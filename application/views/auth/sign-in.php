<!doctype html>
<!--
    * Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
    * @version 1.0.0-beta14
    * @link https://tabler.io
    * Copyright 2018-2022 The Tabler Authors
    * Copyright 2018-2022 codecalm.net Paweł Kuna
    * Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link rel="icon" type="image/x-icon" href="<?= base_url('upload/'); ?><?=info('logo_bw');?>" />
        <title><?=$title;?></title>
        <!-- CSS files -->
        <link href="<?=base_url();?>assets/backend/css/tabler.min.css?1666304673" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/css/tabler-flags.min.css?1666304673" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/css/tabler-payments.min.css?1666304673" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/css/tabler-vendors.min.css?1666304673" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/css/demo.min.css?1666304673" rel="stylesheet"/>
        <link href="<?=base_url();?>assets/backend/iconfont/tabler-icons.min.css" rel="stylesheet"/>
        <style>
            @import url('https://rsms.me/inter/inter.css');
            :root {
            --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }
        </style>
    </head>
    <body  class=" d-flex flex-column bg-white">
        <script src="<?=base_url();?>assets/backend/js/demo-theme.min.js?1666304673"></script>
        <div class="row g-0 flex-fill">
            <div class="col-12 col-lg-6 col-xl-3 border-top-wide border-primary d-flex flex-column justify-content-center">
                <div class="container container-tight my-5 px-lg-4">
                    <div class="text-center mb-4">
                        <a href="." class="navbar-brand navbar-brand-autodark"><img src="<?= base_url('upload/'); ?><?=info('logo_bw');?>" height="36" alt=""></a>
                    </div>
                    <h2 class="h3 text-center mb-3">
                        Login to Admin Panel
                    </h2>
                    <?php echo $this->session->flashdata('message');;?>
                    <form action="<?=base_url();?>auth/login" method="post" autocomplete="off" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="email_user" id="email_user" placeholder="username" autocomplete="off">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                                <!--span class="form-label-description">
                                <a href="./forgot-password.html">I forgot password</a>
                                </span-->
                            </label>
                            <div class="input-group input-group-flat" id="show_hide_password">
                                <input type="password" class="form-control"  name="pass_user" id="pass_user" placeholder="password"  autocomplete="off">
                                <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                        <i class="ti ti-eye-off" aria-hidden="true"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <!--div class="mb-2">
                            <label class="form-check">
                            <input type="checkbox" class="form-check-input"/>
                            <span class="form-check-label">Remember me on this device</span>
                            </label>
                        </div-->
                        <div class="form-footer">
                            <button type="submit" name='submit'  class="btn btn-primary w-100">Sign in</button>
                        </div>
                    </form>
                    <div class="text-center text-muted mt-3">
                       Kembali Ke <a href="<?= base_url(); ?>" tabindex="-1">Beranda</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-9 d-none d-lg-block">
                <div class="bg-cover h-100 min-vh-100" style="background-image: url(<?= base_url('upload/'); ?><?=info('logo_bw');?>)"></div>
            </div>
        </div>
        <script src="<?= base_url('assets/'); ?>backend/jquery/jquery.min.js" type="text/javascript"></script>
        <!-- Libs JS -->
        <!-- Tabler Core -->
        <script src="<?=base_url();?>assets/backend/js/tabler.min.js?1666304673" defer></script>
        <script src="<?=base_url();?>assets/backend/js/demo.min.js?1666304673" defer></script>
        <script>
            $(document).ready(function() {
                $("#show_hide_password a").on('click', function(event) {
                    event.preventDefault();
                    if($('#show_hide_password input').attr("type") == "text"){
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass( "ti-eye-off" );
                        $('#show_hide_password i').removeClass( "ti-eye" );
                        }else if($('#show_hide_password input').attr("type") == "password"){
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass( "ti-eye-off" );
                        $('#show_hide_password i').addClass( "ti-eye" );
                    }
                });
            });
        </script>
    </body>
</html>