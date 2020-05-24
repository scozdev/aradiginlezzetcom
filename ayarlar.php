<?php require_once './inc/header.php';

islemkontrol();
?>


<div class="container pb-3">
    <form  action="nedmin/netting/kullanici.php" method="post" enctype="multipart/form-data" >
        <div class="row my-4">
            <div class="col-sm col-12 border-right">
                <h3 style="color:#CC2E38;" class="px-4 my-4">Kişisel Bilgiler</h3>

                <div class="form-group row px-4 pb-1">
                    <label for="kullanici_adi" class="col-sm-4 col-form-label">Kullanıcı Adı</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control p-2"  id="kullanici_adi" style="height: 45px;" disabled="" value="<?php echo $kullanicicek['kullanici_adi'] ?>">
                    </div>
                </div>
                <div class="form-group row px-4 py-1">
                    <label for="kullanici_mail" class="col-sm-4 col-form-label">E-Posta Adresi</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control p-2"  id="kullanici_mail" style="height: 45px;" disabled="" value="<?php echo $kullanicicek['kullanici_mail'] ?>">
                    </div>
                </div>
                <div class="form-group row px-4 py-1">
                    <label for="kullanici_adsoyad" class="col-sm-4 col-form-label">Ad Soyad</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control p-2" name="kullanici_adsoyad" id="kullanici_adsoyad" style="height: 45px;" value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>">
                    </div>
                </div>

                <div class="form-group row px-4 py-1">
                    <label for="kullanici_cinsiyet" class="col-sm-4 col-form-label">Cinsiyet</label>
                    <div class="col-sm-8">
                       <select class="custom-select form-control p-2" name="kullanici_cinsiyet" id="kullanici_cinsiyet" style="height: 45px;">    
                           <option <?php echo $kullanicicek['kullanici_cinsiyet']=='kadın'?selected:''  ?> value="kadın">Kadın</option>
                           <option <?php echo $kullanicicek['kullanici_cinsiyet']=='erkek'?selected:''  ?> value="erkek">Erkek</option>
                           <option <?php echo $kullanicicek['kullanici_cinsiyet']=='diğer'?selected:''  ?> value="diğer">Diğer</option>
                       </select>
                   </div>
               </div>
               <div class="form-group row px-4 py-1">
                <label for="kullanici_il" class="col-sm-4 col-form-label">Şehir</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control p-2" name="kullanici_il" id="kullanici_il" style="height: 45px;" value="<?php echo $kullanicicek['kullanici_il'] ?>">
                </div>
            </div>



        </div>
        <div class="col-sm col-12">

            <h3 style="color:#CC2E38;" class="px-3 my-4">Sosyal Medya Hesapları</h3>
            <div class="input-group  mx-3 w-75 pb-2">
                <div class="input-group-prepend mt-2">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i style="color: #CC2E38;" class="fa fa-facebook"></i><span class="ml-2">facebook.com/</span></span>
                </div>
                <input type="text" name="kullanici_facebook" class="form-control border-ayar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="<?php echo $kullanicicek['kullanici_facebook'] ?>">
            </div>
            <div class="input-group  mx-3 w-75  pb-2">
                <div class="input-group-prepend mt-2">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i style="color: #CC2E38;" class="fa fa-instagram"></i><span class="ml-2">instagram.com/</span></span>
                </div>
                <input type="text" name="kullanici_instagram" class="form-control border-ayar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="<?php echo $kullanicicek['kullanici_instagram'] ?>">
            </div>
            <div class="input-group  mx-3 w-75 pb-2">
                <div class="input-group-prepend mt-2">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i style="color: #CC2E38;" class="fa fa-twitter"></i><span class="ml-2">twitter.com/</span></span>
                </div>
                <input type="text"  name="kullanici_twitter" class="form-control border-ayar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="<?php echo $kullanicicek['kullanici_twitter'] ?>">
            </div>
            <div class="input-group  mx-3 w-75 pb-2">
                <div class="input-group-prepend mt-2">
                    <span class="input-group-text" id="inputGroup-sizing-lg"><i style="color: #CC2E38;" class="fa fa-youtube"></i><span class="ml-2">youtube.com/</span></span>
                </div>
                <input type="text" name="kullanici_youtube" class="form-control border-ayar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="<?php echo $kullanicicek['kullanici_youtube'] ?>">
            </div>

            <div class="mx-3 w-75 py-5 my-5 mx-sm-3 w-sm-75 py-sm-5 my-sm-5">
                <button type="submit" name="profilupdate" class="btn btn-danger float-right">Ayarları Kaydet</button>
            </div>

        </div>

    </div>



</form>
</div>






<?php require_once './inc/footer.php' ?>