<?php
	defined("BASEPATH") or exit();
	
	Class Model_setting extends CI_Model{
		
		public function get_last_id($nm){
			$arr = array(
			"id" => null,
			"nama_project" => $nm,
			"update_date" => date("Y-m-d H:i:s"),
			"stat" => 1
			);
			$this->db->insert("cc_project",$arr);
			$id = $this->db->insert_id();
			return $id;
		}
		function getPenggunaan($params = array()){
			print_r($params);
			$this->db->select('*')
			->from('cc_terjual');
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('nama_project', $params['search']['keywords']); 
				} 
				if(!empty($params['search']['sortBy'])){
					$this->db->order_by('`cc_project`.`id`', $params['search']['sortBy']); 
				}
			}
			
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('cc_project.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('cc_project.id', 'ASC'); 
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
		
	}			