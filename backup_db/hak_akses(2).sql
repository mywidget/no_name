-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 08, 2023 at 05:37 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ditlantas`
--

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

DROP TABLE IF EXISTS `hak_akses`;
CREATE TABLE IF NOT EXISTS `hak_akses` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `level` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `publish` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Y',
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id_level`, `id_parent`, `nama`, `level`, `publish`, `status`) VALUES
(1, 0, 'Administrator', 'admin', 'Y', 0),
(2, 0, 'Polresta Tangerang', 'satker', 'Y', 0),
(3, 0, 'Polresta Serang Kota', 'satker', 'Y', 0),
(4, 0, 'Polres Serang', 'satker', 'Y', 0),
(5, 0, 'Polres Lebak', 'satker', 'Y', 0),
(6, 0, 'Polres Cilegon', 'satker', 'Y', 0),
(7, 0, 'Polres Pandeglang', 'satker', 'Y', 0),
(8, 0, 'Ditlantas Polda Banten', 'satker', 'Y', 0),
(9, 0, 'SAMSAT BALARAJA', 'satker', 'Y', 0),
(10, 0, 'SAMSAT MALINGPING', 'satker', 'Y', 0),
(12, 0, 'DITLANTAS/BALARAJA', 'satker', 'Y', 0),
(13, 0, 'DITLANTAS/MALINGPING', 'satker', 'Y', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
