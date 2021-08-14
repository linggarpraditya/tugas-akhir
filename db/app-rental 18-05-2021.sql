-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.7.24 - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table app_rental.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel app_rental.admin: ~0 rows (lebih kurang)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- membuang struktur untuk table app_rental.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_identitas` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel app_rental.customer: ~2 rows (lebih kurang)
DELETE FROM `customer`;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`id_customer`, `username`, `password`, `nama`, `email`, `jenis_kelamin`, `no_telepon`, `alamat`, `no_identitas`, `role_id`) VALUES
	(6, 'linggar', '25d55ad283aa400af464c76d713c07ad', 'Linggar P', '', 'Laki-laki', '085606955200', 'Ngawi', '352115266666890001', 1),
	(7, 'siti', '25d55ad283aa400af464c76d713c07ad', 'siti', 'linggarpraditya2@gmail.com', 'Perempuan', '085606354422', 'klaten', '3421588882616', 2),
	(8, 'asu', '25d55ad283aa400af464c76d713c07ad', 'linggar', 'linggarpraditya2@gmail.com', 'Laki-laki', '08969696969', 'jonggol', '2121212121', 2);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- membuang struktur untuk table app_rental.detail
CREATE TABLE IF NOT EXISTS `detail` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_package_id` int(11) DEFAULT NULL,
  `detail_paket_tour_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`detail_id`),
  KEY `detail_package_id` (`detail_package_id`),
  KEY `detail_product_id` (`detail_paket_tour_id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel app_rental.detail: ~7 rows (lebih kurang)
DELETE FROM `detail`;
/*!40000 ALTER TABLE `detail` DISABLE KEYS */;
INSERT INTO `detail` (`detail_id`, `detail_package_id`, `detail_paket_tour_id`) VALUES
	(53, 15, 1),
	(54, 16, 3),
	(97, 35, 8),
	(98, 34, 6),
	(99, 34, 7),
	(100, 34, 9),
	(101, 34, 10);
/*!40000 ALTER TABLE `detail` ENABLE KEYS */;

-- membuang struktur untuk table app_rental.gambar
CREATE TABLE IF NOT EXISTS `gambar` (
  `id_gambar` int(11) NOT NULL AUTO_INCREMENT,
  `id_mobil` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_gambar`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel app_rental.gambar: ~6 rows (lebih kurang)
DELETE FROM `gambar`;
/*!40000 ALTER TABLE `gambar` DISABLE KEYS */;
INSERT INTO `gambar` (`id_gambar`, `id_mobil`, `gambar`) VALUES
	(4, 33, 'WhatsApp_Image_2020-08-25_at_09_19_13.jpeg'),
	(5, 33, 'WhatsApp_Image_2020-08-25_at_09_23_33.jpeg'),
	(6, 33, 'WhatsApp_Image_2020-08-25_at_09_22_221.jpeg'),
	(7, 32, 'WhatsApp_Image_2020-08-25_at_09_31_121.jpeg'),
	(8, 32, 'WhatsApp_Image_2020-08-25_at_09_31_28.jpeg'),
	(9, 32, 'WhatsApp_Image_2020-08-25_at_09_31_46.jpeg');
/*!40000 ALTER TABLE `gambar` ENABLE KEYS */;

-- membuang struktur untuk table app_rental.mitra
CREATE TABLE IF NOT EXISTS `mitra` (
  `id_mitra` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mitra` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_mitra`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel app_rental.mitra: ~0 rows (lebih kurang)
DELETE FROM `mitra`;
/*!40000 ALTER TABLE `mitra` DISABLE KEYS */;
INSERT INTO `mitra` (`id_mitra`, `nama_mitra`, `alamat`) VALUES
	(1, 'aan', 'poso');
/*!40000 ALTER TABLE `mitra` ENABLE KEYS */;

-- membuang struktur untuk table app_rental.mobil
CREATE TABLE IF NOT EXISTS `mobil` (
  `id_mobil` int(11) NOT NULL AUTO_INCREMENT,
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
  `status_mitra` varchar(11) NOT NULL,
  PRIMARY KEY (`id_mobil`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel app_rental.mobil: ~2 rows (lebih kurang)
DELETE FROM `mobil`;
/*!40000 ALTER TABLE `mobil` DISABLE KEYS */;
INSERT INTO `mobil` (`id_mobil`, `id_mit`, `kode_type`, `merk`, `no_plat`, `warna`, `tahun`, `status`, `harga`, `denda`, `ac`, `supir`, `mp3_player`, `gambar`, `status_mitra`) VALUES
	(35, 0, 'SDN', 'MAK', 'AG3242RBD', 'biru', '2015', 'Tersedia', 150000, 200000, 0, 0, 0, '5vVb0G8d_400x400.png', 'perusahaan'),
	(40, 0, 'MPV', 'wdwad', '3212123', 'biru', '324', 'Tersedia', 324, 3242, 0, 0, 0, '5vVb0G8d_400x4001.png', 'perusahaan');
/*!40000 ALTER TABLE `mobil` ENABLE KEYS */;

-- membuang struktur untuk table app_rental.package
CREATE TABLE IF NOT EXISTS `package` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(100) DEFAULT NULL,
  `kuota` int(11) NOT NULL,
  `harga_paket` int(20) NOT NULL,
  `package_created_at` datetime DEFAULT NULL,
  `foto` varchar(200) NOT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel app_rental.package: ~3 rows (lebih kurang)
DELETE FROM `package`;
/*!40000 ALTER TABLE `package` DISABLE KEYS */;
INSERT INTO `package` (`package_id`, `package_name`, `kuota`, `harga_paket`, `package_created_at`, `foto`) VALUES
	(16, 'paket1', 0, 100000, '2020-07-11 02:36:21', ''),
	(34, 'JOGJA 1', 1, 170000, '2020-08-25 10:59:53', 'pram.jpg'),
	(35, 'JOGJA 2', 0, 200000, '2020-08-25 11:00:33', 'indraynt.jpg');
/*!40000 ALTER TABLE `package` ENABLE KEYS */;

-- membuang struktur untuk table app_rental.paket_tour
CREATE TABLE IF NOT EXISTS `paket_tour` (
  `id_paket` int(11) NOT NULL AUTO_INCREMENT,
  `nama_destinasi` varchar(100) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel app_rental.paket_tour: ~5 rows (lebih kurang)
DELETE FROM `paket_tour`;
/*!40000 ALTER TABLE `paket_tour` DISABLE KEYS */;
INSERT INTO `paket_tour` (`id_paket`, `nama_destinasi`, `gambar`) VALUES
	(6, 'Candi Prambanan', 'a61d9c25-e61d-43dc-bfb2-44f48a1d06af.jpg'),
	(7, 'Malioboro', '01345565-b1ee-4894-a9ce-0c3ec70f0be1.jpg'),
	(8, 'Pantai Indrayanti', 'indraynt.jpg'),
	(9, 'Candi Borobudur', '0ea59e77-caae-4c5b-a69a-d9c0cf91a8f3.jpg'),
	(10, 'Candi Ratu Boko', 'rtu.jpg');
/*!40000 ALTER TABLE `paket_tour` ENABLE KEYS */;

-- membuang struktur untuk table app_rental.rental
CREATE TABLE IF NOT EXISTS `rental` (
  `id_rental` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `tgl_rental` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `status_rental` varchar(50) NOT NULL,
  `status_pengembalian` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rental`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel app_rental.rental: ~0 rows (lebih kurang)
DELETE FROM `rental`;
/*!40000 ALTER TABLE `rental` DISABLE KEYS */;
/*!40000 ALTER TABLE `rental` ENABLE KEYS */;

-- membuang struktur untuk table app_rental.sopir
CREATE TABLE IF NOT EXISTS `sopir` (
  `id_sopir` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_sopir` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_ktp` varchar(50) DEFAULT NULL,
  `alamat` longtext,
  `jenis_kelamin` varchar(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_sopir`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel app_rental.sopir: ~1 rows (lebih kurang)
DELETE FROM `sopir`;
/*!40000 ALTER TABLE `sopir` DISABLE KEYS */;
INSERT INTO `sopir` (`id_sopir`, `nama_sopir`, `username`, `password`, `no_ktp`, `alamat`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
	(1, 'jono', 'jono', '25d55ad283aa400af464c76d713c07ad', '3504141007980002', 'sono', 'l', '2021-05-17 11:11:36', '2021-05-17 11:47:56');
/*!40000 ALTER TABLE `sopir` ENABLE KEYS */;

-- membuang struktur untuk table app_rental.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_rental` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `id_sopir` bigint(20) DEFAULT NULL,
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
  `id_midtrans` varchar(50) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `long` double DEFAULT NULL,
  PRIMARY KEY (`id_rental`),
  KEY `id_sopir` (`id_sopir`),
  CONSTRAINT `FK_transaksi_sopir` FOREIGN KEY (`id_sopir`) REFERENCES `sopir` (`id_sopir`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel app_rental.transaksi: ~1 rows (lebih kurang)
DELETE FROM `transaksi`;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` (`id_rental`, `id_customer`, `id_sopir`, `id_mobil`, `tgl_rental`, `tgl_kembali`, `harga`, `denda`, `total_denda`, `tgl_pengembalian`, `status_pengembalian`, `status_rental`, `bukti_pembayaran`, `status_pembayaran`, `id_midtrans`, `lat`, `long`) VALUES
	(21, 7, 1, 35, '2021-05-18', '2021-05-18', '120000', '0', '0', '2021-05-18', 'Belum selesai', 'Belum selesai', 'Belum selesai', 0, NULL, -7.5360639, 112.3384017);
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;

-- membuang struktur untuk table app_rental.transaksi_paket
CREATE TABLE IF NOT EXISTS `transaksi_paket` (
  `id_transaksi_paket` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `total_harga` varchar(50) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `tgl_rental` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transaksi_paket`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel app_rental.transaksi_paket: ~0 rows (lebih kurang)
DELETE FROM `transaksi_paket`;
/*!40000 ALTER TABLE `transaksi_paket` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi_paket` ENABLE KEYS */;

-- membuang struktur untuk table app_rental.type
CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `kode_type` varchar(10) NOT NULL,
  `nama_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel app_rental.type: ~4 rows (lebih kurang)
DELETE FROM `type`;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` (`id_type`, `kode_type`, `nama_type`) VALUES
	(1, 'SDN', 'sedan'),
	(2, 'MPV', 'Minivann'),
	(3, 'SUV', 'Sport Utility Vehicle'),
	(4, 'HTB', 'Hatchback');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;

-- membuang struktur untuk trigger app_rental.insert_kuota
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `insert_kuota` AFTER INSERT ON `transaksi_paket` FOR EACH ROW UPDATE package
SET kuota = kuota - new.jumlah_orang
WHERE
package_id = new.package_id//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
