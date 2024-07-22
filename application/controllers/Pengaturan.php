<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Pengaturan extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();
			cek_session_login(1);	
			$this->title = info()['title']; 
			$this->perPage = 10; 
			$this->level = $this->session->level; 
			$this->iduser = $this->session->iduser; 
			$this->idparent = $this->session->idparent; 
			$this->idlevel = $this->session->idlevel; 
		}
		
		public function rekapan()
		{
			
			$data['title'] = "Pengaturan Rekapan";
			$data['idparent'] = $this->session->idparent;
			$data['id_divisi'] = $this->session->id_divisi;
			$data['type_akses'] = $this->model_app->view_where('type_akses',['pub'=>0])->result();
			$data['divisi'] = $this->model_app->view_where('cc_divisi',['stat'=>1])->result();
			$data['list'] = $this->model_mutasi->list_divisi_akses($this->idlevel);  
			$this->thm->load('backend/template','backend/inventory/pengaturan_rekapan',$data);
			
		}
		
		
		public function simpan_rekapan()
		{
			
			// dump($_POST,'print_r','exit');
			
			$id = $this->input->post('id');
			$val = $this->input->post('val');
			$apply = $this->input->post('apply');
			
			$data_update = [
			$val =>$apply,
			];
		
			$where = [
				'id'=>$id
			];
			$update = $this->model_app->update('cc_divisi', $data_update, $where);  
			
			// dump($array,'print_r','exit');
			if($update['status']=='ok'){
				$data = ['status'=>true,'title'=>'Simpan Pengaturan!','msg'=>'Berhasil diperbaharui'];
				}else{
				$data = ['status'=>true,'title'=>'Simpan Pengaturan!','msg'=>'Gagal diperbaharui'];
			}
			echo json_encode($data);
		}
		
	}
	/* End of file Pengaturan.php */
