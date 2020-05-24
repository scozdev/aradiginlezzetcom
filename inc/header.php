<?php


ob_start();
date_default_timezone_set('Europe/Istanbul');
session_start();
require_once 'nedmin/netting/baglan.php';
require_once 'nedmin/production/fonksiyon.php';

//Site ayarlarını çekiyoruz
$ayarsor = $db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
    'id' => 0
));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);


// giriş yapan kullanici bilgileri
if (isset($_SESSION['kullanici_adi'])) {
    $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_adi=:kullanici_adi");
    $kullanicisor->execute(array(
        'kullanici_adi' => $_SESSION['kullanici_adi']
    ));
    $say = $kullanicisor->rowCount();
    $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

    if (!isset($_SESSION['userkullanici_id'])) {
        $_SESSION['userkullanici_id'] = $kullanicicek['kullanici_id'];
    }
}


?>
<base href="https://aradiginlezzet.com/">
<!DOCTYPE html>
<html lang="tr">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    
   
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-site-verification" content="SMhGYCdLI3jgaUqELu-PP7OItx8mhcEVBZx8adlpjho" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="alternate" href="https://aradiginlezzet.com/" hreflang="tr" /> 
    
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" /> -->
    <!-- Favicon -->
    <link rel="icon" href="img/core-img/eat.png">
    
  
    <!-- Core Stylesheet -->
    <link href="style.css" rel="stylesheet">
    
     <link href="css/others/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet"  >
 
    <!-- Responsive CSS -->
    <link href="css/responsive/responsive.css" rel="stylesheet">

    
</head>

<body>
    <!-- Preloader Start -->
   <!--  <div id="preloader">
        <div class="yummy-load"></div>
    </div> -->

    <?php 

    if ($_GET['durum']=="hata") {?>

        <div class="alert alert-danger">
            <div class="container"><strong>Hata!</strong> Hatalı Giriş</div>
            
        </div>                   

    <?php } else if ($_GET['durum']=="exit") { ?>

        <div class="alert alert-success">
            <div class="container"><strong>Bilgi!</strong> Başarıyla Çıkış Yapıldı</div>
        </div>                   

    <?php } else if ($_GET['durum']=="kayitok") {?>

        <div class="alert alert-success">
            <div class="container"><strong>Bilgi!</strong> Kaydınız başarılı giriş yapabilirsiniz.</div>
        </div>                   

    <?php } else if ($_GET['durum']=="captchahata") {?>

        <div class="alert alert-danger">
            <div class="container"> <strong>Hata!</strong> Güvenlik Kodu Hatalı</div>
        </div>                   

    <?php } else if ($_GET['durum']=="adkullaniliyor") {?>
        <div class="alert alert-danger">
            <div class="container"><strong>Hata!</strong> Bu kullanıcı adı kullanılıyor. Lütfen başka bir kullanıcı adı ile tekrar deneyin...</div>

        </div>                   

    <?php } else if ($_GET['durum']=="mailkullaniliyor") {?>
        <div class="alert alert-danger">
            <div class="container"><strong>Hata!</strong> Bu mail adresi kullanılıyor. Lütfen başka bir mail adresi ile deneyin...</div>

        </div>                   

    <?php } else if ($_GET['durum']=="eksiksifre") {?>
        <div class="alert alert-danger">
          <div class="container">  <strong>Hata!</strong> Şifreniz 6 karakterden fazla olmalıdır...</div>

      </div>                   

  <?php } ?>



  <!-- Modal Başlangıç -->


  <div class="modal fade" id="sifremiunuttum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Şifre Sıfırlama</h4>

            </div>
            <div class="modal-body">
                <form action="mailphp/sifremi-unuttum.php" method="POST">
                    <div class="form-group">
                        <p><b>Uyarı:</b> Girdiğiniz mail adresi kayıtlarımızda varsa şifreniz mail adresinize gönderilecektir.</p>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Mail Adresiniz:</label>
                        <input type="email" class="form-control" name="kullanici_mail" id="recipient-name">
                    </div>



                    <div class="modal-footer p-0 pt-1">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <button type="submit" name="sifremiunuttum" class="btn btn-primary">Şifre Talep Et</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Bitiş -->
<!-- Modal -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Kayıt Ol</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="nedmin/netting/kullanici.php">
                    <input type="hidden" name="_token" value="">
                    <div class="form-group">
                        <label class="control-label">Kullanıcı Adı:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">aradiginlezzet.com/profil/ </div>
                            </div>
                            <input type="text" class="form-control input-lg" name="username" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">E-posta veya Telefon</label>
                        <div>
                            <input type="email" class="form-control input-lg" name="email" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Şifre</label>
                        <div>
                            <input type="password" class="form-control input-lg" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <button type="submit" name="userregister" class="btn btn-success">
                                Kayıt ol
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Giriş</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="nedmin/netting/kullanici.php">
                    <input type="hidden" name="_token" value="">
                    <div class="form-group">
                        <label class="control-label">Kullanıcı Adı</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="username"

                            <?php  if(isset($_COOKIE['kadi'])) { ?>
                                value="<?php echo $_COOKIE['kadi'] ?>"

                            <?php }else{ ?>
                                value=""
                            <?php } ?>
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Şİfre</label>
                        <div>
                            <input type="password" class="form-control input-lg" name="password"

                            <?php  if(isset($_COOKIE['kadi'])) { ?>
                                value="<?php echo $_COOKIE['pass'] ?>"

                            <?php } ?>
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input <?php echo isset($_COOKIE['kadi'])?"checked":"" ?> type="checkbox" name="remember"> Beni Hatırla
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-success" name="userlogin">Giriş</button>
                            <button id="musterigiris" type="button" class="btn btn-danger" data-toggle="modal" data-target="#sifremiunuttum" >Şifremi Unuttum</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Yeni Nav -->
<nav id="nav" class="navbar navbar-expand-lg navbar-light ">
    <div class="container d-flex flex-row">
        <a style="font-family: 'Roboto', sans-serif;font-size: 22px; font-weight: 700; color: #CC2E38;" class="navbar-brand" href="index">aradiginlezzet<span id="c">.com</span></a>



        <form  action="nedmin/netting/islem.php" method="POST"  class="input-group w-50 d-none d-md-flex">
            <div class="input-group-prepend">
                <button name="ara"  type="submit" style="background-color: #fff" class="input-group-text border-right-0" id="navSearch">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <input type="search" name="search" class="form-control border-left-0 p-0" placeholder="Aramak istediğiniz tarifi yazın.." aria-label="Search">
        </form>


        <div class="navbar-nav d-flex flex-row">




            <li class="nav-item d-none">

                <div style="font-family: Inter,sans-serif !important; font-size: 18px;" class="d-flex align-items-center">
                    <div style="display: inline-flex;;cursor: pointer;" class="css-2xu2nf ebrn5c20"><svg viewBox="0 0 24 24" height="52" width="52">
                        <path fill="#C01F54" fill-rule="evenodd" d="M12,2 C6.48,2 2,6.48 2,12 C2,17.52 6.48,22 12,22 C17.52,22 22,17.52 22,12 C22,6.48 17.52,2 12,2 Z M12,5 C13.66,5 15,6.34 15,8 C15,9.66 13.66,11 12,11 C10.34,11 9,9.66 9,8 C9,6.34 10.34,5 12,5 Z M12,19.2 C9.5,19.2 7.29,17.92 6,15.98 C6.03,13.99 10,12.9 12,12.9 C13.99,12.9 17.97,13.99 18,15.98 C16.71,17.92 14.5,19.2 12,19.2 Z">
                        </path>
                    </svg></div>
                    <div style="flex-direction: column;" class="d-flex css-a9t1a1 ebrn5c20"><span style="margin: 0;
                    padding: 0;
                    font-size: 13px;" class="css-gciat2 e1f47bfa0">Tarif / Yazı Göndermek
                İçin</span>
                <div class="css-61sb6s ebrn5c20"><span class="css-2omkjp e1f47bfa0">Üye Ol</span><span> /
                </span><span class="css-2omkjp e1f47bfa0">Giriş Yap</span></div>
            </div>
        </div>

    </li>

    <?php if (!isset($_SESSION['userkullanici_id'])) { ?>
        <li class="nav-item">

            <!-- Button trigger modal -->

            <button class="btn page-bg text-white btn-sm mr-2" type="button" data-toggle="modal" data-target="#login">Giriş Yap</button>
            <button class="btn page-bg text-white btn-sm" type="button" data-toggle="modal" data-target="#register">Kaydol</button>
        </li>
    <?php } else { ?>
        <li class="nav-item mr-2  align-self-center">
            <a href="tarif-gonder" class="btn page-bg text-white font-nav btn-sm ">Tarif Gönder</a>
        </li>


        <li class="nav-item ">
            <div class="dropdown show">
                <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <div class="media media-pill text-dark align-items-center">
                        <span style="width: 38px;height: 38px;" class="avatar rounded-circle">
                            <img style="width: 100%;border-radius: 50%;" alt="Image placeholder" src="./dimg/user3.png">
                        </span>
                        <div class="ml-2 d-none d-md-block">
                            <span class="mb-0 text-sm  font-weight-bold"><?php echo $kullanicicek['kullanici_adsoyad'] == '' ? 'Hesap Ayarları' : $kullanicicek['kullanici_adsoyad'] ?></span>
                        </div>
                    </div>


                </a>

                <div style="position: absolute !important; right: 0 !important; left: auto !important;" class="dropdown-menu dropdown-menu-right position-absolute font-nav" aria-labelledby="dropdownMenuLink" >
                    <a class="dropdown-item" href="profil/<?php echo $kullanicicek['kullanici_adi'] ?>"><span><i class="fa fa-user-circle"></i></span>Profil</a>
                    <a class="dropdown-item" href="ayarlar"><span><i class="fa fa-cog"></i></span>Ayarlar</a>
                    <a class="dropdown-item" href="dir/logout"><span><i class="fa fa-sign-out"></i></span>Çıkış</a>
                </div>
            </div>
        </li>
    <?php } ?>

</div>





</div>
</nav>

<!-- Yeni Nav -->

<!-- ****** Header Area Start ****** -->
<header class="header_area navbar navbar-expand-lg d-flex justify-content-center">




    <!-- Menu Area Start -->

    <ul class="navbar-nav flex-row justify-content-between" id="yummy-nav">

        <li class="nav-item d-none">
            <div class="input-group mx-auto" style="width: 85%;">
                <div class="input-group-prepend">
                    <span style="background-color: #fff" class="input-group-text border-right-0" id="navSearch">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
                <input type="search" class="form-control border-left-0 p-0" placeholder="Search" aria-label="Search">
            </div>
        </li>

        <li class="nav-item <?php echo ($_SERVER['SCRIPT_NAME'] == "/index.php")?"active":""; ?> ">
            <a class="nav-link" href="index"><span class="d-none d-md-block">Anasayfa</span>
               <span class="d-md-none"><i class="fa fa-home"></i></span>
           </a>
       </li>



       <li class="d-md-none nav-item <?php echo ($_SERVER['SCRIPT_NAME'] == "/iletisim.php")?"active":""; ?> ">
        <a id="search-bottom" class="nav-link" href="javascript:void(0)"><span class="d-none d-md-block">Search</span>
            <span class="d-md-none"><i class="fa fa-search"></i></span>
        </a>
    </li>


    <li class="nav-item <?php echo ($_SERVER['SCRIPT_NAME'] == "/kategori.php")?"active":""; ?> ">
        <a class="nav-link" href="kategori"><span class="d-none d-md-block">Kategoriler</span>
            <span class="d-md-none"><i class="fa fa-book"></i></span>
        </a>
    </li>
    <li class="nav-item <?php echo ($_SERVER['SCRIPT_NAME'] == "/en-iyi-tarifler.php")?"active":""; ?> ">
        <a class="nav-link" href="en-iyi-tarifler"><span class="d-none d-md-block">Popüler Paylaşımlar</span>
            <span class="d-md-none"><i class="fa fa-bookmark"></i></span>
        </a>
    </li>

    <li class="d-none d-md-block nav-item <?php echo ($_SERVER['SCRIPT_NAME'] == "/iletisim.php")?"active":""; ?> ">
        <a class="nav-link" href="iletisim"><span class="d-none d-md-block">İletişim</span>
            <span class="d-md-none"><i class="fa fa-user"></i></span>
        </a>
    </li>
    <li class="d-md-none nav-item <?php echo ($_SERVER['SCRIPT_NAME'] == "https://aradiginlezzet.com/profil/")?"active":""; ?> ">
        <a class="nav-link" href="<?php if(isset($_SESSION['kullanici_adi'])){ ?>profil/<?php echo $kullanicicek['kullanici_adi'] ?><?php } ?>"><span class="d-none d-md-block">User</span>
            <span class="d-md-none"><i class="fa fa-user"></i></span>
        </a>
    </li>

</ul>



</header>
<!-- ****** Header Area End ****** -->

