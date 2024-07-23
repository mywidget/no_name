<?php 
	class Model_whatsapp extends CI_model{
		
		function getDevice($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_device'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('device', $params['search']['keywords']); 
				} 
				
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_device`.`id`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_device.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_device.id', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getTemplate($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_template_pesan'); 
			
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
				$this->db->order_by('`rb_template_pesan`.`id`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_template_pesan.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_template_pesan.id', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		function getReport($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_report_pesan'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('device', $params['search']['keywords']); 
					$this->db->or_like('target', $params['search']['keywords']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_report_pesan`.`id`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_report_pesan.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_report_pesan.id', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getBroadcast($params = array()){
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('rb_broadcast'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('device', $params['search']['keywords']); 
					$this->db->or_like('target', $params['search']['keywords']); 
				} 
				
			}
			
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`rb_broadcast`.`id`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('rb_broadcast.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('rb_broadcast.id', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		
		public function cek_device($id,$val)
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
		
		public function getPengirim()
		{
			
			$this->db->select('device');
			$this->db->from('rb_device');
			$this->db->where('device_status','connect');
			$this->db->limit(1);
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->device:0; 
			return $result; 
		}
		
		public function get_unit_byid($id)
		{
			$query = $this->db->select('nomor_hp');
			$query = $this->db->where('id_unit',$id);
			$query = $this->db->get('rb_psb_daftar');
			$result = $query->result();
			return $result;
		}
		public function get_unit_label($id)
		{
			$query = $this->db->select('nomor_hp');
			$query = $this->db->where('s_pendidikan',$id);
			$query = $this->db->get('rb_psb_daftar');
			$result = $query->result();
			return $result;
		}
	}																																																												