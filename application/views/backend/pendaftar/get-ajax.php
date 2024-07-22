<div id="posts_content">
    <?php if(!empty($record)){ ?>
        <div class="table-responsive">
            <table class="table card-table table-vcenter table-striped text-nowrap datatable">
                <thead class="thead-dark">
                  	<tr>
                        <th class="w-1 text-center">No</th>
                        <th class="w-15 text-left">Tgl. Daftar</th>
                        <th class="w-15 text-left">Thn. Akademik</th>
                        <th class="w-15 text-left">Nama Lengkap</th>
                        <th class="w-15 text-left">NISN</th>
                        <th class="w-15 text-left">Unit</th>
                        <th class="w-15 text-left">Kelas </th>
                        <th class="w-12 text-end">Status | Aksi</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                        $no = 1;
                        foreach ($record as $row){
                            $kode = encrypt_url($row['id']);
                            if($row['status']=='Proses'){
                                $icon = '<i class="fa fa-spinner"></i>&nbsp;Proses';
                                $color = 'warning';
                                }elseif($row['status']=='Diterima'){
                                $icon = '<i class="fa fa-check"></i>&nbsp;Diterima';
                                $color = 'success';
                                }else{
                                $icon = '<i class="fa fa-times"></i>&nbsp;Ditolak';
                                $color = 'danger';
                            }
                            
                            $hapus = '<a class="dropdown-item text-danger" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Data</a>';
                            
                            $edit ="<a href='javascript:void(0);' class='dropdown-item text-info' data-bs-toggle='modal' data-bs-target='#OpenModalUser' data-id='<?=$kode;?>' data-mod='edit' class='openPopup text-info'><i class='ti ti-edit'></i>&nbsp;&nbsp;Edit Data</a>";
                            
                            $status = '<a class="btn btn-'.$color.' btn-sm flat" data-id="'.$kode.'">'.$icon.'</a>';
                            
                            $print = '<a class="btn btn-primary btn-sm flat" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#confirm-delete" href="#"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a>';
                            
                            $foto = '<a class="dropdown-item" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#foto" href="#"><i class="fa fa-image"></i>&nbsp;&nbsp;Foto Pendaftar</a>';
                            $foto_kk = '<a class="dropdown-item" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#foto_kk" href="#"><i class="fa fa-image"></i>&nbsp;&nbsp;Lampiran KK</a>';
                            $transfer = '<a class="dropdown-item" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#foto_kk" href="#"><i class="fa fa-image"></i>&nbsp;&nbsp;Lampiran Transfer</a>';
                            $surat = '<a class="dropdown-item" data-id="'.$kode.'" data-bs-toggle="modal" data-bs-target="#surat" href="#"><i class="fa fa-image"></i>&nbsp;&nbsp;Lampiran Surat</a>';
                            
                        ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=indo_date($row['tanggal_daftar']);?></td>
                            <td><?=$row['tahun_akademik'];?></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?=$row['nama'];?>
                                    </button>
                                    <ul class="dropdown-menu" style="">
                                        <li><a class="dropdown-item" href="#">Kode Pendaftaran : <?=$row['kode_daftar'];?></a></li>
                                        <li><a class="dropdown-item" href="#">Email : <?=$row['email'];?></a></li>
                                        <li><a class="dropdown-item" href="#">Jenis Kelamin : <?=$row['jenis_kelamin'];?></a></li>
                                        <li><a class="dropdown-item" href="#">No. HP : <?=$row['nomor_hp'];?></a></li>
                                        <li><a class="dropdown-item" href="#">UK. Baju : <?=$row['ukuran_seragam_baju'];?></a></li>
                                        <li><a class="dropdown-item" href="#">UK. Celana/Rok : <?=$row['ukuran_celana_rok'];?></a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#">Ayah : <?=$row['nama_ayah'];?></a></li>
                                        <li><a class="dropdown-item" href="#">NIK Ayah : <?=$row['nik_ayah'];?></a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#">Ibu : <?=$row['nama_ibu'];?></a></li>
                                        <li><a class="dropdown-item" href="#">NIK Ibu : <?=$row['nik_ibu'];?></a></li>
                                        
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?=$row['nisn'];?>
                                    </button>
                                    <ul class="dropdown-menu" style="">
                                        <li><a class="dropdown-item" href="#">NIK : <?=$row['nik'];?></a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?=$row['unit_sekolah'];?>
                                    </button>
                                    <ul class="dropdown-menu" style="">
                                        <li><a class="dropdown-item" href="#">Kelas : <?=getKelas($row['kelas']);?></a></li>
                                        <li><a class="dropdown-item" href="#">Biaya Pendaftaran : <?=$row['biaya_daftar'];?></a></li>
                                    </ul>
                                </div>
                            </td>
                            <td><?=getKelas($row['kelas']);?></td>
                            <td align="right">
                                <div class="btn-group btn-sm flat bg-danger">
                                    <?=$status;?>
                                    <?=$print;?>
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split bg-danger" data-bs-toggle="dropdown" aria-expanded="true">
                                        <span class="visually-hidden">Toggle Dropright</span>
                                    </button>
                                    <ul class="dropdown-menu"  data-popper-placement="right-start">
                                        <li><?=$foto;?></li>
                                        <li><?=$foto_kk;?></li>
                                        <li><?=$transfer;?></li>
                                        <li><?=$surat;?></li>
                                        <li><?=$edit;?></li>
                                        <li><?=$hapus;?></li>
                                        <!--li><hr class="dropdown-divider"></li-->
                                    </ul>
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