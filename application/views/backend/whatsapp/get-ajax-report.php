<div id="posts_content">
    <?php if(!empty($record)){ ?>
        <div class="table-responsives">
            <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                <thead class="thead-dark">
                    <tr>
                        <th style="width:1% !important;">No</th>
                        <th class="w-2">Device</th>
                        <th class="w-2">Target</th>
                        <th style="width:200px !important;">Pesan</th>
                        <th class="w-2">Status</th>
                        <th style="width:20%;text-align:center">Aksi</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                         $no = $start + 1;
                        foreach ($record as $row){
                            $kode = encrypt_url($row->id);
                            
                            $hapus = '<a class="btn btn-danger" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Data</a>';
                            
                        ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=$row->device;?></td>
                            <td><?=$row->target;?></td>
                            <td class="pesan"><?=$row->message;?></td>
                            <td><?=$row->status;?></td>
                            <td align="right">
                                <div class="btn-group btn-group-sm">
                                    <a href='javascript:void(0);' class="btn btn-info detail"  data-id='<?=$kode;?>'  class='openPopup text-primary'><i class="ti ti-search"></i>&nbsp;&nbsp;Detail</a>
                                    <a href='javascript:void(0);' class="btn btn-primary kirim"  data-id='<?=$kode;?>'  class='openPopup text-info'><i class="ti ti-reload"></i>&nbsp;&nbsp;Kirim Ulang</a>
                                    <?=$hapus;?>
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
