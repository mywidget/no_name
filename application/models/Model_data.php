<?php 
	class Model_data extends CI_model{
		
		function getPengguna($params = array()){ 
			$dbprefix = $this->db->dbprefix('tb_users');
			
			$this->db->select('*'); 
			$this->db->from($dbprefix); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('nama_lengkap', $params['search']['keywords']); 
				} 
			}
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`tb_users`.`id_user`', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('tb_users.id_user', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('tb_users.id_user', 'ASC'); 
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
		function getPesan($params = array()){ 
			$dbprefix = $this->db->dbprefix('pesan_masuk');
			
			$this->db->select('*'); 
			$this->db->from($dbprefix); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('kode', $params['search']['keywords']); 
				} 
				if(!empty($params['search']['sortBy'])){ 
					$this->db->order_by('`pesan_masuk`.`id`', $params['search']['sortBy']); 
				}
				
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('pesan_masuk.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('pesan_masuk.id', 'DESC'); 
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
		
		function getHalaman($params = array()){ 
			$dbprefix = $this->db->dbprefix('rb_pages');
			
			$this->db->select('*'); 
			$this->db->from($dbprefix); 
			
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
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_pages.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_pages.id', 'DESC'); 
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
		function getApliksi($params = array()){ 
			 
			$this->db->select('*'); 
			$this->db->from('rb_setting'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('value', $params['search']['keywords']); 
				} 
				 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_setting.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_setting.id', 'asc'); 
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
		
		public function get_categories(){
			
			$this->db->select('*');
			$this->db->from('rb_menu');
			$this->db->where('id_parent', 0);
			$this->db->where('aktif', 'Ya');
			$this->db->order_by('`urutan`', 'ASC'); 
			$parent = $this->db->get();
			
			$categories = $parent->result();
			$i=0;
			foreach($categories as $p_cat){
				
				$categories[$i]->sub = $this->sub_categories($p_cat->id_menu);
				$i++;
			}
			return $categories;
		}
		
		public function sub_categories($id){
			
			$this->db->select('*');
			$this->db->from('rb_menu');
			$this->db->where('id_parent', $id);
			$this->db->where('aktif', 'Ya');
			$this->db->order_by('`urutan`', 'ASC'); 
			$child = $this->db->get();
			$categories = $child->result();
			$i=0;
			foreach($categories as $p_cat){
				
				$categories[$i]->sub = $this->sub_categories($p_cat->id_menu,$cat);
				$i++;
			}
			return $categories;       
		}
		
		public function cek_user($username){
			$this->db->select('*');
			$this->db->from('tb_users');
			$this->db->where('email', $username);
			$this->db->where('aktif','Y');
			$result = $this->db->get();
			return $result;
		}
		private function random_hash(){
			$a = rand(1,100000);
			$b = rand(100000,999999);
			$timestamp = sha1(date("YmdHis"));
			$first = sha1($a) . sha1($b);
			return sha1($first.$timestamp);
		}
		public function login_record($username){
			$s = $_SERVER;
			$tgl = date("Y-m-d H:i:s");
			$expired = date("Y-m-d H:i:s",strtotime($tgl) + 12 * 60 * 60);
			
			$token = $this->random_hash();
			
			//save data to database
			if(query("INSERT INTO rb_admin_log VALUES (NULL, ".quote($username).", ".quote($tgl).", ".quote($expired).", ".quote($token).", ".quote($s['REMOTE_ADDR']).", ".quote($s['HTTP_USER_AGENT']).")")){
				
				$_SESSION['current_token'] = $token;
				
			}
			return true;
		}
		
		public function fail_record($username){
			$s = $_SERVER;
			$tgl = date("Y-m-d H:i:s");
			
			$data = [
			'username'=>$username,
			'tgl'=>$tgl,
			'ip'=>$s['REMOTE_ADDR'],
			'useragent'=>$s['HTTP_USER_AGENT'],
			'stat'=>0
			];
			$this->db->insert('rb_admin_fail', $data);
			
			return true;
		}
	}																																																					