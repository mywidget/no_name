<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Tiket
				</div>
                <h2 class="page-title">
					Support Tiket
				</h2>
			</div>
			<div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
					
					<a href="#BuatTiket" data-bs-toggle="modal" data-bs-target="#BuatTiket" class="btn btn-primary d-none d-sm-inline-block">
						<i class="ti ti-plus fa-lg"></i>
						Buat Tiket
					</a>
					<a href="#BuatTiket" data-bs-toggle="modal" data-bs-target="#BuatTiket" class="btn btn-primary d-sm-none btn-icon">
						<i class="ti ti-plus fa-lg"></i>
					</a>
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
						<h3 class="card-title">Data Tiket</h3>
					</div>
					<div class="card-body">
						<div class="d-flex table-responsive">
							<div class="text-muted">
								SHOW
								<div class="mx-2 d-inline-block">
									<select id="limits" name="limits" class="form-control form-select" style="width:70px!important" onchange="search_tiket()">
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
										<option value="150">150</option>
									</select>
								</div>
								
							</div>
							<div class="text-muted">
								Materiel
								<div class="mx-2 d-inline-block">
									<select id="kategori" class="form-control form-select w-1" onchange="search_tiket()" style="width:100px!important">
										<option value="" selected>Pilih</option>
										<?php foreach($kategori->result() AS $row){ ?>
											<option value="<?=$row->id_sub;?>"><?=$row->title;?></option>
										<?php } ?>
									</select>
								</div>
								
							</div>
							<div class="text-muted">
								Satker
								<div class="mx-2 d-inline-block">
									<select id="satker" class="form-control form-select w-1" onchange="search_tiket()" style="width:100px!important">
										<option value="" selected>Pilih</option>
										<?php foreach($divisi->result() AS $row){ ?>
											<option value="<?=$row->id;?>"><?=$row->nama_divisi;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="text-muted">
								Status
								<div class="mx-2 d-inline-block">
									<select id="status_sort" class="form-control form-select w-1" onchange="search_tiket()" style="width:100px!important">
										<option value="">Pilih</option>
										<option value="1" selected>BARU</option>
										<option value="2">SELESAI</option>
										<option value="3">PENDING</option>
										<option value="4">CANCEL</option>
										<option value="5">HAPUS</option>
									</select>
								</div>
							</div>
							<div class="ms-auto text-muted">
								Cari:
								<div class="ms-2 d-inline-block">
									<div class="input-group">
										<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="search_tiket();"/>
										<span class="input-group-text">
											<a href="#" class="link-secondary clear" data-bs-toggle="tooltip" aria-label="Clear search" title="Clear search">
												<i class="ti ti-x fa-lg"></i>
											</a>
											
											<a href="#" class="link-secondary ms-2" data-bs-toggle="tooltip" aria-label="Cari kode" title="Cari kode | nomor tiket" onkeyup="search_tiket();"><i class="ti ti-search fa-lg"></i>
											</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="posts_content">
						<?php if(!empty($record)){ ?>
							<div class="table-responsive">
								<table class="table card-table table-vcenter text-nowrap table-striped">
									<thead class="thead-dark">
										<tr>
											<th width=5%>No.</th>
											<th class="text-start" width="10%">Tanggal Tiket</th>
											<th width="5%">Kode</th>
											<th>Nomor tiket</th>
											<th>satuan kerja</th>
											<th>Materiel</th>
											<th>Jml</th>
											<th class="text-start" width="10%">Tanggal Penggunaan</th>
											<th class="text-end" width=5%>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$no=1;
											
											foreach($record as $row){
												$nama ='';
												$bg ='';
												$disabled ='';
												if($row['status']==1){
													$nama = '<i class="fa fa-spinner fa-spin"></i>&nbsp;PROSES';
													$bg = 'info';
												}
												if($row['status']==2){
													$nama = 'SELESAI';
													$bg = 'success';
													$disabled = 'disabled';
												}
												if($row['status']==3){
													$nama = 'PENDING';
													$bg = 'warning';
												}
												if($row['status']==4){
													$nama = 'CANCEL';
													$bg = 'secondary';
													$disabled = 'disabled';
												}
												if($row['status']==5){
													$nama = 'HAPUS';
													$bg = 'danger';
													$disabled = 'disabled';
												}
											 
											?>
											<tr>
												<td><?=$no;?></td>
												<td><?=tanggal_indo($row['tanggal'],true)?></td>
												<td><?=$row['kode']?></td>
												<td><?=$row['nomor_tiket']?></td>
												<td align="left"><span><?=divisi($row['id_divisi'])['title'];?></span></td>
												<td align="left"><span><?=get_parent($row['id_master'])->tag;?></span></td>
												<td><?=$row['jml']?></td>
												<td><?=tanggal_indo($row['tanggal_penggunaan'],true)?></td>
												<td class="text-end">
													<div class="btn-group btn-group-sm">
														<button data-bs-toggle="modal" data-bs-target="#DetailTiket"  data-id="<?=$row['id'];?>" class="btn btn-<?=$bg;?>"><?=$nama;?></button>
														<?php if($level=='admin'){ ?>
															<button data-bs-toggle="modal" data-bs-target="#EditTiket" class="btn btn-default" data-id="<?=$row['id'];?>" <?=$disabled;?>><i class="ti ti-address-book"></i> Edit</button>
														<?php } ?>
													</div>
												</td>
											</tr>
											<?php
											$no++;}
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
			</div><!-- /.row -->
		</div>
	</div>
</div>

<div class="modal modal-blur fade" id="BuatTiket" tabindex="-1">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="LabelTerimaBarang">Buat Tiket</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body pb-0 mt-0 pt-1">
                <form id="save_tiket">
					<input type="hidden" class="form-control" id="mod" name="mod" value="buat">
					
					<div class="card-block">
						<label class="form-label" for="tanggal">Tanggal Tiket</label>
						<div class="input-icon mb-1">
							<input type="date" name="tanggal" class="form-control" id="tanggal" value="<?=$tanggal;?>" autocomplate="off">
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="Materiel">Materiel</label>
							<select name="Materiel" id="Materiel" class="form-control form-select"  required="">
								<option value="0">Pilih Materiel</option>
								<?php
									foreach($kategori->result_array() AS $row){
										echo "<option value=$row[id_sub]>$row[title]</option>"; 
									}
								?>
							</select>
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="kode">Kode Transaksi</label>
							<input type="text" name="kode" value="" class="form-control" id="kode" required="" autocomplate="off">
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="keterangan">Keterangan</label>
							<textarea name="keterangan" value="" class="form-control" id="keterangan" required="" autocomplate="off"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" onClick="submit_tiket()" id="btn-tiket" class="btn btn-success">Submit</button>
				<button type="button" class="btn bg-red" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal modal-blur fade" id="EditTiket" tabindex="-1">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="LabelTerimaBarang">Edit Tiket</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body pb-0 mt-0 pt-1">
                <form id="save_status">
					<input type="hidden" class="form-control" id="id_tiket" name="id_tiket">
					<input type="hidden" class="form-control" id="id_divisi" name="id_divisi">
					<input type="hidden" class="form-control" id="mod_edit" name="mod_edit" value="edit">
					
					<div class="card-block">
						<label class="form-label" for="tanggal">Tanggal</label>
						<div class="input-icon mb-1">
							<input type="date" name="tanggal_edit" value="" class="form-control" id="tanggal_edit" required="" autocomplate="off" disabled>
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="materiel_edit">Materiel</label>
							<select name="materiel_edit" id="materiel_edit" class="form-control form-select"  required="" readonly>
								<option value="0">Pilih Materiel</option>
								<?php
									foreach($kategori->result_array() AS $row){
										echo "<option value=$row[id_sub]>$row[title]</option>"; 
									}
								?>
							</select>
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="kode_edit">Kode Transaksi</label>
							<input type="text" name="kode_edit" class="form-control" id="kode_edit" required="" autocomplate="off" readonly>
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="keterangan_edit">Keterangan</label>
							<textarea name="keterangan_edit" value="" class="form-control" id="keterangan_edit" required="" autocomplate="off" readonly></textarea>
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="keterangan_balas">Keterangan Balasan</label>
							<textarea name="keterangan_balas" value="" class="form-control" id="keterangan_balas" required="" autocomplate="off"></textarea>
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="status">Status</label>
							<select name="status" id="status" class="form-control form-select"  required="">
								<option value="1">PROSES</option>
								<option value="2">SELESAI</option>
								<option value="3">PENDING</option>
								<option value="4">CANCEL</option>
								<option value="5">HAPUS</option>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" onClick="simpan_status()" id="btn-status" class="btn btn-success">Submit</button>
				<button type="button" class="btn bg-red" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-blur fade" id="DetailTiket" tabindex="-1">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="LabelTerimaBarang">Detail Tiket</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body pb-0 mt-0 pt-1">
                <form id="savestatus">
					<div class="card-block">
						<label class="form-label" for="tanggal">Tanggal</label>
						<div class="input-icon mb-1">
							<input type="date" name="tanggal_detail" value="" class="form-control" id="tanggal_detail" required="" autocomplate="off" disabled>
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="materiel_edit">Materiel</label>
							<select name="materiel_edit" id="materiel_detail" class="form-control form-select"  required="" disabled>
								<option value="0">Pilih Materiel</option>
								<?php
									foreach($kategori->result_array() AS $row){
										echo "<option value=$row[id_sub]>$row[title]</option>"; 
									}
								?>
							</select>
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="kode_detail">Kode Transaksi</label>
							<input type="text" class="form-control" id="kode_detail" required="" autocomplate="off" disabled>
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="keterangan_edit">Keterangan</label>
							<textarea class="form-control" id="keterangan_detail" required="" autocomplate="off" disabled></textarea>
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="balas_detail">Keterangan Balasan</label>
							<textarea class="form-control" id="balas_detail" required="" autocomplate="off" disabled></textarea>
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="status">Status</label>
							<select name="status_detail" id="status_detail" class="form-control form-select"  required="" disabled>
								<option value="1">PROSES</option>
								<option value="2">SELESAI</option>
								<option value="3">PENDING</option>
								<option value="4">CANCEL</option>
								<option value="5">HAPUS</option>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn bg-red" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<style>
	select[readonly]
	{
    pointer-events: none;
	}
</style>	
<script>
	
    function search_tiket(page_num){
        page_num = page_num?page_num:0;
        var limit = $('#limits').val();
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var kategori = $('#kategori').val();
        var satker = $('#satker').val();
        var status = $('#status_sort').val();
        $.ajax({
            type: 'POST',
            url: base_url+'ticket/ajaxTiket/'+page_num,
            data:{page:page_num,
				limit:limit,
				keywords:keywords,
				sortBy:sortBy,
				kategori:kategori,
				satker:satker,
				status:status
				},
            beforeSend: function(){
                $('body').loading();
			},
            success: function(html){
                $('#posts_content').html(html);
                $('body').loading('stop');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
				$('body').loading('stop');
			}
		});
	}
	
	$('#EditTiket').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).data('id');
		var mod = $(e.relatedTarget).data('mod');
		
		if(id != 0){
			$.ajax({
				type: 'POST',
				url: base_url + "ticket/load_tiket",
				data: {id:id,mod:mod},
				dataType: "json",
				beforeSend: function () {
					$('body').loading();
				},
				success: function(data) {
					// console.log(data)
					$('#id_tiket').val(data.id);
					$('#id_divisi').val(data.id_divisi);
					$('#tanggal_edit').val(data.tanggal);
					$('#materiel_edit').val(data.materiel);
					$('#kode_edit').val(data.kode);
					$('#keterangan_edit').val(data.keterangan);
					$('#status').val(data.status);
					$('body').loading('stop');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
					$('body').loading('stop');
				}
			});
			
			notifikasi_tiket();
			}else{
			$('#type').val('add');
		}
		
	});
	
	$('#DetailTiket').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).data('id');
		var mod = $(e.relatedTarget).data('mod');
		
		if(id != 0){
			$.ajax({
				type: 'POST',
				url: base_url + "ticket/load_tiket",
				data: {id:id},
				dataType: "json",
				beforeSend: function () {
					$('body').loading();
				},
				success: function(data) {
					// console.log(data)
					$('#tanggal_detail').val(data.tanggal);
					$('#materiel_detail').val(data.materiel);
					$('#kode_detail').val(data.kode);
					$('#keterangan_detail').val(data.keterangan);
					$('#balas_detail').val(data.balasan);
					$('#status_detail').val(data.status);
					$('body').loading('stop');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
					$('body').loading('stop');
				}
			});
			
			notifikasi_tiket();
			}else{
			$('#type').val('add');
		}
		
	});
	
	
	function submit_tiket()
	{
		
		if($("#tanggal").val()==''){
			$("#tanggal").addClass('form-control-warning');
			showNotif('top-center','Input Data','Harus diisi','warning');
			$("#tanggal").focus();
			return;
		}
		if($("#Materiel").val()==0){
			$("#Materiel").addClass('form-control-warning');
			showNotif('top-center','Input Data','Materiel Harus dipilih','warning');
			$("#Materiel").focus();
			return;
		}
		if($("#kode").val()==''){
			$("#kode").addClass('form-control-warning');
			showNotif('top-center','Input Data','Kode Transaksi Harus diisi','warning');
			$("#kode").focus();
			return;
		}
		
		if($("#keterangan").val()==''){
			$("#keterangan").addClass('form-control-warning');
			showNotif('top-center','Input Data','Keterangan Harus diisi','warning');
			$("#keterangan").focus();
			return;
		}
		$("#btn-tiket").attr('disabled',true);
		
		var formData = $("#save_tiket").serialize();
		$.ajax({
			type: "POST",
			url: base_url+"ticket/simpan_tiket",
			dataType: 'json',
			data: formData,
			beforeSend: function () {
				$("body").loading({zIndex:1060});
			},
			success: function(data) {
				$('body').loading('stop');
				if(data.status==200){
					showNotif('bottom-right',data.title,data.msg,'success');
					$("#BuatTiket").modal('hide');
					search_tiket();
					}else{
					showNotif('bottom-right',data.title,data.msg,'error');
				}
				$("#btn-tiket").attr('disabled',false);
				} ,error: function(xhr, status, error) {
				showNotif('bottom-right','Peringatan',error,'error');
				$('body').loading('stop');
				$("#btn-tiket").attr('disabled',false);
			}
		});
	}
	
	function simpan_status()
	{
		
		if($("#kode_edit").val()==''){
			$("#kode_edit").addClass('form-control-warning');
			showNotif('top-center','Input Data','Harus diisi','warning');
			$("#kode_edit").focus();
			return;
		}
		if($("#status").val()==1){
			$("#status").addClass('form-control-warning');
			showNotif('top-center','Input Data','Status belum dipilih','warning');
			$("#status").focus();
			return;
		}
		$("#btn-status").attr('disabled',true);
		var formData = $("#save_status").serialize();
		$.ajax({
			type: "POST",
			url: base_url+"ticket/simpan_tiket",
			dataType: 'json',
			data: formData,
			beforeSend: function () {
				$("body").loading({zIndex:1060});
			},
			success: function(data) {
				$('body').loading('stop');
				if(data.status==200){
					showNotif('bottom-right',data.title,data.msg,'success');
					$("#EditTiket").modal('hide');
					}else{
					showNotif('bottom-right',data.title,data.msg,'error');
				}
				$("#btn-status").attr('disabled',false);
				search_tiket();
				} ,error: function(xhr, status, error) {
				showNotif('bottom-right','Peringatan',error,'error');
				$('body').loading('stop');
				$("#btn-status").attr('disabled',false);
			}
		});
	}
	$('#BuatTiket').on('hidden.bs.modal', function () {
		$(this).find('form').trigger('reset');
	})
	$('#EditTiket').on('hidden.bs.modal', function () {
		$(this).find('form').trigger('reset');
	})
	$(document).on('click','.clear',function(e){
		$("#limits").val(10);
		$("#keywords").val('');
		search_tiket();
	});
	
</script>        	