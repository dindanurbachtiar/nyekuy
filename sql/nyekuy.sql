-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 14, 2025 at 03:01 PM
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
('BB001', 'Kerupuk basah', 100),
('BB002', 'Ceker ayam', 50),
('BB003', 'Bakso sapi', 80),
('BB004', 'Sosis', 100),
('BB005', 'Telur', 60),
('BB006', 'Makaroni', 75),
('BB007', 'Kwetiau', 40),
('BB008', 'Mie kuning', 90),
('BB009', 'Cimol', 50),
('BB010', 'Cireng', 55),
('BB011', 'Tahu goreng', 70),
('BB012', 'Tahu aci', 45),
('BB013', 'Jamur tiram', 35),
('BB014', 'Sukro', 100),
('BB015', 'Sayap ayam', 25),
('BB016', 'Tulangan ayam', 30),
('BB017', 'Keju parut', 40),
('BB018', 'Kornet', 50),
('BB019', 'Otak-otak ikan', 45),
('BB020', 'Kikil sapi', 25);

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

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`kode_laporan`, `tgl_laporan`, `pendapatan`, `kode_transaksi`) VALUES
('L001', '2025-07-14', 15000, 'T001'),
('L002', '2025-07-14', 30000, 'T002');

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
('M001', 'Seblak Original', 12000, 'Kerupuk basah', 'BB001'),
('M002', 'Seblak + Ceker', 15000, 'Ceker ayam', 'BB002'),
('M003', 'Seblak + Bakso', 15000, 'Bakso sapi', 'BB003'),
('M004', 'Seblak + Sosis', 15000, 'Sosis', 'BB004'),
('M005', 'Seblak + Telur', 13000, 'Telur', 'BB005'),
('M006', 'Seblak + Makaroni', 14000, 'Makaroni', 'BB006'),
('M007', 'Seblak + Kwetiau', 14000, 'Kwetiau', 'BB007'),
('M008', 'Seblak + Mie Kunin', 14000, 'Mie kuning', 'BB008'),
('M009', 'Seblak + Cimol', 13000, 'Cimol', 'BB009'),
('M010', 'Seblak + Cireng', 14000, 'Cireng', 'BB010'),
('M011', 'Seblak + Tahu Gore', 13000, 'Tahu goreng', 'BB011'),
('M012', 'Seblak + Tahu Aci', 14000, 'Tahu aci', 'BB012'),
('M013', 'Seblak + Jamur Tir', 14000, 'Jamur tiram', 'BB013'),
('M014', 'Seblak + Sukro', 12000, 'Sukro', 'BB014'),
('M015', 'Seblak + Sayap Aya', 15000, 'Sayap ayam', 'BB015'),
('M016', 'Seblak + Tulangan', 14000, 'Tulangan ayam', 'BB016'),
('M017', 'Seblak + Keju', 15000, 'Keju parut', 'BB017'),
('M018', 'Seblak + Kornet', 15000, 'Kornet', 'BB018'),
('M019', 'Seblak + Otak-otak', 15000, 'Otak-otak ikan', 'BB019'),
('M020', 'Seblak + Kikil', 15000, 'Kikil sapi', 'BB020');

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

--
-- Dumping data for table `nota_pesanan`
--

INSERT INTO `nota_pesanan` (`kode_pesanan`, `nama_pelanggan`, `jumlah_pesanan`, `nama_menu`, `kode_menu`, `id_pelayan`) VALUES
('NP001', 'Ani', 1, 'Seblak + Ceker', 'M002', 'P001'),
('NP002', 'Dedi', 2, 'Seblak + Kornet', 'M018', 'P002');

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

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `tgl_bayar`, `total_bayar`, `kode_pesanan`, `id_pelayan`) VALUES
('T001', '2025-07-14', 15000, 'NP001', 'P001'),
('T002', '2025-07-14', 30000, 'NP002', 'P002');

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
