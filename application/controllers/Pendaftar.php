<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	use PhpOffice\PhpSpreadsheet\IOFactory;
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Reader\Csv;
	use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
	use PHPUnit\Util\Json;
	use Curl\Curl;
	class Pendaftar extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			cek_session_login(1);
			$this->title = tag_key('site_title');
			$this->iduser = $this->session->iduser; 
            $this->level = $this->session->level; 
            $this->idlevel = $this->session->idlevel; 
			$this->load->model('model_pendaftar');
			$this->load->model('model_formulir');
			$this->curl = new Curl();
			$this->menu = $this->uri->segment(1); 
			$this->perPage = 10;
		}
		
		public function index()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Data Pendaftar | '.$this->title;
			$data['tahun'] = $this->model_app->view('rb_tahun_akademik')->result();
			$data['unit'] = $this->model_app->view_where('rb_unit',['aktif'=>'Ya'])->result();
			$data['kelas'] = $this->model_app->view_where('rb_kelas',['status'=>1,'aktif'=>'Ya'])->result();
			$data['menu'] = getMenu($this->menu);
			$status = $this->input->get();
			// if(isset($status)){
			// if(!empty($status['baru'])){
			$data['status'] = 'Baru';
			// $data['baru'] = $status['baru'];
			// }else{
			$data['baru'] = '';
			// $data['status'] = '';
			// }
			// if(!empty($status['pindahan'])){
			// $data['pindahan'] = $status['baru'];
			// $data['status'] = 'Pindahan';
			// }else{
			// $data['pindahan'] = '';
			// $data['status'] = '';
			// }
			// }else{
			// $data['baru'] = '';
			// $data['pindahan'] = '';
			// $data['status'] = '';
			// }
			
			$this->thm->load('backend/template','backend/pendaftar/view_index',$data);
		}
		
        function ajax_list()
        {
			cek_crud_akses('READ','html');
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
			
			$tahun = $this->input->post('tahun');
			if (!empty($tahun)) {
				$conditions['search']['tahun'] = $tahun;
			}
			
			$sortBy = $this->input->post('sortBy');
			if (!empty($sortBy)) {
				$conditions['search']['sortBy'] = $sortBy;
			}
			
			$status = $this->input->post('status');
			if (!empty($status)) {
				$conditions['search']['status'] = $status;
			}
			
			
			$sortUnit = $this->input->post('sortUnit');
			if (!empty($sortUnit)) {
				$conditions['search']['sortUnit'] = $sortUnit;
			}
			
			$sortKelas = $this->input->post('sortKelas');
			if (!empty($sortKelas)) {
				$conditions['search']['sortKelas'] = $sortKelas;
			}
			
			$diterima = $this->input->post('diterima');
			if (!empty($diterima)) {
				$conditions['search']['sortKelas'] = $sortKelas;
			}
			
			$conditions['where'] = ['s_pendidikan'=>'Baru'
			];
			
			// Get record count 
			$conditions['returnType'] = 'count';
			$totalRec = $this->model_pendaftar->getPendaftar($conditions);
			
			// Pagination configuration 
			$config['target']      = '#posts_content';
			$config['base_url']    = base_url('pendaftar/ajax_list');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $limit;
			$config['link_func']   = 'searchPengguna';
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config);
			
			// Get records 
			$conditions['start'] = $offset;
			$conditions['limit'] = $limit;
			
			unset($conditions['returnType']);
			$data['record'] = $this->model_pendaftar->getPendaftar($conditions);
			
			// Load the data list view 
			$this->load->view('backend/pendaftar/get-ajax',$data);
			
		}
		
		public function naik_tingkat()
		{
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Data Pendaftar | '.$this->title;
			
			$data['menu'] = getMenu($this->menu);
			$data['tahun'] = $this->model_app->view('rb_tahun_akademik')->result();
			$data['unit'] = $this->model_app->view_where('rb_unit',['aktif'=>'Ya'])->result();
			$data['kelas'] = $this->model_app->view_where('rb_kelas',['aktif'=>'Ya'])->result();
			
			
			$this->thm->load('backend/template','backend/pendaftar/view_index_naik_tingkat',$data);
		}
		
		function ajax_list_naik_tingkat()
		{
			cek_crud_akses('CONTENT','html');
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
			$tahun = $this->input->post('tahun');
			if (!empty($tahun)) {
				$conditions['search']['tahun'] = $tahun;
			}
			$sortBy = $this->input->post('sortBy');
			if (!empty($sortBy)) {
				$conditions['search']['sortBy'] = $sortBy;
			}
			
			$sortKelas = $this->input->post('sortKelas');
			if (!empty($sortKelas)) {
				$conditions['search']['sortKelas'] = $sortKelas;
			}
			$conditions['where'] = ['s_pendidikan'=>'Naik Tingkatan'];
			// Get record count 
			$conditions['returnType'] = 'count';
			$totalRec = $this->model_pendaftar->getPendaftar($conditions);
			
			// Pagination configuration 
			$config['target']      = '#posts_content';
			$config['base_url']    = base_url('pendaftar/ajax_list_naik_tingkat');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $limit;
			$config['link_func']   = 'searchData';
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config);
			
			// Get records 
			$conditions['start'] = $offset;
			$conditions['limit'] = $limit;
			
			unset($conditions['returnType']);
			$data['record'] = $this->model_pendaftar->getPendaftar($conditions);
			
			// Load the data list view 
			$this->load->view('backend/pendaftar/get-ajax',$data);
			
		}
		
		public function kelas()
		{
			
			if ( $this->input->is_ajax_request() ) 
			{
				$id = $this->input->post('id',true);
				
				$kelas = $this->model_app->view_where_ordering('rb_kelas',['id_unit'=>$id],'nama_kelas','ASC')->result();
				$response = [];
				foreach($kelas AS $val)
				{
					$response[] = ['id'=>$val->id,
					'name'=>$val->kode_kelas.' - '.$val->nama_kelas
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function load_kelas()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id = $this->input->post('id',true);
				if($id=='Baru'){
					$where = ['status'=>1,'aktif'=>'Ya'];
					}else{
					$where = ['aktif'=>'Ya'];
				}
				$kelas = $this->model_app->view_where_ordering('rb_kelas',$where,'nama_kelas','ASC')->result();
				$response = [];
				foreach($kelas AS $val)
				{
					$response[] = ['id'=>$val->id,
					'name'=>$val->kode_kelas.' - '.$val->nama_kelas
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		function edit_data(){
			
			if ($this->input->is_ajax_request()) 
			{
				cek_crud_akses('CONTENT','json');
				$id = $this->db->escape_str($this->input->post('id'));
				$index = decrypt_url($id);
				$data['tahun'] = $this->model_app->view_where('rb_tahun_akademik',['aktif'=>'Ya'])->row_array();
				
				$data['unit_sekolah'] = $this->model_app->view_ordering_distinct('rb_unit','id,nama_jurusan','id','ASC')->result_array();
				$data['kamar'] = $this->model_app->view_ordering('rb_kamar','nama_kamar','ASC')->result_array();
				$data['provinsi'] = $this->model_app->view_ordering('t_provinces','name','ASC')->result_array();
				$data['pendidikan'] = $this->model_app->view_where('rb_pendidikan',['aktif'=>'Ya'])->result();
				$data['pekerjaan'] = $this->model_app->view_where('rb_pekerjaan',['aktif'=>'Ya'])->result();
				
				$data['record'] = $this->model_app->view_where('rb_psb_daftar',['id'=>$index])->row();
				$this->load->view('backend/pendaftar/form_edit', $data, false);
			}
		}
		
		public function load_pendidikan()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$result = $this->model_app->view_where_ordering('rb_pendidikan',['aktif'=>'Ya'],'id','ASC')->result();
				$response = [];
				foreach($result AS $val)
				{
					$response[] = ['id'=>$val->id,
					'name'=>$val->title
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function load_pesan()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$result = $this->model_app->view_where_ordering('rb_template_pesan',['aktif'=>'Ya'],'id','ASC')->result();
				$response = [];
				foreach($result AS $val)
				{
					$response[] = ['id'=>$val->id,
					'name'=>$val->title
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		public function load_pekerjaan()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$result = $this->model_app->view_where_ordering('rb_pekerjaan',['aktif'=>'Ya'],'id','ASC')->result();
				$response = [];
				foreach($result AS $val)
				{
					$response[] = ['id'=>$val->id,
					'name'=>$val->title
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		public function unit_sekolah()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$result = $this->model_app->view_where_ordering('rb_unit',['aktif'=>'Ya'],'nama_jurusan','ASC')->result();
				$response = [];
				foreach($result AS $val)
				{
					$response[] = ['id'=>$val->id,
					'name'=>$val->nama_jurusan
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function load_kamar()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$result = $this->model_app->view_where_ordering('rb_kamar',['aktif'=>'Ya'],'nama_kamar','ASC')->result();
				$response = [];
				foreach($result AS $val)
				{
					$response[] = ['id'=>$val->id,
					'name'=>$val->nama_kamar
					];
				}
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function ijasah_terakhir()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id  = $this->input->post('id',TRUE);
				$result = $this->model_app->view_where('rb_psb_daftar',['id'=>$id])->row();
				
				$response= ['id'=>$id,
				'name'=>$result->ijasah_terakhir
				];
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		public function ukuran_seragam_baju()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id  = $this->input->post('id',TRUE);
				$result = $this->model_app->view_where('rb_psb_daftar',['id'=>$id])->row();
				
				$response= ['id'=>$id,
				'name'=>$result->ukuran_seragam_baju
				];
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function ukuran_celana()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id  = $this->input->post('id',TRUE);
				$result = $this->model_app->view_where('rb_psb_daftar',['id'=>$id])->row();
				
				$response= ['id'=>$id,
				'name'=>$result->ukuran_celana_rok
				];
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function penghasilan_orang_tua()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id  = $this->input->post('id',TRUE);
				$result = $this->model_app->view_where('rb_psb_daftar',['penghasilan_ortu'=>$id])->row();
				
				$response= ['id'=>$id,
				'name'=>$result->penghasilan_ortu
				];
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function status_pendaftar()
		{
			if ( $this->input->is_ajax_request() ) 
			{
				$id  = $this->input->post('id',TRUE);
				$result = $this->model_app->view_where('rb_psb_daftar',['status'=>$id])->row();
				
				$response= ['id'=>$id,
				'name'=>$result->status
				];
				
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			}
		}
		
		public function _cek_edit_email($val = '') 
		{
			$id_post = ($this->input->post('id_pendaftar') ? decrypt_url($this->input->post('id_pendaftar')) : 0);
			
			$cek = $this->model_pendaftar->cek_email($id_post, $val);
			// dump($cek);
			if ( $cek === FALSE ) 
			{
				$this->form_validation->set_message('_cek_edit_email', 'Email sudah ada');
			} 
			
			return $cek;
		}
		
		public function _cek_edit_nik($val = '') 
		{
			$id_post = ($this->input->post('id_pendaftar') ? decrypt_url($this->input->post('id_pendaftar')) : 0);
			
			$cek = $this->model_pendaftar->cek_edit_nik($id_post, $val);
			// dump($cek);
			if ( $cek === FALSE ) 
			{
				$this->form_validation->set_message('_cek_edit_nik', 'NIK sudah ada');
			} 
			
			return $cek;
		}
		
		public function _cek_edit_nisn($val = '') 
		{
			$id_post = ($this->input->post('id_pendaftar') ? decrypt_url($this->input->post('id_pendaftar')) : 0);
			
			$cek = $this->model_pendaftar->cek_edit_nisn($id_post, $val);
			// dump($cek);
			if ( $cek === FALSE ) 
			{
				$this->form_validation->set_message('_cek_edit_nisn', 'NISN sudah ada');
			} 
			
			return $cek;
		}
		
		public function _cek_edit_nokk($val = '') 
		{
			$id_post = ($this->input->post('id_pendaftar') ? decrypt_url($this->input->post('id_pendaftar')) : 0);
			
			$cek = $this->model_pendaftar->cek_edit_nokk($id_post, $val);
			// dump($cek);
			if ( $cek === FALSE ) 
			{
				$this->form_validation->set_message('_cek_edit_nokk', 'No. KK sudah ada');
			} 
			
			return $cek;
		}
		
		public function _cek_edit_nik_ayah($val = '') 
		{
			$id_post = ($this->input->post('id_pendaftar') ? decrypt_url($this->input->post('id_pendaftar')) : 0);
			
			$cek = $this->model_pendaftar->cek_edit_nik_ayah($id_post, $val);
			// dump($cek);
			if ( $cek === FALSE ) 
			{
				$this->form_validation->set_message('_cek_edit_nik_ayah', 'NIK Ayah sudah ada');
			} 
			
			return $cek;
		}
		
		public function _cek_edit_nik_ibu($val = '') 
		{
			$id_post = ($this->input->post('id_pendaftar') ? decrypt_url($this->input->post('id_pendaftar')) : 0);
			
			$cek = $this->model_pendaftar->cek_edit_nik_ibu($id_post, $val);
			// dump($cek);
			if ( $cek === FALSE ) 
			{
				$this->form_validation->set_message('_cek_edit_nik_ibu', 'NIK Ayah sudah ada');
			} 
			
			return $cek;
		}
		
		function simpan_pendaftar(){
			if ( $this->input->is_ajax_request() ) 
			{
				$id_pendaftar = decrypt_url($this->input->post('id_pendaftar',true));
				$email = $this->input->post('email',true);
				$nik = $this->input->post('nik',true);
				$nisn = $this->input->post('nisn',true);
				$no_kk = $this->input->post('no_kk',true);
				$nik_ayah = $this->input->post('nik_ayah',true);
				$nik_ibu = $this->input->post('nik_ibu',true);
				$kirim_pesan = $this->input->post('kirim_pesan',true);
				
				
				// $this->send_notif($post);
				// exit;
				// dump($_FILES);
				$this->form_validation->set_rules(array(
				array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|trim|min_length[10]|callback__cek_edit_email['.$email.']',
				'errors' => array(
				'required' => '%s. Harus di isi',
				'min_length' => '%s minimal 10 digit.',
				'is_unique'     => '%s sudah ada.'
				)
				),
				array(
				'field' => 'nik',
				'label' => 'NIK',
				'rules' => 'required|trim|numeric|min_length[16]|max_length[16]|callback__cek_edit_nik['.$nik.']',
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
				'rules' => 'required|trim|numeric|min_length[10]|max_length[10]|callback__cek_edit_nisn['.$nisn.']',
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
				'rules' => 'required|trim|numeric|min_length[16]|max_length[16]|callback__cek_edit_nokk['.$no_kk.']',
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
				'rules' => 'required|trim|numeric|min_length[16]|max_length[16]|callback__cek_edit_nik_ayah['.$nik_ayah.']',
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
				'rules' => 'required|trim|numeric|min_length[16]|max_length[16]|callback__cek_edit_nik_ibu['.$nik_ibu.']',
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
					
					$nama_unit = $this->model_pendaftar->nama_unit_byid($this->input->post('unit_sekolah',true));
					
					$input_data = [
					"kode_daftar"              	  => 'PSB-'.$this->input->post('nik',true),
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
					"nomor_hp"                    => clean($this->input->post('nomor_hp',true)),
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
					"status"           => $this->input->post('status_pendaftar',true),
					];
					// dump($input_data);
					$biaya=convert_to_number($this->input->post('biaya',true));
					
					$post = $this->input->post();
					$nama = $this->input->post('nama',true);
					$nomor = $this->input->post('nomor_hp',true);
					$nik = $this->input->post('nik',true);
					
					$nama_kamar = $this->input->post('kamar',true);
					$kuota = $this->kuota_kamar($nama_kamar);
					
					$kuota = $kuota-1;
					
					$update_kuota = ['kuota'=>$kuota]; 
					
					
					
					$input = $this->model_app->update('rb_psb_daftar',$input_data,['id'=>$id_pendaftar]);
					if($input['status']==true)
					{
						if($kirim_pesan=='Ya'){
							$this->send_notif($post);
						}
						// $this->model_app->update('rb_kamar',$update_kuota,['nama_kamar'=>$nama_kamar]);
						// $this->send_notif($post);
						$response['status'] = true;
						$response['title'] = 'Update Data';
						$response['message'] = 'Data berhasil diupdate';
						// $response['amount'] = $biaya;
						// $response['nik'] = $this->input->post('nik',true);
						}else{
						$response['status'] = false;
						$response['title'] = 'Update Data';
						$response['message'] = 'Gagal';
					}
					// dump($input_data);
					$this->thm->json_output($response);
				}
				else
				{
					$response['status'] = false;
					$response['title'] = 'Update Data';
					$response['message']= validation_errors();
					$this->thm->json_output($response);
				}
			}
		}
		
		private function send_notif($post)
		{
			$token = $this->model_formulir->get_token()->token;
			$isi_pesan = $this->model_formulir->get_pesan($post);
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
		
		private function kuota_kamar($id)
		{
			
			$kuota = $this->model_app->view_where('rb_kamar',['nama_kamar'=>$id])->row();
			$response =$kuota->kuota;
			return $response;	
		}
		
		function hapus_pendaftar(){
			cek_input_post('GET');
			
			$id = $this->db->escape_str($this->input->post('id'),true);
			$id = decrypt_url($id);
			$where = array('id' => $id);
			
			$search = $this->model_app->edit('rb_psb_daftar', $where);
			if($search->num_rows()>0){
				$row = $search->row_array();
				
				$res = $this->model_app->hapus('rb_psb_daftar',$where);
				if($res==true){
					$data = array('status'=>200,'title'=>'Hapus data','msg'=>'Data berhasil dihapus');
					}else{
					$data = array('status'=>400,'title'=>'Hapus data','msg'=>'Data gagal dihapus');
				}
				
				}else{
				$data = array('status'=>500,'msg'=>'Data gagal dihapus');
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		function download($file=""){
			$this->load->helper('download');
			$opathFile = FCPATH.'upload/foto_dokumen/'.$file;
			if(!empty($id)){
				$size = @filesize($opathFile);
				if($size !== false){
					force_download($opathFile, NULL);
					}else{
					$data['title'] = 'File tidak ditemukan | '.$this->title;
					$this->thm->load('backend/template','backend/blank_file',$data);
				}
				}else{
				$data['title'] = 'File tidak ditemukan | '.$this->title;
				$this->thm->load('backend/template','backend/blank',$data);
			}
		}
		function print_dokumen($id=""){
			if(!empty($id)){
				$data['title'] = 'Print Formulir | '.$this->title;
				$query = $this->model_app->view_where('rb_psb_daftar',['id'=>decrypt_url($id)]);
				if($query->num_rows() > 0){
					$data['s'] = $query->row_array();
					$this->load->view('backend/pendaftar/print',$data);
					// $this->thm->load('backend/template','backend/pendaftar/print',$data);
					}else{
					$this->thm->load('backend/template','backend/blank',$data);
				}
				}else{
				$this->thm->load('backend/template','backend/blank',$data);
			}
			
		}
		
		function export_excel()
		{
			// dumps();
			/* Data */
			$filter = $this->input->post('export');
			$data = $this->model_pendaftar->fetch_transactions();
			
			/* Spreadsheet Init */
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$style_title = [
            // Set font bold
            'font' => ['bold' => true]
		    ];
			/* Excel Header */
			$sheet->setCellValue('A1', 'DATA PENERIMAAN SANTRI BARU');
			$sheet->mergeCells('A1:G1');
			$sheet->setCellValue('A2', 'PONDOK PESANTREN TEBUIRENG 4 AL ISHLAH');
			$sheet->mergeCells('A2:G2');
			$sheet->setCellValue('A3', 'TAHUN AJARAN '.$filter);
			$sheet->mergeCells('A3:G3');
			$sheet->setCellValue('A4', 'BATANG CENAKU INDRAGIRI HULU RIAU');
			$sheet->mergeCells('A4:G4');
			
			$sheet->getStyle('A1:G1')->applyFromArray($style_title);
			$sheet->getStyle('A2:G2')->applyFromArray($style_title);
			$sheet->getStyle('A3:G3')->applyFromArray($style_title);
			$sheet->getStyle('A4:G4')->applyFromArray($style_title);
			$sheet->getStyle('A6:AY6')->applyFromArray($style_title);
			
			$sheet->setCellValue('A6','No.');
			$sheet->setCellValue('B6','Kode Daftar');
			$sheet->setCellValue('C6','Nama');
			$sheet->setCellValue('D6','NIK');
			$sheet->setCellValue('E6','No KK');
			$sheet->setCellValue('F6','Jenis Kelamin');
			$sheet->setCellValue('G6','Tempat / Tgl Lahir');
			$sheet->setCellValue('H6','Email');
			$sheet->setCellValue('I6','Anak Ke');
			$sheet->setCellValue('J6','Jumlah Saudara');
			$sheet->setCellValue('K6','Status dalam keluarga');
			$sheet->setCellValue('L6','Saudara sekandung di PP Tebuireng4');
			$sheet->setCellValue('M6','Status');
			$sheet->setCellValue('N6','Unit Sekolah');
			$sheet->setCellValue('O6','Kelas/Semester');
			$sheet->setCellValue('P6','Status di Sekolah/Kuliah');
			$sheet->setCellValue('Q6','Kamar');
			$sheet->setCellValue('R6','Ijazah Terakhir');
			$sheet->setCellValue('S6','Nama sekolah asal');
			$sheet->setCellValue('T6','Alamat sekolah asal');
			$sheet->setCellValue('U6','NISN');
			$sheet->setCellValue('V6','No KIP');
			$sheet->setCellValue('W6','Nomor Kartu Keluarga');
			$sheet->setCellValue('X6','Nama Ayah');
			$sheet->setCellValue('Y6','NIK Ayah');
			$sheet->setCellValue('Z6','Kondisi');
			$sheet->setCellValue('AA6','Pendidikan Terakhir');
			$sheet->setCellValue('AB6','Pekerjaan');
			$sheet->setCellValue('AC6','Nama Ibu');
			$sheet->setCellValue('AD6','NIK Ibu');
			$sheet->setCellValue('AE6','Kondisi');
			$sheet->setCellValue('AF6','Pendidikan Terakhir');
			$sheet->setCellValue('AG6','Pekerjaan');
			$sheet->setCellValue('AH6','Penghasilan orang tua');
			$sheet->setCellValue('AI6','Nomor Telphone');
			$sheet->setCellValue('AJ6','Nomor telfon alternatif');
			$sheet->setCellValue('AK6','RT RW');
			$sheet->setCellValue('AL6','Dusun');
			$sheet->setCellValue('AM6','Kode pos');
			$sheet->setCellValue('AN6','Alamat');
			$sheet->setCellValue('AO6','Provinsi');
			$sheet->setCellValue('AP6','Kabupaten');
			$sheet->setCellValue('AQ6','Kecamatan');
			$sheet->setCellValue('AR6','Kelurahan');
			$sheet->setCellValue('AS6','Jenis penyakit');
			$sheet->setCellValue('AT6','Sejak');
			$sheet->setCellValue('AU6','Tindakan pengobatan');
			$sheet->setCellValue('AV6','Kondisi sekarang');
			$sheet->setCellValue('AW6','Baju');
			$sheet->setCellValue('AX6','Celana/Rok');
			$sheet->setCellValue('AY6','Biaya Daftar');
			
			
			/* Excel Data */
			$row_number = 7;
			foreach($data as $key => $row)
			{
				
				if(getKelas($row['kelas']) != false){
					$kode_kelas = getKelas($row['kelas'])->kode_kelas;
					}else{
					$kode_kelas = $row['kelas'];
					
				}
				$sheet->setCellValue('A'.$row_number, $key+1);
				$sheet->setCellValueExplicit('B'.$row_number, $row['kode_daftar'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('C'.$row_number, $row['nama']);
				$sheet->setCellValueExplicit('D'.$row_number, $row['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('E'.$row_number, $row['no_kk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('F'.$row_number, $row['jenis_kelamin']);
				$sheet->setCellValue('G'.$row_number, $row['tempat_lahir'].', '.$row['tanggal_lahir']);
				$sheet->setCellValue('H'.$row_number, $row['email']);
				$sheet->setCellValue('I'.$row_number, $row['anak_ke']);
				$sheet->setCellValue('J'.$row_number, $row['dari']);
				$sheet->setCellValue('K'.$row_number, $row['status_keluarga']);
				$sheet->setCellValue('L'.$row_number, $row['saudara_pp']);
				$sheet->setCellValue('M'.$row_number, $row['s_pendidikan']);
				$sheet->setCellValue('N'.$row_number, $row['unit_sekolah']);
				$sheet->setCellValue('O'.$row_number, $kode_kelas);
				$sheet->setCellValue('P'.$row_number, $row['status_sekolah']);
				$sheet->setCellValue('Q'.$row_number, $row['kamar']);
				$sheet->setCellValue('R'.$row_number, $row['ijasah_terakhir']);
				$sheet->setCellValue('S'.$row_number, $row['nama_sekolah_asal']);
				$sheet->setCellValue('T'.$row_number, $row['alamat_sekolah']);
				$sheet->setCellValueExplicit('U'.$row_number, $row['nisn'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('V'.$row_number, $row['no_kip']);
				$sheet->setCellValueExplicit('W'.$row_number, $row['no_kk'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('X'.$row_number, $row['nama_ayah']);
				$sheet->setCellValueExplicit('Y'.$row_number, $row['nik_ayah'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('Z'.$row_number, $row['kondisi_ayah']);
				$sheet->setCellValue('AA'.$row_number, $row['pendidikan_terakhir_ayah']);
				$sheet->setCellValue('AB'.$row_number, $row['pekerjaan_ayah']);
				$sheet->setCellValue('AC'.$row_number, $row['nama_ibu']);
				$sheet->setCellValueExplicit('AD'.$row_number, $row['nik_ibu'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('AE'.$row_number, $row['kondisi_ibu']);
				$sheet->setCellValue('AF'.$row_number, $row['pendidikan_terakhir_ibu']);
				$sheet->setCellValue('AG'.$row_number, $row['pekerjaan_ibu']);
				$sheet->setCellValue('AH'.$row_number, $row['penghasilan_ortu']);
				$sheet->setCellValueExplicit('AI'.$row_number, $row['nomor_hp'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('AJ'.$row_number, $row['no_hp_alternatif'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('AK'.$row_number, $row['rt'].'/'.$row['rw']);
				$sheet->setCellValue('AL'.$row_number, $row['dusun']);
				$sheet->setCellValue('AM'.$row_number, $row['kode_pos']);
				$sheet->setCellValue('AN'.$row_number, $row['alamat']);
				$sheet->setCellValue('AO'.$row_number, getProvinsi($row['provinsi']));
				$sheet->setCellValue('AP'.$row_number, getKabupaten($row['kabupaten']));
				$sheet->setCellValue('AQ'.$row_number, getKecamatan($row['kecamatan']));
				$sheet->setCellValue('AR'.$row_number, getKelurahan($row['kelurahan']));
				$sheet->setCellValue('AS'.$row_number, $row['jenis_penyakit']);
				$sheet->setCellValue('AT'.$row_number, $row['sejak']);
				$sheet->setCellValue('AU'.$row_number, $row['tindakan_pengobatan']);
				$sheet->setCellValue('AV'.$row_number, $row['kondisi_sekarang']);
				$sheet->setCellValue('AW'.$row_number, $row['ukuran_seragam_baju']);
				$sheet->setCellValue('AX'.$row_number, $row['ukuran_celana_rok']);
				$sheet->setCellValue('AY'.$row_number, $row['biaya_daftar']);
				
				$row_number++;
			}
			
			for ($i = 'A'; $i !=  $spreadsheet->getActiveSheet()->getHighestColumn(); $i++) {
				$spreadsheet->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
			}
			// $sheet->getColumnDimension('A')->setWidth(4); // Set width kolom A
			// $sheet->getColumnDimension('B')->setWidth(17); // Set width kolom B
			// $sheet->getColumnDimension('C')->setWidth(28); // Set width kolom C
			$sheet->setTitle("Penerimaan Santri Baru");
			/* Excel File Format */
			$writer = new Xlsx($spreadsheet);
			$filename = 'penerimaan-santri-baru-pesantren';
			
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
			header('Cache-Control: max-age=0');
			
			$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save('php://output');
		}
		
	}																																																																																																																																		