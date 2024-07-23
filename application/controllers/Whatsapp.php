<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	use PHPUnit\Util\Json;
	use Curl\Curl;
	class Whatsapp extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			cek_session_login(1);
			$this->title = tag_key('site_title');
			$this->iduser = $this->session->iduser; 
            $this->level = $this->session->level; 
            $this->idlevel = $this->session->idlevel; 
			$this->load->model('model_whatsapp');
			$this->load->model('model_formulir');
			$this->perPage = 10;
			$this->curl = new Curl();
		}
		
		public function device()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Data Device | '.$this->title;
			
			$this->thm->load('backend/template','backend/whatsapp/view_index',$data);
		}
		
		public function template()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Template Pesan | '.$this->title;
			
			$this->thm->load('backend/template','backend/whatsapp/template',$data);
		}
		public function broadcast()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Broadcast Pesan | '.$this->title;
			$data['unit'] = $this->model_app->view_where('rb_unit',['aktif'=>'Ya'])->result();
			$this->thm->load('backend/template','backend/whatsapp/broadcast',$data);
		}
		
		public function report()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Report Pesan | '.$this->title;
			
			$this->thm->load('backend/template','backend/whatsapp/report',$data);
		}
		
		
		function ajax_list()
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
				$limit = 5;
			}
			
			
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_whatsapp->getDevice($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('whatsapp/ajax_list');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchData';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_whatsapp->getDevice($conditions);
			
            // Load the data list view 
			$this->load->view('backend/whatsapp/get-ajax',$data);
			
		}
		
		function ajax_list_report()
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
            $totalRec = $this->model_whatsapp->getReport($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('whatsapp/ajax_list_report');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchData';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
            $data['start'] = $offset;
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_whatsapp->getReport($conditions);
			
            // Load the data list view 
			$this->load->view('backend/whatsapp/get-ajax-report',$data);
			
		}
		
		function ajax_list_broadcast()
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
            $totalRec = $this->model_whatsapp->getBroadcast($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('whatsapp/ajax_list_broadcast');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchData';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
            $data['start'] = $offset;
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_whatsapp->getBroadcast($conditions);
			
            // Load the data list view 
			$this->load->view('backend/whatsapp/get-ajax-broadcast',$data);
			
		}
		
		function ajax_list_template()
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
            $totalRec = $this->model_whatsapp->getTemplate($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('whatsapp/ajax_list_template');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchData';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_whatsapp->getTemplate($conditions);
			
            // Load the data list view 
			$this->load->view('backend/whatsapp/get-ajax-template',$data);
			
		}
		
		/**
			* get_template
			*
			* @return void
		*/
		public function get_template()
		{
			
			if ($this->input->is_ajax_request()) {
				$id = xss_filter($this->input->post('id'), 'xss');
				$idedit = decrypt_url($id);
				if(!empty($id)){
					$row = $this->model_app->view_where('rb_template_pesan', ['id' => $idedit])->row();
					$response = [
					'status' => true,
					'id' => $id,
					'title' => $row->title,
					'deskripsi' => $row->deskripsi,
					'slug' => $row->slug,
					'publish' => $row->aktif
					];
					} else {
					$response = [
					'status' => true,
					'id' => 0,
					'title' =>'',
					'deskripsi' =>'',
					'publish' =>'Ya'
					];
				}
				}else{
				$response = ['status' => false];
			}
			$this->thm->json_output($response);
		}
		
		/**
			* get_template
			*
			* @return void
		*/
		public function get_broadcast()
		{
			
			if ($this->input->is_ajax_request()) {
				$id = xss_filter($this->input->post('id'), 'xss');
				$idedit = decrypt_url($id);
				if(!empty($id)){
					$row = $this->model_app->view_where('rb_broadcast', ['id' => $idedit])->row();
					$response = [
					'status' => true,
					'id' => $id,
					'title' => $row->title,
					'message' => $row->message,
					'target' => $row->target,
					'schedule' => $row->schedule
					];
					} else {
					$response = [
					'status' => true,
					'id' => 0,
					'title' =>'',
					'message' =>'',
					'target' =>'',
					'schedule' =>''
					];
				}
				}else{
				$response = ['status' => false];
			}
			$this->thm->json_output($response);
		}
		
		/**
			* get_detail
			*
			* @return void
		*/
		public function get_detail()
		{
			
			if ($this->input->is_ajax_request()) {
				$id = xss_filter($this->input->post('id'), 'xss');
				$idedit = decrypt_url($id);
				if(!empty($id)){
					$row = $this->model_app->view_where('rb_report_pesan', ['id' => $idedit])->row();
					$response = [
					'status' => true,
					'id' => $id,
					'target' => $row->target,
					'deskripsi' => $row->message,
					];
					} else {
					$response = [
					'status' => true,
					'id' => 0,
					'title' =>'',
					'deskripsi' =>''
					];
				}
				}else{
				$response = ['status' => false];
			}
			$this->thm->json_output($response);
		}
		
		/**
			* save_template
			*
			* @return void
		*/
		public function save_template()
		{
			
			if ($this->input->is_ajax_request()) {
				$type      = xss_filter($this->input->post('type'), 'xss');
				$title     = xss_filter($this->input->post('title'), 'xss');
				$deskripsi = xss_filter($this->input->post('deskripsi'));
				$deskripsi = ($deskripsi);
				$slug    = $this->input->post('slug');
				$aktif    = $this->input->post('publish');
				
				$this->form_validation->set_rules(array(array(
				'field' => 'title',
				'label' => 'Title',
				'rules' => 'required|trim',
				'errors' => array(
				'required' => '%s. Harus di isi'
				)
				)));
				
				$this->form_validation->set_rules(array(array(
				'field' => 'deskripsi',
				'label' => 'Deskripsi',
				'rules' => 'required|trim',
				'errors' => array(
				'required' => '%s. Harus di isi'
				)
				)));
				
				if ($this->form_validation->run()) {
					if ($type == 'add') {
						$param = ['title' => $title, 'deskripsi' => $deskripsi, 'slug' => $slug, 'aktif' => $aktif, 'create_date' => today()];
						$input =  $this->model_app->input('rb_template_pesan', $param);
						if ($input['status'] == 'ok') {
							$result = array('status' => true, 'msg' => 'Data berhasil diinput');
							} else {
							$result = array('status' => false);
						}
					}
					if ($type == 'edit') {
						
						$id = xss_filter($this->input->post('id'), 'xss');
						$id = decrypt_url($id);
						$param = ['title' => $title, 'deskripsi' => $deskripsi,'slug'=>$slug, 'aktif' => $aktif];
						$update = $this->model_app->update('rb_template_pesan', $param, ['id' => $id]);
						if ($update['status'] == 'ok') {
							$result = ['status' => true, 'msg' => 'Berhasil'];
							} else {
							$result = ['status' => false, 'msg' => 'Gagal'];
						}
					}
					} else {
					
					$result['status'] = 'error';
					$result['alert']['type'] = 'error';
					$result['alert']['content'] = validation_errors();
				}
				
				} else {
				$result = ['status' => false];
			}
			$this->thm->json_output($result);
		}
		/**
			* save_broadcast
			*
			* @return void
		*/
		public function save_broadcast()
		{
			
			if ($this->input->is_ajax_request()) {
				$type      = xss_filter($this->input->post('type'), 'xss');
				$title     = xss_filter($this->input->post('title'), 'xss');
				$deskripsi = xss_filter($this->input->post('deskripsi'));
				$unit    = $this->input->post('unit');
				$schedule    = $this->input->post('schedule');
				if(!empty($schedule)){
					$schedule    = $this->input->post('schedule');
					}else{
					$schedule    = null;
				}
				$getPengirim = $this->model_whatsapp->getPengirim();
				if($getPengirim==false){
					$result = ['status' => false, 'msg' => 'Device tidak ditemukan'];
					$this->thm->json_output($result);
				}
				$this->form_validation->set_rules(array(array(
				'field' => 'title',
				'label' => 'Title',
				'rules' => 'required|trim',
				'errors' => array(
				'required' => '%s. Harus di isi'
				)
				)));
				
				$this->form_validation->set_rules(array(array(
				'field' => 'deskripsi',
				'label' => 'Deskripsi',
				'rules' => 'required|trim',
				'errors' => array(
				'required' => '%s. Harus di isi'
				)
				)));
				
				if ($this->form_validation->run()) {
					if ($type == 'add') {
						$param = ['title' => $title, 
						'device' => $getPengirim, 
						'message' => $deskripsi, 
						'target' => $unit, 
						'schedule' => $schedule, 
						'create_date' => today()];
						$input =  $this->model_app->input('rb_broadcast', $param);
						if ($input['status'] == 'ok') {
							$result = array('status' => true, 'msg' => 'Data berhasil diinput');
							} else {
							$result = array('status' => false);
						}
					}
					if ($type == 'edit') {
						
						$id = xss_filter($this->input->post('id'), 'xss');
						$id = decrypt_url($id);
						$param = ['title' => $title, 
						'message' => $deskripsi, 
						'target' => $unit, 
						'schedule' => $schedule];
						$update = $this->model_app->update('rb_broadcast', $param, ['id' => $id]);
						if ($update['status'] == 'ok') {
							$result = ['status' => true, 'msg' => 'Berhasil'];
							} else {
							$result = ['status' => false, 'msg' => 'Gagal'];
						}
					}
					} else {
					
					$result['status'] = 'error';
					$result['alert']['type'] = 'error';
					$result['alert']['content'] = validation_errors();
				}
				
				} else {
				$result = ['status' => false];
			}
			$this->thm->json_output($result);
		}
		
		function hapus_template(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$where = array('id' => $id);
			$search = $this->model_app->edit('rb_template_pesan', $where);
			if($search->num_rows()>0){
				$row = $search->row_array();
				$res = $this->model_app->hapus('rb_template_pesan',$where);
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
		function hapus_boradcast(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$where = array('id' => $id);
			$search = $this->model_app->edit('rb_broadcast', $where);
			if($search->num_rows()>0){
				$row = $search->row_array();
				$res = $this->model_app->hapus('rb_broadcast',$where);
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
		function hapus_data(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$where = array('id' => $id);
			$search = $this->model_app->edit('rb_report_pesan', $where);
			if($search->num_rows()>0){
				$row = $search->row_array();
				$res = $this->model_app->hapus('rb_report_pesan',$where);
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
		/**
			* cek_status
			*
			* @return void
		*/
		public function cek_status()
		{
			$token = decrypt_url($this->input->post('token'));
			$result = $this->fonnte('https://api.fonnte.com/device',$token);
			
			if ($result['status'] == true) {
				if ($result['msg']->status == true) {
					$this->update_device($result['msg'],$token);
					$data = $result['msg'];
					} else {
					$data = $result['msg'];
				}
			}
			if ($result['status'] == false) {
				$data = ['status' => false, 'msg' => $result['msg']];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		/**
			* cek_status
			*
			* @return void
		*/
		public function cek_status_device()
		{
			$token = ($this->input->post('token'));
			$result = $this->fonnte('https://api.fonnte.com/device',$token);
			
			if ($result['status'] == true) {
				if ($result['msg']->status == true) {
					$this->update_device($result['msg'],$token);
					$data = $result['msg'];
					} else {
					$data = $result['msg'];
				}
			}
			if ($result['status'] == false) {
				$data = ['status' => false, 'msg' => $result['msg']];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		
		/**
			* scan_qr
			*
			* @return void
		*/
		public function scan_qr()
		{
			$token = $this->input->post('token');
			// cek_promo('get',$token);
			$result = $this->fonnte('https://api.fonnte.com/qr',$token);
			// dump($result);
			$_token = (object)['token'=>$token];
			if ($result['status'] == true) {
				if ($result['msg']->status == true) {
					$data = $result['msg'];
					} else {
					$data = $result['msg'];
				}
			}
			if ($result['status'] == false) {
				$data = ['status' => false, 'msg' => $result['msg']];
			}
			$obj_merged = (object) array_merge((array) $data, (array) $_token);
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($obj_merged));
		}
		
		/**
			* logout_device
			*
			* @return string
		*/
		public function logout_device()
		{
			$token = $this->input->post('token');
			// $status = cek_demo_promo('disconnect',$token);
			// if ($status['status'] == true) {
			// $response = $status;
			// } else {
			$response = $this->fonnte('https://api.fonnte.com/disconnect',$token);
			// }
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
		}
		
		/**
			* validate_number
			*
			* @return string
		*/
		public function validate_number()
		{
			$token = $this->input->post('token');
			$target = $this->input->post('target');
			$cek_nomor = array(
			'target' => $target,
			'countryCode' => '62'
			);
			
			$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
			$this->curl->setDefaultJsonDecoder($assoc = true);
			$this->curl->setHeader('Authorization', $token);
			$this->curl->setHeader('Content-Type', 'application/json');
			$this->curl->post('https://api.fonnte.com/validate', $cek_nomor);
			if ($this->curl->error) {
				$result = ['status' => false, 'msg' => $this->curl->errorMessage];
				} else {
				$result = ['status' => true, 'msg' => (object)$this->curl->response];
			}
			
			if ($result['status'] == true) {
				if (!empty($result->registered)) {
					$data = ['status' => true, 'msg' => 'OK'];
					} else {
					$data = ['status' => false, 'msg' => 'ERROR'];
				}
				} else {
				$data = ['status' => false, 'msg' => $result['msg']];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		/**
			* fonnte
			*
			* @param  mixed $url
			* @return array
		*/
		private function fonnte($url,$token="")
		{
			$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
			$this->curl->setDefaultJsonDecoder($assoc = true);
			$this->curl->setHeader('Authorization', $token);
			$this->curl->setHeader('Content-Type', 'application/json');
			$this->curl->post($url);
			if ($this->curl->error) {
				$result = ['status' => false, 'msg' => $this->curl->errorMessage];
				} else {
				$result = ['status' => true, 'msg' => (object)$this->curl->response];
			}
			return $result;
		}
		
		/**
			* load_device
			*
			* @param  mixed $param
			* @return void
		*/
		public function load_device()
		{
			$load = $this->model_app->views('device')->result();
			foreach($load AS $row)
			{
				$response[] = array("id"=>encrypt_url($row->token),"name"=>$row->device);
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
		}
		/**
			* add_device
			*
			* @param  mixed $param
			* @return void
		*/
		public function add_device()
		{
			$id = decrypt_url($this->input->post('id'));
			$tipe = $this->input->post('tipe');
			$token = $this->input->post('token');
			
			if($tipe=='get' AND $id==0)
			{
				$response = ['status'=>false,'id'=>0];
			}
			
			if($tipe=='get' AND $id > 0)
			{
				
				$cek = $this->model_app->view_where('rb_device', ['id' => $id]);
				if ($cek->num_rows() > 0) {
					$response = ['status'=>200,'id'=>$id,'token'=>maskString($cek->row()->token)];
					} else {
					$response = ['status'=>false,'token'=>''];
				}
			}
			
			if($tipe=='add')
			{
				
				$cek = $this->model_app->view_where('rb_device', ['token' => $token]);
				if ($cek->num_rows() > 0) {
					$response = ['status'=>false,'msg'=>'Token Sudah ada'];
					} else {
					$input = $this->model_app->input('rb_device', ['token' => $token]);
					if($input['status']=='ok')
					{
						$response = ['status'=>200,'msg'=>'Berhasil di simpan'];
						$this->get_data_fonnte($token);
						}else{
						$response = ['status'=>false,'msg'=>'Gagal di simpan'];
					}
				}
			}
			
			if($tipe=='edit' AND $id > 0)
			{
				
				$cek = $this->model_app->view_where('rb_device', ['token'=>$token,'id !=' => $id]);
				if ($cek->num_rows() > 0) {
					$response = ['status'=>false,'msg'=>'Token Sudah ada'];
					}else{
					$update = $this->model_app->update('rb_device', ['token'=>$token], ['id' => $id]);
					if($update['status']=='ok')
					{
						$response = ['status'=>200,'msg'=>'Berhasil di update'];
						$this->get_data_fonnte($token);
						}else{
						$response = ['status'=>false,'msg'=>'Gagal di update'];
					}
				}
			}
			
			if($tipe=='hapus' AND $id > 0)
			{
				
				$cek = $this->model_app->view_where('rb_device', ['id' => $id]);
				if ($cek->num_rows() > 0) {
					$hapus = $this->model_app->hapus('rb_device', array('id' => $id));
					if($hapus['status']=='ok')
					{
						$response = ['status'=>true,'msg'=>'Berhasil di hapus'];
						}else{
						$response = ['status'=>false,'msg'=>'Gagal di hapus'];
					}
					}else{
					$response = ['status'=>false,'msg'=>'Data tidak ditemukan'];
				}
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
		}
		
		/**
			* cek_status
			*
			* @return void
		*/
		public function get_data_fonnte($token)
		{
			
			$result = $this->fonnte('https://api.fonnte.com/device',$token);
			
			if ($result['status'] == true) {
				if ($result['msg']->status == true) {
					$this->update_device($result['msg'],$token);
				}
			}
			
		}
		
		/**
			* update_device
			*
			* @param  mixed $param
			* @return void
		*/
		private function update_device($array,$token)
		{
			$param = [
			'device'       => $array->device,
			'device_status'=> $array->device_status,
			'expired'      => $array->expired,
			'messages'     => $array->messages,
			'name'         => $array->name,
			'package'      => $array->package,
			'quota'        => $array->quota,
			];
			
			$cek = $this->model_app->view_where('rb_device', ['token' => $token]);
			if ($cek->num_rows() > 0) {
				$this->model_app->update('rb_device', $param, ['token' => $token]);
			}
		}
		
		/**
			* kirim_boradcast
			*
			* @return void
		*/
		public function kirim_boradcasts()
		{
			$curl = curl_init();
			
			curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.fonnte.com/send',
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING =>'',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array('data' => '[{"target": "089611274798", "message": "1","delay":"1"},{"target": "089611274798", "message": "2","delay":"5"},{"target": "089611274798", "message": "3","delay":"0"}]'),
			CURLOPT_HTTPHEADER => array(
			'Authorization: yVe9otFTBSRkwRtTj3-U' //change TOKEN to your actual token
			),
			));
			
			$response = curl_exec($curl);
			
			curl_close($curl);
			$this->thm->json_output($response);
			echo $response;
		}
		
		public function kirim_boradcast()
		{
			$id = decrypt_url($this->input->post('id',true));
			$device = decrypt_url($this->input->post('device',true));
			$token = $this->model_app->view_where('rb_device', ['device' => $device])->row()->token;
			$pesan = $this->get_pesan($id);
			$this->send_notif($pesan);
			
		}
		
		private function send_notif($pesan)
		{
			$token = $this->model_formulir->get_token()->token;
			
			$data_send = ['data'=>$pesan];
			
			$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
			$this->curl->setDefaultJsonDecoder($assoc = true);
			$this->curl->setHeader('Authorization', $token);
			$this->curl->setHeader('Content-Type', 'application/json');
			$this->curl->post('https://api.fonnte.com/send', $data_send);
			if ($this->curl->error) {
			$result = ['status' => false, 'msg' => $this->curl->errorMessage];
			} else {
			$response = $this->curl->response;
			$result = ['status' => true, 'msg' => (object)$response];
			}
			$this->thm->json_output($response);
			 
		}
		
		/**
			* get_pesan
			*
			* @return array
		*/
		public function get_pesan($id)
		{
			
			$pesan = $this->model_app->view_where('rb_broadcast', ['id' => $id])->row();
			if(is_numeric($pesan->target)){
				$label = $pesan->target;
				$target  = $this->model_app->view_where('rb_psb_daftar', ['id_unit' => $label])->result_array();
				
				}elseif($pesan->target=='Baru'){
				$label = get_unit($pesan->target);
				$target  = $this->model_app->view_where('rb_psb_daftar', ['s_pendidikan' => $label])->result_array();
				}elseif($pesan->target=='Naik Tingkatan'){
				$label = get_unit($pesan->target);
				$target  = $this->model_app->view_where('rb_psb_daftar', ['s_pendidikan' => $label])->result_array();
				}else{
				$target  = $this->model_app->view('rb_psb_daftar')->result_array();
			}
			
			$data = [];
			foreach($target AS $val){
				// Array containing search string
				$searchVal = array(
				"{selamat}",
				"{nama_sekolah}",
				"{web_sekolah} ",
				"{wa_sekolah}",
				"{email_sekolah}",
				"{alamat_sekolah}",
				"{nomor_pendaftaran}",
				"{tgl_pendaftaran}",
				"{nama_pendaftar}",
				"{nik}",
				"{nisn}",
				"{email_pendaftar}",
				"{unit}",
				"{kelas}",
				"{kamar}",
				"{cetak_formulir}"
				);
				$link = tag_key('site_url').'/cetak-formulir/'.encrypt_url($val['nik']);
				// Array containing replace string from  search string
				$replaceVal = array(
				ucapan(),
				info('nama_sekolah'),
				info('site_url'),
				info('whatsapp'),
				info('site_mail'),
				info('site_addr'),
				$val['nik'],
				date('Y-m-d'),
				$val['nama'],
				$val['nik'],
				$val['nisn'],
				$val['email'],
				$val['unit_sekolah'],
				$val['kelas'],
				$val['kamar'],
				$link
				);
				
				// Function to replace string
				$message  = str_replace($searchVal, $replaceVal, $pesan->message);
				$data[] = ['target' => $val['nomor_hp'], 'message' => $message,'delay'=>'5'];
				
			}
			
			
			$kirim = json_encode($data);
			return $kirim;
		}
		
	}																																																											