<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Aplikasi extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			cek_session_login(1);
			$this->perPage = 10; 
			$this->title = tag_key('site_title');
			$this->iduser = $this->session->iduser; 
			$this->akses = $this->session->type_akses; 
			$this->perPage = 10;
		}
		
		public function index()
		{
			cek_menu_akses();
			
			$data['title'] = 'Pengaturan ' .$this->title;
			$this->thm->load('backend/template','backend/aplikasi/view_index',$data);
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
				$limit = $this->perPage;
			}
			
			
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getApliksi($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('aplikasi/ajax_list');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchData';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['start'] = $offset;
            $data['record'] = $this->model_data->getApliksi($conditions);
			
            // Load the data list view 
			$this->load->view('backend/aplikasi/get-ajax',$data);
			
		}
		
		function edit_data(){
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('CONTENT');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				
				$result = $this->model_app->view_where('rb_setting',['id'=>$index]);
				if($result->num_rows() > 0){
					$response = [
					'status'=>true,
					'id'=>$id,
					'name'=>$result->row()->name,
					'value'=>$result->row()->value,
					'jenis'=>$result->row()->jenis,
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
		
		/**
			* save_template
			*
			* @return void
		*/
		public function save_data()
		{
			// dumps();
			if ($this->input->is_ajax_request()) {
				$type   = xss_filter($this->input->post('type'), 'xss');
				$name   = xss_filter($this->input->post('name'), 'xss');
				$value 	= xss_filter($this->input->post('value'));
				$jenis 	= xss_filter($this->input->post('jenis'));
			 
				$this->form_validation->set_rules(array(array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required|trim',
				'errors' => array(
				'required' => '%s. Harus di isi'
				)
				)));
				
				
				if ($this->form_validation->run()) {
					if ($type == 'add') {
						if(!empty($_FILES['image']['name']))
						{
							$config['upload_path']   = './upload'; //path folder
							$config['max_size']		 = tag_key('file_size');
							$config['allowed_types'] = tag_key('file_allowed'); //type yang image yang dizinkan
							$config['encrypt_name']  = TRUE; //enkripsi nama file
							$this->upload->initialize($config);
							if ($this->upload->do_upload('image'))
							{
								$gbr = $this->upload->data();
								$gambar = $gbr['file_name'];
								$param = ['name' => cleans($name), 'value' => $gambar, 'jenis' => $jenis];
								$input =  $this->model_app->input('rb_setting', $param);
								if ($input['status'] == 'ok') {
									$result = array('status' => true, 'title'=>'Tambah Data','msg' => 'Data berhasil diinput');
									} else {
									$result = array('status' => false,'title'=>'Tambah Data','msg' => 'Data gagal diinput');
								}
								}else{
								$response['status'] = false;
								$response['title'] = 'Upload Error';
								$response['msg'] = $this->upload->display_errors();
								$this->thm->json_output($response);
							}
							}else{
							$param = ['name' => cleans($name), 'value' => $value, 'jenis' => $jenis];
							$input =  $this->model_app->input('rb_setting', $param);
							if ($input['status'] == 'ok') {
								$result = array('status' => true, 'title'=>'Tambah Data','msg' => 'Data berhasil diinput');
								} else {
								$result = array('status' => false,'title'=>'Tambah Data','msg' => 'Data gagal diinput');
							}
						}
					}
					if ($type == 'edit') {
						if(!empty($_FILES['image']['name']))
						{
							
							$id 	= decrypt_url($this->input->post('id',TRUE));
							$where = array('id' => $id);
							$gambar_lama = $this->model_app->pilih_where('value','rb_setting', $where)->row()->value;
							
							$config['upload_path']   = './upload'; //path folder
							$config['max_size']		 = tag_key('file_size');
							$config['allowed_types'] = tag_key('file_allowed'); //type yang image yang dizinkan
							$config['encrypt_name']  = TRUE; //enkripsi nama file
							$this->upload->initialize($config);
							if ($this->upload->do_upload('image'))
							{
								$opathFile = FCPATH."upload/" . $gambar_lama;
								$size = @getimagesize($opathFile);
								if($size !== false){
									$img=FCPATH."upload/".$gambar_lama;
									unlink($img);
								}
								$gbr = $this->upload->data();
								$gambar = $gbr['file_name'];
								$param = ['name' => cleans($name), 'value' => $gambar, 'jenis' => $jenis];
							
								$input =  $this->model_app->update('rb_setting', $param, ['id' => $id]);
								if ($input['status'] == 'ok') {
									$result = array('status' => true, 'title'=>'Tambah Data','msg' => 'Data berhasil diinput');
									} else {
									$result = array('status' => false,'title'=>'Tambah Data','msg' => 'Data gagal diinput');
								}
								}else{
								$response['status'] = false;
								$response['title'] = 'Upload Error';
								$response['msg'] = $this->upload->display_errors();
								$this->thm->json_output($response);
							}
							
							}else{
							$id = xss_filter($this->input->post('id'), 'xss');
							$id = decrypt_url($id);
							$param = ['name' => cleans($name), 'value' => $value, 'jenis' => $jenis];
							$update = $this->model_app->update('rb_setting', $param, ['id' => $id]);
							if ($update['status'] == 'ok') {
								$result = array('status' => true, 'title'=>'Simpan Data','msg' => 'Data berhasil disimpan');
								} else {
								$result = array('status' => false, 'title'=>'Simpan Data','msg' => 'Data gagal disimpan');
							}
						}
					}
					} else {
					
					$result['status'] 	= false;
					$result['title'] 	= 'error';
					$result['msg'] 		= validation_errors();
				}
				
				} else {
				$result = ['status' => false];
			}
			$this->thm->json_output($result);
		}
		
		function hapus_data(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$where = array('id' => $id);
			$search = $this->model_app->edit('rb_setting', $where);
			if($search->num_rows()>0){
				$row = $search->row_array();
				$res = $this->model_app->hapus('rb_setting',$where);
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
