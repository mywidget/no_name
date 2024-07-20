<div id="posts_content_kelas">
    <?php if(!empty($record)){ ?>
        <div class="table-responsive">
            <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                <thead class="thead-dark">
                  	<tr>
                        <th class="w-1 text-center">No</th>
                        <th class="w-15 text-left">Pekerjaan</th>
                        <th class="w-12 text-end">Aksi</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                        $no = $start + 1;
                        foreach ($record as $row){
                            $kode = encrypt_url($row['id']);
                            
                            $hapus = '<a class="btn btn-danger" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#confirm-delete-pekerjaan" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Data</a>';
                             
                        ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=$row['title'];?></td>
                            <td align="right">
                                <div class="btn-group btn-group-sm">
                                    <a href='javascript:void(0);' class="btn btn-primary" data-bs-toggle='modal' data-bs-target='#OpenModalPekerjaan' data-id='<?=$kode;?>' data-mod='edit' class='openPopup text-info'><i class="ti ti-edit"></i>&nbsp;&nbsp;Edit</a>
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
<script>
    $(document).ready(function(){
        $('.openPopup').on('click',function(){
            var dataURL = $(this).attr('data-href');
            $('.modal-body1').load(dataURL,function(){
                $('#myModalEdit').modal({show:true});
            });
        }); 
    });    
</script>    