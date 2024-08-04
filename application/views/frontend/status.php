<?php
    if(!empty($tahun['nama_tahun'])){
        $nama_tahun = $tahun['nama_tahun'];
        }else{
        $nama_tahun = '';
    }
?>
<main class="container my-4">
    <h4 class="my-4 text-dark">Cek Status Pendaftaran Santri Baru <?=$nama_tahun;?></h4>
    <p class="text-secondary">Masukkan Nomor Registrasi Online dan Tanggal Lahir dengan format HHBBTTTT contoh 23002010</p>
    <div class="shadow rounded-12 p-3 mb-4">
        <form method='POST' id="form-cek">   
            <div class="row align-items-center">
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <label for="noInduk">Nomor Pendaftaran</label>
                </div>
                <div class="col-sm-8 col-md-6 col-lg-4">
                    <input type="number" name="kode_daftar" id="noInduk" class="form-control" value="" required="">
                </div>
            </div>
            
            <div class="row align-items-center mt-3">
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                </div>
                <div class="col-sm-8 col-md-6 col-lg-4">
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="" required="">
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-sm-3 col-md-3 col-lg-2"></div>
                <div class="col-sm-8 col-md-6 col-lg-4 justify-content-end">
                    <button type="submit" class="btn btn-success rounded-pill px-5"> Cek Status</button>
                </div>
            </div>
        </form>
    </div>
    <div id="show_status"></div>
</main>
<?php $this->RenderScript[] = function() { ?>
    <script>
    // var html = '<h1>A</h1><h2>B</h2><p>Foobar</p><h3>C</h3>';
    
    // //split on ><
    // var arr = html.split(/></g);
    
    // //split removes the >< so we need to determine where to put them back in.
    // for(var i = 0; i < arr.length; i++){
    // if(arr[i].substring(0, 1) != '<'){
    // arr[i] = '<' + arr[i];
    // }
    
    // if(arr[i].slice(-1) != '>'){
    // arr[i] = arr[i] + '>';
    // }
    // }
    // console.log(arr)
    $('#form-cek').on('submit', function (e) {
        e.preventDefault();
        $('button:submit', this).html(spinner).prop('disabled', true);
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            url: base_url+ "dashboard/cek_status",
            success: (response) => {
                $('#show_status').html(response);
                
            },
            complete: () => {
                $('button:submit', this).text('Cek Status').prop('disabled', false);
            },
        });
    });
    
    /* --------- UPDATE PHOTO BUKTI TRANSFER ---------------*/
    $(document).on('change','#fotobukti',function(){
        var id_pendaftar = $('#id_pendaftar').val();
        var file_data = $('#fotobukti').prop('files')[0];  
        var image_name = file_data.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        
        if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png']) == -1){
            swal({title: 'Oops!', text: 'File yang di unggah tidak sesuai dengan format, File harus jpg, jpeg, gif, png.!', icon: 'error', timer: 2000,});
        }
        
        var form_data = new FormData();
        form_data.append("id",id_pendaftar);
        form_data.append("type",'slip');
        form_data.append("file",file_data);
        $.ajax({
            url: base_url+"dashboard/update_lampiran",
            method:'POST',
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
                // $("body").loading({zIndex:1051,message:'saving data'});
            },
            success:function(data){
                // console.log(data)
                if (data.status == true) {
                    swal.fire({
                        icon: 'success',
                        title: 'Upload Surat',
                        html: data.msg,
                        confirmButtonText: 'OK',
                    })
                    .then(() => {
                        $('#img-bukti').attr("src", data.image);
                        refreshImage(data.image);
                    });
                    } else {
                    swal.fire({
                        icon: 'error',
                        title: 'Error Upload Foto',
                        html: data.msg,
                        confirmButtonText: 'OK',
                    })
                    .then(() => {
                        
                    });
                }
                // $("body").loading('stop');
            },
            error : function(res, status, httpMessage) {
                // $("body").loading('stop');
                if(res.status==401){
                    // sweet_login(httpMessage,'warning',base_url);
                    }else{
                    // sweet("Peringatan!!!", httpMessage, "warning", "warning");
                }			
            }
        });
    });
    
    /* --------- UPDATE PHOTO SANTRI ---------------*/
    $(document).on('change','#fotosantri',function(){
        var id_pendaftar = $('#id_pendaftar').val();
        var file_data = $('#fotosantri').prop('files')[0];  
        var image_name = file_data.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        
        if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png']) == -1){
            swal({title: 'Oops!', text: 'File yang di unggah tidak sesuai dengan format, File harus jpg, jpeg, gif, png.!', icon: 'error', timer: 2000,});
        }
        
        var form_data = new FormData();
        form_data.append("id",id_pendaftar);
        form_data.append("type",'santri');
        form_data.append("file",file_data);
        $.ajax({
            url: base_url+"dashboard/update_lampiran",
            method:'POST',
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
                // $("body").loading({zIndex:1051,message:'saving data'});
            },
            success:function(data){
                // console.log(data)
                if (data.status == true) {
                    swal.fire({
                        icon: 'success',
                        title: 'Upload Surat',
                        html: data.msg,
                        confirmButtonText: 'OK',
                    })
                    .then(() => {
                        $('#img-santri').attr("src", data.image);
                        refreshImage(data.image);
                    });
                    
                    } else {
                    swal.fire({
                        icon: 'error',
                        title: 'Error Upload Foto',
                        html: data.msg,
                        confirmButtonText: 'OK',
                    })
                    .then(() => {
                        
                    });
                }
                // $("body").loading('stop');
            },
            error : function(res, status, httpMessage) {
                // $("body").loading('stop');
                if(res.status==401){
                    // sweet_login(httpMessage,'warning',base_url);
                    }else{
                    // sweet("Peringatan!!!", httpMessage, "warning", "warning");
                }			
            }
        });
    });
    
    /* --------- UPDATE PHOTO surat ---------------*/
    $(document).on('change','#surat',function(){
        var id_pendaftar = $('#id_pendaftar').val();
        var file_data = $('#surat').prop('files')[0];  
        var image_name = file_data.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        
        if(jQuery.inArray(image_extension,['pdf','doc','docx','jpg','jpeg','png']) == -1){
            swal.fire({title: 'Oops!', text: 'File yang di unggah tidak sesuai dengan format, File harus jpg, jpeg, pdf, png doc, docx.!', icon: 'error', timer: 2000,});
            return;
        }
        
        var form_data = new FormData();
        form_data.append("id",id_pendaftar);
        form_data.append("type",'surat');
        form_data.append("file",file_data);
        $.ajax({
            url: base_url+"dashboard/update_lampiran",
            method:'POST',
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
                // $("body").loading({zIndex:1051,message:'saving data'});
            },
            success:function(data){
                // console.log(data)
                if (data.status == true) {
                    swal.fire({
                        icon: 'success',
                        title: 'Upload Surat',
                        html: data.msg,
                        confirmButtonText: 'OK',
                    })
                    .then(() => {
                        $('#img-surat').attr("src", data.image);
                        refreshImage(data.image);
                    });
                    
                    } else {
                    swal.fire({
                        icon: 'error',
                        title: 'Error Upload Surat',
                        html: data.msg,
                        confirmButtonText: 'OK',
                    })
                    .then(() => {
                        
                    });
                }
                
                // $("body").loading('stop');
            },
            error : function(res, status, httpMessage) {
                // $("body").loading('stop');
                if(res.status==401){
                    // sweet_login(httpMessage,'warning',base_url);
                    }else{
                    // sweet("Peringatan!!!", httpMessage, "warning", "warning");
                }			
            }
        });
    });
    
    /* --------- UPDATE PHOTO KK ---------------*/
    $(document).on('change','#foto_kk',function(){
        var id_pendaftar = $('#id_pendaftar').val();
        var file_data = $('#foto_kk').prop('files')[0];  
        var image_name = file_data.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        
        if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png']) == -1){
            swal({title: 'Oops!', text: 'File yang di unggah tidak sesuai dengan format, File harus jpg, jpeg, gif, png.!', icon: 'error', timer: 2000,});
        }
        
        var form_data = new FormData();
        form_data.append("id",id_pendaftar);
        form_data.append("type",'foto_kk');
        form_data.append("file",file_data);
        $.ajax({
            url: base_url+"dashboard/update_lampiran",
            method:'POST',
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
                // $("body").loading({zIndex:1051,message:'saving data'});
            },
            success:function(data){
                // console.log(data)
                if (data.status == true) {
                    swal.fire({
                        icon: 'success',
                        title: 'Upload Surat',
                        html: data.msg,
                        confirmButtonText: 'OK',
                    })
                    .then(() => {
                        $('#img-kk').attr("src", data.image);
                        refreshImage(data.image);
                    });
                    } else {
                    swal.fire({
                        icon: 'error',
                        title: 'Error Upload Foto',
                        html: data.msg,
                        confirmButtonText: 'OK',
                    })
                    .then(() => {
                        
                    });
                }
                // $("body").loading('stop');
            },
            error : function(res, status, httpMessage) {
                // $("body").loading('stop');
                if(res.status==401){
                    // sweet_login(httpMessage,'warning',base_url);
                    }else{
                    // sweet("Peringatan!!!", httpMessage, "warning", "warning");
                }			
            }
        });
    });
    
    async function refreshImage(url) {
        await fetch(url, {cache: 'reload', mode: 'no-cors'});
    }
    
</script>    

<?php } ?>