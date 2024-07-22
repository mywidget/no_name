<?php
	defined("BASEPATH") or exit();
	
	Class Master extends CI_Controller{
		
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			cek_session_login(1);
			$this->perPage = 10; 
			$this->title = info()['title']; 
			$this->iduser = $this->session->idu; 
			$this->akses = $this->session->type_akses; 
			
		}
		
		public function index(){
			redirect("master/inventory");
		}
		
		public function inventory(){
			// cek_menu_akses();
			$data['title'] = 'Data Inventory | '.$this->title;
			
            // Get record count 
            
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getData($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('master/ajaxInventory');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchInventory';
            
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
			$data['parent'] = $this->model_master->load_master();
			$data['kategori'] = $this->model_master->load_kategori();
            $data['query'] = $this->model_data->getData($conditions);
			$this->thm->load('backend/template','backend/inventory/data',$data);
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
            
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getData($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('master/ajaxInventory');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $limit;
            $config['link_func']   = 'searchInventory';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
            
            $conditions['where'] = array(
            'stat' => 1
            );
            // $sWhere = "WHERE level='owner' AND parent='$iduser' OR level='marketing' AND parent='$iduser'";
            unset($conditions['returnType']);
            $data['start'] = $offset;
            $data['query'] = $this->model_data->getData($conditions);
            
            
            // Load the data list view 
			$this->load->view('backend/inventory/ajax-data',$data);
			
		}
		
		public function satker(){
			cek_menu_akses();
			$data['title'] = 'Data Inventory | '.$this->title;
			
            $data['query'] = $this->model_app->view_where_ordering('cc_divisi',['stat'=>1],'urutan','ASC');
			$data['result'] = $this->model_app->view_where('hak_akses',['publish'=>'Y']);
			$this->thm->load('backend/template','backend/inventory/satker',$data);
		}
		
		public function edit_divisi(){
			$id = $this->db->escape_str($this->input->post('id'));
			$row = $this->model_app->edit('cc_divisi', ['id'=>$id])->row();
			$data = ['id'=>$id,'title'=>$row->nama_divisi,'parent'=>$row->parent];
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function simpan_divisi(){
			
			$type   = $this->db->escape_str($this->input->post('type'));
			$title  = $this->db->escape_str($this->input->post('title'));
			$parent = $this->db->escape_str($this->input->post('parent'));
			
			$data_post = ['nama_divisi'=>$title,'parent'=>$parent];
			if($type=='add'){
				$insert = $this->model_app->input('cc_divisi',$data_post);
				if($insert['status']=='ok')
				{
					$arr = [
					'status'=>true,
					'title' =>'Tambah data',
					'msg'   =>'Data berhasil ditambahkan'
					];
				}
				else
				{
					$arr = [
					'status'=>false,
					'title' =>'Tambah data',
					'msg'   =>'Data gagal ditambahkan'
					];
				}
			}
			if($type=='edit'){
				$id = $this->db->escape_str($this->input->post('id'));
				
				$where = array('id' => $id);
				$res= $this->model_app->update('cc_divisi', $data_post, $where);
				if($res['status']=='ok'){
					$arr = [
					'status'=>true,
					'title' =>'Perbaharui data',
					'msg'   =>'Data berhasil diperbaharui'
					];
					}else{
					$arr = [
					'status'=>false,
					'title' =>'Perbaharui data',
					'msg'   =>'Data gagal diperbaharui'
					];
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		
		public function hapus_divisi(){
			$id = $this->db->escape_str($this->input->post('id'));
			$where = array('id' => $id);
			$data_post = ['stat'=>9];
			$res= $this->model_app->update('cc_divisi', $data_post, $where);
			if($res['status']=='ok'){
				$arr = [
				'status'=>true,
				'title' =>'Hapus data',
				'msg'   =>'Data berhasil dihapus'
				];
				}else{
				$arr = [
				'status'=>false,
				'title' =>'Hapus data',
				'msg'   =>'Data gagal dihapus'
				];
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		public function form_penggunaan(){
			// cek_menu_akses();
			$data['title'] = 'Data Form penggunaan | '.$this->title;
			
            // $data['query'] = $this->model_app->view_where('form_penggunaan',['stat'=>1]);
            $data['query'] = $this->model_app->view_where_ordering('form_penggunaan',[''],'urutan','ASC');
			$data['master'] = $this->model_app->view_where('cc_master',['parent'=>0,'stat'=>1]);
			$data['kategori'] = $this->model_app->view_where('kategori',['stat'=>1]);
			$this->thm->load('backend/template','backend/inventory/data_form_penggunaan',$data);
		}
		public function crud_form(){
			
			$type = $this->input->get('type', TRUE);
			$gdata = $this->input->get('data', TRUE);
			$id = $this->input->get('id', TRUE);('id');
			$aktif = $this->input->get('aktif', TRUE);
			if($type=='get'){
				$data = array();
				$return = $this->db->query("SELECT * FROM form_penggunaan WHERE id='".$id."'")->row_array();	
				$data = array(
				'id' => $return['id'],
				'label' => $return['title'],
				'tarif' => $return['tarif'],
				'idparent' => $return['idparent'],
				'idkategori' => $return['id_kategori'],
				'idmaster' => $return['id_master'],
				'kategori' => strtoupper($return['kategori']),
				'grup' => $return['grup'],
				'aktif' => $return['stat']
				);	
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
				}elseif($type=='simpan'){
				// dump($_GET,'print_r','x');
				$data = json_decode($this->input->get('data', TRUE));
				function parseJsonArray($jsonArray, $parentID = 0) {
					$return = array();
					foreach ($jsonArray as $subArray) {
						$returnSubSubArray = array();
						if (isset($subArray->children)) {
							$returnSubSubArray = parseJsonArray($subArray->children, $subArray->id);
						}
						$return[] = array('id' => $subArray->id, 'parentID' => $parentID);
						$return = array_merge($return, $returnSubSubArray);
					}
					return $return;
				}
				
				$readbleArray = parseJsonArray($data);
				
				$i=0;
				foreach($readbleArray as $row){
					$data = [
					'idparent'=>$row['parentID'],
					'urutan'=>$i,
					];
					$this->model_app->update('form_penggunaan',$data,['id'=>$row['id']]); 
					$i++;
				}
				}elseif($type=='hapus'){
				// menu_demo();
				function recursiveDeleteMenu($id) {
					$ci = & get_instance();
					$data = array('hapus'=>'hapus');
					$query = $ci->model_app->view_where('form_penggunaan',['idparent' =>$id]);
					if ($query->num_rows >0) {
						foreach ($query->result_array() as $current){
							recursiveDeleteMenu($current['id']);
						}
					}
					
					$qry =$ci->model_app->hapus('form_penggunaan',['stat'=>0,'id'=>$id]);
					if($qry['status']=='ok'){
						$data = array(0=>'ok');;
						}else{
						$data = array(0=>'error');;
					}
					return json_encode($data);
				}
				echo recursiveDeleteMenu($id);
			}
		}
		public function save_form(){
			// menu_demo();
			$type = $this->input->get('type', TRUE);
			$id = $this->input->get('id', TRUE);('id');
			$label = $this->input->get('label', TRUE);
			$tarif = $this->input->get('tarif', TRUE);
			$aktif = $this->input->get('aktif', TRUE);
			$idparent = $this->input->get('idparent', TRUE);
			$idmaster = $this->input->get('idmaster', TRUE);
			$idkategori = $this->input->get('idkategori', TRUE);
			$grup = $this->input->get('grup', TRUE);
			///
			// dump($_GET,'print_r','x');
			if($type=='simpan'){
				$tag = parent_barang($idmaster);
				if($id > 0){
					
					$where = array('id' => $id);
					$data_post = [
					'title'=>$label,
					'tarif'=>$tarif,
					'idparent'=>$idparent,
					'id_master'=>$idmaster,
					'id_kategori'=>$idkategori,
					'grup'=>$grup,
					'kategori'=>strtolower($tag->tag),
					'stat'=>$aktif];
					
					$this->model_app->update('form_penggunaan', $data_post, $where);
					$arr['type']  = 'edit';
					$arr['msg'] = 'Data di Update';
					$arr['label'] = $label;
					$arr['aktif']  = $aktif;
					$arr['idkategori']  = $idkategori;
					$arr['id'] = $id;
					} else {
					$row = $this->db->query("SELECT max(urutan)+1 as urutan FROM form_penggunaan")->row_array();
					 
					$data_post = [
					'title'=>$label,
					'tarif'=>$tarif,
					'idparent'=>$idparent,
					'id_master'=>$idmaster,
					'id_kategori'=>$idkategori,
					'kategori'=>strtolower($tag->tag),
					'urutan'=>$row['urutan'],
					'grup'=>$grup,
					'stat'=>$aktif];
					$insert = $this->model_app->input('form_penggunaan',$data_post);
					if($insert['status']=='ok')
					{
						$arr['ok'] = 'ok';
						$lastid = $insert['id'];
						
						$_aktif = '';
						if($aktif==0){
							$_aktif = 'text-danger';
						}
						
						$arr['menu'] = '<li class="dd-item dd3-item '.$_aktif.'" data-id="'.$lastid.'" >
	                    <div class="dd-handle dd3-handle"></div>
	                    <div class="ns-row">
						<div class="ns-title" id="label_show'.$lastid.'">'.$label.'</div>
						<div class="ns-class" id="eclass_show'.$lastid.'">'.$tag->tag.'</div>
						<div class="ns-actions">
						<a class="edit-button" id="'.$lastid.'"><i class="fa fa-pencil"></i></a>
						<a href="#" class="confirm-delete" data-id="'.$lastid.'" id="'.$lastid.'"><i class="fa fa-trash"></i></a>
						</div> 
	                    </div>
						<script>
						$(".confirm-delete").on("click", function(e) {
						e.preventDefault();
						var id = $(this).data("id");
						$("#myModalDel").data("id", id).modal("show");
						});
						</script>';
						}else{
						$arr['type'] = 'error';
					}
					$arr['type'] = 'add';
					$arr['msg'] = 'Data di simpan';
				}
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		public function cari_divisi(){
			$divisi = $this->model_master->load_divisi();
			if($divisi->num_rows() >0){
				foreach ($divisi->result_array() AS $row) {
					$data[] = array("id"=>$row['id'],"name"=>$row['nama_divisi']);
				}
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
			}
		}
		
		public function cari_master(){
			$divisi = $this->model_master->load_master();
			if($divisi->num_rows() >0){
				foreach ($divisi->result_array() AS $row) {
					$data[] = array("id"=>$row['id'],"name"=>$row['nama_barang']);
				}
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
			}
		}
		
		public function edit_materiel(){
			$id = $this->db->escape_str($this->input->post('id'));
			$row = $this->model_app->edit('cc_master', ['id'=>$id])->row();
			
			$data = [
			'id'      =>$id,
			'title'   =>$row->nama_barang,
			'parent'  =>$row->parent,
			'kategori'=>$row->kategori,
			'harga'   =>$row->harga,
			'stok'  =>$row->linked,
			'aktif'  =>$row->stat,
			'satuan'  =>$row->satuan
			];
		
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function simpan_barang(){
			
			$type           = $this->db->escape_str($this->input->post('type'));
			$nama_barang    = $this->db->escape_str($this->input->post('nama_barang'));
			$harga_barang   = $this->db->escape_str($this->input->post('harga_barang'));
			$satuan_barang  = $this->db->escape_str($this->input->post('satuan_barang'));
			$parent         = $this->db->escape_str($this->input->post('parent_barang'));
			$kategori       = $this->db->escape_str($this->input->post('kategori'));
			$stok       	= $this->db->escape_str($this->input->post('stok'));
			$aktif       	= $this->db->escape_str($this->input->post('aktif'));
			
			if($type=='add'){
				$data_post = [
				'nama_barang'=>$nama_barang,
				'harga'      =>$harga_barang,
				'satuan'     =>$satuan_barang,
				'parent'     =>$parent,
				'kategori'   =>$kategori,
				'tag'   	 =>kategori($kategori)['tag'],
				'linked'   	 =>$stok,
				'stat'   	 =>$aktif,
				'tgl'        =>date('Y-m-d')
				];
			
				$insert = $this->model_app->input('cc_master',$data_post);
				
				if($insert['status']=='ok')
				{
					$arr = [
					'status'=>true,
					'title' =>'Tambah data',
					'msg'   =>'Data berhasil ditambahkan'
					];
				}
				else
				{
					$arr = [
					'status'=>false,
					'title' =>'Tambah data',
					'msg'   =>'Data gagal ditambahkan'
					];
				}
			}
			if($type=='edit'){
				$id = $this->db->escape_str($this->input->post('id'));
				
				$data_post = [
				'nama_barang'=>$nama_barang,
				'harga'      =>$harga_barang,
				'satuan'     =>$satuan_barang,
				'parent'     =>$parent,
				'kategori'   =>$kategori,
				'tag'   	 =>strtoupper(kategori($kategori)['tag']),
				'linked'   	 =>$stok,
				'stat'   	 =>$aktif,
				];
			
				$where = array('id' => $id);
				$res= $this->model_app->update('cc_master', $data_post, $where);
				
				if($res['status']=='ok'){
					$arr = [
					'status'=>true,
					'title' =>'Perbaharui data',
					'msg'   =>'Data berhasil diperbaharui'
					];
					}else{
					$arr = [
					'status'=>false,
					'title' =>'Perbaharui data',
					'msg'   =>'Data gagal diperbaharui'
					];
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
		
		public function hapus_barang(){
			
			$id = $this->db->escape_str($this->input->post('id'));
			
			$where = array('id' => $id);
			$data_post = ['stat'=>0];
			
			$res= $this->model_app->update('cc_divisi', $data_post, $where);
			if($res['status']=='ok'){
				$arr = [
				'status'=>true,
				'title' =>'Hapus data',
				'msg'   =>'Data berhasil dihapus'
				];
				}else{
				$arr = [
				'status'=>false,
				'title' =>'Hapus data',
				'msg'   =>'Data gagal dihapus'
				];
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($arr));
		}
	}