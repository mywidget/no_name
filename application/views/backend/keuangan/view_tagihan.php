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
						<div class="card-actions">
							<a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#OpenModal" aria-label="Tambah Unit" data-id="0" data-mod="add">
								<!-- Download SVG icon from http://tabler-icons.io/i/plus -->
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
									<select id="sortBy" class="form-control form-select w-1" onchange="searchBiaya()" style="width:85px!important">
										<option value="ASC">ASC</option>
										<option value="DESC" selected>DESC</option>
									</select>
								</div>
							</div>
							
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Status</div>
								<div class="mx-2 d-inline-block">
									<select id="sortBy" class="form-control form-select w-1" onchange="searchBiaya()" style="width:80px!important">
										<option value="" selected>PILIH</option>
										<option value="Y">Lunas</option>
										<option value="N" >Belum Lunas</option>
									</select>
								</div>
							</div>
							<div class="text-muted">
								<div class="mx-2 d-inline-block">
									<select id="tahun_akademik_filter" class="form-control form-select w-5" style="width:200px!important" onchange="searchBiaya()">
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

<div class="modal modal-blur fade" id="OpenModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Tambah Kuota</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="formAdd">
					<input type="hidden" class="form-control" id="id" name="id">
					<input type="hidden" class="form-control" id="type" name="type">
					<div class="card-block">
						<div class="form-group mb-1">
							<label class="form-label" for="title">Title</label>
							<input type="text" name="title" class="form-control" id="title" placeholder="Title" value="" required="" autocomplete="off">
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="nama">Nama</label>
							<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="" required="">
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="nomor">Nomor Whatsapp</label>
							<input type="text" name="nomor" class="form-control" id="nomor" placeholder="Nomor Whatsapp" value="" required="">
						</div>
						
						<div class="form-group mb-1">
							<label class="form-label" for="aktif">Aktif</label>
							<select name="aktif" id="aktif" class="form-control form-select">
								<option value="Ya">Ya</option>
								<option value="Tidak">Tidak</option>
							</select>
						</div>
						
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
				<button type="button" onClick="simpanData()" id="btn-data" class="btn btn-success">Submit</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalBayar" tabindex="-1" aria-labelledby="ModalBayarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalBayarLabel">BAYAR TAGIHAN #<span class="tinvoice"></span></h5>
			</div>
            <div class="modal-body">
                <form id="bayarForm">
                    <div class="mb-3 row">
                        <label for="kategori" class="col-4 col-form-label">JENIS PEMBAYARAN</label>
                        <div class="col-8">
                            <select name="kategori" id="kategori" class="form-select">
                                <!-- Options dynamically added here -->
							</select>
						</div>
					</div>
					<div class="mb-3 row">
                        <label for="rekening" class="col-4 col-form-label">PILIH REKENING</label>
                        <div class="col-8">
                            <select name="rekening" id="rekening" class="form-select">
                                <!-- Options dynamically added here -->
							</select>
						</div>
					</div>
                    <div class="mb-3 row">
                        <label for="lampiran" class="col-4 col-form-label">BUKTI TRANSFER</label>
                        <div class="col-8">
                            <input class="form-control" name="lampiran" id="lampiran" type="file" accept=".jpeg, .jpg, .png">
						</div>
					</div>
                    <div class="mb-3 row">
                        <label for="sisabayar" class="col-4 col-form-label">TOTAL TAGIHAN</label>
                        <div class="col-8">
                            <input id="sisabayar" name="sisabayar" type="text" class="form-control" readonly>
						</div>
					</div>
                    <div class="mb-3 row">
                        <label for="totalbyr" class="col-4 col-form-label">SISA TAGIHAN</label>
                        <div class="col-8">
                            <input id="totalbyr" name="totalbyr" type="text" class="form-control" value="0" readonly>
                            <input id="total_bayar" name="total_bayar" type="hidden" value="0">
						</div>
					</div>
                    <div class="mb-3 row">
                        <label for="uangm" class="col-4 col-form-label">JUMLAH BAYAR</label>
                        <div class="col-8">
                            <input id="uangm" name="uangm" type="text" class="form-control" onchange="inputan()">
						</div>
					</div>
                    <div class="mb-3 row">
                        <div class="col-12 load-bayar"></div>
					</div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="bayar_l" disabled>SIMPAN PEMBAYARAN</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
					</div>
				</form>
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
	
</style>

<?php $this->RenderScript[] = function() { ?>
	
	<script>
		
		searchData();
		function searchData(page_num)
		{
			
			page_num = page_num?page_num:0;
			var limit = $('#limits').val();
			var keywords = $('#keywords').val();
			$.ajax({
				type: 'POST',
				url: base_url+'keuangan/ajax_list/'+page_num,
				data:{page:page_num,
					limit:limit,
					keywords:keywords,
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
					$('body').loading('stop');
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
		$(document).ready(function() {
			$.ajax({
				url: "<?php echo base_url('psb/get_tahun_akademik'); ?>", // Ganti dengan URL untuk mengambil data tahun akademik
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
		});
		$('#ModalBayar').on('show.bs.modal', function(e) {
			var id = $(e.relatedTarget).data('id');
			var mod = $(e.relatedTarget).data('mod');
			$('input').val('');
			if(id != 0){
				$('#type').val('edit');
				$("#myModalLabel").html("Edit Panitia")
				$.ajax({
					type: 'POST',
					url: base_url + "keuangan/edit_data",
					data: {id:id,mod:mod},
					dataType: "json",
					beforeSend: function () {
						$("body").loading({zIndex:1060});
					},
					success: function(data) {
						$('#id').val(data.id);
						$('#title').val(data.title);
						$('#nama').val(data.nama);
						$('#nomor').val(data.nomor);
						$('#aktif').val(data.aktif);
						$('body').loading('stop');
					},
					error: function (xhr, ajaxOptions, thrownError) {
						sweet('Peringatan!!!',thrownError,'warning','warning');
						$('body').loading('stop');
					}
				});
				}else{
				
				$("#myModalLabel").html("Tambah Panitia")
				$('#type').val('new');
			}
			
		});
		
		
		function simpanData()
		{
			
			if($("#title").val()==''){
				$("#title").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#title").focus();
				return;
			}
			if($("#nama").val()==''){
				$("#nama").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#nama").focus();
				return;
			}
			if($("#nomor").val()==''){
				$("#nomor").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#nomor").focus();
				return;
			}
			
			var formData = $("#formAdd").serialize();
			$.ajax({
				type: "POST",
				url: base_url+"panitia/simpan_data",
				dataType: 'json',
				data: formData,
				beforeSend: function () {
					$("body").loading({zIndex:1060});　
				},
				success: function(data) {
					$('body').loading('stop');
					if(data.status==200){
						showNotif('bottom-right',data.title,data.msg,'success');
						$("#OpenModal").modal('hide');
						$('input').val('');
						}else{
						showNotif('bottom-right',data.title,data.msg,'error');
					}
					
					searchData();
					} ,error: function(xhr, status, error) {
					showNotif('bottom-right','Peringatan',error,'error');
					$('body').loading('stop');
				}
			});
		}
		
		$(document).on('click','.hapus_data',function(e){
			var id = $("#data-hapus").val();
			$.ajax({
				url: base_url + 'panitia/hapus_data',
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
					searchData();
					
					$('body').loading('stop');　
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');　
				}
			});
		});
		
		$(document).on('click','.clear',function(e){
			$("#keywords").val('');
			searchData();
		});
		
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$('#data-hapus').val($(e.relatedTarget).data('id'));
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
							rekening.append('<option value="' + item.id + '">' + item.title + '</option>');
						});
					}
				}
			});
			
			// AJAX save bayar
			$('#bayarForm').submit(function(e) {
				e.preventDefault();
				
				var formData = new FormData(this);
				$.ajax({
					url: "<?php echo site_url('keuangan/save_bayar'); ?>",
					type: "POST",
					data: formData,
					dataType: "json",
					processData: false,
					contentType: false,
					success: function(response) {
						if (response.status) {
							alert(response.message);
							$('#ModalBayar').modal('hide');
							} else {
							alert(response.message);
						}
					}
				});
			});
		});
	</script>
	
<?php } ?>	