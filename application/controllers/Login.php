<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Login extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->helper('string');
			$this->load->model('model_login');
		}
		// Fungsi untuk menangani login
		public function index() {
			// Ambil data JSON yang dikirimkan dari AJAX
			$input_data = json_decode(file_get_contents('php://input'), true);
			
			$email = isset($input_data['email']) ? $input_data['email'] : '';
			$password = isset($input_data['password']) ? $input_data['password'] : '';
			
			// Validasi input email dan password
			if (empty($email) || empty($password)) {
				echo json_encode(['status' => false, 'message' => 'Email dan kata sandi diperlukan']);
				return;
			}
			
			// Verifikasi login (cek email dan password di database)
			$row = $this->model_login->check_login($email, $password);
			
			if ($row) {
				
				$sid_baru = session_id();
				$this->session->set_userdata(
				array('iduser'=>$row['id_user'],
				'emailuser'=>$row['email'],
				'nama'=>$row['nama_lengkap'],
				'idparent'=>$row['parent'],
				'idlevel'=>$row['id_level'],
				'id_divisi'=>$row['id_divisi'],
				'idlv'=>$row['idlevel'],
				'level'=>$row['level'],
				'idsession'=>$row['id_session'],
				'typeakses'=>$row['type_akses'],
				'sesid'=>$sid_baru)
				);
				$this->record_login($email,$sid_baru);
				// Mengembalikan response sukses
				echo json_encode(['status' => true, 'message' => 'Login berhasil', 'userName' => $row['nama_lengkap']]);
				} else {
				// Jika login gagal
				echo json_encode(['status' => false, 'message' => 'Email atau kata sandi tidak valid']);
			}
		}
		
		private function record_login($email_user,$sid_baru){
			$cek_info   = cek_info();
			$cekip      = $this->model_app->view_where('user_agent',['ip'=>$cek_info['ip']]);
			$this->model_app->update('tb_users', array("sesi_login"=>$sid_baru),array('id_user'=>$this->session->iduser));
			$this->model_data->login_record($email_user);
			if ($cekip->num_rows() > 0){
				$rowcek = $cekip->row();
				$counter = $rowcek->counter + 1;
				$this->model_app->update('user_agent', array("counter"=>$counter),array('ip'=>$cek_info['ip']));
				}else{
				$data_info = array(
				'ip'=>$cek_info['ip'],
				'os'=>$cek_info['os'],
				'browser'=>$cek_info['browser'],
				'create_date'=>date('Y-m-d H:i:s')
				);
				$this->model_app->insert('user_agent',$data_info);
			}
		}
		
	}											