 <!-- ****** Blog Sidebar ****** -->
 <div class="col-12 col-sm-8 col-md-6 col-lg-4">
    <div class="blog-sidebar mt-5 mt-lg-0">

        <!-- start -->
        <div class="single-widget-area popular-post-widget mt-0">
            <div class="widget-title text-center">
                <h6><a href="kategori">Kategoriler</a></h6>
            </div>


            <ol class="foode-catagories">

               <?php

               $kategorisor = $db->prepare("SELECT kategori.kategori_ad,COUNT(tarif.tarif_id) as tarif_sayisi,kategori_seourl FROM tarif RIGHT JOIN kategori on tarif.kategori_id=kategori.kategori_id GROUP by kategori_ad order by kategori.kategori_id");
               $kategorisor->execute();




               while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {


                ?>


                <li <?php if ($_SERVER['REQUEST_URI'] == "/kategori/{$kategoricek['kategori_seourl']}") { ?> class="page-color" <?php   }  ?>>
                    <a style="color:inherit;" href="kategori/<?= seo($kategoricek['kategori_ad']) ?>"><span><i class="fa fa-stop" aria-hidden="true"></i> <?php echo $kategoricek['kategori_ad'] ?></span>
                    <span style="color:inherit !important;" class="text-muted">(<?php echo $kategoricek['tarif_sayisi'] ?>)</span></a>
                </li>

            <?php } ?>

        </ol>

    </div>
    <!-- finish -->

    <?php require_once 'populer-post.php' ?>


   

    <!-- Single Widget Area -->
   <!--   
    <div class="single-widget-area newsletter-widget">
        <div class="widget-title text-center">
            <h6>Newsletter</h6>
        </div>
        <p>Subscribe our newsletter gor get notification about new updates, information discount,
        etc.</p>
        <div class="newsletter-form">
            <form action="#" method="post">
                <input type="email" name="newsletter-email" id="email" placeholder="Your email">
                <button type="submit"><i class="fa fa-paper-plane-o"
                    aria-hidden="true"></i></button>
                </form>
            </div>
        </div>  -->
    </div>
</div>
</div>
</div>
</section>
<!-- ****** Blog Area End ****** -->