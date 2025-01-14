<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Keuangan extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			cek_session_login(1);
			$this->title = tag_key('site_title');
			$this->iduser = $this->session->iduser; 
            $this->level = $this->session->level; 
            $this->idlevel = $this->session->idlevel; 
            $this->menu = $this->uri->segment(1); 
			$this->load->model('model_tagihan');
			$this->perPage = 10;
		}
		
		public function tagihan()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			
			$data['title'] = 'Tagihan | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			
			$this->thm->load('backend/template','backend/keuangan/view_tagihan',$data);
		}
		
		public function pemasukan()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			
			$data['title'] = 'Pemasukan | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			$data['kategori'] = $this->model_tagihan->get_kategori();
			
			$this->thm->load('backend/template','backend/keuangan/view_pemasukan',$data);
		}
		
		public function pengeluaran()
        {
			cek_menu_akses();
			cek_crud_akses('READ');
			
			$data['title'] = 'Pengeluaran | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			
			$this->thm->load('backend/template','backend/keuangan/view_pengeluaran',$data);
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
			$status = $this->input->post('status');
            if (!empty($status)) {
                $conditions['search']['status'] = $status;
			}
			$kategori = $this->input->post('kategori');
            if (!empty($kategori)) {
                $conditions['search']['kategori'] = $kategori;
			}
			$tahun = $this->input->post('tahun');
            if (!empty($tahun)) {
                $conditions['search']['tahun'] = $tahun;
			}
			
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_tagihan->getTagihan($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('keuangan/ajax_list');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchData';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_tagihan->getTagihan($conditions);
			
            // Load the data list view 
			$this->load->view('backend/keuangan/get-ajax',$data);
			
		}
		
        function ajax_list_pemasukan()
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
			
            $kategori = $this->input->post('kategori');
            if (!empty($kategori)) {
                $conditions['search']['kategori'] = $kategori;
			}
			
			$limit = $this->input->post('limit');
            if (!empty($limit)) {
                $conditions['search']['limit'] = $limit;
				}else{
				$limit = 5;
			}
			
			
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_tagihan->getPemasukan($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('keuangan/ajax_list_pemasukan');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchData';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_tagihan->getPemasukan($conditions);
			
            // Load the data list view 
			$this->load->view('backend/keuangan/get-ajax-pemasukan',$data);
			
		}
		
        function ajax_list_pengeluaran()
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
            $totalRec = $this->model_tagihan->getPengeluaran($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('keuangan/ajax_list_pengeluaran');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchData';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
            unset($conditions['returnType']);
            $data['record'] = $this->model_tagihan->getPengeluaran($conditions);
			
            // Load the data list view 
			$this->load->view('backend/keuangan/get-ajax-pengeluaran',$data);
			
		}
		
		function bayar_tagihan()
		{
			cekRequest();
			cek_crud_akses('CONTENT','JSON');
			$id = $this->db->escape_str($this->input->post('id'));
			$index = decrypt_url($id);
			
			$result = $this->model_app->view_where('rb_tagihan',['id_tagihan'=>$index]);
			if($result->num_rows() > 0){
				$sisa = $result->row()->total_tagihan - $result->row()->total_bayar;
				$response = [
				'status'=>true,
				'id'=>$id,
				'total_dibayar'=>$result->row()->total_bayar,
				'total_tagihan'=>$result->row()->total_tagihan,
				'sisa'=>$sisa
				];
				}else{
				$response = [
				'status'=>false,
				'msg'=>'Gagal'
				];
			}
			$this->thm->json_output($response);
			
		}
		
		function hapus_data(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	= decrypt_url($this->input->post('id',TRUE));
			
			$where = array('id' => $id);
			$search = $this->model_app->edit('rb_pages', $where);
			if($search->num_rows()>0){
				$row = $search->row_array();
				$res = $this->model_app->hapus('rb_pages',$where);
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
		function hapus_bayar(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id 	 = decrypt_url($this->input->post('id',TRUE));
			$tagihan = decrypt_url($this->input->post('tagihan',TRUE));
			
			$where = array('id_bayar_tagihan' => $id);
			$search = $this->model_app->edit('rb_bayar_tagihan', $where);
			if($search->num_rows()>0){
				$row = $search->row();
				$opathFile = FCPATH."upload/lampiran/" . $row->lampiran;
				$size = @getimagesize($opathFile);
				if($size !== false){
					$img=FCPATH."upload/lampiran/".$row->lampiran;
					unlink($img);
				}
				$jumlah_bayar = $row->jumlah_bayar;
				$this->cek_total_bayar($tagihan,$jumlah_bayar);
				$res = $this->model_app->hapus('rb_bayar_tagihan',$where);
				if($res==true){
					$data = array('status'=>true,'title'=>'Hapus data','msg'=>'Data berhasil dihapus','id'=>encrypt_url($tagihan));
					}else{
					$data = array('status'=>false,'title'=>'Hapus data','msg'=>'Data gagal dihapus','id'=>0);
				}
				
				}else{
				$data = array('status'=>false,'msg'=>'Data gagal dihapus');
			}
			
			$this->thm->json_output($data);
			
		}
		
		private function cek_total_bayar($id,$jumlah_bayar){
			$query = $this->model_app->edit('rb_tagihan', ['id_tagihan'=>$id]);
			if($query->num_rows()>0){
				$total_bayar = $query->row()->total_bayar - $jumlah_bayar;
				$this->model_app->update('rb_tagihan',['total_bayar'=>$total_bayar],['id_tagihan'=>$id]);
			}
		}
		
		function aktifkan(){
			cek_input_post('GET');
			cek_crud_akses('DELETE');
			$id = decrypt_url($this->input->post('id',TRUE));
			$aktif = $this->input->post('aktif',TRUE);
			
			$where = array('id' => $id);
			if($aktif=='Ya'){
				$array = array('aktif'=>'Ya');
				$title = 'diaktifkan';
				}else{
				$array = array('aktif'=>'Tidak');
				$title = 'dinonaktifkan';
			}
			
			$search = $this->model_app->edit('rb_pages', ['id' => $id]);
			if($search->num_rows()>0){
				$row = $search->row_array();
				$res = $this->model_app->update('rb_pages',$array,$where);
				if($res==true){
					$data = array('status'=>true,'title'=>'Aktifkan data','msg'=>'Data berhasil '.$title);
					}else{
					$data = array('status'=>false,'title'=>'Aktifkan data','msg'=>'Data gagal '.$title);
				}
				
				}else{
				$data = array('status'=>false,'msg'=>'Data gagal muat');
			}
			
			$this->thm->json_output($data);
			
		}
		// Mengambil rekening untuk dropdown
		public function get_kategori()
		{
			if ($this->input->is_ajax_request()) 
			{
				$kategori = $this->model_tagihan->get_kategori();
				echo json_encode($kategori);
			}
		}
		
		// Mengambil rekening untuk dropdown
		public function get_rekening()
		{
			$rekening = $this->model_tagihan->get_rekening();
			echo json_encode($rekening);
		}
		
		// Mengambil data bayar
		public function load_bayar()
		{
			if ($this->input->is_ajax_request()) 
			{
				$id_tagihan = decrypt_url($this->input->post('id',TRUE));
				$query = $this->model_tagihan->get_bayar($id_tagihan);
				$data = [];
				foreach($query AS $row){
					$data[] = [
					'id_bayar_tagihan'=>encrypt_url($row->id_bayar_tagihan),
					'id_tagihan'=>encrypt_url($row->id_tagihan),
					'id'=>$this->input->post('id',TRUE),
					'kategori'=>getKategori($row->id_kategori),
					'tanggal'=>$row->tgl_bayar,
					'jumlah_bayar'=>$row->jumlah_bayar,
					];
				}
				echo json_encode($data);
			}
		}
		
		// Menyimpan pembayaran
		public function save_bayar()
		{
			if ($this->input->is_ajax_request()) 
			{
				// Validasi input
				$this->form_validation->set_rules('tanggal_bayar', 'Tanggal bayar', 'required');
				$this->form_validation->set_rules('rekening', 'Rekening', 'required');
				$this->form_validation->set_rules('lampiran', 'Lampiran', 'callback_file_check'); // Atur validasi file
				// dump($_POST);
				if ($this->form_validation->run() == FALSE) {
					echo json_encode(['status' => false, 'message' => validation_errors()]);
					} else {
					// Atur upload config
					$config['upload_path']   = './upload/lampiran/';
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size']      = 2048; // Max file size in KB
					$config['file_name']     = uniqid('lampiran_'); // Generate unique filename
					
					$this->upload->initialize($config);
					
					// Upload file
					if (!$this->upload->do_upload('lampiran')) {
						// Jika gagal upload
						echo json_encode(['status' => false, 'message' => $this->upload->display_errors()]);
						} else {
						$id_tagihan = decrypt_url($this->input->post('id_tagihan',TRUE));
						$total_tagihan = convert_to_number($this->input->post('total_tagihan',TRUE));
						$total_dibayar = convert_to_number($this->input->post('total_dibayar',TRUE));
						$sisa_tagihan = convert_to_number($this->input->post('sisa_tagihan',TRUE));
						$jumlah_bayar = convert_to_number($this->input->post('jumlah_bayar',TRUE));
						$total_bayar = $total_dibayar + $jumlah_bayar;
						// Jika berhasil upload
						$file_data = $this->upload->data();
						if($sisa_tagihan >0){
							$status = 'N';
							}else{
							$status = 'Y';
						}
						$data = [
						'id_kategori' => $this->input->post('kategori'),
						'id_tagihan'  => $id_tagihan,
						'id_bayar'    => $this->input->post('rekening'),
						'lampiran'    => $file_data['file_name'], // Simpan nama file yang di-upload
						'tgl_bayar'    => $this->input->post('tanggal_bayar'), // Simpan nama file yang di-upload
						'jumlah_bayar'=> convert_to_number($this->input->post('jumlah_bayar')),
						'id_user'=> $this->iduser
						];
						
						$result = $this->model_tagihan->insert_bayar($data);
						$this->model_app->update('rb_tagihan',['total_bayar'=>$total_bayar,'status_lunas'=>$status],['id_tagihan'=>$id_tagihan]);
						
						if ($result) {
							echo json_encode(['status' => true, 'message' => 'Pembayaran berhasil disimpan']);
							} else {
							echo json_encode(['status' => false, 'message' => 'Terjadi kesalahan, silakan coba lagi']);
						}
					}
				}
			}
		}
		
		public function cetak_tagihan($id="")
		{
			$data['title']       = 'Cetak tagihan';
			if($id){
				$id = decrypt_url($id);
				$search = $this->model_app->edit('rb_tagihan', ['id_tagihan' => $id]);
				if($search->num_rows()>0){
					$data['favicon'] = tag_image('site_favicon');
					$data['logo'] = tag_image('site_logo');
					$data['cetak'] = $search->row();
					$data['result'] = $this->model_app->view_where('rb_bayar_tagihan', ['id_tagihan' => $id])->result();
					$this->load->view('backend/keuangan/cetak_tagihan', $data);
				}
			}
		}
		// Menyimpan data pengeluaran
		public function save_pengeluaran() {
			// Validasi input
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
			$this->form_validation->set_rules('kategori', 'Keterangan', 'required');
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
			
			if ($this->form_validation->run() == FALSE) {
				// Jika validasi gagal, kirim pesan error
				echo json_encode(array('status' => 'error', 'message' => validation_errors()));
				} else {
				$jumlah = convert_to_number($this->input->post('jumlah'));
				$total_saldo = $this->model_tagihan->total_saldo();
				if($jumlah > $total_saldo){
				$this->thm->json_output($data);
				}
				// Data valid, simpan ke database
				$data = array(
                'tanggal' => $this->input->post('tanggal'),
                'keterangan' => $this->input->post('kategori'),
                'jumlah' => convert_to_number($this->input->post('jumlah')),
				);
				
				// Simpan data ke database
				if ($this->Pengeluaran_model->save($data)) {
					// Kirim response sukses
					echo json_encode(array('status' => 'success', 'message' => 'Pengeluaran berhasil disimpan'));
					} else {
					// Jika gagal menyimpan, kirim pesan error
					echo json_encode(array('status' => 'error', 'message' => 'Pengeluaran gagal disimpan'));
				}
			}
		}
		// Callback untuk validasi file
		public function file_check($str)
		{
			$allowed_types = array('jpeg', 'jpg', 'png');
			$file_type = pathinfo($_FILES['lampiran']['name'], PATHINFO_EXTENSION);
			
			if (!in_array($file_type, $allowed_types)) {
				$this->form_validation->set_message('file_check', 'Format file tidak valid. Hanya jpeg, jpg, dan png yang diperbolehkan.');
				return FALSE;
			}
			return TRUE;
		}
	}																																																																							