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
			$this->menu = $this->uri->segment(1); 
			$this->curl = new Curl();
			$this->url_api = 'https://server.pospercetakan.my.id';
			$this->url_send = 'https://api.pospercetakan.my.id';
			$this->api_key = tag_key('api_key_wa');
		}
		
		public function device()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			
			$data['title'] = 'Data Device | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			$this->thm->load('backend/template','backend/whatsapp/view_index',$data);
		}
		
		public function pengaturan()
		{
			$result= $this->model_app->view('pengaturan_device')->result_array();
			foreach($result as $row)
			{
				$data[] = array("id"=>$row['id'],"name"=>$row['title'],"url"=>$row['url_api'],"aktif"=>$row['aktif']);
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
			
		}
		
		public function get_form_device()
		{
			$id = $this->input->post('id');
			$type_add = $this->input->post('type_add');
			if($type_add=='add' AND $id > 0){
				$row= $this->model_app->view_where('pengaturan_device',['id'=>$id])->row_array();
				if($row['id']==1){
					$this->load->view('backend/whatsapp/form_add_app'); 
					}else{
					$this->load->view('backend/whatsapp/form_add_fonnte'); 
				}
			}
		}
		public function get_form_edit_device()
		{
			$id = decrypt_url($this->input->post('id'));
			$idp = $this->input->post('idp');
			
			$row= $this->model_app->view_where('pengaturan_device',['id'=>$idp])->row_array();
			$data['device']= $this->model_app->view_where('rb_device',['id'=>$id])->row();
			if($row['id']==1){
				$this->load->view('backend/whatsapp/form_edit_app',$data,false); 
				}else{
				$this->load->view('backend/whatsapp/form_edit_fonnte',$data); 
			}
			
		}
		public function template()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Template Pesan | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			$this->thm->load('backend/template','backend/whatsapp/template',$data);
		}
		public function broadcast()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Broadcast Pesan | '.$this->title;
			$data['unit'] = $this->model_app->view_where('rb_unit',['aktif'=>'Ya'])->result();
			$data['menu'] = getMenu($this->menu);
			$this->thm->load('backend/template','backend/whatsapp/broadcast',$data);
		}
		
		public function report()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Report Pesan | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			$this->thm->load('backend/template','backend/whatsapp/report',$data);
		}
		
		
		function ajax_list()
        {
            // Define offset 
			cek_crud_akses('CONTENT');
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
			cek_crud_akses('CONTENT');
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
			cek_crud_akses('CONTENT');
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
			cek_crud_akses('CONTENT');
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
			cek_crud_akses('EDIT');
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
		function kirim_ulang(){
			cek_input_post('GET');
			cek_crud_akses('CONTENT');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$where = array('id' => $id);
			$search = $this->model_app->edit('rb_report_pesan', $where);
			if($search->num_rows()>0){
				$row = $search->row();
				$target = $row->target;
				$message = $row->message;
				$this->send_message($target,$message);
				
				$data = array('status'=>true,'title'=>'Kirim ulang','msg'=>'Data berhasil dikirim');
				}else{
				$data = array('status'=>false,'title'=>'Kirim ulang','msg'=>'Data gagal dikirim');
			}
			
			$this->thm->json_output($data);
			
			
		}
		private function send_message($target,$message)
		{
			$token = $this->model_formulir->get_token()->token;
			
			$data_send = array(
			'target' => $target,
			'message' => $message,
			'countryCode' => '62'
			);
			// dump($token);
			
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
			return $result;
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
			* cek_status_device
			*
			* @return void
		*/
		public function cek_status_device()
		{
			$id = $this->input->post('id_pengaturan');
			if($id==1){
				$device = $this->input->post('device');
				$token = $this->cek_token($device);
				$data = $this->cek_status_device_app($token,$device);
				}else{
				$token = $this->input->post('token');
				$data = $this->cek_status_device_fonnte($token);
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		private function cek_status_device_app($token,$device)
		{
			
			$data = [
			'APP-API-KEY' => $token,
			'device' => $device
			];
			
			$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
			$this->curl->setDefaultJsonDecoder($assoc = true);
			//$this->curl->setHeader('x-api-key', $this->api_key);
			$this->curl->setHeader('Content-Type', 'application/json');
			$this->curl->post($this->url_api.'/api/cek_device', $data);
			
			if($this->curl->error){
				$arr = $this->curl->errorMessage;
				}else{
				$arr = $this->curl->response;
				$this->update_device_status($arr);
			}
			
			return $arr;
			
		}
		
		private function update_device_status($params = []){
			$update = $this->model_app->update('rb_device',['device_status'=>$params['message']],['device'=>$params['device']]);
			
		}
		private function cek_status_device_fonnte($token)
		{
			
			
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
			return $data;
		}
		private function cek_token($device)
		{
			
			return $this->model_app->view_where('rb_device', ['id_pengaturan'=>1,'device' => $device])->row()->token;
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
			$id = $this->input->post('id');
			$tipe = $this->input->post('type_add');
			$id_pengaturan = $this->input->post('id_pengaturan') ? $this->input->post('id_pengaturan') : $this->input->post('load_pengaturan');
			
			if($tipe=='add')
			{
				
				cek_crud_akses(7);//create
				if($id_pengaturan==1){
					$response = $this->add_post();
					}else{
					$response = $this->add_post_fonnte();
				}
				
			}
			// dump($response);
			if($tipe=='edit' AND $id > 0)
			{
				
				cek_crud_akses(9,'json');//update
				// dump($_POST);
				if($id_pengaturan==1){
					$nama_device = $this->input->post('nama_device');
					$nomor_device = $this->input->post('nomor_device');
					$update = $this->model_app->update('rb_device', ['name'=>$nama_device,'device'=>$nomor_device], ['id' => $id]);
					if($update['status']=='ok')
					{
						$response = ['status'=>200,'msg'=>'Berhasil di update'];
						// $this->get_data_fonnte($token);
						}else{
						$response = ['status'=>false,'msg'=>'Gagal di update'];
					}
				}
				if($id_pengaturan==2){
					$token_api = $this->input->post('token_api');
					$update = $this->model_app->update('rb_device', ['token'=>$token_api], ['id' => $id]);
					if($update['status']=='ok')
					{
						$response = ['status'=>200,'msg'=>'Berhasil di update'];
						$this->get_data_fonnte($token_api);
						}else{
						$response = ['status'=>false,'msg'=>'Gagal di update'];
					}
				}
				
			}
			
			if($tipe=='hapus' AND $id > 0)
			{
				cek_crud_akses(10,'json');//delete
				
				$cek = $this->model_app->view_where('rb_device', ['id' => $id]);
				if ($cek->num_rows() > 0) {
					$hapus = $this->model_app->hapus('rb_device', array('id' => $id));
					if($hapus['status']=='ok')
					{
						$response = ['status'=>200,'msg'=>'Berhasil di hapus'];
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
		// Menambahkan post
		private function add_post() {
			// Validasi form
			$this->form_validation->set_rules('nama_device', 'nama_device', 'required');
			$this->form_validation->set_rules('nomor_device', 'nomor_device', 'required|callback_check_device_exists');
			
			if ($this->form_validation->run() == FALSE) {
				// Jika validasi gagal
				$response = ['status'=>'error','msg'=>validation_errors()];
				} else {
				$token = $this->api_key;
				$id_pengaturan = $this->input->post('id_pengaturan');
				$nama_device = $this->input->post('nama_device');
				$nomor_device = hp62($this->input->post('nomor_device'));
				$input = $this->model_app->input('rb_device', ['id_pengaturan'=>$id_pengaturan,'token'=>$token,'name' => $nama_device,'device' => $nomor_device]);
				if($input['status']=='ok')
				{
					$this->tambah_device_app($token,$nomor_device);
					$response = ['status'=>true,'title'=>'Simpan device','msg'=>'Berhasil di simpan'];
					} else {
					$response = ['status'=>false,'title'=>'Simpan device','msg'=>'Gagal di simpan'];
				}
			}
			return $response;
		}
		/**
			* tambah_device_app
			*
			* @param  mixed $url
			* @return array
		*/
		private function tambah_device_app($token="",$device="")
		{
			$data = [
			'APP-API-KEY' => $token,
			'device' => $device
			];
			
			$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
			$this->curl->setDefaultJsonDecoder($assoc = true);
			$this->curl->setHeader('Content-Type', 'application/json');
			$this->curl->post($this->url_api.'/api/add_device', $data);
			
			if($this->curl->error){
				$arr = $this->curl->errorMessage;
				}else{
				$arr = $this->curl->response;
			}
			
			return $arr;
		}
		// hapus post
		private function hapus_post($id_pengaturan,$device) {
			
			$token = $this->api_key;
			
			if($id_pengaturan==1)
			{
				$this->hapus_device_app($token,$device);
				$response = ['status'=>true,'title'=>'Hapus device','msg'=>'Berhasil di Hapus'];
				return $response;
			}
			
		}
		/**
			* hapus_device_app
			*
			* @param  mixed $url
			* @return array
		*/
		private function hapus_device_app($token="",$device="")
		{
			$data = [
			'APP-API-KEY' => $token,
			'device' => $device
			];
			
			$this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
			$this->curl->setDefaultJsonDecoder($assoc = true);
			$this->curl->setHeader('Content-Type', 'application/json');
			$this->curl->post($this->url_api.'/api/hapus_device', $data);
			
			if($this->curl->error){
				$arr = $this->curl->errorMessage;
				}else{
				$arr = $this->curl->response;
			}
			
			return $arr;
		}
		
		// Callback untuk cek email
		public function check_device_exists($nomor_device)
		{
			
			if ($this->model_whatsapp->check_device_exists($nomor_device) == FALSE) {
				$this->form_validation->set_message('check_device_exists', 'Device sudah terdaftar.');
				return FALSE;
			}
			return TRUE;
		}
		// Fungsi callback untuk validasi unique title saat update
		public function check_unique_device($device) {
			$id = $this->input->post('id');
			if ($this->model_whatsapp->is_device_unique($device, $id)) {
				return TRUE;
				} else {
				$this->form_validation->set_message('check_unique_device', 'The title must be unique.');
				return FALSE;
			}
		}
		// Menambahkan post
		private function add_post_fonnte() {
			// Validasi form
			
			$this->form_validation->set_rules('token_api', 'Token', 'required|is_unique[device.token]');
			
			if ($this->form_validation->run() == FALSE) {
				// Jika validasi gagal
				$response = ['status'=>'error','msg'=>validation_errors()];
				} else {
				$token = $this->input->post('token_api');
				$input = $this->model_app->input('device', ['token' => $token]);
				if($input['status']=='ok')
				{
					$this->get_data_fonnte($token);
					$response = ['status'=>true,'msg'=>'Berhasil di simpan'];
					} else {
					$response = ['status'=>false,'msg'=>'Gagal di simpan'];
				}
			}
			return $response;
		}
		/**
			* cek_pengaturan
			*
			* @return void
		*/
		public function cek_pengaturan($id)
		{
			
			$result = $this->model_app->view_where('pengaturan_device',['id'=>$id]);
			
			return false;
			if ($result->num_rows() > 0) {
				return true;
			}
			
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
				getNamaKelas($val['kelas']),
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
		/**
			* scan_qr
			*
			* @return void
		*/
		public function scanqr_app($id)
		{
			$data['title'] = 'Device | ' . $this->title;
			$data['api_key'] = $this->api_key;
			$data['url_send'] = $this->url_send;
			$data['menu'] = getMenu($this->menu);
			$cek = $this->model_app->view_where('rb_device', ['id' => decrypt_url($id)]);
			if ($cek->num_rows() > 0) {
				$data['row'] = $cek->row();
				$this->thm->load('backend/template','backend/whatsapp/device_scan',$data);
			}
		}
	}	