<section class="h-100">
	<div class="container h-100">
		<div class="row justify-content-sm-center h-100">
			<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
				<div class="text-center my-5">
					
				</div>
				<div class="card">
					<div class="card-body p-5">
					<h3 class="fs-4 card-title fw-bold mb-2 <?=$text;?> text-center"><?=$notif;?></h3>
						<form method="POST" class="needs-validation" action="/home/reset_val" autocomplete="off">
							<div class="mb-3">
								<label class="mb-2 text-muted" for="passcode">Passcode</label>
								<input id="passcode" type="text" class="form-control" name="passcode" value="" required autofocus>
							</div>
							<div class="mb-3">
								<label class="mb-2 text-muted" for="passcode">Pilihan</label>
								<select class="form-control form-select" name="pilihan">
									<option value="SEMUA">SEMUA</option>
									<option value="kirim">TB KIRIM</option>
									<option value="penggunaan">TB REKAPAN</option>
									<option value="project">TB PROJECT</option>
									<option value="stok">TB STOK</option>
									<option value="sppm">TB SPPM</option>
									<option value="terima">TB TERIMA</option>
									<option value="terjual">TB TERJUAL</option>
									<option value="data_penggunaan">TB PENGGUNAAN</option>
									<option value="penerimaan">TB PENERIMAAN</option>
								</select>
							</div>
							
							<div class="d-flex align-items-center">
								<button type="submit" name="submit" class="btn btn-primary ms-auto">
									SUBMIT
								</button>
							</div>
						</form>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
</section>