<div class="container">
	<table class="table table-vcenter card-table table-striped">
		<thead>
			<tr>
				<td colspan="5">PEMASUKAN</td>
			</tr>
			<tr>
				<th style="width:1%!important">#</th>
				<th style="width:15%!important">Tanggal</th>
				<th style="width:20%!important">Kategori</th>
				<th scope="col">Keterangan</th>
				<th class="text-end" scope="col">Jumlah</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$total_pemasukan=0;
			if (!empty($pemasukan)): ?>
			<?php foreach ($pemasukan as $index => $row): 
				$total_pemasukan += $row->jumlah_bayar;
			?>
			<tr>
				<th scope="row"><?= $index + 1 ?></th>
				<td><?= dtime($row->tgl_bayar) ?></td>
				<td><?=($row->title);?></td>
				<td><?= $row->nama ?> [<?=($row->rekening);?>]</td>
				<td class="text-end"><?= rprp($row->jumlah_bayar) ?></td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="5" class="text-center">Tidak ada data untuk ditampilkan.</td>
			</tr>
			<?php endif; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4">TOTAL PEMASUKAN</td>
				<td class="text-end strong"><?=rprp($total_pemasukan);?></td>
			</tr>
		</tfoot>
	</table>
	<table class="table table-vcenter card-table table-striped">
		<thead>
			<tr>
				<td colspan="5">PENGELUARAN</td>
			</tr>
			<tr>
				<th style="width:1%!important">#</th>
				<th style="width:15%!important">Tanggal</th>
				<th style="width:20%!important">Kategori</th>
				<th scope="col">Keterangan</th>
				<th class="text-end" scope="col">Jumlah</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$total_pengeluaran =0;
			if (!empty($pengeluaran)): ?>
			<?php foreach ($pengeluaran as $index => $row): 
				$total_pengeluaran += $row->jumlah_pengeluaran;
			?>
			<tr>
				<th scope="row"><?= $index + 1 ?></th>
				<td><?= dtime($row->tanggal_pengeluaran) ?></td>
				<td><?=getKategori($row->id_kategori);?></td>
				<td><?= $row->keterangan_pengeluaran ?></td>
				<td class="text-end"><?= rprp($row->jumlah_pengeluaran) ?></td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="5" class="text-center">Tidak ada data untuk ditampilkan.</td>
			</tr>
			<?php endif; ?>
		</tbody>
		
		
		<tfoot>
			<tr>
				<td colspan="4">TOTAL PENGELUARAN</td>
				<td class="text-end strong"><?=rprp($total_pengeluaran);?></td>
			</tr>
		</tfoot>
	</table>
	<table class="table table-vcenter card-table table-striped">
		<tbody>
			<tr>
				<td colspan="5" class="text-end strong">TOTAL PEMASUKAN: <?=rprp($total_pembayaran);?></td>
			</tr>
			<tr>
				<td colspan="5" class="text-end strong">TOTAL PENGELUARAN: <?=rprp($total_pengeluaran);?></td>
			</tr>
			<tr>
				<td colspan="5" class="text-end strong">TOTAL SALDO: <?=rprp($sisa_saldo);?></td>
			</tr>
		</tbody>
	</table>
	
</div>