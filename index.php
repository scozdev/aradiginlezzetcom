
<?php

require_once 'inc/header.php'; 

if (isset($_GET['sef'])) {

    $kategorisor = $db->prepare("SELECT * from kategori where kategori_seourl=:kategori_seourl");
    $kategorisor->execute(array(
        'kategori_seourl' => $_GET['sef']
    ));
    $kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)

    ?>

    <head>

        <title><?php echo $kategoricek['kategori_title'] ?></title>

        <meta name="description" content="<?php echo $kategoricek['kategori_description'] ?>">

        <meta name="keywords" content="<?php echo $kategoricek['kategori_keywords'] ?>">

    </head>

<?php }else { ?>


 <head>

    <title><?php echo $ayarcek['ayar_title'] ?></title>

    <meta name="description" content="<?php echo $ayarcek['ayar_description'] ?>">

    <meta name="keywords" content="<?php echo $ayarcek['ayar_keywords'] ?>">

</head>


<?php } ?>

<!-- ****** Blog Area Start ****** -->
<section class="blog_area section_padding_0_80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="row">


                    <?php

                    if (isset($_GET['sef'])) {

                        $sayfada = 8; // sayfada gösterilecek içerik miktarını belirtiyoruz.

                        $sorgu = $db->prepare("select * from tarif inner join kategori on tarif.kategori_id=kategori.kategori_id where kategori_seourl=:kategori_seourl");
                        $sorgu->execute(array(
                            'kategori_seourl' => $_GET['sef']
                        ));
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
                        $tarifsor = $db->prepare("SELECT tarif.*,kategori.*,kullanici.* FROM tarif INNER JOIN kategori ON tarif.kategori_id=kategori.kategori_id INNER JOIN kullanici ON tarif.kullanici_id=kullanici.kullanici_id WHERE tarif_durum=:tarif_durum and kategori.kategori_seourl=:kategori_seourl order by tarif.tarif_zaman DESC limit $limit,$sayfada");
                        $tarifsor->execute(array(
                            'tarif_durum' => 1,
                            'kategori_seourl' => $_GET['sef']
                        ));

                        $say = $sorgu->rowCount();



                        if ($say == 0) {
                            echo "Bu kategoride ürün Bulunamadı";
                        }
                    } else {

                        $sayfada =8; // sayfada gösterilecek içerik miktarını belirtiyoruz.
                        $sorgu = $db->prepare("select * from tarif");
                        $sorgu->execute();
                        $toplam_icerik = $sorgu->rowCount();
                        $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                        // eğer sayfa girilmemişse 1 varsayalım.
                        $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                        // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                        if ($sayfa < 1) $sayfa = 1;
                        // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                        if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                        $limit = ($sayfa - 1) * $sayfada;


                        $tarifsor = $db->prepare("SELECT * FROM tarif INNER JOIN kategori ON tarif.kategori_id=kategori.kategori_id INNER JOIN kullanici ON tarif.kullanici_id=kullanici.kullanici_id WHERE tarif_durum=:tarif_durum order by tarif.tarif_zaman DESC limit $limit,$sayfada");
                        $tarifsor->execute(array(
                            'tarif_durum' => 1
                        ));

                        $say = $sorgu->rowCount();

                        if ($say == 0) {
                            echo "Bu kategoride ürün Bulunamadı";
                        }
                    }

                    $delay = 0.1;

                    while ($tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC)) {


                        ?>




                        <!-- Single Post -->
                        <div class="col-12 col-md-6">

                            <div class="single-post wow fadeInUp" data-wow-delay="<?php echo $delay ?>s">
                                <!-- Post Thumb -->
                                <div class="post-thumb">
                                   <a href="tarif/<?php echo ($tarifcek['tarif_seourl']) ?>">
                                    <img src="<?php echo $tarifcek['tarif_resim'] ?>" alt="<?php echo seo($tarifcek['tarif_ad']) ?>"></a>
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-meta d-flex">
                                        <div class="post-author-date-area d-flex">
                                            <!-- Post Author -->
                                            <div class="post-author">
                                                <a href="profil/<?php echo $tarifcek['kullanici_adi'] ?>"><?php echo $tarifcek['kullanici_adi'] ?></a>
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
                                                <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> 0</a>
                                            </div>
                                            <!-- Post Comments -->
                                            <div class="post-comments">
                                                <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i> 0</a>
                                            </div>
                                            <!-- Post Share -->
                                            <div class="post-share">
                                                <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <a href="tarif/<?php echo ($tarifcek['tarif_seourl']) ?>">
                                        <span class="tarif-ad">  
                                            <?php echo $tarifcek['tarif_ad'] ?>

                                        </span>
                                    </a>

                                </div>
                            </div>

                        </div>

                    <?php $delay += 0.1; } ?>


 


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

                                        if (!empty($_GET['sef'])) {

                                            if ($s == $sayfa) { ?>

                                               <li class="page-item active">
                                                <a class="page-link" href="kategori-<?php echo $_GET['sef']; ?>?sayfa=<?php echo $s; ?>"><?php echo $s; ?><span class="sr-only">(current)</span></a>
                                            </li>

                                        <?php } else { ?>


                                            <li class="page-item"><a class="page-link" href="kategori-<?php echo $_GET['sef']; ?>?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>


                                        <?php   }

                                    } else {


                                        if ($s == $sayfa) { ?>


                                           <li class="page-item"><a class="page-link" href="index?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>


                                       <?php } else { ?>

                                           <li class="page-item"><a class="page-link" href="index?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>


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


    <?php require_once 'inc/kategori-sidebar.php'; ?>




    <?php require_once 'inc/footer.php'; ?>