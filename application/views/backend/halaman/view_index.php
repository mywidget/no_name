<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					<?=$menu;?>
				</div>
                <h2 class="page-title">
					Halaman
				</h2>
			</div>
			<div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
					 
				</div>
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
									<select id="sortBy" class="form-control form-select w-1" onchange="searchData()" style="width:80px!important">
										<option value="ASC">ASC</option>
										<option value="DESC" selected>DESC</option>
									</select>
								</div>
							</div>
							
							<div class="ms-auto text-muted">
								<div class="ms-2 d-inline-block">
									<div class="input-group">
										<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="searchData();" style="width:150px!important" />
										<span class="input-group-text">
											
											<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block" data-bs-toggle="tooltip" aria-label="Cari data" title="Cari data" onclick="searchData();"><i class="ti ti-search fa-lg"></i>&nbsp;
											</a>
											<a href="#" class="link-secondary">&nbsp;|&nbsp;</a>
											<a href="#" class="link-secondary clear" data-bs-toggle="tooltip" aria-label="Clear search" title="Clear search">
												<i class="ti ti-x fa-lg"></i>
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
				<h3>Are you sure?</h3>
				<div class="text-muted">Do you really want to remove data? What you've done cannot be undone.</div>
				<p class="debug-url"></p>
				<input type="hidden" id="data-hapus">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-danger hapus_user" type="button">YA</button> 
			</div>
		</div>
	</div>
</div>

<div class="modal modal-blur fade" id="OpenModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Tambah halaman</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="formHalaman">
					<input type="hidden" class="form-control" id="id" name="id">
					<input type="hidden" class="form-control" id="type" name="type" value="add">
					
					<div class="row">
						<div class="col-md-12">
							<div class="card-block">
								<div class="form-group mb-1">
									<label class="form-label" for="Title">Title</label>
									<input type="text" name="title" value="" class="form-control" id="title" placeholder="Title" required="">
								</div>
								<div class="form-group mb-1">
									<label class="form-label" for="seo">seo</label>
									<input type="text" name="seo" value="" class="form-control" id="seo" placeholder="seo" required="">
								</div>
								
								<div class="form-group mb-1">
									<label class="form-label" for="deskripsi">Deskripsi</label>
									<textarea  name="deskripsi" value="" class="form-control" id="deskripsi" required=""></textarea>
								</div>
								<div class="form-group mb-1">
									<label>Status Aktif</label>
									<select name="aktif" id="aktif" class="form-select" required="">
										<option value="Ya" selected>Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
				<button type="button"  id="simpan_data" class="btn btn-success">Submit</button>
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
	
	select[readonly] {
	pointer-events: none;
	cursor: not-allowed;
	}
	
</style>
<?php
	$this->RenderScript[] = function() {
	?>
	
	<script>
		
		
		$(document).ready(function () {
			tinymce.init({
				selector: '#deskripsi',
				height: 300,
				menubar: false,
				plugins: [
				'advlist', 'autolink','lists', 'link', 'image', 'charmap',  'preview', 'anchor',
				// 'searchreplace visualblocks code fullscreen',
				'insertdatetime', 'media', 'table', 'code', 'wordcount'
				],
				mobile: { 
					theme: 'mobile' 
				},
				toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
				content_css: [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
				'//www.tiny.cloud/css/codepen.min.css'
				],
			});
		});
		searchData();
		function searchData(page_num){
			page_num = page_num?page_num:0;
			var limit = $('#limits').val();
			var keywords = $('#keywords').val();
			var sortBy = $('#sortBy').val();
			var sort_tahun = $('#sort_tahun').val();
			var status = $('#status').val();
			var sortUnit = $('#sortUnit').val();
			var sortKelas = $('#sortKelas').val();
			$.ajax({
				type: 'POST',
				url: base_url+'halaman/ajax_list/'+page_num,
				data:{page:page_num,
					limit:limit,
					keywords:keywords,
					sortBy:sortBy,
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
			if(mod=='add'){
				$("#type").val('add');
				$("#myModalLabel").html('Tambah halaman');
				$("#title").val('');
				tinymce.get('deskripsi').setContent(''); 
				return;
				}else{
				$("#type").val('edit');
				$("#myModalLabel").html('Edit halaman');
			}
			$.ajax({
				type: 'POST',
				url: base_url + "halaman/edit_data",
				data: {id:id,mod:mod},
				dataType: "json",
				beforeSend: function () {
					$("body").loading({zIndex:1060});
				},
				success: function(data) {
					$('#id').val(data.id);
					$('#title').val(data.title);
					$('#seo').val(data.seo);
					// $('#deskripsi').val(data.deskripsi);
					tinymce.get('deskripsi').setContent(data.deskripsi); 
					$('#aktif').val(data.aktif);
					
					$('body').loading('stop');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
					$('body').loading('stop');
				}
			});
		});
		
		$(document).on('click','#simpan_data',function(e){
			$('#formHalaman').submit();
		})
		$('#formHalaman').on('submit', function(ed) {
			if($("#title").val()==''){
				$("#title").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#title").focus();
				return;
			}
			
			tinymce.triggerSave();
			ed.preventDefault();
			var formData = $("#formHalaman").serialize();
			$.ajax({
				type: "POST",
				url: base_url+"halaman/simpan_data",
				dataType: 'json',
				data: formData,
				beforeSend: function () {
					$("body").loading({zIndex:1060});　
				},
				success: function(data) {
					$('body').loading('stop');
					if(data.status==true){
						showNotif('bottom-right',data.title,data.msg,'success');
						$("#OpenModal").modal('hide');
						}else{
						showNotif('bottom-right',data.title,data.msg,'error');
					}
					
					searchData();
					} ,error: function(xhr, status, error) {
					showNotif('bottom-right','Peringatan',error,'error');
					$('body').loading('stop');
				}
			});
		});
		$(document).on('click','.hapus_user',function(e){
			var id = $("#data-hapus").val();
			$.ajax({
				url: base_url + 'halaman/hapus_data',
				data: {id:id},
				method: 'POST',
				dataType:'json',
				beforeSend: function () {
					$('body').loading();　
				},
				success: function(data) {
					$('#confirm-delete').modal('hide');
					if(data.status==200){
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
		
		$(document).on('click','.aktifkan, .nonaktifkan',function(e){
			var id = $(this).attr('data-id');
			var aktif = $(this).attr('data-aktif');
			
			$.ajax({
				url: base_url + 'halaman/aktifkan',
				data: {id:id,aktif:aktif},
				method: 'POST',
				dataType:'json',
				beforeSend: function () {
					$('body').loading();　
				},
				success: function(data) {
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