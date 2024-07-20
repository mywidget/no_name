<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Pengaturan
				</div>
                <h2 class="page-title">
					Tanda Tangan
				</h2>
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
						<h3 class="card-title">List data</h3>
					</div>
					<div class="card-body" id="posts_content">
						<?php if(!empty($list)){ ?>
							<div class="table-responsive">
								<table id="table_ttd" class="table card-table table-vcenter text-nowrap datatable">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama Pejabat</th>
											<th>Pangkat</th>
											<th>Jabatan</th>
											<th>NRP</th>
											<th class="text-end">Aksi</th>
										</tr>
									</thead>
									<tbody id="exampleid">
										<?php
											$no = 1;
											foreach($list as $row){
											?>
											<tr>
												<td><?=$no;?></td>
												<td><a href="javascript:;" data-bs-toggle='modal' data-bs-target='#OpenModal' data-id='<?=$row->id;?>'><?=$row->nama;?></a></td>
												<td><?=$row->pangkat;?></td>
												<td><?=$row->jabatan;?></td>
												<td><?=$row->nrp;?></td>
												<td class="text-end">
													<a href="javascript:;" class="btn btn-primary btn-sm active" data-bs-toggle='modal' data-bs-target='#OpenModal' data-id='<?=$row->id;?>'><i class="ti ti-list-details"></i>&nbsp;Edit</a>
												</td>
											</tr>
											<?php $no++; 
											}
										?>
									</tbody>
								</table>
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
<div class="modal modal-blur fade" id="OpenModal" tabindex="-1">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="LabelKirimBarang">Edit data</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body  pb-0 mt-0 pt-1">
				<form id="form_ttd">
					<div class="form-group mb-1">
						<label class="form-label" for="nama">Nama</label>
						<input type="text" name="nama" value="" class="form-control" id="nama" placeholder="nama" required="">
						<input type="hidden" name="id" id="id" required="">
					</div>
					<div class="form-group mb-1">
						<label class="form-label" for="pangkat">Pangkat</label>
						<input type="text" name="pangkat" value="" class="form-control" id="pangkat" placeholder="pangkat" required="">
					</div>
					<div class="form-group mb-1">
						<label class="form-label" for="jabatan">Jabatan</label>
						<input type="text" name="jabatan" value="" class="form-control" id="jabatan" placeholder="jabatan" required="">
					</div>
					<div class="form-group mb-1">
						<label class="form-label" for="nrp">NRP</label>
						<input type="text" name="nrp" value="" class="form-control" id="nrp" placeholder="nrp" required="">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" onClick="simpanTtd()"><i class="fa fa-save"></i>&nbsp;Simpan</button>
				<button type="button" class="btn bg-red" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
	 
	$('#OpenModal').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).data('id');
		
		if(id > 0){
			$.ajax({
				type: 'POST',
				url: base_url + "user/get_ttd",
				data: {id:id},
				dataType: "json",
				beforeSend: function () {
					$("body").loading({zIndex:1060});　
				},
				success: function(data) {
					if(data.status==200)
					{
						$('#id').val(data.id);
						$('#nama').val(data.nama);
						$('#pangkat').val(data.pangkat);
						$('#jabatan').val(data.jabatan);
						$('#nrp').val(data.nrp);
						}else{
						sweet('Peringatan!!!',data.msg,'warning','warning');
					}
					$('body').loading('stop');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
					$('body').loading('stop');
				}
			});
		}
	});
	
	
	function simpanTtd()
	{
		
		if($("#nama").val()==''){
			$("#nama").addClass('form-control-warning');
			showNotif('top-center','Input Data','nama diisi','warning');
			$("#nama").focus();
			return;
		}
		if($("#pangkat").val()==''){
			$("#pangkat").addClass('form-control-warning');
			showNotif('top-center','Input Data','pangkat diisi','warning');
			$("#pangkat").focus();
			return;
		}
		if($("#jabatan").val()==''){
			$("#jabatan").addClass('form-control-warning');
			showNotif('top-center','Input Data','jabatan diisi','warning');
			$("#jabatan").focus();
			return;
		}
		if($("#nrp").val()==''){
			$("#nrp").addClass('form-control-warning');
			showNotif('top-center','Input Data','nrp diisi','warning');
			$("#nrp").focus();
			return;
		}
		
		
		var formData = $("#form_ttd").serialize();
		$.ajax({
			type: "POST",
			url: base_url+"user/simpan_ttd",
			dataType: 'json',
			data: formData,
			beforeSend: function () {
				$("body").loading({zIndex:1060});　
			},
			success: function(data) {
				$('body').loading('stop');
				$("#table_ttd").load(location.href + " #table_ttd");
				if(data.status==200){
					showNotif('bottom-right',data.title,data.msg,'success');
					$("#OpenModal").modal('hide');
					}else{
					showNotif('bottom-right',data.title,data.msg,'error');
				}
				 
				} ,error: function(xhr, status, error) {
				showNotif('bottom-right','Peringatan',error,'error');
				$('body').loading('stop');
			}
		});
	}
	
	
</script>		