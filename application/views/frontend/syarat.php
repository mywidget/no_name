<main class="container my-4">
    <?php if(!empty($row)){ ?>
        <div class="shadow rounded-12 p-3">
            <h4 class="my-4 text-dark"><?=$row->title;?></h4>
            <hr class="my-2">
            <?=$row->deskripsi;?>
        </div>
        <?php }else{ ?>
        <div class="shadow rounded-12 p-3">
            <h4 class="my-4 text-dark">Belum ada data</h4>
            <hr class="my-2">
        </div>
    <?php } ?>
</main>