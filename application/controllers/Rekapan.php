<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Rekapan extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			cek_session_login(1);
			$this->perPage = 10; 
			$this->title = info()['title']; 
			$this->iduser = $this->session->iduser; 
			$this->akses = $this->session->type_akses; 
			
		}
		
		public function index(){
			$data['title'] = 'Rekapan Materiel | '.$this->title;
			$data['periode'] = date('m/Y');	
			
            $data['tahun'] = $this->model_report->getRekapanByYear();
			
			$conditions['where'] = array(
			'tb' => 'cc_terjual'
			);
			$conditions['returnType'] = 'count';
			$totalRec = $this->model_data->getRekapan($conditions);
			
			// Pagination configuration 
			$config['target']      = '#posts_content';
			$config['base_url']    = base_url('rekapan/ajaxRekapan');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $this->perPage;
			$config['link_func']   = 'search_rekapan';
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config);
			
			// Get records 
			$conditions = array(
			'limit' => $this->perPage
			);
			
			$conditions['where'] = array(
			'tb' => 'cc_terjual'
			);
			
			$data['list'] = $this->model_data->getRekapan($conditions);
			$this->thm->load('backend/template','backend/inventory/rekapan',$data);
		}
		
		public function ajaxRekapan(){
			
			$page = $this->input->post('page');
            if (!$page) {
                $offset = 0;
                } else {
                $offset = $page;
			}
			$limit = $this->input->post('limit');
            if (!$limit) {
                $limit = $this->perPage;
                } else {
                $limit = $limit;
			}
             
            $sortBy = $this->input->post('sortBy');
            if (!empty($sortBy)) {
                $conditions['search']['sortBy'] = $sortBy;
			}
			$bulan = $this->input->post('bulan');
            if (!empty($bulan)) {
                $conditions['search']['bulan'] = $bulan;
			}
            
			$conditions['where'] = array(
			'tb' => 'cc_terjual'
			);
			
            // Get record count 
			$conditions['returnType'] = 'count';
			$totalRec = $this->model_data->getRekapan($conditions);
			
			// Pagination configuration 
			$config['target']      = '#posts_content';
			$config['base_url']    = base_url('rekapan/ajaxRekapan');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $this->perPage;
			$config['link_func']   = 'search_rekapan';
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config);
			
			// Get records 
			$conditions['start'] = $offset;
            $conditions['limit'] = $limit;
			
			$conditions['where'] = array(
			'tb' => 'cc_terjual'
			);
			unset($conditions['returnType']);
			$data['start'] = $offset;
			$data['list'] = $this->model_data->getRekapan($conditions);
			$this->load->view('backend/inventory/ajax-rekapan',$data);
		}
		public function detail(){
			// print_r($_POST);
			$data['title'] = 'Rekapan | '.$this->title;
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$materiel = $this->input->post('materiel');
			$id_master = $this->input->post('id_master');
			$data['kasubdit'] = ttd_user('kasubdit');
			$data['materiel'] = strtoupper($materiel);
			$data['bulan'] = strtoupper(getBulan($bulan)) .' '. $tahun;
			$data['divisi'] = $this->model_master->load_divisi();
			
			$this->load->view('backend/laporan/cetak_rekapan_'.$materiel,$data);
		}
			public function print_rekapan(){
			// print_r($_POST);
			$data['title'] = 'Rekapan | '.$this->title;
			
			$tanggal = $this->input->post('tanggal_rekapan');
			if (!empty($tanggal)) {
				$dt = periode($tanggal);
				$data['dari'] = $dt['awal'];
				$data['sampai'] = $dt['akhir'];
				 
				$materiel = $this->input->post('materiel');
				// $id_master = $this->input->post('id_master');
				
				$data['kasubdit'] = ttd_user('kasubdit');
				$data['materiel'] = strtoupper($materiel);
				$data['bulan'] = getYear($dt['akhir']);
				$data['divisi'] = $this->model_master->load_divisi();
				
				$this->load->view('backend/laporan/cetak_rekapan_'.$materiel,$data);
			}
		}
	}				
