<!DOCTYPE html>
<html lang="en">
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Favicon icon -->
		<link rel="icon" type="image/x-icon" href="<?= base_url('upload/'); ?><?=info('site_favicon');?>">
		<title><?=$title;?></title>
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
			body{
			background: #eef5f9;
			}
			#main-wrapper {
			width: 260mm;
			min-height: 297mm;
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
			body{
			width:100%;
			margin: auto;
			padding: 0;
			background: #fff;
			}
			
			hr {
			margin-top: 2px;
			margin-bottom: 2px;
			border: 0;
			border-top-color: currentcolor;
			border-top-style: none;
			border-top-width: 0px;
			border-top: 1px solid rgba(0,0,0,.1);
			}
			
			}
			
		</style>
		<?php  
			$tagihan = "LAPORAN TAGIHAN";
			$text = "text-success";
			
			
		?>
	</head>
	
	<body class="fix-header card-no-border logo-center">
		<div id="main-wrapper">
			<div class="page-wrapper">
				<div class="container-fluid ">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-body printableArea">
								
								<h3><b class="<?=$text;?>"><?=$tagihan;?></b> <span class="pull-right">TAHUN : <?=$tahun;?></span></h3>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<div class="pull-left">
											<address>
												<p class="text-muted m-l-5"><?=tag_key('nama_sekolah');?>
													<br/>Telp. <?=tag_key('site_phone');?>
													<br/> Email: <?=tag_key('site_mail');?>
												</p>
											</address>
										</div>
										<div class="pull-right text-right">
											<img src="<?=$logo;?>" height="40px" alt="" />
											<address>
												<p class="m-t-5"><b><?=tag_key('letter_addr');?></b> , <?=date_full(today());?></p>
											</address>
										</div>
									</div>
									<div class="col-md-12">
										<div class="table-responsive" style="clear: both;">
											<table class="table table-striped" style="margin-bottom: 5px;">
												<thead style="font-size:12px">
													<tr>
														<th class="w-1 text-center">No</th>
														<th class="w-15 text-left">Tanggal | Kode_Daftar</th>
														<th class="w-15 text-left">Nama | Tahun_Akademik</th>
														<th class="w-15 text-right">Total</th>
														<th class="w-15 text-right">Bayar</th>
														<th class="w-15 text-right">Sisa</th>
													</tr>
												</thead>
												<tbody style="font-size:12px">
													<?php $no = 1; 
														$total_tagihan = $total_bayar = $sisa_tagihan = 0;
														foreach($record AS $row): 
														$sisa = $row['total_tagihan'] - $row['total_bayar'];
														$total_tagihan +=$row['total_tagihan'];
														$total_bayar +=$row['total_bayar'];
														$sisa_tagihan +=$sisa;
													?>
													<tr>
														<td><?=$no++;?></td>
														<td><?=dtime($row['tgl_tagihan']);?>
															<div class="text-secondary"><?=$row['kode_daftar'];?></div>
														</td>
														<td>
															<?=get_nama($row['id_siswa']);?>
															<div class="text-secondary"><?=$row['tahun_akademik'];?></div>
														</td>
														
														<td class="text-right">
															<?=rprp($row['total_tagihan']);?>
															<div class="text-secondary">Pendaftaran + Biaya Masuk</div>
														</td>
														<td class="text-right"><?=rprp($row['total_bayar']);?>
															<div class="text-secondary">Pendaftaran & Biaya Masuk</div>
														</td>
														<td class="text-right"><?=rprp($sisa);?>
															<div class="text-secondary">Biaya Masuk</div>
														</td>
													</tr>
													<?php endforeach;?>
												</tbody>
												<tfoot style="font-size:12px">
													<tr>
														<td>#</td>
														<td colspan="2">Total</td>
														<td class="text-right"><?=rprp($total_tagihan);?></td>
														<td class="text-right"><?=rprp($total_bayar);?></td>
														<td class="text-right"><?=rprp($sisa_tagihan);?></td>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-12">
										<hr>
										<div class="pull-left">
											
										</div>
										<div class="pull-right d-print-none">
											<button onclick="window.print()" class="btn btn-default btn-outline hidden-print" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
										</div>
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
			<!-- ============================================================== -->
			<!-- End Wrapper -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- All Jquery -->
			<!-- ============================================================== -->
			<script src="<?=base_url();?>assets/print_style/jquery/jquery.min.js"></script>
			<!-- Bootstrap tether Core JavaScript -->
			<script src="<?=base_url();?>assets/print_style/bootstrap/js/popper.min.js"></script>
			<script src="<?=base_url();?>assets/print_style/bootstrap/js/bootstrap.min.js"></script>
			<!-- slimscrollbar scrollbar JavaScript -->
			
			<script src="<?=base_url();?>assets/print_style/jquery.PrintArea.js" type="text/JavaScript"></script>
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
				});
			</script>
			
		</body>
	</html>																			