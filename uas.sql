-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2022 at 12:51 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(15) NOT NULL,
  `nama_divisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'SDM'),
(2, 'Teknik'),
(3, 'Administrasi'),
(4, 'Hukum'),
(5, 'Bongkar Muat');

-- --------------------------------------------------------

--
-- Table structure for table `kesehatan`
--

CREATE TABLE `kesehatan` (
  `id_kesehatan` varchar(15) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `id_divisi` int(15) NOT NULL,
  `lampiran_suket` varchar(255) NOT NULL,
  `status_kesehatan` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `tgl_periksa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kesehatan`
--

INSERT INTO `kesehatan` (`id_kesehatan`, `nip`, `id_divisi`, `lampiran_suket`, `status_kesehatan`, `deskripsi`, `tgl_periksa`) VALUES
('00057', '001', 1, '', 'sehat', 'dalam kondisi sehat', '2022-01-02'),
('009', '00026', 1, 'UTS_NADHILA BAZHLINA_3CA.pdf', 'sehat', 'dalam kondisi sehat', '2022-01-18'),
('111', '00039', 5, '', 'Baik', 'Dalam Kondisi Baik', '2022-02-02'),
('546', '00033', 1, 'UTS_NADHILA BAZHLINA_3CA.pdf', 'tidak sehat', 'dalam kondisi tidak sehat\r\n', '2022-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `kesehatan_selesai`
--

CREATE TABLE `kesehatan_selesai` (
  `id_kesehatan` varchar(15) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `id_divisi` int(15) NOT NULL,
  `lampiran_suket` varchar(255) NOT NULL,
  `status_kesehatan` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `tgl_disetujui` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kesehatan_selesai`
--

INSERT INTO `kesehatan_selesai` (`id_kesehatan`, `nip`, `id_divisi`, `lampiran_suket`, `status_kesehatan`, `deskripsi`, `tgl_disetujui`) VALUES
('001', '00001', 1, 'link drive tugas Nadhila Bazhlina_3CA_062030701619.pdf', 'sehat', 'dalam kondisi sehat', '2022-01-30'),
('022', '00011', 5, 'Surat Keterangan Sehat.pdf', 'Baik', 'Dalam Kondisi Baik', '2022-02-02'),
('027', '00011', 5, 'Surat Keterangan Sehat.pdf', 'Baik', 'Dalam Kondisi Baik', '2022-02-02'),
('029', '00092', 1, 'Surat Keterangan Sehat.pdf', 'Baik', 'Dalam Kondisi Baik', '2022-02-02'),
('111', '008', 5, 'Task 1_Nadhila Bazhlina.pdf', 'Baik', 'Dalam Kondisi Baik', '2022-02-02'),
('333', '002', 1, 'UTS_NADHILA BAZHLINA_3CA.pdf', 'sehat', 'dalam kondisi sehat', '2022-01-18'),
('734', '222', 2, 'UTS_NADHILA BAZHLINA_3CA.pdf', 'sehat', 'dalam kondisi sehat', '2022-01-22'),
('778', '111', 1, 'UTS_NADHILA BAZHLINA_3CA.pdf', 'sehat', 'dalam kondisi sehat', '2022-01-01'),
('877', '211', 2, 'UTS_NADHILA BAZHLINA_3CA.pdf', 'sehat', 'dalam kondisi sehat', '2022-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(15) NOT NULL,
  `id` int(12) UNSIGNED ZEROFILL NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_divisi` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `id`, `nama`, `alamat`, `tgl_lahir`, `jk`, `no_hp`, `email`, `id_divisi`) VALUES
('00001', 000000000021, 'nadhirra', 'palembang', '2001-01-01', '“Perempuan”', '082134781230', 'nadhir123@gmail.com', 3),
('00002', 000000000022, 'Ardian', 'Palembang', '2001-01-12', 'laki-laki', '089627381234', 'vilia.nur123@gmail.com', 4),
('00003', 000000000023, 'RiDhil', 'Palembang', '2002-01-26', '“Perempuan”', '089627381234', 'ridhil@gmail.com', 5),
('00004', 000000000024, 'Vilia Nur Arifah', 'Sekojo', '2003-06-29', 'Perempuan', '081323964569', 'vilia.nur@gmail.com', 1),
('00005', 000000000025, 'Fajarul Akbar', 'Jl. PDAM', '2002-01-13', 'Laki - Laki', '082376193610', 'fajarulakbr@gmail.com', 1),
('00006', 000000000026, 'Nabilah Fatharani', 'Jl. Lunjuk Jaya', '1999-10-23', 'Perempuan', '089812537835', 'fathachive@gmail.com', 2),
('00092', 000000000016, 'Yaya Ridhil', 'Palembang', '2001-01-26', '“Laki-Laki”', '089627381234', 'vilia.nur123@gmail.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(12) UNSIGNED ZEROFILL NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`) VALUES
(000000000011, 'nadhira', 'nadh', '202cb962ac59075b964b07152d234b70', 'pegawai'),
(000000000012, 'Ardian', 'ardian', 'e10adc3949ba59abbe56e057f20f883e', 'pegawai'),
(000000000013, 'Nadhila', 'nadhilabazh', 'e10adc3949ba59abbe56e057f20f883e', 'admin'),
(000000000014, 'Ria Febriyanti', 'riafeb27', '2e7ceec8361275c4e31fee5fe422740b', 'admin'),
(000000000015, 'Fanny Hisrahf', 'fanny', 'e10adc3949ba59abbe56e057f20f883e', 'pegawai'),
(000000000016, 'Yaya Ridhil', 'yaya', '202cb962ac59075b964b07152d234b70', 'pegawai'),
(000000000017, 'Najwa Kayla', 'najwa@gmail.com', '25d55ad283aa400af464c76d713c07ad', '“pegawai”'),
(000000000018, 'Nadhila & Ria Febri', 'ridhil', 'e10adc3949ba59abbe56e057f20f883e', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `kesehatan`
--
ALTER TABLE `kesehatan`
  ADD PRIMARY KEY (`id_kesehatan`);

--
-- Indexes for table `kesehatan_selesai`
--
ALTER TABLE `kesehatan_selesai`
  ADD PRIMARY KEY (`id_kesehatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(12) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
