<?php
require_once './inc/header.php';

$sef = $_GET['sef'];

// if(!empty($_SESSION['userkullanici_id']) && isset($_GET['sef']) && $_GET['sef']==$kullanicicek['kullanici_adi']){
// 	$sef = $_GET['sef'];
// 	Header("Location:../profil");


// }else if(!empty($_SESSION['userkullanici_id']) && !isset($_GET['sef'])){
// 	$sef = $kullanicicek['kullanici_adi'];

// 	// Header("Location:404.php");
// 	// exit;	
// }else if($kullanicicek['kullanici_adi']==$_GET['sef']){
// 	$sef = $kullanicicek['kullanici_adi'];


// 	// exit;	
// }else if(isset($_GET['sef'])){
// 	$sef =  $_GET['sef'];
// 	// Header("Location:404.php");
// 	// exit;	
// }



$girisyapanadi = $kullanicicek['kullanici_adi'];



$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_adi=:kullanici_adi");
$kullanicisor->execute(array(
	'kullanici_adi' => $sef
));

$say=$kullanicisor->rowCount();

if ($say==0) {

	Header("Location:404.php");
}

$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);


?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $kullanicicek['kullanici_adsoyad']==""?$kullanicicek['kullanici_adi']:$kullanicicek['kullanici_adsoyad'] ?> - Yazar | aradiginlezzet.com</title>
	<link href="css/css/style.css" rel="stylesheet">
	<meta name="viewport"
	content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	
	<meta name="description" content="Yemek Tarifleri, Tarif, nefis ve pratik yemek tarifleri, püf noktaları, videolar, öğreten içerikler...">
  <meta name="keywords" content="Profil, Yemek, Yemek Tarifleri, Tarif, Tatlı Tarifleri">
  <meta name="author" content="<?php echo $kullanicicek['kullanici_adi'] ?>">
</head>




<main class="profile-container">

	<section class="profile">
		<header class="profile__header">
			<div class="profile__avatar-container">
				<img src="<?php echo $kullanicicek['kullanici_profilfoto'] ?>" class="profile__avatar" />
			</div>
			<div class="profile__info">
				<div class="profile__name">
					<h1 class="profile__title"><?php echo $kullanicicek['kullanici_adi'] ?></h1>
					
					<?php if($girisyapanadi===$_GET['sef'] ) {?>
						<a href="ayarlar" class="profile__button u-fat-text">Profil Düzenle</a>

						<i class="fa fa-cog fa-2x" id="cog"></i>
					<?php } ?>
				</div>
				<ul class="profile__numbers">
					<li class="profile__posts">
						<span class="profile__number u-fat-text">0</span> <span style="font-weight: 400;">posts</span>
					</li>
					<li class="profile__followers">
						<span class="profile__number u-fat-text">0</span> <span style="font-weight: 400;">followers</span>
					</li>
					<li class="profile__following">
						<span class="profile__number u-fat-text">0</span> <span style="font-weight: 400;">following</span>
					</li>
				</ul>
				<div class="profile__bio">
					<span class="profile__full-name u-fat-text"><?php echo $kullanicicek['kullanici_adsoyad'] ?></span>
					<br>
					<p class="profile__full-bio mt-1 d-inline-block"><?php echo $kullanicicek['kullanici_biyo'] ?>.</p>
				</div>
			</div>
		</header>







		<div  class="fx7hk"><a style="color: #262626;" class="_9VEo1 " href="/se1cuq/"><span class="smsjF">
			<i class="fa fa-list"></i>
			<span class="PJXu4">Gönderiler</span></span></a>

			<?php if(!empty($_SESSION['userkullanici_id']) && $girisyapanadi===$_GET['sef']) {?>
				<a class="_9VEo1 " href="/se1cuq/saved/"><span
					class="smsjF">

					<i class="far fa-bookmark"></i>

					<span class="PJXu4">Kaydedilenler</span></span></a>

				<?php } ?>

			</div>
