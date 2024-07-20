<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Satker extends CI_Controller
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
		
		public function crud(){
			
			$type = $this->input->get('type', TRUE);
			$id = $this->input->get('id', TRUE);('id');
			$aktif = $this->input->get('aktif', TRUE);
			if($type=='get'){
				$data = array();
				$return = $this->db->query("SELECT * FROM cc_divisi WHERE id='".$id."'")->row_array();	
				$data = array(
				'id' => $return['id'],
				'label' => $return['nama_divisi'],
				'rekapan' => $return['nama_rekapan'],
				'aktif' => $return['stat'],
				'level' => $return['id_level_divisi']
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
					$qry = $this->db->query("update cc_divisi set idparent = '".$row['parentID']."', urutan='$i' where id = '".$row['id']."' ");
					$i++;
				}
				}elseif($type=='hapus'){
				// menu_demo();
				function recursiveDeleteMenu($id) {
					$ci = & get_instance();
					$data = array('hapus'=>'hapus');
					$query = $ci->model_app->view_where('cc_divisi',['idparent' =>$id]);
					if ($query->num_rows >0) {
						foreach ($query->result_array() as $current){
							recursiveDeleteMenu($current['id']);
						}
					}
					
					$qry =$ci->model_app->hapus('cc_divisi',['id'=>$id]);
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
			$rekapan = $this->input->get('rekapan', TRUE);
			$treeview = $this->input->get('parentc', TRUE);
			$aktif = $this->input->get('aktif', TRUE);
			$level = $this->input->get('level', TRUE);
			///
			if($type=='simpan'){
				if($id != ''){
					$where = array('id' => $id);
					$data_post = [
					'nama_divisi'=>$label,
					'nama_rekapan'=>$rekapan,
					'id_level_divisi'=>$level,
					'stat'=>$aktif];
					$res= $this->model_app->update('cc_divisi', $data_post, $where);
					$arr['type']  = 'edit';
					$arr['msg'] = 'Data di Update';
					$arr['label'] = $label;
					$arr['parentc']  = $treeview;
					$arr['aktif']  = $aktif;
					$arr['level']  = $level;
					$arr['id']    = $id;
					} else {
					$row = $this->db->query("SELECT max(urutan)+1 as urutan FROM cc_divisi")->row_array();
					$data_post = ['nama_divisi'=>$label,'nama_rekapan'=>$rekapan,'urutan'=>$row['urutan']];
					$insert = $this->model_app->input('cc_divisi',$data_post);
					if($insert['status']=='ok')
					{
						$arr['ok'] = 'ok';
						$lastid = $insert['id'];
						$resultz = $this->db->query("SELECT id FROM cc_divisi");
						foreach ($resultz->result_array() as $rowz){
							$ids_array[] = $rowz['id'];
						}
						if($this->level=='admin'){
							$data = implode(",",$ids_array);
							}else{
							$data = $level;
						}
						$_aktif = '';
						if($aktif==9){
							$_aktif = 'text-danger';
						}
						$this->db->query("update tb_users set id_divisi = '".$data."'");
						$arr['menu'] = '<li class="dd-item dd3-item '.$_aktif.'" data-id="'.$lastid.'" >
	                    <div class="dd-handle dd3-handle"></div>
	                    <div class="ns-row">
						<div class="ns-title" id="label_show'.$lastid.'">'.$label.'</div>
						<div class="ns-actions">
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
		
	}				
