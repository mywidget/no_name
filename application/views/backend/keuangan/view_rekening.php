<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					<?=$menu;?>
				</div>
                <h2 class="page-title">
					Data Rekening
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
							<a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rekeningModal" aria-label="Tambah Unit" data-id="0" data-mod="add" id="addRekeningBtn">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
								Tambah
							</a>
						</div>
					</div>
					
					
					<div class="table-responsive">
						<table class="table card-table table-vcenter table-striped text-nowrap datatable">
							<thead>
								<tr>
									<th>No</th>
									<th>Title</th>
									<th>Nomor Rekening</th>
									<th>Pemilik</th>
									<th>Status</th>
									<th class="text-end">Aksi</th>
								</tr>
							</thead>
							<tbody id="rekeningTableBody">
								<?php $no = 1; foreach ($rekenings as $rekening): ?>
								<tr id="row<?= $rekening->id_rekening ?>">
									<td><?= $no++ ?></td>
									<td><?= $rekening->title ?></td>
									<td><?= $rekening->nomor_rekening ?></td>
									<td><?= $rekening->pemilik ?></td>
									<td><?= $rekening->aktif == 'Y' ? 'Aktif' : 'Tidak Aktif' ?></td>
									<td class="text-end">
									<div class="btn-group btn-group-sm">
										<button class="btn btn-primary editBtn" data-id="<?= $rekening->id_rekening ?>">Edit</button>
										<button class="btn btn-danger deleteBtn" data-id="<?= $rekening->id_rekening ?>">Delete</button>
									</div>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
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

<!-- Modal for Add/Edit Rekening -->
<div class="modal fade" id="rekeningModal" tabindex="-1" aria-labelledby="rekeningModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rekeningModalLabel">Tambah Rekening</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
            <div class="modal-body">
                <form id="rekeningForm">
                    <input type="hidden" id="id_rekening" name="id_rekening">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
					</div>
                    <div class="mb-3">
                        <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
                        <input type="text" class="form-control" id="nomor_rekening" name="nomor_rekening" required>
					</div>
                    <div class="mb-3">
                        <label for="pemilik" class="form-label">Pemilik</label>
                        <input type="text" class="form-control" id="pemilik" name="pemilik" required>
					</div>
                    <div class="mb-3">
                        <label for="aktif" class="form-label">Status</label>
                        <select class="form-select" id="aktif" name="aktif">
                            <option value="Y">Aktif</option>
                            <option value="N">Tidak Aktif</option>
						</select>
					</div>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
				</form>
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
	/* Tambahkan styling khusus untuk input di dalam SweetAlert */
	.swal2-content{z-index:1050}
	.swal2-input {
	width: 100%;
	padding: 10px;
	margin: 5px 0;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid #ccc;
	}
	input[readonly]
	{
    background-color:#ccc;
	}
	.modal-footer {
	border-top: 1px solid #dee2e6; /* Menambahkan garis pada bagian atas footer modal */
    }
</style>

<?php $this->RenderScript[] = function() { ?>
	
	<script>
		$(document).ready(function() {
			// Menambahkan Rekening Baru
			$('#rekeningForm').submit(function(e) {
				e.preventDefault();
				let formData = $(this).serialize();
				let id_rekening = $('#id_rekening').val();
				
				let url = id_rekening ? '<?= base_url('keuangan/update_rekening') ?>' : '<?= base_url('keuangan/add_rekening') ?>';
				
				$.ajax({
					type: 'POST',
					url: url,
					data: formData,
					dataType: 'json',
					success: function(response) {
						if (response.status) {
							location.reload(); // Reload halaman setelah sukses
							} else {
							alert('Gagal menyimpan data!');
						}
					}
				});
			});
			
			// Menampilkan data rekening di modal (untuk Edit)
			$(document).on('click', '.editBtn', function() {
				let id_rekening = $(this).data('id');
				$.ajax({
					url: '<?= base_url('keuangan/edit_rekening/') ?>' + id_rekening,
					dataType: 'json',
					success: function(data) {
						$('#id_rekening').val(data.id_rekening);
						$('#title').val(data.title);
						$('#nomor_rekening').val(data.nomor_rekening);
						$('#pemilik').val(data.pemilik);
						$('#aktif').val(data.aktif);
						$('#rekeningModalLabel').text('Edit Rekening');
						$('#rekeningModal').modal('show');
					}
				});
			});
			
			// Menghapus rekening
			$(document).on('click', '.deleteBtn', function() {
				let id_rekening = $(this).data('id');
				if (confirm('Apakah Anda yakin ingin menghapus rekening ini?')) {
					$.ajax({
						url: '<?= base_url('keuangan/delete_rekening/') ?>' + id_rekening,
						dataType: 'json',
						success: function(response) {
							if (response.status) {
								$('#row' + id_rekening).remove();
								} else {
								alert('Gagal menghapus rekening!');
							}
						}
					});
				}
			});
		});
		
		$(document).on('click','.hapus_data',function(e){
			var id = $("#data-hapus").val();
			$.ajax({
				url: base_url + 'keuangan/hapus_data',
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
					// searchData();
					
					$('body').loading('stop');　
					},error: function (xhr, ajaxOptions, thrownError) {
					// Menangani error yang terjadi
					$('body').loading('stop');
					$('#confirm-delete').modal('hide');
					// Jika session kadaluarsa (misalnya server merespon dengan kode 401)
					if (xhr.status === 401 || xhr.status === 403) {
						// Menyembunyikan modal
						// Menampilkan alert dengan pesan session kadaluarsa
						alert_logout(base_url);
						} else {
						// Jika terjadi error selain session kadaluarsa
						sweet('Peringatan!!!',thrownError,'warning','warning');
					}
				}
			});
		});
		
		$(document).on('click','.clear',function(e){
			$("#keywords").val('');
			searchData();
		});
		
		$(document).on('click','#simpan_bayar',function(e){
			$("#bayarForm").submit();
		});
		 
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$('#data-hapus').val($(e.relatedTarget).data('id'));
		});
		
		
		$(document).ready(function() {
			// Ambil rekening untuk dropdown
			$.ajax({
				url: "<?php echo site_url('keuangan/get_kategori'); ?>",
				method: "GET",
				dataType: "json",
				success: function(data) {
					if (data) {
						var rekening = $('#kategori');
						rekening.empty();
						rekening.append('<option value="">Pilih kategori</option>');
						$.each(data, function(index, item) {
							rekening.append('<option value="' + item.id_kategori + '">' + item.title + '</option>');
						});
					}
				}
			});
			$.ajax({
				url: base_url+ 'psb/get_tahun_akademik',  
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
			
			
			// Ambil rekening untuk dropdown
			$.ajax({
				url: "<?php echo site_url('keuangan/get_rekening'); ?>",
				method: "GET",
				dataType: "json",
				success: function(data) {
					if (data) {
						var rekening = $('#rekening');
						rekening.empty();
						rekening.append('<option value="">Pilih Rekening</option>');
						$.each(data, function(index, item) {
							rekening.append('<option value="' + item.id_rekening + '">' + item.title + '</option>');
						});
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					// Menangani error yang terjadi
					$('body').loading('stop');
					// $('#ModalBayar').modal('hide');
					// Jika session kadaluarsa (misalnya server merespon dengan kode 401)
					if (xhr.status === 401 || xhr.status === 403) {
						// Menyembunyikan modal
						// Menampilkan alert dengan pesan session kadaluarsa
						alert_logout(base_url);
						} else {
						// Jika terjadi error selain session kadaluarsa
						sweet('Peringatan!!!',thrownError,'warning','warning');
					}
				}
			});
			
			// AJAX save bayar
			$('#bayarForm').submit(function(e) {
				e.preventDefault();
				
				var formData = new FormData(this);
				$.ajax({
					url: base_url+"keuangan/save_bayar",
					type: "POST",
					data: formData,
					dataType: "json",
					processData: false,
					contentType: false,
					success: function(response) {
						if (response.status) {
							sweet('Notifikasi!!!',response.message,'success','success');
							$('#ModalBayar').modal('hide');
							searchData();
							} else {
							sweet('Peringatan!!!',response.message,'warning','warning');
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						// Menangani error yang terjadi
						$('body').loading('stop');
						$('#ModalBayar').modal('hide');
						// Jika session kadaluarsa (misalnya server merespon dengan kode 401)
						if (xhr.status === 401 || xhr.status === 403) {
							// Menyembunyikan modal
							// Menampilkan alert dengan pesan session kadaluarsa
							alert_logout(base_url);
							} else {
							// Jika terjadi error selain session kadaluarsa
							sweet('Peringatan!!!',thrownError,'warning','warning');
						}
					}
				});
			});
		});
		
		$(document).ready(function() {
			// Fungsi untuk memeriksa status tombol simpan_bayar
			function checkFormStatus() {
				var kategoriSelected = $('#kategori').val();
				var rekeningSelected = $('#rekening').val();
				var jumlah_bayar = angka($('#jumlah_bayar').val());
				
				// Jika kategori dan rekening keduanya terpilih, aktifkan tombol simpan_bayar
				if (kategoriSelected && rekeningSelected && jumlah_bayar > 0) {
					$('#simpan_bayar').prop('disabled', false); // Aktifkan tombol simpan_bayar
					} else {
					$('#simpan_bayar').prop('disabled', true); // Nonaktifkan tombol simpan_bayar
				}
			}
			
			// Event listener untuk kategori select change
			$('#kategori').on('change', function() {
				checkFormStatus(); // Memeriksa apakah tombol simpan_bayar harus diaktifkan
			});
			
			// Event listener untuk rekening select change
			$('#rekening').on('change', function() {
				checkFormStatus(); // Memeriksa apakah tombol simpan_bayar harus diaktifkan
			});
			
			$('#jumlah_bayar').on('keyup', function() {
				checkFormStatus(); // Memeriksa apakah tombol simpan_bayar harus diaktifkan
			});
			
			// Inisialisasi status tombol saat halaman pertama kali dimuat
			checkFormStatus();
			// Menghitung sisa tagihan setiap kali ada input di #jumlah_bayar
			$('#jumlah_bayar').on('keyup', function() {
				// Mendapatkan nilai total tagihan dan jumlah bayar
				var totalTagihan = angka($('#total_tagihan').val()) || 0;
				var total_dibayar = angka($('#total_dibayar').val()) || 0;
				var jumlahBayar = angka($(this).val()) || 0;
				
				
				// Validasi agar jumlah bayar tidak melebihi total tagihan
				if (parseInt(jumlahBayar) > parseInt(totalTagihan)) {
					jumlahBayar = totalTagihan-total_dibayar;  // Membatasi jumlah bayar agar tidak melebihi total tagihan
					$(this).val(formatRupiah(jumlahBayar));   // Update nilai input jumlah bayar
				}
				// Menghitung sisa tagihan
				var sisaTagihan = totalTagihan - jumlahBayar - total_dibayar;
				// console.log(sisaTagihan)
				// Update sisa tagihan
				$('#sisa_tagihan').val(formatRupiah(sisaTagihan));  // Menampilkan sisa tagihan dengan 2 desimal
			});
			$('#jumlah_bayar').on('keyup', function() {
				var value = $(this).val();
				
				// Menghapus angka 0 yang ada di depan
				var newValue = value.replace(/^0+/, '');
				
				
				// Update nilai input jika ada perubahan
				$(this).val(newValue);
			});
		});
		
	</script>
	
<?php } ?>	