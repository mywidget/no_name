<div id="posts_content">
    <?php if(!empty($record)){ ?>
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
                <thead class="thead-dark">
                  	<tr>
                        <th class="w-1 text-center">No</th>
                        <th class="w-15 text-left">Tanggal</th>
                        <th class="w-15 text-left">SUMBER KAS</th>
                        <th class="w-15 text-left">Keterangan</th>
                        <th class="w-15 text-end">Jumlah</th>
                        <th class="w-15 text-end">Aksi</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                        $total = 0;
                        $no = 1;
                        foreach ($record as $row){
                            $kode = encrypt_url($row['id']);
                            $total += $row['jumlah'];
                            $link = base_url('keuangan').'/cetak_pengeluaran/'.$kode;
                            $print = '<a class="btn btn-primary btn-sm flat" data-id="'.$kode.'" href="'.$link.'" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a>';
                            $hapus = '<a class="btn btn-danger" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>Hapus Data</a>';
                            $edit ="<a href='javascript:void(0);' class='btn btn-success edit_pengeluaran' data-id='".$kode."' class='openPopup text-info'><i class='ti ti-edit'></i> Edit Data</a>";
                        ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=indo_date($row['tanggal']);?></td>
                            <td><?=getKategori($row['id_kategori']);?></td>
                            <td><?=($row['keterangan']);?></td>
                            <td class="text-end"><?=rprp($row['jumlah']);?></td>
                            <td align="right">
                                <div class="btn-group btn-group-sm">
                                    <?=$print.$edit.$hapus;?>
                                    
                                </div>
                            </td>
                        </tr>
                        <?php $no++;
                        }
                    ?>
                    <tfoot class="thead-dark">
                        <tr>
                            <td>#</td>
                            <td colspan="3">Total Pengeluaran</td>
                            <td class="text-end"><?=rprp($total);?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </tbody>  
            </table>  
        </div>
        <div class="card-footer bg-transparent">
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
