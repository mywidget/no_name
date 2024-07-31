<main class="container my-4">
    <div class="row ">
        <?php foreach($brosur AS $val): 
            $opathFile = FCPATH."upload/" . $val->gambar;
            $size = @getimagesize($opathFile);
            if($size !== false){
                $gambar=base_url()."upload/".$val->gambar;
                }else{
                $gambar = 'https://unsplash.it/1200/768.jpg?image=251';
            }
        ?>
        <div class="col-md-4 shadow-sm">
            <h4 class="p-2 text-dark"><a href="/brosur/<?php echo $val->seo ;?>"><?php echo $val->title ;?></a></h4>
            <div class="image_item">
            	<a href="<?=$gambar;?>" data-toggle="lightbox" data-gallery="example-gallery" >
                    <img class="img-fluid" src="<?=$gambar;?>" width="100%" alt="<?php echo $val->title ;?>">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>

<style>
    .image_item {
    position: relative;
    width: 100%;
    }
    
    .image_item {
    text-align: center;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
    background-color: #000;
    }
    .image_item i {
    position: absolute;
    top: 50%;
    left: 50%;
    border-radius: 50%;
    font-size: 34px;
    color: black;
    width: 60px;
    height: 60px;
    line-height: 60px;
    background: #ffffff;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
    -webkit-transform: translate(-50%, -50%) scale(0);
    transform: translate(-50%, -50%) scale(0);
    transition: all 300ms 0ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
    }
    
    .image_item:hover img {
    opacity: 0.3;
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
    }
    .image_item:hover i {
    -webkit-transform: translate(-50%, -50%) scale(1);
    transform: translate(-50%, -50%) scale(1);
    transition: all 300ms 100ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
</style>    