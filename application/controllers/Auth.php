<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Auth extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->helper('string');
			
			$this->title = tag_key('site_title');
		}
		function index(){
			redirect('auth/login');
		}
		function login(){
			$data['title'] = 'Administrator &rsaquo; Log In | '.$this->title;
			$data['description'] = tag_key('site_desc');
			$data['keywords'] = tag_key('site_keys');
			$data['email'] = '';
			
			if (isset($_POST['submit'])){
				
				//cek ip
				$cek_info   = cek_info();
				$cekip      = $this->model_app->view_where('user_agent',['ip'=>$cek_info['ip']]);
				$email_user = $this->input->post('email_user');
				$password   = $this->input->post('pass_user');
				$cek        = $this->model_data->cek_user($email_user);
				$total      = $cek->num_rows();
				
				if ($total > 0){
					$sid_baru = session_id();
					$row = $cek->row_array();
					$hash = $row['password'];
					if (password_verify($password, $hash)) {
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
						
						redirect('home');
						}else{
						$this->model_data->fail_record($email_user);
						echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Username atau Password Salah!!</center></div>');
						$data['title'] = 'Username atau Password salah!';
						$this->load->view('auth/sign-in', $data);
					}
					}else{
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Username atau Password Salah!!</center></div>');
					$data['title'] = 'username salah atau akun anda sedang diblokir';
					$this->load->view('auth/sign-in', $data);
				}
				}else{
				if ($this->session->level!=''){
					redirect('home');
					}else{
					$this->load->view('auth/sign-in', $data);
				}
			}
		}
		public function logout(){
			$this->session->sess_destroy();
			redirect('auth');
		}
	}			