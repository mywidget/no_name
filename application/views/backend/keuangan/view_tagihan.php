<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					<?=$menu;?>
				</div>
                <h2 class="page-title">
					Data Tagihan
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
							
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Sort</div>
								<div class="mx-2 d-inline-block">
									<select id="sortBy" class="form-control form-select w-1" onchange="searchBiaya()" style="width:85px!important">
										<option value="ASC">ASC</option>
										<option value="DESC" selected>DESC</option>
									</select>
								</div>
							</div>
							
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Status</div>
								<div class="mx-2 d-inline-block">
									<select id="sortBy" class="form-control form-select w-1" onchange="searchBiaya()" style="width:80px!important">
										<option value="" selected>PILIH</option>
										<option value="Y">Lunas</option>
										<option value="N" >Belum Lunas</option>
									</select>
								</div>
							</div>
							<div class="text-muted">
								<div class="mx-2 d-inline-block">
									<select id="tahun_akademik_filter" class="form-control form-select w-5" style="width:200px!important" onchange="searchBiaya()">
										<option value="">Tahun Akademik</option>
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
							<label class="form-label" for="title">Title</label>
							<input type="text" name="title" class="form-control" id="title" placeholder="Title" value="" required="" autocomplete="off">
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="nama">Nama</label>
							<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="" required="">
						</div>
						<div class="form-group mb-1">
							<label class="form-label" for="nomor">Nomor Whatsapp</label>
							<input type="text" name="nomor" class="form-control" id="nomor" placeholder="Nomor Whatsapp" value="" required="">
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

<!-- bayar invoice -->
<div class="modal fade" id="ModalBayar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" id="saving-bayar">
        <div class="modal-content flat">
            <div class="modal-header py-1">
                <h4 class="modal-title">BAYAR TAGIHAN #<span class="tinvoice"></span></h4>
			</div>
            <div class="modal-body pb-0">
                <div class="form-group row mb-0">
                    <label  class="col-4 col-form-label"> 
                        <div class="input-group">
                            BAYAR&nbsp;&nbsp;
                            <div class="custom-control custom-radio">
                                <input type="radio" id="Bayar1" name="Bayar" class="custom-control-input Bayar" value="1" checked>
                                <label class="custom-control-label" for="Bayar1"> FULL&nbsp;&nbsp;</label>
							</div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="Bayar2" name="Bayar" class="custom-control-input Bayar" value="2" >
                                <label class="custom-control-label" for="Bayar2">SEBAGIAN</label>
								</div>
						</div>
					</label> 
                    <div class="col-8">
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" for="id_byr">CARA BAYAR</span>
							</div>
                            <select name="id_byr" id="id_byr" onchange="sumawal()" class="custom-select form-control form-control-sm"  data-valueKey="id" data-displayKey="name" required>
							</select>
                            <div class="input-group-prepend">
                                <span class="input-group-text" for="rekening">REKENING</span>
							</div>
                            <select name="rekening" id="rekening" class="custom-select form-control form-control-sm rekening" disabled>
							</select>
						</div>
					</div>
				</div> 
                <div class="form-group row mb-0 lampiran">
                    <label for="lampiran" class="col-4 col-form-label">Bukti Transfer</label> 
                    <div class="col-8">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary preview p-0 flat" id="preview" >
                                    <img class="img-preview mklbItem" id="imageresource" src="<?=base_url('assets/img/bone.jpg');?>"  data-toggle='tooltip' title="Preview bukti transfer" style="width: 30px; height: 30px; object-fit: cover;">
								</button>
							</div>
                            <div class="custom-file form-control-sm">
                                <input class="custom-file-input" name='lampiran' id="lampiran" type="file">
                                <label class="custom-file-label" for="lampiran">Format file jpeg | jpg | png | webp</label>
							</div>
						</div>
					</div>
				</div>
                <div class="form-group row mb-0">
                    <label for="pajak" class="col-4 col-form-label">PPN | Total Pajak</label> 
                    <div class="col-4">
                        <div class="input-group">
                            <input id="pajak" name="pajak" value="0" type="text" onchange="inputan()" class="form-control form-control-sm"> 
                            <div class="input-group-append">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-warning btn-sm flat pajakd" id="pajakd" disabled>% INPUT PAJAK</button>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <button style="display:none" type="button" onclick="savpajak();" class="btn btn-success btn-sm flat savpajak" id="savpajak" data-toggle='tooltip' title="Simpan Pajak"><i class="fa fa-save"></i></button>
                                        <button style="display:none" type="button" onclick="batal();" class="btn btn-danger btn-sm batal" id="batal"><i class="fa fa-times"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-4">
                        <div class="input-group">
                            <input id="sumpajak" name="sumpajak" type="text" class="form-control form-control-sm" readonly>
						</div>
					</div>
				</div>
                
                <div class="form-group row mb-0">
                    <label for="sisabayar" class="col-4 col-form-label">TOTAL ORDER</label> 
                    <div class="col-8">
                        <div class="input-group">
                            <input id="sisabayar" name="sisabayar" type="text" class="form-control form-control-sm" readonly>
						</div>
					</div>
				</div> 
                <div class="form-group row mb-0">
                    <label for="totalbyr" class="col-4 col-form-label">SISA</label> 
                    <div class="col-8">
                        <div class="input-group">
                            <input id="totalbyr" name="totalbyr" type="text" value="0" class="form-control form-control-sm" readonly>
                            <input id="total_bayar" name="total_bayar" type="hidden" value="0" class="form-control form-control-sm" readonly>
						</div>
					</div>
				</div> 
                <div class="form-group row mb-0 p-0 flat">
                    <label for="nominal" class="col-4 col-form-label">NOMINAL</label> 
                    <div class="col-8">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary btn-sm flat n-bayar" data-id="50000">50.000</button>
                            <button class="btn btn-secondary btn-sm flat n-bayar" data-id="100000">100.000</button>
                            <button class="btn btn-success btn-sm flat n-bayar" data-id="200000">200.000</button>
                            <button class="btn btn-info btn-sm flat n-bayar" data-id="300000">300.000</button>
                            <button class="btn btn-warning btn-sm flat n-bayar" data-id="400000">400.000</button>
                            <button class="btn btn-danger btn-sm flat n-bayar" data-id="500000">500.000</button>
                            <button type="button" onclick="lunasd();" class="btn btn-dark btn-sm flat lunasd">UANGPAS</button>
						</div>
					</div>
				</div>
                <div class="form-group row mb-0 flat">
                    <label for="uangm" class="col-4 col-form-label">JUMLAH BAYAR</label> 
                    <div class="col-8">
                        <div class="input-group flat">
                            <input id="uangm" name="uangm" type="text" onchange="inputan()" onkeyup="kembalian()" class="form-control form-control-sm input"> 
						</div>
					</div>
				</div>
                <div class="form-group row mb-0 mt-0">
                    <label for="kembalian" class="col-4 col-form-label">KEMBALIAN</label> 
                    <div class="col-8">
                        <div class="input-group">
                            <input id="kembalian" name="kembalian" type="text" class="form-control form-control-sm" readonly>
						</div>
					</div>
				</div> 
                
                <div class="form-group row">
                    <div class="col-12 load-bayar"></div>
				</div>
			</div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary flat bayar_l" id="bayar_l" disabled>SIMPAN BAYAR</button>
                <button type="button" class="btn btn-danger flat" data-dismiss="modal">TUTUP</button>
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
				url: base_url+'keuangan/ajax_list/'+page_num,
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
		$(document).ready(function() {
			$.ajax({
				url: "<?php echo base_url('psb/get_tahun_akademik'); ?>", // Ganti dengan URL untuk mengambil data tahun akademik
				type: "GET",
				dataType: "json",
				success: function(data) {
					var dropdown = $('#tahun_akademik_filter');
					dropdown.empty(); // Kosongkan dropdown terlebih dahulu
					dropdown.append('<option value="">Pilih Tahun Akademik</option>'); // Option default
					
					$.each(data, function(index, item) {
						dropdown.append('<option value="' + item.id_tahun_akademik + '">' + item.nama_tahun + '</option>');
					});
				}
			});
		});
		$('#ModalBayar').on('show.bs.modal', function(e) {
			var id = $(e.relatedTarget).data('id');
			var mod = $(e.relatedTarget).data('mod');
			$('input').val('');
			if(id != 0){
				$('#type').val('edit');
				$("#myModalLabel").html("Edit Panitia")
				$.ajax({
					type: 'POST',
					url: base_url + "keuangan/edit_data",
					data: {id:id,mod:mod},
					dataType: "json",
					beforeSend: function () {
						$("body").loading({zIndex:1060});
					},
					success: function(data) {
						$('#id').val(data.id);
						$('#title').val(data.title);
						$('#nama').val(data.nama);
						$('#nomor').val(data.nomor);
						$('#aktif').val(data.aktif);
						$('body').loading('stop');
					},
					error: function (xhr, ajaxOptions, thrownError) {
						sweet('Peringatan!!!',thrownError,'warning','warning');
						$('body').loading('stop');
					}
				});
				}else{
				
				$("#myModalLabel").html("Tambah Panitia")
				$('#type').val('new');
			}
			
		});
		
		
		function simpanData()
		{
			
			if($("#title").val()==''){
				$("#title").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#title").focus();
				return;
			}
			if($("#nama").val()==''){
				$("#nama").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#nama").focus();
				return;
			}
			if($("#nomor").val()==''){
				$("#nomor").addClass('form-control-warning');
				showNotif('top-center','Input Data','Harus diisi','warning');
				$("#nomor").focus();
				return;
			}
			
			var formData = $("#formAdd").serialize();
			$.ajax({
				type: "POST",
				url: base_url+"panitia/simpan_data",
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
				url: base_url + 'panitia/hapus_data',
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