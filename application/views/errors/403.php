<!DOCTYPE html>
<html lang="id" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        
        <!-- Title -->
        <title>Sorry, This Page Can&#39;t Be Accessed</title>
        <?=link_tag('assets/vendor/fontawesome/css/font-awesome.css'); ?>
		<?=link_tag('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>
    </head>
    
    <body class="bg-dark text-white py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-2 text-center">
                    <p><i class="fa fa-exclamation-triangle fa-5x"></i><br/>Status Code: 403</p>
                </div>
                <div class="col-md-10">
                    <h3>OPPSSS!!!! Sorry...</h3>
                    <p>Maaf, akses Anda ditolak karena alasan keamanan server kami dan juga data sensitif kami.
                    <br>Silakan kembali ke halaman sebelumnya untuk melanjutkan browsing.</p>
                    <a class="btn btn-danger" href="javascript:history.back()">Go Back</a>
                </div>
            </div>
        </div>
        
        <div id="footer" class="text-center">
            Hak Cipta 2022, Pospercetakan
        </div>
    </body>
</html>