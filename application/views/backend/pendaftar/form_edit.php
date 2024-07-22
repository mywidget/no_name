<form method="post" class='form-horizontal' id="formPendaftaran">
	<ol type="I">
		<h5>
			<li>Identitas calon santri</li>
		</h5>
		<input type="hidden" name="thnakademik" id="thnakademik" class="form-control" value="<?=$record->tahun_akademik;?>">
		<input type="hidden" name="id_pendaftar" id="id_pendaftar" class="form-control" value="<?=encrypt_url($record->id);?>">
		<div class="container p-0">
			<div class="row align-items-center">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="email" class="form-label m-0"><small>Email Aktif</small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="email" name="email" id="email" class="form-control" autocomplete="off" autofocus="" value="<?=$record->email;?>" required="">
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="nama" class="form-label m-0"><small> Nama lengkap </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$record->nama;?>" required="">
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="gender" class="form-label m-0"><small> Jenis kelamin </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="jenis_kelamin" id="gender" class="form-select" required="">
						<option value="Laki-laki" <?=($record->jenis_kelamin == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
						<option value="Perempuan" <?=($record->jenis_kelamin == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
					</select>
					<div class="invalid-feedback">Janis kelamin wajib di isi</div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="birthPlace" class="form-label m-0"><small> Tempat lahir </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="tempat_lahir" id="birthPlace" class="form-control" value="<?=$record->tempat_lahir;?>" required="">
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="birthday" class="form-label m-0"><small> Tanggal lahir </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="date" name="tanggal_lahir" id="birthday" class="form-control" placeholder="Masukkan tanggal lahir" value="<?=$record->tanggal_lahir;?>" required="">
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="nik" class="form-label m-0"><small> NIK </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" id="nik" name="nik" minlength="16" maxlength="16" class="form-control" autocomplete="off"   value="<?=$record->nik;?>" required>
					<div class="invalid-feedback" id="nik-feedback"> Masukkan NIK yang valid. NIK harus terdiri dari 16 digit </div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="sewali" class="form-label m-0"><small> Saudara sekandung di PP Tebuireng4 (Jika ada)</small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="saudara_pp" id="sewali" value="<?=$record->saudara_pp;?>" class="form-control">
					<input type="hidden" name="nisSewali" id="nisSewali" class="form-control">
					<div class="position-relative">
						<ul class="list-group shadow-sm sewali-autocomplete"></ul>
					</div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="statusAnak" class="form-label m-0"><small> Status dalam keluarga </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="status_keluarga" id="statusAnak" class="form-select" required="">
						<option value="1" <?=($record->status_keluarga == 'Anak Kandung') ? 'selected' : ''; ?>>Anak Kandung</option>
						<option value="1" <?=($record->status_keluarga == 'Anak Tiri') ? 'selected' : ''; ?>>Anak Tiri</option>
						<option value="1" <?=($record->status_keluarga == 'Anak Angkat') ? 'selected' : ''; ?>>Anak Angkat</option>
					</select>
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="anakKe" class="form-label m-0"><small> Anak ke </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="number" name="anak_ke" id="anakKe" class="form-control" value="<?=$record->anak_ke;?>" required="">
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="jumlahSaudara" class="form-label m-0"><small> Dari </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="number" name="dari" id="jumlahSaudara" class="form-control" value="<?=$record->dari;?>" required="">
					<div class="invalid-feedback"></div>
				</div>
			</div>
		</div>
		
		<h5 class="mt-3">
			<li>Pilihan Pendidikan</li>
		</h5>
		<div class="container p-0">
			<div class="row align-items-center">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="statusSantri" class="form-label m-0"><small> Status </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="s_pendidikan" value="<?=$record->s_pendidikan;?>" id="statusSantri" value="Baru" class="form-control" readonly="">
				</div>
			</div>
			
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="unit" class="form-label m-0"><small> Unit Sekolah </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					
					<select id="form_unit" class="form-select" name="unit_sekolah" required="">
					</select>
					<div class="invalid-feedback"></div>
				</div>
			</div>
			
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="kelas" class="form-label m-0"><small>Kelas </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="kelas" id="form_kelas" class="form-select" required=""></select>
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="biaya" class="form-label m-0"><small> Biaya Pendaftaran</small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="biaya" id="form_biaya" class="form-select" required="">
						<option value="<?=$record->biaya_daftar;?>"><?=rp($record->biaya_daftar);?></option>
					</select>
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="statusPendidikan" class="form-label m-0"><small>Status di Sekolah</small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="status_sekolah" id="statusPendidikan" class="form-select">
						<option value="Baru">Baru</option>
						<option value="Pindahan">Pindahan</option>
					</select>
				</div>
			</div>
		</div>
		
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="kamar" class="form-label m-0"><small> Kamar </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8">
				<select id="form_kamar" class="form-select" name="kamar" required="">
				</select>
				<div class="invalid-feedback"></div>
			</div>
		</div>
		
		<h5 class="mt-3">
			<li>Riwayat pendidikan</li>
		</h5>
		<div class="container p-0">
			<div class="row align-items-center">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="ijazahTerakhir" class="form-label m-0"><small> Ijazah Terakhir </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
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
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="nama_sekolah_asal" class="form-label m-0"><small> Nama sekolah asal </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="nama_sekolah_asal" id="asalSekolah" class="form-control" value="<?=$record->nama_sekolah_asal;?>"  required="">
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="alamatSekolah" class="form-label m-0"><small> Alamat sekolah asal </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="alamat_sekolah" id="alamatSekolah" value="<?=$record->alamat_sekolah;?>"  class="form-control">
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="nisn" class="form-label m-0"><small> NISN </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="nisn" id="nisn" minlength="10" maxlength="10" class="form-control" autocomplete="off"  value="<?=$record->nisn;?>"  required>  
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="nokip" class="form-label m-0"><small> No KIP (Jika ada) </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="no_kip" value="<?=$record->no_kip;?>"  id="nokip" class="form-control">
				</div>
			</div>
		</div>
		
		<h5 class="mt-3">
			<li>Identitas orang tua</li>
		</h5>
		<div class="container p-0">
			<div class="row align-items-center">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="nokk" class="form-label m-0"><small> Nomor Kartu Keluarga </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="no_kk" id="nokk" minlength="16" maxlength="16" class="form-control" autocomplete="off"  value="<?=$record->no_kk;?>"  required>  
					
					<div class="invalid-feedback"></div>
				</div>
			</div>
			
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="namaAyah" class="form-label m-0"><small> Nama Ayah </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="nama_ayah" id="namaAyah" class="form-control" value="<?=$record->nama_ayah;?>"  required="">
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="nikAyah" class="form-label m-0"><small> NIK Ayah </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="nik_ayah" id="nikAyah" minlength="16" maxlength="16" class="form-control" autocomplete="off" value="<?=$record->nik_ayah;?>"  required>  
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="kondisiAyah" class="form-label m-0"><small> Kondisi </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="kondisi_ayah" id="kondisiAyah" class="form-select">
						<option value="Hidup">Hidup</option>
						<option value="Meninggal">Meninggal</option>
					</select>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="pendidikanAyah" class="form-label m-0"><small> Pendidikan Terakhir </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="pendidikan_terakhir_ayah" id="pendidikanAyah" class="form-select" required="">
					</select>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="pekerjaanAyah" class="form-label m-0"><small> Pekerjaan </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="pekerjaan_ayah" id="pekerjaanAyah" class="form-select" required="">
					</select>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="namaIbu" class="form-label m-0"><small> Nama Ibu </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="nama_ibu" id="namaIbu" class="form-control" value="<?=$record->nama_ibu;?>"  required="">
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="nikIbu" class="form-label m-0"><small> NIK Ibu </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="nik_ibu" id="nikIbu" minlength="16" maxlength="16" class="form-control" autocomplete="off"  value="<?=$record->nik_ibu;?>"  required>  
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="kondisiIbu" class="form-label m-0"><small> Kondisi </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="kondisi_ibu" id="kondisiIbu" class="form-select">
						<option value="Hidup">Hidup</option>
						<option value="Meninggal">Meninggal</option>
					</select>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="pendidikanIbu" class="form-label m-0"><small> Pendidikan Terakhir </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="pendidikan_terakhir_ibu" id="pendidikanIbu" class="form-select" required="">
					</select>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="pekerjaanIbu" class="form-label m-0"><small> Pekerjaan </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="pekerjaan_ibu" id="pekerjaanIbu" class="form-select" required="">
					</select>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="penghasilan" class="form-label m-0"><small> Penghasilan orang tua </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="penghasilan_ortu" id="penghasilan" class="form-select" required="">
						<option value="" selected="" disabled="">Pilih</option>
						<option value="Dibawah Rp.500.000">Dibawah Rp.500.000</option>
						<option value="Rp.500.000 - Rp.1jt">Rp.500.000 - Rp.1jt</option>
						<option value="Rp.1jt - Rp.2jt">Rp.1jt - Rp.2jt</option>
						<option value="Rp.2jt - Rp.3jt">Rp.2jt - Rp.3jt</option>
						<option value="Rp.3jt - Rp.5jt">Rp.3jt - Rp.5jt</option>
						<option value="Diatas Rp.5jt">Diatas Rp.5jt</option>
					</select>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="telp" class="form-label m-0"><small> Nomor Telphone </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="tel" name="nomor_hp" id="telp" class="form-control" value="<?=$record->nomor_hp;?>"  required="">
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="telp2" class="form-label m-0"><small> Nomor telfon alternatif </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="tel" name="no_hp_alternatif" value="<?=$record->no_hp_alternatif;?>"  id="telp2" class="form-control">
					<div class="invalid-feedback"></div>
				</div>
			</div>
		</div>
		
		<h5 class="mt-3">
			<li>Alamat calon santri</li>
		</h5>
		<div class="container p-0">
			<div class="row align-items-center">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="alamat" class="form-label m-0"><small> Alamat </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="alamat" id="alamat" class="form-control" required="" placeholder="Jl. Raden Intan No. 19" value="<?=$record->alamat;?>"  >
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="rt" class="form-label m-0"><small> RT RW </small></label>
				</div>
				<div class="col-5 col-sm-3 col-md-3 col-lg-4">
					<input type="number" name="rt" id="rt" value="<?=$record->rt;?>"  class="form-control" placeholder="RT">
				</div>
				
				<div class="col-5 col-sm-3 col-md-3 col-lg-4">
					<input type="number" name="rw" id="rw" value="<?=$record->rw;?>"  class="form-control" placeholder="RW">
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="dusun" class="form-label m-0"><small> Dusun </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="dusun" id="dusun" value="<?=$record->dusun;?>" class="form-control">
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="kodepos" class="form-label m-0"><small> Kode pos </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="number" name="kode_pos" id="kodepos" value="<?=$record->kode_pos;?>" class="form-control" required="">
					<div class="invalid-feedback">Kode pos harus berupa 5 digit angka</div>
				</div>
			</div>
			
			
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="form_prov" class="form-label m-0"><small> Provinsi </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					
					<select id="form_prov" class="form-select" name="prov" required="">
						
					</select>
					
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="form_kab" class="form-label m-0"><small> Kabupaten </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select id="form_kab" class="form-select" name="kab" required=""></select>
					
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="form_kec" class="form-label m-0"><small> Kecamatan </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="kec" id="form_kec" class="form-select" required="" disabled></select>
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="form_des" class="form-label m-0"><small> Kelurahan </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="kel" id="form_des" class="form-select" required="" disabled></select>
					<div class="invalid-feedback"></div>
				</div>
			</div>
		</div>
		
		<h5 class="mt-3">
			<li>Riwayat penyakit</li>
		</h5>
		<div class="container p-0">
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="sakita" class="form-label m-0"><small> Jenis penyakit </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="jenis_penyakit" id="sakita" value="<?=$record->jenis_penyakit;?>" class="form-control">
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="sejaka" class="form-label m-0"><small> Sejak </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="date" name="sejak" id="sejaka" value="<?=$record->sejak;?>"  class="form-control">
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="tindakana" class="form-label m-0"><small> Tindakan pengobatan </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="tindakan_pengobatan" id="tindakana" value="<?=$record->tindakan_pengobatan;?>" class="form-control">
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="kondisia" class="form-label m-0"><small> Kondisi sekarang </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<input type="text" name="kondisi_sekarang" id="kondisia" value="<?=$record->kondisi_sekarang;?>"  class="form-control">
				</div>
			</div>
		</div>
		
		<h5 class="mt-3">
			<li>Lain-lain</li>
		</h5>
		<div class="container p-0">
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="ukuranBaju" class="form-label m-0"><small> Ukuran Seragam </small></label>
				</div>
				<div class="col-5 col-sm-3 col-md-3 col-lg-4">
					<select name="ukuran_seragam_baju" id="ukuranBaju" class="form-select" required="">
						<option value="" selected="" disabled="">Baju</option>
						<option value="S">S</option>
						<option value="M">M</option>
						<option value="L">L</option>
						<option value="XL">XL</option>
						<option value="XXL">XXL</option>
						<option value="XXXL">XXXL</option>
						<option value="XXXXL">XXXXL</option>
					</select>
					<div class="invalid-feedback"></div>
				</div>
				
				<div class="col-5 col-sm-3 col-md-3 col-lg-4">
					<select name="ukuran_celana_rok" id="ukuranCelana" class="form-select" required="">
						<option value="" selected="" disabled="">Celana/Rok</option>
						<option value="S">S</option>
						<option value="M">M</option>
						<option value="L">L</option>
						<option value="XL">XL</option>
						<option value="XXL">XXL</option>
						<option value="XXXL">XXXL</option>
						<option value="XXXXL">XXXXL</option>
					</select>
				</div>
			</div>
			<?php
				$opathfoto = FCPATH."upload/lampiran/" . $record->foto;
				$size_foto = @getimagesize($opathfoto);
				if($size_foto !== false){
					$gambar_foto=base_url()."upload/lampiran/" . $record->foto;
					$show_foto = 'd-none';
					$hide_foto = '';
					}else{
					$hide_foto = 'd-none';
					$show_foto = '';
					$gambar_foto = '';
				}
			?>
			<div class="row mt-3">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="fotoSantri" class="form-label m-0"><small> Foto Calon Santri </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<label for="fotoKk" class="form-label m-0 <?=$show_foto;?>"><small> Belum ada lampiran </small></label>
					<div id="fotoSantriPreviewContainer" class="position-relative overflow-hidden mb-2 <?=$hide_foto;?>" style="width: 125px; height: 166.67px;">
						<img id="fotoSantriPreview" class="position-absolute top-0 left-0 w-100 h-100" src="<?=$gambar_foto;?>" alt="Foto Santri Preview" style="object-fit: cover;">
					</div>
				</div>
			</div>
			
			<?php
				$opathFile = FCPATH."upload/lampiran/" . $record->foto_kk;
				$size = @getimagesize($opathFile);
				if($size !== false){
					$gambar=base_url()."upload/lampiran/" . $record->foto_kk;
					$show = 'd-none';
					$hide = '';
					}else{
					$hide = 'd-none';
					$show = '';
					$gambar = '';
				}
			?>
			<div class="row mt-3">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="fotoKk" class="form-label m-0"><small> Foto Kartu Keluarga </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8 ">
					<label for="fotoKk" class="form-label m-0 <?=$show;?>"><small> Belum ada lampiran </small></label>
					<div id="fotoKkPreviewContainer" class="position-relative overflow-hidden mb-2 <?=$hide;?>" style="width: 237.5px; height: 125px;" >
						<img id="fotoKkPreview" class="position-absolute top-0 left-0 w-100 h-100" src="<?=$gambar;?>" alt="Foto KK Preview" style="object-fit: cover;">
					</div>
				</div>
			</div>
			<?php
				$fotobukti = FCPATH."upload/foto_dokumen/" . $record->fotobukti;
				$size_bukti = @getimagesize($fotobukti);
				if($size_bukti !== false){
					$gambar_bukti=base_url()."upload/foto_dokumen/" . $record->fotobukti;
					$hide_bukti = 'd-none';
					$hide_bukti = '';
					}else{
					$hide_bukti = 'd-none';
					$show_bukti = '';
					$gambar_bukti = '';
				}
			?>
			<div class="row mt-3">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="fotoKk" class="form-label m-0"><small> Bukti Transfer </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<label for="fotoKk" class="form-label m-0 <?=$show_bukti;?>"><small> Belum ada lampiran </small></label>
					<div id="fotoBuktiPreviewContainer" class="position-relative overflow-hidden mb-2 <?=$hide_bukti;?>" style="width: 237.5px; height: 125px;">
						<img id="fotoKkPreview" class="position-absolute top-0 left-0 w-100 h-100" src="<?=$gambar_bukti;?>" alt="Bukti Transfer" style="object-fit: cover;">
					</div>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="status_pendaftar" class="form-label m-0"><small> Status Pendaftar </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="status_pendaftar" id="status_pendaftar" class="form-select" required="">
						<option value="Proses">Proses</option>
						<option value="Diterima">Diterima</option>
						<option value="Tidak Diterima">Ditolak</option>
					</select>
				</div>
			</div>
			
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="kirim_pesan" class="form-label m-0"><small> Kirim Pesan </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="kirim_pesan" id="kirim_pesan" class="form-select" required="">
						<option value="Ya">Ya</option>
						<option value="Tidak" selected>Tidak</option>
					</select>
				</div>
			</div>
			
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="template_pesan" class="form-label m-0"><small> Template Pesan </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="template_pesan" id="template_pesan" class="form-select" disabled="">
					</select>
				</div>
			</div>
			
		</form>			
		<script>
			
			var id_pendaftar = <?=$record->id;?>;
			var unit_sekolah = "<?=$record->id_unit;?>";
			var form_kelas = "<?=$record->kelas;?>";
			var form_kamar = "<?=$record->kamar;?>";
			var ijasah_terakhir = "<?=$record->ijasah_terakhir;?>";
			var provinsi = "<?=$record->provinsi;?>";
			var kabupaten = "<?=$record->kabupaten;?>";
			var kecamatan = "<?=$record->kecamatan;?>";
			var kelurahan = "<?=$record->kelurahan;?>";
			var pendidikan_terakhir_ayah = "<?=$record->pendidikan_terakhir_ayah;?>";
			var pekerjaan_ayah = "<?=$record->pekerjaan_ayah;?>";
			var pendidikan_terakhir_ibu = "<?=$record->pendidikan_terakhir_ayah;?>";
			var pekerjaan_ibu = "<?=$record->pekerjaan_ibu;?>";
			var penghasilan_ortu = "<?=$record->pekerjaan_ibu;?>";
			
			
			$("#form_unit").filter(function () {
				$.ajax({
					url: base_url+ "pendaftar/unit_sekolah",
					type: "POST",
					dataType: 'json',
					beforeSend: function () {
						$("#form_unit").append("<option value='loading'>loading</option>");
						$("#form_unit").attr("disabled", true);
					},
					success: function (response) {
						if(response.status==false){
							$("#form_unit").append("<option value='loading'>loading</option>");
							$("#form_unit").attr("disabled", true);
							$("#form_unit").attr("disabled", true);
							return;
						}
						$("#form_unit option[value='loading']").remove();
						$("#form_unit").attr("disabled", false);
						$("#form_unit").append("<option value=''>Pilih</option>");
						var len = response.length;
						for (var i = 0; i < len; i++) {
							
							var id = response[i]['id'];
							var name = response[i]['name'];
							if(name==unit_sekolah){
								$("#form_unit").append("<option value='" + id + "' selected>" + name + "</option>");
								}else{
								$("#form_unit").append("<option value='" + id + "'>" + name + "</option>");
							}
						}
					}
				});
			});
			
			$("#form_kelas").filter(function () {
				$.ajax({
					url: base_url+ "pendaftar/load_kelas",
					type: "POST",
					dataType: 'json',
					beforeSend: function () {
						$("#form_kelas").append("<option value='loading'>loading</option>");
						$("#form_kelas").attr("disabled", true);
					},
					success: function (response) {
						if(response.status==false){
							$("#form_kelas").append("<option value='loading'>loading</option>");
							$("#form_kelas").attr("disabled", true);
							$("#form_kelas").attr("disabled", true);
							return;
						}
						$("#form_kelas option[value='loading']").remove();
						$("#form_kelas").attr("disabled", false);
						$("#form_kelas").append("<option value=''>Pilih</option>");
						var len = response.length;
						for (var i = 0; i < len; i++) {
							
							var id = response[i]['id'];
							var name = response[i]['name'];
							if(id==form_kelas){
								$("#form_kelas").append("<option value='" + id + "' selected>" + name + "</option>");
								}else{
								$("#form_kelas").append("<option value='" + id + "'>" + name + "</option>");
							}
						}
					}
				});
			});
			
			$("#form_kamar").filter(function () {
				$.ajax({
					url: base_url+ "pendaftar/load_kamar",
					type: "POST",
					dataType: 'json',
					beforeSend: function () {
						$("#form_kamar").append("<option value='loading'>loading</option>");
						$("#form_kamar").attr("disabled", true);
					},
					success: function (response) {
						if(response.status==false){
							$("#form_kamar").append("<option value='loading'>loading</option>");
							$("#form_kamar").attr("disabled", true);
							$("#form_kamar").attr("disabled", true);
							return;
						}
						$("#form_kamar option[value='loading']").remove();
						$("#form_kamar").attr("disabled", false);
						$("#form_kamar").append("<option value=''>Pilih</option>");
						var len = response.length;
						for (var i = 0; i < len; i++) {
							
							var id = response[i]['id'];
							var name = response[i]['name'];
							if(name==form_kamar){
								$("#form_kamar").append("<option value='" + name + "' selected>" + name + "</option>");
								}else{
								$("#form_kamar").append("<option value='" + name + "'>" + name + "</option>");
							}
						}
					}
				});
			});
			
			$("#ijazahTerakhir").filter(function () {
				$.ajax({
					url: base_url+ "pendaftar/ijasah_terakhir",
					data:{id:id_pendaftar},
					type: "POST",
					dataType: 'json',
					beforeSend: function () {
						// $("#ijazahTerakhir").attr("disabled", true);
					},
					success: function (response) {
						// console.log(response);
						$("#ijazahTerakhir").val(response.name).change();
					}
				});
			});
			
			$("#ukuranBaju").filter(function () {
				$.ajax({
					url: base_url+ "pendaftar/ukuran_seragam_baju",
					data:{id:id_pendaftar},
					type: "POST",
					dataType: 'json',
					beforeSend: function () {
						// $("#ijazahTerakhir").attr("disabled", true);
					},
					success: function (response) {
						// console.log(response);
						$("#ukuranBaju").val(response.name).change();
					}
				});
			});
			$("#ukuranCelana").filter(function () {
				$.ajax({
					url: base_url+ "pendaftar/ukuran_celana",
					data:{id:id_pendaftar},
					type: "POST",
					dataType: 'json',
					beforeSend: function () {
						// $("#ijazahTerakhir").attr("disabled", true);
					},
					success: function (response) {
						// console.log(response);
						$("#ukuranCelana").val(response.name).change();
					}
				});
			});
			
			$("#form_prov").filter(function () {
				$.ajax({
					url: base_url+ "dashboard/provinsi",
					type: "POST",
					dataType: 'json',
					beforeSend: function () {
						$("#form_prov").append("<option value='loading'>loading</option>");
						$("#form_prov").attr("disabled", true);
					},
					success: function (response) {
						if(response.status==false){
							$("#form_prov").append("<option value='loading'>loading</option>");
							$("#form_prov").attr("disabled", true);
							$("#form_prov").attr("disabled", true);
							return;
						}
						$("#form_prov option[value='loading']").remove();
						$("#form_prov").attr("disabled", false);
						$("#form_prov").append("<option value=''>Pilih Provinsi</option>");
						var len = response.length;
						for (var i = 0; i < len; i++) {
							
							var id = response[i]['id'];
							var name = response[i]['name'];
							if(id==provinsi){
								$("#form_prov").append("<option value='" + id + "' selected>" + name + "</option>");
								}else{
								$("#form_prov").append("<option value='" + id + "'>" + name + "</option>");
							}
						}
					}
				});
			});
			
			$("#form_kab").filter(function () {
				var id = provinsi;
				
				$.ajax({
					type: 'POST',
					url: base_url+ "dashboard/kabupaten",
					data: {id:id},
					dataType : "json",
					beforeSend: function(){
						$("#form_kab").empty();
						$("#form_kec").empty().attr("disabled", true);
						$("#form_des").empty().attr("disabled", true);
						$("#form_kab").append("<option value=''>Pilih</option>");
					},
					success: function(response) {
						$("#form_kab").attr("disabled", false);
						var msize = response.length;
						var i = 0;
						for (; i < msize; i++) {
							var teg = response[i]["id"];
							var name = response[i]["name"];
							if(teg==kabupaten){
								$("#form_kab").append("<option value='" + teg + "' selected>" + name + "</option>");
								}else{
								$("#form_kab").append("<option value='" + teg + "'>" + name + "</option>");
							}
						}
					}
				});
			});
			
			
			$("#form_kec").filter(function () {
				var id = kabupaten;
				$.ajax({
					type: 'POST',
					url: base_url+ "dashboard/kecamatan",
					data: {id:id},
					dataType : "json",
					beforeSend: function(){
						$("#form_kec").empty();
						$("#form_des").empty().empty().attr("disabled", true);
						$("#form_kec").append("<option value=''>Pilih</option>");
					},
					success: function(response) {
						$("#form_kec").attr("disabled", false);
						var msize = response.length;
						var i = 0;
						for (; i < msize; i++) {
							var teg = response[i]["id"];
							var name = response[i]["name"];
							if(teg==kecamatan){
								$("#form_kec").append("<option value='" + teg + "' selected>" + name + "</option>");
								}else{
								$("#form_kec").append("<option value='" + teg + "'>" + name + "</option>");
							}
						}
					}
				});
			});
			
			
			$("#form_des").filter(function () {
				var id = kecamatan;
				console.log(kelurahan)
				$.ajax({
					type: 'POST',
					url: base_url+ "dashboard/desa",
					data: {id:id},
					dataType : "json",
					beforeSend: function(){
						$("#form_des").empty();
						$("#form_des").append("<option value=''>Pilih</option>");
					},
					success: function(response) {
						$("#form_des").attr("disabled", false);
						var msize = response.length;
						var i = 0;
						for (; i < msize; i++) {
							var teg = response[i]["id"];
							var name = response[i]["name"];
							if(teg==kelurahan){
								$("#form_des").append("<option value='" + teg + "' selected>" + name + "</option>");
								}else{
								$("#form_des").append("<option value='" + teg + "'>" + name + "</option>");
							}
						}
					}
				});
			});
			
			$("#pendidikanAyah").filter(function () {
				$.ajax({
					type: 'POST',
					url: base_url+ "pendaftar/load_pendidikan",
					dataType : "json",
					beforeSend: function(){
						$("#pendidikanAyah").empty();
						// $("#pendidikanAyah").append("<option value=''>Pilih</option>");
					},
					success: function(response) {
						$("#pendidikanAyah").attr("disabled", false);
						var msize = response.length;
						var i = 0;
						for (; i < msize; i++) {
							var teg = response[i]["id"];
							var name = response[i]["name"];
							if(name==pendidikan_terakhir_ayah){
								$("#pendidikanAyah").append("<option value='" + name + "' selected>" + name + "</option>");
								}else{
								$("#pendidikanAyah").append("<option value='" + name + "'>" + name + "</option>");
							}
						}
					}
				});
			});
			$("#pendidikanIbu").filter(function () {
				$.ajax({
					type: 'POST',
					url: base_url+ "pendaftar/load_pendidikan",
					dataType : "json",
					beforeSend: function(){
						$("#pendidikanIbu").empty();
						// $("#pendidikanAyah").append("<option value=''>Pilih</option>");
					},
					success: function(response) {
						$("#pendidikanIbu").attr("disabled", false);
						var msize = response.length;
						var i = 0;
						for (; i < msize; i++) {
							var teg = response[i]["id"];
							var name = response[i]["name"];
							if(name==pendidikan_terakhir_ibu){
								$("#pendidikanIbu").append("<option value='" + name + "' selected>" + name + "</option>");
								}else{
								$("#pendidikanIbu").append("<option value='" + name + "'>" + name + "</option>");
							}
						}
					}
				});
			});
			
			$("#pekerjaanAyah").filter(function () {
				$.ajax({
					type: 'POST',
					url: base_url+ "pendaftar/load_pekerjaan",
					dataType : "json",
					beforeSend: function(){
						$("#pekerjaanAyah").empty();
						// $("#pendidikanAyah").append("<option value=''>Pilih</option>");
					},
					success: function(response) {
						$("#pekerjaanAyah").attr("disabled", false);
						var msize = response.length;
						var i = 0;
						for (; i < msize; i++) {
							var teg = response[i]["id"];
							var name = response[i]["name"];
							if(name==pekerjaan_ayah){
								$("#pekerjaanAyah").append("<option value='" + name + "' selected>" + name + "</option>");
								}else{
								$("#pekerjaanAyah").append("<option value='" + name + "'>" + name + "</option>");
							}
						}
					}
				});
			});
			$("#pekerjaanIbu").filter(function () {
				$.ajax({
					type: 'POST',
					url: base_url+ "pendaftar/load_pekerjaan",
					dataType : "json",
					beforeSend: function(){
						$("#pekerjaanIbu").empty();
						// $("#pendidikanAyah").append("<option value=''>Pilih</option>");
					},
					success: function(response) {
						$("#pekerjaanIbu").attr("disabled", false);
						var msize = response.length;
						var i = 0;
						for (; i < msize; i++) {
							var teg = response[i]["id"];
							var name = response[i]["name"];
							if(name==pekerjaan_ibu){
								$("#pekerjaanIbu").append("<option value='" + name + "' selected>" + name + "</option>");
								}else{
								$("#pekerjaanIbu").append("<option value='" + name + "'>" + name + "</option>");
							}
						}
					}
				});
			});
			
			
			
		</script>																																			