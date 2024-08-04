<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                    Dashboard
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="col d-flex flex-column">
            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row g-2 align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-green text-white avatar">
                                            <i class="ti ti-users fa-lg"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?=$pendaftar_baru;?>
                                        </div>
                                        <div class="text-muted">
                                            PENDAFTAR BARU
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="/pendaftar" class="btn">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm bg">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-green text-white avatar"> 
                                            <i class="ti ti-users fa-lg"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?=$pendaftar_diterima;?>
                                        </div>
                                        <div class="text-muted">
                                            PENDAFTAR BARU DITERIMA
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="/pendaftar?status=Diterima" class="btn">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm bg">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger text-white avatar"> 
                                            <i class="ti ti-users fa-lg"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?=$pendaftar_ditolak;?>
                                        </div>
                                        <div class="text-muted">
                                            PENDAFTAR BARU DITOLAK
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="/pendaftar?status=Tidak Diterima" class="btn">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm bg">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-twitter text-white avatar"> 
                                            <i class="ti ti-users fa-lg"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?=$pendaftar_pindahan_baru;?>
                                        </div>
                                        <div class="text-muted">
                                            PENDAFTAR PINDAHAN
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="/pendaftar?filter=Pindahan" class="btn">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm bg">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-twitter text-white avatar"> 
                                            <i class="ti ti-users fa-lg"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?=$pendaftar_pindahan_ditolak;?>
                                        </div>
                                        <div class="text-muted">
                                            PENDAFTAR PINDAHAN DITERIMA
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="/pendaftar?filter=Pindahan&status=Diterima" class="btn">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm bg">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger text-white avatar"> 
                                            <i class="ti ti-users fa-lg"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?=$pendaftar_pindahan_ditolak;?>
                                        </div>
                                        <div class="text-muted">
                                            PENDAFTAR PINDAHAN DITOLAK
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="/pendaftar?filter=Pindahan&status=Tidak Diterima" class="btn">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm bg">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-primary text-white avatar"> 
                                            <i class="ti ti-users fa-lg"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?=$naik_tingkat;?>
                                        </div>
                                        <div class="text-muted">
                                            NAIK TINGKAT
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="/pendaftar/naik_tingkat" class="btn">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm bg">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-primary text-white avatar"> 
                                            <i class="ti ti-users fa-lg"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?=$naik_tingkat_diterima;?>
                                        </div>
                                        <div class="text-muted">
                                            NAIK TINGKAT DITERIMA
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="/pendaftar/naik_tingkat?status=Diterima" class="btn">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm bg">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-danger text-white avatar"> 
                                            <i class="ti ti-users fa-lg"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?=$naik_tingkat_ditolak;?>
                                        </div>
                                        <div class="text-muted">
                                            NAIK TINGKAT DITOLAK
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="/pendaftar/naik_tingkat?status=Tidak Diterima" class="btn">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col d-flex flex-column">
                        
                        <div class="card-body">
                            <div class="row row-cards">
                                
                            </div>
                        </div>
                    </div>
                    
                    <!--div class="col-sm-12 col-lg-12">
                        <div class="card">
                        <div class="card-body">
                        <div class="d-flex align-items-center">
                        <div class="subheader">GRAFIK</div>
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
                    </div-->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dataTables_wrapper {padding:0 10px 20px 10px}
</style>
<script>
    $(document).ready(function () {
        $('#aktifitas').DataTable();
    });
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
        // load_chart()
    });
    
    
</script>
