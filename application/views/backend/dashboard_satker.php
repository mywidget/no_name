<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Dashboard
                    </div>
                    <h2 class="page-title">
                        <?=$menu;?>
                    </h2>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="">
                <div class="row g-0">
                    
                    <div class="col d-flex flex-column">
                        
                        <div class="card-body">
                            <div class="row row-cards">
                                <?php 
                                    $nomor=0;
                                    $typeakses=$this->session->typeakses;
                                    foreach($kategori AS $row){
                                        $tag = strtoupper($row->tag);
                                        $dash = strtoupper($row->dash);
                                        $idmaster = $row->id_master;
                                        if(empty($idmaster)){
                                            $stok = $this->model_mutasi->real_stok_tag_divisi($tag,$satker);
                                            }else{
                                            $stok = $this->model_mutasi->real_stok_id_divisi($idmaster,$satker);
                                        }
                                        $nomor++;
                                        
                                        if ($nomor == 1 OR $nomor == 4 OR $nomor == 7 OR $nomor == 10){
                                            $warna_belakang = "bg-primary";
                                            }elseif($nomor == 2 OR $nomor == 5 OR  $nomor == 8 OR $nomor == 11){
                                            $warna_belakang = "bg-warning";
                                            }elseif($nomor == 3 OR $nomor == 6 OR  $nomor == 9 OR $nomor == 12){
                                            $warna_belakang = "bg-success";
                                            }else{
                                            $warna_belakang = "bg-danger";
                                        }
                                        $col =4;
                                        if ($nomor == 13){
                                            $col = 12;
                                        }
                                        
                                        $cc_tag = $this->db->query("SELECT slug FROM type_akses where id IN($typeakses)")->result();
                                        foreach($cc_tag AS $val){
                                            if($dash==strtoupper($val->slug)){
                                                $modal ='';
                                                $target ='';
                                                $mod ='';
                                                if($row->detail==1){
                                                    $target = cleans(strtolower($row->title));
                                                    $modal = 'data-bs-toggle="modal" data-bs-target="#'.$target.'"';
                                                    $mod ='stok';
                                                }
                                            ?>
                                            <div class="col-sm-6 col-lg-<?=$col;?>">
                                                <div class="card card-sm <?=$mod;?> <?=$warna_belakang;?>" <?=$modal;?> >
                                                    <div class="card-body">
                                                        <div class="row g-2 align-items-center">
                                                            <div class="col-auto">
                                                                <span class="jump-response text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                        <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                                                        <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                                                        <path d="M9 8h6"></path>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <div class="col">
                                                                <div class="font-weight-medium text-white">
                                                                    <?=$row->title;?>
                                                                </div>
                                                                <div class="text-white">
                                                                    <?=rp($stok);?>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <a href="fasmat/detail/<?=strtolower($row->dash);?>" class="btn">
                                                                    Input
                                                                </a>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php 
                                            } 
                                        }
                                    } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">GRAFIK PENGGUNAAN MATERIEL</div>
                                    <div class="ms-auto lh-1">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <a href="#" class="link-secondary">
                                                    <i class="ti ti-calendar fa-lg"></i>
                                                </a>
                                            </span>
                                            <input type="text" id="tanggal_materiel" class="form-control w-30 tanggal" value="<?=$tanggal;?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <div class="h1 mb-0 me-2" id="load_total_materiel_satker">0</div>
                                    
                                </div>
                            </div>
                            <div id="chart_penggunaan_satker" class="p-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    //stok_awal R2
    $master_r2 = idform('52,53,54,55');
    $r2_hitam = stok_awal_divisi_tnkb($master_r2['hitam'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    $r2_putih = stok_awal_divisi_tnkb($master_r2['putih'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    $r2_merah = stok_awal_divisi_tnkb($master_r2['merah'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    $r2_kuning = stok_awal_divisi_tnkb($master_r2['kuning'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    //stok_awal R4
    $master_r4 = idform('0,58,60,59');
    $r4_hitam = stok_awal_divisi_tnkb($master_r4['hitam'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    $r4_putih = stok_awal_divisi_tnkb($master_r4['putih'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    $r4_merah = stok_awal_divisi_tnkb($master_r4['merah'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    $r4_kuning = stok_awal_divisi_tnkb($master_r4['kuning'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    //stok_awal R2L
    $master_r2l = idform('133,125,126,127');
    $r2l_hitam = stok_awal_divisi_tnkb($master_r2l['hitam'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    $r2l_putih = stok_awal_divisi_tnkb($master_r2l['putih'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    $r2l_merah = stok_awal_divisi_tnkb($master_r2l['merah'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    $r2l_kuning = stok_awal_divisi_tnkb($master_r2l['kuning'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    //stok_awal R4L
    $master_r4l = idform('128,0,129,130');
    $r4l_hitam = stok_awal_divisi_tnkb($master_r4l['hitam'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    $r4l_putih = stok_awal_divisi_tnkb($master_r4l['putih'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    $r4l_merah = stok_awal_divisi_tnkb($master_r4l['merah'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    $r4l_kuning = stok_awal_divisi_tnkb($master_r4l['kuning'],$divisi,$dari,$sampai)['stok_awal_divisi'];
    
?>
<div class="modal fade left" id="tnkb_r2" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">TNKB R2</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-indigo-lt">
                <div class="col-sm-12 col-lg-12 mb-3 border-0">
                    <div class="card card-sm">
                        <div class="card-body bg-white p-3">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-black avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                            <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                            <path d="M9 8h6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fs-h1 text-black">
                                        <?=rp($r2_putih);?>
                                    </div>
                                    <div class="fs-h3 text-black">
                                        PUTIH
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12 mb-3">
                    <div class="card card-sm border-0">
                        <div class="card-body bg-danger">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-black avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                            <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                            <path d="M9 8h6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fs-h1 text-white">
                                        <?=rp($r2_merah);?>
                                    </div>
                                    <div class="fs-h3 text-white">
                                        MERAH
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12">
                    <div class="card card-sm border-0">
                        <div class="card-body bg-yellow">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-black avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                            <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                            <path d="M9 8h6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fs-h1 text-black">
                                        <?=rp($r2_kuning);?>
                                    </div>
                                    <div class="fs-h3 text-black">
                                        KUNING
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade left" id="tnkb_r4" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">TNKB R4</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-indigo-lt">
                <div class="col-sm-12 col-lg-12 mb-3 border-0">
                    <div class="card card-sm">
                        <div class="card-body bg-white p-3">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-black avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                            <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                            <path d="M9 8h6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fs-h1 text-black">
                                        <?=rp($r4_putih);?>
                                    </div>
                                    <div class="fs-h3 text-black">
                                        PUTIH
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12 mb-3">
                    <div class="card card-sm border-0">
                        <div class="card-body bg-danger">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-black avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                            <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                            <path d="M9 8h6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fs-h1 text-white">
                                        <?=rp($r4_merah);?>
                                    </div>
                                    <div class="fs-h3 text-white">
                                        MERAH
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12">
                    <div class="card card-sm border-0">
                        <div class="card-body bg-yellow">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-black avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                            <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                            <path d="M9 8h6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fs-h1 text-black">
                                        <?=rp($r4_kuning);?>
                                    </div>
                                    <div class="fs-h3 text-black">
                                        KUNING
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade left" id="tnkb_r2_listrik" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">TNKB R2 LISTRIK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-indigo-lt">
                <div class="col-sm-12 col-lg-12 mb-3 border-0">
                    <div class="card card-sm">
                        <div class="card-body bg-black p-3">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-black avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                            <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                            <path d="M9 8h6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fs-h1 text-white">
                                        <?=rp($r2l_putih);?>
                                    </div>
                                    <div class="fs-h3 text-white">
                                        HITAM
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12 mb-3">
                    <div class="card card-sm border-0">
                        <div class="card-body bg-danger">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-black avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                            <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                            <path d="M9 8h6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fs-h1 text-white">
                                        <?=rp($r2l_merah);?>
                                    </div>
                                    <div class="fs-h3 text-white">
                                        MERAH
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12">
                    <div class="card card-sm border-0">
                        <div class="card-body bg-yellow">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-black avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                            <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                            <path d="M9 8h6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fs-h1 text-black">
                                        <?=rp($r2l_kuning);?>
                                    </div>
                                    <div class="fs-h3 text-black">
                                        KUNING
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade left" id="tnkb_r4_listrik" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">TNKB R4 LISTRIK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-indigo-lt">
                <div class="col-sm-12 col-lg-12 mb-3 border-0">
                    <div class="card card-sm">
                        <div class="card-body bg-black p-3">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-black avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                            <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                            <path d="M9 8h6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fs-h1 text-white">
                                        <?=rp($r4l_hitam);?>
                                    </div>
                                    <div class="fs-h3 text-white">
                                        HITAM
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12 mb-3">
                    <div class="card card-sm border-0">
                        <div class="card-body bg-danger">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-black avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                            <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                            <path d="M9 8h6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fs-h1 text-white">
                                        <?=rp($r4l_merah);?>
                                    </div>
                                    <div class="fs-h3 text-white">
                                        MERAH
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12">
                    <div class="card card-sm border-0">
                        <div class="card-body bg-yellow">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-black avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="128" height="128" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                            <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                            <path d="M9 8h6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fs-h1 text-black">
                                        <?=rp($r4l_kuning);?>
                                    </div>
                                    <div class="fs-h3 text-black">
                                        KUNING
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
    .stok{cursor:pointer}
</style>
<script>
    $('#tanggal_materiel').daterangepicker({
        ranges: {
            'Hari ini': [moment(), moment()],
            'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '7 Hari terakhir': [moment().subtract(6, 'days'), moment()],
            '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
            'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
            'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "alwaysShowCalendars": true,
        timePicker: false,
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
    
    $('#tanggal_materiel').on('apply.daterangepicker', function(ev, picker) {
        load_materiel();load_total_materiel();
    });
    
    $('#tanggal_satker').daterangepicker({
        ranges: {
            'Hari ini': [moment(), moment()],
            'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '7 Hari terakhir': [moment().subtract(6, 'days'), moment()],
            '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
            'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
            'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "alwaysShowCalendars": true,
        timePicker: false,
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
    
</script>
