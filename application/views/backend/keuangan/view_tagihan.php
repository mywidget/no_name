<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					<?=$menu;?>
				</div>
                <h2 class="page-title">
					Data Tagihan
				</h2>
			</div>
			<div class="col-12 col-md-auto ms-auto d-print-none">
				
			</div>
		</div>
	</div>
</div>
<div class="page-body">
	<div class="container-xl">
		<div class="row row-cards">
            <div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">List Data</h3>
						<!--div class="card-actions">
							<a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#OpenModal" aria-label="Tambah Unit" data-id="0" data-mod="add">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
							Tambah
							</a>
						</div-->
					</div>
					<div class="card-body">
						<div class="d-flex">
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Show</div>
								<div class="mx-2 d-inline-block">
									<select id="limits" name="limits" class="form-control form-select" style="width:70px!important" onchange="searchData()">
										<option value="10">10</option>
										<option value="20">20</option>
										<option value="50">50</option>
										<option value="100">100</option>
									</select>
								</div>
							</div> 
							
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Sort</div>
								<div class="mx-2 d-inline-block">
									<select id="sortBy" class="form-control form-select w-1" onchange="searchData()" style="width:85px!important">
										<option value="ASC">ASC</option>
										<option value="DESC" selected>DESC</option>
									</select>
								</div>
							</div>
							
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Status</div>
								<div class="mx-2 d-inline-block">
									<select id="status" class="form-control form-select w-1" onchange="searchData()" style="width:80px!important">
										<option value="" selected>PILIH</option>
										<option value="Y">Lunas</option>
										<option value="N" >Belum Lunas</option>
									</select>
								</div>
							</div>
							<div class="text-muted">
								<div class="mx-2 d-inline-block">
									<select id="tahun_akademik_filter" class="form-control form-select w-5" style="width:200px!important" onchange="searchData()">
										<option value="">Tahun Akademik</option>
									</select>
								</div>
							</div>
							
							<div class="ms-auto text-muted">
								<div class="d-none d-sm-inline-block">Search:</div>
								<div class="ms-2 d-inline-block">
									<div class="input-group">
										<input type="text" id="keywords" class="form-control w-40" placeholder="Cari Data" onkeyup="searchData();"/>
										<span class="input-group-text">
											<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block" data-bs-toggle="tooltip" aria-label="Cari Data" title="Cari Data" onclick="searchData();"><i class="ti ti-search fa-lg"></i>&nbsp;
											</a>
											<a href="#" class="link-secondary clear" data-bs-toggle="tooltip" aria-label="Clear Pencarian" title="Clear Pencarian">&nbsp;<i class="ti ti-x fa-lg"></i>&nbsp;|<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block cetak_laporan" data-bs-toggle="tooltip" aria-label="Cari Data" title="Cetak laporan" ><i class="ti ti-printer fa-lg"></i>&nbsp;Cetak
											</a>
											</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="table-responsive" id="posts_content">
					</div>
				</div><!-- /.card -->
			</div>
		</div>
	</div>
</div>

<div class="modal modal-blur fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-status bg-danger"></div>
			<div class="modal-body text-center py-4">
				<!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
				<svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
				<h3>Apa kamu yakin?</h3>
				<div class="text-muted">Apakah Anda benar-benar ingin menghapus data? Apa yang telah Anda lakukan tidak dapat dibatalkan.</div>
				<p class="debug-url"></p>
				<input type="hidden" id="data-hapus">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-danger hapus_data" type="button">YA</button> 
			</div>
		</div>
	</div>
</div>

<div class="modal modal-blur fade" id="confirm-hapus" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-status bg-danger"></div>
			<div class="modal-body text-center py-4">
				<!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
				<svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
				<h3>Apa kamu yakin?</h3>
				<div class="text-muted">Apakah Anda benar-benar ingin menghapus data? Apa yang telah Anda lakukan tidak dapat dibatalkan.</div>
				<p class="debug-url"></p>
				<input type="hidden" id="data-bayar">
				<input type="hidden" id="data-tagihan">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-danger hapus_bayar" type="button">YA</button> 
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalBayar" tabindex="-1" aria-labelledby="ModalBayarLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalBayarLabel">BAYAR TAGIHAN #<span class="tinvoice"></span></h5>
			</div>
            <div class="modal-body">
                <form id="bayarForm">
					<input id="id_tagihan" name="id_tagihan" type="hidden" class="form-control" readonly>
					<input id="id_siswa" name="id_siswa" type="hidden" class="form-control" readonly>
					<div class="mb-1 row">
                        <label for="tanggal_bayar" class="col-4 col-form-label">TANGGAL BAYAR</label>
                        <div class="col-8">
                            <input id="tanggal_bayar" name="tanggal_bayar" type="date" class="form-control">
						</div>
					</div>
                    <div class="mb-1 row">
                        <label for="kategori" class="col-4 col-form-label">JENIS PEMBAYARAN</label>
                        <div class="col-8">
                            <select name="kategori" id="kategori" class="form-select">
                                <!-- Options dynamically added here -->
							</select>
						</div>
					</div>
					<div class="mb-1 row">
                        <label for="rekening" class="col-4 col-form-label">PILIH REKENING</label>
                        <div class="col-8">
                            <select name="rekening" id="rekening" class="form-select">
                                <!-- Options dynamically added here -->
							</select>
						</div>
					</div>
                    <div class="mb-1 row">
                        <label for="lampiran" class="col-4 col-form-label">BUKTI TRANSFER</label>
                        <div class="col-8">
                            <input class="form-control" name="lampiran" id="lampiran" type="file" accept=".jpeg, .jpg, .png">
						</div>
					</div>
                    <div class="mb-1 row">
                        <label for="total_tagihan" class="col-4 col-form-label">TOTAL TAGIHAN</label>
                        <div class="col-8">
                            <input id="total_tagihan" name="total_tagihan" type="text" class="form-control" readonly>
						</div>
					</div>
                    <div class="mb-1 row">
                        <label for="total_dibayar" class="col-4 col-form-label">SUDAH DIBAYAR</label>
                        <div class="col-8">
                            <input id="total_dibayar" name="total_dibayar" type="text" class="form-control" readonly>
						</div>
					</div>
                    <div class="mb-1 row">
                        <label for="sisa_tagihan" class="col-4 col-form-label">SISA TAGIHAN</label>
                        <div class="col-8">
                            <input id="sisa_tagihan" name="sisa_tagihan" type="text" class="form-control" value="0" readonly>
						</div>
					</div>
                    <div class="mb-1 row">
                        <label for="jumlah_bayar" class="col-4 col-form-label">JUMLAH BAYAR</label>
                        <div class="col-8">
                            <input id="jumlah_bayar" name="jumlah_bayar" type="text" class="form-control rupiah">
						</div>
					</div>
                    <div class="mb-1 row">
                        <div class="col-12 load-bayar"></div>
					</div>
					
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" id="simpan_bayar" disabled>SIMPAN PEMBAYARAN</button>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">TUTUP</button>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="kirim-wa" tabindex="-1" aria-labelledby="ModalBayarLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalBayarLabel">KIRIM TAGIHAN #<span class="tinvoice"></span></h5>
			</div>
            <div class="modal-body">
                <form id="kirimForm">
					<input id="id-tagihan" name="id_tagihan" type="hidden" class="form-control" readonly>
					<input id="nomor-wa" name="nomor" type="hidden" class="form-control" readonly>
                    <div class="mb-1 row">
                        <label for="template" class="col-4 col-form-label">DEVICE</label>
                        <div class="col-8">
                            <select name="id_device" id="id_device" class="form-select">
                                <!-- Options dynamically added here -->
							</select>
						</div>
					</div>  
                    <div class="mb-1 row">
                        <label for="template" class="col-4 col-form-label">TEMPLATE PESAN</label>
                        <div class="col-8">
                            <select name="template" id="template" class="form-select">
                                <!-- Options dynamically added here -->
							</select>
						</div>
					</div>  
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary kirim_tagihan" id="kirim_tagihan">KIRIM TAGIHAN</button>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">TUTUP</button>
			</div>
		</div>
	</div>
</div>


<div class="modal modal-blur fade" id="ModalCetak" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-status bg-danger"></div>
			<div class="modal-body text-center py-4">
				<!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
				<svg class="icons" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
				<h3>Pilih Format</h3>
				<form method="POST" id="formExport" action="/keuangan/cetak_laporan_tagihan" target="_blank">
					<div class="mx-2 d-inline-block">
						<select name="pilihan" id="pilihan" class="form-control form-select w-100"style="width:150px!important">
							<option value="print">PRINT</option>
							<option value="export" >EXCEL</option>
						</select>
					</div>
					<input type="hidden" name="kategori_cetak" id="kategori_cetak">
					<input type="hidden" name="tahun_cetak" id="tahun_cetak">
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-bs-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-success cetak_data" id="pilih-format" type="button">Cetak</button> 
			</div>
		</div>
	</div>
</div>

<style>
	.select2-container {
	width: 100% !important;
	padding: 0;
	z-index:1050;
	}
	/* Tambahkan styling khusus untuk input di dalam SweetAlert */
	.swal2-content{z-index:1050}
	.swal2-input {
	width: 100%;
	padding: 10px;
	margin: 5px 0;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid #ccc;
	}
	input[readonly]
	{
    background-color:#ccc;
	}
	.modal-footer {
	border-top: 1px solid #dee2e6; /* Menambahkan garis pada bagian atas footer modal */
    }
</style>

<?php $this->RenderScript[] = function() { ?>
	
	<script>
		$(document).on('click','.cetak_data',function(e){
			$("#formExport").submit();
			
		});
		$(document).on('change','#pilihan',function(e){
			var id = $(this).val();
			if(id=='print')
			{
				$("#pilih-format").html('Cetak');
				}else{
				$("#pilih-format").html('Export');
			}
		});
		
		$(document).on('click','.cetak_laporan',function(e){
			$("#ModalCetak").modal('show');
			var kategori = $('#kategori').val();
			var tahun = $('#tahun_akademik_filter').val();
			$('#kategori_cetak').val(kategori);
			$('#tahun_cetak').val(tahun);
			
		});
		searchData();
		function searchData(page_num)
		{
			
			page_num = page_num?page_num:0;
			var limit = $('#limits').val();
			var status = $('#status').val();
			var keywords = $('#keywords').val();
			var kategori = $('#kategori').val();
			var tahun = $('#tahun_akademik_filter').val();
			$.ajax({
				type: 'POST',
				url: base_url+'keuangan/ajax_list/'+page_num,
				data:{page:page_num,
					limit:limit,
					status:status,
					keywords:keywords,
					kategori:kategori,
					tahun:tahun,
				},
				error: function (xhr, ajaxOptions, thrownError) {
					// Menangani error yang terjadi
					$('body').loading('stop');
					$('#ModalBayar').modal('hide');
					// Jika session kadaluarsa (misalnya server merespon dengan kode 401)
					if (xhr.status === 401 || xhr.status === 403) {
						// Menyembunyikan modal
						// Menampilkan alert dengan pesan session kadaluarsa
						alert_logout(base_url);
						} else {
						// Jika terjadi error selain session kadaluarsa
						sweet('Peringatan!!!',thrownError,'warning','warning');
					}
				},
				beforeSend: function(){
					$('body').loading();
				},
				success: function(html){
					$('#posts_content').html(html);
					$('body').loading('stop');
				}
			});
		}
		
		function load_bayar(id) {
			$.ajax({
				url: base_url+"keuangan/load_bayar",
				type: "POST",
				data: { id: id },
				dataType: "json",
				success: function(data) {
					var dropdown = $('.load-bayar');
					dropdown.empty(); // Kosongkan dropdown terlebih dahulu
					
					// Membuat header tabel
					var table = '<table class="table table-bordered">';
					table += '<thead><tr>';
					table += '<th scope="col" class="w-2">#</th>';
					table += '<th scope="col" class="w-20">Kategori</th>';
					table += '<th scope="col" class="w-20">Tanggal bayar</th>';
					table += '<th class="text-end w-20" scope="col">Sub Total</th>';
					table += '<th scope="col" class="text-center w-8">Aksi</th>';
					table += '</tr></thead>';
					table += '<tbody>';
					
					// Menambahkan baris tabel untuk setiap item dalam data
					$.each(data, function(index, item) {
						table += '<tr>';
						table += '<td class="pt-1 pb-1">' + (index + 1) + '</td>'; // Menampilkan urutan
						table += '<td class="pt-1 pb-1">' + item.kategori + '</td>'; // Mengisi tanggal
						table += '<td class="pt-1 pb-1">' + item.tanggal + '</td>'; // Mengisi tanggal
						table += '<td class="pt-1 pb-1 text-end">' + formatRupiah(item.jumlah_bayar )+ '</td>'; // Mengisi sub total
						table += '<td class="text-center pt-1 pb-1"><button type="button" class="btn btn-danger btn-sm" data-id="'+item.id_bayar_tagihan+'" data-tagihan="'+item.id_tagihan+'" data-bs-toggle="modal" data-bs-target="#confirm-hapus">Hapus</button></td>'; // Tombol aksi
						table += '</tr>';
					});
					
					table += '</tbody>';
					table += '</table>';
					
					// Menambahkan tabel ke dalam dropdown
					dropdown.append(table);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					// Menangani error yang terjadi
					$('body').loading('stop');
					// Jika session kadaluarsa (misalnya server merespon dengan kode 401)
					if (xhr.status === 401 || xhr.status === 403) {
						// Menyembunyikan modal
						// Menampilkan alert dengan pesan session kadaluarsa
						alert_logout(base_url);
						} else {
						// Jika terjadi error selain session kadaluarsa
						sweet('Peringatan!!!', thrownError, 'warning', 'warning');
					}
				}
			});
		}
		
		function load_modal(id) {
			$('#ModalBayar').modal('show');
			load_bayar(id);
			$.ajax({
				url: base_url+"keuangan/bayar_tagihan",
				type: "POST",
				data: { id: id },
				dataType: "json",
				beforeSend: function () {
					$("body").loading({zIndex:1060});
					$('#id_tagihan').val('');
					$('#total_tagihan').val('');
					$('#total_dibayar').val('');
					$('#sisa_tagihan').val('');
				},
				success: function(data) {
					if(data.status==true){
						$('#id_tagihan').val(data.id);
						$('#id_siswa').val(data.id_siswa);
						$('#total_tagihan').val(formatRupiah(data.total_tagihan));
						$('#total_dibayar').val(formatRupiah(data.total_dibayar));
						$('#sisa_tagihan').val(formatRupiah(data.sisa));
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					// Menangani error yang terjadi
					$('body').loading('stop');
					// Jika session kadaluarsa (misalnya server merespon dengan kode 401)
					if (xhr.status === 401 || xhr.status === 403) {
						// Menyembunyikan modal
						// Menampilkan alert dengan pesan session kadaluarsa
						alert_logout(base_url);
						} else {
						// Jika terjadi error selain session kadaluarsa
						sweet('Peringatan!!!', thrownError, 'warning', 'warning');
					}
				}
			});
		}
		
		$(document).on('click','.hapus_bayar',function(e){
			var id = $("#data-bayar").val();
			var tagihan = $("#data-tagihan").val();
			
			$.ajax({
				url: base_url + 'keuangan/hapus_bayar',
				data: {id:id,tagihan:tagihan},
				method: 'POST',
				dataType:'json',
				beforeSend: function () {
					$('body').loading();　
				},
				success: function(data) {
					if(data.status==true){
						showNotif('bottom-right',data.title,data.msg,'success');
						load_modal(data.id)
						}else{
						sweet('Peringatan!!!',data.msg,'warning','warning');
					}
					$('#confirm-hapus').modal('hide');
					searchData();
					
					$('body').loading('stop');　
					},error: function (xhr, ajaxOptions, thrownError) {
					// Menangani error yang terjadi
					$('body').loading('stop');
					$('#confirm-hapus').modal('hide');
					// Jika session kadaluarsa (misalnya server merespon dengan kode 401)
					if (xhr.status === 401 || xhr.status === 403) {
						// Menyembunyikan modal
						// Menampilkan alert dengan pesan session kadaluarsa
						alert_logout(base_url);
						} else {
						// Jika terjadi error selain session kadaluarsa
						sweet('Peringatan!!!',thrownError,'warning','warning');
					}
				}
			});
		});
		
		
		$('#ModalBayar').on('show.bs.modal', function(e) {
			var id = $(e.relatedTarget).data('id');
			var mod = $(e.relatedTarget).data('mod');
			$('input').val('');
			
			if(id != 0){
				$('#type').val('edit');
				$("#myModalLabel").html("Edit Panitia");
				$.ajax({
					type: 'POST',
					url: base_url + "keuangan/bayar_tagihan",
					data: {id: id, mod: mod},
					dataType: "json",
					beforeSend: function () {
						$("body").loading({zIndex:1060});
						$('#kategori').val('');
						$('#rekening').val('');
						$('#id_tagihan').val('');
						$('#total_tagihan').val('');
						$('#total_dibayar').val('');
						$('#sisa_tagihan').val('');
					},
					success: function(data) {
						load_bayar(data.id)
						// Jika data diterima dengan sukses
						$('#id_tagihan').val(data.id);
						$('#id_siswa').val(data.id_siswa);
						$('#total_tagihan').val(formatRupiah(data.total_tagihan));
						$('#total_dibayar').val(formatRupiah(data.total_dibayar));
						$('#sisa_tagihan').val(formatRupiah(data.sisa));
						$('body').loading('stop');
					},
					error: function (xhr, ajaxOptions, thrownError) {
						// Menangani error yang terjadi
						$('body').loading('stop');
						$('#ModalBayar').modal('hide');
						// Jika session kadaluarsa (misalnya server merespon dengan kode 401)
						if (xhr.status === 401 || xhr.status === 403) {
							// Menyembunyikan modal
							// Menampilkan alert dengan pesan session kadaluarsa
							alert_logout(base_url);
							} else {
							// Jika terjadi error selain session kadaluarsa
							sweet('Peringatan!!!',thrownError,'warning','warning');
						}
					}
				});
				} else {
				$("#myModalLabel").html("Tambah Panitia");
				$('#type').val('new');
			}
		});
		
		
		$(document).on('click','.hapus_data',function(e){
			var id = $("#data-hapus").val();
			$.ajax({
				url: base_url + 'keuangan/hapus_data',
				data: {id:id},
				method: 'POST',
				dataType:'json',
				beforeSend: function () {
					$('body').loading();　
				},
				success: function(data) {
					$('#confirm-delete').modal('hide');
					if(data.status==true){
						showNotif('bottom-right',data.title,data.msg,'success');
						
						}else{
						sweet('Peringatan!!!',data.msg,'warning','warning');
					}
					// searchData();
					
					$('body').loading('stop');　
					},error: function (xhr, ajaxOptions, thrownError) {
					// Menangani error yang terjadi
					$('body').loading('stop');
					$('#confirm-delete').modal('hide');
					// Jika session kadaluarsa (misalnya server merespon dengan kode 401)
					if (xhr.status === 401 || xhr.status === 403) {
						// Menyembunyikan modal
						// Menampilkan alert dengan pesan session kadaluarsa
						alert_logout(base_url);
						} else {
						// Jika terjadi error selain session kadaluarsa
						sweet('Peringatan!!!',thrownError,'warning','warning');
					}
				}
			});
		});
		
		$(document).on('click','.kirim_tagihan',function(e){
			var id = $("#id-tagihan").val();
			$.ajax({
				url: base_url + 'keuangan/kirim_tagihan',
				data: $('#kirimForm').serialize(),
				method: 'POST',
				dataType:'json',
				beforeSend: function () {
					$('body').loading();　
				},
				success: function(data) {
					$('#kirim-wa').modal('hide');
					if(data.status==true){
						showNotif('bottom-right',data.title,data.msg,'success');
						
						}else{
						sweet('Peringatan!!!',data.msg,'warning','warning');
					}
					// searchData();
					
					$('body').loading('stop');　
					},error: function (xhr, ajaxOptions, thrownError) {
					// Menangani error yang terjadi
					$('body').loading('stop');
					$('#confirm-delete').modal('hide');
					// Jika session kadaluarsa (misalnya server merespon dengan kode 401)
					if (xhr.status === 401 || xhr.status === 403) {
						// Menyembunyikan modal
						// Menampilkan alert dengan pesan session kadaluarsa
						alert_logout(base_url);
						} else {
						// Jika terjadi error selain session kadaluarsa
						sweet('Peringatan!!!',thrownError,'warning','warning');
					}
				}
			});
		});
		
		$(document).on('click','.clear',function(e){
			$("#keywords").val('');
			searchData();
		});
		
		$(document).on('click','#simpan_bayar',function(e){
			$("#bayarForm").submit();
		});
		
		$('#confirm-hapus').on('show.bs.modal', function(e) {
			$('#data-bayar').val($(e.relatedTarget).data('id'));
			$('#data-tagihan').val($(e.relatedTarget).data('tagihan'));
		});
		
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$('#data-hapus').val($(e.relatedTarget).data('id'));
		});
		
		$('#kirim-wa').on('show.bs.modal', function(e) {
			get_template();
			get_device();
			$('#id-tagihan').val($(e.relatedTarget).data('id'));
			$('#nomor-wa').val($(e.relatedTarget).data('nomor'));
		});
		
		function get_device()
		{
			$.ajax({
				url: base_url+"keuangan/get_device",
				method: "GET",
				dataType: "json",
				success: function(data) {
					if (data) {
						var rekening = $('#id_device');
						rekening.empty();
						rekening.append('<option value="">Pilih device</option>');
						$.each(data, function(index, item) {
							rekening.append('<option value="' + item.id + '">' + item.device + '</option>');
						});
					}
				}
			});
		}
		function get_template()
		{
			$.ajax({
				url: base_url+"keuangan/get_template",
				method: "GET",
				dataType: "json",
				success: function(data) {
					if (data) {
						var template = $('#template');
						template.empty();
						template.append('<option value="">Pilih template</option>');
						$.each(data, function(index, item) {
							template.append('<option value="' + item.id + '">' + item.title + '</option>');
						});
					}
				}
			});
		}
		
		$(document).ready(function() {
			// Ambil rekening untuk dropdown
			$.ajax({
				url: base_url+"keuangan/get_kategori",
				method: "GET",
				dataType: "json",
				success: function(data) {
					if (data) {
						var rekening = $('#kategori');
						rekening.empty();
						rekening.append('<option value="">Pilih kategori</option>');
						$.each(data, function(index, item) {
							rekening.append('<option value="' + item.id_kategori + '">' + item.title + '</option>');
						});
					}
				}
			});
			
			$.ajax({
				url: base_url+ 'psb/get_tahun_akademik',  
				type: "GET",
				dataType: "json",
				success: function(data) {
					var dropdown = $('#tahun_akademik_filter');
					dropdown.empty(); // Kosongkan dropdown terlebih dahulu
					dropdown.append('<option value="">Pilih Tahun Akademik</option>'); // Option default
					
					$.each(data, function(index, item) {
						dropdown.append('<option value="' + item.id_tahun_akademik + '">' + item.nama_tahun + '</option>');
					});
				}
			});
			
			
			// Ambil rekening untuk dropdown
			$.ajax({
				url: "<?php echo site_url('keuangan/get_rekening'); ?>",
				method: "GET",
				dataType: "json",
				success: function(data) {
					if (data) {
						var rekening = $('#rekening');
						rekening.empty();
						rekening.append('<option value="">Pilih Rekening</option>');
						$.each(data, function(index, item) {
							rekening.append('<option value="' + item.id_rekening + '">' + item.title + '</option>');
						});
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					// Menangani error yang terjadi
					$('body').loading('stop');
					// $('#ModalBayar').modal('hide');
					// Jika session kadaluarsa (misalnya server merespon dengan kode 401)
					if (xhr.status === 401 || xhr.status === 403) {
						// Menyembunyikan modal
						// Menampilkan alert dengan pesan session kadaluarsa
						alert_logout(base_url);
						} else {
						// Jika terjadi error selain session kadaluarsa
						sweet('Peringatan!!!',thrownError,'warning','warning');
					}
				}
			});
			
			// AJAX save bayar
			$('#bayarForm').submit(function(e) {
				e.preventDefault();
				
				var formData = new FormData(this);
				$.ajax({
					url: base_url+"keuangan/save_bayar",
					type: "POST",
					data: formData,
					dataType: "json",
					processData: false,
					contentType: false,
					success: function(response) {
						if (response.status) {
							sweet('Notifikasi!!!',response.message,'success','success');
							$('#ModalBayar').modal('hide');
							searchData();
							} else {
							sweet('Peringatan!!!',response.message,'warning','warning');
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						// Menangani error yang terjadi
						$('body').loading('stop');
						$('#ModalBayar').modal('hide');
						// Jika session kadaluarsa (misalnya server merespon dengan kode 401)
						if (xhr.status === 401 || xhr.status === 403) {
							// Menyembunyikan modal
							// Menampilkan alert dengan pesan session kadaluarsa
							alert_logout(base_url);
							} else {
							// Jika terjadi error selain session kadaluarsa
							sweet('Peringatan!!!',thrownError,'warning','warning');
						}
					}
				});
			});
		});
		
		$(document).ready(function() {
			// Fungsi untuk memeriksa status tombol simpan_bayar
			function checkFormStatus() {
				var kategoriSelected = $('#kategori').val();
				var rekeningSelected = $('#rekening').val();
				var jumlah_bayar = angka($('#jumlah_bayar').val());
				
				// Jika kategori dan rekening keduanya terpilih, aktifkan tombol simpan_bayar
				if (kategoriSelected && rekeningSelected && jumlah_bayar > 0) {
					$('#simpan_bayar').prop('disabled', false); // Aktifkan tombol simpan_bayar
					} else {
					$('#simpan_bayar').prop('disabled', true); // Nonaktifkan tombol simpan_bayar
				}
			}
			
			// Event listener untuk kategori select change
			$('#kategori').on('change', function() {
				checkFormStatus(); // Memeriksa apakah tombol simpan_bayar harus diaktifkan
			});
			
			// Event listener untuk rekening select change
			$('#rekening').on('change', function() {
				checkFormStatus(); // Memeriksa apakah tombol simpan_bayar harus diaktifkan
			});
			
			$('#jumlah_bayar').on('keyup', function() {
				checkFormStatus(); // Memeriksa apakah tombol simpan_bayar harus diaktifkan
			});
			
			// Inisialisasi status tombol saat halaman pertama kali dimuat
			checkFormStatus();
			// Menghitung sisa tagihan setiap kali ada input di #jumlah_bayar
			$('#jumlah_bayar').on('keyup', function() {
				// Mendapatkan nilai total tagihan dan jumlah bayar
				var totalTagihan = angka($('#total_tagihan').val()) || 0;
				var total_dibayar = angka($('#total_dibayar').val()) || 0;
				var jumlahBayar = angka($(this).val()) || 0;
				
				
				// Validasi agar jumlah bayar tidak melebihi total tagihan
				if (parseInt(jumlahBayar) > parseInt(totalTagihan)) {
					jumlahBayar = totalTagihan-total_dibayar;  // Membatasi jumlah bayar agar tidak melebihi total tagihan
					$(this).val(formatRupiah(jumlahBayar));   // Update nilai input jumlah bayar
				}
				// Menghitung sisa tagihan
				var sisaTagihan = totalTagihan - jumlahBayar - total_dibayar;
				// console.log(sisaTagihan)
				// Update sisa tagihan
				$('#sisa_tagihan').val(formatRupiah(sisaTagihan));  // Menampilkan sisa tagihan dengan 2 desimal
			});
			$('#jumlah_bayar').on('keyup', function() {
				var value = $(this).val();
				
				// Menghapus angka 0 yang ada di depan
				var newValue = value.replace(/^0+/, '');
				
				
				// Update nilai input jika ada perubahan
				$(this).val(newValue);
			});
		});
		
	</script>
	
<?php } ?>	