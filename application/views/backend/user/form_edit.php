<form id="formAdd">
	<input type="hidden" value="<?=encrypt_url($arr->id_user);?>" class="form-control" id="id" name="id">
	<input type="hidden" value="edit" class="form-control" id="type" name="type">
	<div class="row mt-0 pt-0">
		<div class="col-md-6">
			
			<div class="form-group mb-1 mt-0 pt-0">
				<label class="form-label" for="mail">Username</label>
				<input type="text" name="mail" value="<?=$arr->email;?>" class="form-control" id="mail" placeholder="Email" required="">
			</div>
			<div class="form-group mb-1">
				<label class="form-label" for="password">Password</label>
				<input type="password" name="password" class="form-control" id="password" placeholder="Password Pengguna" value="" required="" autocomplete="off">
			</div>
			<div class="form-group mb-1">
				<label class="form-label" for="title">Nama Lengkap</label>
				<input type="text" name="title" value="<?=$arr->nama_lengkap;?>" class="form-control" id="title" placeholder="Nama Lengkap" required="">
			</div>
			<div class="form-group mb-1">
				<label class="form-label" for="nama_lembaga">Nama Lembaga</label>
				<input type="text" name="nama_lembaga" value="<?=$arr->nama_lembaga;?>" class="form-control" id="nama_lembaga" placeholder="Nama Lembaga" required="">
			</div>
			<div class="form-group mb-2">
				<label class="form-label" for="pangkat">Pangkat</label>
				<input type="text" name="pangkat" class="form-control" value="<?=$arr->pangkat;?>" required>
			</div>
			<div class="form-group row mb-2">
				<div class="col-md-7">
					<label class="form-label" for="jabatan">Jabatan</label>
					<input type="text" name="jabatan" class="form-control" value="<?=$arr->jabatan;?>" required>
				</div>
				<div class="col-md-5">
					<label class="form-label" for="nrp">NRP</label>
					<input type="text" name="nrp" class="form-control" value="<?=$arr->nrp;?>" required>
				</div>
			</div>
			<div class="form-group mb-1">
				<label class="form-label" for="daftar">TGL. Daftar </label>
				<input type="date" name="daftar" value="<?=($arr->tgl_daftar);?>" class="form-control dpd1"  id="daftar">
			</div>
		</div>
		<div class="col-md-6">
			
			<div class="form-group mb-0">
				<label class="form-label" for="profit">Menu Akses</label>
			</div>
			<div class="over-users p-1">
				<label class="form-check">
					<input type="checkbox" class="form-check-input" id="select_all"/>
					<span class="form-check-label">Pilih semua</span>
				</label>
				<?php
					$lv = $arr->id_level;
					$resultz = $this->db->query("SELECT * FROM menuadmin where FIND_IN_SET('$lv', CONCAT(id_level, ',')) AND aktif='Y' order by urutan");
					foreach ($resultz->result_array() as $rowz){
						$dataT[$rowz['idparent']][] = $rowz;
					}
					
					echo checkbox($dataT,0,$rowz['idparent'],$arr->idmenu);
				?>
			</div>
	 
			<div class="form-group mb-1">
				<label class="form-label" >Level Akses</label>
				<select name='id_level' class="form-select form-control">
					<?php
						if($this->level=="admin") {
							$hak_akses = $this->model_app->view_where('hak_akses',['publish'=>'Y'])->result_array();
							foreach($hak_akses AS $we){
								if ($arr->id_level==$we['id_level']){
									echo "<option value=$we[id_level] selected>$we[nama]</option>";
									}else{
									echo "<option value=$we[id_level]>$we[nama]</option>"; 
								}
							}
							}else{
							$tampil = $this->db->query("select * FROM hak_akses where id_level IN ($arr->idlevel)");
							if ($arr->id_level==0){
								echo "<option value=0 selected>Pilih Level Akses</option>"; 
							}
							foreach($tampil->result_array() AS $w){
								if ($arr->id_level==$w['id_level']){
								echo "<option value=$w[id_level] selected>$w[nama]</option>";}
								else{
								echo "<option value=$w[id_level]>$w[nama]</option>";}}
						}
					?>
				</select>
			</div>
			<div class="form-group mb-1">	
				<label class="form-label" >Materiel Akses</label>
				<select id="cat" name="cat[]" class="form-control select2-multiple" multiple="multiple">
					<?php
						foreach($kategori as $rowz){
							$dataTz[$rowz->id_parent][] = $rowz;
						}
						echo select_kbox($dataTz,0,0,$arr->type_akses);
					?>
				</select>	
			</div>
			
			<div class="form-group row mb-0"> 
				
				<div class="col-md-6">
					<div class="form-label">Status Aktif</div>
					<div>
						<?php if($arr->aktif=="Y") { ?>
							<label class="form-check form-check-inline">
								<input class="form-check-input" type="radio" id="aktif1" name="aktif" value="Y" checked>
								<span class="form-check-label">Ya</span>
							</label>
							<label class="form-check form-check-inline">
								<input class="form-check-input" type="radio" id="aktif2" name="aktif" value="N" >
								<span class="form-check-label">Tidak</span>
							</label>
							<?php }else{ ?>
							<label class="form-check form-check-inline">
								<input class="form-check-input" type="radio" id="aktif1" name="aktif" value="Y">
								<span class="form-check-label">Ya</span>
							</label>
							<label class="form-check form-check-inline">
								<input class="form-check-input" type="radio" id="aktif2" name="aktif" value="N" checked>
								<span class="form-check-label">Tidak</span>
							</label>
						<?php 	}  ?>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-label">Lock Menu</div>
					<div>
						<?php 
							if($this->level=="admin") {
								if($arr->lock_menu==1) { ?>
								<label for="lock_1" class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="lock_1" name="lock" value="1" checked>
									<span class="form-check-label">Ya</span>
								</label>
								<label for="lock_2" class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="lock_2" name="lock" value="0" >
									<span class="form-check-label">Tidak</span>
								</label>
								<?php }else{ ?>
								<label for="lock_1" class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="lock_1" name="lock" value="1">
									<span class="form-check-label">Ya</span>
								</label>
								<label for="lock_2" class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="lock_2" name="lock" value="0" checked>
									<span class="form-check-label">Tidak</span>
								</label>
								<?php 	
								} 
								}else{ 
								if($arr->lock_menu==1) {
									
								?>
								<label class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="lock_2" name="lock" value="0" checked>
									<span class="form-check-label">Ya</span>
								</label>
								<?php 
								}
							}
						?>
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
	$('.over-users').slimScroll({
		height: '300px'
	});
	$('.over-satker').slimScroll({
		height: '100px'
	});
	$(document).on('keydown', '#mail', function(e) {
		if (e.keyCode == 32) return false;
	});
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