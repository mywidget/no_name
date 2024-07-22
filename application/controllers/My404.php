<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class My404 extends CI_Controller 
	{
		public function __construct() 
		{
			parent::__construct(); 
		} 
		
		public function index() 
		{
			$data = ['heading'=>'404','message'=>'Halaman tidak ditemukan'];
			$this->output->set_status_header('404'); 
			$this->load->view('errors/404',$data);//loading in custom error view
		} 
		
		public function login() 
		{ 
			if (isset($this->session->level)){
				redirect();
			}
			$data = ['heading'=>'401','message'=>'Login Required'];
			$this->output->set_status_header('401'); 
			$this->load->view('errors/401',$data);
		} 
		
		  
		public function forbidden() 
		{ 
			$data = ['heading'=>'403','message'=>'Access Forbidden'];
			$this->output->set_status_header('403'); 
			$this->load->view('errors/403',$data);
		} 
	}			