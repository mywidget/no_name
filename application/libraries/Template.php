<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Template {
		var $template_data = array();
		function set($name, $value)
		{
			$this->template_data[$name] = $value;
			// $this->analytics();
		}
		
		function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
		{
			
			$this->CI =& get_instance();
			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));			
			return $this->CI->load->view($template, $this->template_data, $return);
		}
		
		public function json_output($parm, $header=200)
		{
			$this->CI =& get_instance();
			$this->CI->output
			->set_status_header($header)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($parm, JSON_HEX_APOS | JSON_HEX_QUOT))
			->_display();
			exit();
		}
	}		