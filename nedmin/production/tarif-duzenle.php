<?php 

include 'header.php'; 


$tarifsor=$db->prepare("SELECT * FROM tarif where tarif_id=:id");
$tarifsor->execute(array(
  'id' => $_GET['tarif_id']
));

$tarifcek=$tarifsor->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tarif Düzenleme <small>,

              <?php 

              if ($_GET['durum']=="ok") {?>

                <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

                <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>


            </small></h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />



            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">




             <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarif Ad <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="tarif_ad" value="<?php echo $tarifcek['tarif_ad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <!-- Kategori seçme başlangıç -->


            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Seç<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">

                <?php  

                $tarif_id=$tarifcek['kategori_id']; 

                $kategorisor=$db->prepare("select * from kategori  order by kategori_sira");
                $kategorisor->execute();

                ?>
                <select class="select2_multiple form-control" required="" name="kategori_id" >


                 <?php 

                 while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {

                   $kategori_id=$kategoricek['kategori_id'];

                   ?>

                   <option <?php if ($kategori_id==$tarif_id) { echo "selected='select'"; } ?> value="<?php echo $kategoricek['kategori_id']; ?>"><?php echo $kategoricek['kategori_ad']; ?></option>

                 <?php } ?>

               </select>
             </div>
           </div>


           <!-- kategori seçme bitiş -->


           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarifinizin lezzetinden bassedin. <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea name="tarif_lezzet" class="form-control text-center"  rows="3"  ><?php echo $tarifcek['tarif_lezzet'] ?></textarea>
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mazemeler <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea class="form-control" name="tarif_mazemeler" id="tarif_mazemeler" ><?php echo $tarifcek['tarif_mazemeler'] ?></textarea>


              <script>
                CKEDITOR.replace('tarif_mazemeler', {
                  height: 100,

                  toolbarGroups: [{
                    "name": "basicstyles",
                    "groups": ["basicstyles"]
                  },

                  {
                    "name": "paragraph",
                    "groups": ["list", "blocks"]
                  }


                  ],
                  removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
                });
              </script>
            </div>
          </div>








          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarif Resim <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <img width="200" src="../../<?php echo $tarifcek['tarif_resim'] ?>">
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarif Kaç Kişilik <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="tarif_kackisilik" value="<?php echo $tarifcek['tarif_kackisilik'] ?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hazırlama süresi <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="tarif_hazirlanma" value="<?php echo $tarifcek['tarif_hazirlanma'] ?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pişirme süresi <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="tarif_pisirme" value="<?php echo $tarifcek['tarif_pisirme'] ?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarif Nasıl Yapılır <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              
              <textarea name="tarif_nasilyapilir" class="form-control text-center" id="tarif_nasilyapilir" rows="3" placeholder="Tarifinizin nasıl yapıldığını anlatın."><?php echo $tarifcek['tarif_nasilyapilir'] ?></textarea>


              <script>
                CKEDITOR.replace('tarif_nasilyapilir', {
                  height: 100,

                  toolbarGroups: [{
                    "name": "basicstyles",
                    "groups": ["basicstyles"]
                  },

                  {
                    "name": "paragraph",
                    "groups": ["list", "blocks"]
                  }


                  ],
                  removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
                });
              </script>
            </div>
          </div>
          <!-- Ck Editör Başlangıç -->

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Püf Noktaları, Pişirme ve Servis Önerileri <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">

              <textarea  class="ckeditor" id="editor1" name="tarif_oneri"><?php echo $tarifcek['tarif_oneri']; ?></textarea>
            </div>
          </div>

          <script type="text/javascript">

           CKEDITOR.replace( 'editor1',

           {

            filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

            filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

            filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',

            filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

            filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

            filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

            forcePasteAsPlainText: true

          } 

          );

        </script>

        <!-- Ck Editör Bitiş -->



        <input type="hidden" name="tarif_id" value="<?php echo $_GET['tarif_id'] ?>"> 

        <div class="ln_solid"></div>
        <div class="form-group">
          <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" name="tarifduzenle" class="btn btn-success">Güncelle</button>
          </div>
        </div>

      </form>



    </div>
  </div>
</div>
</div>



<hr>
<hr>
<hr>



</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
