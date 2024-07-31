<main class="container my-4">
    <?php if(!empty($brosur)){ 
        $opathFile = FCPATH."upload/" . $brosur->gambar;
        $size = @getimagesize($opathFile);
        if($size !== false){
            $gambar=base_url()."upload/".$brosur->gambar;
            }else{
            $gambar = 'https://unsplash.it/1200/768.jpg?image=251';
        }
       
    ?>
    <div class="shadow rounded-12 p-3">
        <h4 class="my-4 text-dark"><?=$brosur->title;?></h4>
        <hr class="my-2">
        <?php  if($brosur->tampil_image=='Ya'){ ?>
        <div class="mb-4">
            <div class="image_item">
                <img class="img-fluid" src="<?=$gambar;?>" width="100%" alt="<?php echo $brosur->title ;?>">
            </div>
        </div>
        <?php } ?>
        <?=$brosur->deskripsi;?>
    </div>
    <?php }else{ ?>
    <div class="shadow rounded-12 p-3">
        <h4 class="my-4 text-dark">Belum ada data</h4>
        <hr class="my-2">
    </div>
    <?php } ?>
</main>