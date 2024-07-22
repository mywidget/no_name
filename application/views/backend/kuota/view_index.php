<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Master Data
				</div>
                <h2 class="page-title">
					Data Kuota Kamar
				</h2>
			</div>
			<div class="col-12 col-md-auto ms-auto d-print-none">
				<a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#OpenModal" data-id="0" data-mod="add">
					<i class="ti ti-plus fa-lg"></i>
					Tambah
				</a>
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
											<a href="#" class="link-secondary" data-bs-toggle="modal" data-bs-target="#OpenModal" aria-label="Tambah Data" data-id="0" data-mod="add">
												&nbsp;<i class="ti ti-plus fa-lg"></i>
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
							<label class="form-label" for="id_unit">Unit</label>
							<select name="id_unit" id="id_unit" class="form-control form-select" >
								<option value="">Semua Unit</option>
								<?php foreach($unit AS $val) : ?>
								<option value="<?=$val->id;?>"><?=$val->nama_jurusan;?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="nama_kamar">Nama Kamar</label>
							<input type="text" name="nama_kamar" class="form-control" id="nama_kamar" placeholder="Nama Tahun " value="" required="" autocomplete="off">
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="gender">Kamar Khusus</label>
							<select name="gender" id="gender" class="form-control form-select">
								<option value="" selected>Pilih</option>
								<option value="Laki-laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
						</div>
						
						<div class="form-group mb-1">
							<label class="form-label" for="kuota">Kuota Kamar</label>
							<input type="text" name="kuota" class="form-control" id="kuota" placeholder="kuota" value="" required="">
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
			url: base_url+'psb/ajax_list_kuota/'+page_num,
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
	
	$('#OpenModal').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).data('id');
		var mod = $(e.relatedTarget).data('mod');
		$('#id_unit').val('');
		$('input').val('');
		if(id != 0){
			$('#type').val('edit');
			$("#myModalLabel").html("Edit Kuota")
			$.ajax({
				type: 'POST',
				url: base_url + "psb/edit_kuota",
				data: {id:id,mod:mod},
				dataType: "json",
				beforeSend: function () {
					$("body").loading({zIndex:1060});
				},
				success: function(data) {
					$('#id').val(data.id);
					$('#id_unit').val(data.id_unit);
					$('#nama_kamar').val(data.nama);
					$('#kuota').val(data.kuota);
					$('#aktif').val(data.aktif);
					$('body').loading('stop');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
					$('body').loading('stop');
				}
			});
			}else{
			
			$("#myModalLabel").html("Tambah Kuota")
			$('#type').val('new');
		}
		
	});
	
	
	function simpanData()
	{
		
		if($("#id_unit").val()==''){
			$("#id_unit").addClass('form-control-warning');
			showNotif('top-center','Input Data','Harus dipilih','warning');
			$("#id_unit").focus();
			return;
		}
		if($("#nama_kamar").val()==''){
			$("#nama_kamar").addClass('form-control-warning');
			showNotif('top-center','Input Data','Harus diisi','warning');
			$("#nama_unit").focus();
			return;
		}
		if($("#kuota").val()==''){
			$("#kuota").addClass('form-control-warning');
			showNotif('top-center','Input Data','Harus diisi','warning');
			$("#kuota").focus();
			return;
		}
		
		var formData = $("#formAdd").serialize();
		$.ajax({
			type: "POST",
			url: base_url+"psb/simpan_kuota",
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
			url: base_url + 'psb/hapus_kuota',
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
	
</script>        


<?php } ?>	