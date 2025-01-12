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
		
		public function get_pesan($post)
		{
			$this->db->select('deskripsi');
			$this->db->from('rb_template_pesan');
			$this->db->where('slug','PENDAFTARAN');
			$this->db->where('aktif','Ya');
			$query = $this->db->get(); 
			
			if($query->num_rows() > 0){ 
				$row = $query->row();
				$biaya = convert_to_number($post['biaya']);
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
				"{biaya}",
				"{cetak_formulir}"
				);
				$link = tag_key('site_url').'/cetak-formulir/'.encrypt_url($post['nik']);
				// Array containing replace string from  search string
				$replaceVal = array(
				ucapan(),
				info('nama_sekolah'),
				info('site_url'),
				info('whatsapp'),
				info('site_mail'),
				info('site_addr'),
				$post['nik'],
				date('Y-m-d'),
				$post['nama'],
				$post['nik'],
				$post['nisn'],
				$post['email'],
				$post['unit_sekolah'],
				$post['kelas'],
				$post['kamar'],
				rp($biaya),
				$link
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
				'title'=>'Biaya pendaftar',
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
				'id_kategori'=>1,
				'id_tagihan'=>$inserted_ids,
				'id_bayar'=>2,
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
		public function insert_bayar($data)
		{
			// Menyimpan data pembayaran
			return $this->db->insert('rb_bayar_tagihan', $data);
		}
	}																														