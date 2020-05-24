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
            <form action="../netting/adminislem.php" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">




             <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarif Ad <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="tarif_ad" class=" form-tarif-gonder form-control form-control-lg " id="tarif_ad" placeholder="Tarifinizin adını giriniz.">
              </div>
            </div>

            <!-- Kategori seçme başlangıç -->


            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Seç<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">

                <select name="kategori_id" class="form-control " id="kategori_id">
                  <?php
                  $kategorisor = $db->prepare("SELECT * FROM kategori order by kategori_sira ASC");
                  $kategorisor->execute();

                  while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                    ?>

                    <option value="<?php echo $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></option>

                  <?php } ?>
                </select>
              </div>
            </div>




            <!-- kategori seçme bitiş -->

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Püf Noktaları, Pişirme ve Servis Öneriler <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <textarea class="form-control" name="tarif_lezzet" id="tarif_lezzet" rows="3" placeholder="Tarifinizin lezzetinden bassedin."></textarea>
             </div>
           </div>



           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mazemeler <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
             <textarea class="form-control" name="tarif_mazemeler" id="tarif_mazemeler" placeholder="Tarifinizin mazemelerini yazınız."></textarea>


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
           <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text ">Tikla</span>
            </div>
            <div class="custom-file ">
              <input type="file" name="tarif_resim" class="custom-file-input " id="tarif_resim">
              <label class="custom-file-label" for="tarif_resim">Yemeğinizin tiklayarak resmini ekleyin.</label>
            </div>
          </div>
        </div>
      </div>



      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kaç kişilik ? <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" name="tarif_kackisilik" class="form-control" id="inputCity">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hazırlanma süresi ? <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input class="form-control" name="tarif_hazirlanma" type="text" id="inputState">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pişirme süresi ? <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" name="tarif_pisirme" class="form-control" id="inputZip">
        </div>
      </div>





      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarif Nasıl Yapılır <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <textarea name="tarif_nasilyapilir" class="form-control text-center" id="tarif_nasilyapilir" rows="3" placeholder="Tarifinizin nasıl yapıldığını anlatın."></textarea>


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

          <textarea name="tarif_oneri" class="form-control text-center" id="tarif_oneri" rows="3" placeholder="Tarifinizin lezzetinden bassedin."></textarea>
          <script>
            CKEDITOR.replace('tarif_oneri', {
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



      <!-- Ck Editör Bitiş -->



      <input type="hidden" name="tarif_id" value="<?php echo $_GET['tarif_id'] ?>"> 

      <div class="ln_solid"></div>
      <div class="form-group">
        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <button type="submit" name="tarifkaydet" class="btn btn-success">Güncelle</button>
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
