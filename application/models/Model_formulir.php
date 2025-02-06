<?php 
	class Model_formulir extends CI_model{
		
		
		public function cek_kode($id,$val)
		{
			$cek = $this->db->where("BINARY device = '$val'", NULL, FALSE)->get('rb_device');
			if (
			$cek->num_rows() == 1 && 
			$cek->row_array()['id'] == $id || 
			$cek->num_rows() != 1
			) 
			{
				return TRUE;
			}
			else 
			{
				return FALSE;
			}
		}	
		
		public function get_token()
		{
			$wa_aktif = tag_key('wa_aktif');
			 
			$this->db->select('*');
			$this->db->from('rb_device');
			$this->db->where('id_pengaturan',$wa_aktif);
			$this->db->limit(1);
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result;
		}	
		
		public function get_pesan_pendaftaran($post)
		{
			$this->db->select('deskripsi');
			$this->db->from('rb_template_pesan');
			$this->db->where('slug','PENDAFTARAN');
			$this->db->where('aktif','Ya');
			$this->db->limit(1);
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
				get_unit($post['unit_sekolah']),
				getNamaKelas($post['kelas']),
				$post['kamar'],
				rp($biaya),
				$link
				);
				
				// Function to replace string
				$pesan = str_replace($searchVal, $replaceVal, $row->deskripsi);
				
				return $pesan;
			}
		}	
		
		public function get_pesan($post)
		{
			$this->db->select('deskripsi');
			$this->db->from('rb_template_pesan');
			$this->db->where('id',$post['template_pesan']);
			$this->db->where('aktif','Ya');
			$this->db->limit(1);
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
		
		
		public function nama_unit_byid($id)
		{
			
			$this->db->select('nama_jurusan');
			$this->db->from('rb_unit');
			$this->db->where('id',$id);
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->nama_jurusan:NULL; 
			return $result; 
		}
	}																																																																			