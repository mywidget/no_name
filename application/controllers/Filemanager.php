<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Filemanager extends CI_Controller
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
			$data['title'] = 'Data filemanager | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			$this->thm->load('backend/template','backend/filemanager/view_index',$data);
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
            $totalRec = $this->model_data->getFile($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('filemanager/ajax_list');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchData';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_data->getFile($conditions);
			
            // Load the data list view 
			$this->load->view('backend/filemanager/get-ajax',$data);
			
		}
		  
		function edit_data(){
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('CONTENT');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				
				$result = $this->model_app->view_where('rb_filemanager',['id'=>$index]);
				if($result->num_rows() > 0){
					$response = [
					'status'=>true,
					'id'=>$id,
					'title'=>$result->row()->title,
					'file'=>$result->row()->nama_file,
					'aktif'=>$result->row()->aktif
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
			if($type=='new'){
				$this->form_validation->set_rules(array(
				array(
				'field' => 'title',
				'label' => 'Title',
				'rules' => 'required|trim|min_length[2]|is_unique[rb_psb_brosur.title]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 2 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				));
				if ( $this->form_validation->run() ) 
				{
					if(!empty($_FILES['file']['name']))
					{
						$config['upload_path']   = './upload'; //path folder
						$config['max_size']		 = 2048;
						$config['allowed_types'] = 'jpg|png|jpeg|doc|docx|pdf'; //type yang image yang dizinkan
						$config['encrypt_name']  = TRUE; //enkripsi nama file
						$this->upload->initialize($config);
						if ($this->upload->do_upload('file'))
						{
							$gbr = $this->upload->data();
							$gambar = $gbr['file_name'];
							}else{
							$response['status'] = false;
							$response['title'] = 'Upload Error';
							$response['msg'] = $this->upload->display_errors();
							$this->thm->json_output($response);
						}
						}else{
						$response['status'] = false;
						$response['msg'] = 'File mash kosong';
						$this->thm->json_output($response);
					}
					
					$data_post 	= [
					"title"	=> $this->input->post('title',TRUE),
					"seo"	=> seotitle($this->input->post('title',TRUE)),
					"nama_file"	=> $gambar,
					"aktif"	    => $this->input->post('aktif',TRUE),
					];
					$insert = $this->model_app->input('rb_filemanager',$data_post);
					if($insert['status']==true)
					{
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
				
				
				if(!empty($_FILES['file']['name']))
				{
					$opathFile = FCPATH."upload/" . $this->input->post('file_lama',TRUE);
					$size = @getimagesize($opathFile);
					if($size !== false){
						$img=FCPATH."upload/".$this->input->post('file_lama',TRUE);
						unlink($img);
				 
					}
					$config['upload_path']   = './upload'; //path folder
					$config['max_size']		 = 2048;
					$config['allowed_types'] = 'jpg|png|jpeg|doc|docx|pdf'; //type yang image yang dizinkan
					$config['encrypt_name']  = TRUE; //enkripsi nama file
					$this->upload->initialize($config);
					if ($this->upload->do_upload('file'))
					{
						$gbr = $this->upload->data();
						$gambar = $gbr['file_name'];
					 
						}else{
						$response['status'] = false;
						$response['msg'] = $this->upload->display_errors();
						$this->thm->json_output($response);
					}
					}else{
					$gambar = $this->input->post('file_lama',TRUE);
				}
				
				$data_post 	= [
				"title"	=> $this->input->post('title',TRUE),
				"seo"	=> seotitle($this->input->post('title',TRUE)),
				"nama_file"	=> $gambar,
				"aktif"	    => $this->input->post('aktif',TRUE),
				];
				$update = $this->model_app->update('rb_filemanager',$data_post, ['id'=>$postid]);
				if($update['status']=='ok')
				{
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
		  
		function hapus_data(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));			
			$where = array('id' => $id);
			$search = $this->model_app->edit('rb_filemanager', $where);
			if($search->num_rows()>0){
				$row = $search->row();
				$this->hapus_file_brosur($row->gambar);
				$res = $this->model_app->hapus('rb_filemanager',$where);
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
		
		private function hapus_file_brosur($file) 
		{
			$opathFile = FCPATH."upload/" . $file;
			$size = @filesize($opathFile);
			if($size !== false){
				$img=FCPATH."upload/".$file;
				unlink($img);
				 
			}
		}
		 
	}																																