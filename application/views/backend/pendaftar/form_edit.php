<form method="post" class='form-horizontal' id="formPendaftaran">
	<ol type="I">
		<h5>
			<li>Identitas calon santri</li>
		</h5>
		<input type="hidden" name="thnakademik" id="thnakademik" class="form-control" value="<?php echo $tahun['id_tahun_akademik'];?>">
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
						<option value="1" <?=($record->jenis_kelamin == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
						<option value="2" <?=($record->jenis_kelamin == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
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
						<option value="">Pilih Unit</option>
						<?php 
							foreach($unit_sekolah AS $row){
								if($record->unit_sekolah == $row['ketKelas']){ ?>
							<option value="<?php echo $row['ketKelas']; ?>"><?php echo $row['ketKelas']; ?></option>
							<?php }else{ ?>
							<option value="<?php echo $row['ketKelas']; ?>"><?php echo $row['ketKelas']; ?></option>
								<?php }
							}
						?>
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
					<select name="biaya" id="form_biaya" value="<?=$record->biaya_daftar;?>"  class="form-select" required=""></select>
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
					<option value="">Pilih Kamar</option>
					<?php 
						// $daerah = mysqli_query($konek,"SELECT nama_kamar FROM rb_kamar ORDER BY nama_kamar ASC");
						foreach($kamar AS $row){
						?>
						<option value="<?php echo $row['nama_kamar']; ?>"><?php echo $row['nama_kamar']; ?></option>
						<?php 
						}
					?>
				</select>
				<div class="invalid-feedback"></div>
			</div>
		</div>
		
		<div class="row align-items-center mt-2">
			<div class="col-sm-3 col-md-3 col-lg-4">
				<label for="kuota" class="form-label m-0"><small> Kuota Kamar</small></label>
			</div>
			<div class="col-sm-9 col-md-8 col-lg-8">
				<select name="kuota" id="form_kuota" value="<?=$record->kamar;?>"  class="form-select" required=""></select>
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
						<option value="TK-PAUD">TK-PAUD</option>
						<option value="SD-MI">SD-MI</option>
						<option value="SLTP">SLTP</option>
						<option value="SLTA" selected>SLTA</option>
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
						<option value="">Pilih Pendidikan</option>
						<option value="Tidak Sekolah">Tidak Sekolah</option>
						<option value="PAUD/TK">PAUD/TK</option>
						<option value="SD/MI" selected>SD/MI</option>
						<option value="SLTP">SLTP</option>
						<option value="SLTA">SLTA</option>
						<option value="D1">D1</option>
						<option value="D2">D2</option>
						<option value="D3">D3</option>
						<option value="D4">D4</option>
						<option value="S1">S1</option>
						<option value="S2">S2</option>
						<option value="S3">S3</option>
						<option value="Pesantren">Pesantren</option>
						<option value="PGA">PGA</option>
					</select>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="pekerjaanAyah" class="form-label m-0"><small> Pekerjaan </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="pekerjaan_ayah" id="pekerjaanAyah" class="form-select" required="">
						<option value="">Pilih Pekerjaan</option>
						<option value="0"></option>
						<option value="TIDAK BEKERJA">TIDAK BEKERJA</option>
						<option value="PNS">PNS</option>
						<option value="GURU">GURU</option>
						<option value="PENGUSAHA">PENGUSAHA</option>
						<option value="PETANI">PETANI</option>
						<option value="PEKERJA PABRIK">PEKERJA PABRIK</option>
						<option value="TUKANG BANGUNAN">TUKANG BANGUNAN</option>
						<option value="PENSIUNAN">PENSIUNAN</option>
						<option value="TNI/POLRI">TNI/POLRI</option>
						<option value="WIRASWASTA">WIRASWASTA</option>
						<option value="PEDAGANG">PEDAGANG</option>
						<option value="NELAYAN">NELAYAN</option>
						<option value="SUPIR/KONDEKTUR">SUPIR/KONDEKTUR</option>
						<option value="LAINNYA" selected>LAINNYA</option>
						<option value="Mubaligh">Mubaligh</option>
						<option value="Karyawan">Karyawan</option>
						<option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
						<option value="Penjahit">Penjahit</option>
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
						<option value="">Pilih Pendidikan</option>
						<option value="Tidak Sekolah">Tidak Sekolah</option>
						<option value="PAUD/TK">PAUD/TK</option>
						<option value="SD/MI">SD/MI</option>
						<option value="SLTP">SLTP</option>
						<option value="SLTA" selected>SLTA</option>
						<option value="D1">D1</option>
						<option value="D2">D2</option>
						<option value="D3">D3</option>
						<option value="D4">D4</option>
						<option value="S1">S1</option>
						<option value="S2">S2</option>
						<option value="S3">S3</option>
						<option value="Pesantren">Pesantren</option>
						<option value="PGA">PGA</option>
					</select>
				</div>
			</div>
			<div class="row align-items-center mt-2">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="pekerjaanIbu" class="form-label m-0"><small> Pekerjaan </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<select name="pekerjaan_ibu" id="pekerjaanIbu" class="form-select" required="">
						<option value="">Pilih Pekerjaan</option>
						<option value="TIDAK BEKERJA">TIDAK BEKERJA</option>
						<option value="PNS">PNS</option>
						<option value="GURU">GURU</option>
						<option value="PENGUSAHA">PENGUSAHA</option>
						<option value="PETANI">PETANI</option>
						<option value="PEKERJA PABRIK">PEKERJA PABRIK</option>
						<option value="TUKANG BANGUNAN">TUKANG BANGUNAN</option>
						<option value="PENSIUNAN">PENSIUNAN</option>
						<option value="TNI/POLRI">TNI/POLRI</option>
						<option value="WIRASWASTA">WIRASWASTA</option>
						<option value="PEDAGANG">PEDAGANG</option>
						<option value="NELAYAN">NELAYAN</option>
						<option value="SUPIR/KONDEKTUR">SUPIR/KONDEKTUR</option>
						<option value="LAINNYA">LAINNYA</option>
						<option value="Mubaligh">Mubaligh</option>
						<option value="Karyawan">Karyawan</option>
						<option value="Ibu Rumah Tangga" selected>Ibu Rumah Tangga</option>
						<option value="Penjahit">Penjahit</option>
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
						<option value="Rp.1jt - Rp.2jt" selected>Rp.1jt - Rp.2jt</option>
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
						<option value="M" selected>M</option>
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
						<option value="M" selected>M</option>
						<option value="L">L</option>
						<option value="XL">XL</option>
						<option value="XXL">XXL</option>
						<option value="XXXL">XXXL</option>
						<option value="XXXXL">XXXXL</option>
					</select>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="fotoSantri" class="form-label m-0"><small> Foto Calon Santri </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<div id="fotoSantriPreviewContainer" class="position-relative overflow-hidden mb-2" style="width: 125px; height: 166.67px; display: none;">
						<img id="fotoSantriPreview" class="position-absolute top-0 left-0 w-100 h-100" src="./formulir" alt="Foto Santri Preview" style="object-fit: cover;">
					</div>
					
					<input class="form-control" type="file" id="fotoSantri" name="fotoSantri" accept="image/png, image/jpg, image/jpeg" required="">
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="fotoKk" class="form-label m-0"><small> Foto Kartu Keluarga </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<div id="fotoKkPreviewContainer" class="position-relative overflow-hidden mb-2" style="width: 237.5px; height: 125px; display: none;">
						<img id="fotoKkPreview" class="position-absolute top-0 left-0 w-100 h-100" src="./formulir" alt="Foto KK Preview" style="object-fit: cover;">
					</div>
					
					<input class="form-control" type="file" id="fotoKk" name="fotoKk" accept="image/png, image/jpg, image/jpeg" required="">
					<div class="invalid-feedback"></div>
				</div>
			</div>
			
			<div class="row mt-3">
				<div class="col-sm-3 col-md-3 col-lg-4">
					<label for="fotoKk" class="form-label m-0"><small> Bukti Transfer </small></label>
				</div>
				<div class="col-sm-9 col-md-8 col-lg-8">
					<div id="fotoBuktiPreviewContainer" class="position-relative overflow-hidden mb-2" style="width: 237.5px; height: 125px; display: none;">
						<img id="fotoKkPreview" class="position-absolute top-0 left-0 w-100 h-100" src="./formulir" alt="Foto KK Preview" style="object-fit: cover;">
					</div>
					
					<input class="form-control" type="file" id="image" name="fotobukti" accept="image/png, image/jpg, image/jpeg" required="">
					<div class="invalid-feedback"></div>
				</div>
			</div>
		</ol>
		
	</form>			