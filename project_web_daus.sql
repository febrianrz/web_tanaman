-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2017 at 10:31 AM
-- Server version: 5.7.20
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_web_daus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(36) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `nama`, `password`, `status`) VALUES
('4b12d4e1-d5db-11e7-ac5d-507b9db6fc35', 'firdaussmuttaqin@gmail.com', 'Firdaus', '6e7190cc1194a3eab16bfb392e4a08b2406ba23f', 'Aktif'),
('masteradminbakti', 'daniesimanjuntak@gmail.com', 'Dani', '3da541559918a808c2402bba5012f6c60b27661c', 'Aktif');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `insert_id_admin` BEFORE INSERT ON `admin` FOR EACH ROW BEGIN 
    SET NEW.id = UUID(); 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `famili_tanaman`
--

CREATE TABLE `famili_tanaman` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `famili_tanaman`
--

INSERT INTO `famili_tanaman` (`id`, `nama`) VALUES
(1, 'Malvacaeae'),
(2, 'Thymelaeaceae'),
(3, 'Zingiberaceae');

-- --------------------------------------------------------

--
-- Table structure for table `master_tanaman`
--

CREATE TABLE `master_tanaman` (
  `id` int(11) NOT NULL,
  `nama_tanaman` varchar(50) NOT NULL,
  `nama_ilmiah` varchar(50) NOT NULL,
  `id_famili` int(11) NOT NULL,
  `pemanfaatan` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `peneliti` varchar(225) NOT NULL,
  `nama_lembaga` varchar(100) NOT NULL,
  `tempat_penelitian` varchar(200) NOT NULL,
  `nama_etnis` varchar(50) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `waktu_penelitian` varchar(100) NOT NULL,
  `metode_penelitian` text NOT NULL,
  `ketinggian_lokasi` varchar(50) NOT NULL,
  `bentuk_pemanfaatan` varchar(100) NOT NULL,
  `kandungan` varchar(100) NOT NULL,
  `cara_penggunaan` varchar(100) NOT NULL,
  `khasiat` varchar(50) NOT NULL,
  `media_tanam` varchar(50) NOT NULL,
  `ciri_fisik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_tanaman`
--

INSERT INTO `master_tanaman` (`id`, `nama_tanaman`, `nama_ilmiah`, `id_famili`, `pemanfaatan`, `latitude`, `longitude`, `peneliti`, `nama_lembaga`, `tempat_penelitian`, `nama_etnis`, `tujuan`, `waktu_penelitian`, `metode_penelitian`, `ketinggian_lokasi`, `bentuk_pemanfaatan`, `kandungan`, `cara_penggunaan`, `khasiat`, `media_tanam`, `ciri_fisik`) VALUES
(53, 'temulawak', 'testing', 0, 'obat', '123123', '123123', 'joko', 'lab', 'lab', 'tes', 'tes', 'tes', 'tes', 'tes', 'tes', 'tes', 'tes', 'tes', 'tes', 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `option_web`
--

CREATE TABLE `option_web` (
  `id` mediumint(9) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `option` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `option_web`
--

INSERT INTO `option_web` (`id`, `nama`, `option`) VALUES
(1, 'web_name', 'Tanaman');

-- --------------------------------------------------------

--
-- Table structure for table `source_web`
--

CREATE TABLE `source_web` (
  `id` int(11) NOT NULL,
  `domain` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `famili_tanaman`
--
ALTER TABLE `famili_tanaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_tanaman`
--
ALTER TABLE `master_tanaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option_web`
--
ALTER TABLE `option_web`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `source_web`
--
ALTER TABLE `source_web`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `famili_tanaman`
--
ALTER TABLE `famili_tanaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `master_tanaman`
--
ALTER TABLE `master_tanaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `option_web`
--
ALTER TABLE `option_web`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `source_web`
--
ALTER TABLE `source_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
