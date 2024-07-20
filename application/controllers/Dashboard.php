<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Dashboard extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			
			
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
			
			$data['row'] = $this->model_app->view_where('rb_psb_daftar',$where)->row_array();
			$this->load->view('frontend/form_status',$data);
			
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
				
				$biaya = $this->model_app->view_where('kelas_siswa',['idKelas'=>$id])->row();
				
				$response = ['id'=>rprp($biaya->biaya_daftar_baru),
				'name'=>rprp($biaya->biaya_daftar_baru)
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
				
				$result = $this->model_app->view_where_ordering('t_districts',['regency_id'=>$id],'id','ASC')->result();
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
				
				$result = $this->model_app->view_where_ordering('t_villages',['district_id'=>$id],'id','ASC')->result();
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
				$id = $this->input->post('id',true);
				
				$response['status'] ='success';
				$response['data'] = ['nis'=>123,
				'nisn'=>323,
				'nama'=>'nama',
				'gender'=>'Laki-laki',
				'tempatLahir'=>'tempatLahir',
				'tanggalLahir'=>'tanggalLahir',
				'pondok'=>'pondok',
				'namaAyah'=>'namaAyah',
				'namaIbu'=>'namaIbu',
				'dusun'=>'dusun',
				'provinsi'=>36,
				'kabupaten'=>3673,
				'kecamatan'=>3673010,
				'kelurahan'=>3673010001,
				];
				
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function proses()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				// dump($_FILES);
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
					if(!empty($_FILES['fotoSantri']['name']))
					{
						$new_name = $nik.'_'.$_FILES["fotoSantri"]['name'];
						$config['file_name']        = $new_name;
						$config['upload_path']   = './upload/lampiran'; //path folder
						$config['max_size']		 = 2048;
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
							$response['msg'] = $this->upload->display_errors();
							$this->thm->json_output($response);
						}
						}else{
						$response['status'] = false;
						$response['msg'] = 'Foto santri mash kosong';
						$this->thm->json_output($response);
					}
					//foto KK
					if(!empty($_FILES['fotoKk']['name']))
					{
						$new_name = $nik.'_'.$_FILES["fotoKk"]['name'];
						$config['file_name']        = $new_name;
						$config['upload_path']   = './upload/lampiran'; //path folder
						$config['max_size']		 = 2048;
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
							$response['msg'] = $this->upload->display_errors();
							$this->thm->json_output($response);
						}
						}else{
						$response['status'] = false;
						$response['msg'] = 'Foto KK mash kosong';
						$this->thm->json_output($response);
					}
					
					//foto bukti transfer
					if(!empty($_FILES['fotobukti']['name']))
					{
						$new_name = $nik.'_'.time().'_'.$_FILES["fotobukti"]['name'];
						$config['file_name']        = $new_name;
						$config['upload_path']   = './upload/foto_dokumen'; //path folder
						$config['max_size']		 = 2048;
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
							$response['msg'] = $this->upload->display_errors();
							$this->thm->json_output($response);
						}
						}else{
						$response['status'] = false;
						$response['msg'] = 'Foto KK mash kosong';
						$this->thm->json_output($response);
					}
					
					$this->upload->initialize($config);
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
					"unit_sekolah"                => $this->input->post('unit_sekolah',true),
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
					"nomor_hp"                    => $this->input->post('nomor_hp',true),
					"no_hp_alternatif"            => $this->input->post('thnakademik',true),
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
					
					$nama = $this->input->post('nama',true);
					$nomor = $this->input->post('nomor_hp',true);
					$nik = $this->input->post('nik',true);
					
					$nama_kamar = $this->input->post('kamar',true);
					$kuota = $this->kuota_kamar($nama_kamar);
					
					$kuota = $kuota-1;
					
					$update_kuota = ['kuota'=>$kuota]; 
					
					
					
					$input = $this->model_app->input('rb_psb_daftar',$input_data);
					if($input['status']==true)
					{
						$this->model_app->update('rb_kamar',$update_kuota,['nama_kamar'=>$nama_kamar]);
						$this->send_notif($nama,$nomor,$nik);
						$response['status'] = true;
						$response['amount'] = $biaya;
						$response['nik'] = $this->input->post('nik',true);
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
		
		
		private function send_notif($nama,$nomor,$nik)
		{
			$content = $this->model_app->view('rb_psb_notifikasi')->row()->content;
			$pesan=str_replace("@NAMA_PENDAFTAR",$nama,$content);
			$pesan1=str_replace("@KODE_DAFTAR",$nik,$pesan);
			$curl = curl_init();
			
			curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.fonnte.com/send',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array(
			'target' => $nomor,
			'message' => $pesan1,
			'url' => 'https://md.fonnte.com/images/wa-logo.png',
			'filename' => 'filename',
			'schedule' => 1,
			'typing' => false,
			'delay' => '2',
			'countryCode' => '62',
			'followup' => 0,
			),
			
			//kwk5UKBV25Du6R5AsXC-
			//yVe9otFTBSRkwRtTj3-U
			CURLOPT_HTTPHEADER => array(
			'Authorization: kwk5UKBV25Du6R5AsXC-'
			),
			));
			
			$response = curl_exec($curl);
			if (curl_errno($curl)) {
				$error_msg = curl_error($curl);
			}
			curl_close($curl);
			
			// if (isset($error_msg)) {
			// echo $error_msg;
			// }
			// echo $response;
		}
		
		function _create_foto($nik,$file_name){
			// Image resizing config
			$config = array(
			
			// Image Small
			array(
			'image_library' => 'GD2',
			'source_image'  => './upload/lampiran/'.$file_name,
			'maintain_ratio'=> FALSE,
			'width'         => 300,
			'height'        => 400,
			'new_image'     => './upload/lampiran/foto_300x400_'.$nik.'_'.$file_name
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
			'source_image'  => './upload/lampiran/'.$file_name,
			'maintain_ratio'=> FALSE,
			'width'         => 1024,
			'height'        => 576,
			'new_image'     => './upload/lampiran/kk_1024x576_'.$nik.'_'.$file_name
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
		
	}
