-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2025 at 03:42 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsibackup`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataset_dt`
--

CREATE TABLE `dataset_dt` (
  `id_dt` int(11) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `label` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataset_dt`
--

INSERT INTO `dataset_dt` (`id_dt`, `customer`, `total_qty`, `total_harga`, `label`) VALUES
(1, 'Adhi TCI', 15, 74500000, 3),
(2, 'Albert Kurniawan', 8, 130000000, 2),
(3, 'Ardi DMS', 10, 48000000, 3),
(4, 'Ardi Surya', 8, 29600000, 3),
(5, 'Bagas Adyatama', 11, 37700000, 3),
(6, 'Barata Mandiri', 15, 48000000, 3),
(7, 'BARTON', 18, 63000000, 3),
(8, 'BEP', 85, 322500000, 1),
(9, 'Buana Mandiri', 6, 21000000, 3),
(10, 'CAP Express', 18, 66600000, 3),
(11, 'Dennis MMS', 60, 210000000, 2),
(12, 'Dwi Tunggal', 20, 65400000, 3),
(13, 'Eka Mardianto', 10, 35000000, 3),
(14, 'Erlangga Mahesa', 6, 19200000, 3),
(15, 'Hendri Oktovian', 60, 192000000, 2),
(16, 'Hendro lim', 10, 32000000, 3),
(17, 'Hendry Gemilang', 29, 182500000, 2),
(18, 'Herman Priamesta', 5, 42500000, 3),
(19, 'Imam Shodiq', 17, 160000000, 2),
(20, 'Imron LJA', 66, 211200000, 2),
(21, 'Jordan CO', 48, 153600000, 2),
(22, 'Luthfi BEK', 18, 86400000, 3),
(23, 'Marco Xena', 76, 266000000, 1),
(24, 'MHK', 8, 25600000, 3),
(25, 'Mitra Mandiri Logistik', 70, 224000000, 2),
(26, 'Norick eriyadi', 10, 39000000, 3),
(27, 'Nur Hamid', 12, 38400000, 3),
(28, 'Rendragraha', 8, 68000000, 3),
(29, 'Reza Lazuardi', 18, 63200000, 3),
(30, 'Rudy NS', 90, 315000000, 1),
(31, 'Sanjaya Utama', 20, 64000000, 3),
(32, 'Santosa Bandung', 8, 68000000, 3),
(33, 'Seino', 85, 272000000, 1),
(34, 'SMP', 16, 56000000, 3),
(35, 'TBM', 2, 17000000, 3),
(36, 'Tri Guna', 22, 77000000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `dataset_dtnative`
--

CREATE TABLE `dataset_dtnative` (
  `id_dt` int(11) NOT NULL,
  `kode_customer` varchar(15) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `label` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataset_dtnative`
--

INSERT INTO `dataset_dtnative` (`id_dt`, `kode_customer`, `customer`, `total_qty`, `total_harga`, `label`) VALUES
(1, 'CUST348', 'Rudy NS', 90, 315000000, 1),
(2, 'CUST738', 'Rendragraha', 8, 68000000, 3),
(3, 'CUST323', 'Seino', 85, 272000000, 1),
(4, 'CUST303', 'Bagas Adyatama', 11, 37700000, 3),
(5, 'CUST396', 'BEP', 85, 322500000, 1),
(6, 'CUST659', 'Hendry Gemilang', 29, 182500000, 2),
(7, 'CUST284', 'Mitra Mandiri Logistik', 70, 224000000, 1),
(8, 'CUST508', 'Nur Hamid', 12, 38400000, 3),
(9, 'CUST748', 'Reza Lazuardi', 18, 63200000, 3),
(10, 'CUST591', 'Sanjaya Utama', 20, 64000000, 3),
(11, 'CUST287', 'Jordan CO', 48, 153600000, 2),
(12, 'CUST305', 'Eka Mardianto', 10, 35000000, 3),
(13, 'CUST240', 'Imron LJA', 66, 211200000, 1),
(14, 'CUST454', 'Hendro lim', 10, 32000000, 3),
(15, 'CUST258', 'SMP', 16, 56000000, 3),
(16, 'CUST462', 'Ardi DMS', 10, 48000000, 3),
(17, 'CUST341', 'Tri Guna', 22, 77000000, 3),
(18, 'CUST231', 'Herman Priamesta', 5, 42500000, 3),
(19, 'CUST515', 'Buana Mandiri', 6, 21000000, 3),
(20, 'CUST117', 'Albert Kurniawan', 8, 130000000, 3),
(21, 'CUST166', 'Imam Shodiq', 17, 160000000, 2),
(22, 'CUST344', 'Marco Xena', 76, 266000000, 1),
(23, 'CUST236', 'Erlangga Mahesa', 6, 19200000, 3),
(24, 'CUST102', 'Dwi Tunggal', 20, 65400000, 3),
(25, 'CUST355', 'Norick eriyadi', 10, 39000000, 3),
(26, 'CUST482', 'Luthfi BEK', 18, 86400000, 3),
(27, 'CUST271', 'BARTON', 18, 63000000, 3),
(28, 'CUST310', 'Santosa Bandung', 8, 68000000, 3),
(29, 'CUST237', 'CAP Express', 18, 66600000, 3),
(30, 'CUST682', 'Barata Mandiri', 15, 48000000, 3),
(31, 'CUST368', 'Adhi TCI', 15, 74500000, 3),
(32, 'CUST546', 'TBM', 2, 17000000, 3),
(33, 'CUST259', 'Dennis MMS', 60, 210000000, 2),
(34, 'CUST685', 'MHK', 8, 25600000, 3),
(35, 'CUST238', 'Hendri Oktovian', 60, 192000000, 2),
(36, 'CUST108', 'Ardi Surya', 8, 29600000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `dataset_km`
--

CREATE TABLE `dataset_km` (
  `id_ds` int(11) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `total_harga` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataset_km`
--

INSERT INTO `dataset_km` (`id_ds`, `customer`, `total_qty`, `total_harga`) VALUES
(1, 'Adhi TCI', 15, 74500000),
(2, 'Albert Kurniawan', 8, 130000000),
(3, 'Ardi DMS', 10, 48000000),
(4, 'Ardi Surya', 8, 29600000),
(5, 'Bagas Adyatama', 11, 37700000),
(6, 'Barata Mandiri', 15, 48000000),
(7, 'BARTON', 18, 63000000),
(8, 'BEP', 85, 322500000),
(9, 'Buana Mandiri', 6, 21000000),
(10, 'CAP Express', 18, 66600000),
(11, 'Dennis MMS', 60, 210000000),
(12, 'Dwi Tunggal', 20, 65400000),
(13, 'Eka Mardianto', 10, 35000000),
(14, 'Erlangga Mahesa', 6, 19200000),
(15, 'Hendri Oktovian', 60, 192000000),
(16, 'Hendro lim', 10, 32000000),
(17, 'Hendry Gemilang', 29, 182500000),
(18, 'Herman Priamesta', 5, 42500000),
(19, 'Imam Shodiq', 17, 160000000),
(20, 'Imron LJA', 66, 211200000),
(21, 'Jordan CO', 48, 153600000),
(22, 'Luthfi BEK', 18, 86400000),
(23, 'Marco Xena', 76, 266000000),
(24, 'MHK', 8, 25600000),
(25, 'Mitra Mandiri Logistik', 70, 224000000),
(26, 'Norick eriyadi', 10, 39000000),
(27, 'Nur Hamid', 12, 38400000),
(28, 'Rendragraha', 8, 68000000),
(29, 'Reza Lazuardi', 18, 63200000),
(30, 'Rudy NS', 90, 315000000),
(31, 'Sanjaya Utama', 20, 64000000),
(32, 'Santosa Bandung', 8, 68000000),
(33, 'Seino', 85, 272000000),
(34, 'SMP', 16, 56000000),
(35, 'TBM', 2, 17000000),
(36, 'Tri Guna', 22, 77000000);

-- --------------------------------------------------------

--
-- Table structure for table `dataset_kombinasipb`
--

CREATE TABLE `dataset_kombinasipb` (
  `id_dt` int(11) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `label` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataset_kombinasipb`
--

INSERT INTO `dataset_kombinasipb` (`id_dt`, `customer`, `total_qty`, `total_harga`, `label`) VALUES
(1, 'Rudy NS', 90, 315000000, 1),
(2, 'Rendragraha', 8, 68000000, 3),
(3, 'Seino', 85, 272000000, 1),
(4, 'Bagas Adyatama', 11, 37700000, 3),
(5, 'BEP', 85, 322500000, 1),
(6, 'Hendry Gemilang', 29, 182500000, 2),
(7, 'Mitra Mandiri Logistik', 70, 224000000, 2),
(8, 'Nur Hamid', 12, 38400000, 3),
(9, 'Reza Lazuardi', 18, 63200000, 3),
(10, 'Sanjaya Utama', 20, 64000000, 3),
(11, 'Jordan CO', 48, 153600000, 2),
(12, 'Eka Mardianto', 10, 35000000, 3),
(13, 'Imron LJA', 66, 211200000, 2),
(14, 'Hendro lim', 10, 32000000, 3),
(15, 'SMP', 16, 56000000, 3),
(16, 'Ardi DMS', 10, 48000000, 3),
(17, 'Tri Guna', 22, 77000000, 3),
(18, 'Herman Priamesta', 5, 42500000, 3),
(19, 'Buana Mandiri', 6, 21000000, 3),
(20, 'Albert Kurniawan', 8, 130000000, 2),
(21, 'Imam Shodiq', 17, 160000000, 2),
(22, 'Marco Xena', 76, 266000000, 1),
(23, 'Erlangga Mahesa', 6, 19200000, 3),
(24, 'Dwi Tunggal', 20, 65400000, 3),
(25, 'Norick eriyadi', 10, 39000000, 3),
(26, 'Luthfi BEK', 18, 86400000, 3),
(27, 'BARTON', 18, 63000000, 3),
(28, 'Santosa Bandung', 8, 68000000, 3),
(29, 'CAP Express', 18, 66600000, 3),
(30, 'Barata Mandiri', 15, 48000000, 3),
(31, 'Adhi TCI', 15, 74500000, 3),
(32, 'TBM', 2, 17000000, 3),
(33, 'Dennis MMS', 60, 210000000, 2),
(34, 'MHK', 8, 25600000, 3),
(35, 'Hendri Oktovian', 60, 192000000, 2),
(36, 'Ardi Surya', 8, 29600000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `history_decisiontree`
--

CREATE TABLE `history_decisiontree` (
  `id_hdt` int(11) NOT NULL,
  `hdt_customer` varchar(50) NOT NULL,
  `hdt_totalqty` int(11) NOT NULL,
  `hdt_totalharga` bigint(20) NOT NULL,
  `hdt_aktualkm` int(11) NOT NULL,
  `hdt_pred` int(11) NOT NULL,
  `id_history` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_decisiontree`
--

INSERT INTO `history_decisiontree` (`id_hdt`, `hdt_customer`, `hdt_totalqty`, `hdt_totalharga`, `hdt_aktualkm`, `hdt_pred`, `id_history`) VALUES
(1265, 'Reza Lazuardi', 18, 63200000, 3, 3, 'DT0001'),
(1266, 'Rendragraha', 8, 68000000, 3, 3, 'DT0001'),
(1267, 'Hendro lim', 10, 32000000, 3, 3, 'DT0001'),
(1268, 'Ardi DMS', 10, 48000000, 3, 3, 'DT0001'),
(1269, 'Erlangga Mahesa', 6, 19200000, 3, 3, 'DT0001'),
(1270, 'Albert Kurniawan', 8, 130000000, 2, 2, 'DT0001'),
(1271, 'Buana Mandiri', 6, 21000000, 3, 3, 'DT0001'),
(1272, 'Seino', 85, 272000000, 1, 1, 'DT0001'),
(1273, 'MHK', 8, 25600000, 3, 3, 'DT0001'),
(1274, 'Marco Xena', 76, 266000000, 1, 1, 'DT0001'),
(1275, 'Luthfi BEK', 18, 86400000, 3, 3, 'DT0001'),
(1276, 'Hendry Gemilang', 29, 182500000, 2, 2, 'DT0001'),
(1277, 'Herman Priamesta', 5, 42500000, 3, 3, 'DT0001'),
(1278, 'Tri Guna', 22, 77000000, 3, 3, 'DT0001'),
(1279, 'CAP Express', 18, 66600000, 3, 3, 'DT0001'),
(1280, 'Jordan CO', 48, 153600000, 2, 2, 'DT0001'),
(1281, 'Eka Mardianto', 10, 35000000, 3, 3, 'DT0001'),
(1282, 'Santosa Bandung', 8, 68000000, 3, 3, 'DT0001'),
(1283, 'Bagas Adyatama', 11, 37700000, 3, 3, 'DT0001'),
(1284, 'BARTON', 18, 63000000, 3, 3, 'DT0001'),
(1285, 'Hendri Oktovian', 60, 192000000, 2, 2, 'DT0001'),
(1286, 'BEP', 85, 322500000, 1, 1, 'DT0001'),
(1287, 'SMP', 16, 56000000, 3, 3, 'DT0001'),
(1288, 'Imam Shodiq', 17, 160000000, 2, 2, 'DT0001'),
(1289, 'Imron LJA', 66, 211200000, 2, 2, 'DT0001'),
(1290, 'Sanjaya Utama', 20, 64000000, 3, 3, 'DT0001'),
(1291, 'Mitra Mandiri Logistik', 70, 224000000, 2, 1, 'DT0001'),
(1292, 'Adhi TCI', 15, 74500000, 3, 3, 'DT0001'),
(1293, 'Barata Mandiri', 15, 48000000, 3, 3, 'DT0001'),
(1294, 'Nur Hamid', 12, 38400000, 3, 3, 'DT0001'),
(1295, 'Dwi Tunggal', 20, 65400000, 3, 3, 'DT0001'),
(1296, 'Norick eriyadi', 10, 39000000, 3, 3, 'DT0001'),
(1297, 'Rudy NS', 90, 315000000, 1, 1, 'DT0001'),
(1298, 'TBM', 2, 17000000, 3, 3, 'DT0001'),
(1299, 'Ardi Surya', 8, 29600000, 3, 3, 'DT0001'),
(1300, 'Dennis MMS', 60, 210000000, 2, 2, 'DT0001'),
(1301, 'Reza Lazuardi', 18, 63200000, 3, 3, 'DT0002'),
(1302, 'Rendragraha', 8, 68000000, 3, 3, 'DT0002'),
(1303, 'Hendro lim', 10, 32000000, 3, 3, 'DT0002'),
(1304, 'Barata Mandiri', 15, 48000000, 3, 3, 'DT0002'),
(1305, 'Erlangga Mahesa', 6, 19200000, 3, 3, 'DT0002'),
(1306, 'Albert Kurniawan', 8, 130000000, 3, 3, 'DT0002'),
(1307, 'Buana Mandiri', 6, 21000000, 3, 3, 'DT0002'),
(1308, 'Seino', 85, 272000000, 1, 1, 'DT0002'),
(1309, 'MHK', 8, 25600000, 3, 3, 'DT0002'),
(1310, 'Marco Xena', 76, 266000000, 1, 1, 'DT0002'),
(1311, 'Luthfi BEK', 18, 86400000, 3, 3, 'DT0002'),
(1312, 'Hendry Gemilang', 29, 182500000, 2, 2, 'DT0002'),
(1313, 'Herman Priamesta', 5, 42500000, 3, 3, 'DT0002'),
(1314, 'Tri Guna', 22, 77000000, 3, 3, 'DT0002'),
(1315, 'CAP Express', 18, 66600000, 3, 3, 'DT0002'),
(1316, 'Jordan CO', 48, 153600000, 2, 2, 'DT0002'),
(1317, 'Eka Mardianto', 10, 35000000, 3, 3, 'DT0002'),
(1318, 'Santosa Bandung', 8, 68000000, 3, 3, 'DT0002'),
(1319, 'Bagas Adyatama', 11, 37700000, 3, 3, 'DT0002'),
(1320, 'BARTON', 18, 63000000, 3, 3, 'DT0002'),
(1321, 'Hendri Oktovian', 60, 192000000, 2, 2, 'DT0002'),
(1322, 'BEP', 85, 322500000, 1, 1, 'DT0002'),
(1323, 'SMP', 16, 56000000, 3, 3, 'DT0002'),
(1324, 'Imam Shodiq', 17, 160000000, 2, 2, 'DT0002'),
(1325, 'Imron LJA', 66, 211200000, 1, 2, 'DT0002'),
(1326, 'Sanjaya Utama', 20, 64000000, 3, 3, 'DT0002'),
(1327, 'Mitra Mandiri Logistik', 70, 224000000, 1, 1, 'DT0002'),
(1328, 'Adhi TCI', 15, 74500000, 3, 3, 'DT0002'),
(1329, 'Ardi DMS', 10, 48000000, 3, 3, 'DT0002'),
(1330, 'Nur Hamid', 12, 38400000, 3, 3, 'DT0002'),
(1331, 'Dwi Tunggal', 20, 65400000, 3, 3, 'DT0002'),
(1332, 'Norick eriyadi', 10, 39000000, 3, 3, 'DT0002'),
(1333, 'Rudy NS', 90, 315000000, 1, 1, 'DT0002'),
(1334, 'TBM', 2, 17000000, 3, 3, 'DT0002'),
(1335, 'Ardi Surya', 8, 29600000, 3, 3, 'DT0002'),
(1336, 'Dennis MMS', 60, 210000000, 2, 2, 'DT0002');

-- --------------------------------------------------------

--
-- Table structure for table `history_kmeans`
--

CREATE TABLE `history_kmeans` (
  `id_hkm` int(11) NOT NULL,
  `hkm_customer` varchar(50) NOT NULL,
  `hkm_totalqty` int(11) NOT NULL,
  `hkm_totalharga` bigint(20) NOT NULL,
  `hkm_cluster` int(11) NOT NULL,
  `id_history` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_kmeans`
--

INSERT INTO `history_kmeans` (`id_hkm`, `hkm_customer`, `hkm_totalqty`, `hkm_totalharga`, `hkm_cluster`, `id_history`) VALUES
(2218, 'Adhi TCI', 15, 74500000, 3, 'KM0001'),
(2219, 'Albert Kurniawan', 8, 130000000, 2, 'KM0001'),
(2220, 'Ardi DMS', 10, 48000000, 3, 'KM0001'),
(2221, 'Ardi Surya', 8, 29600000, 3, 'KM0001'),
(2222, 'Bagas Adyatama', 11, 37700000, 3, 'KM0001'),
(2223, 'Barata Mandiri', 15, 48000000, 3, 'KM0001'),
(2224, 'BARTON', 18, 63000000, 3, 'KM0001'),
(2225, 'BEP', 85, 322500000, 1, 'KM0001'),
(2226, 'Buana Mandiri', 6, 21000000, 3, 'KM0001'),
(2227, 'CAP Express', 18, 66600000, 3, 'KM0001'),
(2228, 'Dennis MMS', 60, 210000000, 2, 'KM0001'),
(2229, 'Dwi Tunggal', 20, 65400000, 3, 'KM0001'),
(2230, 'Eka Mardianto', 10, 35000000, 3, 'KM0001'),
(2231, 'Erlangga Mahesa', 6, 19200000, 3, 'KM0001'),
(2232, 'Hendri Oktovian', 60, 192000000, 2, 'KM0001'),
(2233, 'Hendro lim', 10, 32000000, 3, 'KM0001'),
(2234, 'Hendry Gemilang', 29, 182500000, 2, 'KM0001'),
(2235, 'Herman Priamesta', 5, 42500000, 3, 'KM0001'),
(2236, 'Imam Shodiq', 17, 160000000, 2, 'KM0001'),
(2237, 'Imron LJA', 66, 211200000, 2, 'KM0001'),
(2238, 'Jordan CO', 48, 153600000, 2, 'KM0001'),
(2239, 'Luthfi BEK', 18, 86400000, 3, 'KM0001'),
(2240, 'Marco Xena', 76, 266000000, 1, 'KM0001'),
(2241, 'MHK', 8, 25600000, 3, 'KM0001'),
(2242, 'Mitra Mandiri Logistik', 70, 224000000, 2, 'KM0001'),
(2243, 'Norick eriyadi', 10, 39000000, 3, 'KM0001'),
(2244, 'Nur Hamid', 12, 38400000, 3, 'KM0001'),
(2245, 'Rendragraha', 8, 68000000, 3, 'KM0001'),
(2246, 'Reza Lazuardi', 18, 63200000, 3, 'KM0001'),
(2247, 'Rudy NS', 90, 315000000, 1, 'KM0001'),
(2248, 'Sanjaya Utama', 20, 64000000, 3, 'KM0001'),
(2249, 'Santosa Bandung', 8, 68000000, 3, 'KM0001'),
(2250, 'Seino', 85, 272000000, 1, 'KM0001'),
(2251, 'SMP', 16, 56000000, 3, 'KM0001'),
(2252, 'TBM', 2, 17000000, 3, 'KM0001'),
(2253, 'Tri Guna', 22, 77000000, 3, 'KM0001'),
(2254, 'Rudy NS', 90, 315000000, 1, 'KM0002'),
(2255, 'Rendragraha', 8, 68000000, 3, 'KM0002'),
(2256, 'Seino', 85, 272000000, 1, 'KM0002'),
(2257, 'Bagas Adyatama', 11, 37700000, 3, 'KM0002'),
(2258, 'BEP', 85, 322500000, 1, 'KM0002'),
(2259, 'Hendry Gemilang', 29, 182500000, 2, 'KM0002'),
(2260, 'Mitra Mandiri Logistik', 70, 224000000, 2, 'KM0002'),
(2261, 'Nur Hamid', 12, 38400000, 3, 'KM0002'),
(2262, 'Reza Lazuardi', 18, 63200000, 3, 'KM0002'),
(2263, 'Sanjaya Utama', 20, 64000000, 3, 'KM0002'),
(2264, 'Jordan CO', 48, 153600000, 2, 'KM0002'),
(2265, 'Eka Mardianto', 10, 35000000, 3, 'KM0002'),
(2266, 'Imron LJA', 66, 211200000, 2, 'KM0002'),
(2267, 'Hendro lim', 10, 32000000, 3, 'KM0002'),
(2268, 'SMP', 16, 56000000, 3, 'KM0002'),
(2269, 'Ardi DMS', 10, 48000000, 3, 'KM0002'),
(2270, 'Tri Guna', 22, 77000000, 3, 'KM0002'),
(2271, 'Herman Priamesta', 5, 42500000, 3, 'KM0002'),
(2272, 'Buana Mandiri', 6, 21000000, 3, 'KM0002'),
(2273, 'Albert Kurniawan', 8, 130000000, 2, 'KM0002'),
(2274, 'Imam Shodiq', 17, 160000000, 2, 'KM0002'),
(2275, 'Marco Xena', 76, 266000000, 1, 'KM0002'),
(2276, 'Erlangga Mahesa', 6, 19200000, 3, 'KM0002'),
(2277, 'Dwi Tunggal', 20, 65400000, 3, 'KM0002'),
(2278, 'Norick eriyadi', 10, 39000000, 3, 'KM0002'),
(2279, 'Luthfi BEK', 18, 86400000, 3, 'KM0002'),
(2280, 'BARTON', 18, 63000000, 3, 'KM0002'),
(2281, 'Santosa Bandung', 8, 68000000, 3, 'KM0002'),
(2282, 'CAP Express', 18, 66600000, 3, 'KM0002'),
(2283, 'Barata Mandiri', 15, 48000000, 3, 'KM0002'),
(2284, 'Adhi TCI', 15, 74500000, 3, 'KM0002'),
(2285, 'TBM', 2, 17000000, 3, 'KM0002'),
(2286, 'Dennis MMS', 60, 210000000, 2, 'KM0002'),
(2287, 'MHK', 8, 25600000, 3, 'KM0002'),
(2288, 'Hendri Oktovian', 60, 192000000, 2, 'KM0002'),
(2289, 'Ardi Surya', 8, 29600000, 3, 'KM0002');

-- --------------------------------------------------------

--
-- Table structure for table `history_predict`
--

CREATE TABLE `history_predict` (
  `id_history` varchar(12) NOT NULL,
  `metoda` varchar(30) NOT NULL,
  `accuracy` float NOT NULL,
  `foto` varchar(100) NOT NULL,
  `tgl_pred` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(100) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_predict`
--

INSERT INTO `history_predict` (`id_history`, `metoda`, `accuracy`, `foto`, `tgl_pred`, `keterangan`, `updated_at`) VALUES
('DT0001', 'dt-dskm', 0.933333, 'tree_plot_1738279211.png', '2025-01-30 23:20:11', '3 Bulan', NULL),
('DT0002', 'dt', 0.933333, 'tree_plot_1738279252.png', '2025-01-30 23:20:52', '3 Bulan', NULL),
('KM0001', 'km', 0.7434, 'scatter_plot1738279191.png', '2025-01-30 23:19:51', '3 Bulan', NULL),
('KM0002', 'km-dspb', 0.9167, 'scatter_plot_1738279226.png', '2025-01-30 23:20:26', '3 Bulan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bout`
--

CREATE TABLE `tbl_bout` (
  `id_out` int(11) NOT NULL,
  `tanggal_out` date NOT NULL,
  `nomor_po` varchar(15) NOT NULL,
  `kode_barang` varchar(12) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `merek` varchar(30) NOT NULL,
  `ukuran` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty_keluar` int(11) NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `kode_customer` varchar(12) NOT NULL,
  `customer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bout`
--

INSERT INTO `tbl_bout` (`id_out`, `tanggal_out`, `nomor_po`, `kode_barang`, `nama_barang`, `merek`, `ukuran`, `harga`, `qty_keluar`, `total_harga`, `kode_customer`, `customer`) VALUES
(1, '2023-10-04', '20231019701', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST197', 'Gery Mardhiana'),
(2, '2023-10-06', '20231051501', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 6, 21000000, 'CUST515', 'Buana Mandiri'),
(3, '2023-10-06', '20231051501', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST515', 'Buana Mandiri'),
(4, '2023-10-09', '20231054301', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 32, 102400000, 'CUST543', 'Nusa Sejahtera Logistik'),
(5, '2023-10-10', '20231019201', 'DUR005', 'AM86', 'Durun', '10.00R20', 3700000, 8, 29600000, 'CUST192', 'Yunus Suryatna'),
(6, '2023-10-13', '20231032301', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 64, 204800000, 'CUST323', 'Seino'),
(7, '2023-10-17', '20231065901', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 4, 34000000, 'CUST659', 'Hendry Gemilang'),
(8, '2023-10-18', '20231010201', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 10, 32000000, 'CUST102', 'Dwi Tunggal'),
(9, '2023-10-27', '20231037301', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 40, 128000000, 'CUST373', 'DUNEX'),
(10, '2023-10-30', '20231016601', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 25, 87500000, 'CUST166', 'Imam Shodiq'),
(11, '2023-10-30', '20231016601', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 6, 51000000, 'CUST166', 'Imam Shodiq'),
(12, '2023-10-31', '20231023801', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 30, 96000000, 'CUST238', 'Hendri Oktovian'),
(13, '2023-11-02', '20231130501', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 8, 28000000, 'CUST305', 'Eka Mardianto'),
(14, '2023-11-03', '20231166101', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 2, 6400000, 'CUST661', 'Golden Express'),
(15, '2023-11-06', '20231128001', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 10, 35000000, 'CUST280', 'Erik Sucipto'),
(16, '2023-11-08', '20231167601', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 80, 280000000, 'CUST676', 'Global Express Logistik'),
(17, '2023-11-10', '20231127201', 'DUR002', 'YT919', 'Durun', '10.00R20', 3900000, 20, 78000000, 'CUST272', 'Sandy Abe'),
(18, '2023-11-10', '20231127201', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 80, 256000000, 'CUST272', 'Sandy Abe'),
(19, '2023-11-13', '20231119301', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 4, 34000000, 'CUST193', 'Wibisana'),
(20, '2023-11-14', '20231154201', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 130, 455000000, 'CUST542', 'Stamford Tyres'),
(21, '2023-11-15', '20231139601', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 6, 51000000, 'CUST396', 'BEP'),
(22, '2023-11-17', '20231147301', 'ALL001', 'AR903 11.00', 'Allround', '11.00R20', 4500000, 2, 9000000, 'CUST473', 'Erick Siregar'),
(23, '2023-11-17', '20231147301', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 16, 51200000, 'CUST473', 'Erick Siregar'),
(24, '2023-11-17', '20231147301', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 8, 28000000, 'CUST473', 'Erick Siregar'),
(25, '2023-11-20', '20231170201', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 6, 19200000, 'CUST702', 'Larisma'),
(26, '2023-11-20', '20231170201', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 8, 28000000, 'CUST702', 'Larisma'),
(27, '2023-11-21', '20231174401', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 70, 245000000, 'CUST744', 'KSS'),
(28, '2023-11-21', '20231174401', 'DUR002', 'YT919', 'Durun', '10.00R20', 3900000, 20, 78000000, 'CUST744', 'KSS'),
(29, '2023-11-23', '20231130502', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 2, 7000000, 'CUST305', 'Eka Mardianto'),
(30, '2023-11-28', '20231159101', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 15, 48000000, 'CUST591', 'Sanjaya Utama'),
(31, '2023-11-30', '20231172101', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 30, 105000000, 'CUST721', 'Mandiri Indo Motor'),
(32, '2023-11-30', '20231172101', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST721', 'Mandiri Indo Motor'),
(33, '2023-12-01', '20231234801', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 47, 164500000, 'CUST348', 'Rudy NS'),
(34, '2023-12-04', '20231260001', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 30, 105000000, 'CUST600', 'WWPI'),
(35, '2023-12-05', '20231251501', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST515', 'Buana Mandiri'),
(36, '2023-12-08', '20231225901', 'ALL001', 'AR903 11.00', 'Allround', '11.00R20', 4500000, 20, 90000000, 'CUST259', 'Dennis MMS'),
(37, '2023-12-11', '20231219701', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 6, 51000000, 'CUST197', 'Gery Mardhiana'),
(38, '2023-12-13', '20231273901', 'DUR004', 'DH703 12.00', 'Durun', '12.00R20', 4800000, 8, 38400000, 'CUST739', 'Kevin Liang'),
(39, '2023-12-15', '20231262301', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST623', 'MPI'),
(40, '2023-12-18', '20231260002', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 10, 35000000, 'CUST600', 'WWPI'),
(41, '2023-12-20', '20231222501', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 32, 112000000, 'CUST225', 'PRIMEPACK'),
(42, '2023-12-20', '20231250901', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 5, 42500000, 'CUST509', 'Hemadanda'),
(43, '2023-12-22', '20231223701', 'DUR005', 'AM86', 'Durun', '10.00R20', 3700000, 14, 51800000, 'CUST237', 'CAP Express'),
(44, '2024-01-02', '20240170201', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 10, 32000000, 'CUST702', 'Larisma'),
(45, '2024-01-03', '20240116601', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST166', 'Imam Shodiq'),
(46, '2024-01-03', '20240116601', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 30, 96000000, 'CUST166', 'Imam Shodiq'),
(47, '2024-01-04', '20240111701', 'DUR005', 'AM86', 'Durun', '10.00R20', 3700000, 8, 29600000, 'CUST117', 'Albert Kurniawan'),
(48, '2024-01-08', '20240150401', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 10, 32000000, 'CUST504', 'SE KONG'),
(49, '2024-01-08', '20240150401', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 25, 87500000, 'CUST504', 'SE KONG'),
(50, '2024-01-08', '20240172201', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 10, 32000000, 'CUST722', 'AGO Ban'),
(51, '2024-01-09', '20240139601', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 8, 68000000, 'CUST396', 'BEP'),
(52, '2024-01-10', '20240152201', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 12, 38400000, 'CUST522', 'Zulfikar Hasan'),
(53, '2024-01-12', '20240122501', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 50, 160000000, 'CUST225', 'PRIMEPACK'),
(54, '2024-01-15', '20240138601', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 60, 210000000, 'CUST386', 'MKJ'),
(55, '2024-01-15', '20240138601', 'ALL001', 'AR903 11.00', 'Allround', '11.00R20', 4500000, 30, 135000000, 'CUST386', 'MKJ'),
(56, '2024-01-18', '20240166101', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 2, 6400000, 'CUST661', 'Golden Express'),
(57, '2024-01-19', '20240169001', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 8, 28000000, 'CUST690', 'Trans Express'),
(58, '2024-01-23', '20240134401', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 80, 280000000, 'CUST344', 'Marco Xena'),
(59, '2024-01-25', '20240127601', 'TEK002', 'TEKMASTER 23.5-25', 'Tekmaster', '23.5-25 E3/L3', 16250000, 2, 32500000, 'CUST276', 'Lingga Fadilah'),
(60, '2024-01-26', '20240135101', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 16, 51200000, 'CUST351', 'Logifast'),
(61, '2024-01-29', '20240165901', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 40, 128000000, 'CUST659', 'Hendry Gemilang'),
(62, '2024-01-30', '20240132301', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 60, 192000000, 'CUST323', 'Seino'),
(63, '2024-02-01', '20240211301', 'ALL003', 'AR903 R24', 'Allround', '12.00R24', 6250000, 16, 100000000, 'CUST113', 'Dharma Satrya'),
(64, '2024-02-02', '20240237301', 'DUR002', 'YT919', 'Durun', '10.00R20', 3900000, 24, 93600000, 'CUST373', 'DUNEX'),
(65, '2024-02-05', '20240251501', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST515', 'Buana Mandiri'),
(66, '2024-02-05', '20240251501', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 22, 77000000, 'CUST515', 'Buana Mandiri'),
(67, '2024-02-07', '20240226701', 'ALL001', 'AR903 11.00', 'Allround', '11.00R20', 4500000, 26, 117000000, 'CUST267', 'Yahya Utomo'),
(68, '2024-02-13', '20240237501', 'DUR004', 'DH703 12.00', 'Durun', '12.00R20', 4800000, 20, 96000000, 'CUST375', 'GTyres'),
(69, '2024-02-13', '20240237501', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 10, 32000000, 'CUST375', 'GTyres'),
(70, '2024-02-15', '20240264901', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 8, 25600000, 'CUST649', 'HAG'),
(71, '2024-02-21', '20240265401', 'DUR005', 'AM86', 'Durun', '10.00R20', 3700000, 9, 33300000, 'CUST654', 'Surya Eka Logistik'),
(72, '2024-02-26', '20240223801', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 42, 134400000, 'CUST238', 'Hendri Oktovian'),
(73, '2024-02-26', '20240272201', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 12, 38400000, 'CUST722', 'AGO Ban'),
(74, '2024-03-01', '20240374701', 'DUR002', 'YT919', 'Durun', '10.00R20', 3900000, 8, 31200000, 'CUST747', 'Rudy Johanes'),
(75, '2024-03-04', '20240324001', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 32, 102400000, 'CUST240', 'Imron LJA'),
(76, '2024-03-04', '20240330501', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 18, 63000000, 'CUST305', 'Eka Mardianto'),
(77, '2024-03-06', '20240350401', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 6, 21000000, 'CUST504', 'SE KONG'),
(78, '2024-03-07', '20240328401', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 70, 224000000, 'CUST284', 'Mitra Mandiri Logistik'),
(79, '2024-03-13', '20240354601', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST546', 'TBM'),
(80, '2024-03-15', '20240311701', 'TEK002', 'TEKMASTER 23.5-25', 'Tekmaster', '23.5-25 E3/L3', 16250000, 4, 65000000, 'CUST117', 'Albert Kurniawan'),
(81, '2024-03-18', '20240334601', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 112, 392000000, 'CUST346', 'Marbelous'),
(82, '2024-03-19', '20240360001', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 30, 105000000, 'CUST600', 'WWPI'),
(83, '2024-03-22', '20240366101', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 12, 38400000, 'CUST661', 'Golden Express'),
(84, '2024-03-25', '20240327201', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 102, 326400000, 'CUST272', 'Sandy Abe'),
(85, '2024-03-25', '20240327201', 'DUR002', 'YT919', 'Durun', '10.00R20', 3900000, 20, 78000000, 'CUST272', 'Sandy Abe'),
(86, '2024-03-26', '20240335501', 'DUR002', 'YT919', 'Durun', '10.00R20', 3900000, 2, 7800000, 'CUST355', 'Norick eriyadi'),
(87, '2024-03-28', '20240373901', 'DUR004', 'DH703 12.00', 'Durun', '12.00R20', 4800000, 4, 19200000, 'CUST739', 'Kevin Liang'),
(88, '2024-03-28', '20240348201', 'DUR004', 'DH703 12.00', 'Durun', '12.00R20', 4800000, 2, 9600000, 'CUST482', 'Luthfi BEK'),
(89, '2024-04-01', '20240428001', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 22, 77000000, 'CUST280', 'Erik Sucipto'),
(90, '2024-04-03', '20240454301', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 10, 32000000, 'CUST543', 'Nusa Sejahtera Logistik'),
(91, '2024-04-04', '20240450401', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 15, 48000000, 'CUST504', 'SE KONG'),
(92, '2024-04-05', '20240416601', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 4, 34000000, 'CUST166', 'Imam Shodiq'),
(93, '2024-04-16', '20240473801', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST738', 'Rendragraha'),
(94, '2024-04-18', '20240434601', 'DUR005', 'AM86', 'Durun', '10.00R20', 3700000, 40, 148000000, 'CUST346', 'Marbelous'),
(95, '2024-04-18', '20240434601', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 78, 249600000, 'CUST346', 'Marbelous'),
(96, '2024-04-19', '20240432301', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 72, 230400000, 'CUST323', 'Seino'),
(97, '2024-04-22', '20240465901', 'DUR002', 'YT919', 'Durun', '10.00R20', 3900000, 8, 31200000, 'CUST659', 'Hendry Gemilang'),
(98, '2024-04-22', '20240465901', 'DUR004', 'DH703 12.00', 'Durun', '12.00R20', 4800000, 8, 38400000, 'CUST659', 'Hendry Gemilang'),
(99, '2024-04-22', '20240465901', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 10, 85000000, 'CUST659', 'Hendry Gemilang'),
(100, '2024-04-23', '20240417901', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 20, 64000000, 'CUST179', 'FPJ'),
(101, '2024-04-24', '20240427101', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST271', 'BARTON'),
(102, '2024-04-25', '20240474001', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 5, 42500000, 'CUST740', 'Warlan Kusuma'),
(103, '2024-04-25', '20240472201', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 20, 64000000, 'CUST722', 'AGO Ban'),
(104, '2024-04-26', '20240434801', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 100, 350000000, 'CUST348', 'Rudy NS'),
(105, '2024-04-29', '20240452201', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 5, 16000000, 'CUST522', 'Zulfikar Hasan'),
(106, '2024-05-02', '20240517601', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 30, 96000000, 'CUST176', 'Agung Jaya Motor'),
(107, '2024-05-03', '20240545301', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 16, 51200000, 'CUST453', 'Andika Maulana'),
(108, '2024-05-06', '20240562301', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 8, 68000000, 'CUST623', 'MPI'),
(109, '2024-05-08', '20240517901', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 40, 128000000, 'CUST179', 'FPJ'),
(110, '2024-05-13', '20240550601', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 5, 42500000, 'CUST506', 'Juna Pratama'),
(111, '2024-05-13', '20240568501', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 12, 38400000, 'CUST685', 'MHK'),
(112, '2024-05-14', '20240564901', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 18, 57600000, 'CUST649', 'HAG'),
(113, '2024-05-16', '20240574801', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 3, 9600000, 'CUST748', 'Reza Lazuardi'),
(114, '2024-05-17', '20240537301', 'DUR002', 'YT919', 'Durun', '10.00R20', 3900000, 12, 46800000, 'CUST373', 'DUNEX'),
(115, '2024-05-17', '20240537301', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 30, 96000000, 'CUST373', 'DUNEX'),
(116, '2024-05-20', '20240520001', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 16, 51200000, 'CUST200', 'Kevin Irawan'),
(117, '2024-05-21', '20240523101', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 4, 34000000, 'CUST231', 'Herman Priamesta'),
(118, '2024-05-22', '20240530301', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 18, 57600000, 'CUST303', 'Bagas Adyatama'),
(119, '2024-05-22', '20240566101', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 11, 35200000, 'CUST661', 'Golden Express'),
(120, '2024-05-27', '20240523601', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 6, 19200000, 'CUST236', 'Erlangga Mahesa'),
(121, '2024-05-28', '20240574802', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 10, 32000000, 'CUST748', 'Reza Lazuardi'),
(122, '2024-05-29', '20240517501', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST175', 'Ismail Mahrizal'),
(123, '2024-05-29', '20240517501', 'DUR002', 'YT919', 'Durun', '10.00R20', 3900000, 40, 156000000, 'CUST175', 'Ismail Mahrizal'),
(124, '2024-05-31', '20240515301', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 20, 64000000, 'CUST153', 'Rezon Alem'),
(125, '2024-06-03', '20240652001', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 7, 59500000, 'CUST520', 'Jody Cahyadi'),
(126, '2024-06-04', '20240631001', 'TEK002', 'TEKMASTER 23.5-25', 'Tekmaster', '23.5-25 E3/L3', 16250000, 2, 32500000, 'CUST310', 'Santosa Bandung'),
(127, '2024-06-06', '20240615501', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST155', 'Gani Susanto'),
(128, '2024-06-07', '20240623801', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 20, 64000000, 'CUST238', 'Hendri Oktovian'),
(129, '2024-06-11', '20240673701', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 15, 52500000, 'CUST737', 'MBS'),
(130, '2024-06-11', '20240673701', 'ALL001', 'AR903 11.00', 'Allround', '11.00R20', 4500000, 10, 45000000, 'CUST737', 'MBS'),
(131, '2024-06-12', '20240654601', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 4, 34000000, 'CUST546', 'TBM'),
(132, '2024-06-14', '20240619801', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST198', 'Zainal Izdan'),
(133, '2024-06-19', '20240638601', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 110, 385000000, 'CUST386', 'MKJ'),
(134, '2024-06-21', '20240660002', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 54, 189000000, 'CUST600', 'WWPI'),
(135, '2024-06-24', '20240633801', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 10, 85000000, 'CUST338', 'Jatmiko Tjandra'),
(136, '2024-06-24', '20240669001', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 15, 48000000, 'CUST690', 'Trans Express'),
(137, '2024-06-27', '20240637501', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 38, 121600000, 'CUST375', 'GTyres'),
(138, '2024-06-28', '20240611901', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 10, 85000000, 'CUST119', 'Irwan MUL'),
(139, '2024-07-01', '20240734801', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 90, 315000000, 'CUST348', 'Rudy NS'),
(140, '2024-07-03', '20240773801', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 4, 34000000, 'CUST738', 'Rendragraha'),
(141, '2024-07-04', '20240732301', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 85, 272000000, 'CUST323', 'Seino'),
(142, '2024-07-04', '20240730301', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 6, 19200000, 'CUST303', 'Bagas Adyatama'),
(143, '2024-07-08', '20240739601', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 80, 280000000, 'CUST396', 'BEP'),
(144, '2024-07-08', '20240739601', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 5, 42500000, 'CUST396', 'BEP'),
(145, '2024-07-10', '20240765901', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 15, 48000000, 'CUST659', 'Hendry Gemilang'),
(146, '2024-07-10', '20240765901', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 12, 102000000, 'CUST659', 'Hendry Gemilang'),
(147, '2024-07-11', '20240728401', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 70, 224000000, 'CUST284', 'Mitra Mandiri Logistik'),
(148, '2024-07-12', '20240750801', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 12, 38400000, 'CUST508', 'Nur Hamid'),
(149, '2024-07-15', '20240774801', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 10, 32000000, 'CUST748', 'Reza Lazuardi'),
(150, '2024-07-15', '20240774801', 'DUR002', 'YT919', 'Durun', '10.00R20', 3900000, 8, 31200000, 'CUST748', 'Reza Lazuardi'),
(151, '2024-07-19', '20240759101', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 20, 64000000, 'CUST591', 'Sanjaya Utama'),
(152, '2024-07-22', '20240730302', 'DUR005', 'AM86', 'Durun', '10.00R20', 3700000, 5, 18500000, 'CUST303', 'Bagas Adyatama'),
(153, '2024-07-26', '20240728701', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 8, 25600000, 'CUST287', 'Jordan CO'),
(154, '2024-07-29', '20240730501', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 10, 35000000, 'CUST305', 'Eka Mardianto'),
(155, '2024-08-01', '20240824001', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 66, 211200000, 'CUST240', 'Imron LJA'),
(156, '2024-08-06', '20240845401', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 10, 32000000, 'CUST454', 'Hendro lim'),
(157, '2024-08-09', '20240825801', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 16, 56000000, 'CUST258', 'SMP'),
(158, '2024-08-12', '20240846201', 'DUR004', 'DH703 12.00', 'Durun', '12.00R20', 4800000, 10, 48000000, 'CUST462', 'Ardi DMS'),
(159, '2024-08-15', '20240834101', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 22, 77000000, 'CUST341', 'Tri Guna'),
(160, '2024-08-16', '20240823101', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 5, 42500000, 'CUST231', 'Herman Priamesta'),
(161, '2024-08-19', '20240851501', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 6, 21000000, 'CUST515', 'Buana Mandiri'),
(162, '2024-08-20', '20240811701', 'TEK002', 'TEKMASTER 23.5-25', 'Tekmaster', '23.5-25 E3/L3', 16250000, 2, 32500000, 'CUST117', 'Albert Kurniawan'),
(163, '2024-08-22', '20240816601', 'TEK002', 'TEKMASTER 23.5-25', 'Tekmaster', '23.5-25 E3/L3', 16250000, 2, 32500000, 'CUST166', 'Imam Shodiq'),
(164, '2024-08-22', '20240816601', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 15, 127500000, 'CUST166', 'Imam Shodiq'),
(165, '2024-08-23', '20240834401', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 76, 266000000, 'CUST344', 'Marco Xena'),
(166, '2024-08-27', '20240823601', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 6, 19200000, 'CUST236', 'Erlangga Mahesa'),
(167, '2024-09-02', '20240910201', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 18, 57600000, 'CUST102', 'Dwi Tunggal'),
(168, '2024-09-03', '20240935501', 'DUR002', 'YT919', 'Durun', '10.00R20', 3900000, 10, 39000000, 'CUST355', 'Norick eriyadi'),
(169, '2024-09-03', '20240948201', 'DUR004', 'DH703 12.00', 'Durun', '12.00R20', 4800000, 18, 86400000, 'CUST482', 'Luthfi BEK'),
(170, '2024-09-04', '20240927101', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 18, 63000000, 'CUST271', 'BARTON'),
(171, '2024-09-06', '20240965901', 'TEK002', 'TEKMASTER 23.5-25', 'Tekmaster', '23.5-25 E3/L3', 16250000, 2, 32500000, 'CUST659', 'Hendry Gemilang'),
(172, '2024-09-09', '20240931001', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 8, 68000000, 'CUST310', 'Santosa Bandung'),
(173, '2024-09-11', '20240928701', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 40, 128000000, 'CUST287', 'Jordan CO'),
(174, '2024-09-12', '20240911701', 'TEK002', 'TEKMASTER 23.5-25', 'Tekmaster', '23.5-25 E3/L3', 16250000, 6, 97500000, 'CUST117', 'Albert Kurniawan'),
(175, '2024-09-13', '20240923701', 'DUR005', 'AM86', 'Durun', '10.00R20', 3700000, 18, 66600000, 'CUST237', 'CAP Express'),
(176, '2024-09-17', '20240968201', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 15, 48000000, 'CUST682', 'Barata Mandiri'),
(177, '2024-09-19', '20240936801', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 5, 42500000, 'CUST368', 'Adhi TCI'),
(178, '2024-09-19', '20240936801', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 10, 32000000, 'CUST368', 'Adhi TCI'),
(179, '2024-09-20', '20240954601', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 2, 17000000, 'CUST546', 'TBM'),
(180, '2024-09-23', '20240925901', 'DUR003', 'DH703 11.00', 'Durun', '11.00R20', 3500000, 60, 210000000, 'CUST259', 'Dennis MMS'),
(181, '2024-09-23', '20240968501', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 8, 25600000, 'CUST685', 'MHK'),
(182, '2024-09-25', '20240910202', 'DUR002', 'YT919', 'Durun', '10.00R20', 3900000, 2, 7800000, 'CUST102', 'Dwi Tunggal'),
(183, '2024-09-26', '20240973801', 'TEK001', 'TEKMASTER 17.5-25', 'Tekmaster', '17.5-25 E3/L3', 8500000, 4, 34000000, 'CUST738', 'Rendragraha'),
(184, '2024-09-27', '20240923801', 'DUR001', 'YTH3', 'Durun', '10.00R20', 3200000, 60, 192000000, 'CUST238', 'Hendri Oktovian'),
(185, '2024-09-30', '20240910801', 'DUR005', 'AM86', 'Durun', '10.00R20', 3700000, 8, 29600000, 'CUST108', 'Ardi Surya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `nama` char(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `uname`, `nama`, `password`, `role`) VALUES
(1, 'toni', 'Tonny', '81dc9bdb52d04dc20036dbd8313ed055', 2),
(3, 'tomi', 'Tommy Widianarto', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(5, 'edy', 'Eddy', '81dc9bdb52d04dc20036dbd8313ed055', 3),
(7, 'doni', 'Donnie Varyasetya', '81dc9bdb52d04dc20036dbd8313ed055', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataset_dtnative`
--
ALTER TABLE `dataset_dtnative`
  ADD PRIMARY KEY (`id_dt`);

--
-- Indexes for table `history_decisiontree`
--
ALTER TABLE `history_decisiontree`
  ADD PRIMARY KEY (`id_hdt`);

--
-- Indexes for table `history_kmeans`
--
ALTER TABLE `history_kmeans`
  ADD PRIMARY KEY (`id_hkm`);

--
-- Indexes for table `history_predict`
--
ALTER TABLE `history_predict`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `uname` (`uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_decisiontree`
--
ALTER TABLE `history_decisiontree`
  MODIFY `id_hdt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1337;

--
-- AUTO_INCREMENT for table `history_kmeans`
--
ALTER TABLE `history_kmeans`
  MODIFY `id_hkm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2290;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
