-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Agu 2020 pada 11.15
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

--
-- Dumping data untuk tabel `analisa_kimias`
--

INSERT INTO `analisa_kimias` (`id`, `cpp_head_id`, `ppq_id`, `ts_awal_1`, `ts_awal_2`, `ts_tengah_1`, `ts_tengah_2`, `ts_akhir_1`, `ts_akhir_2`, `ts_awal_avg`, `ts_tengah_avg`, `ts_akhir_avg`, `ph_awal`, `ph_tengah`, `ph_akhir`, `visko_awal`, `visko_tengah`, `visko_akhir`, `sensori_awal`, `sensori_tengah`, `sensori_akhir`, `jam_filling_awal`, `jam_filling_tengah`, `jam_filling_akhir`, `ts_oven_awal`, `ts_oven_tengah`, `ts_oven_akhir`, `kode_batch_standar`, `progress_status`, `analisa_kimia_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 15.99, 15.99, 15.99, 16.00, 16.00, 16.00, 15.990, 16.000, 16.000, 6.79, 6.79, 6.79, '6.16', '6', '5.72', 'OK', 'OK', 'OK', '2020-07-27 18:17:25', '2020-07-27 21:16:54', '2020-07-28 01:40:38', NULL, NULL, NULL, 'tc0109a', 1, 1, 1, 1, NULL, '2020-07-27 23:06:48', '2020-07-27 23:38:02', NULL);

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
  `corrective_action` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ini diinput oleh qc tahanan dan engineering',
  `due_date_corrective_action` date DEFAULT NULL COMMENT 'ini diinput oleh qc tahanan dan engineering',
  `pic_corrective_action` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'diinput oleh qc tahanan dan enginerring',
  `status_corrective_action` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = on progress , 1 = done | diinput oleh qc tahanan or enginerring',
  `verifikasi_corrective_action` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ini diinput oleh qc tahanan dan engineering',
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
(1, 1, 1, 1, 'KC2707A', 35, NULL, NULL, '2020-07-26 17:01:32', '2020-07-26 17:01:32', NULL),
(2, 1, 1, 2, 'KB2707A', 35, NULL, NULL, '2020-07-26 17:01:36', '2020-07-26 17:01:36', NULL),
(25, 2, 2, 2, 'KB2707B', 35, NULL, NULL, '2020-07-27 02:20:02', '2020-07-27 02:20:02', NULL);

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
(1, 20, 1, NULL, '2020-07-28', '1', 1, 1, NULL, '2020-07-27 21:11:49', '2020-07-27 23:06:48', NULL),
(2, 13, NULL, NULL, '2020-07-28', '0', 1, NULL, NULL, '2020-07-28 00:56:44', '2020-07-28 00:56:44', NULL);

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `follow_up_ppqs`
--

CREATE TABLE `follow_up_ppqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ppq_id` bigint(20) NOT NULL,
  `jumlah_metode_sampling` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'column yang diinput oleh params Qc Release',
  `hasil_analisa` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'column yang diinput qc release jika status PI | diinput oleh qc tahanan as hasil evaluasi',
  `status_produk` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = reject , 1 = release , 2 = relase partial | diinput oleh qc release or qc tahanan || status_produk',
  `tanggal_status_ppq` date DEFAULT NULL,
  `nomor_lbd` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'column yang diinput qc release jika status PI',
  `root_cause` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ini diinput oleh tim engineering',
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
  `dugaan_penyebab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'column yang  diisi oleh RnD',
  `hasil_analisa` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'column yang  diisi oleh RnD',
  `status_produk` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = reject , 1 = release , 2 = relase partial ',
  `tanggal_status_produk` date DEFAULT NULL,
  `status_follow_up_rkj` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = on progress , 1 = close ',
  `nomor_rkp` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'diinput oleh tim QA',
  `hasil_investigasi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'diisi oleh tim QA',
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
  `bar_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(301, 1, 'P01', '2020-07-27 18:19:44', '2020-07-27 19:17:19', 72, 1728, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 17:01:32', '2020-07-26 17:30:19', NULL),
(302, 2, 'P01', '2020-07-27 18:17:28', '2020-07-27 18:41:13', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 17:01:36', '2020-07-26 17:02:13', NULL),
(303, 2, 'P02', '2020-07-27 18:41:13', '2020-07-27 19:02:28', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 17:02:13', '2020-07-26 17:02:51', NULL),
(304, 2, 'P03', '2020-07-27 19:02:28', '2020-07-27 19:31:13', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 17:02:52', '2020-07-26 17:03:52', NULL),
(305, 2, 'P04', '2020-07-27 19:31:13', '2020-07-27 19:56:21', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 17:03:52', '2020-07-26 17:04:22', NULL),
(306, 2, 'P05', '2020-07-27 19:56:21', '2020-07-28 20:29:13', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 20:05:19', '2020-07-26 20:09:39', NULL),
(307, 2, 'P06', '2020-07-27 17:05:56', '2020-07-28 20:51:12', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-26 20:05:56', '2020-07-26 20:12:27', '2020-07-26 20:12:27'),
(308, 2, 'P07', '2020-07-27 17:06:25', '2020-07-28 21:18:05', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-26 20:06:25', '2020-07-26 20:12:24', '2020-07-26 20:12:24'),
(309, 2, 'P08', '2020-07-27 17:06:47', '2020-07-28 21:56:45', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-26 20:06:47', '2020-07-26 20:12:21', '2020-07-26 20:12:21'),
(310, 2, 'P09', '2020-07-27 17:07:08', '2020-07-28 22:25:44', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-26 20:07:08', '2020-07-26 20:12:18', '2020-07-26 20:12:18'),
(311, 2, 'P10', '2020-07-27 17:07:34', '2020-07-28 22:48:15', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-26 20:07:34', '2020-07-26 20:12:14', '2020-07-26 20:12:14'),
(312, 2, 'P11', '2020-07-27 17:07:56', '2020-07-28 23:10:42', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-26 20:07:56', '2020-07-26 20:12:11', '2020-07-26 20:12:11'),
(313, 2, 'P12', '2020-07-27 17:08:24', '2020-07-28 23:33:05', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-26 20:08:24', '2020-07-26 20:12:06', '2020-07-26 20:12:06'),
(314, 2, 'P13', '2020-07-27 17:08:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-26 20:08:43', '2020-07-26 20:09:06', '2020-07-26 20:09:06'),
(315, 2, 'P13', '2020-07-27 17:10:03', '2020-07-28 23:55:42', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-26 20:10:03', '2020-07-26 20:12:01', '2020-07-26 20:12:01'),
(316, 2, 'P06', '2020-07-27 17:12:36', '2020-07-28 20:51:12', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-26 20:12:36', '2020-07-26 20:13:29', '2020-07-26 20:13:29'),
(317, 2, 'P07', '2020-07-27 17:13:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-26 20:13:04', '2020-07-26 20:13:20', '2020-07-26 20:13:20'),
(318, 2, 'P06', '2020-07-27 17:23:25', '2020-07-27 20:51:12', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 20:23:25', '2020-07-26 20:24:57', NULL),
(319, 2, 'P07', '2020-07-27 20:51:12', '2020-07-27 21:18:05', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 20:24:59', '2020-07-26 20:25:47', NULL),
(320, 2, 'P08', '2020-07-27 21:18:05', '2020-07-27 21:56:45', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 20:25:48', '2020-07-26 20:26:30', NULL),
(321, 2, 'P09', '2020-07-27 21:56:45', '2020-07-27 22:25:44', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 20:26:31', '2020-07-26 20:27:23', NULL),
(322, 2, 'P10', '2020-07-27 22:25:44', '2020-07-27 22:48:15', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 20:27:24', '2020-07-26 20:28:12', NULL),
(323, 2, 'P11', '2020-07-27 22:48:15', '2020-07-27 23:10:42', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 20:28:14', '2020-07-26 20:29:03', NULL),
(324, 2, 'P12', '2020-07-27 23:10:42', '2020-07-27 23:33:05', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 20:29:05', '2020-07-26 20:29:49', NULL),
(325, 2, 'P13', '2020-07-27 23:33:05', '2020-07-27 23:55:42', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 20:29:51', '2020-07-26 20:30:25', NULL),
(326, 2, 'P14', '2020-07-27 23:55:42', '2020-07-28 00:18:28', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 20:30:27', '2020-07-26 20:31:25', NULL),
(327, 2, 'P15', '2020-07-28 00:18:28', '2020-07-28 00:41:29', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 22:06:53', '2020-07-26 22:07:42', NULL),
(328, 2, 'P16', '2020-07-28 00:41:29', '2020-07-28 01:03:18', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 22:07:43', '2020-07-26 22:08:18', NULL),
(329, 2, 'P17', '2020-07-28 01:03:18', '2020-07-28 01:25:49', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 22:08:19', '2020-07-26 22:10:24', NULL),
(330, 2, 'P18', '2020-07-27 19:09:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-26 22:09:38', '2020-07-26 22:10:13', '2020-07-26 22:10:13'),
(331, 2, 'P18', '2020-07-28 01:25:49', '2020-07-28 01:40:32', 92, 2208, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-26 22:10:27', '2020-07-26 22:11:40', NULL),
(332, 25, 'P01', '2020-07-28 02:08:40', '2020-07-28 02:31:27', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 02:20:02', '2020-07-27 06:30:38', NULL),
(333, 25, 'P02', '2020-07-28 02:31:27', '2020-07-28 02:54:15', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:30:41', '2020-07-27 06:42:58', NULL),
(334, 25, 'P03', '2020-07-28 02:54:15', '2020-07-28 03:27:23', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:31:12', '2020-07-27 06:43:03', NULL),
(335, 25, 'P04', '2020-07-28 03:27:23', '2020-07-28 04:11:19', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:31:47', '2020-07-27 06:43:13', NULL),
(336, 25, 'P05', '2020-07-28 04:11:19', '2020-07-28 04:44:28', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:32:28', '2020-07-27 06:43:18', NULL),
(337, 25, 'P06', '2020-07-28 03:32:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-27 06:32:35', '2020-07-27 06:32:59', '2020-07-27 06:32:59'),
(338, 25, 'P06', '2020-07-28 04:44:28', '2020-07-28 05:21:30', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:33:14', '2020-07-27 06:43:20', NULL),
(339, 25, 'P07', '2020-07-28 05:21:30', '2020-07-28 05:44:17', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:33:55', '2020-07-27 06:43:20', NULL),
(340, 25, 'P08', '2020-07-28 05:44:17', '2020-07-28 06:27:54', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:34:41', '2020-07-27 06:44:28', NULL),
(341, 25, 'P09', '2020-07-28 03:35:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-27 06:35:21', '2020-07-27 06:36:14', '2020-07-27 06:36:14'),
(342, 25, 'P09', '2020-07-28 06:27:54', '2020-07-28 06:50:33', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:36:34', '2020-07-27 06:43:28', NULL),
(343, 25, 'P10', '2020-07-28 06:50:33', '2020-07-28 07:14:09', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:37:06', '2020-07-27 06:43:43', NULL),
(344, 25, 'P11', '2020-07-28 07:14:09', '2020-07-28 08:02:41', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:37:30', '2020-07-27 06:43:42', NULL),
(345, 25, 'P12', '2020-07-28 08:02:41', '2020-07-28 08:25:16', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:38:00', '2020-07-27 06:43:53', NULL),
(346, 25, 'P13', '2020-07-28 08:25:16', '2020-07-28 08:47:51', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:38:24', '2020-07-27 06:43:53', NULL),
(347, 25, 'P14', '2020-07-28 03:39:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-27 06:39:01', '2020-07-27 06:39:27', '2020-07-27 06:39:27'),
(348, 25, 'P15', '2020-07-28 03:39:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, 35, 35, '2020-07-27 06:39:02', '2020-07-27 06:39:21', '2020-07-27 06:39:21'),
(349, 25, 'P14', '2020-07-28 08:47:51', '2020-07-28 09:10:34', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:39:41', '2020-07-27 06:44:01', NULL),
(350, 25, 'P15', '2020-07-28 09:10:34', '2020-07-28 09:33:02', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:40:47', '2020-07-27 06:44:02', NULL),
(351, 25, 'P16', '2020-07-28 09:33:02', '2020-07-28 09:55:59', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:41:40', '2020-07-27 06:44:07', NULL),
(352, 25, 'P17', '2020-07-28 09:55:59', '2020-07-28 10:18:46', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:42:11', '2020-07-27 06:44:16', NULL),
(353, 25, 'P18', '2020-07-28 10:18:46', '2020-07-28 10:49:34', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 06:42:39', '2020-07-27 09:37:55', NULL),
(354, 25, 'P19', '2020-07-28 10:49:34', '2020-07-28 11:12:47', 140, 3360, NULL, NULL, NULL, NULL, NULL, 35, 35, NULL, '2020-07-27 09:37:55', '2020-07-27 09:38:30', NULL);

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `preventive_actions`
--

CREATE TABLE `preventive_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follow_up_ppq_id` bigint(20) DEFAULT NULL COMMENT 'connected to table follow up ppq',
  `follow_up_rkj_id` bigint(20) DEFAULT NULL COMMENT 'connected to table follow up rkj',
  `preventive_action` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'diisi oleh tim eng atau qc tahanan',
  `due_date_preventive_action` date DEFAULT NULL COMMENT 'ini diinput oleh qc tahanan dan engineering',
  `pic_preventive_action` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'diinput oleh qc tahanan dan enginerring dan QA',
  `status_preventive_action` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = on progress , 1 = done | diinput oleh qc tahanan or enginerring',
  `verifikasi_preventive_action` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'diisi oleh tim eng atau qc tahanan',
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
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psr_status` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '  0 = draft psr, 1 = ready to print, 2 = On Progress Penyelia, 3 = Closed By penyelia ',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `psrs`
--

INSERT INTO `psrs` (`id`, `wo_number_id`, `psr_number`, `psr_qty`, `note`, `psr_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, '001/PSR/FQC/VII/2020', '277', 'Sampel PSR QC', '2', 1, 1, NULL, '2020-07-27 21:48:11', '2020-07-27 21:59:42', NULL);

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
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_akhir` enum('OK','#OK','-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verifikasi` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan_verifikasi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rpd_filling_detail_at_events`
--

INSERT INTO `rpd_filling_detail_at_events` (`id`, `rpd_filling_head_id`, `wo_number_id`, `filling_machine_id`, `filling_sampel_code_id`, `verifier_id`, `palet_id`, `filling_date`, `filling_time`, `ls_sa_sealing_quality`, `ls_sa_proportion`, `sideway_sealing_alignment`, `overlap`, `package_length`, `paper_splice_sealing_quality`, `no_kk`, `no_md`, `ls_sa_sealing_quality_strip`, `ls_short_stop_quality`, `sa_short_stop_quality`, `keterangan`, `status_akhir`, `verifikasi`, `keterangan_verifikasi`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(30, 1, 1, 2, 23, NULL, 0, '2020-07-27', '23:24:02', 'OK', '40:60', 0.70, 16.00, 14.48, 'OK', NULL, NULL, NULL, NULL, NULL, NULL, '#OK', NULL, NULL, 88, 88, NULL, '2020-07-26 19:32:53', '2020-07-26 19:39:18', NULL),
(31, 1, 1, 2, 27, NULL, 316, '2020-07-28', '00:01:22', 'OK', '40:60', NULL, NULL, NULL, NULL, NULL, NULL, 'OK', NULL, NULL, NULL, 'OK', NULL, NULL, 88, 88, NULL, '2020-07-26 20:19:20', '2020-07-26 20:22:08', NULL),
(32, 1, 1, 2, 23, NULL, 316, '2020-07-28', '01:17:35', 'OK', '40:60', 0.20, 14.36, 115.30, 'OK', NULL, NULL, NULL, NULL, NULL, NULL, '#OK', NULL, NULL, 88, 88, NULL, '2020-07-26 21:24:17', '2020-07-26 21:31:37', NULL);

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
  `correction` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(684, 1, 1, 2, 22, '2020-07-27', '18:17:24', 222.60, 221.90, 4.16, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 14:29:52', '2020-07-26 14:30:08', NULL),
(685, 1, 1, 2, 41, '2020-07-27', '18:30:10', 222.96, 222.20, 4.36, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 14:30:21', '2020-07-26 14:30:36', NULL),
(686, 1, 1, 1, 1, '2020-07-27', '18:19:39', 220.80, 222.70, 4.26, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 14:31:10', '2020-07-26 14:31:36', NULL),
(687, 1, 1, 1, 8, '2020-07-27', '18:29:42', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 87, NULL, NULL, '2020-07-26 14:37:22', '2020-07-26 14:37:22', NULL),
(688, 1, 1, 1, 13, '2020-07-27', '18:30:18', 221.50, 221.20, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 14:37:39', '2020-07-26 14:37:50', NULL),
(689, 1, 1, 1, 8, '2020-07-27', '18:31:03', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 87, NULL, NULL, '2020-07-26 14:38:03', '2020-07-26 14:38:03', NULL),
(690, 1, 1, 1, 13, '2020-07-27', '18:33:24', 219.50, 220.40, 4.12, '40:60', 200, 198, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 14:38:23', '2020-07-26 14:39:10', NULL),
(691, 1, 1, 1, 8, '2020-07-27', '18:34:43', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 87, NULL, NULL, '2020-07-26 14:39:38', '2020-07-26 14:39:38', NULL),
(692, 1, 1, 2, 40, '2020-07-27', '18:45:00', 222.90, 222.00, 4.50, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 15:04:29', '2020-07-26 15:04:39', NULL),
(693, 1, 1, 2, 23, '2020-07-27', '18:53:09', 222.27, 222.37, 3.92, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 15:05:02', '2020-07-26 15:05:13', NULL),
(694, 1, 1, 2, 25, '2020-07-27', '18:53:15', 222.57, 221.58, 4.22, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 15:05:35', '2020-07-26 15:05:49', NULL),
(695, 1, 1, 2, 41, '2020-07-27', '19:00:00', 222.28, 222.82, 4.10, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 15:06:08', '2020-07-26 15:06:32', NULL),
(696, 1, 1, 1, 13, '2020-07-27', '18:56:20', 220.77, 222.76, 4.48, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 15:07:09', '2020-07-26 15:07:23', NULL),
(697, 1, 1, 1, 8, '2020-07-27', '18:56:52', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 87, NULL, NULL, '2020-07-26 15:07:36', '2020-07-26 15:07:36', NULL),
(698, 1, 1, 2, 40, '2020-07-27', '19:15:00', 223.50, 221.80, 3.92, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 15:19:16', '2020-07-26 15:19:27', NULL),
(699, 1, 1, 2, 29, '2020-07-27', '19:15:42', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 87, NULL, NULL, '2020-07-26 15:19:39', '2020-07-26 15:19:39', NULL),
(700, 1, 1, 1, 13, '2020-07-27', '19:16:48', 222.50, 222.70, 4.22, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 15:20:04', '2020-07-26 15:20:14', NULL),
(701, 1, 1, 1, 8, '2020-07-27', '19:17:22', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 87, NULL, NULL, '2020-07-26 15:20:26', '2020-07-26 15:20:26', NULL),
(702, 1, 1, 2, 34, '2020-07-27', '19:22:24', 222.80, 222.10, 4.06, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 15:47:37', '2020-07-26 15:47:48', NULL),
(703, 1, 1, 2, 41, '2020-07-27', '19:30:00', 222.02, 222.42, 3.89, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 15:48:02', '2020-07-26 15:48:21', NULL),
(704, 1, 1, 2, 40, '2020-07-27', '19:45:00', 222.10, 222.80, 4.22, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 15:49:40', '2020-07-26 16:22:27', NULL),
(705, 1, 1, 2, 41, '2020-07-27', '20:00:00', 222.68, 222.20, 3.98, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 16:22:44', '2020-07-26 16:22:53', NULL),
(706, 1, 1, 2, 29, '2020-07-27', '20:09:13', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 87, NULL, NULL, '2020-07-26 16:23:10', '2020-07-26 16:23:10', NULL),
(707, 1, 1, 2, 34, '2020-07-27', '20:20:05', 220.80, 221.50, 4.00, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 16:24:37', '2020-07-26 17:16:51', NULL),
(708, 1, 1, 2, 41, '2020-07-27', '20:30:00', 222.92, 222.23, 4.21, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 17:17:08', '2020-07-26 17:17:32', NULL),
(709, 1, 1, 2, 40, '2020-07-27', '20:45:00', 221.80, 222.40, 4.30, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 17:32:43', '2020-07-26 17:33:32', NULL),
(710, 1, 1, 2, 29, '2020-07-27', '20:57:51', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 87, NULL, NULL, '2020-07-26 17:33:00', '2020-07-26 17:33:00', NULL),
(711, 1, 1, 2, 34, '2020-07-27', '21:01:58', 222.35, 221.74, 4.20, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 17:34:10', '2020-07-26 17:34:39', NULL),
(712, 1, 1, 2, 23, '2020-07-27', '21:08:50', 223.00, 223.00, 4.30, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 17:37:18', '2020-07-26 17:38:24', NULL),
(713, 1, 1, 2, 25, '2020-07-27', '21:08:56', 222.22, 222.90, 4.30, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 17:37:45', '2020-07-26 17:39:17', NULL),
(714, 1, 1, 2, 40, '2020-07-27', '21:15:00', 222.80, 222.00, 4.10, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 17:38:06', '2020-07-26 17:58:53', NULL),
(715, 1, 1, 2, 27, '2020-07-27', '21:20:02', 222.70, 222.00, 4.48, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 18:00:42', '2020-07-26 18:00:58', NULL),
(716, 1, 1, 2, 28, '2020-07-27', '21:20:07', 222.10, 222.70, 4.16, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 18:01:19', '2020-07-26 18:01:46', NULL),
(717, 1, 1, 2, 29, '2020-07-27', '21:40:31', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 87, NULL, NULL, '2020-07-26 18:02:06', '2020-07-26 18:02:06', NULL),
(718, 1, 1, 2, 34, '2020-07-27', '21:55:52', 222.40, 222.00, 3.88, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 18:02:31', '2020-07-26 18:03:08', NULL),
(719, 1, 1, 2, 41, '2020-07-27', '22:00:00', 222.76, 223.24, 4.15, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 87, 87, NULL, '2020-07-26 18:02:55', '2020-07-26 18:03:25', NULL),
(720, 1, 1, 2, 29, '2020-07-27', '22:03:03', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 87, NULL, NULL, '2020-07-26 18:07:28', '2020-07-26 18:07:28', NULL),
(721, 1, 1, 2, 34, '2020-07-27', '22:09:20', 222.13, 222.06, 3.85, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 18:12:05', '2020-07-26 18:12:25', NULL),
(722, 1, 1, 2, 40, '2020-07-27', '22:15:00', 222.36, 222.81, 4.39, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 18:15:50', '2020-07-26 18:16:12', NULL),
(723, 1, 1, 2, 41, '2020-07-27', '22:30:00', 222.87, 222.23, 4.27, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 18:35:12', '2020-07-26 18:35:27', NULL),
(724, 1, 1, 2, 40, '2020-07-27', '22:45:00', 221.97, 221.75, 4.03, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 18:48:26', '2020-07-26 18:49:46', NULL),
(725, 1, 1, 2, 41, '2020-07-27', '23:00:00', 222.74, 222.40, 3.70, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 19:07:42', '2020-07-26 19:07:54', NULL),
(726, 1, 1, 2, 40, '2020-07-27', '23:15:04', 222.64, 221.83, 4.22, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 19:16:52', '2020-07-26 19:18:51', NULL),
(727, 1, 1, 2, 23, '2020-07-27', '23:24:02', 224.28, 223.11, 4.13, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 19:32:53', '2020-07-26 19:34:24', NULL),
(728, 1, 1, 2, 25, '2020-07-27', '23:24:10', 222.47, 221.78, 4.37, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 19:33:08', '2020-07-26 19:34:48', NULL),
(729, 1, 1, 2, 41, '2020-07-27', '23:30:00', 223.54, 222.00, 4.30, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 19:33:32', '2020-07-26 19:36:10', NULL),
(730, 1, 1, 2, 40, '2020-07-27', '23:45:00', 222.20, 222.91, 4.22, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 19:46:12', '2020-07-26 19:46:29', NULL),
(731, 1, 1, 2, 41, '2020-07-28', '00:00:00', 222.32, 222.67, 4.02, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 20:18:55', '2020-07-26 20:21:04', NULL),
(732, 1, 1, 2, 27, '2020-07-28', '00:01:22', 221.94, 222.62, 4.33, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 20:19:20', '2020-07-26 20:21:21', NULL),
(733, 1, 1, 2, 28, '2020-07-28', '00:02:00', 223.04, 222.60, 4.29, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 20:20:32', '2020-07-26 20:21:36', NULL),
(734, 1, 1, 2, 40, '2020-07-28', '00:15:01', 223.10, 222.35, 4.18, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 20:20:52', '2020-07-26 20:21:52', NULL),
(735, 1, 1, 2, 41, '2020-07-28', '00:30:00', 222.89, 221.87, 4.27, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 20:30:10', '2020-07-26 20:30:26', NULL),
(736, 1, 1, 2, 40, '2020-07-28', '00:45:00', 222.03, 222.52, 4.17, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 20:47:11', '2020-07-26 20:47:24', NULL),
(737, 1, 1, 2, 41, '2020-07-28', '01:00:00', 222.05, 222.72, 4.21, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 21:14:29', '2020-07-26 21:14:58', NULL),
(738, 1, 1, 2, 40, '2020-07-28', '01:15:00', 223.18, 222.27, 4.37, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 21:14:46', '2020-07-26 21:15:13', NULL),
(739, 1, 1, 2, 23, '2020-07-28', '01:17:35', 223.60, 222.69, 3.50, '40:60', 200, 200, 'OK', 'OK', '#OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'Block seal', NULL, '#OK', 88, 1, NULL, '2020-07-26 21:24:17', '2020-07-27 21:36:16', NULL),
(740, 1, 1, 2, 25, '2020-07-28', '01:17:42', 222.02, 222.64, 3.50, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 1, NULL, '2020-07-26 21:24:37', '2020-07-27 21:36:29', NULL),
(741, 1, 1, 2, 41, '2020-07-28', '01:30:00', 223.22, 221.86, 3.96, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 21:30:18', '2020-07-26 21:30:37', NULL),
(742, 1, 1, 2, 39, '2020-07-28', '01:40:37', 223.15, 222.48, 4.47, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 21:42:29', '2020-07-26 21:42:44', NULL),
(743, 2, 2, 2, 22, '2020-07-28', '02:08:40', 221.95, 222.29, 4.21, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 22:24:20', '2020-07-26 22:25:30', NULL),
(744, 2, 2, 2, 23, '2020-07-28', '02:14:48', 223.28, 222.94, 4.13, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 22:24:46', '2020-07-26 22:25:42', NULL),
(745, 2, 2, 2, 25, '2020-07-28', '02:14:55', 222.83, 222.71, 4.03, '50:50', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 22:25:13', '2020-07-26 22:25:59', NULL),
(746, 2, 2, 2, 41, '2020-07-28', '02:30:00', 223.46, 223.12, 4.23, '50:50', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 22:39:51', '2020-07-26 22:40:51', NULL),
(747, 2, 2, 2, 24, '2020-07-28', '02:34:14', 223.28, 222.69, 3.98, '50:50', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 22:40:18', '2020-07-26 22:41:06', NULL),
(748, 2, 2, 2, 26, '2020-07-28', '02:34:18', 222.88, 223.24, 4.00, '50:50', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 22:40:40', '2020-07-26 22:41:24', NULL),
(749, 2, 2, 2, 40, '2020-07-28', '02:45:00', 223.39, 223.78, 4.18, '50:50', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 22:45:37', '2020-07-26 22:45:49', NULL),
(750, 2, 2, 2, 27, '2020-07-28', '02:48:50', 223.60, 223.42, 4.09, '50:50', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 22:54:58', '2020-07-26 22:55:27', NULL),
(751, 2, 2, 2, 28, '2020-07-28', '02:48:55', 222.27, 223.07, 4.46, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 22:55:16', '2020-07-26 22:56:01', NULL),
(752, 2, 2, 2, 41, '2020-07-28', '03:00:00', 223.12, 223.13, 4.21, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 23:05:03', '2020-07-26 23:05:15', NULL),
(753, 2, 2, 2, 29, '2020-07-28', '03:10:43', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 88, NULL, NULL, '2020-07-26 23:09:50', '2020-07-26 23:09:50', NULL),
(754, 2, 2, 2, 38, '2020-07-28', '03:21:02', 222.90, 222.82, 4.20, '30:70', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 23:25:26', '2020-07-26 23:25:48', NULL),
(755, 2, 2, 2, 41, '2020-07-28', '03:30:00', 222.83, 223.47, 4.23, '30:70', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 23:32:14', '2020-07-26 23:32:47', NULL),
(756, 2, 2, 2, 29, '2020-07-28', '03:33:09', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 88, NULL, NULL, '2020-07-26 23:32:31', '2020-07-26 23:32:31', NULL),
(757, 2, 2, 2, 34, '2020-07-28', '03:48:37', 223.01, 222.95, 4.21, '50:50', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-26 23:55:45', '2020-07-26 23:56:25', NULL),
(758, 2, 2, 2, 29, '2020-07-28', '03:59:01', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 88, NULL, NULL, '2020-07-26 23:58:31', '2020-07-26 23:58:31', NULL),
(759, 2, 2, 2, 34, '2020-07-28', '04:04:39', 222.34, 221.93, 4.19, '50:50', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-27 00:17:56', '2020-07-27 00:18:18', NULL),
(760, 2, 2, 2, 40, '2020-07-28', '04:15:00', 222.79, 222.82, 4.25, '50:50', 200, 208, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-27 00:26:36', '2020-07-27 00:27:06', NULL),
(761, 2, 2, 2, 29, '2020-07-28', '04:15:54', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 88, NULL, NULL, '2020-07-27 00:27:33', '2020-07-27 00:27:33', NULL),
(762, 2, 2, 2, 34, '2020-07-28', '04:20:28', 221.76, 222.72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88, 38, 38, '2020-07-27 00:29:09', '2020-07-27 02:52:30', '2020-07-27 02:52:30'),
(763, 2, 2, 2, 34, '2020-07-28', '04:20:28', 221.76, 222.72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88, 38, 38, '2020-07-27 00:29:47', '2020-07-27 02:52:38', '2020-07-27 02:52:38'),
(764, 2, 2, 2, 34, '2020-07-28', '04:20:28', 221.76, 222.72, 4.22, '50:50', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-27 00:31:40', '2020-07-27 00:32:05', NULL),
(765, 2, 2, 2, 41, '2020-07-28', '04:30:00', 222.62, 222.56, 4.04, '50:50', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-27 00:33:00', '2020-07-27 00:33:18', NULL),
(766, 2, 2, 2, 29, '2020-07-28', '04:34:33', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 88, NULL, NULL, '2020-07-27 00:34:45', '2020-07-27 00:34:45', NULL),
(767, 2, 2, 2, 34, '2020-07-28', '04:38:03', 223.36, 222.54, 4.11, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-27 00:57:39', '2020-07-27 00:58:10', NULL),
(768, 2, 2, 2, 23, '2020-07-28', '04:41:00', 222.79, 222.06, 4.17, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-27 00:59:02', '2020-07-27 00:59:25', NULL),
(769, 2, 2, 2, 25, '2020-07-28', '04:41:06', 221.60, 222.29, 4.26, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-27 01:00:11', '2020-07-27 01:00:33', NULL),
(770, 2, 2, 2, 40, '2020-07-28', '05:45:00', 222.28, 222.91, 4.22, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-27 01:01:04', '2020-07-27 01:01:31', NULL),
(771, 2, 2, 2, 29, '2020-07-28', '04:47:55', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 88, NULL, NULL, '2020-07-27 01:02:15', '2020-07-27 01:02:15', NULL),
(772, 2, 2, 2, 34, '2020-07-28', '04:53:54', 220.87, 221.95, 4.19, '30:70', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-27 01:03:18', '2020-07-27 01:04:10', NULL),
(773, 2, 2, 2, 40, '2020-07-28', '04:45:00', 222.28, 222.91, 4.22, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-27 01:13:15', '2020-07-27 01:13:28', NULL),
(774, 2, 2, 2, 29, '2020-07-28', '05:08:15', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 88, NULL, NULL, '2020-07-27 01:19:05', '2020-07-27 01:19:05', NULL),
(775, 2, 2, 2, 34, '2020-07-28', '05:16:12', 221.88, 221.30, 4.14, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-27 01:19:38', '2020-07-27 01:19:51', NULL),
(776, 2, 2, 2, 41, '2020-07-28', '05:30:00', 222.79, 221.86, 4.26, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 88, 88, NULL, '2020-07-27 01:30:36', '2020-07-27 01:30:49', NULL),
(777, 2, 2, 2, 29, '2020-07-28', '05:54:33', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 88, NULL, NULL, '2020-07-27 01:54:22', '2020-07-27 01:54:22', NULL),
(778, 2, 2, 2, 34, '2020-07-28', '06:15:30', 221.97, 221.08, 4.43, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 02:53:07', '2020-07-27 03:27:53', NULL),
(779, 2, 2, 2, 27, '2020-07-28', '06:19:02', 221.62, 222.52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, 38, 38, '2020-07-27 02:53:31', '2020-07-27 02:54:10', '2020-07-27 02:54:10'),
(780, 2, 2, 2, 28, '2020-07-28', '06:19:08', 221.92, 223.52, 4.28, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 02:54:00', '2020-07-27 03:30:33', NULL),
(781, 2, 2, 2, 27, '2020-07-28', '06:19:02', 221.62, 222.52, 4.29, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 02:55:08', '2020-07-27 03:28:07', NULL),
(782, 2, 2, 2, 24, '2020-07-28', '06:23:57', 221.54, 223.11, 4.34, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 02:56:33', '2020-07-27 03:30:49', NULL),
(783, 2, 2, 2, 26, '2020-07-28', '06:24:10', 221.59, 222.48, 4.34, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 02:58:22', '2020-07-27 03:31:03', NULL),
(784, 2, 2, 2, 41, '2020-07-28', '06:30:00', 221.59, 222.26, 4.31, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 02:59:13', '2020-07-27 03:31:20', NULL),
(785, 2, 2, 2, 41, '2020-07-28', '07:00:00', 222.71, 221.45, 4.25, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 03:19:35', '2020-07-27 03:33:00', NULL),
(786, 2, 2, 2, 40, '2020-07-28', '06:45:00', 221.24, 222.64, 4.30, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 03:19:54', '2020-07-27 03:31:31', NULL),
(787, 2, 2, 2, 23, '2020-07-28', '07:06:51', 221.69, 222.74, 4.48, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 03:20:12', '2020-07-27 03:33:14', NULL),
(788, 2, 2, 2, 25, '2020-07-28', '07:06:51', 222.94, 222.46, 4.24, '60:40', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 03:20:28', '2020-07-27 03:34:19', NULL),
(789, 2, 2, 2, 42, '2020-07-28', '07:14:55', 0.00, 0.00, 4.24, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 03:21:21', '2020-07-27 03:34:32', NULL),
(790, 2, 2, 2, 29, '2020-07-28', '07:14:55', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 38, NULL, NULL, '2020-07-27 03:27:03', '2020-07-27 03:27:03', NULL),
(791, 2, 2, 2, 34, '2020-07-28', '07:23:18', 222.93, 223.90, 4.14, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 03:27:26', '2020-07-27 03:34:44', NULL),
(792, 2, 2, 2, 40, '2020-07-28', '07:30:00', 222.82, 222.13, 4.27, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 03:35:01', '2020-07-27 03:35:15', NULL),
(793, 2, 2, 2, 29, '2020-07-28', '07:42:33', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 38, NULL, NULL, '2020-07-27 03:48:30', '2020-07-27 03:48:30', NULL),
(794, 2, 2, 2, 34, '2020-07-28', '08:00:02', 221.15, 222.13, 4.14, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 04:02:39', '2020-07-27 04:02:54', NULL),
(795, 2, 2, 2, 40, '2020-07-28', '08:15:00', 222.47, 223.07, 4.08, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 04:16:01', '2020-07-27 04:16:12', NULL),
(796, 2, 2, 2, 23, '2020-07-28', '08:19:55', 222.33, 223.18, 4.20, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 04:27:57', '2020-07-27 04:28:32', NULL),
(797, 2, 2, 2, 25, '2020-07-28', '08:20:03', 221.43, 222.27, 4.31, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 04:28:17', '2020-07-27 04:28:43', NULL),
(798, 2, 2, 2, 41, '2020-07-28', '08:30:00', 221.80, 223.08, 4.12, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 04:30:06', '2020-07-27 04:30:20', NULL),
(799, 2, 2, 2, 40, '2020-07-28', '08:45:00', 221.45, 223.07, 4.35, '30:70', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 04:47:54', '2020-07-27 04:48:06', NULL),
(800, 2, 2, 2, 41, '2020-07-28', '09:00:49', 221.42, 222.92, 4.10, '30:70', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 05:08:50', '2020-07-27 05:10:03', NULL),
(801, 2, 2, 2, 27, '2020-07-28', '09:01:14', 221.36, 222.46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, 38, 38, '2020-07-27 05:09:10', '2020-07-27 05:09:30', '2020-07-27 05:09:30'),
(802, 2, 2, 2, 28, '2020-07-28', '09:01:20', 221.17, 222.48, 4.33, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 05:09:26', '2020-07-27 05:11:05', NULL),
(803, 2, 2, 2, 27, '2020-07-28', '09:01:04', 221.39, 222.46, 4.34, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 05:09:48', '2020-07-27 05:10:14', NULL),
(804, 2, 2, 2, 40, '2020-07-28', '09:15:00', 221.90, 222.65, 4.20, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 05:14:17', '2020-07-27 05:14:45', NULL),
(805, 2, 2, 2, 41, '2020-07-28', '09:30:00', 221.35, 222.01, 3.95, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 05:32:24', '2020-07-27 05:33:18', NULL),
(806, 2, 2, 2, 40, '2020-07-28', '09:45:00', 221.84, 222.88, 4.33, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 05:49:50', '2020-07-27 05:51:10', NULL),
(807, 2, 2, 2, 41, '2020-07-28', '10:00:00', 221.20, 222.03, 3.95, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 06:51:35', '2020-07-27 07:04:09', NULL),
(808, 2, 2, 2, 23, '2020-07-28', '10:11:42', 221.44, 222.49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, 38, 38, '2020-07-27 06:52:05', '2020-07-27 06:59:40', '2020-07-27 06:59:40'),
(809, 2, 2, 2, 25, '2020-07-28', '10:11:15', 221.17, 222.33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, 38, 38, '2020-07-27 06:58:46', '2020-07-27 07:00:12', '2020-07-27 07:00:12'),
(810, 2, 2, 2, 23, '2020-07-28', '10:11:42', 221.44, 222.49, 4.36, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:00:07', '2020-07-27 07:05:02', NULL),
(811, 2, 2, 2, 25, '2020-07-28', '10:11:50', 221.17, 222.33, 4.18, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:00:46', '2020-07-27 07:05:22', NULL),
(812, 2, 2, 2, 40, '2020-07-28', '10:15:18', 222.50, 221.14, 4.15, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:01:20', '2020-07-27 07:05:41', NULL),
(813, 2, 2, 2, 29, '2020-07-28', '10:22:06', 0.00, 0.00, 0.00, '-', 0, 0, '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', NULL, 'OK', 38, NULL, NULL, '2020-07-27 07:01:35', '2020-07-27 07:01:35', NULL),
(814, 2, 2, 2, 34, '2020-07-28', '10:30:19', 220.82, 220.89, 4.12, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:01:54', '2020-07-27 07:05:57', NULL),
(815, 2, 2, 2, 40, '2020-07-28', '10:45:00', 221.43, 222.13, 4.30, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:02:13', '2020-07-27 07:06:16', NULL),
(816, 2, 2, 2, 24, '2020-07-28', '10:54:12', 221.54, 222.64, 4.40, '40:60', 202, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:02:34', '2020-07-27 07:06:27', NULL),
(817, 2, 2, 2, 26, '2020-07-28', '10:54:18', 221.37, 222.31, 4.19, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:03:26', '2020-07-27 07:06:46', NULL),
(818, 2, 2, 2, 41, '2020-07-28', '11:00:00', 220.86, 222.42, 4.30, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:03:53', '2020-07-27 07:07:05', NULL),
(819, 2, 2, 2, 40, '2020-07-28', '11:15:00', 221.63, 222.10, 4.39, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:15:52', '2020-07-27 07:16:18', NULL),
(820, 2, 2, 2, 27, '2020-07-28', '11:26:24', 221.40, 222.47, 4.25, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:34:56', '2020-07-27 07:36:57', NULL),
(821, 2, 2, 2, 28, '2020-07-28', '11:26:32', 221.04, 222.47, 4.36, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:35:35', '2020-07-27 07:37:08', NULL),
(822, 2, 2, 2, 41, '2020-07-28', '11:30:00', 221.86, 221.42, 4.23, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:37:36', '2020-07-27 07:37:47', NULL),
(823, 2, 2, 2, 40, '2020-07-28', '11:45:00', 221.65, 222.06, 4.21, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:57:18', '2020-07-27 07:58:56', NULL),
(824, 2, 2, 2, 24, '2020-07-28', '11:47:17', 222.26, 221.45, 4.21, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:57:56', '2020-07-27 07:59:10', NULL),
(825, 2, 2, 2, 26, '2020-07-28', '11:47:22', 221.52, 222.35, 4.36, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 07:58:32', '2020-07-27 07:59:22', NULL),
(826, 2, 2, 2, 41, '2020-07-28', '12:00:00', 222.78, 221.90, 4.15, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 08:30:29', '2020-07-27 08:33:32', NULL),
(827, 2, 2, 2, 23, '2020-07-28', '12:12:57', 221.28, 223.04, 4.22, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 08:31:36', '2020-07-27 08:34:04', NULL),
(828, 2, 2, 2, 25, '2020-07-28', '12:13:04', 222.35, 222.01, 4.34, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 08:31:57', '2020-07-27 08:34:15', NULL),
(829, 2, 2, 2, 40, '2020-07-28', '12:15:05', 221.71, 222.20, 4.34, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 08:32:15', '2020-07-27 08:34:37', NULL),
(830, 2, 2, 2, 41, '2020-07-28', '12:30:00', 221.43, 222.56, 4.11, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 08:32:51', '2020-07-27 08:34:48', NULL),
(831, 2, 2, 2, 40, '2020-07-28', '12:45:00', 221.84, 223.24, 4.28, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 08:45:41', '2020-07-27 08:45:57', NULL),
(832, 2, 2, 2, 41, '2020-07-28', '13:00:00', 222.70, 221.29, 4.30, '40:60', 202, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 09:12:55', '2020-07-27 09:13:32', NULL),
(833, 2, 2, 2, 39, '2020-07-28', '13:05:43', 221.18, 223.24, 4.34, '40:60', 200, 202, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 38, 38, NULL, '2020-07-27 09:13:10', '2020-07-27 09:14:20', NULL);

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
(1, 20, '2020-07-28', '1', 1, 1, NULL, '2020-07-27 19:51:20', '2020-07-27 21:48:11', NULL),
(2, 13, '2020-07-28', '0', 1, NULL, NULL, '2020-07-28 00:11:57', '2020-07-28 00:11:57', NULL);

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
  `explanation_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explanation_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explanation_3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, 3, 20, 1, 1, 'G2007214005', '2020-07-23', '2020-07-27', '2021-07-27', '2020-07-28', '9969.25', NULL, NULL, '-', '-', '-', '-', '5', '1', 1, 1, NULL, NULL, '2020-07-28 00:17:55', NULL),
(2, 3, 13, 2, 2, 'G2007214007', '2020-07-23', '2020-07-27', '2021-07-27', '2020-07-28', '9956.565', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AR/34.44)', '3', '1', 1, 1, NULL, NULL, '2020-07-28 00:56:44', NULL),
(3, 3, 13, NULL, NULL, 'G2007214008', '2020-07-23', '2020-07-27', NULL, NULL, '9956.565', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AR/34.44)', '2', '1', 1, 1, NULL, NULL, '2020-07-28 00:11:41', NULL),
(4, 3, 4, NULL, NULL, 'G2007708011', '2020-07-28', NULL, NULL, NULL, '5887.26', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HB GREEK CLASSIC 24X200ML (SENTUL) ( 0.5/FGHB09)', '0', '1', 1, 1, NULL, NULL, '2020-07-27 19:43:00', NULL),
(5, 3, 4, NULL, NULL, 'G2007708006', '2020-07-28', NULL, NULL, NULL, '5887.26', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HB GREEK CLASSIC 24X200ML (SENTUL) ( 0.5/FGHB09)', '0', '1', 1, 1, NULL, NULL, '2020-07-27 19:43:00', NULL),
(6, 3, 17, NULL, NULL, 'G2008216001', '2020-07-29', NULL, NULL, NULL, '14026.986', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HILO TEEN RTD COFFEE TIRAMISU ( AM/34.48)', '0', '1', 1, 1, NULL, NULL, '2020-07-27 19:43:00', NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `cpp_heads`
--
ALTER TABLE `cpp_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `energy_monitorings`
--
ALTER TABLE `energy_monitorings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `energy_usages`
--
ALTER TABLE `energy_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT untuk tabel `palet_ppqs`
--
ALTER TABLE `palet_ppqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ppqs`
--
ALTER TABLE `ppqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `preventive_actions`
--
ALTER TABLE `preventive_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `psrs`
--
ALTER TABLE `psrs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rkjs`
--
ALTER TABLE `rkjs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rpd_filling_detail_at_events`
--
ALTER TABLE `rpd_filling_detail_at_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `rpd_filling_detail_pis`
--
ALTER TABLE `rpd_filling_detail_pis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=834;

--
-- AUTO_INCREMENT untuk tabel `rpd_filling_heads`
--
ALTER TABLE `rpd_filling_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `wo_numbers`
--
ALTER TABLE `wo_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
