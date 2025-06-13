<?php
    $today = strtotime(date('Y-m-d'));
    $tgl_mulai = strtotime($gelombang->tgl_mulai);
    $tgl_selesai = strtotime($gelombang->tgl_selesai);
    
    if($today >= $tgl_mulai AND $today <= $tgl_selesai){
        $buka = true;
        $deskripsi = '';
        }else{
        $buka = true;
        $deskripsi = $gelombang->deskripsi;
    }
    // $email          ='rangkasku@gmail.com';
    // $nama           ='Munajat';
    // $tempat_lahir   ='Lebak';
    $tgl_lahir      ='2011-01-01';
    // $nik            ='1205175502120004';
    // $nama_sekolah   ='SMPN 5';
    // $alamat_sekolah ='Rangkasbitung';
    // $nisn           ='0127279327';
    // $no_kk           ='1402073008210003';
    // $nama_ayah      ='Julianus Manalu';
    // $nik_ayah       ='1205170407820009';
    // $nama_ibu       ='Siti Julaiha';
    // $nik_ibu        ='1205174806850008';
    // $anak_Ke        =1;
    // $dari           =2;
    // $nomor_hp       ='089611274798';
    // $alamat         ='Jln poros Penyaguan, Indragiri hulu,Riau';
    // $rt             =2;
    // $dusun          ="Tutul";
    // $kodepos        =42117;
    
    $selected = 'selected';
    
    if(!empty($tahun['nama_tahun'])){
        $nama_tahun = $tahun['nama_tahun'];
        $id_tahun_akademik = $tahun['id_tahun_akademik'];
        }else{
        $nama_tahun = '';
        $id_tahun_akademik = '';
    }
    
    if($buka){
        
    ?>
    
    <main class="container" id="formulir">
        <h4 class="mt-5 mb-4 db-primary">Formulir Pendaftaran Santri Baru <?=$nama_tahun;?></h4>
        <form method="post" class='form-horizontal needs-validation' id="formPendaftaran" novalidate>
            <ol type="I">
                <h5>
                    <li>Identitas calon santri</li>
                </h5>
                <div class="container p-0">
                    <input type="hidden" name="thnakademik" id="thnakademik" class="form-control" value="<?=encrypt_url($id_tahun_akademik);?>" required>
                    <input type="hidden" name="id_gelombang" id="id_gelombang" class="form-control" value="<?=$gelombang->id_gelombang;?>" required>
                     
                <h5 class="mt-3">
                    <li>Lain-lain</li>
                </h5>
                <div class="container p-0">
                   
                    <div class="row mt-3">
                        <div class="col-sm-3 col-md-3 col-lg-2">
                            <label for="fotoSantri" class="form-label m-0"><small> Foto Calon Santri </small></label>
                        </div>
                        <div class="col-sm-9 col-md-8 col-lg-6">
                            <div id="fotoSantriPreviewContainer" class="position-relative overflow-hidden mb-2" style="width: 125px; height: 166.67px; display: none;">
                                <img id="fotoSantriPreview" class="position-absolute top-0 left-0 w-100 h-100" src="./formulir" alt="Foto Santri Preview" style="object-fit: cover;">
                            </div>
                            
                            <input class="form-control" type="file" id="fotoSantri" name="fotoSantri" accept="image/png, image/jpg, image/jpeg" required="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-3 col-md-3 col-lg-2">
                            <label for="fotoKk" class="form-label m-0"><small> Foto Kartu Keluarga </small></label>
                        </div>
                        <div class="col-sm-9 col-md-8 col-lg-6">
                            <div id="fotoKkPreviewContainer" class="position-relative overflow-hidden mb-2" style="width: 237.5px; height: 125px; display: none;">
                                <img id="fotoKkPreview" class="position-absolute top-0 left-0 w-100 h-100" src="./formulir" alt="Foto KK Preview" style="object-fit: cover;">
                            </div>
                            
                            <input class="form-control" type="file" id="fotoKk" name="fotoKk" accept="image/png, image/jpg, image/jpeg" required="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-3 col-md-3 col-lg-2">
                            <label for="fotobukti" class="form-label m-0"><small> Bukti Transfer </small></label>
                        </div>
                        <div class="col-sm-9 col-md-8 col-lg-6">
                            <div id="fotobuktiPreviewContainer" class="position-relative overflow-hidden mb-2" style="width: 237.5px; height: 125px; display: none;">
                                <img id="fotobuktiPreview" class="position-absolute top-0 left-0 w-100 h-100" src="./formulir" alt="Foto KK Preview" style="object-fit: cover;">
                            </div>
                            
                            <input class="form-control" type="file" id="fotobukti" name="fotobukti" accept="image/png, image/jpg, image/jpeg" required="">
                            <div class="invalid-feedback"></div>
                            <div class="form-text">
                                <a class="link-primary" href="#PanduanBayar" data-bs-toggle="modal" data-bs-target="#PanduanBayar">
                                    Panduan Pembayaran
                                </a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-3 col-md-3 col-lg-2">
                            <label for="fotobukti" class="form-label m-0"><small> Recaptcha </small></label>
                        </div>
                        <div class="col-sm-9 col-md-8 col-lg-6">
                            <div class="g-recaptcha" data-sitekey="<?=tag_key('site_key');?>"></div>
                        </div>
                    </div>
                </ol>
                
                <div class="container mt-4 mb-5">
                    <div class="row justify-content-center">
                        <div class="col-sm-auto">
                            <button type="submit" id="form_simpan" class="btn btn-lg btn-success rounded-pill w-100 px-5">
                                Kirimkan formulir
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </main>
          
        <style>
            .iti.iti--allow-dropdown { width: 100% }
        </style>
        <!--modal end-->
        <?php }else{ ?>
        <main class="container" id="formulir">
            <h4 class="mt-5 mb-4 db-primary text-center">Pendaftaran Santri Baru <?=$gelombang->title;?></h4>
            <?=$deskripsi;?>
        </main>
        <?php }
        $this->RenderScript[] = function() {
        ?>
      
        <script src="<?=base_url('assets');?>/js/formulir_test.js?v=<?=time();?>"></script>
         
        <?php    
        }
    ?>
