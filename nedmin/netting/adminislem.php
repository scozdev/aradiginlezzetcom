<?php 


ob_start();
session_start();

include 'baglan.php';
include '../production/fonksiyon.php';





if (isset($_POST['tarifkaydet'])) {


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
		'tarif_seourl' => htmlspecialchars(seo($_POST['tarif_ad']))
		
	));

	if ($insert) {

		Header("Location:../../tarif-gonder?durum=ok");

	} else {

		Header("Location:../../tarif-gonder?durum=no");
	}




}

















// ben öncesi


if (isset($_POST['admingiris'])) {

	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);
	$kullanici_password=md5(htmlspecialchars($_POST['kullanici_password']));

	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_password=:password and kullanici_yetki=:yetki");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'password' => $kullanici_password,
		'yetki' => 5
	));

	echo $say=$kullanicisor->rowCount();

	if ($say==1) {

		$_SESSION['kullanici_mail']=$kullanici_mail;
		header("Location:../production/index.php");
		exit;



	} else {

		header("Location:../production/login.php?durum=no");
		exit;
	}
	

}


if (isset($_POST['logoduzenle'])) {

	if($_FILES['ayar_logo']['size']>1048576){
		echo "Bu dosya boyutu çok büyük";
		Header("Location:../production/genel-ayar.php?durum=dosyabuyuk");
	}
	
	$izinli_uzantılar=array('jpg','png');

	$ext=strtolower(substr($_FILES['ayar_logo']['name'], strpos($_FILES['ayar_logo']['name'], '.')+1));

	if(in_array($ext, $izinli_uzantılar)==false){
		echo 'Bu uzantı kabul edilmiyor';
		Header('Location:../production/genel-ayar.php?durum=formathata');
		exit;
	}

	$uploads_dir = '../../dimg';

	@$tmp_name = $_FILES['ayar_logo']["tmp_name"];
	@$name = $_FILES['ayar_logo']["name"];

	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.$name;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");

	
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'logo' => $refimgyol
	));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/genel-ayar.php?durum=ok");

	} else {

		Header("Location:../production/genel-ayar.php?durum=no");
	}

}



if (isset($_POST['adminkullaniciduzenle'])) {

	
	$kullanici_id = $_POST['kullanici_id'];
	

	$kullaniciguncelle=$db->prepare("UPDATE kullanici SET
		kullanici_ad=:kullanici_ad,
		kullanici_soyad=:kullanici_soyad,
		kullanici_tc=:kullanici_tc,
		kullanici_gsm=:kullanici_gsm,
		kullanici_adres=:kullanici_adres,
		kullanici_il=:kullanici_il,
		kullanici_ilce=:kullanici_ilce,
		kullanici_durum=:kullanici_durum

		WHERE kullanici_id={$kullanici_id}");

	$update=$kullaniciguncelle->execute(array(
		'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
		'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
		'kullanici_tc' => htmlspecialchars($_POST['kullanici_tc']),
		'kullanici_gsm' => htmlspecialchars($_POST['kullanici_gsm']),
		'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
		'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
		'kullanici_ilce' => htmlspecialchars($_POST['kullanici_ilce']),
		'kullanici_durum' => htmlspecialchars($_POST['kullanici_durum'])

	));


	if ($update) {

		Header("Location:../production/kullanici-duzenle.php?durum=ok&kullanici_id=$kullanici_id");

	} else {

		Header("Location:../production/kullanici-duzenle.php?durum=no&kullanici_id=$kullanici_id");
	}

}



if ($_GET["magazaonay"]=="red") {

	$kullaniciguncelle=$db->prepare("UPDATE kullanici SET
		kullanici_magaza=:kullanici_magaza

		WHERE kullanici_id={$_GET['kullanici_id']}");

	$update=$kullaniciguncelle->execute(array(
		'kullanici_magaza' => 0

	));


	if ($update) {

		Header("Location:../production/magazalar.php?durum=ok");

	} else {

		Header("Location:../production/magazalar.php?durum=no");

	}

}



if(isset($_POST['magazaonaykayit'])){
	

	$kullaniciguncelle=$db->prepare("UPDATE kullanici SET
		kullanici_ad=:kullanici_ad,
		kullanici_soyad=:kullanici_soyad,
		kullanici_gsm=:kullanici_gsm,
		kullanici_banka=:kullanici_banka,
		kullanici_iban=:kullanici_iban,
		kullanici_tip=:kullanici_tip,
		kullanici_tc=:kullanici_tc,
		kullanici_unvan=:kullanici_unvan,
		kullanici_vdaire=:kullanici_vdaire,		
		kullanici_vno=:kullanici_vno,
		kullanici_adres=:kullanici_adres,
		kullanici_il=:kullanici_il,
		kullanici_ilce=:kullanici_ilce,
		kullanici_magaza=:kullanici_magaza


		WHERE kullanici_id={$_POST['kullanici_id']}");

	$update=$kullaniciguncelle->execute(array(
		'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
		'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
		'kullanici_gsm' => htmlspecialchars($_POST['kullanici_gsm']),
		'kullanici_banka' => htmlspecialchars($_POST['kullanici_banka']),
		'kullanici_iban' => htmlspecialchars($_POST['kullanici_iban']),
		'kullanici_tip' => htmlspecialchars($_POST['kullanici_tip']),
		'kullanici_tc' => htmlspecialchars($_POST['kullanici_tc']),
		'kullanici_unvan' => htmlspecialchars($_POST['kullanici_unvan']),
		'kullanici_vdaire' => htmlspecialchars($_POST['kullanici_vdaire']),
		'kullanici_vno' => htmlspecialchars($_POST['kullanici_vno']),
		'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
		'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
		'kullanici_ilce' => htmlspecialchars($_POST['kullanici_ilce']),
		'kullanici_magaza' => 2
	));


	if ($update) {

		Header("Location:../production/magazalar.php?durum=ok");

	} else {

		Header("Location:../production/magazalar.php?durum=no");

	}

	


}


if (isset($_POST['kullaniciresimguncelle'])) {


	if($_FILES['kullanici_magazafoto']['size']>1048576){
		echo "Bu dosya boyutu çok büyük";
		Header("Location:../../profil-resim-guncelle?durum=dosyabuyuk");
	}
	
	$izinli_uzantılar=array('jpg','png');

	$ext=strtolower(substr($_FILES['kullanici_magazafoto']['name'], strpos($_FILES['kullanici_magazafoto']['name'], '.')+1));

	if(in_array($ext, $izinli_uzantılar)==false){
		echo 'Bu uzantı kabul edilmiyor';
		Header('Location:../../profil-resim-guncelle?durum=formathata');
		exit;
	}

	@$tmp_name = $_FILES['kullanici_magazafoto']["tmp_name"];
	// türkçe karakter içerirse patlamaması için seo fonksiyonu kullandım
	@$name = seo($_FILES['kullanici_magazafoto']["name"]);

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
		kullanici_magazafoto=:kullanici_magazafoto
		WHERE kullanici_id={$_SESSION['kullanici_id']}");
	$update=$duzenle->execute(array(
		'kullanici_magazafoto' => $refimgyol
	));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../../profil-resim-guncelle?durum=ok");

	} else {

		Header("Location:../../profil-resim-guncelle?durum=no");
	}

}



// magaza urun ekleme
if (isset($_POST['magazaurunekle'])) {


	if($_FILES['urunfoto_resimyol']['size']>1048576){
		echo "Bu dosya boyutu çok büyük";
		Header("Location:../../urun-ekle?durum=dosyabuyuk");
	}
	
	$izinli_uzantılar=array('jpg','png');

	$ext=strtolower(substr($_FILES['urunfoto_resimyol']['name'], strpos($_FILES['urunfoto_resimyol']['name'], '.')+1));

	if(in_array($ext, $izinli_uzantılar)==false){
		echo 'Bu uzantı kabul edilmiyor';
		Header('Location:../../urun-ekle?durum=formathata');
		exit;
	}

	@$tmp_name = $_FILES['urunfoto_resimyol']["tmp_name"];
	// türkçe karakter içerirse patlamaması için seo fonksiyonu kullandım
	@$name = seo($_FILES['urunfoto_resimyol']["name"]);

	// image resize işlemleri
	include('SimpleImage.php');
	$image = new SimpleImage();
	$image->load($tmp_name);
	$image->resize(829,422);
	$image->save($tmp_name);


	$uploads_dir = '../../dimg/urunfoto';



	$benzersizsayi4=uniqid();
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.".".$ext;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4.$ext");

	
	$duzenle=$db->prepare("INSERT INTO urun SET
		kategori_id=:kategori_id,
		kullanici_id=:kullanici_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urunfoto_resimyol=:urunfoto_resimyol

		");
	$update=$duzenle->execute(array(
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']),
		'urun_ad' => htmlspecialchars($_POST['urun_ad']),
		'urun_detay' => htmlspecialchars($_POST['urun_detay']),
		'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat']),
		'urunfoto_resimyol' => $refimgyol
	));



	if ($update) {

		Header("Location:../../urunlerim?durum=ok");

	} else {

		Header("Location:../../urun-ekle?durum=hata");
	}

}


if (isset($_POST['magazaurunduzenle'])) {

// FOTOGRAF VARSA İSLEMLER
	if($_FILES['urunfoto_resimyol']['size']>0){

		if($_FILES['urunfoto_resimyol']['size']>1048576){
			echo "Bu dosya boyutu çok büyük";
			Header("Location:../../urun-duzenle?durum=dosyabuyuk");
		}

		$izinli_uzantılar=array('jpg','png');

		$ext=strtolower(substr($_FILES['urunfoto_resimyol']['name'], strpos($_FILES['urunfoto_resimyol']['name'], '.')+1));

		if(in_array($ext, $izinli_uzantılar)==false){
			echo 'Bu uzantı kabul edilmiyor';
			Header('Location:../../urun-duzenle?durum=formathata');
			exit;
		}

		@$tmp_name = $_FILES['urunfoto_resimyol']["tmp_name"];
	// türkçe karakter içerirse patlamaması için seo fonksiyonu kullandım
		@$name = seo($_FILES['urunfoto_resimyol']["name"]);

	// image resize işlemleri
		include('SimpleImage.php');
		$image = new SimpleImage();
		$image->load($tmp_name);
		$image->resize(829,422);
		$image->save($tmp_name);


		$uploads_dir = '../../dimg/urunfoto';



		$benzersizsayi4=uniqid();
		$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.".".$ext;

		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4.$ext");


		$duzenle=$db->prepare("UPDATE urun SET
			kategori_id=:kategori_id,
			urun_ad=:urun_ad,
			urun_detay=:urun_detay,
			urun_fiyat=:urun_fiyat,
			urunfoto_resimyol=:urunfoto_resimyol

			WHERE urun_id={$_POST['urun_id']}");

		
		$update=$duzenle->execute(array(
			'kategori_id' => htmlspecialchars($_POST['kategori_id']),
			'urun_ad' => htmlspecialchars($_POST['urun_ad']),
			'urun_detay' => htmlspecialchars($_POST['urun_detay']),
			'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat']),
			'urunfoto_resimyol' => $refimgyol
		));


		$urun_id = $_POST['urun_id'];
		if ($update) {

			$resimsilunlink=$_POST['eski_yol'];
			unlink("../../$resimsilunlink");
			Header("Location:../../urun-duzenle?durum=ok&urun_id=$urun_id");

		} else {

			Header("Location:../../urun-duzenle?durum=hata&urun_id=$urun_id");
		}


	}else{

	// FOTOGRAF YOKSA İSLEMLER
		

		$duzenle=$db->prepare("UPDATE urun SET
			kategori_id=:kategori_id,
			urun_ad=:urun_ad,
			urun_detay=:urun_detay,
			urun_fiyat=:urun_fiyat
			

			WHERE urun_id={$_POST['urun_id']}");

		
		$update=$duzenle->execute(array(
			'kategori_id' => htmlspecialchars($_POST['kategori_id']),
			'urun_ad' => htmlspecialchars($_POST['urun_ad']),
			'urun_detay' => htmlspecialchars($_POST['urun_detay']),
			'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat'])
			
		));


		$urun_id = $_POST['urun_id'];
		if ($update) {

			Header("Location:../../urun-duzenle?durum=ok&urun_id=$urun_id");

		} else {

			Header("Location:../../urun-duzenle?durum=hata&urun_id=$urun_id");
		}




	}

}


if(($_GET['urunsil']=='ok')){
	$sil=$db->prepare("DELETE from urun where urun_id=:urun_id");
	$kontrol=$sil->execute(array(
		'urun_id' => $_GET['urun_id']
	));

	if ($kontrol) {

		$resimsilunlink=$_GET['urun_resimyol'];
		unlink("../../$resimsilunlink");

		Header("Location:../../urunlerim.php?durum=ok");

	} else {

		Header("Location:../../urunlerim.php?durum=hata");
	}
}





if (isset($_POST['kategoriduzenle'])) {

	$kategori_id=$_POST['kategori_id'];
	$kategori_seourl=seo($_POST['kategori_ad']);


	$kaydet=$db->prepare("UPDATE kategori SET
		kategori_ad=:ad,
		kategori_durum=:kategori_durum,	
		kategori_seourl=:seourl,
		kategori_title=:kategori_title,
		kategori_description=:kategori_description,
		kategori_keywords=:kategori_keywords,
		kategori_onecikar=:kategori_onecikar,
		kategori_sira=:sira
		WHERE kategori_id={$_POST['kategori_id']}");
	$update=$kaydet->execute(array(
		'ad' => htmlspecialchars($_POST['kategori_ad']),
		'kategori_durum' => htmlspecialchars($_POST['kategori_durum']),
		'seourl' => htmlspecialchars($kategori_seourl),
		'kategori_title' => ($_POST['kategori_title']),
		'kategori_description' => $_POST['kategori_description'],
		'kategori_keywords' => $_POST['kategori_keywords'],
		'kategori_onecikar' => htmlspecialchars($_POST['kategori_onecikar']),
		'sira' => htmlspecialchars($_POST['kategori_sira'])		
	));

	if ($update) {

		Header("Location:../production/kategori-duzenle.php?durum=ok&kategori_id=$kategori_id");

	} else {

		Header("Location:../production/kategori-duzenle.php?durum=no&kategori_id=$kategori_id");
	}

}





?>