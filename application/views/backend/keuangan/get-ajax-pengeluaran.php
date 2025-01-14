<div id="posts_content">
    <?php if(!empty($record)){ ?>
        <div class="table-responsive">
            <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                <thead class="thead-dark">
                  	<tr>
                        <th class="w-1 text-center">No</th>
                        <th class="w-15 text-left">Tanggal</th>
                        <th class="w-15 text-left">Keterangan</th>
                        <th class="w-15 text-end">Jumlah</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                        $total = 0;
                        $no = 1;
                        foreach ($record as $row){
                            $kode = encrypt_url($row['id']);
                            $total += $row['jumlah'];
                        ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=indo_date($row['tanggal']);?></td>
                            <td><?=($row['keterangan']);?></td>
                            <td class="text-end"><?=rprp($row['jumlah']);?></td>
                        </tr>
                        <?php $no++;
                        }
                    ?>
                    <tfoot>
                        <tr>
                            <td>#</td>
                            <td colspan="2">Total Pengeluaran</td>
                            <td class="text-end"><?=rprp($total);?></td>
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
