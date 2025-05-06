-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 02:50 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rev_web_skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_kategori`
--

CREATE TABLE `barang_kategori` (
  `bkategori_id` int(11) NOT NULL,
  `bkategori_nama` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_kategori`
--

INSERT INTO `barang_kategori` (`bkategori_id`, `bkategori_nama`, `created_at`, `updated_at`) VALUES
(5, 'Makanan', '2023-05-21 14:24:42', '2023-05-21 14:24:42'),
(8, 'Mainan', '2023-05-21 14:25:43', '2023-05-21 14:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `barang_satuan`
--

CREATE TABLE `barang_satuan` (
  `bsatuan_id` int(11) NOT NULL,
  `bsatuan_nama` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_satuan`
--

INSERT INTO `barang_satuan` (`bsatuan_id`, `bsatuan_nama`, `created_at`, `updated_at`) VALUES
(1, 'cm', '2023-05-18 22:35:09', '2023-05-18 22:37:29'),
(3, 'Box', '2023-05-21 14:26:57', '2023-05-21 14:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `barang_stock`
--

CREATE TABLE `barang_stock` (
  `bstock_id` int(11) NOT NULL,
  `bstock_custom_code` varchar(15) DEFAULT NULL,
  `bstock_nama_barang` varchar(255) NOT NULL,
  `bstock_kategori` varchar(255) DEFAULT NULL,
  `bstock_unit` varchar(255) DEFAULT NULL,
  `bstock_harga` bigint(255) NOT NULL DEFAULT 0,
  `bstock_ready_stock` int(11) NOT NULL DEFAULT 0,
  `bstock_catatan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_stock`
--

INSERT INTO `barang_stock` (`bstock_id`, `bstock_custom_code`, `bstock_nama_barang`, `bstock_kategori`, `bstock_unit`, `bstock_harga`, `bstock_ready_stock`, `bstock_catatan`, `created_at`, `updated_at`) VALUES
(1, 'A001', 'Buku Cetak', 'Buku', 'PCS', 10000, 3783, NULL, NULL, '2023-10-31 01:46:17'),
(2, 'A002', 'Buku Cetak 2', 'Buku', 'PCS', 5000, 8299, NULL, NULL, '2023-10-31 01:46:17'),
(10, 'PZ01', 'Pizza', 'Makanan', 'Box', 333, 8, '0', '2023-05-21 14:58:03', '2023-05-21 14:58:03'),
(11, 'TOY2', 'hotwheels', 'Mainan', 'Box', 17500, 0, 'mainan mainan', '2023-05-21 15:00:24', '2023-06-04 23:16:05'),
(12, 'VVEZ', 'Mie', 'Makanan', '-', 3500, 6, 'ads', '2023-05-24 13:19:43', '2023-10-05 21:04:29'),
(13, 'DR024', 'Teh Gelas', '-', 'Box', 43000, 0, NULL, '2023-06-04 23:17:06', '2023-06-04 23:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `hutang_pelanggan`
--

CREATE TABLE `hutang_pelanggan` (
  `hutang_id` int(11) NOT NULL,
  `hutang_date` date NOT NULL,
  `hutang_nominal` bigint(20) NOT NULL,
  `hutang_catatan` varchar(255) DEFAULT NULL,
  `hutang_islunas` tinyint(1) NOT NULL DEFAULT 0,
  `hutang_idpelanggan` int(11) DEFAULT NULL,
  `hutang_transaksi_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hutang_pelanggan`
--

INSERT INTO `hutang_pelanggan` (`hutang_id`, `hutang_date`, `hutang_nominal`, `hutang_catatan`, `hutang_islunas`, `hutang_idpelanggan`, `hutang_transaksi_id`, `created_at`, `updated_at`) VALUES
(1, '2022-12-14', 2000000, 'beli permen', 0, 32, NULL, NULL, NULL),
(7, '2023-05-09', 0, '-', 1, 48, 1073, '2023-05-09 21:13:17', '2023-05-18 13:04:35'),
(45, '2023-05-23', 0, '', 1, 55, 1118, '2023-05-23 09:43:31', '2023-10-09 23:26:12'),
(47, '2023-05-26', 4987, '', 0, 72, 1120, '2023-05-27 11:10:07', '2023-05-27 13:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `omzet_harian`
--

CREATE TABLE `omzet_harian` (
  `omzet_id` int(11) NOT NULL,
  `omzet_date` date DEFAULT NULL,
  `omzet_nominal` bigint(20) DEFAULT NULL,
  `omzet_catatan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `omzet_harian`
--

INSERT INTO `omzet_harian` (`omzet_id`, `omzet_date`, `omzet_nominal`, `omzet_catatan`, `created_at`, `updated_at`) VALUES
(2, '2022-10-01', 10000000, '1 oktober', NULL, NULL),
(5, '2022-12-07', 2000, 'UNTUKUPPhu', '2022-12-24 19:12:17', '2023-01-24 04:55:47'),
(6, '2022-12-13', 1000, '', '2022-12-26 04:07:33', '2022-12-26 04:13:37'),
(8, '2022-12-03', 54000000, '', '2022-12-26 17:22:58', '2022-12-26 17:22:58'),
(9, '0000-00-00', NULL, NULL, '2023-04-29 22:14:57', '2023-04-29 22:14:57'),
(17, '2003-01-01', 0, NULL, '2023-04-29 22:25:31', '2023-04-29 22:25:31'),
(19, '0002-01-01', 0, NULL, '2023-04-29 22:26:14', '2023-04-29 22:26:14'),
(23, '2023-05-05', -290000, NULL, '2023-05-05 20:21:13', '2023-10-06 17:42:52'),
(24, '2023-05-06', -670000, NULL, '2023-05-06 13:35:47', '2023-05-06 13:35:47'),
(29, '2023-05-22', 0, NULL, '2023-05-22 22:05:02', '2023-05-22 22:05:02'),
(30, '2023-05-23', 0, NULL, '2023-05-23 07:00:24', '2023-10-06 17:42:24'),
(31, '2023-05-24', 5000, 'hari libur', '2023-05-24 13:21:55', '2023-05-25 20:53:28'),
(32, '2023-05-26', 5000, NULL, '2023-05-27 11:10:06', '2023-05-27 11:10:06'),
(33, '2023-06-21', 0, NULL, '2023-06-21 14:19:15', '2023-10-06 19:50:32'),
(34, '2023-10-05', 920000, NULL, '2023-10-05 13:25:22', '2023-10-06 17:38:24'),
(35, '2023-10-04', 0, NULL, '2023-10-05 21:57:13', '2023-10-05 21:57:13'),
(36, '2023-10-06', 16920000, NULL, '2023-10-06 08:41:58', '2023-10-06 23:19:48'),
(37, '2023-10-07', 0, NULL, '2023-10-06 22:21:44', '2023-10-06 23:15:48'),
(38, '2023-10-29', 40000, NULL, '2023-10-29 06:13:20', '2023-10-29 06:48:57'),
(39, '2023-10-30', 240000, NULL, '2023-10-30 15:58:33', '2023-10-30 16:50:56'),
(40, '2023-10-31', 15000, NULL, '2023-10-31 01:46:17', '2023-10-31 01:46:17');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `pelanggan_nama` varchar(255) DEFAULT NULL,
  `pelanggan_telp` varchar(15) DEFAULT NULL,
  `pelanggan_alamat` varchar(255) DEFAULT NULL,
  `pelanggan_catatan` varchar(255) DEFAULT NULL,
  `pelanggan_hutangislunas` tinyint(4) DEFAULT 1,
  `pelanggan_hutangnominal` bigint(20) DEFAULT 0,
  `pelanggan_hutangcatatan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `pelanggan_nama`, `pelanggan_telp`, `pelanggan_alamat`, `pelanggan_catatan`, `pelanggan_hutangislunas`, `pelanggan_hutangnominal`, `pelanggan_hutangcatatan`, `created_at`, `updated_at`) VALUES
(1, 'Kinanti', '14045', 'jl Tunjungan', 'Pelanggan Setia', 1, NULL, NULL, NULL, NULL),
(21, 'tgb njjiu', '244444', 'adscxzce', '', 1, NULL, NULL, '2023-04-17 13:22:03', '2023-05-03 19:38:54'),
(24, 'ciko', '22', 'ciko', '', 0, 32000, NULL, '2023-04-17 13:47:38', '2023-10-30 16:28:11'),
(73, 'andri', '08329', 'bogor', '', 1, 0, '', '2023-10-30 16:50:54', '2023-10-31 01:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

CREATE TABLE `stock_in` (
  `stock_in_id` int(11) NOT NULL,
  `stock_in_date` date DEFAULT NULL,
  `stock_in_barang_id` int(11) DEFAULT NULL,
  `stock_in_barang_barcode` varchar(255) DEFAULT NULL,
  `stock_in_supp` varchar(255) DEFAULT NULL,
  `stock_in_qty` int(11) DEFAULT NULL,
  `stock_in_catatan` varchar(255) DEFAULT NULL,
  `stock_in_nama_barang` varchar(255) DEFAULT NULL,
  `stock_in_harga_masuk` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_in`
--

INSERT INTO `stock_in` (`stock_in_id`, `stock_in_date`, `stock_in_barang_id`, `stock_in_barang_barcode`, `stock_in_supp`, `stock_in_qty`, `stock_in_catatan`, `stock_in_nama_barang`, `stock_in_harga_masuk`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, 'sebuah toko', 14, NULL, NULL, NULL, NULL, NULL),
(7, '2023-05-17', 1, NULL, 'PT Anugrah Jaya, Pak Sam', 915, 'Pengiriman instan', 'Buku Cetak', 8499, '2023-05-17 15:45:40', '2023-05-17 15:45:40'),
(8, '2023-05-17', 1, NULL, 'PT Anugrah Jaya, Pak Sam', 27, 'stock in', 'Buku Cetak', 3534, '2023-05-17 15:48:06', '2023-05-17 15:48:06'),
(13, '2023-05-17', 1, NULL, 'PT Anugrah Jaya, Pak Sam', 11, 'instan tambahan', 'Buku Cetak', 2500, '2023-05-17 17:21:19', '2023-05-17 17:21:19'),
(14, '2023-05-17', 1, 'A001', 'PT Anugrah Jaya, Pak Sam', 11, 'delivery', 'Buku Cetak', 3000, '2023-05-17 17:22:33', '2023-05-17 17:22:33'),
(17, '2023-05-19', 2, 'A002', 'PT Anugrah Jaya, Pak Sam', 5, '', 'Buku Cetak 2', 0, '2023-05-19 16:16:43', '2023-05-19 16:16:43'),
(18, '2023-05-19', 2, 'A002', 'john', 1, '', 'Buku Cetak 2', 5000, '2023-05-19 16:17:13', '2023-05-19 16:17:13'),
(19, '2023-05-21', 10, 'PZ01', '-', 10, '', 'Pizza', 5300, '2023-05-21 15:20:04', '2023-05-21 15:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out`
--

CREATE TABLE `stock_out` (
  `stock_out_id` int(11) NOT NULL,
  `stock_out_date` date DEFAULT NULL,
  `stock_out_barang_id` int(11) DEFAULT NULL,
  `stock_out_barang_barcode` varchar(255) DEFAULT NULL,
  `stock_out_nama_barang` varchar(255) DEFAULT NULL,
  `stock_out_qty` int(11) DEFAULT NULL,
  `stock_out_catatan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_out`
--

INSERT INTO `stock_out` (`stock_out_id`, `stock_out_date`, `stock_out_barang_id`, `stock_out_barang_barcode`, `stock_out_nama_barang`, `stock_out_qty`, `stock_out_catatan`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, NULL, 14, NULL, NULL, NULL),
(14, '2023-05-21', 10, 'PZ01', 'Pizza', 2, '', '2023-05-21 16:02:24', '2023-05-21 16:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_contact`
--

CREATE TABLE `supplier_contact` (
  `supp_id` int(11) NOT NULL,
  `supp_nama` varchar(255) NOT NULL,
  `supp_namaproduk` varchar(255) DEFAULT NULL,
  `supp_telp` varchar(15) DEFAULT NULL,
  `supp_catatan` varchar(255) DEFAULT NULL,
  `supp_alamat` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier_contact`
--

INSERT INTO `supplier_contact` (`supp_id`, `supp_nama`, `supp_namaproduk`, `supp_telp`, `supp_catatan`, `supp_alamat`, `created_at`, `updated_at`) VALUES
(15, 'Margono S.', 'Sampoerna, uMild, Surya', '08938288', 'Rokok, jadwal selasa sore', '', '2023-06-04 21:22:17', '2023-06-05 14:02:28'),
(16, 'Pak Naryo', 'Galon, Minuman Kardus', '0345523', 'Aqua, Club, Cleo, Ale-ale, teh gelas', 'Proliman Blt', '2023-06-04 21:24:54', '2023-06-05 14:02:40'),
(17, 'Pak Mif', 'Snack, Beras, Minyak, Sabun', '0884918', 'hanya kirim2 sebelum jam 11 siang', 'Kel. Nglegok', '2023-06-04 21:27:16', '2023-06-05 14:02:51'),
(18, 'Sandian', 'Beras', '0819482', 'Beras 3kg, 5kg, 10kg', 'Blitar Kota', '2023-06-04 21:29:04', '2023-06-05 14:03:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id_cart` smallint(6) NOT NULL,
  `bstock_id` int(11) NOT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `diskon` decimal(10,0) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `transaksi_id` smallint(6) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `nm_kostumer` varchar(255) NOT NULL,
  `nm_kostumer_id` int(11) DEFAULT 0,
  `is_hutang` tinyint(4) DEFAULT NULL,
  `total_harga` decimal(10,0) DEFAULT NULL,
  `diskon` decimal(10,0) DEFAULT NULL,
  `harga_final` decimal(10,0) DEFAULT NULL,
  `tunai` decimal(10,0) DEFAULT NULL,
  `kembalian` decimal(10,0) DEFAULT NULL,
  `catatan` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`transaksi_id`, `invoice`, `nm_kostumer`, `nm_kostumer_id`, `is_hutang`, `total_harga`, `diskon`, `harga_final`, `tunai`, `kembalian`, `catatan`, `user_id`, `tanggal`, `created_at`) VALUES
(991, 'TK1304230002', 'Pelanggan', 0, NULL, '210000', '0', '210000', '230000', '20000', '', 0, '2023-04-13', '2023-04-13 04:35:30'),
(992, 'TK1304230003', 'Pelanggan', 0, NULL, '200000', '0', '200000', '213000', '13000', '', 0, '2023-04-13', '2023-04-13 08:07:00'),
(993, 'TK1304230004', 'Pelanggan', 0, NULL, '200000', '0', '200000', '205839', '5839', '', 0, '2023-04-13', '2023-04-13 08:24:18'),
(1119, 'TK2405230001', 'aodsif', 71, 2, '5000', '0', '5000', '100', '-4900', '', 0, '2023-05-24', '2023-05-24 06:21:55'),
(1120, 'TK2705230001', 'pel baru', 72, 1, '5000', '0', '5000', '13', '-4987', '', 0, '2023-05-26', '2023-05-27 04:10:06'),
(1177, 'TK3010230001', 'ciko', 24, 1, '60000', '0', '60000', '5000', '0', '', 0, '2023-10-30', '2023-10-30 08:58:33'),
(1178, 'TK3010230002', 'ciko', 24, 1, '60000', '0', '60000', '5000', '0', '', 0, '2023-10-30', '2023-10-30 08:58:46'),
(1179, 'TK3010230003', 'ciko', 24, 1, '60000', '0', '60000', '5000', '0', '', 0, '2023-10-30', '2023-10-30 09:00:36'),
(1180, 'TK3010230004', 'ciko', 24, 1, '30000', '0', '30000', '2000', '0', '', 0, '2023-10-30', '2023-10-30 09:20:38'),
(1181, 'TK3010230005', 'ciko', 24, 1, '10000', '0', '10000', '8000', '0', '', 0, '2023-10-30', '2023-10-30 09:22:23'),
(1182, 'TK3010230006', 'ciko', 24, 1, '10000', '0', '10000', '8000', '3', '', 0, '2023-10-30', '2023-10-30 09:28:10'),
(1183, 'TK3010230007', 'andri', 73, 2, '10000', '0', '10000', '6000', '0', '', 0, '2023-10-30', '2023-10-30 09:50:56'),
(1184, 'TK3110230001', 'andri', 73, 2, '15000', '0', '15000', '3000', '0', '', 0, '2023-10-31', '2023-10-30 18:46:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_detail`
--

CREATE TABLE `tbl_transaksi_detail` (
  `detail_transaksi_id` smallint(6) NOT NULL,
  `transaksi_id` smallint(6) NOT NULL,
  `bstock_id` int(11) NOT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `diskon` decimal(10,0) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_transaksi_detail`
--

INSERT INTO `tbl_transaksi_detail` (`detail_transaksi_id`, `transaksi_id`, `bstock_id`, `harga`, `qty`, `diskon`, `total`) VALUES
(9991, 991, 1, '10000', 21, '0', '210000'),
(9992, 992, 1, '10000', 13, '0', '130000'),
(9993, 992, 2, '5000', 14, '0', '70000'),
(9994, 993, 1, '10000', 13, '0', '130000'),
(9995, 993, 2, '5000', 14, '0', '70000'),
(10092, 1119, 2, '5000', 1, '0', '5000'),
(10093, 1120, 2, '5000', 1, '0', '5000'),
(10108, 1131, 1, '10000', 3, '0', '30000'),
(10109, 1132, 1, '10000', 2, '0', '20000'),
(10110, 1133, 1, '10000', 95, '0', '950000'),
(10112, 1135, 1, '10000', 400, '0', '4000000'),
(10113, 1135, 2, '5000', 902, '0', '4510000'),
(10114, 1136, 1, '10000', 25, '0', '250000'),
(10115, 1136, 2, '5000', 125, '0', '625000'),
(10116, 1137, 1, '10000', 25, '0', '250000'),
(10117, 1137, 2, '5000', 75, '0', '375000'),
(10119, 1139, 1, '10000', 25, '0', '250000'),
(10120, 1139, 2, '5000', 300, '0', '1500000'),
(10121, 1140, 1, '10000', 25, '0', '250000'),
(10122, 1140, 2, '5000', 500, '0', '2500000'),
(10123, 1141, 1, '10000', 25, '0', '250000'),
(10124, 1141, 2, '5000', 25, '0', '125000'),
(10125, 1142, 1, '10000', 25, '0', '250000'),
(10126, 1142, 2, '5000', 23, '0', '115000'),
(10127, 1143, 1, '10000', 25, '0', '250000'),
(10128, 1143, 2, '5000', 52, '0', '260000'),
(10129, 1144, 1, '10000', 25, '0', '250000'),
(10130, 1144, 2, '5000', 25, '0', '125000'),
(10131, 1145, 1, '10000', 5, '0', '50000'),
(10132, 1145, 2, '5000', 3, '0', '15000'),
(10133, 1146, 1, '10000', 3, '0', '30000'),
(10134, 1146, 2, '5000', 2, '0', '10000'),
(10141, 1150, 1, '10000', 2, '0', '20000'),
(10142, 1150, 2, '5000', 3, '0', '15000'),
(10149, 1154, 1, '10000', 3, '0', '30000'),
(10150, 1154, 2, '5000', 5, '0', '25000'),
(10151, 1155, 1, '10000', 2, '0', '20000'),
(10152, 1155, 2, '5000', 4, '0', '20000'),
(10153, 1156, 1, '10000', 11, '0', '110000'),
(10154, 1156, 2, '5000', 32, '0', '160000'),
(10157, 1158, 1, '10000', 3, '0', '30000'),
(10158, 1158, 2, '5000', 1, '0', '5000'),
(10163, 1161, 1, '10000', 3, '0', '30000'),
(10164, 1161, 2, '5000', 4, '0', '20000'),
(10165, 1162, 1, '10000', 3, '0', '30000'),
(10166, 1162, 2, '5000', 2, '0', '10000'),
(10167, 1163, 1, '10000', 5, '0', '50000'),
(10168, 1163, 2, '5000', 2, '0', '10000'),
(10171, 1165, 1, '10000', 1, '0', '10000'),
(10172, 1165, 2, '5000', 3, '0', '15000'),
(10175, 1167, 1, '10000', 1, '0', '10000'),
(10176, 1167, 2, '5000', 2, '0', '10000'),
(10191, 1175, 1, '10000', 2, '0', '20000'),
(10192, 1176, 1, '10000', 2, '0', '20000'),
(10193, 1177, 1, '10000', 6, '0', '60000'),
(10194, 1180, 1, '10000', 3, '0', '30000'),
(10195, 1181, 1, '10000', 1, '0', '10000'),
(10196, 1182, 1, '10000', 1, '0', '10000'),
(10197, 1183, 1, '10000', 1, '0', '10000'),
(10198, 1184, 1, '10000', 1, '0', '10000'),
(10199, 1184, 2, '5000', 1, '0', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(20) NOT NULL,
  `user_password` varchar(10) NOT NULL,
  `user_isadmin` tinyint(1) NOT NULL DEFAULT 0,
  `user_nama` varchar(255) NOT NULL,
  `user_alamat` varchar(255) DEFAULT NULL,
  `user_telp` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_isadmin`, `user_nama`, `user_alamat`, `user_telp`, `created_at`, `updated_at`) VALUES
(0, 'kasir', 'jika', 1, '', NULL, NULL, '2022-12-26 04:06:28', '2022-12-26 04:06:42'),
(2, 'jika', 'jika', 0, '', NULL, NULL, '2022-12-22 17:26:46', '2022-12-22 17:26:46'),
(3, 'ononno', 'kau', 0, '', NULL, NULL, '2022-12-22 17:46:27', '2022-12-22 21:06:51'),
(6, 'madara', 'madara', 1, '', NULL, NULL, '2022-12-23 08:13:58', '2022-12-23 08:13:58'),
(8, 'yuyu', 'jika', 1, '', NULL, NULL, '2022-12-26 04:06:28', '2022-12-26 04:06:42'),
(10, 'briko', 'birko', 0, 'bribi', 'palembang', '333', '2023-05-02 21:43:09', '2023-05-02 21:43:09'),
(20, 'admin', 'admin', 1, 'admin', 'admin', '048123', '2023-05-23 20:10:54', '2023-05-23 20:10:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_kategori`
--
ALTER TABLE `barang_kategori`
  ADD PRIMARY KEY (`bkategori_id`);

--
-- Indexes for table `barang_satuan`
--
ALTER TABLE `barang_satuan`
  ADD PRIMARY KEY (`bsatuan_id`);

--
-- Indexes for table `barang_stock`
--
ALTER TABLE `barang_stock`
  ADD PRIMARY KEY (`bstock_id`);

--
-- Indexes for table `hutang_pelanggan`
--
ALTER TABLE `hutang_pelanggan`
  ADD PRIMARY KEY (`hutang_id`);

--
-- Indexes for table `omzet_harian`
--
ALTER TABLE `omzet_harian`
  ADD PRIMARY KEY (`omzet_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`stock_in_id`);

--
-- Indexes for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`stock_out_id`);

--
-- Indexes for table `supplier_contact`
--
ALTER TABLE `supplier_contact`
  ADD PRIMARY KEY (`supp_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `tbl_cart_bstock_id_foreign` (`bstock_id`),
  ADD KEY `tbl_cart_user_id_foreign` (`user_id`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `tbl_transaksi_user_id_foreign` (`user_id`);

--
-- Indexes for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  ADD PRIMARY KEY (`detail_transaksi_id`),
  ADD KEY `tbl_transaksi_detail_bstock_id_foreign` (`bstock_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_kategori`
--
ALTER TABLE `barang_kategori`
  MODIFY `bkategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `barang_satuan`
--
ALTER TABLE `barang_satuan`
  MODIFY `bsatuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `barang_stock`
--
ALTER TABLE `barang_stock`
  MODIFY `bstock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hutang_pelanggan`
--
ALTER TABLE `hutang_pelanggan`
  MODIFY `hutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `omzet_harian`
--
ALTER TABLE `omzet_harian`
  MODIFY `omzet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `stock_in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `stock_out_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `supplier_contact`
--
ALTER TABLE `supplier_contact`
  MODIFY `supp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id_cart` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `transaksi_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1185;

--
-- AUTO_INCREMENT for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  MODIFY `detail_transaksi_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10200;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_bstock_id_foreign` FOREIGN KEY (`bstock_id`) REFERENCES `barang_stock` (`bstock_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD CONSTRAINT `tbl_transaksi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  ADD CONSTRAINT `tbl_transaksi_detail_bstock_id_foreign` FOREIGN KEY (`bstock_id`) REFERENCES `barang_stock` (`bstock_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
