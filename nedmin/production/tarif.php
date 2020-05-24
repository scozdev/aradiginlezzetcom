<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$tarifsor=$db->prepare("SELECT * FROM tarif order by tarif_id DESC");
$tarifsor->execute();


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tarif Listeleme <small>,

              <?php 

              if ($_GET['durum']=="ok") {?>

                <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

                <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>


            </small></h2>

            <div class="clearfix"></div>

            <div align="right">
              <a href="tarif-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>

            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Tarif Ad</th>
                    <th>Tarif Seo URL</th>
                  <th>Öne Çıkar</th>
                  <th>Durum</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php 

                $say=0;

                while($tarifcek=$tarifsor->fetch(PDO::FETCH_ASSOC)) { $say++?>


                  <tr>
                   <td width="20"><?php echo $say ?></td>
                   <td><?php echo $tarifcek['tarif_ad'] ?></td>
                   
                   <td>
                    <form method="POST" action="../netting/islem.php">
                      <input type="text" name="tarif_seourl" value="<?php echo $tarifcek['tarif_seourl'] ?>">
                      <input type="hidden" name="tarif_id" value="<?php echo $tarifcek['tarif_id'] ?>">
                      <button name="seourlduzenle" type="submit">Duzenle</button>
                    </form>
                  </td>

                   <td><center>
                    <?php 

                    if ($tarifcek['tarif_onecikar']==0) {?>

                     <a href="../netting/islem.php?tarif_id=<?php echo $tarifcek['tarif_id'] ?>&tarif_one=1&tarif_onecikar=ok"><button class="btn btn-success btn-xs">Ön Çıkar</button></a>


                   <?php } elseif ($tarifcek['tarif_onecikar']==1) {?>


                     <a href="../netting/islem.php?tarif_id=<?php echo $tarifcek['tarif_id'] ?>&tarif_one=0&tarif_onecikar=ok"><button class="btn btn-warning btn-xs">Kaldır</button></a>

                   <?php } ?>


                 </center></td>




                 <td><center>

                  <?php 

                  if ($tarifcek['tarif_durum']==0) {?>

                    <a href="../netting/islem.php?tarif_id=<?php echo $tarifcek['tarif_id'] ?>&tarif_one=1&tarif_durum=ok"><button class="btn btn-warning btn-xs">Aktif Et</button></a>

                  <?php } elseif ($tarifcek['tarif_durum']==1) {?>

                   <a href="../netting/islem.php?tarif_id=<?php echo $tarifcek['tarif_id'] ?>&tarif_one=0&tarif_durum=ok"><button class="btn btn-danger btn-xs">Pasif Et</button></a>

                 <?php } ?>

               </center></td>




               <td><center><a href="tarif-duzenle.php?tarif_id=<?php echo $tarifcek['tarif_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
               <td><center><a href="../netting/islem.php?tarif_id=<?php echo $tarifcek['tarif_id']; ?>&tarifsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
             </tr>



           <?php  }

           ?>


         </tbody>
       </table>

       <!-- Div İçerik Bitişi -->


     </div>
   </div>
 </div>
</div>




</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
