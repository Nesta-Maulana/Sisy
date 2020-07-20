-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jul 2020 pada 02.30
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisy_alpha_transaction_data`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_kimias`
--

CREATE TABLE `analisa_kimias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cpp_head_id` bigint(20) NOT NULL COMMENT 'connected to cpphead table',
  `ppq_id` bigint(20) DEFAULT NULL COMMENT 'connected to ppq table',
  `ts_awal_1` double(5,2) DEFAULT NULL,
  `ts_awal_2` double(5,2) DEFAULT NULL,
  `ts_tengah_1` double(5,2) DEFAULT NULL,
  `ts_tengah_2` double(5,2) DEFAULT NULL,
  `ts_akhir_1` double(5,2) DEFAULT NULL,
  `ts_akhir_2` double(5,2) DEFAULT NULL,
  `ts_awal_avg` double(6,3) DEFAULT NULL,
  `ts_tengah_avg` double(6,3) DEFAULT NULL,
  `ts_akhir_avg` double(6,3) DEFAULT NULL,
  `ph_awal` double(5,2) DEFAULT NULL,
  `ph_tengah` double(5,2) DEFAULT NULL,
  `ph_akhir` double(5,2) DEFAULT NULL,
  `visko_awal` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visko_tengah` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visko_akhir` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sensori_awal` enum('OK','#OK') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sensori_tengah` enum('OK','#OK') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sensori_akhir` enum('OK','#OK') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_filling_awal` datetime DEFAULT NULL,
  `jam_filling_tengah` datetime DEFAULT NULL,
  `jam_filling_akhir` datetime DEFAULT NULL,
  `ts_oven_awal` double(5,2) DEFAULT NULL,
  `ts_oven_tengah` double(5,2) DEFAULT NULL,
  `ts_oven_akhir` double(5,2) DEFAULT NULL,
  `kode_batch_standar` char(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `progress_status` tinyint(1) DEFAULT NULL,
  `analisa_kimia_status` tinyint(1) DEFAULT NULL,
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_mikro`
--

CREATE TABLE `analisa_mikro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cpp_head_id` bigint(20) DEFAULT NULL COMMENT 'connected to cpp head table',
  `tanggal_analisa` date DEFAULT NULL,
  `progress_status` tinyint(1) DEFAULT NULL,
  `progress_status_30` tinyint(1) DEFAULT NULL,
  `progress_status_55` tinyint(1) DEFAULT NULL,
  `verifikasi_qc_release` tinyint(1) DEFAULT NULL,
  `analisa_mikro_status` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = #OK, 1 = OK',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_mikro_details`
--

CREATE TABLE `analisa_mikro_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `analisa_mikro_id` bigint(20) DEFAULT NULL COMMENT 'connected to analisa mikro table',
  `analisa_mikro_resampling_id` bigint(20) DEFAULT NULL COMMENT 'connected to analisa mikro table',
  `filling_machine_id` bigint(20) NOT NULL COMMENT 'connected to filling machine table',
  `ppq_id` bigint(20) DEFAULT NULL COMMENT 'connected to ppq table',
  `kode_sampel` char(7) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ini ngambil dari column filling sampel code ngambil dari table rpd filling produk',
  `jam_filling` datetime NOT NULL COMMENT 'ini defaultnya ambil dari jam filling sampel dari rpd filling',
  `suhu_preinkubasi` enum('30','55') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ini untuk pembeda suhu 30 derajat atau 55 derajat dalam kategori susu dan non susu',
  `tpc` bigint(20) DEFAULT NULL COMMENT 'diinput oleh tim lab mikro',
  `yeast` bigint(20) DEFAULT NULL COMMENT 'diinput oleh tim lab mikro',
  `mold` bigint(20) DEFAULT NULL COMMENT 'diinput oleh tim lab mikro',
  `ph` double(5,2) DEFAULT NULL COMMENT 'ini diinput oleh tim petugas qc release',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = #ok , 1 = OK ',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_mikro_resampling`
--

CREATE TABLE `analisa_mikro_resampling` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `analisa_mikro_id` bigint(20) DEFAULT NULL COMMENT 'connected to analisa mikro table',
  `ppq_id` bigint(20) DEFAULT NULL COMMENT 'connected to analisa mikro table',
  `tanggal_analisa` date DEFAULT NULL,
  `suhu_preinkubasi` bigint(20) DEFAULT NULL,
  `progress_status` tinyint(1) DEFAULT NULL,
  `analisa_mikro_status` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = #OK, 1 = OK',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `corrective_actions`
--

CREATE TABLE `corrective_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follow_up_ppq_id` bigint(20) DEFAULT NULL COMMENT 'connected to table follow up ppq',
  `follow_up_rkj_id` bigint(20) DEFAULT NULL COMMENT 'connected to table follow up rkj',
  `corrective_action` text COLLATE utf8mb4_unicode_ci COMMENT 'ini diinput oleh qc tahanan dan engineering',
  `due_date_corrective_action` date DEFAULT NULL COMMENT 'ini diinput oleh qc tahanan dan engineering',
  `pic_corrective_action` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'diinput oleh qc tahanan dan enginerring',
  `status_corrective_action` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = on progress , 1 = done | diinput oleh qc tahanan or enginerring',
  `verifikasi_corrective_action` text COLLATE utf8mb4_unicode_ci COMMENT 'ini diinput oleh qc tahanan dan engineering',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpp_details`
--

CREATE TABLE `cpp_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cpp_head_id` bigint(20) NOT NULL COMMENT 'connected to cpp_heads table',
  `wo_number_id` bigint(20) NOT NULL COMMENT 'connected to wo_numbers table',
  `filling_machine_id` bigint(20) NOT NULL COMMENT 'connected to filling_machine table',
  `lot_number` char(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'logic lot number TC 23 10 A . T => Tahun , C => Mesin , 23 => tanggal , 10 => Bulan , A => Urutan proses produksi',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cpp_details`
--

INSERT INTO `cpp_details` (`id`, `cpp_head_id`, `wo_number_id`, `filling_machine_id`, `lot_number`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 'KC2206A', 1, NULL, NULL, '2020-06-28 02:29:34', '2020-06-28 02:29:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cpp_heads`
--

CREATE TABLE `cpp_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL COMMENT 'connected to product table',
  `analisa_kimia_id` bigint(20) DEFAULT NULL COMMENT 'connected to analisa kimia table',
  `analisa_mikro_id` bigint(20) DEFAULT NULL COMMENT 'connected to analisa mikro table',
  `packing_date` date NOT NULL,
  `cpp_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 => on progress, 1 => done',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cpp_heads`
--

INSERT INTO `cpp_heads` (`id`, `product_id`, `analisa_kimia_id`, `analisa_mikro_id`, `packing_date`, `cpp_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 20, NULL, NULL, '2020-06-28', '1', 1, 1, NULL, '2020-06-28 02:27:56', '2020-06-28 03:10:22', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `energy_monitorings`
--

CREATE TABLE `energy_monitorings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flowmeter_id` bigint(20) NOT NULL COMMENT 'connected to flowmeter table',
  `monitoring_value` double NOT NULL COMMENT 'angka meterannya',
  `monitoring_date` date NOT NULL COMMENT 'ini untuk panduan tanggal pengamatannya kapan',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `energy_monitorings`
--

INSERT INTO `energy_monitorings` (`id`, `flowmeter_id`, `monitoring_value`, `monitoring_date`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:27:59', '2020-07-19 16:27:59', NULL),
(3, 2, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:28:34', '2020-07-19 16:28:34', NULL),
(4, 3, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:28:38', '2020-07-19 16:28:38', NULL),
(5, 4, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:29:09', '2020-07-19 16:29:09', NULL),
(6, 15, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:29:13', '2020-07-19 16:29:13', NULL),
(7, 19, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:29:18', '2020-07-19 16:29:18', NULL),
(8, 20, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:29:22', '2020-07-19 16:29:22', NULL),
(9, 5, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:30:16', '2020-07-19 16:30:16', NULL),
(10, 6, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:30:24', '2020-07-19 16:30:24', NULL),
(11, 7, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:30:44', '2020-07-19 16:30:44', NULL),
(12, 8, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:30:50', '2020-07-19 16:30:50', NULL),
(13, 9, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:31:05', '2020-07-19 16:31:05', NULL),
(14, 10, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:31:29', '2020-07-19 16:31:29', NULL),
(15, 11, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:31:38', '2020-07-19 16:31:38', NULL),
(16, 12, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:31:42', '2020-07-19 16:31:42', NULL),
(17, 13, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:31:45', '2020-07-19 16:31:45', NULL),
(18, 14, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:31:49', '2020-07-19 16:31:49', NULL),
(19, 16, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:32:01', '2020-07-19 16:32:01', NULL),
(20, 17, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:32:04', '2020-07-19 16:32:04', NULL),
(21, 18, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:32:09', '2020-07-19 16:32:09', NULL),
(22, 21, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:32:14', '2020-07-19 16:32:14', NULL),
(23, 22, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:32:20', '2020-07-19 16:32:20', NULL),
(24, 23, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:32:24', '2020-07-19 16:32:24', NULL),
(25, 24, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:32:29', '2020-07-19 16:32:29', NULL),
(26, 25, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:32:33', '2020-07-19 16:32:33', NULL),
(27, 26, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:32:38', '2020-07-19 16:32:38', NULL),
(28, 27, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:33:42', '2020-07-19 16:33:42', NULL),
(29, 28, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:33:47', '2020-07-19 16:33:47', NULL),
(30, 29, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:33:52', '2020-07-19 16:33:52', NULL),
(31, 30, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:34:05', '2020-07-19 16:34:05', NULL),
(32, 31, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:34:11', '2020-07-19 16:34:11', NULL),
(33, 32, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:34:25', '2020-07-19 16:34:25', NULL),
(34, 33, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:34:46', '2020-07-19 16:34:46', NULL),
(35, 34, 2000, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:34:52', '2020-07-19 16:34:52', NULL),
(36, 1, 2100, '2020-07-20', 1, 1, NULL, '2020-07-19 17:25:43', '2020-07-19 17:38:43', NULL),
(37, 2, 2300, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:41:36', '2020-07-19 17:41:36', NULL),
(38, 3, 2300, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:41:40', '2020-07-19 17:41:40', NULL),
(39, 4, 3000, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:42:24', '2020-07-19 17:42:24', NULL),
(40, 15, 2500, '2020-07-20', 1, 1, NULL, '2020-07-19 17:44:50', '2020-07-19 18:19:22', NULL),
(41, 19, 2000, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:46:52', '2020-07-19 17:46:52', NULL),
(42, 20, 2000, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:46:59', '2020-07-19 17:46:59', NULL),
(43, 5, 2300, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:12', '2020-07-19 17:47:12', NULL),
(44, 6, 2400, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:14', '2020-07-19 17:47:14', NULL),
(45, 7, 2300, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:17', '2020-07-19 17:47:17', NULL),
(46, 8, 2200, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:20', '2020-07-19 17:47:20', NULL),
(47, 9, 2100.98, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:26', '2020-07-19 17:47:26', NULL),
(48, 10, 2000.9, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:31', '2020-07-19 17:47:31', NULL),
(49, 11, 2000.99, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:38', '2020-07-19 17:47:38', NULL),
(50, 12, 2000.01, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:43', '2020-07-19 17:47:43', NULL),
(51, 13, 2000.9, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:51', '2020-07-19 17:47:51', NULL),
(52, 14, 2000.9, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:54', '2020-07-19 17:47:54', NULL),
(53, 16, 2200, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:11', '2020-07-19 17:48:11', NULL),
(54, 17, 2290, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:16', '2020-07-19 17:48:16', NULL),
(55, 18, 2210, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:18', '2020-07-19 17:48:18', NULL),
(56, 21, 2230, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:21', '2020-07-19 17:48:21', NULL),
(57, 22, 2230, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:24', '2020-07-19 17:48:24', NULL),
(58, 23, 2209, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:26', '2020-07-19 17:48:26', NULL),
(59, 24, 2209, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:28', '2020-07-19 17:48:28', NULL),
(60, 25, 2209, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:30', '2020-07-19 17:48:30', NULL),
(61, 26, 2208, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:33', '2020-07-19 17:48:33', NULL),
(62, 27, 2209, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:35', '2020-07-19 17:48:35', NULL),
(63, 28, 2201, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:38', '2020-07-19 17:48:38', NULL),
(64, 29, 2100, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:42', '2020-07-19 17:48:42', NULL),
(65, 30, 2100, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:50', '2020-07-19 17:48:50', NULL),
(66, 31, 2100, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:56', '2020-07-19 17:48:56', NULL),
(67, 32, 2100, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:58', '2020-07-19 17:48:58', NULL),
(68, 33, 2100, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:49:00', '2020-07-19 17:49:00', NULL),
(69, 34, 2100, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:49:02', '2020-07-19 17:49:02', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `energy_usages`
--

CREATE TABLE `energy_usages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flowmeter_usage_id` bigint(20) NOT NULL COMMENT 'connected to flowmeter usage table',
  `flowmeter_formula_id` bigint(20) NOT NULL COMMENT 'connected to flowmeter table',
  `usage_value` double NOT NULL COMMENT 'angka penggunaan berdasar rumus yang diatas',
  `usage_date` date NOT NULL COMMENT 'ini untuk panduan tanggal penggunaannya kapan',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `energy_usages`
--

INSERT INTO `energy_usages` (`id`, `flowmeter_usage_id`, `flowmeter_formula_id`, `usage_value`, `usage_date`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:27:59', '2020-07-19 16:34:53', NULL),
(2, 2, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:28:34', '2020-07-19 16:34:53', NULL),
(3, 3, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:28:38', '2020-07-19 16:34:53', NULL),
(4, 4, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:29:10', '2020-07-19 16:34:53', NULL),
(5, 15, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:29:14', '2020-07-19 16:34:55', NULL),
(6, 19, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:29:19', '2020-07-19 16:34:55', NULL),
(7, 20, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:29:24', '2020-07-19 16:34:56', NULL),
(8, 28, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:29:24', '2020-07-19 16:34:57', NULL),
(9, 5, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:30:18', '2020-07-19 16:34:53', NULL),
(10, 6, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:30:25', '2020-07-19 16:34:54', NULL),
(11, 7, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:30:45', '2020-07-19 16:34:54', NULL),
(12, 8, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:30:51', '2020-07-19 16:34:54', NULL),
(13, 9, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:31:06', '2020-07-19 16:34:54', NULL),
(14, 10, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:31:32', '2020-07-19 16:34:54', NULL),
(15, 11, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:31:40', '2020-07-19 16:34:54', NULL),
(16, 12, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:31:43', '2020-07-19 16:34:55', NULL),
(17, 13, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:31:48', '2020-07-19 16:34:55', NULL),
(18, 14, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:31:51', '2020-07-19 16:34:55', NULL),
(19, 16, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:32:03', '2020-07-19 16:34:55', NULL),
(20, 27, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:32:03', '2020-07-19 16:34:57', NULL),
(21, 17, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:32:06', '2020-07-19 16:34:55', NULL),
(22, 18, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:32:12', '2020-07-19 16:34:55', NULL),
(23, 21, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:32:19', '2020-07-19 16:34:56', NULL),
(24, 22, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:32:23', '2020-07-19 16:34:56', NULL),
(25, 23, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:32:28', '2020-07-19 16:34:56', NULL),
(26, 24, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:32:32', '2020-07-19 16:34:56', NULL),
(27, 25, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:32:37', '2020-07-19 16:34:56', NULL),
(28, 26, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:32:42', '2020-07-19 16:34:57', NULL),
(29, 31, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:33:58', '2020-07-19 16:34:57', NULL),
(30, 32, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:34:10', '2020-07-19 16:34:57', NULL),
(31, 33, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:34:24', '2020-07-19 16:34:57', NULL),
(32, 34, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:34:46', '2020-07-19 16:34:57', NULL),
(33, 35, 1, 0, '2020-07-19', 1, 1, NULL, '2020-07-19 16:34:52', '2020-07-19 16:34:57', NULL),
(34, 36, 1, 0, '2020-07-19', 1, NULL, NULL, '2020-07-19 16:34:58', '2020-07-19 16:34:58', NULL),
(35, 1, 1, 100, '2020-07-20', 1, 1, NULL, '2020-07-19 17:25:43', '2020-07-19 17:38:43', NULL),
(36, 2, 1, 300, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:41:36', '2020-07-19 17:41:36', NULL),
(37, 3, 1, 300, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:41:40', '2020-07-19 17:41:40', NULL),
(38, 4, 1, 1000, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:42:24', '2020-07-19 17:42:24', NULL),
(39, 15, 1, 500, '2020-07-20', 1, 1, NULL, '2020-07-19 17:44:50', '2020-07-19 18:19:22', NULL),
(40, 19, 1, 0, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:46:53', '2020-07-19 17:46:53', NULL),
(41, 20, 1, 0, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:46:59', '2020-07-19 17:46:59', NULL),
(42, 28, 1, 0, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:46:59', '2020-07-19 17:46:59', NULL),
(43, 5, 1, 300, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:12', '2020-07-19 17:47:12', NULL),
(44, 6, 1, 400, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:15', '2020-07-19 17:47:15', NULL),
(45, 7, 1, 300, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:18', '2020-07-19 17:47:18', NULL),
(46, 8, 1, 200, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:20', '2020-07-19 17:47:20', NULL),
(47, 9, 1, 100.98, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:26', '2020-07-19 17:47:26', NULL),
(48, 10, 1, 0.90000000000009, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:31', '2020-07-19 17:47:31', NULL),
(49, 11, 1, 0.99000000000001, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:38', '2020-07-19 17:47:38', NULL),
(50, 12, 1, 0.0099999999999909, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:43', '2020-07-19 17:47:43', NULL),
(51, 13, 1, 0.90000000000009, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:51', '2020-07-19 17:47:51', NULL),
(52, 14, 1, 0.90000000000009, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:47:55', '2020-07-19 17:47:55', NULL),
(53, 16, 1, 200, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:12', '2020-07-19 17:48:12', NULL),
(54, 27, 1, 200, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:12', '2020-07-19 17:48:12', NULL),
(55, 17, 1, 290, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:16', '2020-07-19 17:48:16', NULL),
(56, 18, 1, 210, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:19', '2020-07-19 17:48:19', NULL),
(57, 21, 1, 230, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:22', '2020-07-19 17:48:22', NULL),
(58, 22, 1, 230, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:24', '2020-07-19 17:48:24', NULL),
(59, 23, 1, 209, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:27', '2020-07-19 17:48:27', NULL),
(60, 24, 1, 209, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:29', '2020-07-19 17:48:29', NULL),
(61, 25, 1, 209, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:30', '2020-07-19 17:48:30', NULL),
(62, 26, 1, 208, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:33', '2020-07-19 17:48:33', NULL),
(63, 31, 1, 100, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:42', '2020-07-19 17:48:42', NULL),
(64, 32, 1, 100, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:51', '2020-07-19 17:48:51', NULL),
(65, 33, 1, 100, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:56', '2020-07-19 17:48:56', NULL),
(66, 34, 1, 100, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:48:59', '2020-07-19 17:48:59', NULL),
(67, 35, 1, 100, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:49:00', '2020-07-19 17:49:00', NULL),
(68, 36, 1, 100, '2020-07-20', 1, NULL, NULL, '2020-07-19 17:49:02', '2020-07-19 17:49:02', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `follow_up_ppqs`
--

CREATE TABLE `follow_up_ppqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ppq_id` bigint(20) NOT NULL,
  `jumlah_metode_sampling` text COLLATE utf8mb4_unicode_ci COMMENT 'column yang diinput oleh params Qc Release',
  `hasil_analisa` text COLLATE utf8mb4_unicode_ci COMMENT 'column yang diinput qc release jika status PI | diinput oleh qc tahanan as hasil evaluasi',
  `status_produk` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = reject , 1 = release , 2 = relase partial | diinput oleh qc release or qc tahanan || status_produk',
  `tanggal_status_ppq` date DEFAULT NULL,
  `nomor_lbd` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'column yang diinput qc release jika status PI',
  `root_cause` text COLLATE utf8mb4_unicode_ci COMMENT 'ini diinput oleh tim engineering',
  `kategori_case` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = case lama , 1 = case baru | diinput oleh tim engineering',
  `status_case` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = on progress , 1 = close | diinput oleh tim engineering',
  `status_follow_up_ppq` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = on progress , 1 = close ',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `follow_up_rkjs`
--

CREATE TABLE `follow_up_rkjs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rkj_id` bigint(20) DEFAULT NULL COMMENT 'ini connect ke rkj table',
  `dugaan_penyebab` text COLLATE utf8mb4_unicode_ci COMMENT 'column yang  diisi oleh RnD',
  `hasil_analisa` text COLLATE utf8mb4_unicode_ci COMMENT 'column yang  diisi oleh RnD',
  `status_produk` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = reject , 1 = release , 2 = relase partial ',
  `tanggal_status_produk` date DEFAULT NULL,
  `status_follow_up_rkj` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = on progress , 1 = close ',
  `nomor_rkp` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'diinput oleh tim QA',
  `hasil_investigasi` text COLLATE utf8mb4_unicode_ci COMMENT 'diisi oleh tim QA',
  `tanggal_loi` date DEFAULT NULL COMMENT 'diisi oleh tim QA',
  `status_case` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = On progress , 1 = Done',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `palets`
--

CREATE TABLE `palets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cpp_detail_id` bigint(20) NOT NULL COMMENT 'connected to cpp detail tabel',
  `palet` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `jumlah_box` smallint(6) DEFAULT NULL,
  `jumlah_pack` smallint(6) DEFAULT NULL,
  `analisa_mikro_30_status` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `analisa_mikro_55_status` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bar_number` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bar_status` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bar_note` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `palets`
--

INSERT INTO `palets` (`id`, `cpp_detail_id`, `palet`, `start`, `end`, `jumlah_box`, `jumlah_pack`, `analisa_mikro_30_status`, `analisa_mikro_55_status`, `bar_number`, `bar_status`, `bar_note`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'P01', '2020-06-22 21:46:21', '2020-06-22 22:22:35', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:29:34', '2020-06-28 02:56:22', NULL),
(2, 1, 'P02', '2020-06-22 22:22:35', '2020-06-22 22:49:05', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:29:37', '2020-06-28 02:56:32', NULL),
(3, 1, 'P03', '2020-06-22 22:49:05', '2020-06-22 23:15:30', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:29:39', '2020-06-28 02:56:37', NULL),
(4, 1, 'P04', '2020-06-22 23:15:30', '2020-06-22 23:50:11', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:29:41', '2020-06-28 02:56:40', NULL),
(5, 1, 'P05', '2020-06-22 23:50:11', '2020-06-23 00:27:21', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:29:43', '2020-06-28 02:56:43', NULL),
(6, 1, 'P06', '2020-06-23 00:27:21', '2020-06-23 01:01:36', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:29:45', '2020-06-28 02:56:53', NULL),
(7, 1, 'P07', '2020-06-23 01:01:36', '2020-06-23 01:28:10', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:29:46', '2020-06-28 02:56:57', NULL),
(8, 1, 'P08', '2020-06-23 01:28:10', '2020-06-23 01:59:40', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:29:48', '2020-06-28 02:57:06', NULL),
(9, 1, 'P09', '2020-06-23 01:59:40', '2020-06-23 02:28:31', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:29:49', '2020-06-28 02:57:09', NULL),
(10, 1, 'P10', '2020-06-23 02:28:31', '2020-06-23 02:55:38', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:29:51', '2020-06-28 02:57:13', NULL),
(11, 1, 'P11', '2020-06-23 02:55:38', '2020-06-23 03:25:04', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:29:55', '2020-06-28 02:57:16', NULL),
(12, 1, 'P12', '2020-06-23 03:25:04', '2020-06-23 04:02:50', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:29:57', '2020-06-28 02:57:19', NULL),
(13, 1, 'P13', '2020-06-23 04:02:50', '2020-06-23 04:29:31', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:41:17', '2020-06-28 02:57:26', NULL),
(14, 1, 'P14', '2020-06-23 04:29:31', '2020-06-23 04:55:50', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:41:18', '2020-06-28 02:57:31', NULL),
(15, 1, 'P15', '2020-06-23 04:55:50', '2020-06-23 05:22:13', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:41:21', '2020-06-28 02:57:34', NULL),
(16, 1, 'P16', '2020-06-23 05:22:13', '2020-06-23 05:55:50', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:41:26', '2020-06-28 02:57:38', NULL),
(17, 1, 'P17', '2020-06-23 05:55:50', '2020-06-23 06:22:57', 140, 3360, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:41:27', '2020-06-28 02:57:42', NULL),
(18, 1, 'P18', '2020-06-23 06:22:57', '2020-06-23 06:32:55', 52, 1248, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-06-28 02:41:29', '2020-06-28 02:57:46', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `palet_ppqs`
--

CREATE TABLE `palet_ppqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ppq_id` bigint(20) NOT NULL COMMENT 'connected to ppq table',
  `palet_id` bigint(20) NOT NULL COMMENT 'connected to palet table',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `palet_ppqs`
--

INSERT INTO `palet_ppqs` (`id`, `ppq_id`, `palet_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 1, 5, 1, NULL, NULL, '2020-06-28 03:03:41', '2020-06-28 03:03:41', NULL),
(18, 1, 6, 1, NULL, NULL, '2020-06-28 03:03:41', '2020-06-28 03:03:41', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppqs`
--

CREATE TABLE `ppqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rpd_filling_detail_pi_id` bigint(20) DEFAULT NULL COMMENT 'connected to table rpd filling detail pi untuk patokan trigger pembuatan PPQ pada event OK setelah #OK',
  `cpp_head_id` bigint(20) DEFAULT NULL COMMENT 'connected to table cpphead',
  `kategori_ppq_id` bigint(20) DEFAULT NULL COMMENT 'connected to table kategori_ppq',
  `nomor_ppq` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ppq_date` date NOT NULL,
  `jam_awal_ppq` datetime NOT NULL,
  `jam_akhir_ppq` datetime NOT NULL,
  `jumlah_pack` int(11) NOT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_titik_ppq` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_akhir` enum('0','1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = new , 1 = on progress , 2 = done,3 = on progress rkj, 4 = Done RKJ , 5, Draft PPQ ',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ppqs`
--

INSERT INTO `ppqs` (`id`, `rpd_filling_detail_pi_id`, `cpp_head_id`, `kategori_ppq_id`, `nomor_ppq`, `ppq_date`, `jam_awal_ppq`, `jam_akhir_ppq`, `jumlah_pack`, `alasan`, `detail_titik_ppq`, `status_akhir`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 19, NULL, 2, '001/PPQ/VI/2020', '2020-06-28', '2020-06-23 00:10:19', '2020-06-23 00:30:00', 70, 'Overlapnya under spek', 'Dari jam sekian sampe jam sekian', '0', 1, 1, NULL, '2020-06-28 02:18:53', '2020-06-28 03:07:40', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `preventive_actions`
--

CREATE TABLE `preventive_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follow_up_ppq_id` bigint(20) DEFAULT NULL COMMENT 'connected to table follow up ppq',
  `follow_up_rkj_id` bigint(20) DEFAULT NULL COMMENT 'connected to table follow up rkj',
  `preventive_action` text COLLATE utf8mb4_unicode_ci COMMENT 'diisi oleh tim eng atau qc tahanan',
  `due_date_preventive_action` date DEFAULT NULL COMMENT 'ini diinput oleh qc tahanan dan engineering',
  `pic_preventive_action` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'diinput oleh qc tahanan dan enginerring dan QA',
  `status_preventive_action` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = on progress , 1 = done | diinput oleh qc tahanan or enginerring',
  `verifikasi_preventive_action` text COLLATE utf8mb4_unicode_ci COMMENT 'diisi oleh tim eng atau qc tahanan',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `psrs`
--

CREATE TABLE `psrs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wo_number_id` bigint(20) NOT NULL COMMENT 'connected to wo_number table',
  `psr_number` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `psr_qty` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `psr_status` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '  0 = draft psr, 1 = ready to print, 2 = On Progress Penyelia, 3 = Closed By penyelia ',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rkjs`
--

CREATE TABLE `rkjs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ppq_id` bigint(20) DEFAULT NULL COMMENT 'connect to ppq_table',
  `nomor_rkj` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rkj_date` date NOT NULL,
  `status_akhir` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = new , 1 = on progress , 2 = done',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rpd_filling_detail_at_events`
--

CREATE TABLE `rpd_filling_detail_at_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rpd_filling_head_id` bigint(20) NOT NULL COMMENT 'Connected to rpd filling head table',
  `wo_number_id` bigint(20) NOT NULL COMMENT 'Connected to Wo Number table',
  `filling_machine_id` bigint(20) NOT NULL COMMENT 'connected to filling machine head',
  `filling_sampel_code_id` bigint(20) NOT NULL COMMENT 'connected to filling sampel code table',
  `verifier_id` bigint(20) DEFAULT NULL COMMENT 'connected to user  table',
  `palet_id` bigint(20) DEFAULT NULL COMMENT 'connected to palet table',
  `filling_date` date NOT NULL,
  `filling_time` time NOT NULL,
  `ls_sa_sealing_quality` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ls_sa_proportion` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sideway_sealing_alignment` double(4,2) DEFAULT NULL,
  `overlap` double(5,2) DEFAULT NULL,
  `package_length` double(6,2) DEFAULT NULL,
  `paper_splice_sealing_quality` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_kk` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_md` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ls_sa_sealing_quality_strip` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ls_short_stop_quality` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sa_short_stop_quality` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `status_akhir` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verifikasi` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan_verifikasi` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rpd_filling_detail_pis`
--

CREATE TABLE `rpd_filling_detail_pis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rpd_filling_head_id` bigint(20) NOT NULL COMMENT 'Connected to rpd filling head table',
  `wo_number_id` bigint(20) NOT NULL COMMENT 'Connected to Wo Number table',
  `filling_machine_id` bigint(20) NOT NULL COMMENT 'connected to filling machine head',
  `filling_sampel_code_id` bigint(20) NOT NULL COMMENT 'connected to filling sampel code table',
  `filling_date` date NOT NULL,
  `filling_time` time NOT NULL,
  `berat_kanan` double(6,2) NOT NULL,
  `berat_kiri` double(6,2) NOT NULL,
  `overlap` double(4,2) DEFAULT NULL,
  `ls_sa_proportion` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume_kanan` int(11) DEFAULT NULL,
  `volume_kiri` int(11) DEFAULT NULL,
  `airgap` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ts_accurate_kanan` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ts_accurate_kiri` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ls_accurate` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sa_accurate` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surface_check` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinching` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strip_folding` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konduktivity_kanan` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konduktivity_kiri` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `design_kanan` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `design_kiri` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dye_test` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residu_h2o2` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prod_code_and_no_md` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correction` text COLLATE utf8mb4_unicode_ci,
  `dissolving_test` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_akhir` enum('OK','#OK') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rpd_filling_detail_pis`
--

INSERT INTO `rpd_filling_detail_pis` (`id`, `rpd_filling_head_id`, `wo_number_id`, `filling_machine_id`, `filling_sampel_code_id`, `filling_date`, `filling_time`, `berat_kanan`, `berat_kiri`, `overlap`, `ls_sa_proportion`, `volume_kanan`, `volume_kiri`, `airgap`, `ts_accurate_kanan`, `ts_accurate_kiri`, `ls_accurate`, `sa_accurate`, `surface_check`, `pinching`, `strip_folding`, `konduktivity_kanan`, `konduktivity_kiri`, `design_kanan`, `design_kiri`, `dye_test`, `residu_h2o2`, `prod_code_and_no_md`, `correction`, `dissolving_test`, `status_akhir`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, '2020-06-22', '21:46:00', 221.44, 222.46, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-06-28 00:57:49', '2020-06-28 01:51:58', NULL),
(2, 1, 1, 1, 8, '2020-06-22', '21:49:44', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 00:58:18', '2020-06-28 00:58:18', NULL),
(3, 1, 1, 1, 13, '2020-06-22', '21:52:18', 223.87, 221.65, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-06-28 00:58:55', '2020-06-28 01:55:40', NULL),
(4, 1, 1, 1, 8, '2020-06-22', '22:08:41', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 00:59:24', '2020-06-28 00:59:24', NULL),
(5, 1, 1, 1, 13, '2020-06-22', '22:15:50', 220.96, 223.96, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-06-28 01:01:07', '2020-06-28 01:57:12', NULL),
(6, 1, 1, 1, 20, '2020-06-22', '22:30:00', 222.22, 223.43, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-06-28 01:01:45', '2020-06-28 01:59:58', NULL),
(7, 1, 1, 1, 19, '2020-06-22', '22:45:05', 222.00, 223.48, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:02:28', '2020-06-28 01:02:28', NULL),
(8, 1, 1, 1, 20, '2020-06-22', '23:00:45', 223.73, 222.09, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:03:34', '2020-06-28 01:03:34', NULL),
(9, 1, 1, 1, 19, '2020-06-22', '23:15:05', 221.54, 222.34, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:04:32', '2020-06-28 01:04:32', NULL),
(10, 1, 1, 1, 20, '2020-06-22', '23:30:00', 221.88, 223.56, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:05:14', '2020-06-28 01:05:14', NULL),
(11, 1, 1, 1, 8, '2020-06-22', '23:35:46', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:05:44', '2020-06-28 01:05:44', NULL),
(12, 1, 1, 1, 13, '2020-06-22', '23:43:50', 221.70, 222.57, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:06:25', '2020-06-28 01:06:25', NULL),
(13, 1, 1, 1, 19, '2020-06-22', '23:45:00', 222.01, 223.09, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:07:31', '2020-06-28 01:07:31', NULL),
(14, 1, 1, 1, 20, '2020-06-23', '00:00:00', 222.26, 223.81, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:08:14', '2020-06-28 01:08:14', NULL),
(15, 1, 1, 1, 2, '2020-06-23', '00:06:09', 222.23, 223.63, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:09:12', '2020-06-28 01:09:12', NULL),
(16, 1, 1, 1, 4, '2020-06-23', '00:06:16', 222.26, 223.16, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:09:45', '2020-06-28 01:09:45', NULL),
(17, 1, 1, 1, 8, '2020-06-23', '00:10:19', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:10:11', '2020-06-28 01:10:11', NULL),
(18, 1, 1, 1, 13, '2020-06-23', '00:19:53', 221.27, 222.54, 3.20, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'Overlap underspek', NULL, '#OK', 1, 1, NULL, '2020-06-28 01:10:51', '2020-06-28 02:14:11', NULL),
(19, 1, 1, 1, 20, '2020-06-23', '00:30:00', 221.54, 223.21, 3.60, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-28 01:11:24', '2020-06-28 02:14:53', NULL),
(20, 1, 1, 1, 10, '2020-06-23', '00:33:15', 221.48, 223.07, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:12:03', '2020-06-28 01:12:03', NULL),
(21, 1, 1, 1, 16, '2020-06-23', '00:41:06', 221.39, 222.87, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:12:38', '2020-06-28 01:12:38', NULL),
(22, 1, 1, 1, 19, '2020-06-23', '00:45:16', 221.35, 222.85, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:13:20', '2020-06-28 01:13:20', NULL),
(23, 1, 1, 1, 3, '2020-06-23', '00:53:26', 222.46, 223.32, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:15:20', '2020-06-28 01:15:20', NULL),
(24, 1, 1, 1, 5, '2020-06-23', '00:53:34', 223.44, 221.92, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:16:28', '2020-06-28 01:16:28', NULL),
(25, 1, 1, 1, 20, '2020-06-23', '01:00:25', 223.03, 221.57, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:17:03', '2020-06-28 01:17:03', NULL),
(26, 1, 1, 1, 19, '2020-06-23', '01:15:04', 221.89, 223.13, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:17:36', '2020-06-28 01:17:36', NULL),
(27, 1, 1, 1, 20, '2020-06-23', '01:30:00', 221.72, 221.80, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:18:25', '2020-06-28 01:18:25', NULL),
(28, 1, 1, 1, 19, '2020-06-23', '01:46:30', 221.46, 223.24, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:19:06', '2020-06-28 01:19:06', NULL),
(29, 1, 1, 1, 12, '2020-06-23', '01:55:15', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:20:26', '2020-06-28 01:20:26', NULL),
(30, 1, 1, 1, 17, '2020-06-23', '01:57:46', 221.35, 221.71, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:21:02', '2020-06-28 01:21:02', NULL),
(31, 1, 1, 1, 2, '2020-06-23', '01:58:42', 222.35, 223.61, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:22:04', '2020-06-28 01:22:04', NULL),
(32, 1, 1, 1, 4, '2020-06-23', '01:58:50', 222.02, 222.04, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:22:34', '2020-06-28 01:22:34', NULL),
(33, 1, 1, 1, 20, '2020-06-23', '02:00:59', 223.37, 221.93, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:23:10', '2020-06-28 01:23:10', NULL),
(34, 1, 1, 1, 8, '2020-06-23', '02:14:58', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:23:49', '2020-06-28 01:23:49', NULL),
(35, 1, 1, 1, 13, '2020-06-23', '02:19:33', 221.59, 223.16, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:24:33', '2020-06-28 01:24:33', NULL),
(36, 1, 1, 1, 20, '2020-06-23', '02:30:00', 222.00, 223.69, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:25:07', '2020-06-28 01:25:07', NULL),
(37, 1, 1, 1, 19, '2020-06-23', '02:45:00', 222.25, 223.57, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:25:38', '2020-06-28 01:25:38', NULL),
(38, 1, 1, 1, 20, '2020-06-23', '03:00:00', 223.20, 222.20, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:26:14', '2020-06-28 01:26:14', NULL),
(39, 1, 1, 1, 8, '2020-06-23', '03:03:32', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:26:40', '2020-06-28 01:26:40', NULL),
(40, 1, 1, 1, 13, '2020-06-23', '03:06:07', 221.93, 223.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:27:13', '2020-06-28 01:27:13', NULL),
(41, 1, 1, 1, 3, '2020-06-23', '03:09:36', 223.37, 222.12, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:28:01', '2020-06-28 01:28:01', NULL),
(42, 1, 1, 1, 5, '2020-06-23', '03:09:23', 222.23, 223.38, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:28:40', '2020-06-28 01:28:40', NULL),
(43, 1, 1, 1, 19, '2020-06-23', '03:15:00', 223.41, 221.96, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:29:15', '2020-06-28 01:29:15', NULL),
(44, 1, 1, 1, 20, '2020-06-23', '03:30:00', 221.99, 223.75, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:29:46', '2020-06-28 01:29:46', NULL),
(45, 1, 1, 1, 10, '2020-06-23', '03:34:55', 221.48, 223.32, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:30:19', '2020-06-28 01:30:19', NULL),
(46, 1, 1, 1, 16, '2020-06-23', '03:45:59', 221.11, 222.67, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:30:54', '2020-06-28 01:30:54', NULL),
(47, 1, 1, 1, 2, '2020-06-23', '03:51:51', 223.03, 223.05, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:31:22', '2020-06-28 01:31:22', NULL),
(48, 1, 1, 1, 4, '2020-06-23', '03:51:58', 223.32, 222.25, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:32:00', '2020-06-28 01:32:00', NULL),
(49, 1, 1, 1, 19, '2020-06-23', '04:00:00', 223.35, 222.14, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, 1, '2020-06-28 01:32:24', '2020-06-28 01:33:03', '2020-06-28 01:33:03'),
(50, 1, 1, 2, 22, '2020-06-23', '15:33:21', 220.00, 200.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, 1, '2020-06-28 01:33:33', '2020-06-28 01:35:51', '2020-06-28 01:35:51'),
(51, 1, 1, 1, 20, '2020-06-23', '04:00:00', 221.46, 223.66, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:36:43', '2020-06-28 01:36:43', NULL),
(52, 1, 1, 1, 19, '2020-06-23', '04:15:00', 221.46, 223.15, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:37:15', '2020-06-28 01:37:15', NULL),
(53, 1, 1, 1, 20, '2020-06-23', '04:30:00', 221.15, 223.50, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:37:48', '2020-06-28 01:37:48', NULL),
(54, 1, 1, 1, 19, '2020-06-23', '04:45:10', 221.96, 223.57, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:38:20', '2020-06-28 01:38:20', NULL),
(55, 1, 1, 1, 20, '2020-06-23', '05:00:00', 221.95, 223.18, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:40:25', '2020-06-28 01:40:25', NULL),
(56, 1, 1, 1, 19, '2020-06-23', '05:16:02', 223.38, 222.28, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:41:00', '2020-06-28 01:41:00', NULL),
(57, 1, 1, 1, 20, '2020-06-23', '05:30:00', 221.80, 222.35, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:41:35', '2020-06-28 01:41:35', NULL),
(58, 1, 1, 1, 8, '2020-06-23', '05:39:30', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:41:59', '2020-06-28 01:41:59', NULL),
(59, 1, 1, 1, 13, '2020-06-23', '05:46:59', 222.89, 221.77, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:42:36', '2020-06-28 01:42:36', NULL),
(60, 1, 1, 1, 20, '2020-06-23', '06:00:00', 223.62, 221.61, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:43:12', '2020-06-28 01:43:12', NULL),
(61, 1, 1, 1, 2, '2020-06-23', '06:12:32', 223.85, 222.70, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:43:51', '2020-06-28 01:43:51', NULL),
(62, 1, 1, 1, 4, '2020-06-23', '06:12:40', 222.13, 223.03, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:44:24', '2020-06-28 01:44:24', NULL),
(63, 1, 1, 1, 19, '2020-06-23', '06:15:00', 222.69, 223.96, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:44:57', '2020-06-28 01:44:57', NULL),
(64, 1, 1, 1, 6, '2020-06-23', '06:19:50', 221.50, 222.90, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:45:32', '2020-06-28 01:45:32', NULL),
(65, 1, 1, 1, 7, '2020-06-23', '06:19:56', 221.50, 222.90, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:46:07', '2020-06-28 01:46:07', NULL),
(66, 1, 1, 1, 19, '2020-06-23', '06:30:15', 222.80, 221.47, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:48:10', '2020-06-28 01:48:10', NULL),
(67, 1, 1, 1, 18, '2020-06-23', '06:33:00', 223.00, 222.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 01:48:44', '2020-06-28 01:48:44', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rpd_filling_heads`
--

CREATE TABLE `rpd_filling_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL COMMENT 'connected to product table',
  `start_filling_date` date NOT NULL,
  `rpd_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = On Progress, 1 = Closed',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rpd_filling_heads`
--

INSERT INTO `rpd_filling_heads` (`id`, `product_id`, `start_filling_date`, `rpd_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 20, '2020-06-28', '1', 1, 1, NULL, '2020-06-28 00:55:50', '2020-06-28 03:08:59', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wo_numbers`
--

CREATE TABLE `wo_numbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) NOT NULL COMMENT 'connected to plan table',
  `product_id` bigint(20) NOT NULL COMMENT 'connected to product table',
  `rpd_filling_head_id` bigint(20) DEFAULT NULL COMMENT 'connected to rpd filling head table',
  `cpp_head_id` bigint(20) DEFAULT NULL COMMENT 'connected to cpp head table',
  `wo_number` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `production_plan_date` date NOT NULL,
  `production_realisation_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `fillpack_date` date DEFAULT NULL,
  `plan_batch_size` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_batch_size` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completion_date` date DEFAULT NULL,
  `explanation_1` text COLLATE utf8mb4_unicode_ci,
  `explanation_2` text COLLATE utf8mb4_unicode_ci,
  `explanation_3` text COLLATE utf8mb4_unicode_ci,
  `formula_revision` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wo_status` enum('0','1','2','3','4','5','6') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '	0 = Pending ( WIP Mixing ), 1 = On Progress Mixing , 2 = WIP Fillpack , 3 = In Progress Fillpack , 4 = Done Fillpack ( Waiting For Close ) , 5 = Closed, 6 = Canceled',
  `upload_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = Draft, 1 = close',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `wo_numbers`
--

INSERT INTO `wo_numbers` (`id`, `plan_id`, `product_id`, `rpd_filling_head_id`, `cpp_head_id`, `wo_number`, `production_plan_date`, `production_realisation_date`, `expired_date`, `fillpack_date`, `plan_batch_size`, `actual_batch_size`, `completion_date`, `explanation_1`, `explanation_2`, `explanation_3`, `formula_revision`, `wo_status`, `upload_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 20, 1, 1, 'G2006214008', '2020-06-22', '2020-06-22', '2021-06-22', '2020-06-28', '9969.25', NULL, NULL, '-', '-', '-', '-', '4', '1', 1, 1, NULL, NULL, '2020-06-28 03:10:22', NULL),
(2, 3, 13, NULL, NULL, 'G2006214004', '2020-06-22', NULL, NULL, NULL, '9956.565', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AR/34.44)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 00:54:52', NULL),
(3, 3, 13, NULL, NULL, 'G2006214010', '2020-06-22', NULL, NULL, NULL, '9956.565', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AR/34.44)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 00:54:52', NULL),
(4, 3, 31, NULL, NULL, 'G2006700011', '2020-06-23', NULL, NULL, NULL, '2196.15', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE LOW FAT HB YOGURT ( 3.7/WPHB03)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 00:54:53', NULL),
(5, 3, 30, NULL, NULL, 'G2006700010', '2020-06-23', NULL, NULL, NULL, '6625.45', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE LOW FAT HB YOGURT ORIGINAL 01-00 ( 1.2/WPHB02)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 00:54:53', NULL),
(6, 3, 9, NULL, NULL, 'G2006708009', '2020-06-23', NULL, NULL, NULL, '6660', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT WHOLESOME ORIGINAL ( 2/FGHB02)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 00:54:53', NULL),
(7, 3, 4, NULL, NULL, 'G2006708007', '2020-06-23', NULL, NULL, NULL, '5887.26', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HB GREEK CLASSIC 24X200ML (SENTUL) ( 0.5/FGHB09)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 00:54:54', NULL),
(8, 3, 1, NULL, NULL, 'G2006706002', '2020-06-24', NULL, NULL, NULL, '10048.24', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT BLACKCURRANT ( 3.3/FGHB03)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 00:54:54', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `analisa_kimias`
--
ALTER TABLE `analisa_kimias`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `analisa_mikro`
--
ALTER TABLE `analisa_mikro`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `analisa_mikro_details`
--
ALTER TABLE `analisa_mikro_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `analisa_mikro_resampling`
--
ALTER TABLE `analisa_mikro_resampling`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `corrective_actions`
--
ALTER TABLE `corrective_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cpp_details`
--
ALTER TABLE `cpp_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cpp_heads`
--
ALTER TABLE `cpp_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `energy_monitorings`
--
ALTER TABLE `energy_monitorings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `energy_usages`
--
ALTER TABLE `energy_usages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `follow_up_ppqs`
--
ALTER TABLE `follow_up_ppqs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `follow_up_rkjs`
--
ALTER TABLE `follow_up_rkjs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `palets`
--
ALTER TABLE `palets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `palet_ppqs`
--
ALTER TABLE `palet_ppqs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ppqs`
--
ALTER TABLE `ppqs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `preventive_actions`
--
ALTER TABLE `preventive_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `psrs`
--
ALTER TABLE `psrs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rkjs`
--
ALTER TABLE `rkjs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rpd_filling_detail_at_events`
--
ALTER TABLE `rpd_filling_detail_at_events`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rpd_filling_detail_pis`
--
ALTER TABLE `rpd_filling_detail_pis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rpd_filling_heads`
--
ALTER TABLE `rpd_filling_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wo_numbers`
--
ALTER TABLE `wo_numbers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `analisa_kimias`
--
ALTER TABLE `analisa_kimias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `analisa_mikro`
--
ALTER TABLE `analisa_mikro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `analisa_mikro_details`
--
ALTER TABLE `analisa_mikro_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `analisa_mikro_resampling`
--
ALTER TABLE `analisa_mikro_resampling`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `corrective_actions`
--
ALTER TABLE `corrective_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cpp_details`
--
ALTER TABLE `cpp_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `cpp_heads`
--
ALTER TABLE `cpp_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `energy_monitorings`
--
ALTER TABLE `energy_monitorings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `energy_usages`
--
ALTER TABLE `energy_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `follow_up_ppqs`
--
ALTER TABLE `follow_up_ppqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `follow_up_rkjs`
--
ALTER TABLE `follow_up_rkjs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `palets`
--
ALTER TABLE `palets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `palet_ppqs`
--
ALTER TABLE `palet_ppqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `ppqs`
--
ALTER TABLE `ppqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `preventive_actions`
--
ALTER TABLE `preventive_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `psrs`
--
ALTER TABLE `psrs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rkjs`
--
ALTER TABLE `rkjs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rpd_filling_detail_at_events`
--
ALTER TABLE `rpd_filling_detail_at_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rpd_filling_detail_pis`
--
ALTER TABLE `rpd_filling_detail_pis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `rpd_filling_heads`
--
ALTER TABLE `rpd_filling_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `wo_numbers`
--
ALTER TABLE `wo_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
