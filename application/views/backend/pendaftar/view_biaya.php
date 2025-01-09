<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					<?=$menu;?>
				</div>
                <h2 class="page-title">
					Data Biaya
				</h2>
			</div>
			<div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
					
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
						<h3 class="card-title">List Data</h3>
						<div class="card-actions">
							<a href="javascript:void(0)" class="btn btn-primary" id="add_biaya_btn">
								<!-- Download SVG icon from http://tabler-icons.io/i/plus -->
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
								Tambah
							</a>
						</div>
						
					</div>
					<div class="card-body table-responsive">
						<div class="d-flex ">
							<div class="text-muted">
								<div class="d-none d-sm-inline-block">Show</div>
								<div class="mx-2 d-inline-block">
									<select id="limits" name="limits" class="form-control form-select" style="width:70px!important" onchange="searchBiaya()">
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
									<select id="sortBy" class="form-control form-select w-1" onchange="searchBiaya()" style="width:80px!important">
										<option value="ASC">ASC</option>
										<option value="DESC" selected>DESC</option>
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
								<div class="input-group">
									<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="searchBiaya();" style="width:150px!important" />
									<span class="input-group-text ms-2 d-none d-sm-inline-block">
										
										<a href="javascript:void(0)" class="link-secondary ms-2 d-none d-sm-inline-block" data-bs-toggle="tooltip" aria-label="Cari pengguna" title="Cari pengguna" onclick="searchBiaya();"><i class="ti ti-search fa-lg"></i>&nbsp;
										</a>
										<a href="#" class="link-secondary">&nbsp;|&nbsp;</a>
										<a href="#" class="link-secondary clear" data-bs-toggle="tooltip" aria-label="Clear search" title="Clear search">
											<i class="ti ti-x fa-lg"></i>
										</a>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="pb-2" id="posts_content_biaya">
					</div>
					
				</div><!-- /.card -->
			</div>
		</div>
	</div>
</div>

<!-- Modal Tambah / Edit Biaya -->
<div class="modal fade" id="biayaModal" tabindex="-1" role="dialog" aria-labelledby="biayaModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="biayaModalLabel">Tambah Biaya</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="biaya_form">
					<input type="hidden" name="id_biaya" id="id_biaya">
					<div class="form-group">
						<label for="title">Title:</label>
						<input type="text" name="title" id="title" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="id_unit">Unit:</label>
						<select name="id_unit" id="id_unit" class="form-control" required>
							<option value="">Pilih Unit</option>
							<?php foreach ($units as $unit) { ?>
								<option value="<?php echo $unit->id; ?>"><?php echo $unit->nama_jurusan; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_kategori">Kategori:</label>
						<select name="id_kategori" id="id_kategori" class="form-control custom-select">
							<option value="">Pilih</option>
							<?php foreach ($kategori as $k): ?>
							<option value="<?php echo $k->id_kategori; ?>"><?php echo $k->title; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<!-- Tahun Akademik -->
					<div class="form-group">
						<label for="id_tahun_akademik">Tahun Akademik:</label>
						<select id="id_tahun_akademik" class="form-control custom-select" name="id_tahun_akademik" >
							<option value="">Pilih</option>
							<?php foreach($tahun AS $val) : ?>
							<option value="<?=$val->id_tahun_akademik;?>"><?=$val->id_tahun_akademik;?></option>
							<?php endforeach; ?>
						</select>
					</div>
					
					<div class="form-group mb-2">
						<label for="amount">Amount:</label>
						<input type="text" name="amount" id="amount" class="form-control rupiah" required>
					</div>
					<button type="submit" id="save_biaya" class="btn btn-primary">Simpan</button>
				</form>
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

<style>
	
	select[readonly] {
	pointer-events: none;
	cursor: not-allowed;
	}
	
</style>

<?php
	$this->RenderScript[] = function() {
	?>
	<script>
		searchBiaya()
		function searchBiaya(page_num){
			page_num = page_num?page_num:0;
			var limit = $('#limits').val();
			var keywords = $('#keywords').val();
			var sortBy = $('#sortBy').val();
			var sort_tahun = $('#tahun_akademik_filter').val();
			var status = $('#status').val();
			var sortUnit = $('#sortUnit').val();
			var sortKelas = $('#sortKelas').val();
			$.ajax({
				type: 'POST',
				url: base_url+'psb/ajax_list_biaya/'+page_num,
				data:{page:page_num,
					limit:limit,
					keywords:keywords,
					tahun:sort_tahun,
					sortBy:sortBy,
					sortUnit:sortUnit,
				},
				beforeSend: function(){
					$('body').loading();
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
					$('body').loading('stop');
				},
				success: function(html){
					
					if(html=='Belum ada data'){
						var data = "<table class='table table-bordered'><tr><td>"+html+"</td></tr></table>";
						$('#posts_content_biaya').html(data);
						}else{
						$('#posts_content_biaya').html(html);
					}
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
		
        // Tambah Biaya
		$('#add_biaya_btn').click(function() {
			$('#biayaModal').modal('show');
			$('#biaya_form')[0].reset();
			$('#id_biaya').val('');
			$('#biayaModalLabel').text('Tambah Biaya');
		});
		
		// Edit Biaya
		$(document).on('click','.edit_biaya',function(){
			var id = $(this).data('id');
			$.ajax({
				url: "<?php echo base_url('psb/edit_biaya/'); ?>" + id,
				type: "GET",
				dataType: "json",
				success: function(data) {
					$('#id_biaya').val(data.id_biaya);
					$('#id_tahun_akademik').val(data.id_tahun_akademik);
					$('#id_unit').val(data.id_unit);
					$('#id_kategori').val(data.id_kategori);
					$('#title').val(data.title);
					$('#amount').val(formatRupiah(data.amount));
					$('#biayaModal').modal('show');
					$('#biayaModalLabel').text('Edit Biaya');
				}
			});
		});
		
		
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$('#data-hapus').val($(e.relatedTarget).data('id'));
		});
		$(document).on('click','.hapus_data',function(e){
			var id = $("#data-hapus").val();
			$.ajax({
				url: base_url + 'psb/delete_biaya',
				data: {id:id},
				method: 'POST',
				dataType:'json',
				beforeSend: function () {
					$('body').loading();　
				},
				success: function(data) {
					$('#confirm-delete').modal('hide');
					if(data.status==true){
						showNotif('bottom-right',data.title,data.message,'success');
						}else{
						sweet('Peringatan!!!',data.message,'warning','warning');
					}
					searchBiaya();
					
					$('body').loading('stop');　
					},error: function(xhr, status, error) {
					showNotif('bottom-right','Update',error,'error');
					$('body').loading('stop');　
				}
			});
		});		
		// Simpan Data Biaya
		$('#biaya_form').submit(function(e) {
			e.preventDefault();
			var id_biaya = $('#id_biaya').val();
			var url = id_biaya ? "<?php echo base_url('psb/update_biaya'); ?>" : "<?php echo base_url('psb/add_biaya'); ?>";
			$.ajax({
				url: url,
				type: "POST",
				data: $(this).serialize(),
				dataType: "json",
				success: function(data) {
					// alert(data.message);
					if (data.status) {
						$('#biayaModal').modal('hide'); // Menutup modal setelah sukses
						showNotif('bottom-right',data.title,data.message,'success');
						searchBiaya();
					}
				}
			});
		});
		function formatRupiah(angka) {
			var reverse = angka.toString().split('').reverse().join(''); // Membalik angka
			var ribuan = reverse.match(/\d{1,3}/g); // Memecah angka menjadi grup ribuan
			ribuan = ribuan.join('.').split('').reverse().join(''); // Menyambung grup ribuan dengan titik
			return ribuan ? 'Rp ' + ribuan : ''; // Menambahkan simbol "Rp" di depan
		}
		$(document).ready(function() {
			// Format input amount ke format rupiah
			$('.rupiah').on('input', function() {
				var nilai = $(this).val().replace(/[^\d]/g, ''); // Menghapus selain angka
				$(this).val(formatRupiah(nilai));
			});
			
			
		});
	</script>
<?php } ?>			