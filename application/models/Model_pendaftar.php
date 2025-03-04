<?php 
	class Model_pendaftar extends CI_model{
		
		// Fungsi untuk mengambil total pendaftar per kelas dan mengurutkan berdasarkan tahun akademik
		public function get_total_per_kelas($tahun_akademik = null) {
			$this->db->select('rk.nama_kelas AS kelas, COUNT(*) as total_pendaftar, ta.nama_tahun');
			$this->db->from('rb_psb_daftar pd');
			$this->db->join('rb_tahun_akademik ta', 'pd.tahun_akademik = ta.id_tahun_akademik', 'left');
			$this->db->join('rb_kelas rk', 'pd.kelas = rk.id');
			
			// Jika tahun akademik dipilih, filter berdasarkan tahun akademik
			if ($tahun_akademik) {
				$this->db->where('pd.tahun_akademik', $tahun_akademik);
			}
			
			$this->db->group_by('pd.kelas, ta.nama_tahun');
			$this->db->order_by('rk.urutan', 'ASC');
			$query = $this->db->get();
			
			return $query->result_array();
		}
		
		// Fungsi untuk mendapatkan daftar tahun akademik
		public function get_tahun_akademik() {
			$this->db->select('id_tahun_akademik, nama_tahun');
			$query = $this->db->get('rb_tahun_akademik');
			return $query->result_array();
		}
		function getPendaftar($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_psb_daftar'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('nama', $params['search']['keywords']); 
					$this->db->or_like('nik', $params['search']['keywords']); 
					$this->db->or_like('nisn', $params['search']['keywords']); 
					$this->db->or_like('nomor_hp', $params['search']['keywords']); 
				} 
				
				if(!empty($params['search']['tahun'])){ 
					$this->db->where('tahun_akademik', $params['search']['tahun']); 
				} 
				
				if(!empty($params['search']['status'])){ 
					$this->db->where('s_pendidikan', $params['search']['status']); 
				} 
				if(!empty($params['search']['sortUnit'])){ 
					$this->db->like('unit_sekolah', $params['search']['sortUnit']); 
				} 
				if(!empty($params['search']['sortKelas'])){ 
					$this->db->where('kelas', $params['search']['sortKelas']); 
				} 
				if (!empty($params['search']['dari']) and !empty($params['search']['sampai'])) {
                    $this->db->where('tanggal_daftar BETWEEN "'.date('Y-m-d', strtotime($params['search']['dari'])).'" and "'.date('Y-m-d', strtotime($params['search']['sampai'])).'"');
				}
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_psb_daftar`.`id`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_psb_daftar.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_psb_daftar.id', 'DESC'); 
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
		
		function getGelombang($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_gelombang'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('title', $params['search']['keywords']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`id_gelombang`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('id_gelombang', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('id_gelombang', 'ASC'); 
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
		
		function getUnit($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_unit'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('nama_jurusan', $params['search']['keywords']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_psb_daftar`.`id`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_unit.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_unit.urutan', 'ASC'); 
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
		
		function getKelas($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_kelas'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('kode_kelas', $params['search']['keywords']); 
					$this->db->or_like('nama_kelas', $params['search']['keywords']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_kelas`.`urutan`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_kelas.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_kelas.urutan', 'ASC'); 
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
		
		function getTahun($params = array()){
			$this->db->select('*'); 
			$this->db->from('rb_tahun_akademik'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('id_tahun_akademik', $params['search']['keywords']); 
					$this->db->or_like('nama_tahun', $params['search']['keywords']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_tahun_akademik`.`id`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_tahun_akademik.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_tahun_akademik.id', 'DESC'); 
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
		
		function getKuota($params = array()){
			$this->db->select('*'); 
			$this->db->from('rb_kamar'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('nama_kamar', $params['search']['keywords']); 
					$this->db->or_like('kuota', $params['search']['keywords']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_kamar`.`id`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_kamar.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_kamar.id', 'DESC'); 
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
		function getPanitia($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_panitia'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('nama', $params['search']['keywords']); 
					$this->db->or_like('nomor_wa', $params['search']['keywords']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_panitia`.`id`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_panitia.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_panitia.id', 'DESC'); 
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
		function getBrosur($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_psb_brosur'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('title', $params['search']['keywords']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_psb_brosur`.`id`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_psb_brosur.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_psb_brosur.id', 'DESC'); 
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
		function getPendidikan($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_pendidikan'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('title', $params['search']['keywords']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_pendidikan`.`id`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_pendidikan.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_pendidikan.id', 'ASC'); 
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
		
		function getPekerjaan($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_pekerjaan'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('title', $params['search']['keywords']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_pekerjaan`.`id`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_pekerjaan.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_pekerjaan.id', 'DESC'); 
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
		
		public function cek_kode_unit($id,$val)
		{
			$cek = $this->db->where("BINARY kode_jurusan = '$val'", NULL, FALSE)->get('rb_unit');
			if (
			$cek->num_rows() == 1 && 
			$cek->row->id == $id || 
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
		public function cek_nama_unit($id,$val)
		{
			$cek = $this->db->where("BINARY nama_jurusan = '$val'", NULL, FALSE)->get('rb_unit');
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
		
		public function cek_email($id,$val)
		{
			$cek = $this->db->where("BINARY email = '$val'", NULL, FALSE)->get('rb_psb_daftar');
			
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
		
		public function cek_edit_nik($id,$val)
		{
			$cek = $this->db->where("BINARY nik = '$val'", NULL, FALSE)->get('rb_psb_daftar');
			
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
		public function cek_edit_nisn($id,$val)
		{
			$cek = $this->db->where("BINARY nisn = '$val'", NULL, FALSE)->get('rb_psb_daftar');
			
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
		public function cek_edit_nokk($id,$val)
		{
			$cek = $this->db->where("BINARY no_kk = '$val'", NULL, FALSE)->get('rb_psb_daftar');
			
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
		public function cek_edit_nik_ayah($id,$val)
		{
			$cek = $this->db->where("BINARY nik_ayah = '$val'", NULL, FALSE)->get('rb_psb_daftar');
			
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
		public function cek_edit_nik_ibu($id,$val)
		{
			$cek = $this->db->where("BINARY nik_ibu= '$val'", NULL, FALSE)->get('rb_psb_daftar');
			
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
		public function cek_kode_kelas($id,$val)
		{
			$cek = $this->db->where("BINARY kode_kelas = '$val'", NULL, FALSE)->get('rb_kelas');
			
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
		public function cek_nama_kelas($id,$val)
		{
			$cek = $this->db->where("BINARY nama_kelas= '$val'", NULL, FALSE)->get('rb_kelas');
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
		
		public function cek_kode_tahun($id,$val)
		{
			$cek = $this->db->where("BINARY id_tahun_akademik = '$val'", NULL, FALSE)->get('rb_tahun_akademik');
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
		public function cek_nama_tahun($id,$val)
		{
			$cek = $this->db->where("BINARY nama_tahun= '$val'", NULL, FALSE)->get('rb_tahun_akademik');
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
		
		public function cek_nomor($id,$val)
		{
			$cek = $this->db->where("BINARY nomor_wa= '$val'", NULL, FALSE)->get('rb_panitia');
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
		public function nama_unit_byid($id)
		{
			
			$this->db->select('nama_jurusan');
			$this->db->from('rb_unit');
			$this->db->where('id',$id);
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->nama_jurusan:NULL; 
			return $result; 
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
		
		function fetch_transactions()
		{
			/* Filter */
			$filter = $this->input->post('export');
			$status = $this->input->post('status');
			$unit = $this->input->post('unit');
			$kelas = $this->input->post('kelas');
			if(!empty($status)){
				$this->db->where('s_pendidikan', $status);
			}
			if(!empty($unit)){
				$this->db->where('unit_sekolah', $unit);
			}
			if(!empty($kelas)){
				$this->db->where('kelas', $kelas);
			}
			/* Query */
			$this->db->select("*");
			$this->db->where('tahun_akademik', $filter);
			// $this->db->where('s_pendidikan', 'Baru');
			$this->db->order_by('nama', 'ASC'); 
			$query = $this->db->get('rb_psb_daftar');
			return $query->result_array();
		}
		
		public function batch_data($table, $data)
		{
			// dump($data);
			$this->db->update_batch($table, $data, 'id'); // this will set the id column as the condition field
			return true;
		}
		
		function getBiaya($params = array()){
			// print_r($params);
			$this->db->select('b.id_biaya, k.title as kategori, b.title, b.amount, ta.nama_tahun as tahun_akademik, u.nama_jurusan');
			$this->db->from('rb_biaya b');
			$this->db->join('rb_kategori k', 'b.id_kategori = k.id_kategori');
			$this->db->join('rb_tahun_akademik ta', 'b.id_tahun_akademik = ta.id_tahun_akademik');
			$this->db->join('rb_unit u', 'b.id_unit = u.id', 'left'); // Join dengan tabel rb_unit
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('u.nama_jurusan', $params['search']['keywords']); 
					$this->db->or_like('b.amount', $params['search']['keywords']); 
					$this->db->or_like('k.title', $params['search']['keywords']); 
				} 
				
				if(!empty($params['search']['tahun'])){ 
					$this->db->where('b.id_tahun_akademik', $params['search']['tahun']); 
				} 
				
				if(!empty($params['search']['sortUnit'])){ 
					$this->db->like('b.id_unit', $params['search']['sortUnit']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('b.id_biaya', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('b.id_biaya', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('b.id_biaya', 'DESC'); 
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
		
		public function get_all($tahun_akademik) {
			$this->db->select('b.id_biaya, k.title as kategori, b.title, b.amount, ta.nama_tahun as tahun_akademik, u.nama_jurusan');
			$this->db->from('rb_biaya b');
			$this->db->join('rb_kategori k', 'b.id_kategori = k.id_kategori');
			$this->db->join('rb_tahun_akademik ta', 'b.id_tahun_akademik = ta.id_tahun_akademik');
			$this->db->join('rb_unit u', 'b.id_unit = u.id', 'left'); // Join dengan tabel rb_unit
			if (!empty($tahun_akademik)) {
				$this->db->where('b.id_tahun_akademik', $tahun_akademik);
			}
			$query = $this->db->get();
			return $query->result(); // Mengembalikan data sebagai array
		}
		public function get_alled() {
			$this->db->select('b.id_biaya, k.title as kategori, b.title, b.amount, ta.nama_tahun as tahun_akademik');
			$this->db->from('rb_biaya b');
			$this->db->join('rb_kategori k', 'b.id_kategori = k.id_kategori');
			$this->db->join('rb_tahun_akademik ta', 'b.id_tahun_akademik = ta.id_tahun_akademik');
			$query = $this->db->get();
			return $query->result(); // Mengembalikan data sebagai array
		}
		
		// Menampilkan semua data biaya
		public function get_all_biaya()
		{
			$this->db->select('b.id_biaya, b.title, b.amount, k.title as kategori');
			$this->db->from('rb_biaya b');
			$this->db->join('rb_kategori k', 'b.id_kategori = k.id_kategori');
			$query = $this->db->get();
			return $query->result();
		}
		
		// Menampilkan semua data unit
		public function get_all_unit()
		{
			$this->db->select('*');
			$this->db->from('rb_unit');
			$query = $this->db->get();
			return $query->result();
		}
		
		// Menampilkan semua data biaya
		public function get_all_kategori()
		{
			$this->db->select('*');
			$this->db->from('rb_kategori');
			$query = $this->db->get();
			return $query->result();
		}
		
		// Menambah data biaya
		public function insert_biaya($data)
		{
			return $this->db->insert('rb_biaya', $data);
		}
		
		// Mengupdate data biaya
		public function update_biaya($id, $data)
		{
			$this->db->where('id_biaya', $id);
			return $this->db->update('rb_biaya', $data);
		}
		
		// Menghapus data biaya
		public function delete_biaya($id)
		{
			$this->db->where('id_biaya', $id);
			return $this->db->delete('rb_biaya');
		}
		
		// Mengambil data biaya berdasarkan ID
		public function get_biaya_by_id($id)
		{
			$this->db->where('id_biaya', $id);
			$query = $this->db->get('rb_biaya');
			return $query->row();
		}
	}																			