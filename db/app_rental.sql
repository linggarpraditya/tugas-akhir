-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2021 at 04:30 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_identitas` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `username`, `password`, `nama`, `email`, `jenis_kelamin`, `no_telepon`, `alamat`, `no_identitas`, `role_id`) VALUES
(6, 'linggar', '25d55ad283aa400af464c76d713c07ad', 'Linggar P', '', 'Laki-laki', '085606955200', 'Ngawi', '352115266666890001', 1),
(7, 'siti', '5c2e4a2563f9f4427955422fe1402762', 'siti', '', 'Perempuan', '085606354422', 'klaten', '3421588882616', 2),
(8, 'asu', '25d55ad283aa400af464c76d713c07ad', 'linggar', 'linggarpraditya2@gmail.com', 'Laki-laki', '08969696969', 'jonggol', '2121212121', 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `detail_id` int(11) NOT NULL,
  `detail_package_id` int(11) DEFAULT NULL,
  `detail_paket_tour_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`detail_id`, `detail_package_id`, `detail_paket_tour_id`) VALUES
(53, 15, 1),
(54, 16, 3),
(97, 35, 8),
(98, 34, 6),
(99, 34, 7),
(100, 34, 9),
(101, 34, 10);

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE `gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`id_gambar`, `id_mobil`, `gambar`) VALUES
(4, 33, 'WhatsApp_Image_2020-08-25_at_09_19_13.jpeg'),
(5, 33, 'WhatsApp_Image_2020-08-25_at_09_23_33.jpeg'),
(6, 33, 'WhatsApp_Image_2020-08-25_at_09_22_221.jpeg'),
(7, 32, 'WhatsApp_Image_2020-08-25_at_09_31_121.jpeg'),
(8, 32, 'WhatsApp_Image_2020-08-25_at_09_31_28.jpeg'),
(9, 32, 'WhatsApp_Image_2020-08-25_at_09_31_46.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` int(11) NOT NULL,
  `nama_mitra` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `nama_mitra`, `alamat`) VALUES
(1, 'aan', 'poso');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int(11) NOT NULL,
  `id_mit` int(11) DEFAULT NULL,
  `kode_type` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `no_plat` varchar(20) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `status` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `ac` int(11) NOT NULL,
  `supir` int(11) NOT NULL,
  `mp3_player` int(11) NOT NULL,
  `gambar` varchar(250) NOT NULL,
  `status_mitra` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `id_mit`, `kode_type`, `merk`, `no_plat`, `warna`, `tahun`, `status`, `harga`, `denda`, `ac`, `supir`, `mp3_player`, `gambar`, `status_mitra`) VALUES
(31, 0, 'MPV', 'Honda Mobilio', 'AB 1192', 'Putih', '2013', '0', 300000, 50000, 1, 1, 1, 'WhatsApp_Image_2020-08-25_at_09_25_43.jpeg', 'perusahaan'),
(32, 0, 'MPV', 'Mitshubishi Xpander', 'AB 1740 NX', 'Hitam', '2017', '0', 400000, 50000, 1, 1, 1, 'WhatsApp_Image_2020-08-25_at_09_31_12.jpeg', 'perusahaan'),
(33, 0, 'MPV', 'Toyota Innova', 'AB 1972 LJ', 'Hitam', '2016', 'Tersedia', 350000, 50000, 1, 1, 1, 'WhatsApp_Image_2020-08-25_at_09_22_22.jpeg', 'perusahaan');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(100) DEFAULT NULL,
  `kuota` int(11) NOT NULL,
  `harga_paket` int(20) NOT NULL,
  `package_created_at` datetime DEFAULT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `package_name`, `kuota`, `harga_paket`, `package_created_at`, `foto`) VALUES
(16, 'paket1', 0, 100000, '2020-07-11 02:36:21', ''),
(34, 'JOGJA 1', 1, 170000, '2020-08-25 10:59:53', 'pram.jpg'),
(35, 'JOGJA 2', 0, 200000, '2020-08-25 11:00:33', 'indraynt.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `paket_tour`
--

CREATE TABLE `paket_tour` (
  `id_paket` int(11) NOT NULL,
  `nama_destinasi` varchar(100) NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket_tour`
--

INSERT INTO `paket_tour` (`id_paket`, `nama_destinasi`, `gambar`) VALUES
(6, 'Candi Prambanan', 'a61d9c25-e61d-43dc-bfb2-44f48a1d06af.jpg'),
(7, 'Malioboro', '01345565-b1ee-4894-a9ce-0c3ec70f0be1.jpg'),
(8, 'Pantai Indrayanti', 'indraynt.jpg'),
(9, 'Candi Borobudur', '0ea59e77-caae-4c5b-a69a-d9c0cf91a8f3.jpg'),
(10, 'Candi Ratu Boko', 'rtu.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id_rental` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `tgl_rental` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `status_rental` varchar(50) NOT NULL,
  `status_pengembalian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_rental` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `tgl_rental` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `harga` varchar(100) NOT NULL,
  `denda` varchar(100) NOT NULL,
  `total_denda` varchar(100) NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `status_pengembalian` varchar(50) NOT NULL,
  `status_rental` varchar(50) NOT NULL,
  `bukti_pembayaran` varchar(150) NOT NULL,
  `status_pembayaran` int(11) NOT NULL,
  `id_midtrans` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_rental`, `id_customer`, `id_mobil`, `tgl_rental`, `tgl_kembali`, `harga`, `denda`, `total_denda`, `tgl_pengembalian`, `status_pengembalian`, `status_rental`, `bukti_pembayaran`, `status_pembayaran`, `id_midtrans`) VALUES
(15, 8, 31, '2021-04-16', '2021-05-08', '300000', '50000', '400000', '2021-04-30', 'Belum Kembali', 'Selesai', '', 1, '88174397'),
(16, 8, 32, '2021-04-16', '2021-04-21', '400000', '50000', '0', '0000-00-00', 'Belum Selesai', 'Selesai', '', 1, '1460499819');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_paket`
--

CREATE TABLE `transaksi_paket` (
  `id_transaksi_paket` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `total_harga` varchar(50) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `tgl_rental` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_paket`
--

INSERT INTO `transaksi_paket` (`id_transaksi_paket`, `package_id`, `id_customer`, `total_harga`, `jumlah_orang`, `tgl_rental`, `status`, `bukti`) VALUES
(1, 17, 5, '100000', 0, '2020-07-15', 'Menunggu Konfirmasi', ''),
(2, 17, 5, '100000', 0, '2020-07-15', 'Menunggu Konfirmasi', ''),
(3, 17, 5, '100000', 0, '2020-07-15', 'Menunggu Konfirmasi', ''),
(4, 18, 5, '2000000', 0, '0000-00-00', 'Menunggu Konfirmasi', ''),
(5, 18, 5, '2000000', 0, '0000-00-00', 'Menunggu Konfirmasi', ''),
(11, 17, 7, '100000', 0, '0000-00-00', '1', '95699470_240413433969548_2207435600035263486_n.jpg'),
(12, 18, 7, '2000000', 0, '0000-00-00', '0', ''),
(13, 19, 7, '200000', 0, '2020-08-25', '0', ''),
(14, 34, 7, '170000', 0, '2020-09-23', '0', ''),
(15, 34, 7, '340000', 2, '2020-09-23', '0', ''),
(16, 34, 7, '850000', 5, '0000-00-00', '0', ''),
(18, 34, 7, '680000', 4, '0000-00-00', '0', ''),
(19, 34, 7, '850000', 5, '0000-00-00', '0', ''),
(20, 34, 7, '0', 0, '0000-00-00', '0', '');

--
-- Triggers `transaksi_paket`
--
DELIMITER $$
CREATE TRIGGER `insert_kuota` AFTER INSERT ON `transaksi_paket` FOR EACH ROW UPDATE package
SET kuota = kuota - new.jumlah_orang
WHERE
package_id = new.package_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `kode_type` varchar(10) NOT NULL,
  `nama_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id_type`, `kode_type`, `nama_type`) VALUES
(1, 'SDN', 'sedan'),
(2, 'MPV', 'Minivann'),
(3, 'SUV', 'Sport Utility Vehicle'),
(4, 'HTB', 'Hatchback');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `detail_package_id` (`detail_package_id`),
  ADD KEY `detail_product_id` (`detail_paket_tour_id`);

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `paket_tour`
--
ALTER TABLE `paket_tour`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id_rental`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_rental`);

--
-- Indexes for table `transaksi_paket`
--
ALTER TABLE `transaksi_paket`
  ADD PRIMARY KEY (`id_transaksi_paket`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `paket_tour`
--
ALTER TABLE `paket_tour`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id_rental` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_rental` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transaksi_paket`
--
ALTER TABLE `transaksi_paket`
  MODIFY `id_transaksi_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
