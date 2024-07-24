<?php 
	class Model_app extends CI_model{
		
		public function pilih($pilih,$table){
			$this->db->select($pilih);
			return $this->db->get($table);
		}
		
		public function pilih_where($select,$table,$data){
			$this->db->select($select);
			$this->db->where($data);
			return $this->db->get($table);
		}
		
        public function hapus($table, $where){
            if($this->db->delete($table, $where))
            {
                $arr['status'] =  "ok";
                $arr['msg'] =  "Input berhasil";
                }else{
                $arr['status'] =  "error";
                $arr['msg'] =  "Gagal input data";
			}
            return $arr;
		}
        public function input($table,$data){
            if($this->db->insert($table, $data))
            {
                $arr['status'] = true;
                $arr['msg'] =  "Input berhasil";
                $arr['id'] = $this->db->insert_id();
                }else{
                $arr['status'] = false;
                $arr['msg'] =  "Input gagal";
                $arr['id'] =  "";
			}
			
            return $arr;
		}
		
		public function input_tr($table,$data){
			$this->db->trans_begin();
            $this->db->insert($table, $data);
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				$arr['status'] =  "error";
                $arr['msg'] =  "Gagal input data";
                $arr['id'] =  "";
			}
			else
			{
				$this->db->trans_commit();
				$arr['status'] =  "ok";
                $arr['msg'] =  "Input berhasil";
                $arr['id'] = $this->db->insert_id();
			}
			
            return $arr;
		}
		public function update($table, $data, $where){
            if($this->db->update($table, $data, $where))
            {
                $arr['status'] =  "ok";
                $arr['msg'] =  "Update berhasil";
                $arr['id'] = '';
                }else{
                $arr['status'] =  "error";
                $arr['msg'] =  "Gagal input data";
                $arr['id'] =  "";
			}
			
            return $arr;
		}
		
		
		public function update_tr($table, $data, $where){
			$this->db->trans_begin();
            $this->db->update($table, $data, $where);
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				$arr['status'] =  "error";
                $arr['msg'] =  "Gagal update data";
			}
			else
			{
				$this->db->trans_commit();
				$arr['status'] =  "ok";
                $arr['msg'] =  "update berhasil";
			}
            return $arr;
		}
		
		public function view($table){
			return $this->db->get($table);
		}
		
		public function insert($table,$data){
			return $this->db->insert($table, $data);
		}
		
		public function edit($table, $data){
			return $this->db->get_where($table, $data);
		}
		
		public function delete($table, $where){
			return $this->db->delete($table, $where);
		}
		
		public function view_wherein($table,$data){
			$this->db->where_in($data);
			return $this->db->get($table);
		}
		public function view_where($table,$data){
			$this->db->where($data);
			return $this->db->get($table);
		}
		
		public function view_where_like($table,$where,$data,$before=''){
			$this->db->like($where,$data,$before);
			return $this->db->get($table);
		}
		public function view_where_or_like($table,$where,$like,$or_like){
			$this->db->where($where);
			$this->db->like($like);
			$this->db->or_like($or_like);
			return $this->db->get($table);
		}
		public function view_where_not_like($table,$where,$not_like,$or_not_like){
			$this->db->where($where);
			$this->db->not_like($not_like);
			$this->db->not_like($or_not_like);
			return $this->db->get($table);
		}
		public function view_select_where($select,$table,$data){
			$this->db->select($select);
			$this->db->where($data);
			return $this->db->get($table);
		}
		public function view_where_in($table,$baris,$data){
			
			$this->db->where_in($baris,$data);
			return $this->db->get($table);
		}
		public function view_like($table,$data){
			$this->db->like($data);
			return $this->db->get($table);
		}
		public function view_or_where($table,$where,$or_where){
			$this->db->where($where);
			$this->db->or_where($or_where);
			return $this->db->get($table);
		}
		
		public function view_or_like($table,$data,$data1,$data2){
			$this->db->like($data);
			$this->db->or_like($data1);
			$this->db->or_like($data2);
			return $this->db->get($table);
		}
		
		public function view_like_group($table,$data,$group){
			$this->db->like($data);
			$this->db->group_by($group);
			return $this->db->get($table);
		}
		
		public function view_ordering_limit($table,$order,$ordering,$baris,$dari){
			$this->db->select('*');
			$this->db->order_by($order,$ordering);
			$this->db->limit($dari, $baris);
			return $this->db->get($table);
		}
		public function view_where_ordering_limit($table,$data,$order,$ordering,$baris){
			$this->db->where($data);
			$this->db->order_by($order,$ordering);
			$this->db->limit($baris);
			// return $this->db->get($table)->result_array();
			return $this->db->get($table);
		}
		
		public function view_ordering_lenght($table,$pilih,$kolom,$lenght,$order,$ordering){
			$this->db->select($pilih);
			$this->db->from($table);
			$this->db->where("LENGTH($kolom)",$lenght);
			$this->db->order_by($order,$ordering);
			return $this->db->get();
		}
		
		public function view_ordering_distinct($table,$kolom,$order,$ordering){
			$this->db->distinct($kolom);
			$this->db->select($kolom);
			$this->db->from($table);
			$this->db->order_by($order,$ordering);
			return $this->db->get();
		}
		
		public function view_ordering($table,$order,$ordering){
			$this->db->select('*');
			$this->db->from($table);
			$this->db->order_by($order,$ordering);
			return $this->db->get();
		}
		
		public function view_where_ordering($table,$data,$order,$ordering){
			$this->db->where($data);
			$this->db->order_by($order,$ordering);
			return $this->db->get($table);
		}
		
		public function view_join_one($table1,$table2,$field,$order,$ordering){
			$this->db->select('*');
			$this->db->from($table1);
			$this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
			$this->db->order_by($order,$ordering);
			return $this->db->get()->result_array();
		}
		public function view_join_where_ordering($select,$table1,$table2,$field1,$field2,$where,$order,$ordering){
			$this->db->select($select);
			$this->db->from($table1);
			$this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
			$this->db->where($where);
			$this->db->order_by($order,$ordering);
			return $this->db->get();
		}
		public function view_join_where($table1,$table2,$field,$where,$order,$ordering){
			$this->db->select('*');
			$this->db->from($table1);
			$this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
			$this->db->where($where);
			$this->db->order_by($order,$ordering);
			return $this->db->get()->result_array();
		}
		public function join_where($select,$table1,$table2,$field1,$field2,$where){
			$this->db->select($select);
			$this->db->from($table1);
			$this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
			$this->db->where($where);
			return $this->db->get();
		}
		public function pilih_1($table,$where){
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($where);
			return $this->db->get()->result_array();
		}
		public function pilih_max($max,$table,$where){
			$this->db->select_max($max);
			$this->db->from($table);
			$this->db->where($where);
			return $this->db->get()->row()->$max;
		}
		
		public function cek_total($table,$select,$where){
			$this->db->select($select);
			$this->db->from($table);
			$this->db->where($where);
			return $this->db->get()->row();
		}
		
		public function sum_data($strsum,$table,$where){
			$this->db->select_sum($strsum);
			$this->db->where($where);
			$query = $this->db->get($table);  
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result->$strsum;
		}
		public function sum_data_group($strsum,$table,$where,$group){
			$this->db->select_sum($strsum);
			$this->db->where($where);
			$this->db->group_by($group);
			$query = $this->db->get($table);  
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result->$strsum;
		}
		
		public function sum_data_math($strsum,$table,$where,$group){
			$this->db->select($strsum);
			$this->db->where($where);
			$this->db->group_by($group);
			$query = $this->db->get($table);  
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result->total;
		}
		
		public function counter($table,$params=array()){
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			
			if(array_key_exists("search", $params))
			{
				if(!empty($params['search']['level'])){ 
					$this->db->where("level !='{$params['search']['level']}'"); 
				} 
				
			} 
			
			$result = $this->db->count_all_results($table);
			return $result; 
			
		}
		function cek_crud($type=''){
			$id_type = $this->cek_type($type);
			
			$this->db->where("FIND_IN_SET('$id_type', CONCAT(type_akses, ',')) AND id_user=".$this->session->iduser);
			$query = $this->db->get('tb_users'); 
			$result = ($query->num_rows() > 0)?TRUE:FALSE; 
			return $result;
		}
		
		public function cek_type($type){
			$this->db->select('id');
			$this->db->where('title',$type);
			$query = $this->db->get('type_akses');  
			$result = ($query->num_rows() > 0)?$query->row()->id:FALSE; 
			return $result;
		}
		public function last_id($table){
			$last = $this->db->order_by('id',"asc")
			->limit(1)
			->get($table)
			->row();
			return $last;
		}
		
	}																															