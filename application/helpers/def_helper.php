<?php
	defined("BASEPATH") or exit();
	
	function last_date($month)
	{
		$d = date_create_from_format('Y-m',$month); 
		$last_day = date_format($d, 't');
		
		return $last_day; // 2022-01
	}
	
	function date_my($date)
	{
		list($bulan, $tahun) = explode('/', $date);
		return ['bulan' => $bulan, 'tahun' => $tahun];
	}	
	
	function getMonth($month)
	{
		$tgl = date('m', strtotime($month));
		return $tgl;
	}
	
	function getYear($year)
	{
		$tgl = date('Y', strtotime($year));
		return $tgl;
	}
	
	function tgl_pengiriman($tgl)
	{
		$tgl = date('d/m/Y', strtotime($tgl));
		return $tgl;
	}
	
	function tgl_dari_slash()
	{
		$tgl = date('d/m/Y', strtotime(date('Y-m-') . '01'));
		return $tgl;
	}
	
	function tgl_sampai_slash()
	{
		$tgl = date('d/m/Y', strtotime(date('Y-m-d')));
		return $tgl; //01/12/2020
	}
	
	function tgl_my()
	{
		$tgl = date('m/Y', strtotime(date('Y-m-d')));
		return $tgl; //01/12/2020
	}
	function periode($date){
        list( $awal, $akhir ) = explode(' - ', $date );
        return ['awal'=>date_dmy($awal),'akhir'=>date_dmy($akhir)];
	}
	function periode_detail($date){
        list( $awal, $akhir ) = explode('&', $date );
        return ['awal'=>date_ymd($awal),'akhir'=>date_ymd($akhir)];
	}
	
	function date_ymd($tglp)
	{
		$tgl_post = date('Y-m-d', strtotime($tglp));
		return $tgl_post;
	}
	
	function date_dmy($date)
	{
		$date = DateTime::createFromFormat('d/m/Y', $date);
		$date = $date->format('Y-m-d');
		return $date;
	}
	
	function today()
	{
		return date('Y-m-d H:i:s'); //2020-12-01
	}
	function tgl_dari()
	{
		$tgl = date('Y-m-d', strtotime(date('Y-m-') . '01'));
		return $tgl;
	}
	function tanggal()
	{
		return date('Y-m-d'); //2020-12-01
	}
	function month()
	{
		return date('m'); //2020-12-01
	}
	function year()
	{
		return date('Y'); //2020-12-01
	}
	function getBulan($bln)
	{
		switch ($bln) {
			case 1:
            return "Januari";
            break;
			case 2:
            return "Februari";
            break;
			case 3:
            return "Maret";
            break;
			case 4:
            return "April";
            break;
			case 5:
            return "Mei";
            break;
			case 6:
            return "Juni";
            break;
			case 7:
            return "Juli";
            break;
			case 8:
            return "Agustus";
            break;
			case 9:
            return "September";
            break;
			case 10:
            return "Oktober";
            break;
			case 11:
            return "November";
            break;
			case 12:
            return "Desember";
            break;
		}
	}
	function rprp($angka){
		$hasil = "Rp. " . number_format($angka,0,',','.');
		return $hasil;
	}
	function rp($angka){
        $konversi = number_format($angka, 0, ',', '.');
        return $konversi;
	}
	
	function nomor($angka){
		if($angka > 0){
			$konversi = number_format($angka, 0, ',', ',');
			}else{
			$konversi = '';
		}
        
        return $konversi;
	}
	
	function cek_nik($anak,$ayah,$ibu){
		if($anak===$ayah AND $anak===$ibu){
			$msg = ['status'=>true,'msg'=>'NIK Anak tidak boleh sama dengan ayah/ibu'];
			}elseif($anak===$ayah){
			$msg = ['status'=>true,'msg'=>'NIK Anak tidak boleh sama dengan ayah'];
			}elseif($anak===$ibu){
			$msg = ['status'=>true,'msg'=>'NIK Anak tidak boleh sama dengan ibu'];
			}elseif($ayah===$ibu){
			$msg = ['status'=>true,'msg'=>'NIK ayah tidak boleh sama dengan ibu'];
			}else{
			$msg = ['status'=>false,'msg'=>'ok'];
		}
        
        return $msg;
	}
	
	function sum_jml($angka){
		if($angka > 0){
			$konversi = number_format($angka, 0, ',', ',');
			}else{
			$konversi = '<center>-</center>';
		}
        
        return $konversi;
	}
	
	function number_to_alphabet($number) {
		$number = intval($number);
		if ($number <= 0) {
			return '';
		}
		$alphabet = '';
		while($number != 0) {
			$p = ($number - 1) % 26;
			$number = intval(($number - $p) / 26);
			$alphabet = chr(65 + $p) . $alphabet;
		}
		return $alphabet;
	}
	function tgl_kirim($tglp)
	{
		$tgl_post = date('Y-m-d', strtotime($tglp));
		return $tgl_post;
	}
	//kumpulan shortcode untuk mempermudah pemanggilan di backend dan frontend
	function getRomawi($bln){
		switch ($bln){
			case 1: 
			return "I";
			break;
			case 2:
			return "II";
			break;
			case 3:
			return "III";
			break;
			case 4:
			return "IV";
			break;
			case 5:
			return "V";
			break;
			case 6:
			return "VI";
			break;
			case 7:
			return "VII";
			break;
			case 8:
			return "VIII";
			break;
			case 9:
			return "IX";
			break;
			case 10:
			return "X";
			break;
			case 11:
			return "XI";
			break;
			case 12:
			return "XII";
			break;
		}
	}
	function kata($string, $limit, $break=" ", $pad="...") {
		// return with no change if string is shorter than $limit 
		if(strlen($string) <= $limit) 
		return $string; 
		$string = substr($string, 0, $limit); 
		if(false !== ($breakpoint = strrpos($string, $break))) { 
		$string = substr($string, 0, $breakpoint); } 
		return $string . $pad; 
	}
	function quoteLike($text){
		global $CI;
		return $CI->db->escape("%".$text."%");
	}
	
	function myFilter($var){
		return ($var !== NULL && $var !== FALSE && $var !== "");
	}
	function get_setting($param, $return="content"){
		$sql = query("SELECT * FROM cms_option WHERE param = ".quote($param));
		
		$row = $sql->row_array();
		if(strlen($row[$return]) == 0){
			return $row['def'];
		}
		else
		return $row[$return];
	}
	
	function is_same($a, $b, $out=""){
		if($a == $b)
		return $out;
	}
	function is_not_same($a, $b, $out=""){
		if($a <> $b)
		return $out;
	}
	
	function dump($arr){
		echo "<textarea style='width:100%; height:300px;'>";
		print_r($arr);
		echo "</textarea>";
		exit;
	}
	function dumps(){
		echo "<textarea style='width:100%; height:300px;'>";
		print_r($_POST);
		echo "</textarea>";
		exit;
	}
	function cleanTag($text){
		$text = preg_replace('/[^a-zA-Z0-9\s]/', ' ', strip_tags(html_entity_decode($text)));
		return $text;
	}    
	function register_header($script, $loc=""){
		global $register_header;
		$register_header .= $script."\n";
	}
	
	function register_footer($script, $loc=""){
		global $register_footer;
		$register_footer .= $script."\n";
	}
	
	function cms_register($loc){
		global $register_header;
		global $register_footer;
		
		if($loc=="header"){
			echo $register_header;
		}
		else if($loc == "footer"){
			echo $register_footer;
		}
	}
	
	function cut_text($txt, $length=20){
		$x = explode(" ",$txt);
		if(count($x) <= $length)
		return $txt;
		else{
			$imp = "";
			for($i=0; $i<$length; $i++){
				$imp .= $x[$i]." ";
			}
			return $imp;
		}
	}
	
	function post_session($post, $list=array()){
		foreach($list as $l){
			if(isset($post[$l])){
				$_SESSION['form-'.$l] = $post[$l];
			}
		}
	}
	
	
	
	function input($type, $name, $default="", $class="", $attr="", $list=array()){
		//pengaturan default value di input
		if(isset($_SESSION['form-'.$name])){
			$default = $_SESSION['form-'.$name];
			unset($_SESSION['form-'.$name]);
		}
		
		$ret = "";
		if($type=="select"){
			$ret .= "<select name='$name' id='form-$name' class='$class' $attr>";
			$ret .= "<option></option>";
			
			foreach($list as $key=>$val){
				$sel = "";
				if($key==$default){
					$sel = "selected";
				}
				$ret .= "<option $sel value='$key'>$val</option>";
			}
			
			$ret  .= "</select>";
		}
		
		else if($type=="radio"){
			$tk = 0;
			foreach($list as $key=>$val){
				$sel = "";
				if($key==$default){
					$sel = "checked";
				}
				$ret .= "<label for='form-$name-$tk'><input type='radio' name='$name' id='form-$name-$tk' value='$key' $sel> $val</label> ";
				$tk++;
			}
		}
		
		else if($type == "textarea"){
			$ret .= "<textarea name='$name' id='form-$name' class='$class' $attr>$default</textarea>";
		}
		else if($type == "file"){
			$ret .= "<input type='file' name='$name' class='$class' $attr value='$default'>";
		}
		else{
			$ret .= "<input type='$type' name='$name' class='$class' id='form-$name' $attr value='$default'>";
		}
		
		return $ret;
	}
	
	function paging($sql, $currentpage=1){
		$run = query($sql);
		$num = $run->num_rows();
		
		$limit = get_setting("backend_paging");
		$offset = ($currentpage - 1) * $limit;
		
		$totalpage = ceil($num/$limit);
		
		$addQuery = "LIMIT $offset,$limit";
		
		return array(
		"totalpage" => $totalpage,
		"query" => $sql." ".$addQuery
		);
		
	}
	
	function date_short($tgl){
        $tanggal 	= strtotime($tgl);
        $hari_arr 	= Array (	'0'=>'Minggu',
        '1'=>'Senin',
        '2'=>'Selasa',
        '3'=>'Rabu',
        '4'=>'Kamis',
        '5'=>'Jum`at',
        '6'=>'Sabtu'
        );
		$hari 	= @$hari_arr[date('w',$tanggal)];
		$tggl 	= date('j',$tanggal);
		$bln 	= date('m',$tanggal);
		$thn 	= date('y',$tanggal);
		return "$hari, $tggl/$bln/$thn";	
        
	}
	
	function get_month($n=null){
		
		$month = array(
		"", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
		);
		if($n === null){
			return $month;
		}
		else
		return $month[$n];
	}
	
	function indo_date($tgl, $type="half"){
		$month = array(
		"", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
		);
		
		$tahun = date("Y",strtotime($tgl));
		$bulan = $month[date("n",strtotime($tgl))];
		$tanggal = date("d",strtotime($tgl));
		
		$fullDate = "$tanggal $bulan $tahun";
		
		if($type <> "half"){
			$jam = date("H:i:s", strtotime($tgl));
			return $fullDate." ".$jam;
		}
		return $fullDate;
	}
	function dtime($tgl)
	{
		$tanggal     = strtotime($tgl);
		$hari_arr     = array(
		'0' => 'Minggu',
		'1' => 'Senin',
		'2' => 'Selasa',
		'3' => 'Rabu',
		'4' => 'Kamis',
		'5' => 'Jum`at',
		'6' => 'Sabtu'
		);
		$hari     = @$hari_arr[date('w', $tanggal)];
		$tggl     = date('j', $tanggal);
		$bln     = date('m', $tanggal);
		$thn     = date('Y', $tanggal);
		return "$hari, $tggl/$bln/$thn";
	}
	function date_time($tgl)
	{
		$tanggal     = strtotime($tgl);
		$hari_arr     = array(
		'0' => 'Minggu',
		'1' => 'Senin',
		'2' => 'Selasa',
		'3' => 'Rabu',
		'4' => 'Kamis',
		'5' => 'Jum`at',
		'6' => 'Sabtu'
		);
		$hari     = @$hari_arr[date('w', $tanggal)];
		$tggl     = date('j', $tanggal);
		$bln     = date('m', $tanggal);
		$thn     = date('Y', $tanggal);
		return "$tggl/$bln/$thn";
	}
	function date_full($tgl,$Jam=true){
        $tanggal 	= strtotime($tgl);
        $hari_arr 	= Array (	'0'=>'Minggu',
        '1'=>'Senin',
        '2'=>'Selasa',
        '3'=>'Rabu',
        '4'=>'Kamis',
        '5'=>'Jum`at',
        '6'=>'Sabtu'
        );
		$hari 	= @$hari_arr[date('w',$tanggal)];
		$tggl 	= date('j',$tanggal);
		$bln 	= date('m',$tanggal);
		$thn 	= date('Y',$tanggal);
		$jam 	= $Jam ? date ('H:i',$tanggal) : '';
		return "$hari, $tggl/$bln/$thn $jam";	
	}
	
	function tanggal_indo($tanggal, $cetak_hari = false)
	{
		$hari = array ( 1 =>    'Senin',
		'Selasa',
		'Rabu',
		'Kamis',
		'Jumat',
		'Sabtu',
		'Minggu'
		);
		
		$bulan = array (1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
		);
		$split 	  = explode('-', $tanggal);
		$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
		
		if ($cetak_hari) {
			$num = date('N', strtotime($tanggal));
			return $hari[$num] . ', ' . $tgl_indo;
		}
		return $tgl_indo;
	}
	
	function check_image($dir,$default="upload/default.jpg"){
		if(is_file($dir)){
			$image = "<img src='$dir' height=50>";
		}
		else{
			$image = "<img src='$default' height=50>";
		}
		return $image;
	}
	
	function pagination($totalpage, $currentpage=1){
		$url = $_SERVER['REQUEST_URI'];
		$exp = explode("?",$url);
		
		
		echo "<ul class='pagination'>";
		for($i=1;$i<=$totalpage;$i++){
			$cl = "";
			if($i==$currentpage){
				$cl = "active";
			}
			echo "<li class='$cl'><a href='$exp[0]?page=$i'>$i</a></li>";
		}
		echo "</ul>";
	}
	
	function create_alert($type, $pesan, $header=null){
		//shortcode aja
		$_SESSION['adm-type'] = $type;
		$_SESSION['adm-message'] = $pesan;
		
		if($header !== null){
			redirect($header);
			exit();
		}
	}
	
	function rupiah($num,$angka_belakang_koma=0){
		$angka = number_format($num,$angka_belakang_koma,",",".");
		return "Rp ".$angka;
	}
	
	function jumlah_hari($bulan, $tahun){
		$def = array(
		1 => 31,
		2 => 0,
		3 => 31,
		4 => 30,
		5 => 31,
		6 => 30,
		7 => 31,
		8 => 31,
		9 => 30,
		10 => 31,
		11 => 30,
		12 => 31
		);
		$current = $def[intval($bulan)];
		if($current == 0){
			if($tahun % 4 == 0)
			$current = 29;
			else
			$current = 28;
		}
		
		return $current;
	}
	
	function better_time($int){
		if($int == 0)
		return null;
		
		if(($int / 3600) > 1){
			$jam = floor($int / 3600);
			$int -= ($jam * 3600);
		}
		
		if(($int / 60) > 1){
			$menit = floor($int / 60);
			$int -= ($menit * 60);
		}
		
		$detik = $int;
		
		$out = "";
		if(isset($jam))
		$out .= "$jam jam ";
		if(isset($menit))
		$out .= "$menit menit ";
		if($detik > 0)
		$out .= "$detik detik ";
		
		$ret = "<span class='label label-danger'>$out</span>";
		
		return $ret;
	}
	
	function selisih_tgl($tgl_a, $tgl_b){
		$a = date_create($tgl_a);
		$b = date_create($tgl_b);
		
		$selisih = date_diff($a, $b);
		$hari = $selisih->format("%a");
		
		if(($hari / 365) >= 1){
			$tahun = floor($hari / 365);
			$hari -= ($tahun * 365);
		}
		if(($hari / 30) >= 1){
			$bulan = floor($hari / 30);
			$hari -= ($bulan * 30);
		}
		
		$out = "";
		if(isset($tahun))
		$out .= "$tahun tahun ";
		if(isset($bulan))
		$out .= "$bulan bulan ";
		if($hari > 0)
		$out .= "$hari hari";
		
		return $out;
	}
	
	function usia_daftar($tgl_a, $tgl_b){
		$a = date_create($tgl_a);
		$b = date_create($tgl_b);
		
		$selisih = date_diff($a, $b);
		$hari = $selisih->format("%a");
		
		if(($hari / 365) >= 1){
			$tahun = floor($hari / 365);
			$hari -= ($tahun * 365);
		}
		if(($hari / 30) >= 1){
			$bulan = floor($hari / 30);
			$hari -= ($bulan * 30);
		}
		
		$out = "";
		if(isset($tahun))
		$out = $tahun;
		
		return $out;
	}
	
	function clean($text){
		$text = preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode($text)));
		return $text;
	}
	
	function array_to_number($rupiah)
	{
		$newJumlah = array_map(function($v){
			return intval(preg_replace('/,.*|[^0-9]/', '', $v));
		}, $rupiah);
		return $newJumlah;
	} 			
	
	function convert_to_number($rupiah)
	{
		return intval(preg_replace('/,.*|[^0-9]/', '', $rupiah));
	} 			
	
	if ( ! function_exists('seotitle'))
	{
		/**
			* - Fungsi untuk memfilter string manjadi string seo.
			*   Contoh : seotitle("foo bar bass")
			*   Hasil  : foo-bar-bass
			* 
			* @param 	string 	$str
			* @param 	string 	$sp
			* @return 	string 	
		*/
		function seotitle($str = '', $sp = '-')
		{
			$seotitle = '';
			
			if ( !empty($str) )
			{	
				$q_separator = preg_quote($sp, '#');
				
				$trans = array(
				'_' => $sp,
				'&.+?;' => '',
				'[^\w\d -]' => '',
				'\s+' => $sp,
				'('.$q_separator.')+' => $sp
				);
				
				$str = strip_tags($str);
				
				foreach ($trans as $key => $val)
				{
					$str = preg_replace('#'.$key.'#i'.(UTF8_ENABLED ? 'u' : ''), $val, $str);
				}
				
				$str = strtolower($str);
				$seotitle = trim(trim($str, $sp));
			}
			
			return $seotitle;
		}
	}
	function cleans($s) {
		$c = array (' ');
		$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','"');
		
		$s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
		
		$s = strtolower(str_replace($c, '_', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
		return $s;
	}
	
	function random($panjang_karakter)  
    {
        $karakter = '98765432101234567890';  
        $string = '';  
        for($i = 0; $i < $panjang_karakter; $i++) {  
            $pos = rand(0, strlen($karakter)-1);  
            $string .= $karakter[$pos];
		}  
        return $string;  
	} 
	
	function get_kelas($str=0)
	{
		if($str==7)
		{
			$_str = 1;
			}elseif($str==8){
			$_str = 2;
			}elseif($str==9){
			$_str = 3;
			}elseif($str==10){
			$_str = 1;
			}elseif($str==11){
			$_str = 2;
			}elseif($str==12){
			$_str = 3;
			}else{
			$_str = 1;
		}
		return $_str;
	}
	
	function copyYear($copyYear='')
	{
		if($copyYear==''){
			$copyYear = 2015; 
		}
		$curYear = date('Y'); 
		return 'copyright &#169;&#160;' . $copyYear . (($copyYear != $curYear) ? ' - ' . $curYear : ''); 
	}
	
	
	function ucapan()
	{
		$waktu=gmdate("H:i",time()+7*3600);
		$t=explode(":",$waktu);
		$jam=$t[0];
		$menit=$t[1];
		
		if ($jam >= 00 and $jam < 10 ){
			if ($menit >00 and $menit<60){
				$ucapan="Selamat Pagi";
			}
			}else if ($jam >= 10 and $jam < 15 ){
			if ($menit >00 and $menit<60){
				$ucapan="Selamat Siang";
			}
			}else if ($jam >= 15 and $jam < 18 ){
			if ($menit >00 and $menit<60){
				$ucapan="Selamat Sore";
			}
			}else if ($jam >= 18 and $jam <= 24 ){
			if ($menit >00 and $menit<60){
				$ucapan="Selamat Malam";
			}
			}else {
			$ucapan="Error";
			
		}
		
		return $ucapan;
	}				
	
	function hp62($nohp) {
		// kadang ada penulisan no hp 0811 239 345
		$nohp = str_replace(" ","",$nohp);
		// kadang ada penulisan no hp (0274) 778787
		$nohp = str_replace("(","",$nohp);
		// kadang ada penulisan no hp (0274) 778787
		$nohp = str_replace(")","",$nohp);
		// kadang ada penulisan no hp 0811.239.345
		$nohp = str_replace(".","",$nohp);
		// kadang ada penulisan no hp 0811-239-345
		$nohp = str_replace("-","",$nohp);
		$nohp = str_replace("+","",$nohp);
		
		// cek apakah no hp mengandung karakter + dan 0-9
		$hp = '';
		if(!preg_match('/[^+0-9]/',trim($nohp))){
			// cek apakah no hp karakter 1-3 adalah +62
			if(substr(trim($nohp), 0, 3)=='+62'){
				// $hp = trim($nohp);
				$hp = substr_replace($nohp,'62',0,3);
			}
			// cek apakah no hp karakter 1 adalah 0
			elseif(substr(trim($nohp), 0, 2)=='62'){
				$hp = substr_replace($nohp,'62',0,2);
			}
			elseif(substr(trim($nohp), 0, 1)=='0'){
				$hp = '62'.substr(trim($nohp), 1);
			}
		}
		return $hp;
	}	