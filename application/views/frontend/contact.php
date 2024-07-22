<main class="container my-4">
    <div class="shadow rounded-12 p-3">
        <h4 class="my-4 text-dark">Kontak Panitia Pendaftaran Santri Baru <?php echo $tahun['nama_tahun'];?></h4>
        <hr class="my-2">
        <?php
            if(!empty($panitia)):
            foreach($panitia AS $row):
        ?>
        <div class="row align-items-center my-2">
            <div class="col-md-2">
                <label for="noin"><?=$row->title;?></label>
            </div>
            <div class="col-auto">
                <span><?=$row->nomerwa;?></span>
            </div>
        </div>
        <?php 
            endforeach; 
            endif; 
        ?>
         
    </div>
</main>