<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					<?=$menu;?>
				</div>
                <h2 class="page-title">
					Data Pendaftar Baru
				</h2>
			</div>
			<div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
					<button class="btn btn-secondary export" id="export" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-id="0" data-mod="export" disabled>
						<i class="ti ti-file-spreadsheet fa-lg"></i>
						Export
					</button>
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
						<h3 class="card-title">List Data Pendaftar</h3>
						<div class="card-actions" id="update_status" style="display:none">
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Update status</div>
								<div class="mx-2 d-inline-block">
									<select name="status_pendaftar" id="update_status_pendaftar" class="form-select" required="">
										<option value="">Pilih status</option>
										<option value="Proses">Proses</option>
										<option value="Diterima">Diterima</option>
										<option value="Tidak Diterima">Ditolak</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body table-responsive">
						<div class="d-flex ">
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Show</div>
								<div class="mx-2 d-inline-block">
									<select id="limits" name="limits" class="form-control form-select" style="width:70px!important" onchange="searchPengguna()">
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
									<select id="sortBy" class="form-control form-select w-1" onchange="searchPengguna()" style="width:80px!important">
										<option value="ASC">ASC</option>
										<option value="DESC" selected>DESC</option>
									</select>
								</div>
							</div>
							<div class="text-muted">
								<div class="mx-2 d-inline-block">
									<select id="sort_tahun" class="form-control form-select w-2" onchange="searchPengguna()" style="width:150px!important">
										<option value="">Tahun Akademik</option>
										<?php foreach($tahun AS $val) : ?>
										<option value="<?=$val->id_tahun_akademik;?>"><?=$val->id_tahun_akademik;?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Status</div>
								<div class="mx-2 d-inline-block">
									<select id="status" name="status" class="form-control form-select" style="width:100px!important" onchange="searchPengguna()">
										<option value="Baru" <?php echo ($filter == 'Baru') ? 'selected' : ''; ?>>Baru</option>
										<option value="Pindahan" <?php echo ($filter == 'Pindahan') ? 'selected' : ''; ?>>Pindahan</option>
									</select>
								</div>
							</div>
							
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Unit</div>
								<div class="mx-2 d-inline-block">
									<select id="sortUnit" class="form-control form-select w-2" onchange="searchPengguna()" style="width:130px!important">
										<option value="">Pilih Unit</option>
										<?php foreach($unit AS $val) : ?>
										<option value="<?=$val->nama_jurusan;?>"><?=$val->nama_jurusan;?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Kelas</div>
								<div class="mx-2 d-inline-block">
									<select id="sortKelas" class="form-control form-select w-2" onchange="searchPengguna()" style="width:130px!important">
										<option value="">Pilih Kelas</option>
										<?php foreach($kelas AS $val) : ?>
										<option value="<?=$val->id;?>"><?=$val->kode_kelas;?> - <?=$val->nama_kelas;?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="ms-auto text-muted">
								<div class="input-group">
									<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="searchPengguna();" style="width:150px!important" />
									<span class="input-group-text ms-2 d-none d-sm-inline-block">
										
										<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block" data-bs-toggle="tooltip" aria-label="Cari pengguna" title="Cari pengguna" onclick="searchPengguna();"><i class="ti ti-search fa-lg"></i>&nbsp;
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

<div class="modal modal-blur fade" id="OpenModalUser" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabelPengguna">Edit Data Pendaftar</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="load-pengguna"></div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
				<button type="button" onClick="simpanMember()" id="btn-bahan" class="btn btn-success">Submit</button>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-blur fade" id="OpenModalImage" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Lampiran</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="load-lampiran text-center">
					<img src="" id="img-lampiran" alt="" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
				<a href="#" id="img-download" target="_blank" class="btn btn-success">Download</a>
			</div>
		</div>
	</div>
</div>

<!-- Modal Export Excel -->
<div id="modalExport" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="<?= site_url('pendaftar/export_excel') ?>" target="_blank">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export to Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
                <div class="modal-body">
                    <!-- Date -->
					<div class="form-group">
						<label for="filter-tahun" class="form-label my-0"><small> Tahun Akademik </small></label>
						<input id="filter-tahun" name="export" class="form-control mt-3" type="text" readonly>
					</div>
					<div class="form-group">
						<label for="filter-status" class="form-label mt-2"><small>Status Pendaftar </small></label>
						<input id="filter-status" name="status" class="form-control mt-3" type="text" readonly>
					</div>
					<div class="form-group d-none" id="show-unit">
						<label for="filter-sortunit" class="form-label mt-2"><small>Unit Pilihan</small></label>
						<input id="filter-sortunit" name="unit" class="form-control mt-3" type="text" readonly>
					</div>
					<div class="form-group d-none" id="show-kelas">
						<label for="filter-sortkelas" class="form-label mt-2"><small>Kelas Pilihan</small></label>
						<input id="filter-sortkelas" name="kelas" class="form-control mt-3" type="text" readonly>
					</div>
				</div>
                <div class="modal-footer">
					<button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Submit</button>
				</div>
			</form>
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
<script>
	var filter_status = "<?=ucfirst($status);?>";
</script>
<?php
	$this->RenderScript[] = function() {
	?>
	<script>
		
		searchPengguna();
		function searchPengguna(page_num){
			page_num = page_num?page_num:0;
			var limit = $('#limits').val();
			var keywords = $('#keywords').val();
			var sortBy = $('#sortBy').val();
			var sort_tahun = $('#sort_tahun').val();
			var status = $('#status').val();
			var sortUnit = $('#sortUnit').val();
			var sortKelas = $('#sortKelas').val();
			var diterima = filter_status;
			$.ajax({
				type: 'POST',
				url: base_url+'pendaftar/ajax_list/'+page_num,
				data:{page:page_num,
					limit:limit,
					keywords:keywords,
					tahun:sort_tahun,
					sortBy:sortBy,
					status:status,
					sortUnit:sortUnit,
					sortKelas:sortKelas,
					diterima:diterima
				},
				beforeSend: function(){
					$('body').loading();
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
					$('body').loading('stop');
				},
				success: function(html){
					
					if(html=='Belum ada data'){
						$('#export').removeClass('btn-success').addClass('btn-secondary');
						$('#export').attr('disabled',true);
						var data = "<table class='table table-bordered'><tr><td>"+html+"</td></tr></table>";
					$('#posts_content').html(data);
					}else{
					$('#posts_content').html(html);
					}
					$('body').loading('stop');
				}
				
			});
		}
		
		$('#OpenModalUser').on('show.bs.modal', function(e) {
			var id = $(e.relatedTarget).data('id');
			var mod = $(e.relatedTarget).data('mod');
			
			$.ajax({
				type: 'POST',
				url: base_url + "pendaftar/edit_data",
				data: {id:id,mod:mod},
				dataType: "html",
				beforeSend: function () {
					$("body").loading({zIndex:1060});
				},
				success: function(data) {
					$('.load-pengguna').html(data);
					$('body').loading('stop');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
					$('body').loading('stop');
				}
			});
		});
		
		
		function load_lampiran(id,file)
		{
			var lampiran =  file.split('.').pop();
			// console.log(lampiran)
			// return;
			if(lampiran=='jpg' || lampiran =='jpeg' || lampiran =='png'){
				var gambar = base_url + 'upload/foto_dokumen/'+file;
				var link_download = base_url + 'download-lampiran/'+file;
				$('#OpenModalImage').modal('show')
				$('#img-lampiran').attr("src", gambar);
				$("#img-download"). prop('href', link_download);
				}else{
				var link_download = base_url + 'download-lampiran/'+file;
				window.open(link_download, '_blank');
			}
			
		}
		
		function simpanMember()
		{
			// if($("#mail").val()==''){
			// $("#mail").addClass('form-control-warning');
			// showNotif('top-center','Input Data','Harus diisi','warning');
			// $("#mail").focus();
			// return;
			// }
			// if($("#title").val()==''){
			// $("#title").addClass('form-control-warning');
			// showNotif('top-center','Input Data','Harus diisi','warning');
			// $("#title").focus();
			// return;
			// }
			
			// if($("#daftar").val()==''){
			// $("#daftar").addClass('form-control-warning');
			// showNotif('top-center','Input Data','Harus diisi','warning');
			// $("#daftar").focus();
			// return;
			// }
			// if($("#phone").val()==''){
			// $("#phone").addClass('form-control-warning');
			// showNotif('top-center','Input Data','Harus diisi','warning');
			// $("#phone").focus();
			// return;
			// }
			// if($("#alamat").val()==''){
			// $("#alamat").addClass('form-control-warning');
			// showNotif('top-center','Input Data','Harus diisi','warning');
			// $("#alamat").focus();
			// return;
			// }
			
			var formData = $("#formPendaftaran").serialize();
			$.ajax({
				type: "POST",
				url: base_url+"pendaftar/simpan_pendaftar",
				dataType: 'json',
				data: formData,
				beforeSend: function () {
					$("body").loading({zIndex:1060});　
				},
				success: function(data) {
					$('body').loading('stop');
					if(data.status==true){
						showNotif('bottom-right',data.title,data.message,'success');
						$("#OpenModalUser").modal('hide');
						}else{
						showNotif('bottom-right',data.title,data.message,'error');
					}
					
					searchPengguna();
					} ,error: function(xhr, status, error) {
					showNotif('bottom-right','Peringatan',error,'error');
					$('body').loading('stop');
				}
			});
		}
		
		$(document).on('click','.export',function(e){
			$("#modalExport").modal('show');
			var tahun = $("#sort_tahun").val();
			var status = $("#status").val();
			var sortUnit = $("#sortUnit").val();
			var sortKelas = $("#sortKelas").val();
			
			if(sortUnit!=''){
				$("#show-unit").removeClass('d-none');
			}
			if(sortKelas != 0){
				$("#show-kelas").removeClass('d-none');
			}
			$("#filter-tahun").val(tahun);
			$("#filter-status").val(status);
			$("#filter-sortunit").val(sortUnit);
			$("#filter-sortkelas").val(sortKelas);
			
		});
		
		
		$(document).on('click','.hapus_user',function(e){
			var id = $("#data-hapus").val();
			$.ajax({
				url: base_url + 'pendaftar/hapus_pendaftar',
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
					searchPengguna();
					
					$('body').loading('stop');　
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');　
				}
			});
		});
		$(document).on('click','.clear',function(e){
			$("#keywords").val('');
			searchPengguna();
		});
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$('#data-hapus').val($(e.relatedTarget).data('id'));
		});
		
		// ambil data kelas ketika data memilih unit
		$('body').on("change","#sortUnit",function(){
			var id = $(this).val();
			var data = {id:id};
			// $("#sortKelas").attr('disabled',true);
			$.ajax({
				type: 'POST',
				url: base_url+ "pendaftar/kelas",
				data: data,
				dataType : "json",
				beforeSend: function(){
					$("#sortKelas").empty();
					$("#sortKelas").append("<option value=''>Pilih</option>");
				},
				success: function(response) {
					var msize = response.length;
					if(msize > 0)
					{
						// $("#sortKelas").attr('disabled',false);
						var i = 0;
						for (; i < msize; i++) {
							var teg = response[i]["id"];
							var name = response[i]["name"];
							$("#sortKelas").append("<option value='" + teg + "'>" + name + "</option>");
						}
					}
				}
			});
		});
		// ambil data kelas ketika data memilih unit
		$('body').on("change","#status",function(){
			var id = $(this).val();
			var data = {id:id};
			// $("#sortKelas").attr('disabled',true);
			$.ajax({
				type: 'POST',
				url: base_url+ "pendaftar/load_kelas",
				data: data,
				dataType : "json",
				beforeSend: function(){
					$("#sortKelas").empty();
					$("#sortKelas").append("<option value='0'>Pilih Kelas</option>");
				},
				success: function(response) {
					var msize = response.length;
					if(msize > 0)
					{
						// $("#sortKelas").attr('disabled',false);
						var i = 0;
						for (; i < msize; i++) {
							var teg = response[i]["id"];
							var name = response[i]["name"];
							$("#sortKelas").append("<option value='" + teg + "'>" + name + "</option>");
						}
					}
				}
			});
		});
		
		$('body').on("change","#kirim_pesan",function(){
			var aktif = $(this).val();
			if(aktif=='Ya'){
				$.ajax({
					type: 'POST',
					url: base_url+ "pendaftar/load_pesan",
					dataType : "json",
					beforeSend: function(){
						$("#template_pesan").empty();
						$("#template_pesan").append("<option value=''>Pilih</option>");
					},
					success: function(response) {
						$("#template_pesan").attr("disabled", false);
						var msize = response.length;
						var i = 0;
						for (; i < msize; i++) {
							var teg = response[i]["id"];
							var name = response[i]["name"];
							$("#template_pesan").append("<option value='" + teg + "'>" + name + "</option>");
						}
					}
				});
				}else{
				$("#template_pesan").empty();
				$("#template_pesan").attr("disabled", true);
			}
		});
		
		$('body').on("change","#sort_tahun",function(){
			var tahun = $(this).val();
			if(tahun!=''){
				$("#export").removeClass("btn-secondary").addClass('btn-success');
				$("#export").attr("disabled", false);
				}else{
				$("#export").attr("disabled", true);
				$("#export").removeClass("btn-success").addClass('btn-secondary');
			}
		});
		
		$('body').on("change","#update_status_pendaftar",function(){
			// do what you like with the input
			$input = $("#update_status_pendaftar").val();
			if($input==""){
				return;
			}
			var $form = $('#update_form');
			
			var data = {
				'status' : $input
			};
			
			data = $form.serialize() + '&' + $.param(data);
			$.ajax({
				type: "POST",
				url: base_url+"pendaftar/update_status",
				dataType: 'json',
				data: data,
				beforeSend: function () {
					$("body").loading({zIndex:1060});　
				},
				success: function(data) {
					$('body').loading('stop');
					if(data.status==true){
						showNotif('bottom-right',data.title,data.message,'success');
						}else{
						showNotif('bottom-right',data.title,data.message,'error');
					}
					$("#update_status").hide();
					searchPengguna();
					} ,error: function(xhr, status, error) {
					showNotif('bottom-right','Peringatan',error,'error');
					$('body').loading('stop');
				}
			});
		});
		
	</script>        
<?php } ?>		