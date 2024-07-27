<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Pengaturan
				</div>
                <h2 class="page-title">
					Data Pengguna
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
						<h3 class="card-title">List Data Pengguna</h3>
						<div class="card-actions">
							<a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#OpenModalUser" aria-label="Tambah Unit" data-id="0" data-mod="add">
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
										<option value="ASC" selected>ASC</option>
										<option value="DESC">DESC</option>
									</select>
								</div>
							</div>
							<div class="ms-auto text-muted">
								<div class="d-none d-sm-inline-block">Search:</div>
								<div class="ms-2 d-inline-block">
									<div class="input-group">
										<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="searchPengguna();"/>
										<span class="input-group-text">
											<a href="#" class="link-secondary clear" data-bs-toggle="tooltip" aria-label="Clear search" title="Clear search">
												<i class="ti ti-x fa-lg"></i>
											</a>
											
											<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block" data-bs-toggle="tooltip" aria-label="Cari pengguna" title="Cari pengguna" onclick="searchPengguna();"><i class="ti ti-search fa-lg"></i>
											</a>
											 
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="pb-2" id="posts_content">
						<?php if(!empty($record)){ ?>
							<div class="table-responsive">
								<table class="table card-table table-vcenter text-nowrap datatable">
									<thead class="thead-dark">
										<tr>
											<th class="w-1 text-center">No</th>
											<th class="w-15 text-left">Nama Lengkap</th>
											<th class="w-15 text-left">Nama Pengguna</th>
											<th class="w-15 text-left">Tanggal Input</th>
											<th class="w-15 text-left">Level</th>
											<th class="w-12 text-end">Status | Aksi</th>
										</tr>
										</thead>
									<tbody>
										<?php 
											$no = 1;
											foreach ($record as $row){
												if ($row['level'] == 'admin'){ 
													$hapus = '<a class="btn btn-danger" data-id="'.encrypt_url($row['id_user']).'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</a>';
													}else{ 
													$hapus = '<a class="btn btn-danger" data-id="'.encrypt_url($row['id_user']).'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</a>';
												}
												if ($row['aktif'] == 'Y'){ $aktif ='<i class="fa fa-check-circle" data-bs-toggle="tooltip" title="Aktif"></i>'; }else{ $aktif = '<i class="fa fa-check-circle-o" data-bs-toggle="tooltip" title="Tikda Aktif"></i>'; }
												$kode = encrypt_url($row['id_user']);
											?>
											<tr>
												<td><?=$no;?></td>
												<td><?=$row['nama_lengkap'];?></td>
												<td><?=$row['email'];?></td>
												<td><?=indo_date($row['tgl_daftar']);?></td>
												<td><span class="badge badge-success flat"><?=$row['level'];?></span></td>
												<td align="right">
													<div class="btn-group btn-group-sm">
														<a href="#" class="btn btn-primary btn-sm active" aria-current="page"><?=$aktif;?></a>
														<a href='javascript:void(0);' class="btn btn-primary" data-bs-toggle='modal' data-bs-target='#OpenModalUser' data-id='<?=encrypt_url($row['id_user']);?>' data-mod='edit' class='openPopup text-info'><i class="ti ti-edit"></i>&nbsp;&nbsp;Edit</a>
														<?=$hapus;?>
													</div>
												</td>
											</tr>
											<?php $no++;
											}
										?>
									</tbody>
								</table> 
							</div>
							<div class="p-3">
								<?php echo $this->ajax_pagination->create_links(); ?>
							</div>
							<?php }else{ ?>
							<table class='table table-bordered'>
								<tr>
									<td>Belum ada data</td>
								</tr>
							</table>
						<?php } ?>
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
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabelPengguna">Tambah Pengguna</h5>
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
<style>
    .select2-container {
    width: 100% !important;
	padding: 0;
	z-index:1050;
	}
	
</style>

<script>
	 
    function searchPengguna(page_num){
        page_num = page_num?page_num:0;
		var limit = $('#limits').val();
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        $.ajax({
            type: 'POST',
            url: base_url+'user/ajaxPengguna/'+page_num,
            data:{page:page_num,
				limit:limit,
				keywords:keywords,
				sortBy:sortBy
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
		
		if(id != 0){
			var urldata = "edit_user";
			var tipe = 'edit';
            $("#myModalLabelPengguna").html("Edit Pengguna")
			}else{
			var urldata = "add_user";
			var tipe = 'new';
		}
		$.ajax({
			type: 'POST',
			url: base_url + "user/"+urldata,
			data: {tipe:tipe,id:id,mod:mod},
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
	
	
	function simpanMember()
	{
		// console.log('submit');
		if($("#mail").val()==''){
			$("#mail").addClass('form-control-warning');
			showNotif('top-center','Input Data','Harus diisi','warning');
			$("#mail").focus();
			return;
		}
		if($("#title").val()==''){
			$("#title").addClass('form-control-warning');
			showNotif('top-center','Input Data','Harus diisi','warning');
			$("#title").focus();
			return;
		}
		
		if($("#daftar").val()==''){
			$("#daftar").addClass('form-control-warning');
			showNotif('top-center','Input Data','Harus diisi','warning');
			$("#daftar").focus();
			return;
		}
		if($("#phone").val()==''){
			$("#phone").addClass('form-control-warning');
			showNotif('top-center','Input Data','Harus diisi','warning');
			$("#phone").focus();
			return;
		}
		if($("#alamat").val()==''){
			$("#alamat").addClass('form-control-warning');
			showNotif('top-center','Input Data','Harus diisi','warning');
			$("#alamat").focus();
			return;
		}
		
		var formData = $("#formAdd").serialize();
		$.ajax({
			type: "POST",
			url: base_url+"user/simpan_pengguna",
			dataType: 'json',
			data: formData,
			beforeSend: function () {
				$("body").loading({zIndex:1060});　
			},
			success: function(data) {
				$('body').loading('stop');
				if(data.status==200){
					showNotif('bottom-right',data.title,data.msg,'success');
					$("#OpenModalUser").modal('hide');
					}else{
					showNotif('bottom-right',data.title,data.msg,'error');
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
			url: base_url + 'user/hapus_user',
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
</script>        