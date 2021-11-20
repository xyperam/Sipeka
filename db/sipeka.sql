-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2021 at 09:48 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `earsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(100) NOT NULL,
  `user_id` int(10) NOT NULL,
  `tgl_surat` date NOT NULL,
  `no_surat` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `tgl_surat`, `no_surat`, `alamat`, `kelurahan`, `keterangan`, `image`, `status`, `created_at`) VALUES
(180, 61, '2021-10-23', '360/1134/RR-BPBD', 'Kp. Sindang Barang Loji RT 03 RW 13 Kel. Loji Kec. Bogor Barat', 'Kel. Pasir Ayam', '', 'teksim1.PNG', '', '2021-10-23 14:25:09'),
(182, 61, '2021-10-23', '360/1134/RR-BPBD', 'Kp. Sindang Barang Loji RT 03 RW 13 Kel. Loji Kec. Bogor Barat', 'Kel. Pasir Angin', 'lorem ipsum', 'teksim2.png', 'Selesai Survei', '2021-10-23 14:54:37'),
(183, 61, '2021-10-08', '360/1134/RR-BPBD', 'Jl. Rimba Baru Bojong Menteng RT 05/RW  11  Kelurahan Pasir Kuda Kecamatan Bogor Barat', 'Kel. Pasir', '', 'Redux_Thunk.PNG', '', '2021-10-23 15:51:27'),
(184, 68, '2021-10-30', '360/1134/RR-BPBD', 'Tanah Baru', 'Cimahpar', 'lorem ipsum', 'Capture.PNG', 'Selesai Survei', '2021-10-23 15:54:47'),
(185, 68, '2021-11-27', '360/1134/RR-BPBD', 'Kp. Sindang Barang Loji RT 03 RW 13 Kel. Loji Kec. Bogor Barat', 'Kel. Pasir Angin', '', 'Capture.PNG', '', '2021-10-23 16:15:24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `role` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role`, `username`, `email`, `password`, `avatar`) VALUES
(61, 'member', 'aditya', 'aditya@gmail.com', '$2y$10$jD3XmYChwx6rrbeFIoATbOxGzxyunihIaao9bGqm9EWKWOGbL40iO', '6173c9c49c71c.jpg'),
(66, 'admin', 'yogga', 'yogga@gmail.com', '$2y$10$3xbvzPi54OAMS5UrILfHSuWjHES5I0IRKcJu9O3B2S/PONOazOIOC', ''),
(68, 'member', 'candra', 'candra@gmail.com', '$2y$10$RC0Z9RWJ2OoithHPCVyP0OM1z9MDScggdv7A8E9dKSTLNWfOYXmX6', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
