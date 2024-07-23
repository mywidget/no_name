<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Whatsapp
				</div>
                <h2 class="page-title">
					Broadcast Pesan
				</h2>
			</div>
			<div class="col-12 col-md-auto ms-auto d-print-none">
				<button class="btn btn-primary d-none d-sm-inline-block add_template" data-id="0">
					<i class="ti ti-plus fa-lg"></i>
					Buat Broadcast
				</button>
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
<div class="modal fade" id="ModalTemplate" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
		<div class="modal-content flat">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Form edit</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="form-broadcast" method="post">
					<input type='hidden' name='id' id='id_broadcast' value='0'>
					<input type='hidden' name='type' id="type_broadcast">
					<div class="card-block">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group my-1">
									<label class="form-label" for="title">Judul</label>
									<input type="text" name="title" id="title_template" class="form-control" required>
								</div>
								<div class="form-group my-1">
									<label class="form-label" for="inisial">Isi Pesan</label>
									<textarea class="form-control fcs" rows="8" id="deskripsi" name="deskripsi" required></textarea>
								</div>
								
								<div class="form-group my-1">
									<label class="form-label" for="unit_kelas">Kirim Ke</label>
									<select id="unit_kelas" name="unit" class="form-control custom-select">
										<option value="SEMUA">Semua Unit</option>
										<?php foreach($unit AS $val): ?>
										<option value="<?=$val->id;?>"><?=$val->nama_jurusan;?></option>
										<?php endforeach; ?>
										<option value="Baru">PENDAFTAR BARU</option>
										<option value="Kenaikan Tingkatan">KENAIKAN TINGKAT</option>
									</select>
								</div>
								<div class="form-group my-1">
									<label for="schedule">Schedule</label>
									<div class="input-group input-group-sm">
										<div class="input-group-prepend"  data-bs-toggle="tooltip" data-bs-placement="top" title="Format AM/PM ke 24 Jam">
											<button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#ModalFormat">Format AM/PM</button>
										</div>
										<input type="datetime-local" class="form-control" id="schedule" name="schedule">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<ul class="pl-3">
									<li><small>{selamat} : SELAMAT PAGI | SIANG | SORE | MALAM</small></li>
									<li><small>{nama_sekolah} : NAMA SEKOLAH</small></li>
									<li><small>{web_sekolah} : ALAMAT WEBSITE</small></li>
									<li><small>{whatsapp} : NO. WA ADMIN</small></li>
									<li><small>{email_sekolah} : EMAIL SEKOLAH</small></li>
									<li><small>{alamat_sekolah} : ALAMAT SEKOLAH</small></li>
									<li><small>{nomor_pendaftaran} : NOMOR PENDAFTARAN</small></li>
									<li><small>{tgl_pendaftaran} : TANGGAL DAFTAR</small></li>
									<li><small>{nama_pendaftar} : NAMA PENDAFTARA</small></li>
									<li><small>{nik} : NIK PENDAFTARA</small></li>
									<li><small>{nisn} : NOMOR NISN PENDAFTARA</small></li>
									<li><small>{email_pendaftar} : EMAIL PENDAFTARA</small></li>
									<li><small>{unit} : UNIT PILIHAN</small></li>
									<li><small>{kelas} : KELAS PILIHAN</small></li>
									<li><small>{kamar} : KAMAR PILIHAN</small></li>
									<li><small>{biaya} : BIAYA PENDAFTARAN</small></li>
									<li><small>{cetak_formulir} : LINK CETAK FORMULIR PENDAFTARAN</small></li>
								</ul>
							</div>
						</div>
					</div>
					
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" name="submit" class="btn btn-info save_data">Simpan</button>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ModalFormat" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">24-Hour Clock Time Conversion Table</h5>
				<button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#ModalTemplate"></button>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered">
					<tr>
						<td class="boxcontent">1 AM</td>
						<td class="boxcontent">01:00</td>
					</tr>
					<tr>
						<td class="boxcontent">2 AM</td>
						<td class="boxcontent">02:00</td>
					</tr>
					<tr>
						<td class="boxcontent">3 AM</td>
						<td class="boxcontent">03:00</td>
					</tr>
					<tr>
						<td class="boxcontent">4 AM</td>
						<td class="boxcontent">04:00</td>
					</tr>
					<tr>
						<td class="boxcontent">5 AM</td>
						<td class="boxcontent">05:00</td>
					</tr>
					<tr>
						<td class="boxcontent">6 AM</td>
						<td class="boxcontent">06:00</td>
					</tr>
					<tr>
						<td class="boxcontent">7 AM</td>
						<td class="boxcontent">07:00</td>
					</tr>
					<tr>
						<td class="boxcontent">8 AM</td>
						<td class="boxcontent">08:00</td>
					</tr>
					<tr>
						<td class="boxcontent">9 AM</td>
						<td class="boxcontent">09:00</td>
					</tr>
					<tr>
						<td class="boxcontent">10 AM</td>
						<td class="boxcontent">10:00</td>
					</tr>
					<tr>
						<td class="boxcontent">11 AM</td>
						<td class="boxcontent">11:00</td>
					</tr>
					<tr>
						<td class="boxcontent">12 PM</td>
						<td class="boxcontent">12:00</td>
					</tr>
					<tr>
						<td class="boxcontent">1 PM</td>
						<td class="boxcontent">13:00</td>
					</tr>
					<tr>
						<td class="boxcontent">2 PM</td>
						<td class="boxcontent">14:00</td>
					</tr>
					<tr>
						<td class="boxcontent">3 PM</td>
						<td class="boxcontent">15:00</td>
					</tr>
					<tr>
						<td class="boxcontent">4 PM</td>
						<td class="boxcontent">16:00</td>
					</tr>
					<tr>
						<td class="boxcontent">5 PM</td>
						<td class="boxcontent">17:00</td>
					</tr>
					<tr>
						<td class="boxcontent">6 PM</td>
						<td class="boxcontent">18:00</td>
					</tr>
					<tr>
						<td class="boxcontent">7 PM</td>
						<td class="boxcontent">19:00</td>
					</tr>
					<tr>
						<td class="boxcontent">8 PM</td>
						<td class="boxcontent">20:00</td>
					</tr>
					<tr>
						<td class="boxcontent">9 PM</td>
						<td class="boxcontent">21:00</td>
					</tr>
					<tr>
						<td class="boxcontent">10 PM</td>
						<td class="boxcontent">22:00</td>
					</tr>
					<tr>
						<td class="boxcontent">11 PM</td>
						<td class="boxcontent">23:00</td>
					</tr>
					<tr>
						<td class="boxcontent">12 AM</td>
						<td class="boxcontent">00:00</td>
					</tr>
				</tbody></table>
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
	td.pesan{
    max-width: 400px !important;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
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
				url: base_url+'whatsapp/ajax_list_broadcast/'+page_num,
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
		
		$(document).on('click','.add_template',function(e){
			e.preventDefault();
			var id = $(this).attr('data-id');
			$('input').val('');
			$('textarea').val('');
			new bootstrap.Modal($('#ModalTemplate')).show();
			if(id==0){
				$("#type_broadcast").val('add');
				$("#exampleModalScrollableTitle").html('Tambah Data');
				return;
				}else{
				$("#type_broadcast").val('edit');
				$("#exampleModalScrollableTitle").html('Edit Data');
			}
			
			$.ajax({
				url: base_url + 'whatsapp/get_broadcast',
				data: {id:id},
				method: 'POST',
				dataType:'json',
				beforeSend: function(){
					$("body").loading({zIndex:1060});
				},
				success: function(data) {
					$("#id_broadcast").val(data.id);
					$("#title_broadcast").val(data.title);
					$("#deskripsi").val(data.message);
					$("#unit_kelas").val(data.target);
					$("#schedule").val(data.schedule);
					$('body').loading('stop');
				},
				error : function(res, status, httpMessage) {
					$('body').loading('stop');
					console.log(res.status)
					if(res.status==401){
						sweet_login(httpMessage,'warning',base_url);
						}else{
						sweet("Peringatan!!!", httpMessage, "warning", "warning");
					}			
				}
			});
		});
		
		$(document).on('click','.save_data',function(e){
			e.preventDefault();
			var dataform = $("#form-broadcast").serialize();
			
			$.ajax({
				url: base_url + 'whatsapp/save_broadcast',
				data: dataform,
				method: 'POST',
				dataType:'json',
				beforeSend: function(){
					$("body").loading({zIndex:1060});
				},
				success: function(data) {
					if(data.status==true){
						searchData();
						showNotif('bottom-right','Update',data.msg,'success');
						$('#ModalTemplate').modal('hide');
						}else if(data.status==false){
						sweet('Peringatan!!!',data.msg,'warning','warning');
						}else{
						showNotif('bottom-right','Update',data.alert['content'],'warning');
					}
					$('body').loading('stop');
				},
				error : function(res, status, httpMessage) {
					$('body').loading('stop');
					console.log(res.status)
					if(res.status==401){
						sweet_login(httpMessage,'warning',base_url);
						}else{
						sweet("Peringatan!!!", httpMessage, "warning", "warning");
					}			
				}
			});
		});
		
		$(document).on('click','.hapus_data',function(e){
			var id = $("#data-hapus").val();
			$.ajax({
				url: base_url + 'whatsapp/hapus_boradcast',
				data: {tipe:'hapus',id:id},
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
		$(document).on('click','.kirim',function(e){
			var id = $(this).attr('data-id');
			var device = $(this).attr('data-device');
			$.ajax({
				url: base_url + 'whatsapp/kirim_boradcast',
				data: {id:id,device:device},
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