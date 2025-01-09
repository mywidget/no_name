<ol type="I">
	<h5>
		<li>Identitas calon santri</li>
	</h5>
	<input type="hidden" name="id_pendaftar" id="id_pendaftar" class="form-control" value="0">
	<div class="container p-0 form-scrollable">
		<div class="row align-items-center ">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="email" class="form-label m-0"><small>Tahun Akademik</small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="thnakademik" id="thnakademik" class="form-control form-select" required>
					<option value="">Tahun Akademik</option>
					<?php foreach($tahun AS $val) :
					?>
					<option value="<?=$val->id_tahun_akademik;?>"><?=$val->id_tahun_akademik;?></option>
					<?php endforeach; ?>
				</select>
				<div class="invalid-tooltip">Tahun akademik harus dipilih</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="email" class="form-label m-0"><small>Email Aktif</small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="email" name="email" id="email" class="form-control" autocomplete="off" autofocus="" value="<?=$record->email;?>" required="">
				<div class="invalid-tooltip">Email wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="nama" class="form-label m-0"><small> Nama lengkap </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$record->nama;?>" required="">
				<div class="invalid-tooltip">Nama lengkap wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="gender" class="form-label m-0"><small> Jenis kelamin </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="jenis_kelamin" id="gender" class="form-select" required="">
					<option value="">Pilih</option>
					<option value="Laki-laki" <?=($record->jenis_kelamin == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
					<option value="Perempuan" <?=($record->jenis_kelamin == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
				</select>
				<div class="invalid-tooltip">Janis kelamin wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="birthPlace" class="form-label m-0"><small> Tempat lahir </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="tempat_lahir" id="birthPlace" class="form-control" value="<?=$record->tempat_lahir;?>" required="">
				<div class="invalid-tooltip">Tempat lahir wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="birthday" class="form-label m-0"><small> Tanggal lahir </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="date" name="tanggal_lahir" id="birthday" class="form-control" placeholder="Masukkan tanggal lahir" value="<?=$record->tanggal_lahir;?>" required="">
				<div class="invalid-tooltip">Tanggal lahir wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="nik" class="form-label m-0"><small> NIK </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="number" id="nik" name="nik" minlength="16" maxlength="16" class="form-control search-input" autocomplete="off"  required>
				<div class="invalid-tooltip" id="nik-feedback"> Masukkan NIK yang valid. NIK harus terdiri dari 16 digit </div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="sewali" class="form-label m-0"><small> Saudara sekandung di PP Tebuireng4 (Jika ada)</small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="saudara_pp" id="sewali" value="<?=$record->saudara_pp;?>" class="form-control">
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="statusAnak" class="form-label m-0"><small> Status dalam keluarga </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="status_keluarga" id="statusAnak" class="form-select" required="">
					<option value="1" <?=($record->status_keluarga == 'Anak Kandung') ? 'selected' : ''; ?>>Anak Kandung</option>
					<option value="1" <?=($record->status_keluarga == 'Anak Tiri') ? 'selected' : ''; ?>>Anak Tiri</option>
					<option value="1" <?=($record->status_keluarga == 'Anak Angkat') ? 'selected' : ''; ?>>Anak Angkat</option>
				</select>
				<div class="invalid-tooltip">Status dalam keluarga wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="anakKe" class="form-label m-0"><small> Anak ke </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="number" name="anak_ke" id="anakKe" class="form-control" value="<?=$record->anak_ke;?>" required="">
				<div class="invalid-tooltip">Anak ke wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="jumlahSaudara" class="form-label m-0"><small> Dari </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="number" name="dari" id="jumlahSaudara" class="form-control" value="<?=$record->dari;?>" required="">
				<div class="invalid-tooltip">Dari wajib di isi</div>
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
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="s_pendidikan" value="<?=$record->s_pendidikan;?>" id="statusSantri" value="Baru" class="form-control" readonly="" required>
			</div>
		</div>
		
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="unit" class="form-label m-0"><small> Unit Sekolah </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select id="form_unit" class="form-select" name="unit_sekolah" required="" disabled></select>
				<div class="invalid-tooltip">Unit Sekolah wajib di isi</div>
			</div>
		</div>
		
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="kelas" class="form-label m-0"><small>Kelas </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="kelas" id="form_kelas" class="form-select" required="" disabled></select>
				<div class="invalid-tooltip">Kelas wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="biaya" class="form-label m-0"><small> Biaya Pendaftaran</small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="biaya" id="form_biaya" class="form-select" required="">
					
				</select>
				<div class="invalid-tooltip">Biaya Pendaftaran wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="statusPendidikan" class="form-label m-0"><small>Status di Sekolah</small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
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
		<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
			<select id="form_kamar" class="form-select" name="kamar" required="" disabled>
			</select>
			<div class="invalid-tooltip">Kamar wajib di isi</div>
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
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
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
				<div class="invalid-tooltip">Ijazah Terakhir wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="nama_sekolah_asal" class="form-label m-0"><small> Nama sekolah asal </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="nama_sekolah_asal" id="asalSekolah" class="form-control" value="<?=$record->nama_sekolah_asal;?>"  required="">
				<div class="invalid-tooltip">Nama sekolah asal wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="alamatSekolah" class="form-label m-0"><small> Alamat sekolah asal </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="alamat_sekolah" id="alamatSekolah" value="<?=$record->alamat_sekolah;?>"  class="form-control" required>
				<div class="invalid-tooltip">Alamat sekolah asal wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="nisn" class="form-label m-0"><small> NISN </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="nisn" id="nisn" minlength="10" maxlength="10" class="form-control" autocomplete="off"  value="<?=$record->nisn;?>"  required>  
				<div class="invalid-tooltip">NISN wajib di isi</div>
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
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="no_kk" id="nokk" minlength="16" maxlength="16" class="form-control" autocomplete="off"  value="<?=$record->no_kk;?>"  required>  
				
				<div class="invalid-tooltip">Nomor Kartu Keluarga wajib di isi</div>
			</div>
		</div>
		
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="namaAyah" class="form-label m-0"><small> Nama Ayah </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="nama_ayah" id="namaAyah" class="form-control" value="<?=$record->nama_ayah;?>"  required="">
				<div class="invalid-tooltip">Nama Ayah wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="nikAyah" class="form-label m-0"><small> NIK Ayah </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="nik_ayah" id="nikAyah" minlength="16" maxlength="16" class="form-control" autocomplete="off" value="<?=$record->nik_ayah;?>"  required>  
				<div class="invalid-tooltip">NIK Ayah wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="kondisiAyah" class="form-label m-0"><small> Kondisi </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
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
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="pendidikan_terakhir_ayah" id="pendidikanAyah" class="form-select" required="">
				</select>
				<div class="invalid-tooltip">Pendidikan Terakhir wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="pekerjaanAyah" class="form-label m-0"><small> Pekerjaan </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="pekerjaan_ayah" id="pekerjaanAyah" class="form-select" required="">
				</select>
				<div class="invalid-tooltip">Pekerjaan wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="namaIbu" class="form-label m-0"><small> Nama Ibu </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="nama_ibu" id="namaIbu" class="form-control" value="<?=$record->nama_ibu;?>"  required="">
				<div class="invalid-tooltip">Nama Ibu wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="nikIbu" class="form-label m-0"><small> NIK Ibu </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="nik_ibu" id="nikIbu" minlength="16" maxlength="16" class="form-control" autocomplete="off"  value="<?=$record->nik_ibu;?>"  required>  
				<div class="invalid-tooltip">NIK Ibu wajib di isi</div>
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
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="pendidikan_terakhir_ibu" id="pendidikanIbu" class="form-select" required="">
				</select>
				<div class="invalid-tooltip">Pendidikan Terakhir wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="pekerjaanIbu" class="form-label m-0"><small> Pekerjaan </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="pekerjaan_ibu" id="pekerjaanIbu" class="form-select" required="">
				</select>
				<div class="invalid-tooltip">Pekerjaan wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="penghasilan" class="form-label m-0"><small> Penghasilan orang tua </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="penghasilan_ortu" id="penghasilan" class="form-select" required="">
					<option value="" selected="" disabled="">Pilih</option>
					<option value="Dibawah Rp.500.000">Dibawah Rp.500.000</option>
					<option value="Rp.500.000 - Rp.1jt">Rp.500.000 - Rp.1jt</option>
					<option value="Rp.1jt - Rp.2jt">Rp.1jt - Rp.2jt</option>
					<option value="Rp.2jt - Rp.3jt">Rp.2jt - Rp.3jt</option>
					<option value="Rp.3jt - Rp.5jt">Rp.3jt - Rp.5jt</option>
					<option value="Diatas Rp.5jt">Diatas Rp.5jt</option>
				</select>
				<div class="invalid-tooltip">Penghasilan orang tua wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="telp" class="form-label m-0"><small> Nomor Telphone </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="tel" name="nomor_hp" id="telp" class="form-control" value="<?=$record->nomor_hp;?>"  required="">
				<div class="invalid-tooltip">Nomor Telphone wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="telp2" class="form-label m-0"><small> Nomor telfon alternatif </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8">
				<input type="tel" name="no_hp_alternatif" value="<?=$record->no_hp_alternatif;?>"  id="telp2" class="form-control">
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
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="alamat" id="alamat" class="form-control" required="" placeholder="Jl. Raden Intan No. 19" value="<?=$record->alamat;?>"  >
				<div class="invalid-tooltip">Alamat wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="rt" class="form-label m-0"><small> RT RW </small></label>
			</div>
			<div class="col-5 col-sm-3 col-md-3 col-lg-4 position-relative">
				<input type="number" name="rt" id="rt" value="<?=$record->rt;?>"  class="form-control" placeholder="RT" required>
				<div class="invalid-tooltip">RT wajib di isi</div>
			</div>
			
			<div class="col-5 col-sm-3 col-md-3 col-lg-4 position-relative">
				<input type="number" name="rw" id="rw" value="<?=$record->rw;?>"  class="form-control" placeholder="RW" required>
				<div class="invalid-tooltip">RW wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="dusun" class="form-label m-0"><small> Dusun </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="text" name="dusun" id="dusun" value="<?=$record->dusun;?>" class="form-control" required>
				<div class="invalid-tooltip">Dusun wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="kodepos" class="form-label m-0"><small> Kode pos </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<input type="number" name="kode_pos" id="kodepos" value="<?=$record->kode_pos;?>" class="form-control" required="">
				<div class="invalid-tooltip">Kode pos harus berupa 5 digit angka</div>
			</div>
		</div>
		
		
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="form_prov" class="form-label m-0"><small> Provinsi </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select id="form_prov" class="form-select" name="prov" required="">
				</select>
				<div class="invalid-tooltip">Provinsi wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="form_kab" class="form-label m-0"><small> Kabupaten </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select id="form_kab" class="form-select" name="kab" required=""></select>
				
				<div class="invalid-tooltip">Kabupaten wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="form_kec" class="form-label m-0"><small> Kecamatan </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="kec" id="form_kec" class="form-select" required="" disabled></select>
				<div class="invalid-tooltip">Kecamatan wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="form_des" class="form-label m-0"><small> Kelurahan </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="kel" id="form_des" class="form-select" required="" disabled></select>
				<div class="invalid-tooltip">Kelurahan wajib di isi</div>
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
				<div class="invalid-tooltip">Ukuran Seragam wajib di isi</div>
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
				<div class="invalid-tooltip">Celana/Rok wajib di isi</div>
			</div>
		</div>
		
		<div class="row mt-3">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="fotoSantri" class="form-label m-0"><small> Foto Calon Santri </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<div id="fotoSantriPreviewContainer" class="position-relative overflow-hidden mb-2" style="width: 125px; height: 166.67px; display: none;">
					<img id="fotoSantriPreview" class="position-absolute top-0 left-0 w-100 h-100" src="./formulir" alt="Foto Santri Preview" style="object-fit: cover;">
				</div>
				
				<input class="form-control" type="file" id="fotoSantri" name="fotoSantri" accept="image/png, image/jpg, image/jpeg" required="">
				<div class="invalid-tooltip">Foto Calon Santri wajib di isi</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="fotoKk" class="form-label m-0"><small> Foto Kartu Keluarga </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<div id="fotoKkPreviewContainer" class="position-relative overflow-hidden mb-2" style="width: 237.5px; height: 125px; display: none;">
					<img id="fotoKkPreview" class="position-absolute top-0 left-0 w-100 h-100" src="./formulir" alt="Foto KK Preview" style="object-fit: cover;">
				</div>
				
				<input class="form-control" type="file" id="fotoKk" name="fotoKk" accept="image/png, image/jpg, image/jpeg" required="">
				<div class="invalid-tooltip">Foto Kartu Keluarga wajib di isi</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="fotobukti" class="form-label m-0"><small> Bukti Transfer </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<div id="fotobuktiPreviewContainer" class="position-relative overflow-hidden mb-2" style="width: 237.5px; height: 125px; display: none;">
					<img id="fotobuktiPreview" class="position-absolute top-0 left-0 w-100 h-100" src="./formulir" alt="Foto KK Preview" style="object-fit: cover;">
				</div>
				
				<input class="form-control" type="file" id="fotobukti" name="fotobukti" accept="image/png, image/jpg, image/jpeg" required="">
				<div class="invalid-tooltip">Bukti Transfer wajib di isi</div>
			</div>
		</div>
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="status_pendaftar" class="form-label m-0"><small> Status Pendaftar </small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="status_pendaftar" id="status_pendaftar" class="form-select" required="">
					<option value="Baru">Baru</option>
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
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
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
			<div class="col-sm-9 col-md-8 col-lg-8 position-relative">
				<select name="template_pesan" id="template_pesan" class="form-select" disabled="">
				</select>
			</div>
		</div>
	</div>
</ol>
<script>
	$('#form_unit').attr('disabled',false);
	$("#pekerjaanAyah").filter(function () {
		$.ajax({
			type: 'POST',
			url: base_url+ "pendaftar/load_pekerjaan",
			dataType : "json",
			beforeSend: function(){
				$("#pekerjaanAyah").empty();
				$("#pekerjaanAyah").append("<option value=''>Pilih</option>");
			},
			success: function(response) {
				$("#pekerjaanAyah").attr("disabled", false);
				var msize = response.length;
				var i = 0;
				for (; i < msize; i++) {
					var teg = response[i]["id"];
					var name = response[i]["name"];
					$("#pekerjaanAyah").append("<option value='" + name + "'>" + name + "</option>");
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
				$("#pendidikanAyah").append("<option value=''>Pilih</option>");
			},
			success: function(response) {
				$("#pendidikanAyah").attr("disabled", false);
				var msize = response.length;
				var i = 0;
				for (; i < msize; i++) {
					var teg = response[i]["id"];
					var name = response[i]["name"];
					$("#pendidikanAyah").append("<option value='" + name + "'>" + name + "</option>");
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
				$("#pendidikanIbu").append("<option value=''>Pilih</option>");
			},
			success: function(response) {
				$("#pendidikanIbu").attr("disabled", false);
				var msize = response.length;
				var i = 0;
				for (; i < msize; i++) {
					var teg = response[i]["id"];
					var name = response[i]["name"];
					$("#pendidikanIbu").append("<option value='" + name + "'>" + name + "</option>");
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
				$("#pekerjaanIbu").append("<option value=''>Pilih</option>");
			},
			success: function(response) {
				$("#pekerjaanIbu").attr("disabled", false);
				var msize = response.length;
				var i = 0;
				for (; i < msize; i++) {
					var teg = response[i]["id"];
					var name = response[i]["name"];
					$("#pekerjaanIbu").append("<option value='" + name + "'>" + name + "</option>");
				}
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
					$("#form_prov").append("<option value='" + id + "'>" + name + "</option>");
				}
			}
		});
	});
	
	
	$('#fotoSantri, #fotoKk, #fotobukti').change(function () {
		const id = $(this).attr('id');
		const foto = this.files[0];
		$(this).removeClass('is-invalid');
		
		if (foto) {
			// const maxImageSize = id == 'fotoKk' ? 1000 * 1024 : `${file_size}` * 1024;
			// if (foto.size > maxImageSize) {
			// $(this).val('')
			// .addClass('is-invalid')
			// .siblings('.invalid-tooltip')
			// .text(`Ukuran foto terlalu besar mohon gunakan foto dengan ukuran maximal ${id == 'fotoKk' ? '1 MB' : file_size + ' KB'}`
			// );
			// $(`#${id}Preview`).attr('src', '#');
			// $(`#${id}PreviewContainer`).hide();
			
			// // return;
			// }
			
			// const expectedAspectRatio = id == 'fotoKk' ? 16 / 9 : 3 / 4;
			const img = new Image();
			
			// img.onload = () => {
			// const aspectRatio = img.width / img.height;
			// if (Math.abs(aspectRatio - expectedAspectRatio) > 0.01) {
			// $(this)
			// .addClass('is-invalid')
			// .siblings('.invalid-tooltip')
			// .text(`Ukuran foto akan di crop dengan ukuran ${
			// id == 'fotoKk' ? '16:9' : '3:4'
			// } silahkan ubah jika tidak sesuai`
			// );
			// }
			// };
			
			img.src = URL.createObjectURL(foto);
			$(`#${id}Preview`).attr('src', URL.createObjectURL(foto));
			$(`#${id}PreviewContainer`).show();
			} else {
			$(`#${id}PreviewContainer`).hide();
		}
	});
	
	$('#image').change(function(){
		$("#frames").html('');
		for (var i = 0; i < $(this)[0].files.length; i++) {
			$("#frames").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" width="80px" height="100px"/>');
		}
	});
	
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
	function validateNumber(event) {
		var key = window.event ? event.keyCode : event.which;
		if (event.keyCode === 8 || event.keyCode === 46 || event.keyCode === 37 || event.keyCode === 39) {
			return true;
			} else if (key < 48 || key > 57) {
			return false;
		} else return true;
	};
</script>																	