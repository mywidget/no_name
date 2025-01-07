<header class="dbg-secondary pt-2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 pb-5 text-center text-md-start">
                <h1 class="db-primary py-3"><?=tag_key('heading');?></h1>
                <p><?=tag_key('sub_heading');?></p>
                <a href="<?=base_url('formulir');?>">
                    <button type="button" class="btn btn-lg btn-success rounded-25 goform">Daftar Sekarang</button>
                </a>
            </div>
            <div class="col-md-6">
                <picture>
                    <img src="<?=base_url('upload');?>/<?=tag_key('bg_hero');?>" alt="hero-image">
                </picture>
            </div>
        </div>
    </div>
</header>

<main class="mb-4">
    <section class="pt-5 px-3 text-center">
        <h4>BISMILLAHIRRAHMANIRRAHIM</h4>
        <p class="mb-0">Panitia Penerimaan Santri dan Peserta Didik Baru Pondok Pesantren Tebu Ireng 4 Al-Ishlah</p>
        <p class="mb-0">Menyediakan formulir pendaftaran online yang bisa diakses dimanapun.</p>
        <p class="mb-0">Untuk saat ini Panitia tidak menerima pendaftaran melalui kantor sekretariat. Semua pendaftaran dilayani secara online.</p>
    </section>
    <?php if(tag_key('alur_aktif')=='Y'): ?>
    <section class="py-5 px-3 text-center">
        <h4 class="pb-3"><?=tag_key('alur_title');?></h4>
        <div class="container">
            <div class="row g-3">
            <?php foreach($alur AS $row): ?>
                <div class="col-sm-6 col-lg-3">
                    <div class="step-item rounded-12 h-100 px-3 py-4">
                        <span><i class="fa <?=$row->icon;?> fa-2x" aria-hidden="true"></i></span>
                        <h5 class="pt-4"><?=$row->title;?></h5>
                        <p class="text-secondary"><?=$row->deskripsi;?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>