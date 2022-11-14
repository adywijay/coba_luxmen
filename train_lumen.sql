-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2022 at 03:07 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `train_lumen`
--

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_akses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `nama_akses`, `created_at`, `updated_at`) VALUES
(1, 'Dept.IT-Group', '2022-10-17 09:48:26', '2022-10-17 09:48:26'),
(2, 'Dept.HR/GA-Group', '2022-10-17 09:49:11', '2022-10-17 09:49:11'),
(3, 'Dept.Executive-Group', '2022-10-17 09:50:03', '2022-10-17 09:50:03'),
(4, 'Bsc As Bassic', '2022-10-17 09:51:20', '2022-10-17 09:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `jabatans`
--

CREATE TABLE `jabatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatans`
--

INSERT INTO `jabatans` (`id`, `kode_jabatan`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'CEO', 'Chief Executive Officer', NULL, NULL),
(2, 'CFO', 'Chief Financial; Officer', NULL, NULL),
(3, 'COO', 'Chief Operation Officer', NULL, NULL),
(5, 'IT-Dev.Jr', 'IT-Developer.Junior', NULL, NULL),
(6, 'IT-Dev.Mr', 'IT-Developer.Middle', NULL, NULL),
(7, 'IT-Dev.Sr', 'IT-Developer.Senior', NULL, NULL),
(9, 'IT-Ops', 'IT-Operations', '2022-10-17 08:59:28', '2022-10-17 08:59:28'),
(10, 'CFO', 'Chief Financial Officer', '2022-10-17 09:02:23', '2022-10-17 09:02:23'),
(11, 'CMO', 'Chief Management Officer', '2022-10-17 09:35:05', '2022-10-17 09:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `akses_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  `tgl_keluar` datetime NOT NULL,
  `status` enum('Aktif','Nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id`, `nama_karyawan`, `jabatan_id`, `akses_id`, `tahun_masuk`, `tgl_masuk`, `tgl_keluar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Immanuel Khan D.P', 7, 1, 2020, '2022-10-21 08:10:09', '2022-10-21 08:10:09', 'Nonaktif', '2022-10-21 08:10:09', '2022-10-21 08:10:09'),
(2, 'Grace racetho HP', 9, 3, 2020, '2022-10-21 08:10:09', '2022-10-21 08:10:09', 'Aktif', '2022-10-21 08:10:09', '2022-10-21 09:49:17'),
(3, 'Bangun Siangan Jr', 6, 1, 2020, '2022-10-21 08:10:09', '2022-10-21 08:10:09', 'Nonaktif', '2022-10-21 08:10:09', '2022-10-21 08:10:09'),
(4, 'Samandimins Ag', 10, 4, 2015, '2022-10-21 08:10:09', '2022-10-21 08:10:09', 'Aktif', '2022-10-21 08:10:09', '2022-10-21 09:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2022_10_13_023510_create_jabatans_table', 1),
(2, '2022_10_13_024426_create_hak_akses_table', 1),
(5, '2022_10_13_024646_create_karyawans_table', 2),
(6, '2022_10_18_070408_create_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `token`, `created_at`, `updated_at`) VALUES
(1, 'adywijanarko14@gmail.com', '$2y$10$JM93F.8mJ/jxEOMMI5vnF.EiSn5Wf7TZ3ek1SesZY5FAUtodQiXpK', '2a696afa79df186256a7c2918b5903ce0e998b27b65d74688ba16589bb28438f6cb2fad9adffbdc2', '2022-10-18 07:54:23', '2022-10-18 07:58:06'),
(2, 'test_dev1@gmail.com', '$2y$10$y4WGOjdepIy7E9d8GVdubOAUQ4Xxgp4gkeRK5kMKw7sxJNvJG3/cq', 'b76e0640a1eaba5d9638cb63321ea5230cd06ea5cded1e49debc9050d5208a52b660b68f04382909', '2022-10-18 12:50:53', '2022-10-18 12:57:05'),
(3, 'ggh_dev1@gmail.com', '$2y$10$LYKoIFO0Qio/wDgQNfn4qu/2RhTIFDKC14aNq15C1GQPKw15VmKUW', '1bc61bef80715deb6d39', '2022-10-18 18:31:04', '2022-10-19 11:39:45'),
(4, 'dev-02@gmail.com', '$2y$10$7/fn.X7KF0Ab/EUnAQEUsOkYHUCeBj9WcvHUXL59uzSdeaiUzvh0q', 'f17686b12d4c0064143c', '2022-10-21 08:22:56', '2022-10-21 09:48:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatans`
--
ALTER TABLE `jabatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawans_jabatan_id_foreign` (`jabatan_id`),
  ADD KEY `karyawans_akses_id_foreign` (`akses_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD CONSTRAINT `karyawans_akses_id_foreign` FOREIGN KEY (`akses_id`) REFERENCES `hak_akses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `karyawans_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
