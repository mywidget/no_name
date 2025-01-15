<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					<?=$menu;?>
				</div>
                <h2 class="page-title">
					Detail Tagihan
				</h2>
			</div>
			<!-- Page title actions -->
			<div class="col-auto ms-auto d-print-none">
                <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
					<!-- Download SVG icon from http://tabler-icons.io/i/printer -->
					<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path></svg>
					Print Tagihan
				</button>
			</div>
		</div>
	</div>
</div>

<div class="page-body">
	<div class="container-xl">
		<div class="card card-lg">
			<div class="card-body">
                <div class="row">
					<div class="col-6">
						<p class="h3"><?=tag_key('nama_sekolah');?></p>
						<address>
							<?=tag_key('site_addr');?><br>
							<?=tag_key('site_phone');?><br>
							<?=tag_key('site_mail');?><br>
						</address>
					</div>
					<div class="col-6 text-end">
						<p class="h3"><?=cekPendaftar($cetak->id_siswa)['nama'];?></p>
						<address>
							<?=cekPendaftar($cetak->id_siswa)['unit_sekolah'];?><br>
							<?=cekPendaftar($cetak->id_siswa)['nomor_hp'];?><br>
							<?=cekPendaftar($cetak->id_siswa)['email'];?><br>
						</address>
					</div>
					<div class="col-6 my-3">
					<div class="text-secondary">KODE PENDAFTARAN</div>
						<h1><?=$cetak->kode_daftar;?></h1>
					</div>
					<div class="col-6 my-3 text-end">
					<div class="text-secondary">TOTAL TAGIHAN</div>
						<h1><?=rprp($cetak->total_tagihan);?></h1>
					</div>
				</div>
                <table class="table table-transparent table-responsive">
					<thead>
						<tr>
							<th class="text-center" style="width: 1%"></th>
							<td class="strong">Rincian</td>
							<td class="strong text-end" >Amount</td>
						</tr>
					</thead>
					<tbody>
						<?php
						
						$no = 1;
							foreach($result AS $row):
						?>
						<tr>
							<td class="text-center"><?=$no;?></td>
							<td>
								<p class="strong mb-1"><?=getKategori($row->id_kategori);?></p>
							</td>
							<td class="text-end"><?=rprp($row->harga);?></td>
						</tr>
					    <?php $no++; endforeach;?>
					</tbody></table>
					<p class="text-secondary text-center mt-3"><?=tag_key('site_name');?></p>
			</div>
		</div>
	</div>
</div>