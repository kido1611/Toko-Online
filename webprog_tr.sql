-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2017 at 06:36 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webprog_tr`
--

-- --------------------------------------------------------

--
-- Table structure for table `webprog_barang`
--

CREATE TABLE `webprog_barang` (
  `barang_id` int(11) NOT NULL,
  `barang_nama` varchar(255) NOT NULL,
  `barang_harga` int(11) NOT NULL,
  `barang_kategori` int(11) NOT NULL,
  `barang_jumlah` int(11) NOT NULL,
  `barang_gambar` varchar(255) NOT NULL,
  `barang_tanggal_tambah` varchar(255) NOT NULL,
  `barang_keterangan` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webprog_barang`
--

INSERT INTO `webprog_barang` (`barang_id`, `barang_nama`, `barang_harga`, `barang_kategori`, `barang_jumlah`, `barang_gambar`, `barang_tanggal_tambah`, `barang_keterangan`) VALUES
(4, 'Laptop', 4000000, 2, 8, 'barang/Laptop_2.jpg', '2017-08-08 05:28:27', ''),
(5, 'NodeMCU v3', 87000, 4, 23, 'barang/NodeMCU_nodemcudevkit_v1-0_io.jpg', '2017-08-08 05:31:00', 'IOT '),
(6, 'Arduino Mega', 120000, 4, 5, 'barang/Arduino Mega_Mega2560_R3_Label-small-v2.png', '2017-08-08 05:31:44', ''),
(8, 'Counter Strike Global Offensive', 116000, 5, 1000, 'barang/Counter Strike Global Offensive_csgo.png', '2017-08-08 05:34:31', ''),
(9, 'Arduino Nano', 38000, 4, 16, 'barang/Arduino Nano_nano.jpg', '2017-08-11 07:12:28', 'Nano');

-- --------------------------------------------------------

--
-- Table structure for table `webprog_cart`
--

CREATE TABLE `webprog_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_jasa_kirim` int(11) NOT NULL,
  `cart_tanggal_tambah` varchar(255) NOT NULL,
  `cart_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webprog_cart`
--

INSERT INTO `webprog_cart` (`cart_id`, `user_id`, `cart_jasa_kirim`, `cart_tanggal_tambah`, `cart_transaksi`) VALUES
(1, 10, 0, '2017-08-13 19:59:48', 1),
(2, 10, 0, '2017-08-13 23:51:55', 1),
(3, 10, 0, '2017-08-14 05:25:39', 1),
(4, 10, 0, '2017-08-14 06:13:57', 0),
(45, 14, 0, '2017-08-14 06:25:23', 0),
(46, 0, 0, '2017-08-14 06:25:58', 0),
(47, 1, 0, '2017-08-14 06:27:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `webprog_cart_item`
--

CREATE TABLE `webprog_cart_item` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `cart_item_jumlah` int(11) NOT NULL,
  `cart_item_keterangan` varchar(255) NOT NULL,
  `cart_item_tanggal_tambah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webprog_cart_item`
--

INSERT INTO `webprog_cart_item` (`cart_item_id`, `cart_id`, `barang_id`, `cart_item_jumlah`, `cart_item_keterangan`, `cart_item_tanggal_tambah`) VALUES
(1, 1, 8, 3, '', '2017-08-13 20:23:28'),
(4, 1, 4, 1, '					\r\n				', '2017-08-13 21:44:46'),
(5, 1, 6, 5, '					\r\n				', '2017-08-13 21:45:28'),
(6, 1, 5, 3, '						\r\n					', '2017-08-13 21:51:47'),
(7, 2, 9, 1, '						\r\n					', '2017-08-13 23:54:03'),
(8, 2, 8, 1, '						\r\n					', '2017-08-14 05:22:45'),
(9, 0, 6, 1, '						\r\n					', '2017-08-14 05:37:51'),
(10, 0, 6, 0, '						\r\n					', '2017-08-14 05:42:32'),
(16, 3, 6, 2, '						\r\n					', '2017-08-14 05:56:41'),
(17, 3, 8, 5, '						\r\n					', '2017-08-14 05:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `webprog_kategori`
--

CREATE TABLE `webprog_kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(255) NOT NULL,
  `kategori_tanggal_tambah` varchar(255) NOT NULL,
  `kategori_index` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webprog_kategori`
--

INSERT INTO `webprog_kategori` (`kategori_id`, `kategori_nama`, `kategori_tanggal_tambah`, `kategori_index`) VALUES
(2, 'Komputer', '2017-08-07 16:38:03', 0),
(3, 'Handphone', '2017-08-07 16:38:10', 0),
(4, 'Elektronik', '2017-08-08 04:28:54', 0),
(5, 'Game Steam', '2017-08-08 05:31:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `webprog_user`
--

CREATE TABLE `webprog_user` (
  `user_id` int(11) NOT NULL,
  `user_jenis` int(11) NOT NULL,
  `user_nama` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_alamat` varchar(255) NOT NULL,
  `user_nohp` varchar(255) NOT NULL,
  `user_tanggal_daftar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webprog_user`
--

INSERT INTO `webprog_user` (`user_id`, `user_jenis`, `user_nama`, `user_email`, `user_username`, `user_password`, `user_alamat`, `user_nohp`, `user_tanggal_daftar`) VALUES
(1, -1, 'admin', 'admin@localhost', 'admin', 'YWRtaW4=', 'admin', '0123456789', '2017-08-08 04:26:26'),
(9, 1, 'Muhammad Abdusy Syukur', 'ahmadci3@gmail.com', 'abdusy', 'YWhtYWRjaTNAZ21haWwuY29t', 'Semarang', '085727758392', '2017-08-03 16:10:23'),
(10, 1, 'Muhammad Abdusy Syukur', 'ahmadci3@gmail.com', 'abdusy2', 'YWhtYWQ=', 'Semarang', '+6285727758392', '2017-08-08 04:11:21'),
(11, 1, 'coba', 'coba@localhost', 'coba', 'Y29iYQ==', 'coba', '0812371237', '2017-08-11 07:30:12'),
(12, 1, 'Muhammad Abdusy Syukur', 'ahmadci3@gmail.com', 'abdusy3', 'YWhtYWQ=', 'semarang', '085727758392', '2017-08-13 05:56:27'),
(13, 1, 'Muhammad Abdusy Syukur', 'ahmadci3@gmail.com', 'abdusy4', 'YWhtYWQ=', 'semarang', '085727758392', '2017-08-13 05:57:13'),
(14, 1, 'ahmad', 'ahmad@localhost', 'ahmad', 'YWhtYWQ=', 'ahmad', '085727758392', '2017-08-14 06:14:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `webprog_barang`
--
ALTER TABLE `webprog_barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `webprog_cart`
--
ALTER TABLE `webprog_cart`
  ADD PRIMARY KEY (`cart_id`,`user_id`);

--
-- Indexes for table `webprog_cart_item`
--
ALTER TABLE `webprog_cart_item`
  ADD PRIMARY KEY (`cart_item_id`,`cart_id`,`barang_id`);

--
-- Indexes for table `webprog_kategori`
--
ALTER TABLE `webprog_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `webprog_user`
--
ALTER TABLE `webprog_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `webprog_barang`
--
ALTER TABLE `webprog_barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `webprog_cart`
--
ALTER TABLE `webprog_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `webprog_cart_item`
--
ALTER TABLE `webprog_cart_item`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `webprog_kategori`
--
ALTER TABLE `webprog_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `webprog_user`
--
ALTER TABLE `webprog_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
