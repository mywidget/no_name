<div id="posts_content">
    <?php if(!empty($record)){ ?>
        <div class="table-responsive">
            <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                <thead class="thead-dark">
                  	<tr>
                        <th class="w-1 text-center">No</th>
                        <th class="w-15 text-left">Title</th>
                        <th class="w-15 text-left">Link FIle</th>
                        <th class="w-15 text-left">Tanggal</th>
                        <th class="w-12 text-end">Status | Aksi</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                        $no = 1;
                        foreach ($record as $row){
                            $kode = encrypt_url($row['id']);
                            
                            if ($row['aktif'] == 'Y')
                            { 
                                $aktif ='<i class="fa fa-check-circle" data-bs-toggle="tooltip" title="Aktif"></i>';
                                $status = '<a href="#" class="btn btn-success btn-sm active" aria-current="page">'.$aktif.'</a>';
                                }else{ 
                                $aktif = '<i class="fa fa-check-circle-o" data-bs-toggle="tooltip" title="Tikda Aktif"></i>';
                                $status = '<a href="#" class="btn btn-secondary btn-sm active" aria-current="page">'.$aktif.'</a>';
                            }
                            $hapus = '<a class="btn btn-danger" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Data</a>';
                            
                        ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=$row['title'];?></td>
                            <td><?=base_url('download-file').'/'.$row['nama_file'];?></td>
                            <td><?=$row['create_date'];?></td>
                            <td align="right">
                                <div class="btn-group btn-group-sm">
                                    <?=$status;?>
                                    <a href='javascript:void(0);' class="btn btn-primary" data-bs-toggle='modal' data-bs-target='#OpenModal' data-id='<?=$kode;?>' data-mod='edit' class='openPopup text-info'><i class="ti ti-edit"></i>&nbsp;&nbsp;Edit</a>
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
