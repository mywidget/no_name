<div id="posts_content">
    <?php if(!empty($record)){ ?>
        <div class="table-responsive" style="min-height: 300px;">
            <table class="table card-table table-vcenter table-striped text-nowrap datatable" >
                <thead class="thead-dark">
                  	<tr>
                        <th class="w-1 text-center">No</th>
                        <th class="w-15 text-left">Tanggal | Kode Daftar</th>
                        <th class="w-15 text-left">Nama | Tahun Akademik</th>
                        <th class="w-15 text-end">Total Tagihan</th>
                        <th class="w-15 text-end">Total Bayar</th>
                        <th class="w-15 text-end">Sisa Tagihan</th>
                        <th class="w-12 text-end">Bayar | Cetak | Kirim | Detail</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                        $no=$this->uri->segment(3)+1;
                        $total_tagihan = $total_bayar = $sisa_tagihan = 0;
                        foreach ($record as $row){
                            $kode = encrypt_url($row['id_tagihan']);
                            
                            if ($row['status_lunas'] == 'Y')
                            { 
                                
                                $bayar = '<a class="btn btn-success" href="#"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Lunas</a>';
                                }else{ 
                                
                                $bayar = '<a class="btn btn-info flat" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#ModalBayar" href="#"><i class="fa fa-money"></i>&nbsp;&nbsp;Bayar</a>';
                            }
                            $hapus = '<a class="btn btn-danger" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Data</a>';
                            
                            $icon = '<i class="fa fa-print" data-bs-toggle="tooltip" title="Tikda Aktif"></i>&nbsp;Cetak';
                            $print = '<a href="/keuangan/cetak_tagihan/'.$kode.'" class="dropdown-item" target="_blank">'.$icon.'</a>';
                            $detail = '<a href="/keuangan/detail_tagihan/'.$kode.'" class="dropdown-item" target="_blank">Detail</a>';
                            //KIRIM TAGIHAN KE WA
                            $nomor_wa = cekPendaftar($row['id_siswa'])['nomor_hp'];
                            $send_wa = '<a class="dropdown-item" data-id="'.$kode.'" data-nomor="'.$nomor_wa.'" data-bs-toggle="modal" data-bs-target="#kirim-wa" href="#"><i class="fa fa-whatsapp"></i>&nbsp;Kirim WA</a>';
                            
                            $sisa = $row['total_tagihan'] - $row['total_bayar'];
                            $total_tagihan +=$row['total_tagihan'];
                            $total_bayar +=$row['total_bayar'];
                            $sisa_tagihan +=$sisa;
                            
                        ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td>
                                <?=date_short($row['tgl_tagihan']);?>
                                <div class="text-secondary"><?=$row['kode_daftar'];?></div>
                            </td>
                            <td>
                                <?=get_nama($row['id_siswa']);?>
                                <div class="text-secondary"><?=$row['tahun_akademik'];?></div>
                            </td>
                            
                            <td class="text-end">
                                <?=rprp($row['total_tagihan']);?>
                                <div class="text-secondary">Pendaftaran + Biaya Masuk</div>
                            </td>
                            <td class="text-end"><?=rprp($row['total_bayar']);?>
                                <div class="text-secondary">Pendaftaran & Biaya Masuk</div>
                            </td>
                            <td class="text-end"><?=rprp($sisa);?>
                                <div class="text-secondary">Biaya Masuk</div>
                            </td>
                            <td class="text-end">
                                <div class="btn-group flat">
                                    <?=$bayar;?>
                                    <button class="btn btn-danger flat dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu"  data-popper-placement="right-start" style="z-index:99999!important">
                                        <li><?=$print;?></li>
                                        <li><?=$send_wa;?></li>
                                        <li><?=$detail;?></li>
                                        <!--li><hr class="dropdown-divider"></li-->
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php $no++;
                        }
                    ?>
                    <tfoot>
                        <tr>
                            <td>#</td>
                            <td colspan="2">Total</td>
                            <td class="text-end"><?=rprp($total_tagihan);?></td>
                            <td class="text-end"><?=rprp($total_bayar);?></td>
                            <td class="text-end"><?=rprp($sisa_tagihan);?></td>
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
