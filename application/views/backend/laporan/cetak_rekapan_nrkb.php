<!DOCTYPE html>
<html lang="en">

<head>
	<title><?= $title; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="<?= base_url('upload/'); ?><?= info()['favicon']; ?>">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Munajat Ibnu">
	<!-- Favicon icon -->

	<!-- Bootstrap Core CSS -->
	<link href="<?= base_url(); ?>assets/print_style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?= base_url(); ?>assets/print_style/css/style.css" rel="stylesheet">
	<!-- You can change the theme colors from here -->
	<link href="<?= base_url(); ?>assets/print_style/css/colors/blue.css" id="theme" rel="stylesheet">
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

		body {
			background: #eef5f9;
			font-family: arial;
			font-size: 9pt;
		}

		#main-wrapper {
			width: 297mm;
			height: 210mm;
			margin: 0 auto;

		}

		.table td {
			padding: 3px 12px !important;
		}

		.table th,
		.table thead th {
			font-size: 10pt !important;
			font-weight: 100 !important;
		}

		@media print {
			.table td {
				padding: 3px 12px !important;
			}

			.table th,
			.table thead th {
				font-size: 10pt !important;
				font-weight: 100 !important;
			}

			#main-wrapper {
				width: 100%;
				margin: 0 auto;

			}

			.page-wrapper {
				width: 100%;
				border: 0;
				padding-bottom: 0px;
				padding-top: 0px;
				background: #fff;
			}

			.container-fluid {

				padding: 0;
				margin: 0 auto;
			}

			.card {
				border: 0px padding:0;
			}

			.card-body {
				border: 0px;
				padding: 0;
			}

			#bypassme {
				background: #fff;
			}

			html {
				background: #fff;
			}

			body {
				width: 100%;
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
				border-top: 1px solid rgba(0, 0, 0, .1);
			}

		}

		hr {
			margin-top: 1px;
			margin-bottom: 6px;
			border: 0;
			border-top-color: currentcolor;
			border-top-style: none;
			border-top-width: 0px;
			border-top: 1px solid rgba(0, 0, 0, .1);
		}
	</style>
	<style type="text/css" media="print">
		@page {
			size: landscape;
		}
	</style>
	<script src="<?= base_url(); ?>assets/print_style/jquery/jquery.min.js"></script>
	<script>
		var nama_file = '<?= $materiel . '-' . $bulan; ?>';
	</script>
</head>

<body class="fix-header card-no-border logo-center">
	<div id="main-wrapper">
		<div class="page-wrapper pt-3 pb-3" id="renderPDF">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card card-body mb-2 printableArea" id="printableArea">
							<div class="row mt-2" id="exportExcel">
								<div class="col-md-6 col-sm-6 mb-0 pb-0">
									<div class="pull-left mr-5 ">
										<p class="text-center m-l-5 border-bottom border-dark text-body">KEPOLISIAN NEGARA REPUBLIK INDONESIA
											<br />DAERAH BANTEN
											<br />DIREKTORAT LALU LINTAS
										</p>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 mb-0 pb-0">
									<div class="pull-right ml-5 pl-5 ml-4">

										<p class="m-l-5 text-body">
											<br /><span class="border border-dark p-1">L. MAT 08</span>
											<br />
										</p>

									</div>
								</div>
								<div class="col-md-12 mb-0 pt-2">
									<p class="m-l-5 text-body text-center font-weight-bold fs-6">
										LAPORAN PENGGUNAAN <?= $materiel; ?>-PILIHAN
										<br>BULAN <?= $bulan; ?>
									</p>
								</div>

								<div class="col-md-12 mt-0 pt-0">
									<table class="table border border-dark" style="font-size:8.6pt;margin-bottom: 5px;" id='table_wrapper'>
										<thead class="border border-dark">
											<tr align="center" class="border border-dark">
												<td rowspan="3" class="text-center align-middle border border-dark">NO</td>
												<td rowspan="3" class="text-center align-middle border border-dark">KESATUAN</td>
												<td colspan="10" class="text-center align-middle border border-dark" style="padding:5px 0 5px!important">PENGGUNAAN</td>
												<td rowspan="3" class="text-center align-middle border border-dark">RUSAK</td>
												<td rowspan="3" class="text-center align-middle border border-dark">KET</td>
											</tr>
											<tr>
												<td colspan="2" align="center" class="text-center align-middle border border-dark" style="width:70px">NRKB 1</td>
												<td colspan="2" align="center" class="text-center align-middle border border-dark" style="width:70px">NRKB 2</td>
												<td colspan="2" align="center" class="text-center align-middle border border-dark" style="width:70px">NRKB 3</td>
												<td colspan="2" align="center" class="text-center align-middle border border-dark" style="width:70px">NRKB 4</td>
												<td colspan="2" align="center" class="text-center align-middle border border-dark" style="width:70px">JUMLAH</td>
											</tr>
											<tr>
												<td align="center" class="text-center align-middle border border-dark" style="width:70px">HURUF</td>
												<td align="center" class="text-center align-middle border border-dark" style="width:70px">BLANK</td>
												<td align="center" class="text-center align-middle border border-dark" style="width:70px">HURUF</td>
												<td align="center" class="text-center align-middle border border-dark" style="width:70px">BLANK</td>
												<td align="center" class="text-center align-middle border border-dark" style="width:70px">HURUF</td>
												<td align="center" class="text-center align-middle border border-dark" style="width:70px">BLANK</td>
												<td align="center" class="text-center align-middle border border-dark" style="width:70px">HURUF</td>
												<td align="center" class="text-center align-middle border border-dark" style="width:70px">BLANK</td>
												<td class="text-center align-middle border border-dark" style="width:70px">HURUF</td>
												<td class="text-center align-middle border border-dark" style="width:70px">BLANK</td>
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
											</tr>
											<tr>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
												<td style="padding:0px!important;font-size:7pt" class=" border border-dark">&nbsp;</td>
											</tr>
											<tr>
												<td class="text-center align-middle border border-dark">1</td>
												<td class="font-weight-bold border border-dark">GUDANG FASMAT</td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
												<td class="font-weight-bold border border-dark text-center">-</td>
												<td class="font-weight-bold border border-dark text-center">-</td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
											</tr>

										</thead>
										<tbody class="border-bottom  border-dark">
											<?php

											$nrkb_1_huruf = 0;
											$nrkb_1_blank = 0;
											$nrkb_2_huruf = 0;
											$nrkb_2_blank = 0;
											$nrkb_3_huruf = 0;
											$nrkb_3_blank = 0;
											$nrkb_4_huruf = 0;
											$nrkb_4_blank = 0;
											$nrkb_jumlah_huruf = 0;
											$nrkb_jumlah_blank = 0;

											$sum_1_huruf = 0;
											$sum_1_blank = 0;
											$sum_2_huruf = 0;
											$sum_2_blank = 0;
											$sum_3_huruf = 0;
											$sum_3_blank = 0;
											$sum_4_huruf = 0;
											$sum_4_blank = 0;
											$sum_jumlah_huruf = 0;
											$sum_jumlah_blank = 0;
											$no = 2;

											foreach ($divisi as $rows) {
												//nrkb 1 huruf
												$nrkb_1_huruf = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 213, $materiel);
												$jml_nrkb_1_huruf = $nrkb_1_huruf > 0 ? $nrkb_1_huruf : '';
												//nrkb 1 blank
												$nrkb_1_blank = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 212, $materiel);
												$jml_nrkb_1_blank = $nrkb_1_blank > 0 ? $nrkb_1_blank : '';

												//nrkb 2 huruf
												$nrkb_2_huruf = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 218, $materiel);
												$jml_nrkb_2_huruf = $nrkb_1_huruf > 0 ? $nrkb_1_huruf : '';
												//nrkb 2 blank
												$nrkb_2_blank = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 217, $materiel);
												$jml_nrkb_2_blank = $nrkb_2_blank > 0 ? $nrkb_2_blank : '';
												//nrkb 3 huruf
												$nrkb_3_huruf = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 220, $materiel);
												$jml_nrkb_3_huruf = $nrkb_3_huruf > 0 ? $nrkb_3_huruf : '';
												//nrkb 3 blank
												$nrkb_3_blank = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 219, $materiel);
												$jml_nrkb_3_blank = $nrkb_3_blank > 0 ? $nrkb_3_blank : '';
												//nrkb 4 huruf
												$nrkb_4_huruf = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 222, $materiel);
												$jml_nrkb_4_huruf = $nrkb_4_huruf > 0 ? $nrkb_4_huruf : '';
												//nrkb 4 blank
												$nrkb_4_blank = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 221, $materiel);
												$jml_nrkb_4_blank = $nrkb_4_blank > 0 ? $nrkb_4_blank : '';

												$nrkb_jumlah_huruf = $nrkb_1_huruf + $nrkb_2_huruf + $nrkb_3_huruf + $nrkb_4_huruf;
												$jml_nrkb_jumlah_huruf = $nrkb_jumlah_huruf > 0 ? $nrkb_jumlah_huruf : '<center>-</center>';

												$nrkb_jumlah_blank = $nrkb_1_blank + $nrkb_2_blank + $nrkb_3_blank + $nrkb_4_blank;
												$jml_nrkb_jumlah_blank = $nrkb_jumlah_blank > 0 ? $nrkb_jumlah_blank : '<center>-</center>';

												$sum_1_huruf += $nrkb_1_huruf;
												$sum_1_blank += $nrkb_1_blank;
												$sum_2_huruf += $nrkb_2_huruf;
												$sum_2_blank += $nrkb_2_blank;
												$sum_3_huruf += $nrkb_3_huruf;
												$sum_3_blank += $nrkb_3_blank;
												$sum_4_huruf += $nrkb_4_huruf;
												$sum_4_blank += $nrkb_4_blank;
												$sum_jumlah_huruf += $nrkb_jumlah_huruf;
												$sum_jumlah_blank += $nrkb_jumlah_blank;
											?>
												<tr>
													<td class="text-right align-middle border border-dark"><?= $no; ?></td>
													<td class="font-weight-bold border border-dark"><?= strtoupper($rows->nama_rekapan); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= $jml_nrkb_1_huruf; ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= $jml_nrkb_1_blank; ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= $jml_nrkb_2_huruf; ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= $jml_nrkb_2_blank; ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= $jml_nrkb_3_huruf; ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= $jml_nrkb_3_blank; ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= $jml_nrkb_4_huruf; ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= $jml_nrkb_4_blank; ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= $jml_nrkb_jumlah_huruf; ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= $jml_nrkb_jumlah_blank; ?></td>
													<td class="font-weight-bold border border-dark">&nbsp;</td>
													<td class="font-weight-bold border border-dark">&nbsp;</td>
												</tr>
											<?php $no++;
											} ?>
										</tbody>
										<tfoot>
											<tr>
												<td class="text-center align-middle font-weight-bold border border-dark" colspan="2">JUMLAH</td>
												<td class="text-right font-weight-bold border border-dark"><?= $sum_1_huruf > 0 ? $sum_1_huruf : '<center>-</center>'; ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= $sum_1_blank > 0 ? $sum_1_blank : '<center>-</center>'; ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= $sum_2_huruf > 0 ? $sum_2_huruf : '<center>-</center>'; ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= $sum_2_blank > 0 ? $sum_2_blank : '<center>-</center>'; ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= $sum_3_huruf > 0 ? $sum_3_huruf : '<center>-</center>'; ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= $sum_3_blank > 0 ? $sum_3_blank : '<center>-</center>'; ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= $sum_4_huruf > 0 ? $sum_4_huruf : '<center>-</center>'; ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= $sum_4_blank > 0 ? $sum_4_blank : '<center>-</center>'; ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= $sum_jumlah_huruf > 0 ? $sum_jumlah_huruf : '<center>-</center>'; ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= $sum_jumlah_blank > 0 ? $sum_jumlah_blank : '<center>-</center>'; ?></td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
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
													<td class="text-center">Serang, <?= tanggal_indo(tanggal()); ?></td>
												</tr>
												<tr>
													<td class="text-center">&nbsp;</td>
													<td>&nbsp;</td>
													<td class="text-center font-weight-bold"><?= $kasubdit->jabatan; ?></td>
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
													<td class="text-center font-weight-bold">
														<span class="">
															<?= $kasubdit->nama; ?>
														</span>
													</td>
												</tr>
												<tr>
													<td class="text-center">

													</td>
													<td class=""></td>
													<td class="text-center ttd">
														<span class="border-top border-dark pt-1"><?= $kasubdit->pangkat; ?> NRP <?= $kasubdit->nrp; ?></span>
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
									<button class="btn btn-default btn-outline hidden-print excel" type="button"> <span><i class="fa fa-file-excel-o"></i> Excel</span> </button>
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
			border: 0 !important;
			z-index: 100;
			right: 300px;
			opacity: 0.7;
		}
	</style>

	<script src="<?= base_url(); ?>assets/print_style/jquery.PrintArea.js" type="text/JavaScript"></script>
	<script src="<?= base_url(); ?>assets/print_style/jspdf.min.js"></script>
	<script src="<?= base_url(); ?>assets/backend/js/jquery.table2excel.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/print_style/canvas2image.js"></script>
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

			$(".excel").click(function() {
				$("#exportExcel").table2excel({
					name: "NRKB",
					filename: nama_file + Math.floor((Math.random() * 9999999) + 1000000) + ".xls", // do include extension
					preserveColors: false // set to true if you want background colors and font colors preserved
				});
			});

		});
	</script>

</body>

</html>