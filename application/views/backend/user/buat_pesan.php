<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Pesan
				</div>
                <h2 class="page-title">
					<?=$judul;?>
				</h2>
			</div>
		</div>
	</div>
</div>
<div class="page-body">
	<div class="container-xl">
		<div class="row row-cards">
			<div class="col-12">
				<form class="card">
					<div class="card-body">
						<h3 class="card-title">Form pesan</h3>
						<div class="row row-cards">
							
							<div class="col-sm-6 col-md-6">
								<div class="mb-3">
									<label class="form-label">To</label>
									<select name="satker" data-original-value="" id="satker" class="form-select" required>
										<option value=''>Pilih tujuan</option>
										<?php foreach($divisi as $rows){ 
											echo "<option value='{$rows['id']}'>{$rows['nama_divisi']}</option>";
										} ?>
									</select>
								</div>
								</div>
							<div class="col-sm-6 col-md-6">
								<div class="mb-3">
									<label class="form-label">Judul</label>
									<input type="text" class="form-control" placeholder="Judul" name="judul">
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="mb-3 mb-0">
									<label class="form-label">Isi Pesan</label>
									<textarea rows="5" id="mytextarea" name="isi_pesan" class="form-control" placeholder=""></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-end">
						<div class="d-flex">
							<a href="/pesan" class="btn btn-info btn-warning"><i class="ti ti-chevron-left"></i> Kembali</a>
							<button type="submit" name="submit" class="btn btn-primary ms-auto"><i class="ti ti-send"></i> Kirim</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
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