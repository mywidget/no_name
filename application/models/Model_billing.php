<?php 
	class Model_billing extends CI_model{
		
		public function get_alur(){
			
			$this->db->select('*');
			$this->db->from('tagihan_pembayaran');
			$this->db->where('aktif', 'Ya');
			$this->db->order_by('`urutan`', 'ASC'); 
			$parent = $this->db->get();
			
			$result = $parent->result();
			
			return $result;
		}
	}																																