<!doctype html>
<html lang="en">
	<head>
		<title><?=$title;?></title>
		<link href="<?=base_url();?>assets/print_style/bootstrap/css/bootstrap.css" rel="stylesheet"/>
		<!--link href="<?=base_url();?>assets/print_style/printer.css" rel="stylesheet"/-->
		<script type="text/javascript">
			<!--
			// window.print();
			// window.onfocus=function(){ window.close();}
			//-->
		</script>
	</head>
	<body>
	No.		Kode Daftar	Nama	NIK	No KK	Jenis Kelamin	Tempat / Tgl Lahir	Email	Anak Ke	Jumlah Saudara	Status dalam keluarga	Saudara sekandung di PP Tebuireng4	Status	Unit Sekolah	Kelas/Semester	Status di Sekolah/Kuliah	Kamar	Ijazah Terakhir	Nama sekolah asal	Alamat sekolah asal	NISN	No KIP	Nomor Kartu Keluarga	Nama Ayah	NIK Ayah	Kondisi	Pendidikan Terakhir	Pekerjaan	Nama Ibu	NIK Ibu	Kondisi	Pendidikan Terakhir	Pekerjaan	Penghasilan orang tua	Nomor Telphone	Nomor telfon alternatif	RT RW	Dusun	Kode pos	Alamat	Provinsi	Kabupaten	Kecamatan	Kelurahan	Jenis penyakit	Sejak	Tindakan pengobatan	Kondisi sekarang	Baju	Celana/Rok	Biaya Daftar

		<div class="container">
			<h3><center><?=tag_key('nama_sekolah');?></center></h3>
			<tr>
				<td>No.</td>
				<td>Tanggal Daftar.</td>
			</tr>
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