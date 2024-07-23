<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					PSB Online
				</div>
                <h2 class="page-title">
					Data Pendaftar Naik Tingkatan
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
						<h3 class="card-title">List Data Pendaftar</h3>
					</div>
					<div class="card-body">
						<div class="d-flex">
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
										<option value="Baru">Baru</option>
										<option value="Pindahan">Pindahan</option>
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
								<div class="ms-2 d-inline-block">
									<div class="input-group">
										<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="searchPengguna();" style="width:150px!important" />
										<span class="input-group-text">
											
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
					</div>
					
					<div class="pb-2" id="posts_content"></div>
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
				<div class="load-lampiran">
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
			$.ajax({
				type: 'POST',
				url: base_url+'pendaftar/ajax_list_naik_tingkat/'+page_num,
				data:{page:page_num,
					limit:limit,
					keywords:keywords,
					tahun:sort_tahun,
					sortBy:sortBy,
					status:status,
					sortUnit:sortUnit,
					sortKelas:sortKelas
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
			// console.log('submit');
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
					$("#sortKelas").append("<option value='0'>Pilih</option>");
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
		
		
	</script>        
<?php } ?>