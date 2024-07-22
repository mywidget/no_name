<form id="formAdd">
	<input type="hidden" class="form-control" id="id" name="id">
	<input type="hidden" class="form-control" id="type" name="type" value="<?=$tipe;?>">
	
	<div class="row">
		<div class="col-md-6">
			<div class="card-block">
				<div class="form-group mb-1">
					<label class="form-label" for="mail">Username</label>
					<input type="text" name="mail" value="" class="form-control" id="mail" placeholder="Username" required="">
				</div>
				<div class="form-group mb-1">
					<label class="form-label" for="password">Password</label>
					<input type="password" name="password" class="form-control" id="password" placeholder="Password Pengguna" value="" required="" autocomplete="off">
				</div>
				<div class="form-group mb-1">
					<label class="form-label" for="title">Nama Lengkap</label>
					<input type="text" name="title" value="" class="form-control" id="title" placeholder="Nama Lengkap" required="">
				</div>
				<div class="form-group mb-1">
					<label class="form-label" for="nama_lembaga">Nama Lembaga</label>
					<input type="text" name="nama_lembaga" value="" class="form-control" id="nama_lembaga" placeholder="Nama Lembaga" required="">
				</div>
				<div class="form-group mb-1">
					<label class="form-label" for="pangkat">Pangkat</label>
					<input type="text" name="pangkat" value="" class="form-control" id="pangkat" placeholder="Pangkat">
				</div>
				<div class="form-group row mb-2">
					<div class="col-md-7">
						<label class="form-label" for="jabatan">Jabatan</label>
						<input type="text" name="jabatan" class="form-control"  required>
					</div>
					<div class="col-md-5">
						<label class="form-label" for="nrp">NIP</label>
						<input type="text" name="nrp" class="form-control" required>
					</div>
				</div>
				<div class="form-group mb-1">
					<label class="form-label" for="daftar">TGL. Daftar </label>
					<input type="date" name="daftar" class="form-control dpd1"  id="daftar">
				</div>
				
			</div>
		</div>
		<div class="col-md-6">
			<div class="card-block">
				<div class="form-group mb-1">
					<label for="profit">Menu Akses</label>
					
				</div>
				<div class="over-user">
					
					<label class="form-check">
						<input type="checkbox" class="form-check-input" id="select_all"/>
						<span class="form-check-label">Pilih semua</span>
					</label>
					<?php
						$level = $this->session->level;
						$lv = $this->session->idlevel;
						$idparent = $this->session->idparent;
						$typeakses = $this->session->typeakses;
						$resultz = $this->db->query("SELECT * FROM menuadmin where FIND_IN_SET('$lv', CONCAT(id_level, ',')) AND aktif='Y' order by urutan");
						foreach ($resultz->result_array() as $rowz){
							$dataT[$rowz['idparent']][] = $rowz;
						}
						echo checkbox($dataT,0,0,$idparent);
					?>
					
				</div>
				 
				<div class="form-group mb-1">
					<label>Level Akses</label>
					<select name="id_level" class="form-control form-select">
						<?php
							if($level=='admin'){
								$tampil=$this->db->query("SELECT * FROM hak_akses");
								}else{
								$tampil=$this->db->query("SELECT * FROM hak_akses where id_level='$lv'");
							}
							foreach($tampil->result_array() AS $we){
								if($lv==$we['id_level']){
									echo "<option value=$we[id_level] selected>$we[nama]</option>"; 
									}else{
									echo "<option value=$we[id_level]>$we[nama]</option>"; 
								}
							}
						?>
					</select>
					
				</div>
				<div class="form-group mb-1">	
					<label>Type Akses</label>
					<select id="cat" name="cat[]" class="form-control select2-multiple" multiple="multiple">
						<?php  
							if ($level == 'admin' AND $idparent==0){ ?>
							<?php
								foreach($kategori as $rowz){
									$dataTzx[$rowz->id_parent][] = $rowz;
								}
								// echo select_badge($dataTzx,0,0,$typeakses);
								echo select_kbox($dataTzx,0,0,$typeakses);
							?>
							<?php }else{
								foreach($kategori as $rowz){
									$dataTzx[$rowz->id_parent][] = $rowz;
								}
								// echo select_badge($dataTzx,0,0,$typeakses);
								echo select_kbox($dataTzx,0,0,$typeakses);
							}
						?>
					</select>
				</div>
				<div class="form-group row mb-0">
					<div class="col-md-6">
						<label>Status Aktif</label>
						<div class="">
							<label>
								<input type="radio" class="minimal" name="aktif" id="optionsRadios2" value="Y">
								Ya
								<input type="radio" class="minimal" name="aktif" id="optionsRadios1" value="N" checked="">
								Tidak
							</label>
						</div>
					</div>
					<div class="col-md-6">
						<label>Lock Menu</label>
						<div class="">
							<label>
								<input type="radio" class="minimal" name="lock" id="Lock1" value="1" checked>
								Ya
								<input type="radio" class="minimal" name="lock" id="Lock2" value="0">
								Tidak
							</label>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</div>
</form>
<style>
	.select2-container {
	width: 100% !important;
	padding: 0;
	}
	.over-users{min-height:100px}
	
	.theme-dark .select2-selection__choice__display{color:#1D273B}
	.theme-dark .select2-results__option{color:#1D273B}
</style>
<script>
	$('.over-user').slimScroll({
		height: '300px'
	});
	$('.over-satker').slimScroll({
		height: '100px'
	});
	$(document).on('keydown', '#mail', function(e) {
		if (e.keyCode == 32) return false;
	});
	// $(".select2").select2({
		// placeholder: "--Pilih--",
		// allowClear: true,
		// dropdownParent: $("#OpenModalUser")
	// });
	
	$(document).ready(function(){
		$('.select2-multiple').select2({dropdownParent: $("#OpenModalUser")});
		$('#select_all').on('click',function(){
			if(this.checked){
				$('.check-input').each(function(){
					this.checked = true;
				});
				}else{
				$('.check-input').each(function(){
					this.checked = false;
				});
			}
		});
		
		$('.check-input').on('click',function(){
			if($('.check-input:checked').length == $('.check-input').length){
				$('#select_all').prop('checked',true);
				}else{
				$('#select_all').prop('checked',false);
			}
		});
	});
</script>	