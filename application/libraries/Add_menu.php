<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Add_menu {
		private $name; 
		
		public function suratjalan()
		{
			$menu = array('idparent' => '155','id_level' => '1,2,3,4,5,6','nama_menu' => 'Surat jalan','link' => 'laporan/suratjalan','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '15');
				
			return $this->name = $menu;
		}
		
		public function user()
		{
			$user = array('parent' => '1','idmenu' => '24,33,109,112,116,139,141,147,148,153,154,155,156,157,159,160,162,165,166,167,168,170,171,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190','id_level' => '3','idlevel' => '1,2,3,4','password' => '$2y$10$/tUAYsjhPRD4J6zbH5mziOEpKI8gSfKM/v8j6Sz59/4j.FZJRVEVW','nama_lengkap' => 'Kasir','tgl_daftar' => '2020-08-28','alamat' => 'Banten','email' => 'kasir@my.id','no_hp' => '0899828282','foto' => '/upload/images/user/favicon.png','level' => 'kasir','aktif' => 'Y','hak_akses' => '0','type_akses' => '6,7,8,9','id_session' => 'ca43-608e-5c5b-7b50-2085','sesi_login' => '2650cda73beafdd21002fb7eafe2ceb8ee300f99','logo' => NULL,'verify' => '1','app_secret' => 'f947976c8ec41e321ddc5926333c75d8a550e5e0a17535cda6234b26ca9e8d98','last_invoice' => '0','last_idp' => '0');
				
			return $this->name = $user;
		}
		
		function get_name() {
			return $this->name;
		}
	}																						