-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `stok` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `buku` (`id`, `judul`, `pengarang`, `stok`) VALUES
(1,	'PHP untuk Pemula',	'Budi Santoso',	6),
(2,	'Belajar Web dengan HTML',	'Rina Wulandari',	3),
(3,	'Menara 100 Lantai',	'Iyan Mulyadi',	10),
(4,	'Dilan 1990',	'Ciwan',	5),
(8,	'Solo Leveling',	'Ciwanso',	2),
(9,	'Pendidikan Militer',	'Kang Dedy Mulyadi',	20);

DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE `peminjaman` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_buku` int NOT NULL,
  `nama_peminjam` varchar(100) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_buku` (`id_buku`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `peminjaman` (`id`, `id_buku`, `nama_peminjam`, `tanggal_pinjam`, `tanggal_kembali`) VALUES
(1,	1,	'Andi Nugroho',	'2025-06-20',	'2025-06-25'),
(2,	2,	'Ciwanso',	'2025-06-26',	'2025-06-28'),
(4,	4,	'Diwa Ardinata',	'2025-06-02',	'2025-06-06'),
(7,	1,	'Kristoforus',	'2025-06-11',	'2025-06-12');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3,	'admin',	'21232f297a57a5a743894a0e4a801fc3');

DROP VIEW IF EXISTS `view_peminjaman`;
CREATE TABLE `view_peminjaman` (`id` int, `judul_buku` varchar(100), `nama_peminjam` varchar(100), `tanggal_pinjam` date, `tanggal_kembali` date);


DROP TABLE IF EXISTS `view_peminjaman`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_peminjaman` AS select `p`.`id` AS `id`,`b`.`judul` AS `judul_buku`,`p`.`nama_peminjam` AS `nama_peminjam`,`p`.`tanggal_pinjam` AS `tanggal_pinjam`,`p`.`tanggal_kembali` AS `tanggal_kembali` from (`peminjaman` `p` join `buku` `b` on((`p`.`id_buku` = `b`.`id`)));

-- 2025-06-28 10:18:37