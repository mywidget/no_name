<?php if(!empty($record)){ ?>
    <form method="post" id="update_form">
        <div class="table-responsive" style="min-height: 300px;">
            <table class="table card-table table-vcenter table-striped text-nowrap datatable" id="tablein">
                <thead class="thead-dark">
                    <tr>
                        <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" id="selectAll" aria-label="Select all invoices"></th>
                        <th class="w-1 text-center">No</th>
                        <th class="w-15 text-left">Tgl. Daftar</th>
                        <th class="w-15 text-left">Thn. Akademik</th>
                        <th class="w-15 text-left">Nama Lengkap</th>
                        <th class="w-15 text-left">NISN</th>
                        <th class="w-15 text-left">Unit</th>
                        <th class="w-15 text-left">Kelas </th>
                        <th class="w-12 text-end">Status | Print | Aksi</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                        $i = 0;
                        $no = 1;
                        foreach ($record as $row){
                            $kode = encrypt_url($row['id']);
                            $link = base_url('pendaftar').'/print_dokumen/'.$kode;
                            if($row['status']=='Baru'){
                                $icon = '<i class="fa fa-file-text"></i>&nbsp;Baru';
                                $color = 'secondary';
                                }elseif($row['status']=='Proses'){
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
                            
                            $edit ="<a href='javascript:void(0);' class='dropdown-item text-info' data-bs-toggle='modal' data-bs-target='#OpenModalUser' data-id='".$kode."' data-mod='edit' class='openPopup text-info'><i class='ti ti-edit'></i>&nbsp;&nbsp;Edit Data</a>";
                            
                            $status = '<a class="btn btn-'.$color.' btn-sm flat" data-id="'.$kode.'">'.$icon.'</a>';
                            
                            $print = '<a class="btn btn-primary btn-sm flat" data-id="'.$kode.'" href="'.$link.'" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</a>';
                            
                            if(getKelas($row['kelas']) != false){
                                $kode_kelas = getKelas($row['kelas'])->kode_kelas;
                                }else{
                                $kode_kelas = $row['kelas'];
                                
                            }
                        ?>
                        <tr>
                            <td><input class="form-check-input m-0 align-middle case" type="checkbox" name="pilih[]" id="case<?=$i;?>" value="<?=$i;?>">
                                <input type='hidden' id='id_<?=$i;?>' name='id[<?=$i;?>]' value="<?=$kode;?>" />
                                <input type='hidden' id='biaya_daftar_<?=$i;?>' name='biaya_daftar[<?=$i;?>]' value="<?=$row['biaya_daftar'];?>" />
                                <input type='hidden' id='tahun_akademik_<?=$i;?>' name='tahun_akademik[<?=$i;?>]' value="<?=$row['tahun_akademik'];?>" />
                                <input type='hidden' id='kode_daftar_<?=$i;?>' name='kode_daftar[<?=$i;?>]' value="<?=$row['kode_daftar'];?>" />
                            </td>
                            <td><?=$no;?></td>
                            <td><?=indo_date($row['tanggal_daftar']);?></td>
                            <td><?=$row['tahun_akademik'];?></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?=$row['nama'];?>
                                    </button>
                                    <ul class="dropdown-menu" style="">
                                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="withoutJquery(<?=$i;?>);" data-bs-toggle="tooltips" data-bs-placement="top" title="Click to copy">Kode Pendaftaran : <span id="copyText<?=$i;?>"><?=$row['kode_daftar'];?></span></a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="withoutJquery('<?=$i;?>_<?=$i;?>');" data-bs-toggle="tooltips" data-bs-placement="top" title="Click to copy">Tanggal lahir : <span id="copyText<?=$i;?>_<?=$i;?>"><?=$row['tanggal_lahir'];?></span></a></li>
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
                                        <li><a class="dropdown-item" href="#">Kelas : <?=$kode_kelas;?></a></li>
                                        <li><a class="dropdown-item" href="#">Nama Kelas : <?=getKelas($row['kelas'])->nama_kelas;?></a></li>
                                        <li><a class="dropdown-item" href="#">Biaya Pendaftaran : <?=rprp($row['biaya_daftar']);?></a></li>
                                    </ul>
                                </div>
                            </td>
                            <td><?=$kode_kelas;?></td>
                            <td align="right">
                                <div class="btn-group btn-sm flat bg-danger">
                                    <?=$status;?>
                                    <?=$print;?>
                                    
                                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu"  data-popper-placement="right-start">
                                    <li><?=$edit;?></li>
                                        <li><a class="dropdown-item"  href="javascript:void(0)" onclick="load_lampiran('<?=$kode;?>','<?=$row['foto'];?>')"><i class="fa fa-image" ></i>&nbsp;&nbsp;Foto Pendaftar</a></li>
                                        <li><a class="dropdown-item"  href="javascript:void(0)" onclick="load_lampiran('<?=$kode;?>','<?=$row['foto_kk'];?>')"><i class="fa fa-image" ></i>&nbsp;&nbsp;Lampiran KK</a></li>
                                        <li><a class="dropdown-item"  href="javascript:void(0)" onclick="load_lampiran('<?=$kode;?>','<?=$row['fotobukti'];?>')"><i class="fa fa-image" ></i>&nbsp;&nbsp;Bukti Transfer</a></li>
                                        <?php if(!empty($row['surat'])){ ?>
                                            <li><a class="dropdown-item"  href="javascript:void(0)" onclick="load_lampiran('<?=$kode;?>','<?=$row['surat'];?>')" data-bs-toggle="tooltips" aria-label="Clear search" data-bs-placement="left" title="Lampiran surat"><i class="fa fa-image" ></i>&nbsp;&nbsp;Lampiran Surat</a></li>
                                            <?php }else{ ?>
                                            <li><a class="dropdown-item"  href="javascript:void(0)" data-bs-toggle="tooltips" aria-label="Clear search" data-bs-placement="left" title="Belum ada lampiran"><i class="fa fa-image" ></i>&nbsp;&nbsp;Lampiran Surat</a></li>
                                        <?php } ?>
                                        
                                        <?php if($row['status']=='Tidak Diterima'){ ?>
                                            <li><?=$hapus;?></li>
                                        <?php } ?>
                                        <!--li><hr class="dropdown-divider"></li-->
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php $no++;$i++;
                        }
                    ?>
                </tbody>  
            </table>  
        </div>
    </form>
    <div class="p-2">
        <?php echo $this->ajax_pagination->create_links(); ?>
    </div>
    
    <script>
       
        $(document).ready(function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltips"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>    
    <?php }else{echo "Belum ada data";} ?>