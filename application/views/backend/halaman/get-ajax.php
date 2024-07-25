<?php if(!empty($record)){ ?>
    <div class="table-responsive">
        <table class="table card-table table-vcenter table-striped text-nowrap datatable">
            <thead class="thead-dark">
                <tr>
                    <th class="w-1 text-center">No</th>
                    <th class="w-15 text-left">Title</th>
                    <th class="w-15 text-left">Tanggal</th>
                    <th class="w-12 text-end">Status | Aksi</th>
                </tr>
            </thead>  
            <tbody> 
                <?php 
                    $i = 0;
                    $no = 1;
                    foreach ($record as $row){
                        $kode = encrypt_url($row['id']);
                        if ($row['aktif'] == 'Ya')
                        { 
                            $aktif ='<i class="fa fa-check-circle"></i>';
                            $status = '<a href="javascript:void(0)" class="btn btn-success btn-sm nonaktifkan" aria-current="page" data-id="'.$kode.'" data-aktif="Tidak" data-bs-toggle="tooltip" data-trigger="hover" title="Aktif">'.$aktif.'</a>';
                            }else{ 
                            $aktif = '<i class="fa fa-check-circle-o"></i>';
                            $status = '<a href="javascript:void(0)" class="btn btn-secondary btn-sm aktifkan" aria-current="page" data-id="'.$kode.'" data-aktif="Ya" data-bs-toggle="tooltip" data-trigger="hover" title="Tidak Aktif">'.$aktif.'</a>';
                        }
                        $hapus = '<a class="btn btn-danger" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Data</a>';
                        
                    ?>
                    <tr>
                        <td><?=$no;?></td>
                        <td><?=$row['title'];?></td>
                        <td><?=indo_date($row['create_date']);?></td>
                        <td align="right">
                            <div class="btn-group btn-group-sm">
                                <?=$status;?>
                                <a href='javascript:void(0);' class="btn btn-primary" data-bs-toggle='modal' data-bs-target='#OpenModal' data-id='<?=$kode;?>' data-mod='edit' class='openPopup text-info'><i class="ti ti-edit"></i>&nbsp;&nbsp;Edit</a>
                                <?=$hapus;?>
                            </div>
                        </td>
                    </tr>
                    <?php $no++;$i++;
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

<script>
    
    $(document).ready(function(){
        $('.aktifkan').tooltip({
            template: '<div class="tooltip svg__icon_c_tooltip_right" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
            title: 'Aktifkan',
            html: true,
            placement: 'left',
            delay: 250
        });
        
        $('.nonaktifkan').tooltip({
            template: '<div class="tooltip svg__icon_c_tooltip_right" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
            title: 'Nonaktifkan',
            html: true,
            placement: 'left',
            delay: 250
        });
    });
    
    $('.aktifkan, .nonaktifkan').on('shown.bs.tooltip', function() {
        $(this).attr('data-tooltip', 'loaded');
    });
    
    $('.aktifkan, .nonaktifkan').on('hide.bs.tooltip', function() {
        $(this).attr('data-tooltip', 'hidden');
    });
    
    $('.aktifkan, .nonaktifkan').on('click', function() {
        var _tooltip = $(this).attr('data-tooltip');
        
        switch(_tooltip) {
            case 'loaded':
            if ($(this).next().hasClass('tooltip')) {
                $(this).tooltip('hide');
                } else {
                $(this).tooltip('show');
            }
            break;
            case 'hidden':
            $(this).tooltip('show');
            break;
        }
    });
    
</script>    