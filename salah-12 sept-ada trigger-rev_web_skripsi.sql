-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 06:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `bkategori_nama` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barang_satuan`
--

CREATE TABLE `barang_satuan` (
  `bsatuan_nama` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `bstock_catatan` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_stock`
--

INSERT INTO `barang_stock` (`bstock_id`, `bstock_custom_code`, `bstock_nama_barang`, `bstock_kategori`, `bstock_unit`, `bstock_harga`, `bstock_ready_stock`, `bstock_catatan`, `created_at`, `updated_at`) VALUES
(1, 'A001', 'Buku Cetak', 'Buku', 'PCS', 10000, 100, NULL, NULL, NULL),
(2, 'A002', 'Buku Cetak 2', 'Buku', 'PCS', 5000, 90, NULL, NULL, NULL);

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
  `hutang_invoice_transaksi` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hutang_pelanggan`
--

INSERT INTO `hutang_pelanggan` (`hutang_id`, `hutang_date`, `hutang_nominal`, `hutang_catatan`, `hutang_islunas`, `hutang_idpelanggan`, `hutang_invoice_transaksi`, `created_at`, `updated_at`) VALUES
(1, '2022-12-14', 2000000, 'beli permen', 0, NULL, NULL, NULL, NULL),
(4, '2022-11-29', 2000000, '', 1, NULL, NULL, '2022-12-26 07:20:59', '2022-12-26 07:20:59'),
(5, '2022-11-30', 4155000, '', 1, NULL, NULL, '2022-12-26 07:21:37', '2022-12-26 07:26:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-04-06-035622', 'App\\Database\\Migrations\\TblCart', 'default', 'App', 1681183534, 1),
(2, '2023-04-07-153314', 'App\\Database\\Migrations\\TblPenjualan', 'default', 'App', 1681183534, 1),
(4, '2023-04-07-153314', 'App\\Database\\Migrations\\TblPenjualanDetail', 'default', 'App', 1681185773, 2);

-- --------------------------------------------------------

--
-- Table structure for table `omzet_harian`
--

CREATE TABLE `omzet_harian` (
  `omzet_id` int(11) NOT NULL,
  `omzet_date` date NOT NULL,
  `omzet_nominal` bigint(20) NOT NULL,
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
(8, '2022-12-03', 54000000, '', '2022-12-26 17:22:58', '2022-12-26 17:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `pelanggan_nama` varchar(255) NOT NULL,
  `pelanggan_telp` varchar(15) NOT NULL,
  `pelanggan_alamat` varchar(255) NOT NULL,
  `pelanggan_catatan` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

CREATE TABLE `stock_in` (
  `stock_in_id` int(11) NOT NULL,
  `stock_in_date` date DEFAULT NULL,
  `stock_in_barang_id` int(11) NOT NULL,
  `stock_in_supp` varchar(255) DEFAULT NULL,
  `stock_in_catatan` varchar(255) DEFAULT NULL,
  `stock_in_qty` int(11) DEFAULT NULL,
  `stock_in_nama_barang` varchar(255) DEFAULT NULL,
  `stock_in_harga_masuk` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_out`
--

CREATE TABLE `stock_out` (
  `stock_out_id` int(11) NOT NULL,
  `stock_out_date` date DEFAULT NULL,
  `stock_out_barang_id` int(11) DEFAULT NULL,
  `stock_out_nama_barang` varchar(255) DEFAULT NULL,
  `stock_out_catatan` varchar(255) DEFAULT NULL,
  `stock_out_qty` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'john', 'aqua', '421', 'cleo orange dengan kemasan dan diantar dengan truk dari semalam hingga minggu depan', 'jalan mahemayo', '2022-12-25 09:52:40', '2022-12-26 17:40:50'),
(4, 'Eko SutiDJO', 'air', '87654321', '', 'jakarta', '2022-12-26 17:38:52', '2022-12-26 17:38:52'),
(7, 'njuhygtfc vnjko', '', '', '', '', '2022-12-26 17:44:20', '2022-12-26 17:44:20'),
(8, 'dedi', 'kertas', '', '', '', '2023-01-24 00:11:00', '2023-01-24 00:11:00');

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

INSERT INTO `tbl_transaksi` (`transaksi_id`, `invoice`, `nm_kostumer`, `total_harga`, `diskon`, `harga_final`, `tunai`, `kembalian`, `catatan`, `user_id`, `tanggal`, `created_at`) VALUES
(4, 'TK1104230004', 'Pelanggan', '9000', '1000', '8000', '10000', '2000', 'Lunas', 0, '2023-04-11', '2023-04-11 04:05:33'),
(5, 'TK1104230005', 'Pelanggan', '55000', '0', '55000', '60000', '5000', 'Lunas', 0, '2023-04-11', '2023-04-11 04:12:48'),
(6, 'TK1104230006', 'Pelanggan', '50000', '0', '50000', '50000', '0', '', 0, '2023-04-11', '2023-04-11 04:20:16');

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
(2, 4, 1, '10000', 1, '1000', '9000'),
(3, 5, 1, '10000', 1, '0', '10000'),
(4, 5, 2, '5000', 10, '500', '45000'),
(5, 6, 2, '5000', 10, '0', '50000');

--
-- Triggers `tbl_transaksi_detail`
--
DELIMITER $$
CREATE TRIGGER `stok_min` AFTER INSERT ON `tbl_transaksi_detail` FOR EACH ROW BEGIN
UPDATE barang_stock SET bstock_ready_stock = bstock_ready_stock - NEW.qty where bstock_id = NEW.bstock_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_return` AFTER DELETE ON `tbl_transaksi_detail` FOR EACH ROW BEGIN
UPDATE barang_stock SET bstock_ready_stock = bstock_ready_stock + OLD.qty where bstock_id = OLD.bstock_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(20) NOT NULL,
  `user_password` varchar(10) NOT NULL,
  `user_isowner` tinyint(1) NOT NULL DEFAULT 0,
  `user_nama` varchar(255) NOT NULL,
  `user_alamat` varchar(255) DEFAULT NULL,
  `user_telp` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_isowner`, `user_nama`, `user_alamat`, `user_telp`, `created_at`, `updated_at`) VALUES
(0, 'kasir', 'jika', 1, '', NULL, NULL, '2022-12-26 04:06:28', '2022-12-26 04:06:42'),
(2, 'jika', 'jika', 0, '', NULL, NULL, '2022-12-22 17:26:46', '2022-12-22 17:26:46'),
(3, 'ononno', 'kau', 0, '', NULL, NULL, '2022-12-22 17:46:27', '2022-12-22 21:06:51'),
(6, 'madara', 'madara', 1, '', NULL, NULL, '2022-12-23 08:13:58', '2022-12-23 08:13:58'),
(8, 'yuyu', 'jika', 1, '', NULL, NULL, '2022-12-26 04:06:28', '2022-12-26 04:06:42');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `omzet_harian`
--
ALTER TABLE `omzet_harian`
  ADD PRIMARY KEY (`omzet_id`);

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
  ADD KEY `tbl_transaksi_detail_bstock_id_foreign` (`bstock_id`),
  ADD KEY `tbl_transaksi_detail_transaksi_id_foreign` (`transaksi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_stock`
--
ALTER TABLE `barang_stock`
  MODIFY `bstock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hutang_pelanggan`
--
ALTER TABLE `hutang_pelanggan`
  MODIFY `hutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `omzet_harian`
--
ALTER TABLE `omzet_harian`
  MODIFY `omzet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `stock_in_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `stock_out_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_contact`
--
ALTER TABLE `supplier_contact`
  MODIFY `supp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id_cart` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `transaksi_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  MODIFY `detail_transaksi_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `tbl_transaksi_detail_bstock_id_foreign` FOREIGN KEY (`bstock_id`) REFERENCES `barang_stock` (`bstock_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_transaksi_detail_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `tbl_transaksi` (`transaksi_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
