<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" type="image/x-icon" href="<?= base_url('upload/'); ?><?=info()['favicon'];?>">
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Munajat Ibnu">
		<!-- Favicon icon -->
        
		<!-- Bootstrap Core CSS -->
		<link href="<?=base_url();?>assets/print_style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="<?=base_url();?>assets/print_style/css/style.css" rel="stylesheet">
		<!-- You can change the theme colors from here -->
		<link href="<?=base_url();?>assets/print_style/css/colors/blue.css" id="theme" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<style>
			html {
			background: #eef5f9;
			}
			body{
			background: #eef5f9;
			font-family:Arial Narrow;
			font-size:10pt;
			}
			#main-wrapper {
			width: 330mm;
			height: 210mm;
			margin:0 auto;
			
			}
			.table td  {
			padding: 2px 8px!important;
			font-size: 7pt !important;
			font-weight: bold;
			}
			
			.table td.ttd  {
			padding: 2px 8px!important;
			font-size: 9pt !important;
			font-weight: bold;
			}
			.table th, .table thead th {
			font-size: 7pt !important;
			font-weight: bold;
			}
			
			@media print
			{
			.table td  {
			padding: 3px 10px!important;
			}
			.table th, .table thead th {
			font-size: 9pt !important;
			font-weight: 100 !important;
			}
			#main-wrapper {
			width:100%;
			margin:0 auto;
			
			}
			.page-wrapper {
			width:100%;
			border:0;
			padding-bottom: 0px;
			padding-top: 0px;
			background: #fff;
			}
			
			.container-fluid {
			
			padding: 0;
			margin: 0 auto;
			}
			.card{
			border:0px
			padding:0;
			}
			.card-body{
			border:0px;
			padding:0;
			}
			#bypassme {
			background: #fff;
			}
			html {
			background: #fff;
			}
			body{
			width:100%;
			margin: auto;
			padding: 0;
			background: #fff;
			}
			
			hr {
			margin-top: 1px;
			margin-bottom: 1px;
			border: 0;
			border-top-color: currentcolor;
			border-top-style: none;
			border-top-width: 0px;
			border-top: 1px solid rgba(0,0,0,.1);
			}
			
			}
			hr {
			margin-top: 1px;
			margin-bottom: 6px;
			border: 0;
			border-top-color: currentcolor;
			border-top-style: none;
			border-top-width: 0px;
			border-top: 1px solid rgba(0,0,0,.1);
			}
			
		</style>
		<style type="text/css" media="print">
			@media print { 
			@page { 
			size: landscape;
			margin-top: 0cm; 
			margin-bottom: 0cm; 
			} 
			
			}
		</style>
		<script src="<?=base_url();?>assets/print_style/jquery/jquery.min.js"></script>
		
	</head>
	
	<body class="fix-header card-no-border logo-center">
		<div id="main-wrapper">
			<div class="page-wrapper pt-3 pb-3" id="renderPDF">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-body mb-2 printableArea" id="printableArea">
								<div class="row mt-2">
									<div class="col-md-6 col-sm-6 mb-0 pb-0">
										<div class="pull-left mr-5 ">
                                            <p class="text-center m-l-5 border-bottom border-dark text-body">KEPOLISIAN NEGARA REPUBLIK INDONESIA
                                                <br/>DAERAH BANTEN
											<br/>DIREKTORAT LALU LINTAS</p>
										</div>
									</div>
                                    <div class="col-md-6 col-sm-6 mb-0 pb-0">
										<div class="pull-right ml-5 pl-5 ml-4">
                                            
                                            <p class="m-l-5 text-body">
                                                <br/><span class="border border-dark p-1">L. MAT 01</span>
											<br/></p>
                                            
										</div>
									</div>
                                    <div class="col-md-12 mb-0 pt-2">
                                        <p class="m-l-5 text-body text-center font-weight-bold fs-6">
                                            LAPORAN SISA STOK PENERIMAAN DAN PENGGUNAAN MATERIEL <?=$materiel;?>
                                            <br>BULAN <?=$bulan;?>
										</p>
									</div>
									<?php
										//stok_awal
										$jml_3g = stok_awal_divisi_tnkb($idform['hitam'],0,$dari,$sampai)['stok_awal_gudang'];;
										$jml_4g = stok_awal_divisi_tnkb($idform['merah'],0,$dari,$sampai)['stok_awal_gudang'];;
										$jml_5g = stok_awal_divisi_tnkb($idform['kuning'],0,$dari,$sampai)['stok_awal_gudang'];;
										$jml_6g = stok_awal_divisi_tnkb($idform['putih'],0,$dari,$sampai)['stok_awal_gudang'];;
										$jml_7g = $jml_3g + $jml_4g + $jml_5g + $jml_6g;
										
										//penerimaan
										$jml_8g = stok_awal_divisi_tnkb($idform['hitam'],0,$dari,$sampai)['stok_terima_gudang'];;
										$jml_9g = stok_awal_divisi_tnkb($idform['merah'],0,$dari,$sampai)['stok_terima_gudang'];;
										$jml_10g = stok_awal_divisi_tnkb($idform['kuning'],0,$dari,$sampai)['stok_terima_gudang'];;
										$jml_11g = stok_awal_divisi_tnkb($idform['putih'],0,$dari,$sampai)['stok_terima_gudang'];;
										$jml_12g = $jml_8g + $jml_9g + $jml_10g + $jml_11g;
										
										//distribusi
										$jml_13g= stok_awal_divisi_tnkb($idform['hitam'],0,$dari,$sampai)['stok_distribusi_gudang'];;
										$jml_14g= stok_awal_divisi_tnkb($idform['merah'],0,$dari,$sampai)['stok_distribusi_gudang'];;
										$jml_15g = stok_awal_divisi_tnkb($idform['kuning'],0,$dari,$sampai)['stok_distribusi_gudang'];;
										$jml_16g = stok_awal_divisi_tnkb($idform['putih'],0,$dari,$sampai)['stok_distribusi_gudang'];;
										$jml_17g = $jml_13g + $jml_14g + $jml_15g + $jml_16g;
										
										
										$jml_18g=0;
										$jml_19g=0;
										$jml_20g=0;
										$jml_21g=0;
										$jml_22g=0;
										
										$jml_23g=0;
										$jml_24g=0;
										$jml_25g=0;
										$jml_26g=0;
										$jml_27g=0;
										//sisa stok
										$jml_28g = $jml_3g+$jml_8g-$jml_13g-$jml_18g;
										$jml_29g = $jml_4g+$jml_9g-$jml_14g-$jml_19g;
										$jml_30g = $jml_5g+$jml_10g-$jml_15g-$jml_20g;
										$jml_31g = $jml_6g+$jml_11g-$jml_16g-$jml_21g;
										$jml_32g = $jml_7g+$jml_12g-$jml_17g-$jml_22g;
										
									?>
									<div class="col-md-12 mt-0 pt-0">
										<table class="table border border-dark" style="font-size:8.6pt;margin-bottom: 5px;">
											<thead class="border border-dark">
												<tr class="border border-dark">
													<td class="text-center align-middle border border-dark" rowspan="3">NO</td>
													<td class="text-center align-middle border border-dark" rowspan="3" style="width:160px!important">KESATUAN</td>
													<td colspan="5" align="center" class="text-center align-middle border border-dark" style="padding:5px 0 5px!important">STOK AWAL</td>
													<td colspan="5" align="center" class="text-center align-middle border border-dark" style="padding:5px 0 5px!important">PENERIMAAN</td>
													<td colspan="5" align="center" class="text-center align-middle border border-dark" style="padding:5px 0 5px!important">PENDISTRIBUSIAN</td>
													<td colspan="5" align="center" class="text-center align-middle border border-dark" style="padding:5px 0 5px!important">PENGGUNAAN</td>
													<td colspan="5" class="text-center align-middle border border-dark">RUSAK</td>
													<td colspan="5" class="text-center align-middle border border-dark">SISA STOK SEKARANG</td>
												</tr>
												<tr>
													<td colspan="4" align="center" class="text-center align-middle border border-dark" ><?=$materiel;?></td>
													<td rowspan="2" align="center" class="text-center align-middle border border-dark" >JUMLAH</td>
													<td colspan="4" align="center" class="text-center align-middle border border-dark" ><?=$materiel;?></td>
													<td rowspan="2" align="center" class="text-center align-middle border border-dark" >JUMLAH</td>
													<td colspan="4" align="center" class="text-center align-middle border border-dark" style="width:74px"><?=$materiel;?></td>
													<td rowspan="2" align="center" class="text-center align-middle border border-dark">JUMLAH</td>
													<td colspan="4" align="center" class="text-center align-middle border border-dark" style="width:74px"><?=$materiel;?></td>
													<td rowspan="2" align="center" class="text-center align-middle border border-dark">JUMLAH</td>
													<td colspan="4" align="center" class="text-center align-middle border border-dark" ><?=$materiel;?></td>
													<td rowspan="2" align="center" class="text-center align-middle border border-dark">JUMLAH</td>
													<td colspan="4" align="center" class="text-center align-middle border border-dark"><?=$materiel;?></td>
													<td rowspan="2" class="text-center align-middle border border-dark">JUMLAH</td>
												</tr>
												<tr>
													<td align="center" bgcolor="#000000" style="color:#fff" class="text-center align-middle border border-dark">H</td>
													<td align="center" bgcolor="#FF0000" class="text-center align-middle border border-dark" >M</td>
													<td align="center" bgcolor="#FFFF00" class="text-center align-middle border border-dark" >K</td>
													<td align="center" bgcolor="#FFFFFF" class="text-center align-middle border border-dark" >P</td>
													<td align="center" bgcolor="#000000" class="text-center align-middle border border-dark"style="color:#fff" >H</td>
													<td align="center" bgcolor="#FF0000" class="text-center align-middle border border-dark" >M</td>
													<td align="center" bgcolor="#FFFF00" class="text-center align-middle border border-dark" >K</td>
													<td align="center" bgcolor="#FFFFFF" class="text-center align-middle border border-dark" >P</td>
													<td align="center" bgcolor="#000000" class="text-center align-middle border border-dark" style="color:#fff">H</td>
													<td align="center" bgcolor="#FF0000" class="text-center align-middle border border-dark" >M</td>
													<td align="center" bgcolor="#FFFF00" class="text-center align-middle border border-dark" >K</td>
													<td align="center" bgcolor="#FFFFFF" class="text-center align-middle border border-dark" >P</td>
													<td align="center" bgcolor="#000000" class="text-center align-middle border border-dark" style="color:#fff">H</td>
													<td align="center" bgcolor="#FF0000" class="text-center align-middle border border-dark">M</td>
													<td align="center" bgcolor="#FFFF00" class="text-center align-middle border border-dark">K</td>
													<td align="center" bgcolor="#FFFFFF" class="text-center align-middle border border-dark">P</td>
													<td bgcolor="#000000" class="text-center align-middle border border-dark" style="color:#fff">H</td>
													<td bgcolor="#FF0000" class="text-center align-middle border border-dark">M</td>
													<td bgcolor="#FFFF00" class="text-center align-middle border border-dark">K</td>
													<td bgcolor="#FFFFFF" class="text-center align-middle border border-dark">P</td>
													<td bgcolor="#000000" class="text-center align-middle border border-dark" style="color:#fff">H</td>
													<td bgcolor="#FF0000" class="text-center align-middle border border-dark">M</td>
													<td bgcolor="#FFFF00" class="text-center align-middle border border-dark">K</td>
													<td bgcolor="#FFFFFF" class="text-center align-middle border border-dark">P</td>
												</tr>
												<tr align="center">
													<td class="text-center align-middle  border border-dark">1</td>
													<td class="text-center align-middle  border border-dark">2</td>
													<td class="text-center align-middle  border border-dark">3</td>
													<td class="text-center align-middle  border border-dark">4</td>
													<td class="text-center align-middle  border border-dark">5</td>
													<td class="text-center align-middle  border border-dark">6</td>
													<td class="text-center align-middle  border border-dark">7</td>
													<td class="text-center align-middle  border border-dark">8</td>
													<td class="text-center align-middle  border border-dark">9</td>
													<td class="text-center align-middle  border border-dark">10</td>
													<td class="text-center align-middle  border border-dark">11</td>
													<td class="text-center align-middle  border border-dark">12</td>
													<td class="text-center align-middle  border border-dark">13</td>
													<td class="text-center align-middle  border border-dark">14</td>
													<td class="text-center align-middle  border border-dark">15</td>
													<td class="text-center align-middle  border border-dark">16</td>
													<td class="text-center align-middle  border border-dark">17</td>
													<td class="text-center align-middle  border border-dark">18</td>
													<td class="text-center align-middle  border border-dark">19</td>
													<td class="text-center align-middle  border border-dark">20</td>
													<td class="text-center align-middle  border border-dark">21</td>
													<td class="text-center align-middle  border border-dark">22</td>
													<td class="text-center align-middle  border border-dark">23</td>
													<td class="text-center align-middle  border border-dark">24</td>
													<td class="text-center align-middle  border border-dark">25</td>
													<td class="text-center align-middle  border border-dark">26</td>
													<td class="text-center align-middle  border border-dark">27</td>
													<td class="text-center align-middle  border border-dark">28</td>
													<td class="text-center align-middle  border border-dark">29</td>
													<td class="text-center align-middle  border border-dark">30</td>
													<td class="text-center align-middle  border border-dark">31</td>
													<td class="text-center align-middle  border border-dark">32</td>
												</tr>
												<tr>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
													<td style="padding:0px!important;font-size:7pt" class="border border-dark">&nbsp;</td>
												</tr>
												<tr>
													<td class="text-center align-middle border border-dark">1</td>
													<td class="font-weight-bold border border-dark">GUDANG FASMAT</td>
													<td class="text-right border border-dark"><?=nomor($jml_3g);?></td>
													<td class="text-right border border-dark"><?=nomor($jml_4g);?></td>
													<td class="text-right border border-dark"><?=nomor($jml_5g);?></td>
													<td class="text-right border border-dark"><?=nomor($jml_6g);?></td>
													<td class="text-right border border-dark"><?=nomor($jml_7g);?></td>
													<td class="text-right border border-dark"><?=nomor($jml_8g);?></td>
													<td class="text-right border border-dark"><?=nomor($jml_9g);?></td>
													<td class="text-right border border-dark"><?=nomor($jml_10g);?></td>
													<td class="text-right border border-dark"><?=nomor($jml_11g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_12g);?></td>
													<td class="font-weight-bold border border-dark"><?=nomor($jml_13g);?></td>
													<td class="font-weight-bold border border-dark"><?=nomor($jml_14g);?></td>
													<td class="font-weight-bold border border-dark"><?=nomor($jml_15g);?></td>
													<td class="font-weight-bold border border-dark"><?=nomor($jml_16g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_17g);?></td>
													
													<td class="font-weight-bold border border-dark">&nbsp;</td>
													<td class="font-weight-bold border border-dark">&nbsp;</td>
													<td class="font-weight-bold border border-dark">&nbsp;</td>
													<td class="font-weight-bold border border-dark">&nbsp;</td>
													<td class="font-weight-bold border border-dark">&nbsp;</td>
													<td class="font-weight-bold border border-dark">&nbsp;</td>
													<td class="font-weight-bold border border-dark">&nbsp;</td>
													<td class="font-weight-bold border border-dark">&nbsp;</td>
													<td class="font-weight-bold border border-dark">&nbsp;</td>
													<td class="font-weight-bold border border-dark">&nbsp;</td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_28g);?></td>
													<td class="font-weight-bold border border-dark"><?=nomor($jml_29g);?></td>
													<td class="font-weight-bold border border-dark"><?=nomor($jml_30g);?></td>
													<td class="font-weight-bold border border-dark"><?=nomor($jml_31g);?></td>
													<td class="font-weight-bold border border-dark"><?=nomor($jml_32g);?></td>
												</tr>
												
											</thead>
											<tbody class="border-bottom  border-dark">
												<?php 
													$stok_awal = 0;
													$penerimaan = 0;
													$pcc_kirim = 0;
													$jml_distribusi = 0;
													
													$sum_penerimaan = 0;
													$sum_distribusi = 0;
													
													$sum_3	= $sum_4 = $sum_5= $sum_6=$sum_7 = $sum_8 = $sum_9 = $sum_10 = $sum_11 = $sum_12 = $sum_13 = $sum_14 = $sum_15 = $sum_16 = $sum_17 = $sum_18 = $sum_19 = $sum_20 = $sum_21 = $sum_22 = $sum_23 = $sum_24 = $sum_25 = $sum_26 = $sum_27 = $sum_28 = $sum_29 = $sum_30 = $sum_31 = $sum_32 = 0;
													
													$sisa = 0;
													$sum_sisa = 0;
													$sum_stok = 0;
													$no = 2;
													// dump($divisi,'print_r','exit');
													foreach($divisi as $rows){
														//penerimaan - penggunaan
														$mutasi = $this->model_mutasi->get_current_mutasi_tnkb($list_cc,$dari,$sampai,$rows->id);
														//hitam - putih - merah - kuning
														// echo $idform['hitam'];echo"<br>";
														// echo $idform['putih'];echo"<br>";
														// echo $idform['merah'];echo"<br>";
														// echo $idform['kuning'];
														// dump($stok_awal,'print_r','exit');
														//stok_awal
														$jml_3 = stok_awal_divisi_tnkb($idform['hitam'],$rows->id,$dari,$sampai)['stok_awal_divisi'];
														$jml_4 = stok_awal_divisi_tnkb($idform['merah'],$rows->id,$dari,$sampai)['stok_awal_divisi'];
														$jml_5 = stok_awal_divisi_tnkb($idform['kuning'],$rows->id,$dari,$sampai)['stok_awal_divisi'];
														$jml_6 = stok_awal_divisi_tnkb($idform['putih'],$rows->id,$dari,$sampai)['stok_awal_divisi'];
														$jml_7 = $jml_3 + $jml_4 + $jml_5 + $jml_6;
														//penerimaan
														$jml_8  = stok_awal_divisi_tnkb($idform['hitam'],$rows->id,$dari,$sampai)['penerimaan_divisi'];
														$jml_9  = stok_awal_divisi_tnkb($idform['merah'],$rows->id,$dari,$sampai)['penerimaan_divisi'];
														$jml_10 = stok_awal_divisi_tnkb($idform['kuning'],$rows->id,$dari,$sampai)['penerimaan_divisi'];
														$jml_11 = stok_awal_divisi_tnkb($idform['putih'],$rows->id,$dari,$sampai)['penerimaan_divisi'];
														$jml_12 = $jml_8 + $jml_9 + $jml_10 + $jml_11;
														
														
														$jml_13 = 0;
														$jml_14 = 0;
														$jml_15 = 0;
														$jml_16 = 0;
														$jml_17 = 0;
														//putih
														// print_r($putih);
														$baru_21 = penggunaan_by_id_form('cc_terjual',$rows->id,$dari,$sampai,$putih['a'],'TNKB');
														$perpanjangan_21 = penggunaan_by_id_form('cc_terjual',$rows->id,$dari,$sampai,$putih['b'],'TNKB');
														$Perubahan_21 = penggunaan_by_id_form('cc_terjual',$rows->id,$dari,$sampai,$putih['c'],'TNKB');
														 
														//merah
														$baru_19 = penggunaan_by_id_form('cc_terjual',$rows->id,$dari,$sampai,$merah['a'],'TNKB');
														$perpanjangan_19 = penggunaan_by_id_form('cc_terjual',$rows->id,$dari,$sampai,$merah['b'],'TNKB');
														$Perubahan_19 = penggunaan_by_id_form('cc_terjual',$rows->id,$dari,$sampai,$merah['c'],'TNKB');
														//kuning
														$baru_20 = penggunaan_by_id_form('cc_terjual',$rows->id,$dari,$sampai,$kuning['a'],'TNKB');
														$perpanjangan_20 = penggunaan_by_id_form('cc_terjual',$rows->id,$dari,$sampai,$kuning['b'],'TNKB');
														$Perubahan_20 = penggunaan_by_id_form('cc_terjual',$rows->id,$dari,$sampai,$kuning['c'],'TNKB');
														
														$jml_18 = 0;//hitam
														$jml_19 = $baru_19 + $perpanjangan_19 + $Perubahan_19;//merah
														$jml_20 = $baru_20 + $perpanjangan_20 + $Perubahan_20;//kuning
														$jml_21 = $baru_21 + $perpanjangan_21 + $Perubahan_21;//putih
														$jml_22 = $jml_18 + $jml_19 + $jml_20 + $jml_21;
														
														$jml_23 = 0;
														$jml_24 = 0;
														$jml_25 = 0;
														$jml_26 = 0;
														$jml_27 = 0;
														//sisa stok
														$jml_28 = $jml_3+$jml_8-$jml_13-$jml_18;
														$jml_29 = $jml_4+$jml_9-$jml_14-$jml_19;
														$jml_30 = $jml_5+$jml_10-$jml_15-$jml_20;
														$jml_31 = $jml_6+$jml_11-$jml_16-$jml_21;
														$jml_32 = $jml_7+$jml_12-$jml_17-$jml_22;
														
														$jml_distribusi = stok_keluar_by_month($rows->id,$dari,$sampai,$materiel);
														
														
														// $sisa = $stok_awal + $penerimaan - $jml_24;
														
														$sum_stok += $stok_awal;
														$sum_penerimaan += $pcc_kirim;
														$sum_distribusi = $jml_distribusi;
														
														$sum_3	+=	$jml_3;
														$sum_4	+=	$jml_4;
														$sum_5	+=	$jml_5;
														$sum_6	+=	$jml_6;
														$sum_7	+=	$jml_7;
														$sum_8	+=	$jml_8;
														$sum_9	+=	$jml_9;
														$sum_10	+=	$jml_10;
														$sum_11	+=	$jml_11;
														$sum_12	+=	$jml_12;
														$sum_13	+=	$jml_13;
														$sum_14	+=	$jml_14;
														$sum_15	+=	$jml_15;
														$sum_16	+=	$jml_16;
														$sum_17	+=	$jml_17;
														$sum_18	+=	$jml_18;
														$sum_19	+=	$jml_19;
														$sum_20	+=	$jml_20;
														$sum_21	+=	$jml_21;
														$sum_22	+=	$jml_22;
														$sum_23	+=	$jml_23;
														$sum_24	+=	$jml_24;
														$sum_25	+=	$jml_25;
														$sum_26	+=	$jml_26;
														$sum_27	+=	$jml_27;
														$sum_28	+=	$jml_28;
														$sum_29	+=	$jml_29;
														$sum_30	+=	$jml_30;
														$sum_31	+=	$jml_31;
														$sum_32	+=	$jml_32;
														
														
														$sum_sisa += $sisa;
													?>
													<tr>
														<td class="text-center align-middle border border-dark"><?=$no;?></td>
														<td class="font-weight-bold border border-dark"><?=strtoupper($rows->nama_rekapan);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_3);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_4);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_5);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_6);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_7);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_8);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_9);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_10);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_11);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_12);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_13);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_14);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_15);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_16);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_17);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_18);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_19);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_20);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_21);?></td>
														<td class="text-right font-weight-bold border border-dark"><?=nomor($jml_22);?></td>
														<td class="font-weight-bold border border-dark"><?=nomor($jml_23);?></td>
														<td class="font-weight-bold border border-dark"><?=nomor($jml_24);?></td>
														<td class="font-weight-bold border border-dark"><?=nomor($jml_25);?></td>
														<td class="font-weight-bold border border-dark"><?=nomor($jml_26);?></td>
														<td class="font-weight-bold border border-dark"><?=nomor($jml_27);?></td>
														<td class="font-weight-bold border border-dark"><?=nomor($jml_28);?></td>
														<td class="font-weight-bold border border-dark"><?=nomor($jml_29);?></td>
														<td class="font-weight-bold border border-dark"><?=nomor($jml_30);?></td>
														<td class="font-weight-bold border border-dark"><?=nomor($jml_31);?></td>
														<td class="font-weight-bold border border-dark"><?=nomor($jml_32);?></td>
													</tr>
												<?php $no++; } ?>
											</tbody>
											<tfoot>
												<tr>
													<td class="text-center align-middle font-weight-bold border border-dark" colspan="2">JUMLAH</td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_3+$jml_3g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_4+$jml_4g);?> </td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_5+$jml_5g);?> </td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_6+$jml_6g);?> </td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_7+$jml_7g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_8+$jml_8g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_9+$jml_9g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_10+$jml_10g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_11+$jml_11g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_12+$jml_12g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_13+$jml_13g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_14+$jml_14g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_15+$jml_15g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_16+$jml_16g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_17+$jml_17g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_18+$jml_18g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_19+$jml_19g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_20+$jml_20g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_21+$jml_21g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_22+$jml_22g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_23+$jml_23g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_24+$jml_24g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_25+$jml_25g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_26+$jml_26g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_27+$jml_27g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_28+$jml_28g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_29+$jml_29g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_30+$jml_30g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_31+$jml_31g);?></td>
													<td class="text-right font-weight-bold border border-dark"><?=nomor($sum_32+$jml_32g);?></td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
								
								<div class="row mt-3">
									<div class="col-md-12 col-print-12 p-0">
										<div class="pull-right mr-5 ">
											<table class="table table-borderless">
												<tbody>
													<tr>
														<td class="text-center">&nbsp;</td>
														<td class=""></td>
														<td class="text-center ttd">Serang, <?=tanggal_indo(tanggal());?></td>
													</tr>                
													<tr>
														<td class="text-center">&nbsp;</td>
														<td>&nbsp;</td>
														<td class="text-center font-weight-bold ttd"><?=$kasubdit->jabatan;?></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td class="text-center font-weight-bold">&nbsp;</td>
														<td class=""></td>
														<td class="text-center font-weight-bold ttd">
															<span class="">
																<?=$kasubdit->nama;?>
															</span>
														</td>
													</tr>  
													<tr>
														<td class="text-center">
															
														</td>
														<td class=""></td>
														<td class="text-center ttd">
															<span class="border-top border-dark pt-1"><?=$kasubdit->pangkat;?> NRP <?=$kasubdit->nrp;?></span>
														</td>
													</tr>   
												</tbody>
											</table>
										</div>
										
									</div><!-- /.col -->
									
								</div><!-- /.col -->
							</div>
							<div class="row hidden-print" id="bypassme">
								<div class="col-md-12">
									<div class="clearfix"></div>
									<div class="text-right d-print-none bg-white">
										
										<!--button class="btn btn-default btn-outline hidden-print text-success kirim_wa" type="button" data-phone="" data-id=""> <span><i class="fa  fa-whatsapp"></i> Kirim</span></button>
											
										<button class="btn btn-default btn-outline hidden-print text-danger kirim_pdf" type="button" data-phone="" data-id=""> <span><i class="fa fa-file-pdf-o"></i> Pdf</span></button-->
										<a href="/rekapan" class="btn btn-default btn-outline hidden-print text-info kirim_pdf" type="button" data-phone="" data-id=""> <span><i class="ti ti-arrow-left"></i> Kembali</span></a>
										
										<button onclick="window.print()" class="btn btn-default btn-outline hidden-print" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
									</div>
								</div>
							</div>
						</div>
						<!-- ============================================================== -->
						<!-- End PAge Content -->
					</div>
				</div>
				<!-- ============================================================== -->
				<!-- End Page wrapper  -->
				<!-- ============================================================== -->
			</div>
		</div>
		
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<style>
			.thumbnail {
			position: absolute;
			border: 0!important;
			z-index:100;
			right: 300px;
			opacity:0.7;
			}
		</style>
		
		<script src="<?=base_url();?>assets/print_style/jquery.PrintArea.js" type="text/JavaScript"></script>
		<script src="<?=base_url();?>assets/print_style/jspdf.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>assets/print_style/canvas2image.js"></script>
		<script>
			
			$(document).ready(function() {
				$("#print").click(function() {
					var mode = 'iframe'; //popup
					var close = mode == "popup";
					var options = {
						mode: mode,
						popWd: 400,
						popClose: close
					};
					$("div.printableArea").printArea(options);
				});
			});
			
		</script>
		
	</body>
</html>										