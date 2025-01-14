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
							
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Status</div>
								<div class="mx-2 d-inline-block">
									<select name="kategori" id="kategori" class="form-select" onchange="searchData()">
										<!-- Options dynamically added here -->
									</select>
								</div>
							</div>
							
							<div class="ms-auto text-muted">
								<div class="ms-2 d-inline-block">
									<div class="input-group">
										<span class="input-group-text">
											<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block" data-bs-toggle="tooltip" aria-label="Cari Data" title="Muat ulang" onclick="searchData();"><i class="ti ti-refresh fa-lg"></i>&nbsp;
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
		
		searchData();
		function searchData(page_num)
		{
			
			page_num = page_num?page_num:0;
			var limit = $('#limits').val();
			var kategori = $('#kategori').val();
			$.ajax({
				type: 'POST',
				url: base_url+'keuangan/ajax_list_pemasukan/'+page_num,
				data:{page:page_num,
					limit:limit,
					kategori:kategori,
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
		
		$(document).ready(function() {
			// Ambil rekening untuk dropdown
			$.ajax({
				url: "<?php echo site_url('keuangan/get_kategori'); ?>",
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
		 
	</script>
	
<?php } ?>	