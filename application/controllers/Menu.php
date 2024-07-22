<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Menu extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// cek_tabel();
			cek_session_login(1);
			$this->perPage = 10; 
			$this->title = tag_key('site_title');
			$this->iduser = $this->session->iduser; 
			$this->akses = $this->session->type_akses; 
			
		}
		
		public function index()
		{
			// cek_menu_akses();
			$data['title'] = 'Menu Admin | ' .$this->title;
			$data['result'] = $this->model_app->view_where('hak_akses',['publish'=>'Y']);
			$this->thm->load('backend/template','backend/menuadmin',$data);
		}
		
		public function crud(){
			
			$type = $this->input->get('type', TRUE);
			$id = $this->input->get('id', TRUE);('id');
			$label = $this->input->get('label', TRUE);
			$link = $this->input->get('link', TRUE);
			$eclass = $this->input->get('eclass', TRUE);
			$treeview = $this->input->get('parentc', TRUE);
			$target = $this->input->get('target', TRUE);
			$aktif = $this->input->get('aktif', TRUE);
			$submenu = $this->input->get('submenu', TRUE);
			if($type=='get'){
				$data = array();
				$return = $this->db->query("SELECT * FROM menuadmin WHERE idmenu='".$id."'")->row_array();	
				$data = array(
				'id' => $return['idmenu'],
				'label' => $return['nama_menu'],
				'link' => $return['link'],
				'target' => $return['target'],
				'eclass' => $return['icon'],
				'parentc' => $return['treeview'],
				'aktif' => $return['aktif'],
				'level' => $return['id_level'],
				'submenu' => $return['link_on']
				);	
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
				}elseif($type=='simpan'){
				// menu_demo();
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
					$qry = $this->db->query("update menuadmin set idparent = '".$row['parentID']."', urutan='$i' where idmenu = '".$row['id']."' ");
					$i++;
				}
				}elseif($type=='hapus'){
				// menu_demo();
				function recursiveDeleteMenu($id) {
					$ci = & get_instance();
					$data = array('hapus'=>'hapus');
					$query = $ci->model_app->view_where('menuadmin',['idparent' =>$id]);
					if ($query->num_rows >0) {
						foreach ($query->result_array() as $current){
							recursiveDeleteMenu($current['idmenu']);
						}
					}
					
					$qry =$ci->model_app->hapus('menuadmin',['idmenu'=>$id]);
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
		public function save_menu(){
			// menu_demo();
			$type = $this->input->get('type', TRUE);
			$id = $this->input->get('id', TRUE);('id');
			$label = $this->input->get('label', TRUE);
			$link = $this->input->get('link', TRUE);
			$target = $this->input->get('target', TRUE);
			$eclass = $this->input->get('eclass', TRUE);
			$treeview = $this->input->get('parentc', TRUE);
			$aktif = $this->input->get('aktif', TRUE);
			$submenu = $this->input->get('submenu', TRUE);
			$level = $this->input->get('level', TRUE);
			///
			if($type=='simpan'){
				if($id > 0){
					
					$data_update = [
					'nama_menu' => $label, 
					'link'      => $link, 
					'icon'      => $eclass, 
					'treeview'  => $treeview, 
					'aktif'     => $aktif, 
					'target'    => $target, 
					'link_on'   => $submenu, 
					'id_level'  => $level
					];
					$res= $this->model_app->update('menuadmin', $data_update,['idmenu'=>$id]);
					$arr['type']     = 'edit';
					$arr['msg']      = 'Data di Update';
					$arr['label']    = $label;
					$arr['link']     = $link;
					$arr['eclass']   = $eclass;
					$arr['parentc']  = $treeview;
					$arr['aktif']    = $aktif;
					$arr['submenu']  = $submenu;
					$arr['target']   = $target;
					$arr['level']    = $level;
					$arr['id']       = $id;
					
					} else {
					$row = $this->db->query("SELECT max(urutan)+1 as urutan FROM menuadmin")->row_array();
					$qry = $this->db->query("insert into menuadmin (nama_menu,link,icon,id_level,treeview,aktif,target,link_on,urutan) values ('".$label."', '".$link."', '".$eclass."', '".$level."', '".$treeview."', '".$aktif."','".$target."','".$submenu."','".$row['urutan']."')");
					
					if($qry){
						$arr['ok'] = 'ok';
						$lastid = $this->db->insert_id();
						$resultz = $this->db->query("SELECT idmenu FROM menuadmin");
						foreach ($resultz->result_array() as $rowz){
							$ids_array[] = $rowz['idmenu'];
						}
						$data = implode(",",$ids_array);
						$_aktif = '';
						if($aktif=='N'){
							$_aktif = 'text-danger';
						}
						// $this->db->query("update tb_users set idmenu = '".$data."' where idlevel='$level'");
						$arr['menu'] = '<li id="label_title'.$lastid.'" class="dd-item dd3-item '.$_aktif.'" data-id="'.$lastid.'" >
	                    <div class="dd-handle dd3-handle"></div>
	                    <div class="ns-row">
						<div class="ns-title" id="label_show'.$lastid.'">'.$label.'</div>
						<div class="ns-url" id="link_show'.$lastid.'">'.$link.'</div> 
						<div class="ns-class" id="eclass_show'.$lastid.'">'.$eclass.'</div>
						<div class="ns-actions">
						<a class="edit-button" id="'.$lastid.'" label="'.$label.'" link="'.$link.'" eclass="'.$eclass.'" parentc="'.$treeview.'"><i class="fa fa-pencil"></i></a>
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
		
		
		
		public function printer()
		{
			cek_menu_akses();
			$data['title'] = 'Pengaturan printer |' .$this->title;
			$data['judul'] ='Pengaturan printer';
			
			$this->thm->load('main/themes','main/printer',$data);
		}
		public function data_printer()
		{
			$data['record'] = $this->model_app->view_ordering('printer','id','DESC');
			$this->load->view('main/data_printer',$data);
		}
		public function edit_printer(){
			$id= $this->db->escape_str($this->input->post('id'));
			if($id>0){
				$where = array('id' => $id);
				$row = $this->model_app->edit('printer',$where)->row_array();
				$data = array('id'=>$id,'jenis'=>$row['name'],'shared'=>$row['shared_name'],'ukuran'=>$row['ukuran_kertas'],'posisi'=>$row['posisi'],'item'=>$row['max_item'],'aktif'=>$row['pub']);
				}else{
				$data = array('id'=>0,'jenis'=>"",'shared'=>'','ukuran'=>'','posisi'=>'','item'=>'',"aktif"=>"");
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function save_printer()
		{
			cek_input_post('GET');
			
			$id    = $this->db->escape_str($this->input->post('id'));
			$type  = $this->db->escape_str($this->input->post('type'));
			$judul = $this->db->escape_str($this->input->post('judul'));
			$shared= $this->db->escape_str($this->input->post('shared'));
			$ukuran= $this->db->escape_str($this->input->post('ukuran'));
			$posisi= $this->db->escape_str($this->input->post('posisi'));
			$item  = $this->db->escape_str($this->input->post('item'));
			$aktif = $this->db->escape_str($this->input->post('aktif'));
			
			if($id > 0 AND $type=='edit'){
				$_data = array('name'=>$judul,'shared_name'=>$shared,'ukuran_kertas'=>$ukuran,'posisi'=>$posisi,'max_item'=>$item,'pub'=>$aktif);
				if($aktif==1){
					$res=  $this->model_app->update('printer',$_data,array('id'=>$id));
					$xdata = array('pub'=>0);
					$this->model_app->update('printer',$xdata,array('id!='=>$id));
					}else{
					$res=  $this->model_app->update('printer',$_data,array('id'=>$id));
				}
				///data update
				if($res['status']=='ok'){
					$data = array('status'=>200,'msg'=>'Data berhasil update');
					}else{
					$data = array('status'=>400);
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		public function folder()
		{
			cek_menu_akses();
			$data['title'] = 'Pengaturan Folder | ' .$this->title;
			$data['rows'] = ["computer_name"  =>pengaturan('computer_name'),
            "folder_af" =>pengaturan('folder_af'),
            "folder_gm" =>pengaturan('folder_gm'),
            "folder_ns" =>pengaturan('folder_ns'),
            "folder_tz" =>pengaturan('folder_tz')
            ];
			$this->thm->load('main/themes','main/website/folder',$data);
		}
		public function save_folder()
		{
			
			if (isset($_POST['submit'])){
				$computer_name = $this->db->escape_str($this->input->post('computer_name'));
				$data = array('isi'=>$computer_name);
				$where = array('nama'=>'computer_name');
				$update = $this->model_app->update('shared_folder',$data,$where);
				if($update['status']=='ok'){
					$this->session->set_flashdata('message', '<script>notif("Data di simpan","success");</script>');
					redirect('main/folder');
					}else{
					$this->session->set_flashdata('message', '<script>notif("Data gagal di simpan","danger");</script>');
					redirect('main/folder');
				}
			}
			
		}
	}				
