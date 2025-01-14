<div id="posts_content">
    <?php if(!empty($record)){ ?>
        <div class="table-responsive">
            <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                <thead class="thead-dark">
                  	<tr>
                        <th class="w-1 text-center">No</th>
                        <th class="w-15 text-left">Kode Pendaftar</th>
                        <th class="w-15 text-left">Nama</th>
                        <th class="w-15 text-left">Tahun Akademik</th>
                        <th class="w-15 text-end">Total Tagihan</th>
                        <th class="w-15 text-end">Total Bayar</th>
                        <th class="w-15 text-end">Sisa Tagihan</th>
                        <th class="w-12 text-end">Status | Aksi</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                        $no = 1;
                        foreach ($record as $row){
                            $kode = encrypt_url($row['id_tagihan']);
                            
                            if ($row['status_lunas'] == 'Y')
                            { 
                                
                                $bayar = '<a class="btn btn-success" href="#"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Lunas</a>';
                                }else{ 
                                
                                $bayar = '<a class="btn btn-info" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#ModalBayar" href="#"><i class="fa fa-money"></i>&nbsp;&nbsp;Bayar</a>';
                            }
                            $hapus = '<a class="btn btn-danger" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Data</a>';
                            $sisa = $row['total_tagihan'] - $row['total_bayar'];
                            
                            $icon = '<i class="fa fa-print" data-bs-toggle="tooltip" title="Tikda Aktif"></i>';
                            $print = '<a href="/keuangan/cetak_tagihan/'.$kode.'" class="btn btn-secondary btn-sm active" target="_blank">'.$icon.'</a>';
                        ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=$row['kode_daftar'];?></td>
                            <td><?=get_nama($row['id_siswa']);?></td>
                            <td><?=$row['tahun_akademik'];?></td>
                            <td class="text-end"><?=rprp($row['total_tagihan']);?></td>
                            <td class="text-end"><?=rprp($row['total_bayar']);?></td>
                            <td class="text-end"><?=rprp($sisa);?></td>
                            <td align="right">
                                <div class="btn-group btn-group-sm">
                                    <?=$print;?>
                                    <?=$bayar;?>
                                </div>
                            </td>
                        </tr>
                        <?php $no++;
                        }
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
