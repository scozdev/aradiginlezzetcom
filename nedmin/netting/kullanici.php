<?php 
date_default_timezone_set('Europe/Istanbul');
ob_start();
session_start();

require_once 'baglan.php';
require_once '../production/fonksiyon.php';



if (isset($_POST['userregister'])) {

	$kullanici_adi=htmlspecialchars($_POST['username']);
	$kullanici_mail=htmlspecialchars($_POST['email']); 
	$kullanici_password=htmlspecialchars($_POST['password']);  




	if (strlen($kullanici_password)>=6) {

		$kullanicisor=$db->prepare("select * from kullanici where kullanici_adi=:kullanici_adi or kullanici_mail=:kullanici_mail");
		$kullanicisor->execute(array(
			'kullanici_mail' => $kullanici_mail,
			'kullanici_adi' => $kullanici_adi
		));

		$say=$kullanicisor->rowCount();
		$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);



		if ($say==0) {

			$password=md5($kullanici_password);

			$kullanici_yetki=1;

			$kullanicikaydet=$db->prepare("INSERT INTO kullanici SET
				kullanici_adi=:kullanici_adi,
				kullanici_mail=:kullanici_mail,
				kullanici_password=:kullanici_password,
				kullanici_yetki=:kullanici_yetki
				");
			$insert=$kullanicikaydet->execute(array(
				'kullanici_adi' => $kullanici_adi,
				'kullanici_mail' => $kullanici_mail,
				'kullanici_password' => $password,
				'kullanici_yetki' => $kullanici_yetki
			));

			if ($insert) {

				header("Location:../../index?durum=kayitok");


			} else {


				header("Location:../../index?durum=basarisiz");
			}

		} else {

			if ($kullanicicek['kullanici_adi'] === $kullanici_adi) {
				header("Location:../../index?durum=adkullaniliyor");
				exit;
			}

			if ($kullanicicek['kullanici_mail'] === $kullanici_mail) {
				header("Location:../../index?durum=mailkullaniliyor");
				exit;
			}


		}



	} else {


		header("Location:../../index?durum=eksiksifre");
		exit;

	}



}




if (isset($_POST['userlogin'])) {

	$kullanici_adi=htmlspecialchars($_POST['username']);
	$kullanici_password=md5(htmlspecialchars($_POST['password']));  



	$kullanicisor=$db->prepare("select * from kullanici where kullanici_adi=:kullanici_adi and kullanici_password=:password and kullanici_durum=:durum");
	$kullanicisor->execute(array(
		'kullanici_adi' => $kullanici_adi,
		'password' => $kullanici_password,
		'durum' => 1
	));


	$say=$kullanicisor->rowCount();

	$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
	


	if ($say==1) {

		$_SESSION['kullanici_adi']=$kullanicicek['kullanici_adi'];

		if(isset($_POST['remember'])){

			setcookie('kadi',$kullanici_adi,strtotime("+1 day"),"/");
			setcookie('pass',$_POST['password'],strtotime("+1 day"),"/");

		}else{
			setcookie('kadi',$kullanici_adi,strtotime("-1 day"),"/");
			setcookie('pass',$_POST['password'],strtotime("-1 day"),"/");
		}

		header("Location:../../index?durum=girisbasarili");
		exit;
		

	} else {


		header("Location:../../index?durum=hata");

	}


}









if(isset($_POST['profilupdate'])){


	$kullaniciguncelle=$db->prepare("UPDATE kullanici SET
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_il=:kullanici_il,
		kullanici_cinsiyet=:kullanici_cinsiyet,
		kullanici_facebook=:kullanici_facebook,
		kullanici_instagram=:kullanici_instagram,
		kullanici_twitter=:kullanici_twitter,
		kullanici_youtube=:kullanici_youtube

		WHERE kullanici_id={$_SESSION['userkullanici_id']}");

	$update=$kullaniciguncelle->execute(array(
		'kullanici_adsoyad' => htmlspecialchars($_POST['kullanici_adsoyad']),
		'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
		'kullanici_cinsiyet' => htmlspecialchars($_POST['kullanici_cinsiyet']),
		'kullanici_facebook' => htmlspecialchars($_POST['kullanici_facebook']),
		'kullanici_instagram' => htmlspecialchars($_POST['kullanici_instagram']),
		'kullanici_twitter' => htmlspecialchars($_POST['kullanici_twitter']),		
		'kullanici_youtube' => htmlspecialchars($_POST['kullanici_youtube'])

	));


	if ($update) {

		Header("Location:../../ayarlar?durum=ok");

	} else {

		Header("Location:../../ayarlar?durum=no");
	}


}




if (isset($_POST['imageupdate'])) {


	if($_FILES['kullanici_profilfoto']['size']>1048576){
		echo "Bu dosya boyutu çok büyük";
		Header("Location:../../profil-duzenle?durum=dosyabuyuk");
	}
	
	$izinli_uzantılar=array('jpg','png');

	$ext=strtolower(substr($_FILES['kullanici_profilfoto']['name'], strpos($_FILES['kullanici_profilfoto']['name'], '.')+1));

	if(in_array($ext, $izinli_uzantılar)==false){
		echo 'Bu uzantı kabul edilmiyor';
		Header('Location:../../profil-duzenle?durum=formathata');
		exit;
	}

	@$tmp_name = $_FILES['kullanici_profilfoto']["tmp_name"];
	// türkçe karakter içerirse patlamaması için seo fonksiyonu kullandım
	@$name = seo($_FILES['kullanici_profilfoto']["name"]);

	// image resize işlemleri
	include('SimpleImage.php');
	$image = new SimpleImage();
	$image->load($tmp_name);
	$image->resize(128,128);
	$image->save($tmp_name);


	$uploads_dir = '../../dimg/userphoto';



	$benzersizsayi4=uniqid();
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.".".$ext;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4.$ext");

	
	$duzenle=$db->prepare("UPDATE kullanici SET
		kullanici_profilfoto=:kullanici_profilfoto
		WHERE kullanici_id={$_SESSION['kullanici_id']}");
	$update=$duzenle->execute(array(
		'kullanici_profilfoto' => $refimgyol
	));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../../profil-duzenle?durum=ok");

	} else {

		Header("Location:../../profil-duzenle?durum=no");
	}

}







if (isset($_POST['tarifkaydet'])) {

$tarif_seourl = htmlspecialchars(seo($_POST['tarif_ad']));

	$tarifsor = $db->prepare("SELECT tarif_seourl FROM tarif where tarif_seourl=:tarif_seourl");
	$tarifsor->execute(array(
		'tarif_seourl'=>$tarif_seourl
	));
	$say = $tarifsor->rowCount();

	if($say>0){
		$tarif_seourl.=("-".$_SESSION['userkullanici_id']);
	}


	if ($_FILES['tarif_resim']['size']>1048576) {
		
		echo "Bu dosya boyutu çok büyük";

		Header("Location:../../tarif-gonder.php?durum=dosyabuyuk");
		exit;

	}

	$izinli_uzantilar=array('jpg','png');

	//echo $_FILES['ayar_logo']["name"];

	$ext=strtolower(substr($_FILES['tarif_resim']["name"],strpos($_FILES['tarif_resim']["name"],'.')+1));

	if (in_array($ext, $izinli_uzantilar) === false) {
		echo "Bu uzantı kabul edilmiyor";
		Header("Location:../../tarif-gonder.php?durum=formathata");

		exit;
	}

	@$tmp_name = $_FILES['tarif_resim']["tmp_name"];
	@$name = $_FILES['tarif_resim']["name"];

	//İmage Resize İşlemleri
	include('SimpleImage.php');
	$image = new SimpleImage();
	$image->load($tmp_name);
	$image->resize(800,534);
	$image->save($tmp_name);


	$uploads_dir = '../../dimg/tarif';
	@$tmp_name = $_FILES['tarif_resim']["tmp_name"];
	@$name = $_FILES['tarif_resim']["name"];
	
	$benzersizad=uniqid();
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	


	$kaydet=$db->prepare("INSERT INTO tarif SET
		kullanici_id =:kullanici_id,
		tarif_ad=:tarif_ad,
		kategori_id=:kategori_id,
		tarif_lezzet=:tarif_lezzet,
		tarif_mazemeler=:tarif_mazemeler,
		tarif_resim=:tarif_resim,
		tarif_kackisilik=:tarif_kackisilik,
		tarif_hazirlanma=:tarif_hazirlanma,
		tarif_pisirme=:tarif_pisirme,
		tarif_nasilyapilir=:tarif_nasilyapilir,
		tarif_oneri=:tarif_oneri,
		tarif_seourl=:tarif_seourl

		");
	$insert=$kaydet->execute(array(
		'kullanici_id'=> htmlspecialchars($_SESSION['userkullanici_id']),
		'tarif_ad' => htmlspecialchars($_POST['tarif_ad']),
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'tarif_lezzet' => htmlspecialchars($_POST['tarif_lezzet']),
		'tarif_mazemeler' => ($_POST['tarif_mazemeler']),
		'tarif_resim' => $refimgyol,
		'tarif_kackisilik' => htmlspecialchars($_POST['tarif_kackisilik']),
		'tarif_hazirlanma' => htmlspecialchars($_POST['tarif_hazirlanma']),
		'tarif_pisirme' => htmlspecialchars($_POST['tarif_pisirme']),
		'tarif_nasilyapilir' => ($_POST['tarif_nasilyapilir']),
		'tarif_oneri' => ($_POST['tarif_oneri']),
		'tarif_seourl' => $tarif_seourl
		
	));

	if ($insert) {

		Header("Location:../../tarif-gonder?durum=ok");

	} else {

		Header("Location:../../tarif-gonder?durum=no");
	}




}




if (isset($_POST['takipet'])) {


	$tarif_ad = seo($_POST['tarif_ad']);
	$tarif_seourl = $_POST['tarif_seourl'];

	$kullanicikaydet=$db->prepare("INSERT INTO takip SET
		takip_eden=:takip_eden,
		takip_edilen=:takip_edilen
		");
	$insert=$kullanicikaydet->execute(array(
		'takip_eden' => $_SESSION['userkullanici_id'],
		'takip_edilen' => $_POST['kullanici_id']
	));

	if ($insert) {

		header("Location:../../tarif/$tarif_seourl?durum=ok");


	} else {


		header("Location:../../tarif/$tarif_seourl?durum=no");
	}




}


if (isset($_POST['yorumkaydet'])) {


	$tarif_ad = seo($_POST['tarif_ad']);
	$tarif_id = $_POST['tarif_id'];

	$kaydet=$db->prepare("INSERT INTO yorumlar SET

		tarif_id=:tarif_id,
		yorum_detay=:yorum_detay,
		kullanici_id=:kullanici_id
		");

	$insert=$kaydet->execute(array(

		'tarif_id' => $_POST['tarif_id'],
		'yorum_detay' => htmlspecialchars($_POST['message']),
		'kullanici_id' => $_SESSION['userkullanici_id']

	));


	if ($insert) {

		header("Location:../../tarif/$tarif_ad-$tarif_id?durum=ok");


	} else {


		header("Location:../../tarif/$tarif_ad-$tarif_id?durum=no");
	}


}
?>