 <!-- ****** Blog Sidebar ****** -->
 <div class="col-12 col-sm-8 col-md-6 col-lg-4">
    <div class="blog-sidebar mt-5 mt-lg-0">


        <!-- profil start -->

        <div id="usertarif" class="single-widget-area popular-post-widget mt-0 p-2" > 
            <div class="widget-title text-center">
                <h6 style="font-family: Inter, sans-serif;font-weight: 600;font-size: 22px;">Tarifin Yazarı</h6>
            </div>



            <div class="d-flex flex-column">

                <div class="d-flex justify-content-between mb-3">
                    <div class="d-flex flex-column mt-1">
                        <a id="detayuserad" class="" href="profil/<?php echo $tarifcek['kullanici_adi'] ?>"><?php echo $tarifcek['kullanici_adi'] ?></a>
                        <p><?php echo $tarifcek['kullanici_biyo'] ?></p>
                    </div>
                    <div>
                        <div class="comment-author2">
                            <img src="<?php echo $tarifcek['kullanici_profilfoto'] ?>" alt="">
                        </div>
                    </div>
                </div>

                <?php 

                $takipsor = $db->prepare("SELECT * FROM takip where takip_eden=:takip_eden and takip_edilen=:takip_edilen");
                $takipsor->execute(array(
                    'takip_eden' => $_SESSION['userkullanici_id'],
                    'takip_edilen' => $tarifcek['kullanici_id']
                ));
                $say = $takipsor->rowCount();



                $takipcisor = $db->prepare("SELECT * FROM takip where takip_edilen=:takip_edilen");
                $takipcisor->execute(array(
                    'takip_edilen' => $tarifcek['kullanici_id']
                ));
                $say2 = $takipcisor->rowCount();

                ?>


                <div class="d-flex justify-content-between">
                    <div>
                        <?php if($say>0){ ?>

                            <button class="btn btn-danger btn mt-1" disabled="">Takip Ediliyor</button>


                        <?php }elseif($tarifcek['kullanici_id']!=$_SESSION['userkullanici_id'] && isset($_SESSION['userkullanici_id'])){ ?>
                          <form action="./nedmin/netting/kullanici.php" method="POST">
                            <input type="hidden" name="kullanici_id" value="<?php echo $tarifcek['kullanici_id'] ?>">
                            <input type="hidden" name="tarif_ad" value="<?php echo $tarifcek['tarif_ad'] ?>">
                            <input type="hidden" name="tarif_seourl" value="<?php echo $tarifcek['tarif_seourl'] ?>">
                            <button class="btn btn-danger btn mt-1" name="takipet">Takip Et</button>
                        </form>
                    <?php }else{ ?>
                        <button class="btn btn-danger btn mt-1"  disabled="">Takip Et</button>
                    <?php } ?>

                </div>
                <div class="d-flex flex-column">


                    <span class="mt-3 takip"><?php echo $say2 ?> <span>Takipçi</span></span>
                </div>
            </div>

        </div>








    </div>
    <div style="margin: 24px 0px;">
        <div style="border-bottom: 1px solid rgb(235, 235, 235);"></div>
    </div>
    <!-- profil finish -->



    <!-- start -->
    <div class="single-widget-area popular-post-widget mt-0">
        <div class="widget-title text-center">
            <h6>Kategoriler</h6>
        </div>


        <ol class="foode-catagories">

         <?php

         $kategorisor = $db->prepare("SELECT kategori.kategori_ad,COUNT(tarif.tarif_id) as tarif_sayisi FROM tarif RIGHT JOIN kategori on tarif.kategori_id=kategori.kategori_id GROUP by kategori_ad order by kategori.kategori_id");
         $kategorisor->execute();




         while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {




            ?>

            <li><a href="kategori/<?= seo($kategoricek['kategori_ad']) ?>"><span><i class="fa fa-stop" aria-hidden="true"></i> <?php echo $kategoricek['kategori_ad'] ?></span>
                <span class="text-muted">(<?php echo $kategoricek['tarif_sayisi'] ?>)</span></a>
            </li>

        <?php } ?>

    </ol>

</div>
<!-- finish -->

<?php require_once 'populer-post.php' ?>


<!-- Single Widget Area -->
<!--
<div class="single-widget-area add-widget text-center">
    <div class="add-widget-area">
        <img src="img/sidebar-img/6.jpg" alt="">
        <div class="add-text">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <h2>Reklam Alanı</h2>
                    <p>Satın almak için iletişime geçin !</p>
                    <a href="iletisim" class="add-btn">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

-->

<!-- Single Widget Area -->
<!-- <div class="single-widget-area newsletter-widget">
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
    </div> -->
</div>
</div>
</div>
</div>
</section>
<!-- ****** Blog Area End ****** -->