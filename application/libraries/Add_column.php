<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Add_column {
		private $name; 
		
		public function add_column_bahan()
		{
			$fields = array(
			'harga_jual' => array(
			'type' => 'INT',
			'constraint' => 11,
			'after' => 'harga_modal',
			'null' => FALSE,
			'default' => 0,
			),
			'id_satuan' => array(
			'type' => 'INT',
			'constraint' => 11,
			'null' => FALSE,
			'default' => 0,
			),
			'status_stok' => array(
			'type' => 'ENUM("Y","N")',
			'null' => FALSE,
			'default' => 'N',
			),
			'kunci' => array(
			'type' => 'INT',
			'constraint' => 1,
			'null' => FALSE,
			'default' => 0,
			),
			'status' => array(
			'type' => 'INT',
			'constraint' => 1,
			'null' => FALSE,
			'default' => 0,
			),
			'pub' => array(
			'type' => 'INT',
			'constraint' => 1,
			'null' => FALSE,
			'default' => 0,
			)
			);
			return $this->name = $fields;
		}
		public function add_column_aktiva()
		{
			$fields = array(
			'aktiva' => array(
			'type' => 'INT',
			'constraint' => 1,
			'after' => 'keterangan',
			'null' => FALSE,
			'default' => '0',
			),
			'pasiva' => array(
			'type' => 'INT',
			'constraint' => 1,
			'after' => 'aktiva',
			'null' => FALSE,
			'default' => '0',
			),
			'kewajiban' => array(
			'type' => 'INT',
			'constraint' => 1,
			'after' => 'pasiva',
			'null' => FALSE,
			'default' => '0',
			),
			'urutan' => array(
			'type' => 'INT',
			'constraint' => 4,
			'after' => 'kewajiban',
			'null' => FALSE,
			'default' => '0',
			),
			'kunci' => array(
			'type' => 'INT',
			'constraint' => 1,
			'after' => 'urutan',
			'null' => FALSE,
			'default' => '0',
			)
			);
			return $this->name = $fields;
		}
		
		public function produk(){
			$fields = array(
			'ukuran' => array(
			'type' => 'VARCHAR',
			'constraint' => 10,
			'after' => 'diskon',
			'null' => TRUE,
			)
			);
			return $this->name = $fields;
		}
		
		public function bayar_detail(){
			$this->load->dbforge();
			$fields = array(
				'jam_bayar' => array(
					'type' => 'TIME',
					'after' => 'tgl_bayar',
					'null' => TRUE,
				)
			);
			return $this->name = $fields;
		}
		
		public function suratjalan()
		{
			$menu = array('idparent' => '155','id_level' => '1,2,3,4,5,6','nama_menu' => 'Surat jalan','link' => 'laporan/suratjalan','target' => '_self','link_on' => 'N','treeview' => '','classes' => NULL,'classicon' => 'Y','icon' => '','aktif' => 'Y','level' => NULL,'urutan' => '15');
			
			return $this->name = $menu;
		}
		
		function get_name() {
			return $this->name;
		}
	}																							