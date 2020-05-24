
<?php require_once 'inc/header.php'; ?>

    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
         <title>Kategoriler | aradiginlezzet.com</title>
        

        <meta name="description" content="Aradığın Lezzeti Kategoriler şeklinde bulabilirsin - aradiginlezzet.com">

        <meta name="keywords" content=" tarif kategorileri, tüm tarifler, tarifler, aradığın kategori">

    </head>



<!-- ****** Archive Area Start ****** -->
<section class="archive-area section_padding_80">
    <div class="container">
        <div class="row">




            <?php 



            $kategorisor = $db->prepare("SELECT * FROM kategori WHERE kategori_durum=:kategori_durum order by kategori_sira DESC");
            $kategorisor->execute(array(
                'kategori_durum' => 1
            ));


            $delay = 0.1;

            while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {



               ?>



               <!-- Single Post -->
               <div class="col-6 col-md-4 col-lg-3">
                <div class="single-post wow fadeInUp" data-wow-delay="<?php echo $delay ?>s">
                    <!-- Post Thumb -->
                    <div class="post-thumb">
                        <a href="kategori/<?= seo($kategoricek['kategori_ad']) ?>">
                            <img src="<?php echo $kategoricek['kategori_resim']; ?>" alt="<?php echo $kategoricek['kategori_ad']; ?>">
                        </a>
                    </div>
                    <!-- Post Content -->
                    <div class="post-content">

                        <a href="kategori/<?= seo($kategoricek['kategori_ad']) ?>">
                            <h4 class="post-headline"><?php echo $kategoricek['kategori_ad']; ?></h4>
                        </a>
                    </div>
                </div>
            </div>


        <?php $delay += 0.1; } ?>


    </div>
</div>
</section>
<!-- ****** Archive Area End ****** -->



<?php require_once 'inc/footer.php'; ?>