  <!-- ****** Instagram Area Start ****** -->
  <div class="instargram_area owl-carousel section_padding_100_0 clearfix" id="portfolio">


    <?php 


    $tarifsor = $db->prepare("SELECT * FROM tarif WHERE tarif_durum=:tarif_durum and tarif_onecikar=:tarif_onecikar order by tarif_hit desc limit 5");
    $tarifsor->execute(array(
        'tarif_durum' => 1,
        'tarif_onecikar'=>1
    ));



    while($tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC)){

        ?>
        <!-- Instagram Item -->
        <div class="instagram_gallery_item">
            <!-- Instagram Thumb -->
            <a href="tarif/<?php echo seo($tarifcek['tarif_ad']) ?>-<?php echo $tarifcek['tarif_id'] ?>">
                <img src="<?php echo $tarifcek['tarif_resim'] ?>" alt="<?php echo $tarifcek['tarif_ad'] ?>">
                <!-- Hover -->
                <div class="profile-picture__overlay">
                    <span class="profile-picture__number">
                        <?php echo $tarifcek['tarif_ad']; ?>
                    </span>
                    
                </div></a>
            </div>

        <?php } ?>

    </div>
    <!-- ****** Our Creative Portfolio Area End ****** -->
    <!-- ****** Footer Social Icon Area Start ****** -->
    <div class="social_icon_area clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-social-area d-flex">
                        <div class="single-icon">
                            <a href="<?php echo $ayarcek['ayar_facebook'] ?>"><i class="fa fa-facebook" aria-hidden="true"></i><span>facebook</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="<?php echo $ayarcek['ayar_twitter'] ?>"><i class="fa fa-twitter" aria-hidden="true"></i><span>Twitter</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="<?php echo $ayarcek['ayar_google'] ?>"><i class="fa fa-google-plus" aria-hidden="true"></i><span>GOOGLE+</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="<?php echo $ayarcek['ayar_linkedin'] ?>"><i class="fa fa-linkedin"
                                aria-hidden="true"></i><span>linkedin</span></a>
                            </div>
                            <div class="single-icon">
                                <a href="<?php echo $ayarcek['ayar_instagram'] ?>"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
                            </div>
                            <div class="single-icon">
                                <a href="<?php echo $ayarcek['ayar_vimeo'] ?>"><i class="fa fa-vimeo" aria-hidden="true"></i><span>VIMEO</span></a>
                            </div>
                            <div class="single-icon">
                                <a href="<?php echo $ayarcek['ayar_youtube'] ?>"><i class="fa fa-youtube-play" aria-hidden="true"></i><span>YOUTUBE</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ****** Footer Social Icon Area End ****** -->

        <!-- ****** Footer Menu Area Start ****** -->
        <footer class="footer_area">
           

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Copywrite Text -->
                        <div class="copy_right_text text-center">
                            <p>Her hakkı saklıdır. © 2020 Aradığın Lezzet by <a href="">Selcuk Ozdemir, Enis karslıoglu</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>



        <div class="search-model" style="display: none;">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch">+</div>
                <form method="post" action="nedmin/netting/islem.php" class="search-model-form">
                    <input name="search"   type="text" id="search-input" placeholder="Aradığınız tarifi girin.....">
                    
                    <div class="d-flex justify-content-center mt-2 ">
                        <button  name="ara" class="btn btn-secondary" type="submit" id="button-addon2">Ara</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- ****** Footer Menu Area End ****** -->

        <!-- Jquery-2.2.4 js -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <!-- Popper js -->
        <script src="js/bootstrap/popper.min.js"></script>
        <!-- Bootstrap-4 js -->
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <!-- All Plugins JS -->
        <script src="js/others/plugins.js"></script>
        <!-- Active JS -->
        <script src="js/active.js"></script>

        <!-- Profil  -->
        <script src="js/app.js"></script><script>
            $( "#musterigiris" ).click(function() {
              $("#login").modal('hide');
          });
      </script>

  </body>