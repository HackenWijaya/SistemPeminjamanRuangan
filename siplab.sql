-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql301.byetcluster.com
-- Waktu pembuatan: 11 Jun 2020 pada 22.50
-- Versi server: 5.6.47-87.0
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_25020675_66`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ask`
--

CREATE TABLE `ask` (
  `id_ask` int(11) NOT NULL,
  `nama_asker` varchar(64) NOT NULL,
  `judul_ask` varchar(64) NOT NULL,
  `isi_ask` varchar(512) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ask`
--

INSERT INTO `ask` (`id_ask`, `nama_asker`, `judul_ask`, `isi_ask`) VALUES
(6, 'Marzuki', 'Tidak punya WhatsApp', 'setelah mengajukan peminjaman, sistem mengarahkan ke whatsapp, bagaimana user yang tidak punya whatsapp min?');

-- --------------------------------------------------------

--
-- Struktur dari tabel `help`
--

CREATE TABLE `help` (
  `id_help` int(11) NOT NULL,
  `judul` varchar(64) NOT NULL,
  `isi` varchar(512) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `help`
--

INSERT INTO `help` (`id_help`, `judul`, `isi`) VALUES
(1, 'Bagaimana cara mendaftar?', 'Dengan mengklik tombol \'mendaftar\' pada halaman login, kemudian tunggu hingga status pengguna diterima oleh Administrator'),
(2, 'Mengapa sistem menampilkan pesan user belum aktif?', 'Setelah selesai mendaftar harap menunggu konfirmasi dari Administrator untuk menerima anda sebagai pengguna baru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_peminjaman` int(3) NOT NULL,
  `status_jadwal` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(4) NOT NULL,
  `id_user` int(3) NOT NULL,
  `id_ruangan` int(3) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_berakhir` time NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(32) NOT NULL,
  `status_peminjaman` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(1) NOT NULL,
  `kode_ruangan` varchar(10) NOT NULL,
  `nama_ruangan` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status_ruangan` enum('Dipakai','Nganggur') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `kode_ruangan`, `nama_ruangan`, `image`, `status_ruangan`) VALUES
(1, 'R1.LK', 'Ruangan 1 Lab Komputer', '5e1382570d24e.png', 'Nganggur'),
(2, 'R2.LK', 'Ruangan 2 Lab Komputer', '5e14771323e46.png', 'Nganggur'),
(3, 'R3.LK', 'Ruangan 3 Lab Komputer', '5e13825fac4bd.png', 'Nganggur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `site`
--

CREATE TABLE `site` (
  `id_site` int(1) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `title` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `site`
--

INSERT INTO `site` (`id_site`, `icon`, `logo`, `title`) VALUES
(1, '5e14758da49b31.png', '5e14758da49b3.png', 'SISTEM PEMINJAMAN LAB KOMPUTER ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(3) NOT NULL,
  `nama_lengkap` varchar(32) NOT NULL,
  `bio` varchar(500) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `level` enum('Admin','Peminjam') NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `bio`, `username`, `password`, `nip`, `no_telp`, `level`, `image`, `status`) VALUES
(1, 'Admin', 'Ini bio admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '11753101951', '82286062083', 'Admin', '5e139bcf64e1e.jpg', 1),
(3, 'Marzuki', '', 'marzuki', 'c93c7b3466148a7418835555700f7fb9b38e58bb', '11751019201', '', 'Peminjam', '', 1),
(21, 'Fahri Susaini', '', 'fahri', '5b18bb6641ef208740515238db03e90c0b68a521', '1175301941', '', 'Peminjam', '', 1),
(25, 'Nur Yulia Yeti', '', 'yulia', '4c0860f68178047c8bc26678dc37953bd57220f4', '11753101952', '', 'Peminjam', '', 1),
(23, 'Yosie Juniarti', '', 'yosie', 'ffdd66ef02126a5f7eaf0455eddaeb1fcc9f1d2a', '1182429372198421', '', 'Peminjam', '', 1),
(24, 'Darwin', '', 'darwin', '34dc8e1804c0a14aeb717e91af443219be617042', '11753101953', '', 'Peminjam', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ask`
--
ALTER TABLE `ask`
  ADD PRIMARY KEY (`id_ask`);

--
-- Indeks untuk tabel `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`id_help`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indeks untuk tabel `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id_site`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ask`
--
ALTER TABLE `ask`
  MODIFY `id_ask` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `help`
--
ALTER TABLE `help`
  MODIFY `id_help` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `site`
--
ALTER TABLE `site`
  MODIFY `id_site` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
