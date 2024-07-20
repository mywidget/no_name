
<form id="form-update" method="post">
    
    <div class="shadow rounded-12 p-3 mb-3">
        <hr class="my-2">
        <div class="d-flex justify-content-between">
            Assalamualaikum Wr. Wb <strong> <?php echo $row['nama'];?></strong>
        </div>
        <small class="d-block text-secondary mt-2"><strong>Note: </strong> Selamat Anda Terdaftar Sebagai calon santri Pondok Pesantren Tebuireng 4 Al-Ishlah, pada Unit : <?php echo $row['unit_sekolah'];?> Kelas : <?php echo $row['kelas'];?> Untuk selanjutnya silahkan upload bukti pembayaran, Foto Santri, Scan Foto Kartu Keluarga untuk melengkapi proses pendaftaran, Terimakasih Wassalam</small>
    </div>
    <div class="shadow rounded-12 p-3 mb-3">
        <hr class="my-2">
        <div class="d-flex justify-content-between">
            Biaya Pendaftaran :  <strong> Rp. <?php echo  $rupiah=number_format($row['biaya_daftar'],0,',','.');?></strong>
            <strong id="total"></strong>
        </div>
    </div>
    
    <div class="shadow rounded-12 p-3 mb-3">
        <div class="col-sm-3 col-md-3 col-lg-3">
            <label for="fotobukti" class="form-label m-0"><small> Slip Transfer </small></label>
        </div>
        <div class="rounded-12 p-3">
            <div id="fotoBuktiPreviewContainer" class="position-relative overflow-hidden mb-" style="width: 125px; height: 166.67px; display: none;">
                <img id="fotoBuktiPreview" class="position-absolute top-0 left-0 w-100 h-100" src="" alt="Foto Transfer Preview" style="object-fit: cover;">
            </div>
            <input class="form-control" type="file" id="image" name="fotobukti" accept="image/png, image/jpg, image/jpeg" required="" />
            <br>
            <div id="frames">
                <?php
                    $opathFile = FCPATH.'upload/foto_dokumen/'.$row['fotobukti'];
                    
                    $size = @getimagesize($opathFile);
                    if($size !== false){
                        $fotobukti = base_url().'upload/foto_dokumen/'.$row['fotobukti'];
                        }else{
                        $fotobukti = base_url()."upload/foto_dokumen/noimage.jpg";
                    }
                    
                ?>  
                <img class="img-thumbnail" style="width: 125px;" src="<?=$fotobukti;?>">
            </div>
        </div>
    </div>
    
    <div class="shadow rounded-12 p-3 mb-3">
        <div class="col-sm-3 col-md-3 col-lg-3">
            <label for="fotoSantri" class="form-label m-0"><small> Foto Santri </small></label>
        </div>
        <div class="rounded-12 p-3">
            <div id="fotoSantriPreviewContainer" class="position-relative overflow-hidden mb-2" style="width: 125px; height: 166.67px; display: none;">
                <img id="fotoSantriPreview" class="position-absolute top-0 left-0 w-100 h-100" src="" alt="Foto Santri Preview" style="object-fit: cover;">
            </div>
            <input class="form-control" type="file" id="image1" name="fotosantri" accept="image/png, image/jpg, image/jpeg" required="" />
            <br>
            <div id="frames1">
                <?php
                    $opathFile = FCPATH.'upload/lampiran/'.$row['foto'];
                    
                    $size = @getimagesize($opathFile);
                    if($size !== false){
                        $foto = base_url().'upload/lampiran/'.$row['foto'];
                        }else{
                        $foto = base_url()."upload/foto_dokumen/noimage.jpg";
                    }
                    
                ?>  
                <img class="img-thumbnail" style="width: 125px;" src="<?=$foto;?>">
            </div>
        </div>
    </div>
    
    <div class="shadow rounded-12 p-3 mb-3">
        <div class="col-sm-3 col-md-3 col-lg-3">
            <label for="fotoKk" class="form-label m-0"><small> Foto Kartu Keluarga </small></label>
        </div>
        <div class="rounded-12 p-3">
            <div id="fotoKkPreviewContainer" class="position-relative overflow-hidden mb-2" style="width: 237.5px; height: 125px; display: none;">
                <img id="fotoKkPreview" class="position-absolute top-0 left-0 w-100 h-100" src="./formulir" alt="Foto KK Preview" style="object-fit: cover;">
            </div>
            <input class="form-control" type="file" id="image2" name="foto_kk" accept="image/png, image/jpg, image/jpeg" required=""/>
            <br>
            <div id="frames2">
                <?php
                    $opathFile = FCPATH.'upload/lampiran/'.$row['foto_kk'];
                    
                    $size = @getimagesize($opathFile);
                    if($size !== false){
                        $foto_kk = base_url().'upload/lampiran/'.$row['foto_kk'];
                        }else{
                        $foto_kk = base_url()."upload/foto_dokumen/noimage.jpg";
                    }
                    
                ?>  
                <img class="img-thumbnail" style="width: 125px;" src="<?=$foto_kk;?>">
                
            </div>
        </div>
    </div>
</div>

<div class="shadow rounded-12 p-3">
    <div class="col-sm-3 col-md-3 col-lg-3">
        <label for="fotoKk" class="form-label m-0"><small> Surat Pernyataan </small></label>
    </div>
    <div class="rounded-12 p-3">
        <div id="fotoKkPreviewContainer" class="position-relative overflow-hidden mb-2" style="width: 237.5px; height: 125px; display: none;">
            <img id="fotoKkPreview" class="position-absolute top-0 left-0 w-100 h-100" src="./formulir" alt="Surat Pernyataan" style="object-fit: cover;">
        </div>
        <input class="form-control" type="file" id="image3" name="surat" accept="" required=""/>
        <br>
        <div id="frames2">
            <?php
                $opathFile = FCPATH.'upload/lampiran/'.$row['surat'];
                
                $size = @getimagesize($opathFile);
                if($size !== false){
                    $surat = base_url().'upload/lampiran/'.$row['surat'];
                    }else{
                    $surat = base_url()."upload/nodok.jpg";
                }
                
            ?>  
            <img class="img-thumbnail" style="width: 125px;" src="<?=$surat;?>">
            
        </div>
    </div>
</div>
</div>

<div class="container p-3">
    <div class="row">
        <div class="col-8 col-sm-6 mx-auto">
            <input type="hidden" name="kodedaftar" value="<?php echo $row['kode_daftar'];?>"> 
            <button type="submit" name="simpanbukti" class="btn btn-success rounded-pill w-100" >Kirimkan Dokumen</button>
        </div>
    </div>
</div>

</form>

<?php $this->RenderScript[] = function() { ?>
    
 
<?php } ?>        