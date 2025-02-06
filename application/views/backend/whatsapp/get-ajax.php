<div id="posts_content">
    <?php if(!empty($record)){ ?>
        <div class="table-responsive">
            <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Device</th>
                        <th>Nomor HP</th>
                        <th>Status Device</th>
                        <th>Tgl Kadaluarsa</th>
                        <th>Kuota</th>
                        <th>Jenis Paket</th>
                        <th>Cek Status</th>
                        <th class="w-12 text-end">Status | Aksi</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                        $no = 1;
                        $html ='';
                        foreach ($record as $row){
                            $kode = encrypt_url($row->id);
                            if($row->id_pengaturan==1){
                                if ($row->device_status == 'Connected') {
                                    $scan_qr = '<a href="/whatsapp/scanqr_app/'.encrypt_url($row->id).'" class="btn  btn-primary bg-primary btn-sm avatar avatar-sm text-white" ><i class="fa fa-qrcode rounded-circle"></i></a> Terhubung';
                                    $aktif ='<i class="fa fa-check-circle" data-bs-toggle="tooltip" title="Terhubung"></i>';
                                    $status = '<a href="#" class="btn btn-success btn-sm active" aria-current="page">'.$aktif.'</a>';
                                    }else{
                                    $scan_qr = '<a href="/whatsapp/scanqr_app/'.encrypt_url($row->id).'" class="btn btn-danger bg-danger btn-sm avatar avatar-sm text-white" ><i class="fa fa-qrcode rounded-circle fa-lg text-white"></i></a> Klik untuk memindai';
                                    $aktif = '<i class="fa fa-check-circle-o" data-bs-toggle="tooltip" title="Tidak Terhubung"></i>';
                                    $status = '<a href="#" class="btn btn-secondary btn-sm active" aria-current="page">'.$aktif.'</a>';
                                }
                                $hapus = '<a class="btn btn-danger" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Data</a>';
                            ?>
                            <tr>
                                <td>APP POS</td>
                                <td><a href="javascript:void(0)" class="edit_device" data-id="<?=encrypt_url($row->id);?>" data-idp="<?=($row->id_pengaturan);?>" token-id="<?=$row->token?>"><?=$row->device;?></a></td>
                                <td><?=$scan_qr ?></td>
                                <td><?=$row->expired?></td>
                                <td>Unlimited</td>
                                <td>Berbayar</td>
                                <td class='text-right'><div class='btn-group'><button type='button' class='btn btn-primary btn-sm cek_status_app'  idp='<?=$row->id_pengaturan;?>' token-id='<?=$row->token?>' device-id='<?=$row->device?>' title=''>Cek Status</button></td>
                                    <td align="right">
                                        <div class="btn-group btn-group-sm">
                                            <?=$status;?>
                                            <a href='javascript:void(0);' class="btn btn-primary edit_device"  data-id='<?=$kode;?>' data-idp="<?=$row->id_pengaturan;?>" class='openPopup text-info'><i class="ti ti-edit"></i>&nbsp;&nbsp;Edit</a>
                                            <?=$hapus;?>
                                        </div>
                                    </td>
                                </tr>
                                
                                <?php
                                    }else{
                                    if ($row->device_status == 'connect') {
                                        $device_status = 'Terhubung';
                                        $device_btn = 'success';
                                        $scan_qr = 'logout_qr';
                                        $aktif ='<i class="fa fa-check-circle" data-bs-toggle="tooltip" title="Terhubung"></i>';
                                        $status = '<a href="#" class="btn btn-success btn-sm active" aria-current="page">'.$aktif.'</a>';
                                        }else{
                                        $device_btn = 'danger';
                                        $scan_qr = 'scan_qr';
                                        $device_status = 'Click to scan';
                                        $aktif = '<i class="fa fa-check-circle-o" data-bs-toggle="tooltip" title="Tidak Terhubung"></i>';
                                        $status = '<a href="#" class="btn btn-secondary btn-sm active" aria-current="page">'.$aktif.'</a>';
                                    }
                                    
                                    $hapus = '<a class="btn btn-danger" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Data</a>';
                                    
                                    ?>
                                    <tr>
                                        <td><?=$row->name;?></td>
                                        <td><a href="javascript:void(0)" class="edit_device" data-id="<?=$kode?>" data-idp="<?=($row->id_pengaturan);?>" ><?=$row->device?></a></td>
                                        <td><button type="button" class="btn  btn-<?=$device_btn;?> btn-sm bg-<?=$device_btn;?> avatar avatar-sm  <?=$scan_qr;?>" token-id="<?=$row->token;?>" title="<?=$device_status ?>"><i class="fa fa-qrcode rounded-circle fa-lg text-white"></i></button>&nbsp;&nbsp;<?=$device_status?>
                                        </td>
                                        <td><?=$row->expired;?></td>
                                        <td><?=$row->quota;?></td>
                                        <td><?=$row->package;?></td>
                                        <td><button type="button" class="btn btn-info btn-sm cek_status" token-id="<?=$row->token;?>" title="">Cek Status</button>
                                        </td>
                                        <td align="right">
                                            <div class="btn-group btn-group-sm">
                                                <?=$status;?>
                                                <a href='javascript:void(0);' class="btn btn-primary edit_device"  data-id='<?=$kode;?>' data-idp="<?=$row->id_pengaturan;?>" class='openPopup text-info'><i class="ti ti-edit"></i>&nbsp;&nbsp;Edit</a>
                                                <?=$hapus;?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    $no++;
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
        