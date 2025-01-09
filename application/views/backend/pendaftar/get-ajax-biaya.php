<?php if(!empty($record)){ ?>
    
    <div class="table-responsive" style="min-height: 300px;">
        <table class="table card-table table-vcenter table-striped text-nowrap datatable" id="tablein">
            <thead class="thead-dark">
                <tr>
                    <th class="w-1 text-center">No</th>
                    <th class="w-15 text-left">Title</th>
                    <th class="w-15 text-left">Thn. Akademik</th>
                    <th class="w-15 text-left">Unit</th>
                    <th class="w-15 text-left">Kategori</th>
                    <th class="w-15 text-left">Amount</th>
                    <th class="w-12 text-end">Aksi</th>
                </tr>
            </thead>  
            <tbody> 
                <?php 
                    $i = 0;
                    $no = 1;
                    foreach ($record as $row){
                        $kode = encrypt_url($row['id_biaya']);
                        $hapus = '<a class="btn btn-danger" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>Hapus Data</a>';
                        $edit ="<a href='javascript:void(0);' class='btn btn-success edit_biaya' data-id='".$kode."' class='openPopup text-info'><i class='ti ti-edit'></i> Edit Data</a>";
                    ?>
                    <tr>
                        
                        <td><?=$no;?></td>
                        <td><?=$row['title'];?></td>
                        <td><?=$row['tahun_akademik'];?></td>
                        <td><?=$row['nama_jurusan'];?></td>
                        <td><?=$row['kategori'];?></td>
                        <td><?=rprp($row['amount']);?></td>
                        
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <?=$edit.$hapus;?>
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
    
<?php }else{echo "Belum ada data";} ?>