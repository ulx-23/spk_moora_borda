-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2025 at 06:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_moora_borda`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `kode_alternatif` varchar(10) NOT NULL,
  `nama_alternatif` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id_alternatif`, `kode_alternatif`, `nama_alternatif`) VALUES
(1, 'A', 'LOKASI A'),
(2, 'B', 'LOKASI B'),
(3, 'C', 'LOKASI C'),
(4, 'D', 'LOKASI D'),
(5, 'E', 'LOKASI E'),
(6, 'F', 'LOKASI F'),
(7, 'G', 'LOKASI G'),
(8, 'H', 'LOKASI H'),
(9, 'I', 'LOKASI I'),
(10, 'J', 'LOKASI J');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(5) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `bobot` float NOT NULL,
  `type` enum('Benefit','Cost') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `bobot`, `type`) VALUES
(1, 'C1', 'Kepadatan Penduduk', 0.35, 'Benefit'),
(2, 'C2', 'Jarak ke Puskesmas', 0.25, 'Cost'),
(3, 'C3', 'Ketersediaan Ruangan', 0.15, 'Benefit'),
(4, 'C4', 'Biaya Operasional', 0.15, 'Cost'),
(5, 'C5', 'Aksebilitas Lokasi', 0.1, 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_penilaian`
--

INSERT INTO `tb_penilaian` (`id_penilaian`, `id_user`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(1, 2, 1, 1, 145),
(2, 2, 1, 2, 1.2),
(3, 2, 1, 3, 4),
(4, 2, 1, 4, 800),
(5, 2, 1, 5, 4),
(6, 2, 2, 1, 200),
(7, 2, 2, 2, 2.5),
(8, 2, 2, 3, 3),
(9, 2, 2, 4, 500),
(10, 2, 2, 5, 3),
(11, 2, 3, 1, 120),
(12, 2, 3, 2, 0.8),
(13, 2, 3, 3, 5),
(14, 2, 3, 4, 1200),
(15, 2, 3, 5, 5),
(16, 2, 4, 1, 180),
(17, 2, 4, 2, 1.5),
(18, 2, 4, 3, 4),
(19, 2, 4, 4, 600),
(20, 2, 4, 5, 4),
(21, 2, 5, 1, 220),
(22, 2, 5, 2, 2),
(23, 2, 5, 3, 3),
(24, 2, 5, 4, 700),
(25, 2, 5, 5, 3),
(26, 2, 6, 1, 130),
(27, 2, 6, 2, 1),
(28, 2, 6, 3, 5),
(29, 2, 6, 4, 900),
(30, 2, 6, 5, 5),
(31, 2, 7, 1, 170),
(32, 2, 7, 2, 1.8),
(33, 2, 7, 3, 4),
(34, 2, 7, 4, 550),
(35, 2, 7, 5, 4),
(36, 2, 8, 1, 190),
(37, 2, 8, 2, 2.2),
(38, 2, 8, 3, 3),
(39, 2, 8, 4, 650),
(40, 2, 8, 5, 3),
(41, 2, 9, 1, 140),
(42, 2, 9, 2, 0.9),
(43, 2, 9, 3, 5),
(44, 2, 9, 4, 1100),
(45, 2, 9, 5, 5),
(46, 2, 10, 1, 160),
(47, 2, 10, 2, 1.6),
(48, 2, 10, 3, 4),
(49, 2, 10, 4, 750),
(50, 2, 10, 5, 4),
(51, 3, 1, 1, 160),
(52, 3, 1, 2, 1),
(53, 3, 1, 3, 4),
(54, 3, 1, 4, 850),
(55, 3, 1, 5, 5),
(56, 3, 2, 1, 180),
(57, 3, 2, 2, 2),
(58, 3, 2, 3, 3),
(59, 3, 2, 4, 600),
(60, 3, 2, 5, 4),
(61, 3, 3, 1, 130),
(62, 3, 3, 2, 0.5),
(63, 3, 3, 3, 5),
(64, 3, 3, 4, 1100),
(65, 3, 3, 5, 5),
(66, 3, 4, 1, 125),
(67, 3, 4, 2, 1.2),
(68, 3, 4, 3, 4),
(69, 3, 4, 4, 700),
(70, 3, 4, 5, 4),
(71, 3, 5, 1, 170),
(72, 3, 5, 2, 1.8),
(73, 3, 5, 3, 3),
(74, 3, 5, 4, 800),
(75, 3, 5, 5, 3),
(76, 3, 6, 1, 140),
(77, 3, 6, 2, 0.8),
(78, 3, 6, 3, 5),
(79, 3, 6, 4, 1000),
(80, 3, 6, 5, 5),
(81, 3, 7, 1, 160),
(82, 3, 7, 2, 1.5),
(83, 3, 7, 3, 4),
(84, 3, 7, 4, 600),
(85, 3, 7, 5, 4),
(86, 3, 8, 1, 180),
(87, 3, 8, 2, 2.2),
(88, 3, 8, 3, 3),
(89, 3, 8, 4, 700),
(90, 3, 8, 5, 3),
(91, 3, 9, 1, 150),
(92, 3, 9, 2, 0.7),
(93, 3, 9, 3, 5),
(94, 3, 9, 4, 1200),
(95, 3, 9, 5, 5),
(96, 3, 10, 1, 170),
(97, 3, 10, 2, 1.4),
(98, 3, 10, 3, 4),
(99, 3, 10, 4, 800),
(100, 3, 10, 5, 4),
(101, 4, 1, 1, 140),
(102, 4, 1, 2, 1.5),
(103, 4, 1, 3, 4),
(104, 4, 1, 4, 700),
(105, 4, 1, 5, 4),
(106, 4, 2, 1, 220),
(107, 4, 2, 2, 3),
(108, 4, 2, 3, 2),
(109, 4, 2, 4, 400),
(110, 4, 2, 5, 3),
(111, 4, 3, 1, 100),
(112, 4, 3, 2, 1),
(113, 4, 3, 3, 4),
(114, 4, 3, 4, 1000),
(115, 4, 3, 5, 5),
(116, 4, 4, 1, 160),
(117, 4, 4, 2, 1.8),
(118, 4, 4, 3, 4),
(119, 4, 4, 4, 650),
(120, 4, 4, 5, 4),
(121, 4, 5, 1, 100),
(122, 4, 5, 2, 2.5),
(123, 4, 5, 3, 2),
(124, 4, 5, 4, 500),
(125, 4, 5, 5, 3.5),
(126, 4, 6, 1, 120),
(127, 4, 6, 2, 1.2),
(128, 4, 6, 3, 5),
(129, 4, 6, 4, 900),
(130, 4, 6, 5, 4),
(131, 4, 7, 1, 150),
(132, 4, 7, 2, 2),
(133, 4, 7, 3, 4),
(134, 4, 7, 4, 600),
(135, 4, 7, 5, 3),
(136, 4, 8, 1, 200),
(137, 4, 8, 2, 2.8),
(138, 4, 8, 3, 3),
(139, 4, 8, 4, 450),
(140, 4, 8, 5, 5),
(141, 4, 9, 1, 200),
(142, 4, 9, 2, 1.1),
(143, 4, 9, 3, 5),
(144, 4, 9, 4, 1100),
(145, 4, 9, 5, 5),
(146, 4, 10, 1, 180),
(147, 4, 10, 2, 2.2),
(148, 4, 10, 3, 4),
(149, 4, 10, 4, 700),
(150, 4, 10, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `role` enum('admin','dm') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `username`, `password`, `nama_lengkap`, `jabatan`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Admin Sistem', 'admin'),
(2, 'dm1', '5e23ff2642d15654b549d86897153110', 'DM1', 'Kepala Dinas Kesehatan', 'dm'),
(3, 'dm2', '780263bef57220278cf950519ea0ce4b', 'DM2', 'Kader Posyandu', 'dm'),
(4, 'dm3', 'fb8e84d8f9ea79c43946e8197795053b', 'DM3', 'Tokoh Masyarakat', 'dm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `fk_user` (`id_user`),
  ADD KEY `fk_alternatif` (`id_alternatif`),
  ADD KEY `fk_kriteria` (`id_kriteria`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
