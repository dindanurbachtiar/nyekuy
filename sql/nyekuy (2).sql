-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 14, 2025 at 10:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nyekuy`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `kode_bahan` varchar(12) NOT NULL,
  `nama_bahan` varchar(30) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`kode_bahan`, `nama_bahan`, `stok`) VALUES
('BB001', 'Ceker', 100),
('BB002', 'Tulang', 50),
('BB003', 'Kerupuk Oren', 80),
('BB004', 'Kerupuk Bintang', 100),
('BB005', 'Kerupuk Rantai', 60),
('BB006', 'Kerupuk Keong', 75),
('BB007', 'Potato', 40),
('BB008', 'Makaroni Kriuk', 90),
('BB009', 'Makaroni Spiral', 50),
('BB010', 'Kwetiau', 55),
('BB011', 'Batagor Bulat', 70),
('BB012', 'Batagor Lidah', 45),
('BB013', 'Siomai Segitiga', 35),
('BB014', 'Mie Golosor', 100),
('BB015', 'Jamur Kuping', 25),
('BB016', 'Siomay', 30),
('BB017', 'Tahu Putih', 40),
('BB018', 'Tahu Kuning', 50),
('BB019', 'Sawi Putih', 45),
('BB020', 'Sawi Hijau', 25),
('BB021', 'Kangkung', 35),
('BB022', 'Kol', 60),
('BB023', 'Mie', 70),
('BB024', 'Sosis', 50),
('BB025', 'Baso', 40),
('BB026', 'Kikil', 30),
('BB027', 'Cilok', 45),
('BB028', 'Cuanki', 30),
('BB029', 'Tahu Sumedang', 50),
('BB030', 'Cirawang', 35),
('BB031', 'Cibak', 20),
('BB032', 'Makaroni Hitam', 60);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `kode_laporan` varchar(12) NOT NULL,
  `tgl_laporan` date DEFAULT NULL,
  `pendapatan` int(11) DEFAULT NULL,
  `kode_transaksi` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `kode_menu` varchar(12) NOT NULL,
  `nama_menu` varchar(18) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `bahan_baku` varchar(30) DEFAULT NULL,
  `kode_bahan` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`kode_menu`, `nama_menu`, `harga`, `bahan_baku`, `kode_bahan`) VALUES
('MN001', 'Ceker', 2000, 'Ceker', 'BB001'),
('MN002', 'Tulang', 3000, 'Tulang', 'BB002'),
('MN003', 'Kerupuk Oren', 2000, 'Kerupuk Oren', 'BB003'),
('MN004', 'Kerupuk Bintang', 2000, 'Kerupuk Bintang', 'BB004'),
('MN005', 'Kerupuk Rantai', 2000, 'Kerupuk Rantai', 'BB005'),
('MN006', 'Kerupuk Keong', 2000, 'Kerupuk Keong', 'BB006'),
('MN007', 'Potato', 2000, 'Potato', 'BB007'),
('MN008', 'Makaroni Kriuk', 2000, 'Makaroni Kriuk', 'BB008'),
('MN009', 'Makaroni Spiral', 2000, 'Makaroni Spiral', 'BB009'),
('MN010', 'Kwetiau', 2000, 'Kwetiau', 'BB010'),
('MN011', 'Batagor Bulat', 3000, 'Batagor Bulat', 'BB011'),
('MN012', 'Batagor Lidah', 1000, 'Batagor Lidah', 'BB012'),
('MN013', 'Siomai Segitiga', 1000, 'Siomai Segitiga', 'BB013'),
('MN014', 'Mie Golosor', 2000, 'Mie Golosor', 'BB014'),
('MN015', 'Jamur Kuping', 2000, 'Jamur Kuping', 'BB015'),
('MN016', 'Siomay', 1000, 'Siomay', 'BB016'),
('MN017', 'Tahu Putih', 1000, 'Tahu Putih', 'BB017'),
('MN018', 'Tahu Kuning', 1000, 'Tahu Kuning', 'BB018'),
('MN019', 'Sawi Putih', 1000, 'Sawi Putih', 'BB019'),
('MN020', 'Sawi Hijau', 1000, 'Sawi Hijau', 'BB020'),
('MN021', 'Kangkung', 1000, 'Kangkung', 'BB021'),
('MN022', 'Kol', 1000, 'Kol', 'BB022'),
('MN023', 'Mie', 2000, 'Mie', 'BB023'),
('MN024', 'Sosis', 2000, 'Sosis', 'BB024'),
('MN025', 'Baso', 2000, 'Baso', 'BB025'),
('MN026', 'Kikil', 2000, 'Kikil', 'BB026'),
('MN027', 'Cilok', 1000, 'Cilok', 'BB027'),
('MN028', 'Cuanki', 1000, 'Cuanki', 'BB028'),
('MN029', 'Tahu Sumedang', 1000, 'Tahu Sumedang', 'BB029'),
('MN030', 'Cirawang', 2000, 'Cirawang', 'BB030'),
('MN031', 'Cibak', 2000, 'Cibak', 'BB031'),
('MN032', 'Makaroni Hitam', 2000, 'Makaroni Hitam', 'BB032');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nota_pesanan`
--

CREATE TABLE `nota_pesanan` (
  `kode_pesanan` varchar(12) NOT NULL,
  `nama_pelanggan` varchar(25) DEFAULT NULL,
  `jumlah_pesanan` int(11) DEFAULT NULL,
  `nama_menu` varchar(25) DEFAULT NULL,
  `kode_menu` varchar(12) DEFAULT NULL,
  `id_pelayan` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelayan`
--

CREATE TABLE `pelayan` (
  `id_pelayan` varchar(12) NOT NULL,
  `nama_pelayan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `pelayan`
--

INSERT INTO `pelayan` (`id_pelayan`, `nama_pelayan`, `username`, `password`) VALUES
('P001', 'Dinda', 'admin1', '$2y$10$Bj7HpWSHzAhN8Wo8lYFvjeE14AHvFvknicj6mjk/hUSDqg5bV.qmy'),
('P002', 'Wanda', 'admin2', '$2y$10$fMqxsOKexvF7MgSjvY6NHuXDqXnj.stymNRQcBqCu8wlX3n1E.W2S');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('rGGAOuulNZwlXZ7DdMfkCbovEpNrINFeP5waprkb', 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNDBIT1AzNFh4NzJGWlNkSHVQaTNhd2VMbllGTEJKN241WG9Pd0F3TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MDt9', 1752492055);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(12) NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `kode_pesanan` varchar(12) DEFAULT NULL,
  `id_pelayan` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`kode_bahan`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`kode_laporan`),
  ADD KEY `kode_transaksi` (`kode_transaksi`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`kode_menu`),
  ADD KEY `kode_bahan` (`kode_bahan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nota_pesanan`
--
ALTER TABLE `nota_pesanan`
  ADD PRIMARY KEY (`kode_pesanan`),
  ADD KEY `kode_menu` (`kode_menu`),
  ADD KEY `id_pelayan` (`id_pelayan`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelayan`
--
ALTER TABLE `pelayan`
  ADD PRIMARY KEY (`id_pelayan`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `kode_pesanan` (`kode_pesanan`),
  ADD KEY `id_pelayan` (`id_pelayan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`kode_transaksi`) REFERENCES `transaksi` (`kode_transaksi`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`kode_bahan`) REFERENCES `bahan_baku` (`kode_bahan`);

--
-- Constraints for table `nota_pesanan`
--
ALTER TABLE `nota_pesanan`
  ADD CONSTRAINT `nota_pesanan_ibfk_1` FOREIGN KEY (`kode_menu`) REFERENCES `menu` (`kode_menu`),
  ADD CONSTRAINT `nota_pesanan_ibfk_2` FOREIGN KEY (`id_pelayan`) REFERENCES `pelayan` (`id_pelayan`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`kode_pesanan`) REFERENCES `nota_pesanan` (`kode_pesanan`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pelayan`) REFERENCES `pelayan` (`id_pelayan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
