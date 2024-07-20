<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link rel="icon" type="image/x-icon" href="<?= base_url('upload/'); ?><?=info()['favicon'];?>">
        <meta http-equiv="refresh" content="<?=$grafik;?>" />
        <title><?=$title;?></title>
        <style>
            @import url('https://rsms.me/inter/inter.css');
            :root {
            --tblr-font-sans-serif: Inter,-apple-system,BlinkMacSystemFont,San Francisco,Segoe UI,Roboto,Helvetica Neue,sans-serif !important;
            }
        </style>
        <link href="<?=base_url();?>assets/backend/css/tabler.min.css" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/css/tabler-flags.min.css" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/css/tabler-payments.min.css" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/css/tabler-vendors.min.css" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/css/demo.min.css" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/fontawesome/css/font-awesome.css" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/iconfont/tabler-icons.min.css" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/libs/select2/dist/css/select2.min.css" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/libs/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/libs/selectize/css/selectize.css" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/libs/icon-picker/simple-iconpicker.css" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/libs/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/libs/alertify/css/alertify.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/backend/css/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/backend/libs/daterangepicker/daterangepicker.css"/>
        <link rel="stylesheet"  type="text/css" href="<?=base_url();?>assets/backend/libs/litepicker/dist/css/litepicker.css?1666304673" defer></link>
        <script src="<?= base_url('assets/'); ?>backend/jquery/jquery.min.js" type="text/javascript"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
        <!-- Tabler Core -->
        <script src="<?= base_url('assets/'); ?>backend/libs/daterangepicker/moment.min.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>backend/libs/jQuery-slimScroll/jquery.slimscroll.js" type="text/javascript"></script>
        <script src="<?=base_url('assets/');?>backend/js/validation.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets/');?>backend/libs/select2/dist/js/select2.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets/');?>backend/libs/datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?=base_url('assets/');?>backend/libs/selectize/js/standalone/selectize.js" type="text/javascript"></script>
        <script src="<?=base_url('assets/');?>backend/libs/alertify/alertify.js" type="text/javascript"></script>
        <script src="<?= base_url('assets/'); ?>backend/libs/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
        <script src="<?= base_url('assets/'); ?>backend/libs/daterangepicker/daterangepicker.js"></script>
        
        <script>
            var my_ip = "<?=$_SERVER['SERVER_NAME']; ?>";
            var base_url = '<?=base_url(); ?>';
            
        </script>
        <script src="<?=base_url('assets/');?>backend/js/custom_grafik.js?r=<?=time();?>" type="text/javascript"></script>
        
    </head>
    <body class="layout-fluid theme-light">
        <script src="<?=base_url('assets/');?>backend/js/demo-theme.min.js?1666304673"></script>
        <div class="page">
            <header class="navbar navbar-expand-md navbar-light d-print-none">
                <div class="container-xl">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                        <a href="/grafik">
                            <img src="<?= base_url('upload/'); ?><?=info()['logo'];?>" width="110" height="32" alt=sifasmat" class="navbar-brand-image">
                        </a>
                    </h1>
                    <div class="navbar-nav flex-row order-md-last">
                        
                        <div class="d-none d-md-flex">
                            <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
                            </a>
                            <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
                            </a>
                            
                        </div>
                        
                    </div>
                </div>
            </header>
            
            <div class="page-body">
                <div class="container-xl">
                    <div class="col d-flex flex-column">
                        <div class="col-12">
                            <div class="row row-cards">
                                <div class="col d-flex flex-column">
                                    
                                    <div class="card-body">
                                        <div class="row">
                                            <?php 
                                                $nomor =0;
                                                foreach($kategori AS $row){
                                                    $tag = strtoupper($row->tag);
                                                    $idmaster = $row->id_master;
                                                    $modal ='';
                                                    $target ='';
                                                    if($row->detail==1){
                                                        $target = cleans(strtolower($row->title));
                                                        $modal = 'data-bs-toggle="modal" data-bs-target="#'.$target.'"';
                                                    }
                                                    if(empty($tag)){
                                                        $stok = $this->model_mutasi->stok_idmaster_gudang($idmaster);
                                                        }else{
                                                        $stok = $this->model_mutasi->stok_tag_gudang($tag);
                                                    }
                                                    $title = 'STOK';
                                                    // $stok = isset($mutasi[$tag]) ? $mutasi[$tag] : 0;
                                                    
                                                    
                                                    $nomor++;
                                                    $col =3;
                                                    if ($nomor == 13){
                                                        $col = 12;
                                                    }
                                                    if ($nomor == 1 OR $nomor == 5 OR $nomor == 9){
                                                        $warna_belakang = "bg-primary";
                                                        }elseif($nomor == 2 OR $nomor == 6 OR  $nomor == 10){
                                                        $warna_belakang = "bg-warning";
                                                        }elseif($nomor == 3 OR $nomor == 7 OR  $nomor == 11){
                                                        $warna_belakang = "bg-success";
                                                        }elseif($nomor == 4 OR $nomor == 8 OR  $nomor == 12){
                                                        $warna_belakang = "bg-danger";
                                                        }else{
                                                        $warna_belakang = "bg-info";
                                                    }
                                                ?>
                                                <div class="card cards card-2 text-center p-3" style="width: 18.5rem;">
                                                    <div class="card-body">
                                                        <a href="#" <?=$modal;?> class="btn btn-primary btn-lg rounded-4 stok mb-2"><?=rp($stok);?></a>
                                                        <h1 class="card-title mt-1"><?=$row->title;?></h1>
                                                    </div>
                                                </div>
                                                
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                </div>
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
                                                <div class="h1 mb-0 me-2" id="load_total_materiel">0</div>
                                                
                                            </div>
                                        </div>
                                        <div id="chart_penggunaan" class="p-3"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="subheader">GRAFIK PENGGUNAAN PER SATUAN KERJA</div>
                                                <div class="ms-auto lh-1">
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <a href="#" class="link-secondary">
                                                                <i class="ti ti-calendar fa-lg"></i>
                                                            </a>
                                                        </span>
                                                        <input type="text" id="tanggal_satker" class="form-control w-30 tanggal" value="<?=$tanggal;?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="chart_satker" class="p-3"></div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .cards {
                margin: 0 auto;
                text-align: center;
                display: -webkit-flex;
                display: flex;
                border-radius: 10px;
                -webkit-justify-content: center; 
                justify-content: center;
                -webkit-flex-wrap: wrap; 
                flex-wrap: wrap;
                margin-top: 15px;
                padding: 1.5%;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box; */
                box-sizing: border-box; */
                box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
                }
                
                .cards:hover {
                box-shadow: 0 4px 10px rgba(0,0,0,0.16), 0 4px 10px rgba(0,0,0,0.23);
                }
                .card-title {
                display: block;
                margin: 0 0 1rem;
                font-size: 2rem;
                line-height: 2rem;
                }
                .stok{
                font-size: 2.5rem;
                }
            </style>
            <?php
                //stok_awal R2
                $master_r2 = idform('52,53,54,55');
                $r2_hitam = stok_awal_divisi_tnkb($master_r2['hitam'],0,$dari,$sampai)['stok_awal_gudang'];
                $r2_putih = stok_awal_divisi_tnkb($master_r2['putih'],0,$dari,$sampai)['stok_awal_gudang'];
                $r2_merah = stok_awal_divisi_tnkb($master_r2['merah'],0,$dari,$sampai)['stok_awal_gudang'];
                $r2_kuning = stok_awal_divisi_tnkb($master_r2['kuning'],0,$dari,$sampai)['stok_awal_gudang'];
                //stok_awal R4
                $master_r4 = idform('0,60,59,58');
                $r4_hitam = stok_awal_divisi_tnkb($master_r4['hitam'],0,$dari,$sampai)['stok_awal_gudang'];
                $r4_putih = stok_awal_divisi_tnkb($master_r4['putih'],0,$dari,$sampai)['stok_awal_gudang'];
                $r4_merah = stok_awal_divisi_tnkb($master_r4['merah'],0,$dari,$sampai)['stok_awal_gudang'];
                $r4_kuning = stok_awal_divisi_tnkb($master_r4['kuning'],0,$dari,$sampai)['stok_awal_gudang'];
                //stok_awal R2L
                $master_r2l = idform('133,125,126,127');
                $r2l_hitam = stok_awal_divisi_tnkb($master_r2l['hitam'],0,$dari,$sampai)['stok_awal_gudang'];
                $r2l_putih = stok_awal_divisi_tnkb($master_r2l['putih'],0,$dari,$sampai)['stok_awal_gudang'];
                $r2l_merah = stok_awal_divisi_tnkb($master_r2l['merah'],0,$dari,$sampai)['stok_awal_gudang'];
                $r2l_kuning = stok_awal_divisi_tnkb($master_r2l['kuning'],0,$dari,$sampai)['stok_awal_gudang'];
                //stok_awal R4L
                $master_r4l = idform('0,129,130,128');
                $r4l_hitam = stok_awal_divisi_tnkb($master_r4l['hitam'],0,$dari,$sampai)['stok_awal_gudang'];
                $r4l_putih = stok_awal_divisi_tnkb($master_r4l['putih'],0,$dari,$sampai)['stok_awal_gudang'];
                $r4l_merah = stok_awal_divisi_tnkb($master_r4l['merah'],0,$dari,$sampai)['stok_awal_gudang'];
                $r4l_kuning = stok_awal_divisi_tnkb($master_r4l['kuning'],0,$dari,$sampai)['stok_awal_gudang'];
                
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
                                                    <?=rp($r4l_putih);?>
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
            
            
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        
                        <div class="col-12 mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0 ">
                                <li class="list-inline-item">
                                    Copyright &copy; 2022
                                    <a href="#" class="link-secondary"><?=info()['footer_web'];?></a>.
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="link-secondary" rel="noopener">
                                        v1.0
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        
        <style>
            .dataTables_wrapper {padding:0 10px 20px 10px}
            .modal.left .modal-dialog,
            .modal.right .modal-dialog {
            position: fixed;
            margin: auto;
            width: 320px;
            height: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
            }
            
            .modal.left .modal-content,
            .modal.right .modal-content {
            height: 100%;
            overflow-y: auto;
            }
            
            .modal.left .modal-body,
            .modal.right .modal-body {
            padding: 15px 15px 80px;
            }
            
            
            
            
            /*Right*/
            .modal.right.fade .modal-dialog {
            right: -320px;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
            -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
            }
            .modal.right.fade.in .modal-dialog {
            right: 0;
            }
            
            /* ----- MODAL STYLE ----- */
            .modal-content {
            border-radius: 0;
            border: none;
            }
            
            .modal-header {
            border-bottom-color: #EEEEEE;
            background-color: #FAFAFA;
            }
            
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
            
            $('#tanggal_satker').on('apply.daterangepicker', function(ev, picker) {
                load_chart()
            });
            
            
        </script>
        <!-- Libs JS -->
        <script src="<?= base_url('assets/'); ?>backend/libs/jquery.loading/jquery.loading.js"></script>
        <script src="<?= base_url('assets/'); ?>backend/libs/sweetalert2/sweetalert2.min.js"></script>
        
        <script src="//cdn.jsdelivr.net/npm/litepicker-polyfills-ie11/dist/index.js" defer></script>
        <script src="<?=base_url();?>assets/backend/libs/litepicker/dist/bundle.js?1666304673" defer></script>
        <script src="<?=base_url();?>assets/backend/libs/apexcharts/dist/apexcharts.js" defer></script>
        <script src="<?=base_url();?>assets/backend/js/tabler.min.js" defer></script>
        <script src="<?=base_url();?>assets/backend/js/demo.min.js" defer></script>
        <script src="<?=base_url();?>assets/backend/js/grafik_chart.js" defer></script>
        
        <script src="<?=base_url();?>assets/backend/libs/icon-picker/simple-iconpicker.js" defer></script>
        <script type="text/javascript" src="<?=base_url();?>assets/backend/js/datatables.min.js"></script>
        <script>
            
            function get_random_color() {
                var letters = '0123456789ABCDEF'.split('');
                var color = '#';
                for (var i = 0; i < 6; i++ ) {
                    color += letters[Math.round(Math.random() * 15)];
                }
                return color;
            }
            $(".jump-response").each(function() {
                $(this).css("background-color", get_random_color());
            });
        </script>
        
    </body>
</html>                                                                                                                                                