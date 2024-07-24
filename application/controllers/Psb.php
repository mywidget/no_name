<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Psb extends CI_Controller
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
			$data['title'] = 'Data Unit & Kelas | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			
			$data['unit'] = $this->model_app->view_where('rb_unit',['aktif'=>'Ya'])->result();
			$data['kelas'] = $this->model_app->view_where('rb_kelas',['aktif'=>'Ya'])->result();
			
			$this->thm->load('backend/template','backend/unit_kelas/view_index',$data);
		}
		
		public function kuota()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Data Kuota Kamar | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			
			$data['unit'] = $this->model_app->view_where('rb_unit',['aktif'=>'Ya'])->result();
			$data['kelas'] = $this->model_app->view_where('rb_kelas',['aktif'=>'Ya'])->result();
			
			$this->thm->load('backend/template','backend/kuota/view_index',$data);
		}
		
		public function tahun_akademik()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Data Tahun Akademik | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			$this->thm->load('backend/template','backend/tahun_akademik/view_index',$data);
		}
		
		public function pendidikan()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Data Pendidikan & Pekerjaan | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			$this->thm->load('backend/template','backend/pendidikan/view_index',$data);
		}
		
        function ajax_list_unit()
        {
			cek_crud_akses('READ','html');
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
            $totalRec = $this->model_pendaftar->getUnit($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content_unit';
            $config['base_url']    = base_url('psb/ajax_list_unit');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchUnit';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_pendaftar->getUnit($conditions);
			
            // Load the data list view 
			$this->load->view('backend/unit_kelas/get-ajax-unit',$data);
			
		}
		
		function edit_unit(){
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('CONTENT','json');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				
				$result = $this->model_app->view_where('rb_unit',['id'=>$index]);
				if($result->num_rows() > 0){
					$response = [
					'status'=>true,
					'id'=>$id,
					'kode'=>$result->row()->kode_jurusan,
					'nama'=>$result->row()->nama_jurusan,
					"pendaftaran"	=> $result->row()->biaya_pendaftaran,
					"kenaikan"	=> $result->row()->biaya_kenaikan,
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
		
		function simpan_unit(){
			cek_input_post('GET');
			cek_crud_akses('UPDATE');
			$type = $this->input->post('type_unit',TRUE);
			// dump($_POST);
			if($type=='new'){
				$this->form_validation->set_rules(array(
				array(
				'field' => 'kode_unit',
				'label' => 'Kode Unit',
				'rules' => 'required|trim|min_length[2]|is_unique[rb_unit.kode_jurusan]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 2 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				array(
				'field' => 'nama_unit',
				'label' => 'Nama Unit',
				'rules' => 'required|trim|min_length[2]|is_unique[rb_unit.nama_jurusan]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 2 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				array(
				'field' => 'pendaftaran',
				'label' => 'Biaya Pendaftaran',
				'rules' => 'required|trim|numeric|min_length[3]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'numeric' => '%s. Harus angka',
				'min_length' => '%s minimal 3 digit.',
				)
				),
				array(
				'field' => 'kenaikan',
				'label' => 'Biaya Kenaikan Tingkat',
				'rules' => 'required|trim|numeric|min_length[3]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'numeric' => '%s. Harus angka',
				'min_length' => '%s minimal 3 digit.',
				)
				),
				));
				if ( $this->form_validation->run() ) 
				{
					$data_post 	= [
					"kode_jurusan"	=> $this->input->post('kode_unit',TRUE),
					"nama_jurusan"	=> $this->input->post('nama_unit',TRUE),
					"biaya_pendaftaran"	=> $this->input->post('pendaftaran',TRUE),
					"biaya_kenaikan"	=> $this->input->post('kenaikan',TRUE),
					"aktif"	    => $this->input->post('aktif_unit',TRUE),
					];
					$insert = $this->model_app->input('rb_unit',$data_post);
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
				$postid 	= decrypt_url($this->input->post('id_unit',TRUE));
				$kode_unit 	= decrypt_url($this->input->post('kode_unit',TRUE));
				$nama_unit 	= decrypt_url($this->input->post('nama_unit',TRUE));
				
				$this->form_validation->set_rules(array(array(
				'field' => 'kode_unit',
				'label' => 'Kode Unit',
				'rules' => 'required|trim|max_length[50]|callback__cek_edit_kode_unit['.$kode_unit.']',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'max_length' => '%s maksimal 50 digit.',
				)
				)));
				
				$this->form_validation->set_rules(array(array(
				'field' => 'nama_unit',
				'label' => 'Nama Unit',
				'rules' => 'required|trim|max_length[50]|callback__cek_edit_nama_unit['.$nama_unit.']',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'max_length' => '%s maksimal 50 digit.',
				)
				)));
				
				if ( $this->form_validation->run() ) 
				{
					
					$data_post 	= [
					"kode_jurusan"	=> $this->input->post('kode_unit',TRUE),
					"nama_jurusan"	=> $this->input->post('nama_unit',TRUE),
					"biaya_pendaftaran"	=> $this->input->post('pendaftaran',TRUE),
					"biaya_kenaikan"	=> $this->input->post('kenaikan',TRUE),
					"aktif"	    => $this->input->post('aktif_unit',TRUE),
					];
					
					$update = $this->model_app->update('rb_unit',$data_post, ['id'=>$postid]);
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
		
		function hapus_unit(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$cek = $this->model_app->view_where('rb_psb_daftar', ['id_unit'=>$id]);
			if($cek->num_rows() > 0)
			{
				$data = array('status'=>false,'title'=>'Hapus data','msg'=>'Data tidak bisa dihapus');
				}else{
				$where = array('id' => $id);
				$search = $this->model_app->edit('rb_unit', $where);
				if($search->num_rows()>0){
					$row = $search->row_array();
					$res = $this->model_app->hapus('rb_unit',$where);
					if($res==true){
						$data = array('status'=>true,'title'=>'Hapus data','msg'=>'Data berhasil dihapus');
						}else{
						$data = array('status'=>false,'title'=>'Hapus data','msg'=>'Data gagal dihapus');
					}
					
					}else{
					$data = array('status'=>false,'msg'=>'Data gagal dihapus');
				}
				
			}
			$this->thm->json_output($data);
			
		}
		
		function ajax_list_kelas()
        {
			cek_crud_akses('READ','html');
            // Define offset 
            $page = $this->input->post('page');
            if (!$page) {
                $offset = 0;
                } else {
                $offset = $page;
			}
			
			$limit = $this->input->post('limit');
            if (!empty($limit)) {
                $conditions['search']['limit'] = $limit;
				}else{
				$limit = 5;
			}
			
            $keywords = $this->input->post('keywords');
            if (!empty($keywords)) {
                $conditions['search']['keywords'] = $keywords;
			}
			
			
            $unit = $this->input->post('unit');
            if (!empty($unit)) {
                $conditions['where'] = ['id_unit'=>$unit];
			}
			
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_pendaftar->getKelas($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content_kelas';
            $config['base_url']    = base_url('psb/ajax_list_kelas');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchKelas';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['start'] = $offset;
            $data['record'] = $this->model_pendaftar->getKelas($conditions);
			
            // Load the data list view 
			$this->load->view('backend/unit_kelas/get-ajax-kelas',$data);
			
		}
		
		function edit_kelas(){
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('CONTENT','json');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				
				$result = $this->model_app->view_where('rb_kelas',['id'=>$index]);
				if($result->num_rows() > 0){
					$response = [
					'status'=>true,
					'id'=>$id,
					'unit'=>$result->row()->id_unit,
					'kode'=>$result->row()->kode_kelas,
					'nama'=>$result->row()->nama_kelas,
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
		
		function simpan_kelas(){
			cek_input_post('GET');
			cek_crud_akses('UPDATE');
			$type = $this->input->post('type_kelas',TRUE);
			$kode_kelas = $this->input->post('kode_kelas',TRUE);
			$exp = explode(' ',$kode_kelas);
			
			$get_kode = get_kelas($exp[0]);
			// dump($get_kode);
			if($type=='new'){
				$this->form_validation->set_rules(array(
				array(
				'field' => 'kode_kelas',
				'label' => 'Kode Kelas',
				'rules' => 'required|trim|min_length[1]|is_unique[rb_kelas.kode_kelas]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 1 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				array(
				'field' => 'nama_kelas',
				'label' => 'Nama Kelas',
				'rules' => 'required|trim|min_length[2]|is_unique[rb_kelas.nama_kelas]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 2 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				));
				if ( $this->form_validation->run() ) 
				{
					$data_post 	= [
					"id_unit"	=> $this->input->post('unit_kelas',TRUE),
					"kode_kelas"	=> $this->input->post('kode_kelas',TRUE),
					"nama_kelas"	=> $this->input->post('nama_kelas',TRUE),
					"status"	    => $get_kode,
					"aktif"	    => $this->input->post('aktif_kelas',TRUE),
					];
					$insert = $this->model_app->input('rb_kelas',$data_post);
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
				$postid 	= decrypt_url($this->input->post('id_kelas',TRUE));
				$nama_kelas	= $this->input->post('nama_kelas',TRUE);
				
				$this->form_validation->set_rules(array(array(
				'field' => 'kode_kelas',
				'label' => 'Kode Kelas',
				'rules' => 'required|trim|max_length[50]|callback__cek_edit_kode_kelas['.$kode_kelas.']',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'max_length' => '%s maksimal 50 digit.',
				)
				)));
				
				$this->form_validation->set_rules(array(array(
				'field' => 'nama_kelas',
				'label' => 'Nama Kelas',
				'rules' => 'required|trim|max_length[50]|callback__cek_edit_nama_kelas['.$nama_kelas.']',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'max_length' => '%s maksimal 50 digit.',
				)
				)));
				
				if ( $this->form_validation->run() ) 
				{
					$data_post 	= [
					"id_unit"	=> $this->input->post('unit_kelas',TRUE),
					"kode_kelas"	=> $this->input->post('kode_kelas',TRUE),
					"nama_kelas"	=> $this->input->post('nama_kelas',TRUE),
					"status"	    => $get_kode,
					"aktif"	    => $this->input->post('aktif_kelas',TRUE),
					];
					// dump($data_post);
					$update = $this->model_app->update('rb_kelas',$data_post, ['id'=>$postid]);
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
		
		function hapus_kelas(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$cek = $this->model_app->view_where('rb_psb_daftar', ['kelas'=>$id]);
			if($cek->num_rows() > 0)
			{
				$data = array('status'=>false,'title'=>'Hapus data','msg'=>'Data tidak bisa dihapus');
				}else{
				$where = array('id' => $id);
				$search = $this->model_app->edit('rb_kelas', $where);
				if($search->num_rows()>0){
					$row = $search->row_array();
					$res = $this->model_app->hapus('rb_kelas',$where);
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
		
		
        function ajax_list_ajaran()
        {
			cek_crud_akses('READ','html');
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
            $totalRec = $this->model_pendaftar->getTahun($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('psb/ajax_list_ajaran');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchTahun';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_pendaftar->getTahun($conditions);
			
            // Load the data list view 
			$this->load->view('backend/tahun_akademik/get-ajax',$data);
			
		}
		
		
		function edit_tahun(){
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('EDIT','json');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				
				$result = $this->model_app->view_where('rb_tahun_akademik',['id'=>$index]);
				if($result->num_rows() > 0)
				{
					
					$response = [
					'status'		=>true,
					'id'			=>$id,
					'kode'			=>$result->row()->id_tahun_akademik,
					'nama'			=>$result->row()->nama_tahun,
					"keterangan"	=> $result->row()->keterangan,
					'aktif'			=>$result->row()->aktif,
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
		
		function simpan_tahun(){
			cek_input_post('GET');
			cek_crud_akses('UPDATE','json');
			$type = $this->input->post('type',TRUE);
			
			if($type=='new'){
				$this->form_validation->set_rules(array(
				array(
				'field'             => 'kode_tahun',
				'label'             => 'Kode Tahun',
				'rules'             => 'required|trim|min_length[8]|is_unique[rb_tahun_akademik.id_tahun_akademik]',
				'errors'            => array(
				'required'          => '%s. Harus di isi',
				'min_length'        => '%s minimal 8 digit.',
				'is_unique'         => '%s sudah ada.'
				)
				),
				array(
				'field'             => 'nama_tahun',
				'label'             => 'Nama Tahun',
				'rules'             => 'required|trim|min_length[2]|is_unique[rb_tahun_akademik.nama_tahun]',
				'errors'            => array(
				'required'          => '%s. Harus di isi',
				'min_length'        => '%s minimal 2 digit.',
				'is_unique'         => '%s sudah ada.'
				)
				),
				array(
				'field'             => 'keterangan',
				'label'             => 'Keterangan',
				'rules'             => 'required|trim|min_length[5]',
				'errors'            => array(
				'required'          => '%s. Harus di isi',
				'min_length'        => '%s minimal 5 digit.',
				)
				),
				));
				if ( $this->form_validation->run() ) 
				{
					$data_post 	= [
					"id_tahun_akademik"	=> $this->input->post('kode_tahun',TRUE),
					"nama_tahun"	=> $this->input->post('nama_tahun',TRUE),
					"keterangan"	=> $this->input->post('keterangan',TRUE),
					"aktif"	        => $this->input->post('aktif',TRUE),
					];
					$insert = $this->model_app->input('rb_tahun_akademik',$data_post);
					if($insert['status']==true)
					{
						$this->model_app->update('rb_tahun_akademik',['aktif'=>'Tidak'], ['id !='=>$insert['id']]);
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
					$response['title'] = 'Input error';
					$response['msg']= validation_errors();
					$this->thm->json_output($response);
				}
			}
			
			
			if($type=='edit'){
				$postid 	= decrypt_url($this->input->post('id_tahun',TRUE));
				$kode_tahun 	= decrypt_url($this->input->post('kode_tahun',TRUE));
				$nama_tahun 	= decrypt_url($this->input->post('nama_tahun',TRUE));
				
				$this->form_validation->set_rules(array(array(
				'field' => 'kode_tahun',
				'label' => 'Kode Unit',
				'rules' => 'required|trim|min_length[8]|callback__cek_edit_kode_tahun['.$kode_tahun.']',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'max_length' => '%s minimal 8 digit.',
				)
				)));
				
				$this->form_validation->set_rules(array(array(
				'field' => 'nama_tahun',
				'label' => 'Nama Unit',
				'rules' => 'required|trim|max_length[50]|callback__cek_edit_nama_tahun['.$nama_tahun.']',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'max_length' => '%s maksimal 50 digit.',
				)
				)));
				
				if ( $this->form_validation->run() ) 
				{
					
					$data_post 	= [
					"id_tahun_akademik"	=> $this->input->post('kode_tahun',TRUE),
					"nama_tahun"	=> $this->input->post('nama_tahun',TRUE),
					"keterangan"	=> $this->input->post('keterangan',TRUE),
					"aktif"	    => $this->input->post('aktif',TRUE),
					];
					
					$update = $this->model_app->update('rb_tahun_akademik',$data_post, ['id'=>$postid]);
					if($update['status']=='ok')
					{
						$this->model_app->update('rb_tahun_akademik',['aktif'=>'Tidak'], ['id !='=>$postid]);
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
		
		function hapus_tahun(){
			cek_input_post('GET');
			cek_crud_akses('DELETE','json');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$cek = $this->model_app->view_where('rb_psb_daftar', ['id_unit'=>$id]);
			if($cek->num_rows() > 0)
			{
				$data = array('status'=>false,'title'=>'Hapus data','msg'=>'Data tidak bisa dihapus');
				}else{
				$where = array('id' => $id);
				$search = $this->model_app->edit('rb_tahun_akademik', $where);
				if($search->num_rows()>0){
					$row = $search->row();
				 
					if($row->aktif=='Ya'){
						$last = $this->model_app->last_id('rb_tahun_akademik')->id;
						$this->model_app->update('rb_tahun_akademik',['aktif'=>'Tidak'], ['id'=>$last]);
					}
					$res = $this->model_app->hapus('rb_tahun_akademik',$where);
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
		
		function ajax_list_kuota()
        {
			cek_crud_akses('CONTENT','html');
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
			$totalRec = $this->model_pendaftar->getKuota($conditions);
			
			// Pagination configuration 
			$config['target']      = '#posts_content';
			$config['base_url']    = base_url('psb/ajax_list_kuota');
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
			$data['record'] = $this->model_pendaftar->getKuota($conditions);
			
			// Load the data list view 
			$this->load->view('backend/kuota/get-ajax',$data);
			
		}
		
		function edit_kuota(){
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('CONTENT');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				
				$result = $this->model_app->view_where('rb_kamar',['id'=>$index]);
				if($result->num_rows() > 0)
				{
					
					$response = [
					'status'		=>true,
					'id'			=>$id,
					'id_unit'		=>$result->row()->id_unit,
					'nama'			=>$result->row()->nama_kamar,
					"kuota"	=> $result->row()->kuota,
					'aktif'			=>$result->row()->aktif,
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
		
		function simpan_kuota(){
			cek_input_post('GET');
			cek_crud_akses('UPDATE');
			$type = $this->input->post('type',TRUE);
			
			if($type=='new'){
				$this->form_validation->set_rules(array(
				array(
				'field'             => 'nama_kamar',
				'label'             => 'Nama Kamar',
				'rules'             => 'required|trim|min_length[3]|is_unique[rb_kamar.nama_kamar]',
				'errors'            => array(
				'required'          => '%s. Harus di isi',
				'min_length'        => '%s minimal 3 digit.',
				'is_unique'         => '%s sudah ada.'
				)
				),
				array(
				'field'             => 'kuota',
				'label'             => 'Kuota',
				'rules'             => 'required|trim|numeric',
				'errors'            => array(
				'required'          => '%s. Harus di isi',
				'min_length'        => '%s minimal 2 digit.',
				'numeric'       	=> '%s Harus angka',
				)
				),
				));
				if ( $this->form_validation->run() ) 
				{
					$data_post 	= [
					"id_unit"	=> $this->input->post('id_unit',TRUE),
					"nama_kamar"	=> $this->input->post('nama_kamar',TRUE),
					"kuota"	=> $this->input->post('kuota',TRUE),
					"gender"	=> $this->input->post('gender',TRUE),
					"aktif"	    => $this->input->post('aktif',TRUE),
					];
					$insert = $this->model_app->input('rb_kamar',$data_post);
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
					$response['title'] = 'Error Input';
					$response['msg']= validation_errors();
					$this->thm->json_output($response);
				}
			}
			
			
			if($type=='edit'){
				$postid 	= decrypt_url($this->input->post('id',TRUE));
				
				$data_post 	= [
				"id_unit"	=> $this->input->post('id_unit',TRUE),
				"nama_kamar"	=> $this->input->post('nama_kamar',TRUE),
				"kuota"	=> $this->input->post('kuota',TRUE),
				"gender"	=> $this->input->post('gender',TRUE),
				"aktif"	    => $this->input->post('aktif',TRUE),
				];
				
				$update = $this->model_app->update('rb_kamar',$data_post, ['id'=>$postid]);
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
		
		function hapus_kuota(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$cek = $this->model_app->view_where('rb_psb_daftar', ['kamar'=>$id]);
			if($cek->num_rows() > 0)
			{
				$data = array('status'=>false,'title'=>'Hapus data','msg'=>'Data tidak bisa dihapus');
				}else{
				$where = array('id' => $id);
				$search = $this->model_app->edit('rb_kamar', $where);
				if($search->num_rows()>0){
					$row = $search->row_array();
					$res = $this->model_app->hapus('rb_kamar',$where);
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
		
		function ajax_list_pendidikan()
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
            $totalRec = $this->model_pendaftar->getPendidikan($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content_pendidikan';
            $config['base_url']    = base_url('psb/ajax_list_pendidikan');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchPendidikan';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['start'] = $offset;
            $data['record'] = $this->model_pendaftar->getPendidikan($conditions);
			
            // Load the data list view 
			$this->load->view('backend/pendidikan/get-ajax-pendidikan',$data);
			
		}
		
		function edit_pendidikan(){
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('CONTENT');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				
				$result = $this->model_app->view_where('rb_pendidikan',['id'=>$index]);
				if($result->num_rows() > 0)
				{
					
					$response = [
					'status'	=>true,
					'id'		=>$id,
					'title'		=>$result->row()->title,
					'aktif'		=>$result->row()->aktif,
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
		
		function simpan_pendidikan(){
			cek_input_post('GET');
			cek_crud_akses('UPDATE');
			$type = $this->input->post('type_pendidikan',TRUE);
			
			if($type=='new'){
				$this->form_validation->set_rules(array(
				array(
				'field'             => 'title_pendidikan',
				'label'             => 'Pendidikan Terakhir',
				'rules'             => 'required|trim|min_length[2]|is_unique[rb_pendidikan.title]',
				'errors'            => array(
				'required'          => '%s. Harus di isi',
				'min_length'        => '%s minimal 2 digit.',
				'is_unique'         => '%s sudah ada.'
				)
				),
				));
				if ( $this->form_validation->run() ) 
				{
					$data_post 	= [
					"title"	=> $this->input->post('title_pendidikan',TRUE),
					"aktif"	    => $this->input->post('aktif_pendidikan',TRUE),
					];
					$insert = $this->model_app->input('rb_pendidikan',$data_post);
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
					$response['title'] = 'Error Input';
					$response['msg']= validation_errors();
					$this->thm->json_output($response);
				}
			}
			
			
			if($type=='edit'){
				$postid 	= decrypt_url($this->input->post('id_pendidikan',TRUE));
				
				$data_post 	= [
				"title"	=> $this->input->post('title_pendidikan',TRUE),
				"aktif"	    => $this->input->post('aktif_pendidikan',TRUE),
				];
				
				$update = $this->model_app->update('rb_pendidikan',$data_post, ['id'=>$postid]);
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
		
		function hapus_pendidikan(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$cek = $this->model_app->view_where('rb_psb_daftar', ['ijasah_terakhir'=>$id]);
			if($cek->num_rows() > 0)
			{
				$data = array('status'=>false,'title'=>'Hapus data','msg'=>'Data tidak bisa dihapus');
				}else{
				$where = array('id' => $id);
				$search = $this->model_app->edit('rb_pendidikan', $where);
				if($search->num_rows()>0){
					$row = $search->row_array();
					$res = $this->model_app->hapus('rb_pendidikan',$where);
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
		
		function ajax_list_pekerjaan()
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
            $totalRec = $this->model_pendaftar->getPekerjaan($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content_pekerjaan';
            $config['base_url']    = base_url('psb/ajax_list_pekerjaan');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchPekerjaan';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['start'] = $offset;
            $data['record'] = $this->model_pendaftar->getPekerjaan($conditions);
			
            // Load the data list view 
			$this->load->view('backend/pendidikan/get-ajax-pekerjaan',$data);
			
		}
		
		function edit_pekerjaan(){
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('CONTENT');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				
				$result = $this->model_app->view_where('rb_pekerjaan',['id'=>$index]);
				if($result->num_rows() > 0)
				{
					
					$response = [
					'status'	=>true,
					'id'		=>$id,
					'title'		=>$result->row()->title,
					'aktif'		=>$result->row()->aktif,
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
		
		function simpan_pekerjaan(){
			cek_input_post('GET');
			cek_crud_akses('UPDATE');
			$type = $this->input->post('type_pekerjaan',TRUE);
			
			if($type=='new'){
				$this->form_validation->set_rules(array(
				array(
				'field'             => 'title_pekerjaan',
				'label'             => 'Pekerjaan',
				'rules'             => 'required|trim|min_length[2]|is_unique[rb_pekerjaan.title]',
				'errors'            => array(
				'required'          => '%s. Harus di isi',
				'min_length'        => '%s minimal 2 digit.',
				'is_unique'         => '%s sudah ada.'
				)
				),
				));
				if ( $this->form_validation->run() ) 
				{
					$data_post 	= [
					"title"	=> $this->input->post('title_pekerjaan',TRUE),
					"aktif"	    => $this->input->post('aktif_pekerjaan',TRUE),
					];
					$insert = $this->model_app->input('rb_pekerjaan',$data_post);
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
					$response['title'] = 'Error Input';
					$response['msg']= validation_errors();
					$this->thm->json_output($response);
				}
			}
			
			
			if($type=='edit'){
				$postid 	= decrypt_url($this->input->post('id_pekerjaan',TRUE));
				
				$data_post 	= [
				"title"	=> $this->input->post('title_pekerjaan',TRUE),
				"aktif"	    => $this->input->post('aktif_pekerjaan',TRUE),
				];
				
				$update = $this->model_app->update('rb_pendidikan',$data_post, ['id'=>$postid]);
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
		
		function hapus_pekerjaan(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$cek = $this->model_app->view_or_where('rb_psb_daftar', ['pekerjaan_ayah'=>$id],['pekerjaan_ibu'=>$id]);
			if($cek->num_rows() > 0)
			{
				$data = array('status'=>false,'title'=>'Hapus data','msg'=>'Data tidak bisa dihapus');
				}else{
				$where = array('id' => $id);
				$search = $this->model_app->edit('rb_pekerjaan', $where);
				if($search->num_rows()>0){
					$row = $search->row_array();
					$res = $this->model_app->hapus('rb_pekerjaan',$where);
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
		
		public function _cek_edit_kode_unit($val = '') 
		{
			$id_post = ($this->input->post('id_unit') ? decrypt_url($this->input->post('id_unit')) : 0);
			$cek = $this->model_pendaftar->cek_kode_unit($id_post, $val);
			
			if ( $cek === FALSE ) 
			{
				$this->form_validation->set_message('_cek_edit_kode_unit', 'Kode Unit sudah ada');
			} 
			
			return $cek;
		}
		
		public function _cek_edit_nama_unit($val = '') 
		{
			$id_post = ($this->input->post('id_unit') ? decrypt_url($this->input->post('id_unit')) : 0);
			$cek = $this->model_pendaftar->cek_nama_unit($id_post, $val);
			
			if ( $cek === FALSE ) 
			{
				$this->form_validation->set_message('_cek_edit_nama_unit', 'Nama Unit sudah ada');
			} 
			
			return $cek;
		}
		
		public function _cek_edit_kode_kelas($val = '') 
		{
			$id_post = ($this->input->post('id_kelas') ? decrypt_url($this->input->post('id_kelas')) : 0);
			
			$cek = $this->model_pendaftar->cek_kode_kelas($id_post, $val);
			// dump($cek);
			if ( $cek === FALSE ) 
			{
				$this->form_validation->set_message('_cek_edit_kode_kelas', 'Kode Kelas sudah ada');
			} 
			
			return $cek;
		}
		
		public function _cek_edit_nama_kelas($val = '') 
		{
			$id_post = ($this->input->post('id_kelas') ? decrypt_url($this->input->post('id_kelas')) : 0);
			$cek = $this->model_pendaftar->cek_nama_kelas($id_post, $val);
			
			if ( $cek === FALSE ) 
			{
				$this->form_validation->set_message('_cek_edit_nama_kelas', 'Nama Kelas sudah ada');
			} 
			
			return $cek;
		}
		
		public function _cek_edit_kode_tahun($val = '') 
		{
			$id_post = ($this->input->post('id_tahun') ? decrypt_url($this->input->post('id_tahun')) : 0);
			$cek = $this->model_pendaftar->cek_kode_tahun($id_post, $val);
			
			if ( $cek === FALSE ) 
			{
				$this->form_validation->set_message('_cek_edit_kode_tahun', 'Kode Tahun sudah ada');
			} 
			
			return $cek;
		}
		
		public function _cek_edit_nama_tahun($val = '') 
		{
			$id_post = ($this->input->post('id_tahun') ? decrypt_url($this->input->post('id_tahun')) : 0);
			$cek = $this->model_pendaftar->cek_nama_tahun($id_post, $val);
			
			if ( $cek === FALSE ) 
			{
				$this->form_validation->set_message('_cek_edit_nama_tahun', 'Nama Tahun sudah ada');
			} 
			
			return $cek;
		}
		
	}																														