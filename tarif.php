


<?php require_once 'inc/user-header.php'; ?>

<?php

$tarifsor = $db->prepare("SELECT * FROM tarif inner join kullanici on tarif.kullanici_id=kullanici.kullanici_id  WHERE kullanici_adi=:kullanici_adi");
$tarifsor->execute(array(
	'kullanici_adi' => $_GET["sef"]
));


$say=$tarifsor->rowCount();

if ($say==0) {

	header("Location:index.php?durum=oynasma");
	exit;
}


?>
<div class="">
	<div class="d-flex align-items-center justify-content-between mb-3">
		<h5 class="mb-0">Recent photos</h5><a href="#" class="btn btn-link text-muted">Show all</a>
	</div>
	<div class="row">

		<?php 

		while ($tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC)) {


			?>
			<!-- start -->
			<!-- Single Post -->
			<div class="col-md-4">

				<div class="single-post wow fadeInUp" data-wow-delay=".6s">
					<!-- Post Thumb -->
					<div class="post-thumb">
						<img src="<?php echo $tarifcek['tarif_resim'] ?>" alt="<?php echo seo($tarifcek['tarif_ad']) ?>">
					</div>
					<!-- Post Content -->
					<div class="post-content">
						<div class="post-meta d-flex">
							<div class="post-author-date-area d-flex">
								<!-- Post Author -->
								<div class="post-author">
									<a href="#"><?php echo $tarifcek['kullanici_adi'] ?></a>
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
									<a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> 10</a>
								</div>
								<!-- Post Comments -->
								<div class="post-comments">
									<a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i> 12</a>
								</div>
								<!-- Post Share -->
								<div class="post-share">
									<a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>

						<a href="tarif-<?php echo seo($tarifcek['tarif_ad']) ?>-<?php echo $tarifcek['tarif_id'] ?>"><h4 class="post-headline">  
							<?php echo $tarifcek['tarif_ad'] ?>

						</h4>  </a>

					</div>
				</div>

			</div>

			<!-- end -->



		<?php } ?>


	</div>




</div>

</div>
</div>
</div>



</div>	



<?php require_once 'inc/footer.php' ?>