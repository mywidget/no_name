<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Ticket extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			cek_session_login(1);
			$this->title = info()['title']; 
			$this->iduser = $this->session->iduser; 
            $this->id_divisi = $this->session->id_divisi; 
            $this->level = $this->session->level; 
			$this->perPage = 10;
		}
		
		public function index()
        {
			cek_menu_akses();
			$data['title'] = 'Ticket | '.$this->title;
			
            $cekUser = cekUser($this->iduser);
			
            $data['level'] = $this->level;
            $data['id_level'] = $cekUser['idlv'];
            $data['idmenu'] = $cekUser['idmenu'];
            $data['tanggal'] = tanggal();
            // Get record count 
			if($this->level!='admin'){
				$conditions['where'] = array(
				'id_user' => $this->iduser,
				);
				$where = ['id'=>$this->id_divisi,'stat'=>1];
				}else{
				$conditions['where'] = array(
				'status' => 1
				);
				$where = ['stat'=>1];
			}
			// dump($where,'print_r','exit');
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getPesan($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('pesan/ajaxPesan');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'search_tiket';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions = array(
            'limit' => $this->perPage
            );
			
            // Get record count 
			if($this->level!='admin'){
				$conditions['where'] = array(
				'id_user' => $this->iduser,
				);
			}
			// Get record count 
			if($this->level=='admin'){
				$conditions['where'] = array(
				'status' => 1
				);
			}
			$data['kategori'] = $this->model_app->view_where('kategori',['tiket'=>1]);
			$data['divisi'] = $this->model_app->view_where('cc_divisi',$where);
            $data['record'] = $this->model_data->getPesan($conditions);
			$this->thm->load('backend/template','backend/user/tiket',$data);
		}
        function ajaxTiket()
        {
            // Define offset 
            $page = $this->input->post('page');
            if (!$page) {
                $offset = 0;
                } else {
                $offset = $page;
			}
            $limit = $this->input->post('limit');
            if (!empty($limit)) {
                $conditions['search']['limit'] = $limit;
				}else{
				$limit = $this->perPage;
			}
			$keywords = $this->input->post('keywords');
            if (!empty($keywords)) {
                $conditions['search']['keywords'] = $keywords;
			}
            $sortBy = $this->input->post('sortBy');
            if (!empty($sortBy)) {
                $conditions['search']['sortBy'] = $sortBy;
			}
			$kategori = $this->input->post('kategori');
            if (!empty($kategori)) {
                $conditions['where'] = array(
				'id_master' => $kategori,
				);
			}
			$satker = $this->input->post('satker');
            if (!empty($satker)) {
				$conditions['where'] = array(
				'id_divisi' => $satker,
				);
			}
			if($this->level!='admin'){
				$conditions['where'] = array(
				'id_user' => $this->iduser,
				);
			}
			$status = $this->input->post('status');
			if (!empty($status)) {
				$conditions['where'] = array(
				'status' => $status
				);
			}
            // Get record count 
            $conditions['returnType'] = 'count';
            $totalRec = $this->model_data->getPesan($conditions);
            
            // Pagination configuration 
            $config['target']      = '#posts_content';
            $config['base_url']    = base_url('ticket/ajaxTiket');
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'search_tiket';
            
            // Initialize pagination library 
            $this->ajax_pagination->initialize($config);
            
            // Get records 
            $conditions['start'] = $offset;
            $conditions['limit'] = $limit;
            $data['start'] = $offset;
            $data['level'] = $this->level;
            if (!empty($status)) {
				$conditions['where'] = array(
				'status' => $status
				);
			}
            unset($conditions['returnType']);
            $data['record'] = $this->model_data->getPesan($conditions);
			
            // Load the data list view 
			$this->load->view('backend/user/ajax-tiket',$data);
			
		}
		
		public function simpan_tiket()
		{
			
			$mod = $this->input->post('mod',TRUE);
			$kode = $this->input->post('kode',TRUE);
			$Materiel = $this->input->post('Materiel',TRUE);
			$tanggal = $this->input->post('tanggal',TRUE);
			
			$mod_edit = $this->input->post('mod_edit',TRUE);
			if ($mod=='buat'){
				$get_parent = get_parent($Materiel)->parent;
				if($get_parent > 0){
					$Materiel = $get_parent;
					}else{
					$Materiel = $this->input->post('Materiel',TRUE);
				}
				$cek_nomor = $this->model_app->view_where('cc_terjual',['id_surat'=>$kode,'id_master'=>$Materiel,'id_divisi'=>$this->id_divisi]);
				if($cek_nomor->num_rows() > 0){
					$cek_kode = $this->model_app->view_where('pesan_masuk',['kode'=>$kode]);
					if($cek_kode->num_rows() > 0){
						$row = $cek_kode->row();
						if($row->status==1){
							$data = array('status'=>400,'title'=>'Buat Tiket','msg'=>'Permohonan masih dalam proses mohon bersabar');
						}
						if($row->status==2){
							$data = array('status'=>400,'title'=>'Buat Tiket','msg'=>'Permohonan sudah selesai di proses');
						}
						if($row->status==3){
							$data = array('status'=>400,'title'=>'Buat Tiket','msg'=>'Permohonan masih di pending');
						}
						if($row->status==4){
							$data = array('status'=>400,'title'=>'Buat Tiket','msg'=>'Permohonan sudah di cancel');
						}
						if($row->status==5){
							$data = array('status'=>400,'title'=>'Buat Tiket','msg'=>'Permohonan penghapusan sudah selesai');
						}
						
						$this->output
						->set_status_header(200)
						->set_content_type('application/json', 'utf-8')
						->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						->_display();
						exit;
					}
					//count
					$count_jml = $this->model_app->sum_data('jml','cc_terjual',['id_surat'=>$kode,'id_master'=>$Materiel,'id_divisi'=>$this->id_divisi]);
					$data = array('id_user'=>$this->iduser,
					'id_divisi'=>$this->id_divisi,
					'id_master'=>$this->db->escape_str($this->input->post('Materiel')),
					'kode'=>$this->db->escape_str($this->input->post('kode')),
					'nomor_tiket'=>random(9),
					'status'=>1,
					'tanggal'=>$tanggal,
					'id_form'=>$cek_nomor->row()->id_form,
					'jml'=>$count_jml,
					'tanggal_penggunaan'=>$cek_nomor->row()->tgl,
					'keterangan'=>$this->db->escape_str($this->input->post('keterangan'))
					);
					
					$input= $this->model_app->input('pesan_masuk', $data);
					if($input['status']=='ok'){
						$data = array('status'=>200,'title'=>'Buat Tiket','msg'=>'Tiket berhasil dibuat');
						}else{
						$data = array('status'=>400,'title'=>'Buat Tiket','msg'=>'Tiket gagal dibuat');
					}
					}else{
					$data = array('status'=>400,'title'=>'Buat Tiket','msg'=>'Kode Transaksi / Materiel tidak sesuai, Cek di laporan penggunaan');
				}
			}
			if ($mod_edit=='edit'){
				$Materiel = $this->input->post('materiel_edit',TRUE);
				$get_parent = get_parent($Materiel)->parent;
				if($get_parent > 0){
					$Materiel = $get_parent;
					}else{
					$Materiel = $this->input->post('Materiel',TRUE);
				}
				$status = $this->input->post('status',TRUE);
				$id_tiket = $this->input->post('id_tiket',TRUE);
				$id_divisi = $this->input->post('id_divisi',TRUE);
				$kode_edit = $this->input->post('kode_edit',TRUE);
				
				$keterangan_edit = $this->input->post('keterangan_edit',TRUE);
				$keterangan_balas = $this->input->post('keterangan_balas',TRUE);
				$where = ['id'=>$id_tiket];
				$search = $this->model_app->edit('pesan_masuk', $where);
				if($search->num_rows()>0){
					
					$_data = ['status'=>$status,'keterangan'=>nl2br($keterangan_edit),'balasan'=>nl2br($keterangan_balas)];
					$res = $this->model_app->update('pesan_masuk',$_data,$where);
					if($res['status']=='ok'){
						if($status==5){
							$this->add_to_hapus_materiel($id_divisi,$kode_edit);
							$data = $this->hapus_materiel($id_divisi,$kode_edit);
							}else{
							$data = array('status'=>200,'title'=>'Update status','msg'=>'Tiket berhasil diupdate');
						}
						}else{
						$data = array('status'=>400,'title'=>'Update status','msg'=>'Tiket gagal diupdate');
					}
					
					}else{
					$data = array('status'=>500,'msg'=>'Terjadi masalah');
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		function hapus_tiket(){
			cek_input_post('GET');
			
			$id = $this->db->escape_str($this->input->post('id'));
			$where = array('id' => $id);
			
			$search = $this->model_app->edit('pesan_masuk', $where);
			if($search->num_rows()>0){
				
				$res = $this->model_app->update('pesan_masuk',['status'=>4],$where);
				if($res['status']=='ok'){
					$data = array('status'=>200,'title'=>'Hapus data','msg'=>'Tiket berhasil dihapus');
					}else{
					$data = array('status'=>400,'title'=>'Hapus data','msg'=>'Tiket gagal dihapus');
				}
				
				}else{
				$data = array('status'=>500,'msg'=>'Tiket gagal dihapus');
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		private function add_to_hapus_materiel($id_divisi=0,$kode_edit=0){
			
			$where = array('id_divisi' => $id_divisi,'id_surat'=>$kode_edit);
			// print_r($where);
			$search = $this->model_app->view_where('cc_terjual', $where);
			if($search->num_rows()>0){
				foreach($search->result() AS $row){
					// print_r($row);
					$this->model_app->input('hapus_cc_terjual', $row,$where);
				}
			}
			// return $data;
		}
		
		private function hapus_materiel($id_divisi,$kode_edit){
			
			$where = array('id_divisi' => $id_divisi,'id_surat'=>$kode_edit);
			$_where = array('id_divisi' => $id_divisi,'id'=>$kode_edit);
			// dump($where,'print_r','exit');
			$search = $this->model_app->view_where('cc_terjual', $where);
			if($search->num_rows()>0){
				$delete = $this->model_app->hapus('cc_terjual', $where);
				$this->model_app->hapus('data_penggunaan', $_where);
				if($delete['status']=='ok')
				{
					$data = array('status'=>200,'title'=>'Hapus data','msg'=>'Tiket berhasil diupdate dan materiel sudah dihapus');
					}else{
					$data = array('status'=>400,'title'=>'Hapus data','msg'=>'Tiket gagal dihapus');
				}
				
				}else{
				$data = array('status'=>500,'msg'=>'Data gagal dihapus');
			}
			return $data;
			
		}
		
		
		public function load_tiket()
		{
			cek_input_post('GET');
			
			$id = $this->db->escape_str($this->input->post('id'));
			$where = array('id' => $id);
			$search = $this->model_app->edit('pesan_masuk', $where);
			if($search->num_rows()>0){
				$this->model_app->update('pesan_masuk',['dibaca'=>1],$where);
				$row = $search->row();
				
				$data = [
				'status'=>200,
				'id'=>$row->id,
				'id_divisi'=>$row->id_divisi,
				'materiel'=>$row->id_master,
				'kode'=>$row->kode,
				'tanggal'=>$row->tanggal,
				'status'=>$row->status,
				'keterangan'=>$row->keterangan,
				'balasan'=>$row->balasan
				];
				}else{
				$data = array('status'=>500,'msg'=>'Data tidak ada');
			}
			
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
	}