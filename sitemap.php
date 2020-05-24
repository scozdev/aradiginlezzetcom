<?php header('Content-type: application/xml; charset="utf8"',true); ?>



<urlset 



xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"

xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"

xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"

xmlns:example="http://www.example.com/schemas/example_schema">



<!-- namespace extension -->

<?php 
date_default_timezone_set('Europe/Istanbul');

include "nedmin/production/fonksiyon.php";

include "nedmin/netting/baglan.php";





?>



<!-- Tekli Linkler -->

<url>

	<loc>https://<?php echo $_SERVER['HTTP_HOST'];?>/</loc>

	<lastmod><?php echo "2020-04-23"; ?></lastmod>

	<changefreq>daily</changefreq>

	<priority>1</priority>

</url>

<url>

	<loc>https://<?php echo $_SERVER['HTTP_HOST'];?>/kategori</loc>

	<lastmod><?php echo "2020-04-23"; ?></lastmod>

	<changefreq>daily</changefreq>

	<priority>0.9</priority>

</url>

<url>

	<loc>https://<?php echo $_SERVER['HTTP_HOST'];?>/en-iyi-tarifler</loc>

	<lastmod><?php echo "2020-04-23"; ?></lastmod>

	<changefreq>daily</changefreq>

	<priority>0.8</priority>

</url>

<url>

	<loc>https://<?php echo $_SERVER['HTTP_HOST'];?>/iletisim</loc>

	<lastmod><?php echo "2020-04-23"; ?></lastmod>

	<changefreq>daily</changefreq>

	<priority>0.4</priority>

</url>

<!-- Tarif Linkler -->



<?php 



$tarifsor=$db->prepare("SELECT * FROM tarif where tarif_durum=:durum");

$tarifsor->execute(array(

	'durum' => 1

));



while($tarifcek=$tarifsor->fetch(PDO::FETCH_ASSOC)) {?>



<url>

	<loc>https://<?php echo $_SERVER['HTTP_HOST'];?>/tarif/<?php echo $tarifcek['tarif_seourl'] ?></loc>

	<lastmod><?php $ddate =explode(' ', $tarifcek['tarif_zaman']); echo $ddate[0]; ?></lastmod>

	<changefreq>daily</changefreq>

	<priority>0.7</priority>

</url>



<?php } ?>


<!-- Kategori Linkler -->



<?php 



$kategorisor=$db->prepare("SELECT * FROM kategori where kategori_durum=:durum");

$kategorisor->execute(array(

	'durum' => 1

));



while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {?>



<url>

	<loc>https://<?php echo $_SERVER['HTTP_HOST'];?>/kategori/<?php echo seo($kategoricek['kategori_ad']) ?></loc>

		<lastmod><?php echo "2020-04-25"; ?></lastmod>

	<changefreq>daily</changefreq>

	<priority>0.6</priority>

</url>



<?php } ?>


<!-- Profiller Linkler -->



<?php 



$usersor=$db->prepare("SELECT * FROM kullanici where kullanici_durum=:durum");

$usersor->execute(array(

	'durum' => 1

));



while($usercek=$usersor->fetch(PDO::FETCH_ASSOC)) {?>



<url>

	<loc>https://<?php echo $_SERVER['HTTP_HOST'];?>/profil/<?php echo seo($usercek['kullanici_adi']) ?></loc>

	<lastmod><?php $ddate =explode(' ', $usercek['kullanici_zaman']); echo $ddate[0]; ?></lastmod>


	<changefreq>daily</changefreq>

	<priority>0.4</priority>

</url>



<?php } ?>

</urlset>