
<?php require_once 'inc/header.php'; ?>

<head>
    <title>Lezizlezzetler.com - Yemek Tarifleri ve Yemek Fikirleri</title>
</head>


<!-- ****** Archive Area Start ****** -->
<section class="archive-area section_padding_80">
    <div class="container">
        <div class="row">










           <div style="padding-left: 15px;" class="w-100 py-3 ">

               <h4 style="" class="">Arama Sonuçları</h4>

           </div>

           <hr>

           <?php

           if ($_GET['search']!="") {

            $aranan = $_GET['search'];

                        $sayfada = 6; // sayfada gösterilecek içerik miktarını belirtiyoruz.

                        $sorgu = $db->prepare("select * from tarif inner join kategori on tarif.kategori_id=kategori.kategori_id where tarif_ad LIKE ?");
                        $sorgu->execute(array("%$aranan%"));

                        $toplam_icerik = $sorgu->rowCount();
                        $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                        // eğer sayfa girilmemişse 1 varsayalım.
                        $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                        // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                        if ($sayfa < 1) $sayfa = 1;
                        // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                        if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                        $limit = ($sayfa - 1) * $sayfada;

                        //tüm tablo sütunlarının çekilmesi
                        $tarifsor = $db->prepare("SELECT tarif.*,kategori.*,kullanici.* FROM tarif INNER JOIN kategori ON tarif.kategori_id=kategori.kategori_id INNER JOIN kullanici ON tarif.kullanici_id=kullanici.kullanici_id WHERE tarif_durum=:tarif_durum and tarif.tarif_ad LIKE '%$aranan%' order by tarif.tarif_zaman DESC limit $limit,$sayfada");
                        $tarifsor->execute(array(
                            'tarif_durum' => 1
                        ));

                        $say = $tarifsor->rowCount();

                        

                        if ($say == 0) {
                            echo "Bu kategoride ürün Bulunamadı";
                        }
                    } else {

                       Header("Location:index.php");
                       exit;
                   }



                   while ($tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC)) {


                    ?>

                    <!-- Single Post -->
                    <div class="col-8">
                        <div class="list-blog single-post d-sm-flex wow fadeInUpBig" data-wow-delay=".2s">
                            <!-- Post Thumb -->
                            <div class="post-thumb">
                                <a href="tarif/<?php echo seo($tarifcek['tarif_ad']) ?>-<?php echo $tarifcek['tarif_id'] ?>">
                                    <img src="<?php echo $tarifcek['tarif_resim'] ?>" alt="<?php echo seo($tarifcek['tarif_ad']) ?>">
                                </a>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <div class="post-meta d-flex">
                                    <div class="post-author-date-area d-flex">
                                        <!-- Post Author -->
                                        <div class="post-author">
                                            <a href="u-<?php echo $tarifcek['kullanici_adi'] ?>"><?php echo $tarifcek['kullanici_adi'] ?></a>
                                        </div>
                                        <!-- Post Date -->
                                        <div class="post-date">
                                            <?php $date = explode(" ", $tarifcek['tarif_zaman']); ?>
                                            <a href="#"><?php echo $date[0] ?></a>
                                        </div>
                                    </div>
                                    <!-- Post Comment & Share Area -->
                                    <div class="post-comment-share-area d-flex">
                                        <!-- Post Favourite -->
                                        <div class="post-favourite">
                                            <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> 10</a>
                                        </div>
                                        <!-- Post Comments -->
                                        <div class="post-comments">
                                            <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i> 12</a>
                                        </div>
                                        <!-- Post Share -->
                                        <div class="post-share">
                                            <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <a href="tarif/<?php echo seo($tarifcek['tarif_ad']) ?>-<?php echo $tarifcek['tarif_id'] ?>">
                                    <h4 class="post-headline"> <?php echo $tarifcek['tarif_ad'] ?></h4>
                                </a>
                                <p><?php echo substr($tarifcek['tarif_lezzet'],0,100) ?>..</p>
                                <a href="tarif/<?php echo seo($tarifcek['tarif_ad']) ?>-<?php echo $tarifcek['tarif_id'] ?>" class="read-more">Tarif Detayına Bak..</a>
                            </div>
                        </div>
                    </div>

                <?php } ?>


                <div class="col-12">
                    <div class="pagination-area d-sm-flex mt-15">
                        <nav aria-label="#">
                            <ul class="pagination">





                                <!-- start -->
                                <?php

                                $s = 0;

                                while ($s < $toplam_sayfa) {

                                    $s++; ?>

                                    <?php

                                    if (!empty($_GET['search'])) {

                                        if ($s == $sayfa) { ?>

                                         <li class="page-item active">
                                            <a class="page-link" href="ara?search=<?php echo $_GET['search']; ?>&sayfa=<?php echo $s; ?>"><?php echo $s; ?><span class="sr-only">(current)</span></a>
                                        </li>

                                    <?php } else { ?>


                                        <li class="page-item"><a class="page-link" href="ara?search=<?php echo $_GET['search']; ?>&sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>


                                    <?php   }

                                } else {


                                    if ($s == $sayfa) { ?>


                                        <li class="page-item"><a class="page-link" href="ara?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>


                                    <?php } else { ?>

                                     <li class="page-item"><a class="page-link" href="ara?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>


                                 <?php   }
                             }
                         }

                         ?>
                         <!-- end -->




                     </ul>
                 </nav>
                 <div class="page-status">
                    <p>Page 1 of 60 results</p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- ****** Archive Area End ****** -->



<?php require_once 'inc/footer.php'; ?>