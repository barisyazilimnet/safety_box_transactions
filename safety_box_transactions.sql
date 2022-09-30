-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 17 Ağu 2022, 11:54:24
-- Sunucu sürümü: 8.0.27
-- PHP Sürümü: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `deneme`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tablo1`
--

DROP TABLE IF EXISTS `tablo1`;
CREATE TABLE IF NOT EXISTS `tablo1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(250) NOT NULL,
  `debt` int NOT NULL,
  `receivable` int NOT NULL,
  `add_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `tablo1`
--

INSERT INTO `tablo1` (`id`, `customer_name`, `debt`, `receivable`, `add_date`) VALUES
(1, 'müşteri1', 800, 500, '2022-05-18 21:23:26'),
(2, 'müşteri2', 275, 250, '2022-06-23 21:23:34'),
(3, 'müşteri3', 275, 200, '2022-06-23 21:23:36'),
(4, 'müşteri4', 250, 100, '2022-05-18 21:23:26'),
(5, 'müşteri5', 275, 50, '2022-06-23 21:23:34'),
(6, 'müşteri6', 275, 50, '2022-06-23 21:23:36'),
(7, 'müşteri7', 250, 500, '2022-05-18 21:23:26'),
(8, 'müşteri8', 275, 300, '2022-06-23 21:23:34'),
(9, 'müşteri9', 275, 50, '2022-06-23 21:23:36'),
(10, 'müşteri10', 250, 500, '2022-05-18 21:23:26'),
(11, 'müşteri11', 275, 1000, '2022-06-23 21:23:34'),
(12, 'müşteri12', 275, 50, '2022-03-08 21:23:36');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
