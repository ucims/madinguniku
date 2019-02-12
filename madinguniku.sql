-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 20, 2018 at 01:06 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `madinguniku`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fakultas1`
--

CREATE TABLE `tbl_fakultas1` (
  `id_fakultas` int(2) NOT NULL,
  `nama_fakultas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fakultas1`
--

INSERT INTO `tbl_fakultas1` (`id_fakultas`, `nama_fakultas`) VALUES
(1, 'Fakultas Ilmu Komputerr'),
(2, 'Fakultas Ekonomi'),
(4, 'dd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `id_post` int(25) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `id_fakultas` int(2) NOT NULL,
  `id_prodi` int(2) NOT NULL,
  `level` varchar(25) NOT NULL,
  `file_url` text,
  `keterangan` text NOT NULL,
  `sifat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`id_post`, `judul`, `tanggal`, `id_fakultas`, `id_prodi`, `level`, `file_url`, `keterangan`, `sifat`) VALUES
(8, 'Pengumuman Kegiatan Ospek tahun 2018', '2018-09-08', 1, 9, 'Mahasiswa', 'uploads/5b93e31e7d06f6.73150502-jpg', 'o', 'Penting');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prodi1`
--

CREATE TABLE `tbl_prodi1` (
  `id_prodi` int(2) NOT NULL,
  `nama_prodi` varchar(255) NOT NULL,
  `id_fakultas` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prodi1`
--

INSERT INTO `tbl_prodi1` (`id_prodi`, `nama_prodi`, `id_fakultas`) VALUES
(8, 'TI', 1),
(9, 'Sistem Informatika', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user1`
--

CREATE TABLE `tbl_user1` (
  `id_user` varchar(255) NOT NULL,
  `id_fakultas` int(2) NOT NULL,
  `id_prodi` int(2) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user1`
--

INSERT INTO `tbl_user1` (`id_user`, `id_fakultas`, `id_prodi`, `nama`, `username`, `password`, `level`) VALUES
('2014081110', 1, 9, 'Uci Muhamad Sanusi', 'atep', '1234', 'Mahasiswa'),
('3231222', 1, 8, 'Tata Usah TI ', 'ti', '123', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_fakultas1`
--
ALTER TABLE `tbl_fakultas1`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_fakultas` (`id_fakultas`,`id_prodi`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `tbl_prodi1`
--
ALTER TABLE `tbl_prodi1`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indexes for table `tbl_user1`
--
ALTER TABLE `tbl_user1`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_fakultas` (`id_fakultas`,`id_prodi`),
  ADD KEY `tbl_user1_ibfk_1` (`id_prodi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `id_post` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD CONSTRAINT `tbl_post_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `tbl_fakultas1` (`id_fakultas`),
  ADD CONSTRAINT `tbl_post_ibfk_2` FOREIGN KEY (`id_prodi`) REFERENCES `tbl_prodi1` (`id_prodi`);

--
-- Constraints for table `tbl_prodi1`
--
ALTER TABLE `tbl_prodi1`
  ADD CONSTRAINT `tbl_prodi1_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `tbl_fakultas1` (`id_fakultas`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_user1`
--
ALTER TABLE `tbl_user1`
  ADD CONSTRAINT `tbl_user1_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `tbl_prodi1` (`id_prodi`),
  ADD CONSTRAINT `tbl_user1_ibfk_2` FOREIGN KEY (`id_fakultas`) REFERENCES `tbl_fakultas1` (`id_fakultas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
