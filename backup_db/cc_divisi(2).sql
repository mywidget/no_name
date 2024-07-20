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
-- Table structure for table `cc_divisi`
--

DROP TABLE IF EXISTS `cc_divisi`;
CREATE TABLE IF NOT EXISTS `cc_divisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idparent` int(5) NOT NULL DEFAULT '0',
  `id_level_divisi` varchar(50) DEFAULT '1,2,3,4',
  `nama_divisi` varchar(50) DEFAULT NULL,
  `nama_rekapan` varchar(100) DEFAULT NULL,
  `stat` int(1) DEFAULT '1',
  `urutan` int(5) NOT NULL DEFAULT '0',
  `hapus` int(1) NOT NULL DEFAULT '0',
  `sim` int(11) NOT NULL DEFAULT '1',
  `stnk` int(11) NOT NULL DEFAULT '1',
  `bpkb` int(11) NOT NULL DEFAULT '1',
  `tnkb` int(11) NOT NULL DEFAULT '1',
  `tckb` int(11) NOT NULL DEFAULT '1',
  `stck` int(11) NOT NULL DEFAULT '1',
  `mutasi` int(11) NOT NULL DEFAULT '1',
  `skukp` int(11) NOT NULL DEFAULT '1',
  `nrkb` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cc_divisi`
--

INSERT INTO `cc_divisi` (`id`, `idparent`, `id_level_divisi`, `nama_divisi`, `nama_rekapan`, `stat`, `urutan`, `hapus`, `sim`, `stnk`, `bpkb`, `tnkb`, `tckb`, `stck`, `mutasi`, `skukp`, `nrkb`) VALUES
(1, 0, '1,8', 'DITLANTAS', 'DITLANTAS POLDA', 1, 0, 0, 1, 0, 0, 0, 0, 1, 0, 1, 0),
(2, 0, '1,2', 'Polresta Tangerang', 'Polresta Tangerang', 1, 5, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0),
(3, 0, '1,3', 'Polresta Serang Kota', 'Polresta Serang Kota', 1, 6, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(4, 0, '1,4', 'Polres Serang', 'Polres Serang', 1, 7, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(5, 0, '1,5', 'Polres Lebak', 'Polres Lebak', 1, 8, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(6, 0, '1,6', 'Polres Cilegon', 'Polres Cilegon', 1, 9, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(7, 0, '1,7', 'Polres Pandeglang', 'Polres Pandeglang', 1, 10, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(9, 1, '1,9', 'SAMSAT BALARAJA', 'DITLANTAS/SAMSAT BALARAJA', 1, 1, 0, 0, 1, 1, 1, 1, 0, 1, 0, 1),
(10, 1, '1,10', 'SAMSAT MALINGPING', 'DITLANTAS/SAMSAT MALINGPING', 1, 2, 0, 0, 1, 1, 1, 1, 0, 1, 0, 1),
(17, 1, '1', 'BPKB BALARAJA', 'DITLANTAS/BALARAJA', 1, 3, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0),
(18, 1, '1', 'BPKB MALINGPING', 'DITLANTAS/MALINGPING', 1, 4, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
