<?php 
	class Model_pendaftar extends CI_model{
		
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
					$this->db->where('status_sekolah', $params['search']['status']); 
				} 
				if(!empty($params['search']['sortUnit'])){ 
					$this->db->like('unit_sekolah', $params['search']['sortUnit']); 
				} 
				if(!empty($params['search']['sortKelas'])){ 
					$this->db->where('kelas', $params['search']['sortKelas']); 
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
					$this->db->order_by('rb_unit.id', 'DESC'); 
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
				$this->db->order_by('`rb_kelas`.`id`', $params['search']['sortBy']); 
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
					$this->db->order_by('rb_kelas.id', 'DESC'); 
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
			/* Query */
			$this->db->select("*");
			$this->db->where('tahun_akademik', $filter);
			$this->db->where('s_pendidikan', 'Baru');
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
	}					