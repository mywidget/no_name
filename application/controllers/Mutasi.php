<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Mutasi extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();
			cek_session_login(1);	
			$this->title = info()['title']; 
			$this->perPage = 10; 
			$this->level = $this->session->level; 
			$this->iduser = $this->session->iduser; 
		}
		public function penerimaan($kategori='',$id='')
		{
			cek_menu_akses();
			$data['title'] = 'Data Barang | '.$this->title;
			
            // Get record count 
            $conditions['where'] = array(
			'parent' => 0,
            'stat' => 1
            );
			$conditions['search']['groupby'] = 'tag';
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getInventory($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('mutasi/ajaxInventory');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchMutasiPenerimaan';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions = array(
            'limit' => $this->perPage
            );
			$conditions['where'] = array(
			'parent' => 0,
            'stat' => 1
            );
            $conditions['search']['groupby'] = 'tag';
            $data['list'] = $this->model_data->getInventory($conditions);
			$data['mutasi'] = $this->model_mutasi->get_current_mutasi($data['list']);
			$data['divisi'] = $this->model_master->load_divisi();
			$data['kategori'] = $this->model_app->view_where('kategori',['idparent'=>0,'stat'=>1,'tampil'=>1]);
			$this->thm->load('backend/template','backend/inventory/terima',$data);
		}
		
		function ajaxInventory()
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
            $keywords = $this->input->post('keywords');
            if (!empty($keywords)) {
                $conditions['search']['keywords'] = $keywords;
			}
            $sortBy = $this->input->post('sortBy');
            if (!empty($sortBy)) {
                $conditions['search']['sortBy'] = $sortBy;
			}
            $conditions['where'] = array(
			'parent' => 0,
            'stat' => 1
            );
			$conditions['search']['groupby'] = 'tag';
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getInventory($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('mutasi/ajaxInventory');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchMutasiPenerimaan';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
            if (!empty($sortBy)) {
                $conditions['search']['sortBy'] = $sortBy;
			}
			$conditions['where'] = array(
			'parent' => 0,
            'stat' => 1
            );
			$conditions['search']['groupby'] = 'tag';
            // $sWhere = "WHERE level='owner' AND parent='$iduser' OR level='marketing' AND parent='$iduser'";
            unset($conditions['returnType']);
            $data['list'] = $this->model_data->getInventory($conditions);
            // print_r($data['list']); 
			if(!empty($data['list'])){
				$data['mutasi'] = $this->model_mutasi->get_current_mutasi($data['list']);
			}
			$data['start'] = $offset;
            // Load the data list view 
			$this->load->view('backend/inventory/ajax-stok',$data);
			
		}
		public function add_materiel($id='')
		{
			$data['title'] = "Input penerimaan materiel";
			$data['idparent'] = $this->session->idparent;
			$data['id_level'] = $this->session->idlevel;
			$data['id_divisi'] = $this->session->id_divisi;
			$data['typeakses'] = $this->session->typeakses;
			$data['type'] = intval($id);
			$data['hide'] = '';
			if(!empty($id)){
				if($this->level=='admin'){
					
					$conditions['where'] = array(
					'stat' => 1
					);
					$data['list'] = $this->model_data->getInventory($conditions);
					$list = $this->model_mutasi->list_divisi();
					
					$data['menu'] = '';
					$data['divisi'] = $this->model_app->view_where('cc_divisi',['stat'=>1])->result_array();
					
					// $data['list_cc'] = $this->model_mutasi->load_barang_by_id($id);
					$where['where'] = array(
					'stat' => 1,
					'linked' => 'Y',
					'kategori' => $id
					);
					$data['list_cc'] = $this->model_mutasi->load_cc_where($where);
					// dump($data['list_cc'],'print_r','exit');
					$data['mutasi'] = $this->model_mutasi->get_current_mutasi($data['list']);
					$data['iddiv'] = $data['id_level'];
					$data['kategori'] = $this->model_app->view_where('kategori',['idparent'=>0,'stat'=>1,'tampil'=>1]);
					$this->thm->load('backend/template','backend/inventory/add_materiel',$data);
					}else{
					
					$this->thm->load('backend/template','backend/blank',$data);
				}
				}else{
				
				$this->thm->load('backend/template','backend/blank',$data);
			}
		}
		public function stok_satker($detail='',$iddivisi='')
		{
			
			$data['title'] = "Rekap Stok Inventory per Divisi";
			$data['level'] = $this->level;
			$data['idparent'] = $this->session->idparent;
			$data['id_level'] = $this->session->idlevel;
			$data['id_divisi'] = $this->session->id_divisi;
			// $data['typeakses'] = $this->session->typeakses;
			$data['divisi'] = $this->model_app->view_where('cc_divisi',['stat'=>1])->result();
			$data['list'] = $this->model_mutasi->list_divisi_akses($data['id_level']);
			
			if(empty($detail))
			{
				$this->thm->load('backend/template','backend/inventory/pengiriman',$data);
				}else{
				$iddivisi = decrypt_url($iddivisi);
				// echo $iddivisi;
				if($iddivisi > 0){
					$list = $this->model_mutasi->list_divisi();
					
					$data['menu'] = $list[$iddivisi];
					$data['title'] = "Data Stok Materiel di ".$list[$iddivisi];
					$conditions['where'] = array(
					'stat' => 1,
					'parent' => 0
					);
					// echo $iddivisi;
					$data['list_cc'] = $this->model_mutasi->load_cc_where($conditions);
					$data['mutasi'] = $this->model_mutasi->get_current_mutasi($data['list_cc'], $iddivisi);
					$data['typeakses'] = $this->model_app->view_where('tb_users',['id_divisi'=>$iddivisi])->row()->type_akses; 
					
					// dump($data['typeakses'],'print_r','exit');
					
					$data['kategori'] = $this->model_app->view_where_ordering('kategori_tag',['stat'=>1,'idparent'=>0],'urutan','ASC')->result(); 
					$data['iddiv'] = $iddivisi;
					$this->thm->load('backend/template','backend/inventory/pengiriman_detail',$data);
					}else{
					$this->thm->load('backend/template','backend/blank',$data);
				}
			}
		}
		
		
		public function stok_terakhir($id='')
		{
			$data['title'] = "Rekap Stok Inventory per Divisi";
			
			$data['type'] = intval($id);
			$data['hide'] = '';
			if(!empty($id) AND $this->level=='admin'){
				$conditions['where'] = array(
				'stat' => 1
				);
				$data['list'] = $this->model_data->getInventory($conditions);
				$list = $this->model_mutasi->list_divisi();
				
				$data['divisi'] = $this->model_app->view_where('cc_divisi',['stat'=>1])->result_array();
				$data['title'] = "Stok Awal";
				
				$data['kategori'] = $this->model_app->view_where('kategori',['idparent'=>0,'stat'=>1,'tampil'=>1]);
				$this->thm->load('backend/template','backend/inventory/add_stok_terakhir',$data);
				}else{
				$data['title'] = $this->title;
				$this->thm->load('backend/template','backend/blank',$data);
			}
		}
		public function form_stok_terakhir()
		{
			// dump($_POST,'print_r','exit');
			$divisi = $this->input->post('divisi');
			$id = $this->input->post('id');
			$tanggal = $this->input->post('tanggal');
			
			$data['typeakses'] = $this->session->typeakses;
			$data['type'] = intval($id);
			$data['divisi'] = $divisi;
			$data['tanggal'] = $tanggal;
			$conditions['where'] = array(
			'stat' => 1
			);
			$data['list'] = $this->model_data->getInventory($conditions);
			$list = $this->model_mutasi->list_divisi();
			$where['where'] = array(
			'stat' => 1,
			'linked' => 'Y',
			'kategori' => $id
			);
			$data['list_cc'] = $this->model_mutasi->load_cc_where($where);
			if($divisi > 0)
			{
				$data['mutasi'] = $this->model_mutasi->get_current_mutasi_stok_awal($data['list_cc'], $divisi);
				}else{
				$data['mutasi'] = $this->model_mutasi->get_current_mutasi_stok_awal($data['list']);
			}
			$data['kategori'] = $this->model_app->view_where('kategori',['idparent'=>0,'stat'=>1,'tampil'=>1]);
			
			$this->load->view('backend/inventory/form_stok_terakhir',$data);
		}
		public function simpan_materiel()
        {
			$nomor = $this->input->post('nomor');
			$id = $this->input->post('materiel');
			$detail = $this->input->post('detail');
			$nomor_spm = 'SPPM/'.$nomor.$detail;
			$idmaster = $this->input->post('idmaster');
			$nama_barang = $this->input->post('nama_barang');
			$jumlah = array_to_number($this->input->post('jumlah'));
			$sum_jumlah = array_sum($jumlah);
			$harga = array_to_number($this->input->post('harga'));
			$satuan = $this->input->post('satuan');
			$tanggal = $this->input->post('tanggal');
			$ket = $this->input->post('ket');
			$keterangan = $this->input->post('keterangan');
			$cek = $this->model_app->view_where('penerimaan',['nomor'=>$nomor]);
			$tag = kategori($id)['tag'];
			
			if($cek->num_rows() > 0){
				$_data = [
				'status' =>false,
				'title'  =>'Penerimaan',
				'msg'    =>'Nomor sudah ada'
				];
				
				echo json_encode($_data);
				exit;
			}
			$data = array();        
			$index = 0;  
			$_jumlah = 0;  
			foreach($idmaster as $key){
				array_push($data, array(
				'id_master'=>$key,
				'nama_barang'=>$nama_barang[$index], 
				'jumlah'=>$jumlah[$index],
				'satuan'=>$satuan[$index],
				'harga'=>$harga[$index],
				'ket'=>$ket[$index]
				));
				$_jumlah += $jumlah[$index];
				$index++;    
			}
			if(empty($_jumlah)){
				$_data         = [
				'status' =>false,
				'title'  =>'Penerimaan',
				'msg'    =>'Jumlah masih kosong'
				];
				
				echo json_encode($_data);
				exit;
				
			}
			
			$detail = json_encode(['detail'=>$data]);
			$sppm = [
			'id_user'=>$this->iduser,
			'nomor'=>$nomor,
			'nomor_spm'=>$nomor_spm,
			'materiel'=>kategori($id)['title'],
			'tanggal'=>tgl_kirim($tanggal),
			'keterangan'=>$keterangan,
			'jumlah'=>$sum_jumlah,
			'detail'=>$detail,
			'status'=>1,
			];
			$input = $this->model_app->input('penerimaan',$sppm);
			if($input['status']=='ok'){
				$status = true;
				$id = $input['id'];
				}else{
				$_data         = [
				'status' =>false,
				'title'  =>'Penerimaan',
				'msg'    =>'Gagal menyimpan'
				];
				
				echo json_encode($_data);
				exit;
				
			}
			if($status==true){
				
				$array = array();
				$i = 0;  
				foreach($idmaster as $str){
					if($jumlah[$i] > 0){
						array_push($array, array(
						'id_master'=>$str,
						'tag'=>$tag,
						'id_surat'=>$id,
						'tgl'=>tgl_kirim($tanggal),
						'jml'=>$jumlah[$i],
						'ket'=>$ket[$i],
						'stat'=>1,
						));
					}
					$i++;    
				}
				
				if(!empty($array)){
					$this->save_penerimaan('cc_terima',$array);
				}
				$data         = [
				'status' =>true,
				'title'  =>'Penerimaan',
				'msg'    =>'Sukses'
				];
				
				echo json_encode($data);
				
			}
		}
		private function save_penerimaan($table,$data){    
			return $this->db->insert_batch($table, $data);  
		}
		public function load_terima(){
			$id = $this->db->escape_str($this->input->post('id'));
			$row = $this->model_app->edit('cc_master', ['id'=>$id])->row();
			$data = ['id'=>$row->id,'title'=>$row->nama_barang,'tgl'=>date('Y-m-d')];
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}		
		public function simpan_barang_diterima(){
			$idmaster = $this->db->escape_str($this->input->post('id'));
			// print_r($_POST);
			$arr = array(
			"id_master" => $idmaster,
			"tgl" => $this->db->escape_str($this->input->post('tanggal')),
			"jml" => $this->db->escape_str($this->input->post('jumlah')),
			"ket" => $this->db->escape_str($this->input->post('keterangan')),
			"stat" => 1
			);
			$input = $this->model_app->input("cc_terima",$arr);
			if($input['status']=='ok')
			{
				$arr = [
				'status'=>true,
				'title' =>'Input data',
				'msg'   =>'Data berhasil Input'
				];
			}
			else
			{
				$arr = [
				'status'=>false,
				'title' =>'Input data',
				'msg'   =>'Data gagal Input'
				];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		
		public function simpan_barang_kirim(){
			
			$idmaster = $this->db->escape_str($this->input->post('id'));
			$jumlah_kirim = $this->db->escape_str($this->input->post('jumlah_kirim'));
			$ket_kirim = $this->db->escape_str($this->input->post('ket_kirim'));
			$id_divisi = $this->db->escape_str($this->input->post('satker'));
			// print_r($_POST);exit;
			$stokmaster = $this->model_mutasi->real_stok($idmaster);
			if($jumlah_kirim > $stokmaster){
				$data = array('status'=>500,'title' =>'Alert !!!','msg'=>'Stok tidak mencukupi untuk melakukan pengiriman.<br> (Stok : '.$stokmaster.', dikirim : '.$jumlah_kirim.')');
				$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
				exit;
			}
			$listdiv = $this->model_mutasi->list_divisi();
			
			if(empty($ket_kirim)){
				$ket_kirim = "Dikirim ke ".$listdiv[$id_divisi];
			}
			
			$arr = array(
			"id_master" => $idmaster,
			"id_divisi" => $id_divisi,
			"tgl" => $this->db->escape_str($this->input->post('tanggal_kirim')),
			"jml" => $jumlah_kirim ,
			"ket" => $ket_kirim,
			"stat" => 1
			);
			
			$input = $this->model_app->input("cc_kirim",$arr);
			if($input['status']=='ok')
			{
				$arr = [
				'status'=>true,
				'title' =>'Input data',
				'msg'   =>'Data berhasil Input'
				];
			}
			else
			{
				$arr = [
				'status'=>false,
				'title' =>'Input data',
				'msg'   =>'Data gagal Input'
				];
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		
		public function load_detail()
		{
			cek_input_post('GET');
			$idmaster = $this->db->escape_str($this->input->post('id'));
			$row = $this->model_mutasi->get_page_cc("cc_master",$idmaster);
			$data['row'] = $row;
			$data['idmaster'] = $idmaster;
			$data['level'] = $this->level;
			$data['divisi'] = $this->model_app->view_where('cc_divisi', ['stat'=>1])->result_array();
			// print_r($data['divisi']);
			$data['item_mutasi'] = $this->model_mutasi->item_mutasi_tag($idmaster);
			$this->load->view('backend/inventory/detail_global',$data);
		}
		
		public function load_detail_divisi()
		{
			cek_input_post('GET');
			$iddivisi = $this->db->escape_str($this->input->post('id'));
			$idmaster = $this->db->escape_str($this->input->post('idmaster'));
			// echo $idmaster;
			$row = $this->model_mutasi->get_page("cc_master",$idmaster);
			$data['row'] = $row;
			$data['idmaster'] = $idmaster;
			$data['iddivisi'] = $iddivisi;
			$data['divisi'] = $this->model_app->view_where('cc_divisi', ['stat'=>1])->result_array();
			$data['disabled'] = '';
			$data['level'] = $this->level;
			if($iddivisi==0){
				$data['item_mutasi'] = $this->model_mutasi->item_mutasi($idmaster);
				$this->load->view('backend/inventory/detail_global',$data);
				}else{
				$data['item_mutasi'] = $this->model_mutasi->item_mutasi_divisi($idmaster, $iddivisi);
				$this->load->view('backend/inventory/detail_divisi',$data);
			}
		}	
		public function view()
		{
			cek_input_post('GET');
			$iddivisi = $this->db->escape_str($this->input->post('divisi'));
			$idmaster = $this->db->escape_str($this->input->post('master'));
			$row = $this->model_mutasi->get_page("cc_master",$idmaster);
			$data['row'] = $row;
			$data['idmaster'] = $idmaster;
			$data['iddivisi'] = $iddivisi;
			if($this->level=='admin'){
				$data['disabled'] = '';
				$data['divisi'] = $this->model_app->view_where('cc_divisi', ['stat'=>1])->result_array();
				}else{
				$data['disabled'] = 'readonly';
				$data['divisi'] = $this->model_app->view_where('cc_divisi', ['stat'=>1,'id'=>$iddivisi])->result_array();
			}
			
			$data['item_mutasi'] = $this->model_mutasi->item_mutasi_divisi($idmaster, $iddivisi);
			$this->load->view('backend/inventory/detail_divisi',$data);
		}
		
		public function load_kirim()
		{
			
			$iddivisi = $this->db->escape_str($this->input->post('divisi'));
			$idmaster = $this->db->escape_str($this->input->post('idmaster'));
			$list = $this->model_mutasi->list_divisi();
			
			$row = $this->model_mutasi->get_page("cc_master",$idmaster);
			
			$data['judul'] = "Stok Inventory ".$row['nama_barang']." Terpakai di ".$list[$iddivisi];
			$data['divisi'] = $this->model_app->view_where('cc_divisi', ['stat'=>1])->result_array();
			$data['real_stok'] = $this->model_mutasi->real_stok_div($idmaster, $iddivisi);
			$data['iddiv'] = $iddivisi;
			$data['level'] = $this->session->level;
			$data['tgl'] = date("Y-m-d");
			$data['idmaster'] = $idmaster;
			$data['iddivisi'] = $iddivisi;
			$this->load->view('backend/inventory/kirim',$data);
			
		}
		public function addkirim(){
			
			$post = $_POST;
			
			$list_post = array("cc_tgl","cc_jml","cc_ket");
			if($post['cc_jml'] > $post['cc_terjual']){
				post_session($post, $list_post);
				$arr = [
				'status'=>false,
				'title' =>'Input data',
				'msg'   =>'Jumlah yang dimasukkan melebihi stok yang ada di divisi. (Stok : '.$post['cc_terjual'].')'
				];
			}
			else{
				if(empty($post['cc_jml']) or empty($post['cc_tgl'])){
					post_session($post, $list_post);
					$arr = [
					'status'=>false,
					'title' =>'Input data',
					'msg'   =>'Kolom masih kosong'
					];
				}
				else{
					//input ke db
					$data = array(
					"id_master" => $post['idmaster'],
					"id_divisi" => $post['iddivisi'],
					"jml" => $post['cc_jml'],
					"tgl" => $post['cc_tgl'],
					"ket" => $post['cc_ket'],
					"stat" => 1
					);
					$this->db->insert("cc_terjual",$data);
					$arr = [
					'status'=>true,
					'title' =>'Input data',
					'msg'   =>'Data berhasil disimpan'
					];
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		public function simpan_stok_terakhir()
        {
			
			
			$type = $this->input->post('type');
			$idmaster = $this->input->post('idmaster');
			$linked = $this->input->post('linked');
			$nama_barang = $this->input->post('nama_barang');
			$jumlah = array_to_number($this->input->post('jumlah'));
			$catatan = $this->input->post('catatan');
			$tanggal = $this->input->post('tanggal');
			$id_divisi = $this->input->post('divisi');
			$keterangan = $this->input->post('ket');
			$sum_stok = array_sum($jumlah);
			
			// dump($_POST,'print_r','exit');
			$listdiv = $this->model_mutasi->list_divisi();
			if($id_divisi=='gudang'){
				$ket_kirim = "Stok awal GUDANG FASMAT";
				$tb = 'cc_terima';
				}else{
				$ket_kirim = "Stok awal ".$listdiv[$id_divisi];
				$tb = 'cc_kirim';
			}
			if($sum_stok ==0){
				$array = array();
				$i = 0;  
				foreach($idmaster as $str){
					
					if($jumlah[$i] == 0 AND $linked[$i]=='Y'){
						$cek_stok = $this->model_mutasi->cek_real_stok_awal_gudang($str,$id_divisi);
						if($str==$cek_stok['id_master']){
							$where = ['tb'=>$tb,'id_divisi'=>$cek_stok['id_divisi'],'id_master'=>$cek_stok['id_master']];
							$res = $this->model_app->hapus('cc_stok',$where);
						}
					}
					$i++;    
				}
				$data = ['status'=>true,'title'=>'Peringatan!','msg'=>'Jumlah stok 0 telah dihapus'];
				echo json_encode($data);
				exit;
			}
			
			
			
			$array = array();
			$i = 0;  
			foreach($idmaster as $str){
				if($jumlah[$i] > 0 AND $linked[$i]=='Y'){
					$cek_stok = $this->model_mutasi->cek_real_stok_awal_gudang($str,$id_divisi);
					if($str==$cek_stok['id_master']){
						$data_update = ['jml'=>$jumlah[$i]];
						$where = ['tb'=>$tb,'id_divisi'=>$cek_stok['id_divisi'],'id_master'=>$cek_stok['id_master']];
						$this->model_app->update('cc_stok', $data_update, $where);
						}else{
						array_push($array, array(
						'id_user'=>$this->iduser,
						'id_project'=>$type,
						'id_master'=>$str,
						'tb'=>$tb,
						'tag'=>strtoupper(kategori($type)['tag']),
						'id_divisi'=>$id_divisi,
						'tgl'=>tgl_kirim($tanggal),
						'jml'=>$jumlah[$i],
						'ket'=>$ket_kirim,
						'stat'=>1,
						));
					}
				}
				if($jumlah[$i] == 0 AND $linked[$i]=='Y'){
					$cek_stok = $this->model_mutasi->cek_real_stok_awal_gudang($str,$id_divisi);
					if($str==$cek_stok['id_master']){
						$data_update = ['jml'=>$jumlah[$i]];
						$where = ['tb'=>$tb,'id_divisi'=>$cek_stok['id_divisi'],'id_master'=>$cek_stok['id_master']];
						$res = $this->model_app->update('cc_stok', $data_update, $where);
					}
				}
				$i++;    
			}
			// dump($array,'print_r','exit');
			if(!empty($array)){
				$this->save_penerimaan('cc_stok',$array);
				$data = ['status'=>true,'title'=>'Peringatan!','msg'=>'Material '.$ket_kirim];
				}else{
				$data = ['status'=>true,'title'=>'Peringatan!','msg'=>'Material berhasil di perbaharui'];
			}
			echo json_encode($data);
		}
		
	}
	/* End of file Mutasi.php */
