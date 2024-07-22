<!doctype html>
<html lang="en">
	<head>
		<title><?=$title;?></title>
		<link href="<?=base_url();?>assets/print_style/bootstrap/css/bootstrap.css" rel="stylesheet"/>
		<!--link href="<?=base_url();?>assets/print_style/printer.css" rel="stylesheet"/-->
	</head>
	<body onload="window.print()">
	<div class="container">
		<h3><center><?=tag_key('nama_sekolah');?></center></h3>
		 <table class="green-white">
			<tr><td>Kode Daftar </td>      <td>:</td> <td><?=$s['kode_daftar'];?></td></tr>
			<tr><td colspan='3'><br><u><b>I. Identitas Calon Santri</b></u></td></tr>
			<tr><td>1. Nama </td>      <td>:</td> <td><?=$s['nama'];?></td></tr>
			<tr><td>2. NIK </td>      <td>:</td> <td><?=$s['nik'];?></td></tr>
			<tr><td>3. No KK </td>      <td>:</td> <td><?=$s['no_kk'];?></td></tr>
			<tr><td>4. Jenis Kelamin </td>      <td>:</td> <td><?=$s['jenis_kelamin'];?></td></tr>
			<tr><td>5. Tempat / Tgl Lahir</td> <td>:</td> <td><?=$s['tempat_lahir'];?>, <?=indo_date($s['tanggal_lahir']);?></td></tr>
			<tr><td>6. Email</td>              <td>:</td> <td><?=$s['email'];?></td></tr>
			<tr><td>7. Anak Ke</td> <td>:</td> <td><?=$s['anak_ke'];?></td></tr>
			<tr><td>8. Jumlah Saudara</td>       <td>:</td> <td><?=$s['dari'];?></td></tr>
			<tr><td>9. Status dalam keluarga</td>   <td>:</td> <td><?=$s['status_keluarga'];?></td></tr>
			<tr><td>10. Saudara sekandung di PP Tebuireng4 </td>   <td>:</td> <td><?=$s['saudara_pp'];?></td></tr>
			<tr><td colspan='3'><br><u><b>II. Pilihan Pendidikan</b></u></td></tr>
			<tr><td>1. Status</td>       <td>:</td> <td><?=$s['s_pendidikan'];?></td></tr>
			<tr><td>2. Unit Sekolah</td>       <td>:</td> <td><?=$s['unit_sekolah'];?></td></tr>
			<tr><td>3. Kelas/Semester</td>       <td>:</td> <td><?=getKelas($s['kelas'])->kode_kelas;?></td></tr>
			<tr><td>4. Status di Sekolah/Kuliah</td>       <td>:</td> <td><?=$s['status_sekolah'];?></td></tr>
			<tr><td>5. Kamar</td>       <td>:</td> <td><?=$s['kamar'];?></td></tr>
			<tr><td colspan='3'><br><u><b>III. Riwayat Pendidikan</b></u></td></tr>
			<tr><td>1. Ijazah Terakhir</td>       <td>:</td> <td><?=$s['ijasah_terakhir'];?></td></tr>
			<tr><td>2. Nama sekolah asal</td>       <td>:</td> <td><?=$s['nama_sekolah_asal'];?></td></tr>
			<tr><td>3. Alamat sekolah asal</td>       <td>:</td> <td><?=$s['alamat_sekolah'];?></td></tr>
			<tr><td>4. NISN</td>       <td>:</td> <td><?=$s['nisn'];?></td></tr>
			<tr><td>5. No KIP (Jika ada)</td>       <td>:</td> <td><?=$s['no_kip'];?></td></tr>
			<tr><td colspan='3'><br><u><b>IV. Identitas orang tua</b></u></td></tr>
			<tr><td>1. Nomor Kartu Keluarga</td>       <td>:</td> <td><?=$s['no_kk'];?></td></tr>
			<tr><td>2. Nama Ayah</td>       <td>:</td> <td><?=$s['nama_ayah'];?></td></tr>
			<tr><td>3. NIK Ayah</td>       <td>:</td> <td><?=$s['nik_ayah'];?></td></tr>
			<tr><td>4. Kondisi</td>       <td>:</td> <td><?=$s['kondisi_ayah'];?></td></tr>
			<tr><td>5. Pendidikan Terakhir</td>       <td>:</td> <td><?=$s['pendidikan_terakhir_ayah'];?></td></tr>
			<tr><td>6. Pekerjaan</td>       <td>:</td> <td><?=$s['pekerjaan_ayah'];?></td></tr>
			<tr><td>7. Nama Ibu</td>       <td>:</td> <td><?=$s['nama_ibu'];?></td></tr>
			<tr><td>8. NIK Ibu</td>       <td>:</td> <td><?=$s['nik_ibu'];?></td></tr>
			<tr><td>9. Kondisi</td>       <td>:</td> <td><?=$s['kondisi_ibu'];?></td></tr>
			<tr><td>10. Pendidikan Terakhir</td>       <td>:</td> <td><?=$s['pendidikan_terakhir_ibu'];?></td></tr>
			<tr><td>11. Pekerjaan</td>       <td>:</td> <td><?=$s['pekerjaan_ibu'];?></td></tr>
			<tr><td>12. Penghasilan orang tua</td>       <td>:</td> <td><?=$s['penghasilan_ortu'];?></td></tr>
			<tr><td>13. Nomor Telphone</td>       <td>:</td> <td><?=$s['nomor_hp'];?></td></tr>
			<tr><td>14. Nomor telfon alternatif</td>       <td>:</td> <td><?=$s['no_hp_alternatif'];?></td></tr>
			<tr><td colspan='3'><br><u><b>V. Alamat calon santri</b></u></td></tr>
			<tr><td>1.RT/RW </td><td>:</td> <td><?=$s['rt'];?>/<?=$s['rw'];?></td></tr>
			<tr><td>2. Dusun </td><td>:</td> <td><?=$s['dusun'];?></td></tr>
			<tr><td>3. Kode pos </td><td>:</td> <td><?=$s['kode_pos'];?></td></tr>
			<tr><td>4. Alamat </td><td>:</td> <td><?=$s['alamat'];?></td></tr>
			<tr><td width='160px' style='padding-left:19px'>a. Propinsi</td>         <td>:</td> <td><?=getProvinsi($s['provinsi']);?></td></tr>
			<tr><td style='padding-left:19px'>b. Kabupaten</td>         <td>:</td> <td><?=getKabupaten($s['kabupaten']);?></td></tr>
			<tr><td width='160px' style='padding-left:19px'>c. Kecamatan</td>         <td>:</td> <td><?=getKecamatan($s['kecamatan']);?></td></tr>
			<tr><td style='padding-left:19px'>d. Kelurahan</td>         <td>:</td> <td><?=getKelurahan($s['kelurahan']);?></td></tr>
			<tr><td colspan='3'><br><u><b>VI. Riwayat penyakit</u></b></td></tr>
			<tr><td>1.Jenis penyakit </td><td>:</td> <td><?=$s['jenis_penyakit'];?></td></tr>
			<tr><td>2. Sejak </td><td>:</td> <td><?=$s['sejak'];?></td></tr>
			<tr><td>3. Tindakan pengobatan </td><td>:</td> <td><?=$s['tindakan_pengobatan'];?></td></tr>
			<tr><td>4. Kondisi sekarang </td><td>:</td> <td><?=$s['kondisi_sekarang'];?></td></tr>
			<tr><td colspan='3'><br><u><b>VII. Lain Lain</b></u></td></tr>
			<tr><td>1.Ukuran Seragam </td></tr>
			<tr><td width='160px' style='padding-left:19px'>a. Baju</td>         <td>:</td> <td><?=$s['ukuran_seragam_baju'];?></td></tr>
			<tr><td style='padding-left:19px'>b. Celana/Rok</td>         <td>:</td> <td><?=$s['ukuran_celana_rok'];?></td></tr>
			
		</table>
		
		<br><br>
		<table border=0 width=100%>
			<tr>
				<td width="400" align="center"></td>
				<td width="400" align="center"><?php echo tag_key('letter_addr');?>, <?php echo indo_date(date("Y-m-d")); ?> <br> Mengetahui: orang tua / wali</td>
			</tr>
			<tr>
				<td align="center"><br /></td>
				
				<td align="center"><br /><br />
				................................... <br /><br /></td>
			</tr>
		</table> 
	</div>
	</body>
</html>                                                                                                                    