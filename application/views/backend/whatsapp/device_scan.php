<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					<?=$menu;?>
				</div>
                <h2 class="page-title">
					Scan Device
				</h2>
			</div>
			<div class="col-12 col-md-auto ms-auto d-print-none">
				
			</div>
		</div>
	</div>
</div>
<div class="page-body">
	<div class="container-xl">
		<div class="alert alert-info border">Pindai QR ini menggunakan multi perangkat whatsapp.</div>
		<div class="row">
			<div class="col-xl-12">
				<div class="card widget widget-stats-large shadow-none">
					<div class="row">
						<div class="col-xl-7">
							<div class="widget-stats-large-chart-container">
								<div class="card-header" id="logoutbutton">
									<button onclick="logoutqr()" class="btn btn-danger btn-sm scanbutton"><i class="mdi mdi-logout-variant"></i> Logout perangkat</button>
								</div>
								<div class="card-body">
									
									<div id="div1"></div>
									<div id="apex-earnings"></div>
									<div class="imageee text-center mb-2" id="area-image">
										<img src="<?= base_url() ?>assets/img/wa_icon.png" height="200px" alt="">
									</div>
									<div class="text-center mt-2" id="statusss">
										<button class="btn btn-primary mb-2" type="button" disabled>
											<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
											Menunggu tanggapan dari server
										</button>
										
										<li class="list-group-item text-danger mt-2">
											<img src="<?= base_url() ?>assets/img/image_scan.png" class="img-fluid" height="200px" alt="">
										</li>
										
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-5">
							<div class="widget-stats-large-info-container">
								<div class="card-header">
									<button type="button" data-toggle="modal" data-target="#webhooks" class="btn btn-primary btn-sm"><i class="mdi mdi-message-settings-variant"></i> Pengaturan</button>
								</div>
								
								<div class="card-body account">
									<ul class="list-group account list-group-flush">
										<li class="list-group-item p-0">Nama : <span id="nama"></span></li>
										<li class="list-group-item p-0">Nomor Device :</li>
										<li class="list-group-item p-0"><span id="number"></span></li>
									</ul>
									<div class="mt-2">
										
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<div class="card-body " style="max-height:100px;overflow:auto">
						<h6>Log: </h6>
						<span id="logs"></span>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>assets/backend/socket.io/client-dist/socket.io.js"></script>
<script>
	
	var host = $(location).attr('host');
    var nomorbase = '<?= $row->device ?>';
    var id_pengaturan = 1;
    
    var apiKey ='<?= $api_key ?>';
    var url_send ='<?= $url_send ?>';
	
	// let socket;
	
	let cek_status = false;
	
	const socket = io(url_send, {
		query: {api_key: apiKey }  // Kirimkan API key dalam query parameter
	});
	
	socket.emit('StartConnection', nomorbase);
	
	socket.on('api_error', ({status, text }) => {
		load_data(status,text)
		
	})
	
	load_data = (status,text,) => {
		$('#logoutbutton').addClass('d-none');
		console.log(text)
		if(status==false){
		return false;
	}
	}
	
	socket.on('qrcode', ({token, data, message }) => {
		if (token == nomorbase) {
			let url = data
			$('#area-image').html(`<img src="${url}" height="300px" alt="">`)
			let count = 0;
			$('#statusss').html(`<button class="btn btn-warning" type="button" disabled><i class="mdi mdi-qrcode-scan"></i>
			<span class="" role="status" aria-hidden="true"></span>
			${message}
			</button>`)
			
		}
		
	})
	socket.on('connection-open', ({
		token,
		user,
		ppUrl
		}) => {
		if (token == nomorbase) {
			$('#logoutbutton').addClass('d-none');
			// console.log(token)
			cek_status_device(nomorbase)
			$('#nama').html(`${user.name}`)
			$('#number').html(`${user.id}`)
			$('.device').html(`${token}`)
			$('.imageee').html(` <img src="${ppUrl}" height="300px" alt="">`)
			$('#statusss').html('<button disabled class="btn btn-success"><i class="mdi mdi-qrcode-scan"></i> Terhubung.</button>');
			$('#logs').append('Whatsapp is ready!<hr class="p-0 m-0">');
		}
	})
	
	socket.on('Unauthorized', ({
		token
		}) => {
		if (token == nomorbase) {
			$('#logoutbutton').removeClass('d-none');
			$('.statusss').html(`  <button class="btn btn-danger" type="button" disabled>
			<span class="" role="status" aria-hidden="true"></span>
			{{__('Unauthorized')}}
			</button>`)
		}
		
	})
	socket.on('message', ({
		token,
		message
		}) => {
		// console.log(1)
		if (token == nomorbase) {
			$('#logs').append(message + '<hr class="p-0 m-0">');
			$('.statusss').html(`  <button class="btn btn-success" type="button" disabled>
			<span class="" role="status" aria-hidden="true"></span>
			${message}
			</button>`);
			//if there is text connection close in message
			if (message.includes('Connection closed')) {
				// count 5 second
				let count = 5;
				//set interval
				let interval = setInterval(() => {
					//if count is 0
					if (count == 0) {
						//clear interval
						clearInterval(interval);
						//reload page
						location.reload();
					}
					//change text
					$('.statusss').html(`<button class="btn btn-success" type="button" disabled>
					<span class="" role="status" aria-hidden="true"></span>
					${message} {{__('in')}} ${count} {{__('second')}}
					</button>`);
					//count down
					count--;
				}, 1000);
				
			}
		}
		
		
		
	});
	
	function logoutqr() {
		$('body').loading();
		socket.emit('LogoutDevice', nomorbase)
	}
	
	function cek_status_device(device) {
		$.ajax({
			url: base_url + 'whatsapp/cek_status_device',
			method: 'POST',
			data:{device:device,id_pengaturan:id_pengaturan},
			dataType: "json",
			beforeSend : function() {
				// $('body').loading();
			},
			success: function(response) {
				// console.log(response);
				if(response.status==true && response.message=='Connected'){
					showNotif('bottom-right','Device','Conected','success');
					$('#logoutbutton').removeClass('d-none');
					}else if(response.status==true && response.message=='Disconnect'){
					showNotif('bottom-right','Device',response.message	,'error');
					$('#logoutbutton').addClass('d-none');
					}else{
					showNotif('bottom-right','Device','Not Conected','error');
				}
				
			},
			error: function(xhr, status, error) {
				showNotif('bottom-right','Update',error,'error');
				$('body').loading('stop');
			}
		});
	}
</script>									