<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					<?=$menu;?>
				</div>
                <h2 class="page-title">
					Data Pemasukan
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
									<select name="kategori" id="kategori" class="form-select" onchange="searchData()">
										<!-- Options dynamically added here -->
									</select>
								</div>
							</div>
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Tanggal</div>
								<div class="mx-2 d-inline-block">
									<input type="text" name="daterange" id="filter-tanggal" class="form-control filter-tanggal" onchange="searchData();" />
								</div>
							</div>
							<div class="ms-auto text-muted">
								<div class="ms-2 d-inline-block">
									<div class="input-group">
										<span class="input-group-text">
											<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block" data-bs-toggle="tooltip" aria-label="Cari Data" title="Muat ulang" onclick="searchData();"><i class="ti ti-refresh fa-lg"></i>&nbsp;Refresh&nbsp;
											</a>|
											<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block cetak_laporan" data-bs-toggle="tooltip" aria-label="Cari Data" title="Cetak laporan" ><i class="ti ti-printer fa-lg"></i>&nbsp;Cetak
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

<div class="modal modal-blur fade" id="ModalCetak" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-status bg-danger"></div>
			<div class="modal-body text-center py-4">
				<!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
				<svg class="icons" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
				<h3>Pilih Format</h3>
				<form method="POST" id="formExport" action="/keuangan/cetak_pemasukan" target="_blank">
					<div class="mx-2 d-inline-block">
						<select name="pilihan" id="pilihan" class="form-control form-select w-100"style="width:150px!important">
							<option value="print">PRINT</option>
							<option value="export" >EXCEL</option>
						</select>
					</div>
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
	.icons {
	width: 50px;
	height: 50px;
    }
	
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
		jQuery(document).ready(function () {
			var week = moment().startOf('isoWeek');
			var start = moment().startOf("month");
			var end = moment();
			$('.filter-tanggal').daterangepicker({
				opens: 'right',
				ranges: {
					'Hari ini': [moment(), moment()],
					'Kemarin': [moment().subtract('days', 1), moment()],
					'Minggu Ini': [moment().startOf('isoWeek'), moment()],
					'7 Hari Terakhir': [moment().subtract('days', 6), moment()],
					'Bulan ini': [moment().startOf('month'), moment()],
					'Bulan sebelumnya': [moment().subtract('days', 29), moment()],
					'Tahun ini': [moment().startOf('year'), moment()],
					
				},
				"dateLimit": {
					"days": 365
				},
				showDropdowns: true,
				"linkedCalendars": false,
				"startDate": start,
				"endDate": end,
				"maxDate": end,
				locale: {
					customRangeLabel: 'Pilih Tanggal',
					format: 'DD/MM/YYYY',
					applyLabel: 'Pilih',
					separator: " - ",
					"monthNames": [
					"Januari",
					"Februari",
					"Maret",
					"April",
					"Mei",
					"Juni",
					"Juli",
					"Agustus",
					"September",
					"Oktober",
					"November",
					"Desember"
					],
				}
			},	function(startDate, endDate, label) 
			{
				start = startDate.format('DD-MM-YYYY');
				end = endDate.format('DD-MM-YYYY');
				
				
			})
		});
		searchData();
		function searchData(page_num)
		{
			
			page_num = page_num?page_num:0;
			var limit = $('#limits').val();
			var kategori = $('#kategori').val();
			var periode = $('#filter-tanggal').val();
			// var tahun = $('#tahun_akademik_filter').val();
			$.ajax({
				type: 'POST',
				url: base_url+'keuangan/ajax_list_pemasukan/'+page_num,
				data:{page:page_num,
					limit:limit,
					kategori:kategori,
					periode:periode
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
			var tahun = $('#tahun_akademik_filter').val();
			$('#tahun_cetak').val(tahun);
			
		});
		
		$(document).on('click','.cetak_data',function(e){
			$("#formExport").submit();
			
		});
		
		$(document).ready(function() {
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
			
		});
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$('#data-hapus').val($(e.relatedTarget).data('id'));
		});
		$(document).on('click','.hapus_data',function(e){
			var id = $("#data-hapus").val();
			$.ajax({
				url: base_url + 'keuangan/hapus_uang_masuk',
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
					searchData();
					
					$('body').loading('stop');　
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');　
				}
			});
		});	
	</script>
	
<?php } ?>	