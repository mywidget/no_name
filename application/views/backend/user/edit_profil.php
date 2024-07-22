<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Profile
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
			<?php
				echo $this->session->flashdata('message');
				$attributes = array('class'=>'form-horizontal','role'=>'form');
				echo form_open_multipart($this->uri->segment(1).'/save_profil',$attributes); 
				
			?>
			
			<input type='hidden' name='<?=encrypt_url('id');?>' value='<?=encrypt_url($rows['sesi_login']);?>'>
			<input type='hidden' name='lock' value='<?=$rows['lock_menu'];?>'>
			<div class="row">
				<div class="col-md-6">
					<!-- Form Basic -->
					<div class="card mb-4">
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h4 class="card-title">Form <?=$judul;?></h4>
							
						</div>
						<div class="card-body">
							
							<div class="form-group mb-2">
								<label class="form-label" for="email">Username</label>
								<input type="text" name="email" class="form-control" value="<?=$rows['email'];?>" readonly>
							</div>
							<div class="form-group mb-2">
								<label class="form-label" for="password">Password</label>
								<input type="password" name="password" class="form-control" autocaomplate="off">
							</div>
							<div class="form-group mb-2">
								<label class="form-label" for="nama">Nama lengkap</label>
								<input type="text" name="nama" class="form-control" value="<?=$rows['nama_lengkap'];?>" required>
							</div>
							<div class="form-group mb-2">
								<label class="form-label" for="nama_lembaga">Nama Unit</label>
								<input type="text" name="nama_lembaga" class="form-control" value="<?=$rows['nama_lembaga'];?>" required>
							</div>
							<div class="form-group mb-2">
								<label class="form-label" for="pangkat">Pangkat</label>
								<input type="text" name="pangkat" class="form-control" value="<?=$rows['pangkat'];?>" required>
							</div>
							<div class="form-group row mb-2">
								<div class="col-md-7">
									<label class="form-label" for="jabatan">Jabatan</label>
									<input type="text" name="jabatan" class="form-control" value="<?=$rows['jabatan'];?>" required>
								</div>
								<div class="col-md-5">
									<label class="form-label" for="nrp">NIP</label>
									<input type="text" name="nrp" class="form-control" value="<?=$rows['nrp'];?>" required>
								</div>
							</div>
							<?php  
								if ($rows['level'] == 'admin' AND $rows['parent']==0){ 
									$readonly ='';
									$read ='';
									$hidden ='';
									}else{
									$readonly ='readonly';
									$read ='readonly';
									$hidden ='hidden';
								}
							?>
							<div class="form-group  mb-2" <?=$hidden;?>>
								<label class="form-label" >Level akses</label>
								<select name="level" class="custom-select form-control" <?=$readonly;?>>
									<?php 
										$akses=$this->model_app->view_where_ordering('hak_akses',array('level'=>$rows['level']),'id_level','ASC')->result_array();
										if(!empty($akses)){
											foreach($akses AS $key=>$val){
												if($val['id_level']==$rows['id_level']){
													echo '<option value="'.$val['id_level'].','.$val['level'].'" selected>'.$val['nama'].'</option>';
													}else{
													echo '<option value="'.$val['id_level'].','.$val['level'].'">'.$val['nama'].'</option>';
												}
											}
										} 
									?>
								</select>
							</div>
							 
							<div class="form-group d-flex flex-row mt-2 mb-2">
								<?php if ($rows['aktif']=='Y'){ ?>
									<div class="col-sm-3">Status</div>
									<div class="col-sm-9"><span class="badge badge-success flat">Aktif</span>
										<input type="hidden" value="Y" id="aktif1" name="aktif">
									</div>
								<?php } ?>
							</div>	
							
						</div>
						<div class="card-footer">
							<div class="row align-items-center">
								<div class="col">Profile pengguna</div>
								<div class="col-auto">
									<button type="submit" name="submit" class="btn btn-success">Simpan</button>
								</div>
							</div>
						</div>
					</div>
					
					
				</div>
				<div class="col-md-6">
					<!-- Form Basic -->
					<div class="card mb-4">
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h4 class="card-title">Menu akses</h4>
						</div>
						<div class="card-body">
							<div class="over-profile  mb-2">
								<label class="form-check">
									<input type="checkbox" class="form-check-input" id="select_all"/>
									<span class="form-check-label">Pilih semua</span>
								</label>
								<?php
									
									$lv = $rows['id_level'];
									$parent = $rows['parent'];
									$resultz = $this->db->query("SELECT * FROM menuadmin where FIND_IN_SET('$lv', CONCAT(id_level, ',')) AND aktif='Y' order by urutan");
									if($resultz->num_rows() >0){
										foreach ($resultz->result_array() as $rowz){
											$dataTz[$rowz['idparent']][] = $rowz;
										}
										// print_r($dataTz);
										echo checkbox($dataTz,0,$rowz['idparent'],$rows['idmenu'],$parent);
									}
								?>
							</div>
							<div class="form-group mt-2">	
								<label class="form-label" >Materiel Akses</label>
								
								<select id="akses" name="akses[]" class="form-control select2-profil" multiple="multiple" <?=$read;?>>
									<?php
										foreach($kategori as $rowz){
											$dataTzx[$rowz->id_parent][] = $rowz;
										}
										echo select_kbox($dataTzx,0,0,$rows['type_akses']);
									?>
								</select>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
<style>
	select[readonly] {
	background: #eee;
	pointer-events: none;
	touch-action: none;
	}
	input[readonly] {
	color: #616876;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	background-color: var(--tblr-gray-100);
	opacity: 1;
	pointer-events: none! important;
	cursor: not-allowed! important;
	touch-action: none;
	}
	.theme-dark .select2-selection__choice__display{color:#1D273B}
	.theme-dark .select2-results__option{color:#1D273B}
	.hidden{display:none}
</style>

<script>
	$(document).on('keydown', '#mail', function(e) {
		if (e.keyCode == 32) return false;
	});
	var parent = "<?=$rows['parent'];?>";
	var level = "<?=$rows['level'];?>";
	if(level=='admin' && parent==0){
		$('.over-profile').slimScroll({
			height: '450px'
		});
		}else{
		$('.over-profile').slimScroll({
			height: '420px'
		});
	}
	$(".select2-profil").select2();
	
	$('select[readonly=readonly] option:not(:selected)').prop('disabled', true);
	$(document).ready(function(){
		// firs_load();
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