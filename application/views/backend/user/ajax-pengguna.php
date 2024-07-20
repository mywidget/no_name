<div id="posts_content">
    <?php if(!empty($record)){ ?>
        <div class="posts_list">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead class="thead-dark">
                  	<tr>
                        <th class="w-1 text-center">No</th>
                        <th class="w-15 text-left">Nama Lengkap</th>
                        <th class="w-15 text-left">Nama Pengguna</th>
                        <th class="w-15 text-left">Tanggal Input</th>
                        <th class="w-15 text-left">Level</th>
                        <th class="w-12 text-end">Status | Aksi</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                        $no = 1;
                        foreach ($record as $row){
                            if ($row['level'] == 'admin'){ 
                                $hapus = '<a class="btn btn-danger" data-id="'.$row['id_user'].'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</a>';
                                }else{ 
                                $hapus = '<a class="btn btn-danger" data-id="'.$row['id_user'].'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus</a>';
                            }
                            if ($row['aktif'] == 'Y'){ $aktif ='<i class="fa fa-check-circle" data-bs-toggle="tooltip" title="Aktif"></i>'; }else{ $aktif = '<i class="fa fa-check-circle-o" data-bs-toggle="tooltip" title="Tikda Aktif"></i>'; }
                            $kode = encrypt_url($row['id_user']);
                        ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=$row['nama_lengkap'];?></td>
                            <td><?=$row['email'];?></td>
                            <td><?=indo_date($row['tgl_daftar']);?></td>
                            <td><span class="badge badge-success flat"><?=$row['level'];?></span></td>
                            <td align="right">
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-primary btn-sm active" aria-current="page"><?=$aktif;?></a>
                                    <a href='javascript:void(0);' class="btn btn-primary" data-bs-toggle='modal' data-bs-target='#OpenModalUser' data-id='<?=encrypt_url($row['id_user']);?>' data-mod='edit' class='openPopup text-info'><i class="ti ti-edit"></i>&nbsp;&nbsp;Edit</a>
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