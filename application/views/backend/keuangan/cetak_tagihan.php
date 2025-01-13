<!DOCTYPE html>
<html>
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Percetakan & Digital Printing" />
		
		<meta name="author" content="Munajat Ibnu">
		<!-- Favicon icon -->
		<link rel="icon" type="image/png" sizes="16x16" href="<?=$favicon;?>">
		<link href="<?= base_url('assets/'); ?>print_style/bootstrap-3.3.7/dist/css/bootstrap.css" rel="stylesheet"/>
		
		<script src="<?= base_url('assets/'); ?>js/jquery.min.js"></script>
		
		<style>
			
			@font-face {
			
			body{
			font-family: "Microsoft Sans Serif", sans-serif;
			font-size: 12pt;
			-webkit-print-color-adjust:exact !important;
			print-color-adjust:exact !important;
			color-adjust: exact;
			margin:0 auto;
			}
			h1, p{
			margin:0px;  
			}
			.main-section{
			border: 2px dashed  #ffffff;
			}
			.header{
			background-color: #fff;
			padding:10px 15px 10px 15px ;  
			color:#000000;
			border-bottom:2px dashed  #000
			}
			.border-bottom{
			color:#000000;
			border-bottom:2px dashed  #000 !important
			}
			.content{
			padding:10px 15px 10px 15px;
			}
			th{
			background-color: #ffffff;
			color: #000000;  
			text-align: right;
			}
			.table td:nth-child(1),
			.table th:nth-child(1){
			text-align:left; 
			}
			.lastSection{
			padding: 20px 15px 30px 15px;
			}
			.thumbnail {
			position: absolute;
			border: 0!important;
			z-index:-1;
			right: 30%;
			opacity:0.7;
			}
			.border-top-0{border: 0px!important}
			.border-bottom-0{border: 0px!important}
			.text-center{text-align:center!important}
			.text-left{text-align:left!important}
			.font-weight-bold{font-weight:bold}
			blockquote {
			padding: 10px 10px;
			margin: 0 0 10px;
			font-size: 17.5px;
			border-left: 5px solid #eee;
			}
			address {
			margin-bottom: 0;
			font-style: normal;
			line-height: 1.42857143;
			}
			.table {
			margin-bottom: 5px;
			}
			.table > thead > tr > th {
			vertical-align: bottom;
			border-bottom: 2px dashed  #000;
			}
			.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
			border-top: 1.5px dashed  #000;
			}
			.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
			position: relative;
			min-height: 1px;
			padding-right: 10px;
			padding-left: 10px;
			}
			.p-1{padding-right: 5px;padding-left: 5px;}
			.p-2{padding-right: 10px;padding-left: 10px;}
			.mt-2{margin-top: 10px!important;}
			.mb-2{margin-bottom: 10px!important;}
			@media print {
			body {
			-webkit-filter: grayscale(100%);
			-moz-filter: grayscale(100%);
			-ms-filter: grayscale(100%);
			filter: grayscale(100%);
			}
			.border-top{
			border-style: solid;
			}
		</style>
		<script type="text/javascript">
			<!--
			//window.print();
			//window.onfocus=function(){ window.close();}
			-->
		</script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				
				<div class="col-md-3 col-sm-3 col-md-offset-5">
					<div class="row main-section">
						<div class="col-md-12 col-sm-12 header text-center">
							<h1><img src="<?=$logo;?>" height="100px" alt="" /></h1>
						</div>
						
						<div class="col-md-12 col-sm-12 content text-center">
							<p><?=tag_key('nama_sekolah');?></p>
							<p><span class="sosmed"><?=tag_key('whatsapp');?></span></p>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12 text-left">
								<table class="table table-striped">
									<tr>
										<td class="text-left">Tanggal</td>
										<td class="text-right"><?=date('d/m/Y',strtotime($cetak->tgl_tagihan));?></td>
									</tr>
									<tr>
										<td class="text-left">Kepada</td>
										<td class="text-right"><?=get_nama($cetak->id_siswa);?></td>
									</tr>
									
								</table>
							</div>
						</div>
						
						<div class="col-md-12 col-sm-12 col-xs-12 text-center">
							<p>Kode Daftar</p>
							<button class="btn btn-default btn-md" type="submit"><?=($cetak->kode_daftar);?></button>
						</div>
						
						<div class="col-md-12 col-sm-12 col-xs-12 text-center mt-2 mb-2">
							<h4 class="mb-0 pb-0">TOTAL TAGIHAN</h4>
							<button class="btn btn-default btn-lg" type="submit"><?=rprp($cetak->total_tagihan);?></button>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 " style="margin-top:20px!important">
						</div>
						
						<div class="row mt-2">
							<table class="table table-striped">
								<tr>
									<td class="text-center" colspan="2">RINCIAN PEMBAYARAN</td>
								</tr>
								<?php 
									if($result):
									foreach($result AS $val){ ?>
									<tr>
										<td class="">
											<?=getKategori($val->id_kategori);?>
										</td>
										<td class="text-right">
											<?=rprp($val->jumlah_bayar)?>
										</td>
									</tr>
									<?php 
									} 
									endif;
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>													