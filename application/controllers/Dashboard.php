<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	use PHPUnit\Util\Json;
	use Curl\Curl;
	
	use Brick\PhoneNumber\PhoneNumber;
	use Brick\PhoneNumber\PhoneNumberParseException;
	use Brick\PhoneNumber\PhoneNumberFormat;
	
	class Dashboard extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->curl = new Curl();
			$this->load->model('model_formulir');
			$this->title = tag_key('site_title');
		}
		
		public function index()
		{
			
			$data = [
			'title'=>tag_key('site_title'),
			'description'=>tag_key('site_desc'),
			'keywords'=>tag_key('site_keys'),
			'menu'=>$this->model_data->get_categories()
			];
			
			$this->thm->load('frontend/template','frontend/home',$data);
		}
		
		public function syarat()
		{
			$this->thm->set('title', 'Syarat Pendaftaran | '. tag_key('site_title'));
			$this->thm->set('description', tag_key('site_desc'));
			$this->thm->set('keywords', tag_key('site_keys'));
			
			$data['tahun'] = $this->model_app->view_where('rb_tahun_akademik',['aktif'=>'Ya'])->row_array();
			$data['row'] = $this->model_app->view_where('rb_pages',['seo'=>'syarat','aktif'=>'Ya'])->row();
			$data['menu'] = $this->model_data->get_categories();
			
			// dump($data['provinsi']);
			$this->thm->load('frontend/template','frontend/syarat',$data);
		}
		
		public function formulir()
		{
			$this->thm->set('title', 'Formulir Pendaftaran | '. tag_key('site_title'));
			$this->thm->set('description', tag_key('site_desc'));
			$this->thm->set('keywords', tag_key('site_keys'));
			$data['menu'] = $this->model_data->get_categories();
			$data['tahun'] = $this->model_app->view_where('rb_tahun_akademik',['aktif'=>'Ya'])->row_array();
			$data['unit_sekolah'] = $this->model_app->view_ordering_distinct('rb_unit','id,nama_jurusan','id','ASC')->result_array();
			$data['kamar'] = $this->model_app->view_ordering('rb_kamar','nama_kamar','ASC')->result_array();
			$data['provinsi'] = $this->model_app->view_ordering('t_provinces','name','ASC')->result_array();
			$data['pendidikan'] = $this->model_app->view_where('rb_pendidikan',['aktif'=>'Ya'])->result();
			$data['pekerjaan'] = $this->model_app->view_where('rb_pekerjaan',['aktif'=>'Ya'])->result();
			
			$this->thm->load('frontend/template','frontend/formulir',$data);
		}
		
		public function status()
		{
			$this->thm->set('title', 'Cek Status | '. tag_key('site_title'));
			$this->thm->set('description', tag_key('site_desc'));
			$this->thm->set('keywords', tag_key('site_keys'));
			$data['tahun'] = $this->model_app->view_where('rb_tahun_akademik',['aktif'=>'Ya'])->row_array();
			
			$data['menu'] = $this->model_data->get_categories();
			// dump($data['provinsi']);
			$this->thm->load('frontend/template','frontend/status',$data);
		}
		
		public function brosur()
		{
			$this->thm->set('title', 'Brosur | '.tag_key('site_title'));
			$this->thm->set('description', tag_key('site_desc'));
			$this->thm->set('keywords', tag_key('site_keys'));
			$data['brosur'] = $this->model_app->view_where_ordering('rb_psb_brosur',['aktif'=>'Ya'],'id','desc')->result();
			
			$data['menu'] = $this->model_data->get_categories();
			$this->thm->load('frontend/template','frontend/brosur',$data);
		}
		
		public function contact()
		{
			$this->thm->set('title', 'Kontak | '.tag_key('site_title'));
			$this->thm->set('description', tag_key('site_desc'));
			$this->thm->set('keywords', tag_key('site_keys'));
			$data['tahun'] = $this->model_app->view_where('rb_tahun_akademik',['aktif'=>'Ya'])->row_array();
			$data['panitia'] = $this->model_app->view_where('rb_panitia_ppdb',['aktif'=>'Ya'])->result();
			
			$data['menu'] = $this->model_data->get_categories();
			// dump($data['provinsi']);
			$this->thm->load('frontend/template','frontend/contact',$data);
		}
		
		public function cek_status()
		{
			// dump($_POST);
			$kode_daftar = $this->input->post('kode_daftar',true);
			$tanggal_lahir = $this->input->post('tanggal_lahir',true);
			
			$where = ['kode_daftar'=>$kode_daftar,'tanggal_lahir'=>$tanggal_lahir];
			
			$query = $this->model_app->view_where('rb_psb_daftar',$where);
			if($query->num_rows() > 0){
				$data['row'] = $query->row_array();
				$this->load->view('frontend/form_status',$data);
				}else{
				$this->load->view('frontend/form_status_error');
			}
			
		}
		
		public function update_lampiran()
		{
			// dump($_FILES);
			if ( $this->input->is_ajax_request() ) 
			{
				$postid = decrypt_url($this->input->post('id',TRUE));
				$type = $this->input->post('type',TRUE);
				$data = [];
				if($type=='slip'){
					if(!empty($_FILES['file']['name']))
					{
						$config['upload_path']   = './upload/foto_dokumen'; //path folder
						$config['max_size']		 = tag_key('file_size');
						$config['allowed_types'] = 'jpg|png|jpeg'; //type yang image yang dizinkan
						$config['encrypt_name']  = TRUE; //enkripsi nama file
						$this->upload->initialize($config);
						if ($this->upload->do_upload('file'))
						{
							$gbr = $this->upload->data();
							$gambar = $gbr['file_name'];
							$data = array(
							'foto'     => $gambar
							);
							}else{
							$response['status'] = false;
							$response['title'] = 'Upload Error';
							$response['msg'] = $this->upload->display_errors();
							$this->thm->json_output($response);
						}
						}else{
						$response['status'] = false;
						$response['msg'] = 'Foto masih kosong';
						$this->thm->json_output($response);
					}
					$data_post 	= ["fotobukti"	=> $gambar];
					$update = $this->model_app->update('rb_psb_daftar',$data_post, ['id'=>$postid]);
					if($update['status']=='ok')
					{
						$response = [
						'status'=>true,
						'title' =>'Update Bukti Transfer',
						'msg'   =>'Data berhasil diupdate',
						'data'   =>$data,
						'image'   =>base_url().'upload/foto_dokumen/'.$gambar.'?v='.time()
						];
					}
					else
					{
						$response = [
						'status'=>false,
						'title' =>'Update data',
						'msg'   =>'Data gagal diupdate'
						];
					}
				}
				if($type=='santri'){
					if(!empty($_FILES['file']['name']))
					{
						$config['upload_path']   = './upload/foto_dokumen'; //path folder
						$config['max_size']		 = tag_key('file_size');
						$config['allowed_types'] = 'jpg|png|jpeg'; //type yang image yang dizinkan
						$config['encrypt_name']  = TRUE; //enkripsi nama file
						$this->upload->initialize($config);
						if ($this->upload->do_upload('file'))
						{
							$gbr = $this->upload->data();
							$gambar = $gbr['file_name'];
							$data = array(
							'foto'     => $gambar
							);
							}else{
							$response['status'] = false;
							$response['title'] = 'Upload Error';
							$response['msg'] = $this->upload->display_errors();
							$this->thm->json_output($response);
						}
						}else{
						$response['status'] = false;
						$response['msg'] = 'Foto masih kosong';
						$this->thm->json_output($response);
					}
					$data_post 	= ["foto"	=> $gambar];
					$update = $this->model_app->update('rb_psb_daftar',$data_post, ['id'=>$postid]);
					if($update['status']=='ok')
					{
						$response = [
						'status'=>true,
						'title' =>'Update Foto Santri',
						'msg'   =>'Data berhasil diupdate',
						'data'   =>$data,
						'image'   =>base_url().'upload/foto_dokumen/'.$gambar.'?v='.time()
						];
					}
					else
					{
						$response = [
						'status'=>false,
						'title' =>'Update data',
						'msg'   =>'Data gagal diupdate'
						];
					}
				}
				
				if($type=='foto_kk'){
					if(!empty($_FILES['file']['name']))
					{
						$config['upload_path']   = './upload/foto_dokumen'; //path folder
						$config['max_size']		 = tag_key('file_size');
						$config['allowed_types'] = 'jpg|png|jpeg'; //type yang image yang dizinkan
						$config['encrypt_name']  = TRUE; //enkripsi nama file
						$this->upload->initialize($config);
						if ($this->upload->do_upload('file'))
						{
							$gbr = $this->upload->data();
							$gambar = $gbr['file_name'];
							$data = array(
							'foto'     => $gambar
							);
							}else{
							$response['status'] = false;
							$response['title'] = 'Upload Error';
							$response['msg'] = $this->upload->display_errors();
							$this->thm->json_output($response);
						}
						}else{
						$response['status'] = false;
						$response['msg'] = 'Foto masih kosong';
						$this->thm->json_output($response);
					}
					$data_post 	= ["foto_kk"	=> $gambar];
					$update = $this->model_app->update('rb_psb_daftar',$data_post, ['id'=>$postid]);
					if($update['status']=='ok')
					{
						$response = [
						'status'=>true,
						'title' =>'Update Foto KK',
						'msg'   =>'Data berhasil diupdate',
						'data'   =>$data,
						'image'   =>base_url().'upload/foto_dokumen/'.$gambar.'?v='.time()
						];
					}
					else
					{
						$response = [
						'status'=>false,
						'title' =>'Update data',
						'msg'   =>'Data gagal diupdate'
						];
					}
				}
				if($type=='surat'){
					if(!empty($_FILES['file']['name']))
					{
						$config['upload_path']   = './upload/foto_dokumen'; //path folder
						$config['max_size']		 = tag_key('file_size');
						$config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx'; //type yang image yang dizinkan
						$config['encrypt_name']  = TRUE; //enkripsi nama file
						$this->upload->initialize($config);
						if ($this->upload->do_upload('file'))
						{
							$gbr = $this->upload->data();
							$gambar = $gbr['file_name'];
							$data = array(
							'foto'     => $gambar
							);
							}else{
							$response['status'] = false;
							$response['title'] = 'Upload Error';
							$response['msg'] = $this->upload->display_errors();
							$this->thm->json_output($response);
						}
						}else{
						$response['status'] = false;
						$response['msg'] = 'Foto masih kosong';
						$this->thm->json_output($response);
					}
					$data_post 	= ["surat"	=> $gambar];
					$update = $this->model_app->update('rb_psb_daftar',$data_post, ['id'=>$postid]);
					if($update['status']=='ok')
					{
						$response = [
						'status'=>true,
						'title' =>'Update Lampiran Surat',
						'msg'   =>'Data berhasil diupdate',
						'data'   =>$data,
						'image'   =>base_url().'upload/nodok.jpg?v='.time()
						];
					}
					else
					{
						$response = [
						'status'=>false,
						'title' =>'Update data',
						'msg'   =>'Data gagal diupdate'
						];
					}
				}
				$this->thm->json_output($response);
			}
		}
		
		public function kelas()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id = $this->input->post('id',true);
				$status = $this->input->post('status',true);
				if($status=='Baru'){
					$where = ['id_unit'=>$id,'aktif'=>'Ya','status'=>1];
					}else{
					$where = ['id_unit'=>$id];
				}
				$kelas = $this->model_app->view_where_ordering('rb_kelas',$where,'nama_kelas','ASC')->result();
				$response = [];
				foreach($kelas AS $val)
				{
					$response[] = ['id'=>$val->id,
					'name'=>$val->kode_kelas
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		
		public function biaya()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id = $this->input->post('id',true);
				$id_unit = $this->input->post('id_unit',true);
				
				$biaya = $this->model_app->view_where('rb_unit',['id'=>$id_unit])->row();
				
				$response = ['id'=>rprp($biaya->biaya_pendaftaran),
				'name'=>rprp($biaya->biaya_pendaftaran)
				];
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function load_kamar()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id = $this->input->post('id',true);
				$gender = $this->input->post('gender',true);
				$kamar = $this->model_app->view_where('rb_kamar',['id_unit'=>$id,'gender'=>$gender,'aktif'=>'Ya'])->result();
				// dump($kamar);
				foreach($kamar AS $val){
					$response[] = ['id'=>($val->nama_kamar),
					'name'=>($val->nama_kamar)
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function kamar()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id = $this->input->post('id',true);
				
				$biaya = $this->model_app->view_where('rb_kamar',['nama_kamar'=>$id])->row();
				
				$response = ['id'=>($biaya->kuota),
				'name'=>($biaya->kuota)
				];
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		
		public function provinsi()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				
				$result = $this->model_app->view_where_ordering('t_provinces',['status'=>0],'name','ASC')->result();
				$response = [];
				foreach($result AS $val)
				{
					$response[] = ['id'=>$val->id,
					'name'=>$val->name
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function get_provinsi()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id = $this->input->post('id',true);
				
				$result = $this->model_app->view_where_ordering('t_provinces',['id'=>$id],'id','ASC')->result();
				$response = [];
				foreach($result AS $val)
				{
					$response[] = ['id'=>$val->id,
					'name'=>$val->name
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function kabupaten()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id = $this->input->post('id',true);
				
				$result = $this->model_app->view_where_ordering('t_regencies',['province_id'=>$id],'id','ASC')->result();
				$response = [];
				foreach($result AS $val)
				{
					$response[] = ['id'=>$val->id,
					'name'=>$val->name
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function kabupatens($id)
		{
			if ( $this->input->is_ajax_request() ) 
			{
				// $id = $this->input->post('id',true);
				
				$result = $this->model_app->view_where_ordering('t_regencies',['province_id'=>$id],'id','ASC')->result();
				$response = [];
				foreach($result AS $val)
				{
					$response[] = ['id'=>$val->id,
					'text'=>$val->name
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		
		public function kecamatan()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id = $this->input->post('id',true);
				
				$result = $this->model_app->view_where_ordering('t_districts',['regency_id'=>$id],'name','ASC')->result();
				$response = [];
				foreach($result AS $val)
				{
					$response[] = ['id'=>$val->id,
					'name'=>$val->name
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		
		public function desa()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id = $this->input->post('id',true);
				
				$result = $this->model_app->view_where_ordering('t_villages',['district_id'=>$id],'name','ASC')->result();
				$response = [];
				foreach($result AS $val)
				{
					$response[] = ['id'=>$val->id,
					'name'=>$val->name
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function santri()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$nis = $this->input->post('nis',true);
				$namaIbu = $this->input->post('namaIbu',true);
				$tanggalLahir = $this->input->post('tanggalLahir',true);
				$post = $this->input->post();
				$where = [
				'nisSiswa'=>$nis,
				'nmOrtu'=>$namaIbu,
				];
				
				$query = $this->model_app->view_where('siswa',$where);
				if($query->num_rows()> 0){
					$row = $query->row();
					
					
					if($row->jkSiswa=='L'){
						$gender = 'Laki-laki';
						}else{
						$gender = 'Perempuan';
					}
					
					$response['status'] ='success';
					$response['data'] = [
					'nis'         =>$nis,
					'nisn'        =>$row->nisnSiswa,
					'nama'        =>$row->nmSiswa,
					'gender'      =>$gender,
					'tempatLahir' =>'tempatLahir',
					'tanggalLahir'=>$tanggalLahir,
					'pondok'      =>'pondok',
					'namaAyah'    =>$row->nmOrtu,
					'namaIbu'     =>'namaIbu',
					'dusun'       =>'dusun',
					'provinsi'    =>36,
					'kabupaten'   =>3673,
					'kecamatan'   =>3673010,
					'kelurahan'   =>3673010001,
					];
					
					}else{
					$response['status'] ='error';
					$response['message'] ='Data tidak ditemukan';
				}
				
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function proses()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				
				$this->form_validation->set_rules(array(
				array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|trim|min_length[10]|is_unique[rb_psb_daftar.email]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 10 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				array(
				'field' => 'nik',
				'label' => 'NIK',
				'rules' => 'required|trim|numeric|min_length[16]|max_length[16]|is_unique[rb_psb_daftar.nik]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'numeric' => '%s. Harus angka',
				'min_length' => '%s minimal 16 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				
				array(
				'field' => 'nisn',
				'label' => 'NISN',
				'rules' => 'required|trim|numeric|min_length[10]|max_length[10]|is_unique[rb_psb_daftar.nisn]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 10 digit.',
				'numeric' => '%s Harus angka.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				array(
				'field' => 'no_kk',
				'label' => ' Nomor Kartu Keluarga ',
				'rules' => 'required|trim|numeric|min_length[16]|max_length[16]|is_unique[rb_psb_daftar.no_kk]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'numeric' => '%s. Harus angka',
				'min_length' => '%s minimal 16 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				
				array(
				'field' => 'nik_ayah',
				'label' => ' NIK Ayah',
				'rules' => 'required|trim|numeric|min_length[16]|max_length[16]|is_unique[rb_psb_daftar.nik_ayah]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'numeric' => '%s. Harus angka',
				'min_length' => '%s minimal 16 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				
				array(
				'field' => 'nik_ibu',
				'label' => ' NIK Ibu',
				'rules' => 'required|trim|numeric|min_length[16]|max_length[16]|is_unique[rb_psb_daftar.nik_ibu]',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'numeric' => '%s. Harus angka',
				'min_length' => '%s minimal 16 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				
				));
				
				if ( $this->form_validation->run() ) 
				{
					$nik = $this->input->post('nik',true);
					$nik_ayah = $this->input->post('nik_ayah',true);
					$nik_ibu = $this->input->post('nik_ibu',true);
					$tanggal_lahir = $this->input->post('tanggal_lahir',true);
					$cek_nik = cek_nik($nik,$nik_ayah,$nik_ibu);
					if($cek_nik['status']===true){
						$response['status'] = false;
						$response['message'] = $cek_nik['msg'];
						$this->thm->json_output($response);
					}
					$selisih_tgl = usia_daftar($tanggal_lahir,tanggal());
					// dump($selisih_tgl);
					if(!empty($_FILES['fotoSantri']['name']))
					{
						$new_name = $nik.'_'.$_FILES["fotoSantri"]['name'];
						$config['file_name']        = $new_name;
						$config['upload_path']   = './upload/foto_dokumen'; //path folder
						$config['max_size']		 = tag_key('file_size');
						$config['allowed_types'] = 'jpg|png|jpeg'; //type yang image yang dizinkan
						$config['encrypt_name']  = FALSE; //enkripsi nama file
						$this->upload->initialize($config);
						if ($this->upload->do_upload('fotoSantri'))
						{
							$gbr = $this->upload->data();
							$photo_santri = $gbr['file_name'];
							$this->_create_foto($nik,$gbr['file_name']);
							}else{
							$response['status'] = false;
							$response['message'] = $this->upload->display_errors();
							$this->thm->json_output($response);
						}
						}else{
						$response['status'] = false;
						$response['message'] = 'Foto santri mash kosong';
						$this->thm->json_output($response);
					}
					//foto KK
					if(!empty($_FILES['fotoKk']['name']))
					{
						$new_name = $nik.'_'.$_FILES["fotoKk"]['name'];
						$config['file_name']        = $new_name;
						$config['upload_path']   = './upload/foto_dokumen'; //path folder
						$config['max_size']		 = tag_key('file_size');
						$config['allowed_types'] = 'jpg|png|jpeg'; //type yang image yang dizinkan
						$config['encrypt_name']  = FALSE; //enkripsi nama file
						$this->upload->initialize($config);
						if ($this->upload->do_upload('fotoKk'))
						{
							$gbr = $this->upload->data();
							$photo_kk = $gbr['file_name'];
							$this->_create_kk($nik,$gbr['file_name']);
							}else{
							$response['status'] = false;
							$response['message'] = $this->upload->display_errors();
							$this->thm->json_output($response);
						}
						}else{
						$response['status'] = false;
						$response['message'] = 'Foto KK mash kosong';
						$this->thm->json_output($response);
					}
					
					//foto bukti transfer
					if(!empty($_FILES['fotobukti']['name']))
					{
						$new_name = $nik.'_'.time().'_'.$_FILES["fotobukti"]['name'];
						$config['file_name']        = $new_name;
						$config['upload_path']   = './upload/foto_dokumen'; //path folder
						$config['max_size']		 = tag_key('file_size');
						$config['allowed_types'] = 'jpg|png|jpeg'; //type yang image yang dizinkan
						$config['file_ext_tolower'] = TRUE;
						$config['encrypt_name']  = FALSE;
						$this->upload->initialize($config);
						if ($this->upload->do_upload('fotobukti'))
						{
							$gbr = $this->upload->data();
							$lampiran = $gbr['file_name'];
							}else{
							$response['status'] = false;
							$response['message'] = $this->upload->display_errors();
							$this->thm->json_output($response);
						}
						}else{
						$response['status'] = false;
						$response['message'] = 'Foto KK mash kosong';
						$this->thm->json_output($response);
					}
					$nama_unit = $this->model_formulir->nama_unit_byid($this->input->post('unit_sekolah',true));
					$full_phone = $this->input->post('full_phone');
					$full_phone_country = $this->input->post('full_phone_country');
					$number = PhoneNumber::parse($full_phone);
					$nomor_personal = $number->format(PhoneNumberFormat::NATIONAL); // 044 668 18 00
					
					
					$input_data = [
					"kode_daftar"              	  => $this->input->post('nik',true),
					"tahun_akademik"              => $this->input->post('thnakademik',true),
					"email"                       => $this->input->post('email',true),
					"nama"                        => $this->input->post('nama',true),
					"jenis_kelamin"               => $this->input->post('jenis_kelamin',true),
					"tempat_lahir"                => $this->input->post('tempat_lahir',true),
					"tanggal_lahir"               => $this->input->post('tanggal_lahir',true),
					"nik"                         => $this->input->post('nik',true),
					"saudara_pp"                  => $this->input->post('saudara_pp',true),
					"status_keluarga"             => $this->input->post('status_keluarga',true),
					"anak_ke"                     => $this->input->post('anak_ke',true),
					"dari"                        => $this->input->post('dari',true),
					"s_pendidikan"                => $this->input->post('s_pendidikan',true),
					"id_unit"                	  => $this->input->post('unit_sekolah',true),
					"unit_sekolah"                => $nama_unit,
					"kelas"                       => $this->input->post('kelas',true),
					"biaya_daftar"                => convert_to_number($this->input->post('biaya',true)),
					"status_sekolah"              => $this->input->post('status_sekolah',true),
					"kamar"                       => $this->input->post('kamar',true),
					"ijasah_terakhir"             => $this->input->post('ijasah_terakhir',true),
					"nama_sekolah_asal"           => $this->input->post('nama_sekolah_asal',true),
					"alamat_sekolah"              => $this->input->post('alamat_sekolah',true),
					"nisn"                        => $this->input->post('nisn',true),
					"no_kip"                      => $this->input->post('no_kip',true),
					"no_kk"                       => $this->input->post('no_kk',true),
					"nama_ayah"                   => $this->input->post('nama_ayah',true),
					"nik_ayah"                    => $this->input->post('nik_ayah',true),
					"kondisi_ayah"                => $this->input->post('kondisi_ayah',true),
					"pendidikan_terakhir_ayah"    => $this->input->post('pendidikan_terakhir_ayah',true),
					"pekerjaan_ayah"              => $this->input->post('pekerjaan_ayah',true),
					"nama_ibu"                    => $this->input->post('nama_ibu',true),
					"nik_ibu"                     => $this->input->post('nik_ibu',true),
					"kondisi_ibu"                 => $this->input->post('kondisi_ibu',true),
					"pendidikan_terakhir_ibu"     => $this->input->post('pendidikan_terakhir_ibu',true),
					"pekerjaan_ibu"               => $this->input->post('pekerjaan_ibu',true),
					"penghasilan_ortu"            => $this->input->post('penghasilan_ortu',true),
					"nomor_hp"                    => clean($nomor_personal),
					"no_hp_alternatif"            => clean($this->input->post('thnakademik',true)),
					"alamat"                      => $this->input->post('alamat',true),
					"rt"                          => $this->input->post('rt',true),
					"rw"                          => $this->input->post('rw',true),
					"dusun"                       => $this->input->post('dusun',true),
					"kode_pos"                    => $this->input->post('kode_pos',true),
					"provinsi"                    => $this->input->post('prov',true),
					"kabupaten"                   => $this->input->post('kab',true),
					"kecamatan"				      => $this->input->post('kec',true),
					"kelurahan"                   => $this->input->post('kel',true),
					"jenis_penyakit"              => $this->input->post('jenis_penyakit',true),
					"sejak"                       => $this->input->post('sejak',true),
					"tindakan_pengobatan"         => $this->input->post('tindakan_pengobatan',true),
					"kondisi_sekarang"            => $this->input->post('kondisi_sekarang',true),
					"ukuran_seragam_baju"         => $this->input->post('ukuran_seragam_baju',true),
					"ukuran_celana_rok"           => $this->input->post('ukuran_celana_rok',true),
					"foto"        			      => $photo_santri,
					"foto_kk"        		      => $photo_kk,
					"fotobukti"       		      => $lampiran
					];
					$biaya=convert_to_number($this->input->post('biaya',true));
					
					$post = $this->input->post();
					$nama = $this->input->post('nama',true);
					$nomor = $this->input->post('nomor_hp',true);
					$nik = $this->input->post('nik',true);
					
					$nama_kamar = $this->input->post('kamar',true);
					$kuota = $this->kuota_kamar($nama_kamar);
					
					$kuota = $kuota-1;
					
					$kuota_terpakai = $this->kuota_terpakai($nama_kamar);
					$kuota_terpakai = $kuota_terpakai + 1;
					$update_kuota = ['kuota'=>$kuota,'terpakai'=>$kuota_terpakai]; 
					
					
					
					$input = $this->model_app->input('rb_psb_daftar',$input_data);
					if($input['status']==true)
					{
						
						$this->model_app->update('rb_kamar',$update_kuota,['nama_kamar'=>$nama_kamar]);
						$this->send_notif($post);
						$response['status'] = true;
						$response['nik'] = $this->input->post('nik',true);
						$response['message'] = 'Berhasil';
						}else{
						$response['status'] = false;
						$response['message'] = 'Gagal';
					}
					// dump($input_data);
					$this->thm->json_output($response);
				}
				else
				{
					$response['status'] = false;
					$response['type'] = 'error';
					$response['message']= validation_errors();
					$this->thm->json_output($response);
				}
			}
		}
		
		private function kuota_kamar($id)
		{
			
			$kuota = $this->model_app->view_where('rb_kamar',['nama_kamar'=>$id])->row();
			$response =$kuota->kuota;
			return $response;	
		}
		private function kuota_terpakai($id)
		{
			
			$kuota = $this->model_app->view_where('rb_kamar',['nama_kamar'=>$id])->row();
			$response =$kuota->terpakai;
			return $response;	
		}
		
		private function send_notif($post)
		{
			$token = $this->model_formulir->get_token()->token;
			$isi_pesan = $this->model_formulir->get_pesan_pendaftaran($post);
			$data_send = array(
			'target' => $post['nomor_hp'],
			'message' => $isi_pesan,
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
				$this->report_pesan($response,$isi_pesan,$post['nik']);
			}
		}
		
		private function report_pesan($response,$message,$id)
		{
			$device = $this->model_formulir->get_token()->device;
			foreach($response["id"] as $k=>$v){
				$target = $response["target"][$k];
				$process = $response["process"];
				$status = $response["status"];
				$data = ['id_kirim'=>$v,'nik_pendaftar'=>$id,'device'=>$device,'target'=>$target,'message'=>$message,'status'=>$process,'create_date'=>date('Y-m-d')];
				if($status==true){
					$this->model_app->input('rb_report_pesan',$data);
				}
				// dump($data);
			}
			
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
		
		function _create_foto($nik,$file_name){
			// Image resizing config
			$config = array(
			
			// Image Small
			array(
			'image_library' => 'GD2',
			'source_image'  => './upload/foto_dokumen/'.$file_name,
			'maintain_ratio'=> FALSE,
			'width'         => 300,
			'height'        => 400,
			'new_image'     => './upload/foto_dokumen/foto_300x400_'.$nik.'_'.$file_name
			));
			
			$this->load->library('image_lib', $config[0]);
			foreach ($config as $item){
				$this->image_lib->initialize($item);
				if(!$this->image_lib->resize())
				{
					return false;
				}
				$this->image_lib->clear();
			}
		}
		
		function _create_kk($nik,$file_name){
			// Image resizing config
			$config = array(
			array(
			'image_library' => 'GD2',
			'source_image'  => './upload/foto_dokumen/'.$file_name,
			'maintain_ratio'=> FALSE,
			'width'         => 1024,
			'height'        => 576,
			'new_image'     => './upload/foto_dokumen/kk_1024x576_'.$nik.'_'.$file_name
			)
			);
			
			$this->load->library('image_lib', $config[0]);
			foreach ($config as $item){
				$this->image_lib->initialize($item);
				if(!$this->image_lib->resize())
				{
					return false;
				}
				$this->image_lib->clear();
			}
		}
		
		function print_dokumen($id=""){
			
			$data['title'] = 'Print Formulir | '.$this->title;
			$query = $this->model_app->view_where('rb_psb_daftar',['nik'=>decrypt_url($id)]);
			if($query->num_rows() > 0){
				$data['s'] = $query->row_array();
				$this->load->view('backend/pendaftar/print',$data);
				// $this->thm->load('backend/template','backend/pendaftar/print',$data);
				}else{
				$this->load->view('errors/404');
			}
			
		}
	}
