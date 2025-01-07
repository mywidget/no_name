<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Alur extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			cek_session_login(1);
			$this->title = tag_key('site_title');
			$this->iduser = $this->session->iduser; 
            $this->level = $this->session->level; 
            $this->idlevel = $this->session->idlevel; 
            $this->menu = $this->uri->segment(1); 
			$this->perPage = 10;
		}
		
		public function index()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			
			$data['title'] = 'Alur PSB | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			
			$this->thm->load('backend/template','backend/alur/view_index',$data);
		}
		
        function ajax_list()
        {
            // Define offset 
            $page = $this->input->post('page');
            if (!$page) {
                $offset = 0;
                } else {
                $offset = $page;
			}
            $keywords = $this->input->post('keywords');
            if (!empty($keywords)) {
                $conditions['search']['keywords'] = $keywords;
			}
            $sortBy = $this->input->post('sortBy');
            if (!empty($sortBy)) {
                $conditions['search']['sortBy'] = $sortBy;
			}
			$limit = $this->input->post('limit');
            if (!empty($limit)) {
                $conditions['search']['limit'] = $limit;
				}else{
				$limit = 5;
			}
			
			
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getAlur($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('alur/ajax_list');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchData';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_data->getAlur($conditions);
			
            // Load the data list view 
			$this->load->view('backend/alur/get-ajax',$data);
			
		}
		
		function edit_data()
		{
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('CONTENT');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				
				$result = $this->model_app->view_where('rb_alur',['id'=>$index]);
				if($result->num_rows() > 0){
					$response = [
					'status'=>true,
					'id'=>$id,
					'title'=>$result->row()->title,
					'icon'=>$result->row()->icon,
					'deskripsi'=>$result->row()->deskripsi,
					'urutan'=>$result->row()->urutan,
					'aktif'=>$result->row()->aktif,
					];
					}else{
					$response = [
					'status'=>false,
					'msg'=>'Gagal'
					];
				}
				$this->thm->json_output($response);
			}
		}
		
		function simpan_data(){
			cek_input_post('GET');
			cek_crud_akses('UPDATE');
			$type = $this->input->post('type',TRUE);
			// dump($_POST);
			if($type=='add'){
				$this->form_validation->set_rules(array(
				array(
				'field' => 'title',
				'label' => 'Title',
				'rules' => 'required|trim|min_length[5]|is_unique[rb_alur.title]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 5 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),array(
				'field' => 'icon',
				'label' => 'icon',
				'rules' => 'required|trim|min_length[5]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 5 digit.',
				)
				),
				array(
				'field' => 'deskripsi',
				'label' => 'Deskripsi',
				'rules' => 'required|trim|min_length[10]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 10 kata.',
				)
				),
				));
				if ( $this->form_validation->run() ) 
				{
					$data_post 	= [
					"title"	=> $this->input->post('title',TRUE),
					"icon"	=> $this->input->post('icon',TRUE),
					"deskripsi"	=> $this->input->post('deskripsi',TRUE),
					"urutan"	    => $this->input->post('urutan',TRUE),
					"aktif"	    => $this->input->post('aktif',TRUE),
					];
					$insert = $this->model_app->input('rb_alur',$data_post);
					if($insert['status']==true)
					{
						$arr = [
						'status'=>true,
						'title' =>'Input data',
						'msg'   =>'Data berhasil Input'
						];
					}
					else
					{
						$arr = [
						'status'=>false,
						'title' =>'Input data',
						'msg'   =>'Data gagal Input'
						];
					}
					}else{
					$response['status'] = false;
					$response['type'] = 'error';
					$response['msg']= validation_errors();
					$this->thm->json_output($response);
				}
			}
			
			
			if($type=='edit'){
				$postid 	= decrypt_url($this->input->post('id',TRUE));
				
				$data_post 	= [
				"title"	=> $this->input->post('title',TRUE),
				"icon"	=> $this->input->post('icon',TRUE),
				"deskripsi"	=> $this->input->post('deskripsi',TRUE),
				"urutan"	    => $this->input->post('urutan',TRUE),
				"aktif"	    => $this->input->post('aktif',TRUE),
				];
				
				$update = $this->model_app->update('rb_alur',$data_post, ['id'=>$postid]);
				if($update['status']=='ok')
				{
					$arr = [
					'status'=>true,
					'title' =>'Update data',
					'msg'   =>'Data berhasil diupdate'
					];
				}
				else
				{
					$arr = [
					'status'=>false,
					'title' =>'Update data',
					'msg'   =>'Data gagal diupdate'
					];
				}
				
			}
			if($type==''){
				$arr = [
				'status'=>201,
				'title' =>'Input data',
				'msg'   =>'Data gagal'
				];
			}
			
			$this->thm->json_output($arr);
			
		}
		 
		function hapus_data(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$where = array('id' => $id);
			$search = $this->model_app->edit('rb_alur', $where);
			if($search->num_rows()>0){
				$row = $search->row_array();
				$res = $this->model_app->hapus('rb_alur',$where);
				if($res==true){
					$data = array('status'=>true,'title'=>'Hapus data','msg'=>'Data berhasil dihapus');
					}else{
					$data = array('status'=>false,'title'=>'Hapus data','msg'=>'Data gagal dihapus');
				}
				
				}else{
				$data = array('status'=>false,'msg'=>'Data gagal dihapus');
			}
			
			$this->thm->json_output($data);
			
		}
		
		function aktifkan(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id = decrypt_url($this->input->post('id',TRUE));
			$aktif = $this->input->post('aktif',TRUE);
			
			$where = array('id' => $id);
			if($aktif=='Ya'){
				$array = array('aktif'=>'Ya');
				$title = 'diaktifkan';
				}else{
				$array = array('aktif'=>'Tidak');
				$title = 'dinonaktifkan';
			}
			
			$search = $this->model_app->edit('rb_alur', ['id' => $id]);
			if($search->num_rows()>0){
				$row = $search->row_array();
				$res = $this->model_app->update('rb_alur',$array,$where);
				if($res==true){
					$data = array('status'=>true,'title'=>'Aktifkan data','msg'=>'Data berhasil '.$title);
					}else{
					$data = array('status'=>false,'title'=>'Aktifkan data','msg'=>'Data gagal '.$title);
				}
				
				}else{
				$data = array('status'=>false,'msg'=>'Data gagal muat');
			}
			
			$this->thm->json_output($data);
			
		}
		
	}																																										