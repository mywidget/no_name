<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					<?=$menu;?>
				</div>
                <h2 class="page-title">
					Data Unit & Kelas
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
						<h3 class="card-title">List Data Unit</h3>
					</div>
					<div class="card-body">
						<div class="d-flex">
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Show</div>
								<div class="mx-2 d-inline-block">
									<select id="limits" name="limits" class="form-control form-select" style="width:70px!important" onchange="searchUnit()">
										<option value="5">5</option>
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
										<input type="text" id="keywords" class="form-control w-40" placeholder="Cari unit" onkeyup="searchUnit();"/>
										<span class="input-group-text">
											<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block" data-bs-toggle="tooltip" aria-label="Cari Unit" title="Cari Unit" onclick="searchUnit();"><i class="ti ti-search fa-lg"></i>&nbsp;
											</a>
											<a href="#" class="link-secondary clear_unit" data-bs-toggle="tooltip" aria-label="Clear Pencarian" title="Clear search">&nbsp;<i class="ti ti-x fa-lg"></i>&nbsp;
											</a>
											<a href="#" class="link-secondary" data-bs-toggle="modal" data-bs-target="#OpenModalUnit" aria-label="Tambah Unit" data-id="0" data-mod="add">
												&nbsp;<i class="ti ti-plus fa-lg"></i>
											</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="pb-2" id="posts_content_unit">
					</div>
				</div><!-- /.card -->
			</div>
            <div class="col-6">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">List Data Kelas</h3>
					</div>
					<div class="card-body">
						<div class="d-flex">
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Show</div>
								<div class="mx-2 d-inline-block">
									<select id="limit_kelas" name="limits" class="form-control form-select" style="width:70px!important" onchange="searchKelas()">
										<option value="5">5</option>
										<option value="10">10</option>
										<option value="20">20</option>
										<option value="50">50</option>
										<option value="100">100</option>
									</select>
								</div>
							</div> 
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Unit</div>
								<div class="mx-2 d-inline-block">
									<select id="unit_kelas" name="unit_kelas" class="form-control form-select" style="width:120px!important" onchange="searchKelas()">
										<option value="0">Semua Unit</option>
										<?php foreach($unit AS $val): ?>
										<option value="<?=$val->id;?>"><?=$val->nama_jurusan;?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div> 
							<div class="ms-auto text-muted">
								<div class="d-none d-sm-inline-block">Search:</div>
								<div class="ms-2 d-inline-block">
									<div class="input-group">
										<input type="text" id="keywords_kelas" class="form-control w-20" placeholder="Cari Kelas" onkeyup="searchKelas();" style="width:120px!important"/>
										<span class="input-group-text">
											<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block" data-bs-toggle="tooltip" aria-label="Cari Kelas" title="Cari Kelas" onclick="searchKelas();"><i class="ti ti-search fa-lg"></i>&nbsp;
											</a>
											<a href="#" class="link-secondary clear_kelas" data-bs-toggle="tooltip" aria-label="Clear Pencarian" title="Clear Pencarian">&nbsp;<i class="ti ti-x fa-lg"></i>&nbsp;
											</a>
											<a href="#" class="link-secondary" data-bs-toggle="modal" data-bs-target="#OpenModalKelas" aria-label="Tambah Kelas" data-id="0" data-mod="add">
												&nbsp;<i class="ti ti-plus fa-lg"></i>
											</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="pb-2" id="posts_content_kelas">
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
				<button class="btn btn-danger hapus_unit" type="button">YA</button> 
			</div>
		</div>
	</div>
</div>

<div class="modal modal-blur fade" id="OpenModalUnit" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabelUnit">Tambah Unit</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="formAdd">
					<input type="hidden" class="form-control" id="id_unit" name="id_unit">
					<input type="hidden" class="form-control" id="type_unit" name="type_unit">
					<div class="card-block">
						<div class="form-group mb-1">
							<label class="form-label" for="kode_unit">Kode Unit</label>
							<input type="text" name="kode_unit" value="" class="form-control" id="kode_unit" placeholder="Kode Unit" required="">
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="nama_unit">Nama Unit</label>
							<input type="text" name="nama_unit" class="form-control" id="nama_unit" placeholder="Nama Unit" value="" required="" autocomplete="off">
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="pendaftaran">Biaya Pendaftaran</label>
							<input type="text" name="pendaftaran" class="form-control" id="pendaftaran" placeholder="Biaya Pendaftaran" value="" required="">
						</div>
						
						<div class="form-group mb-1">
							<label class="form-label" for="kenaikan">Biaya Kenaikan Tingkat</label>
							<input type="text" name="kenaikan" class="form-control" id="kenaikan" placeholder="Biaya Kenaikan Tingkat" value="" required="">
						</div>
						
						<div class="form-group mb-1">
							<label class="form-label" for="aktif_unit">Aktif</label>
							<select name="aktif_unit" id="aktif_unit" class="form-control form-select">
								<option value="Ya">Ya</option>
								<option value="Tidak">Tidak</option>
							</select>
						</div>
						
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
				<button type="button" onClick="simpanUnit()" id="btn-unit" class="btn btn-success">Submit</button>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-blur fade" id="OpenModalKelas" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabelKelas">Tambah Kelas</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="formAddKelas">
					<input type="hidden" class="form-control" id="id_kelas" name="id_kelas">
					<input type="hidden" class="form-control" id="type_kelas" name="type_kelas">
					<div class="card-block">
						<div class="form-group mb-1">
							<label class="form-label" for="kode_kelas">Unit</label>
							<select name="unit_kelas" id="unit_kelas" class="form-control form-select">
								<option value="">Pilih Unit</option>
								<?php foreach($unit AS $val) : ?>
								<option value="<?=$val->id;?>"><?=$val->nama_jurusan;?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="kode_kelas">Kode Kelas</label>
							<input type="text" name="kode_kelas" value="" class="form-control" id="kode_kelas" placeholder="Kode Kelas" required="">
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="nama_kelas">Nama Kelas</label>
							<input type="text" name="nama_kelas" class="form-control" id="nama_kelas" placeholder="Nama Kelas" value="" required="" autocomplete="off">
						</div>
						
						<div class="form-group mb-1">
							<label class="form-label" for="aktif_kelas">Aktif</label>
							<select name="aktif_kelas" id="aktif_kelas" class="form-control form-select">
								<option value="Ya">Ya</option>
								<option value="Tidak">Tidak</option>
							</select>
						</div>
						
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
				<button type="button" onClick="simpanKelas()" id="btn-kelas" class="btn btn-success">Submit</button>
			</div>
		</div>
	</div>
</div>


<div class="modal modal-blur fade" id="confirm-delete-kelas" tabindex="-1" role="dialog" aria-hidden="true">
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
				<input type="hidden" id="data-kelas">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-danger hapus_kelas" type="button">YA</button> 
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
		
		searchUnit();
		function searchUnit(page_num){
			page_num = page_num?page_num:0;
			var limit = $('#limits').val();
			var keywords = $('#keywords').val();
			$.ajax({
				type: 'POST',
				url: base_url+'psb/ajax_list_unit/'+page_num,
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
					$('#posts_content_unit').html(html);
					$('body').loading('stop');
				}
			});
		}
		
		$('#OpenModalUnit').on('show.bs.modal', function(e) {
			var id = $(e.relatedTarget).data('id');
			var mod = $(e.relatedTarget).data('mod');
			$('input').val('');
			if(id != 0){
				$('#type_unit').val('edit');
				$("#myModalLabelUnit").html("Edit Unit")
				$.ajax({
					type: 'POST',
					url: base_url + "psb/edit_unit",
					data: {id:id,mod:mod},
					dataType: "json",
					beforeSend: function () {
						$("body").loading({zIndex:1060});
					},
					success: function(data) {
						$('#id_unit').val(data.id);
						$('#kode_unit').val(data.kode);
						$('#nama_unit').val(data.nama);
						$('#pendaftaran').val(data.pendaftaran);
						$('#kenaikan').val(data.kenaikan);
						$('#aktif_unit').val(data.aktif);
						$('body').loading('stop');
					},
					error: function (xhr, ajaxOptions, thrownError) {
						sweet('Peringatan!!!',thrownError,'warning','warning');
						$('body').loading('stop');
					}
				});
				}else{
				
				$("#myModalLabelUnit").html("Tambah Unit")
				$('#type_unit').val('new');
			}
			
		});
		
		
		function simpanUnit()
		{
			// console.log('submit');
			if($("#kode_unit").val()==''){
				$("#kode_unit").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#kode_unit").focus();
				return;
			}
			if($("#nama_unit").val()==''){
				$("#nama_unit").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#nama_unit").focus();
				return;
			}
			
			var formData = $("#formAdd").serialize();
			$.ajax({
				type: "POST",
				url: base_url+"psb/simpan_unit",
				dataType: 'json',
				data: formData,
				beforeSend: function () {
					$("body").loading({zIndex:1060});　
				},
				success: function(data) {
					$('body').loading('stop');
					if(data.status==200){
						showNotif('bottom-right',data.title,data.msg,'success');
						$("#OpenModalUnit").modal('hide');
						$('input').val('');
						}else{
						showNotif('bottom-right',data.title,data.msg,'error');
					}
					
					searchUnit();
					} ,error: function(xhr, status, error) {
					showNotif('bottom-right','Peringatan',error,'error');
					$('body').loading('stop');
				}
			});
		}
		
		$(document).on('click','.hapus_unit',function(e){
			var id = $("#data-hapus").val();
			$.ajax({
				url: base_url + 'psb/hapus_unit',
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
					searchUnit();
					
					$('body').loading('stop');　
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');　
				}
			});
		});
		
		$(document).on('click','.clear_unit',function(e){
			$("#keywords").val('');
			searchUnit();
		});
		
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$('#data-hapus').val($(e.relatedTarget).data('id'));
		});
		
		searchKelas();
		function searchKelas(page_num){
			page_num = page_num?page_num:0;
			var limit = $('#limit_kelas').val();
			var keywords = $('#keywords_kelas').val();
			var unit_kelas = $('#unit_kelas').val();
			$.ajax({
				type: 'POST',
				url: base_url+'psb/ajax_list_kelas/'+page_num,
				data:{page:page_num,
					limit:limit,
					keywords:keywords,
					unit:unit_kelas,
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
					$('body').loading('stop');
				},
				beforeSend: function(){
					$('body').loading();
				},
				success: function(html){
					$('#posts_content_kelas').html(html);
					$('body').loading('stop');
				}
			});
		}
		
		$('#OpenModalKelas').on('show.bs.modal', function(e) {
			var id = $(e.relatedTarget).data('id');
			var mod = $(e.relatedTarget).data('mod');
			$('input').val('');
			if(id != 0){
				$('#type_kelas').val('edit');
				$("#myModalLabelKelas").html("Edit Kelas")
				$.ajax({
					type: 'POST',
					url: base_url + "psb/edit_kelas",
					data: {id:id,mod:mod},
					dataType: "json",
					beforeSend: function () {
						$("body").loading({zIndex:1060});
					},
					success: function(data) {
						$('#id_kelas').val(data.id);
						$('#kode_kelas').val(data.kode);
						$('#nama_kelas').val(data.nama);
						$('#unit_kelas').val(data.unit);
						$('#aktif_kelas').val(data.aktif);
						$('body').loading('stop');
					},
					error: function (xhr, ajaxOptions, thrownError) {
						sweet('Peringatan!!!',thrownError,'warning','warning');
						$('body').loading('stop');
					}
				});
				}else{
				
				$("#myModalLabelUnit").html("Tambah Unit")
				$('#type_kelas').val('new');
			}
			
		});
		function simpanKelas()
		{
			// console.log('submit');
			if($("#unit_kelas").val()==''){
				$("#unit_kelas").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus dipilih','warning');
				$("#unit_kelas").focus();
				return;
			}
			if($("#kode_kelas").val()==''){
				$("#kode_kelas").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#kode_kelas").focus();
				return;
			}
			if($("#nama_kelas").val()==''){
				$("#nama_kelas").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#nama_kelas").focus();
				return;
			}
			
			var formData = $("#formAddKelas").serialize();
			$.ajax({
				type: "POST",
				url: base_url+"psb/simpan_kelas",
				dataType: 'json',
				data: formData,
				beforeSend: function () {
					$("body").loading({zIndex:1060});　
				},
				success: function(data) {
					$('body').loading('stop');
					if(data.status==200){
						showNotif('bottom-right',data.title,data.msg,'success');
						$("#OpenModalKelas").modal('hide');
						$('input').val('');
						}else{
						showNotif('bottom-right',data.title,data.msg,'error');
					}
					
					searchKelas();
					} ,error: function(xhr, status, error) {
					showNotif('bottom-right','Peringatan',error,'error');
					$('body').loading('stop');
				}
			});
		}
		
		$(document).on('click','.hapus_kelas',function(e){
			var id = $("#data-kelas").val();
			$.ajax({
				url: base_url + 'psb/hapus_kelas',
				data: {id:id},
				method: 'POST',
				dataType:'json',
				beforeSend: function () {
					$('body').loading();　
				},
				success: function(data) {
					$('#confirm-delete-kelas').modal('hide');
					if(data.status==true){
						showNotif('bottom-right',data.title,data.msg,'success');
						}else{
						sweet('Peringatan!!!',data.msg,'warning','warning');
					}
					searchKelas();
					
					$('body').loading('stop');　
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');　
				}
			});
		});
		
		$(document).on('click','.clear_kelas',function(e){
			$("#keywords_kelas").val('');
			searchKelas();
		});
		
		$('#confirm-delete-kelas').on('show.bs.modal', function(e) {
			$('#data-kelas').val($(e.relatedTarget).data('id'));
		});
	</script>        
	
	
<?php } ?>	