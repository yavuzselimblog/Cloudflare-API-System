-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 May 2023, 00:01:02
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `cloudflareapi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `adminkadi` varchar(300) NOT NULL,
  `adminposta` varchar(300) NOT NULL,
  `adminsifre` varchar(300) NOT NULL,
  `admindurum` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = aktif 2 = pasif',
  `adminkodu` varchar(300) NOT NULL,
  `adminekleyen` varchar(300) NOT NULL,
  `adminyetki` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1 admin 2 kullanıcı',
  `ekleme` tinyint(1) NOT NULL DEFAULT 1,
  `duzenleme` tinyint(1) NOT NULL DEFAULT 1,
  `silme` tinyint(1) NOT NULL DEFAULT 1,
  `listeleme` tinyint(1) NOT NULL DEFAULT 1,
  `apikey` text DEFAULT NULL,
  `apimail` varchar(300) DEFAULT NULL,
  `apiorganizasyon` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `site_baslik` varchar(300) NOT NULL,
  `site_url` varchar(300) NOT NULL,
  `defaultsite` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_baslik`, `site_url`, `defaultsite`) VALUES
(1, 'BCYSoftware', 'http://localhost/cloudflareapi', 'memordica');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dnsler`
--

CREATE TABLE `dnsler` (
  `dnsid` int(11) NOT NULL,
  `type` varchar(300) DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL,
  `content` varchar(300) DEFAULT NULL,
  `ttl` varchar(300) DEFAULT NULL,
  `proxied` varchar(300) DEFAULT NULL,
  `priority` varchar(300) DEFAULT NULL,
  `dnswebsite` text DEFAULT NULL,
  `dnsdomain` varchar(300) DEFAULT NULL,
  `dnstarih` timestamp NOT NULL DEFAULT current_timestamp(),
  `dnsdurum` tinyint(1) NOT NULL DEFAULT 1,
  `dnsekleyen` varchar(300) DEFAULT NULL,
  `cloudflareip` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `loglar`
--

CREATE TABLE `loglar` (
  `logid` int(11) NOT NULL,
  `logbaslik` varchar(300) DEFAULT NULL,
  `logsipariskodu` varchar(300) DEFAULT NULL,
  `logaciklama` text DEFAULT NULL,
  `logekleyen` varchar(300) DEFAULT NULL,
  `logtarih` timestamp NOT NULL DEFAULT current_timestamp(),
  `logip` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `websiteler`
--

CREATE TABLE `websiteler` (
  `siteid` int(11) NOT NULL,
  `sitekodu` varchar(300) DEFAULT NULL,
  `sitezone` text DEFAULT NULL,
  `siteadi` varchar(300) DEFAULT NULL,
  `sitedomain` varchar(300) DEFAULT NULL,
  `sitetarih` timestamp NOT NULL DEFAULT current_timestamp(),
  `durum` tinyint(1) NOT NULL DEFAULT 1,
  `siteip` varchar(300) DEFAULT NULL,
  `siteekleyen` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `dnsler`
--
ALTER TABLE `dnsler`
  ADD PRIMARY KEY (`dnsid`);

--
-- Tablo için indeksler `loglar`
--
ALTER TABLE `loglar`
  ADD PRIMARY KEY (`logid`);

--
-- Tablo için indeksler `websiteler`
--
ALTER TABLE `websiteler`
  ADD PRIMARY KEY (`siteid`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `dnsler`
--
ALTER TABLE `dnsler`
  MODIFY `dnsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Tablo için AUTO_INCREMENT değeri `loglar`
--
ALTER TABLE `loglar`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Tablo için AUTO_INCREMENT değeri `websiteler`
--
ALTER TABLE `websiteler`
  MODIFY `siteid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
