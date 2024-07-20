<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link rel="icon" type="image/x-icon" href="<?= base_url('upload/'); ?><?=info('site_favicon');?>">
        <title><?=$title;?></title>
        <style>
            @import url('https://rsms.me/inter/inter.css');
            :root {
            --tblr-font-sans-serif: Inter,-apple-system,BlinkMacSystemFont,San Francisco,Segoe UI,Roboto,Helvetica Neue,sans-serif !important;
            }
        </style>
        <!-- CSS files -->
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
            var level = '<?=$this->session->level; ?>';
            // var baseurl = 
        </script>
        <script src="<?=base_url('assets/');?>backend/js/custom.js?r=<?=time();?>" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/backend/libs/tinymce/tinymce.min.js?1668287865" defer></script>
    </head>
    <body >
        <script src="<?=base_url('assets/');?>backend/js/demo-theme.min.js?1666304673"></script>
        <div class="page">
            
            <header class="navbar navbar-expand-md navbar-light d-print-none">
                <div class="container-xl">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                        <a href="/home">
                            <img src="<?= base_url('upload/'); ?><?=info('site_logo');?>" width="110" height="32" alt="" class="navbar-brand-image">
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
                            <div class="nav-item dropdown d-none d-md-flex me-3" id="notifikasi_tiket"></div>
                            <div class="nav-item dropdown d-none d-md-flex me-3" id="search_notifikasi"></div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                                <span class="avatar avatar-sm" style="background-image: url()"><i class="ti ti-user-circle fa-lg"></i></span>
                                <div class="d-none d-xl-block ps-2">
                                    <div><?=$this->session->nama;?></div>
                                    <div class="mt-1 small text-muted"><?=$this->session->level;?></div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <!--a href="#" class="dropdown-item">Set status</a-->
                                <a href="<?=base_url('user/profil');?>" class="dropdown-item">Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a href="<?=base_url();?>" target="_blank" class="dropdown-item">View Web</a>
                                <a href="<?=base_url('auth/logout');?>" class="dropdown-item">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="navbar-expand-md no-print">
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="navbar navbar-light">
                        <div class="container-xl">
                            <?php
                                
                                $sq = $this->db->query("SELECT * from tb_users where id_user='".$this->session->iduser."'");
                                if($sq->num_rows()>0){
                                    $n =  $sq->row_array();
                                    
                                    $sidemenu = $n['idmenu'];
                                    
                                    $sql= $this->db->query("select * from menuadmin where idmenu IN ($sidemenu) AND idparent='0' AND aktif='Y' order by urutan ");
                                    
                                ?>
                                <ul class="navbar-nav" id="accordionSidebar">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=base_url('home');?>" >
                                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                                            </span>
                                            <span class="nav-link-title">
                                                Home
                                            </span>
                                        </a>
                                    </li>
                                    <?php
                                        $link_menu = $this->uri->segment(1);
                                        foreach ($sql->result_array() as $m){
                                            $idlm = $m['id_level']; 
                                            $carimenu=$this->db->query("select * from menuadmin where link='$m[link]'");
                                            $sm = $carimenu->row_array();
                                            if($m['treeview']=='treeview'){
                                                $sub=$this->db->query("SELECT * FROM menuadmin WHERE idmenu IN ($sidemenu) AND idparent=$m[idmenu] AND aktif='Y' order by urutan");
                                                $subs=$this->db->query("SELECT * FROM menuadmin WHERE idparent='$m[idmenu]' AND aktif='Y' order by urutan")->row_array();
                                                
                                                $jml=$sub->num_rows();
                                            ?>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                                                    <i class="fa fa-fw <?=$m['icon'];?> fa-lg" style="color:#6C7A91;"></i>
                                                    <span class="nav-link-title">
                                                        <?=$m['nama_menu'];?>
                                                    </span>
                                                </a>
                                                <?php if (isset($subs)){ ?>
                                                    <div class="dropdown-menu">
                                                        <div class="dropdown-menu-columns">
                                                            <div class="dropdown-menu-column">
                                                                <?php foreach ($sub->result_array() as $w){ ?>
                                                                    <a class="dropdown-item" href="<?=base_url().$w['link'];?>">
                                                                        <?=$w['nama_menu'];?>
                                                                    </a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </li>
                                            <?php }else{ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?=base_url().$m['link'];?>" >
                                                    <i class="fa fa-fw <?=$m['icon'];?> fa-lg" style="color:#6C7A91;"></i>
                                                    <span class="nav-link-title">
                                                        <?=$m['nama_menu'];?>
                                                    </span>
                                                </a>
                                            </li>
                                        <?php } } ?>
                                </ul>
                            <?php } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="page-wrapper">
                <?=$contents;?>
                
                <footer class="footer footer-transparent d-print-none">
                    <div class="container-xl">
                        <div class="row text-center align-items-center flex-row-reverse">
                            
                            <div class="col-12 mt-3 mt-lg-0">
                                <ul class="list-inline list-inline-dots mb-0 ">
                                    <li class="list-inline-item">
                                        <?= copyYear(2015);?> <a href="#" class="link-secondary"><?=info('footer_web');?></a>.
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
        </div>
        
        <!-- Libs JS -->
        <script src="<?= base_url('assets/'); ?>backend/libs/jquery.loading/jquery.loading.js"></script>
        <script src="<?= base_url('assets/'); ?>backend/libs/sweetalert2/sweetalert2.min.js"></script>
        
        <script src="//cdn.jsdelivr.net/npm/litepicker-polyfills-ie11/dist/index.js" defer></script>
        <script src="<?=base_url();?>assets/backend/libs/litepicker/dist/bundle.js?1666304673" defer></script>
        <script src="<?=base_url();?>assets/backend/libs/apexcharts/dist/apexcharts.js" defer></script>
        <script src="<?=base_url();?>assets/backend/js/tabler.min.js" defer></script>
        <script src="<?=base_url();?>assets/backend/js/demo.min.js" defer></script>
        <?php if($this->session->level=='admin'){ ?>
            <!--script src="<?=base_url();?>assets/backend/js/chart.js" defer></script-->
            <?php }else{ ?>
            <!--script src="<?=base_url();?>assets/backend/js/chart_satker.js" defer></script-->
        <?php } ?>
        <script src="<?=base_url();?>assets/backend/libs/icon-picker/simple-iconpicker.js" defer></script>
        <script type="text/javascript" src="<?=base_url();?>assets/backend/js/datatables.min.js"></script>
        <script>
            $("li.nav-item a").filter(function() {
                return this.href == url;
            }).parentsUntil(".sidebar > .nav-link dropdown").addClass("active");
            $("li.nav-item a").filter(function() {
                return this.href == url;
            }).closest(".dropdown").addClass("dropdown");
            $(".dropdown-item").filter(function() {
                return this.href == url;
                }).closest("a").siblings().removeClass("active").end().addClass("active").css({
                display : "block"
            });
            
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
        <?php
            if(isset($this->RenderScript))
            foreach($this->RenderScript as $script) {
                $script();
            }
        ?>
    </body>
</html>                                                                                                                    