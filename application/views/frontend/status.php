<main class="container my-4">
    <h4 class="my-4 text-dark">Cek Status Pendaftaran Santri Baru <?php echo $tahun['nama_tahun'];?></h4>
    <p class="text-secondary">Masukkan Nomor Registrasi Online dan Tanggal Lahir dengan format HHBBTTTT contoh 23002010</p>
    <div class="shadow rounded-12 p-3 mb-4">
        <form method='POST' id="form-cek">   
            <div class="row align-items-center">
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <label for="noInduk">Nomor Pendaftaran</label>
                </div>
                <div class="col-sm-8 col-md-6 col-lg-4">
                    <input type="number" name="kode_daftar" id="noInduk" class="form-control" value="1205175502120003" required="">
                </div>
            </div>
            
            <div class="row align-items-center mt-3">
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                </div>
                <div class="col-sm-8 col-md-6 col-lg-4">
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="2012-02-15" required="">
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-sm-3 col-md-3 col-lg-2"></div>
                <div class="col-sm-8 col-md-6 col-lg-4 justify-content-end">
                    <button type="submit" class="btn btn-success rounded-pill px-5"> Cek Status</button>
                </div>
            </div>
        </form>
    </div>
    <div id="show_status"></div>
</main>
<?php $this->RenderScript[] = function() { ?>
    <script>
        $('#form-cek').on('submit', function (e) {
            e.preventDefault();
            $('button:submit', this).html(spinner).prop('disabled', true);
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                url: base_url+ "dashboard/cek_status",
                success: (response) => {
                    $('#show_status').html(response);
                    
                },
                complete: () => {
                    $('button:submit', this).text('Cek Status').prop('disabled', false);
                },
            });
        });
    </script>    
    
<?php } ?>