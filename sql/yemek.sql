-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 22 Nis 2020, 19:18:17
-- Sunucu sürümü: 5.7.17-log
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `yemek`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayar`
--

CREATE TABLE `ayar` (
  `ayar_id` int(11) NOT NULL,
  `ayar_logo` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_url` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_title` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_description` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_keywords` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_author` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_gsm` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_faks` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_mail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_ilce` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_il` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_adres` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_mesai` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_maps` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_analystic` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_zopim` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_facebook` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_twitter` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_google` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_youtube` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtphost` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtpuser` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtppassword` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtpport` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_bakim` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ayar`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hakkimizda`
--

CREATE TABLE `hakkimizda` (
  `hakkimizda_id` int(11) NOT NULL,
  `hakkimizda_baslik` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizda_icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizda_video` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizda_vizyon` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizda_misyon` varchar(500) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hakkimizda`
--


-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_ad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kategori_resim` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `kategori_onecikar` enum('0','1') COLLATE utf8_turkish_ci NOT NULL,
  `kategori_seourl` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `kategori_sira` int(2) NOT NULL,
  `kategori_durum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `kullanici_id` int(11) NOT NULL,
  `subMerchantKey` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_profilfoto` varchar(250) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'dimg/magaza-fotoyok.png',
  `kullanici_zaman` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kullanici_sonzaman` datetime NOT NULL,
  `kullanici_adi` varchar(55) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_adsoyad` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_cinsiyet` text COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_mail` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_password` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_il` varchar(22) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_biyo` varchar(22) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_facebook` varchar(22) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_twitter` varchar(22) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_instagram` varchar(22) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_youtube` varchar(22) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_yetki` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_durum` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_ust` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `menu_ad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `menu_detay` text COLLATE utf8_turkish_ci NOT NULL,
  `menu_url` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `menu_sira` int(2) NOT NULL,
  `menu_durum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL,
  `menu_seourl` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_ad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `slider_resimyol` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `slider_sira` int(2) NOT NULL,
  `slider_link` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `slider_durum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `takip`
--

CREATE TABLE `takip` (
  `takip_id` int(11) NOT NULL,
  `takip_eden` int(11) NOT NULL,
  `takip_edilen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tarif`
--

CREATE TABLE `tarif` (
  `tarif_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `tarif_hit` int(11) NOT NULL,
  `tarif_zaman` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tarif_ad` varchar(55) NOT NULL,
  `tarif_lezzet` text NOT NULL,
  `tarif_mazemeler` text NOT NULL,
  `tarif_seourl` varchar(22) NOT NULL,
  `tarif_detay` text NOT NULL,
  `tarif_resim` varchar(55) NOT NULL,
  `tarif_video` varchar(55) NOT NULL,
  `tarif_kackisilik` char(22) NOT NULL,
  `tarif_hazirlanma` char(22) NOT NULL,
  `tarif_pisirme` char(22) NOT NULL,
  `tarif_durum` enum('0','1') NOT NULL DEFAULT '0',
  `tarif_onecikar` enum('0','1') NOT NULL DEFAULT '0',
  `tarif_nasilyapilir` text NOT NULL,
  `tarif_oneri` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `yorum_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `tarif_id` int(11) NOT NULL,
  `yorum_detay` text COLLATE utf8_turkish_ci NOT NULL,
  `yorum_zaman` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `yorum_onay` enum('0','1') COLLATE utf8_turkish_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayar`
--
ALTER TABLE `ayar`
  ADD PRIMARY KEY (`ayar_id`);

--
-- Tablo için indeksler `hakkimizda`
--
ALTER TABLE `hakkimizda`
  ADD PRIMARY KEY (`hakkimizda_id`);

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`kullanici_id`);

--
-- Tablo için indeksler `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Tablo için indeksler `takip`
--
ALTER TABLE `takip`
  ADD PRIMARY KEY (`takip_id`);

--
-- Tablo için indeksler `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`tarif_id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`yorum_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `kullanici_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
--
-- Tablo için AUTO_INCREMENT değeri `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Tablo için AUTO_INCREMENT değeri `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `takip`
--
ALTER TABLE `takip`
  MODIFY `takip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Tablo için AUTO_INCREMENT değeri `tarif`
--
ALTER TABLE `tarif`
  MODIFY `tarif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `yorum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
