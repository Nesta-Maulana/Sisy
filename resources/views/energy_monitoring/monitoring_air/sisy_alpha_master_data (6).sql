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
-- Database: `sisy_alpha_master_data`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_name` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_description` char(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_link` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `applications`
--

INSERT INTO `applications` (`id`, `application_name`, `application_description`, `application_link`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Master Apps', 'Aplikasi untuk mengelola seluruh data-data dari aplikasi yang terdapat pada Sentul integrated system', 'master-apps', 1, 1, NULL, NULL, '2020-01-23 15:24:31', '2020-01-23 15:24:31', NULL),
(2, 'Rollie', 'Aplikasi untuk mengelola seluruh data-data penunjang release produk di plant sentul', 'rollie', 1, 1, NULL, NULL, '2020-01-23 15:24:32', '2020-01-23 15:24:32', NULL),
(3, 'Rollie - Admin Panel', 'Aplikasi untuk mengelola seluruh data-data yang terdapat pada aplikasi Rollie', 'rollie-admin-panel', 1, 1, NULL, NULL, '2020-01-23 15:24:32', '2020-01-23 15:24:32', NULL),
(4, 'Energy Monitoring', 'Aplikasi untuk mengelola seluruh data-data penggunaan energy di PT Nutrifood Indonesia Plant Sentul', 'emon', 1, 1, NULL, NULL, '2020-01-23 15:24:32', '2020-01-23 15:24:32', NULL),
(5, 'Energy Monitoring - Admin Panel', 'Aplikasi untuk mengelola seluruh data-data yang terdapat pada aplikasi Emon', 'emon-admin-panel', 1, 1, 1, NULL, '2020-01-23 15:24:32', '2020-03-30 07:40:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `application_permissions`
--

CREATE TABLE `application_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) NOT NULL COMMENT 'Connect to applications table',
  `user_id` bigint(20) NOT NULL COMMENT 'Connect to user table',
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `application_permissions`
--

INSERT INTO `application_permissions` (`id`, `application_id`, `user_id`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, NULL, NULL, '2020-01-23 15:24:34', '2020-01-23 15:24:34', NULL),
(2, 1, 2, 1, 1, NULL, NULL, '2020-01-23 15:24:34', '2020-01-23 15:24:34', NULL),
(3, 2, 1, 1, 1, NULL, NULL, '2020-01-23 15:24:35', '2020-01-23 15:24:35', NULL),
(4, 2, 2, 1, 1, NULL, NULL, '2020-01-23 15:24:35', '2020-01-23 15:24:35', NULL),
(5, 3, 1, 1, 1, NULL, NULL, '2020-01-23 15:24:35', '2020-01-23 15:24:35', NULL),
(6, 3, 2, 1, 1, NULL, NULL, '2020-01-23 15:24:35', '2020-01-23 15:24:35', NULL),
(7, 4, 1, 1, 1, NULL, NULL, '2020-01-23 15:24:35', '2020-01-23 15:24:35', NULL),
(8, 4, 2, 1, 1, NULL, NULL, '2020-01-23 15:24:36', '2020-01-23 15:24:36', NULL),
(9, 5, 1, 1, 1, NULL, NULL, '2020-01-23 15:24:36', '2020-01-23 15:24:36', NULL),
(10, 5, 2, 1, 1, NULL, NULL, '2020-01-23 15:24:36', '2020-01-23 15:24:36', NULL),
(11, 2, 87, 1, 1, NULL, NULL, NULL, NULL, NULL),
(12, 2, 88, 1, 1, NULL, NULL, NULL, NULL, NULL),
(13, 1, 30, 2, 1, NULL, NULL, '2020-03-31 14:09:59', '2020-03-31 14:09:59', NULL),
(14, 2, 30, 1, 1, NULL, NULL, '2020-03-31 14:09:59', '2020-03-31 14:09:59', NULL),
(15, 3, 30, 2, 1, NULL, NULL, '2020-03-31 14:09:59', '2020-03-31 14:09:59', NULL),
(16, 4, 30, 2, 1, NULL, NULL, '2020-03-31 14:09:59', '2020-03-31 14:09:59', NULL),
(17, 5, 30, 2, 1, NULL, NULL, '2020-03-31 14:09:59', '2020-03-31 14:09:59', NULL),
(18, 2, 36, 1, 1, NULL, NULL, '2020-03-31 14:10:55', '2020-03-31 14:10:55', NULL),
(19, 2, 32, 1, 1, NULL, NULL, '2020-03-31 14:11:55', '2020-03-31 14:11:55', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) NOT NULL COMMENT 'connect to companies table',
  `brand_name` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `brands`
--

INSERT INTO `brands` (`id`, `company_id`, `brand_name`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'NFI', 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'HNI', 1, 1, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'WRP', 1, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_short_name` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_short_name`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PT. Nutrifood Indonesia', 'NFI', 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'PT. Heavenly Nutrition Indonesia', 'HNI', 1, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `departement` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `departements`
--

INSERT INTO `departements` (`id`, `departement`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'FQC', 1, 1, NULL, NULL, '2020-01-23 15:24:31', '2020-01-23 15:24:31', NULL),
(2, 'FSA', 1, 1, NULL, NULL, '2020-01-23 15:24:31', '2020-01-23 15:24:31', NULL),
(3, 'FRC', 1, 1, NULL, NULL, '2020-01-23 15:24:31', '2020-01-23 15:24:31', NULL),
(4, 'FEC', 1, 1, NULL, NULL, '2020-01-23 15:24:31', '2020-01-23 15:24:31', NULL),
(5, 'FGS', 1, 1, NULL, NULL, '2020-01-23 15:24:31', '2020-01-23 15:24:31', NULL),
(6, 'FPD', 1, 1, NULL, NULL, '2020-01-23 15:24:31', '2020-01-23 15:24:31', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `distribution_lists`
--

CREATE TABLE `distribution_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) NOT NULL COMMENT 'connected to employee table',
  `ppq_mail_to` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `ppq_mail_cc` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `rkj_nfi_mail_to` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `rkj_nfi_mail_cc` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `rkj_wrp_mail_to` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `rkj_wrp_mail_cc` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `rkj_hb_mail_to` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `rkj_hb_mail_cc` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `sortasi_mail_to` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `sortasi_mail_cc` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `psr_mail_to` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `psr_mail_cc` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `distribution_lists`
--

INSERT INTO `distribution_lists` (`id`, `employee_id`, `ppq_mail_to`, `ppq_mail_cc`, `rkj_nfi_mail_to`, `rkj_nfi_mail_cc`, `rkj_wrp_mail_to`, `rkj_wrp_mail_cc`, `rkj_hb_mail_to`, `rkj_hb_mail_cc`, `sortasi_mail_to`, `sortasi_mail_cc`, `psr_mail_to`, `psr_mail_cc`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL),
(2, 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement_id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`id`, `fullname`, `email`, `departement_id`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nesta Maulana', 'nestamaulana165@gmail.com', 1, 1, 1, NULL, NULL, '2020-01-23 15:24:33', '2020-01-23 15:24:33', NULL),
(2, 'Administrator', 'nesta.maulana@nutrifood.co.id', 1, 1, 1, NULL, NULL, '2020-01-23 15:24:33', '2020-01-23 15:24:33', NULL),
(3, 'Nesta Maulana', 'nestamaulana165@gmail.com', 1, 0, 1, NULL, NULL, '2019-04-14 07:05:56', '0000-00-00 00:00:00', NULL),
(6, 'Nesta Maulana', 'nesta.maulana@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-09-28 02:32:37', '2019-07-10 00:30:54', NULL),
(7, 'Adiyono', 'adiyono@nutrifood.co.id', 2, 0, 1, NULL, NULL, '2019-09-28 02:32:27', '2019-09-20 17:39:51', NULL),
(8, 'Hendrajaya', 'hendra@nutrifood.co.id', 2, 0, 1, NULL, NULL, '2019-09-28 02:32:18', '2019-09-20 17:40:26', NULL),
(9, 'Yunianto', 'yunianto@nutrifood.co.id', 2, 0, 1, NULL, NULL, '2019-09-28 02:32:33', '2019-09-20 17:41:01', NULL),
(10, 'R. Mulyana Adi Kusuma', 'operator.prc@nutrifood.co.id', 2, 0, 1, NULL, NULL, '2019-09-20 17:43:50', '2019-09-20 17:43:50', NULL),
(11, 'Awang Sunarwan', 'operator.prc@nutrifood.co.id', 2, 0, 1, NULL, NULL, '2019-09-20 17:44:15', '2019-09-20 17:44:15', NULL),
(12, 'Sahroni', 'operator.prc@nutrifood.co.id', 2, 0, 1, NULL, NULL, '2019-09-20 17:44:30', '2019-09-20 17:44:30', NULL),
(13, 'Sunarya', 'qc.rtd@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-09-28 02:32:56', '2019-09-20 18:31:30', NULL),
(14, 'Irfai', 'qc.rtd@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-09-28 02:32:59', '2019-09-20 18:31:56', NULL),
(15, 'Leonardo Caesar S', 'qc.rtd@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-09-28 02:33:01', '2019-09-20 18:32:18', NULL),
(16, 'Acu Supriadi', 'acu@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-09-28 02:33:08', '2019-09-27 18:31:32', NULL),
(17, 'Dwi Aditya Hermawan', 'teknisi_pec@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-09-27 18:32:05', '2019-09-27 18:32:05', NULL),
(18, 'Rady Irawan', 'Teknisi_pec@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-09-27 18:32:53', '2019-09-27 18:32:53', NULL),
(19, 'Mohammad Teguh Wicaksana', 'teknisi_pec@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-09-27 18:34:14', '2019-09-27 18:34:14', NULL),
(20, 'Willianto', 'willianto@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-09-28 02:50:00', '2019-09-27 18:45:59', NULL),
(21, 'Mujiono', 'mujiono@nutrifood.co.id', 2, 0, 1, NULL, NULL, '2019-09-28 02:49:58', '2019-09-27 18:55:44', NULL),
(22, 'Hilda Utami  Anwar', 'hilda.utami@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-09-28 02:48:07', '2019-09-27 18:56:56', NULL),
(23, 'Lukmanul Hakim', 'lukmanul.hakim@nutrifood.co.id', 2, 0, 1, NULL, NULL, '2019-09-28 02:48:00', '2019-09-27 18:59:11', NULL),
(24, 'Mohammad Agung Maulana', 'maulana.mohammad@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-09-28 02:47:57', '2019-09-27 19:01:28', NULL),
(25, 'Paula Wulandari Soetjipto', 'paula.wulandari@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-09-28 02:33:23', '2019-09-27 19:09:38', NULL),
(26, 'Febdian Logis Rohmanto', 'febdian@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-09-28 02:33:20', '2019-09-27 19:11:23', NULL),
(27, 'Nurdiani Afrilia', 'afrilia.nurdiani@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-09-28 02:33:17', '2019-09-27 19:12:07', NULL),
(28, 'Romi Anggara', 'romi.anggara@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-09-27 19:13:06', '2019-09-27 19:13:06', NULL),
(29, 'Gugum Chandra Gumilar', 'gugum.chandra@nutrifood.co.id', 3, 0, 1, NULL, NULL, '2019-09-27 19:13:55', '2019-09-27 19:13:55', NULL),
(30, 'Jilli Saaduddin Musytari', 'jilli.saaduddin@nutrifood.co.id', 3, 0, 1, NULL, NULL, '2019-09-27 19:15:02', '2019-09-27 19:15:02', NULL),
(31, 'Andreas Didit Herdito', 'didit@nutrifood.co.id', 3, 0, 1, NULL, NULL, '2019-09-28 02:50:29', '2019-09-27 19:21:02', NULL),
(32, 'Dhiaksa Mahitra Prastawa', 'dhiaksa.mahitra@nutrifood.co.id', 3, 0, 1, NULL, NULL, '2019-09-28 02:50:34', '2019-09-27 19:21:35', NULL),
(33, 'Hendra Darusman', 'operator.prc@nutrifood.co.id', 2, 0, 1, NULL, NULL, '2019-09-27 19:54:56', '2019-09-27 19:54:56', NULL),
(34, 'M. Miftahul Husein', 'labmikro.sentul@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-09-28 00:51:06', '2019-09-28 00:51:06', NULL),
(35, 'Putri Reta Nafisah', 'labmikro.sentul@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-09-28 00:51:57', '2019-09-28 00:51:57', NULL),
(36, 'Taufik Nugraha', 'labmikro.sentul@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-09-28 01:06:56', '2019-09-28 01:06:56', NULL),
(37, 'awang sunarwan', 'sunarwan556@gmail.com', 2, 0, 1, NULL, NULL, '2019-10-01 05:43:07', '2019-10-01 05:43:07', NULL),
(43, 'Acu Supriadi', 'acu@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-11-04 23:40:19', '2019-11-04 23:40:19', NULL),
(44, 'Maulana pandawa', 'nesta.maulana@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-11-10 06:24:08', '2019-11-10 06:24:08', NULL),
(45, 'Muhamad Sahidin', 'qcreference.sentul@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2019-11-17 07:29:55', '2019-11-17 07:29:55', NULL),
(46, 'Aawang.sunarwan', 'sunarwan556@gmail.com', 2, 0, 1, NULL, NULL, '2019-11-30 23:44:14', '2019-11-30 23:44:14', NULL),
(47, 'Dodi Wijaya', 'Dodi.wijaya@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:04:22', '2019-12-13 17:04:22', NULL),
(48, 'Sindhu Satya Prathama', 'sindhu.satya@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:05:12', '2019-12-13 17:05:12', NULL),
(49, 'Chiptana Wijayangrana S', 'opwtp.sentul@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:08:08', '2019-12-13 17:08:08', NULL),
(50, 'Wildan Maulana Hasan', 'opwtp.sentul@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:08:48', '2019-12-13 17:08:48', NULL),
(51, 'Agit Fajar Sukmana', 'agit.fajar@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:10:48', '2019-12-13 17:10:48', NULL),
(52, 'Fadhly Yudha AB', 'boiler.sentul@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:11:31', '2019-12-13 17:11:31', NULL),
(53, 'desse.firmanda', 'teknisipec.utility@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:12:32', '2019-12-13 17:12:32', NULL),
(54, 'Muhammad Bai\'at Abdullah', 'opwtp.sentul@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:13:15', '2019-12-13 17:13:15', NULL),
(55, 'Agus Sarno', 'teknisipec.utility@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:13:51', '2019-12-13 17:13:51', NULL),
(56, 'Akbar Toash Arill Wicaksana', 'boiler.sentul@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:14:32', '2019-12-13 17:14:32', NULL),
(57, 'Bayu Andi Pamungkas', 'teknisipec.utility@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:15:16', '2019-12-13 17:15:16', NULL),
(58, 'Satrio Cesareka Widarputro', 'boiler.sentul@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:15:45', '2019-12-13 17:15:45', NULL),
(59, 'Rizki Amalia', 'rizki.amalia@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:16:21', '2019-12-13 17:16:21', NULL),
(60, 'Hassanudin', 'hasanudin@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:18:04', '2019-12-13 17:18:04', NULL),
(61, 'Rico Wicaksono', 'boiler.sentul@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:18:55', '2019-12-13 17:18:55', NULL),
(62, 'Hery Abdurouf', 'teknisipec.utility@nutrifood.co.id', 4, 0, 1, NULL, NULL, '2019-12-13 17:31:47', '2019-12-13 17:31:47', NULL),
(63, 'awangsunarwan', 'sunarwan556@gmail.com', 2, 0, 1, NULL, NULL, '2019-12-26 07:33:13', '2019-12-26 07:33:13', NULL),
(64, 'Naufal Maulana', 'qc.rtd@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2020-01-03 06:25:21', '2020-01-03 06:25:21', NULL),
(65, 'Bayu Priasmoro', 'qc.rtd@nutrifood.co.id', 1, 0, 1, NULL, NULL, '2020-01-05 06:48:24', '2020-01-05 06:48:24', NULL),
(70, 'Jajang Nurjaman', 'nesta.maulana@nutrifood.co.id', 1, 1, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `filling_machines`
--

CREATE TABLE `filling_machines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filling_machine_name` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filling_machine_code` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `filling_machines`
--

INSERT INTO `filling_machines` (`id`, `filling_machine_name`, `filling_machine_code`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'TBA', 'TBA C', 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'A3', 'A3CF B', 1, 1, NULL, NULL, NULL, NULL, NULL),
(3, 'TPA', 'TPA A', 1, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'Filling Machine D', 'Filling Machine D', 1, 1, 1, NULL, '2020-04-05 12:46:48', '2020-04-06 08:21:05', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `filling_machine_group_details`
--

CREATE TABLE `filling_machine_group_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filling_machine_group_head_id` bigint(20) NOT NULL COMMENT 'connect to filling machine group head table',
  `filling_machine_id` bigint(20) NOT NULL COMMENT 'connect to filling machine table',
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `filling_machine_group_details`
--

INSERT INTO `filling_machine_group_details` (`id`, `filling_machine_group_head_id`, `filling_machine_id`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 1, 2, 1, 1, NULL, NULL, NULL, NULL, NULL),
(3, 2, 3, 1, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `filling_machine_group_heads`
--

CREATE TABLE `filling_machine_group_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filling_machine_group_name` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `filling_machine_group_heads`
--

INSERT INTO `filling_machine_group_heads` (`id`, `filling_machine_group_name`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Brix', 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Prisma', 1, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `filling_sampel_codes`
--

CREATE TABLE `filling_sampel_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filling_sampel_code` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filling_sampel_event` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_type_id` bigint(20) NOT NULL COMMENT 'connected to product type table',
  `filling_machine_id` bigint(20) NOT NULL COMMENT 'connected to filling machine table',
  `pi` int(11) NOT NULL,
  `mikro30` int(11) NOT NULL,
  `mikro55` int(11) NOT NULL,
  `dissolve` int(11) NOT NULL,
  `standar` int(11) NOT NULL,
  `retain` int(11) NOT NULL,
  `wo` int(11) NOT NULL,
  `ts_ph` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `filling_sampel_codes`
--

INSERT INTO `filling_sampel_codes` (`id`, `filling_sampel_code`, `filling_sampel_event`, `product_type_id`, `filling_machine_id`, `pi`, `mikro30`, `mikro55`, `dissolve`, `standar`, `retain`, `wo`, `ts_ph`, `jumlah`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A', 'Start Filling', 1, 1, 4, 2, 2, 4, 1, 1, 0, 2, 16, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'B', 'Before Paper', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(3, 'B(SP)', 'Before Paper (Sambungan Pabrik)', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'C', 'After Paper', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'C(SP)', 'After Paper  (Sambung Pabrik )', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'D', 'Before Strip', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(7, 'E', 'After Strip', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(8, 'F', 'Before Short Stop', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL),
(9, 'F(B)', 'Before Short Stop Paper', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(10, 'F(D)', 'Before Short Stop Strip', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(11, 'F(H)', 'Before Short Stop CIP', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, NULL, NULL),
(12, 'F(N)', 'Before Short Stop Normal Stop', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL),
(13, 'G', 'After Short Stop', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(14, 'G(A)', 'After Short Stop Paper', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(15, 'G(C)', 'After Short Stop Strip', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(16, 'G(E)', 'After Short Stop CIP', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(17, 'G(N)', 'After Short Stop Normal Stop', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(18, 'H', 'End filling', 1, 1, 4, 2, 1, 0, 0, 0, 0, 1, 8, 1, NULL, NULL, NULL, NULL, NULL),
(19, 'R', 'Random QC', 1, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(20, 'R(P)', 'Random Prod', 1, 1, 3, 0, 0, 0, 0, 0, 0, 0, 3, 1, NULL, NULL, NULL, NULL, NULL),
(21, 'R(S)', 'Random Resampling', 1, 1, 10, 0, 0, 0, 0, 0, 0, 0, 10, 1, NULL, NULL, NULL, NULL, NULL),
(22, 'A', 'Start Filling', 1, 2, 4, 2, 2, 4, 1, 1, 0, 2, 16, 1, NULL, NULL, NULL, NULL, NULL),
(23, 'B', 'Before Paper', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(24, 'B(SP)', 'Before Paper (Sambungan Pabrik)', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(25, 'C', 'After Paper', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(26, 'C(SP)', 'After Paper  (Sambung Pabrik )', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(27, 'D', 'Before Strip', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(28, 'E', 'After Strip', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(29, 'F', 'Before Short Stop', 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL),
(30, 'F(B)', 'Before Short Stop Paper', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(31, 'F(D)', 'Before Short Stop Strip', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(32, 'F(H)', 'Before Short Stop CIP', 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, NULL, NULL),
(33, 'F(N)', 'Before Short Stop Normal Stop', 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL),
(34, 'G', 'After Short Stop', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(35, 'G(A)', 'After Short Stop Paper', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(36, 'G(C)', 'After Short Stop Strip', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(37, 'G(E)', 'After Short Stop CIP', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(38, 'G(N)', 'After Short Stop Normal Stop', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(39, 'H', 'End filling', 1, 2, 4, 2, 1, 0, 0, 0, 0, 1, 8, 1, NULL, NULL, NULL, NULL, NULL),
(40, 'R', 'Random QC', 1, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(41, 'R(P)', 'Random Prod', 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 3, 1, NULL, NULL, NULL, NULL, NULL),
(42, 'R(S)', 'Random Resampling', 1, 2, 10, 0, 0, 0, 0, 0, 0, 0, 10, 1, NULL, NULL, NULL, NULL, NULL),
(43, 'A', 'Start Filling', 1, 3, 4, 2, 2, 4, 1, 1, 0, 2, 16, 1, NULL, NULL, NULL, NULL, NULL),
(44, 'B', 'Before Paper', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(45, 'B(SP)', 'Before Paper (Sambungan Pabrik)', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(46, 'C', 'After Paper', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(47, 'C(SP)', 'After Paper  (Sambung Pabrik )', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(48, 'D', 'Before Strip', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(49, 'E', 'After Strip', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(50, 'F', 'Before Short Stop', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(51, 'F(B)', 'Before Short Stop Paper', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(52, 'F(D)', 'Before Short Stop Strip', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(53, 'F(H)', 'Before Short Stop CIP', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(54, 'F(N)', 'Before Short Stop Normal Stop', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(55, 'G', 'After Short Stop', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(56, 'G(A)', 'After Short Stop Paper', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(57, 'G(C)', 'After Short Stop Strip', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(58, 'G(E)', 'After Short Stop CIP', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(59, 'G(N)', 'After Short Stop Normal Stop', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(60, 'H', 'End filling', 1, 3, 4, 2, 1, 0, 0, 0, 0, 1, 8, 1, NULL, NULL, NULL, NULL, NULL),
(61, 'R', 'Random QC', 1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(62, 'R(P)', 'Random Prod', 1, 3, 3, 2, 0, 0, 0, 0, 0, 0, 5, 1, NULL, NULL, NULL, NULL, NULL),
(63, 'R(S)', 'Random Resampling', 1, 3, 10, 0, 0, 0, 0, 0, 0, 0, 10, 1, NULL, NULL, NULL, NULL, NULL),
(64, 'A', 'Start Filling', 2, 1, 4, 2, 0, 4, 1, 1, 0, 2, 14, 1, NULL, NULL, NULL, NULL, NULL),
(65, 'B', 'Before Paper', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(66, 'B(SP)', 'Before Paper (Sambungan Pabrik)', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(67, 'C', 'After Paper', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(68, 'C(SP)', 'After Paper  (Sambung Pabrik )', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(69, 'D', 'Before Strip', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(70, 'E', 'After Strip', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(71, 'F', 'Before Short Stop', 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL),
(72, 'F(B)', 'Before Short Stop Paper', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(73, 'F(D)', 'Before Short Stop Strip', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(74, 'F(H)', 'Before Short Stop CIP', 2, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, NULL, NULL),
(75, 'F(N)', 'Before Short Stop Normal Stop', 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL),
(76, 'G', 'After Short Stop', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(77, 'G(A)', 'After Short Stop Paper', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(78, 'G(C)', 'After Short Stop Strip', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(79, 'G(E)', 'After Short Stop CIP', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(80, 'G(N)', 'After Short Stop Normal Stop', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(81, 'H', 'End filling', 2, 1, 4, 2, 0, 0, 0, 0, 0, 1, 7, 1, NULL, NULL, NULL, NULL, NULL),
(82, 'R', 'Random QC', 2, 1, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(83, 'R(P)', 'Random Prod', 2, 1, 3, 0, 0, 0, 0, 0, 0, 0, 3, 1, NULL, NULL, NULL, NULL, NULL),
(84, 'R(S)', 'Random Resampling', 2, 1, 10, 0, 0, 0, 0, 0, 0, 0, 10, 1, NULL, NULL, NULL, NULL, NULL),
(85, 'A', 'Start Filling', 2, 2, 4, 2, 0, 4, 1, 1, 0, 2, 14, 1, NULL, NULL, NULL, NULL, NULL),
(86, 'B', 'Before Paper', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(87, 'B(SP)', 'Before Paper (Sambungan Pabrik)', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(88, 'C', 'After Paper', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(89, 'C(SP)', 'After Paper  (Sambung Pabrik )', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(90, 'D', 'Before Strip', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(91, 'E', 'After Strip', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(92, 'F', 'Before Short Stop', 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL),
(93, 'F(B)', 'Before Short Stop Paper', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(94, 'F(D)', 'Before Short Stop Strip', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(95, 'F(H)', 'Before Short Stop CIP', 2, 2, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, NULL, NULL, NULL, NULL, NULL),
(96, 'F(N)', 'Before Short Stop Normal Stop', 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL),
(97, 'G', 'After Short Stop', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(98, 'G(A)', 'After Short Stop Paper', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(99, 'G(C)', 'After Short Stop Strip', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(100, 'G(E)', 'After Short Stop CIP', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(101, 'G(N)', 'After Short Stop Normal Stop', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(102, 'H', 'End filling', 2, 2, 4, 2, 0, 0, 0, 0, 0, 1, 7, 1, NULL, NULL, NULL, NULL, NULL),
(103, 'R', 'Random QC', 2, 2, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(104, 'R(P)', 'Random Prod', 2, 2, 3, 0, 0, 0, 0, 0, 0, 0, 3, 1, NULL, NULL, NULL, NULL, NULL),
(105, 'R(S)', 'Random Resampling', 2, 2, 10, 0, 0, 0, 0, 0, 0, 0, 10, 1, NULL, NULL, NULL, NULL, NULL),
(106, 'A', 'Start Filling', 2, 3, 4, 2, 0, 4, 1, 1, 0, 2, 14, 1, NULL, NULL, NULL, NULL, NULL),
(107, 'B', 'Before Paper', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(108, 'B(SP)', 'Before Paper (Sambungan Pabrik)', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(109, 'C', 'After Paper', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(110, 'C(SP)', 'After Paper  (Sambung Pabrik )', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(111, 'D', 'Before Strip', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(112, 'E', 'After Strip', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(113, 'F', 'Before Short Stop', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(114, 'F(B)', 'Before Short Stop Paper', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(115, 'F(D)', 'Before Short Stop Strip', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(116, 'F(H)', 'Before Short Stop CIP', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(117, 'F(N)', 'Before Short Stop Normal Stop', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(118, 'G', 'After Short Stop', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(119, 'G(A)', 'After Short Stop Paper', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(120, 'G(C)', 'After Short Stop Strip', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(121, 'G(E)', 'After Short Stop CIP', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(122, 'G(N)', 'After Short Stop Normal Stop', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(123, 'H', 'End filling', 2, 3, 4, 2, 0, 0, 0, 0, 0, 1, 7, 1, NULL, NULL, NULL, NULL, NULL),
(124, 'R', 'Random QC', 2, 3, 4, 2, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, NULL),
(125, 'R(P)', 'Random Prod', 2, 3, 3, 2, 0, 0, 0, 0, 0, 0, 5, 1, NULL, NULL, NULL, NULL, NULL),
(126, 'R(S)', 'Random Resampling', 2, 3, 10, 0, 0, 0, 0, 0, 0, 0, 10, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `flowmeters`
--

CREATE TABLE `flowmeters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flowmeter_workcenter_id` bigint(20) NOT NULL COMMENT 'connected to flowmeter workcenter',
  `flowmeter_unit_id` bigint(20) NOT NULL COMMENT 'connected to flowmeter unit',
  `flowmeter_location_id` bigint(20) NOT NULL COMMENT 'connected to flowmeter location',
  `flowmeter_name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ini untuk nama flowmetersnya yang akan muncul di table daily monitoring',
  `flowmeter_code` char(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ini untuk nama flowmetersnya yang akan muncul di table daily monitoring',
  `spek_min` double DEFAULT NULL,
  `spek_max` double DEFAULT NULL,
  `recording_schedule` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 => perhari, 1 => pershift , 2 => perjam , 3 => tidak ada pengamatan',
  `usage_formula_id` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `flowmeters`
--

INSERT INTO `flowmeters` (`id`, `flowmeter_workcenter_id`, `flowmeter_unit_id`, `flowmeter_location_id`, `flowmeter_name`, `flowmeter_code`, `spek_min`, `spek_max`, `recording_schedule`, `usage_formula_id`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 'Deepwell 1  ESDM', 'E1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(2, 1, 1, 1, 'Deepwell 2 ESDM', 'E2', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(3, 1, 1, 1, 'Deepwell 3 ESDM', 'E3', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(4, 1, 1, 1, 'Deepwell 4 ESDM', 'E4', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(5, 2, 1, 2, 'Input Rain water WTP IE', 'WI1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(6, 2, 1, 2, 'Input Raw water WTP IE', 'WI2', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(7, 2, 1, 2, 'Input process Soft 1', 'WD1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(8, 2, 1, 2, 'Input process Soft 2', 'WS1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(9, 2, 1, 2, 'Input Embung', 'WE1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(10, 2, 1, 2, 'Input Process Recycle', 'WR1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(11, 2, 1, 2, 'Permeate RO', 'WP1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(12, 2, 1, 2, 'Reject Water', 'WR2', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(13, 2, 1, 2, 'Waste WTP IE', 'WW1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(14, 2, 1, 2, 'Waste WTP Recycle', 'WW2', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(15, 3, 1, 1, 'Product Water', 'DDW1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(16, 3, 1, 3, 'Boiler Water', 'DSC1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(17, 3, 1, 3, 'Product Water Ruby', 'DDR1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(18, 3, 1, 3, 'Product Water HB', 'DDH1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(19, 3, 1, 1, 'Soft Water (Production) - 3inch', 'DSW1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(20, 3, 1, 1, 'Soft Water (Production) - 4inch', 'DSW2', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(21, 3, 1, 3, 'Soft Water Ruby', 'DSR1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(22, 3, 1, 3, 'Soft water Non-Produksi', 'DSN1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(23, 3, 1, 3, 'Soft water Gedung Depan', 'DSD1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(24, 3, 1, 3, 'Soft Water HB Produksi', 'DSH1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(25, 3, 1, 3, 'Soft Water HB', 'DSH2', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(26, 3, 1, 3, 'Soft water lubrikasi', 'DSL1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(27, 3, 1, 3, 'Soft water Cooling Tower', 'DSC1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(28, 3, 1, 3, 'Service Water (all plant)', 'DSW2', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(29, 3, 1, 3, 'Soft Water Kantin', 'DSK1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(30, 4, 1, 4, 'IPAL HB & Blowdown Boiler', 'WWH1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(31, 4, 1, 4, 'WWTP Input - Sumpit', 'WWI1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(32, 4, 1, 4, 'WWTP process - Equal', 'WWP1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(33, 4, 1, 4, 'WWTP Output 1', 'WWO1', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL),
(34, 4, 1, 4, 'WWTP Output 2', 'WWO2', NULL, NULL, '0', NULL, 1, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `flowmeter_categories`
--

CREATE TABLE `flowmeter_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flowmeter_category` char(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ini kaya sejenis flow meternya air , listrik , gas',
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `flowmeter_categories`
--

INSERT INTO `flowmeter_categories` (`id`, `flowmeter_category`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Air', 1, 1, 1, NULL, '2020-05-17 19:54:43', '2020-05-17 20:54:56', NULL),
(2, 'Gas', 1, 1, NULL, NULL, '2020-05-17 20:58:17', '2020-05-17 20:58:17', NULL),
(3, 'Listrik', 1, 1, NULL, NULL, '2020-05-17 20:58:23', '2020-05-17 20:58:23', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `flowmeter_consumption_realisation_details`
--

CREATE TABLE `flowmeter_consumption_realisation_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `flowmeter_consumption_realisation_heads`
--

CREATE TABLE `flowmeter_consumption_realisation_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `flowmeter_formulas`
--

CREATE TABLE `flowmeter_formulas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `formula_code` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ini untuk code formulanya',
  `flowmeter_formula` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'disini disimpan rumus untuk semuanya dalam bentuk json, apabila di isi kosong maka akan merefer ke perhitungan hari sebelumnya.',
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `flowmeter_formulas`
--

INSERT INTO `flowmeter_formulas` (`id`, `formula_code`, `flowmeter_formula`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'DEFAULT', 'Penggunaan Hari Ini = Nilai Pengamatan Hari Ini - Pengamatan Hari Kemarin', 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'NDW1', '[\"FU_DDW1\",\"-\",\"FU_DSC1\",\"-\",\"FU_DDR1\",\"-\",\"FU_DDH1\"]', 1, 1, NULL, NULL, '2020-07-19 05:48:00', '2020-07-19 05:48:00', NULL),
(3, 'NSW1', '[\"(\",\"FU_DSW1\",\"+\",\"FU_DSW2\",\")\",\"\",\"-\",\"FU_DSR1\",\"-\",\"FU_DSN1\",\"-\",\"FU_DSD1\",\"-\",\"FU_DSH1\",\"-\",\"FU_DSH2\",\"-\",\"FU_DSL1\",\"-\",\"FU_DSC1\",\"-\",\"FU_HSK1\"]', 1, 1, NULL, NULL, '2020-07-19 06:07:19', '2020-07-19 06:07:19', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `flowmeter_locations`
--

CREATE TABLE `flowmeter_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flowmeter_category_id` bigint(20) NOT NULL,
  `flowmeter_location` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `flowmeter_locations`
--

INSERT INTO `flowmeter_locations` (`id`, `flowmeter_category_id`, `flowmeter_location`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Induk', 1, 1, NULL, NULL, '2020-07-17 13:31:04', '2020-07-17 13:31:04', NULL),
(2, 1, 'Process WTP', 1, 1, NULL, NULL, '2020-07-17 13:31:17', '2020-07-17 13:31:17', NULL),
(3, 1, 'Water Distribution', 1, 1, NULL, NULL, '2020-07-17 13:32:55', '2020-07-17 13:32:55', NULL),
(4, 1, 'Waste Water', 1, 1, NULL, NULL, '2020-07-17 13:33:12', '2020-07-17 13:33:12', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `flowmeter_units`
--

CREATE TABLE `flowmeter_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flowmeter_unit` char(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ini untuk satuan ',
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `flowmeter_units`
--

INSERT INTO `flowmeter_units` (`id`, `flowmeter_unit`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'm3', 1, 1, NULL, NULL, '2020-07-17 13:33:36', '2020-07-17 13:33:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `flowmeter_usages`
--

CREATE TABLE `flowmeter_usages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flowmeter_workcenter_id` bigint(20) NOT NULL COMMENT 'connected to flowmeter workcenter',
  `flowmeter_formula_id` bigint(20) NOT NULL COMMENT 'connected to flowmeter formula untuk menentukan rumus yang dipakai',
  `flowmeter_name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ini untuk nama pada penggunaan bisa saja berbeda dengan yang ada di table usage monitoring.',
  `flowmeter_code` char(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Panduan untuk rumus flowmeter',
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `flowmeter_usages`
--

INSERT INTO `flowmeter_usages` (`id`, `flowmeter_workcenter_id`, `flowmeter_formula_id`, `flowmeter_name`, `flowmeter_code`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Deepwell 1 ESDM', 'FU_E1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(2, 1, 1, 'Deepwell 2 ESDM', 'FU_E2', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(3, 1, 1, 'Deepwell 3 ESDM', 'FU_E3', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(4, 1, 1, 'Deepwell 4 ESDM', 'FU_E4', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(5, 2, 1, 'Input Rain water WTP IE', 'FU_WI1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(6, 2, 1, 'Input Raw water WTP IE', 'FU_WI2', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(7, 2, 1, 'Input process Soft 1', 'FU_WD1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(8, 2, 1, 'Input process Soft 2', 'FU_WS1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(9, 2, 1, 'Input Embung', 'FU_WE1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(10, 2, 1, 'Input Process Recycle', 'FU_WR1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(11, 2, 1, 'Permeate RO', 'FU_WP1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(12, 2, 1, 'Reject Water', 'FU_WR2', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(13, 2, 1, 'Waste WTP IE', 'FU_WW1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(14, 2, 1, 'Waste WTP Recycle', 'FU_WW2', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(15, 3, 1, 'Product Water', 'FU_DDW1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(16, 3, 1, 'Boiler Water', 'FU_DSC1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(17, 3, 1, 'Product Water Ruby', 'FU_DDR1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(18, 3, 1, 'Product Water HB', 'FU_DDH1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(19, 3, 1, 'Soft Water (Production) - 3\"', 'FU_DSW1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(20, 3, 1, 'Soft Water (Production) - 4\"', 'FU_DSW2', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(21, 3, 1, 'Soft water Ruby', 'FU_DSR1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(22, 3, 1, 'Soft water Non-Produksi', 'FU_DSN1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(23, 3, 1, 'Soft water Gedung Depan', 'FU_DSD1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(24, 3, 1, 'Soft Water HB Produksi', 'FU_DSH1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(25, 3, 1, 'Soft Water HB', 'FU_DSH2', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(26, 3, 1, 'Soft water lubrikasi', 'FU_DSL1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(27, 3, 1, 'Soft water Cooling Tower', 'FU_DSC1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(28, 3, 1, 'Service Water (all plant)', 'FU_DSW2', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(31, 3, 1, 'Soft Water Kantin', 'FU_DSK1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(32, 4, 1, 'IPAL HB & Blowdown Boiler', 'FU_WWH1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(33, 4, 1, 'WWTP Input - Sumpit', 'FU_WWI1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(34, 4, 1, 'WWTP process - Equal', 'FU_WWP1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(35, 4, 1, 'WWTP Output', 'FU_WWO1', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(36, 4, 1, 'WWTP Output 2', 'FU_WWO2', 1, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(37, 3, 2, 'Product Water Produksi NFI', 'FU-NDW1', 1, 1, NULL, NULL, '2020-07-19 05:57:46', '2020-07-19 05:57:46', NULL),
(38, 3, 3, 'Soft Water Produksi NFI', 'FU-NSW1', 1, 1, NULL, NULL, '2020-07-19 06:08:34', '2020-07-19 06:08:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `flowmeter_workcenters`
--

CREATE TABLE `flowmeter_workcenters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flowmeter_category_id` bigint(20) NOT NULL COMMENT 'connected to flowmeter category table',
  `flowmeter_workcenter` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `flowmeter_workcenters`
--

INSERT INTO `flowmeter_workcenters` (`id`, `flowmeter_category_id`, `flowmeter_workcenter`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Flometer ESDM', 1, 1, NULL, NULL, '2020-07-17 13:26:53', '2020-07-17 13:26:53', NULL),
(2, 1, 'Process WTP', 1, 1, NULL, NULL, '2020-07-17 13:30:06', '2020-07-17 13:30:06', NULL),
(3, 1, 'Water Distribution', 1, 1, NULL, NULL, '2020-07-17 13:30:21', '2020-07-17 13:30:21', NULL),
(4, 1, 'Waste Water', 1, 1, NULL, NULL, '2020-07-17 13:30:34', '2020-07-17 13:30:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `icons`
--

CREATE TABLE `icons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icons` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `icons`
--

INSERT INTO `icons` (`id`, `icons`, `created_at`, `updated_at`) VALUES
(1, 'fa-500px', NULL, NULL),
(2, 'fa-address-book', NULL, NULL),
(3, 'fa-address-book-o', NULL, NULL),
(4, 'fa-address-card', NULL, NULL),
(5, 'fa-address-card-o', NULL, NULL),
(6, 'fa-adjust', NULL, NULL),
(7, 'fa-adn', NULL, NULL),
(8, 'fa-align-center', NULL, NULL),
(9, 'fa-align-justify', NULL, NULL),
(10, 'fa-align-left', NULL, NULL),
(11, 'fa-align-right', NULL, NULL),
(12, 'fa-amazon', NULL, NULL),
(13, 'fa-ambulance', NULL, NULL),
(14, 'fa-american-sign-lan', NULL, NULL),
(15, 'fa-anchor', NULL, NULL),
(16, 'fa-android', NULL, NULL),
(17, 'fa-angellist', NULL, NULL),
(18, 'fa-angle-double-down', NULL, NULL),
(19, 'fa-angle-double-left', NULL, NULL),
(20, 'fa-angle-double-righ', NULL, NULL),
(21, 'fa-angle-double-up', NULL, NULL),
(22, 'fa-angle-down', NULL, NULL),
(23, 'fa-angle-left', NULL, NULL),
(24, 'fa-angle-right', NULL, NULL),
(25, 'fa-angle-up', NULL, NULL),
(26, 'fa-apple', NULL, NULL),
(27, 'fa-archive', NULL, NULL),
(28, 'fa-area-chart', NULL, NULL),
(29, 'fa-arrow-circle-down', NULL, NULL),
(30, 'fa-arrow-circle-left', NULL, NULL),
(31, 'fa-arrow-circle-o-do', NULL, NULL),
(32, 'fa-arrow-circle-o-le', NULL, NULL),
(33, 'fa-arrow-circle-o-ri', NULL, NULL),
(34, 'fa-arrow-circle-o-up', NULL, NULL),
(35, 'fa-arrow-circle-righ', NULL, NULL),
(36, 'fa-arrow-circle-up', NULL, NULL),
(37, 'fa-arrow-down', NULL, NULL),
(38, 'fa-arrow-left', NULL, NULL),
(39, 'fa-arrow-right', NULL, NULL),
(40, 'fa-arrow-up', NULL, NULL),
(41, 'fa-arrows', NULL, NULL),
(42, 'fa-arrows-alt', NULL, NULL),
(43, 'fa-arrows-h', NULL, NULL),
(44, 'fa-arrows-v', NULL, NULL),
(45, 'fa-asl-interpreting', NULL, NULL),
(46, 'fa-assistive-listeni', NULL, NULL),
(47, 'fa-asterisk', NULL, NULL),
(48, 'fa-at', NULL, NULL),
(49, 'fa-audio-description', NULL, NULL),
(50, 'fa-automobile', NULL, NULL),
(51, 'fa-backward', NULL, NULL),
(52, 'fa-balance-scale', NULL, NULL),
(53, 'fa-ban', NULL, NULL),
(54, 'fa-bandcamp', NULL, NULL),
(55, 'fa-bank', NULL, NULL),
(56, 'fa-bar-chart', NULL, NULL),
(57, 'fa-bar-chart-o', NULL, NULL),
(58, 'fa-barcode', NULL, NULL),
(59, 'fa-bars', NULL, NULL),
(60, 'fa-bath', NULL, NULL),
(61, 'fa-bathtub', NULL, NULL),
(62, 'fa-battery', NULL, NULL),
(63, 'fa-battery-0', NULL, NULL),
(64, 'fa-battery-1', NULL, NULL),
(65, 'fa-battery-2', NULL, NULL),
(66, 'fa-battery-3', NULL, NULL),
(67, 'fa-battery-4', NULL, NULL),
(68, 'fa-battery-empty', NULL, NULL),
(69, 'fa-battery-full', NULL, NULL),
(70, 'fa-battery-half', NULL, NULL),
(71, 'fa-battery-quarter', NULL, NULL),
(72, 'fa-battery-three-qua', NULL, NULL),
(73, 'fa-bed', NULL, NULL),
(74, 'fa-beer', NULL, NULL),
(75, 'fa-behance', NULL, NULL),
(76, 'fa-behance-square', NULL, NULL),
(77, 'fa-bell', NULL, NULL),
(78, 'fa-bell-o', NULL, NULL),
(79, 'fa-bell-slash', NULL, NULL),
(80, 'fa-bell-slash-o', NULL, NULL),
(81, 'fa-bicycle', NULL, NULL),
(82, 'fa-binoculars', NULL, NULL),
(83, 'fa-birthday-cake', NULL, NULL),
(84, 'fa-bitbucket', NULL, NULL),
(85, 'fa-bitbucket-square', NULL, NULL),
(86, 'fa-bitcoin', NULL, NULL),
(87, 'fa-black-tie', NULL, NULL),
(88, 'fa-blind', NULL, NULL),
(89, 'fa-bluetooth', NULL, NULL),
(90, 'fa-bluetooth-b', NULL, NULL),
(91, 'fa-bold', NULL, NULL),
(92, 'fa-bolt', NULL, NULL),
(93, 'fa-bomb', NULL, NULL),
(94, 'fa-book', NULL, NULL),
(95, 'fa-bookmark', NULL, NULL),
(96, 'fa-bookmark-o', NULL, NULL),
(97, 'fa-braille', NULL, NULL),
(98, 'fa-briefcase', NULL, NULL),
(99, 'fa-btc', NULL, NULL),
(100, 'fa-bug', NULL, NULL),
(101, 'fa-building', NULL, NULL),
(102, 'fa-building-o', NULL, NULL),
(103, 'fa-bullhorn', NULL, NULL),
(104, 'fa-bullseye', NULL, NULL),
(105, 'fa-bus', NULL, NULL),
(106, 'fa-buysellads', NULL, NULL),
(107, 'fa-cab', NULL, NULL),
(108, 'fa-calculator', NULL, NULL),
(109, 'fa-calendar', NULL, NULL),
(110, 'fa-calendar-check-o', NULL, NULL),
(111, 'fa-calendar-minus-o', NULL, NULL),
(112, 'fa-calendar-o', NULL, NULL),
(113, 'fa-calendar-plus-o', NULL, NULL),
(114, 'fa-calendar-times-o', NULL, NULL),
(115, 'fa-camera', NULL, NULL),
(116, 'fa-camera-retro', NULL, NULL),
(117, 'fa-car', NULL, NULL),
(118, 'fa-caret-down', NULL, NULL),
(119, 'fa-caret-left', NULL, NULL),
(120, 'fa-caret-right', NULL, NULL),
(121, 'fa-caret-square-o-do', NULL, NULL),
(122, 'fa-caret-square-o-le', NULL, NULL),
(123, 'fa-caret-square-o-ri', NULL, NULL),
(124, 'fa-caret-square-o-up', NULL, NULL),
(125, 'fa-caret-up', NULL, NULL),
(126, 'fa-cart-arrow-down', NULL, NULL),
(127, 'fa-cart-plus', NULL, NULL),
(128, 'fa-cc', NULL, NULL),
(129, 'fa-cc-amex', NULL, NULL),
(130, 'fa-cc-diners-club', NULL, NULL),
(131, 'fa-cc-discover', NULL, NULL),
(132, 'fa-cc-jcb', NULL, NULL),
(133, 'fa-cc-mastercard', NULL, NULL),
(134, 'fa-cc-paypal', NULL, NULL),
(135, 'fa-cc-stripe', NULL, NULL),
(136, 'fa-cc-visa', NULL, NULL),
(137, 'fa-certificate', NULL, NULL),
(138, 'fa-chain', NULL, NULL),
(139, 'fa-chain-broken', NULL, NULL),
(140, 'fa-check', NULL, NULL),
(141, 'fa-check-circle', NULL, NULL),
(142, 'fa-check-circle-o', NULL, NULL),
(143, 'fa-check-square', NULL, NULL),
(144, 'fa-check-square-o', NULL, NULL),
(145, 'fa-chevron-circle-do', NULL, NULL),
(146, 'fa-chevron-circle-le', NULL, NULL),
(147, 'fa-chevron-circle-ri', NULL, NULL),
(148, 'fa-chevron-circle-up', NULL, NULL),
(149, 'fa-chevron-down', NULL, NULL),
(150, 'fa-chevron-left', NULL, NULL),
(151, 'fa-chevron-right', NULL, NULL),
(152, 'fa-chevron-up', NULL, NULL),
(153, 'fa-child', NULL, NULL),
(154, 'fa-chrome', NULL, NULL),
(155, 'fa-circle', NULL, NULL),
(156, 'fa-circle-o', NULL, NULL),
(157, 'fa-circle-o-notch', NULL, NULL),
(158, 'fa-circle-thin', NULL, NULL),
(159, 'fa-clipboard', NULL, NULL),
(160, 'fa-clock-o', NULL, NULL),
(161, 'fa-clone', NULL, NULL),
(162, 'fa-close', NULL, NULL),
(163, 'fa-cloud', NULL, NULL),
(164, 'fa-cloud-download', NULL, NULL),
(165, 'fa-cloud-upload', NULL, NULL),
(166, 'fa-cny', NULL, NULL),
(167, 'fa-code', NULL, NULL),
(168, 'fa-code-fork', NULL, NULL),
(169, 'fa-codepen', NULL, NULL),
(170, 'fa-codiepie', NULL, NULL),
(171, 'fa-coffee', NULL, NULL),
(172, 'fa-cog', NULL, NULL),
(173, 'fa-cogs', NULL, NULL),
(174, 'fa-columns', NULL, NULL),
(175, 'fa-comment', NULL, NULL),
(176, 'fa-comment-o', NULL, NULL),
(177, 'fa-commenting', NULL, NULL),
(178, 'fa-commenting-o', NULL, NULL),
(179, 'fa-comments', NULL, NULL),
(180, 'fa-comments-o', NULL, NULL),
(181, 'fa-compass', NULL, NULL),
(182, 'fa-compress', NULL, NULL),
(183, 'fa-connectdevelop', NULL, NULL),
(184, 'fa-contao', NULL, NULL),
(185, 'fa-copy', NULL, NULL),
(186, 'fa-copyright', NULL, NULL),
(187, 'fa-creative-commons', NULL, NULL),
(188, 'fa-credit-card', NULL, NULL),
(189, 'fa-credit-card-alt', NULL, NULL),
(190, 'fa-crop', NULL, NULL),
(191, 'fa-crosshairs', NULL, NULL),
(192, 'fa-css3', NULL, NULL),
(193, 'fa-cube', NULL, NULL),
(194, 'fa-cubes', NULL, NULL),
(195, 'fa-cut', NULL, NULL),
(196, 'fa-cutlery', NULL, NULL),
(197, 'fa-dashboard', NULL, NULL),
(198, 'fa-dashcube', NULL, NULL),
(199, 'fa-database', NULL, NULL),
(200, 'fa-deaf', NULL, NULL),
(201, 'fa-deafness', NULL, NULL),
(202, 'fa-dedent', NULL, NULL),
(203, 'fa-delicious', NULL, NULL),
(204, 'fa-desktop', NULL, NULL),
(205, 'fa-deviantart', NULL, NULL),
(206, 'fa-diamond', NULL, NULL),
(207, 'fa-digg', NULL, NULL),
(208, 'fa-dollar', NULL, NULL),
(209, 'fa-dot-circle-o', NULL, NULL),
(210, 'fa-download', NULL, NULL),
(211, 'fa-dribbble', NULL, NULL),
(212, 'fa-drivers-license', NULL, NULL),
(213, 'fa-drivers-license-o', NULL, NULL),
(214, 'fa-dropbox', NULL, NULL),
(215, 'fa-drupal', NULL, NULL),
(216, 'fa-edge', NULL, NULL),
(217, 'fa-edit', NULL, NULL),
(218, 'fa-eercast', NULL, NULL),
(219, 'fa-eject', NULL, NULL),
(220, 'fa-ellipsis-h', NULL, NULL),
(221, 'fa-ellipsis-v', NULL, NULL),
(222, 'fa-empire', NULL, NULL),
(223, 'fa-envelope', NULL, NULL),
(224, 'fa-envelope-o', NULL, NULL),
(225, 'fa-envelope-open', NULL, NULL),
(226, 'fa-envelope-open-o', NULL, NULL),
(227, 'fa-envelope-square', NULL, NULL),
(228, 'fa-envira', NULL, NULL),
(229, 'fa-eraser', NULL, NULL),
(230, 'fa-etsy', NULL, NULL),
(231, 'fa-eur', NULL, NULL),
(232, 'fa-euro', NULL, NULL),
(233, 'fa-exchange', NULL, NULL),
(234, 'fa-exclamation', NULL, NULL),
(235, 'fa-exclamation-circl', NULL, NULL),
(236, 'fa-exclamation-trian', NULL, NULL),
(237, 'fa-expand', NULL, NULL),
(238, 'fa-expeditedssl', NULL, NULL),
(239, 'fa-external-link', NULL, NULL),
(240, 'fa-external-link-squ', NULL, NULL),
(241, 'fa-eye', NULL, NULL),
(242, 'fa-eye-slash', NULL, NULL),
(243, 'fa-eyedropper', NULL, NULL),
(244, 'fa-fa', NULL, NULL),
(245, 'fa-facebook', NULL, NULL),
(246, 'fa-facebook-f', NULL, NULL),
(247, 'fa-facebook-official', NULL, NULL),
(248, 'fa-facebook-square', NULL, NULL),
(249, 'fa-fast-backward', NULL, NULL),
(250, 'fa-fast-forward', NULL, NULL),
(251, 'fa-fax', NULL, NULL),
(252, 'fa-feed', NULL, NULL),
(253, 'fa-female', NULL, NULL),
(254, 'fa-fighter-jet', NULL, NULL),
(255, 'fa-file', NULL, NULL),
(256, 'fa-file-archive-o', NULL, NULL),
(257, 'fa-file-audio-o', NULL, NULL),
(258, 'fa-file-code-o', NULL, NULL),
(259, 'fa-file-excel-o', NULL, NULL),
(260, 'fa-file-image-o', NULL, NULL),
(261, 'fa-file-movie-o', NULL, NULL),
(262, 'fa-file-o', NULL, NULL),
(263, 'fa-file-pdf-o', NULL, NULL),
(264, 'fa-file-photo-o', NULL, NULL),
(265, 'fa-file-picture-o', NULL, NULL),
(266, 'fa-file-powerpoint-o', NULL, NULL),
(267, 'fa-file-sound-o', NULL, NULL),
(268, 'fa-file-text', NULL, NULL),
(269, 'fa-file-text-o', NULL, NULL),
(270, 'fa-file-video-o', NULL, NULL),
(271, 'fa-file-word-o', NULL, NULL),
(272, 'fa-file-zip-o', NULL, NULL),
(273, 'fa-files-o', NULL, NULL),
(274, 'fa-film', NULL, NULL),
(275, 'fa-filter', NULL, NULL),
(276, 'fa-fire', NULL, NULL),
(277, 'fa-fire-extinguisher', NULL, NULL),
(278, 'fa-firefox', NULL, NULL),
(279, 'fa-first-order', NULL, NULL),
(280, 'fa-flag', NULL, NULL),
(281, 'fa-flag-checkered', NULL, NULL),
(282, 'fa-flag-o', NULL, NULL),
(283, 'fa-flash', NULL, NULL),
(284, 'fa-flask', NULL, NULL),
(285, 'fa-flickr', NULL, NULL),
(286, 'fa-floppy-o', NULL, NULL),
(287, 'fa-folder', NULL, NULL),
(288, 'fa-folder-o', NULL, NULL),
(289, 'fa-folder-open', NULL, NULL),
(290, 'fa-folder-open-o', NULL, NULL),
(291, 'fa-font', NULL, NULL),
(292, 'fa-font-awesome', NULL, NULL),
(293, 'fa-fonticons', NULL, NULL),
(294, 'fa-fort-awesome', NULL, NULL),
(295, 'fa-forumbee', NULL, NULL),
(296, 'fa-forward', NULL, NULL),
(297, 'fa-foursquare', NULL, NULL),
(298, 'fa-free-code-camp', NULL, NULL),
(299, 'fa-frown-o', NULL, NULL),
(300, 'fa-futbol-o', NULL, NULL),
(301, 'fa-gamepad', NULL, NULL),
(302, 'fa-gavel', NULL, NULL),
(303, 'fa-gbp', NULL, NULL),
(304, 'fa-ge', NULL, NULL),
(305, 'fa-gear', NULL, NULL),
(306, 'fa-gears', NULL, NULL),
(307, 'fa-genderless', NULL, NULL),
(308, 'fa-get-pocket', NULL, NULL),
(309, 'fa-gg', NULL, NULL),
(310, 'fa-gg-circle', NULL, NULL),
(311, 'fa-gift', NULL, NULL),
(312, 'fa-git', NULL, NULL),
(313, 'fa-git-square', NULL, NULL),
(314, 'fa-github', NULL, NULL),
(315, 'fa-github-alt', NULL, NULL),
(316, 'fa-github-square', NULL, NULL),
(317, 'fa-gitlab', NULL, NULL),
(318, 'fa-gittip', NULL, NULL),
(319, 'fa-glass', NULL, NULL),
(320, 'fa-glide', NULL, NULL),
(321, 'fa-glide-g', NULL, NULL),
(322, 'fa-globe', NULL, NULL),
(323, 'fa-google', NULL, NULL),
(324, 'fa-google-plus', NULL, NULL),
(325, 'fa-google-plus-circl', NULL, NULL),
(326, 'fa-google-plus-offic', NULL, NULL),
(327, 'fa-google-plus-squar', NULL, NULL),
(328, 'fa-google-wallet', NULL, NULL),
(329, 'fa-graduation-cap', NULL, NULL),
(330, 'fa-gratipay', NULL, NULL),
(331, 'fa-grav', NULL, NULL),
(332, 'fa-group', NULL, NULL),
(333, 'fa-h-square', NULL, NULL),
(334, 'fa-hacker-news', NULL, NULL),
(335, 'fa-hand-grab-o', NULL, NULL),
(336, 'fa-hand-lizard-o', NULL, NULL),
(337, 'fa-hand-o-down', NULL, NULL),
(338, 'fa-hand-o-left', NULL, NULL),
(339, 'fa-hand-o-right', NULL, NULL),
(340, 'fa-hand-o-up', NULL, NULL),
(341, 'fa-hand-paper-o', NULL, NULL),
(342, 'fa-hand-peace-o', NULL, NULL),
(343, 'fa-hand-pointer-o', NULL, NULL),
(344, 'fa-hand-rock-o', NULL, NULL),
(345, 'fa-hand-scissors-o', NULL, NULL),
(346, 'fa-hand-spock-o', NULL, NULL),
(347, 'fa-hand-stop-o', NULL, NULL),
(348, 'fa-handshake-o', NULL, NULL),
(349, 'fa-hard-of-hearing', NULL, NULL),
(350, 'fa-hashtag', NULL, NULL),
(351, 'fa-hdd-o', NULL, NULL),
(352, 'fa-header', NULL, NULL),
(353, 'fa-headphones', NULL, NULL),
(354, 'fa-heart', NULL, NULL),
(355, 'fa-heart-o', NULL, NULL),
(356, 'fa-heartbeat', NULL, NULL),
(357, 'fa-history', NULL, NULL),
(358, 'fa-home', NULL, NULL),
(359, 'fa-hospital-o', NULL, NULL),
(360, 'fa-hotel', NULL, NULL),
(361, 'fa-hourglass', NULL, NULL),
(362, 'fa-hourglass-1', NULL, NULL),
(363, 'fa-hourglass-2', NULL, NULL),
(364, 'fa-hourglass-3', NULL, NULL),
(365, 'fa-hourglass-end', NULL, NULL),
(366, 'fa-hourglass-half', NULL, NULL),
(367, 'fa-hourglass-o', NULL, NULL),
(368, 'fa-hourglass-start', NULL, NULL),
(369, 'fa-houzz', NULL, NULL),
(370, 'fa-html5', NULL, NULL),
(371, 'fa-i-cursor', NULL, NULL),
(372, 'fa-id-badge', NULL, NULL),
(373, 'fa-id-card', NULL, NULL),
(374, 'fa-id-card-o', NULL, NULL),
(375, 'fa-ils', NULL, NULL),
(376, 'fa-image', NULL, NULL),
(377, 'fa-imdb', NULL, NULL),
(378, 'fa-inbox', NULL, NULL),
(379, 'fa-indent', NULL, NULL),
(380, 'fa-industry', NULL, NULL),
(381, 'fa-info', NULL, NULL),
(382, 'fa-info-circle', NULL, NULL),
(383, 'fa-inr', NULL, NULL),
(384, 'fa-instagram', NULL, NULL),
(385, 'fa-institution', NULL, NULL),
(386, 'fa-internet-explorer', NULL, NULL),
(387, 'fa-intersex', NULL, NULL),
(388, 'fa-ioxhost', NULL, NULL),
(389, 'fa-italic', NULL, NULL),
(390, 'fa-joomla', NULL, NULL),
(391, 'fa-jpy', NULL, NULL),
(392, 'fa-jsfiddle', NULL, NULL),
(393, 'fa-key', NULL, NULL),
(394, 'fa-keyboard-o', NULL, NULL),
(395, 'fa-krw', NULL, NULL),
(396, 'fa-language', NULL, NULL),
(397, 'fa-laptop', NULL, NULL),
(398, 'fa-lastfm', NULL, NULL),
(399, 'fa-lastfm-square', NULL, NULL),
(400, 'fa-leaf', NULL, NULL),
(401, 'fa-leanpub', NULL, NULL),
(402, 'fa-legal', NULL, NULL),
(403, 'fa-lemon-o', NULL, NULL),
(404, 'fa-level-down', NULL, NULL),
(405, 'fa-level-up', NULL, NULL),
(406, 'fa-life-bouy', NULL, NULL),
(407, 'fa-life-buoy', NULL, NULL),
(408, 'fa-life-ring', NULL, NULL),
(409, 'fa-life-saver', NULL, NULL),
(410, 'fa-lightbulb-o', NULL, NULL),
(411, 'fa-line-chart', NULL, NULL),
(412, 'fa-link', NULL, NULL),
(413, 'fa-linkedin', NULL, NULL),
(414, 'fa-linkedin-square', NULL, NULL),
(415, 'fa-linode', NULL, NULL),
(416, 'fa-linux', NULL, NULL),
(417, 'fa-list', NULL, NULL),
(418, 'fa-list-alt', NULL, NULL),
(419, 'fa-list-ol', NULL, NULL),
(420, 'fa-list-ul', NULL, NULL),
(421, 'fa-location-arrow', NULL, NULL),
(422, 'fa-lock', NULL, NULL),
(423, 'fa-long-arrow-down', NULL, NULL),
(424, 'fa-long-arrow-left', NULL, NULL),
(425, 'fa-long-arrow-right', NULL, NULL),
(426, 'fa-long-arrow-up', NULL, NULL),
(427, 'fa-low-vision', NULL, NULL),
(428, 'fa-magic', NULL, NULL),
(429, 'fa-magnet', NULL, NULL),
(430, 'fa-mail-forward', NULL, NULL),
(431, 'fa-mail-reply', NULL, NULL),
(432, 'fa-mail-reply-all', NULL, NULL),
(433, 'fa-male', NULL, NULL),
(434, 'fa-map', NULL, NULL),
(435, 'fa-map-marker', NULL, NULL),
(436, 'fa-map-o', NULL, NULL),
(437, 'fa-map-pin', NULL, NULL),
(438, 'fa-map-signs', NULL, NULL),
(439, 'fa-mars', NULL, NULL),
(440, 'fa-mars-double', NULL, NULL),
(441, 'fa-mars-stroke', NULL, NULL),
(442, 'fa-mars-stroke-h', NULL, NULL),
(443, 'fa-mars-stroke-v', NULL, NULL),
(444, 'fa-maxcdn', NULL, NULL),
(445, 'fa-meanpath', NULL, NULL),
(446, 'fa-medium', NULL, NULL),
(447, 'fa-medkit', NULL, NULL),
(448, 'fa-meetup', NULL, NULL),
(449, 'fa-meh-o', NULL, NULL),
(450, 'fa-mercury', NULL, NULL),
(451, 'fa-microchip', NULL, NULL),
(452, 'fa-microphone', NULL, NULL),
(453, 'fa-microphone-slash', NULL, NULL),
(454, 'fa-minus', NULL, NULL),
(455, 'fa-minus-circle', NULL, NULL),
(456, 'fa-minus-square', NULL, NULL),
(457, 'fa-minus-square-o', NULL, NULL),
(458, 'fa-mixcloud', NULL, NULL),
(459, 'fa-mobile', NULL, NULL),
(460, 'fa-mobile-phone', NULL, NULL),
(461, 'fa-modx', NULL, NULL),
(462, 'fa-money', NULL, NULL),
(463, 'fa-moon-o', NULL, NULL),
(464, 'fa-mortar-board', NULL, NULL),
(465, 'fa-motorcycle', NULL, NULL),
(466, 'fa-mouse-pointer', NULL, NULL),
(467, 'fa-music', NULL, NULL),
(468, 'fa-navicon', NULL, NULL),
(469, 'fa-neuter', NULL, NULL),
(470, 'fa-newspaper-o', NULL, NULL),
(471, 'fa-object-group', NULL, NULL),
(472, 'fa-object-ungroup', NULL, NULL),
(473, 'fa-odnoklassniki', NULL, NULL),
(474, 'fa-odnoklassniki-squ', NULL, NULL),
(475, 'fa-opencart', NULL, NULL),
(476, 'fa-openid', NULL, NULL),
(477, 'fa-opera', NULL, NULL),
(478, 'fa-optin-monster', NULL, NULL),
(479, 'fa-outdent', NULL, NULL),
(480, 'fa-pagelines', NULL, NULL),
(481, 'fa-paint-brush', NULL, NULL),
(482, 'fa-paper-plane', NULL, NULL),
(483, 'fa-paper-plane-o', NULL, NULL),
(484, 'fa-paperclip', NULL, NULL),
(485, 'fa-paragraph', NULL, NULL),
(486, 'fa-paste', NULL, NULL),
(487, 'fa-pause', NULL, NULL),
(488, 'fa-pause-circle', NULL, NULL),
(489, 'fa-pause-circle-o', NULL, NULL),
(490, 'fa-paw', NULL, NULL),
(491, 'fa-paypal', NULL, NULL),
(492, 'fa-pencil', NULL, NULL),
(493, 'fa-pencil-square', NULL, NULL),
(494, 'fa-pencil-square-o', NULL, NULL),
(495, 'fa-percent', NULL, NULL),
(496, 'fa-phone', NULL, NULL),
(497, 'fa-phone-square', NULL, NULL),
(498, 'fa-photo', NULL, NULL),
(499, 'fa-picture-o', NULL, NULL),
(500, 'fa-pie-chart', NULL, NULL),
(501, 'fa-pied-piper', NULL, NULL),
(502, 'fa-pied-piper-alt', NULL, NULL),
(503, 'fa-pied-piper-pp', NULL, NULL),
(504, 'fa-pinterest', NULL, NULL),
(505, 'fa-pinterest-p', NULL, NULL),
(506, 'fa-pinterest-square', NULL, NULL),
(507, 'fa-plane', NULL, NULL),
(508, 'fa-play', NULL, NULL),
(509, 'fa-play-circle', NULL, NULL),
(510, 'fa-play-circle-o', NULL, NULL),
(511, 'fa-plug', NULL, NULL),
(512, 'fa-plus', NULL, NULL),
(513, 'fa-plus-circle', NULL, NULL),
(514, 'fa-plus-square', NULL, NULL),
(515, 'fa-plus-square-o', NULL, NULL),
(516, 'fa-podcast', NULL, NULL),
(517, 'fa-power-off', NULL, NULL),
(518, 'fa-print', NULL, NULL),
(519, 'fa-product-hunt', NULL, NULL),
(520, 'fa-puzzle-piece', NULL, NULL),
(521, 'fa-qq', NULL, NULL),
(522, 'fa-qrcode', NULL, NULL),
(523, 'fa-question', NULL, NULL),
(524, 'fa-question-circle', NULL, NULL),
(525, 'fa-question-circle-o', NULL, NULL),
(526, 'fa-quora', NULL, NULL),
(527, 'fa-quote-left', NULL, NULL),
(528, 'fa-quote-right', NULL, NULL),
(529, 'fa-ra', NULL, NULL),
(530, 'fa-random', NULL, NULL),
(531, 'fa-ravelry', NULL, NULL),
(532, 'fa-rebel', NULL, NULL),
(533, 'fa-recycle', NULL, NULL),
(534, 'fa-reddit', NULL, NULL),
(535, 'fa-reddit-alien', NULL, NULL),
(536, 'fa-reddit-square', NULL, NULL),
(537, 'fa-refresh', NULL, NULL),
(538, 'fa-registered', NULL, NULL),
(539, 'fa-remove', NULL, NULL),
(540, 'fa-renren', NULL, NULL),
(541, 'fa-reorder', NULL, NULL),
(542, 'fa-repeat', NULL, NULL),
(543, 'fa-reply', NULL, NULL),
(544, 'fa-reply-all', NULL, NULL),
(545, 'fa-resistance', NULL, NULL),
(546, 'fa-retweet', NULL, NULL),
(547, 'fa-rmb', NULL, NULL),
(548, 'fa-road', NULL, NULL),
(549, 'fa-rocket', NULL, NULL),
(550, 'fa-rotate-left', NULL, NULL),
(551, 'fa-rotate-right', NULL, NULL),
(552, 'fa-rouble', NULL, NULL),
(553, 'fa-rss', NULL, NULL),
(554, 'fa-rss-square', NULL, NULL),
(555, 'fa-rub', NULL, NULL),
(556, 'fa-ruble', NULL, NULL),
(557, 'fa-rupee', NULL, NULL),
(558, 'fa-s15', NULL, NULL),
(559, 'fa-safari', NULL, NULL),
(560, 'fa-save', NULL, NULL),
(561, 'fa-scissors', NULL, NULL),
(562, 'fa-scribd', NULL, NULL),
(563, 'fa-search', NULL, NULL),
(564, 'fa-search-minus', NULL, NULL),
(565, 'fa-search-plus', NULL, NULL),
(566, 'fa-sellsy', NULL, NULL),
(567, 'fa-send', NULL, NULL),
(568, 'fa-send-o', NULL, NULL),
(569, 'fa-server', NULL, NULL),
(570, 'fa-share', NULL, NULL),
(571, 'fa-share-alt', NULL, NULL),
(572, 'fa-share-alt-square', NULL, NULL),
(573, 'fa-share-square', NULL, NULL),
(574, 'fa-share-square-o', NULL, NULL),
(575, 'fa-shekel', NULL, NULL),
(576, 'fa-sheqel', NULL, NULL),
(577, 'fa-shield', NULL, NULL),
(578, 'fa-ship', NULL, NULL),
(579, 'fa-shirtsinbulk', NULL, NULL),
(580, 'fa-shopping-bag', NULL, NULL),
(581, 'fa-shopping-basket', NULL, NULL),
(582, 'fa-shopping-cart', NULL, NULL),
(583, 'fa-shower', NULL, NULL),
(584, 'fa-sign-in', NULL, NULL),
(585, 'fa-sign-language', NULL, NULL),
(586, 'fa-sign-out', NULL, NULL),
(587, 'fa-signal', NULL, NULL),
(588, 'fa-signing', NULL, NULL),
(589, 'fa-simplybuilt', NULL, NULL),
(590, 'fa-sitemap', NULL, NULL),
(591, 'fa-skyatlas', NULL, NULL),
(592, 'fa-skype', NULL, NULL),
(593, 'fa-slack', NULL, NULL),
(594, 'fa-sliders', NULL, NULL),
(595, 'fa-slideshare', NULL, NULL),
(596, 'fa-smile-o', NULL, NULL),
(597, 'fa-snapchat', NULL, NULL),
(598, 'fa-snapchat-ghost', NULL, NULL),
(599, 'fa-snapchat-square', NULL, NULL),
(600, 'fa-snowflake-o', NULL, NULL),
(601, 'fa-soccer-ball-o', NULL, NULL),
(602, 'fa-sort', NULL, NULL),
(603, 'fa-sort-alpha-asc', NULL, NULL),
(604, 'fa-sort-alpha-desc', NULL, NULL),
(605, 'fa-sort-amount-asc', NULL, NULL),
(606, 'fa-sort-amount-desc', NULL, NULL),
(607, 'fa-sort-asc', NULL, NULL),
(608, 'fa-sort-desc', NULL, NULL),
(609, 'fa-sort-down', NULL, NULL),
(610, 'fa-sort-numeric-asc', NULL, NULL),
(611, 'fa-sort-numeric-desc', NULL, NULL),
(612, 'fa-sort-up', NULL, NULL),
(613, 'fa-soundcloud', NULL, NULL),
(614, 'fa-space-shuttle', NULL, NULL),
(615, 'fa-spinner', NULL, NULL),
(616, 'fa-spoon', NULL, NULL),
(617, 'fa-spotify', NULL, NULL),
(618, 'fa-square', NULL, NULL),
(619, 'fa-square-o', NULL, NULL),
(620, 'fa-stack-exchange', NULL, NULL),
(621, 'fa-stack-overflow', NULL, NULL),
(622, 'fa-star', NULL, NULL),
(623, 'fa-star-half', NULL, NULL),
(624, 'fa-star-half-empty', NULL, NULL),
(625, 'fa-star-half-full', NULL, NULL),
(626, 'fa-star-half-o', NULL, NULL),
(627, 'fa-star-o', NULL, NULL),
(628, 'fa-steam', NULL, NULL),
(629, 'fa-steam-square', NULL, NULL),
(630, 'fa-step-backward', NULL, NULL),
(631, 'fa-step-forward', NULL, NULL),
(632, 'fa-stethoscope', NULL, NULL),
(633, 'fa-sticky-note', NULL, NULL),
(634, 'fa-sticky-note-o', NULL, NULL),
(635, 'fa-stop', NULL, NULL),
(636, 'fa-stop-circle', NULL, NULL),
(637, 'fa-stop-circle-o', NULL, NULL),
(638, 'fa-street-view', NULL, NULL),
(639, 'fa-strikethrough', NULL, NULL),
(640, 'fa-stumbleupon', NULL, NULL),
(641, 'fa-stumbleupon-circl', NULL, NULL),
(642, 'fa-subscript', NULL, NULL),
(643, 'fa-subway', NULL, NULL),
(644, 'fa-suitcase', NULL, NULL),
(645, 'fa-sun-o', NULL, NULL),
(646, 'fa-superpowers', NULL, NULL),
(647, 'fa-superscript', NULL, NULL),
(648, 'fa-support', NULL, NULL),
(649, 'fa-table', NULL, NULL),
(650, 'fa-tablet', NULL, NULL),
(651, 'fa-tachometer', NULL, NULL),
(652, 'fa-tag', NULL, NULL),
(653, 'fa-tags', NULL, NULL),
(654, 'fa-tasks', NULL, NULL),
(655, 'fa-taxi', NULL, NULL),
(656, 'fa-telegram', NULL, NULL),
(657, 'fa-television', NULL, NULL),
(658, 'fa-tencent-weibo', NULL, NULL),
(659, 'fa-terminal', NULL, NULL),
(660, 'fa-text-height', NULL, NULL),
(661, 'fa-text-width', NULL, NULL),
(662, 'fa-th', NULL, NULL),
(663, 'fa-th-large', NULL, NULL),
(664, 'fa-th-list', NULL, NULL),
(665, 'fa-themeisle', NULL, NULL),
(666, 'fa-thermometer', NULL, NULL),
(667, 'fa-thermometer-0', NULL, NULL),
(668, 'fa-thermometer-1', NULL, NULL),
(669, 'fa-thermometer-2', NULL, NULL),
(670, 'fa-thermometer-3', NULL, NULL),
(671, 'fa-thermometer-4', NULL, NULL),
(672, 'fa-thermometer-empty', NULL, NULL),
(673, 'fa-thermometer-full', NULL, NULL),
(674, 'fa-thermometer-half', NULL, NULL),
(675, 'fa-thermometer-quart', NULL, NULL),
(676, 'fa-thermometer-three', NULL, NULL),
(677, 'fa-thumb-tack', NULL, NULL),
(678, 'fa-thumbs-down', NULL, NULL),
(679, 'fa-thumbs-o-down', NULL, NULL),
(680, 'fa-thumbs-o-up', NULL, NULL),
(681, 'fa-thumbs-up', NULL, NULL),
(682, 'fa-ticket', NULL, NULL),
(683, 'fa-times', NULL, NULL),
(684, 'fa-times-circle', NULL, NULL),
(685, 'fa-times-circle-o', NULL, NULL),
(686, 'fa-times-rectangle', NULL, NULL),
(687, 'fa-times-rectangle-o', NULL, NULL),
(688, 'fa-tint', NULL, NULL),
(689, 'fa-toggle-down', NULL, NULL),
(690, 'fa-toggle-left', NULL, NULL),
(691, 'fa-toggle-off', NULL, NULL),
(692, 'fa-toggle-on', NULL, NULL),
(693, 'fa-toggle-right', NULL, NULL),
(694, 'fa-toggle-up', NULL, NULL),
(695, 'fa-trademark', NULL, NULL),
(696, 'fa-train', NULL, NULL),
(697, 'fa-transgender', NULL, NULL),
(698, 'fa-transgender-alt', NULL, NULL),
(699, 'fa-trash', NULL, NULL),
(700, 'fa-trash-o', NULL, NULL),
(701, 'fa-tree', NULL, NULL),
(702, 'fa-trello', NULL, NULL),
(703, 'fa-tripadvisor', NULL, NULL),
(704, 'fa-trophy', NULL, NULL),
(705, 'fa-truck', NULL, NULL),
(706, 'fa-try', NULL, NULL),
(707, 'fa-tty', NULL, NULL),
(708, 'fa-tumblr', NULL, NULL),
(709, 'fa-tumblr-square', NULL, NULL),
(710, 'fa-turkish-lira', NULL, NULL),
(711, 'fa-tv', NULL, NULL),
(712, 'fa-twitch', NULL, NULL),
(713, 'fa-twitter', NULL, NULL),
(714, 'fa-twitter-square', NULL, NULL),
(715, 'fa-umbrella', NULL, NULL),
(716, 'fa-underline', NULL, NULL),
(717, 'fa-undo', NULL, NULL),
(718, 'fa-universal-access', NULL, NULL),
(719, 'fa-university', NULL, NULL),
(720, 'fa-unlink', NULL, NULL),
(721, 'fa-unlock', NULL, NULL),
(722, 'fa-unlock-alt', NULL, NULL),
(723, 'fa-unsorted', NULL, NULL),
(724, 'fa-upload', NULL, NULL),
(725, 'fa-usb', NULL, NULL),
(726, 'fa-usd', NULL, NULL),
(727, 'fa-user', NULL, NULL),
(728, 'fa-user-circle', NULL, NULL),
(729, 'fa-user-circle-o', NULL, NULL),
(730, 'fa-user-md', NULL, NULL),
(731, 'fa-user-o', NULL, NULL),
(732, 'fa-user-plus', NULL, NULL),
(733, 'fa-user-secret', NULL, NULL),
(734, 'fa-user-times', NULL, NULL),
(735, 'fa-users', NULL, NULL),
(736, 'fa-vcard', NULL, NULL),
(737, 'fa-vcard-o', NULL, NULL),
(738, 'fa-venus', NULL, NULL),
(739, 'fa-venus-double', NULL, NULL),
(740, 'fa-venus-mars', NULL, NULL),
(741, 'fa-viacoin', NULL, NULL),
(742, 'fa-viadeo', NULL, NULL),
(743, 'fa-viadeo-square', NULL, NULL),
(744, 'fa-video-camera', NULL, NULL),
(745, 'fa-vimeo', NULL, NULL),
(746, 'fa-vimeo-square', NULL, NULL),
(747, 'fa-vine', NULL, NULL),
(748, 'fa-vk', NULL, NULL),
(749, 'fa-volume-control-ph', NULL, NULL),
(750, 'fa-volume-down', NULL, NULL),
(751, 'fa-volume-off', NULL, NULL),
(752, 'fa-volume-up', NULL, NULL),
(753, 'fa-warning', NULL, NULL),
(754, 'fa-wechat', NULL, NULL),
(755, 'fa-weibo', NULL, NULL),
(756, 'fa-weixin', NULL, NULL),
(757, 'fa-whatsapp', NULL, NULL),
(758, 'fa-wheelchair', NULL, NULL),
(759, 'fa-wheelchair-alt', NULL, NULL),
(760, 'fa-wifi', NULL, NULL),
(761, 'fa-wikipedia-w', NULL, NULL),
(762, 'fa-window-close', NULL, NULL),
(763, 'fa-window-close-o', NULL, NULL),
(764, 'fa-window-maximize', NULL, NULL),
(765, 'fa-window-minimize', NULL, NULL),
(766, 'fa-window-restore', NULL, NULL),
(767, 'fa-windows', NULL, NULL),
(768, 'fa-won', NULL, NULL),
(769, 'fa-wordpress', NULL, NULL),
(770, 'fa-wpbeginner', NULL, NULL),
(771, 'fa-wpexplorer', NULL, NULL),
(772, 'fa-wpforms', NULL, NULL),
(773, 'fa-wrench', NULL, NULL),
(774, 'fa-xing', NULL, NULL),
(775, 'fa-xing-square', NULL, NULL),
(776, 'fa-y-combinator', NULL, NULL),
(777, 'fa-y-combinator-squa', NULL, NULL),
(778, 'fa-yahoo', NULL, NULL),
(779, 'fa-yc', NULL, NULL),
(780, 'fa-yc-square', NULL, NULL),
(781, 'fa-yelp', NULL, NULL),
(782, 'fa-yen', NULL, NULL),
(783, 'fa-yoast', NULL, NULL),
(784, 'fa-youtube', NULL, NULL),
(785, 'fa-youtube-play', NULL, NULL),
(786, 'fa-youtube-square', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_ppqs`
--

CREATE TABLE `jenis_ppqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_ppq` char(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ini digunakan di form ppq',
  `is_active` tinyint(1) NOT NULL,
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_ppqs`
--

INSERT INTO `jenis_ppqs` (`id`, `jenis_ppq`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Package Integrity', 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Kimia', 1, 1, NULL, NULL, NULL, NULL, NULL),
(3, 'Mikro', 1, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'Sortasi', 1, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'Lain-Lainnya', 1, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_ppqs`
--

CREATE TABLE `kategori_ppqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_ppq` char(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ini digunakan di form ppq',
  `jenis_ppq_id` bigint(20) NOT NULL COMMENT 'connected to jenis_ppq table',
  `is_active` tinyint(1) NOT NULL,
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_ppqs`
--

INSERT INTO `kategori_ppqs` (`id`, `kategori_ppq`, `jenis_ppq_id`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Man', 1, 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Machine', 1, 1, 1, NULL, NULL, NULL, NULL, NULL),
(3, 'Method', 1, 1, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'Material', 1, 1, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'Enviroment', 1, 1, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'Sortasi', 1, 1, 1, NULL, NULL, NULL, NULL, NULL),
(7, 'Miss Handling', 1, 1, 1, NULL, NULL, NULL, NULL, NULL),
(8, 'Lain-Lainnya', 1, 1, 1, NULL, NULL, NULL, NULL, NULL),
(9, 'Man', 2, 1, 1, NULL, NULL, NULL, NULL, NULL),
(10, 'Machine', 2, 1, 1, NULL, NULL, NULL, NULL, NULL),
(11, 'Method', 2, 1, 1, NULL, NULL, NULL, NULL, NULL),
(12, 'Material', 2, 1, 1, NULL, NULL, NULL, NULL, NULL),
(13, 'Enviroment', 2, 1, 1, NULL, NULL, NULL, NULL, NULL),
(14, 'Sortasi', 2, 1, 1, NULL, NULL, NULL, NULL, NULL),
(15, 'Miss Handling', 2, 1, 1, NULL, NULL, NULL, NULL, NULL),
(16, 'Lain-Lainnya', 2, 1, 1, NULL, NULL, NULL, NULL, NULL),
(17, 'Man', 3, 1, 1, NULL, NULL, NULL, NULL, NULL),
(18, 'Machine', 3, 1, 1, NULL, NULL, NULL, NULL, NULL),
(19, 'Method', 3, 1, 1, NULL, NULL, NULL, NULL, NULL),
(20, 'Material', 3, 1, 1, NULL, NULL, NULL, NULL, NULL),
(21, 'Enviroment', 3, 1, 1, NULL, NULL, NULL, NULL, NULL),
(22, 'Sortasi', 3, 1, 1, NULL, NULL, NULL, NULL, NULL),
(23, 'Miss Handling', 3, 1, 1, NULL, NULL, NULL, NULL, NULL),
(24, 'Lain-Lainnya', 3, 1, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `application_id` bigint(20) NOT NULL,
  `menu_name` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_icon` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_route` char(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ini digunakan untuk pengecekan akses menu di middleware',
  `menu_position` int(11) NOT NULL COMMENT 'digunakan untuk urutan menu disetiap akses aplikasi',
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `application_id`, `menu_name`, `menu_icon`, `menu_route`, `menu_position`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 1, 'Home', 'fa-home', 'master_app.show_home', 3, 1, 1, 1, NULL, '2020-01-22 04:24:32', '2020-03-26 01:16:29', NULL),
(2, 0, 1, 'Pengaturan Aplikasi', 'fa-cog fa-spin', '-', 1, 1, 1, NULL, NULL, '2020-01-22 04:24:32', '2020-01-22 04:24:32', NULL),
(3, 2, 1, 'Kelola Menu', 'fa-bars', 'master_app.manage_menu', 0, 1, 1, NULL, NULL, '2020-01-22 04:24:32', '2020-01-22 04:24:32', NULL),
(4, 0, 2, 'Home', 'fa-home', 'rollie.show_home', 0, 1, 1, NULL, NULL, '2020-01-22 04:24:32', '2020-01-22 04:24:32', NULL),
(5, 0, 5, 'Home', 'fa-home', 'show_home_emon', 0, 1, 1, NULL, NULL, '2020-01-22 04:24:33', '2020-01-22 04:24:33', NULL),
(8, 2, 1, 'Menu Permission', 'fa-universal-access', 'master_app.menu_permissions', 1, 1, 1, NULL, NULL, '2020-01-24 19:28:28', '2020-01-24 19:28:28', NULL),
(10, 0, 2, 'Jadwal Produksi', 'fa-calendar', 'rollie.production_schedules', 1, 1, 1, NULL, NULL, '2020-01-27 01:30:18', '2020-01-27 01:30:18', NULL),
(11, 0, 2, 'Data Proses', 'fa-database', '-', 2, 1, 1, NULL, NULL, '2020-02-07 22:22:29', '2020-02-07 22:22:29', NULL),
(12, 11, 2, 'Rpd Filling', 'fa-file-excel', 'rollie.process_data.rpds', 0, 1, 1, NULL, NULL, '2020-02-07 22:22:48', '2020-02-07 22:22:48', NULL),
(13, 11, 2, 'Cpp Produk', 'fa-table', 'rollie.process_data.cpps', 1, 1, 1, NULL, NULL, '2020-02-07 22:23:27', '2020-02-07 22:23:27', NULL),
(14, 0, 2, 'Data Analisa', 'fa-book', '-', 3, 1, 1, NULL, NULL, '2020-02-29 04:16:42', '2020-02-29 04:16:42', NULL),
(15, 14, 2, 'Fisikokimia', 'fa-beer', 'rollie.analysis_data.fiskokimias', 0, 1, 1, NULL, NULL, '2020-02-29 04:19:33', '2020-02-29 04:19:33', NULL),
(16, 14, 2, 'Fisikokimia', 'fa-beer', 'rollie.analysis_data.fiskokimias_qc_penyelia', 1, 1, 1, NULL, NULL, '2020-03-05 23:07:29', '2020-03-05 23:07:29', NULL),
(40, 0, 5, 'Home', 'fa-home', 'emon-show-home-operator', 0, 1, 1, NULL, NULL, '2019-12-13 02:56:53', '2019-12-13 02:42:28', NULL),
(41, 0, 5, 'Pengamatan', 'fa-tasks', '-', 1, 1, 1, NULL, NULL, '2019-12-13 02:35:15', '2019-12-13 02:35:15', NULL),
(42, 41, 5, 'Meteran Air', 'fa-tint', 'show-home-pengamatan-air', 0, 1, 1, NULL, NULL, '2019-12-13 02:36:07', '2019-12-13 02:36:07', NULL),
(43, 41, 5, 'Meteran Gas', 'fa-fire', 'show-home-pengamatan-gas', 4, 1, 1, NULL, NULL, '2019-12-13 02:38:32', '2019-12-13 02:38:32', NULL),
(44, 41, 5, 'Meteran Listrik', 'fa-bolt', 'show-home-pengamatan-listrik', 5, 1, 1, NULL, NULL, '2019-12-13 02:38:48', '2019-12-13 02:38:48', NULL),
(45, 41, 5, 'Pengamatan Database', 'fa-database', 'show-home-pengamatan-database', 3, 1, 1, NULL, NULL, '2019-12-13 02:38:12', '2019-12-13 02:38:12', NULL),
(46, 0, 2, 'Rkol', 'fa-archive', '-', 4, 1, 1, NULL, NULL, '2020-03-10 16:50:59', '2020-03-10 16:50:59', NULL),
(47, 46, 2, 'FU PPQ QC Release', 'fa-file', 'rollie.rkol.ppq_qc_release', 0, 1, 1, NULL, NULL, '2020-03-10 16:52:05', '2020-03-10 16:52:05', NULL),
(48, 46, 2, 'FU PPQ QC Tahanan', 'fa-file', 'rollie.rkol.ppq_qc_tahanan', 1, 1, 1, NULL, NULL, '2020-03-10 16:52:32', '2020-03-10 16:52:32', NULL),
(49, 46, 2, 'FU PPQ Engineering', 'fa-file', 'rollie.rkol.ppq_engineering', 2, 1, 1, NULL, NULL, '2020-03-10 16:53:17', '2020-03-10 16:53:17', NULL),
(50, 46, 2, 'FU RKJ NFI', 'fa-list-ol', 'rollie.rkol.rkj_rnd_produk_nfi', 3, 1, 1, NULL, NULL, '2020-03-14 01:24:14', '2020-03-14 01:24:14', NULL),
(51, 46, 2, 'FU RKJ QA', 'fa-calendar-check', 'rollie.rkol.rkj_qa', 4, 1, 1, NULL, NULL, '2020-03-14 05:04:38', '2020-03-14 05:04:38', NULL),
(52, 2, 1, 'Kelola Aplikasi', 'fa-calculator', 'master_app.manage_applications', 2, 1, 1, NULL, NULL, '2020-03-26 01:20:29', '2020-03-26 01:20:29', NULL),
(53, 2, 1, 'Application Permission', 'fa-user-md', 'master_app.application_permissions', 3, 1, 1, NULL, NULL, '2020-03-30 00:43:50', '2020-03-30 00:43:50', NULL),
(54, 0, 1, 'Master Data', 'fa-database', '-', 5, 1, 1, 1, NULL, '2020-04-04 03:06:08', '2020-04-05 00:55:04', NULL),
(55, 54, 1, 'Kelola Produk', 'fa-gift', 'master_app.master_data.manage_products', 1, 1, 1, 1, NULL, '2020-04-04 03:06:48', '2020-04-05 00:55:25', NULL),
(56, 54, 1, 'Kelola Mesin Filling', 'fa-gavel', 'master_app.master_data.manage_filling_machines', 2, 1, 1, NULL, NULL, '2020-04-05 01:47:09', '2020-04-05 01:47:09', NULL),
(57, 14, 2, 'Analisa Mikro Produk', 'fa-microchip', 'rollie.analysis_data.analisa_mikro_produk', 3, 1, 1, 1, NULL, '2020-04-25 00:43:59', '2020-04-25 00:52:10', NULL),
(58, 54, 1, 'Kategori Flowmeter', 'fa-universal-access', 'master_app.master_data.manage_flowmeter_categories', 6, 1, 1, 1, NULL, '2020-05-17 16:02:59', '2020-05-17 20:57:35', NULL),
(59, 54, 1, 'Flowmeter Workcenter', 'fa-search-location', 'master_app.master_data.manage_flowmeter_workcenters', 7, 1, 1, NULL, NULL, '2020-05-17 21:16:31', '2020-05-17 21:16:31', NULL),
(60, 0, 1, 'Coba Aja', 'fa-500px', 'coba', 7, 1, 1, 1, NULL, '2020-06-19 06:00:33', '2020-06-19 06:04:41', NULL),
(61, 54, 1, 'Flowmeter Unit', 'fa-unity', 'master_app.master_data.manage_flowmeter_units', 8, 1, 1, NULL, NULL, '2020-06-19 14:11:20', '2020-06-19 14:11:20', NULL),
(62, 54, 1, 'Kelola Flowmeter', 'fa-tachometer-alt', 'master_app.master_data.manage_flowmeters', 9, 1, 1, NULL, NULL, '2020-06-19 14:14:27', '2020-06-19 14:14:27', NULL),
(63, 54, 1, 'Flowmeter Location', 'fa-map-marker-alt', 'master_app.master_data.manage_flowmeter_locations', 10, 1, 1, NULL, NULL, '2020-06-19 16:58:39', '2020-06-19 16:58:39', NULL),
(64, 14, 2, 'Analisa Ph Produk', 'fa-tint', 'rollie.analysis_data.analisa_ph_produk', 4, 1, 1, NULL, NULL, '2020-06-21 23:25:15', '2020-06-21 23:25:15', NULL),
(65, 14, 2, 'Analisa Mikro Produk', 'fa-glass-martini-alt', 'rollie.analysis_data.analisa_mikro_release', 5, 1, 1, NULL, NULL, '2020-06-22 09:21:35', '2020-06-22 09:21:35', NULL),
(66, 0, 2, 'Report', 'fa-clipboard', '-', 6, 1, 1, 1, NULL, '2020-06-22 11:11:03', '2020-06-22 11:11:43', NULL),
(67, 66, 2, 'Rpr', 'fa-journal-whills', 'rollie.reports.rpr', 0, 1, 1, NULL, NULL, '2020-06-22 11:12:32', '2020-06-22 11:12:32', NULL),
(68, 66, 2, 'Report Rpd Filling', 'fa-file-excel-o', 'rollie.reports.rpd_filling', 1, 1, 1, NULL, NULL, '2020-06-27 13:17:41', '2020-06-27 13:17:41', NULL),
(69, 0, 4, 'Home', 'fa-home', 'emon.home-operator', 0, 1, 1, NULL, NULL, '2020-06-27 22:34:39', '2020-06-27 22:34:39', NULL),
(70, 0, 4, 'Pengamatan', 'fa-list', '-', 1, 1, 1, NULL, NULL, '2020-06-27 22:37:29', '2020-06-27 22:37:29', NULL),
(71, 70, 4, 'Monitoring Air', 'fa-tint', 'emon.monitoring.water', 0, 1, 1, NULL, NULL, '2020-06-27 22:38:11', '2020-06-27 22:38:11', NULL),
(72, 70, 4, 'Monitoring Listrik', 'fa-bolt', 'emon.monitoring.listrik', 1, 1, 1, NULL, NULL, '2020-06-27 22:39:59', '2020-06-27 22:39:59', NULL),
(73, 70, 4, 'Monitoring Gas', 'fa-battery-3', 'emon.monitoring.gas', 2, 1, 1, NULL, NULL, '2020-06-27 22:40:58', '2020-06-27 22:40:58', NULL),
(74, 54, 1, 'Flowmeter Usage', 'fa-battery-full', 'master_app.master_data.manage_flowmeter_usages', 12, 1, 1, 1, NULL, '2020-07-18 05:14:07', '2020-07-18 05:18:05', NULL),
(75, 54, 1, 'Kelola Rumus', 'fa-calculator', 'master_app.master_data.manage_flowmeter_formulas', 13, 1, 1, NULL, NULL, '2020-07-18 05:42:13', '2020-07-18 05:42:13', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_permissions`
--

CREATE TABLE `menu_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL COMMENT 'connected to user table',
  `menu_id` bigint(20) NOT NULL COMMENT 'connected to menu table',
  `view` tinyint(1) NOT NULL COMMENT '0 = denied, 1 = allowed',
  `create` tinyint(1) NOT NULL COMMENT '0 = denied, 1 = allowed',
  `edit` tinyint(1) NOT NULL COMMENT '0 = denied, 1 = allowed',
  `delete` tinyint(1) NOT NULL COMMENT '0 = denied, 1 = allowed',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menu_permissions`
--

INSERT INTO `menu_permissions` (`id`, `user_id`, `menu_id`, `view`, `create`, `edit`, `delete`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, '2020-01-21 21:24:36', '2020-01-21 21:24:36', NULL),
(2, 2, 1, 1, 1, 1, 1, 1, 1, NULL, '2020-01-21 21:24:36', '2020-01-24 17:11:37', NULL),
(3, 1, 2, 1, 1, 1, 1, 1, 1, NULL, '2020-01-21 21:24:36', '2020-01-24 16:32:37', NULL),
(4, 2, 2, 1, 1, 1, 1, 1, NULL, NULL, '2020-01-21 21:24:37', '2020-01-21 21:24:37', NULL),
(5, 1, 3, 1, 1, 1, 1, 1, NULL, NULL, '2020-01-21 21:24:37', '2020-01-21 21:24:37', NULL),
(6, 2, 3, 1, 1, 1, 1, 1, NULL, NULL, '2020-01-21 21:24:37', '2020-01-21 21:24:37', NULL),
(7, 1, 4, 1, 1, 1, 1, 1, NULL, NULL, '2020-01-21 21:24:37', '2020-01-21 21:24:37', NULL),
(8, 2, 4, 1, 1, 1, 1, 1, NULL, NULL, '2020-01-21 21:24:37', '2020-01-21 21:24:37', NULL),
(9, 1, 5, 1, 1, 1, 1, 1, NULL, NULL, '2020-01-21 21:24:37', '2020-01-21 21:24:37', NULL),
(10, 2, 5, 1, 1, 1, 1, 1, NULL, NULL, '2020-01-21 21:24:37', '2020-01-21 21:24:37', NULL),
(11, 1, 8, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL),
(12, 2, 8, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL),
(13, 1, 10, 1, 1, 1, 1, 1, NULL, NULL, '2020-01-26 18:30:50', '2020-01-26 18:30:50', NULL),
(14, 1, 11, 1, 1, 1, 1, 1, NULL, NULL, '2020-02-07 15:23:46', '2020-02-07 15:23:46', NULL),
(15, 1, 12, 1, 1, 1, 1, 1, NULL, NULL, '2020-02-07 15:23:46', '2020-02-07 15:23:46', NULL),
(16, 1, 13, 1, 1, 1, 1, 1, NULL, NULL, '2020-02-07 15:23:46', '2020-02-07 15:23:46', NULL),
(17, 1, 14, 1, 1, 1, 1, 1, NULL, NULL, '2020-02-28 21:16:59', '2020-02-28 21:16:59', NULL),
(18, 1, 15, 1, 1, 1, 1, 1, NULL, NULL, '2020-02-28 21:19:46', '2020-02-28 21:19:46', NULL),
(19, 1, 16, 1, 1, 1, 1, 1, NULL, NULL, '2020-03-05 16:07:49', '2020-03-05 16:07:49', NULL),
(1675, 22, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1676, 23, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1677, 24, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:39:21', NULL),
(1678, 29, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1679, 30, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1680, 31, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1681, 32, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1682, 33, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1683, 34, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1684, 35, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1685, 36, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1686, 37, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1687, 38, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1688, 39, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1689, 40, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1690, 41, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1691, 42, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1692, 43, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1693, 44, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1694, 45, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1695, 46, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1696, 47, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1697, 48, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1698, 49, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1699, 50, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1700, 51, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1701, 52, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1702, 53, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1703, 54, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1704, 55, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1705, 56, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1706, 57, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1707, 58, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1708, 59, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1709, 66, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1710, 67, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1711, 68, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(1712, 69, 40, 0, 0, 0, 0, 0, 1, NULL, '2019-12-12 19:34:14', '2020-06-19 06:42:18', NULL),
(1713, 22, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1714, 23, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1715, 24, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:39:24', NULL),
(1716, 29, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1717, 30, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1718, 31, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1719, 32, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1720, 33, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1721, 34, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1722, 35, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1723, 36, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1724, 37, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1725, 38, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1726, 39, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1727, 40, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1728, 41, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1729, 42, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1730, 43, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1731, 44, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1732, 45, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1733, 46, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1734, 47, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1735, 48, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1736, 49, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1737, 50, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1738, 51, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1739, 52, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1740, 53, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1741, 54, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1742, 55, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1743, 56, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1744, 57, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1745, 58, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1746, 59, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1747, 66, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1748, 67, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1749, 68, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1750, 69, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(1751, 22, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1752, 23, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1753, 24, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:39:27', NULL),
(1754, 29, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1755, 30, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1756, 31, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1757, 32, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1758, 33, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1759, 34, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1760, 35, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1761, 36, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1762, 37, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1763, 38, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1764, 39, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1765, 40, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1766, 41, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1767, 42, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1768, 43, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1769, 44, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1770, 45, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1771, 46, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1772, 47, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1773, 48, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1774, 49, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1775, 50, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1776, 51, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1777, 52, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1778, 53, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1779, 54, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1780, 55, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1781, 56, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1782, 57, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1783, 58, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1784, 59, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1785, 66, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1786, 67, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1787, 68, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1788, 69, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:36:07', NULL),
(1789, 22, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1790, 23, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1791, 24, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:39:30', NULL),
(1792, 29, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1793, 30, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1794, 31, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1795, 32, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1796, 33, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1797, 34, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1798, 35, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1799, 36, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1800, 37, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1801, 38, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1802, 39, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1803, 40, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1804, 41, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1805, 42, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1806, 43, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1807, 44, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1808, 45, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1809, 46, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1810, 47, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1811, 48, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1812, 49, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1813, 50, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1814, 51, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1815, 52, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1816, 53, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1817, 54, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1818, 55, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1819, 56, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1820, 57, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1821, 58, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1822, 59, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1823, 66, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1824, 67, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1825, 68, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1826, 69, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:36:41', '2019-12-12 19:36:41', NULL),
(1827, 22, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1828, 23, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1829, 24, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:39:34', NULL),
(1830, 29, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1831, 30, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1832, 31, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1833, 32, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1834, 33, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1835, 34, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1836, 35, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1837, 36, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1838, 37, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1839, 38, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1840, 39, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1841, 40, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1842, 41, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1843, 42, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1844, 43, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1845, 44, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1846, 45, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1847, 46, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1848, 47, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1849, 48, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1850, 49, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1851, 50, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1852, 51, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1853, 52, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1854, 53, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1855, 54, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1856, 55, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1857, 56, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1858, 57, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1859, 58, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1860, 59, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1861, 66, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1862, 67, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1863, 68, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1864, 69, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:37:12', '2019-12-12 19:37:12', NULL),
(1865, 22, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1866, 23, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1867, 24, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:39:37', NULL),
(1868, 29, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1869, 30, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1870, 31, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1871, 32, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1872, 33, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1873, 34, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1874, 35, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1875, 36, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1876, 37, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1877, 38, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1878, 39, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1879, 40, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1880, 41, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1881, 42, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1882, 43, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1883, 44, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1884, 45, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1885, 46, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1886, 47, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1887, 48, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1888, 49, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1889, 50, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1890, 51, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1891, 52, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1892, 53, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1893, 54, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1894, 55, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1895, 56, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1896, 57, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1897, 58, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1898, 59, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1899, 66, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1900, 67, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1901, 68, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1902, 69, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-12 19:38:12', '2019-12-12 19:38:12', NULL),
(1942, 70, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:04:23', '2019-12-12 20:04:23', NULL),
(1943, 70, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:04:23', '2019-12-12 20:04:23', NULL),
(1944, 70, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:04:23', '2019-12-12 20:04:23', NULL),
(1945, 70, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:04:23', '2019-12-12 20:04:23', NULL),
(1946, 70, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:04:23', '2019-12-12 20:04:23', NULL),
(1947, 70, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:04:23', '2019-12-12 20:04:23', NULL),
(1987, 71, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:05:12', '2019-12-12 20:05:12', NULL),
(1988, 71, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:05:12', '2019-12-12 20:05:12', NULL),
(1989, 71, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:05:12', '2019-12-12 20:05:12', NULL),
(1990, 71, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:05:12', '2019-12-12 20:05:12', NULL),
(1991, 71, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:05:12', '2019-12-12 20:05:12', NULL),
(1992, 71, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:05:12', '2019-12-12 20:05:12', NULL),
(2032, 72, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:08:08', '2019-12-12 20:08:08', NULL),
(2033, 72, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:08:08', '2019-12-12 20:08:08', NULL),
(2034, 72, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:08:08', '2019-12-12 20:08:08', NULL),
(2035, 72, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:08:08', '2019-12-12 20:08:08', NULL),
(2036, 72, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:08:08', '2019-12-12 20:08:08', NULL),
(2037, 72, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:08:08', '2019-12-12 20:08:08', NULL),
(2077, 73, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:08:48', '2019-12-12 20:08:48', NULL),
(2078, 73, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:08:48', '2019-12-12 20:08:48', NULL),
(2079, 73, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:08:48', '2019-12-12 20:08:48', NULL),
(2080, 73, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:08:48', '2019-12-12 20:08:48', NULL),
(2081, 73, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:08:48', '2019-12-12 20:08:48', NULL),
(2082, 73, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:08:48', '2019-12-12 20:08:48', NULL),
(2122, 74, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:10:49', '2019-12-12 20:10:49', NULL),
(2123, 74, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:10:49', '2019-12-12 20:10:49', NULL),
(2124, 74, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:10:49', '2019-12-12 20:10:49', NULL),
(2125, 74, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:10:49', '2019-12-12 20:10:49', NULL),
(2126, 74, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:10:49', '2019-12-12 20:10:49', NULL),
(2127, 74, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:10:49', '2019-12-12 20:10:49', NULL),
(2167, 75, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:11:31', '2019-12-12 20:11:31', NULL),
(2168, 75, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:11:31', '2019-12-12 20:11:31', NULL),
(2169, 75, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:11:31', '2019-12-12 20:11:31', NULL),
(2170, 75, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:11:31', '2019-12-12 20:11:31', NULL),
(2171, 75, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:11:31', '2019-12-12 20:11:31', NULL),
(2172, 75, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:11:31', '2019-12-12 20:11:31', NULL),
(2212, 76, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:12:32', '2019-12-12 20:12:32', NULL),
(2213, 76, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:12:32', '2019-12-12 20:12:32', NULL),
(2214, 76, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:12:32', '2019-12-12 20:12:32', NULL),
(2215, 76, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:12:32', '2019-12-12 20:12:32', NULL),
(2216, 76, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:12:32', '2019-12-12 20:12:32', NULL),
(2217, 76, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:12:32', '2019-12-12 20:12:32', NULL),
(2257, 77, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:13:15', '2019-12-12 20:13:15', NULL),
(2258, 77, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:13:15', '2019-12-12 20:13:15', NULL),
(2259, 77, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:13:15', '2019-12-12 20:13:15', NULL),
(2260, 77, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:13:15', '2019-12-12 20:13:15', NULL),
(2261, 77, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:13:15', '2019-12-12 20:13:15', NULL),
(2262, 77, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:13:15', '2019-12-12 20:13:15', NULL),
(2302, 78, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:13:52', '2019-12-12 20:13:52', NULL),
(2303, 78, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:13:52', '2019-12-12 20:13:52', NULL),
(2304, 78, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:13:52', '2019-12-12 20:13:52', NULL),
(2305, 78, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:13:52', '2019-12-12 20:13:52', NULL),
(2306, 78, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:13:52', '2019-12-12 20:13:52', NULL),
(2307, 78, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:13:52', '2019-12-12 20:13:52', NULL),
(2347, 79, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:14:32', '2019-12-12 20:14:32', NULL),
(2348, 79, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:14:32', '2019-12-12 20:14:32', NULL),
(2349, 79, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:14:32', '2019-12-12 20:14:32', NULL),
(2350, 79, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:14:32', '2019-12-12 20:14:32', NULL),
(2351, 79, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:14:32', '2019-12-12 20:14:32', NULL),
(2352, 79, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:14:32', '2019-12-12 20:14:32', NULL),
(2392, 80, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:15:16', '2019-12-12 20:15:16', NULL),
(2393, 80, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:15:16', '2019-12-12 20:15:16', NULL),
(2394, 80, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:15:16', '2019-12-12 20:15:16', NULL),
(2395, 80, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:15:16', '2019-12-12 20:15:16', NULL),
(2396, 80, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:15:16', '2019-12-12 20:15:16', NULL),
(2397, 80, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:15:16', '2019-12-12 20:15:16', NULL),
(2437, 81, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:15:46', '2019-12-12 20:15:46', NULL),
(2438, 81, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:15:46', '2019-12-12 20:15:46', NULL),
(2439, 81, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:15:46', '2019-12-12 20:15:46', NULL),
(2440, 81, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:15:46', '2019-12-12 20:15:46', NULL),
(2441, 81, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:15:46', '2019-12-12 20:15:46', NULL),
(2442, 81, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:15:46', '2019-12-12 20:15:46', NULL),
(2482, 82, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:16:22', '2019-12-12 20:16:22', NULL),
(2483, 82, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:16:22', '2019-12-12 20:16:22', NULL),
(2484, 82, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:16:22', '2019-12-12 20:16:22', NULL),
(2485, 82, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:16:22', '2019-12-12 20:16:22', NULL),
(2486, 82, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:16:22', '2019-12-12 20:16:22', NULL),
(2487, 82, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:16:22', '2019-12-12 20:16:22', NULL),
(2527, 83, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:18:04', '2019-12-12 20:18:04', NULL),
(2528, 83, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:18:04', '2019-12-12 20:18:04', NULL),
(2529, 83, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:18:04', '2019-12-12 20:18:04', NULL),
(2530, 83, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:18:04', '2019-12-12 20:18:04', NULL),
(2531, 83, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:18:04', '2019-12-12 20:18:04', NULL),
(2532, 83, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:18:04', '2019-12-12 20:18:04', NULL),
(2572, 84, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:18:56', '2019-12-12 20:18:56', NULL),
(2573, 84, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:18:56', '2019-12-12 20:18:56', NULL),
(2574, 84, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:18:56', '2019-12-12 20:18:56', NULL),
(2575, 84, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:18:56', '2019-12-12 20:18:56', NULL),
(2576, 84, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:18:56', '2019-12-12 20:18:56', NULL),
(2577, 84, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:18:56', '2019-12-12 20:18:56', NULL),
(2617, 85, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:31:47', '2019-12-12 20:31:47', NULL),
(2618, 85, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:31:47', '2019-12-12 20:31:47', NULL),
(2619, 85, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:31:47', '2019-12-12 20:31:47', NULL),
(2620, 85, 43, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:31:47', '2019-12-12 20:31:47', NULL),
(2621, 85, 44, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:31:47', '2019-12-12 20:31:47', NULL),
(2622, 85, 45, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 20:31:47', '2019-12-12 20:31:47', NULL),
(2662, 86, 40, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-25 10:33:13', '2019-12-25 10:33:13', NULL),
(2663, 86, 41, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-25 10:33:13', '2019-12-25 10:33:13', NULL),
(2664, 86, 42, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-25 10:33:13', '2019-12-25 10:33:13', NULL),
(2665, 86, 43, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-25 10:33:13', '2019-12-25 10:33:13', NULL),
(2666, 86, 44, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-25 10:33:13', '2019-12-25 10:33:13', NULL),
(2667, 86, 45, 0, 0, 0, 0, 0, NULL, NULL, '2019-12-25 10:33:13', '2019-12-25 10:33:13', NULL),
(2707, 87, 40, 0, 0, 0, 0, 0, NULL, NULL, '2020-01-02 09:25:21', '2020-01-02 09:25:21', NULL),
(2708, 87, 41, 0, 0, 0, 0, 0, NULL, NULL, '2020-01-02 09:25:21', '2020-01-02 09:25:21', NULL),
(2709, 87, 42, 0, 0, 0, 0, 0, NULL, NULL, '2020-01-02 09:25:21', '2020-01-02 09:25:21', NULL),
(2710, 87, 43, 0, 0, 0, 0, 0, NULL, NULL, '2020-01-02 09:25:21', '2020-01-02 09:25:21', NULL),
(2711, 87, 44, 0, 0, 0, 0, 0, NULL, NULL, '2020-01-02 09:25:21', '2020-01-02 09:25:21', NULL),
(2712, 87, 45, 0, 0, 0, 0, 0, NULL, NULL, '2020-01-02 09:25:21', '2020-01-02 09:25:21', NULL),
(2752, 88, 40, 0, 0, 0, 0, 0, NULL, NULL, '2020-01-04 09:48:24', '2020-01-04 09:48:24', NULL),
(2753, 88, 41, 0, 0, 0, 0, 0, NULL, NULL, '2020-01-04 09:48:24', '2020-01-04 09:48:24', NULL),
(2754, 88, 42, 0, 0, 0, 0, 0, NULL, NULL, '2020-01-04 09:48:24', '2020-01-04 09:48:24', NULL),
(2755, 88, 43, 0, 0, 0, 0, 0, NULL, NULL, '2020-01-04 09:48:24', '2020-01-04 09:48:24', NULL),
(2756, 88, 44, 0, 0, 0, 0, 0, NULL, NULL, '2020-01-04 09:48:24', '2020-01-04 09:48:24', NULL),
(2757, 88, 45, 0, 0, 0, 0, 0, NULL, NULL, '2020-01-04 09:48:24', '2020-01-04 09:48:24', NULL),
(4000, 1, 40, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 19:34:14', '2019-12-12 19:34:14', NULL),
(4001, 1, 41, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 19:35:15', '2019-12-12 19:35:15', NULL),
(4005, 1, 42, 1, 1, 1, 1, 0, NULL, NULL, '2019-12-12 19:36:07', '2019-12-12 19:39:27', NULL),
(4006, 1, 46, 1, 1, 1, 1, 1, NULL, NULL, '2020-03-10 09:53:38', '2020-03-10 09:53:38', NULL),
(4007, 1, 47, 1, 1, 1, 1, 1, NULL, NULL, '2020-03-10 09:53:38', '2020-03-10 09:53:38', NULL),
(4008, 1, 48, 1, 1, 1, 1, 1, NULL, NULL, '2020-03-10 09:53:38', '2020-03-10 09:53:38', NULL),
(4009, 1, 49, 1, 1, 1, 1, 1, NULL, NULL, '2020-03-10 09:53:38', '2020-03-10 09:53:38', NULL),
(4010, 1, 50, 1, 1, 1, 1, 1, NULL, NULL, '2020-03-13 18:24:29', '2020-03-13 18:24:29', NULL),
(4011, 1, 51, 1, 1, 1, 1, 1, NULL, NULL, '2020-03-13 22:05:32', '2020-03-13 22:05:32', NULL),
(4012, 2, 10, 0, 0, 0, 0, 1, NULL, NULL, '2020-03-25 17:32:07', '2020-03-25 17:32:07', NULL),
(4013, 2, 11, 0, 0, 0, 0, 1, NULL, NULL, '2020-03-25 17:32:07', '2020-03-25 17:32:07', NULL),
(4014, 2, 12, 0, 0, 0, 0, 1, NULL, NULL, '2020-03-25 17:32:07', '2020-03-25 17:32:07', NULL),
(4015, 2, 13, 0, 0, 0, 0, 1, NULL, NULL, '2020-03-25 17:32:07', '2020-03-25 17:32:07', NULL),
(4016, 2, 14, 0, 0, 0, 0, 1, NULL, NULL, '2020-03-25 17:32:07', '2020-03-25 17:32:07', NULL),
(4017, 2, 15, 0, 0, 0, 0, 1, NULL, NULL, '2020-03-25 17:32:07', '2020-03-25 17:32:07', NULL),
(4018, 2, 16, 0, 0, 0, 0, 1, NULL, NULL, '2020-03-25 17:32:07', '2020-03-25 17:32:07', NULL),
(4019, 2, 46, 0, 0, 0, 0, 1, NULL, NULL, '2020-03-25 17:32:07', '2020-03-25 17:32:07', NULL),
(4020, 2, 47, 0, 0, 0, 0, 1, NULL, NULL, '2020-03-25 17:32:07', '2020-03-25 17:32:07', NULL),
(4021, 2, 48, 0, 0, 0, 0, 1, NULL, NULL, '2020-03-25 17:32:07', '2020-03-25 17:32:07', NULL),
(4022, 2, 49, 0, 0, 0, 0, 1, NULL, NULL, '2020-03-25 17:32:07', '2020-03-25 17:32:07', NULL),
(4023, 2, 50, 0, 0, 0, 0, 1, NULL, NULL, '2020-03-25 17:32:07', '2020-03-25 17:32:07', NULL),
(4024, 2, 51, 0, 0, 0, 0, 1, NULL, NULL, '2020-03-25 17:32:07', '2020-03-25 17:32:07', NULL),
(4025, 1, 52, 1, 1, 1, 1, 1, NULL, NULL, '2020-03-25 18:21:01', '2020-03-25 18:21:01', NULL),
(4026, 1, 53, 1, 1, 1, 1, 1, NULL, NULL, '2020-03-29 17:44:07', '2020-03-29 17:44:07', NULL),
(4027, 1, 54, 1, 1, 1, 1, 1, NULL, NULL, '2020-04-03 20:07:08', '2020-04-03 20:07:08', NULL),
(4028, 1, 55, 1, 1, 1, 1, 1, NULL, NULL, '2020-04-03 20:07:08', '2020-04-03 20:07:08', NULL),
(4029, 1, 56, 1, 1, 1, 1, 1, NULL, NULL, '2020-04-04 18:48:12', '2020-04-04 18:48:12', NULL),
(4030, 1, 57, 1, 1, 1, 1, 1, NULL, NULL, '2020-04-24 17:44:20', '2020-04-24 17:44:20', NULL),
(4031, 1, 58, 1, 1, 1, 1, 1, NULL, NULL, '2020-05-17 09:03:27', '2020-05-17 09:03:27', NULL),
(4032, 1, 59, 1, 1, 1, 1, 1, NULL, NULL, '2020-05-17 14:16:48', '2020-05-17 14:16:48', NULL),
(4033, 1, 60, 0, 0, 0, 0, 1, NULL, NULL, '2020-06-19 07:16:57', '2020-06-19 07:16:57', NULL),
(4034, 1, 61, 1, 1, 1, 1, 1, NULL, NULL, '2020-06-19 07:16:57', '2020-06-19 07:16:57', NULL),
(4035, 1, 62, 1, 1, 1, 1, 1, 1, NULL, '2020-06-19 07:16:57', '2020-07-18 05:24:41', NULL),
(4036, 1, 63, 1, 1, 1, 1, 1, NULL, NULL, '2020-06-19 09:59:40', '2020-06-19 09:59:40', NULL),
(4037, 1, 64, 1, 1, 1, 1, 1, NULL, NULL, '2020-06-22 01:29:12', '2020-06-22 01:29:12', NULL),
(4038, 1, 65, 1, 1, 1, 1, 1, NULL, NULL, '2020-06-22 02:23:46', '2020-06-22 02:23:46', NULL),
(4039, 1, 66, 1, 1, 1, 1, 1, NULL, NULL, '2020-06-22 04:20:12', '2020-06-22 04:20:12', NULL),
(4040, 1, 67, 1, 1, 1, 1, 1, NULL, NULL, '2020-06-22 04:20:12', '2020-06-22 04:20:12', NULL),
(4041, 1, 68, 1, 1, 1, 1, 1, NULL, NULL, '2020-06-27 13:19:52', '2020-06-27 13:19:52', NULL),
(4042, 1, 69, 1, 1, 1, 1, 1, NULL, NULL, '2020-06-27 22:35:10', '2020-06-27 22:35:10', NULL),
(4043, 1, 70, 1, 1, 1, 1, 1, NULL, NULL, '2020-06-27 22:41:51', '2020-06-27 22:41:51', NULL),
(4044, 1, 71, 1, 1, 1, 1, 1, NULL, NULL, '2020-06-27 22:41:51', '2020-06-27 22:41:51', NULL),
(4045, 1, 72, 1, 1, 1, 1, 1, NULL, NULL, '2020-06-27 22:41:51', '2020-06-27 22:41:51', NULL),
(4046, 1, 73, 1, 1, 1, 1, 1, NULL, NULL, '2020-06-27 22:41:51', '2020-06-27 22:41:51', NULL),
(4047, 1, 74, 1, 1, 1, 1, 1, NULL, NULL, '2020-07-18 05:24:41', '2020-07-18 05:24:41', NULL),
(4048, 1, 75, 1, 1, 1, 1, 1, NULL, NULL, '2020-07-18 05:43:59', '2020-07-18 05:43:59', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(53, '2019_08_19_000000_create_failed_jobs_table', 1),
(54, '2020_01_21_072303_create_users_table', 1),
(55, '2020_01_21_084922_create_employees_table', 1),
(56, '2020_01_21_085716_create_departements_table', 1),
(57, '2020_01_25_040937_create_menus_table', 1),
(58, '2020_01_25_041743_create_applications_table', 1),
(59, '2020_01_25_042346_create_application_permissions_table', 1),
(60, '2020_01_25_042624_create_menu_permissions_table', 1),
(61, '2020_01_26_152535_create_icons_table', 1),
(62, '2020_01_30_073951_create_products_table', 1),
(63, '2020_01_30_075805_create_product_types_table', 1),
(64, '2020_01_30_075835_create_filling_machines_table', 1),
(65, '2020_01_30_075903_create_brands_table', 1),
(66, '2020_01_30_075915_create_companies_table', 1),
(67, '2020_01_30_075926_create_subbrands_table', 1),
(68, '2020_01_30_075955_create_filling_sampel_codes_table', 1),
(69, '2020_01_30_080025_create_filling_machine_group_heads_table', 1),
(70, '2020_01_30_080039_create_filling_machine_group_details_table', 1),
(71, '2020_01_30_133742_create_wo_numbers_table', 1),
(72, '2020_01_30_133905_create_plans_table', 1),
(73, '2020_02_06_111904_create_rpd_filling_heads_table', 1),
(74, '2020_02_06_112320_create_rpd_filling_detail_pis_table', 1),
(75, '2020_02_06_112458_create_rpd_filling_detail_at_events_table', 1),
(76, '2020_02_10_202551_create_cpp_heads_table', 1),
(77, '2020_02_10_203004_create_cpp_details_table', 1),
(78, '2020_02_10_203254_create_palets_table', 1),
(79, '2020_02_10_203326_create_palet_ppqs_table', 1),
(80, '2020_02_25_212042_create_ppqs_table', 1),
(81, '2020_03_01_160554_create_distribution_lists_table', 1),
(82, '2020_03_03_094606_create_analisa_kimias_table', 1),
(83, '2020_03_14_220041_create_kategori_ppqs_table', 1),
(84, '2020_03_14_222837_create_jenis_ppqs_table', 1),
(85, '2020_03_14_233819_create_follow_up_ppqs_table', 1),
(86, '2020_03_15_230705_create_corrective_actions_table', 1),
(87, '2020_03_15_231022_create_preventive_actions_table', 1),
(88, '2020_03_16_083712_create_rkjs_table', 1),
(89, '2020_03_16_085530_create_follow_up_rkjs_table', 1),
(90, '2020_04_08_093948_create_flowmeter_categories_table', 1),
(91, '2020_04_08_101010_create_flowmeter_workcenters_table', 1),
(92, '2020_04_08_101438_create_flowmeter_units_table', 1),
(93, '2020_04_08_105534_create_flowmeters_table', 1),
(94, '2020_04_27_103043_create_analisa_mikros_table', 1),
(95, '2020_04_27_113757_create_analisa_mikro_details_table', 1),
(96, '2020_04_29_093641_create_analisa_mikro_resampling_table', 1),
(97, '2020_05_19_084531_create_flowmeter_locations_table', 1),
(98, '2020_06_29_102023_create_energy_monitorings_table', 1),
(99, '2020_06_29_102145_create_energy_usages_table', 1),
(100, '2020_06_29_185550_create_psrs_table', 1),
(101, '2020_07_18_120737_create_flowmeter_usages_table', 1),
(102, '2020_07_18_124151_create_flowmeter_formulas_table', 1),
(103, '2020_07_18_185846_create_flowmeter_consumption_realisation_heads_table', 1),
(104, '2020_07_18_185907_create_flowmeter_consumption_realisation_details_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) NOT NULL COMMENT 'connected to companies table',
  `plan_name` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `plans`
--

INSERT INTO `plans` (`id`, `company_id`, `plan_name`, `address`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'PT. Nutrifood Plant Sentul', 'sentul', 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'PT. Nutrifood Plant Ciawi', 'ciawi', 1, 1, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'PT. Nutrifood Plant Cibitung', 'cibitung', 1, 1, NULL, NULL, NULL, NULL, NULL),
(4, 1, 'PT. Nutrifood Indonesia Head Office', 'jakarta', 1, 1, NULL, NULL, NULL, NULL, NULL),
(5, 2, 'PT. Heavenly Blush Sentul', 'sentul', 1, 1, NULL, NULL, NULL, NULL, NULL),
(6, 2, 'PT. Heavenly Nutrition Head Office', 'jakarta', 1, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subbrand_id` bigint(20) NOT NULL COMMENT 'connected to table subbrand',
  `product_type_id` bigint(20) NOT NULL COMMENT 'connected to product type table',
  `filling_machine_group_head_id` bigint(20) NOT NULL COMMENT 'connected to filling machine head',
  `product_name` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oracle_code` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spek_ts_min` double(8,2) NOT NULL,
  `spek_ts_max` double(8,2) NOT NULL,
  `spek_ph_min` double(8,2) NOT NULL,
  `spek_ph_max` double(8,2) NOT NULL,
  `sla` int(11) NOT NULL COMMENT 'dalam hari',
  `waktu_analisa_mikro` int(11) NOT NULL COMMENT 'dalam hari',
  `inkubasi` int(11) DEFAULT NULL COMMENT 'dalam hari',
  `trial_code` char(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ini digunakan apabila ada nomor wo trial',
  `expired_range` int(11) NOT NULL COMMENT 'dalam satuan bulan',
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `subbrand_id`, `product_type_id`, `filling_machine_group_head_id`, `product_name`, `oracle_code`, `spek_ts_min`, `spek_ts_max`, `spek_ph_min`, `spek_ph_max`, `sla`, `waktu_analisa_mikro`, `inkubasi`, `trial_code`, `expired_range`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 1, 'HB YOGURT DRINK BLACKCURRANT 24PX200ML', '7300651', 14.50, 15.30, 4.35, 4.40, 4, 4, 0, 'HB-YD-BC', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 2, 1, 1, 'HB YOGURT DRINK PEACH 24PX200ML', '7300451', 14.50, 15.30, 4.35, 4.40, 4, 4, 0, 'HB-YD-PC', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(3, 2, 1, 2, 'HB YOGURT DRINK PEACH 24PX200ML PROMO GUNDAM', '7300451250', 14.50, 15.30, 4.35, 4.40, 4, 4, 0, 'HB-YD-PC-G', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(4, 2, 2, 2, 'HB GREEK CLASSIC 24PX200ML', '7300861', 14.50, 16.00, 4.15, 4.25, 8, 5, 3, 'HB-GR-GR', 6, 1, 1, NULL, NULL, NULL, NULL, NULL),
(5, 2, 1, 2, 'HB YO YOGURT DRINK KIDS BANANA BERRIES BROCCOLI 24', '7300371', 17.25, 18.50, 4.35, 4.40, 4, 4, 0, 'HB-YO-BB', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(6, 2, 1, 2, 'HB YO YOGURT DRINK KIDS MANGO CARROT 24PX200ML', '7300351', 17.25, 18.50, 4.35, 4.50, 4, 4, 0, 'HB-YO-MC', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(7, 2, 1, 2, 'HB YOGURT DRINK LYCHEE SPINACH 24PX200ML', '7300751', 17.25, 18.50, 4.25, 4.35, 4, 4, 0, 'HB-YO-LS', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(8, 2, 1, 2, 'HB YOGURT DRINK RASPBERRY PUMPKIN 24PX200ML', '7300721', 17.25, 18.50, 4.25, 4.35, 4, 4, 0, 'HB-YO-RP', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(9, 2, 1, 1, 'HB YOGURT DRINK WHOLESOME ORIGINAL 24PX200ML', '7300851', 14.00, 15.30, 4.35, 4.40, 4, 4, 0, 'HB-YD-WH', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(10, 2, 1, 1, 'HB YOGURT DRINK WHOLESOME ORIGINAL 24PX200ML PROMO', '7300851250', 14.00, 15.30, 4.35, 4.40, 4, 4, 0, 'HB-YD-WH-G', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(11, 2, 1, 1, 'HB YOGURT DRINK STRAWBERRY 24PX200ML', '7300281', 14.50, 15.30, 4.35, 4.40, 4, 4, 0, 'HB-YD-ST', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(12, 2, 1, 1, 'HB YOGURT DRINK STRAWBERRY 24PX200ML PROMO GUNDAM', '7300281250', 14.50, 15.30, 4.35, 4.40, 4, 4, 0, 'HB-YD-ST-G', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(13, 1, 1, 1, 'HILO SCHOOL RTD COKLAT 24PX200ML', '2101492', 15.00, 16.00, 6.60, 14.00, 3, 3, 0, 'HL-SC-CO', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(14, 1, 1, 1, 'HILO SCHOOL RTD VEGIBERI 24PX200ML', '21014281', 13.50, 14.50, 6.60, 14.00, 3, 3, 0, 'HL-SC-VE', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(15, 1, 1, 1, 'HILO SCHOOL RTD VEGIBERI 4BNDX6PX200ML CAMBODIA', '5101428160KH', 13.50, 14.50, 6.60, 14.00, 3, 3, 0, '-', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(16, 1, 1, 1, 'HILO TEEN RTD COKLAT 4BNDX6PX200ML CAMBODIA', '5101461600KH', 15.00, 16.00, 6.60, 14.00, 3, 3, 0, '-', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(17, 1, 1, 1, 'HILO TEEN RTD COFFEE TIRAMISU 24PX200ML', '2101656', 14.40, 15.40, 6.60, 14.00, 3, 3, 0, 'HL-TE-TI', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(18, 4, 1, 1, 'L-MEN HIPROTEIN 2 GO RTD CHOCOLATE 12DX2PX200ML', '2307061', 11.80, 12.20, 6.60, 14.00, 3, 3, 0, '-', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(19, 4, 1, 1, 'L-MEN RTD HIGH PROTEIN 2GO CHOCOLATE 24PX200ML', '2307061250', 14.40, 15.20, 6.60, 14.00, 3, 3, 0, 'LM-OT-CO', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(20, 1, 1, 1, 'HILO TEEN RTD COKLAT 200ML', '2101461', 15.00, 16.00, 6.60, 14.00, 3, 3, 0, 'HL-TE-CO', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(21, 3, 1, 1, 'WRP RTD CHOCOLATE 12Dx400ML', '2205061', 17.50, 18.50, 6.50, 4.00, 3, 3, 0, '-', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(22, 3, 1, 1, 'WRP RTD CHOCOLATE 12DX400ML MALDIVES', '5205061MV', 17.50, 18.50, 6.50, 14.00, 3, 3, 0, '-', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(23, 3, 1, 1, 'WRP ON THE GO CHOCOLATE 24PX200ML', '2205051', 17.50, 18.50, 6.50, 14.00, 3, 3, 0, 'WR-OT-CO', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(24, 3, 1, 1, 'WRP ON THE GO COFFEE 24PX200ML', '2205050', 17.50, 18.50, 6.30, 14.00, 3, 3, 0, 'WR-OT-CF', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(25, 3, 1, 1, 'WRP ON THE GO STRAWBERRY 24PX200ML', '22050281', 17.50, 18.50, 6.30, 14.00, 3, 3, 0, 'WR-OT-ST', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(26, 3, 1, 1, 'WRP RTD ON THE GO ORIGINAL 24Px200ML', '2205000', 17.50, 18.50, 6.50, 14.00, 3, 3, 0, 'WR-OT-OR', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(27, 2, 1, 1, 'HB YOGURT DRINK BLACKCURRANT 24PX200ML PROMO GUNDA', '7300651250', 15.30, 14.50, 4.35, 4.40, 4, 4, 0, 'HB-YD-BC-G', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(28, 3, 1, 1, 'WRP ON THE GO ORIGINAL 24PX200ML', '2205000', 17.50, 18.50, 6.50, 14.00, 3, 3, 0, 'WR-OT-OR', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(29, 5, 1, 1, 'NS RTD JERUK MADU 24PX200ML', '1101182250', 8.00, 9.00, 3.60, 3.90, 8, 6, 2, 'NS-RT-JM', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(30, 6, 1, 0, 'YOBASE LOW FAT HB YOGURT ORIGINAL', '7200004', 12.00, 12.50, 6.40, 6.55, 0, 0, NULL, 'HB-YB-OR', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(31, 6, 1, 0, 'YOBASE LOW FAT HB YOGURT', '7200000', 12.00, 12.50, 6.40, 6.55, 0, 0, NULL, 'HB-YB-LF', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(32, 6, 1, 0, 'COMPOUND YOBASE HB YO', '7200002', 12.00, 12.50, 6.50, 6.55, 0, 0, NULL, 'HB-YB-YO', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(33, 2, 1, 2, 'MIXING HB YOGURT DRINK LYCHEE SPINACH KOMA', '7300751K', 17.25, 18.50, 4.25, 4.35, 5, 4, NULL, 'LY-SP-KO', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(34, 2, 1, 2, 'MIXING HB YOGURT DRINK RASPBERRY PUMPKIN 200ML KOMA', '7300721K', 17.25, 18.50, 4.25, 4.35, 5, 4, NULL, 'LY-SP-KO', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(35, 1, 1, 1, 'Hilo RTD Chocolate Taro 200 ml', '2101809250', 10.60, 11.00, 6.80, 7.70, 7, 7, 0, 'HL-CH-TA', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(36, 5, 2, 2, 'NS RTD MANGO SMOOTHIE 24PX200ML', '1101155250', 10.00, 11.50, 4.10, 4.30, 8, 6, 2, 'NS-RT-MS', 12, 1, 1, NULL, NULL, NULL, NULL, NULL),
(37, 1, 2, 1, 'HILO RTD THAI TEA 24PX200ML', '2101947250', 11.40, 12.00, 6.80, 7.40, 3, 7, 7, 'HL-TH-TE', 12, 1, 1, NULL, NULL, '2020-04-04 10:38:20', '2020-04-04 10:38:20', NULL),
(38, 1, 1, 1, 'HILO RTD MILKY BROWN SUGAR 24P X 200 ML', '2101941250', 12.10, 12.60, 6.98, 7.10, 3, 3, 0, 'HL-MB-SG', 12, 1, 1, NULL, NULL, '2020-04-04 10:41:16', '2020-04-04 10:41:16', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_types`
--

CREATE TABLE `product_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_type` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_types`
--

INSERT INTO `product_types` (`id`, `product_type`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Susu', 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Non Susu', 1, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `subbrands`
--

CREATE TABLE `subbrands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) NOT NULL COMMENT 'connect to brands table ',
  `subbrand_name` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive ; 1 = active',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `subbrands`
--

INSERT INTO `subbrands` (`id`, `brand_id`, `subbrand_name`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'HiLo', 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'HB', 1, 1, NULL, NULL, NULL, NULL, NULL),
(3, 3, 'WRP', 1, 1, NULL, NULL, NULL, NULL, NULL),
(4, 1, 'L-Men', 1, 1, NULL, NULL, NULL, NULL, NULL),
(5, 1, 'Nutrisari', 1, 1, NULL, NULL, NULL, NULL, NULL),
(6, 2, 'Yobase', 1, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) NOT NULL COMMENT 'connected to employee table',
  `username` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL COMMENT '0 = unverified , 1 = verified',
  `verified_by_admin` tinyint(1) NOT NULL COMMENT '0 = unverified , 1 = verified',
  `is_active` tinyint(1) NOT NULL COMMENT '0 = inactive , 1 = active',
  `last_update_password` date NOT NULL COMMENT 'for update password after 3 months',
  `created_by` bigint(20) NOT NULL COMMENT 'connected to user table',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'connected to user table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `employee_id`, `username`, `password`, `verified`, `verified_by_admin`, `is_active`, `last_update_password`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'nesta_nm', '$2y$10$QV.64VPXbUMbwWzjnjsOLOykXm7VY00q02Hd2bdEzp7GwUVfwbpCC', 1, 1, 1, '2020-06-28', 1, NULL, NULL, '2020-01-23 15:24:34', '2020-03-25 08:51:13', NULL),
(2, 2, 'administrator', '$2y$10$Sm7Y2i4IBAAtJvSjIvUk2eEStda84URGwA1H1x5BHcsjJsp/R5I5q', 1, 1, 1, '2020-01-25', 1, NULL, NULL, '2020-01-23 15:24:34', '2020-01-23 15:24:34', NULL),
(29, 6, '0009361808', '$2y$10$QwcwIAj2epLzLEU8Td/a6.50nSxc5J.sZpBddb/5GVAvyXlMO0rBK', 1, 1, 1, '2019-09-23', 1, NULL, NULL, '2019-07-10 00:30:54', '2019-09-22 17:15:05', NULL),
(30, 7, 'adiyono', '$2y$10$UDTFO7gp4N0nEw5w4cx.r.XZE/9paYYE1jVHhCRDUJCzHytl76AVm', 1, 1, 1, '2020-02-17', 1, NULL, NULL, '2019-09-20 17:39:51', '2020-02-15 12:58:57', NULL),
(31, 8, 'hendrajaya', '$2y$10$QRPpvuvurEfDCspi/jKOjuPZrknM58UkecUiIr5CULCZXbJ/8hTY.', 1, 1, 1, '2020-02-05', 1, NULL, NULL, '2019-09-20 17:40:26', '2020-02-03 03:58:44', NULL),
(32, 9, 'yunianto', '$2y$10$UOAS2jyhLGzc59Vyq.qVFec0FKTqkcHNsHm6gMzWBjAIjmi4yJAVq', 1, 1, 1, '2020-02-17', 1, NULL, NULL, '2019-09-20 17:41:01', '2020-02-14 22:06:34', NULL),
(33, 10, 'mulyana.adi', '$2y$10$j8kP1iE41ZNHwcIBYtlNVubqrC55O3srjUivjmJbZFIZKgNXmiMM6', 1, 1, 1, '2019-09-30', 1, NULL, NULL, '2019-09-20 17:43:50', '2019-09-28 07:10:15', NULL),
(34, 11, 'awang.sunarwan', '$2y$10$ZO1xBUq6fnqNFmtpaWmF1uqR8YEybOP4pPRk4oy7hyX5R0bZxHBiK', 1, 1, 1, '2020-02-05', 1, NULL, NULL, '2019-09-20 17:44:15', '2020-02-04 06:12:50', NULL),
(35, 12, 'sahroni', '$2y$10$qsfeNpIMJ10g0m8lw68nk.Bsp/w2O9zUiNuu5lPVlSdqHPi57KRuC', 1, 1, 0, '2020-02-06', 1, NULL, NULL, '2019-09-20 17:44:30', '2020-02-09 19:50:46', NULL),
(36, 13, 'sunarya', '$2y$10$.1Lh.zn5S8XE8mE8Q7NSou3LtQLxaH55iFXubrmLkPe1LMeCU8xi.', 1, 1, 1, '2019-12-02', 1, NULL, NULL, '2019-09-20 18:31:30', '2019-12-18 06:58:01', NULL),
(37, 14, 'irfai', '$2y$10$75vahP9Nj2aIrvRid1ReE.5Lh3BgJBdzu7FmIt396pj5stMEYiZb.', 1, 1, 0, '2020-01-06', 1, NULL, NULL, '2019-09-20 18:31:55', '2020-01-19 08:22:42', NULL),
(38, 15, 'leonardo', '$2y$10$KZNIFDSbR6zZVHBrJ5tI9.caE/zazitnkSBFi6xzupqEYphuPTzqK', 1, 1, 1, '2020-01-22', 1, NULL, NULL, '2019-09-20 18:32:18', '2020-02-12 14:17:21', NULL),
(39, 16, 'acu.supriadi', '$2y$10$/UmLICHLHMWU3UdHJQm0u.EuDLrbnrODE1n0wsNI7Zk0tBF215nqu', 1, 1, 1, '2019-11-13', 1, NULL, NULL, '2019-09-27 18:31:32', '2019-11-10 23:45:26', NULL),
(40, 17, 'dwi.hermawan', '$2y$10$.E1JQ8FUyC5AAUl6ghLC3OQ2pbNneE3PNbl87ohaMaLPT6nHokuFS', 1, 1, 1, '2019-08-31', 1, NULL, NULL, '2019-09-27 18:32:05', '2019-09-27 18:32:05', NULL),
(41, 18, 'rady.irawan', '$2y$10$Bkc.iBMsD4hT/myXCQsrx.aIN0IsSnWN6S5NoUahMr8jhQRo.v0wi', 1, 1, 1, '2019-08-31', 1, NULL, NULL, '2019-09-27 18:32:53', '2019-09-28 03:21:00', NULL),
(42, 19, 'teguh.wicaksana', '$2y$10$ZHAN0tyyaZS82gZ/ekjWC.I0Iw5CPYsD8NMwVxZCGhSkXkvmvtx82', 1, 1, 1, '2019-08-31', 1, NULL, NULL, '2019-09-27 18:34:14', '2019-09-27 18:34:14', NULL),
(43, 20, 'willianto', '$2y$10$qVE42V7RgVOQPC1Fwc90CeL20Li28X8f0FxD89MAGLglzkqUTHAtq', 1, 1, 1, '2019-08-31', 1, NULL, NULL, '2019-09-27 18:45:59', '2019-09-27 22:07:11', NULL),
(44, 21, 'mujiono', '$2y$10$xuxRYXDutW1v6IjD5xAldOL5pXnghfumRGcTtk4TaMJBBFHCwsRhK', 1, 1, 1, '2019-08-31', 1, NULL, NULL, '2019-09-27 18:55:44', '2019-09-27 18:55:44', NULL),
(45, 22, 'hilda.utami', '$2y$10$GEaxr28WUsEKZzm0/.465.aml7V6bYJbxNkw8IUV0gRhQDlSXNSmm', 1, 1, 1, '2019-11-05', 1, NULL, NULL, '2019-09-27 18:56:56', '2019-11-16 01:13:41', NULL),
(46, 23, 'lukmanul.hakim', '$2y$10$FGWULyb1KYKCyBDkHtRRmOuXlGHCXxqmJmegtDUTSDoEZxlpyv.Ke', 1, 1, 1, '2019-08-31', 1, NULL, NULL, '2019-09-27 18:59:11', '2019-09-27 18:59:11', NULL),
(47, 24, 'agung.maulana', '$2y$10$W2vP3ViNjfwj7T4fD11/2uave05.dT8xt2nLQ3VhKMZoezeVqWVNy', 1, 1, 1, '2019-08-31', 1, NULL, NULL, '2019-09-27 19:01:28', '2019-09-27 19:01:28', NULL),
(48, 25, 'paula.wulandari', '$2y$10$G2cBCPxqnqjmWwCtWUa7o.4i05aFEVVUx3mLoxENtPPHKPqCfRKPi', 1, 1, 1, '2020-01-21', 1, NULL, NULL, '2019-09-27 19:09:38', '2020-01-19 03:04:53', NULL),
(49, 26, 'febdian', '$2y$10$770.plPKbnB.W52XTMNZduN/1an4skmg/dFY5QFhZGm3qGxh21rgu', 1, 1, 1, '2020-01-06', 1, NULL, NULL, '2019-09-27 19:11:23', '2020-01-04 00:50:45', NULL),
(50, 27, 'afrilia.nurdian', '$2y$10$QNu1xPLEkziW2xssc7EtmeC6NnlCkB10n/oIfMi45Ik0FFhWGuSnu', 1, 1, 1, '2020-01-07', 1, NULL, NULL, '2019-09-27 19:12:07', '2020-01-05 05:21:24', NULL),
(51, 28, 'romi.anggara', '$2y$10$gOVZUrpXA4M2sxlAJtcXyOZYMMvvTlHETqkwucYSWQypcM9rmLhRa', 1, 1, 1, '2019-08-31', 1, NULL, NULL, '2019-09-27 19:13:06', '2019-09-27 19:13:06', NULL),
(52, 29, 'gugum.chandra', '$2y$10$uOe8ZLUeK252JpOwhbJoieIzMsFJ8kCNrdWe/lrLZ2VjvtvweF5FO', 1, 1, 1, '2019-08-31', 1, NULL, NULL, '2019-09-27 19:13:55', '2019-09-27 19:13:55', NULL),
(53, 30, 'jilli.saaduddin', '$2y$10$o7mB3Qc2LnETFsTUMrpateM.qO2QVZ2L2/2CUzXd/N9/1wUIPCeka', 1, 1, 1, '2019-08-31', 1, NULL, NULL, '2019-09-27 19:15:02', '2019-09-27 19:15:02', NULL),
(54, 31, 'didit', '$2y$10$CsWDsQgEmEtdVHnDeu1DH.XJThfGcYQc4XASo8a7K7rAwogSaxrm2', 1, 1, 1, '2019-08-31', 1, NULL, NULL, '2019-09-27 19:21:02', '2019-09-27 19:21:02', NULL),
(55, 32, 'dhiaksa.mahitra', '$2y$10$.Z.M3IQaLb/0bOcHuHxPBucYsDzM4dJ6gnUbE5t/FaSPATSSUcIcy', 1, 1, 1, '2019-08-31', 1, NULL, NULL, '2019-09-27 19:21:35', '2019-09-27 19:21:35', NULL),
(56, 33, 'hendra.darusman', '$2y$10$WVfydCUOp8Y1MXmGEJMU5.FFSFlLf2AJ7YKWe4qFS.fQg75SCzoqu', 1, 1, 1, '2019-10-16', 1, NULL, NULL, '2019-09-27 19:54:56', '2019-10-14 03:26:59', NULL),
(57, 34, 'miftahul.husein', '$2y$10$rAtXXsEZMWRLXG3nFbflteCliynKuVxAEiSjTeqGhZlg8X5j87BOe', 1, 1, 1, '2019-09-30', 1, NULL, NULL, '2019-09-28 00:51:06', '2019-09-29 16:32:20', NULL),
(58, 35, 'putri.reta', '$2y$10$t1EpvgM8Vt9UOcYy3Tw43OfPHSJsmHdRK/XRFoCOFwHajceLUjXmq', 1, 1, 1, '2019-08-31', 1, NULL, NULL, '2019-09-28 00:51:57', '2019-09-28 00:51:57', NULL),
(59, 36, 'taufik.nugraha', '$2y$10$rHwKojQdXX64sxQkDqBY8.YvpCLaLTk0EtWP5Kq9iFvlv3d4ir1pm', 1, 1, 1, '2019-10-01', 1, NULL, NULL, '2019-09-28 01:06:56', '2019-09-28 16:49:29', NULL),
(66, 43, 'acu', '$2y$10$5HNSgNTA4prPX8j/QOeZCe4Rk3zNM3B0S2Viac9HYgHlV6vXBFxwa', 1, 0, 0, '2019-10-08', 1, NULL, NULL, '2019-11-04 23:40:19', '2019-11-04 23:40:48', NULL),
(67, 44, 'maulana.pandawa', '$2y$10$sL8InqmGVPXXqNV/AlDKZuTpjezUKD3Ort5UJdlDBVHHx1yLvj.W2', 1, 0, 0, '2019-10-13', 1, NULL, NULL, '2019-11-10 06:24:08', '2019-11-10 06:24:53', NULL),
(68, 45, 'QCReference.sen', '$2y$10$Tu9Q.P7pwhxhEcwUa9S8kuvPVxARJrskXBOQ7Rt2U0WZhebRJc/ee', 0, 0, 0, '2019-10-20', 1, NULL, NULL, '2019-11-17 07:29:55', '2019-11-17 07:29:55', NULL),
(69, 46, 'sunarwan556', '$2y$10$hWkmhmeJL0Y6Kdmh13zSGeo19tV2w.3GBgue1CmONidY8CiUSbAMC', 0, 0, 1, '2019-11-03', 1, NULL, NULL, '2019-11-30 23:44:14', '2019-11-30 23:44:14', NULL),
(70, 47, 'dodi.wijaya', '$2y$10$/8OAwiRIbyNdjloL.7HZ6euByd8MDHg5S8dlLhNp86ZjK4ZlUVway', 1, 1, 1, '2020-01-15', 1, NULL, NULL, '2019-12-13 17:04:22', '2020-01-13 05:43:30', NULL),
(71, 48, 'sindhu.prathama', '$2y$10$lqEz.jal15JdX0rh1b3Z7eY3doNkT.UKKEFwRcFJKDzUCkgby8ni2', 1, 1, 1, '2019-12-26', 1, NULL, NULL, '2019-12-13 17:05:12', '2019-12-24 05:30:30', NULL),
(72, 49, 'chiptana', '$2y$10$fvgpsI0NzeXEqaeLnFdVHeTTPEgGGUt8OLopHpFKMEDqhPXZxyrOG', 1, 1, 1, '2020-03-06', 1, NULL, NULL, '2019-12-13 17:08:08', '2020-03-03 23:05:35', NULL),
(73, 50, 'wildan.hasan', '$2y$10$zT9GMLY1J6pRN.5lO1hyseC.CVDYVrhIC8YSJf.LHg7nubz8F8hMq', 1, 1, 1, '2020-02-27', 1, NULL, NULL, '2019-12-13 17:08:48', '2020-02-25 00:49:21', NULL),
(74, 51, 'agit.sukmana', '$2y$10$xsgKtEweayOJonorbTwSUerJmJFvtMboLWCkA8qrXDxHPGlKj3wHe', 1, 1, 1, '2019-12-16', 1, NULL, NULL, '2019-12-13 17:10:48', '2019-12-13 23:50:44', NULL),
(75, 52, 'fadhly.yudha', '$2y$10$uKm.KFF1Yy8KuHufZ2HBAepQZVxq4kcPyIRZn09RJX/OIwbhZApa2', 1, 1, 1, '2020-01-23', 1, NULL, NULL, '2019-12-13 17:11:31', '2020-02-15 20:41:03', NULL),
(76, 53, 'desse.firmanda', '$2y$10$cZfHjSQsqcveyJeSmjmuc.H7G5rxXSrLFaz3GzgSjGlPwfjQg8cWO', 1, 1, 1, '2019-12-24', 1, NULL, NULL, '2019-12-13 17:12:32', '2019-12-22 05:45:34', NULL),
(77, 54, 'baiat.abdullah', '$2y$10$cOV3fNWbqjhWK88SPS1fOOp.jTfbDTShdRt0GrNgKkNc9/EW8qcr2', 1, 1, 1, '2020-02-24', 1, NULL, NULL, '2019-12-13 17:13:15', '2020-02-21 23:50:05', NULL),
(78, 55, 'agus.sarno', '$2y$12$Bd/HIKhvM1RHjnwEOTtYfeapRAacRMSLzzE3GROQGRPQBGaJuIgO6', 1, 1, 1, '2020-01-15', 1, NULL, NULL, '2019-12-13 17:13:51', '2020-02-03 00:00:51', NULL),
(79, 56, 'akbar.toash', '$2y$10$pX/5lD/gCTmeeUdHHfbifOf.DQzYENkeHpAf.lNWy9/JodD.AyWce', 1, 1, 0, '2020-01-24', 1, NULL, NULL, '2019-12-13 17:14:32', '2020-02-19 23:06:14', NULL),
(80, 57, 'bayu.pamungkas', '$2y$10$zXiok875SGwzS.BfwW.4pu3YePHwkFFYBMlQUgCqRysQsyHmFz/Fm', 1, 1, 1, '2019-12-16', 1, NULL, NULL, '2019-12-13 17:15:16', '2020-01-07 01:32:08', NULL),
(81, 58, 'satrio', '$2y$10$rI7mNeIK43tmPwYdvadW8OZQNIbMyWOppcYFaJNI7hbQEXMawIphS', 1, 1, 1, '2020-02-25', 1, NULL, NULL, '2019-12-13 17:15:45', '2020-02-22 20:58:28', NULL),
(82, 59, 'rizki.amalia', '$2y$10$OCRSDRYefvWRcN/dQ1eWR.kXob/gI6XWDXifaBGOyBuH2yLot6tmO', 1, 1, 1, '2020-01-16', 1, NULL, NULL, '2019-12-13 17:16:21', '2020-01-13 23:48:45', NULL),
(83, 60, 'hassanudin', '$2y$10$Na.fZnbMIYd176ecTiHbOOWzscovFOQ8MVvRbXrli/82aRmSHqoNi', 1, 1, 1, '2019-11-16', 1, NULL, NULL, '2019-12-13 17:18:04', '2019-12-13 17:18:04', NULL),
(84, 61, 'rico.wicaksono', '$2y$10$RXTAu8/hbO0FfXLWeU18euEM3kV76blc3MKvDaKLZg8vnwQdrjtIK', 1, 1, 1, '2020-02-08', 1, NULL, NULL, '2019-12-13 17:18:55', '2020-02-06 01:26:39', NULL),
(85, 62, 'hery.abdurouf', '$2y$10$Lyu1SjnPAZOQoqsduwSvPezmF.NMuqU/ZOZm3EF5qTU2jaMYr20.q', 1, 1, 1, '2019-12-23', 1, NULL, NULL, '2019-12-13 17:31:47', '2019-12-21 06:57:39', NULL),
(86, 63, 'sunarwan556@', '$2y$10$YTb0bVD8UA9tk/rH8TRhguaNisr9o9FQEJ5dPe31T8xzLIu/41ORy', 0, 0, 0, '2019-11-28', 1, NULL, NULL, '2019-12-26 07:33:13', '2019-12-26 07:33:13', NULL),
(87, 64, 'Naufal', '$2y$10$57FJ.kezU5Mqqo.JVeVMLOqcyT1KatMf7PTuEkhDAdRZ2.PzmO5hW', 1, 0, 0, '2019-12-06', 1, NULL, NULL, '2020-01-03 06:25:21', '2020-01-03 06:25:45', NULL),
(88, 65, 'bayu.priasmoro', '$2y$10$Xogpq09ywY9wDLX15fokZe8ViE6NSGNLRQKyaIYxBYl6UdyN8ij6a', 1, 1, 1, '2020-02-06', 1, NULL, NULL, '2020-01-05 06:48:24', '2020-02-04 15:10:23', NULL),
(90, 70, 'jajang.nurjaman', '$2y$10$a3yaPkMqxInwGkFjVWyrOeSN4Oq06/dnhzmuXMuamHv10qaOO39F2', 1, 1, 0, '2020-03-07', 0, NULL, NULL, NULL, '2020-04-04 09:58:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `application_permissions`
--
ALTER TABLE `application_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `distribution_lists`
--
ALTER TABLE `distribution_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `filling_machines`
--
ALTER TABLE `filling_machines`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `filling_machine_group_details`
--
ALTER TABLE `filling_machine_group_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `filling_machine_group_heads`
--
ALTER TABLE `filling_machine_group_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `filling_sampel_codes`
--
ALTER TABLE `filling_sampel_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `flowmeters`
--
ALTER TABLE `flowmeters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `flowmeter_categories`
--
ALTER TABLE `flowmeter_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `flowmeter_consumption_realisation_details`
--
ALTER TABLE `flowmeter_consumption_realisation_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `flowmeter_consumption_realisation_heads`
--
ALTER TABLE `flowmeter_consumption_realisation_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `flowmeter_formulas`
--
ALTER TABLE `flowmeter_formulas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `flowmeter_locations`
--
ALTER TABLE `flowmeter_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `flowmeter_units`
--
ALTER TABLE `flowmeter_units`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `flowmeter_usages`
--
ALTER TABLE `flowmeter_usages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `flowmeter_workcenters`
--
ALTER TABLE `flowmeter_workcenters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `icons`
--
ALTER TABLE `icons`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_ppqs`
--
ALTER TABLE `jenis_ppqs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_ppqs`
--
ALTER TABLE `kategori_ppqs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_permissions`
--
ALTER TABLE `menu_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `subbrands`
--
ALTER TABLE `subbrands`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `application_permissions`
--
ALTER TABLE `application_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `distribution_lists`
--
ALTER TABLE `distribution_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `filling_machines`
--
ALTER TABLE `filling_machines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `filling_machine_group_details`
--
ALTER TABLE `filling_machine_group_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `filling_machine_group_heads`
--
ALTER TABLE `filling_machine_group_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `filling_sampel_codes`
--
ALTER TABLE `filling_sampel_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT untuk tabel `flowmeters`
--
ALTER TABLE `flowmeters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `flowmeter_categories`
--
ALTER TABLE `flowmeter_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `flowmeter_consumption_realisation_details`
--
ALTER TABLE `flowmeter_consumption_realisation_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `flowmeter_consumption_realisation_heads`
--
ALTER TABLE `flowmeter_consumption_realisation_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `flowmeter_formulas`
--
ALTER TABLE `flowmeter_formulas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `flowmeter_locations`
--
ALTER TABLE `flowmeter_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `flowmeter_units`
--
ALTER TABLE `flowmeter_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `flowmeter_usages`
--
ALTER TABLE `flowmeter_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `flowmeter_workcenters`
--
ALTER TABLE `flowmeter_workcenters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `icons`
--
ALTER TABLE `icons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=787;

--
-- AUTO_INCREMENT untuk tabel `jenis_ppqs`
--
ALTER TABLE `jenis_ppqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori_ppqs`
--
ALTER TABLE `kategori_ppqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `menu_permissions`
--
ALTER TABLE `menu_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4049;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT untuk tabel `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `subbrands`
--
ALTER TABLE `subbrands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
