<div id="posts_content">
	<?php if(!empty($record)){ ?>
		<div class="table-responsive">
			<table class="table card-table table-vcenter text-nowrap datatable">
				<thead class="thead-dark">
					<tr>
						<th width=5%>No.</th>
						<th class="text-start" width="10%">Tanggal Tiket</th>
						<th width="5%">Kode</th>
						<th>Nomor tiket</th>
						<th>divisi</th>
						<th>Materiel</th>
						<th>Jml</th>
						<th class="text-start" width="10%">Tanggal Penggunaan</th>
						<th class="text-end" width=5%>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1 + $start;
						foreach($record as $row){
							$nama ='';
							$bg ='';
							$disabled ='';
							if($row['status']==1){
								$nama = '<i class="fa fa-spinner fa-spin"></i>&nbsp;PROSES';
								$bg = 'info';
							}
							if($row['status']==2){
								$nama = 'SELESAI';
								$bg = 'success';
								$disabled = 'disabled';
							}
							if($row['status']==3){
								$nama = 'PENDING';
								$bg = 'warning';
							}
							if($row['status']==4){
								$nama = 'CANCEL';
								$bg = 'secondary';
								$disabled = 'disabled';
							}
							if($row['status']==5){
								$nama = 'HAPUS';
								$bg = 'danger';
								$disabled = 'disabled';
							}	
						?>
						<tr>
							<td><?=$no;?></td>
							<td><?=tanggal_indo($row['tanggal'],true)?></td>
							<td><?=$row['kode']?></td>
							<td><?=$row['nomor_tiket']?></td>
							<td align="left"><span><?=divisi($row['id_divisi'])['title'];?></span></td>
							<td align="left"><span><?=get_parent($row['id_master'])->tag;?></span></td>
							<td><?=$row['jml']?></td>
							<td><?=tanggal_indo($row['tanggal_penggunaan'],true)?></td>
							<td class="text-end">
								<div class="btn-group btn-group-sm">
									<button data-bs-toggle="modal" data-bs-target="#DetailTiket" data-id="<?=$row['id'];?>" class="btn btn-<?=$bg;?>">&nbsp;<?=$nama;?></button>
									<?php if($level=='admin'){ ?>
										<button data-bs-toggle="modal" data-bs-target="#EditTiket" class="btn btn-default" data-id="<?=$row['id'];?>" <?=$disabled;?>><i class="ti ti-address-book"></i> Edit</button>
									<?php } ?>
								</div>
							</td>
						</tr>
						<?php
						$no++;}
					?>
				</tbody>
			</table> 
		</div>
		<div class="p-2">
			<?php echo $this->ajax_pagination->create_links(); ?>
		</div>
		<?php }else{ ?>
		<table class='table table-bordered'>
			<tr>
				<td>Belum ada data</td>
			</tr>
		</table>
	<?php } ?>
</div>