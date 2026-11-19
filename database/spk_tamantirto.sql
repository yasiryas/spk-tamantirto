-- Schema dan data awal SPK Potensi Kalurahan Tamantirto
-- MySQL 5.7+ / MariaDB 10+

SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
START TRANSACTION;
SET time_zone = '+00:00';
SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `indikator` (
  `id_indikator` int(11) NOT NULL AUTO_INCREMENT,
  `nama_indikator` varchar(128) NOT NULL,
  `kode_indikator` varchar(8) NOT NULL,
  `skor_maksimal` int(11) NOT NULL DEFAULT 100,
  PRIMARY KEY (`id_indikator`),
  UNIQUE KEY `kode_indikator` (`kode_indikator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(128) NOT NULL,
  `ikon` varchar(64) NOT NULL DEFAULT 'fas fa-seedling',
  PRIMARY KEY (`id_kategori`),
  UNIQUE KEY `nama_kategori` (`nama_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `padukuhan` (
  `id_padukuhan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_padukuhan` varchar(128) NOT NULL,
  PRIMARY KEY (`id_padukuhan`),
  UNIQUE KEY `nama_padukuhan` (`nama_padukuhan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(256) NOT NULL DEFAULT 'default.jpg',
  `password` varchar(256) NOT NULL,
  `role` enum('super_user','admin','user') NOT NULL DEFAULT 'user',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_create` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_survey` date NOT NULL,
  `id_surveyor` int(11) NOT NULL,
  `pertanyaan` varchar(512) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_indikator` int(11) NOT NULL,
  `id_padukuhan` int(11) NOT NULL,
  `skor` int(11) NOT NULL,
  PRIMARY KEY (`id_pertanyaan`),
  KEY `id_kategori` (`id_kategori`),
  KEY `id_indikator` (`id_indikator`),
  KEY `id_padukuhan` (`id_padukuhan`),
  KEY `id_surveyor` (`id_surveyor`),
  CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pertanyaan_ibfk_2` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pertanyaan_ibfk_3` FOREIGN KEY (`id_padukuhan`) REFERENCES `padukuhan` (`id_padukuhan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pertanyaan_ibfk_4` FOREIGN KEY (`id_surveyor`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `survey` (
  `id_survey` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `tanggal_survey` date NOT NULL,
  PRIMARY KEY (`id_survey`),
  KEY `id_pertanyaan` (`id_pertanyaan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `hasil_perhitungan` (
  `id_perhitungan` int(11) NOT NULL AUTO_INCREMENT,
  `id_padukuhan` int(11) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `skor_sda` int(11) NOT NULL,
  `skor_sdm` int(11) NOT NULL,
  `skor_kl` int(11) NOT NULL,
  `skor_psr` int(11) NOT NULL,
  `skor_fuzzy` decimal(6,2) NOT NULL,
  `hasil_keputusan` varchar(16) NOT NULL,
  `detail_rule` text DEFAULT NULL,
  `date_create` date NOT NULL,
  PRIMARY KEY (`id_perhitungan`),
  KEY `id_padukuhan` (`id_padukuhan`),
  KEY `tahun` (`tahun`),
  CONSTRAINT `hasil_perhitungan_ibfk_1` FOREIGN KEY (`id_padukuhan`) REFERENCES `padukuhan` (`id_padukuhan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `indikator` (`id_indikator`, `nama_indikator`, `kode_indikator`, `skor_maksimal`) VALUES
(7, 'Sumber Daya Manusia', 'SDM', 52),
(8, 'Potensi Kelembagaan', 'KL', 28),
(9, 'Sarana dan Prasarana', 'PSR', 62),
(10, 'Sumber Daya Alam', 'SDA', 80);

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `ikon`) VALUES
(8, 'Persawahan', 'fas fa-tractor'),
(9, 'Perladangan', 'fas fa-mountain'),
(10, 'Peternakan', 'fas fa-drumstick-bite'),
(11, 'Perkebunan', 'fas fa-leaf'),
(12, 'Pertambangan', 'fas fa-oil-can'),
(13, 'Kerajinan', 'fas fa-hammer'),
(14, 'Industri Sedang/Besar', 'fas fa-industry'),
(15, 'Perikanan', 'fas fa-fish'),
(16, 'Jasa/Perdagangan', 'fas fa-shopping-cart');

INSERT INTO `padukuhan` (`id_padukuhan`, `nama_padukuhan`) VALUES
(7, 'Geblagan'),
(8, 'Gatak'),
(9, 'Ngebel'),
(10, 'Ngrame'),
(11, 'Jetis'),
(12, 'Jadan'),
(13, 'Brajan'),
(14, 'Gonjen'),
(15, 'Kasihan'),
(16, 'Kembaran');

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `is_active`, `date_create`) VALUES
(1, 'Administrator', 'admin@mail.com', '$2y$12$3DS1rKMZefRS60WWdUcSguiH9I.BamsHcK4f4elCy.gmLcvOo73OS', 'admin', 1, 1710131674),
(2, 'Pengguna Tamantirto', 'user@mail.com', '$2y$12$fnAnvNrpMCPoj8EDC0wxVeA6dJzKDg4HXPgzt3jUIiDXeDq/4KCru', 'user', 1, 1710132125),
(3, 'Super User', 'su@mail.com', '$2y$12$LtIoz1A5YnHkRUWmLAQLhO3C3BbJm0TnuFtsjYsUjjh5dYnF10Gkm', 'super_user', 1, 1710132254);

INSERT INTO `pertanyaan` (`id_pertanyaan`, `tanggal_survey`, `id_surveyor`, `pertanyaan`, `id_kategori`, `id_indikator`, `id_padukuhan`, `skor`) VALUES
(1, '2023-08-15', 1, 'Skor Sumber Daya Manusia pada sektor Jasa/Perdagangan', 16, 7, 7, 38),
(2, '2023-08-15', 1, 'Skor Potensi Kelembagaan pada sektor Jasa/Perdagangan', 16, 8, 7, 22),
(3, '2023-08-15', 1, 'Skor Sarana dan Prasarana pada sektor Jasa/Perdagangan', 16, 9, 7, 44),
(4, '2023-08-15', 1, 'Skor Sumber Daya Alam pada sektor Jasa/Perdagangan', 16, 10, 7, 47),
(5, '2023-08-15', 1, 'Skor Sumber Daya Manusia pada sektor Jasa/Perdagangan', 16, 7, 8, 15),
(6, '2023-08-15', 1, 'Skor Potensi Kelembagaan pada sektor Jasa/Perdagangan', 16, 8, 8, 8),
(7, '2023-08-15', 1, 'Skor Sarana dan Prasarana pada sektor Jasa/Perdagangan', 16, 9, 8, 22),
(8, '2023-08-15', 1, 'Skor Sumber Daya Alam pada sektor Jasa/Perdagangan', 16, 10, 8, 28),
(9, '2023-08-15', 1, 'Skor Sumber Daya Manusia pada sektor Jasa/Perdagangan', 16, 7, 9, 36),
(10, '2023-08-15', 1, 'Skor Potensi Kelembagaan pada sektor Jasa/Perdagangan', 16, 8, 9, 21),
(11, '2023-08-15', 1, 'Skor Sarana dan Prasarana pada sektor Jasa/Perdagangan', 16, 9, 9, 40),
(12, '2023-08-15', 1, 'Skor Sumber Daya Alam pada sektor Jasa/Perdagangan', 16, 10, 9, 53),
(13, '2023-08-15', 1, 'Skor Sumber Daya Manusia pada sektor Jasa/Perdagangan', 16, 7, 10, 28),
(14, '2023-08-15', 1, 'Skor Potensi Kelembagaan pada sektor Jasa/Perdagangan', 16, 8, 10, 13),
(15, '2023-08-15', 1, 'Skor Sarana dan Prasarana pada sektor Jasa/Perdagangan', 16, 9, 10, 43),
(16, '2023-08-15', 1, 'Skor Sumber Daya Alam pada sektor Jasa/Perdagangan', 16, 10, 10, 37),
(17, '2023-08-15', 1, 'Skor Sumber Daya Manusia pada sektor Jasa/Perdagangan', 16, 7, 11, 29),
(18, '2023-08-15', 1, 'Skor Potensi Kelembagaan pada sektor Jasa/Perdagangan', 16, 8, 11, 13),
(19, '2023-08-15', 1, 'Skor Sarana dan Prasarana pada sektor Jasa/Perdagangan', 16, 9, 11, 36),
(20, '2023-08-15', 1, 'Skor Sumber Daya Alam pada sektor Jasa/Perdagangan', 16, 10, 11, 36),
(21, '2023-08-15', 1, 'Skor Sumber Daya Manusia pada sektor Jasa/Perdagangan', 16, 7, 12, 28),
(22, '2023-08-15', 1, 'Skor Potensi Kelembagaan pada sektor Jasa/Perdagangan', 16, 8, 12, 15),
(23, '2023-08-15', 1, 'Skor Sarana dan Prasarana pada sektor Jasa/Perdagangan', 16, 9, 12, 42),
(24, '2023-08-15', 1, 'Skor Sumber Daya Alam pada sektor Jasa/Perdagangan', 16, 10, 12, 32),
(25, '2023-08-15', 1, 'Skor Sumber Daya Manusia pada sektor Jasa/Perdagangan', 16, 7, 13, 29),
(26, '2023-08-15', 1, 'Skor Potensi Kelembagaan pada sektor Jasa/Perdagangan', 16, 8, 13, 15),
(27, '2023-08-15', 1, 'Skor Sarana dan Prasarana pada sektor Jasa/Perdagangan', 16, 9, 13, 44),
(28, '2023-08-15', 1, 'Skor Sumber Daya Alam pada sektor Jasa/Perdagangan', 16, 10, 13, 37),
(29, '2023-08-15', 1, 'Skor Sumber Daya Manusia pada sektor Jasa/Perdagangan', 16, 7, 14, 29),
(30, '2023-08-15', 1, 'Skor Potensi Kelembagaan pada sektor Jasa/Perdagangan', 16, 8, 14, 14),
(31, '2023-08-15', 1, 'Skor Sarana dan Prasarana pada sektor Jasa/Perdagangan', 16, 9, 14, 40),
(32, '2023-08-15', 1, 'Skor Sumber Daya Alam pada sektor Jasa/Perdagangan', 16, 10, 14, 40),
(33, '2023-08-15', 1, 'Skor Sumber Daya Manusia pada sektor Jasa/Perdagangan', 16, 7, 15, 34),
(34, '2023-08-15', 1, 'Skor Potensi Kelembagaan pada sektor Jasa/Perdagangan', 16, 8, 15, 12),
(35, '2023-08-15', 1, 'Skor Sarana dan Prasarana pada sektor Jasa/Perdagangan', 16, 9, 15, 44),
(36, '2023-08-15', 1, 'Skor Sumber Daya Alam pada sektor Jasa/Perdagangan', 16, 10, 15, 32),
(37, '2023-08-15', 1, 'Skor Sumber Daya Manusia pada sektor Jasa/Perdagangan', 16, 7, 16, 26),
(38, '2023-08-15', 1, 'Skor Potensi Kelembagaan pada sektor Jasa/Perdagangan', 16, 8, 16, 17),
(39, '2023-08-15', 1, 'Skor Sarana dan Prasarana pada sektor Jasa/Perdagangan', 16, 9, 16, 32),
(40, '2023-08-15', 1, 'Skor Sumber Daya Alam pada sektor Jasa/Perdagangan', 16, 10, 16, 44);

INSERT INTO `survey` (`id_survey`, `id_user`, `id_pertanyaan`, `tanggal_survey`)
SELECT `id_pertanyaan`, 1, `id_pertanyaan`, `tanggal_survey` FROM `pertanyaan`;

INSERT INTO `hasil_perhitungan` (`id_perhitungan`, `id_padukuhan`, `tahun`, `skor_sda`, `skor_sdm`, `skor_kl`, `skor_psr`, `skor_fuzzy`, `hasil_keputusan`, `date_create`) VALUES
(1, 7, '2023', 47, 38, 22, 44, 176.74, 'Tinggi', '2023-08-20'),
(2, 8, '2023', 28, 15, 8, 22, 28.92, 'Rendah', '2023-08-20'),
(3, 9, '2023', 53, 36, 21, 40, 169.70, 'Tinggi', '2023-08-20'),
(4, 10, '2023', 37, 28, 13, 43, 139.94, 'Sedang', '2023-08-20'),
(5, 11, '2023', 36, 29, 13, 36, 104.72, 'Sedang', '2023-08-20'),
(6, 12, '2023', 32, 28, 15, 42, 170.67, 'Tinggi', '2023-08-20'),
(7, 13, '2023', 37, 29, 15, 44, 174.16, 'Tinggi', '2023-08-20'),
(8, 14, '2023', 40, 29, 14, 40, 169.74, 'Tinggi', '2023-08-20'),
(9, 15, '2023', 32, 34, 12, 44, 135.29, 'Sedang', '2023-08-20'),
(10, 16, '2023', 44, 26, 17, 32, 117.49, 'Sedang', '2023-08-20');

COMMIT;
