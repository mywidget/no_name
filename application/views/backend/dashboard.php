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
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                            <i class="ti ti-users fa-lg"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?=$pengguna;?>
                                        </div>
                                        <div class="text-muted">
                                            PENGGUNA
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="/user/index" class="btn">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row g-2 align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-skyscraper" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="3" y1="21" x2="21" y2="21"></line>
                                                <path d="M5 21v-14l8 -4v18"></path>
                                                <path d="M19 21v-10l-6 -4"></path>
                                                <line x1="9" y1="9" x2="9" y2="9.01"></line>
                                                <line x1="9" y1="12" x2="9" y2="12.01"></line>
                                                <line x1="9" y1="15" x2="9" y2="15.01"></line>
                                                <line x1="9" y1="18" x2="9" y2="18.01"></line>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?=$pendaftar;?>
                                        </div>
                                        <div class="text-muted">
                                            PENDAFTAR
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="/master/satker" class="btn">
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
                                        <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                                <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                                <path d="M9 8h6"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            <?=$diterima;?>
                                        </div>
                                        <div class="text-muted">
                                            DOK. BELUM LENGKAP
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="/master/inventory" class="btn">
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
                     
                    <div class="col-sm-12 col-lg-12">
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
                    </div>
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
