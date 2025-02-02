<?php 
	class Model_tagihan extends CI_model{
		
		function getTagihan($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_tagihan'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('nomor_tagihan', $params['search']['keywords']); 
				} 
				if(!empty($params['search']['status'])){ 
					$this->db->where('status_lunas', $params['search']['status']); 
				} 
				
				if(!empty($params['search']['tahun'])){ 
					$this->db->where('tahun_akademik', $params['search']['tahun']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_tagihan`.`id_tagihan `', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_tagihan.id_tagihan ', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_tagihan.id_tagihan ', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getPemasukan($params = array()){
			// print_r($params);
			// $this->db->select('*'); 
			// $this->db->from('rb_bayar_tagihan'); 
			$this->db->select('rb_bayar_tagihan.id_bayar_tagihan,rb_bayar_tagihan.id_kategori,rb_bayar_tagihan.id_siswa, rb_bayar_tagihan.id_tagihan, rb_kategori.title, rb_bayar_tagihan.tgl_bayar, rb_bayar_tagihan.jumlah_bayar,rb_bayar_tagihan.lampiran, rb_rekening.title as rekening');
			$this->db->from('rb_bayar_tagihan');
			$this->db->join('rb_kategori', 'rb_bayar_tagihan.id_kategori = rb_kategori.id_kategori', 'inner');
			$this->db->join('rb_rekening', 'rb_bayar_tagihan.id_bayar = rb_rekening.id_rekening', 'inner');
			// $this->db->group_by('rb_tagihan.id_tagihan');
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				// if(!empty($params['search']['keywords'])){ 
				// $this->db->where('id_kategori', $params['search']['keywords']); 
				// } 
				
				if(!empty($params['search']['kategori'])){ 
					$this->db->where('id_kategori', $params['search']['kategori']); 
				} 
				if(!empty($params['search']['tahun'])){ 
					$this->db->where('rb_tagihan.tahun_akademik', $params['search']['tahun']); 
				} 
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_bayar_tagihan`.`id_bayar_tagihan `', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_bayar_tagihan.id_bayar_tagihan ', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_bayar_tagihan.id_bayar_tagihan ', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		function getPengeluaran($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_pengeluaran'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->where('id_kategori', $params['search']['keywords']); 
				} 
				
				if(!empty($params['search']['tahun'])){ 
					$this->db->where('tahun_akademik', $params['search']['tahun']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_pengeluaran`.`id `', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_pengeluaran.id ', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_pengeluaran.id ', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		// Fungsi untuk memeriksa status pendaftar
		public function check_status($id_pendaftar)
		{
			// Query untuk mendapatkan status berdasarkan ID pendaftar
			$this->db->select('status');
			$this->db->from('rb_psb_daftar');
			$this->db->where('id', $id_pendaftar);
			$query = $this->db->get();
			
			// Cek jika data ditemukan
			if ($query->num_rows() > 0) {
				return $query->row()->status;
			}
			return null; // Jika tidak ditemukan
		}
		
		public function get_token()
		{
			$this->db->select('*');
			$this->db->from('rb_device');
			$this->db->where('device_status','connect');
			$this->db->limit(1);
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result;
		}
		
		private function get_tagihan($id)
		{
			$this->db->select('*');
			$this->db->from('rb_tagihan');
			$this->db->where('id_tagihan',$id);
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row_array():FALSE; 
			return $result;
		}	
		
		private function get_detail_tagihan($id)
		{
			$this->db->select('*');
			$this->db->from('rb_tagihan_detail');
			$this->db->where('id_tagihan',$id);
			$query = $this->db->get(); 
			$detail =$query->result_array(); 
			$break = "\n";
			$result = '----------------------------------' . $break;
			foreach ($detail  as $row) {
				$result .= '*Jenis Tagihan :* ' . $row['title'] .
				$break . '*Jumlah Tagihan :* ' . rprp($row['harga']) .
				$break . '----------------------------------' . $break;
			}
			return $result;
		}
		
		private function get_detail_bayar($id)
		{
			$this->db->select('*');
			$this->db->from('rb_bayar_tagihan');
			$this->db->where('id_tagihan',$id);
			$query = $this->db->get(); 
			$detail =$query->result_array(); 
			$break = "\n";
			$result = '----------------------------------' . $break;
			foreach ($detail  as $row) {
				$result .= '*Jenis Pembayaran :* ' . getKategori($row['id_kategori']) .
				$break . '*Tanggal Bayar :* ' . dtime($row['tgl_bayar']) .
				$break . '*Jumlah Bayar :* ' . rprp($row['jumlah_bayar']) .
				$break . '*Bank Transfer:* ' . getRekening($row['id_bayar']) .
				$break . '----------------------------------' . $break;
			}
			return $result;
		}
		
		public function get_pesan($post)
		{
			// dump($post);
			$this->db->select('deskripsi');
			$this->db->from('rb_template_pesan');
			$this->db->where('id',$post['template']);
			$this->db->where('aktif','Ya');
			$query = $this->db->get(); 
			
			if($query->num_rows() > 0){ 
				$row = $query->row();
				$id_tagihan = decrypt_url($post['id_tagihan']);
				$rows = $this->get_tagihan($id_tagihan);
				$detail_tagihan = $this->get_detail_tagihan($id_tagihan);
				$detail_bayar = $this->get_detail_bayar($id_tagihan);
				$nama = cekPendaftar($rows['id_siswa'])['nama'];
				
				$sisa = $rows['total_tagihan'] - $rows['total_bayar'];
				$searchVal = array(
				"{selamat}",
				"{nama_sekolah}",
				"{web_sekolah} ",
				"{wa_sekolah}",
				"{email_sekolah}",
				"{alamat_sekolah}",
				"{nomor_tagihan}",
				"{tanggal_tagihan}",
				"{nama_pendaftar}",
				"{total_tagihan}",
				"{total_bayar}",
				"{sisa_tagihan}",
				"{detail_tagihan}",
				"{detail_bayar}"
				);
				$link = tag_key('site_url').'/detail-tagihan/'.encrypt_url($post['id_tagihan']);
				// Array containing replace string from  search string
				$replaceVal = array(
				ucapan(),
				info('nama_sekolah'),
				info('site_url'),
				info('whatsapp'),
				info('site_mail'),
				info('site_addr'),
				$rows['kode_daftar'],
				dtime($rows['tgl_tagihan']),
				$nama,
				rprp($rows['total_tagihan']),
				rprp($rows['total_bayar']),
				rprp($sisa),
				$detail_tagihan,
				$detail_bayar
				);
				
				// Function to replace string
				$pesan = str_replace($searchVal, $replaceVal, $row->deskripsi);
				
				return $pesan;
			}
		}	
		
		public function batch_data($table, $data)
		{
			// dump($data);
			$this->db->update_batch($table, $data, 'id'); // this will set the id column as the condition field
			return true;
		}
		
		public function batch_data_tagihan($data)
		{
			// dump($data);
			$this->db->update_batch('rb_tagihan', $data, 'id_tagihan'); // this will set the id column as the condition field
			return true;
		}
		
		public function input_batch_data($table, $data)
		{
			$this->db->insert_batch($table, $data);
			return true;
		}
		
		public function input_multiple_data($data_input)
		{
			// dump($data_input);
			$inserted_ids = array();
			foreach ($data_input as $data) {
				// Insert individu dan dapatkan ID
				$this->db->insert('rb_tagihan', $data);
				$inserted_ids = $this->db->insert_id();
				$res = $this->check_harga(3,$data['tahun_akademik']);
				$update_tagihan[] = [
				'id_tagihan'=>$inserted_ids,
				'total_tagihan'=>$data['total_bayar'] + $res['amount'],
				];
				$tagihan_detail = [
				[
				'id_tagihan'=>$inserted_ids,
				'id_kategori'=>1,
				'title'=>'Biaya pendaftaran',
				'jumlah'=>1,
				'harga'=>$data['total_bayar'],
				],
				[
				'id_tagihan'=>$inserted_ids,
				'id_kategori'=>3,
				'title'=>$res['title'],
				'jumlah'=>1,
				'harga'=>$res['amount'],
				]
				];
				$rb_bayar_tagihan[] = [
				'id_siswa'=>$data['id_siswa'],
				'id_kategori'=>1,
				'id_tagihan'=>$inserted_ids,
				'id_bayar'=>1,
				'jumlah_bayar'=>$data['total_bayar'],
				'id_user'=>$data['id_user'],
				'tgl_bayar'=>date('Y-m-d'),
				];
				$this->db->insert_batch('rb_tagihan_detail', $tagihan_detail);
			}
			// dump($update_tagihan);
			if (!empty($update_tagihan)) {
				$this->batch_data_tagihan($update_tagihan);
			}
			
			if (!empty($rb_bayar_tagihan)) {
				$this->db->insert_batch('rb_bayar_tagihan', $rb_bayar_tagihan);
			}
		}
		public function input_tagihan()
		{
			
			$input_tagihan = [
			'kode_daftar' => $this->input->post('nik',true),
			'id_siswa' => decrypt_url($this->input->post('id_pendaftar',true)),
			'total_bayar' => convert_to_number($this->input->post('biaya',true)),
			'tahun_akademik' => $this->input->post('thnakademik',true),
			'tgl_tagihan' => date('Y-m-d'),
			'id_user' => $this->session->iduser
			];
			// Insert individu dan dapatkan ID
			$this->db->insert('rb_tagihan', $input_tagihan);
			$inserted_ids = $this->db->insert_id();
			$res = $this->check_harga(3,$this->input->post('thnakademik',true));
			$update_tagihan[] = [
			'id_tagihan'=>$inserted_ids,
			'total_tagihan'=>convert_to_number($this->input->post('biaya',true)) + $res['amount'],
			];
			
			$tagihan_detail = [
			[
			'id_tagihan'=>$inserted_ids,
			'id_kategori'=>1,
			'title'=>'Biaya pendaftar',
			'jumlah'=>1,
			'harga'=>convert_to_number($this->input->post('biaya',true)),
			],
			[
			'id_tagihan'=>$inserted_ids,
			'id_kategori'=>3,
			'title'=>$res['title'],
			'jumlah'=>1,
			'harga'=>$res['amount'],
			]
			];
			$rb_bayar_tagihan[] = [
			'id_siswa'=>decrypt_url($this->input->post('id_pendaftar',true)),
			'id_kategori'=>1,
			'id_tagihan'=>$inserted_ids,
			'id_bayar'=>1,
			'jumlah_bayar'=>convert_to_number($this->input->post('biaya',true)),
			'id_user'=>$this->session->iduser,
			'tgl_bayar'=>date('Y-m-d'),
			];
			
			$this->db->insert_batch('rb_tagihan_detail', $tagihan_detail);
			
			// dump($update_tagihan);
			if (!empty($update_tagihan)) {
				$this->batch_data_tagihan($update_tagihan);
			}
			
			if (!empty($rb_bayar_tagihan)) {
				$this->db->insert_batch('rb_bayar_tagihan', $rb_bayar_tagihan);
			}
		}
		// Fungsi untuk memeriksa status pendaftar
		private function check_harga($id_kategori,$tahun_akademik)
		{
			// Query untuk mendapatkan status berdasarkan ID pendaftar
			$this->db->select('title,amount');
			$this->db->from('rb_biaya');
			$this->db->where('id_kategori', $id_kategori);
			$this->db->where('id_tahun_akademik', $tahun_akademik);
			$query = $this->db->get();
			
			// Cek jika data ditemukan
			if ($query->num_rows() > 0) {
				return ['title'=>$query->row()->title,'amount'=>$query->row()->amount];
			}
			return ['title'=>'-','amount'=>0];
			
		}
		public function get_kategori()
		{
			// Query untuk mengambil rekening
			$query = $this->db->get('rb_kategori');
			return $query->result_array();
		}
		public function get_rekening()
		{
			// Query untuk mengambil rekening
			$query = $this->db->get('rb_rekening');
			return $query->result_array();
		}
		public function get_bayar($id_tagihan)
		{
			// Query untuk mengambil rb_bayar_tagihan
			$this->db->where('id_tagihan', $id_tagihan);
			$query = $this->db->get('rb_bayar_tagihan');
			return $query->result();
		}
		public function insert_bayar($data)
		{
			// Menyimpan data pembayaran
			return $this->db->insert('rb_bayar_tagihan', $data);
		}
		// Fungsi untuk menjumlahkan jumlah_bayar berdasarkan kriteria tertentu
		public function total_jumlah_bayar($id_tagihan = null, $id_kategori = null) {
			$this->db->select_sum('jumlah_bayar'); // Menjumlahkan jumlah_bayar
			$this->db->from('rb_bayar_tagihan');  // Tabel yang digunakan
			
			// Jika id_tagihan diberikan, tambahkan kondisi
			if ($id_tagihan) {
				$this->db->where('id_tagihan', $id_tagihan);
			}
			
			// Jika id_kategori diberikan, tambahkan kondisi
			if ($id_kategori) {
				$this->db->where('id_kategori', $id_kategori);
			}
			
			// Eksekusi query dan ambil hasilnya
			$query = $this->db->get();
			
			// Ambil hasil sum
			$result = $query->row();
			
			return $result ? $result->jumlah_bayar : 0;  // Jika ada hasil, kembalikan total, jika tidak 0
		}
		// Fungsi untuk menjumlahkan jumlah_bayar berdasarkan kriteria tertentu
		public function total_saldo() {
			$this->db->select_sum('jumlah_bayar'); // Menjumlahkan jumlah_bayar
			$this->db->from('rb_bayar_tagihan');  // Tabel yang digunakan
			
			// Eksekusi query dan ambil hasilnya
			$query = $this->db->get();
			
			// Ambil hasil sum
			$result = $query->row();
			
			return $result ? $result->jumlah_bayar : 0;  // Jika ada hasil, kembalikan total, jika tidak 0
		}
		
		public function get_laporan($start_date = null, $end_date = null, $kategori = null, $tahun = null) {
			$this->db->select('rb_bayar_tagihan.id_bayar_tagihan,rb_bayar_tagihan.id_kategori,rb_bayar_tagihan.id_siswa, rb_bayar_tagihan.id_tagihan, rb_kategori.title, rb_bayar_tagihan.tgl_bayar, rb_bayar_tagihan.jumlah_bayar, rb_rekening.title as rekening');
			$this->db->from('rb_bayar_tagihan');
			$this->db->join('rb_kategori', 'rb_bayar_tagihan.id_kategori = rb_kategori.id_kategori', 'inner');
			$this->db->join('rb_rekening', 'rb_bayar_tagihan.id_bayar = rb_rekening.id_rekening', 'inner');
			// $this->db->from('rb_bayar_tagihan');
			
			// Kondisi untuk filter berdasarkan kategori dan tanggal jika diperlukan
			if ($kategori) {
				$this->db->where('rb_bayar_tagihan.id_kategori', $kategori);
			}
			// Kondisi untuk filter berdasarkan tahun akademik
			if ($tahun) {
				$this->db->where('rb_tagihan.tahun_akademik', $tahun);
			}
			if ($start_date && $end_date) {
				$this->db->where('rb_bayar_tagihan.tgl_bayar >=', $start_date);
				$this->db->where('rb_bayar_tagihan.tgl_bayar <=', $end_date);
			}
			
			// Eksekusi query untuk mendapatkan data pembayaran
			$query = $this->db->get();
			
			// Mengambil hasil query pembayaran
			$laporan = $query->result();
			
			// Menghitung total pembayaran (hanya dari rb_bayar_tagihan)
			$total_pembayaran = 0;
			foreach ($laporan as $row) {
				$total_pembayaran += $row->jumlah_bayar;
			}
			
			// Query untuk mendapatkan data pengeluaran
			$this->db->select('
			rb_pengeluaran.id AS pengeluaran_id,
			rb_pengeluaran.id_kategori,
			rb_pengeluaran.tanggal AS tanggal_pengeluaran,
			rb_pengeluaran.keterangan AS keterangan_pengeluaran,
			rb_pengeluaran.jumlah AS jumlah_pengeluaran
			');
			
			$this->db->from('rb_pengeluaran');
			
			// Kondisi untuk filter berdasarkan kategori dan tanggal jika diperlukan
			if ($kategori) {
				$this->db->where('rb_pengeluaran.id_kategori', $kategori);
			}
			// Kondisi untuk filter berdasarkan kategori dan tanggal jika diperlukan
			if ($tahun) {
				$this->db->where('rb_pengeluaran.tahun_akademik', $tahun);
			}
			if ($start_date && $end_date) {
				$this->db->where('rb_pengeluaran.tanggal >=', $start_date);
				$this->db->where('rb_pengeluaran.tanggal <=', $end_date);
			}
			
			// Eksekusi query untuk mendapatkan data pengeluaran
			$query = $this->db->get();
			
			// Mengambil hasil query pengeluaran
			$pengeluaran = $query->result();
			
			// Menghitung total pengeluaran
			$total_pengeluaran = 0;
			foreach ($pengeluaran as $row) {
				$total_pengeluaran += $row->jumlah_pengeluaran;
			}
			
			// Menghitung sisa saldo
			$sisa_saldo = $total_pembayaran - $total_pengeluaran;
			
			// Mengembalikan hasil laporan
			return [
			'pemasukan' => $laporan,
			'pengeluaran' => $pengeluaran,
			'total_pembayaran' => $total_pembayaran,
			'total_pengeluaran' => $total_pengeluaran,
			'sisa_saldo' => $sisa_saldo
			];
		}
		
		
		
		// Menambahkan data rekening baru
		public function add_rekening($data) {
			$this->db->insert('rb_rekening', $data);
			return $this->db->insert_id();
		}
		
		// Mendapatkan daftar rekening
		public function get_rekenings() {
			return $this->db->get('rb_rekening')->result();
		}
		// Mendapatkan daftar device
		public function get_device() {
			return $this->db->get('rb_device')->result();
		}
		// Mendapatkan daftar rb_template_pesan
		public function get_template($slug) {
			return $this->db->get_where('rb_template_pesan', ['slug' => $slug])->result();
		}
		
		// Mengambil data rekening berdasarkan id
		public function edit_rekening($id_rekening) {
			return $this->db->get_where('rb_rekening', ['id_rekening' => $id_rekening])->row();
		}
		
		// Mengupdate data rekening
		public function update_rekening($id_rekening, $data) {
			$this->db->where('id_rekening', $id_rekening);
			return $this->db->update('rb_rekening', $data);
		}
		
		// Menghapus data rekening
		public function delete_rekening($id_rekening) {
			return $this->db->delete('rb_rekening', ['id_rekening' => $id_rekening]);
		}
		public function get_tagihan_data() {
			$query = $this->db->get('tagihan_pembayaran');
			return $query->result_array();
		}
	}																																																				