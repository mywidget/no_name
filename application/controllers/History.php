<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class History extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			cek_session_login(1);
			
			$this->perPage = 10; 
			$this->title   = info()['title']; 
			$this->iduser  = $this->session->iduser; 
			$this->akses   = $this->session->type_akses; 
			$this->level   = $this->session->level; 
			
			$this->load->model("model_setting","mdsetting");
			
		}
		 
		public function index(){
			// cek_menu_akses();
			$data['title'] = 'Data Inventory | '.$this->title;
			
            // Get record count 
            
            $conditions['returnType'] = 'count';
            $totalRec = $this->mdsetting->getProject($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('history/ajaxHistory');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'search_history';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions = array(
            'limit' => $this->perPage
            );
            
            // Get record count 
            $conditions['where'] = array(
            'stat' => 1
            );
			// $data['parent'] = $this->model_master->load_master();
			// $data['kategori'] = $this->model_master->load_kategori();
            $data['query'] = $this->mdsetting->getProject($conditions);
			$this->thm->load('backend/template','backend/inventory/history',$data);
		}
		
		function ajaxHistory()
        {
            // Define offset 
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
			
			$keywords = $this->input->post('keywords');
			if (!empty($keywords)) {
				$conditions['search']['keywords'] = $keywords;
			}
			
			// Get record count 
			$conditions['returnType'] = 'count';
			$totalRec = $this->mdsetting->getProject($conditions);
			
			// Pagination configuration 
			$config['target']      = '#posts_content';
			$config['base_url']    = base_url('history/ajaxHistory');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $limit;
			$config['link_func']   = 'search_history';
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config);
			
			// Get records 
			$conditions['start'] = $offset;
			$conditions['limit'] = $limit;
			
			unset($conditions['returnType']);
			$data['start'] = $offset;
			$data['query'] = $this->mdsetting->getProject($conditions);
			
			// Load the data list view 
			$this->load->view('backend/inventory/ajax_history',$data);
			
		}
		public function view($id_project){
			$data['title'] = "History Laporan";
			
			$data['row'] = $this->mdsetting->project_detail($id_project);
			$data['list_cc'] = $this->model_report->list_cc();
			$data['listdiv'] = $this->model_report->listdiv("array");
			
			$dtl = 0;
			$filter = "";
			if(isset($_GET['dtl'])){
				$dtl = intval($_GET['dtl']);
			}
			if(isset($_GET['filter'])){
				$filter = $_GET['filter'];
			}
			
			$data['level'] = $this->level;
			$data['detail'] = $dtl;
			
			if(isset($_GET['show'])){
				$show = intval($_GET['show']);
				if($show == 1){
					$data['query'] = $this->mdsetting->report_master($id_project, $dtl);
					$data['show'] = 1;
					$data['title'] .= " Stok CC Master";
				}
				else if($show == 2){
					$data['show'] = 2;
					$data['title'] .= " Stok CC Divisi";
					$data['query'] = $this->mdsetting->report_divisi($id_project, $dtl, $filter);
					
					if(strlen($filter) > 0){
						$data['title'] .= " ".$data['listdiv'][$filter];
					}
				}
			}
			$this->thm->load('backend/template','backend/inventory/laporan',$data);
			
		}
		
		public function new_periode(){
			
			$skrg = date("Y-m-d");
			
			$list = $this->model_mutasi->load_cc();
			$ldiv = $this->model_mutasi->list_divisi();
			// print_r($ldiv);
			$plus = array();
			$arr_kirim = array();
			$arr_terima = array();
			foreach($ldiv as $iddiv=>$nmdiv){
				$x = $this->model_mutasi->get_current_mutasi_stok($list, $iddiv);
				foreach($x as $idm=>$stk){
					$arr_kirim[] = array(
					"id" => null,
					"id_master" => $idm,
					"tag" => parent_barang($idm)->tag,
					"id_divisi" => $iddiv,
					"tgl" => $skrg,
					"jml" => $stk, 
					"ket" => "Data sisa periode",
					"stat" => 1
					);
				}
			}
			// dump($arr_kirim,'print_r','exit');
			//hasil array diatas direpeat ulang utk penambahan bobot pengeluaran
			$plus = array();
			foreach($arr_kirim as $tes){
				if(!isset($plus[$tes['id_master']])){
					$plus[$tes['id_master']] = $tes['jml'];
				}
				else{
					$plus[$tes['id_master']] += $tes['jml'];
				}
			}
			
			$a = $this->model_mutasi->get_current_mutasi_stok($list);
			// dump($a,'print_r','exit');
			foreach($a as $idmaster=>$stok){
				$pls = 0;
				if(isset($plus[$idmaster])){
					$pls = $plus[$idmaster];
				}
				
				$stok_akhir = $stok + $pls;
				
				$arr_terima[] = array(
				"id" => null,
				"id_master" => $idmaster,
				"tag" => parent_barang($idmaster)->tag,
				"tgl" => $skrg, 
				"jml" => $stok_akhir,
				"ket" => "Data awal periode",
				"stat" => 1
				);
			}
			
			//proses truncating data
			$nm = "Untitled";
			if(isset($_GET['nm'])){
				if(strlen($_GET['nm']) > 0)
				$nm = $_GET['nm'];
			}
			$today = today();
			$id_project = $this->mdsetting->get_last_id($nm);
			
			dump($arr_terima,'print_r','exit');
			//tabel translate : cc_terima, cc_kirim, cc_terjual
			$sql = query("INSERT INTO cc_penggunaan 
			SELECT NULL, $id_project, 'cc_terima', id_master, id_divisi, id_form, id_surat, tgl, jml, ket, stat,null FROM cc_terima");
			
			$sql = query("INSERT INTO cc_penggunaan 
			SELECT NULL, $id_project, 'cc_kirim', id_master, id_divisi, id_form, id_surat, tgl, jml, ket, stat,null FROM cc_kirim");
			$sql = query("INSERT INTO cc_penggunaan 
			SELECT NULL, $id_project, 'cc_terjual', id_master, id_divisi, id_form, id_surat, tgl, jml, ket, stat,null FROM cc_terjual");
			$this->model_app->update('cc_penggunaan',['tgl_update'=>$today],['id_project'=>$id_project]);
			// dump($arr_terima,'print_r','exit');
			$this->db->truncate("cc_terima");
			$this->db->truncate("cc_kirim");
			$this->db->truncate("cc_terjual");
			
			//proses penyimpanan ulang data hasil olah periode baru
			$this->db->insert_batch("cc_terima",$arr_terima);
			$this->db->insert_batch("cc_kirim",$arr_kirim);
			
			create_alert("Success","Berhasil pindah ke periode baru","history");
		}
		
		public function penggunaan()
		{
			cek_menu_akses();
			$data['title'] = 'Rekapan Materiel | '.$this->title;
			$data['judul'] = ' Rekapan Materiel';
			$data['sub'] = ' List History';
            // Get record count 
            
			
			$data['tanggal'] = tgl_my();
			$data['dari'] = tgl_dari();
			$data['sampai'] = tanggal();
			
			$data['divisi'] = $this->model_master->load_divisi();
			$data['kategori'] = $this->model_app->view_where('cc_master',['parent'=>0,'stat'=>1]);
			$this->thm->load('backend/template','backend/inventory/history_penggunaan',$data);
		}
		function ajaxPenggunaan()
        {
			
			$tanggal = $this->input->post('tanggal');
			
			$data['bulan'] = month();
			$data['tahun'] = year();
			
			if (!empty($tanggal)) {
				$dt = date_my($tanggal);
				
				$data['bulan'] = $dt['bulan'];
				$data['tahun'] = $dt['tahun'];
			}
			$data['show'] = 'none';
			$satker = $this->input->post('satker');
			
			if ($satker=='') {
				$conditions['where'] = array(
				'hapus' => 1
				);
			}
			if($satker=='semua') {
				$conditions =[];
			}
			
			if ($satker > 0) {
				$data['disabled'] = '';
				$conditions['where'] = array(
				'id' => $satker
				);
			}
			
			$fasmat = $this->input->post('fasmat');
			if (!empty($fasmat)) {
				$data['show'] = '';
				$data['disabled'] = '';
				}else{
				$data['disabled'] = 'disabled';
			}
			
			$data['tag'] = $fasmat;
			
			$data['divisi'] = $this->model_master->load_divisi_where($conditions);
			// Load the data list view 
			$this->load->view('backend/inventory/ajax-history',$data);
			
		}
		
		public function detail_rekapan()
		{
			
			$data['title'] = 'Detail Penggunaan Materiel | '.$this->title;
			$materiel = $this->input->post('detail_materiel');
			if(isset($materiel))
			{
				$data['id_divisi'] = $this->input->post('id_divisi');
				$data['dari'] = $this->input->post('tanggal_dari');
				$data['sampai'] = $this->input->post('tanggal_sampai');
				$cek_idmaster = cek_idmaster($materiel);
				$data['type'] = strtoupper($materiel);
				
				// dump($_POST,'print_r','exit');
				
				$data['title_periode'] = 'Periode : '.$data['dari'].'/'.$data['sampai'];
				$data['jenis'] = 'tahun';
				$caption = $this->model_app->view_where('kategori',['tag'=>$materiel,'stat'=>1,'idparent'=>0])->row();
				$data['caption']  = !empty($caption->caption) ? $caption->caption : $type;
				
				$data['idmaster'] = $cek_idmaster['id'];
				$conditions['where'] = array(
				'idparent' => 0,
				'stat' => 1,
				'id_master' => $cek_idmaster['id'],
				);
				$list_cc = $this->model_data->form_penggunaan($conditions);
				$data['list_cc'] = $this->categories($list_cc,$cek_idmaster['id']);
				
				$this->thm->load('backend/template','backend/inventory/form_penggunaan_rekapan',$data);
				}else{
				$this->thm->load('backend/template','backend/blank',$data);
			}
		}
		private function categories($categories,$idmaster){
			$i=0;
			foreach($categories as $p_cat){
				
				$categories[$i]->sub = $this->model_data->sub_categories($p_cat->id,$idmaster);
				$i++;
			}
			return $categories;
		}
		
		public function print_rekapan(){
			$data['title'] = 'Rekapan | '.$this->title;
			
			$tanggal = $this->input->post('tanggal_rekapan');
			$dt = date_my($tanggal);
			$data['dari'] = $dt['bulan'];
			$data['sampai'] = $dt['tahun'];
			$materiel = $this->input->post('materiel');
			 
			$data['kasubdit'] = ttd_user('kasubdit');
			$data['materiel'] = strtoupper($materiel);
			$data['bulan'] = strtoupper(getBulan($data['dari'])) .' '. ($data['sampai']);
			$data['divisi'] = $this->model_master->load_divisi();
			$data['stok_awal_gudang'] = stok_awal_divisi($materiel,0,$data['dari'],$data['sampai'])['stok_awal_gudang'];
			// $data['stok_penerimaan'] =  stok_awal_divisi($materiel,0,$data['dari'],$data['sampai'])['stok_terima'];
			$data['stok_penerimaan'] =  $this->model_mutasi->real_stok_tag_gudang($materiel,$data['dari'],$data['sampai']);;
			$data['stok_pengiriman'] =  stok_awal_divisi($materiel,0,$data['dari'],$data['sampai'])['stok_kirim'];
			$data['sisa_stok'] = $data['stok_awal_gudang'] + $data['stok_penerimaan'] - $data['stok_pengiriman'];		
			
			// dump($data,'print_r','exit');
			$this->load->view('backend/laporan/cetak_rekapan_'.$materiel,$data);
		}
	}				
