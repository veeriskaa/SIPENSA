-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2026 at 07:23 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_pengaduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Fasilitas'),
(2, 'Bullying'),
(3, 'Akademik'),
(5, 'Kekerasan');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `warna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2014_10_12_000000_create_users_table', 2),
(5, '2026_04_01_230112_create_pengaduan_table', 3),
(6, '2026_04_08_115615_create_notifikasis_table', 4),
(7, '2026_05_20_125013_create_kategoris_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasis`
--

CREATE TABLE `notifikasis` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notifikasis`
--

INSERT INTO `notifikasis` (`id`, `user_id`, `judul`, `pesan`, `tipe`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 'Laporan Ditanggapi', 'Guru BK telah merespon laporan Anda', 'ditanggapi', 1, '2026-04-09 09:38:53', '2026-06-05 13:30:07'),
(2, 1, 'Laporan Selesai', 'Laporan Anda sudah diselesaikan', 'selesai', 1, '2026-04-09 09:38:53', '2026-06-05 13:30:07'),
(3, 1, 'Laporan Diproses', 'Laporan sedang ditinjau', 'proses', 1, '2026-04-09 09:38:53', '2026-06-05 13:30:07'),
(4, 1, 'Laporan Baru', 'Jadwal Pelajaran Sering Berubah Mendadak', 'laporan', 1, '2026-05-09 12:22:12', '2026-06-05 13:30:07'),
(5, 2, 'Laporan Baru', 'Pembulian pada siswi kelas 11B', 'laporan', 1, '2026-05-13 06:33:10', '2026-06-05 18:40:05'),
(6, 2, 'Laporan Baru', 'Pembulian pada siswi kelas 11B', 'laporan', 1, '2026-05-13 06:34:01', '2026-06-05 18:40:05'),
(7, 2, 'Laporan Baru', 'Jadwal Pelajaran Sering Berubah Mendadak', 'laporan', 1, '2026-05-13 08:02:53', '2026-06-05 18:40:05'),
(8, 1, 'Laporan Baru', 'Pembulian pada siswi kelas 11B', 'laporan', 1, '2026-05-13 16:31:33', '2026-06-05 13:30:07'),
(9, 1, 'Laporan Baru', 'Jadwal Pelajaran Sering Berubah Mendadak', 'laporan', 1, '2026-05-13 16:33:24', '2026-06-05 13:30:07'),
(10, 1, 'Laporan Baru', 'Kerusakan Kursi di Area Kantin', 'laporan', 1, '2026-05-13 16:35:05', '2026-06-05 13:30:07'),
(11, 1, 'Laporan Baru', 'Keterlambatan Penyampaian Nilai Tugas dan Ulangan', 'laporan', 1, '2026-06-05 02:33:13', '2026-06-05 13:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `status` enum('pending','proses','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggapan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `user_id`, `kategori`, `judul`, `deskripsi`, `lokasi`, `waktu`, `bukti`, `status`, `created_at`, `updated_at`, `tanggapan`) VALUES
(12, 1, 'Bullying', 'Pembulian pada siswi kelas 11B', 'Salah satu siswi membuli siswi A dengan kata kata yang tidak pantas dan sampai main fisik', 'Ruang Kelas XI IPA 2', '2026-05-14 06:31:00', NULL, 'pending', '2026-05-13 16:31:33', '2026-05-13 16:31:33', NULL),
(13, 1, 'Akademik', 'Jadwal Pelajaran Sering Berubah Mendadak', 'Saya ingin melaporkan bahwa jadwal pelajaran di kelas sering mengalami perubahan secara mendadak tanpa pemberitahuan yang jelas kepada siswa. Hal ini menyebabkan beberapa siswa terlambat masuk kelas atau tidak membawa perlengkapan sesuai mata pelajaran yang berlangsung. Selain itu, perubahan jadwal yang terlalu sering juga membuat proses belajar menjadi kurang efektif dan membingungkan.\r\n\r\nSaya berharap pihak sekolah dapat memberikan informasi perubahan jadwal lebih awal melalui media yang mudah diakses siswa agar kegiatan belajar mengajar dapat berjalan lebih tertib dan terorganisir.', 'Ruang Kelas TKJ', '2026-05-12 06:32:00', NULL, 'selesai', '2026-05-13 16:33:24', '2026-05-13 18:02:48', 'Terimakasih sudah melaporkan, laporan anda sudah selesai kami urus.'),
(14, 1, 'Fasilitas', 'Kerusakan Kursi di Area Kantin', 'Seseorang baru saja mematahkan kursi kantin dengan cara menendangnya sampai patah', 'Kantin A', '2026-05-01 06:34:00', NULL, 'proses', '2026-05-13 16:35:04', '2026-05-13 18:01:55', 'Baik, laporan sedang kami proses, mohon tunggu untuk info selanjutnya.'),
(15, 1, 'Akademik', 'Keterlambatan Penyampaian Nilai Tugas dan Ulangan', 'Saya ingin melaporkan adanya keterlambatan penyampaian nilai tugas dan hasil ulangan pada salah satu mata pelajaran. Beberapa tugas yang telah dikumpulkan sejak beberapa minggu lalu hingga saat ini belum diberikan penilaian maupun umpan balik kepada siswa. Selain itu, hasil ulangan yang telah dilaksanakan juga belum diumumkan sehingga siswa kesulitan mengetahui perkembangan hasil belajar mereka.\r\n\r\nKondisi ini menyebabkan siswa tidak dapat mengevaluasi kekurangan dan memperbaiki pemahaman materi yang telah dipelajari. Beberapa siswa juga merasa khawatir karena nilai tersebut berpengaruh terhadap penilaian akhir semester.\r\n\r\nSaya berharap pihak sekolah dapat menindaklanjuti permasalahan ini dengan berkoordinasi kepada pihak terkait agar proses penilaian dan penyampaian hasil belajar dapat dilakukan lebih tepat waktu sehingga tidak menghambat proses pembelajaran siswa.', 'Ruang Kelas XI TKJ 2', '2026-06-05 16:32:00', NULL, 'pending', '2026-06-05 02:33:12', '2026-06-05 02:33:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int NOT NULL,
  `id_pengaduan` int DEFAULT NULL,
  `id_user` bigint DEFAULT NULL,
  `tanggapan` text,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('siswa','guru_bk') COLLATE utf8mb4_unicode_ci DEFAULT 'siswa',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `foto`) VALUES
(1, 'Riska Maulida', 'siswa@gmail.com', NULL, '$2y$12$m8H5czXebpEFY8gVxuK2MuA/Wici7ifOnsWe/Xy8LNlFazmdjsaCG', 'siswa', 'Jrl119x5KXiiQ3rsoN5uzbexJ0GPYnUjgbiE3chCNYziVmfa6lEemmVBrcK8', NULL, '2026-06-07 04:50:36', 'foto-user/ZFSlgTdc68gy2Yz37NLscGRD82e6EAoFYv8xdQ4j.jpg'),
(2, 'Guru BK', 'guru@gmail.com', NULL, '$2y$12$m8H5czXebpEFY8gVxuK2MuA/Wici7ifOnsWe/Xy8LNlFazmdjsaCG', 'guru_bk', NULL, NULL, '2026-04-23 05:04:28', 'foto-user/Yv6yQeohobXcE6pQHkOhQUOWch9KdAwaoB7VfGKv.jpg'),
(3, 'vee', 'vee@gmail.com', NULL, '$2y$12$CTvLkjM4kupUs4NrAPyteuSprm5O7/hUW15qICMpmQ5lVJakAxv5K', 'siswa', NULL, '2026-05-14 04:52:05', '2026-05-14 04:52:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notif_user` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifikasis`
--
ALTER TABLE `notifikasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD CONSTRAINT `fk_notif_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
