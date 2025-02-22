<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class User extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			cek_session_login(1);
			$this->title = tag_key('site_title');
			$this->iduser = $this->session->iduser; 
            $this->level = $this->session->level; 
            $this->idlevel = $this->session->idlevel; 
			$this->perPage = 10;
		}
		
		public function index()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Data pengguna | '.$this->title;
			
            $cekUser = cekUser($this->iduser);
			
			
            $data['lv'] = $cekUser['lv'];
            $data['id_level'] = $cekUser['idlv'];
            $data['idmenu'] = $cekUser['idmenu'];
            // Get record count 
			if($this->level=='admin'){
				$conditions['where'] = array(
				'parent !=' => 0,
				'hapus' => 0
				);
				}else{
				$conditions['where'] = array(
				'parent' => $this->iduser,
				'hapus' => 0
				);
			}
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getPengguna($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('user/ajaxPengguna');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchPengguna';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions = array(
            'limit' => $this->perPage
            );
            $cekUser = cekUser($this->iduser);
            $data['lv'] = $cekUser['lv'];
            $data['id_level'] = $cekUser['idlv'];
            $data['idmenu'] = $cekUser['idmenu'];
            // Get record count 
            if($this->level=='admin'){
				$conditions['where'] = array(
				'parent !=' => 0,
				'hapus' => 0
				);
				}else{
				$conditions['where'] = array(
				'parent' => $this->iduser,
				'hapus' => 0
				);
			}
			$data['kategori'] = $this->model_app->view('type_akses')->result();
            $data['record'] = $this->model_data->getPengguna($conditions);
			$this->thm->load('backend/template','backend/user/pengguna',$data);
		}
		
        function ajaxPengguna()
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
            $sortBy = $this->input->post('sortBy');
            if (!empty($sortBy)) {
                $conditions['search']['sortBy'] = $sortBy;
			}
			if($this->level=='admin'){
				$conditions['where'] = array(
				'parent !=' => 0,
				'hapus' => 0
				);
				}else{
				$conditions['where'] = array(
				'parent' => $this->iduser,
				'hapus' => 0
				);
			}
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getPengguna($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('user/ajaxPengguna');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchPengguna';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
            
			if($this->level=='admin'){
				$conditions['where'] = array(
				'parent !=' => 0,
				'hapus' => 0
				);
				}else{
				$conditions['where'] = array(
				'parent' => $this->iduser,
				'hapus' => 0
				);
			}
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_data->getPengguna($conditions);
			
            // Load the data list view 
			$this->load->view('backend/user/ajax-pengguna',$data);
			
		}
		public function add_user(){
			cek_input_post('GET');
			$tipe = $this->db->escape_str($this->input->post('tipe'));
			$where = array('kunci' => 0);
			$data['tipe'] = $tipe;
			$data['kategori'] = $this->model_app->view_where('type_akses',['pub'=>0])->result();
			$this->load->view('backend/user/form_add',$data);
		}
		function edit_user(){
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('CONTENT');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				$data['kategori'] = $this->model_app->view_where('type_akses',['pub'=>0])->result();
				$data['arr'] = $this->model_app->edit('tb_users', ['id_user'=>$index])->row();
				$data['hak_akses'] = $this->model_app->view_where('hak_akses',['publish'=>'Y'])->result();
				$this->load->view('backend/user/form_edit', $data, false);
			}
		}
		
		public function tag()
		{
			$res = $this->db->query("SELECT type_akses FROM `tb_users`");
			$TampungData = array();
			foreach($res->result_array() AS $data_tags){
				$tags = explode(',',strtolower(trim($data_tags['type_akses'])));
				if(empty($data_tags['type_akses'])){echo'';}else{
					foreach($tags as $val) {
						$TampungData[] = $val;
					}
				}
			}
			$totalTags = count($TampungData);
			$jumlah_tag = array_count_values($TampungData);
			ksort($jumlah_tag);
			if ($totalTags > 0) {
				$output = array();
				foreach($jumlah_tag as $key=>$val) {
					$output[] = array("id"=>$key,"name"=>$key);
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($output));
			
		}
		
		public function cari_tag(){
			$id  = $this->input->post('id',TRUE);
			$tag = $this->input->post('tag',TRUE);
			$exp = explode(",",$tag);
			foreach ($exp as  $row)
			{
				$data[] = array("id"=>$row,"name"=>$row);
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		function simpan_pengguna(){
			cek_input_post('GET');
			cek_crud_akses('UPDATE');
			$type = $this->input->post('type',TRUE);
			$id_level = $this->input->post('id_level',TRUE);
			$query = $this->db->get_where('hak_akses',['id_level'=>$id_level]);
			$row = $query->row_array();
			if($type=='new'){
				$akses ='';
				if(!empty($this->input->post('cat',TRUE))){
					$akses	= $this->input->post('cat',TRUE);
					$akses	= implode(',',$akses);
				}
				$data ='';
				if(!empty($this->input->post('data',TRUE))){
					$data_cat	= $this->input->post('data',TRUE);
					$data		= implode(',',$data_cat);
				}
				$query = $this->model_app->view_where('tb_users',['email'=>$this->input->post('mail',TRUE)]);
				if($query->num_rows() > 0){
					$arr = [
					'status'=>201,
					'title' =>'Input data',
					'msg'   =>'Data sudah ada'
					];
					}else{
					if($this->level=='admin'){
						$idlevel = '1,2,3,4,5';
						}elseif($this->level=='panitia'){
						$idlevel = '1,2,3';
						}elseif($this->level=='user'){
						$idlevel = '1,2,3';
						}elseif($this->level=='editor'){
						$idlevel = '1,2,3';
						}else{
						$idlevel = '1,2';
					}
					$data_divisi = '';
					
					if(!empty($this->input->post('iddivisi',TRUE))){
						$iddivisi	= $this->input->post('iddivisi',TRUE);
						if($id_level > 1){
							$data_divisi = implode(',',$iddivisi);
							}else{
							$data_divisi = implode(',',$iddivisi);
						}
						
					}
					if($this->input->post('password',TRUE))
					{
						$password = password_hash($this->input->post('password',TRUE), PASSWORD_DEFAULT);
						$data_post 	= [
						"nama_lengkap"	=> $this->input->post('title',TRUE),
						"nama_lembaga"	=> $this->input->post('nama_lembaga',TRUE),
						"password"	    => $password,
						"alamat"	    => $this->input->post('alamat',TRUE),
						"email"	        => $this->input->post('mail',TRUE),
						"no_hp"	        => $this->input->post('phone',TRUE),
						"tgl_daftar"	=> $this->input->post('daftar',TRUE),
						"aktif"	        => $this->input->post('aktif',TRUE),
						"level"	    	=> $row['level'],
						"parent"	    => $this->iduser,
						"idlevel"	    => $this->input->post('id_level',TRUE),
						"id_level"	    => $this->input->post('id_level',TRUE),
						"id_divisi"	    => $data_divisi,
						"idmenu"	    => $data,
						"pangkat"	    => $this->input->post('pangkat',TRUE),
						"jabatan"	    => $this->input->post('jabatan',TRUE),
						"nrp"	    	=> $this->input->post('nrp',TRUE),
						"lock_menu"	    => $this->input->post('lock',TRUE),
						"type_akses"	=> $akses
						];
					}
					else
					{
						$data_post 	= [
						"nama_lengkap"	=> $this->input->post('title',TRUE),
						"nama_lembaga"	=> $this->input->post('nama_lembaga',TRUE),
						"alamat"	    => $this->input->post('alamat',TRUE),
						"email"	        => $this->input->post('mail',TRUE),
						"no_hp"	        => $this->input->post('phone',TRUE),
						"tgl_daftar"	=> $this->input->post('daftar',TRUE),
						"aktif"	        => $this->input->post('aktif',TRUE),
						"level"	    	=> $row['level'],
						"idlevel"	    => $this->input->post('id_level',TRUE),
						"id_divisi"	    => $data_divisi,
						"parent"	    => $this->iduser,
						"id_level"	    => $this->input->post('id_level',TRUE),
						"idmenu"	    => $data,
						"pangkat"	    => $this->input->post('pangkat',TRUE),
						"jabatan"	    => $this->input->post('jabatan',TRUE),
						"nrp"	    	=> $this->input->post('nrp',TRUE),
						"lock_menu"	    => $this->input->post('lock',TRUE),
						"type_akses"	=> $akses
						];
					}
					$insert = $this->model_app->input('tb_users',$data_post);
					if($insert['status']=='ok')
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
				}
			}
			
			if($type=='edit'){
				$postid 	= decrypt_url($this->input->post('id',TRUE));
				$mail 	= $this->input->post('mail',TRUE);
				$data ='';
				$data_divisi ='';
				$query = $this->db->get_where('hak_akses',['id_level'=>$this->input->post('id_level',TRUE)]);
				$row = $query->row_array();
				$akses ='';
				if(!empty($this->input->post('cat',TRUE))){
					$akses	= $this->input->post('cat',TRUE);
					$akses	= implode(',',$akses);
				}
				if(!empty($this->input->post('data',TRUE))){
					$data_cat	= $this->input->post('data',TRUE);
					$data		= implode(',',$data_cat);
				}
				
				if(!empty($this->input->post('iddivisi',TRUE))){
					$iddivisi	= $this->input->post('iddivisi',TRUE);
					if($id_level > 1){
						$data_divisi = implode(',',$iddivisi);
						}else{
						$data_divisi = implode(',',$iddivisi);
					}
					
				}
				
				// dump($data_divisi,'print_r','exit');
				$this->cek_user($type,$mail,$postid);
				if($this->input->post('password',TRUE))
				{
					$password = password_hash($this->input->post('password',TRUE), PASSWORD_DEFAULT);
					$data_post 	= [
					"nama_lengkap"	=> $this->input->post('title',TRUE),
					"nama_lembaga"	=> $this->input->post('nama_lembaga',TRUE),
					"password"	    => $password,
					"alamat"	    => $this->input->post('alamat',TRUE),
					"email"	        => $this->input->post('mail',TRUE),
					"no_hp"	        => $this->input->post('phone',TRUE),
					"tgl_daftar"	=> $this->input->post('daftar',TRUE),
					"aktif"	        => $this->input->post('aktif',TRUE),
					"level"	    	=> $row['level'],
					"idlevel"	    => $this->input->post('id_level',TRUE),
					"id_level"	    => $this->input->post('id_level',TRUE),
					"idmenu"	    => $data,
					"id_divisi"	    => $data_divisi,
					"pangkat"	    => $this->input->post('pangkat',TRUE),
					"jabatan"	    => $this->input->post('jabatan',TRUE),
					"nrp"	    	=> $this->input->post('nrp',TRUE),
					"lock_menu"	    => $this->input->post('lock',TRUE),
					"type_akses"	=> $akses
					];
				}
				else
				{
					$data_post 	= [
					"nama_lengkap"	=> $this->input->post('title',TRUE),
					"nama_lembaga"	=> $this->input->post('nama_lembaga',TRUE),
					"alamat"	    => $this->input->post('alamat',TRUE),
					"email"	        => $this->input->post('mail',TRUE),
					"no_hp"	        => $this->input->post('phone',TRUE),
					"tgl_daftar"	=> $this->input->post('daftar',TRUE),
					"aktif"	        => $this->input->post('aktif',TRUE),
					"level"	    	=> $row['level'],
					"idlevel"	    => $this->input->post('id_level',TRUE),
					"id_level"	    => $this->input->post('id_level',TRUE),
					"idmenu"	    => $data,
					"id_divisi"	    => $data_divisi,
					"pangkat"	    => $this->input->post('pangkat',TRUE),
					"jabatan"	    => $this->input->post('jabatan',TRUE),
					"nrp"	    	=> $this->input->post('nrp',TRUE),
					"lock_menu"	    => $this->input->post('lock',TRUE),
					"type_akses"	=> $akses
					];
				}
				
				$update = $this->model_app->update('tb_users',$data_post, ['id_user'=>$postid]);
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
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		
		private function cek_user($type,$email,$id){
			if($type=='add'){
				$where = array('email'=>$email);
				$search = $this->model_app->edit('tb_users', $where);
				}elseif($type=='edit'){
				$where = array('email'=>$email,'id_user !='=> $id);
				$search = $this->model_app->edit('tb_users', $where);
			}
			
			if($search->num_rows()>0){
				$data = array('status'=>500,'title' =>'Alert !!!','msg'=>'Username sudah ada');
				$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
				exit;
			}
		}
		
		public function delete_user()
		{
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id = decrypt_url($this->input->post('id',TRUE));
			$cek_posting = cek_posting($id);
			if($cek_posting===false){
				$cek = $this->model_app->view_where('tb_users', ['id_user'=>$id]);
				if($cek->num_rows() > 0)
				{
					$row = $cek->row();
					if($row->level!='admin'){
						$delete = $this->model_app->hapus('tb_users', ['id_user'=>$id]);
						if($delete['status']=='ok')
						{
							$arr = ['status'=>'ok','id'=>$cek_posting];
							}else{
							$arr = ['status'=>'error'];
						}
						}else{
						$arr = ['status'=>'error_delete','id'=>$cek_posting];
					}
					}else{
					$arr = ['status'=>'error'];
				}
				
				}else{
				$arr = ['status'=>'error_delete','id'=>$cek_posting];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		
		public function profil()
		{
			cek_crud_akses('EDIT');
			
			$id = $this->uri->segment(3);
			
			$data['title'] = 'Edit Data | ' .$this->title;
			$data['judul'] = 'Edit profile pengguna';
			
			$data['kategori'] = $this->model_app->view_where('type_akses',['pub'=>0])->result();
			if(!empty($id)){
				$cek = $this->model_app->edit('tb_users', array('sesi_login' => decrypt_url($id)));
				if($cek->num_rows() > 0){
					$data['rows'] = $cek->row_array();
					
					if($data['rows']['lock_menu']==1 AND $this->level!='admin'){
						$this->thm->load('backend/template','backend/user/edit_profil_lock',$data);
						}else{
						$this->thm->load('backend/template','backend/user/edit_profil',$data);
					}
					}else{
					redirect('user/');
				}
				}else{
				cek_menu_akses();
				$id = $this->session->iduser;
				$cek = $this->model_app->edit('tb_users', array('id_user' => $id));
				if($cek->num_rows() > 0){
					$data['rows'] = $cek->row_array();
					if($data['rows']['lock_menu']==1 AND $this->level!='admin'){
						$this->thm->load('backend/template','backend/user/edit_profil_lock',$data);
						}else{
						$this->thm->load('backend/template','backend/user/edit_profil',$data);
					}
					}else{
					redirect('user/');
				}
			}
			
		}
		
		function save_profil($name = NULL, $value = NULL){
			cek_crud_akses('UPDATE');
			 
			foreach ($this->input->post() as $key => $val)
			{
				if($key !='data' AND $key!='akses'){
					$name .= $key.',';
					$value .= $val.',';
				}
			}
			 
			$lock = $this->input->post('lock');
			$input_name = explode(',', $name);
			$input_value = explode(',', $value);
			
			if(decrypt_url($input_name[0])=='id' AND $lock==0)
			{
				if(!empty($this->input->post('akses',TRUE))){
					$akses	= $this->input->post('akses',TRUE);
					$akses	= implode(',',$akses);
				}
				
				$encrypt_id = $input_value[0];
				$decrypt_id = decrypt_url($encrypt_id);
				$data_cat = $this->input->post('data');
				$input_data=implode(',',$data_cat);
			 
				$level = $this->input->post('level');
				$level=explode(',',$level);
				if($this->input->post('password') ==''){
					$_data = array('idmenu'=>$input_data,
					'nama_lengkap'=>$this->db->escape_str($this->input->post('nama')),
					'nama_lembaga'=>$this->db->escape_str($this->input->post('nama_lembaga')),
					'id_level'=>$level[0],
					'level'=>$level[1],
					'type_akses'=>$akses,
					"pangkat"	    => $this->input->post('pangkat',TRUE),
					"jabatan"	    => $this->input->post('jabatan',TRUE),
					"nrp"	    	=> $this->input->post('nrp',TRUE),
					'aktif'=>$this->input->post('aktif'));
					}else{
					$_data = array('idmenu'=>$input_data,
					'nama_lengkap'=>$this->db->escape_str($this->input->post('nama')),
					'nama_lembaga'=>$this->db->escape_str($this->input->post('nama_lembaga')),
					'password'=>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'id_level'=>$level[0],
					'level'=>$level[1],
					'type_akses'=>$akses,
					"pangkat"	    => $this->input->post('pangkat',TRUE),
					"jabatan"	    => $this->input->post('jabatan',TRUE),
					"nrp"	    	=> $this->input->post('nrp',TRUE),
					'aktif'=>$this->input->post('aktif'));
				}
				$where = array('sesi_login' => $decrypt_id);
				$res= $this->model_app->update('tb_users', $_data, $where);
				if($res['status']=='ok'){
					$this->session->set_flashdata('message', "<script>showNotif('bottom-right','Simpan Data','Berhasil','success')</script>");
					redirect('user/profil/'.$encrypt_id);
					}else{
					$this->session->set_flashdata('message', "<script>showNotif('bottom-right','Simpan Data',Gagal','warning')</script>");
					redirect('user/profil/'.$encrypt_id);
				}
				exit;
				}elseif(decrypt_url($input_name[0])=='id' AND $lock==1){
				if($this->input->post('password') ==''){
					$data = array( 
					'nama_lengkap'=>$this->db->escape_str($this->input->post('nama')),
					'nama_lembaga'=>$this->db->escape_str($this->input->post('nama_lembaga')),
					"pangkat"	    => $this->input->post('pangkat',TRUE),
					"jabatan"	    => $this->input->post('jabatan',TRUE),
					"nrp"	    	=> $this->input->post('nrp',TRUE));
					}else{
					$data = array(
					'nama_lengkap'=>$this->db->escape_str($this->input->post('nama')),
					'nama_lembaga'=>$this->db->escape_str($this->input->post('nama_lembaga')),
					'password'=>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					"pangkat"	    => $this->input->post('pangkat',TRUE),
					"jabatan"	    => $this->input->post('jabatan',TRUE),
					"nrp"	    	=> $this->input->post('nrp',TRUE));
				}
				$where = array('sesi_login' => $decrypt_id);
				$res= $this->model_app->update('tb_users', $data, $where);
				if($res['status']=='ok'){
					$this->session->set_flashdata('message', "<script>showNotif('bottom-right','Simpan Data','Berhasil','success')</script>");
					redirect('user/profil/'.$encrypt_id);
					}else{
					$this->session->set_flashdata('message', "<script>showNotif('bottom-right','Simpan Data',Gagal','warning')</script>");
					redirect('user/profil/'.$encrypt_id);
				}
				}else{
				redirect('admin/');
			}
		}
		function hapus_user(){
			cek_input_post('GET');
			
			$id = $this->db->escape_str($this->input->post('id'));
			$where = array('id_user' => $id);
			
			$search = $this->model_app->edit('tb_users', $where);
			if($search->num_rows()>0){
				$row = $search->row_array();
				if($row['level']=='admin' AND $row['parent']==0){
					$data = array('status'=>'error_hapus_admin','msg'=>'Admin tidak boleh dihapus');
					}else{
					$res = $this->model_app->update('tb_users',['hapus'=>1],$where);
					if($res==true){
						$data = array('status'=>200,'title'=>'Hapus data','msg'=>'Data berhasil dihapus');
						}else{
						$data = array('status'=>400,'title'=>'Hapus data','msg'=>'Data gagal dihapus');
					}
				}
				}else{
				$data = array('status'=>500,'msg'=>'Data gagal dihapus');
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
	}																																																																														