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
			font-family:arial;
			}
			#main-wrapper {
			width: 260mm;
			min-height: 145mm;
			margin:0 auto;
			
			}
			.table td  {
			padding: 3px 12px!important;
			}
			.table th, .table thead th {
			font-size: 10pt !important;
			font-weight: 100 !important;
			}
			
			@media print
			{
			.table td  {
			padding: 3px 12px!important;
			}
			.table th, .table thead th {
			font-size: 10pt !important;
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
			@media print { 
			@page { 
			size: potrait;
			width:210cm;
			height:330cm;
			margin-top: 1cm; 
			margin-bottom: 1.5cm; 
			} 
			@page:first {
			margin-top: 1cm;
			margin-bottom: 1cm;
			}
			table {
			break-inside: avoid-page;
			}
			}
		</style>
		<script type="text/javascript">
			<!--
			window.print();
			//-->
		</script>
		
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
										<div class="pull-left ml-5 pl-5 ml-4">
                                            
                                            <p class="m-l-5 text-body">Bentuk&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
                                                <br/>
											<br/> Lembar ke :</p>
                                            
										</div>
									</div>
                                    <div class="col-md-12 mb-0 pt-2">
                                        <p class="m-l-5 text-body text-center font-weight-bold">
                                            SURAT PERINTAH PENGELUARAN MATERIEL
                                            <br>(S.P.P.M)
                                            <br>Nomor : <?=$row->nomor_detail;?>
										</p>
									</div>
                                    <div class="col-md-5 col-sm-5 mb-0 pb-0">
										<div class="pull-left ">
                                            <p class="m-l-5 text-body">Kepada Kasi Fasmat SBST
                                                <br/>Diperintahkan untuk mengeluarkan kepada
                                                <br/>Berdasarkan Nomor Surat
                                                <br/>
                                                <br/>Materiel sebagai berikut :
											</p>
										</div>
									</div>
                                    <div class="col-md-7 col-sm-7 mb-0 pb-0">
										<div class="pull-left ">
                                            <p class="m-l-5 text-body">: <?=$fasmat;?>
                                                <br/>: <?=divisi($row->id_divisi)['title'];?>
                                                <br/>: <?=$row->nomor_surat;?>
                                                <br/>&nbsp;Tgl, <?=tanggal_indo($row->tgl_surat);?>
											</p>
										</div>
									</div>
									<div class="col-md-12 mt-0 pt-0">
										<div class="table-responsive" style="clear: both;">
											<table class="table table-borderless" style="margin-bottom: 5px;">
												<thead>
													<tr class="border  border-dark">
														<td rowspan="2" align="center" valign="middle" class="text-center align-middle border-right border-dark">No. <br>
														Urut</td>
														<td rowspan="2" align="center" class="align-middle border-right border-dark">Nama dan <br>
														Kode Materiel</td>
														<td rowspan="2" align="center" class="align-middle border-right border-dark">Satuan</td>
														<td colspan="2" align="center" class="border-right border-dark">Banyaknya</td>
														<td colspan="2" align="center" class="text-center border-right border-dark">Harga (Rp.)</td>
														<td align="center" valign="middle" class="text-left">Keterangan</td>
													</tr>
                                                    <tr class="border  border-dark">
														<td align="center" class="border-right border-dark">Angka</td>
														<td align="center" style="width:13%;" class="border-right border-dark">Huruf</td>					
														<td align="center" valign="middle" class="text-right border-right border-dark">Satuan</td>
														<td align="center" valign="middle" class="text-right border-right border-dark">Jumlah</td>
														<td style="width:10%;" align="center" valign="middle" class="text-right">&nbsp;</td>
													</tr>
												</thead>
                                                <tbody class="border-bottom  border-dark">
                                                    <?php 
                                                        $total_harga = 0;
                                                        $no = 1;
                                                        $count = count($detail->detail) * 2;
                                                        foreach($detail->detail as $rows){
                                                            $total_harga = $rows->jumlah * $rows->harga;
                                                            $to_word = (to_word($rows->jumlah));
															$catatan = '';
															if($rows->catatan!=''){
																$catatan = '<br>'.$rows->catatan;
															}
														?>
                                                        <tr class="">
                                                            <td class="text-center border-left border-right border-dark"><?=$no;?>.</td>
                                                            <td class="border-right  border-dark"><?=$rows->nama_barang.$catatan;?></td>
                                                            <td class="border-right border-dark"><?=$rows->satuan;?></td>
                                                            <td class="text-center border-right border-dark"><?=$rows->jumlah;?></td>
                                                            <td class="text-center border-right border-dark"><?=$to_word;?></td>
                                                            <td class="text-center border-right border-dark"><?=rp($rows->harga);?></td>
                                                            <td class="text-center border-right border-dark"><?=rp($total_harga);?></td>
                                                            <?php if($no==1){ ?>
                                                                <td rowspan="<?=$count;?>" class="border-right border-dark"><?=$row->keterangan;?></td>
															<?php } ?>
														</tr>
														<tr>
															<td class="border-left border-right border-dark">&nbsp;</td>
															<td class="border-left border-right border-dark">&nbsp;</td>
															<td class="border-left border-right border-dark">&nbsp;</td>
															<td class="border-left border-right border-dark">&nbsp;</td>
															<td class="border-left border-right border-dark">&nbsp;</td>
															<td class="border-left border-right border-dark">&nbsp;</td>
															<td class="border-left border-right border-dark">&nbsp;</td>
															
														</tr>
													<?php $no++; } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								
								<div class="row mt-3">
									<div class="col-md-12 col-print-12 p-0 ">
										<table class="table table-borderless">
											<tbody>
												<tr>
													<td class="text-center">Mengetahui:</td>
													<td class=""></td>
													<td class="text-center">Serang, <?=tanggal_indo($row->tanggal);?></td>
												</tr>                
												<tr>
													<td class="text-center"><?=$direktur->jabatan;?></td>
													<td>&nbsp;</td>
													<td class="text-center"><?=$kasubdit->jabatan;?></td>
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
													<td class="text-center font-weight-bold"><?=$direktur->nama;?></td>
													<td class=""></td>
													<td class="text-center font-weight-bold">
														<span class="border-bottom border-dark">
															<?=$kasubdit->nama;?>
														</span>
													</td>
												</tr>  
												<tr>
													<td class="text-center">
														<span class="border-top border-dark pt-1"><?=$direktur->pangkat;?> NRP <?=$direktur->nrp;?></span>
													</td>
													<td class=""></td>
													<td class="text-center">
														<span class=""><?=$kasubdit->pangkat;?> NRP <?=$kasubdit->nrp;?></span>
													</td>
												</tr>   
											</tbody>
										</table>
									</table>
									
								</div><!-- /.col -->
								
							</div><!-- /.col -->
						</div>
						<div class="row hidden-print" id="bypassme">
							<div class="col-md-12">
								<div class="clearfix"></div>
								<div class="text-right d-print-none bg-white">
                                    
                                    <!--button class="btn btn-default btn-outline hidden-print text-success kirim_wa" type="button" data-phone="" data-id=""> <span><i class="fa  fa-whatsapp"></i> Kirim</span></button>
										
									<button class="btn btn-default btn-outline hidden-print text-danger kirim_pdf" type="button" data-phone="" data-id=""> <span><i class="fa fa-file-pdf-o"></i> Pdf</span></button-->
                                    
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
					popClose: close
				};
				$("div.printableArea").printArea(options);
			});
			
			$(".kirim_wa").click(function() {
				var id = $(this).attr('data-id'); //popup
				var phone = $(this).attr('data-phone'); //popup
				// console.log(id)
				$.ajax({
					type: 'POST',
					url: base_url + 'generate/token',
					data: {
						id: id,
						tipe:1,
						phone: phone
					},
					dataType:"json",
					beforeSend: function() {
						// $("body").loading();
					},
					success: handleKirim,
					error: function(xhr, status, error) {
						var err = xhr.responseText;
						console.log(err)
						// $("body").loading('stop');
					}
				});
			});
			
			$(".kirim_pdf").click(function() {
				var id = $(this).attr('data-id'); //popup
				var phone = $(this).attr('data-phone'); //popup
				// console.log(id)
				$.ajax({
					type: 'POST',
					url: base_url + 'generate/token',
					data: {
						id: id,
						tipe:2,
						phone: phone
					},
					dataType:"json",
					beforeSend: function() {
						// $("body").loading();
					},
					success: handle_Kirim,
					error: function(xhr, status, error) {
						var err = xhr.responseText;
						console.log(err)
						// $("body").loading('stop');
					}
				});
			});
		});
		function handle_Kirim(data) {
			var id= data.id;
			var token= data.token;
			var tipe= data.tipe;
			var url_web = base_url+'cetak/invoice/'+id+'/?type='+tipe+'&token='+token;
			window.open(url_web, '_blank');
		}
		function handleKirim(data) {
			// console.log(data);
			// return;
			if(data.status==200)
			{
				var id= data.id;
				var token= data.token;
				var tipe= data.tipe;
				var url_web = base_url+'cetak/invoice/'+id+'/?type='+tipe+'&token='+token
				var number =data.phone; 
				var message = 
				'Klik Tautan diatas untuk melihat invoice' +
				'%0A' +
				'%0A' +
				'Cek Produk : https://sayuti.com' +
				'%0ACek Harga : https://harga.sayuti.com';
				var url_wa = getLinkWhastapp(number,url_web, message)
				// console.log(url_wa);
				window.open(url_wa, '_blank');
			}
		}
		
		function getLinkWhastapp(number, url_web, message) {
			var url = 'https://wa.me/' 
			+ number+ '?text=' 
			+ encodeURIComponent(url_web)
			+ '%0A' + message
			return url
		}
	</script>
	
</body>
</html>										