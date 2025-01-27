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
				<div class="row row-cards">
					<?php foreach($unit AS $row): ?>
					<div class="col-sm-6 col-lg-4">
						<div class="card card-sm">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-auto">
										<span class="bg-primary text-white avatar" style="width:60px;height:60px">
										<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-door"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 12v.01" /><path d="M3 21h18" /><path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16" /></svg>
										</span>
									</div>
									<div class="col">
										<div class="font-weight-medium py-2">
											KUOTA KAMAR <?=$row->kode_jurusan;?> <span class="badge bg-blue"><?=getKuotaKamar('kuota',['id_unit'=>$row->id]);?></span>
										</div>
										<div class="text-secondary">
											<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-man"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8c1.628 0 3.2 .787 4.707 2.293a1 1 0 0 1 -1.414 1.414c-.848 -.848 -1.662 -1.369 -2.444 -1.587l-.849 5.944v4.936a1 1 0 0 1 -2 0v-4h-2v4a1 1 0 0 1 -2 0v-4.929l-.85 -5.951c-.781 .218 -1.595 .739 -2.443 1.587a1 1 0 1 1 -1.414 -1.414c1.506 -1.506 3.08 -2.293 4.707 -2.293z" /><path d="M12 1a3 3 0 1 1 -3 3l.005 -.176a3 3 0 0 1 2.995 -2.824" /></svg> <span class="badge bg-cyan"><?=getKuotaKamar('kuota',['id_unit'=>$row->id,'gender'=>'Laki-laki']);?></span>  <span class="badge bg-red"><?=getKuotaKamar('terpakai',['id_unit'=>$row->id,'gender'=>'Laki-laki']);?> </span> <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-woman"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 16v5" /><path d="M14 16v5" /><path d="M8 16h8l-2 -7h-4z" /><path d="M5 11c1.667 -1.333 3.333 -2 5 -2" /><path d="M19 11c-1.667 -1.333 -3.333 -2 -5 -2" /><path d="M12 4m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /></svg> <span class="badge bg-cyan"><?=getKuotaKamar('kuota',['id_unit'=>$row->id,'gender'=>'Perempuan']);?></span> <span class="badge bg-red"><?=getKuotaKamar('terpakai',['id_unit'=>$row->id,'gender'=>'Perempuan']);?></span> 
										</div>
										 
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach;?>
				</div>
			</div>
            <div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">List Data Pendaftar</h3>
						<div class="card-actions">
							<a href="javascript:void(0)" class="btn btn-primary OpenModalPendaftar" data-bs-toggle="modal" data-bs-target="#OpenModalPendaftar" aria-label="Tambah Pendaftar" data-id="0" data-mod="add">
								<!-- Download SVG icon from http://tabler-icons.io/i/plus -->
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
								Tambah
							</a>
						</div>
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
					<div class="card-body">
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
					
					<div class="table-responsive" id="posts_content">
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

<div class="modal modal-blur fade" id="confirm-hapus" tabindex="-1" role="dialog" aria-hidden="true">
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
				<input type="hidden" id="data-delete">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-danger hapus_data" type="button">YA</button> 
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
				<button type="button" onClick="simpan_pendaftar()" id="btn-bahan" class="btn btn-success">Submit</button>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-blur fade" id="OpenModalPendaftar" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
			<form method="post" class='form-horizontal needs-validation' id="formPendaftaran" novalidate>
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabelPendaftar">Formulir Pendaftaran</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="form-scrollable px-3">
						<div class="load-pendaftar"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
					<button type="submit" id="btn-simpan" class="btn btn-success simpan_pendaftar">Submit</button>
				</div>
			</form>
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
		$('.form-scrollable').slimScroll({
			height: '500px'
		});
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
					$(".load-pendaftar").empty();
					$(".load-pendaftar").html('');
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
		
		function simpan_pendaftar()
		{
			
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
		$(document).on('click','#selectAll',function(e){
			// $('#selectAll').click(function (e) {
			$(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
            var rowCount = $("#tablein > tbody tr").children().length;
			var countcheck = $('#tablein > tbody input[type="checkbox"]:checked').length;
			console.log(countcheck);
			if (countcheck == 0) {
				$(".OpenModalPendaftar").show();
				$("#update_status").hide();
				$("#status_pendaftar").val('');
			}
			if (countcheck > 0) {
				$(".OpenModalPendaftar").hide();
				$("#update_status").show();
				$("#status_pendaftar").val('');
			}
            
		});
		$(document).on('click','#tablein >tbody input[type="checkbox"]',function(e){
			// $('#tablein >tbody input[type="checkbox"]').click(function() {
			var rowCount = $("#tablein > tbody tr").children().length;
			var countcheck = $('#tablein > tbody input[type="checkbox"]:checked').length;
            if (countcheck == 0) {
				$(".OpenModalPendaftar").show();
				$("#update_status").hide();
				$("#status_pendaftar").val('');
			}
			if (countcheck > 0) {
				$(".OpenModalPendaftar").hide();
				$("#update_status").show();
				$("#status_pendaftar").val('');
			}
		});
        
        
        function withoutJquery(i){
            console.time('time2');
            var temp=document.createElement('input');
            var texttoCopy=document.getElementById('copyText'+i).innerHTML;
            temp.type='input';
            temp.setAttribute('value',texttoCopy);
            document.body.appendChild(temp);
            temp.select();
            document.execCommand("copy");
            temp.remove();
            console.timeEnd('time2');
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
		
		$(document).on('click','.hapus_data',function(e){
			var id = $("#data-delete").val();
			$.ajax({
				url: base_url + 'pendaftar/hapus_data',
				data: {id:id},
				method: 'POST',
				dataType:'json',
				beforeSend: function () {
					$('body').loading();　
				},
				success: function(data) {
					$('#confirm-hapus').modal('hide');
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
		
		$('#confirm-hapus').on('show.bs.modal', function(e) {
			$('#data-delete').val($(e.relatedTarget).data('id'));
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
			// Ambil status yang dipilih
			$input = $("#update_status_pendaftar").val();
			if ($input == "") {
				return;
			}
			
			var $form = $('#update_form');
			
			// Ambil data checkbox yang dicentang (jika ada)
			var selectedCheckboxes = [];
			$('input[name="pilih[]"]:checked').each(function() {
				selectedCheckboxes.push($(this).val());
			});
			
			// Gabungkan data status dan checkbox yang dicentang
			var data = {
				'status': $input,
				'selected_checkboxes': selectedCheckboxes
			};
			// Gabungkan data form dengan data yang baru
			data = $form.serialize() + '&' + $.param(data);
			
			$.ajax({
				type: "POST",
				url: base_url + "pendaftar/update_status",
				dataType: 'json',
				data: data,
				beforeSend: function () {
					$("body").loading({zIndex: 1060});
				},
				success: function(data) {
					$('body').loading('stop');
					if (data.status == true) {
						showNotif('bottom-right', data.title, data.message, 'success');
						} else {
						showNotif('bottom-right', data.title, data.message, 'error');
					}
					$("#update_status_pendaftar").val('');
					$("#update_status").hide();
					$(".OpenModalPendaftar").show();
					searchPengguna();
				},
				error: function(xhr, status, error) {
					showNotif('bottom-right', 'Peringatan', error, 'error');
					$('body').loading('stop');
				}
			});
		});
		
		
		
		$('#OpenModalPendaftar').on('show.bs.modal', function(e) {
			var id = $(e.relatedTarget).data('id');
			var mod = $(e.relatedTarget).data('mod');
			
			$.ajax({
				type: 'POST',
				url: base_url + "pendaftar/tambah_pendaftar",
				data: {id:id,mod:mod},
				dataType: "html",
				beforeSend: function () {
					$("body").loading({zIndex:1060});
					$(".load-pengguna").empty();
					$(".load-pengguna").html('');
					$(".load-pendaftar").empty();
					$(".load-pendaftar").html('');
					
				},
				success: function(data) {
					$('.load-pendaftar').html(data);
					$('body').loading('stop');
					form_unit()
					// pendidikan_ayah()
					// pendidikan_ibu()
					// pekerjaan_ayah()
					// pekerjaan_ibu()
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
					$('body').loading('stop');
				}
			});
		});
		
		// $('select[readonly]').focus(function(){
		// this.blur();
		// });
		$(document).on('change','#gender',function(){
			// $('body').on("change","#gender",function(){
			// var status = $("#statusPendidikan").val();
			// $("#statusPendidikan").val(status).change();
			
			$("#form_unit").attr('disabled',false);
		});
		
		$('body').on("change","#statusPendidikan",function(){
			var form_unit = $("#form_unit").val();
			$("#form_unit").val(form_unit).change();
		});
		
		function form_unit(id)
		{
			
			$.ajax({
				url: base_url+ "pendaftar/unit_sekolah",
				type: "POST",
				dataType: 'json',
				beforeSend: function () {
					$("#form_unit").append("<option value='loading'>loading</option>");
					$("#form_unit").attr("disabled", true);
				},
				success: function (response) {
					$("#form_unit").attr("disabled", false);
					if(response.status==false){
						$("#form_unit").append("<option value='loading'>loading</option>");
						$("#form_unit").attr("disabled", true);
						return;
					}
					$("#form_unit option[value='loading']").remove();
					// $("#form_unit").attr("disabled", false);
					$("#form_unit").append("<option value=''>Pilih</option>");
					var len = response.length;
					for (var i = 0; i < len; i++) {
						
						var id = response[i]['id'];
						var name = response[i]['name'];
						
						$("#form_unit").append("<option value='" + id + "'>" + name + "</option>");
						
					}
				}
			});
		}
		// ambil data kelas ketika data memilih unit
		$('body').on("change","#form_unit",function(){
			var id = $(this).val();
			var statusSantri = $('#statusPendidikan').val();
			load_kamar(id)
			load_biaya(id)
			// console.log(statusSantri)
			$.ajax({
				type: 'POST',
				url: base_url+ "dashboard/kelas",
				data: {id:id,status:statusSantri},
				dataType : "json",
				beforeSend: function(){
					$("#form_kelas").empty();
					$("#form_biaya").empty();
					$("#form_kamar").empty();
					$("#form_kuota").empty();
					$("#form_kelas").attr('disabled',false);
					$("#form_kelas").append("<option value='0'>Pilih</option>");
				},
				success: function(response) {
					var msize = response.length;
					var i = 0;
					for (; i < msize; i++) {
						var teg = response[i]["id"];
						var name = response[i]["name"];
						$("#form_kelas").append("<option value='" + teg + "'>" + name + "</option>");
					}
				}
			});
		});
		function load_biaya(id_unit){
			
			var thnakademik = $("#thnakademik").val();
			var status = $("#statusPendidikan").val();
			
			$.ajax({
				type: 'POST',
				url: base_url+ "dashboard/biaya",
				data: {id:id_unit,status:status,thnakademik:thnakademik},
				dataType : "json",
				beforeSend: function(){
					$("#form_biaya").empty();
				},
				success: function(response) {
					
					var teg = response.id;
					var name = response.name;
					$("#form_biaya").append("<option value='" + teg + "'>" + name + "</option>");
					
				}
			});
			
		}
		
		function load_kamar(id)
		{
			
			var gender = $("#gender").val();
			// console.log(gender)
			$.ajax({
				type: 'POST',
				url: base_url+ "dashboard/load_kamar",
				data: {id:id,gender:gender},
				dataType : "json",
				beforeSend: function(){
					$("#form_kamar").empty();
				},
				success: function(response) {
					$("#form_kamar").attr("disabled", false);
					var len = response.length;
					$("#form_kamar").append("<option value='0'>Pilih Kamar</option>");
					for (var i = 0; i < len; i++) {
						var id = response[i]['id'];
						var name = response[i]['name'];
						$("#form_kamar").append("<option value='" + id + "'>" + name + "</option>");
					}
				}
			});
		}
		
		
		$('body').on("change","#form_kamar",function(){
			var id = $(this).val();
			$.ajax({
				type: 'POST',
				url: base_url+ "dashboard/kamar",
				data: {id:id},
				dataType : "json",
				beforeSend: function(){
					$("#form_kuota").empty();
				},
				success: function(response) {
					var teg = response.id;
					var name = response.name;
					$("#form_kuota").append("<option value='" + teg + "'>" + name + "</option>");
				}
			});
		});
		
		
		
		// ambil data kabupaten ketika data memilih provinsi
		$('body').on("change","#form_prov",function(){
			var id = $(this).val();
			$.ajax({
				type: 'POST',
				url: base_url+ "dashboard/kabupaten",
				data: {id:id},
				dataType : "json",
				beforeSend: function(){
					$("#form_kab").empty();
					$("#form_kec").empty().attr("disabled", true);
					$("#form_des").empty().attr("disabled", true);
					$("#form_kab").append("<option value=''>Pilih</option>");
				},
				success: function(response) {
					$("#form_kab").attr("disabled", false);
					var msize = response.length;
					var i = 0;
					for (; i < msize; i++) {
						var teg = response[i]["id"];
						var name = response[i]["name"];
						$("#form_kab").append("<option value='" + teg + "'>" + name + "</option>");
					}
				}
			});
		});
		
		
		$('body').on("change","#form_kab",function(){
			var id = $(this).val();
			$.ajax({
				type: 'POST',
				url: base_url+ "dashboard/kecamatan",
				data: {id:id},
				dataType : "json",
				beforeSend: function(){
					$("#form_kec").empty();
					$("#form_des").empty().empty().attr("disabled", true);
					$("#form_kec").append("<option value=''>Pilih</option>");
				},
				success: function(response) {
					$("#form_kec").attr("disabled", false);
					var msize = response.length;
					var i = 0;
					for (; i < msize; i++) {
						var teg = response[i]["id"];
						var name = response[i]["name"];
						$("#form_kec").append("<option value='" + teg + "'>" + name + "</option>");
					}
				}
			});
		});
		
		
		$('body').on("change","#form_kec",function(){
			var id = $(this).val();
			$.ajax({
				type: 'POST',
				url: base_url+ "dashboard/desa",
				data: {id:id},
				dataType : "json",
				beforeSend: function(){
					$("#form_des").empty();
					$("#form_des").append("<option value=''>Pilih</option>");
				},
				success: function(response) {
					$("#form_des").attr("disabled", false);
					var msize = response.length;
					var i = 0;
					for (; i < msize; i++) {
						var teg = response[i]["id"];
						var name = response[i]["name"];
						$("#form_des").append("<option value='" + teg + "'>" + name + "</option>");
					}
				}
			});
		});
		
		var forms = document.querySelectorAll('.needs-validation')
		
		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
		.forEach(function (form) {
			form.addEventListener('submit', function (event) {
				if (!form.checkValidity()) {
					event.preventDefault()
					event.stopPropagation()
					}else{
					event.preventDefault();
					var nik = $("#nik").val().length;
					var nisn = $("#nisn").val().length;
					var nikAyah = $("#nikAyah").val().length;
					var nikIbu = $("#nikIbu").val().length;
					
					if(nik != 16){
						$("#nik").addClass('is-invalid');
						$("#nik").siblings('.invalid-tooltip').text('NIK harus 16 digit');
						$("#nik").focus();
						return;
						}else{
						$("#nik").removeClass('is-invalid').addClass('is-valid');
						$("#nik").siblings('.invalid-tooltip').hide();
					}
					
					if(nisn != 10){
						$("#nisn").addClass('is-invalid');
						$("#nisn").siblings('.invalid-tooltip').text('NISN harus 10 digit');
						$("#nisn").focus();
						return;
						}else{
						$("#nisn").removeClass('is-invalid').addClass('is-valid');
						$("#nisn").siblings('.invalid-tooltip').hide();
					}
					
					if(nikAyah != 16){
						$("#nikAyah").addClass('is-invalid');
						$("#nikAyah").siblings('.invalid-tooltip').text('NIK Ayah harus 16 digit');
						$("#nikAyah").focus();
						return;
						}else{
						$("#nikAyah").removeClass('is-invalid').addClass('is-valid');
						$("#nikAyah").siblings('.invalid-tooltip').hide();
					}
					
					if(nikIbu != 16){
						$("#nikIbu").addClass('is-invalid');
						$("#nikIbu").siblings('.invalid-tooltip').text('NIK Ibu harus 16 digit');
						$("#nikIbu").focus();
						return;
						}else{
						$("#nikIbu").removeClass('is-invalid').addClass('is-valid');
						$("#nikIbu").siblings('.invalid-tooltip').hide();
					}
					
					const formData = new FormData($(this)[0]);
					$('button:submit', this).html('Submit').prop('disabled', true);
					
					$.ajax({
						type: 'POST',
						data: formData,
						dataType: 'json',
						processData: false,
						contentType: false,
						url: base_url+"pendaftar/proses",
						success: (response) => {
							// console.log(response)
							if (response.status === false) {
								// alerts()
								swal.fire({
									icon: 'error',
									title: 'Error',
									html: response.message,
									confirmButtonText: 'OK',
								})
								.then(() => {
									if (response.message) {
										const errors = response.message;
										setTimeout(() => {
											const firstErrorKey = Object.keys(errors)[0];
											console.log(firstErrorKey)
											$(`#${firstErrorKey}`).focus();
										}, 500);
										
										for (const key in errors) {
											$(`#${key}`).addClass('is-invalid');
											$(`#${key}`).siblings('.invalid-tooltip').text(errors[key]);
											$(`#${key}`).siblings('.invalid-tooltip').text(errors[key]);
										}
									}
								});
								} else {
								$('body').loading('stop');
								if(response.status==true){
									showNotif('bottom-right',response.title,response.message,'success');
									$("#OpenModalPendaftar").modal('hide');
									}else{
									showNotif('bottom-right',response.title,response.message,'error');
								}
								
								searchPengguna();
							}
						},
						complete: () => {
							$('button:submit', this).text('Submit Formulir').prop('disabled', false);
						},
					});
				}
				
				form.classList.add('was-validated')
			}, false)
		})
		
	</script>        
<?php } ?>			