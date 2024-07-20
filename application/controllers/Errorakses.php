<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Errorakses extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			cek_tabel();
			cek_session_login(1);
			
			$this->title = tag_key('site_title');
			$this->iduser = $this->session->iduser; 
			$this->akses = $this->session->type_akses; 
			
		}
		
		public function index()
		{
			
			$data['title'] = 'Dashboard | '.$this->title;
			$this->thm->load('backend/template','backend/error',$data);
		}
		
		public function crud()
		{
			
			$data['title'] = 'Dashboard | '.$this->title;
			$this->thm->load('backend/template','backend/error_crud',$data);
		}
		
	}
