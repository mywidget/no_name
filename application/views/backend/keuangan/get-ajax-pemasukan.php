<div id="posts_content">
    <?php if(!empty($record)){ ?>
        <div class="table-responsive">
            <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                <thead class="thead-dark">
                  	<tr>
                        <th class="w-1 text-center">No</th>
                        <th class="w-15 text-left">Tanggal</th>
                        <th class="w-15 text-left">pendaftar</th>
                        <th class="w-15 text-left">Kategori</th>
                        <th class="w-15 text-left">Rekening</th>
                        <th class="w-15 text-end">Jumlah</th>
                        <th class="w-12 text-end">Lampiran</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                        $total = 0;
                        $no = 1;
                        foreach ($record as $row){
                            $kode = encrypt_url($row['id_bayar_tagihan']);
                            $total += $row['jumlah_bayar'];
                            $icon = '<i class="fa fa-image" data-bs-toggle="tooltip" title="Tikda Aktif"></i>';
                        ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=indo_date($row['tgl_bayar']);?></td>
                            <td><?=($row['nama']);?></td>
                            <td><?=($row['title']);?></td>
                            <td><?=($row['rekening']);?></td>
                            <td class="text-end"><?=rprp($row['jumlah_bayar']);?></td>
                            <td align="right">
                                <div class="btn-group btn-group-sm">
                                    <?=$icon;?>
                                </div>
                            </td>
                        </tr>
                        <?php $no++;
                        }
                    ?>
                    <tfoot>
                        <tr>
                            <td>#</td>
                            <td colspan="4">Total Pemasukan</td>
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
