<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Fasmat 
				</div>
                <h2 class="page-title">
					SPPM 
				</h2>
			</div>
			<div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
					<div class="mb-3">
						<div class="btn-group w-100">
							<a href="/laporan/pengiriman" class="btn btn-info d-none d-sm-inline-block">
								<i class="ti ti-arrow-left"></i>
							</a>
							
							<a href="/laporan/pengiriman" class="btn btn-primary d-none d-sm-inline-block">
								Laporan  
							</a>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
<?php
	
	$type = '';
	$list_cc = json_decode($sppm->detail,true);
?>

<div class="page-body">
	<div class="container-xl">
		<div class="row row-cards">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Form edit pengiriman</h3>
					</div>
					<form id="form_edit" method="post">
						<div class="card-body" id="posts_content">
							<div class="form-group row mb-3">
								<div class="col-md-4 mb-3">
									<label class="form-label">Nomor Surat Permohonan</label>
									<input class="form-control" data-original-value="" name="nomor_permohonan" id="nomor_permohonan" value="<?=$sppm->nomor_surat;?>">
									<input type="hidden" name="id_sppm" id="id_sppm" value="<?=encrypt_url($sppm->id);?>" required />
									<input type="hidden" name="materiel" id="materiel" value="<?=$sppm->materiel;?>" required />
								</div>
								<div class="col-md-4 mb-3">
									<label class="form-label">Tanggal Permohonan</label>
									<input class="form-control " placeholder="Select a date" id="datepicker-icon" name="tanggal_permohonan" value="<?=$sppm->tgl_surat;?>" required />
								</div>
								<div class="col-md-4 mb-3">
									<label class="form-label">Ganti Satker</label>
									<select name="satker" data-original-value="" id="satker" class="form-select" required>
										<?php foreach($divisi as $rows){ 
											$selected = '';
											if($sppm->id_divisi==$rows['id']){
												$selected = 'selected';
												echo "<option value='{$rows['id']}' {$selected}>{$rows['nama_divisi']}</option>";
												}else{
												echo "<option value='{$rows['id']}' {$selected}>{$rows['nama_divisi']}</option>";
											}
										} ?>
									</select>
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">No. SPPM </label>
									<div class="input-group input-group-flat">
										<input type="text" name="nomor" id="nomor" class="form-control pe-0" autocomplete="off" data-original-value="" value="<?=$sppm->nomor_detail;?>" required >
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Tanggal Dikeluarkan</label>
									<input class="form-control " placeholder="Select a date" id="datepicker-icons" name="tanggal" value="<?=$sppm->tanggal;?>"/>
								</div>
							</div>
							<?php if(!empty($list_cc)){ ?>
								<div class="table-responsive">
									<table id="table-satker" class="table card-table table-vcenter text-nowrap datatable">
										<thead>
											<tr>
												<th style="width:4%">No.</th>
												<th>Nama Materiel</th>
												<th style="width:10%">Jumlah Kirim</th>
												<th style="width:4%">Satuan</th>
												<th style="width:10%">Harga</th>
												<th style="width:15%">Catatan</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$no = 1;
												$jumlah = 0;
												$_readonly = 'readonly';
												foreach($list_cc['detail'] as $row){
													$linked =  parent_barang($row['id_master'])->linked;
												?>
												<tr>
													<td><?=$no;?></td>
													<td><?=kata($row['nama_barang'],80)?>
														<input type="hidden" name="nama_barang[]" value="<?=$row['nama_barang'];?>">
														<input type="hidden" name="idmaster[]" value="<?=$row['id_master'];?>">
														<input type="hidden" name="linked[]" value="<?=$linked;?>">
													</td>
													<td><input type="text" class="form-control form-sm input" name="jumlah[]" data-original-value="0" onkeyup="formatNumber(this);" value="<?=rp($row['jumlah']);?>" min="0" ></td>
													<td><?=$row['satuan'];?>
														<input type="hidden" name="satuan[]" value="<?=$row['satuan'];?>">
													</td>
													<td><input type="text" class="form-control form-sm" name="harga[]" value="<?=rp($row['harga']);?>"  readonly></td>
													<td><input type="text" name="catatan[]" class="form-control form-sm" value="<?=$row['catatan'];?>">
													</td>
												</tr>
												<?php $no++; 
													
												}
												
											?>
										</tbody>
									</table>
								</div>
								<div class="mb-3">
									<label class="form-label">Keterangan</label>
									<textarea class="form-control" id="mytextarea" name="keterangan" data-bs-toggle="autosize" placeholder="Keterangan" required>TERMIN I<br><br>
										TA. 2022<br>
										SETELAH MAT<br>
										DITERIMA<br>
										AGAR<br>
										DIBUAT<br>
										BAPPM<br>
										SELAMBAT-<br>
										LAMBATNYA 7<br>
										HARI KE<br>
										DITLANTAS<br>
										POLDA<br>
										BANTEN<br>
										APABILA TDK<br><br>
										DIBUAT<br>
										BAPPM<br>
										PROSES<br>
										PENGIRIMAN<br>
										SELANJUTNYA<br>
									TDK DILAKS</textarea>
								</div>
								<div class="card-footer text-end">
									<div class="d-flex">
										<a href="/laporan/pengiriman" class="btn btn-link">Cancel</a>
										<button onclick="simpan_sppm()" type="button" class="btn btn-primary ms-auto " >Update</button>
									</div>
								</div>
								<?php }else{ ?>
								<table class='table table-bordered'>
									<tr>
										<td>Belum ada data</td>
									</tr>
								</table>
							<?php } ?>
						</div>
					</form>
				</div><!-- /.card -->
			</div>
		</div>
	</div>
</div>

<script>
	
	
	$('.input').click(function() {
		this.select();
	});
    document.addEventListener("DOMContentLoaded", function () {
    	window.Litepicker && (new Litepicker({
    		element: document.getElementById('datepicker-icon'),
			format: 'DD-MM-YYYY',
    		buttonText: {
    			previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
			<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
			nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
			<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
    		},
			}));
			});
			
		</script>
		<script>
			document.addEventListener("DOMContentLoaded", function () {
				window.Litepicker && (new Litepicker({
					element: document.getElementById('datepicker-icons'),
					format: 'DD-MM-YYYY',
					buttonText: {
						previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
					<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
					nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
					<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
					},
					}));
					});
					
				</script>
				
				<script>
					
					function simpan_sppm()
					{
						if($("#nomor_permohonan").val()==""){
							showNotif('top-center','Simpan Data','Nomor permohonan Harus diisi','warning');
							$("#nomor_permohonan").focus();
							return false;
						}
						if($("#datepicker-icon").val()==""){
							showNotif('top-center','Simpan Data','Tanggal Harus diisi','warning');
							$("#datepicker-icon").focus();
							return false;
						}
						
						if($("#satker").val()==""){
							showNotif('top-center','Simpan Data','satker Harus dipilih','warning');
							$("#satker").focus();
							return false;
						}
						
						if($("#nomor").val()==""){
							showNotif('top-center','Simpan Data','Nomor Harus diisi','warning');
							$("#nomor").focus();
							return false;
						}
						
						if($("#mytextarea").val()==""){
							showNotif('top-center','Simpan Data','Keterangan Harus diisi','warning');
							$("#mytextarea").focus();
							return false;
						}
						var formData = $("#form_edit").serialize();
						$.ajax({
							type: "POST",
							url: base_url+"laporan/simpan_edit_sppm",
							dataType: 'json',
							data: formData,
							beforeSend: function () {
								$('body').loading();　
							},
							success: function(data) {
								// console.log(data);
								$('body').loading('stop');
								if(data.status==true){
									showNotif('bottom-right',data.title,data.msg,'success');
									$('[data-original-value]').each(function(){
										$(this).val($(this).data('original-value'));
									});
									$('#nomor_permohonan').val('');
									$('#nomor').val('');
									$('#satker').val('');
									
									window.location.href = base_url+"laporan/detail/"+data.id;
									}else{
									showNotif('bottom-right',data.title,data.msg,'error');
								}
								// searchMutasiPenerimaan();
								} ,error: function(xhr, status, error) {
								showNotif('bottom-right','Peringatan',xhr.responseText,'error');
								$('body').loading('stop');
							}
						});
					}
					// @formatter:off
					document.addEventListener("DOMContentLoaded", function () {
						let options = {
							selector: '#mytextarea',
							height: 200,
							menubar: false,
							statusbar: false,
							
							toolbar: 'undo redo | formatselect | ' +
							'bold italic backcolor | alignleft aligncenter ' +
							'alignright alignjustify | bullist numlist outdent indent | ' +
							'removeformat',
							content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }',
							setup: function (editor) {
								editor.on('change', function (e) {
									editor.save();
								});
							}
						}
						if (localStorage.getItem("tablerTheme") === 'dark') {
							options.skin = 'oxide-dark';
							options.content_css = 'dark';
						}
						tinyMCE.init(options);
					})
					// @formatter:on
				</script>				
				<style>
					input:read-only {
					background-color: #777777;
					color: white;
					pointer-events: none;
					} 
					.readonly {
					background-color: #777777;
					color: white;
					pointer-events: none;
					}
				</style>																