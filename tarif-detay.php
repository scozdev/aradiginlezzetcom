<?php
require_once './inc/header.php';


$tarifsor = $db->prepare("SELECT * FROM tarif INNER JOIN kategori ON tarif.kategori_id=kategori.kategori_id INNER JOIN kullanici ON tarif.kullanici_id=kullanici.kullanici_id WHERE tarif_seourl=:tarif_seourl and tarif_durum=:tarif_durum");
$tarifsor->execute(array(
   'tarif_seourl' => $_GET['sef'],
    'tarif_durum' => 1
));

$tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC);

$say=$tarifsor->rowCount();

if ($say==0) {

    header("Location:index.php?durum=oynasma");
    exit;
}





$hit = $db->prepare("UPDATE tarif SET tarif_hit= tarif_hit +1 WHERE tarif_seourl=?");
$hit->execute(array($_GET['sef']));


?>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo ($tarifcek['tarif_ad']) ?> Tarifi, Nasıl Yapılır ? - Yazar <?php echo ($tarifcek['kullanici_adi']) ?> | aradiginlezzet.com</title>
    <meta name="description" content="<?php echo ($tarifcek['tarif_lezzet']) ?>">
    <meta name="keywords" content="<?php echo ($tarifcek['tarif_ad']) ?> Tarifi,<?php echo ($tarifcek['tarif_ad']) ?> Tarifi Nasıl Yapılır ?,Kolay <?php echo ($tarifcek['tarif_ad']) ?> Tarifi Nasıl Yapılır,  yemek tarifleri, yemek tarifi,hazırlanışı,Tarif, Yemek Tarifi, Tatlı Tarifi">
    <meta name="author" content="<?php echo ($tarifcek['kullanici_adi']) ?>">
</head>




<!-- ****** Single Blog Area Start ****** -->
<section class="single_blog_area section_padding_80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="row no-gutters">

                    <!-- Single Post Share Info -->
                    <div class="col-2 col-sm-1 d-none d-md-block">
                        <div class="single-post-share-info mt-100">
                            <a href="<?php echo $tarifcek['kullanici_facebook'] ?>" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="<?php echo $tarifcek['kullanici_twitter'] ?>" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="<?php echo $tarifcek['kullanici_googleplus'] ?>" class="googleplus"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            <a href="<?php echo $tarifcek['kullanici_instagram'] ?>" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="<?php echo $tarifcek['kullanici_pinterest'] ?>" class="pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <!-- Single Post -->
                    <div class="col-12 col-sm-11">



                        <div class="single-post">

                          <div class="post-thumb">
                            <img style="" src="<?php echo $tarifcek['tarif_resim'] ?>" alt="<?php echo seo($tarifcek['tarif_ad']) ?>">
                        </div>

                        <!-- Post Content -->
                        <div class="post-content">
                            <div class="post-meta d-flex">
                                <div class="post-author-date-area d-flex">
                                    <!-- Post Author -->
                                    <div class="post-author">
                                        <a href="#"><?php echo $tarifcek['kullanici_adi']; ?></a>
                                    </div>
                                    <!-- Post Date -->
                                    <div class="post-date">
                                        <a href="#"><?php 
                                        $date = explode(" ", strval($tarifcek['tarif_zaman']));
                                        $dates = explode("-", strval($date[0]));

                                        if($dates[1]=="01"){
                                            $ay = "Ocak";
                                        }else if($dates[1]=="02"){
                                            $ay = "Şubat";
                                        }else if($dates[1]=="03"){
                                            $ay = "Mart";                               
                                        }else if($dates[1]=="04"){
                                            $ay = "Nisan";                  
                                        }else if($dates[1]=="05"){
                                            $ay = "Mayıs";   
                                        }else if($dates[1]=="06"){
                                            $ay = "Haziran";   
                                        }else if($dates[1]=="07"){
                                            $ay = "Temmuz";   
                                        }else if($dates[1]=="08"){
                                            $ay = "Ağustos";   
                                        }else if($dates[1]=="09"){
                                            $ay = "Eylül";   
                                        }else if($dates[1]=="10"){
                                            $ay = "Ekim";   
                                        }else if($dates[1]=="11"){
                                            $ay = "Kasım";   
                                        }else if($dates[1]=="12"){
                                            $ay = "Aralık";   
                                        }
                                        echo $dates[2]." ".$ay." ".$dates[0]; ?></a>
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

                            <h1 class="post-headline"><?php echo $tarifcek['tarif_ad'] ?></h1>

                            <p><?php echo $tarifcek['tarif_lezzet'] ?></p>

                            <hr>
                            <div class="row">
                              <?php if(!empty($tarifcek['tarif_kackisilik'])){ ?>
                                <div class="col-12 col-md-4 d-flex flex-column">
                                    <h3><span><i class="fa fa-users"></i></span>Kaç Kişilik</h3>
                                    <p class="a"><?php echo $tarifcek['tarif_kackisilik'] ?></p>
                                </div>
                            <?php } ?>
                            <?php if(!empty($tarifcek['tarif_hazirlanma'])){ ?>
                                <div class="col-12 col-md-4">
                                    <h3><span><i class="fa fa-clock-o "></i></span>Hazırlanma Süresi</h3>
                                    <p class="a" class="a"><?php echo $tarifcek['tarif_hazirlanma'] ?></p>
                                </div>
                            <?php } ?>
                            <?php if(!empty($tarifcek['tarif_pisirme'])){ ?>
                                <div class="col-12 col-md-4">
                                   <h3><span><i class="fa fa-times-circle-o "></i></span>PİŞİRME SÜRESİ</h3>
                                   <p class="a"><?php echo $tarifcek['tarif_pisirme'] ?></p>
                               </div>
                           <?php } ?>
                       </div>
                       <hr>
                       <?php if(!empty($tarifcek['tarif_mazemeler'])){ ?>
                           <h2><span><i class="fa fa-flask"></i></span>Tarif Mazemeler</h2>
                           <p><?php echo $tarifcek['tarif_mazemeler'] ?></p>
                           <hr>
                       <?php } ?>
<?php if(!empty($tarifcek['tarif_nasilyapilir'])){ ?>
                           <h2><span><i class="fa fa-wrench"></i></span>Yapılışı</h2>
                           <p><?php echo $tarifcek['tarif_nasilyapilir'] ?></p>
                       <?php } ?>
                       <?php if(!empty($tarifcek['tarif_oneri'])){ ?>
                           <h2><span><i class="fa fa-circle"></i></span>Öneriler</h2>
                           <p><?php echo $tarifcek['tarif_oneri'] ?></p>
                           <hr>
                       <?php } ?>
                       
                   </div>
               </div>



               <!-- Tags Area -->
               <div class="tags-area">
                <a href="#">Multipurpose</a>
                <a href="#">Design</a>
                <a href="#">Ideas</a>
            </div>

            <!-- Related Post Area -->
            <div class="related-post-area section_padding_50">
                <h4 class="mb-30">İlgili Paylaşımlar</h4>

                <div class="related-post-slider owl-carousel">



                    <?php 


                    $ilgilitarifsor = $db->prepare("SELECT * FROM tarif INNER JOIN kategori ON tarif.kategori_id=kategori.kategori_id INNER JOIN kullanici ON tarif.kullanici_id=kullanici.kullanici_id WHERE tarif_durum=:tarif_durum and kategori.kategori_id=:kategori_id and tarif.tarif_id!={$tarifcek['tarif_id']} order by tarif.tarif_zaman DESC limit 7");
                    $ilgilitarifsor->execute(array(
                        'tarif_durum' => 1,
                        'kategori_id' => $tarifcek['kategori_id']
                    ));


                    while ($ilgilitarifcek = $ilgilitarifsor->fetch(PDO::FETCH_ASSOC)) {

                        ?>



                        <!-- Single Related Post-->
                        <div class="single-post">
                            <!-- Post Thumb -->
                            <div class="post-thumb">
                                <a href="tarif/<?php echo seo($ilgilitarifcek['tarif_ad']) ?>-<?php echo $ilgilitarifcek['tarif_id'] ?>">
                                    <img src="<?php echo $ilgilitarifcek['tarif_resim'] ?>" alt=""></a>
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-meta d-flex">
                                        <div class="post-author-date-area d-flex">
                                            <!-- Post Author -->
                                            <div class="post-author">
                                                <a href="profil/<?php echo $ilgilitarifcek['kullanici_adi'] ?>"><?php echo $ilgilitarifcek['kullanici_adi'] ?></a>
                                            </div>
                                            <!-- Post Date -->
                                            <div class="post-date">
                                                <a href="#"><?php 
                                                $date = explode(" ", strval($ilgilitarifcek['tarif_zaman']));
                                                $dates = explode("-", strval($date[0]));

                                                if($dates[1]=="01"){
                                                    $ay = "Ocak";
                                                }else if($dates[1]=="02"){
                                                    $ay = "Şubat";
                                                }else if($dates[1]=="03"){
                                                    $ay = "Mart";                               
                                                }else if($dates[1]=="04"){
                                                    $ay = "Nisan";                  
                                                }else if($dates[1]=="05"){
                                                    $ay = "Mayıs";   
                                                }else if($dates[1]=="06"){
                                                    $ay = "Haziran";   
                                                }else if($dates[1]=="07"){
                                                    $ay = "Temmuz";   
                                                }else if($dates[1]=="08"){
                                                    $ay = "Ağustos";   
                                                }else if($dates[1]=="09"){
                                                    $ay = "Eylül";   
                                                }else if($dates[1]=="10"){
                                                    $ay = "Ekim";   
                                                }else if($dates[1]=="11"){
                                                    $ay = "Kasım";   
                                                }else if($dates[1]=="12"){
                                                    $ay = "Aralık";   
                                                }
                                                echo $dates[2]." ".$ay." ".$dates[0]; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <h6><?php echo $ilgilitarifcek['tarif_ad'] ?></h6>
                                    </a>
                                </div>
                            </div>


                        <?php } ?>









                    </div>
                </div>
                <?php 
                $yorumsor=$db->prepare("SELECT yorumlar.*,kullanici.* FROM yorumlar INNER JOIN kullanici ON yorumlar.kullanici_id=kullanici.kullanici_id where tarif_id=:id and yorum_onay=:yorum_onay order by yorum_zaman DESC");
                $yorumsor->execute(array(
                    'id' => $tarifcek['tarif_id'],
                    'yorum_onay'=> 1
                ));

                $say = $yorumsor->rowCount();


                ?>
                <!-- Comment Area Start -->
                <div class="comment_area section_padding_50 clearfix">
                    <h4 class="mb-30"><?php echo $say ?> Yorumlar</h4>

                    <ol>


                        <?php 

                        if (!$say) {

                         echo "Bu ürün için henüz yorum girilmemiştir";
                     }
                     while($yorumcek=$yorumsor->fetch(PDO::FETCH_ASSOC)) {  ?>

                        <!-- Single Comment Area -->
                        <li class="single_comment_area">
                            <div class="comment-wrapper d-flex">
                                <!-- Comment Meta -->
                                <div class="comment-author">
                                    <img src="<?php echo $yorumcek['kullanici_profilfoto'] ?>" alt="<?php echo $yorumcek['kullanici_adi'] ?>">
                                </div>
                                <!-- Comment Content -->
                                <div class="comment-content">
                                    <span class="comment-date text-muted"><?php echo $yorumcek['yorum_zaman'] ?></span>
                                    <h5><?php echo $yorumcek['kullanici_adi'] ?></h5>
                                    <p><?php echo $yorumcek['yorum_detay'] ?></p>
                                </div>
                            </div>

                        </li>

                    <?php } ?>

                </ol>
            </div>

            <!-- Leave A Comment -->
            <div class="leave-comment-area section_padding_50 clearfix">
                <div class="comment-form">
                    <h4 class="mb-30">Yorum Yap</h4>

                    <!-- Comment Form -->
                    <form action="nedmin/netting/kullanici.php" method="post">
                        <input type="hidden" name="tarif_id" value="<?php echo $tarifcek['tarif_id'] ?>">
                        <input type="hidden" name="tarif_ad" value="<?php echo $tarifcek['tarif_ad'] ?>">

                        <div class="form-group">
                            <textarea class="form-control" name="message" id="message" cols="30" rows="10" placeholder="Yorumunuzu Yazınız"></textarea>
                        </div>
                        <button type="submit" name="yorumkaydet" class="btn contact-btn">Yorum Gönder</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>



<?php require_once 'inc/tarif-detay-sidebar.php'; ?>


</div>
</div>
</section>
<!-- ****** Single Blog Area End ****** -->




<?php require_once './inc/footer.php' ?>