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
	
	if ( ! function_exists('akses_divisi'))
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
		function akses_divisi($data, $parent = 0, $parent_id = 0, $Nilai='',$_parent=0) {
			static $i = 1;
			$ieTab = str_repeat("- ", $i * 1);
			$tab = $i * 0 ;
			if (isset($data[$parent]))
			{
				$i++;
				$html ='';
				$no =1;
				foreach ($data[$parent] as $v) {
					$child = akses_divisi($data, $v['id'], $parent_id, $Nilai,$_parent);
					//Edit Di Item
					
					$_arrNilai = explode(',', $Nilai);
					if($_parent==1)
					{
						$_ck = (array_search($v['id'], $_arrNilai) === false)? 'disabled' : TRUE;
					}
					else
					{
						$_ck = (array_search($v['id'], $_arrNilai) === false)? '' : TRUE;
					}
					
					$html .= '<tr>';
					$html .= '<td>'.$no++.'</td>';
					$html .= '<td>'.$v['nama_divisi'].'</td>';
					$html .= '<td class="text-end">
					
					<a href="'.base_url().'mutasi/stok_satker/detail/'.encrypt_url($v['id']).'" class="btn btn-primary btn-sm active" aria-current="page"><i class="ti ti-list-details"></i> Detail</a>
					</td>';
					$html .= "</tr>";
					if ($child) { $i--; $html .= $child; }
				}
				return $html;
			}
		}
	}
	
	if ( ! function_exists('web_analytics'))
	{
		function web_analytics() 
		{
			$ci = & get_instance();
			$ci->load->library('user_agent');
			$id_user = $ci->session->iduser;
			$myip 		   = "https://ipinfo.io/".getIpAddress()."?token=29aeaf464d83ec";
			$ipinfo        = json_decode(@file_get_contents($myip));
			$ipvi          = (!empty($ipinfo->ip) ? $ipinfo->ip : $ci->input->ip_address());
			$country       = (!empty($ipinfo->country) ? $ipinfo->country : "Others");
			$city          = (!empty($ipinfo->city) ? $ipinfo->city : "Others");
			$os_stat       = $ci->input->user_agent();
			$platform_stat = $ci->agent->platform();
			$browser_stat  = $ci->agent->browser();
			$datestat      = date("Y-m-d");
			$timestat      = time();
			$url           = $_SERVER['REQUEST_URI'];
			
			$totalvi = $ci->db
			->where('ip', $ipvi)
			->where('date', $datestat)
			->where('url', $url)
			->where('id_user', $id_user)
			->get('t_visitor')
			->num_rows();
			
			if ( $totalvi < 1 ) 
			{
				$ci->db->insert('t_visitor', array(
				'id_user'  => $id_user,
				'ip'       => $ipvi,
				'platform' => $platform_stat,
				'os'       => $os_stat,
				'browser'  => $browser_stat,
				'country'  => $country,
				'city'     => $city,
				'date'     => $datestat,
				'hits'     => 1,
				'url'      => $url 
				));
			}
			else 
			{
				$statpro = $ci->db
				->where('ip', $ipvi)
				->where('date', $datestat)
				->where('url', $url)
				->get('t_visitor')
				->row_array();
				
				$hitspro = $statpro['hits'] + 1;
				
				$data_update = array(
				'platform' => $platform_stat,
				'os'       => $os_stat,
				'browser'  => $browser_stat,
				'country'  => $country,
				'city'     => $city,
				'hits'     => $hitspro,
				'online'   => $timestat,
				'url'      => $url
				);
				
				$ci->db->where('ip', $ipvi)
				->where('date', $datestat)
				->where('url', $url)
				->update('t_visitor', $data_update);
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
	
	
	if ( ! function_exists('logo'))
	{
		/**
			* Code logo
			*
			@return string
		*/
		function logo(){
			$ci = & get_instance();
			return $ci->model_app->pilih('logo','info')->row()->logo;
		}
	}
	
	if ( ! function_exists('favicon'))
	{
		/**
			* Code favicon
			*
			@return string
		*/
		function favicon(){
			$ci = & get_instance();
			return $ci->model_app->pilih('favicon','info')->row()->favicon;
		}
	}
	
	function autoNumbers($awalan,$digit)
	{
		//%06s
		$ci = & get_instance();
		$ci->db->select_max('id_member','max_id');
		$query = $ci->db->get('konsumen');
		if($query->num_rows()>0){
			$data=$query->row();
			$maxid = $data->max_id;
			$count_awalan = strlen($awalan);
			$potong_awalan = str_replace($awalan,"",$maxid);
			$count_potong_awalan = strlen($potong_awalan);
			$noUrut = (int) substr($maxid, $count_awalan, $count_potong_awalan);
			$noUrut++;
			$kode_baru = $awalan.sprintf($digit, $noUrut);
			}else{
			$kode_baru = $awalan.sprintf($digit, 1);
		}
		return $kode_baru;
	}
	function autoNumber($awalan,$digit,$id_table,$table)
	{
		//%06s
		$ci = & get_instance();
		$ci->db->select_max($id_table,'max_id');
		$query = $ci->db->get($table);
		if($query->num_rows()>0){
			$data=$query->row();
			$maxid = $data->max_id;
			$count_awalan = strlen($awalan);
			$potong_awalan = str_replace($awalan,"",$maxid);
			$count_potong_awalan = strlen($potong_awalan);
			$noUrut = (int) substr($maxid, $count_awalan, $count_potong_awalan);
			$noUrut++;
			$kode_baru = $awalan.sprintf($digit, $noUrut);
			}else{
			$kode_baru = $awalan.sprintf($digit, 1);
		}
		return $kode_baru;
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
	
	if ( ! function_exists('cek_demo_promo'))
	{
		
		/**
			* Code Cek demo 
			* 
			@return array
		*/
		function cek_demo_promo($var,$token="")
		{
			$ci = & get_instance();
			
			$device_status = cek_device_status($token);
			$data = array();
			
			if($var=='get'){
				if($query->row()->demo=='Y' AND $ci->session->level!='admin'){
					$data = ['status'=>false,'msg'=>'Akses ditolak','disabled'=>true,'readonly'=>true];
					}else{
					$data = ['status'=>true,'msg'=>'Akses diterima','disabled'=>false,'readonly'=>false];
				}
			}
			
			if($var=='connect'){
				if($query->row()->demo=='Y' AND $ci->session->level!='admin' AND $device_status==true){
					$data = ['status'=>false,'reason'=>'device already connect'];
				}
			}
			
			if($var=='disconnect'){
				if($query->row()->demo=='Y' AND $ci->session->level!='admin' AND $device_status==true){
					$msg = array('detail'=>'device disconnected','status'=> true);
					$data =array ('status'=> true,'detail'=>'Device Disconnected (Demo Only)','msg'=>(object)$msg);
					// $data = ['status'=>true,'detail'=>'device disconnected','msg'=>'Device Disconnected (Demo Only)'];
					}else{
					$msg = array('detail'=>'device disconnected','status'=> true);
					$data =array ('status'=> false,'detail'=>'Device Disconnected','msg'=>(object)$msg);
					// $data = ['status'=>false,'detail'=>'device disconnected'];
				}
				
			}
			
			if($query->row()->demo=='Y' AND $ci->session->level!='admin' AND $device_status==false){
				$data = ['status'=>true,'url'=>img_qrcode()];
			}
			
			if($query->row()->demo=='Y' AND $ci->session->level=='admin' AND $ci->session->idparent!=0 AND $device_status==true){
				$data = ['status'=>false];
			}
			if($query->row()->demo=='Y' AND $ci->session->level=='admin' AND $ci->session->idparent!=0 AND $device_status==false){
				$data = ['status'=>true];
			}
			
			
			return $data;
		}
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