<?php require_once 'inc/header.php';

islemkontrol();
?>


<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</head>


<div>

    <div class="container py-4">
        <div class="row">


            <!--Content-->
            <div id="tarif-gonder" class="col-md-9 mx-auto">

                <?php

                if ($_GET['durum'] == "no") { ?>

                    <div class="alert alert-danger" role="alert">
                        <strong>Hata!</strong> Hatalı kısımları düzelterek yeniden deneyin.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                <?php } else if ($_GET['durum'] == "ok") { ?>

                    <div class="alert alert-primary" role="alert">
                        <strong>Bilgi!</strong> Tarifiniz Kaydedildi.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                <?php }
                ?>
                <form action="nedmin/netting/kullanici.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate>


                    <h2 class="text-center form-header py-3 border-bottom my-3 page-color font-weight-bold">Tarif Gönder</h2>

                    <div class="form-body">


                        <div class="form-group row">
                            <label for="tarif_ad" class="col-sm-1 col-form-label">
                                <i class="fa fa-pencil fa-2x"></i>
                            </label>

                            <div class="col-sm-11">
                                <!-- <label for="inputState">Püf Noktaları, Pişirme ve Servis Önerileri</label> -->
                                <input type="text" name="tarif_ad" class=" form-tarif-gonder form-control form-control-lg " id="tarif_ad" placeholder="Tarifinizin adını giriniz.">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kategori_id" class="col-sm-1 col-form-label">
                                <i class="fa fa-minus-square fa-2x"></i>
                            </label>
                            <div class="col-sm-11">
                                <label for="kategori_id">Tarif Kategorisi</label>

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


                        <div class="form-group row">
                            <label for="tarif_lezzet" class="col-sm-1 col-form-label">
                                <i class="fa fa-smile-o fa-2x"></i>
                            </label>
                            <div class="col-sm-11">
                                <label for="tarif_lezzet">Tarifinizin lezzetinden bassedin.</label>

                                <textarea class="form-control" name="tarif_lezzet" id="tarif_lezzet" rows="3" placeholder="Tarifinizin lezzetinden bassedin."></textarea>

                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="tarif_mazemeler" class="col-sm-1 col-form-label">
                              <i class="fa fa-flask fa-2x"></i>
                          </label>
                          <div class="col-sm-11">
                            <label for="tarif_mazemeler">Mazemeler</label>

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




                  <div class="form-group row">




                    <label for="tarif_resim" class="col-sm-1 col-form-label">
                        <i class="fa fa-camera fa-2x"></i>
                    </label>
                    <div class="col-sm-11">
                        <label for="tarif_resim">Tarifin Resmi</label>

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



                <div class="form-group row">

                    <label for="" class="col-sm-1 col-form-label">
                        <i class="fa fa-clock-o fa-2x"></i>
                    </label>

                    <div class="form-row col-sm-11">

                        <div class="form-group col-md-4">
                            <label for="inputCity">Kaç kişilik ?</label>
                            <input type="text" name="tarif_kackisilik" class="form-control" id="inputCity">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputState">Hazırlanma süresi ?</label>
                            <input class="form-control" name="tarif_hazirlanma" type="text" id="inputState">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputZip">Pişirme süresi ?</label>
                            <input type="text" name="tarif_pisirme" class="form-control" id="inputZip">
                        </div>

                    </div>

                </div>


                <div class="form-group row">
                    <label for="tarif_nasilyapilir" class="col-sm-1 col-form-label">
                        <i class="fa fa-wrench fa-2x"></i>
                    </label>
                    <div class="col-sm-11">
                        <label for="tarif_nasilyapilir">Nasıl yapılır ? <span class="text-muted">(Adım adım resim ekleyerek (tercihe göre) yazabilirsiniz.)</span></label>
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

              <div class="form-group row">
                <label for="tarif_oneri" class="col-sm-1 col-form-label">
                    <i class="fa fa-circle-o-notch fa-2x"></i>
                </label>
                <div class="col-sm-11">
                    <label for="tarif_oneri">Püf Noktaları, Pişirme ve Servis Önerileri</label>
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


      </div>




      <div class=" text-center">
        <button type="submit" name="tarifkaydet" class="btn btn-danger btn-xs mb-4 ml-1">Tarif Gönder</button>

    </div>




</form>


</div>


</div>
</div>

</div>



<?php require_once 'inc/footer.php' ?>

<!-- <script>

   var li = "asd";
   $('#tarif_mazemeler').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);

    if(keycode == '13'){
       $('#tarif_mazemeler').val($('#tarif_mazemeler').val()+li)
    }
});
</script> -->