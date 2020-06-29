INSERT INTO `cpp_details` (`id`, `cpp_head_id`, `wo_number_id`, `filling_machine_id`, `lot_number`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 'KC2206A', 1, NULL, NULL, '2020-06-28 09:29:34', '2020-06-28 09:29:34', NULL);

INSERT INTO `cpp_heads` (`id`, `product_id`, `analisa_kimia_id`, `analisa_mikro_id`, `packing_date`, `cpp_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 20, NULL, NULL, '2020-06-28', '1', 1, 1, NULL, '2020-06-28 09:27:56', '2020-06-28 10:10:22', NULL);

INSERT INTO `palets` (`id`, `cpp_detail_id`, `palet`, `start`, `end`, `jumlah_box`, `jumlah_pack`, `analisa_mikro_30_status`, `analisa_mikro_55_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'P01', '2020-06-22 21:46:21', '2020-06-22 22:22:35', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:29:34', '2020-06-28 09:56:22', NULL),
(2, 1, 'P02', '2020-06-22 22:22:35', '2020-06-22 22:49:05', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:29:37', '2020-06-28 09:56:32', NULL),
(3, 1, 'P03', '2020-06-22 22:49:05', '2020-06-22 23:15:30', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:29:39', '2020-06-28 09:56:37', NULL),
(4, 1, 'P04', '2020-06-22 23:15:30', '2020-06-22 23:50:11', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:29:41', '2020-06-28 09:56:40', NULL),
(5, 1, 'P05', '2020-06-22 23:50:11', '2020-06-23 00:27:21', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:29:43', '2020-06-28 09:56:43', NULL),
(6, 1, 'P06', '2020-06-23 00:27:21', '2020-06-23 01:01:36', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:29:45', '2020-06-28 09:56:53', NULL),
(7, 1, 'P07', '2020-06-23 01:01:36', '2020-06-23 01:28:10', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:29:46', '2020-06-28 09:56:57', NULL),
(8, 1, 'P08', '2020-06-23 01:28:10', '2020-06-23 01:59:40', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:29:48', '2020-06-28 09:57:06', NULL),
(9, 1, 'P09', '2020-06-23 01:59:40', '2020-06-23 02:28:31', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:29:49', '2020-06-28 09:57:09', NULL),
(10, 1, 'P10', '2020-06-23 02:28:31', '2020-06-23 02:55:38', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:29:51', '2020-06-28 09:57:13', NULL),
(11, 1, 'P11', '2020-06-23 02:55:38', '2020-06-23 03:25:04', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:29:55', '2020-06-28 09:57:16', NULL),
(12, 1, 'P12', '2020-06-23 03:25:04', '2020-06-23 04:02:50', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:29:57', '2020-06-28 09:57:19', NULL),
(13, 1, 'P13', '2020-06-23 04:02:50', '2020-06-23 04:29:31', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:41:17', '2020-06-28 09:57:26', NULL),
(14, 1, 'P14', '2020-06-23 04:29:31', '2020-06-23 04:55:50', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:41:18', '2020-06-28 09:57:31', NULL),
(15, 1, 'P15', '2020-06-23 04:55:50', '2020-06-23 05:22:13', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:41:21', '2020-06-28 09:57:34', NULL),
(16, 1, 'P16', '2020-06-23 05:22:13', '2020-06-23 05:55:50', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:41:26', '2020-06-28 09:57:38', NULL),
(17, 1, 'P17', '2020-06-23 05:55:50', '2020-06-23 06:22:57', 140, 3360, NULL, NULL, 1, 1, NULL, '2020-06-28 09:41:27', '2020-06-28 09:57:42', NULL),
(18, 1, 'P18', '2020-06-23 06:22:57', '2020-06-23 06:32:55', 52, 1248, NULL, NULL, 1, 1, NULL, '2020-06-28 09:41:29', '2020-06-28 09:57:46', NULL);

INSERT INTO `palet_ppqs` (`id`, `ppq_id`, `palet_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 1, 5, 1, NULL, NULL, '2020-06-28 10:03:41', '2020-06-28 10:03:41', NULL),
(18, 1, 6, 1, NULL, NULL, '2020-06-28 10:03:41', '2020-06-28 10:03:41', NULL);


INSERT INTO `ppqs` (`id`, `rpd_filling_detail_pi_id`, `cpp_head_id`, `kategori_ppq_id`, `nomor_ppq`, `ppq_date`, `jam_awal_ppq`, `jam_akhir_ppq`, `jumlah_pack`, `alasan`, `detail_titik_ppq`, `status_akhir`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 19, NULL, 2, '001/PPQ/VI/2020', '2020-06-28', '2020-06-23 00:10:19', '2020-06-23 00:30:00', 70, 'Overlapnya under spek', 'Dari jam sekian sampe jam sekian', '0', 1, 1, NULL, '2020-06-28 09:18:53', '2020-06-28 10:07:40', NULL);

INSERT INTO `rpd_filling_detail_pis` (`id`, `rpd_filling_head_id`, `wo_number_id`, `filling_machine_id`, `filling_sampel_code_id`, `filling_date`, `filling_time`, `berat_kanan`, `berat_kiri`, `overlap`, `ls_sa_proportion`, `volume_kanan`, `volume_kiri`, `airgap`, `ts_accurate_kanan`, `ts_accurate_kiri`, `ls_accurate`, `sa_accurate`, `surface_check`, `pinching`, `strip_folding`, `konduktivity_kanan`, `konduktivity_kiri`, `design_kanan`, `design_kiri`, `dye_test`, `residu_h2o2`, `prod_code_and_no_md`, `correction`, `dissolving_test`, `status_akhir`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, '2020-06-22', '21:46:00', 221.44, 222.46, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-06-28 07:57:49', '2020-06-28 08:51:58', NULL),
(2, 1, 1, 1, 8, '2020-06-22', '21:49:44', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 07:58:18', '2020-06-28 07:58:18', NULL),
(3, 1, 1, 1, 13, '2020-06-22', '21:52:18', 223.87, 221.65, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-06-28 07:58:55', '2020-06-28 08:55:40', NULL),
(4, 1, 1, 1, 8, '2020-06-22', '22:08:41', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 07:59:24', '2020-06-28 07:59:24', NULL),
(5, 1, 1, 1, 13, '2020-06-22', '22:15:50', 220.96, 223.96, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-06-28 08:01:07', '2020-06-28 08:57:12', NULL),
(6, 1, 1, 1, 20, '2020-06-22', '22:30:00', 222.22, 223.43, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-06-28 08:01:45', '2020-06-28 08:59:58', NULL),
(7, 1, 1, 1, 19, '2020-06-22', '22:45:05', 222.00, 223.48, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:02:28', '2020-06-28 08:02:28', NULL),
(8, 1, 1, 1, 20, '2020-06-22', '23:00:45', 223.73, 222.09, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:03:34', '2020-06-28 08:03:34', NULL),
(9, 1, 1, 1, 19, '2020-06-22', '23:15:05', 221.54, 222.34, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:04:32', '2020-06-28 08:04:32', NULL),
(10, 1, 1, 1, 20, '2020-06-22', '23:30:00', 221.88, 223.56, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:05:14', '2020-06-28 08:05:14', NULL),
(11, 1, 1, 1, 8, '2020-06-22', '23:35:46', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:05:44', '2020-06-28 08:05:44', NULL),
(12, 1, 1, 1, 13, '2020-06-22', '23:43:50', 221.70, 222.57, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:06:25', '2020-06-28 08:06:25', NULL),
(13, 1, 1, 1, 19, '2020-06-22', '23:45:00', 222.01, 223.09, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:07:31', '2020-06-28 08:07:31', NULL),
(14, 1, 1, 1, 20, '2020-06-23', '00:00:00', 222.26, 223.81, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:08:14', '2020-06-28 08:08:14', NULL),
(15, 1, 1, 1, 2, '2020-06-23', '00:06:09', 222.23, 223.63, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:09:12', '2020-06-28 08:09:12', NULL),
(16, 1, 1, 1, 4, '2020-06-23', '00:06:16', 222.26, 223.16, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:09:45', '2020-06-28 08:09:45', NULL),
(17, 1, 1, 1, 8, '2020-06-23', '00:10:19', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:10:11', '2020-06-28 08:10:11', NULL),
(18, 1, 1, 1, 13, '2020-06-23', '00:19:53', 221.27, 222.54, 3.20, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'Overlap underspek', NULL, '#OK', 1, 1, NULL, '2020-06-28 08:10:51', '2020-06-28 09:14:11', NULL),
(19, 1, 1, 1, 20, '2020-06-23', '00:30:00', 221.54, 223.21, 3.60, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-28 08:11:24', '2020-06-28 09:14:53', NULL),
(20, 1, 1, 1, 10, '2020-06-23', '00:33:15', 221.48, 223.07, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:12:03', '2020-06-28 08:12:03', NULL),
(21, 1, 1, 1, 16, '2020-06-23', '00:41:06', 221.39, 222.87, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:12:38', '2020-06-28 08:12:38', NULL),
(22, 1, 1, 1, 19, '2020-06-23', '00:45:16', 221.35, 222.85, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:13:20', '2020-06-28 08:13:20', NULL),
(23, 1, 1, 1, 3, '2020-06-23', '00:53:26', 222.46, 223.32, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:15:20', '2020-06-28 08:15:20', NULL),
(24, 1, 1, 1, 5, '2020-06-23', '00:53:34', 223.44, 221.92, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:16:28', '2020-06-28 08:16:28', NULL),
(25, 1, 1, 1, 20, '2020-06-23', '01:00:25', 223.03, 221.57, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:17:03', '2020-06-28 08:17:03', NULL),
(26, 1, 1, 1, 19, '2020-06-23', '01:15:04', 221.89, 223.13, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:17:36', '2020-06-28 08:17:36', NULL),
(27, 1, 1, 1, 20, '2020-06-23', '01:30:00', 221.72, 221.80, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:18:25', '2020-06-28 08:18:25', NULL),
(28, 1, 1, 1, 19, '2020-06-23', '01:46:30', 221.46, 223.24, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:19:06', '2020-06-28 08:19:06', NULL),
(29, 1, 1, 1, 12, '2020-06-23', '01:55:15', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:20:26', '2020-06-28 08:20:26', NULL),
(30, 1, 1, 1, 17, '2020-06-23', '01:57:46', 221.35, 221.71, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:21:02', '2020-06-28 08:21:02', NULL),
(31, 1, 1, 1, 2, '2020-06-23', '01:58:42', 222.35, 223.61, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:22:04', '2020-06-28 08:22:04', NULL),
(32, 1, 1, 1, 4, '2020-06-23', '01:58:50', 222.02, 222.04, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:22:34', '2020-06-28 08:22:34', NULL),
(33, 1, 1, 1, 20, '2020-06-23', '02:00:59', 223.37, 221.93, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:23:10', '2020-06-28 08:23:10', NULL),
(34, 1, 1, 1, 8, '2020-06-23', '02:14:58', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:23:49', '2020-06-28 08:23:49', NULL),
(35, 1, 1, 1, 13, '2020-06-23', '02:19:33', 221.59, 223.16, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:24:33', '2020-06-28 08:24:33', NULL),
(36, 1, 1, 1, 20, '2020-06-23', '02:30:00', 222.00, 223.69, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:25:07', '2020-06-28 08:25:07', NULL),
(37, 1, 1, 1, 19, '2020-06-23', '02:45:00', 222.25, 223.57, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:25:38', '2020-06-28 08:25:38', NULL),
(38, 1, 1, 1, 20, '2020-06-23', '03:00:00', 223.20, 222.20, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:26:14', '2020-06-28 08:26:14', NULL),
(39, 1, 1, 1, 8, '2020-06-23', '03:03:32', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:26:40', '2020-06-28 08:26:40', NULL),
(40, 1, 1, 1, 13, '2020-06-23', '03:06:07', 221.93, 223.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:27:13', '2020-06-28 08:27:13', NULL),
(41, 1, 1, 1, 3, '2020-06-23', '03:09:36', 223.37, 222.12, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:28:01', '2020-06-28 08:28:01', NULL),
(42, 1, 1, 1, 5, '2020-06-23', '03:09:23', 222.23, 223.38, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:28:40', '2020-06-28 08:28:40', NULL),
(43, 1, 1, 1, 19, '2020-06-23', '03:15:00', 223.41, 221.96, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:29:15', '2020-06-28 08:29:15', NULL),
(44, 1, 1, 1, 20, '2020-06-23', '03:30:00', 221.99, 223.75, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:29:46', '2020-06-28 08:29:46', NULL),
(45, 1, 1, 1, 10, '2020-06-23', '03:34:55', 221.48, 223.32, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:30:19', '2020-06-28 08:30:19', NULL),
(46, 1, 1, 1, 16, '2020-06-23', '03:45:59', 221.11, 222.67, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:30:54', '2020-06-28 08:30:54', NULL),
(47, 1, 1, 1, 2, '2020-06-23', '03:51:51', 223.03, 223.05, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:31:22', '2020-06-28 08:31:22', NULL),
(48, 1, 1, 1, 4, '2020-06-23', '03:51:58', 223.32, 222.25, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:32:00', '2020-06-28 08:32:00', NULL),
(49, 1, 1, 1, 19, '2020-06-23', '04:00:00', 223.35, 222.14, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, 1, '2020-06-28 08:32:24', '2020-06-28 08:33:03', '2020-06-28 08:33:03'),
(50, 1, 1, 2, 22, '2020-06-23', '15:33:21', 220.00, 200.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, 1, '2020-06-28 08:33:33', '2020-06-28 08:35:51', '2020-06-28 08:35:51'),
(51, 1, 1, 1, 20, '2020-06-23', '04:00:00', 221.46, 223.66, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:36:43', '2020-06-28 08:36:43', NULL),
(52, 1, 1, 1, 19, '2020-06-23', '04:15:00', 221.46, 223.15, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:37:15', '2020-06-28 08:37:15', NULL),
(53, 1, 1, 1, 20, '2020-06-23', '04:30:00', 221.15, 223.50, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:37:48', '2020-06-28 08:37:48', NULL),
(54, 1, 1, 1, 19, '2020-06-23', '04:45:10', 221.96, 223.57, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:38:20', '2020-06-28 08:38:20', NULL),
(55, 1, 1, 1, 20, '2020-06-23', '05:00:00', 221.95, 223.18, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:40:25', '2020-06-28 08:40:25', NULL),
(56, 1, 1, 1, 19, '2020-06-23', '05:16:02', 223.38, 222.28, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:41:00', '2020-06-28 08:41:00', NULL),
(57, 1, 1, 1, 20, '2020-06-23', '05:30:00', 221.80, 222.35, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:41:35', '2020-06-28 08:41:35', NULL),
(58, 1, 1, 1, 8, '2020-06-23', '05:39:30', 0.00, 0.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:41:59', '2020-06-28 08:41:59', NULL),
(59, 1, 1, 1, 13, '2020-06-23', '05:46:59', 222.89, 221.77, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:42:36', '2020-06-28 08:42:36', NULL),
(60, 1, 1, 1, 20, '2020-06-23', '06:00:00', 223.62, 221.61, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:43:12', '2020-06-28 08:43:12', NULL),
(61, 1, 1, 1, 2, '2020-06-23', '06:12:32', 223.85, 222.70, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:43:51', '2020-06-28 08:43:51', NULL),
(62, 1, 1, 1, 4, '2020-06-23', '06:12:40', 222.13, 223.03, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:44:24', '2020-06-28 08:44:24', NULL),
(63, 1, 1, 1, 19, '2020-06-23', '06:15:00', 222.69, 223.96, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:44:57', '2020-06-28 08:44:57', NULL),
(64, 1, 1, 1, 6, '2020-06-23', '06:19:50', 221.50, 222.90, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:45:32', '2020-06-28 08:45:32', NULL),
(65, 1, 1, 1, 7, '2020-06-23', '06:19:56', 221.50, 222.90, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:46:07', '2020-06-28 08:46:07', NULL),
(66, 1, 1, 1, 19, '2020-06-23', '06:30:15', 222.80, 221.47, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:48:10', '2020-06-28 08:48:10', NULL),
(67, 1, 1, 1, 18, '2020-06-23', '06:33:00', 223.00, 222.00, 3.80, '40:60', 220, 220, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, NULL, NULL, '2020-06-28 08:48:44', '2020-06-28 08:48:44', NULL);

INSERT INTO `rpd_filling_heads` (`id`, `product_id`, `start_filling_date`, `rpd_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 20, '2020-06-28', '1', 1, 1, NULL, '2020-06-28 07:55:50', '2020-06-28 10:08:59', NULL);

INSERT INTO `wo_numbers` (`id`, `plan_id`, `product_id`, `rpd_filling_head_id`, `cpp_head_id`, `wo_number`, `production_plan_date`, `production_realisation_date`, `expired_date`, `fillpack_date`, `plan_batch_size`, `actual_batch_size`, `completion_date`, `explanation_1`, `explanation_2`, `explanation_3`, `formula_revision`, `wo_status`, `upload_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 20, 1, 1, 'G2006214008', '2020-06-22', '2020-06-22', '2021-06-22', '2020-06-28', '9969.25', NULL, NULL, '-', '-', '-', '-', '4', '1', 1, 1, NULL, NULL, '2020-06-28 10:10:22', NULL),
(2, 3, 13, NULL, NULL, 'G2006214004', '2020-06-22', NULL, NULL, NULL, '9956.565', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AR/34.44)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 07:54:52', NULL),
(3, 3, 13, NULL, NULL, 'G2006214010', '2020-06-22', NULL, NULL, NULL, '9956.565', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AR/34.44)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 07:54:52', NULL),
(4, 3, 31, NULL, NULL, 'G2006700011', '2020-06-23', NULL, NULL, NULL, '2196.15', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE LOW FAT HB YOGURT ( 3.7/WPHB03)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 07:54:53', NULL),
(5, 3, 30, NULL, NULL, 'G2006700010', '2020-06-23', NULL, NULL, NULL, '6625.45', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE LOW FAT HB YOGURT ORIGINAL 01-00 ( 1.2/WPHB02)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 07:54:53', NULL),
(6, 3, 9, NULL, NULL, 'G2006708009', '2020-06-23', NULL, NULL, NULL, '6660', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT WHOLESOME ORIGINAL ( 2/FGHB02)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 07:54:53', NULL),
(7, 3, 4, NULL, NULL, 'G2006708007', '2020-06-23', NULL, NULL, NULL, '5887.26', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HB GREEK CLASSIC 24X200ML (SENTUL) ( 0.5/FGHB09)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 07:54:54', NULL),
(8, 3, 1, NULL, NULL, 'G2006706002', '2020-06-24', NULL, NULL, NULL, '10048.24', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT BLACKCURRANT ( 3.3/FGHB03)', '0', '1', 1, 1, NULL, NULL, '2020-06-28 07:54:54', NULL);
