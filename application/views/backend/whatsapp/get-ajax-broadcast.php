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
                        <th class="w-2">Schedule KIRIM</th>
                        <th class="w-2">Status</th>
                        <th class="w-12 text-end">Aksi</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                        $no = $start + 1;
                        foreach ($record as $row){
                            $kode = encrypt_url($row->id);
                            $device = encrypt_url($row->device);
                            
                            $hapus = '<a class="btn btn-danger" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Data</a>';
                            if(!empty($row->schedule))
                            {
                                $schedule = $row->schedule;
                                }else{
                                $schedule = 'LANGSUNG'; 
                            }
                            if(is_numeric($row->target)){
                                $target = get_unit($row->target);
                                }else{
                                $target = $row->target;
                            }
                            
                        ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=$row->device;?></td>
                            <td><?=$target;?></td>
                            <td class="pesan"><?=$row->message;?></td>
                            <td><?=$schedule;?></td>
                            <td><?=$row->status;?></td>
                            <td align="right">
                                <div class="btn-group btn-group-sm">
                                    <a href='javascript:void(0);' class="btn btn-info detail"  data-id='<?=$kode;?>'  class='openPopup text-primary'><i class="ti ti-search"></i>&nbsp;&nbsp;Detail</a>
                                    <?php if($row->kirim==0){ ?>
                                        <a href='javascript:void(0);' class="btn btn-success kirim" data-id='<?=$kode;?>' data-device='<?=$device;?>'  class='openPopup text-info'><i class="ti ti-send"></i>&nbsp;&nbsp;Kirim</a>
                                        <?php }else{ ?>
                                        <a href='javascript:void(0);' class="btn btn-info kirim"  data-id='<?=$kode;?>'  data-device='<?=$device;?>'  class='openPopup text-info'><i class="ti ti-reload"></i>&nbsp;&nbsp;Kirim ulang</a>
                                    <?php } ?>
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
