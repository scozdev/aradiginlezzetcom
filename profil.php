<?php 


require_once 'inc/profil-header.php'; 




$tarifsor = $db->prepare("SELECT * FROM tarif  WHERE kullanici_id=:kullanici_id");
$tarifsor->execute(array(
	'kullanici_id' => $kullanicicek['kullanici_id']
));







?>




<div class="profile__pictures mb-5 my-1">
	
	<?php  while($tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC)){ ?>

		<a href="tarif/<?php echo ($tarifcek['tarif_seourl']) ?>" class="profile-picture">
			<img src="<?php echo $tarifcek['tarif_resim'] ?>" class="profile-picture__picture" />
			<div class="profile-picture__overlay">
				<span class="profile-picture__number">
					<?php echo $tarifcek['tarif_ad']; ?>
				</span>
				
			</div>

		</a>

	<?php } ?>

</div>


</section>
</main>






<div class="popUp">
	<i class="fa fa-times fa-2x" id="closePopUp"></i>
	<div class="popUp__container">
		<div class="popUp__buttons">
			<a href="index.html" class="popUp__button">Log Out</a>
			<a href="#" class="popUp__button" id="cancelPopUp">Cancel</a>
		</div>
	</div>
</div>



<?php require_once './inc/footer.php' ?>