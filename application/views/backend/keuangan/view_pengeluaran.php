<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					<?=$menu;?>
				</div>
                <h2 class="page-title">
					Data Pengeluaran
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
						<div class="card-actions">
							<a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm" aria-label="Tambah Unit" data-id="0" data-mod="add">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
								Tambah
							</a>
							
						</div>
					</div>
					<div class="card-body">
						<div class="d-flex">
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Show</div>
								<div class="mx-2 d-inline-block">
									<select id="limits" name="limits" class="form-control form-select" style="width:70px!important" onchange="searchData()">
										<option value="5">5</option>
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
							
							<div class="ms-auto text-muted">
								<div class="d-none d-sm-inline-block">Search:</div>
								<div class="ms-2 d-inline-block">
									<div class="input-group">
										<input type="text" id="keywords" class="form-control w-40" placeholder="Cari Data" onkeyup="searchData();"/>
										<span class="input-group-text">
											<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block" data-bs-toggle="tooltip" aria-label="Cari Data" title="Cari Data" onclick="searchData();"><i class="ti ti-search fa-lg"></i>&nbsp;
											</a>
											<a href="#" class="link-secondary clear" data-bs-toggle="tooltip" aria-label="Clear Pencarian" title="Clear Pencarian">&nbsp;<i class="ti ti-x fa-lg"></i>&nbsp;
											</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="pb-2" id="posts_content">
					</div>
				</div><!-- /.card -->
			</div>
		</div>
	</div>
</div>
<!-- Modal for Input Pengeluaran -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalFormLabel">Form Input Pengeluaran</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- Form -->
				<form id="formPengeluaran">
					<div class="mb-1">
						<label for="tanggal" class="form-label">TANGGAL</label>
						<input type="date" name="tanggal" id="tanggal" class="form-control">
						<div class="invalid-feedback" id="errorTanggal"></div>
						<input type="hidden" name="id" id="id_pengeluaran" class="form-control">
						<input type="hidden" name="tipe" id="tipe" class="form-control">
					</div>
					<div class="mb-1">
                        <label for="kategori" class="col-form-label">DARI KAS</label>
						<select name="kategori" id="kategori" class="form-select">
							<!-- Options dynamically added here -->
						</select>
					</div>
					<div class="mb-1">
						<label for="keterangan" class="form-label">KETERANGAN</label>
						<input type="text" name="keterangan" id="keterangan" class="form-control">
						<div class="invalid-feedback" id="errorKeterangan"></div>
					</div>
					<div class="mb-1">
						<label for="jumlah" class="form-label">JUMLAH</label>
						<input type="text" name="jumlah" id="jumlah" class="form-control rupiah" step="0.01">
						<div class="invalid-feedback" id="errorJumlah"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" id="simpan_pengeluaran">SIMPAN</button>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">TUTUP</button>
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
	.table tfoot td {
	color: var(--tblr-muted);
	background: var(--tblr-gray-50);
	font-size: .625rem;
	font-weight: var(--tblr-font-weight-bold);
	text-transform: uppercase;
	letter-spacing: .04em;
	line-height: 1rem;
	color: var(--tblr-muted);
	padding-top: .5rem;
	padding-bottom: .5rem;
	white-space: nowrap;
	}
	</style>
	
	<?php $this->RenderScript[] = function() { ?>
		
		<script>
			
			searchData();
			function searchData(page_num)
			{
				
				page_num = page_num?page_num:0;
				var limit = $('#limits').val();
				$.ajax({
					type: 'POST',
					url: base_url+'keuangan/ajax_list_pengeluaran/'+page_num,
					data:{page:page_num,
						limit:limit
					},
					error: function (xhr, ajaxOptions, thrownError) {
						// Menangani error yang terjadi
						$('body').loading('stop');
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
			
			$(document).on('click','.clear',function(e){
				$("#keywords").val('');
				searchData();
			});
			
			$(document).ready(function () {
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
				$(document).on('click','#simpan_pengeluaran',function(e){
					$("#formPengeluaran").submit();
				});
				// Menangani submit form pengeluaran dengan AJAX
				$('#formPengeluaran').on('submit', function (e) {
					e.preventDefault(); // Mencegah reload halaman
					
					// Menjaga agar form tidak mengirimkan data ganda
					var formData = new FormData(this);
					
					$.ajax({
						url: base_url+"keuangan/save_pengeluaran",
						type: 'POST',
						data: formData,
						dataType: 'json',
						processData: false,
						contentType: false,
						success: function (response) {
							if (response.status === 'success') {
								// Menampilkan pesan sukses
								sweet('Berhasil!!!', response.message, 'success', 'success');
								searchData();
								$('#modalForm').modal('hide');
								$('#formPengeluaran')[0].reset();
								} else {
								sweet('Peringatan!!!', response.message, 'warning', 'warning');
								
							}
							
							},error: function (xhr, ajaxOptions, thrownError) {
							// Menangani error yang terjadi
							$('body').loading('stop');
							$('#modalForm').modal('hide');
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
			$(document).on('click','.edit_pengeluaran',function(){
				var id = $(this).data('id');
				$.ajax({
					url: base_url+"keuangan/edit_pengeluaran",
					type: "POST",
					data :{id:id},
					dataType: "json",
					success: function(data) {
						$('#modalForm').modal('show');
						$('#id_pengeluaran').val(data.id);
						$('#tanggal').val(data.tanggal);
						$('#kategori').val(data.id_kategori);
						$('#keterangan').val(data.keterangan);
						$('#jumlah').val(formatRupiah(data.jumlah));
						$('#biayaModalLabel').text('Form Edit Pengeluaran');
					}
				});
			});
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$('#data-hapus').val($(e.relatedTarget).data('id'));
			});
			$(document).on('click','.hapus_data',function(e){
				var id = $("#data-hapus").val();
				$.ajax({
					url: base_url + 'keuangan/hapus_pengeluaran',
					data: {id:id},
					method: 'POST',
					dataType:'json',
					beforeSend: function () {
						$('body').loading();　
					},
					success: function(data) {
						$('#confirm-delete').modal('hide');
						if(data.status==true){
							showNotif('bottom-right',data.title,data.message,'success');
							}else{
							sweet('Peringatan!!!',data.message,'warning','warning');
						}
						searchBiaya();
						
						$('body').loading('stop');　
						},error: function(xhr, status, error) {
						showNotif('bottom-right','Update',error,'error');
						$('body').loading('stop');　
					}
				});
			});	
		</script>
		
	<?php } ?>			