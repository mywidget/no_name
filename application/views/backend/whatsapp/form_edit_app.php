<input type='hidden' name='id' id='id' value='<?=$device->id?>'>
<input type='hidden' name='id_pengaturan' id='id_pengaturan' value='1'>
<input type='hidden' name='type_add' id='type_add' value='edit'>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label>Nama Device</label>
			<input type="text" name="nama_device" id="nama_device" value="<?=$device->name?>" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Nomor Device</label>
			<input type="text" name="nomor_device" id="nomor_device" value="<?=$device->device?>"  class="form-control" required>
		</div>
	</div>
</div>
