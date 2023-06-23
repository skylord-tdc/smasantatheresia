-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2023 at 06:22 AM
-- Server version: 8.0.30
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smasantatheresia`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_admin`
--

CREATE TABLE `akun_admin` (
  `id` int NOT NULL,
  `aktor` char(1) NOT NULL DEFAULT '0',
  `secure` varchar(255) NOT NULL,
  `nm` varchar(255) NOT NULL,
  `jk` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pw` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun_admin`
--

INSERT INTO `akun_admin` (`id`, `aktor`, `secure`, `nm`, `jk`, `email`, `pw`) VALUES
(1, '0', 'ca29cb4a-3e20-49aa-0-840b-b10bfe34fa78', 'Admin', 'null', 'admin@sma.test', 'root-0');

-- --------------------------------------------------------

--
-- Table structure for table `akun_ppdb`
--

CREATE TABLE `akun_ppdb` (
  `id` int NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `role` char(1) NOT NULL DEFAULT '1',
  `nm` varchar(90) NOT NULL,
  `tgl_lhr` varchar(50) NOT NULL,
  `jk` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `status` enum('online','offline') NOT NULL DEFAULT 'offline'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form_ppdb`
--

CREATE TABLE `form_ppdb` (
  `id` int NOT NULL,
  `uuid` varchar(60) NOT NULL,
  `thn_dibuat` year NOT NULL,
  `nisn` varchar(30) NOT NULL,
  `nm_peserta` varchar(90) NOT NULL,
  `tmpt_lhr` varchar(255) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `agama` varchar(60) NOT NULL DEFAULT 'Katolik',
  `alamat` text NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `jurusan` varchar(30) NOT NULL DEFAULT 'IPA',
  `nm_ayah` varchar(90) NOT NULL,
  `pend_ayah` varchar(90) NOT NULL,
  `pek_ayah` varchar(90) NOT NULL,
  `no_hp_ayah` varchar(30) NOT NULL,
  `nm_ibu` varchar(90) NOT NULL,
  `pend_ibu` varchar(90) NOT NULL,
  `pek_ibu` varchar(90) NOT NULL,
  `no_hp_ibu` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_ppdb`
--

CREATE TABLE `hasil_ppdb` (
  `id` int NOT NULL,
  `nisn` varchar(60) NOT NULL,
  `nm` varchar(90) NOT NULL,
  `nilai` int NOT NULL,
  `thn` year NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upload_berkas`
--

CREATE TABLE `upload_berkas` (
  `id` int NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `thn_dibuat` year NOT NULL,
  `name` text NOT NULL,
  `size` int NOT NULL,
  `type` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_admin`
--
ALTER TABLE `akun_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akun_ppdb`
--
ALTER TABLE `akun_ppdb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- Indexes for table `form_ppdb`
--
ALTER TABLE `form_ppdb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`) USING BTREE;

--
-- Indexes for table `hasil_ppdb`
--
ALTER TABLE `hasil_ppdb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_berkas`
--
ALTER TABLE `upload_berkas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun_admin`
--
ALTER TABLE `akun_admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `akun_ppdb`
--
ALTER TABLE `akun_ppdb`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_ppdb`
--
ALTER TABLE `form_ppdb`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_ppdb`
--
ALTER TABLE `hasil_ppdb`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upload_berkas`
--
ALTER TABLE `upload_berkas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
