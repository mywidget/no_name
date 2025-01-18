<?php
	
	if ( ! function_exists('quote'))
	{
		function quote($text){
			global $CI;
			return $CI->db->escape($text);
		}
	}
	if ( ! function_exists('query'))
	{
		/**
			* Code pengaturan
			*
			@param $val array
			@return string
		*/
		function query($val){
			global $CI;
			return $CI->db->query($val);
		}
	} 
	
	if ( ! function_exists('select_box'))
	{
		/**
			* Code select_box
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@param params array
			@return string
		*/
		function select_box($data, $parent = 0, $parent_id = 0, $Nilai='',$params = array())
		{
			$ci = & get_instance();
			
			if (isset($data[$parent]))
			{
				$id = $params['id'];
				$title = $params['title'];
				$html = "";
				
				if ($ci->session->level=='admin'){
					$html .= '<option value="0">Semua</option>';
				}
				foreach ($data[$parent] as $v)
				{
					$_arrNilai = explode(',', $Nilai);
					$_ck = (array_search($v->$id, $_arrNilai) === false)? '' : 'selected';
					$html .= '<option value="'.$v->$id.'" '.$_ck.'>&nbsp;'.$v->$title.'</option>';
				}
				return $html;
			}
		}
	}
	
	if ( ! function_exists('select_kbox'))
	{
		/**
			* Code select_kbox
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function select_kbox($data, $parent = 0, $parent_id = 0, $Nilai='')
		{
			$ci = & get_instance();
			if (isset($data[$parent]))
			{
				
				$html = "";
				foreach ($data[$parent] as $v)
				{
					$child = select_kbox($data, $v->id, $parent_id, $Nilai);
					$_arrNilai = explode(',', $Nilai);
					if ($ci->session->level=='admin'){
						$_ck = (array_search($v->id, $_arrNilai) === false)? '' : 'selected';
						$html .= '<option value="'.$v->id.'" '.$_ck.'>&nbsp;'.$v->title.'</option>';
						}else{
						if (in_array($v->id, $_arrNilai)){
							$_ck = (array_search($v->id, $_arrNilai) === false)? '' : 'selected';
							$html .= '<option value="'.$v->id.'" '.$_ck.'>&nbsp;'.$v->title.'</option>';
						}
					}
				}
				return $html;
			}
		}
	}
	
	if ( ! function_exists('select_badge'))
	{
		/**
			* Code select_badge
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function select_badge($data, $parent = 0, $parent_id = 0, $Nilai='')
		{
			$ci = & get_instance();
			if (isset($data[$parent]))
			{
				
				$html = "";
				foreach ($data[$parent] as $v)
				{
					$child = select_badge($data, $v->id, $parent_id, $Nilai);
					$_arrNilai = explode(',', $Nilai);
					if ($ci->session->level=='admin' AND $parent_id==0){
						$_ck = (array_search($v->id, $_arrNilai) === false)? '' : 'selected';
						$html .= '<option value="'.$v->id.'" '.$_ck.'>&nbsp;'.$v->title.'</option>';
						}else{
						if (in_array($v->id, $_arrNilai)){
							$html .= '<button type="button" class="btn btn-secondary btn-sm flat mb-1" readonly>'.$v->title.'</button>&nbsp;';
							$html .= '<input type="hidden" name="akses[]" value="'.$v->id.'">';
							
						}
					}
				}
				return $html;
			}
		}
	}
	if ( ! function_exists('checkbox_menu'))
	{
		/**
			* Code checkbox_menu
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function checkbox_menu($data, $parent = 0, $parent_id = 0, $Nilai = '')
		{
			static $i = 1;
			$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
			$tab = $i * 0;
			if (isset($data[$parent])) {
				$i++;
				$html = "";
				$a = 0;
				foreach ($data[$parent] as $v) {
					$child = checkbox_menu($data, $v['id_level'], $parent_id, $Nilai);
					
					$_arrNilai = explode(',', $Nilai);
					$_ck = (array_search($v['id_level'], $_arrNilai) === false) ? '' : TRUE;
					$array = array(
					'name'          => 'idlevel[]',
					'id'            => 'idlevel'.$v['id_level'],
					'value'         => $v['id_level'],
					'checked'       => $_ck,
					'class'         => 'custom-control-input checkbox get_value'
					);
					$attributes = array(
					'class' => 'custom-control-label',
					'style' => ''
					);
					$html .= '<div class="custom-control custom-checkbox">';
					$html .= $ieTab. form_checkbox($array);
					$html .= form_label($v['nama'], 'idlevel'.$v['id_level'], $attributes);;
					$html .= "</div>";
					if ($child) {
						$i--;
						$html .= $child;
					}
					$a++;
				}
				return $html;
			}
		}
	}
	
	
	if ( ! function_exists('checkcard'))
	{
		/**
			* Code checkcard
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function checkcard($data, $parent = 0, $parent_id = 0, $Nilai='')
		{
			static $i = 1;
			$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
			$tab = $i * 0 ;
			if (isset($data[$parent]))
			{
				$i++;
				$html ="";
				foreach ($data[$parent] as $v)
				{
					$child = checkcard($data, $v['idmenu'], $parent_id, $Nilai);
					
					$_arrNilai = explode(',', $Nilai);
					$_ck = (array_search($v['idmenu'], $_arrNilai) === false)? '' : TRUE;
					$array = array(
					'name'          => 'data[]',
					'id'            => 'data',
					'value'         => $v['idmenu'],
					'checked'       => $_ck,
					'style'         => ''
					);
					
					$html .= '<div class="checkbox">';
					$html .= $ieTab. form_checkbox($array).$v['nama_menu'];
					
					$html .= "</div>";
					if ($child) { $i--; $html .= $child; }
				}
				return $html;
			}
		}
	}
	if ( ! function_exists('checkbox'))
	{
		/**
			* Code checkbox
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function checkbox($data, $parent = 0, $parent_id = 0, $Nilai='',$_parent=0) {
			static $i = 1;
			$ieTab = str_repeat("- ", $i * 1);
			$tab = $i * 0 ;
			if (isset($data[$parent]))
			{
				$i++;
				$html ='';
				foreach ($data[$parent] as $v) {
					$child = checkbox($data, $v['idmenu'], $parent_id, $Nilai,$_parent);
					//Edit Di Item
					
					$_arrNilai = explode(',', $Nilai);
					if($_parent==1)
					{
						$_ck = (array_search($v['idmenu'], $_arrNilai) === false)? 'disabled' : TRUE;
					}
					else
					{
						$_ck = (array_search($v['idmenu'], $_arrNilai) === false)? '' : TRUE;
					}
					$array = array(
					'name'          => 'data[]',
					'id'            => 'checkb'.$v['idmenu'],
					'value'         => $v['idmenu'],
					'checked'       => $_ck,
					'class'         => 'form-check-input check-input'
					);
					$attributes = array(
					'class' => '',
					'style' => ''
					);
					$html .= '<div class="form-check">';
					$html .= form_checkbox($array);
					$html .= $ieTab. form_label($v['nama_menu'], 'checkb'.$v['idmenu'], $attributes);
					$html .= "</div>";
					if ($child) { $i--; $html .= $child; }
				}
				return $html;
			}
		}
	}
	
	if ( ! function_exists('checkbox_divisi'))
	{
		/**
			* Code checkbox
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function checkbox_divisi($data, $parent = 0, $parent_id = 0, $Nilai='',$_parent=0) {
			static $i = 1;
			$ieTab = str_repeat("- ", $i * 1);
			$tab = $i * 0 ;
			if (isset($data[$parent]))
			{
				$i++;
				$html ='';
				foreach ($data[$parent] as $v) {
					// print_r($v);
					$child = checkbox_divisi($data, $v['id'], $parent_id, $Nilai,$_parent);
					
					//Edit Di Item
					$_arrNilai = explode(',', $Nilai);
					if($_parent==1)
					{
						$_ck = (array_search($v['id'], $_arrNilai) === false)? 'disabled' : TRUE;
						$readonly = '';
					}
					else
					{
						$_ck = (array_search($v['id'], $_arrNilai) === false)? '' : TRUE;
						$readonly = '';
					}
					
					$array = array(
					'name'          => 'iddivisi[]',
					'id'            => 'checkb'.$v['id'],
					'value'         => $v['id'],
					'checked'       => $_ck,
					'class'         => 'form-check-input',
					'readonly' 		=> $readonly
					);
					$attributes = array(
					'class' => '',
					'style' => ''
					);
					$html .= '<div class="form-check">';
					$html .= form_checkbox($array);
					$html .= $ieTab. form_label($v['nama_divisi'], 'checkb'.$v['id'], $attributes);
					$html .= "</div>";
					if ($child) { $i--; $html .= $child; }
				}
				return $html;
			}
		}
	}
	  
	function getIpAddress()
	{
		$ipAddress = '';
		if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
			// to get shared ISP IP address
			$ipAddress = $_SERVER['HTTP_CLIENT_IP'];
			} else if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			// check for IPs passing through proxy servers
			// check if multiple IP addresses are set and take the first one
			$ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			foreach ($ipAddressList as $ip) {
				if (! empty($ip)) {
					// if you prefer, you can check for valid IP address here
					$ipAddress = $ip;
					break;
				}
			}
			} else if (! empty($_SERVER['HTTP_X_FORWARDED'])) {
			$ipAddress = $_SERVER['HTTP_X_FORWARDED'];
			} else if (! empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
			$ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
			} else if (! empty($_SERVER['HTTP_FORWARDED_FOR'])) {
			$ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
			} else if (! empty($_SERVER['HTTP_FORWARDED'])) {
			$ipAddress = $_SERVER['HTTP_FORWARDED'];
			} else if (! empty($_SERVER['REMOTE_ADDR'])) {
			$ipAddress = $_SERVER['REMOTE_ADDR'];
		}
		return $ipAddress;
	}
	if ( ! function_exists('template'))
	{
		/**
			* Code template
			*
			@param int
			@return string
		*/
		function template(){
			$ci = & get_instance();
			
			$query = $ci->model_app->view_where('themes',['id'=>$key,'pub'=>0]);
			if ($query->num_rows()>=1){
				
				if ($this->session->level==''){
					redirect(base_url().'adm');
					exit;
				}
				
				return $query->row()->folder;
				}else{
				if ($this->session->level==''){
					redirect(base_url().'adm');
					exit;
				}
			}
			
		}
	}
	
	function info($val){
		$ci = & get_instance();
		$query = $ci->model_app->view_where('rb_setting',['name'=>$val]);
		$row = '';
		if ($query->num_rows()>0)
		{
			$row = $query->row()->value;
		}
		return $row;
	}
	
	 
	function autoNumbers($awalan, $digit)
	{
		// Mendapatkan instance CodeIgniter
		$ci = & get_instance();
		
		// Mengambil ID terakhir dari tabel 'konsumen'
		$ci->db->select_max('id_member', 'max_id');
		$query = $ci->db->get('konsumen');
		
		if ($query->num_rows() > 0) {
			// Jika ada data, ambil ID terakhir
			$data = $query->row();
			$maxid = $data->max_id;
			
			// Menghitung panjang awalan
			$count_awalan = strlen($awalan);
			
			// Menghapus awalan dari ID terakhir
			$potong_awalan = str_replace($awalan, "", $maxid);
			$count_potong_awalan = strlen($potong_awalan);
			
			// Mendapatkan angka urut dan menambahkannya 1
			$noUrut = (int) substr($maxid, $count_awalan, $count_potong_awalan);
			$noUrut++;
			
			// Format ID baru dengan awalan dan jumlah digit yang sesuai
			$kode_baru = $awalan . sprintf('%0' . $digit . 'd', $noUrut);
			} else {
			// Jika tidak ada data sebelumnya, ID pertama akan dimulai dari 1
			$kode_baru = $awalan . sprintf('%0' . $digit . 'd', 1);
		}
		
		return $kode_baru;
	}
	function autoNumber($awalan, $digit, $id_table, $table)
	{
		// Mendapatkan instance CodeIgniter
		$ci = & get_instance();
		
		// Mengambil ID terakhir dari kolom tertentu dalam tabel
		$ci->db->select_max($id_table, 'max_id');
		$query = $ci->db->get($table);
		
		// Jika ada data di tabel, ambil ID terakhir
		if ($query->num_rows() > 0) {
			$data = $query->row();
			$maxid = $data->max_id;
			
			// Menghitung panjang awalan
			$count_awalan = strlen($awalan);
			
			// Menghapus awalan dari ID terakhir
			$potong_awalan = str_replace($awalan, "", $maxid);
			$count_potong_awalan = strlen($potong_awalan);
			
			// Mendapatkan angka urut dan menambahkannya 1
			$noUrut = (int) substr($maxid, $count_awalan, $count_potong_awalan);
			$noUrut++;
			} else {
			// Jika tidak ada data sebelumnya, ID pertama akan dimulai dari 1
			$noUrut = 1;
		}
		
		// Format ID baru dengan awalan dan jumlah digit yang sesuai
		return $awalan . sprintf('%0' . $digit . 'd', $noUrut);
	}
	
	
	function cek_info()
    {
        $ci = & get_instance();
        if ($ci->agent->is_browser())
        {
            $agent['browser'] = $ci->agent->browser().' '.$ci->agent->version();
		}
        elseif ($ci->agent->is_robot())
        {
            $agent['browser'] = $ci->agent->robot();
		}
        elseif ($ci->agent->is_mobile())
        {
            $agent['browser'] = $ci->agent->mobile();
		}
        else
        {
            $agent['browser'] = 'Unidentified User Agent';
		}
        $agent['ip'] = $ci->input->ip_address();
        $agent['os'] = $ci->agent->platform();
        
        return $agent;
	}				
	
	
	if ( ! function_exists('cek_device_status'))
	{
		/**
			* Code device 
			* 
			@param int 
			@return string
		*/
		function cek_device_status($token="")
		{
			$ci = & get_instance();
			
			$cek = $ci->model_app->pilih_where('device_status','rb_device',['token'=>$token]);
			if($cek->num_rows() > 0)
			{
				if($cek->row()->device_status=='connect')
				{
					return true; 
					}else{
					return false; 
				}
				}else{
				return false; 
			}
		}
	}
	
	if ( ! function_exists('get_device'))
	{
		/**
			* Code device 
			* 
			@param int 
			@return string
		*/
		function get_device()
		{
			$ci = & get_instance();
			$cek = $ci->model_app->pilih('device','rb_device');
			if($cek->num_rows() > 0)
			{
				return $cek->row()->device; 	
				}else{
				return false; 
			}
		}
	}		
	if ( ! function_exists('getMenu'))
	{
		/**
			* Code device 
			* 
			@param int 
			@return string
		*/
		function getMenu($val)
		{
			$ci = & get_instance();
			$cek = $ci->model_app->pilih_where('idmenu,idparent','menuadmin',['link'=>$val]);
			if($cek->num_rows() > 0)
			{
				$idparent = $cek->row()->idparent;
				
				if($idparent==0){
					$parent = $cek->row()->idmenu;
					}else{
					$parent = $idparent;
				}
				$row = $ci->model_app->pilih_where('nama_menu','menuadmin',['idmenu'=>$parent])->row();
				return $row->nama_menu; 	
				}else{
				return false; 
			}
		}
	}		
	if ( ! function_exists('getKelas'))
	{
		/**
			* Code device 
			* 
			@param int 
			@return string
		*/
		function getKelas($id)
		{
			$ci = & get_instance();
			$cek = $ci->model_app->pilih_where('kode_kelas,nama_kelas','rb_kelas',['id'=>$id]);
			if($cek->num_rows() > 0)
			{
				return $cek->row(); 	
				}else{
				return false; 
			}
		}
	}		
	
	if ( ! function_exists('getNamaKelas'))
	{
		/**
			* Code device 
			* 
			@param int 
			@return string
		*/
		function getNamaKelas($id)
		{
			$ci = & get_instance();
			$cek = $ci->model_app->pilih_where('nama_kelas','rb_kelas',['id'=>$id]);
			if($cek->num_rows() > 0)
			{
				return $cek->row()->nama_kelas; 	
				}else{
				return false; 
			}
		}
	}		
	
	if ( ! function_exists('getProvinsi'))
	{
		/**
			* Code getProvinsi 
			* 
			@param int 
			@return string
		*/
		function getProvinsi($id)
		{
			$ci = & get_instance();
			$cek = $ci->model_app->pilih_where('name','t_provinces',['id'=>$id]);
			if($cek->num_rows() > 0)
			{
				return $cek->row()->name; 	
				}else{
				return '-'; 
			}
		}
	}		
	if ( ! function_exists('getKabupaten'))
	{
		/**
			* Code getProvinsi 
			* 
			@param int 
			@return string
		*/
		function getKabupaten($id)
		{
			$ci = & get_instance();
			$cek = $ci->model_app->pilih_where('name','t_regencies',['id'=>$id]);
			if($cek->num_rows() > 0)
			{
				return $cek->row()->name; 	
				}else{
				return '-'; 
			}
		}
	}		
	if ( ! function_exists('getKecamatan'))
	{
		/**
			* Code getProvinsi 
			* 
			@param int 
			@return string
		*/
		function getKecamatan($id)
		{
			$ci = & get_instance();
			$cek = $ci->model_app->pilih_where('name','t_villages',['id'=>$id]);
			if($cek->num_rows() > 0)
			{
				return $cek->row()->name; 	
				}else{
				return '-'; 
			}
		}
	}		
	if ( ! function_exists('getKelurahan'))
	{
		/**
			* Code getProvinsi 
			* 
			@param int 
			@return string
		*/
		function getKelurahan($id)
		{
			$ci = & get_instance();
			$cek = $ci->model_app->pilih_where('name','t_districts',['id'=>$id]);
			if($cek->num_rows() > 0)
			{
				return $cek->row()->name; 	
				}else{
				return '-'; 
			}
		}
	}										
	
	function get_pesan_sukses($post)
	{
		$ci = & get_instance();
		$ci->db->select('kode_daftar,tahun_akademik,email,nama,jenis_kelamin,unit_sekolah,kelas,nomor_hp,tanggal_lahir');
		$ci->db->from('rb_psb_daftar');
		$ci->db->where('nik',$ci->session->nik);
		$query = $ci->db->get(); 
		
		if($query->num_rows() > 0){ 
			$row = $query->row();
			$searchVal =[
			"{kode_pendaftaran}",
			"{tahun_akademik}",
			"{email}",
			"{nama}",
			"{tanggal_lahir}",
			"{jenis_kelamin}",
			"{unit_sekolah}",
			"{kelas}",
			"{nomor_hp}",
			"{cek_status_pendaftaran}",
			];
			
			$replaceVal = [
			$row->kode_daftar,
			$row->tahun_akademik,
			$row->email,
			$row->nama,
			$row->tanggal_lahir,
			$row->jenis_kelamin,
			$row->unit_sekolah,
			getKelas($row->kelas)->nama_kelas,
			$row->nomor_hp,
			base_url('status'),
			];
			
			// Function to replace string
			$pesan = str_replace($searchVal, $replaceVal, $post);
			
			return $pesan;
		}
	}
