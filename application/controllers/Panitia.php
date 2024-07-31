<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Panitia extends CI_Controller
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
			$data['title'] = 'Data Panitia PPDB | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			$this->thm->load('backend/template','backend/panitia/view_index',$data);
		}
		
		public function brosur()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Data Brosur PPDB | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			$this->thm->load('backend/template','backend/brosur/view_index',$data);
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
            $totalRec = $this->model_pendaftar->getPanitia($conditions);
            
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
            $data['record'] = $this->model_pendaftar->getPanitia($conditions);
			
            // Load the data list view 
			$this->load->view('backend/panitia/get-ajax',$data);
			
		}
		
        function ajax_list_brosur()
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
            $totalRec = $this->model_pendaftar->getBrosur($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('panitia/ajax_list_brosur');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchData';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_pendaftar->getBrosur($conditions);
			
            // Load the data list view 
			$this->load->view('backend/brosur/get-ajax',$data);
			
		}
		
		function edit_data(){
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('CONTENT');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				
				$result = $this->model_app->view_where('rb_panitia',['id'=>$index]);
				if($result->num_rows() > 0){
					$response = [
					'status'=>true,
					'id'=>$id,
					'title'=>$result->row()->title,
					'nama'=>$result->row()->nama,
					"nomor"	=> $result->row()->nomor_wa,
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
		
		function edit_brosur(){
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('CONTENT');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				
				$result = $this->model_app->view_where('rb_psb_brosur',['id'=>$index]);
				if($result->num_rows() > 0){
					$response = [
					'status'=>true,
					'id'=>$id,
					'title'=>$result->row()->title,
					'gambar'=>$result->row()->gambar,
					'deskripsi'=>$result->row()->deskripsi,
					'aktif'=>$result->row()->aktif,
					'tampil_image'=>$result->row()->tampil_image,
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
				'rules' => 'required|trim|min_length[2]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 2 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				array(
				'field' => 'nama',
				'label' => 'Nama Panitia',
				'rules' => 'required|trim|min_length[2]|is_unique[rb_unit.nama_jurusan]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 2 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				array(
				'field' => 'nomor',
				'label' => 'Nomor Whatsapp',
				'rules' => 'required|trim|min_length[2]|is_unique[rb_panitia.nomor_wa]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'numeric' => '%s. Harus angka',
				'min_length' => '%s minimal 3 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				));
				if ( $this->form_validation->run() ) 
				{
					$data_post 	= [
					"title"	=> $this->input->post('title',TRUE),
					"nama"	=> $this->input->post('nama',TRUE),
					"nomor_wa"	=> $this->input->post('nomor',TRUE),
					"aktif"	    => $this->input->post('aktif',TRUE),
					];
					$insert = $this->model_app->input('rb_panitia',$data_post);
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
				$nomor 	= decrypt_url($this->input->post('nomor',TRUE));
				
				$this->form_validation->set_rules(array(array(
				'field' => 'nomor',
				'label' => 'Nomor Whatsapp',
				'rules' => 'required|trim|max_length[20]|callback__cek_edit_nomor['.$nomor.']',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'max_length' => '%s maksimal 50 digit.',
				)
				)));
				
				if ( $this->form_validation->run() ) 
				{
					
					$data_post 	= [
					"title"	=> $this->input->post('title',TRUE),
					"nama"	=> $this->input->post('nama',TRUE),
					"nomor_wa"	=> $this->input->post('nomor',TRUE),
					"aktif"	    => $this->input->post('aktif',TRUE),
					];
					$update = $this->model_app->update('rb_panitia',$data_post, ['id'=>$postid]);
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
					}else{
					$arr = [
					'status'=>201,
					'title' =>'Update data',
					'msg'   =>validation_errors(),
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
		
		function simpan_brosur(){
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
				array(
				'field' => 'deskripsi',
				'label' => 'Deskripsi',
				'rules' => 'required|trim|min_length[5]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 2 digit.',
				)
				),
				));
				if ( $this->form_validation->run() ) 
				{
					if(!empty($_FILES['gambar']['name']))
					{
						$config['upload_path']   = './upload'; //path folder
						$config['max_size']		 = 2048;
						$config['allowed_types'] = 'jpg|png|jpeg'; //type yang image yang dizinkan
						$config['encrypt_name']  = TRUE; //enkripsi nama file
						$this->upload->initialize($config);
						if ($this->upload->do_upload('gambar'))
						{
							$gbr = $this->upload->data();
							$gambar = $gbr['file_name'];
							$this->_create_thumb($gbr['file_name']);
							}else{
							$response['status'] = false;
							$response['title'] = 'Upload Error';
							$response['msg'] = $this->upload->display_errors();
							$this->thm->json_output($response);
						}
						}else{
						$response['status'] = false;
						$response['msg'] = 'Foto KK mash kosong';
						$this->thm->json_output($response);
					}
					
					$data_post 	= [
					"title"	=> $this->input->post('title',TRUE),
					"seo"	=> seotitle($this->input->post('title',TRUE)),
					"deskripsi"	=> seotitle($this->input->post('deskripsi',TRUE)),
					"gambar"	=> $gambar,
					"create_date"	=> date('Y-m-d H:i:s'),
					"aktif"	    => $this->input->post('aktif',TRUE),
					"tampil_image"	    => $this->input->post('tampil_image',TRUE),
					];
					$insert = $this->model_app->input('rb_psb_brosur',$data_post);
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
				
				
				if(!empty($_FILES['gambar']['name']))
				{
					$opathFile = FCPATH."upload/" . $this->input->post('gambar_lama',TRUE);
					$size = @getimagesize($opathFile);
					if($size !== false){
						$img=FCPATH."upload/".$this->input->post('gambar_lama',TRUE);
						$thumb=FCPATH."upload/400x300_".$this->input->post('gambar_lama',TRUE);
						unlink($img);
						unlink($thumb);
					}
					$config['upload_path']   = './upload'; //path folder
					$config['max_size']		 = 2048;
					$config['allowed_types'] = 'jpg|png|jpeg'; //type yang image yang dizinkan
					$config['encrypt_name']  = TRUE; //enkripsi nama file
					$this->upload->initialize($config);
					if ($this->upload->do_upload('gambar'))
					{
						$gbr = $this->upload->data();
						$gambar = $gbr['file_name'];
						$this->_create_thumb($gbr['file_name']);
						}else{
						$response['status'] = false;
						$response['msg'] = $this->upload->display_errors();
						$this->thm->json_output($response);
					}
					}else{
					$gambar = $this->input->post('gambar_lama',TRUE);
				}
				
				$data_post 	= [
				"title"	=> $this->input->post('title',TRUE),
				"deskripsi"	=> $this->input->post('deskripsi',TRUE),
				"seo"	=> seotitle($this->input->post('title',TRUE)),
				"gambar"	=> $gambar,
				"aktif"	    => $this->input->post('aktif',TRUE),
				"tampil_image"	    => $this->input->post('tampil_image',TRUE),
				];
				$update = $this->model_app->update('rb_psb_brosur',$data_post, ['id'=>$postid]);
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
			
			$cek = $this->model_app->view_where('rb_psb_daftar', ['id_unit'=>$id]);
			if($cek->num_rows() > 0)
			{
				$data = array('status'=>false,'title'=>'Hapus data','msg'=>'Data tidak bisa dihapus');
				}else{
				$where = array('id' => $id);
				$search = $this->model_app->edit('rb_panitia', $where);
				if($search->num_rows()>0){
					$row = $search->row_array();
					$res = $this->model_app->hapus('rb_panitia',$where);
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
		function hapus_brosur(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));			
			$where = array('id' => $id);
			$search = $this->model_app->edit('rb_psb_brosur', $where);
			if($search->num_rows()>0){
				$row = $search->row();
				$this->hapus_file_brosur($row->gambar);
				$res = $this->model_app->hapus('rb_psb_brosur',$where);
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