-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Bulan Mei 2023 pada 15.34
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_brgkeluar`
--

CREATE TABLE `tb_brgkeluar` (
  `id_brgkeluar` char(8) NOT NULL,
  `tglkeluar` date NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `id_product` char(5) NOT NULL,
  `jumlahbrgklr` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_brgkeluar`
--

INSERT INTO `tb_brgkeluar` (`id_brgkeluar`, `tglkeluar`, `nama_penerima`, `id_product`, `jumlahbrgklr`) VALUES
('T-BK-001', '2023-05-23', 'Denna', 'PR001', '1'),
('T-BK-002', '2023-05-23', 'Denna', 'PR002', '1'),
('T-BK-003', '2023-05-26', 'Denna', 'PR001', '2'),
('T-BK-004', '2023-05-25', 'Dwi', 'PR001', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_brgmasuk`
--

CREATE TABLE `tb_brgmasuk` (
  `id_brgmasuk` char(8) NOT NULL,
  `tglmasuk` date NOT NULL,
  `id_vendor` char(4) NOT NULL,
  `id_product` char(5) NOT NULL,
  `jumlahbrgmsk` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_brgmasuk`
--

INSERT INTO `tb_brgmasuk` (`id_brgmasuk`, `tglmasuk`, `id_vendor`, `id_product`, `jumlahbrgmsk`) VALUES
('T-BM-001', '2023-05-26', 'V002', 'PR001', '2'),
('T-BM-002', '2023-05-25', 'V002', 'PR002', '5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_category`
--

CREATE TABLE `tb_category` (
  `id_category` char(4) NOT NULL,
  `nama_category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_category`
--

INSERT INTO `tb_category` (`id_category`, `nama_category`) VALUES
('C001', 'Hardware'),
('C002', 'Software');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product`
--

CREATE TABLE `tb_product` (
  `id_product` char(5) NOT NULL,
  `nama_product` varchar(100) NOT NULL,
  `id_category` char(5) NOT NULL,
  `id_satuan` char(5) NOT NULL,
  `stock` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_product`
--

INSERT INTO `tb_product` (`id_product`, `nama_product`, `id_category`, `id_satuan`, `stock`) VALUES
('PR001', 'Mouse', 'C001', 'S001', '20'),
('PR002', 'Keyboard', 'C001', 'S001', '31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id_satuan` char(4) NOT NULL,
  `nama_satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_satuan`
--

INSERT INTO `tb_satuan` (`id_satuan`, `nama_satuan`) VALUES
('S001', 'Unit'),
('S002', 'Pcs'),
('S003', 'Botol'),
('S004', 'Roll'),
('S005', 'Dus'),
('S006', 'Set');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_vendor`
--

CREATE TABLE `tb_vendor` (
  `id_vendor` char(4) NOT NULL,
  `nama_vendor` varchar(100) NOT NULL,
  `telepon_vendor` char(15) NOT NULL,
  `cperson_vendor` varchar(100) NOT NULL,
  `email_vendor` varchar(100) NOT NULL,
  `alamat_vendor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_vendor`
--

INSERT INTO `tb_vendor` (`id_vendor`, `nama_vendor`, `telepon_vendor`, `cperson_vendor`, `email_vendor`, `alamat_vendor`) VALUES
('V001', 'PT. Cahaya Komputindo', '08888888888', 'Herna', 'cahaya-komputindo@gmail.com', 'WTC Mangga Dua'),
('V002', 'CV. Top Solusindo', '08777777777', 'TOP', 'top-solusindo@gmail.com', 'Mangga Dua');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_brgkeluar`
--
ALTER TABLE `tb_brgkeluar`
  ADD PRIMARY KEY (`id_brgkeluar`),
  ADD KEY `id_product` (`id_product`);

--
-- Indeks untuk tabel `tb_brgmasuk`
--
ALTER TABLE `tb_brgmasuk`
  ADD PRIMARY KEY (`id_brgmasuk`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_vendor` (`id_vendor`);

--
-- Indeks untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_satuan` (`id_satuan`);

--
-- Indeks untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `tb_vendor`
--
ALTER TABLE `tb_vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_brgkeluar`
--
ALTER TABLE `tb_brgkeluar`
  ADD CONSTRAINT `tb_brgkeluar_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `tb_product` (`id_product`);

--
-- Ketidakleluasaan untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  ADD CONSTRAINT `tb_product_ibfk_1` FOREIGN KEY (`id_satuan`) REFERENCES `tb_satuan` (`id_satuan`),
  ADD CONSTRAINT `tb_product_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `tb_category` (`id_category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
