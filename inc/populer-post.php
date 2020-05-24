
<?php 


$tarifsor = $db->prepare("SELECT * FROM tarif WHERE tarif_durum=:tarif_durum order by tarif_hit desc limit 5");
$tarifsor->execute(array(
	'tarif_durum' => 1
));




?>




<!-- Single Widget Area -->
<div class="single-widget-area popular-post-widget populer-post">
	<div class="widget-title text-center">
		<a href="en-iyi-tarifler"><h6>Popüler Paylaşımlar</h6></a>
	</div>


	<?php while($tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC)){ ?>
		<!-- Single Popular Post -->

		<a  href="tarif/<?php echo ($tarifcek['tarif_seourl']) ?>" class="single-populer-post d-flex flex-row">

			<img src="<?php echo $tarifcek['tarif_resim'] ?>" alt="<?php echo $tarifcek['tarif_ad'] ?>">

			<div class="post-content">
			
					<h6><?php echo $tarifcek['tarif_ad'] ?></h6>
			
				<p><?php 
				$date = explode(" ", $tarifcek['tarif_zaman']);
				echo $date[0]; ?></p>
			</div>
		</a>
	<?php } ?>

	
</div>
