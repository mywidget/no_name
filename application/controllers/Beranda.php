<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Home extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();
			
			cek_session_login(1);
			
			$this->title = tag_key('site_title');
			$this->iduser = $this->session->iduser; 
            $this->level = $this->session->level; 
			
			$this->perPage = 10;
		}
		public function index()
		{
			
			$this->thm->set('title', 'Dashboard');
			//PENDAFTAR BARU
			$_where['where'] = array(
			's_pendidikan' => 'Baru'
			);
			//PENDAFTAR BARU DITERIMA
			$diterima['where'] = array(
			's_pendidikan' => 'Baru',
			'status' => 'Diterima'
			);
			//PENDAFTAR BARU DITERIMA
			$ditolak['where'] = array(
			's_pendidikan' => 'Baru',
			'status' => 'Tidak Diterima'
			);
			
			//PENDAFTAR PINDAHAN
			$pindahan['where'] = array(
			's_pendidikan' => 'Pindahan'
			);
			//PENDAFTAR PINDAHAN DITERIMA
			$pindahan_diterima['where'] = array(
			's_pendidikan' => 'Pindahan',
			'status' => 'Diterima'
			);
			//PENDAFTAR PINDAHAN DITOLAK
			$pindahan_ditolak['where'] = array(
			's_pendidikan' => 'Pindahan',
			'status' => 'Tidak Diterima'
			);
			 
			//PENDAFTAR NAIK TINGKAT
			$where['where'] = array(
			's_pendidikan' => 'Naik Tingkatan',
			);
			
			//PENDAFTAR NAIK DITERIMA
			$naik_diterima['where'] = array(
			's_pendidikan' => 'Naik Tingkatan',
			'status' => 'Diterima'
			);
			
			//PENDAFTAR NAIK DITOLAK
			$naik_ditolak['where'] = array(
			's_pendidikan' => 'Naik Tingkatan',
			'status' => 'Tidak Diterima'
			);
			
			$where_user['where'] = array(
			'level !=' => 'admin'
			);
			
			$data['pengguna'] = $this->model_app->counter('tb_users',$where_user);
			
			//baru
			$data['pendaftar_baru'] = $this->model_app->counter('rb_psb_daftar',$_where);
			$data['pendaftar_diterima'] = $this->model_app->counter('rb_psb_daftar',$diterima);
			$data['pendaftar_ditolak'] = $this->model_app->counter('rb_psb_daftar',$ditolak);
			//pindahan
			$data['pendaftar_pindahan_baru'] = $this->model_app->counter('rb_psb_daftar',$pindahan);
			$data['pendaftar_pindahan_diterima'] = $this->model_app->counter('rb_psb_daftar',$pindahan_diterima);
			$data['pendaftar_pindahan_ditolak'] = $this->model_app->counter('rb_psb_daftar',$pindahan_ditolak);
			//NAIK TINGKAT
			$data['naik_tingkat'] = $this->model_app->counter('rb_psb_daftar',$where);
			$data['naik_tingkat_diterima'] = $this->model_app->counter('rb_psb_daftar',$naik_diterima);
			$data['naik_tingkat_ditolak'] = $this->model_app->counter('rb_psb_daftar',$naik_ditolak);
			 
			$data['tanggal'] = tgl_dari_slash() . ' - ' .tgl_sampai_slash();
			$data['dari'] = month();
			$data['sampai'] = year();
			
			$data['item'] = year();
			
			$this->thm->load('backend/template','backend/dashboard',$data);
			
			
		}
		
		private function categories($categories,$idmaster){
			$i=0;
			foreach($categories as $p_cat){
				
				$categories[$i]->sub = $this->model_data->sub_categories($p_cat->id,$idmaster);
				$i++;
			}
			return $categories;
		}
		
		
		private function save_pengiriman($table,$data){    
			return $this->db->insert_batch($table, $data);  
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
			$idmaster = $this->input->post('idmaster');
			$stok = $this->model_mutasi->real_stok_tag_divisi($tag,$idsatker);
			
			$data = ['status'=>true];
			
			if($stok == 0){
				$data = ['status'=>false,'msg'=>'Stok masih kosong'];
			}
			
			if($total > $stok){
				$data = ['status'=>false,'msg'=>'Penggunaan Melebihi Stok '.$stok];
			}
			
			return $data;
		}
		private function cek_stok($idmaster,$idsatker,$total){
			$idmaster = $this->input->post('idmaster');
			// $idsatker = $this->input->post('idsatker');
			// $total = $this->input->post('total');
			$stok = $this->model_mutasi->real_stok_div($idmaster,$idsatker);
			
			$data = ['status'=>true];
			
			if($stok == 0){
				$data = ['status'=>false,'msg'=>'Stok masih kosong'];
			}
			
			if($total > $stok){
				$data = ['status'=>false,'msg'=>'Penggunaan Melebihi Stok'];
			}
			
			return $data;
		}
		
		public function load_total_materiel(){
			$tanggal = $this->input->get('tanggal');
			
			$dari 	= tgl_dari_slash();
			$sampai = tgl_sampai_slash();
			if (!empty($tanggal)) {
				$dt = periode($tanggal);
				$dari 	= $dt['awal'];
				$sampai = $dt['akhir'];
			}
			$hasil = $this->model_report->sumByDate($dari,$sampai);
			$data = ['total'=>rp($hasil->jml)];
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function load_total_materiel_satker(){
			$tanggal = $this->input->get('tanggal');
			
			$dari 	= tgl_dari_slash();
			$sampai = tgl_sampai_slash();
			$divisi = $this->id_divisi;
			if (!empty($tanggal)) {
				$dt = periode($tanggal);
				$dari 	= $dt['awal'];
				$sampai = $dt['akhir'];
			}
			$hasil = $this->model_report->sumByDateSatker($divisi,$dari,$sampai);
			$data = ['total'=>rp($hasil->jml)];
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		public function chart_penggunaan(){
			$tanggal = $this->input->get('tanggal');
			
			$dari 	= tgl_dari_slash();
			$sampai = tgl_sampai_slash();
			if (!empty($tanggal)) {
				$dt = periode($tanggal);
				$dari 	= $dt['awal'];
				$sampai = $dt['akhir'];
			}
			// $cc_master = $this->model_app->view_where('cc_master',['parent'=>0])->result();
			$cc_master = $this->model_app->view_where_ordering('cc_master',['parent'=>0],'sorting','ASC')->result();
			$hasil = [];
			foreach($cc_master as $x => $val) {
				$hasil['data'][] = [
				'x'=>strtoupper($val->tag),
				'y'=>stok_keluar_by_date($val->tag,$dari,$sampai)
				];
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($hasil));
		}
		public function chart_penggunaan_satker(){
			$tanggal = $this->input->get('tanggal');
			
			$dari 	= tgl_dari_slash();
			$sampai = tgl_sampai_slash();
			if (!empty($tanggal)) {
				$dt = periode($tanggal);
				$dari 	= $dt['awal'];
				$sampai = $dt['akhir'];
			}
			
			$cc_master = $this->model_app->view_where_ordering('cc_master',['parent'=>0],'sorting','ASC')->result();
			$hasil = [];
			foreach($cc_master as $x => $val) {
				$cc_divisi = $this->model_app->view_where('cc_divisi',['id'=>$this->id_divisi,$val->tag=>1])->result();
				foreach($cc_divisi as  $row) {
					$hasil['data'][] = [
					'x'=>$val->tag,
					'y'=>stok_keluar_by_date_satker($row->id,$val->tag,$dari,$sampai)
					];
				}
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($hasil));
		}
		
		public function chart_satker(){
			$tanggal = $this->input->post('tanggal');
			
			$dari 	= tgl_dari_slash();
			$sampai = tgl_sampai_slash();
			if (!empty($tanggal)) {
				$dt = periode($tanggal);
				$dari 	= $dt['awal'];
				$sampai = $dt['akhir'];
			}
			
			$cc_master = $this->model_app->view_where_ordering('rb_psb_daftar',['status_sekolah'=>'baru'],'sorting','ASC')->result();
			
			foreach($cc_master as $a => $vals) {
				$arr[$x][$vals->tag] =  stok_keluar_divisi_by_month($val->id,$vals->tag,$dari,$sampai);
				// $arr[$x][] =  $val->id;
				$allnotif[] = array('tag'=>$vals->tag);
				
			}
			// dump($arr,'print_r','exit');
			$json[] = array(
			"divisi" => strtoupper($val->nama_divisi),
			"data" =>[$allnotif[$x],['hasil'=>$arr[$x]]]
			);
			
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
		}
		
		
	}
	
	/* End of file Home.php */
