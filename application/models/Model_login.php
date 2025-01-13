<?php 
	class Model_login extends CI_model{
		
		// Fungsi untuk memverifikasi email dan password
		public function check_login($email, $password) {
			// Query untuk mencari pengguna berdasarkan email
			$this->db->where('email', $email);
			$query = $this->db->get('tb_users'); // Pastikan tabel 'users' ada di database Anda
			
			if ($query->num_rows() == 1) {
				$user = $query->row_array();
				
				// Verifikasi password (misalnya dengan password_hash)
				if (password_verify($password, $user['password'])) { // Jika Anda menggunakan hash password
					return $user;
				}
			}
			
			// Jika login gagal, kembalikan null
			return null;
		}
	}																																																													