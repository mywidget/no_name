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
                    
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">GRAFIK PENDAFTAR</div>
                                    <div class="ms-auto lh-1">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <a href="#" class="link-secondary">
                                                    <i class="ti ti-calendar fa-lg"></i>
                                                </a>
                                            </span>
                                            <select id="tahun_akademik" name="tahun_akademik" class="form-control custom-select">
                                                <option value="">-- Pilih Tahun Akademik --</option>
                                                <?php foreach ($tahun_akademik as $ta): ?>
                                                
                                                <option value="<?= $ta['id_tahun_akademik']; ?>" <?php echo ($ta['id_tahun_akademik'] == $tahun_aktif) ? 'selected' : ''; ?>><?= $ta['nama_tahun']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="chart_pendaftar" class="p-3"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">GRAFIK PENDAFTAR</div>
                                    <div class="ms-auto lh-1">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <a href="#" class="link-secondary">
                                                    <i class="ti ti-calendar fa-lg"></i>
                                                </a>
                                            </span>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="chart" class="p-3"></div>
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
    $(document).ready(function() {
        // Ambil data dari controller
        $.ajax({
            url: '<?= base_url('home/get_data') ?>',
            method: 'GET',
            success: function(response) {
                const data = JSON.parse(response);
                let chartData = {};
                let categories = [];
                
                // Mengelompokkan data berdasarkan kode_jurusan dan tahun akademik
                data.forEach(item => {
                    if (!chartData[item.kode_jurusan]) {
                        chartData[item.kode_jurusan] = {
                            name: item.kode_jurusan,
                            data: []
                        };
                    }
                    chartData[item.kode_jurusan].data.push(item.total_pendaftar);
                    if (!categories.includes(item.id_tahun_akademik)) {
                        categories.push(item.id_tahun_akademik);
                    }
                });
                
                // Persiapkan series untuk ApexCharts
                let series = Object.values(chartData);
                let options = {
                    chart: {
                        type: 'bar',
                        height: 300,
                        maxHeight: 300
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '40%'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    series: series,
                    xaxis: {
                        categories: categories
                    },
                    colors: ['#00008c', '#0086b3', '#ff4c4d', '#d90000', '#8600b3'], // Contoh warna berbeda untuk tiap unit
                    title: {
                        text: 'Total Pendaftar per Unit dan Tahun Akademik'
                    }
                };
                
                // Membuat chart
                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            },
            error: function() {
                alert('Error loading data');
            }
        });
    });
</script>
<script>
    
    var tahun_aktif = "<?=$tahun_aktif;?>";
    // Fungsi untuk memuat data ke chart
    var chart;
    function loadChartData(tahun) {
        $.ajax({
            url: base_url+'home/get_data_per_kelas',
            method: 'POST',
            data:{tahun:tahun},
            dataType: 'json',
            success: function(response) {
                var kelas = [];
                var total_pendaftar = [];
                var tahun_akademik = [];
                
                response.forEach(function(item) {
                    kelas.push(item.kelas);
                    total_pendaftar.push(item.total_pendaftar);
                    tahun_akademik.push(item.nama_tahun);
                });
                
                // Cek apakah chart sudah ada
                if (chart) {
                    // Jika chart sudah ada, update data chart
                    chart.updateOptions({
                        series: [{
                            name: 'Total Pendaftar',
                            data: total_pendaftar
                        }],
                        xaxis: {
                            categories: kelas
                        },
                        subtitle: {
                            text: 'Tahun Akademik: ' + tahun,
                            align: 'center'
                        }
                    });
                    } else {
                    // Jika chart belum ada, buat chart baru
                    var options = {
                        chart: {
                            type: 'bar',
                            height: 350
                        },
                        series: [{
                            name: 'Total Pendaftar',
                            data: total_pendaftar
                        }],
                        xaxis: {
                            categories: kelas,
                            title: {
                                text: 'Kelas'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Jumlah Pendaftar'
                            }
                        },
                        title: {
                            text: 'Total Pendaftar per Kelas',
                            align: 'center'
                        },
                        subtitle: {
                            text: 'Tahun Akademik: ' + tahun,
                            align: 'center'
                        },
                        dataLabels: {
                            enabled: true
                        },
                        tooltip: {
                            enabled: true
                        }
                    };
                    
                    // Inisialisasi chart pertama kali
                    chart = new ApexCharts(document.querySelector("#chart_pendaftar"), options);
                    chart.render();
                }
            }
        });
    }
    
    // Memanggil fungsi untuk load data saat halaman dimuat
    $(document).ready(function() {
        // Load data awal tanpa filter
        loadChartData(tahun_aktif);
        
        // Ketika tahun akademik dipilih, panggil fungsi untuk memuat data
        $('#tahun_akademik').change(function() {
            var selectedYear = $(this).val();
            loadChartData(selectedYear);
        });
    });
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
