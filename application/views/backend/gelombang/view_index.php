<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					<?=$menu;?>
				</div>
                <h2 class="page-title">
					Data gelombang PPDB
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
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Tambah halaman</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="formGelombang" method="POST">
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
									<label class="form-label" for="tgl_mulai">Tanggal Mulai</label>
									<input type="date" name="tgl_mulai" value="" class="form-control" id="tgl_mulai" required="">
								</div>
								
								<div class="form-group mb-1">
									<label class="form-label" for="tgl_selesai">Tanggal Selesai</label>
									<input type="date" name="tgl_selesai" value="" class="form-control" id="tgl_selesai" required="">
								</div>
								
								
								<div class="form-group mb-1">
									<label class="form-label" for="deskripsi">Deskripsi</label>
									<textarea  name="deskripsi" value="" class="form-control" id="deskripsi" required=""></textarea>
								</div>
								<div class="form-group mb-1">
									<label>Status Aktif</label>
									<select name="aktif" id="aktif" class="form-select" required="">
										<option value="Y" selected>Ya</option>
										<option value="N">Tidak</option>
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
	
</style>

<?php $this->RenderScript[] = function() { ?>
	
	<script>
		$(document).ready(function () {
			
			tinymce.init({
				selector: '#deskripsi',
				height: 300,
				menubar: false,
				plugins: [
				'advlist', 'autolink','lists', 'link', 'image', 'charmap',  'preview', 'anchor',
				'media', 'table', 'code'
				],
				mobile: { 
					theme: 'mobile' 
				},
				toolbar: 'insert | undo redo |  formatselect | bold italic link  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
				rel_list:   [ { title: 'Lightbox', value: 'lightbox' } ]
				
			});
		});
		// Prevent Bootstrap dialog from blocking focusin
		document.addEventListener('focusin', (e) => {
			if (e.target.closest(".tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
				e.stopImmediatePropagation();
			}
		});
		searchData();
		function searchData(page_num)
		{
			
			page_num = page_num?page_num:0;
			var limit = $('#limits').val();
			var keywords = $('#keywords').val();
			$.ajax({
				type: 'POST',
				url: base_url+'gelombang/ajax_list/'+page_num,
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
			if(mod=='add'){
				$("#type").val('add');
				$("#myModalLabel").html('Tambah gelombang');
				$("#title").val('');
				// startEditor('deskripsi');
				tinymce.get('deskripsi').setContent(''); 
				return;
				}else{
				$("#type").val('edit');
				$("#myModalLabel").html('Edit gelombang');
				$('#id').val('');
				$('#title').val('');
				$('#seo').val('');
				tinymce.get('deskripsi').setContent(''); 
			}
			$.ajax({
				type: 'POST',
				url: base_url + "gelombang/edit_data",
				data: {id:id,mod:mod},
				dataType: "json",
				beforeSend: function () {
					$("body").loading({zIndex:1060});
				},
				success: function(data) {
					$('#id').val(data.id);
					$('#title').val(data.title);
					$('#tgl_mulai').val(data.tgl_mulai);
					$('#tgl_selesai').val(data.tgl_selesai);
					
					tinymce.get('deskripsi').setContent(data.deskripsi); 
					$('#aktif').val(data.aktif);
					
					$('body').loading('stop');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					$("#OpenModal").modal('hide');
					sweet('Peringatan!!!',thrownError,'warning','warning');
					$('body').loading('stop');
				}
			});
		});
		
		$(document).on('click', '#simpan_data', function (e) {
			$('#formGelombang').submit();
		});
		
		$('#formGelombang').on('submit', function (ed) {
			ed.preventDefault(); // Mencegah reload halaman
			
			// Reset class warning
			$(".form-control").removeClass('form-control-warning');
			
			if ($("#title").val() == '') {
				$("#title").addClass('form-control-warning');
				showNotif('top-center', 'Input Data', 'Harus diisi', 'warning');
				$("#title").focus();
				return;
			}
			if ($("#tgl_mulai").val() == '') {
				$("#tgl_mulai").addClass('form-control-warning');
				showNotif('top-center', 'Input Data', 'Harus diisi', 'warning');
				$("#tgl_mulai").focus();
				return;
			}
			if ($("#tgl_selesai").val() == '') {
				$("#tgl_selesai").addClass('form-control-warning');
				showNotif('top-center', 'Input Data', 'Harus diisi', 'warning');
				$("#tgl_selesai").focus();
				return;
			}
			
			tinymce.triggerSave(); // Jika menggunakan TinyMCE, pastikan data tersimpan sebelum dikirim
			
			var formData = $("#formGelombang").serialize();
			
			$.ajax({
				type: "POST",
				url: base_url + "gelombang/simpan_data",
				dataType: 'json',
				data: formData,
				beforeSend: function () {
					$("body").loading({ zIndex: 1060 });
				},
				success: function (data) {
					$('body').loading('stop');
					if (data.status == 200) {
						showNotif('bottom-right', data.title, data.msg, 'success');
						$("#OpenModal").modal('hide');
						$("#formGelombang")[0].reset(); // Reset form setelah submit sukses
						} else {
						showNotif('bottom-right', data.title, data.msg, 'error');
					}
					searchData(); // Panggil fungsi pencarian data setelah submit sukses
				},
				error: function (xhr, status, error) {
					showNotif('bottom-right', 'Peringatan', error, 'error');
					$('body').loading('stop');
				}
			});
		});
		
		
		$(document).on('click','.hapus_data',function(e){
			var id = $("#data-hapus").val();
			$.ajax({
				url: base_url + 'gelombang/hapus_data',
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