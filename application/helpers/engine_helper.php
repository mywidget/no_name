<?php
	
	if ( ! function_exists('quote'))
	{
		function quote($text){
			global $CI;
			return $CI->db->escape($text);
		}
	}
	if ( ! function_exists('query'))
	{
		/**
			* Code pengaturan
			*
			@param $val array
			@return string
		*/
		function query($val){
			global $CI;
			return $CI->db->query($val);
		}
	}
	if ( ! function_exists('cek_idmaster'))
	{
		/**
			* Code pengaturan
			*
			@param $val array
			@return string
		*/
		function cek_idmaster($tag=''){
			$ci = & get_instance();
			if($tag==''){
				$data = ['status'=>false,'id'=>0,'idparent'=>0,'tag'=>'-','msg'=>'Data tidak ditemukan'];
				}else{
				$result = $ci->model_app->view_where('cc_master',['tag'=>$tag,'parent'=>0]);
				if($result->num_rows() > 0){
					$data = ['status'=>true,'id'=>$result->row()->id,'idparent'=>$result->row()->kategori,'tag'=>$result->row()->tag,'msg'=>''];
					}else{
					$data = ['status'=>false,'id'=>0,'idparent'=>0,'tag'=>'-','msg'=>'Data tidak ditemukan'];
				}
			}
			return $data;
		}
	}
	if ( ! function_exists('periode_stok'))
	{
		/**
			* Code pengaturan
			*
			@param $val array
			@return string
		*/
		function periode_stok($id=''){
			$ci = & get_instance();
			if($id==''){
				return '';
				}else{
				$result = $ci->model_app->view_where('laporan_stok',['id'=>$id])->row();
				return $result->title;
			}
		}
	}
	
	
	if ( ! function_exists('input_stok_keluar'))
	{
		/**
			* Code pengaturan
			*
			@param $val array
			@return string
		*/
		function input_stok_keluar($id){
			$ci = & get_instance();
			// $result = $ci->model_app->view_where('invoice_detail',['id_invoice'=>$id])->result();
			$result = $ci->model_app->join_where('`invoice_detail`.`id_bahan`,`invoice_detail`.`tot_ukuran`,`invoice_detail`.`jumlah`,`invoice_detail`.`update_date`','bahan','invoice_detail','id','id_bahan',['`bahan`.`status_stok`'=>'Y','id_invoice'=>$id])->result();
			if(!empty($result)){
				foreach($result AS $val){
					
					$data[] = [
					'id_bahan'=>$val->id_bahan,
					'id_invoice'=>$id,
					'jumlah'=>$val->jumlah,
					'create_date'=>$val->update_date
					];
					
				}
				$ci->db->insert_batch("stok_keluar",$data);
			}
		}
	}
	function idform($list)
	{
		list($hitam, $putih, $merah, $kuning) = explode(',', $list);
		return ['hitam' => $hitam, 'putih' => $putih, 'merah' => $merah, 'kuning' => $kuning];
	}
	
	function id_form($list)
	{
		list($a, $b, $c) = explode(',', $list);
		return ['a' => $a, 'b' => $b, 'c' => $c];
	}
	
	if ( ! function_exists('stok_gudang'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function stok_gudang($tag,$tahun='')
		{
			
			$ci = & get_instance();
			if(empty($tahun))
			$tahun = date("Y");
			
			$group_by1 = array('tag','YEAR(tgl)');
			
			//penggunaan cc_terjual
			$array_cc_terjual = array('tb'=>'cc_terjual','tag' => $tag);
			$ci->db->select_sum('jml');
			$ci->db->from('cc_penggunaan');
			$ci->db->where('YEAR(cc_penggunaan.tgl)',$tahun);
			$ci->db->where($array_cc_terjual);
			$ci->db->group_by($group_by1);
			$query = $ci->db->get(); 
			$penggunaan_cc_terjual = ($query->num_rows() > 0)?$query->row()->jml:0; 
			
			return $penggunaan_cc_terjual;
			
		}
	}
	if ( ! function_exists('stok_masuk'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function stok_masuk($tag)
		{
			$ci = & get_instance();
			$ci->db->select_sum('jml');
			$ci->db->from('cc_terima');
			$ci->db->where('tag',$tag);
			$ci->db->group_by('tag');
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
			return $result; 
			
		}
	}
	
	if ( ! function_exists('stok_awal_divisi'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function stok_awal_divisi($tag,$id_divisi,$bulan,$tahun='')
		{
			$ci = & get_instance();
			if(empty($bulan)){
				$bulan = date("m");
				}else{
				$bulan = $bulan;
			}
			
			if(empty($tahun)){
				$tahun = date("Y");
				}else{
				$tahun = $tahun;
			}
			$month_year = $tahun.'-'.$bulan;
			//stok awal gudang di tb cc_stok cc_terima
			$where_stok_awal_gudang = array('tb'=>'cc_terima','tag' => $tag);
			$group_gudang = array('tag');
			// print_r($array);
			
			$ci->db->select_sum('jml');
			$ci->db->from('cc_stok');
			$ci->db->where('YEAR(cc_stok.tgl) <=',$tahun);
			$ci->db->where($where_stok_awal_gudang);
			$ci->db->group_by($group_gudang);
			$query = $ci->db->get(); 
			$stok_awal_gudang = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok end
			
			//stok awal satker tb cc_stok cc_kirim
			$array_cc_stok = array('tb'=>'cc_kirim','tag' => $tag, 'id_divisi' => $id_divisi);
			$group_by1 = array('tag','id_divisi');
			// print_r($array);
			
			
			$ci->db->select_sum('jml');
			$ci->db->from('cc_stok');
			$ci->db->where('YEAR(cc_stok.tgl) <=',$tahun);
			$ci->db->where($array_cc_stok);
			$ci->db->group_by($group_by1);
			$query = $ci->db->get(); 
			$stok_awal_divisi = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok end
			
			//total terima bulan sebelumya
			$sql_terima = query("SELECT SUM(jml) AS total_sebelumnya FROM cc_terima WHERE tag = '$tag' AND DATE_FORMAT(tgl,'%Y-%m') < ".quote($month_year).' AND stat <> 9 group by tag');
			// $rowt = $sql_terima->row_array();
			// $total_sebelumnya = $rowt['total_sebelumnya'];
			$total_sebelumnya = ($sql_terima->num_rows() > 0)?$sql_terima->row()->total_sebelumnya:0; 
			//total pengiriman bulan sebelumnya
			$sqlk = query("SELECT SUM(jml) AS total_kirim FROM cc_kirim WHERE tag = '$tag' AND DATE_FORMAT(tgl,'%Y-%m') < ".quote($month_year).' AND stat <> 9 group by tag');
			// $rowk = $sqlk->row_array();
			$total_kirim = ($sqlk->num_rows() > 0)?$sqlk->row()->total_kirim:0; 
			// $total_kirim =  $rowk['total_kirim'];
			//stok di tb cc_terima untuk gudang perbulan
			$where = ['tag'=>$tag];
			$ci->db->select_sum('jml');
			$ci->db->from('cc_terima');
			$ci->db->where($where);
			$ci->db->where('MONTH(cc_terima.tgl)',$bulan);
			$ci->db->where('YEAR(cc_terima.tgl)',$tahun);
			$ci->db->group_by('tag');
			$query = $ci->db->get(); 
			$cc_terima = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok cc_kirim end 
			
			
			//stok di tb cc_kirim untuk gudang
			// $where = ['tag'=>$tag,'id_divisi'=>$id_divisi];
			$ci->db->select_sum('jml');
			$ci->db->from('cc_kirim');
			$ci->db->where($where);
			$ci->db->where('MONTH(cc_kirim.tgl)',$bulan);
			$ci->db->where('YEAR(cc_kirim.tgl)',$tahun);
			$ci->db->group_by('tag');
			$query = $ci->db->get(); 
			$cc_kirim = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok cc_kirim end 
			
			
			//stok di tb cc_kirim
			$where_divisi = ['tag'=>$tag,'id_divisi'=>$id_divisi];
			$ci->db->select_sum('jml');
			$ci->db->from('cc_kirim');
			$ci->db->where($where_divisi);
			$ci->db->where('MONTH(cc_kirim.tgl)',$bulan);
			$ci->db->where('YEAR(cc_kirim.tgl)',$tahun);
			$ci->db->group_by($group_by1);
			$query = $ci->db->get(); 
			$cc_kirim_divisi = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok cc_kirim end 
			
			//penggunaan sebelumnya
			$sql2 = query("SELECT SUM(jml) AS total_penyesuaian FROM cc_terjual WHERE id_divisi='$id_divisi' AND tag = '$tag' AND DATE_FORMAT(tgl,'%Y-%m') < ".quote($month_year)." group by tag,id_divisi");
			// $row2 = $sql2->row_array();
			// $total_penyesuaian = $row2['total_penyesuaian'];
			$total_penyesuaian = ($sql2->num_rows() > 0)?$sql2->row()->total_penyesuaian:0; 
			
			
			//stok di tb cc_kirim stok sebelumya
			$sql = query("SELECT SUM(jml) AS total_terima FROM cc_kirim WHERE id_divisi='$id_divisi' AND tag = '$tag' AND DATE_FORMAT(tgl,'%Y-%m') < ".quote($month_year).' AND stat <> 9 group by tag,id_divisi');
			// $rowa = $sql->row_array();
			$total_terima = ($sql->num_rows() > 0)?$sql->row()->total_terima:0; 
			$total_terima = $total_terima - $total_penyesuaian;
			
			//penggunaan
			
			$data = [
			'stok_awal_gudang'         =>$stok_awal_gudang + $total_sebelumnya - $total_kirim , //stok awal
			'stok_terima_gudang'       =>$cc_terima, //terima dari korlantas perbulan
			'stok_distribusi_gudang'   =>$cc_kirim, //distribusi dari gudang perbulan
			'stok_awal_divisi'         =>$stok_awal_divisi + $total_terima, //stok awal
			'penerimaan_divisi'        =>$cc_kirim_divisi,
			'stok_terima'              =>0,
			'stok_kirim'               =>0
			];
			
			return $data;
			
		}
	}
	
	if ( ! function_exists('stok_awal_divisi_tckb'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function stok_awal_divisi_tckb($id_master,$id_divisi,$bulan,$tahun='')
		{
			$ci = & get_instance();
			if(empty($bulan)){
				$bulan = date("m");
				}else{
				$bulan = $bulan;
			}
			
			if(empty($tahun)){
				$tahun = date("Y");
				}else{
				$tahun = $tahun;
			}
			$month_year = $tahun.'-'.$bulan;
			//stok awal gudang di tb cc_stok cc_terima
			$where_stok_awal_gudang = array('tb'=>'cc_terima','id_master' => $id_master);
			$group_gudang = array('id_master');
			// print_r($array);
			
			$ci->db->select_sum('jml');
			$ci->db->from('cc_stok');
			$ci->db->where('YEAR(cc_stok.tgl) <=',$tahun);
			$ci->db->where($where_stok_awal_gudang);
			$ci->db->group_by($group_gudang);
			$query = $ci->db->get(); 
			$stok_awal_gudang = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok end
			// dump($stok_awal_gudang,'print_r','exit');
			//stok awal satker tb cc_stok cc_kirim
			$array_cc_stok = array('tb'=>'cc_kirim','id_master' => $id_master, 'id_divisi' => $id_divisi);
			$group_by1 = array('id_master','id_divisi');
			// print_r($array);
			
			
			$ci->db->select_sum('jml');
			$ci->db->from('cc_stok');
			$ci->db->where('YEAR(cc_stok.tgl) <=',$tahun);
			$ci->db->where($array_cc_stok);
			$ci->db->group_by($group_by1);
			$query = $ci->db->get(); 
			$stok_awal_divisi = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok end
			
			//total terima bulan sebelumya
			$sql_terima = query("SELECT SUM(jml) AS total_sebelumnya FROM cc_terima WHERE id_master = '$id_master' AND DATE_FORMAT(tgl,'%Y-%m') < ".quote($month_year).' AND stat <> 9 group by id_master');
			
			$total_sebelumnya = ($sql_terima->num_rows() > 0)?$sql_terima->row()->total_sebelumnya:0; 
			//total pengiriman bulan sebelumnya
			$sqlk = query("SELECT SUM(jml) AS total_kirim FROM cc_kirim WHERE id_master = '$id_master' AND DATE_FORMAT(tgl,'%Y-%m') < ".quote($month_year).' AND stat <> 9 group by id_master');
			
			$total_kirim = ($sqlk->num_rows() > 0)?$sqlk->row()->total_kirim:0; 
			
			$where = ['id_master'=>$id_master];
			$ci->db->select_sum('jml');
			$ci->db->from('cc_terima');
			$ci->db->where($where);
			$ci->db->where('MONTH(cc_terima.tgl)',$bulan);
			$ci->db->where('YEAR(cc_terima.tgl)',$tahun);
			$ci->db->group_by('id_master');
			$query = $ci->db->get(); 
			$cc_terima = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok cc_kirim end 
			
			
			//stok di tb cc_kirim untuk gudang
			
			$ci->db->select_sum('jml');
			$ci->db->from('cc_kirim');
			$ci->db->where($where);
			$ci->db->where('MONTH(cc_kirim.tgl)',$bulan);
			$ci->db->where('YEAR(cc_kirim.tgl)',$tahun);
			$ci->db->group_by('id_master');
			$query = $ci->db->get(); 
			$cc_kirim = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok cc_kirim end 
			
			
			//stok di tb cc_kirim
			$where_divisi = ['id_master'=>$id_master,'id_divisi'=>$id_divisi];
			$ci->db->select_sum('jml');
			$ci->db->from('cc_kirim');
			$ci->db->where($where_divisi);
			$ci->db->where('MONTH(cc_kirim.tgl)',$bulan);
			$ci->db->where('YEAR(cc_kirim.tgl)',$tahun);
			$ci->db->group_by($group_by1);
			$query = $ci->db->get(); 
			$cc_kirim_divisi = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok cc_kirim end 
			
			//penggunaan sebelumnya
			$sql2 = query("SELECT SUM(jml) AS total_penyesuaian FROM cc_terjual WHERE id_divisi='$id_divisi' AND id_master = '$id_master' AND DATE_FORMAT(tgl,'%Y-%m') < ".quote($month_year)." group by id_master,id_divisi");
			// $row2 = $sql2->row_array();
			// $total_penyesuaian = $row2['total_penyesuaian'];
			$total_penyesuaian = ($sql2->num_rows() > 0)?$sql2->row()->total_penyesuaian:0; 
			
			
			//stok di tb cc_kirim stok sebelumya
			$sql = query("SELECT SUM(jml) AS total_terima FROM cc_kirim WHERE id_divisi='$id_divisi' AND id_master = '$id_master' AND DATE_FORMAT(tgl,'%Y-%m') < ".quote($month_year).' AND stat <> 9 group by id_master,id_divisi');
			
			$total_terima = ($sql->num_rows() > 0)?$sql->row()->total_terima:0; 
			$total_terima = $total_terima - $total_penyesuaian;
			
			//penggunaan
			
			$data = [
			'stok_awal_gudang'         =>$stok_awal_gudang + $total_sebelumnya - $total_kirim , //stok awal
			'stok_terima_gudang'       =>$cc_terima, //terima dari korlantas perbulan
			'stok_distribusi_gudang'   =>$cc_kirim, //distribusi dari gudang perbulan
			'stok_awal_divisi'         =>$stok_awal_divisi + $total_terima, //stok awal
			'penerimaan_divisi'        =>$cc_kirim_divisi,
			'stok_terima'              =>0,
			'stok_kirim'               =>0
			];
			
			return $data;
			
		}
	}
	
	if ( ! function_exists('stok_awal_divisi_tnkb'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function stok_awal_divisi_tnkb($id_master,$id_divisi,$bulan,$tahun='')
		{
			$ci = & get_instance();
			if(empty($bulan)){
				$bulan = date("m");
				}else{
				$bulan = $bulan;
			}
			
			if(empty($tahun)){
				$tahun = date("Y");
				}else{
				$tahun = $tahun;
			}
			$month_year = $tahun.'-'.$bulan;
			//stok awal gudang di tb cc_stok cc_terima
			$where_stok_awal_gudang = array('tb'=>'cc_terima','id_master' => $id_master);
			$group_gudang = array('id_master');
			// print_r($array);
			
			$ci->db->select_sum('jml');
			$ci->db->from('cc_stok');
			$ci->db->where('YEAR(cc_stok.tgl) <=',$tahun);
			$ci->db->where($where_stok_awal_gudang);
			$ci->db->group_by($group_gudang);
			$query = $ci->db->get(); 
			$stok_awal_gudang = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok end
			// dump($stok_awal_gudang,'print_r','exit');
			//stok awal satker tb cc_stok cc_kirim
			$array_cc_stok = array('tb'=>'cc_kirim','id_master' => $id_master, 'id_divisi' => $id_divisi);
			$group_by1 = array('id_master','id_divisi');
			// print_r($array);
			
			
			$ci->db->select_sum('jml');
			$ci->db->from('cc_stok');
			$ci->db->where('YEAR(cc_stok.tgl) <=',$tahun);
			$ci->db->where($array_cc_stok);
			$ci->db->group_by($group_by1);
			$query = $ci->db->get(); 
			$stok_awal_divisi = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok end
			
			//total terima bulan sebelumya
			$sql_terima = query("SELECT SUM(jml) AS total_sebelumnya FROM cc_terima WHERE id_master = '$id_master' AND DATE_FORMAT(tgl,'%Y-%m') < ".quote($month_year).' AND stat <> 9 group by id_master');
			
			$total_sebelumnya = ($sql_terima->num_rows() > 0)?$sql_terima->row()->total_sebelumnya:0; 
			//total pengiriman bulan sebelumnya
			$sqlk = query("SELECT SUM(jml) AS total_kirim FROM cc_kirim WHERE id_master = '$id_master' AND DATE_FORMAT(tgl,'%Y-%m') < ".quote($month_year).' AND stat <> 9 group by id_master');
			
			$total_kirim = ($sqlk->num_rows() > 0)?$sqlk->row()->total_kirim:0; 
			
			$where = ['id_master'=>$id_master];
			$ci->db->select_sum('jml');
			$ci->db->from('cc_terima');
			$ci->db->where($where);
			$ci->db->where('MONTH(cc_terima.tgl)',$bulan);
			$ci->db->where('YEAR(cc_terima.tgl)',$tahun);
			$ci->db->group_by('id_master');
			$query = $ci->db->get(); 
			$cc_terima = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok cc_kirim end 
			
			
			//stok di tb cc_kirim untuk gudang
			
			$ci->db->select_sum('jml');
			$ci->db->from('cc_kirim');
			$ci->db->where($where);
			$ci->db->where('MONTH(cc_kirim.tgl)',$bulan);
			$ci->db->where('YEAR(cc_kirim.tgl)',$tahun);
			$ci->db->group_by('id_master');
			$query = $ci->db->get(); 
			$cc_kirim = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok cc_kirim end 
			
			
			//stok di tb cc_kirim
			$where_divisi = ['id_master'=>$id_master,'id_divisi'=>$id_divisi];
			$ci->db->select_sum('jml');
			$ci->db->from('cc_kirim');
			$ci->db->where($where_divisi);
			$ci->db->where('MONTH(cc_kirim.tgl)',$bulan);
			$ci->db->where('YEAR(cc_kirim.tgl)',$tahun);
			$ci->db->group_by($group_by1);
			$query = $ci->db->get(); 
			$cc_kirim_divisi = ($query->num_rows() > 0)?$query->row()->jml:0; 
			//stok cc_kirim end 
			
			//penggunaan sebelumnya
			$sql2 = query("SELECT SUM(jml) AS total_penyesuaian FROM cc_terjual WHERE id_divisi='$id_divisi' AND id_master = '$id_master' AND DATE_FORMAT(tgl,'%Y-%m') < ".quote($month_year)." group by id_master,id_divisi");
			// $row2 = $sql2->row_array();
			// $total_penyesuaian = $row2['total_penyesuaian'];
			$total_penyesuaian = ($sql2->num_rows() > 0)?$sql2->row()->total_penyesuaian:0; 
			
			
			//stok di tb cc_kirim stok sebelumya
			$sql = query("SELECT SUM(jml) AS total_terima FROM cc_kirim WHERE id_divisi='$id_divisi' AND id_master = '$id_master' AND DATE_FORMAT(tgl,'%Y-%m') < ".quote($month_year).' AND stat <> 9 group by id_master,id_divisi');
			
			$total_terima = ($sql->num_rows() > 0)?$sql->row()->total_terima:0; 
			$total_terima = $total_terima - $total_penyesuaian;
			
			//penggunaan
			
			$data = [
			'stok_awal_gudang'         =>$stok_awal_gudang + $total_sebelumnya - $total_kirim , //stok awal
			'stok_terima_gudang'       =>$cc_terima, //terima dari korlantas perbulan
			'stok_distribusi_gudang'   =>$cc_kirim, //distribusi dari gudang perbulan
			'stok_awal_divisi'         =>$stok_awal_divisi + $total_terima, //stok awal
			'penerimaan_divisi'        =>$cc_kirim_divisi,
			'stok_terima'              =>0,
			'stok_kirim'               =>0
			];
			
			return $data;
			
		}
	}
	
	if ( ! function_exists('stok_masuk_divisi'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function stok_masuk_divisi($tag,$id_divisi,$bulan,$tahun)
		{
			$ci = & get_instance();
			$where = ['ket !='=>'Data sisa periode','tag'=>$tag,'id_divisi'=>$id_divisi];
			$ci->db->select_sum('jml');
			$ci->db->from('cc_kirim');
			$ci->db->where($where);
			$ci->db->where('MONTH(cc_kirim.tgl)',$bulan);
			$ci->db->where('YEAR(cc_kirim.tgl)',$tahun);
			$ci->db->group_by('tag','id_divisi');
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
			return $result; 
			
		}
	}
	
	if ( ! function_exists('stok_kirim'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function stok_kirim($tag)
		{
			$ci = & get_instance();
			$ci->db->select_sum('jml');
			$ci->db->from('cc_kirim');
			$ci->db->where('tag',$tag);
			$ci->db->group_by('tag');
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
			return $result; 
		}
	}
	if ( ! function_exists('stok_keluar_by_date'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function stok_keluar_by_date($tag,$dari,$sampai)
		{
			$ci = & get_instance();
			$ci->db->select_sum('jml');
			$ci->db->from('cc_terjual');
			$ci->db->where("tgl between '$dari' AND '$sampai'");
			$ci->db->where('tag',$tag);
			$ci->db->group_by('tag');
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
			return $result; 
		}
	}
	
	if ( ! function_exists('stok_keluar_by_date_satker'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return array
		*/
		function stok_keluar_by_date_satker($id_divisi,$tag,$dari,$sampai)
		{
			$ci = & get_instance();
			$ci->db->select_sum('jml');
			$ci->db->from('cc_terjual');
			$ci->db->where("tgl between '$dari' AND '$sampai'");
			$ci->db->where('tag',$tag);
			$ci->db->where('id_divisi',$id_divisi);
			$ci->db->group_by(['tag','id_divisi']);
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
			return $result; 
		}
	}
	if ( ! function_exists('stok_keluar_perdate'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function stok_keluar_perdate($tag,$id_divisi,$tgl)
		{
			$ci = & get_instance();
			$ci->db->select_sum('jml');
			$ci->db->from('cc_terjual');
			$ci->db->where('id_divisi',$id_divisi);
			$ci->db->like('tag',$tag);
			$ci->db->where('tgl',$tgl);
			$ci->db->group_by('id_form');
			$ci->db->order_by('tgl');
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
			return $result; 
		}
	}
	if ( ! function_exists('stok_keluar'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function stok_keluar($tag)
		{
			$ci = & get_instance();
			$ci->db->select_sum('jml');
			$ci->db->from('cc_terjual');
			$ci->db->where('tag',$tag);
			$ci->db->group_by('tag');
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
			return $result; 
		}
	}
	if ( ! function_exists('stok_keluar_by_id_divisi'))
	{
		/**
			* Code stok_keluar_by_id_divisi by range tanggal
			*
			@param $val string
			@return string
		*/
		function stok_keluar_by_id_divisi($id,$dari,$sampai,$tag='')
		{
			if(!empty($tag)){
				$array = array('tag' => $tag, 'id_divisi' => $id);
				$group_by = 'tag';
				}else{
				$array = array('id_divisi' => $id);
				$group_by = 'id_divisi';
			}
			$ci = & get_instance();
			$ci->db->select_sum('jml');
			$ci->db->from('cc_terjual');
			$ci->db->where("tgl between '$dari' AND '$sampai'");
			$ci->db->where($array);
			$ci->db->group_by($group_by);
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
			return $result; 
		}
	}
	
	if ( ! function_exists('stok_keluar_by_month'))
	{
		/**
			* Code stok_keluar_by_id_divisi by bulan tahun
			*
			@param $val string
			@return string
		*/
		function stok_keluar_by_month($id='',$tag='',$bulan='',$tahun='')
		{
			// dump($id,'print_r','exit');
			if(empty($bulan)){
				$bulan = date("m");
				}else{
				$bulan = $bulan;
			}
			
			if(empty($tahun)){
				$tahun = date("Y");
				}else{
				$tahun = $tahun;
			}
			if(!empty($tag)){
				$array = array('tag' => $tag, 'id_divisi' => $id);
				$group_by = array('tag','id_divisi');
				}else{
				$array = array('id_divisi' => $id);
				$group_by = 'id_divisi';
			}
			// print_r($array);
			$ci = & get_instance();
			$ci->db->select_sum('jml');
			$ci->db->from('cc_terjual');
			$ci->db->where('MONTH(cc_terjual.tgl)',$bulan);
			$ci->db->where('YEAR(cc_terjual.tgl)',$tahun);
			$ci->db->where($array);
			$ci->db->group_by($group_by);
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
			return $result; 
		}
	}
	if ( ! function_exists('stok_keluar_divisi_by_month'))
	{
		/**
			* Code stok_keluar_by_id_divisi by bulan tahun
			*
			@param $val string
			@return string
		*/
		function stok_keluar_divisi_by_month($id,$tag,$dari,$sampai)
		{
			
			if(empty($dari)){
				$dari = date("Y-m-d");
			}
			
			if(empty($sampai)){
				$sampai = date("Y-m-d");
			}
			if(!empty($tag)){
				$array = array('tag' => $tag, 'id_divisi' => $id);
				$group_by = array('tag','id_divisi');
				}else{
				$array = array('id_divisi' => $id);
				$group_by = 'id_divisi';
				
			}
			
			$ci = & get_instance();
			
			$ci->db->select_sum('jml');
			$ci->db->from('cc_terjual');
			$ci->db->where("tgl between '$dari' AND '$sampai'");
			// $ci->db->where('MONTH(cc_terjual.tgl)',$bulan);
			// $ci->db->where('YEAR(cc_terjual.tgl)',$tahun);
			$ci->db->where($array);
			$ci->db->group_by($group_by);
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
		    $_array = array('tag' => $tag, 'id_divisi' => $id,'jml'=>$result);
			
			return $_array; 
		}
	}
	if ( ! function_exists('stok_keluar_by_id_form'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function stok_keluar_by_id_form($id,$dari,$sampai,$tag='')
		{
			if(!empty($tag)){
				$array = array('tag' => $tag, 'id_divisi' => $id);
				$group_by = 'tag';
				}else{
				$array = array('id_divisi' => $id);
				$group_by = 'id_divisi';
			}
			$ci = & get_instance();
			$ci->db->select_sum('jml');
			$ci->db->from('cc_terjual');
			$ci->db->where("tgl between '$dari' AND '$sampai'");
			$ci->db->where($array);
			$ci->db->group_by($group_by);
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
			return $result; 
		}
	}	
	
	if ( ! function_exists('penggunaan_by_id_form'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function penggunaan_by_id_form($tb,$id_divisi,$bulan,$tahun,$idform,$tag)
		{
			
			$array = array('id_form'=>$idform,'tag' => $tag, 'id_divisi' => $id_divisi);
			$group_by = ['tag','id_divisi','id_form'];
			
			$ci = & get_instance();
			$ci->db->select_sum('jml');
			$ci->db->from('cc_terjual');
			$ci->db->where('MONTH(cc_terjual.tgl)',$bulan);
			$ci->db->where('YEAR(cc_terjual.tgl)',$tahun);
			$ci->db->where($array);
			$ci->db->group_by($group_by);
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
			return $result; 
		}
	}	
	
	if ( ! function_exists('sum_penggunaan_by_id_divisi'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function sum_penggunaan_by_id_divisi($tb,$tag,$id_divisi,$bulan,$tahun)
		{
			
			$array = array('tb'=>$tb,'tag' => $tag, 'id_divisi' => $id_divisi);
			$group_by = ['tag','id_divisi'];
			
			$ci = & get_instance();
			$ci->db->select_sum('jml');
			$ci->db->from('cc_penggunaan');
			$ci->db->where('MONTH(cc_penggunaan.tgl)',$bulan);
			$ci->db->where('YEAR(cc_penggunaan.tgl)',$tahun);
			$ci->db->where($array);
			$ci->db->group_by($group_by);
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
			return $result; 
		}
	}	
	
	if ( ! function_exists('sum_penggunaan'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function sum_penggunaan($tb,$dari,$sampai,$idform='',$id)
		{
			// echo $sampai;
			// echo "<br>";
			$ci = & get_instance();
			$or_where = '';
			$month_year = $sampai.'-'.$dari;
			
			$where = $ci->db->where("tgl between '$dari' AND '$sampai'");
			// $where = $ci->db->where("DATE_FORMAT(tgl,'%Y-%m') <= ".quote($month_year));
			$from = $ci->db->from('cc_terjual');
			
			if(!empty($idform)){
				$array = array('id_form' => $idform, 'id_divisi' => $id);
				$group_by = 'id_form';
				}else{
				$array = array('id_divisi' => $id);
				$group_by = 'id_divisi';
			}
			
			$ci->db->select_sum('jml');
			$from;
			$where;
			$ci->db->where($array);
			$ci->db->group_by($group_by);
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jml:0; 
			return $result; 
		}
	}
	
	if ( ! function_exists('pengaturan'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function pengaturan($val)
		{
			$ci = & get_instance();
			$title = $ci->db->query("SELECT * FROM shared_folder where nama='$val'")->row_array();
			return $title['isi'];
		}
	}
	
	if ( ! function_exists('select_box'))
	{
		/**
			* Code select_box
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@param params array
			@return string
		*/
		function select_box($data, $parent = 0, $parent_id = 0, $Nilai='',$params = array())
		{
			$ci = & get_instance();
			
			if (isset($data[$parent]))
			{
				$id = $params['id'];
				$title = $params['title'];
				$html = "";
				
				if ($ci->session->level=='admin'){
					$html .= '<option value="0">Semua</option>';
				}
				foreach ($data[$parent] as $v)
				{
					$_arrNilai = explode(',', $Nilai);
					$_ck = (array_search($v->$id, $_arrNilai) === false)? '' : 'selected';
					$html .= '<option value="'.$v->$id.'" '.$_ck.'>&nbsp;'.$v->$title.'</option>';
				}
				return $html;
			}
		}
	}
	
	if ( ! function_exists('select_kbox'))
	{
		/**
			* Code select_kbox
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function select_kbox($data, $parent = 0, $parent_id = 0, $Nilai='')
		{
			$ci = & get_instance();
			if (isset($data[$parent]))
			{
				
				$html = "";
				foreach ($data[$parent] as $v)
				{
					$child = select_kbox($data, $v->id, $parent_id, $Nilai);
					$_arrNilai = explode(',', $Nilai);
					if ($ci->session->level=='admin'){
						$_ck = (array_search($v->id, $_arrNilai) === false)? '' : 'selected';
						$html .= '<option value="'.$v->id.'" '.$_ck.'>&nbsp;'.$v->title.'</option>';
						}else{
						if (in_array($v->id, $_arrNilai)){
							$_ck = (array_search($v->id, $_arrNilai) === false)? '' : 'selected';
							$html .= '<option value="'.$v->id.'" '.$_ck.'>&nbsp;'.$v->title.'</option>';
						}
					}
				}
				return $html;
			}
		}
	}
	
	if ( ! function_exists('select_badge'))
	{
		/**
			* Code select_badge
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function select_badge($data, $parent = 0, $parent_id = 0, $Nilai='')
		{
			$ci = & get_instance();
			if (isset($data[$parent]))
			{
				
				$html = "";
				foreach ($data[$parent] as $v)
				{
					$child = select_badge($data, $v->id, $parent_id, $Nilai);
					$_arrNilai = explode(',', $Nilai);
					if ($ci->session->level=='admin' AND $parent_id==0){
						$_ck = (array_search($v->id, $_arrNilai) === false)? '' : 'selected';
						$html .= '<option value="'.$v->id.'" '.$_ck.'>&nbsp;'.$v->title.'</option>';
						}else{
						if (in_array($v->id, $_arrNilai)){
							$html .= '<button type="button" class="btn btn-secondary btn-sm flat mb-1" readonly>'.$v->title.'</button>&nbsp;';
							$html .= '<input type="hidden" name="akses[]" value="'.$v->id.'">';
							
						}
					}
				}
				return $html;
			}
		}
	}
	if ( ! function_exists('checkbox_menu'))
	{
		/**
			* Code checkbox_menu
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function checkbox_menu($data, $parent = 0, $parent_id = 0, $Nilai = '')
		{
			static $i = 1;
			$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
			$tab = $i * 0;
			if (isset($data[$parent])) {
				$i++;
				$html = "";
				$a = 0;
				foreach ($data[$parent] as $v) {
					$child = checkbox_menu($data, $v['id_level'], $parent_id, $Nilai);
					
					$_arrNilai = explode(',', $Nilai);
					$_ck = (array_search($v['id_level'], $_arrNilai) === false) ? '' : TRUE;
					$array = array(
					'name'          => 'idlevel[]',
					'id'            => 'idlevel'.$v['id_level'],
					'value'         => $v['id_level'],
					'checked'       => $_ck,
					'class'         => 'custom-control-input checkbox get_value'
					);
					$attributes = array(
					'class' => 'custom-control-label',
					'style' => ''
					);
					$html .= '<div class="custom-control custom-checkbox">';
					$html .= $ieTab. form_checkbox($array);
					$html .= form_label($v['nama'], 'idlevel'.$v['id_level'], $attributes);;
					$html .= "</div>";
					if ($child) {
						$i--;
						$html .= $child;
					}
					$a++;
				}
				return $html;
			}
		}
	}
	
	
	if ( ! function_exists('checkcard'))
	{
		/**
			* Code checkcard
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function checkcard($data, $parent = 0, $parent_id = 0, $Nilai='')
		{
			static $i = 1;
			$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
			$tab = $i * 0 ;
			if (isset($data[$parent]))
			{
				$i++;
				$html ="";
				foreach ($data[$parent] as $v)
				{
					$child = checkcard($data, $v['idmenu'], $parent_id, $Nilai);
					
					$_arrNilai = explode(',', $Nilai);
					$_ck = (array_search($v['idmenu'], $_arrNilai) === false)? '' : TRUE;
					$array = array(
					'name'          => 'data[]',
					'id'            => 'data',
					'value'         => $v['idmenu'],
					'checked'       => $_ck,
					'style'         => ''
					);
					
					$html .= '<div class="checkbox">';
					$html .= $ieTab. form_checkbox($array).$v['nama_menu'];
					
					$html .= "</div>";
					if ($child) { $i--; $html .= $child; }
				}
				return $html;
			}
		}
	}
	if ( ! function_exists('checkbox'))
	{
		/**
			* Code checkbox
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function checkbox($data, $parent = 0, $parent_id = 0, $Nilai='',$_parent=0) {
			static $i = 1;
			$ieTab = str_repeat("- ", $i * 1);
			$tab = $i * 0 ;
			if (isset($data[$parent]))
			{
				$i++;
				$html ='';
				foreach ($data[$parent] as $v) {
					$child = checkbox($data, $v['idmenu'], $parent_id, $Nilai,$_parent);
					//Edit Di Item
					
					$_arrNilai = explode(',', $Nilai);
					if($_parent==1)
					{
						$_ck = (array_search($v['idmenu'], $_arrNilai) === false)? 'disabled' : TRUE;
					}
					else
					{
						$_ck = (array_search($v['idmenu'], $_arrNilai) === false)? '' : TRUE;
					}
					$array = array(
					'name'          => 'data[]',
					'id'            => 'checkb'.$v['idmenu'],
					'value'         => $v['idmenu'],
					'checked'       => $_ck,
					'class'         => 'form-check-input check-input'
					);
					$attributes = array(
					'class' => '',
					'style' => ''
					);
					$html .= '<div class="form-check">';
					$html .= form_checkbox($array);
					$html .= $ieTab. form_label($v['nama_menu'], 'checkb'.$v['idmenu'], $attributes);
					$html .= "</div>";
					if ($child) { $i--; $html .= $child; }
				}
				return $html;
			}
		}
	}
	
	if ( ! function_exists('checkbox_divisi'))
	{
		/**
			* Code checkbox
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function checkbox_divisi($data, $parent = 0, $parent_id = 0, $Nilai='',$_parent=0) {
			static $i = 1;
			$ieTab = str_repeat("- ", $i * 1);
			$tab = $i * 0 ;
			if (isset($data[$parent]))
			{
				$i++;
				$html ='';
				foreach ($data[$parent] as $v) {
					// print_r($v);
					$child = checkbox_divisi($data, $v['id'], $parent_id, $Nilai,$_parent);
					
					//Edit Di Item
					$_arrNilai = explode(',', $Nilai);
					if($_parent==1)
					{
						$_ck = (array_search($v['id'], $_arrNilai) === false)? 'disabled' : TRUE;
						$readonly = '';
					}
					else
					{
						$_ck = (array_search($v['id'], $_arrNilai) === false)? '' : TRUE;
						$readonly = '';
					}
					
					$array = array(
					'name'          => 'iddivisi[]',
					'id'            => 'checkb'.$v['id'],
					'value'         => $v['id'],
					'checked'       => $_ck,
					'class'         => 'form-check-input',
					'readonly' 		=> $readonly
					);
					$attributes = array(
					'class' => '',
					'style' => ''
					);
					$html .= '<div class="form-check">';
					$html .= form_checkbox($array);
					$html .= $ieTab. form_label($v['nama_divisi'], 'checkb'.$v['id'], $attributes);
					$html .= "</div>";
					if ($child) { $i--; $html .= $child; }
				}
				return $html;
			}
		}
	}
	
	if ( ! function_exists('akses_divisi'))
	{
		/**
			* Code checkbox
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function akses_divisi($data, $parent = 0, $parent_id = 0, $Nilai='',$_parent=0) {
			static $i = 1;
			$ieTab = str_repeat("- ", $i * 1);
			$tab = $i * 0 ;
			if (isset($data[$parent]))
			{
				$i++;
				$html ='';
				$no =1;
				foreach ($data[$parent] as $v) {
					$child = akses_divisi($data, $v['id'], $parent_id, $Nilai,$_parent);
					//Edit Di Item
					
					$_arrNilai = explode(',', $Nilai);
					if($_parent==1)
					{
						$_ck = (array_search($v['id'], $_arrNilai) === false)? 'disabled' : TRUE;
					}
					else
					{
						$_ck = (array_search($v['id'], $_arrNilai) === false)? '' : TRUE;
					}
					
					$html .= '<tr>';
					$html .= '<td>'.$no++.'</td>';
					$html .= '<td>'.$v['nama_divisi'].'</td>';
					$html .= '<td class="text-end">
					
					<a href="'.base_url().'mutasi/stok_satker/detail/'.encrypt_url($v['id']).'" class="btn btn-primary btn-sm active" aria-current="page"><i class="ti ti-list-details"></i> Detail</a>
					</td>';
					$html .= "</tr>";
					if ($child) { $i--; $html .= $child; }
				}
				return $html;
			}
		}
	}
	
	if ( ! function_exists('web_analytics'))
	{
		function web_analytics() 
		{
			$ci = & get_instance();
			$ci->load->library('user_agent');
			$id_user = $ci->session->iduser;
			$myip 		   = "https://ipinfo.io/".getIpAddress()."?token=29aeaf464d83ec";
			$ipinfo        = json_decode(@file_get_contents($myip));
			$ipvi          = (!empty($ipinfo->ip) ? $ipinfo->ip : $ci->input->ip_address());
			$country       = (!empty($ipinfo->country) ? $ipinfo->country : "Others");
			$city          = (!empty($ipinfo->city) ? $ipinfo->city : "Others");
			$os_stat       = $ci->input->user_agent();
			$platform_stat = $ci->agent->platform();
			$browser_stat  = $ci->agent->browser();
			$datestat      = date("Y-m-d");
			$timestat      = time();
			$url           = $_SERVER['REQUEST_URI'];
			
			$totalvi = $ci->db
			->where('ip', $ipvi)
			->where('date', $datestat)
			->where('url', $url)
			->where('id_user', $id_user)
			->get('t_visitor')
			->num_rows();
			
			if ( $totalvi < 1 ) 
			{
				$ci->db->insert('t_visitor', array(
				'id_user'  => $id_user,
				'ip'       => $ipvi,
				'platform' => $platform_stat,
				'os'       => $os_stat,
				'browser'  => $browser_stat,
				'country'  => $country,
				'city'     => $city,
				'date'     => $datestat,
				'hits'     => 1,
				'url'      => $url 
				));
			}
			else 
			{
				$statpro = $ci->db
				->where('ip', $ipvi)
				->where('date', $datestat)
				->where('url', $url)
				->get('t_visitor')
				->row_array();
				
				$hitspro = $statpro['hits'] + 1;
				
				$data_update = array(
				'platform' => $platform_stat,
				'os'       => $os_stat,
				'browser'  => $browser_stat,
				'country'  => $country,
				'city'     => $city,
				'hits'     => $hitspro,
				'online'   => $timestat,
				'url'      => $url
				);
				
				$ci->db->where('ip', $ipvi)
				->where('date', $datestat)
				->where('url', $url)
				->update('t_visitor', $data_update);
			}
		}
	}
	function getIpAddress()
	{
		$ipAddress = '';
		if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
			// to get shared ISP IP address
			$ipAddress = $_SERVER['HTTP_CLIENT_IP'];
			} else if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			// check for IPs passing through proxy servers
			// check if multiple IP addresses are set and take the first one
			$ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			foreach ($ipAddressList as $ip) {
				if (! empty($ip)) {
					// if you prefer, you can check for valid IP address here
					$ipAddress = $ip;
					break;
				}
			}
			} else if (! empty($_SERVER['HTTP_X_FORWARDED'])) {
			$ipAddress = $_SERVER['HTTP_X_FORWARDED'];
			} else if (! empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
			$ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
			} else if (! empty($_SERVER['HTTP_FORWARDED_FOR'])) {
			$ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
			} else if (! empty($_SERVER['HTTP_FORWARDED'])) {
			$ipAddress = $_SERVER['HTTP_FORWARDED'];
			} else if (! empty($_SERVER['REMOTE_ADDR'])) {
			$ipAddress = $_SERVER['REMOTE_ADDR'];
		}
		return $ipAddress;
	}
	if ( ! function_exists('template'))
	{
		/**
			* Code template
			*
			@param int
			@return string
		*/
		function template(){
			$ci = & get_instance();
			
			$query = $ci->model_app->view_where('themes',['id'=>$key,'pub'=>0]);
			if ($query->num_rows()>=1){
				
				if ($this->session->level==''){
					redirect(base_url().'adm');
					exit;
				}
				
				return $query->row()->folder;
				}else{
				if ($this->session->level==''){
					redirect(base_url().'adm');
					exit;
				}
			}
			
		}
	}
	
	function info($val){
		$ci = & get_instance();
		$query = $ci->model_app->view_where('rb_setting',['name'=>$val]);
		$row = '';
		if ($query->num_rows()>0)
		{
			$row = $query->row()->value;
		}
		return $row;
	}
	
	
	if ( ! function_exists('logo'))
	{
		/**
			* Code logo
			*
			@return string
		*/
		function logo(){
			$ci = & get_instance();
			return $ci->model_app->pilih('logo','info')->row()->logo;
		}
	}
	
	if ( ! function_exists('favicon'))
	{
		/**
			* Code favicon
			*
			@return string
		*/
		function favicon(){
			$ci = & get_instance();
			return $ci->model_app->pilih('favicon','info')->row()->favicon;
		}
	}
	
	function autoNumbers($awalan,$digit)
	{
		//%06s
		$ci = & get_instance();
		$ci->db->select_max('id_member','max_id');
		$query = $ci->db->get('konsumen');
		if($query->num_rows()>0){
			$data=$query->row();
			$maxid = $data->max_id;
			$count_awalan = strlen($awalan);
			$potong_awalan = str_replace($awalan,"",$maxid);
			$count_potong_awalan = strlen($potong_awalan);
			$noUrut = (int) substr($maxid, $count_awalan, $count_potong_awalan);
			$noUrut++;
			$kode_baru = $awalan.sprintf($digit, $noUrut);
			}else{
			$kode_baru = $awalan.sprintf($digit, 1);
		}
		return $kode_baru;
	}
	function autoNumber($awalan,$digit,$id_table,$table)
	{
		//%06s
		$ci = & get_instance();
		$ci->db->select_max($id_table,'max_id');
		$query = $ci->db->get($table);
		if($query->num_rows()>0){
			$data=$query->row();
			$maxid = $data->max_id;
			$count_awalan = strlen($awalan);
			$potong_awalan = str_replace($awalan,"",$maxid);
			$count_potong_awalan = strlen($potong_awalan);
			$noUrut = (int) substr($maxid, $count_awalan, $count_potong_awalan);
			$noUrut++;
			$kode_baru = $awalan.sprintf($digit, $noUrut);
			}else{
			$kode_baru = $awalan.sprintf($digit, 1);
		}
		return $kode_baru;
	}
	
	function cek_info()
    {
        $ci = & get_instance();
        if ($ci->agent->is_browser())
        {
            $agent['browser'] = $ci->agent->browser().' '.$ci->agent->version();
		}
        elseif ($ci->agent->is_robot())
        {
            $agent['browser'] = $ci->agent->robot();
		}
        elseif ($ci->agent->is_mobile())
        {
            $agent['browser'] = $ci->agent->mobile();
		}
        else
        {
            $agent['browser'] = 'Unidentified User Agent';
		}
        $agent['ip'] = $ci->input->ip_address();
        $agent['os'] = $ci->agent->platform();
        
        return $agent;
	}				
	
	if ( ! function_exists('cek_demo_promo'))
	{
		
		/**
			* Code Cek demo 
			* 
			@return array
		*/
		function cek_demo_promo($var,$token="")
		{
			$ci = & get_instance();
			
			$device_status = cek_device_status($token);
			$data = array();
			
			if($var=='get'){
				if($query->row()->demo=='Y' AND $ci->session->level!='admin'){
					$data = ['status'=>false,'msg'=>'Akses ditolak','disabled'=>true,'readonly'=>true];
					}else{
					$data = ['status'=>true,'msg'=>'Akses diterima','disabled'=>false,'readonly'=>false];
				}
			}
			
			if($var=='connect'){
				if($query->row()->demo=='Y' AND $ci->session->level!='admin' AND $device_status==true){
					$data = ['status'=>false,'reason'=>'device already connect'];
				}
			}
			
			if($var=='disconnect'){
				if($query->row()->demo=='Y' AND $ci->session->level!='admin' AND $device_status==true){
					$msg = array('detail'=>'device disconnected','status'=> true);
					$data =array ('status'=> true,'detail'=>'Device Disconnected (Demo Only)','msg'=>(object)$msg);
					// $data = ['status'=>true,'detail'=>'device disconnected','msg'=>'Device Disconnected (Demo Only)'];
					}else{
					$msg = array('detail'=>'device disconnected','status'=> true);
					$data =array ('status'=> false,'detail'=>'Device Disconnected','msg'=>(object)$msg);
					// $data = ['status'=>false,'detail'=>'device disconnected'];
				}
				
			}
			
			if($query->row()->demo=='Y' AND $ci->session->level!='admin' AND $device_status==false){
				$data = ['status'=>true,'url'=>img_qrcode()];
			}
			
			if($query->row()->demo=='Y' AND $ci->session->level=='admin' AND $ci->session->idparent!=0 AND $device_status==true){
				$data = ['status'=>false];
			}
			if($query->row()->demo=='Y' AND $ci->session->level=='admin' AND $ci->session->idparent!=0 AND $device_status==false){
				$data = ['status'=>true];
			}
			
			
			return $data;
		}
	}	
	
	
	if ( ! function_exists('cek_device_status'))
	{
		/**
			* Code device 
			* 
			@param int 
			@return string
		*/
		function cek_device_status($token="")
		{
			$ci = & get_instance();
			
			$cek = $ci->model_app->pilih_where('device_status','rb_device',['token'=>$token]);
			if($cek->num_rows() > 0)
			{
				if($cek->row()->device_status=='connect')
				{
					return true; 
					}else{
					return false; 
				}
				}else{
				return false; 
			}
		}
	}
	
	if ( ! function_exists('get_device'))
	{
		/**
			* Code device 
			* 
			@param int 
			@return string
		*/
		function get_device()
		{
			$ci = & get_instance();
			$cek = $ci->model_app->pilih('device','rb_device');
			if($cek->num_rows() > 0)
			{
				return $cek->row()->device; 	
				}else{
				return false; 
			}
		}
	}		