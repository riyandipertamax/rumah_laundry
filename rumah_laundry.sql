-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2016 at 12:45 AM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rumah_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(5) NOT NULL,
  `admin_nama` varchar(50) NOT NULL,
  `admin_username` varchar(30) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `level` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_nama`, `admin_username`, `admin_password`, `level`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'ewok', 'ewok', 'e10adc3949ba59abbe56e057f20f883e', 2),
(3, 'petugas', 'petugas', 'e10adc3949ba59abbe56e057f20f883e', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` varchar(15) NOT NULL,
  `admin_id` int(3) NOT NULL,
  `order_tanggal_transaksi` datetime NOT NULL,
  `order_total_bayar` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `admin_id`, `order_tanggal_transaksi`, `order_total_bayar`) VALUES
('RL/11/16/0001', 1, '2016-01-01 23:14:36', 81000),
('RL/11/16/0002', 1, '2016-11-08 02:12:36', 120000),
('RL/11/16/0003', 1, '2016-11-08 05:37:43', 36000);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_detail_id` int(20) NOT NULL,
  `order_id` varchar(13) NOT NULL,
  `tarif_id` int(5) NOT NULL,
  `order_detail_jumlah` int(8) DEFAULT NULL,
  `order_detail_subtotal` int(8) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `tarif_id`, `order_detail_jumlah`, `order_detail_subtotal`) VALUES
(59, 'RL/11/16/0001', 5, 3, 36000),
(60, 'RL/11/16/0001', 4, 3, 45000),
(61, 'RL/11/16/0002', 9, 12, 120000),
(62, 'RL/11/16/0003', 20, 3, 36000);

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE IF NOT EXISTS `tarif` (
  `tarif_id` int(5) NOT NULL,
  `tarif_nama` varchar(50) NOT NULL,
  `tarif_ukuran` varchar(20) NOT NULL,
  `tarif_harga` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`tarif_id`, `tarif_nama`, `tarif_ukuran`, `tarif_harga`) VALUES
(1, 'bed cover', 'besar', 30000),
(2, 'bed cover ', 'sedang', 20000),
(3, 'bed cover', 'kecil', 15000),
(4, 'Sprei', 'besar', 15000),
(5, 'sprei', 'kecil', 12000),
(6, 'selimut', 'besar', 25000),
(7, 'selimut', 'sedang', 20000),
(8, 'selimut', 'kecil', 10000),
(9, 'sarung bantal', 'besar', 10000),
(10, 'Sarung Bantal', 'kecil', 5000),
(11, 'Setrika', 'per kg', 4000),
(12, 'cuci', 'per kg', 5000),
(13, 'gaun', 'per pcs', 25000),
(14, 'kemeja', 'per pcs', 8000),
(15, 'kaos', 'per pcs', 8000),
(16, 'celana pendek', 'per pcs', 7000),
(17, 'celana panjang', 'per pcs', 10000),
(18, 'jilbab', 'per pcs', 5000),
(19, 'rok', 'per pcs', 9000),
(20, 'sweater', 'per pcs', 12000),
(21, 'jaket', 'per pcs', 12000),
(22, 'jaket tebal', 'per pcs', 16000),
(23, 'mukena', 'per pcs', 14000),
(24, 'sejadah', 'per pcs', 10000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `tarif_id` (`tarif_id`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`tarif_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `tarif_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
