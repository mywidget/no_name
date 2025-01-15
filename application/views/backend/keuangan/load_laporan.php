<div class="container">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Kategori Pembayaran</th>
				<th scope="col">Jumlah Bayar</th>
				<th scope="col">Tanggal Bayar</th>
				<th scope="col">Tanggal Pengeluaran</th>
				<th scope="col">Keterangan Pengeluaran</th>
				<th scope="col">Jumlah Pengeluaran</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				// $total_pembayaran = $total_pengeluaran = $sisa_saldo =0;
			if (!empty($laporan)): ?>
			<?php foreach ($laporan as $index => $row): ?>
			<tr>
				<th scope="row"><?= $index + 1 ?></th>
				<td><?=getKategori($row->kategori_bayar);?></td>
				<td><?= number_format($row->jumlah_bayar, 0, ',', '.') ?></td>
				<td><?= $row->tgl_bayar ?></td>
				<td><?= $row->tanggal_pengeluaran ?></td>
				<td><?= $row->keterangan_pengeluaran ?></td>
				<td><?= number_format($row->jumlah_pengeluaran, 0, ',', '.') ?></td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="8" class="text-center">Tidak ada data untuk ditampilkan.</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<!-- Menampilkan Total Pembayaran, Total Pengeluaran, dan Sisa Saldo -->
	<div class="row p-3">
		<div class="col-md-4">
			<button class="btn btn-outline-primary" type="button"><strong>Total Pemasukan:</strong> Rp <?= number_format($total_pembayaran, 0, ',', '.') ?></button>
		</div>
		<div class="col-md-4 text-center">
			<button class="btn btn-outline-primary" type="button"><strong>Total Pengeluaran:</strong> Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></button>
		</div>
		<div class="col-md-4 text-end">
			<button class="btn btn-outline-primary" type="button"><strong>Sisa Saldo:</strong> Rp <?= number_format($sisa_saldo, 0, ',', '.') ?></button>
		</div>
	</div>
</div>