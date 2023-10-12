-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2021 at 06:42 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vendorkuy`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_administrasi`
--

CREATE TABLE `tb_administrasi` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `mou` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_administrasi`
--

INSERT INTO `tb_administrasi` (`id`, `id_invoice`, `ktp`, `mou`) VALUES
(12, 12, 'KTP3.jpg', 'format_mou_kiw1.pdf'),
(13, 13, 'KTP4.jpg', 'format_mou_kiw2.pdf'),
(14, 14, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_brg` int(11) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `nama_brg` varchar(120) NOT NULL,
  `keterangan` varchar(225) NOT NULL,
  `kategori` varchar(60) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(4) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_brg`, `id_vendor`, `nama_brg`, `keterangan`, `kategori`, `harga`, `stok`, `gambar`) VALUES
(1, 1, 'Sound System', 'Ukuran Besar', 'Suara', 40000, 20, 'sound.jpg'),
(2, 1, 'Handy Talkie', 'HT Panitia', 'Suara', 10000, 19, 'ht.jpg'),
(4, 1, 'Microphone', 'Wireles', 'Suara', 5000, 19, 'mic.jpg'),
(5, 1, 'Lighting', 'Lighting RGB', 'Cahaya', 15000, 18, 'lightning.jpg'),
(7, 1, 'Proyektor', 'Proyektor', 'proyektor', 10000, 15, 'proyektor.jpg'),
(8, 1, 'Layar Proyektor', 'Layar Proyektor', 'proyektor', 8000, 15, 'layar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `id` int(11) NOT NULL,
  `nama` varchar(56) NOT NULL,
  `id_member` int(11) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `tgl_pengiriman` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `batas_bayar` datetime NOT NULL,
  `status` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_invoice`
--

INSERT INTO `tb_invoice` (`id`, `nama`, `id_member`, `alamat`, `tgl_pengiriman`, `tgl_pengembalian`, `tgl_pesan`, `batas_bayar`, `status`) VALUES
(12, 'Alsadila Fazari', 9, 'Jl. Taman Lopang Indah, Serang, Banten', '2021-08-12', '2021-08-14', '2021-08-11 17:40:16', '2021-08-12 17:40:16', 'Belum dikonfirmasi'),
(13, 'Nindita Rahmawati', 10, 'Jl. Ciracas Serang, Banten', '2021-08-13', '2021-08-15', '2021-08-12 17:45:47', '2021-08-12 17:45:47', 'Batal'),
(14, 'Haitsam', 8, 'oke', '2021-08-23', '2021-09-04', '2021-08-23 22:38:24', '2021-08-24 22:38:24', 'Belum dikonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_notifikasi`
--

CREATE TABLE `tb_kategori_notifikasi` (
  `id` int(11) NOT NULL,
  `kategori_notifikasi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_notifikasi`
--

INSERT INTO `tb_kategori_notifikasi` (`id`, `kategori_notifikasi`) VALUES
(1, 'Notifikasi'),
(2, 'Validasi Vendor'),
(3, 'Pembayaran\r\n'),
(4, 'Undangan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kartu_identitas` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id`, `id_user`, `kartu_identitas`) VALUES
(8, 2, ''),
(9, 32, 'KTP3.jpg'),
(10, 33, 'KTP4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifikasi`
--

CREATE TABLE `tb_notifikasi` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_kategori_notifikasi` int(11) NOT NULL,
  `sub_id` int(11) DEFAULT NULL,
  `waktu_notifikasi` datetime NOT NULL,
  `subjek` varchar(128) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `is_read` int(11) NOT NULL,
  `id_creator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_notifikasi`
--

INSERT INTO `tb_notifikasi` (`id`, `id_user`, `id_kategori_notifikasi`, `sub_id`, `waktu_notifikasi`, `subjek`, `pesan`, `is_read`, `id_creator`) VALUES
(1, 3, 2, 9, '2021-08-20 18:37:36', 'Validasi Vendor', 'Akun Vendor Anda dinyatakan Valid', 1, 1),
(2, 3, 3, 21, '2021-08-23 17:52:31', 'Pembayaran Masuk', 'Pembayaran sebesar19000000 dari Olga Paurenta Masuk', 1, 2),
(3, 1, 2, 10, '2021-08-23 17:59:46', 'Akun baru terdaftar', 'Akun Baru terdaftar', 1, 35);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_rekening_tujuan` int(11) NOT NULL,
  `rekening_pengirim` varchar(128) NOT NULL,
  `bank_pengirim` varchar(100) NOT NULL,
  `nama_pengirim` varchar(128) NOT NULL,
  `waktu_transfer` datetime NOT NULL,
  `nominal_transfer` float(14,2) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id`, `id_invoice`, `id_rekening_tujuan`, `rekening_pengirim`, `bank_pengirim`, `nama_pengirim`, `waktu_transfer`, `nominal_transfer`, `bukti_pembayaran`, `catatan`, `status`) VALUES
(18, 12, 2, '0987654321', 'BCA', 'Alsadila', '2021-08-11 17:41:00', 100000.00, '10__Resi_Pembayaran.jpg', 'Terima kasih!', 'Belum dikonfirmasi'),
(19, 13, 1, '1234567890', 'Mandiri', 'Nindita', '2021-08-11 17:46:00', 100000.00, '10__Resi_Pembayaran1.jpg', 'Thankyou!', 'Belum dikonfirmasi'),
(20, 14, 2, '1203129039213', 'BNI', 'Hariadi Arfah', '2021-09-11 22:44:00', 900000.00, '1200px-Telkom_University_Logo_svg1.png', 'oke', 'Belum dikonfirmasi'),
(21, 14, 2, '1203129039213', 'BNI', 'Olga Paurenta', '2021-09-10 02:52:00', 19000000.00, '1200px-Telkom_University_Logo_svg2.png', 'oke', 'Belum dikonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga` int(10) NOT NULL,
  `pilihan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id`, `id_invoice`, `id_brg`, `nama_brg`, `jumlah`, `harga`, `pilihan`) VALUES
(23, 12, 1, 'Sound System', 4, 40000, ''),
(24, 12, 2, 'Handy Talkie', 6, 10000, ''),
(25, 13, 5, 'Lighting', 4, 15000, ''),
(26, 13, 4, 'Microphone', 2, 5000, ''),
(27, 14, 4, 'Microphone', 1, 5000, '');

--
-- Triggers `tb_pesanan`
--
DELIMITER $$
CREATE TRIGGER `pesanan_penyewaan` AFTER INSERT ON `tb_pesanan` FOR EACH ROW BEGIN
	UPDATE tb_barang SET stok = stok-NEW.jumlah
    WHERE id_brg = NEW.id_brg;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekening`
--

CREATE TABLE `tb_rekening` (
  `id` int(11) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `no_rekening` varchar(255) NOT NULL,
  `atas_nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rekening`
--

INSERT INTO `tb_rekening` (`id`, `bank`, `no_rekening`, `atas_nama`, `email`) VALUES
(1, 'Mandiri', '1234567890', 'Muhammad Shibghotul \'Adalah', 'shibghotul7@gmail.com'),
(2, 'BNI', '0987654321', 'Ghena Patriani Salnia', 'ghenaps@gmail.com'),
(4, 'BCA', '0128102380912', 'Ardhiani Laura', 'ardhiani@gmail.com'),
(5, 'Lainnya', '63765186293', 'Alya Putri Maharani', 'alyapm@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` tinyint(1) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `no_telp`, `alamat`, `password`, `role_id`, `is_active`) VALUES
(1, 'admin', 'admin', '', ':)', '123', 1, 1),
(2, 'member', 'member', '', ':)', '123', 2, 1),
(3, 'Delta Vendor', 'vendor', '081383474071', 'Bandung, Jawa Barat', '123', 3, 1),
(32, 'Alsadila Fazari', 'alsa', '081263635637', 'Jl. Taman Lopang Indah, Serang, Banten', '123', 2, 0),
(33, 'Nindita Rahmawati', 'dita', '081383477354', 'Jl. Ciracas Serang, Banten', '123', 2, 0),
(34, 'Vendor Delta', 'delta', '081383477354', 'Bandung, Jawa Barat', '123', 3, 1),
(35, 'Oke', 'okevendor', '0123', 'jatisari', '1234', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_vendor`
--

CREATE TABLE `tb_vendor` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `bukti_surat_usaha` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `status` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_vendor`
--

INSERT INTO `tb_vendor` (`id`, `id_user`, `bukti_surat_usaha`, `catatan`, `status`) VALUES
(1, 3, '1200px-Telkom_University_Logo_svg5.png', 'Baguss', 'Valid'),
(9, 34, 'kursi.jpg', 'hahaha', 'Valid'),
(10, 35, '1200px-Telkom_University_Logo_svg7.png', '', 'Belum dikonfirmasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_administrasi`
--
ALTER TABLE `tb_administrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_invoice` (`id_invoice`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_brg`),
  ADD KEY `id_vendor` (`id_vendor`);

--
-- Indexes for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_member` (`id_member`);

--
-- Indexes for table `tb_kategori_notifikasi`
--
ALTER TABLE `tb_kategori_notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_invoice` (`id_invoice`),
  ADD KEY `id_rekening_tujuan` (`id_rekening_tujuan`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_brg` (`id_brg`),
  ADD KEY `id_invoice` (`id_invoice`);

--
-- Indexes for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_vendor`
--
ALTER TABLE `tb_vendor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_administrasi`
--
ALTER TABLE `tb_administrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_kategori_notifikasi`
--
ALTER TABLE `tb_kategori_notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_vendor`
--
ALTER TABLE `tb_vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_administrasi`
--
ALTER TABLE `tb_administrasi`
  ADD CONSTRAINT `tb_administrasi_ibfk_1` FOREIGN KEY (`id_invoice`) REFERENCES `tb_invoice` (`id`);

--
-- Constraints for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `tb_barang_ibfk_1` FOREIGN KEY (`id_vendor`) REFERENCES `tb_vendor` (`id`);

--
-- Constraints for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD CONSTRAINT `tb_invoice_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `tb_member` (`id`);

--
-- Constraints for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD CONSTRAINT `tb_member_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`);

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`id_invoice`) REFERENCES `tb_invoice` (`id`),
  ADD CONSTRAINT `tb_pembayaran_ibfk_2` FOREIGN KEY (`id_rekening_tujuan`) REFERENCES `tb_rekening` (`id`);

--
-- Constraints for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD CONSTRAINT `tb_pesanan_ibfk_1` FOREIGN KEY (`id_brg`) REFERENCES `tb_barang` (`id_brg`),
  ADD CONSTRAINT `tb_pesanan_ibfk_2` FOREIGN KEY (`id_invoice`) REFERENCES `tb_invoice` (`id`);

--
-- Constraints for table `tb_vendor`
--
ALTER TABLE `tb_vendor`
  ADD CONSTRAINT `tb_vendor_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
