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
			font-family: Arial Narrow;
			font-size: 10pt;
		}

		#main-wrapper {
			width: 330mm;
			height: 210mm;
			margin: 0 auto;

		}

		.table td {
			padding: 2px 8px !important;
			font-size: 7pt !important;
			font-weight: bold;
		}

		.table td.ttd {
			padding: 2px 8px !important;
			font-size: 10pt !important;
			font-weight: bold;
		}

		.table th,
		.table thead th {
			font-size: 7pt !important;
			font-weight: bold;
		}

		@media print {
			.table td {
				padding: 3px 10px !important;
			}

			.table th,
			.table thead th {
				font-size: 9pt !important;
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
		@media print {
			@page {
				size: landscape;
				margin-top: 0cm;
				margin-bottom: 0cm;
			}

		}
	</style>
	<script src="<?= base_url(); ?>assets/print_style/jquery/jquery.min.js"></script>

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
											<br />DAERAH BANTEN
											<br />DIREKTORAT LALU LINTAS
										</p>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 mb-0 pb-0">
									<div class="pull-right ml-5 pl-5 ml-4">

										<p class="m-l-5 text-body">
											<br /><span class="border border-dark p-1">L. MAT 01</span>
											<br />
										</p>

									</div>
								</div>
								<div class="col-md-12 mb-0 pt-2">
									<p class="m-l-5 text-body text-center font-weight-bold fs-6">
										LAPORAN SISA STOK PENERIMAAN DAN PENGGUNAAN MATERIEL <?= $materiel; ?>
										<br>BULAN <?= $bulan; ?>
									</p>
								</div>

								<div class="col-md-12 mt-0 pt-0">
									<table class="table border border-dark" style="font-size:8.6pt;margin-bottom: 5px;">
										<thead class="border border-dark">
											<tr class="border border-dark">
												<td class="text-center align-middle border border-dark" rowspan="3">NO</td>
												<td class="text-center align-middle border border-dark" rowspan="3" style="width:160px!important">KESATUAN</td>
												<td class="text-center align-middle border border-dark" rowspan="3">STOK_AWAL</td>
												<td class="text-center align-middle border border-dark" rowspan="3">PENERIMAAN</td>
												<td class="text-center align-middle border border-dark" rowspan="3">DISTRIBUSI</td>
												<td colspan="19" align="center" class="text-center align-middle border border-dark" style="padding:5px 0 5px!important">PENGGUNAAN</td>
												<td class="text-center align-middle border border-dark" rowspan="3" style="width:60px">RUSAK</td>
												<td class="text-center align-middle border border-dark" rowspan="3">SISA STOK SEKARANG</td>
												<td class="text-center align-middle border border-dark" rowspan="3">KET</td>
											</tr>
											<tr>
												<td colspan="9" align="center" class="text-center align-middle border border-dark">BARU</td>
												<td colspan="9" align="center" class="text-center align-middle border border-dark" style="width:74px">PERPANJANGAN</td>
												<td rowspan="2" align="center" class="text-center align-middle border border-dark">TOTAL GUN</td>
											</tr>
											<tr>
												<td align="center" class="text-center align-middle border border-dark">A</td>
												<td align="center" class="text-center align-middle border border-dark">AU</td>
												<td align="center" class="text-center align-middle border border-dark">BI</td>
												<td align="center" class="text-center align-middle border border-dark">BII</td>
												<td align="center" class="text-center align-middle border border-dark">BIU</td>
												<td align="center" class="text-center align-middle border border-dark">BIIU</td>
												<td align="center" class="text-center align-middle border border-dark">C</td>
												<td align="center" class="text-center align-middle border border-dark">D</td>
												<td align="center" class="text-center align-middle border border-dark">JUMLAH<br>
													BARU</td>
												<td align="center" class="text-center align-middle border border-dark">A</td>
												<td align="center" class="text-center align-middle border border-dark">AU</td>
												<td align="center" class="text-center align-middle border border-dark">BI</td>
												<td align="center" class="text-center align-middle border border-dark">BII</td>
												<td align="center" class="text-center align-middle border border-dark">BIU</td>
												<td align="center" class="text-center align-middle border border-dark">BIIU</td>
												<td align="center" class="text-center align-middle border border-dark">C</td>
												<td align="center" class="text-center align-middle border border-dark">D</td>
												<td align="center" class="text-center align-middle border border-dark">JUMLAH<br>
													PJNG</td>
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
												<td class="text-right font-weight-bold border border-dark"><?= rp($stok_awal_gudang); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= rp($stok_penerimaan); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= rp($stok_pengiriman); ?></td>
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
												<td class="text-right font-weight-bold border border-dark"><?= rp($sisa_stok); ?></td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
											</tr>

										</thead>
										<tbody class="border-bottom  border-dark">
											<?php
											$stok_awal = 0;
											$penerimaan = 0;
											$pcc_kirim = 0;
											$jml_distribusi = 0;

											$jml_14 = 0;
											$jml_23 = 0;
											$sum_stok = 0;
											$sum_penerimaan = 0;
											$sum_distribusi = 0;

											$sum_6 = $sum_7 = $sum_8 = $sum_6 = $sum_7 = $sum_8 = $sum_9 = $sum_10 = $sum_11 = $sum_12 = $sum_13 = $sum_14 = $sum_15 = $sum_16 = $sum_17 = $sum_18 = $sum_19 = $sum_20 = $sum_21 = $sum_22 = $sum_23 = $sum_24 = 0;

											$sum_sisa = 0;
											$no = 2;

											foreach ($divisi as $rows) {
												//penerimaan - penggunaan

												$awal = stok_awal_divisi($materiel, $rows->id, $dari, $sampai);

												$stok_awal = $awal['stok_awal_divisi'];
												//penerimaan
												$pcc_kirim = $awal['penerimaan_divisi'];
												//jumlah penggunaan
												$jml_distribusi = stok_keluar_by_month($rows->id, $dari, $sampai, $materiel);

												//sim baru
												$jml_6 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 2, $materiel);
												$jml_7 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 223, $materiel);
												$jml_8 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 3, $materiel);
												$jml_9 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 4, $materiel);
												$jml_10 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 225, $materiel);
												$jml_11 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 226, $materiel);
												$jml_12 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 5, $materiel);
												$jml_13 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 8, $materiel);
												$jml_14 = $jml_6 + $jml_7 + $jml_8 + $jml_9 + $jml_10 + $jml_11 + $jml_12 + $jml_13;
												//perpanjangan
												$jml_15 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 12, $materiel);
												$jml_16 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 224, $materiel);
												$jml_17 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 13, $materiel);
												$jml_18 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 14, $materiel);
												$jml_19 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 228, $materiel);
												$jml_20 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 227, $materiel);
												$jml_21 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 15, $materiel);
												$jml_22 = penggunaan_by_id_form('cc_terjual', $rows->id, $dari, $sampai, 18, $materiel);
												$jml_23 = $jml_15 + $jml_16 + $jml_17 + $jml_18 + $jml_19 + $jml_20 + $jml_21 + $jml_22;
												$jml_24 = $jml_14 + $jml_23;

												$penerimaan = $awal['penerimaan_divisi'];

												$sisa = $stok_awal + $penerimaan - $jml_24;

												$sum_stok += $stok_awal;
												$sum_penerimaan += $pcc_kirim;
												$sum_distribusi = $jml_distribusi;

												$sum_6   += $jml_6;
												$sum_7   += $jml_7;
												$sum_8   += $jml_8;
												$sum_9   += $jml_9;
												$sum_10  += $jml_10;
												$sum_11  += $jml_11;
												$sum_12  += $jml_12;
												$sum_13  += $jml_13;
												$sum_14  += $jml_14;
												$sum_15  += $jml_15;
												$sum_16  += $jml_16;
												$sum_17  += $jml_17;
												$sum_18  += $jml_18;
												$sum_19  += $jml_19;
												$sum_20  += $jml_20;
												$sum_21  += $jml_21;
												$sum_22  += $jml_22;
												$sum_23  += $jml_23;
												$sum_24  += $jml_24;

												$sum_sisa += $sisa;
											?>
												<tr>
													<td class="text-center align-middle border border-dark"><?= $no; ?></td>
													<td class="font-weight-bold border border-dark"><?= strtoupper($rows->nama_rekapan); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($stok_awal); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($penerimaan); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_distribusi); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_6); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_7); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_8); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_9); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_10); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_11); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_12); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_13); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_14); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_15); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_16); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_17); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_18); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_19); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_20); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_21); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_22); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_23); ?></td>
													<td class="text-right font-weight-bold border border-dark"><?= nomor($jml_24); ?></td>
													<td class="font-weight-bold border border-dark">&nbsp;</td>
													<td class="text-right font-weight-bold border border-dark"><?= rp($sisa); ?></td>
													<td class="font-weight-bold border border-dark">&nbsp;</td>
												</tr>
											<?php $no++;
											} ?>
										</tbody>
										<tfoot>
											<tr>
												<td class="text-center align-middle font-weight-bold border border-dark" colspan="2">JUMLAH</td>
												<td class="text-right font-weight-bold border border-dark"><?= rp($sum_stok + $stok_awal_gudang); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= rp($sum_penerimaan + $stok_penerimaan); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= rp($sum_distribusi + $stok_pengiriman); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_6); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_7); ?> </td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_8); ?> </td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_9); ?> </td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_10); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_11); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_12); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_13); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_14); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_15); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_16); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_17); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_18); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_19); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_20); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_21); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_22); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_23); ?></td>
												<td class="text-right font-weight-bold border border-dark"><?= nomor($sum_24); ?></td>
												<td class="font-weight-bold border border-dark">&nbsp;</td>
												<td class="text-right font-weight-bold border border-dark"><?= rp($sum_sisa + $sisa_stok); ?></td>
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
		});
	</script>

</body>

</html>