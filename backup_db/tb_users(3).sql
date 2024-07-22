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
-- Table structure for table `tb_users`
--

DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE IF NOT EXISTS `tb_users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL DEFAULT '0',
  `idmenu` text,
  `id_level` varchar(100) DEFAULT '2',
  `idlevel` varchar(50) DEFAULT '1,2,3,4',
  `id_divisi` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nama_lembaga` varchar(100) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `no_hp` varchar(30) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `hak_akses` int(11) NOT NULL DEFAULT '0',
  `type_akses` varchar(50) NOT NULL DEFAULT '0',
  `id_session` varchar(100) DEFAULT NULL,
  `sesi_login` varchar(100) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `verify` int(11) NOT NULL DEFAULT '0',
  `pangkat` varchar(50) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `nrp` varchar(20) DEFAULT NULL,
  `hapus` int(1) NOT NULL DEFAULT '0',
  `lock_menu` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `parent`, `idmenu`, `id_level`, `idlevel`, `id_divisi`, `password`, `nama_lengkap`, `nama_lembaga`, `tgl_daftar`, `alamat`, `email`, `no_hp`, `foto`, `level`, `aktif`, `hak_akses`, `type_akses`, `id_session`, `sesi_login`, `logo`, `verify`, `pangkat`, `jabatan`, `nrp`, `hapus`, `lock_menu`) VALUES
(1, 0, '141,112,139,210,211,239,242,207,208,209,231,212,213,214,215,229,230,236,234,237', '1', '1,2,3,4,5,6,7,8', '1', '$2y$10$Ex7KCGGbS5ROpIbuwsHFHe1KE6Gzt4Y.qJByLSfXGGunlhgkNFIzK', 'Admin SBST', 'GUDANG FASMAT', '2021-04-22', NULL, 'admin', '089611274798', NULL, 'admin', 'Y', 1, '1,2,3,4,5,6,7,13,14', '2R86je3fod', '00f284ba3ccd6ce18415c62975ebcd6dc0351be0', NULL, 1, '-', '-', '1', 0, 0),
(13, 1, '141,212,214,220,221,222,223,224,241,225,226,227,240,215,229,236,237', '2', '1,2,3,4,5,6', '1', '$2y$10$thpt/hBWBFa1ubyCs8lrY.bSwSE3NH05zmLPtMGEthG2VLvU5kbCi', 'Fasmat Tangerang', 'POLRESTA TANGERANG', '2022-06-13', NULL, 'fasmat.tangerang', NULL, NULL, 'satker', 'Y', 0, '1,2,3,4,5,6,7,13,14', NULL, 'tus45923n1d03lbmv05418kcqib5timm', NULL, 0, '-', '-', '-', 0, 1),
(15, 1, '141,212,214,220,221,222,223,224,241,225,226,227,240,215,229,236,237', '5', '1,2,3,4,5,6', '1', '$2y$10$LyhIdWcGCz13/fS6Nhy5MeJ9WkuljHJb16t4GWfizGQTQu/8ybquO', 'Fasmat Lebak', 'POLRES LEBAK', '2022-11-10', NULL, 'fasmat.lebak', NULL, NULL, 'satker', 'Y', 0, '1,2,3,4,5,6,7,13,14', NULL, 'poo8ascegagdf7nn2e9esfbgo1kpshs5', NULL, 0, '-', '-', '-', 0, 1),
(18, 1, '141,112,210,212,214,220,221,225,227,215,229,236,237', '8', '8', '1', '$2y$10$DYfmARKTygTtwtRSueSSBO3jsLPckY83XvaPJZtsV7WnHIMeHZZXK', 'Ditlantas Polda Banten', 'DITLANTAS', '2022-11-15', NULL, 'ditlantas', NULL, NULL, 'satker', 'Y', 0, '1,5,7', NULL, '4ha7v5pulmebjpsf02k3nlsujq2ji2e3', NULL, 0, '-', '-', '-', 0, 0),
(19, 1, '141,212,214,220,221,222,223,224,241,225,226,227,240,215,229,236,237', '4', '1,2,3,4,5,6', '1', '$2y$10$aoCigO4HuOcnKnq/xd9osePnpkxcDaFHSkFwJlPCJT4TCDI2mo7xO', 'Fasmat Serang', 'POLRES SERANG', '2022-11-30', NULL, 'fasmat.serang', NULL, NULL, 'satker', 'Y', 0, '1,2,3,4,5,6,7,13,14', NULL, 'g06hcgvjjboo9fah5hjf5gg7fqnc87dj', NULL, 0, '-', '-', '-', 0, 1),
(20, 1, '141,212,214,220,221,222,223,224,241,225,226,227,240,215,229,236,237', '7', '1,2,3,4,5,6', '1', '$2y$10$Pf7TdztcOdBWBstA1Rnt1eR57xhgsrdZpMF.CgFGaohQprOo6EHH6', 'Fasmat Pandeglang', 'POLRES PANDEGLANG', '2022-11-30', NULL, 'fasmat.pandeglang', NULL, NULL, 'satker', 'Y', 0, '1,2,3,4,5,6,7,13,14', NULL, 'nul7f9hu82kldhnsj12knbocbuluoth9', NULL, 0, '12345', '-', '-', 0, 1),
(21, 1, '141,212,214,220,221,222,223,224,241,225,226,227,240,215,229,236,237', '6', '1,2,3,4,5,6', '1', '$2y$10$jyc6pK8CsdivACNaI0VYG.jU9M2QYOuIFNiYJ45u774pjynFl4YMe', 'Fasmat Cilegon', 'POLRES CILEGON', '2022-11-30', NULL, 'fasmat.cilegon', NULL, NULL, 'satker', 'Y', 0, '1,2,3,4,5,6,7,13,14', NULL, 'qm4ghtuq86optg6uk3hlgeicv3q2i6ji', NULL, 0, '12345', '-', '-', 0, 1),
(22, 1, '141,212,214,220,221,222,223,224,241,225,226,227,240,215,229,236,237', '3', '1,2,3,4,5,6', '1', '$2y$10$CIUzZzsa0L2LOcV73VA6UOLz1rU8J9JsNdkuKkBmX4JZAvOpoeGha', 'Herman', 'POLRES SERANG KOTA', '2022-12-01', NULL, 'fasmat.serangkota', NULL, NULL, 'satker', 'Y', 0, '1,2,3,4,5,6,7,13,14', NULL, 'hivc4s6f3lefmgveeghof338uqdq4u36', NULL, 0, 'Briptu', '-ba regident samsat serang kota', '-96110509', 0, 1),
(23, 1, '141,112,210,212,214,220,222,223,224,226,240,215,229,236,237', '9', '9', '1', '$2y$10$7/cWXMvzNLQD2R/ACyqAzesjVEE2Cl5BSQVvZLv3G.8PhAIIKpu9.', 'User Samsat Balaraja', 'STNK SAMSAT BALARAJA', '2023-02-03', NULL, 'samsat.balaraja', NULL, NULL, 'satker', 'Y', 0, '2,3,4,6,13', NULL, 'k6ihcunllf6vf1jr9orjhiciqcfvashe', NULL, 0, '-', '-', '-', 0, 1),
(24, 1, '141,112,210,212,214,220,222,223,224,226,240,215,229,236,237', '10', '10', '1', '$2y$10$PRfqW8HcQ2cvqc8xZArWOu/ktQagfu25t22adQWRfUeb52FksW4ku', 'User Samsat Malingping', 'STNK DITLANTAS', '2023-02-03', NULL, 'samsat.malingping', NULL, NULL, 'satker', 'Y', 0, '2,3,4,6,13', NULL, '06pg5i4un7vhp6nqfsct88thmem47dru', NULL, 0, '-', '-', '-', 0, 1),
(31, 18, '141,220,221,227,215,229,236,237', '8', '8', '1', '$2y$10$qq3YBt7A5Aig2oyQRlpW1.UlTXl3GyBYv96z7DZB3fkEnzY4n95ZG', 'User SIM DITLANTAS', 'DITLANTAS', '2023-02-28', NULL, 'sim.ditlantas', NULL, NULL, 'satker', 'Y', 0, '1,7', NULL, 'jgnun3anm0fuuofpplnmhod3dt72i9mk', NULL, 0, '-', '-', '-', 0, 1),
(32, 18, '141,220,225,215,229,236,237', '8', '8', '1', '$2y$10$sQvh8cNsok63WyV4lAi71eJkRe3jFESxGzgB2lfIsqC4xepz3f.dK', 'USER STCK DITLANTAS', 'DITLANTAS', '2023-02-28', NULL, 'stck.ditlantas', NULL, NULL, 'satker', 'Y', 0, '5', NULL, '064bkgbk4qk609obi421hivn261529o1', NULL, 0, '-', '-', '-', 0, 1),
(33, 24, '141,220,222,215,229,236,237', '10', '10', '1', '$2y$10$49D0z2F.isIDstDxU4yFGuE9r7ycfq2sMlJ1M2CvdyT14gwj.hRDS', 'USER BPKB MALINGPING', 'SAMSAT MASLINGPING', '2023-02-28', NULL, 'bpkb.malingping', NULL, NULL, 'satker', 'Y', 0, '2', NULL, '1n0aevthe82q4aqj3t17kg194j9kctk3', NULL, 0, '-', '-', '-', 0, 1),
(34, 23, '141,220,222,215,229,236,237', '9', '9', '1', '$2y$10$bEAHxeVMqnFY1d9XWmXWEOIA1JOff4HLRpH.0EOOJeRbQmqUNX2Ba', 'user bpkb balaraja', 'samsat balaraja', '2023-03-02', NULL, 'bpkb.balaraja', NULL, NULL, 'satker', 'Y', 0, '2', NULL, '4vcd1nssvovkhubfdqqdrmt9g27vlabp', NULL, 0, '-', '-', '-', 0, 1),
(35, 1, '141,212,214,215,229,236,237', '12', '12', '17', '$2y$10$5l40gF6CagoeY8rvDXbETugHi8kxZJUXLOMawJ39VZaYTaXU.e.Ai', 'USER DITLANTAS BALARAJA', 'DITLANTAS POLDA BANTEN', '2023-03-08', NULL, 'ditlantas.balaraja', NULL, NULL, 'satker', 'Y', 0, '2', NULL, '50d062f03d5e2b57d30a848ebc0e932570c47314', NULL, 0, '-', '-', '-', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
