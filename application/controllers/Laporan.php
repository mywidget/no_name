<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Laporan extends CI_Controller
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
			$this->level = $this->session->level; 
			$this->id_divisi = $this->session->id_divisi; 
			$this->load->model("model_setting","mdsetting");
			
		}
		
		public function index(){
			$data['title'] = 'Laporan | '.$this->title;
			
			$this->load->model("model_report");
			$data['list_cc'] = $this->model_report->list_cc();
			$data['listdiv'] = $this->model_report->listdiv("array");
			
			// $dtl = 0;
			$dtl    = $this->input->get('dtl');
			$filter = $this->input->get('filter');
			$show   = $this->input->get('show');
			
			if(isset($dtl)){
				$dtl = intval($dtl);
			}
			if(isset($filter)){
				$filter = $filter;
			}
			
			$data['level'] = $this->level;
			$data['id_divisi'] = $this->id_divisi;
			$data['detail'] = $dtl;
			$data['filter'] = $filter;
			
			if(isset($show)){
				$show = intval($show);
				if($show == 1){
					$data['query'] = $this->model_report->report_master($dtl);
					$data['show'] = 1;
					$data['title'] .= " Stok CC Master";
				}
				else if($show == 2){
					$data['show'] = 2;
					$data['title'] .= " Stok CC Divisi";
					$data['query'] = $this->model_report->report_divisi($dtl, $filter);
					
					if(strlen($filter) > 0){
						$data['title'] .= " ".$data['listdiv'][$filter];
					}
				}
				
			}
			
			$data['date'] = date("Y-m-d");
			$this->thm->load('backend/template','backend/inventory/laporan',$data);
		}
		
		public function penerimaan()
		{
			// cek_menu_akses();
			$data['title'] = 'Data Barang | '.$this->title;
			
            // Get record count 
            if($this->level=='admin'){
				$data['judul'] = ' Laporan Penerimaan';
				$data['sub'] = ' List Penerimaan';
				$data['tanggal'] = tgl_dari_slash() . ' - ' .tgl_sampai_slash();
				$conditions['search']['dari'] = tgl_dari();
				$conditions['search']['sampai'] = tanggal();
				
				$conditions['returnType'] = 'count';
				$totalRec = $this->model_data->getPenerimaan($conditions);
				
				// Pagination configuration 
				$config['target']      = '#posts_content';
				$config['base_url']    = base_url('laporan/ajaxPenerimaan');
				$config['total_rows']  = $totalRec;
				$config['per_page']    = $this->perPage;
				$config['link_func']   = 'search_penerimaan';
				
				// Initialize pagination library 
				$this->ajax_pagination->initialize($config);
				
				// Get records 
				$conditions = array(
				'limit' => $this->perPage
				);
				
				$conditions['where'] = array(
				'status' => 1
				);
				$conditions['search']['dari'] = tgl_dari();
				$conditions['search']['sampai'] = tanggal();
				
				$data['list'] = $this->model_data->getPenerimaan($conditions);
				$data['kategori'] = $this->model_app->view_where('cc_master',['parent'=>0,'stat'=>1]);
				$this->thm->load('backend/template','backend/inventory/laporan_penerimaan',$data);
				}else{
				$this->pengiriman();
			}
		}
		
		function ajaxPenerimaan()
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
			$fasmat = $this->input->post('fasmat');
			if (!empty($fasmat)) {
				$conditions['search']['fasmat'] = $fasmat;
			}
			$tanggal = $this->input->post('tanggal');
			if (!empty($tanggal)) {
				$dt = periode($tanggal);
				
				$conditions['search']['dari'] 	= $dt['awal'];
				$conditions['search']['sampai'] = $dt['akhir'];
			}
			
			// Get record count 
			$conditions['returnType'] = 'count';
			$totalRec = $this->model_data->getPenerimaan($conditions);
			
			// Pagination configuration 
			$config['target']      = '#posts_content';
			$config['base_url']    = base_url('laporan/ajaxPenerimaan');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $limit;
			$config['link_func']   = 'search_penerimaan';
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config);
			
			// Get records 
			$conditions['start'] = $offset;
			$conditions['limit'] = $limit;
			
			$conditions['where'] = array(
			'status' => 1
			);
			// $sWhere = "WHERE level='owner' AND parent='$iduser' OR level='marketing' AND parent='$iduser'";
			unset($conditions['returnType']);
			$data['start'] = $offset;
			$data['list'] = $this->model_data->getPenerimaan($conditions);
			
			// Load the data list view 
			$this->load->view('backend/inventory/ajax-penerimaan',$data);
			
		}
		
		public function detail_penerimaan($id='')
		{
			$data['title'] = 'Detail Penerimaan Materiel | '.$this->title;
			$decrypt_url = decrypt_url($id);
			if($decrypt_url > 0 AND $this->level=='admin'){
				$result = $this->model_app->view_where('penerimaan',['id'=>$decrypt_url]);
				if($result->num_rows() > 0){
					$data['row'] = $result->row();
					$this->thm->load('backend/template','backend/inventory/detail_laporan_penerimaan',$data);
				}
				}else{
				$this->thm->load('backend/template','backend/blank',$data);
			}
		}
		
		public function detail_penggunaan($id_divisi='',$id='')
		{
			
			$data['title'] = 'Detail Penggunaan Materiel | '.$this->title;
			$id_divisi = decrypt_url($id_divisi);
			$decrypt_url = decrypt_url($id);
			
			if($decrypt_url  > 0)
			{
				if($decrypt_url > 0 AND $this->level=='admin'){
					$result = $this->model_app->view_where('data_penggunaan',['id'=>$decrypt_url,'id_divisi'=>$id_divisi]);
					}else{
					$result = $this->model_app->view_where('data_penggunaan',['id'=>$decrypt_url,'id_divisi'=>$this->id_divisi]);
				}
				// dump($decrypt_url,'print_r','exit');
				if($result->num_rows() > 0)
				{
					$data['id'] = $id;
					$data['row'] = $result->row();
					$this->thm->load('backend/template','backend/inventory/detail_laporan_penggunaan',$data);
					}else{
					$this->thm->load('backend/template','backend/blank',$data);
				}
				}else{
				$this->thm->load('backend/template','backend/blank',$data);
			}
		}
		
		public function detail_rekapan($type='',$divisi='',$jenis='',$periode='')
		{
			$data['title'] = 'Detail Penggunaan Materiel | '.$this->title;
			$type = $this->input->post('detail_materiel');
			$divisi = $this->input->post('id_divisi');
			$periode = $this->input->post('tanggal_detail');
			
			if(isset($periode))
			{
				
				
				$dt = periode($periode);
				
				$awal = $dt['awal'];
				$akhir = $dt['akhir'];
				$data['title_periode'] = 'Tanggal : '.indo_date($awal,"half") .' - '.indo_date($akhir,"half");
				
				$data['id_divisi'] = $divisi;
				$data['dari'] = $awal;
				$data['sampai'] = $akhir;
				// dump($awal,'print_r','exit');
				$cek_idmaster = cek_idmaster($type);
				$data['type'] = strtoupper($type);
				$caption = $this->model_app->view_where('kategori',['tag'=>$type,'stat'=>1,'idparent'=>0])->row();
				$data['caption']  = !empty($caption->caption) ? $caption->caption : $type;
				
				$data['idmaster'] = $cek_idmaster['id'];
				$conditions['where'] = array(
				'idparent' => 0,
				'stat' => 1,
				'id_master' => $cek_idmaster['id'],
				);
				$list_cc = $this->model_data->form_penggunaan($conditions);
				$data['list_cc'] = $this->categories($list_cc,$cek_idmaster['id']);
				// dump($_POST,'print_r','exit');
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
		
		public function pengiriman()
		{
			
			// cek_menu_akses();
			$data['title'] = 'Data Barang | '.$this->title;
			if($this->level=='admin'){
				$data['judul'] = ' Laporan Pengiriman';
				$data['sub'] = ' List Pengiriman';
				$data['id_divisi'] = '';
				$where['where'] = array();
			}
			
			$get = $this->input->get();
			if(!empty($get)){
				$tanggal = $this->input->get('tgl');
				$data['satker'] = $this->input->get('satker');
				$data['materiel'] = strtoupper($this->input->get('materiel'));
				$data['tanggal'] = tgl_pengiriman($tanggal) . ' - ' .tgl_pengiriman($tanggal);
				}else{
				$data['satker'] = '';
				$data['materiel'] = '';
				$data['tanggal'] = tgl_dari_slash() . ' - ' .tgl_sampai_slash();
			}
            // Get record count 
            if($this->level!='admin'){
				$data['judul'] = ' Laporan Penerimaan';
				$data['sub'] = ' List Penerimaan';
				$data['id_divisi'] = $this->id_divisi;
				
				$conditions['where'] = array(
				'id_divisi' => $this->id_divisi
				);
				if(!empty($get) AND $data['satker'] != $this->id_divisi){
					$this->thm->load('backend/template','backend/blank',$data);
				}
			}
			
			// dump($data['materiel'],'print_r','exit');
			
			$conditions['search']['dari'] = tgl_dari();
			$conditions['search']['sampai'] = tanggal();
			
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getPengiriman($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('laporan/ajaxPengiriman');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'search_sppm';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
			
			// Get records 
			$conditions = array(
			'limit' => $this->perPage
			);
			
			// Get record count 
			if($this->level!='admin'){
				$conditions['where'] = array(
				'id_divisi' => $this->id_divisi
				);
				
				$where['where'] = array(
				'id' => $this->id_divisi
				);
			}
			$data['typeakses']=$this->session->typeakses;
			$conditions['search']['dari'] = tgl_dari();
			$conditions['search']['sampai'] = tanggal();
			$data['list'] = $this->model_data->getPengiriman($conditions);
			$data['divisi'] = $this->model_master->load_divisi_where($where);
			$data['kategori'] = $this->model_app->view_where('cc_master',['parent'=>0,'stat'=>1]);
			$this->thm->load('backend/template','backend/inventory/laporan_pengiriman',$data);
		}
		function ajaxPengiriman()
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
			$fasmat = $this->input->post('fasmat');
			if (!empty($fasmat)) {
				$conditions['search']['fasmat'] = strtolower($fasmat);
			}
			
			
			$tanggal = $this->input->post('tanggal');
			if (!empty($tanggal)) {
				$dt = periode($tanggal);
				
				$conditions['search']['dari'] 	= $dt['awal'];
				$conditions['search']['sampai'] = $dt['akhir'];
			}
			if($this->level!='admin'){
				$conditions['where'] = array(
				'id_divisi' => $this->id_divisi
				);
				}else{
				
			}
			$satker = $this->input->post('satker');
			if (!empty($satker)) {
				$conditions['where'] = array(
				'id_divisi' => $satker
				);
			}
			// Get record count 
			$conditions['returnType'] = 'count';
			$totalRec = $this->model_data->getPengiriman($conditions);
			
			// Pagination configuration 
			$config['target']      = '#posts_content';
			$config['base_url']    = base_url('laporan/ajaxPengiriman');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $limit;
			$config['link_func']   = 'search_sppm';
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config);
			
			// Get records 
			$conditions['start'] = $offset;
			$conditions['limit'] = $limit;
			
			if($this->level!='admin'){
				$conditions['where'] = array(
				'id_divisi' => $this->id_divisi
				);
			}
			
			unset($conditions['returnType']);
			
			$data['list'] = $this->model_data->getPengiriman($conditions);
			
			// Load the data list view 
			$this->load->view('backend/inventory/ajax-pengiriman',$data);
			
		}
		
		public function penggunaan()
		{
			cek_menu_akses();
			$data['title'] = 'Data Penggunaan | '.$this->title;
			$data['judul'] = ' Laporan Penggunaan';
			$data['sub'] = ' List Penggunaan';
			$data['tanggal'] = tgl_dari_slash() . ' - ' .tgl_sampai_slash();
            // Get record count 
			if($this->level!='admin'){
				$conditions['where'] = array(
				'id_divisi' => $this->id_divisi
				);
				
			}
			$conditions['search']['sortBy'] = 'DESC';
			$conditions['search']['dari'] = tgl_dari();
			$conditions['search']['sampai'] = tanggal();
			
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getPenggunaan($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('laporan/ajaxPenggunaan');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'search_penggunaan';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
			
			// Get records 
			$conditions = array(
			'limit' => $this->perPage
			);
			$data['divisi'] = $this->model_master->load_divisi();
			// Get record count 
			if($this->level!='admin'){
				$conditions['where'] = array(
				'id_divisi' => $this->id_divisi
				);
				$where = "id=$this->id_divisi AND";
				$data['divisi'] = $this->model_master->load_divisi($where);
				
			}
			$conditions['search']['sortBy'] = 'DESC';
			$conditions['search']['dari'] = tgl_dari();
			$conditions['search']['sampai'] = tanggal();
			$data['id_divisi'] = $this->id_divisi;
			$data['periode'] = tgl_my();
			$data['typeakses']=$this->session->typeakses;
			$data['list'] = $this->model_data->getPenggunaan($conditions);
			$data['satker'] = '';
			
			$data['kategori'] = $this->model_app->view_where('cc_master',['parent'=>0,'stat'=>1]);
			$this->thm->load('backend/template','backend/inventory/laporan_penggunaan',$data);
		}
		
		public function penggunaaned()
		{
			cek_menu_akses();
			$data['title'] = 'Data Penggunaan | '.$this->title;
			$data['judul'] = ' Laporan Penggunaan';
			$data['sub'] = ' List Penggunaan';
			$data['tanggal'] = tgl_dari_slash() . ' - ' .tgl_sampai_slash();
            // Get record count 
			if($this->level!='admin'){
				$conditions['where'] = array(
				'id_divisi' => $this->id_divisi
				);
				
			}
			$conditions['search']['sortBy'] = 'DESC';
			$conditions['search']['dari'] = tgl_dari();
			$conditions['search']['sampai'] = tanggal();
			
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getPenggunaan($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('laporan/ajaxPenggunaan');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'search_penggunaan';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
			
			// Get records 
			$conditions = array(
			'limit' => $this->perPage
			);
			$data['divisi'] = $this->model_master->load_divisi();
			// Get record count 
			if($this->level!='admin'){
				$conditions['where'] = array(
				'id_divisi' => $this->id_divisi
				);
				$where = "id=$this->id_divisi AND";
				$data['divisi'] = $this->model_master->load_divisi($where);
				
			}
			
			$conditions['search']['dari'] = tgl_dari();
			$conditions['search']['sampai'] = tanggal();
			$data['id_divisi'] = $this->id_divisi;
			$data['periode'] = tgl_my();
			$data['typeakses']=$this->session->typeakses;
			$data['list'] = $this->model_data->getPenggunaan($conditions);
			$data['satker'] = '';
			
			$data['kategori'] = $this->model_app->view_where('cc_master',['parent'=>0,'stat'=>1]);
			$this->thm->load('backend/template','backend/inventory/laporan_penggunaan',$data);
		}
		function ajaxPenggunaan()
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
			if($this->level!='admin'){
				$conditions['where'] = array(
				'id_divisi' => $this->id_divisi
				);
				$where = "id=$this->id_divisi AND";
				$data['divisi'] = $this->model_master->load_divisi($where);
				
			}
			
			$data['periode'] = '';
			$tanggal = $this->input->post('tanggal');
			if (!empty($tanggal)) {
				$dt = periode($tanggal);
				
				$conditions['search']['dari'] 	= $dt['awal'];
				$conditions['search']['sampai'] = $dt['akhir'];
				$data['periode'] = $tanggal;
			}
			// dump($data,'print_r','exit;');
			//filter berdasarkan satuan kerja
			$satker = $this->input->post('satker');
			if (!empty($satker) AND $satker!='semua') {
				$conditions['search']['satker'] = $satker;
			}
			//filter berdasarkan materiel
			$fasmat = $this->input->post('fasmat');
			if (!empty($fasmat)) {
				$conditions['search']['fasmat'] = $fasmat;
			}
			//sorting
			$sortBy = $this->input->post('sorting');
			if (!empty($sortBy)) {
				$conditions['search']['sortBy'] = $sortBy;
			}
			// dump($conditions,'print_r','exit;');
			// Get record count 
			$conditions['returnType'] = 'count';
			$totalRec = $this->model_data->getPenggunaan($conditions);
			
			// Pagination configuration 
			$config['target']      = '#posts_content';
			$config['base_url']    = base_url('laporan/ajaxPenggunaan');
			$config['total_rows']  = $totalRec;
			$config['per_page']    = $limit;
			$config['link_func']   = 'search_penggunaan';
			
			// Initialize pagination library 
			$this->ajax_pagination->initialize($config);
			
			// Get records 
			$conditions['start'] = $offset;
			$conditions['limit'] = $limit;
			if($this->level!='admin'){
				$conditions['where'] = array(
				'id_divisi' => $this->id_divisi
				);
				$where = "id=$this->id_divisi AND";
				$data['divisi'] = $this->model_master->load_divisi($where);
			}
			if (!empty($satker) AND $satker!='semua') {
				$conditions['search']['satker'] = $satker;
			}
			$data['fasmat'] = '';
			if (!empty($fasmat)) {
				$conditions['search']['fasmat'] = $fasmat;
				$data['fasmat'] = $fasmat;
			}
			if (!empty($sortBy)) {
				$conditions['search']['sortBy'] = $sortBy;
			}
			unset($conditions['returnType']);
			
			$data['start'] = $offset;
			$data['list'] = $this->model_data->getPenggunaan($conditions);
			$data['satker'] = $satker;
			// dump($data,'print_r','exit;');
			// Load the data list view 
			$this->load->view('backend/inventory/ajax-penggunaan',$data);
			
		}
		
		public function cek_penggunaan(){
			$satker = $this->db->escape_str($this->input->post('satker'));
			$fasmat = $this->db->escape_str($this->input->post('fasmat'));
			$periode = $this->db->escape_str($this->input->post('periode'));
			
			
			// dump($_POST,'print_r');
			$conditions['search']['status'] = 0;
			$dt = date_my($periode);
			$conditions['search']['bulan'] = $dt['bulan'];
			$conditions['search']['tahun'] = $dt['tahun'];
			
			if (!empty($fasmat)) {
				$conditions['search']['cek_fasmat'] = $fasmat;
				$conditions['search']['fasmat'] = $fasmat;
			}
			// Get record count 
			$conditions['returnType'] = 'count';
			$totalRec = $this->model_data->getPenggunaan($conditions);
			if($totalRec >0){
				$data = ['status'=>true,'title'=>'Cek Penggunaan','count'=>$totalRec,'msg'=>''];
				}else{
				$data = ['status'=>false,'title'=>'Cek Penggunaan','count'=>$totalRec,'msg'=>'Belum ada data '.$fasmat];
			}
			// Pagination configuration 
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function edit_status(){
			$id = $this->db->escape_str($this->input->post('id'));
			$decrypt_url = decrypt_url($id);
			$row = $this->model_app->edit('cc_sppm', ['id'=>$decrypt_url])->row();
			$data = ['id'=>$id,'status'=>$row->stat,'catatan'=>$row->catatan];
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function simpan_status(){
			// dump($_POST,'print_r');
			$id = $this->db->escape_str($this->input->post('id'));
			$decrypt_url = decrypt_url($id);
			$status = $this->db->escape_str($this->input->post('status'));
			$catatan = $this->db->escape_str($this->input->post('catatan'));
			
			$data_post = [
			'stat'=>$status,
			'status'=>'Y',
			'catatan'=>$catatan
			];
			$where = array('id' => $decrypt_url);
			$res= $this->model_app->update('cc_sppm', $data_post, $where);
			if($res['status']=='ok'){
				if($status==0){
					$this->model_app->hapus('cc_sppm', $where);
					$this->model_app->hapus('cc_kirim', ['id_surat'=>$decrypt_url]);
					$notif = 'Ditolak';
				}
				if($status==1){
					$this->model_app->update('cc_kirim', ['stat'=>1], ['id_surat'=>$decrypt_url]);
					$notif = 'Diterima';
				}
				$arr = [
				'status'=>true,
				'id' =>$id,
				'title' =>'Verifikasi data',
				'msg'   =>'Berkas '.$notif
				];
				}else{
				$arr = [
				'status'=>false,
				'title' =>'Verifikasi data',
				'msg'   =>'Data gagal diverifikasi'
				];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		public function detail($id=''){
			$data['title'] = 'Detail SPPM | '.$this->title;
			$decrypt_url = decrypt_url($id);
			$cek_id = cek_id('cc_sppm',$decrypt_url);
			if($decrypt_url > 0 AND $cek_id === true){
				$data['id'] = $decrypt_url;
				$data['level'] = $this->level;
				$this->model_app->update('cc_sppm', ['status'=>'Y'],['id'=>$decrypt_url]);
				if($this->level=='admin')
				{
					$data['row'] = $this->model_app->edit('cc_sppm', ['id'=>$decrypt_url])->row();
					}else{
					$data['row'] = $this->model_app->edit('cc_sppm', ['id'=>$decrypt_url,'id_divisi'=>$this->id_divisi])->row();
				}
				if(!empty($data['row'])){
					$this->thm->load('backend/template','backend/inventory/detail_sppm',$data);
					}else{
					$this->thm->load('backend/template','backend/blank',$data);
				}
				}else{
				$this->thm->load('backend/template','backend/blank',$data);
			}
		}
		public function verifikasi(){
			$id = $this->db->escape_str($this->input->post('id_pengiriman'));
			$catatan = $this->db->escape_str($this->input->post('catatan'));
			// dump($_POST,'print_r','exit');
			$where = array('id' => $id);
			if(isset($_POST['tolak'])){
				$data_post = [
				'stat'=>0,
				'catatan'=>$catatan
				];
				$res= $this->model_app->update('cc_sppm', $data_post, $where);
				if($res['status']=='ok'){
					$this->model_app->hapus('cc_kirim', ['id_surat'=>$id]);
					$this->session->set_flashdata('message', "<script>showNotif('bottom-right','Update Status','Berkas berhasil diverifikasi','success')</script>");
					redirect('laporan/penerimaan');
					exit;
					}else{
					$this->session->set_flashdata('message', "<script>showNotif('bottom-right','Update Status','Berkas gagal diverifikasi','warning')</script>");
					redirect('laporan/penerimaan');
				}
				}elseif(isset($_POST['terima'])){
				$data_post = [
				'stat'=>1,
				'status'=>'Y',
				'catatan'=>$catatan
				];
				$res= $this->model_app->update('cc_sppm', $data_post, $where);
				if($res['status']=='ok'){
					$this->model_app->update('cc_kirim', ['stat'=>1], ['id_surat'=>$id]);
					$this->session->set_flashdata('message', "<script>showNotif('bottom-right','Update Status','Berkas berhasil diverifikasi','success')</script>");
					redirect('laporan/penerimaan');
					exit;
					}else{
					$this->session->set_flashdata('message', "<script>showNotif('bottom-right','Update Status','Berkas gagal diverifikasi','warning')</script>");
					redirect('laporan/penerimaan');
				}
				}else{
				$data['title'] = 'Blank';
				$this->thm->load('backend/template','backend/blank',$data);
			}
		}
		
		public function rekapan()
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
		function get_sub(){
			$type= $this->db->escape_str($this->input->post('type'));
			$id= $this->db->escape_str($this->input->post('id'));
			if($type=='cari'){
				$where = array('tag' => $id);
				$result = $this->model_app->view_where('sub_materiel',$where)->result();
				foreach($result AS $row){
					$data[] = ['id'=>$row->id_master,'name'=>$row->title];
				}
				}else{
				$data[] = [];
			}
			if(empty($data)){
				$data[] = [];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		function ajaxRekapan()
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
			$sub = $this->input->post('sub');
			if (!empty($sub)) {
				$data['sub'] = $sub;
				}else{
				$data['sub'] = 0;
			}
			
			$data['tag'] = $fasmat;
			
			$data['divisi'] = $this->model_master->load_divisi_where($conditions);
			// Load the data list view 
			$this->load->view('backend/inventory/ajax-history',$data);
			
		}
		
		public function rekapan_detail()
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
				// dump($cek_idmaster,'print_r','exit');
				
				$this->thm->load('backend/template','backend/inventory/form_penggunaan_rekapan',$data);
				}else{
				$this->thm->load('backend/template','backend/blank',$data);
			}
		}
		public function print_rekapan(){
			$data['title'] = 'Rekapan | '.$this->title;
			$tanggal = $this->input->post('tanggal_rekapan');
			$id_sub = $this->input->post('id_sub');
			$satuan_kerja = $this->input->post('satuan_kerja');
			$materiel = strtolower($this->input->post('materiel'));
			// dump($_POST,'print_r','exit');
			if(isset($tanggal)){
				$dt = date_my($tanggal);
				$data['dari'] = $dt['bulan'];
				$data['sampai'] = $dt['tahun'];
				
				$data['kasubdit'] = ttd_user('kasubdit');
				$data['bulan'] = strtoupper(getBulan($data['dari'])) .' '. ($data['sampai']);
				if($satuan_kerja=='semua')
				{
					
					$where['where'] = array(
					$materiel => 1
					);
					$data['divisi'] = $this->model_master->load_divisi_where($where);
					}else{
					
					$where['where'] = array(
					$materiel => 1,
					'id' => $satuan_kerja
					);
					$data['divisi'] = $this->model_master->load_divisi_where($where);
				}
				// dump($data['divisi'],'print_r','exit');
				if($id_sub > 0){
					//stok_awal_gudang
					$data['stok_awal_gudang'] = stok_awal_divisi_tckb($id_sub,0,$data['dari'],$data['sampai'])['stok_awal_gudang'];
					//stok_penerimaan
					$data['stok_penerimaan'] = stok_awal_divisi_tckb($id_sub,0,$data['dari'],$data['sampai'])['stok_terima_gudang'];
					//stok_pengiriman
					$data['stok_pengiriman'] =  stok_awal_divisi_tckb($id_sub,0,$data['dari'],$data['sampai'])['stok_distribusi_gudang'];
					$data['sisa_stok'] = $data['stok_awal_gudang'] + $data['stok_penerimaan'] - $data['stok_pengiriman'];
					
					$data['materiel'] = get_sub($id_sub)->title;
					$data['id_master'] = $id_sub;
					
					$conditions['where'] = array(
					'kode' => get_sub($id_sub)->aksi
					);
					//stok | penerimaan | distribusi
					if($id_sub ==1){ //R2
						$data['idform'] = idform('52,53,54,55');
						$data['putih'] = id_form('66,67,68');
						$data['merah'] = id_form('65,70,71');
						$data['kuning'] = id_form('41,42,43');
						}elseif($id_sub ==2){ //R2 LISTRIK
						$data['idform'] = idform('133,125,126,127');
						$data['putih'] = id_form('64,74,73');
						$data['merah'] = id_form('76,77,78');
						$data['kuning'] = id_form('47,48,49');
						}elseif($id_sub ==3){ //R4
						$data['idform'] = idform('0,58,60,59');
						$data['putih'] = id_form('91,92,93');
						$data['merah'] = id_form('96,97,98');
						$data['kuning'] = id_form('207,208,209');
						}elseif($id_sub ==4){ //R4 LISTRIK
						$data['idform'] = idform('128,129,130,0');
						$data['putih'] = id_form('99,100,101');
						$data['merah'] = id_form('204,205,206');
						$data['kuning'] = id_form('87,88,89');
						}else{
						$data['id_form'] = idform('0,0,0,0');
						$data['putih'] = id_form('0,0,0');
						$data['merah'] = id_form('0,0,0');
						$data['kuning'] = id_form('0,0,0');
					}
					
					$data['list_cc'] = $this->model_mutasi->load_cc_where($conditions);
					
					// dump($data['putih'],'print_r','exit');
					
					$this->load->view('backend/laporan/cetak_rekapan_'.$materiel,$data);
					}else{
					
					$data['materiel'] = strtoupper($materiel);
					$data['stok_awal_gudang'] = stok_awal_divisi($materiel,0,$data['dari'],$data['sampai'])['stok_awal_gudang'];
					$data['stok_penerimaan'] = stok_awal_divisi($materiel,0,$data['dari'],$data['sampai'])['stok_terima_gudang'];
					
					$data['stok_pengiriman'] =  stok_awal_divisi($materiel,0,$data['dari'],$data['sampai'])['stok_distribusi_gudang'];
					$data['sisa_stok'] = $data['stok_awal_gudang'] + $data['stok_penerimaan'] - $data['stok_pengiriman'];
					if($materiel=='nrkb'){
						$this->load->view('backend/laporan/cetak_rekapan_nrkb',$data);
						}else{
						$this->load->view('backend/laporan/cetak_rekapan_'.$materiel,$data);
					}
				}
				}else{
				$this->thm->load('backend/template','backend/blank',$data);
			}
			web_analytics();
		}
		
		public function edit_sppm($id='')
		{
			$data['title'] = 'Edit SPPM';
			$id = decrypt_url($id);
			if($id > 0)
			{
				if($this->level=='admin'){
					$data['divisi'] = $this->model_app->view_where('cc_divisi',['stat'=>1])->result_array();
					$data['kategori'] = $this->model_app->view_where('kategori',['idparent'=>0,'stat'=>1]);
					$data['sppm'] = $this->model_app->view_where('cc_sppm',['id'=>$id])->row();
					$this->thm->load('backend/template','backend/laporan/edit_sppm',$data);
					}else{
					$this->thm->load('backend/template','backend/blank',$data);
				}
			}
			else
			{
				$this->thm->load('backend/template','backend/blank',$data);
			}
		}
		
		public function simpan_edit_sppm()
		{
			$id = decrypt_url($this->input->post('id_sppm'));
			$nomor = $this->input->post('nomor');
			$nomor_permohonan = $this->input->post('nomor_permohonan');
			$tanggal_permohonan = $this->input->post('tanggal_permohonan');
			$materiel = strtoupper($this->input->post('materiel'));
			$nomor_detail = $nomor;
			$idmaster = $this->input->post('idmaster');
			$satker = $this->input->post('satker');
			$nama_barang = $this->input->post('nama_barang');
			$linked = $this->input->post('linked');
			$jumlah = array_to_number($this->input->post('jumlah'));
			$harga = array_to_number($this->input->post('harga'));
			$satuan = $this->input->post('satuan');
			$catatan = $this->input->post('catatan');
			$tanggal = $this->input->post('tanggal');
			$keterangan = $this->input->post('keterangan');
			$sum_stok = array_sum($jumlah);
			$data = array();        
			$index = 0;  
			
			$cek_stok = $this->model_mutasi->stok_tag_gudang($materiel);
			
			if($jumlah[0] > $cek_stok){
				$data = ['status'=>false,'title'=>'Peringatan!','msg'=>'Jumlah melebihi Stok'];
				echo json_encode($data);
				exit;
			}
			 
			foreach($idmaster as $key){
				if($jumlah[$index] > 0){
					array_push($data, array(
					'id_master'=>$key,
					'nama_barang'=>$nama_barang[$index], 
					'jumlah'=>$jumlah[$index],
					'satuan'=>$satuan[$index], 
					'harga'=>$harga[$index], 
					'catatan'=>$catatan[$index], 
					));
				}
				$index++;    
			}
			
			$detail = json_encode(['detail'=>$data]);
			$sppm = [
			'id_user'=>$this->iduser,
			'id_divisi'=>$satker,
			'nomor_surat'=>$nomor_permohonan,
			'nomor_detail'=>$nomor_detail,
			'tgl_surat'=>tgl_kirim($tanggal_permohonan),
			'tanggal'=>tgl_kirim($tanggal),
			'keterangan'=>$keterangan,
			'detail'=>$detail
			];
			
			$input = $this->model_app->update('cc_sppm',$sppm,['id'=>$id]);
			if($input['status']=='ok'){
				$status = true;
				
				}else{
				$arr = ['status'=>false,'title'=>'Peringatan!','msg'=>'Pengiriman gagal'];
				echo json_encode($arr);
				exit;
			}
			if($status==true){
				$array = array();
				$i = 0;  
				foreach($idmaster as $str){
					if($jumlah[$i] > 0 AND $linked[$i]=='Y'){
						$data_update = ['id_divisi'=>$satker,'jml'=>$jumlah[$i]];
						$where = ['id_master'=>$str,'id_surat'=>$id];
						$this->model_app->update('cc_kirim', $data_update, $where);
					}
					
					$i++;    
				}
				$arr = ['status'=>true,'title'=>'Update SPPM!','msg'=>'Update Berhasil','id'=>$this->input->post('id_sppm')];
				echo json_encode($arr);
			}
		}
		
		public function edit_penggunaan($id='')
		{
			$data['title'] = 'Detail Penggunaan Materiel | '.$this->title;
			$decrypt_url = decrypt_url($id);
			if($decrypt_url > 0)
			{
				if($decrypt_url > 0 AND $this->level=='admin'){
					$result = $this->model_app->view_where('data_penggunaan',['id'=>$decrypt_url]);
					
				}
				if($result->num_rows() > 0)
				{
					$data['id'] = $id;
					$data['row'] = $result->row();
					$data['caption'] = $this->model_app->view_where('kategori',['tag'=>$data['row']->tag,'stat'=>1,'idparent'=>0])->row();
					$this->thm->load('backend/template','backend/inventory/edit_laporan_penggunaan',$data);
					}else{
					$this->thm->load('backend/template','backend/blank',$data);
				}
				}else{
				$this->thm->load('backend/template','backend/blank',$data);
			}
		}
		
		public function simpan_edit_penggunaan()
		{
			
			// dump($_POST,'print_r','exit');
			$id            	  = $this->input->post('id_penggunaan');
			$title            = $this->input->post('title');
			$nomor            = $this->input->post('nomor');
			$kategoriMateriil = $this->input->post('kategoriMateriil');
			$idmaster         = $this->input->post('id_master');
			$kategori         = $this->input->post('kategori');
			$id_divisi           = $this->input->post('id_divisi');
			$sub              = $this->input->post('sub');
			$jumlah           = array_to_number($this->input->post('volume'));
			$tarif            = array_to_number($this->input->post('tarif'));
			$sub_volume       = array_to_number($this->input->post('sub_volume'));
			$sub_tarif        = array_to_number($this->input->post('sub_tarif'));
			$tanggal          = $this->input->post('tanggal');
			$keterangan       = $this->input->post('keterangan');
			$tag       		  = $this->input->post('tag_edit');
			// $parent_barang    = parent_barang($idmaster);
			$sum_stok 		  = array_sum($jumlah);
			$sum_volume 	  = array_sum($sub_volume);
			$sum_tarif 	  	  = array_sum($sub_tarif);
			
			
			// dump($sum_stok,'print_r','exit');
			if($sum_stok ==0){
				$data = ['status'=>false,'title'=>'Penggunaan','msg'=>'Jumlah masih kosong'];
				echo json_encode($data);
				exit;
			}
			if($tag=='TNKB'){
				$id_sub =  kategori($kategoriMateriil)['id_sub'];
				$cek_stok = $this->cek_stok_byid($id_sub,$id_divisi,$sum_stok);
				}else{
				$cek_stok = $this->cek_stok_bytag($tag,$id_divisi,$sum_stok);
			}
			// dump($cek_stok,'print_r','exit');
			if($cek_stok['status']===false AND $tag!='NRKB')
			{
				$data = ['status'=>false,'title'=>'Penggunaan','msg'=>$cek_stok['msg']];
				echo json_encode($data);
				exit;
			}
			
			$data             = array();        
			$index            = 0;  
			foreach($kategori as $key){
				
				array_push($data, array(
				'tag'         =>$tag,
				'nomor'       =>$nomor[$index],
				'id_form'     =>$key,
				'sub'     	  =>$sub[$index],
				'nama_barang' =>$title[$index], 
				'jumlah'      =>($jumlah[$index]),
				'tarif'       =>($tarif[$index]), 
				'sub_tarif'   =>($sub_tarif[$index]), 
				'sub_volume'  =>($sub_volume[$index]), 
				'catatan'  	  =>'-', 
				));
				
				$index++;    
			}
			
			$detail           = json_encode(['detail'=>$data]);
			
			$sppm             = [
			'id_user'         =>$this->iduser,
			'id_master'       =>$idmaster,
			'tag'       	  =>$tag,
			'id_kategori'     =>$kategoriMateriil,
			'id_divisi'       =>$id_divisi,
			'total_volume'    =>($sum_volume),
			'total_tarif'     =>($sum_tarif),
			'kode_billing'    =>0,
			'kode_ntpn'       =>0,
			'tanggal'         =>tgl_kirim($tanggal),
			'keterangan'      =>$keterangan,
			'detail'          =>$detail
			];
			
			// dump($detail,'print_r','exit');
			$nomor_surat = '';
			$update = $this->model_app->update('data_penggunaan',$sppm,['id'=>$id]);
			if($update['status']=='ok'){
				$status = true;
				$nomor_surat = $id;
				}else{
				$data = ['status'=>false,'title'=>'Penggunaan','msg'=>'Data gagal disimpan'];
				echo json_encode($data);
			}
			$status = true;
			if($status==true){
				$array = array();
				$i = 0;  
				foreach($jumlah as $str){
					if($jumlah[$i] > 0){
						$data_update = ['jml'=>$jumlah[$i]];
						$where = ['id_form'=>$kategori[$i],'id_divisi'=>$id_divisi,'id_surat'=>$id];
						$this->model_app->update('cc_terjual', $data_update, $where);
						array_push($array, array(
						'id_master'=>$idmaster,
						'tag'=>$tag,
						'id_divisi'=>$id_divisi,
						'id_form'=>$kategori[$i],
						'id_surat'=>$nomor_surat,
						'tgl'=>tgl_kirim($tanggal),
						'jml'=>$jumlah[$i],
						'ket'=>$title[$i],
						'stat'=>1,
						));
						
					}
					$i++;    
				}
				// dump($array,'print_r','exit');
				$data = ['status'=>false,'title'=>'Penggunaan','msg'=>'Data gagal diupdate'];
				if(!empty($array)){
					$data = ['status'=>true,'title'=>'Penggunaan','msg'=>'Data berhasil diupdate'];
				}
				echo json_encode($data);
			}
			
		}
		private function cek_stok_byid($idmaster,$idsatker,$total){
			
			$stok = $this->model_mutasi->real_stok_divisi_byid($idmaster,$idsatker);
			
			$data = ['status'=>true];
			
			if($stok == 0){
				$data = ['status'=>false,'msg'=>'Stok masih kosong'];
			}
			
			if($total > $stok){
				$data = ['status'=>false,'msg'=>'Penggunaan Melebihi Stok '.$stok];
			}
			
			return $data;
		}
		private function cek_stok_bytag($tag,$idsatker,$total){
			$stok = $this->model_mutasi->real_stok_tag_divisi($tag,$idsatker);
			
			$data = ['status'=>true];
			
			if($stok == 0){
				$data = ['status'=>false,'msg'=>'Stok masih kosong'];
			}
			
			if($total > $stok){
				$data = ['status'=>false,'msg'=>'Penggunaan Melebihi Stok '.$stok];
			}
			
			return $stok;
		}
		public function hapus_pengiriman()
		{
			cek_input_post('GET');
			$id = $this->db->escape_str($this->input->post('id',TRUE));
			$decrypt_url = decrypt_url($id);
			
			$cek = $this->model_app->view_where('cc_sppm', ['id'=>$decrypt_url]);
			if($cek->num_rows() > 0)
			{
				if($this->level=='admin'){
					$delete = $this->model_app->hapus('cc_sppm', ['id'=>$decrypt_url]);
					if($delete['status']=='ok')
					{
						$this->model_app->hapus('cc_kirim', ['id_surat'=>$decrypt_url]);
						$arr = ['status'=>200,'title'=>'Hapus Pengiriman','msg'=>'Pengiriman dihapus'];
						}else{
						$arr = ['status'=>400,'title'=>'Hapus Pengiriman','msg'=>'Pengiriman gagal dihapus'];
					}
					}else{
					$arr = ['status'=>400,'title'=>'Hapus Pengiriman','msg'=>'Anda bukan admin'];
				}
				}else{
				$arr = ['status'=>400,'title'=>'Hapus Pengiriman','msg'=>'Data tidak ditemukan'];
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		
		
		public function cetak()
		{
			$data['title'] = 'Print Laporan';
			$id = $this->db->escape_str($this->input->post('id'));
			$print_status = $this->db->escape_str($this->input->post('print_status'));
			
			if($this->level=='admin'){
				$cek = $this->model_app->view_where('cc_sppm',['id'=>$id]);
				if($cek->num_rows() > 0){
					$data['row'] = $cek->row();
					$data['detail'] = json_decode($cek->row()->detail);
					$data['fasmat'] = pilih('tb_users','id_user',$this->iduser)['nama_lembaga'];
					$data['direktur'] = ttd_user('direktur');
					$data['kasubdit'] = ttd_user('kasubdit');
					$data['kasi'] = ttd_user('kasi');
					if($print_status=='sppm')
					{
						$data['title'] = 'Print_SPPM_' .date('Y-m-d H:i:s');
						$this->load->view('backend/laporan/cetak_sppm',$data);
						}elseif($print_status=='bukti'){
						$data['title'] = 'Print_Bukti_Pengeluaran_' .date('Y-m-d H:i:s');
						$this->load->view('backend/laporan/cetak_bukti',$data);
						
					}
					}else{
					$this->thm->load('backend/template','backend/blank',$data);
				}
				}else{
				$this->thm->load('backend/template','backend/blank',$data);
			}
			// web_analytics();			
		}
	}																																																																																																											