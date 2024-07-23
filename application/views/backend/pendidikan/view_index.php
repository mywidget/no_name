<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Master Data
				</div>
                <h2 class="page-title">
					Data Pendidikan & Pekerjaan
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
            <div class="col-6">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">List Data Pendidikan</h3>
					</div>
					<div class="card-body">
						<div class="d-flex">
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Show</div>
								<div class="mx-2 d-inline-block">
									<select id="limits" name="limits" class="form-control form-select" style="width:70px!important" onchange="searchPendidikan()">
										<option value="10">10</option>
										<option value="20">20</option>
										<option value="50">50</option>
										<option value="100">100</option>
									</select>
								</div>
								
							</div> 
							<div class="ms-auto text-muted">
								<div class="d-none d-sm-inline-block">Search:</div>
								<div class="ms-2 d-inline-block">
									<div class="input-group">
										<input type="text" id="keywords" class="form-control w-40" placeholder="Cari Data" onkeyup="searchPendidikan();"/>
										<span class="input-group-text">
											<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block" data-bs-toggle="tooltip" aria-label="Cari Data" title="Cari Data" onclick="searchPendidikan();"><i class="ti ti-search fa-lg"></i>&nbsp;
											</a>
											<a href="#" class="link-secondary clear_unit" data-bs-toggle="tooltip" aria-label="Clear Pencarian" title="Clear search">&nbsp;<i class="ti ti-x fa-lg"></i>&nbsp;
											</a>
											<a href="#" class="link-secondary" data-bs-toggle="modal" data-bs-target="#OpenModalPendidikan" aria-label="Tambah Data" data-id="0" data-mod="add">
												&nbsp;<i class="ti ti-plus fa-lg" data-bs-toggle="tooltip" title="Tambah Data"></i>
											</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="pb-2" id="posts_content_pendidikan">
					</div>
				</div><!-- /.card -->
			</div>
            <div class="col-6">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">List Data pekerjaan</h3>
					</div>
					<div class="card-body">
						<div class="d-flex">
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Show</div>
								<div class="mx-2 d-inline-block">
									<select id="limit_pekerjaan" name="limits" class="form-control form-select" style="width:70px!important" onchange="searchPekerjaan()">
										<option value="10">10</option>
										<option value="20">20</option>
										<option value="50">50</option>
										<option value="100">100</option>
									</select>
								</div>
							</div> 
							
							<div class="ms-auto text-muted">
								<div class="d-none d-sm-inline-block">Search:</div>
								<div class="ms-2 d-inline-block">
									<div class="input-group">
										<input type="text" id="keywords_pekerjaan" class="form-control w-20" placeholder="Cari Data" onkeyup="searchPekerjaan();" />
										<span class="input-group-text">
											<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block" data-bs-toggle="tooltip" aria-label="Cari Data" title="Cari Data" onclick="searchPekerjaan();"><i class="ti ti-search fa-lg"></i>&nbsp;
											</a>
											<a href="#" class="link-secondary clear_pekerjaan" data-bs-toggle="tooltip" aria-label="Clear Pencarian" title="Clear Pencarian">&nbsp;<i class="ti ti-x fa-lg"></i>&nbsp;
											</a>
											<a href="#" class="link-secondary" data-bs-toggle="modal" data-bs-target="#OpenModalPekerjaan" aria-label="Tambah Data" data-id="0" data-mod="add" >
												&nbsp;<i class="ti ti-plus fa-lg" data-bs-toggle="tooltip" title="Tambah Data"></i>
											</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="pb-2" id="posts_content_pekerjaan">
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
				<button class="btn btn-danger hapus_pendidikan" type="button">YA</button> 
			</div>
		</div>
	</div>
</div>

<div class="modal modal-blur fade" id="OpenModalPendidikan" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabelPendidikan">Tambah Pendidikan</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="formAdd" method="POST">
					<input type="hidden" class="form-control" id="id_pendidikan" name="id_pendidikan">
					<input type="hidden" class="form-control" id="type_pendidikan" name="type_pendidikan">
					<div class="card-block">
						<div class="form-group mb-1">
							<label class="form-label" for="title_pendidikan">Pendidikan Terakhir</label>
							<input type="text" name="title_pendidikan" value="" class="form-control" id="title_pendidikan" placeholder="Pendidikan Terakhir" required="" autofocus>
						</div>
						
						<div class="form-group mb-1">
							<label class="form-label" for="aktif_pendidikan">Aktif</label>
							<select name="aktif_pendidikan" id="aktif_pendidikan" class="form-control form-select">
								<option value="">Pilih</option>
								<option value="Ya" selected>Ya</option>
								<option value="Tidak">Tidak</option>
							</select>
						</div>
						
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
				<button type="button" id="btn-unit" class="btn btn-success simpanPendidikan">Submit</button>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-blur fade" id="OpenModalPekerjaan" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabelpekerjaan">Tambah pekerjaan</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="formAddpekerjaan" method="POST">
					<input type="hidden" class="form-control" id="id_pekerjaan" name="id_pekerjaan">
					<input type="hidden" class="form-control" id="type_pekerjaan" name="type_pekerjaan">
					<div class="card-block">
						<div class="form-group mb-1">
							<label class="form-label" for="title_pekerjaan">Pekerjaan</label>
							<input type="text" name="title_pekerjaan" value="" class="form-control" id="title_pekerjaan" placeholder="pekerjaan" required="">
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="aktif_pekerjaan">Aktif</label>
							<select name="aktif_pekerjaan" id="aktif_pekerjaan" class="form-control form-select">
								<option value="">Pilih</option>
								<option value="Ya" selected>Ya</option>
								<option value="Tidak">Tidak</option>
							</select>
						</div>
						
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
				<button type="button" id="btn-pekerjaan" class="btn btn-success simpanPekerjaan">Submit</button>
			</div>
		</div>
	</div>
</div>


<div class="modal modal-blur fade" id="confirm-delete-pekerjaan" tabindex="-1" role="dialog" aria-hidden="true">
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
				<input type="hidden" id="data-pekerjaan">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-danger hapus_pekerjaan" type="button">YA</button> 
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
<?php
	$this->RenderScript[] = function() {
	?>
	<script>
		$(document).ready(function () {
			shortcut.add("F1",function() {
				$("#OpenModalPendidikan").modal('show');
				$('#type_pendidikan').val('new');
				greet();
				
			});
			shortcut.add("F2",function() {
				$("#OpenModalPekerjaan").modal('show');
				$('#type_pekerjaan').val('new');
				greetp();
			});
		});
		$("#formAdd").on("keypress", function (event) { 
			console.log("aaya"); 
			var keyPressed = event.keyCode || event.which; 
			if (keyPressed === 13) { 
				event.preventDefault(); 
                // return false; 
				$(".simpanPendidikan").click()
			} 
		}); 
		
		$("#formAddpekerjaan").on("keypress", function (event) { 
			console.log("aaya"); 
			var keyPressed = event.keyCode || event.which; 
			if (keyPressed === 13) { 
				event.preventDefault(); 
                // return false; 
				$(".simpanPekerjaan").click()
			} 
		}); 
		
		searchPendidikan();
		function searchPendidikan(page_num){
			page_num = page_num?page_num:0;
			var limit = $('#limits').val();
			var keywords = $('#keywords').val();
			$.ajax({
				type: 'POST',
				url: base_url+'psb/ajax_list_pendidikan/'+page_num,
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
					$('#posts_content_pendidikan').html(html);
					$('body').loading('stop');
				}
			});
		}
		function greet() {
			setTimeout(function () {
				$('#title_pendidikan').focus();
			}, 1000);
		}
		function greetp() {
			setTimeout(function () {
				$('#title_pekerjaan').focus();
			}, 1000);
		}
		
		$('#OpenModalPendidikan').on('show.bs.modal', function(e) {
			var id = $(e.relatedTarget).data('id');
			var mod = $(e.relatedTarget).data('mod');
			$('input').val('');
			if(id != 0){
				$('#type_pendidikan').val('edit');
				$("#myModalLabelPendidikan").html("Edit pendidikan")
				$.ajax({
					type: 'POST',
					url: base_url + "psb/edit_pendidikan",
					data: {id:id,mod:mod},
					dataType: "json",
					beforeSend: function () {
						$("body").loading({zIndex:1060});
					},
					success: function(data) {
						$('#id_pendidikan').val(data.id);
						$('#title_pendidikan').val(data.title);
						$('#aktif_pendidikan').val(data.aktif);
						$('body').loading('stop');
					},
					error: function (xhr, ajaxOptions, thrownError) {
						sweet('Peringatan!!!',thrownError,'warning','warning');
						$('body').loading('stop');
					}
				});
				}else{
				
				$("#myModalLabelPendidikan").html("Tambah Pendidikan")
				$('#type_pendidikan').val('new');
				greet();
			}
			
		});
		
		
		
		$(document).on('click','.simpanPendidikan',function(e){
			// console.log('submit');
			if($("#title_pendidikan").val()==''){
				$("#title_pendidikan").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#title_pendidikan").focus();
				return;
			}
			if($("#aktif_pendidikan").val()==''){
				$("#aktif_pendidikan").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus dipilih','warning');
				$("#aktif_pendidikan").focus();
				return;
			}
			
			
			var formData = $("#formAdd").serialize();
			$.ajax({
				type: "POST",
				url: base_url+"psb/simpan_pendidikan",
				dataType: 'json',
				data: formData,
				beforeSend: function () {
					$("body").loading({zIndex:1060});　
				},
				success: function(data) {
					$('body').loading('stop');
					if(data.status==200){
						showNotif('bottom-right',data.title,data.msg,'success');
						$("#OpenModalPendidikan").modal('hide');
						$('input').val('');
						}else{
						showNotif('bottom-right',data.title,data.msg,'error');
					}
					
					searchPendidikan();
					} ,error: function(xhr, status, error) {
					showNotif('bottom-right','Peringatan',error,'error');
					$('body').loading('stop');
				}
			});
		});
		
		$(document).on('click','.hapus_pendidikan',function(e){
			var id = $("#data-hapus").val();
			$.ajax({
				url: base_url + 'psb/hapus_pendidikan',
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
					searchPendidikan();
					
					$('body').loading('stop');　
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');　
				}
			});
		});
		
		$(document).on('click','.clear_unit',function(e){
			$("#keywords").val('');
			searchPendidikan();
		});
		
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$('#data-hapus').val($(e.relatedTarget).data('id'));
		});
		
		searchPekerjaan();
		function searchPekerjaan(page_num){
			page_num = page_num?page_num:0;
			var limit = $('#limit_pekerjaan').val();
			var keywords = $('#keywords_pekerjaan').val();
			$.ajax({
				type: 'POST',
				url: base_url+'psb/ajax_list_pekerjaan/'+page_num,
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
					$('#posts_content_pekerjaan').html(html);
					$('body').loading('stop');
				}
			});
		}
		
		
		$('#OpenModalPekerjaan').on('show.bs.modal', function(e) {
			var id = $(e.relatedTarget).data('id');
			var mod = $(e.relatedTarget).data('mod');
			$('input').val('');
			if(id != 0){
				$('#type_pekerjaan').val('edit');
				$("#myModalLabelpekerjaan").html("Edit pekerjaan")
				$.ajax({
					type: 'POST',
					url: base_url + "psb/edit_pekerjaan",
					data: {id:id,mod:mod},
					dataType: "json",
					beforeSend: function () {
						$("body").loading({zIndex:1060});
					},
					success: function(data) {
						$('#id_pekerjaan').val(data.id);
						$('#kode_pekerjaan').val(data.kode);
						$('#nama_pekerjaan').val(data.nama);
						$('#unit_pekerjaan').val(data.unit);
						$('#aktif_pekerjaan').val(data.aktif);
						$('body').loading('stop');
					},
					error: function (xhr, ajaxOptions, thrownError) {
						sweet('Peringatan!!!',thrownError,'warning','warning');
						$('body').loading('stop');
					}
				});
				}else{
				
				$("#myModalLabelPendidikan").html("Tambah Unit")
				$('#type_pekerjaan').val('new');
				
				greetp();
			}
			
		});
		
		$(document).on('click','.simpanPekerjaan',function(e){
			// console.log('submit');
			if($("#title_pekerjaan").val()==''){
				$("#title_pekerjaan").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#title_pekerjaan").focus();
				return;
			}
			if($("#aktif_pekerjaan").val()==''){
				$("#aktif_pekerjaan").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus dipilih','warning');
				$("#aktif_pekerjaan").focus();
				return;
			}
			
			var formData = $("#formAddpekerjaan").serialize();
			$.ajax({
				type: "POST",
				url: base_url+"psb/simpan_pekerjaan",
				dataType: 'json',
				data: formData,
				beforeSend: function () {
					$("body").loading({zIndex:1060});　
				},
				success: function(data) {
					$('body').loading('stop');
					if(data.status==200){
						showNotif('bottom-right',data.title,data.msg,'success');
						$("#OpenModalPekerjaan").modal('hide');
						$('input').val('');
						}else{
						showNotif('bottom-right',data.title,data.msg,'error');
					}
					
					searchPekerjaan();
					} ,error: function(xhr, status, error) {
					showNotif('bottom-right','Peringatan',error,'error');
					$('body').loading('stop');
				}
			});
		});
		
		$(document).on('click','.hapus_pekerjaan',function(e){
			var id = $("#data-pekerjaan").val();
			$.ajax({
				url: base_url + 'psb/hapus_pekerjaan',
				data: {id:id},
				method: 'POST',
				dataType:'json',
				beforeSend: function () {
					$('body').loading();　
				},
				success: function(data) {
					$('#confirm-delete-pekerjaan').modal('hide');
					if(data.status==true){
						showNotif('bottom-right',data.title,data.msg,'success');
						}else{
						sweet('Peringatan!!!',data.msg,'warning','warning');
					}
					searchPekerjaan();
					
					$('body').loading('stop');　
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');　
				}
			});
		});
		
		$(document).on('click','.clear_pekerjaan',function(e){
			$("#keywords_pekerjaan").val('');
			searchPekerjaan();
		});
		
		$('#confirm-delete-pekerjaan').on('show.bs.modal', function(e) {
			$('#data-pekerjaan').val($(e.relatedTarget).data('id'));
		});
	</script>        
	
	
<?php } ?>			