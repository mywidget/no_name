<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Gelombang extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			cek_session_login(1);
			$this->title = tag_key('site_title');
			$this->iduser = $this->session->iduser; 
            $this->level = $this->session->level; 
            $this->idlevel = $this->session->idlevel; 
			$this->load->model('model_pendaftar');
			$this->menu = $this->uri->segment(1); 
			$this->perPage = 10;
		}
		
		public function index()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Data Gelombang PPDB | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			$this->thm->load('backend/template','backend/gelombang/view_index',$data);
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
			$limit = $this->input->post('limit');
            if (!empty($limit)) {
                $conditions['search']['limit'] = $limit;
				}else{
				$limit = 5;
			}
			
			
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_pendaftar->getGelombang($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('panitia/ajax_list');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchData';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_pendaftar->getGelombang($conditions);
			
            // Load the data list view 
			$this->load->view('backend/gelombang/get-ajax',$data);
			
		}
		
		function edit_data(){
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('CONTENT');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				
				$result = $this->model_app->view_where('rb_gelombang',['id_gelombang'=>$index]);
				if($result->num_rows() > 0){
					$response = [
					'status'=>true,
					'id'=>$id,
					'title'=>$result->row()->title,
					'deskripsi'=>$result->row()->deskripsi,
					'tgl_mulai'=>$result->row()->tgl_mulai,
					"tgl_selesai"	=> $result->row()->tgl_selesai,
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
				'rules' => 'required|trim|min_length[2]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 2 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				array(
				'field' => 'tgl_mulai',
				'label' => 'Tanggal Mulai',
				'rules' => 'required|trim',
				'errors' => array(
				'required' => '%s. Harus di isi',
				)
				),
				array(
				'field' => 'tgl_selesai',
				'label' => 'Tanggal selesai',
				'rules' => 'required|trim',
				'errors' => array(
				'required' => '%s. Harus di isi',
				)
				),
				));
				if ( $this->form_validation->run() ) 
				{
					$data_post 	= [
					"title"	=> $this->input->post('title',TRUE),
					"deskripsi"	=> $this->input->post('deskripsi',TRUE),
					"tgl_mulai"	=> $this->input->post('tgl_mulai',TRUE),
					"tgl_selesai"	=> $this->input->post('tgl_selesai',TRUE),
					"aktif"	    => $this->input->post('aktif',TRUE),
					];
					$insert = $this->model_app->input('rb_gelombang',$data_post);
					if($insert['status']==true)
					{
						$this->model_app->update('rb_gelombang',['aktif'=>'N'], ['id_gelombang !='=>$insert['id']]);
						$arr = [
						'status'=>200,
						'title' =>'Input data',
						'msg'   =>'Data berhasil Input'
						];
					}
					else
					{
						$arr = [
						'status'=>201,
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
				"deskripsi"	=> $this->input->post('deskripsi',TRUE),
				"tgl_mulai"	=> $this->input->post('tgl_mulai',TRUE),
				"tgl_selesai"	=> $this->input->post('tgl_selesai',TRUE),
				"aktif"	    => $this->input->post('aktif',TRUE),
				];
				$update = $this->model_app->update('rb_gelombang',$data_post, ['id_gelombang'=>$postid]);
				if($update['status']=='ok')
				{
					$this->model_app->update('rb_gelombang',['aktif'=>'N'], ['id_gelombang !='=>$postid]);
					$arr = [
					'status'=>200,
					'title' =>'Update data',
					'msg'   =>'Data berhasil diupdate'
					];
				}
				else
				{
					$arr = [
					'status'=>201,
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
		
		function _create_thumb($file_name){
			// Image resizing config
			$config = array(
			
			// Image Small
			array(
			'image_library' => 'GD2',
			'source_image'  => './upload/'.$file_name,
			'maintain_ratio'=> FALSE,
			'width'         => 400,
			'height'        => 300,
			'new_image'     => './upload/400x300_'.$file_name
			));
			
			$this->load->library('image_lib', $config[0]);
			foreach ($config as $item){
				$this->image_lib->initialize($item);
				if(!$this->image_lib->crop())
				{
					return false;
				}
				$this->image_lib->clear();
			}
		}
		
		function hapus_data(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$cek = $this->model_app->view_where('rb_psb_daftar', ['id_gelombang'=>$id]);
			if($cek->num_rows() > 0)
			{
				$data = array('status'=>false,'title'=>'Hapus data','msg'=>'Data tidak bisa dihapus');
				}else{
				$where = array('id' => $id);
				$search = $this->model_app->edit('rb_gelombang', $where);
				if($search->num_rows()>0){
					$row = $search->row_array();
					$res = $this->model_app->hapus('rb_gelombang',$where);
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
			
		}
		
		private function hapus_file_brosur($file) 
		{
			$opathFile = FCPATH."upload/" . $file;
			$size = @getimagesize($opathFile);
			if($size !== false){
				$img=FCPATH."upload/".$file;
				$thumbs=FCPATH."upload/400x300_".$file;
				unlink($img);
				unlink($thumbs);
			}
		}
		
		public function _cek_edit_nomor($val = '') 
		{
			$id_post = ($this->input->post('id') ? decrypt_url($this->input->post('id')) : 0);
			$cek = $this->model_pendaftar->cek_nomor($id_post, $val);
			
			if ( $cek === FALSE ) 
			{
				$this->form_validation->set_message('_cek_edit_nomor', 'Nomor Whatsapp sudah ada');
			} 
			
			return $cek;
		}
	}																																			