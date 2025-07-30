/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - nyekuy
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`nyekuy` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `nyekuy`;

/*Table structure for table `bahan_baku` */

DROP TABLE IF EXISTS `bahan_baku`;

CREATE TABLE `bahan_baku` (
  `kode_bahan` varchar(12) COLLATE armscii8_bin NOT NULL,
  `nama_bahan` varchar(30) COLLATE armscii8_bin DEFAULT NULL,
  `stok` int DEFAULT NULL,
  PRIMARY KEY (`kode_bahan`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

/*Data for the table `bahan_baku` */

insert  into `bahan_baku`(`kode_bahan`,`nama_bahan`,`stok`) values 
('BB001','Ceker',100),
('BB002','Tulang',50),
('BB003','Kerupuk Oren',80),
('BB004','Kerupuk Bintang',100),
('BB005','Kerupuk Rantai',60),
('BB006','Kerupuk Keong',75),
('BB007','Potato',40),
('BB008','Makaroni Kriuk',90),
('BB009','Makaroni Spiral',50),
('BB010','Kwetiau',55),
('BB011','Batagor Bulat',70),
('BB012','Batagor Lidah',45),
('BB013','Siomai Segitiga',35),
('BB014','Mie Golosor',100),
('BB015','Jamur Kuping',25),
('BB016','Siomay',30),
('BB017','Tahu Putih',40),
('BB018','Tahu Kuning',50),
('BB019','Sawi Putih',45),
('BB020','Sawi Hijau',25),
('BB021','Kangkung',35),
('BB022','Kol',60),
('BB023','Mie',70),
('BB024','Sosis',50),
('BB025','Baso',40),
('BB026','Kikil',30),
('BB027','Cilok',45),
('BB028','Cuanki',30),
('BB029','Tahu Sumedang',50),
('BB030','Cirawang',35),
('BB031','Cibak',20),
('BB032','Makaroni Hitam',60);

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `laporan` */

DROP TABLE IF EXISTS `laporan`;

CREATE TABLE `laporan` (
  `kode_laporan` varchar(50) COLLATE armscii8_bin NOT NULL,
  `tgl_laporan` date DEFAULT NULL,
  `pendapatan` int DEFAULT NULL,
  `kode_transaksi` varchar(50) COLLATE armscii8_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode_laporan`),
  UNIQUE KEY `kode_laporan` (`kode_laporan`),
  KEY `kode_transaksi` (`kode_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

/*Data for the table `laporan` */

insert  into `laporan`(`kode_laporan`,`tgl_laporan`,`pendapatan`,`kode_transaksi`,`created_at`,`updated_at`) values 
('LAP-250716132333-319','2025-07-16',3000,'TRX-250716132333-728','2025-07-16 13:23:33','2025-07-16 13:23:33'),
('LAP-250716132701-775','2025-07-16',6000,'TRX-250716132701-187','2025-07-16 13:27:01','2025-07-16 13:27:01'),
('LAP-250716133147-770','2025-07-16',6000,'TRX-250716133147-691','2025-07-16 13:31:47','2025-07-16 13:31:47'),
('LAP-250716135741-191','2025-07-16',6000,'TRX-250716135741-302','2025-07-16 13:57:41','2025-07-16 13:57:41'),
('LAP-250716140219-149','2025-07-16',10000,'TRX-250716140219-552','2025-07-16 14:02:19','2025-07-16 14:02:19'),
('LAP-250716140448-648','2025-07-16',4000,'TRX-250716140448-474','2025-07-16 14:04:48','2025-07-16 14:04:48'),
('LAP-250716141038-836','2025-07-16',7000,'TRX-250716141038-843','2025-07-16 14:10:38','2025-07-16 14:10:38'),
('LAP-250716141916-927','2025-07-16',3000,'TRX-250716141916-808','2025-07-16 14:19:16','2025-07-16 14:19:16'),
('LAP-250716142151-714','2025-07-16',3000,'TRX-250716142151-901','2025-07-16 14:21:51','2025-07-16 14:21:51');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `kode_menu` varchar(12) COLLATE armscii8_bin NOT NULL,
  `nama_menu` varchar(18) COLLATE armscii8_bin DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `bahan_baku` varchar(30) COLLATE armscii8_bin DEFAULT NULL,
  `kode_bahan` varchar(12) COLLATE armscii8_bin DEFAULT NULL,
  PRIMARY KEY (`kode_menu`),
  KEY `kode_bahan` (`kode_bahan`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`kode_bahan`) REFERENCES `bahan_baku` (`kode_bahan`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

/*Data for the table `menu` */

insert  into `menu`(`kode_menu`,`nama_menu`,`harga`,`bahan_baku`,`kode_bahan`) values 
('MN001','Ceker',3000,'Ceker','BB001'),
('MN002','Tulang',3000,'Tulang','BB002'),
('MN003','Kerupuk Oren',2000,'Kerupuk Oren','BB003'),
('MN004','Kerupuk Bintang',2000,'Kerupuk Bintang','BB004'),
('MN005','Kerupuk Rantai',2000,'Kerupuk Rantai','BB005'),
('MN006','Kerupuk Keong',2000,'Kerupuk Keong','BB006'),
('MN007','Potato',2000,'Potato','BB007'),
('MN008','Makaroni Kriuk',2000,'Makaroni Kriuk','BB008'),
('MN009','Makaroni Spiral',2000,'Makaroni Spiral','BB009'),
('MN010','Kwetiau',2000,'Kwetiau','BB010'),
('MN011','Batagor Bulat',3000,'Batagor Bulat','BB011'),
('MN012','Batagor Lidah',1000,'Batagor Lidah','BB012'),
('MN013','Siomai Segitiga',1000,'Siomai Segitiga','BB013'),
('MN014','Mie Golosor',2000,'Mie Golosor','BB014'),
('MN015','Jamur Kuping',2000,'Jamur Kuping','BB015'),
('MN016','Siomay',1000,'Siomay','BB016'),
('MN017','Tahu Putih',1000,'Tahu Putih','BB017'),
('MN018','Tahu Kuning',1000,'Tahu Kuning','BB018'),
('MN019','Sawi Putih',1000,'Sawi Putih','BB019'),
('MN020','Sawi Hijau',1000,'Sawi Hijau','BB020'),
('MN021','Kangkung',1000,'Kangkung','BB021'),
('MN022','Kol',1000,'Kol','BB022'),
('MN023','Mie',2000,'Mie','BB023'),
('MN024','Sosis',2000,'Sosis','BB024'),
('MN025','Baso',2000,'Baso','BB025'),
('MN026','Kikil',2000,'Kikil','BB026'),
('MN027','Cilok',1000,'Cilok','BB027'),
('MN028','Cuanki',1000,'Cuanki','BB028'),
('MN029','Tahu Sumedang',1000,'Tahu Sumedang','BB029'),
('MN030','Cirawang',2000,'Cirawang','BB030'),
('MN031','Cibak',2000,'Cibak','BB031'),
('MN032','Makaroni Hitam',2000,'Makaroni Hitam','BB032');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2024_01_01_000000_create_transaksi_table',2);

/*Table structure for table `nota_pesanan` */

DROP TABLE IF EXISTS `nota_pesanan`;

CREATE TABLE `nota_pesanan` (
  `kode_pesanan` varchar(50) COLLATE armscii8_bin NOT NULL,
  `nama_pelanggan` varchar(25) COLLATE armscii8_bin DEFAULT NULL,
  `jumlah_pesanan` int DEFAULT NULL,
  `nama_menu` varchar(25) COLLATE armscii8_bin DEFAULT NULL,
  `kode_menu` varchar(12) COLLATE armscii8_bin DEFAULT NULL,
  `id_pelayan` varchar(12) COLLATE armscii8_bin DEFAULT NULL,
  `harga_satuan` decimal(10,2) NOT NULL COMMENT 'Harga per item',
  `total_harga` decimal(10,2) NOT NULL COMMENT 'Total harga (harga_satuan * jumlah_pesanan)',
  `tanggal_pesanan` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Tanggal dan waktu pesanan',
  `status` enum('pending','processing','completed','cancelled') COLLATE armscii8_bin DEFAULT 'pending' COMMENT 'Status pesanan',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode_pesanan`),
  UNIQUE KEY `kode_pesanan` (`kode_pesanan`),
  KEY `kode_menu` (`kode_menu`),
  KEY `id_pelayan` (`id_pelayan`),
  CONSTRAINT `nota_pesanan_ibfk_1` FOREIGN KEY (`kode_menu`) REFERENCES `menu` (`kode_menu`),
  CONSTRAINT `nota_pesanan_ibfk_2` FOREIGN KEY (`id_pelayan`) REFERENCES `pelayan` (`id_pelayan`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

/*Data for the table `nota_pesanan` */

insert  into `nota_pesanan`(`kode_pesanan`,`nama_pelanggan`,`jumlah_pesanan`,`nama_menu`,`kode_menu`,`id_pelayan`,`harga_satuan`,`total_harga`,`tanggal_pesanan`,`status`,`created_at`,`updated_at`) values 
('PSN-250716-001','al',1,'Ceker','MN001','P001',3000.00,3000.00,'2025-07-16 20:23:33','pending','2025-07-16 13:23:33','2025-07-16 13:23:33'),
('PSN-250716-002','al',1,'Ceker','MN001','P001',3000.00,3000.00,'2025-07-16 20:27:01','pending','2025-07-16 13:27:01','2025-07-16 13:27:01'),
('PSN-250716-003','al',1,'Tulang','MN002','P001',3000.00,3000.00,'2025-07-16 20:27:01','pending','2025-07-16 13:27:01','2025-07-16 13:27:01'),
('PSN-250716-004','dinda',1,'Ceker','MN001','P001',3000.00,3000.00,'2025-07-16 20:31:47','pending','2025-07-16 13:31:47','2025-07-16 13:31:47'),
('PSN-250716-005','dinda',1,'Tulang','MN002','P001',3000.00,3000.00,'2025-07-16 20:31:47','pending','2025-07-16 13:31:47','2025-07-16 13:31:47'),
('PSN-250716-006','al',1,'Ceker','MN001','P001',3000.00,3000.00,'2025-07-16 20:57:41','pending','2025-07-16 13:57:41','2025-07-16 13:57:41'),
('PSN-250716-007','al',1,'Tulang','MN002','P001',3000.00,3000.00,'2025-07-16 20:57:41','pending','2025-07-16 13:57:41','2025-07-16 13:57:41'),
('PSN-250716-008','flo',1,'Ceker','MN001','P001',3000.00,3000.00,'2025-07-16 21:02:19','pending','2025-07-16 14:02:19','2025-07-16 14:02:19'),
('PSN-250716-009','flo',1,'Tulang','MN002','P001',3000.00,3000.00,'2025-07-16 21:02:19','pending','2025-07-16 14:02:19','2025-07-16 14:02:19'),
('PSN-250716-010','flo',1,'Kerupuk Rantai','MN005','P001',2000.00,2000.00,'2025-07-16 21:02:19','pending','2025-07-16 14:02:19','2025-07-16 14:02:19'),
('PSN-250716-011','flo',1,'Kerupuk Keong','MN006','P001',2000.00,2000.00,'2025-07-16 21:02:19','pending','2025-07-16 14:02:19','2025-07-16 14:02:19'),
('PSN-250716-012','dinda',4,'Siomay','MN016','P001',1000.00,4000.00,'2025-07-16 21:04:48','pending','2025-07-16 14:04:48','2025-07-16 14:04:48'),
('PSN-250716-013','sani',1,'Ceker','MN001','P001',3000.00,3000.00,'2025-07-16 21:10:38','pending','2025-07-16 14:10:38','2025-07-16 14:10:38'),
('PSN-250716-014','sani',1,'Kerupuk Rantai','MN005','P001',2000.00,2000.00,'2025-07-16 21:10:38','pending','2025-07-16 14:10:38','2025-07-16 14:10:38'),
('PSN-250716-015','sani',1,'Kwetiau','MN010','P001',2000.00,2000.00,'2025-07-16 21:10:38','pending','2025-07-16 14:10:38','2025-07-16 14:10:38'),
('PSN-250716-016','kayla',1,'Ceker','MN001','P001',3000.00,3000.00,'2025-07-16 21:19:16','pending','2025-07-16 14:19:16','2025-07-16 14:19:16'),
('PSN-250716-017','alya',1,'Ceker','MN001','P001',3000.00,3000.00,'2025-07-16 21:21:51','pending','2025-07-16 14:21:51','2025-07-16 14:21:51');

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `pelayan` */

DROP TABLE IF EXISTS `pelayan`;

CREATE TABLE `pelayan` (
  `id_pelayan` varchar(12) COLLATE armscii8_bin NOT NULL,
  `nama_pelayan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_pelayan`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

/*Data for the table `pelayan` */

insert  into `pelayan`(`id_pelayan`,`nama_pelayan`,`username`,`password`) values 
('P001','Dinda','admin1','$2y$12$R3YZgbvRehdBVzNQHERdcuGqCTJ77wKKZgegS4cPLZzgnwHBbVJ8q'),
('P002','Wanda','admin2','$2y$10$fMqxsOKexvF7MgSjvY6NHuXDqXnj.stymNRQcBqCu8wlX3n1E.W2S');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('qYafjjrXk8Pglulx3UUWnGtrveaFc5R375XFGi4o','0','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoibEtkaXJIZmk0eXVTVjRVSDFwYXZLZ1VpUU45c3lUeDlzRGxxd1NicSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjA7czozOiJ1cmwiO2E6MDp7fX0=',1752677627),
('SzojXUWvBDszSgRKuvVo5OjY8AsRCi1OBHVK6nSi','0','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSURGaENEaWdmbjltVlRNNXFQQU1mcmVsZ3lseElIVXVOeklDaDJVeCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGF5bWVudCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjQ6IlAwMDEiO30=',1752675913);

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(50) COLLATE armscii8_bin NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `total_bayar` int DEFAULT NULL,
  `kode_pesanan` varchar(12) COLLATE armscii8_bin DEFAULT NULL,
  `id_pelayan` varchar(12) COLLATE armscii8_bin DEFAULT NULL,
  `jumlah_bayar` decimal(15,2) DEFAULT NULL,
  `kembalian` decimal(15,2) DEFAULT '0.00',
  `metode_bayar` varchar(255) COLLATE armscii8_bin DEFAULT 'tunai',
  `status` enum('pending','completed','failed') COLLATE armscii8_bin DEFAULT 'completed',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode_transaksi`),
  KEY `kode_pesanan` (`kode_pesanan`),
  KEY `id_pelayan` (`id_pelayan`),
  KEY `idx_transaksi_kode` (`kode_transaksi`),
  KEY `idx_transaksi_tgl_bayar` (`tgl_bayar`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`kode_pesanan`) REFERENCES `nota_pesanan` (`kode_pesanan`),
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pelayan`) REFERENCES `pelayan` (`id_pelayan`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

/*Data for the table `transaksi` */

insert  into `transaksi`(`kode_transaksi`,`tgl_bayar`,`total_bayar`,`kode_pesanan`,`id_pelayan`,`jumlah_bayar`,`kembalian`,`metode_bayar`,`status`,`created_at`,`updated_at`) values 
('TXN-250716-2204','2025-07-16',4000,NULL,NULL,10000.00,6000.00,'cash','completed','2025-07-16 14:04:54','2025-07-16 14:04:54'),
('TXN-250716-2593','2025-07-16',10000,NULL,NULL,20000.00,10000.00,'cash','completed','2025-07-16 14:02:24','2025-07-16 14:02:24'),
('TXN-250716-2714','2025-07-16',7000,NULL,NULL,20000.00,13000.00,'cash','completed','2025-07-16 14:10:44','2025-07-16 14:10:44'),
('TXN-250716-3070','2025-07-16',3000,NULL,NULL,10000.00,7000.00,'cash','completed','2025-07-16 14:25:19','2025-07-16 14:25:19'),
('TXN-250716-4064','2025-07-16',3000,NULL,NULL,10000.00,7000.00,'cash','completed','2025-07-16 12:01:55','2025-07-16 12:01:55'),
('TXN-250716-4511','2025-07-16',9000,NULL,NULL,10000.00,1000.00,'cash','completed','2025-07-16 11:59:35','2025-07-16 11:59:35'),
('TXN-250716-5644','2025-07-16',6000,NULL,NULL,10000.00,4000.00,'cash','completed','2025-07-16 13:57:47','2025-07-16 13:57:47'),
('TXN-250716-6198','2025-07-16',7000,NULL,NULL,20000.00,13000.00,'cash','completed','2025-07-16 14:12:50','2025-07-16 14:12:50'),
('TXN-250716-7110','2025-07-16',6000,NULL,NULL,10000.00,4000.00,'cash','completed','2025-07-16 12:02:48','2025-07-16 12:02:48'),
('TXN-250716-7329','2025-07-16',3000,NULL,NULL,10000.00,7000.00,'cash','completed','2025-07-16 11:29:03','2025-07-16 11:29:03'),
('TXN-250716-9402','2025-07-16',3000,NULL,NULL,10000.00,7000.00,'cash','completed','2025-07-16 12:00:51','2025-07-16 12:00:51');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
