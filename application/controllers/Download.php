<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Download extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();
			$this->load->helper(array('url','download'));	
			
			$this->title = tag_key('site_title');
		}
		
		public function data($file="")
		{
			
			if(empty($file)){
				$response = ['status'=>false,'msg'=>'file tidak ditemukan'];
				$this->thm->json_output($response);
				}else{
				$opathFile = FCPATH."upload/" . $file;
				$size = @filesize($opathFile);
				if($size !== false){
					force_download('upload/'.$file,NULL);
					}else{
					$response = ['status'=>false,'msg'=>'file tidak ditemukan'];
					$this->thm->json_output($response);
				}
			}
		}
		
	}
	
	/* End of file Home.php */
