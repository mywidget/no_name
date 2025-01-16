<?php
    
    // $email          ='rangkasku@gmail.com';
    // $nama           ='Munajat';
    // $tempat_lahir   ='Lebak';
    // $tgl_lahir      ='2000-01-01';
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
    
    $email          ='';
    $nama           ='';
    $tempat_lahir   ='';
    $tgl_lahir      ='';
    $nik            ='';
    $nama_sekolah   ='';
    $alamat_sekolah ='';
    $nisn           ='';
    $no_kk          ='';
    $nama_ayah      ='';
    $nik_ayah       ='';
    $nama_ibu       ='';
    $nik_ibu        ='';
    $anak_Ke        ='';
    $dari           ='';
    $nomor_hp       ='';
    $alamat         ='';
    $rt         ='';
    $dusun         ='';
    $kodepos         ='';
    if(!empty($tahun['nama_tahun'])){
        $nama_tahun = $tahun['nama_tahun'];
        $id_tahun_akademik = $tahun['id_tahun_akademik'];
        }else{
        $nama_tahun = '';
        $id_tahun_akademik = '';
    }
?>

<main class="container" id="formulir">
    <h4 class="mt-5 mb-4 db-primary">Formulir Pendaftaran Santri Baru <?=$nama_tahun;?></h4>
    <form method="post" class='form-horizontal needs-validation' id="formPendaftaran" novalidate>
        <ol type="I">
            <h5>
                <li>Identitas calon santri</li>
            </h5>
            <div class="container p-0">
                <input type="hidden" name="thnakademik" id="thnakademik" class="form-control" value="<?=$id_tahun_akademik;?>" required>
                <div class="row align-items-center">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="email" class="form-label m-0"><small>Email Aktif</small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="email" name="email" id="email" class="form-control" autocomplete="off" autofocus="" value="<?=$email;?>" required="">
                        <div class="invalid-tooltip" id="email-feedback">Email wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="nama" class="form-label m-0"><small> Nama lengkap </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$nama;?>" required="">
                        <div class="invalid-tooltip" id="nama-feedback">Nama wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="gender" class="form-label m-0"><small> Jenis kelamin </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <select name="jenis_kelamin" id="gender" class="form-select" required="">
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-tooltip" id="gender-feedback">Janis kelamin wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="birthPlace" class="form-label m-0"><small> Tempat lahir </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="text" name="tempat_lahir" id="birthPlace" class="form-control" value="<?=$tempat_lahir;?>" required="">
                        <div class="invalid-tooltip">Tempat lahir wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="birthday" class="form-label m-0"><small> Tanggal lahir </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="date" name="tanggal_lahir" id="birthday" class="form-control" placeholder="Masukkan tanggal lahir" value="<?=$tgl_lahir;?>" required="">
                        <div class="invalid-tooltip">Tanggal lahir wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="nik" class="form-label m-0"><small> NIK </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="number" id="nik" name="nik" minlength="16" maxlength="16" class="form-control search-input" autocomplete="off"   value="<?=$nik;?>"  required>
                        <div class="invalid-tooltip" id="nik-feedback"> Masukkan NIK yang valid. NIK harus terdiri dari 16 digit </div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="sewali" class="form-label m-0"><small> Saudara sekandung di PP Tebuireng4 (Jika ada)</small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <input type="text" name="saudara_pp" id="sewali" class="form-control">
                        <input type="hidden" name="nisSewali" id="nisSewali" class="form-control">
                        <div class="position-relative">
                            <ul class="list-group shadow-sm sewali-autocomplete"></ul>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="statusAnak" class="form-label m-0"><small> Status dalam keluarga </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <select name="status_keluarga" id="statusAnak" class="form-select" required="">
                            <option value="" selected="" disabled="">Pilih</option>
                            <option value="Anak Kandung" selected="">Anak Kandung</option>
                            <option value="Anak Tiri">Anak Tiri</option>
                            <option value="Anak Angkat">Anak Angkat</option>
                        </select>
                        <div class="invalid-tooltip" id="statusAnak-feedback">Status wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="anakKe" class="form-label m-0"><small> Anak ke </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="number" name="anak_ke" id="anakKe" onkeyup="formatNumber(this)" class="form-control" value="<?=$anak_Ke;?>" required="">
                        <div class="invalid-tooltip">Anak ke Wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="jumlahSaudara" class="form-label m-0"><small> Dari </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="number" name="dari" id="jumlahSaudara" onkeyup="formatNumber(this)" class="form-control" value="<?=$dari;?>" required="">
                        <div class="invalid-tooltip">Jumlah saudara harus diisi</div>
                    </div>
                </div>
            </div>
            
            <h5 class="mt-3">
                <li>Pilihan Pendidikan</li>
            </h5>
            <div class="container p-0">
                <div class="row align-items-center d-none">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="statusSantri" class="form-label m-0"><small> Status </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <input type="text" name="s_pendidikan" id="statusSantri" value="Baru" class="form-control" readonly="">
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="statusPendidikan" class="form-label m-0"><small>Status di Sekolah</small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <select name="status_sekolah" id="statusPendidikan" class="form-select">
                            <option value="Baru">Baru</option>
                            <option value="Pindahan">Pindahan</option>
                        </select>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="unit" class="form-label m-0"><small> Unit Sekolah </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <select id="form_unit" class="form-select" name="unit_sekolah" required="">
                            <option value="">Pilih Unit</option>
                            <?php 
                                foreach($unit_sekolah AS $row){
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nama_jurusan']; ?></option>
                                <?php 
                                }
                            ?>
                        </select>
                        <div class="invalid-tooltip" id="form_unit-feedback">Unit wajib diisi</div>
                    </div>
                </div>
                
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="kelas" class="form-label m-0"><small>Kelas </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <select name="kelas" id="form_kelas" class="form-select" required=""></select>
                        <div class="invalid-tooltip" id="form_kelas-feedback">Kelas wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="biaya" class="form-label m-0"><small> Biaya Pendaftaran</small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <select name="biaya" id="form_biaya" class="form-select" required=""></select>
                        <div class="invalid-tooltip">Biaya Pendaftaran harus diisi</div>
                    </div>
                </div>
                
            </div>
            
            <div class="row align-items-center mt-2">
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <label for="kamar" class="form-label m-0"><small> Kamar </small></label>
                </div>
                <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                    <select id="form_kamar" class="form-select" name="kamar" required="">
                    </select>
                    <div class="invalid-tooltip" id="form_kamar-feedback">Kamar wajib diisi</div>
                </div>
            </div>
            
            <div class="row align-items-center mt-2">
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <label for="kuota" class="form-label m-0"><small> Kuota Kamar</small></label>
                </div>
                <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                    <select name="kuota" id="form_kuota" class="form-select" required=""></select>
                    <div class="invalid-tooltip" id="form_kuota-feedback">Kuota wajib diisi</div>
                </div>
            </div>
            
            <h5 class="mt-3">
                <li>Riwayat pendidikan</li>
            </h5>
            <div class="container p-0">
                <div class="row align-items-center">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="ijazahTerakhir" class="form-label m-0"><small> Ijazah Terakhir </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <select name="ijasah_terakhir" id="ijazahTerakhir" class="form-select" required="">
                            <option value="" selected="" disabled="">Pilih</option>
                            <option value="TK/PAUD">TK/PAUD</option>
                            <option value="SD/MI">SD/MI</option>
                            <option value="SMP/MTs/Sederajat">SMP/MTs/Sederajat</option>
                            <option value="SMA/MA/Sederajat">SMA/MA/Sederajat</option>
                            <option value="Diploma">Diploma</option>
                            <option value="Sarjana">Sarjana</option>
                            <option value="Pasca Sarjana">Pasca Sarjana</option>
                            <option value="Pesantren">Pesantren</option>
                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                        </select>
                        <div class="invalid-tooltip" id="ijazahTerakhir-feedback">Ijazah Terakhir wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="nama_sekolah_asal" class="form-label m-0"><small> Nama sekolah asal </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="text" name="nama_sekolah_asal" id="asalSekolah" class="form-control" value="<?=$nama_sekolah;?>" required="">
                        <div class="invalid-tooltip">Nama sekolah asal wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="alamatSekolah" class="form-label m-0"><small> Alamat sekolah asal </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="text" name="alamat_sekolah" id="alamatSekolah" value="<?=$alamat_sekolah;?>" class="form-control">
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="nisn" class="form-label m-0"><small> NISN </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="number" name="nisn" id="nisn" minlength="10" maxlength="10" class="form-control search-input" autocomplete="off"  value="<?=$nisn;?>" pattern="^\d{10}$" required>  
                        <div class="invalid-tooltip">NISN wajib diisi</div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="nokip" class="form-label m-0"><small> No KIP (Jika ada) </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <input type="text" name="no_kip" id="nokip" class="form-control">
                    </div>
                </div>
            </div>
            
            <h5 class="mt-3">
                <li>Identitas orang tua</li>
            </h5>
            <div class="container p-0">
                <div class="row align-items-center">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="nokk" class="form-label m-0"><small> Nomor Kartu Keluarga </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="number" name="no_kk" id="nokk" minlength="16" maxlength="16" class="form-control search-input" autocomplete="off"  value="<?=$no_kk;?>" required>  
                        <div class="invalid-tooltip">Nomor KK wajib diisi</div>
                    </div>
                </div>
                
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="namaAyah" class="form-label m-0"><small> Nama Ayah </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="text" name="nama_ayah" id="namaAyah" class="form-control" value="<?=$nama_ayah;?>" required="">
                        <div class="invalid-tooltip">Nama Ayah wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="nikAyah" class="form-label m-0"><small> NIK Ayah </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="number" name="nik_ayah" id="nikAyah" minlength="16" maxlength="16" class="form-control search-input" autocomplete="off" value="<?=$nik_ayah;?>" onkeyup="formatNumber(this)" required>  
                        <div class="invalid-tooltip" id="nikAyah-feedback"> Masukkan NIK yang valid. NIK harus terdiri dari 16 digit </div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="kondisiAyah" class="form-label m-0"><small> Kondisi </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <select name="kondisi_ayah" id="kondisiAyah" class="form-select">
                            <option value="Hidup">Hidup</option>
                            <option value="Meninggal">Meninggal</option>
                        </select>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="pendidikanAyah" class="form-label m-0"><small> Pendidikan Terakhir </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <select name="pendidikan_terakhir_ayah" id="pendidikanAyah" class="form-select" required="">
                            <option value="">Pilih Pendidikan</option>
                            <?php foreach($pendidikan AS $val): ?>
                            <option value="<?=$val->title;?>"><?=$val->title;?></option>
                            <?php endforeach;?>
                        </select>
                        <div class="invalid-tooltip" id="pendidikanAyah-feedback">Pendidikan wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="pekerjaanAyah" class="form-label m-0"><small> Pekerjaan </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <select name="pekerjaan_ayah" id="pekerjaanAyah" class="form-select" required="">
                            <option value="">Pilih Pekerjaan</option>
                            <?php foreach($pekerjaan AS $val): ?>
                            <option value="<?=$val->title;?>"><?=$val->title;?></option>
                            <?php endforeach;?>
                        </select>
                        <div class="invalid-tooltip">Pekerjaan wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="namaIbu" class="form-label m-0"><small> Nama Ibu </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="text" name="nama_ibu" id="namaIbu" class="form-control" value="<?=$nama_ibu;?>" required="">
                        <div class="invalid-tooltip">Nama Ibu wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="nikIbu" class="form-label m-0"><small> NIK Ibu </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="number" name="nik_ibu" id="nikIbu" minlength="16" maxlength="16" class="form-control search-input" autocomplete="off"  value="<?=$nik_ibu;?>" required>  
                        <div class="invalid-tooltip" id="nikIbu-feedback"> Masukkan NIK yang valid. NIK harus terdiri dari 16 digit </div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="kondisiIbu" class="form-label m-0"><small> Kondisi </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <select name="kondisi_ibu" id="kondisiIbu" class="form-select">
                            <option value="Hidup">Hidup</option>
                            <option value="Meninggal">Meninggal</option>
                        </select>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="pendidikanIbu" class="form-label m-0"><small> Pendidikan Terakhir </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <select name="pendidikan_terakhir_ibu" id="pendidikanIbu" class="form-select" required="">
                            <option value="">Pilih Pendidikan</option>
                            <?php foreach($pendidikan AS $val): ?>
                            <option value="<?=$val->title;?>"><?=$val->title;?></option>
                            <?php endforeach;?>
                        </select>
                        <div class="invalid-tooltip">Pendidikan wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="pekerjaanIbu" class="form-label m-0"><small> Pekerjaan </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <select name="pekerjaan_ibu" id="pekerjaanIbu" class="form-select" required="">
                            <option value="">Pilih Pekerjaan</option>
                            <?php foreach($pekerjaan AS $val): ?>
                            <option value="<?=$val->title;?>"><?=$val->title;?></option>
                            <?php endforeach;?>
                        </select>
                        <div class="invalid-tooltip">Pekerjaan wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="penghasilan" class="form-label m-0"><small> Penghasilan orang tua </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <select name="penghasilan_ortu" id="penghasilan" class="form-select" required="">
                            <option value="" selected="" disabled="">Pilih</option>
                            <option value="Dibawah Rp.500.000">Dibawah Rp.500.000</option>
                            <option value="Rp.500.000 - Rp.1jt">Rp.500.000 - Rp.1jt</option>
                            <option value="Rp.1jt - Rp.2jt" <?= $selected;?>>Rp.1jt - Rp.2jt</option>
                            <option value="Rp.2jt - Rp.3jt">Rp.2jt - Rp.3jt</option>
                            <option value="Rp.3jt - Rp.5jt">Rp.3jt - Rp.5jt</option>
                            <option value="Diatas Rp.5jt">Diatas Rp.5jt</option>
                        </select>
                        <div class="invalid-tooltip">Penghasilan wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="telp" class="form-label m-0"><small> Nomor Handphone </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <input type="tel" name="nomor_hp" id="telp" class="form-control" value="<?=$nomor_hp;?>" required="" style="width:100%!important">
                        <div class="invalid-tooltip" id="feedback-telp">Format Harus angka</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="telp2" class="form-label m-0"><small> Nomor telfon alternatif </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <input type="tel" name="no_hp_alternatif"  id="telp2" class="form-control" >
                        <div class="invalid-tooltip" id="feedback-telp-2">Format Harus angka</div>
                    </div>
                </div>
            </div>
            
            <h5 class="mt-3">
                <li>Alamat calon santri</li>
            </h5>
            <div class="container p-0">
                <div class="row align-items-center">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="alamat" class="form-label m-0"><small> Alamat </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="text" name="alamat" id="alamat" class="form-control" required="" placeholder="" value="<?=$alamat;?>" >
                        <div class="invalid-tooltip">Alamat Wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="rt" class="form-label m-0"><small> RT RW </small></label>
                    </div>
                    <div class="col-5 col-sm-3 col-md-3 col-lg-2 position-relative">
                        <input type="number" value="<?=$rt;?>" name="rt" id="rt" class="form-control" placeholder="RT" required="">
                        <div class="invalid-tooltip">RT Wajib diisi</div>
                    </div>
                    <div class="col-auto">/</div>
                    <div class="col-5 col-sm-3 col-md-3 col-lg-2 position-relative">
                        <input type="number" value="<?=$rt;?>" name="rw" id="rw" class="form-control" placeholder="RW" required="">
                        <div class="invalid-tooltip">RW Wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="dusun" class="form-label m-0"><small> Dusun </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <input type="text" value="<?=$dusun;?>" name="dusun" id="dusun" class="form-control" required>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="kodepos" class="form-label m-0"><small> Kode pos </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <input type="number" value="<?=$kodepos;?>" name="kode_pos" id="kodepos" class="form-control" required="">
                        <div class="invalid-tooltip">Kode pos harus berupa 5 digit angka</div>
                    </div>
                </div>
                
                
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="form_prov" class="form-label m-0"><small> Provinsi </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        
                        <select id="form_prov" class="form-select" name="prov" required="">
                        </select>
                        
                        <div class="invalid-tooltip">Provinsi Wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="form_kab" class="form-label m-0"><small> Kabupaten </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <select id="form_kab" class="form-select" name="kab" required="" disabled></select>
                        <div class="invalid-tooltip">Kabupaten Wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="form_kec" class="form-label m-0"><small> Kecamatan </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <select name="kec" id="form_kec" class="form-select" required="" disabled></select>
                        <div class="invalid-tooltip">Kecamatan Wajib diisi</div>
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="form_des" class="form-label m-0"><small> Kelurahan </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6 position-relative">
                        <select name="kel" id="form_des" class="form-select" required="" disabled></select>
                        <div class="invalid-tooltip">Kelurahan Wajib diisi</div>
                    </div>
                </div>
            </div>
            
            <h5 class="mt-3">
                <li>Riwayat penyakit</li>
            </h5>
            <div class="container p-0">
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="sakita" class="form-label m-0"><small> Jenis penyakit </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <input type="text" name="jenis_penyakit" id="sakita" class="form-control">
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="sejaka" class="form-label m-0"><small> Sejak </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <input type="date" name="sejak" id="sejaka" class="form-control">
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="tindakana" class="form-label m-0"><small> Tindakan pengobatan </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <input type="text" name="tindakan_pengobatan" id="tindakana" class="form-control">
                    </div>
                </div>
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="kondisia" class="form-label m-0"><small> Kondisi sekarang </small></label>
                    </div>
                    <div class="col-sm-9 col-md-8 col-lg-6">
                        <input type="text" name="kondisi_sekarang" id="kondisia" class="form-control">
                    </div>
                </div>
            </div>
            
            <h5 class="mt-3">
                <li>Lain-lain</li>
            </h5>
            <div class="container p-0">
                <div class="row align-items-center mt-2">
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <label for="ukuranBaju" class="form-label m-0"><small> Ukuran Seragam </small></label>
                    </div>
                    <div class="col-5 col-sm-3 col-md-3 col-lg-2 position-relative">
                        <select name="ukuran_seragam_baju" id="ukuranBaju" class="form-select" required="">
                            <option value="" selected="" disabled="">Baju</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L" <?= $selected;?>>L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                            <option value="XXXL">XXXL</option>
                            <option value="XXXXL">XXXXL</option>
                        </select>
                        <div class="invalid-tooltip">Ukuran Seragam Wajib diisi</div>
                        
                        <div class="form-text">
                            <a class="link-primary" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ukuranBajuModal">
                                Panduan Ukuran
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">/</div>
                    <div class="col-5 col-sm-3 col-md-3 col-lg-2 position-relative">
                        <select name="ukuran_celana_rok" id="ukuranCelana" class="form-select" required="">
                            <option value="" selected="" disabled="">Celana/Rok</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L" <?= $selected;?>>L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                            <option value="XXXL">XXXL</option>
                            <option value="XXXXL">XXXXL</option>
                        </select>
                        <div class="invalid-tooltip">Ukuran Celana/Rok Wajib diisi</div>
                        <div class="form-text">
                            <a class="link-primary" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ukuranCelanaModal">
                                Panduan Ukuran
                            </a>
                        </div>
                    </div>
                </div>
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
    <main class="container d-none mt-4" id="sukses">
        <div class="modal-body d-flex flex-column gap-3">
            <div class="shadow rounded-12 p-3">
                <h6>Pendaftaran Sukses</h6>
                <div id="rincian"></div>
                <hr class="my-2">
                
                <small class="d-block text-secondary mt-2"><strong>Nomor Pendaftaran: </strong> <span id="nomor_pendaftaran"></span></small>
                <small class="d-block text-secondary mt-2"><strong>Jika ada perubahan lampiran Cek Status Pendaftaran dan lengkapi lampiran yang belum di upload</strong></small>
            </div>
        </div>
    </main>
    <!--Modal show-->
    <div class="modal fade" id="PanduanBayar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <img src="./upload/panduan_pembayaran.jpg" alt="Ukuran Celana" class="w-100">
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="ukuranBajuModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <img src="./upload/baju.jpeg" alt="Ukuran Baju" class="w-100">
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="ukuranCelanaModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <img src="./upload/celana.jpeg" alt="Ukuran Celana" class="w-100">
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="kategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="kategoriLabel" style="display: block;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-center px-3 pt-3">
                    <h5 class="modal-title">Pilih Kategori</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <select id="kategori-val" class="form-select">
                                <option value="baru" selected="">Baru</option>
                                <!--option value="nt">Naik Tingkatan (Naik Jenjang Selanjutnya)</option-->
                            </select>
                        </div>
                        <div id="nt-form" style="display: none;">
                            <div class="mb-3">
                                <label for="nt-noin" class="form-label mb-1">Nomor Induk Santri</label>
                                <input type="number" class="form-control" id="nt-noin" placeholder="Masukkan nomor induk santri yang terdaftar" value="<?=$nik;?>">
                            </div>
                            <div class="mb-3">
                                <label for="nt-tgllhr" class="form-label mb-1">Tanggal Lahir</label>
                                <input type="date"  value="<?=$tgl_lahir;?>" class="form-control" id="nt-tgllhr" placeholder="Masukkan tanggal lahir">
                            </div>
                            <div class="mb-3">
                                <label for="nt-namaibu" class="form-label mb-1">Nama Ibu Kandung</label>
                                <input type="text" value="<?=$nama_ibu;?>"  class="form-control" id="nt-namaibu" placeholder="Masukkan nama ibu yang terdaftar">
                            </div>
                            <div class="d-flex">
                                <strong class="me-2">Catatan&nbsp;:</strong>
                                <p class="mb-0 text-secondary">Pendaftaran naik tingkatan hanya berlaku bagi siswa kelas akhir dengan syarat telah lunas Pembayaran Syahriyah sampai akhir tahun</p>
                            </div>
                        </div>
                        <div class="container p-3">
                            <div class="row">
                                <div class="col-8 col-sm-6 mx-auto">
                                    <button type="submit" class="btn btn-success rounded-pill w-100">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .iti.iti--allow-dropdown { width: 100% }
    </style>
    <!--modal end-->
    <?php
        $this->RenderScript[] = function() {
        ?>
        <script src="https://www.google.com/recaptcha/api.js"></script>
        
        <script src="<?=base_url('assets');?>/js/formulir.js?v=<?=time();?>"></script>
        <script>
            $('#nik').keypress(validateNumber);
            $('#nisn').keypress(validateNumber);
            $('#nokk').keypress(validateNumber);
            $('#nikAyah').keypress(validateNumber);
            $('#nikIbu').keypress(validateNumber);
            $("input").on("keypress",function() {
                var maxLength = $(this).attr("maxlength");
                if(maxLength){
                    $(this).prop("type", "number");
                    if ($(this).val().length==maxLength) {
                        $(".search-input").css("color", "green");
                        } else {
                        $(".search-input").css("color", "red");
                    }
                    if($(this).val().length >= maxLength) {
                        $(this).prop("type", "text");
                        // $(this).attr('maxlength',maxLength)
                        // alert("You can't write more than " + maxLength +" chacters")
                    }
                }
            });
            // $('#nik').keyup(function () {
            
            // });
            function validateNumber(event) {
                var key = window.event ? event.keyCode : event.which;
                if (event.keyCode === 8 || event.keyCode === 46 || event.keyCode === 37 || event.keyCode === 39) {
                    return true;
                    } else if (key < 48 || key > 57) {
                    return false;
                } else return true;
            };
        </script>
        <?php    
        }
    ?>                                                                                                                                                                                                                                                                        