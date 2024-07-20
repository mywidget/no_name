<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Grafik extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();
			
			// cek_session_login(1);
			$this->title = info()['title']; 
			$this->grafik = info()['grafik']; 
			
			$this->perPage = 10;
		}
		public function index()
		{
			
			$data['title'] = 'Grafik ' .$this->title;
			$data['grafik'] = $this->grafik;
			
			$where['where'] = array(
			'parent' => 0
			);
			$data['pengguna'] = $this->model_app->counter('tb_users',[]);
			$data['satker'] = $this->model_app->counter('cc_divisi',[]);
			$data['item'] = $this->model_app->counter('cc_master',$where);
			$data['kategori'] = $this->model_app->view_where_ordering('kategori_tag',['stat'=>1,'idparent'=>0],'urutan','ASC')->result(); 
		
			$data['tanggal'] = tgl_dari_slash() . ' - ' .tgl_sampai_slash();
			$data['dari'] = month();
			$data['sampai'] = year();
			
			$data['login'] = $this->model_app->view_ordering_limit('cms_admin_log','id','DESC',0,20);
			$this->load->view('backend/grafik',$data);
			
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
 
		public function chart_penggunaan(){
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
				$hasil['data'][] = [
				'x'=>strtoupper($val->tag),
				'y'=>stok_keluar_by_date($val->tag,$dari,$sampai)
				];
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
			
			$query_divisi = $this->model_app->view_where_ordering('cc_divisi',['stat'=>1],'urutan','ASC')->result();
			$cc_master = $this->model_app->view_where_ordering('cc_master',['parent'=>0],'sorting','ASC')->result();
			
			foreach($query_divisi as $x => $val) {
				
				foreach($cc_master as $a => $vals) {
					$arr[$x][$vals->tag] =  stok_keluar_divisi_by_month($val->id,$vals->tag,$dari,$sampai);
					// $arr[$x][] =  $val->id;
					$allnotif[] = array('tag'=>strtoupper($vals->tag));
					
				}
				// dump($arr,'print_r','exit');
				$json[] = array(
				"divisi" => strtoupper($val->nama_divisi),
				"data" =>[$allnotif[$x],['hasil'=>$arr[$x]]]
				);
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
		}
	}
	/* End of file Grafik.php */
