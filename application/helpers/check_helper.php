<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
	
	
	function tag_key($val)
	{
		$ci = & get_instance();
		$data = $ci->model_app->view_where('rb_setting',['name'=>$val])->row();
		return $data->value;
	}
	
	if ( ! function_exists('cek_id'))
	{
		/**
			* Code Cek user 
			* 
			@param int 
			@return array
		*/
		function cek_id($table,$id='')
		{
			$ci = & get_instance();
			if(empty(intval($id))){
				return false;
				exit;
			}
			$sql_cek = $ci->db->query("SELECT * FROM $table where id=$id");
			if($sql_cek->num_rows() >0)
			{
				return true;
				}else{
				return false;
			}
			
		}
	}
	
	if ( ! function_exists('Notifikasi'))
	{
		/**
			* Code Cek user 
			* 
			@param int 
			@return array
		*/
		function Notifikasi($divisi='')
		{
			if(empty($divisi)){
				$where = "where stat=9";
				}else{
				$where = "where id_divisi='$divisi' AND stat=9 AND status='N'";
			}
			$ci = & get_instance();
			$data = [];
			$sql_cek = $ci->db->query("SELECT * FROM cc_sppm $where");
			if($sql_cek->num_rows() >0)
			{
				$data[] = $sql_cek->result();
			}
			return $data;
		}
	}
	
	if ( ! function_exists('Notif'))
	{
		/**
			* Code Cek user 
			* 
			@param int 
			@return array
		*/
		function Notif()
		{
			
			$where = "where dibaca=0 AND status=1";
			$ci = & get_instance();
			$data = [];
			$sql_cek = $ci->db->query("SELECT * FROM pesan_masuk $where");
			if($sql_cek->num_rows() >0)
			{
				$data[] = $sql_cek->result();
			}
			return $data;
		}
	}
	
	if ( ! function_exists('cekUser'))
	{
		/**
			* Code Cek user 
			* 
			@param int 
			@return array
		*/
		function cekUser($val)
		{
			$ci = & get_instance();
			$sql_cek = $ci->db->query("SELECT * FROM tb_users where id_user='$val' AND aktif='Y'");
			if($sql_cek->num_rows() >0)
			{
				$rows=$sql_cek->row_array();
				$data = array(
				'status'=>1,
				'id'=>$rows['id_user'],
				'email'=>$rows['email'],
				'nohp'=>$rows['no_hp'],
				'nama'=>$rows['nama_lengkap'],
				'img'=>$rows['foto'],
				'idlv'=>$rows['idlevel'],
				'parent'=>$rows['parent'],
				'alamat'=>$rows['alamat'],
				'idmenu'=>$rows['idmenu'],
				'lv'=>$rows['id_level']);
				}else{
				$data = array('status'=>0,'email'=>'','nohp'=>'','id'=>0,'nama'=>'','img'=>'','idlv'=>'','parent'=>'','web'=>'','secret'=>'','alamat'=>'','percetakan'=>'','idmenu'=>'','lv'=>'');
			}
			return $data;
		}
	}
	
	if ( ! function_exists('cek_tabel'))
	{
		/**
			* Code Cek tabel 
			* 
			@param int 
			@return bolean
		*/
		function cek_tabel()
		{
			$ci = & get_instance();
			$tables = $ci->db->list_tables();
			if(empty($tables))
			{
				$ci->session->sess_destroy();
				redirect('error/401');
				exit;
			}
		}
		function ada_tabel(){
			$ci = & get_instance();
			$tables = $ci->db->list_tables();
			if(!empty($tables))
			{
				$ci->session->sess_destroy();
				redirect('error/401');
				exit;
			}
		}
	}
	
	if ( ! function_exists('cek_ip'))
	{
		/**
			* Code cek ip
			* 
			@param string 
			@return bolean
		*/
		function cek_ip($ip)
		{
			$ci = & get_instance();
			$query = $ci->db->query("SELECT ip FROM user_agent where ip='$ip'");
			
			if ($query->num_rows() <=0)
			{
				$ci->session->sess_destroy();
				redirect('error/401');
				exit;
			}
			
		}
	}
	
	
	if ( ! function_exists('is_admin'))
	{
		function is_admin(){
			$ci = & get_instance();
			$query = $ci->model_app->pilih('demo','info');
			$data = array();
			if ($query->num_rows() > 0){
				if($query->row()->demo=='Y' AND $ci->session->level=='admin' AND $ci->session->idparent==0){
					$data = ['status'=>true,'msg'=>'Saved admin'];
					}else{
					$data = ['status'=>false,'msg'=>'erro request'];
				}
				// $data = ['status'=>200,'msg'=>'Saved user'];
				}else{
				$data = ['status'=>false,'msg'=>'erro request'];
			}
			return $data;
		}
	}
	
	
	
	if ( ! function_exists('cek_crud_akses'))
	{
		/**
			* Code Cek Crud akses 
			* 
			@param int
			@param string
			@return string
		*/
		function cek_crud_akses($str,$tipe=''){
			$ci = & get_instance();
			$query = $ci->model_app->cek_crud($str);
			
			if ($query == FALSE){
				
				if($tipe=='json'){
					$data = ['status'=>false,'msg'=>'akses ditolak'];
					$ci->output
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
					exit;
					}elseif($tipe=='html'){
					echo '<div class="card-body"><div class="alert alert-danger" role="alert">
					Akses dibatasi, Hubungi Admin
					</div></div>';
					exit;
					}else{
					redirect('error/cruds');
					exit;
					
				}
			}
		}
	}
	
	if ( ! function_exists('cek_type_akses'))
	{
		function cek_type_akses($idakses,$iduser,$id,$mod){
			$ci = & get_instance();
			$query = $ci->model_app->cek_akses($idakses,$iduser);
			$total_order = $ci->model_app->sum_data('total_bayar','invoice',['id_invoice'=>$id]);
			$total_bayar = $ci->model_app->sum_data('jml_bayar','bayar_invoice_detail',['id_invoice'=>$id]);
			$data = array();
			if ($query->num_rows()>0){
				$data = ['status'=>200,'id'=>$id,'mod'=>$mod,'total_order'=>$total_order,'total_bayar'=>$total_bayar,'msg'=>'akses ok'];
				}else{
				$data = ['status'=>401,'msg'=>'akses ditolak'];
			}
			
			$ci->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
			exit;
		}
	}
	
	if ( ! function_exists('cek_menu_akses'))
	{
		function cek_menu_akses(){
			$ci = & get_instance();
			$session = $ci->session->iduser;
			$link_menu = $ci->uri->uri_string();
			
			// echo  $session;
			if(isset($session)){
				$menu = $ci->db->query("SELECT * FROM menuadmin WHERE link='$link_menu' AND aktif='Y'")->row_array();
				$user = $ci->db->query("SELECT * FROM tb_users WHERE id_user='$session' AND aktif='Y'")->row_array();
				$people = explode(",",$user['idmenu']);
				if (!in_array($menu['idmenu'], $people)){
					redirect(base_url().'error/crud');
				}
				}else{
				redirect(base_url());
			}
		}
	}	
	
	if ( ! function_exists('cek_session_login'))
	{
		function cek_session_login($params=0){
			$ci = & get_instance();
			$session = $ci->session->level;
			if($params==0)
			{
				if (!isset($session))
				{
					$data = ['status'=>401,'msg'=>'Login required'];
					$ci->output
					->set_status_header(401)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
					exit;
				}
				
			}
			elseif($params==1)
			{
				if (!isset($session)){
					redirect('error/401');
				}
				}else{
				if (!isset($session)){
					redirect('error/401');
				}
			}
		}
	}
	
	
	if ( ! function_exists('cekSessiLogin'))
	{
		function cekSessiLogin(){
			$ci = & get_instance();
			$ip = gethostbyname(trim(exec("hostname")));
			$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$session = $ci->session->userdata('iduser');
			$ids = $ci->session->userdata('ids');
			$rses = $ci->db->query("SELECT sesi_login FROM tb_users where id_user='$session'")->row_array();
			if ($rses['sesi_login'] != $ids) {
				session_destroy();
				echo 'logout';
			}
			if ($ci->session->level==''){
				echo 'logout';
				exit;
			} 
		}	
	}				
	
	if ( ! function_exists('cek_session_admin'))
	{
		function cek_session_admin($params='')
		{
			$ci = & get_instance();
			$session = $ci->session->userdata('level');
			if($params==0)
			{
				echo json_encode(['status'=>'error_hapus_admin','msg'=>'Admin tidak boleh dihapus']);exit;
			}
			elseif($params==1)
			{
				if ($session != 'admin')
				{
					redirect('error/401');
				}
				}else{
				if ($session != 'admin')
				{
					redirect('error/401');
				}
			}
		}
	}			
	
	if ( ! function_exists('cek_input_akses'))
	{
		
		/**
			@param array
			ex : array('metode'=>'GET',
			'idakses'=>1,
			'iduser'=>1,
			'value'=>'Simpan',
			'id'=>1,
			'mod'=>'edit',
			'tipe'=>'json',
			'redir'=>'home'
			); 
			*
			$params['idakses'] : int | 1 - 10
			$params['iduser']  : int | 1 etc
			$params['id']      : int | 1 etc
			$params['metode']  : string | GET/POST 
			$params['value']   : string | simpan/edit/hapus
			$params['mod']     : string | edit
			$params['tipe']    : string | json/none
			$params['redir']   : string | home
			
		*/
		
		
		function cek_input_akses($params=array())
		{
			
			$ci = & get_instance();
			
			//cek request GET/POST
			if ($ci->input->server('REQUEST_METHOD') === $params['metode']) 
			{
				exit('BAD_REQUEST');
			}
			//cek sesi login
			$session = $ci->session->level;
			if (!isset($session))
			{
				//jika tipe json jalankan
				if($params['tipe']=='json'){
					$data = ['status'=>401,'msg'=>'Login required'];
					$ci->output
					->set_content_type('application/json')
					->set_output(json_encode($data));
					exit;
					}else{
					redirect(base_url($params['redir']));
				}
			}
			//cek status demo jika aktif = Y jalankan jika aktif = N skip
			$cek = cek_demo();
			if($cek['status'] ==200)
			{
				//$params['value'] : string
				$data = array('status'=>200,'msg'=>'Data berhasil '.$params['value'].' (demo)');
				$ci->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
				exit;
			}
			
			$total_order =0;
			$total_bayar =0;
			//$params['id'] : int
			if($params['id'] >0 ){
				$total_order = $ci->model_app->sum_data('total_bayar','invoice',['id_invoice'=>$params['id']]);
				$total_bayar = $ci->model_app->sum_data('jml_bayar','bayar_invoice_detail',['id_invoice'=>$params['id']]);
			}
			$data = array();
			
			/*
				cek type akses jika ada skip
				*
				$params['id']     : int
				$params['iduser'] : int
				$params['iduser'] : int
				$params['mod']    : string
				*
			*/
			$query = $ci->model_app->cek_akses($params['idakses'],$params['iduser']);
			if ($query->num_rows()>0){
				$data = ['status'=>200,'id'=>$params['id'],'mod'=>$params['mod'],'total_order'=>$total_order,'total_bayar'=>$total_bayar,'msg'=>'akses ok'];
				}else{
				$data = ['status'=>403,'msg'=>'akses ditolak'];
			}
			//output typ json
			$ci->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
			exit;
		}
		
	}
	
	function cek_input_post($method='')
	{
		$ci = & get_instance();
		if ($ci->input->server('REQUEST_METHOD') === $method) {
			$data = ['status'=>400,'msg'=>'Bad Request'];
			$ci->output
			->set_status_header(400)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
			exit;
		}
	}	
	
	if ( ! function_exists('get_unit'))
	{
		/**
			* Code cek_desain
			*
			@param $id int
			@return id
		*/
		function get_unit($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('nama_jurusan','rb_unit',['id'=>$id]);
			$data = '-';
			if ($query->num_rows() >0)
			{
				$data = $query->row()->nama_jurusan;
			}
			return $data;
		}
	}
	
	if ( ! function_exists('get_sub'))
	{
		/**
			* Code cek_desain
			*
			@param $id int
			@return id
		*/
		function get_sub($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('title,aksi','sub_materiel',['id_master'=>$id]);
			$data = [];
			if ($query->num_rows() >0)
			{
				$data = $query->row();
			}
			return $data;
		}
	}
	if ( ! function_exists('parent_barang'))
	{
		/**
			* Code cek_desain
			*
			@param $id int
			@return id
		*/
		function parent_barang($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('id,parent,nama_barang,tag,kategori,linked','cc_master',['id'=>$id]);
			$data = ['parent'=>0,'title'=>'-','tag'=>'-','kategori'=>0,'linked'=>'N'];
			if ($query->num_rows() >0)
			{
				
				$data = $query->row();
				
			}
			return $data;
		}
	}
	if ( ! function_exists('parent_tag'))
	{
		/**
			* Code parent_tag
			*
			@param $tag string
			@return array
		*/
		function parent_tag($tag)
		{
			$ci = & get_instance();
			$tag = strtolower($tag);
			$query = $ci->model_app->pilih_where('id,parent,nama_barang,tag','cc_master',['parent'=>0,'tag'=>$tag]);
			$data = ['id'=>0,'parent'=>0,'nama_barang'=>'-'];
			if ($query->num_rows() >0)
			{
				$data = $query->row();
			}
			return $data;
		}
	}
	
	if ( ! function_exists('kategori'))
	{
		/**
			* Code cek_desain
			*
			@param $id int
			@return id
		*/
		function kategori($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('title,tag,id_sub','kategori',['id'=>$id]);
			$row = ['title'=>'-','tag'=>'-','id_sub'=>0];
			if ($query->num_rows()>0)
			{
				$row = ['title'=>$query->row()->title,'tag'=>$query->row()->tag,'id_sub'=>$query->row()->id_sub];
				
			}
			return $row;
		}
	}	
	if ( ! function_exists('kategori_tag'))
	{
		/**
			* Code cek_desain
			*
			@param $id int
			@return id
		*/
		function kategori_tag($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('title','kategori_tag',['id'=>$id]);
			$row = ['title'=>'-'];
			if ($query->num_rows()>0)
			{
				$row = ['title'=>$query->row()->title];
				
			}
			return $row;
		}
	}
	
	if ( ! function_exists('form_data'))
	{
		/**
			* Code cek_desain
			*
			@param $id int
			@return id
		*/
		function form_data($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('kategori','form_penggunaan',['id'=>$id]);
			$row = ['title'=>'-'];
			if ($query->num_rows()>0)
			{
				$row = ['title'=>$query->row()->kategori];
				
			}
			return $row;
		}
	}
	if ( ! function_exists('by_username'))
	{
		/**
			* Code cek_desain
			*
			@param $id int
			@return id
		*/
		function by_username($by)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('nama_lengkap','tb_users',['email'=>$by]);
			$row = ['title'=>'-'];
			if ($query->num_rows()>0)
			{
				$row = ['title'=>$query->row()->nama_lengkap];
				
			}
			return $row;
		}
	}
