<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Whatsapp
				</div>
                <h2 class="page-title">
					Data Device
				</h2>
			</div>
			<div class="col-12 col-md-auto ms-auto d-print-none">
				<button class="btn btn-primary d-none d-sm-inline-block add_device">
					<i class="ti ti-plus fa-lg"></i>
					Tambah
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

<div class="modal fade" id="Openqr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabelDevice">Scan Device</h4>
				<!--button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button-->
			</div>
			<div class="modal-body pb-0 mt-0 pt-1">
				<div class="load-qr text-center p-2"></div>
                <div class="text-center">
					<img src="" id="thumbnail_scan" alt="" />
				</div>
			</div>
			<!--div class="modal-footer">
				<button type="button" class="btn bg-red" data-bs-dismiss="modal">Close</button>
			</div-->
		</div>
	</div>
</div>

<div class="modal fade" id="OpenqrLogout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabelLogout">Connected</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body pb-0 mt-0 pt-1">
				<div class="load-qr text-center p-2"></div>
                <div class="text-center">
					<img src="" id="thumbnail" alt="" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn bg-red" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="addDevice" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document" id="loading-status">
		<div class="modal-content flat">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Form Add</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="form-template" method="post">
					<input type='hidden' name='id' id='id_device' value='0'>
					<input type='hidden' name='type' id="type_device">
					<div class="card-block">
						<label class="form-label" for="token_api" class="mb-2">Token WA-API <a href="javascript:void(0)" class="register">DAFTAR</a></label>
						<input type="text" name="token_api" id="token_api" class="form-control flat" required>
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
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="confirm-delete" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
				<button aria-hidden="true" class="close" data-bs-dismiss="modal" type="button">&times;</button>
			</div>
			<div class="modal-body">
				<p>Anda akan menghapus satu url, prosedur ini tidak dapat diubah.</p>
				<p>Apakah Anda ingin melanjutkan?</p>
				<p class="debug-url"></p>
				<input type="hidden" id="data-hapusid">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-danger hapus" type="button">YA</button> 
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
				url: base_url+'whatsapp/ajax_list/'+page_num,
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
		
		function cek_status(token)
		{
			$.ajax({
				url: base_url + 'whatsapp/cek_status_device',
				method: 'POST',
				data:{token:token},
				dataType: "json",
				success: function(data) {
					// console.log(data);
					if(data.device_status=='connect'){
						showNotif('bottom-right','Device','Conected','success');
						}else{
						showNotif('bottom-right','Device','Not Conected','error');
					}
					searchData();
					$('body').loading('stop');
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');
				}
			});
			
		}
		$(document).on('click','.cek_status',function(e){
			e.preventDefault();
			var token = $(this).attr('token-id');
			
			$.ajax({
				url: base_url + 'whatsapp/cek_status_device',
				method: 'POST',
				data:{token:token},
				dataType: "json",
				success: function(data) {
					// console.log(data);
					if(data.device_status=='connect'){
						showNotif('bottom-right','Device','Conected','success');
						}else{
						showNotif('bottom-right','Device','Not Conected','error');
					}
					searchData();
					$('body').loading('stop');
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');
				}
			});
		});
		
		$(document).on('click','.scan_qr',function(e){
			e.preventDefault();
			var token = $(this).attr('token-id');
			
			$.ajax({
				method: 'POST',
				url: base_url + 'whatsapp/scan_qr',
				data:{token:token},
				dataType: "json",
				beforeSend: function () {
					$('body').loading();
					$('.load-qr').html('');
				},
				success: function(data) {
					// console.log(data);
					if(data.status==true){
						new bootstrap.Modal($('#Openqr')).show();
						// $('#Openqr').modal({backdrop: 'static', keyboard: false})  
						$('#myModalLabelDevice').html('Disconnect');
						$('.load-qr').html('Scan Device');
						$("#thumbnail_scan").attr("src", "data:image/png;base64,"+data.url);
						// myVar = setTimeout(function(){ scan_qr() }, 8000);
						setTimeout(function(){
							$('#Openqr').modal('hide')
						}, 10000);
						}else{
						new bootstrap.Modal($('#Openqr')).show();
						$('#myModalLabelDevice').html('Connected');
						var detail = '<div class="reason">'+data.reason+'</div><button type="button" class="btn btn-danger logout_device">Logout</button>';
						$('.load-qr').html(detail);
						cek_status(token);
					}
					$('body').loading('stop');
					
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');
				}
			});
		});
		
		$(document).on('click','.logout_qr',function(e){
			e.preventDefault();
			var token = $(this).attr('token-id');
			$.ajax({
				method: 'POST',
				url: base_url + 'whatsapp/scan_qr',
				data:{token:token},
				dataType: "json",
				beforeSend: function () {
					$('body').loading();
					$('.load-qr').html('');
				},
				success: function(data) {
					new bootstrap.Modal($('#OpenqrLogout')).show();
					
					if(data.status==true){
						$('#myModalLabelDevice').html('Disconnect');
						$('.load-qr').html('Scan Device');
						$("#thumbnail").attr("src", "data:image/png;base64,"+data.url);
						// myVar = setTimeout(function(){ scan_qr() }, 8000);
						// setTimeout(function(){
						// $('#OpenqrLogout').modal('hide')
						// }, 10000);
						
						}else{
						$('#myModalLabelDevice').html('Connected');
						var detail = '<div class="reason">'+data.reason+'</div><button type="button" class="btn btn-danger logout_device" data-id="'+data.token+'">Logout Device</button>';
						$('.load-qr').html(detail);
						// myVar = setTimeout(function(){ scan_qr() }, 8000);
					}
					$('body').loading('stop');
					
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');
				}
			});
		});
		
		$(document).on('click','.logout_device',function(e){
			e.preventDefault();
			var token = $(this).attr('data-id');
			
			$.ajax({
				method: 'POST',
				url: base_url + 'whatsapp/logout_device',
				data:{token:token},
				dataType: "json",
				beforeSend: function () {
					$('body').loading();
				},
				success: function(data) {
					var msg = data.msg;
					// console.log(msg);
					if(data.status==true){
						if(msg.detail=='device disconnected successfully'){
							$('#OpenqrLogout').modal('hide');
							showNotif('bottom-right','Device Status',data.detail,'error');
							searchData();
						}
						if(msg.detail=='device disconnected'){
							$('#OpenqrLogout').modal('hide');
							showNotif('bottom-right','Device Status',data.detail,'error');
							cek_status(token);
							searchData();
						}
						}else{
						showNotif('bottom-right','Device Status',data.msg,'error');
					}
					
					$('body').loading('stop');
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');
				}
			});
		});
		
		$(document).on('click','.add_device',function(e){
			e.preventDefault();
			var id = $(this).attr('data-id');
			$.ajax({
				url: base_url + 'whatsapp/add_device',
				method: 'POST',
				data:{tipe:'get',id:id},
				dataType: "json",
				beforeSend: function () {
					$('body').loading();
				},
				success: function(data) {
					$('body').loading('stop');
					if(data.id==0 && data.status==false)
					{
						$("#type_device").val('add');
						$('#addDevice').modal('show');
						return;
					}
					
					if(data.id==0 && data.status==200)
					{
						showNotif('bottom-right','Device Status',data.msg,'error');
						searchData();
						}else{
						$("#type_device").val('edit');
						$("#exampleModalScrollableTitle").html('Form Edit');
					}
					
					if(data.status==200 && data.id > 0){
						$('#addDevice').modal('show');
						$('#id_device').val(data.id);
						$('#token_api').val(data.token);
						}else{
						showNotif('bottom-right','Device Status',data.msg,'error');
					}
					
					
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');
				}
			});
		});
		
		$(document).on('click','.save_data',function(e){
			e.preventDefault();
			var type_device = $("#type_device").val();
			var id = $("#id_device").val();
			var token = $("#token_api").val();
			
			if(token==''){
				$("#token_api").focus();
				return;
			}
			
			$.ajax({
				url: base_url + 'whatsapp/add_device',
				method: 'POST',
				data:{tipe:type_device,id:id,token:token},
				dataType: "json",
				beforeSend: function () {
					$('body').loading();
				},
				success: function(data) {
					
					if(data.status==200){
						showNotif('bottom-right','Update Device',data.msg,'success');
						$('#addDevice').modal('hide');
						$('#token_api').val('');
						searchData();
						}else{
						showNotif('bottom-right','Device Status',data.msg,'error');
					}
					
					$('body').loading('stop');
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');
				}
			});
		});
		
		$(document).on('click','.register',function(e){
			window.open('https://pospercetakan.my.id/harga', '_blank');
		});
		
		
		$(document).on('click','.hapus_data',function(e){
			var id = $("#data-hapus").val();
			$.ajax({
				url: base_url + 'whatsapp/add_device',
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
		
		$(document).on('click','.clear',function(e){
			$("#keywords").val('');
			searchData();
		});
		
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$('#data-hapus').val($(e.relatedTarget).data('id'));
		});
		
	</script>        
	
	
<?php } ?>	