<input type='hidden' name='id' id='id' value='<?=$device->id?>'>
<input type='hidden' name='id_pengaturan' id='id_pengaturan' value='2'>
<input type='hidden' name='type_add' id='type_add' value='edit'>
<div class="form-group">
	<label for="token_api">Token WA-API <a href="javascript:void(0)" class="register">DAFTAR</a></label>
	<input type="text" name="token_api" id="token_api" value="<?=$device->token?>" class="form-control" required>
</div>

<script>
	
    $(document).on('click','.register',function(e){
		window.open('https://pospercetakan.my.id/harga', '_blank');
	});
</script>