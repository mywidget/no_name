<!doctype html>
<html lang="en">
    
    <head>
        
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title><?=$title;?></title>
        <meta name="keywords" content="<?=$keywords;?>">
        <meta name="description" content="<?=$description;?>">
        <meta name="author" content="Munajat Ibnu">
        <link rel="icon" href="<?=base_url('assets');?>/images/tebuireng4.ico">
        <!-- CSS -->
        <link rel="stylesheet" href="<?=base_url('assets');?>/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=base_url('assets');?>/dist/css/styles.css">
        <link rel="stylesheet" href="<?=base_url('assets');?>/dist/css/flatpickr.min.css">
        <script>
            var base_url = '<?=base_url();?>';
            
        </script>
    </head>
    
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <a href="/" class="navbar-brand fw-bold db-primary">
                    <img class="d-none d-sm-inline" src="<?=base_url('assets');?>/images/tebuireng4.png" alt="Logo" height="64">
                    <img class="ms-sm-2" src="<?=base_url('assets');?>/images/arab.png" alt="Brand Name">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="nav nav-pills flex-column flex-lg-row ms-auto">
                        <?php foreach($menu AS $row) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url($row->link);?>"><?=$row->nama_menu;?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    
                </div>
            </div>
        </nav>
        
        <!-- Top content -->
        <?=$contents;?>
        <footer class="dbg-secondary mt-auto">
            <div class="container py-4">
                <div class="row g-3 text-center">
                    <div class="col-sm-4">
                        <h5>Kontak</h5>
                        <p class="mb-1">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i> &nbsp;
                            <a class="text-reset text-decoration-none" href="https://wa.me/<?=tag_key('site_phone');?>" target="_blank"> <?=tag_key('site_phone');?> </a>
                            <br>
                            <i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;
                            <a class="text-reset" href="mailto:<?=tag_key('site_mail');?>"><?=tag_key('site_mail');?></a>
                        </p>
                        <p></p>
                    </div>
                    <div class="col-sm-4">
                        <h5>Alamat</h5>
                        <p class="mb-0"><?=tag_key('site_addr');?></p>
                    </div>
                    <div class="col-sm-4">
                        <h5>Ikuti Kami</h5>
                        <div class="d-flex justify-content-center">
                            <a class="link-dark px-3" href="https://www.instagram.com/tebuireng_alishlah" target="_blank">
                                <span><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></span>
                            </a>
                            <a class="link-dark px-3" href="https://www.facebook.com/Tebuirengalishlah" target="_blank">
                                <span><i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i></span>
                            </a>
                            <a class="link-dark px-3" href="https://youtube.com/@tebuireng4al-ishlah393" target="_blank">
                                <span><i class="fa fa-youtube-play fa-lg" aria-hidden="true"></i></span>
                            </a>
                            <a class="link-dark px-3" href="https://www.tiktok.com/@tebuireng.alishlah?_t=8kk7VRYAF0R&_r=1" target="_blank">
                                <span><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></span>
                            </a>
                            <a class="link-dark px-3" href="https://www.instagram.com/tebuireng_alishlah/?igshid=MzNlNGNkZWQ4Mg%3D%3D" target="_blank">
                                <span><i class="fa fa-telegram fa-lg" aria-hidden="true"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <span><?= copyYear(2015);?> <?=tag_key('footer_web');?></span>
                </div>
            </div>
        </footer>        
        
        <!-- Javascript -->
        <script src="<?=base_url('assets');?>/fullscreen/assets/js/jquery-3.5.1.min.js"></script>
        <!--script src="<?=base_url('assets');?>/fullscreen/assets/js/jquery-migrate-3.3.0.min.js"></script-->		
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="<?=base_url('assets');?>/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
        <script src="<?=base_url('assets');?>/js/sweetalert2.all.min.js"></script>
        <script src="<?=base_url('assets');?>/fullscreen/assets/js/jquery.backstretch.min.js"></script>
        <script src="<?=base_url('assets');?>/fullscreen/assets/js/wow.min.js"></script>
        <script src="<?=base_url('assets');?>/fullscreen/assets/js/waypoints.min.js"></script>
        
        <script src="<?=base_url('assets');?>/fullscreen/assets/js/scripts.js"></script>
        <script src="<?=base_url('assets');?>/js/function.js?v=<?=time();?>"></script>
        <script>
            var url = window.location;
            // untuk sidebar menu
            $('ul.nav li.nav-item a').filter(function() {
                return this.href == url;
            }).siblings().removeClass('active').end().addClass('active');
            
        </script>
        <?php
            if(isset($this->RenderScript))
            foreach($this->RenderScript as $script) {
                $script();
            }
        ?>
        
    </body>
    
</html>        