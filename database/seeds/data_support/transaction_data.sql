
INSERT INTO `analisa_kimias` (`id`, `cpp_head_id`, `ppq_id`, `ts_awal_1`, `ts_awal_2`, `ts_tengah_1`, `ts_tengah_2`, `ts_akhir_1`, `ts_akhir_2`, `ts_awal_avg`, `ts_tengah_avg`, `ts_akhir_avg`, `ph_awal`, `ph_tengah`, `ph_akhir`, `visko_awal`, `visko_tengah`, `visko_akhir`, `sensori_awal`, `sensori_tengah`, `sensori_akhir`, `jam_filling_awal`, `jam_filling_tengah`, `jam_filling_akhir`, `ts_oven_awal`, `ts_oven_tengah`, `ts_oven_akhir`, `kode_batch_standar`, `progress_status`, `analisa_kimia_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 17.86, 17.86, 17.86, 17.86, 17.86, 17.86, 17.860, 17.860, 17.860, 10.00, 10.23, 10.23, '20000', '20000', '20000', 'OK', 'OK', '#OK', '2020-04-19 15:04:55', '2020-04-19 15:37:53', '2020-04-19 17:13:06', 10.02, 10.36, 10.14, 'TC1002B', 1, 0, 1, 1, NULL, '2020-04-20 00:23:34', '2020-04-26 18:25:12', NULL);

INSERT INTO `analisa_mikro` (`id`, `cpp_head_id`, `tanggal_analisa`, `progress_status`, `analisa_mikro_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2020-05-05', 0, NULL, 1, NULL, NULL, '2020-05-05 04:56:00', '2020-05-05 04:56:00', NULL);

INSERT INTO `analisa_mikro_details` (`id`, `analisa_mikro_id`, `filling_machine_id`, `ppq_id`, `kode_sampel`, `jam_filling`, `suhu_preinkubasi`, `tpc`, `yeast`, `mold`, `ph`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, NULL, 'A1', '2020-04-19 15:04:51', '30', 0, NULL, NULL, NULL, '0', 1, 1, NULL, '2020-05-05 04:56:01', '2020-05-11 01:33:32', NULL),
(2, 1, 1, NULL, 'A2', '2020-04-19 15:04:51', '30', 0, NULL, NULL, NULL, '0', 1, 1, NULL, '2020-05-05 04:56:01', '2020-05-11 01:33:32', NULL),
(3, 1, 1, NULL, 'B(SP)3', '2020-04-19 15:09:06', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:01', '2020-05-05 04:56:01', NULL),
(4, 1, 1, NULL, 'B(SP)4', '2020-04-19 15:09:06', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:01', '2020-05-05 04:56:01', NULL),
(5, 1, 1, NULL, 'C(SP)5', '2020-04-19 15:09:14', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:02', '2020-05-05 04:56:02', NULL),
(6, 1, 1, NULL, 'C(SP)6', '2020-04-19 15:09:14', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:02', '2020-05-05 04:56:02', NULL),
(7, 1, 1, NULL, 'G7', '2020-04-19 15:12:23', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:02', '2020-05-05 04:56:02', NULL),
(8, 1, 1, NULL, 'G8', '2020-04-19 15:12:23', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:02', '2020-05-05 04:56:02', NULL),
(9, 1, 1, NULL, 'G9', '2020-04-19 15:23:06', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:02', '2020-05-05 04:56:02', NULL),
(10, 1, 1, NULL, 'G10', '2020-04-19 15:23:06', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:02', '2020-05-05 04:56:02', NULL),
(11, 1, 1, NULL, 'R1', '2020-04-19 15:30:37', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:02', '2020-05-05 04:56:02', NULL),
(12, 1, 1, NULL, 'R2', '2020-04-19 15:30:37', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:02', '2020-05-05 04:56:02', NULL),
(13, 1, 1, NULL, 'R3', '2020-04-19 16:00:12', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:02', '2020-05-05 04:56:02', NULL),
(14, 1, 1, NULL, 'R4', '2020-04-19 16:00:12', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:02', '2020-05-05 04:56:02', NULL),
(15, 1, 1, NULL, 'G11', '2020-04-19 16:11:50', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:02', '2020-05-05 04:56:02', NULL),
(16, 1, 1, NULL, 'G12', '2020-04-19 16:11:50', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:03', '2020-05-05 04:56:03', NULL),
(17, 1, 1, NULL, 'R5', '2020-04-19 16:30:00', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:03', '2020-05-05 04:56:03', NULL),
(18, 1, 1, NULL, 'R6', '2020-04-19 16:30:00', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:03', '2020-05-05 04:56:03', NULL),
(19, 1, 1, NULL, 'D13', '2020-04-19 16:37:53', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:03', '2020-05-05 04:56:03', NULL),
(20, 1, 1, NULL, 'D14', '2020-04-19 16:37:53', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:03', '2020-05-05 04:56:03', NULL),
(21, 1, 1, NULL, 'E15', '2020-04-19 16:37:59', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:03', '2020-05-05 04:56:03', NULL),
(22, 1, 1, NULL, 'E16', '2020-04-19 16:37:59', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:03', '2020-05-05 04:56:03', NULL),
(23, 1, 1, NULL, 'R7', '2020-04-19 17:00:00', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:03', '2020-05-05 04:56:03', NULL),
(24, 1, 1, NULL, 'R8', '2020-04-19 17:00:00', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:03', '2020-05-05 04:56:03', NULL),
(25, 1, 1, NULL, 'H17', '2020-04-19 17:13:21', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:04', '2020-05-05 04:56:04', NULL),
(26, 1, 1, NULL, 'H18', '2020-04-19 17:13:21', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:04', '2020-05-05 04:56:04', NULL),
(27, 1, 2, NULL, 'A1', '2020-04-19 14:59:35', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:04', '2020-05-05 04:56:04', NULL),
(28, 1, 2, NULL, 'A2', '2020-04-19 14:59:35', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:04', '2020-05-05 04:56:04', NULL),
(29, 1, 2, NULL, 'D3', '2020-04-19 15:28:45', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:04', '2020-05-05 04:56:04', NULL),
(30, 1, 2, NULL, 'D4', '2020-04-19 15:28:45', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:04', '2020-05-05 04:56:04', NULL),
(31, 1, 2, NULL, 'E5', '2020-04-19 15:28:50', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:04', '2020-05-05 04:56:04', NULL),
(32, 1, 2, NULL, 'E6', '2020-04-19 15:28:50', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:04', '2020-05-05 04:56:04', NULL),
(33, 1, 2, NULL, 'R1', '2020-04-19 15:30:00', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:05', '2020-05-05 04:56:05', NULL),
(34, 1, 2, NULL, 'R2', '2020-04-19 15:30:00', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:05', '2020-05-05 04:56:05', NULL),
(35, 1, 2, NULL, 'R3', '2020-04-19 16:00:00', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:05', '2020-05-05 04:56:05', NULL),
(36, 1, 2, NULL, 'R4', '2020-04-19 16:00:00', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:05', '2020-05-05 04:56:05', NULL),
(37, 1, 2, NULL, 'C7', '2020-04-19 16:16:59', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:05', '2020-05-05 04:56:05', NULL),
(38, 1, 2, NULL, 'C8', '2020-04-19 16:16:59', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:05', '2020-05-05 04:56:05', NULL),
(39, 1, 2, NULL, 'R5', '2020-04-19 16:30:01', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:05', '2020-05-05 04:56:05', NULL),
(40, 1, 2, NULL, 'R6', '2020-04-19 16:30:01', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:06', '2020-05-05 04:56:06', NULL),
(41, 1, 2, NULL, 'H9', '2020-04-19 16:57:49', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:06', '2020-05-05 04:56:06', NULL),
(42, 1, 2, NULL, 'H10', '2020-04-19 16:57:49', '30', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:06', '2020-05-05 04:56:06', NULL),
(43, 1, 1, NULL, 'S1', '2020-04-19 15:04:55', '55', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:06', '2020-05-05 04:56:06', NULL),
(44, 1, 1, NULL, 'S2', '2020-04-19 15:37:53', '55', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:06', '2020-05-05 04:56:06', NULL),
(45, 1, 1, NULL, 'S3', '2020-04-19 17:13:06', '55', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:07', '2020-05-05 04:56:07', NULL),
(46, 1, 2, NULL, 'S1', '2020-04-19 15:04:55', '55', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:07', '2020-05-05 04:56:07', NULL),
(47, 1, 2, NULL, 'S2', '2020-04-19 15:37:53', '55', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:07', '2020-05-05 04:56:07', NULL),
(48, 1, 2, NULL, 'S3', '2020-04-19 17:13:06', '55', NULL, NULL, NULL, NULL, '0', 1, NULL, NULL, '2020-05-05 04:56:07', '2020-05-05 04:56:07', NULL);


INSERT INTO `cpp_details` (`id`, `cpp_head_id`, `wo_number_id`, `filling_machine_id`, `lot_number`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 1, 'KC1904A', 1, NULL, NULL, '2020-02-12 09:30:25', '2020-02-12 09:30:25', NULL),
(2, 1, 2, 2, 'KB1904A', 1, NULL, NULL, '2020-02-12 10:04:35', '2020-02-12 10:04:35', NULL);


INSERT INTO `cpp_heads` (`id`, `product_id`, `analisa_kimia_id`, `analisa_mikro_id`, `packing_date`, `cpp_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 23, 1, 1, '2020-04-19', '1', 1, 1, NULL, NULL, '2020-05-05 04:56:00', NULL);



INSERT INTO `palets` (`id`, `cpp_detail_id`, `palet`, `start`, `end`, `jumlah_box`, `jumlah_pack`, `analisa_mikro_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'P01', '2020-04-19 15:04:55', '2020-04-19 15:30:52', 20, 480, NULL, 1, 1, NULL, '2020-02-22 20:11:41', '2020-02-22 20:12:28', NULL),
(2, 1, 'P02', '2020-04-19 15:30:52', '2020-04-19 16:03:51', 20, 480, NULL, 1, 1, NULL, '2020-02-22 20:11:42', '2020-02-22 20:13:41', NULL),
(3, 1, 'P03', '2020-04-19 16:03:51', '2020-04-19 16:30:26', 20, 480, NULL, 1, 1, NULL, '2020-02-22 20:11:43', '2020-02-22 20:13:48', NULL),
(4, 1, 'P04', '2020-04-19 16:30:26', '2020-04-19 16:53:08', 20, 480, NULL, 1, 1, NULL, '2020-02-22 20:11:45', '2020-02-22 20:14:07', NULL),
(5, 1, 'P05', '2020-04-19 16:53:08', '2020-04-19 17:13:06', 20, 480, NULL, 1, 1, NULL, '2020-02-22 20:11:46', '2020-02-22 20:14:26', NULL),
(6, 2, 'P01', '2020-04-19 14:59:36', '2020-04-19 15:18:46', 20, 480, NULL, 1, 1, NULL, '2020-02-22 20:14:37', '2020-02-22 20:15:48', NULL),
(7, 2, 'P02', '2020-04-19 15:18:46', '2020-04-19 15:37:46', 20, 480, NULL, 1, 1, NULL, '2020-02-22 20:14:39', '2020-02-22 20:15:53', NULL),
(8, 2, 'P03', '2020-04-19 15:37:46', '2020-04-19 15:57:00', 20, 480, NULL, 1, 1, NULL, '2020-02-22 20:14:40', '2020-02-22 20:15:58', NULL),
(9, 2, 'P04', '2020-04-19 15:57:00', '2020-04-19 16:16:20', 20, 480, NULL, 1, 1, NULL, '2020-02-22 20:14:42', '2020-02-22 20:16:04', NULL),
(10, 2, 'P05', '2020-04-19 16:16:20', '2020-04-19 16:35:40', 20, 480, NULL, 1, 1, NULL, '2020-02-22 20:14:46', '2020-02-22 20:16:09', NULL),
(11, 2, 'P06', '2020-04-19 16:35:40', '2020-04-19 16:54:45', 20, 480, NULL, 1, 1, NULL, '2020-02-22 20:14:47', '2020-02-22 20:16:14', NULL),
(12, 2, 'P07', '2020-04-19 16:54:45', '2020-04-19 16:57:49', 20, 480, NULL, 1, 1, NULL, '2020-02-22 20:14:51', '2020-02-22 20:16:26', NULL);

INSERT INTO `palet_ppqs` (`id`, `ppq_id`, `palet_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, NULL, NULL, '2020-04-19 06:45:36', '2020-04-19 06:45:36', NULL),
(11, 3, 2, 1, NULL, NULL, '2020-04-26 18:25:29', '2020-04-26 18:25:29', NULL),
(12, 3, 3, 1, NULL, NULL, '2020-04-26 18:25:29', '2020-04-26 18:25:29', NULL),
(13, 3, 4, 1, NULL, NULL, '2020-04-26 18:25:29', '2020-04-26 18:25:29', NULL),
(14, 3, 5, 1, NULL, NULL, '2020-04-26 18:25:29', '2020-04-26 18:25:29', NULL),
(15, 3, 8, 1, NULL, NULL, '2020-04-26 18:25:30', '2020-04-26 18:25:30', NULL),
(16, 3, 9, 1, NULL, NULL, '2020-04-26 18:25:30', '2020-04-26 18:25:30', NULL),
(17, 3, 10, 1, NULL, NULL, '2020-04-26 18:25:30', '2020-04-26 18:25:30', NULL),
(18, 3, 11, 1, NULL, NULL, '2020-04-26 18:25:30', '2020-04-26 18:25:30', NULL),
(19, 3, 12, 1, NULL, NULL, '2020-04-26 18:25:31', '2020-04-26 18:25:31', NULL);

INSERT INTO `ppqs` (`id`, `rpd_filling_detail_pi_id`, `cpp_head_id`, `kategori_ppq_id`, `nomor_ppq`, `ppq_date`, `jam_awal_ppq`, `jam_akhir_ppq`, `jumlah_pack`, `alasan`, `detail_titik_ppq`, `status_akhir`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, NULL, 2, '001/PPQ/IV/2020', '2020-04-19', '2020-04-19 15:04:51', '2020-02-24 15:09:14', 480, 'mesin filling nya mampet', 'di jam segitu aja', '0', 1, NULL, NULL, '2020-04-19 06:45:36', '2020-04-19 06:45:36', NULL),
(3, NULL, 1, 9, '002/PPQ/IV/2020', '2020-04-27', '2020-04-19 15:37:53', '2020-04-19 17:13:06', 4320, 'Palet Akhir :  Sensori Akhir #OK', 'Ada di jam jam kritis', '0', 1, NULL, NULL, '2020-04-26 18:25:28', '2020-04-26 18:25:28', NULL);


INSERT INTO `rpd_filling_detail_at_events` (`id`, `rpd_filling_head_id`, `wo_number_id`, `filling_machine_id`, `filling_sampel_code_id`, `verifier_id`, `palet_id`, `filling_date`, `filling_time`, `ls_sa_sealing_quality`, `ls_sa_proportion`, `sideway_sealing_alignment`, `overlap`, `package_length`, `paper_splice_sealing_quality`, `no_kk`, `no_md`, `ls_sa_sealing_quality_strip`, `ls_short_stop_quality`, `sa_short_stop_quality`, `keterangan`, `status_akhir`, `verifikasi`, `keterangan_verifikasi`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 2, 23, NULL, 10, '2020-04-19', '16:16:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2020-02-23 10:38:13', '2020-03-14 02:20:52', '2020-03-14 02:20:52');

INSERT INTO `rpd_filling_detail_pis` (`id`, `rpd_filling_head_id`, `wo_number_id`, `filling_machine_id`, `filling_sampel_code_id`, `filling_date`, `filling_time`, `berat_kanan`, `berat_kiri`, `overlap`, `ls_sa_proportion`, `volume_kanan`, `volume_kiri`, `airgap`, `ts_accurate_kanan`, `ts_accurate_kiri`, `ls_accurate`, `sa_accurate`, `surface_check`, `pinching`, `strip_folding`, `konduktivity_kanan`, `konduktivity_kiri`, `design_kanan`, `design_kiri`, `dye_test`, `residu_h2o2`, `prod_code_and_no_md`, `correction`, `dissolving_test`, `status_akhir`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 1, 1, '2020-04-19', '15:04:51', 224.30, 222.98, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:19:30', '2020-02-24 16:27:17', NULL),
(2, 1, 2, 1, 3, '2020-04-19', '15:09:06', 224.00, 225.47, 3.67, '40:60', 200, 200, 'OK', 'OK', 'OK', '#OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'block seal', NULL, '#OK', 1, 1, NULL, '2020-02-23 03:20:28', '2020-02-24 16:50:10', NULL),
(3, 1, 2, 1, 5, '2020-04-19', '15:09:14', 225.20, 224.04, 3.50, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'sudah diperbaiki dengan catatan pada form berbeda', NULL, 'OK', 1, 1, NULL, '2020-02-23 03:21:13', '2020-04-19 05:54:42', NULL),
(4, 1, 2, 1, 8, '2020-04-19', '15:10:58', 225.20, 224.04, 3.76, '40;60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:21:48', '2020-02-23 03:21:48', NULL),
(5, 1, 2, 1, 13, '2020-04-19', '15:12:23', 224.30, 223.47, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:22:10', '2020-02-23 03:22:10', NULL),
(6, 1, 2, 1, 8, '2020-04-19', '15:13:45', 224.30, 223.47, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:22:33', '2020-02-23 03:22:33', NULL),
(7, 1, 2, 1, 13, '2020-04-19', '15:23:06', 223.60, 224.23, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:23:18', '2020-02-23 03:23:18', NULL),
(8, 1, 2, 1, 19, '2020-04-19', '15:30:37', 224.00, 224.78, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:23:42', '2020-02-23 03:23:42', NULL),
(9, 1, 2, 1, 20, '2020-04-19', '15:45:00', 223.80, 224.77, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:24:18', '2020-02-23 03:24:18', NULL),
(10, 1, 2, 1, 19, '2020-04-19', '16:00:12', 223.00, 224.47, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:24:41', '2020-02-23 03:24:41', NULL),
(11, 1, 2, 1, 8, '2020-04-19', '16:05:33', 223.00, 224.47, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:25:03', '2020-02-23 03:25:03', NULL),
(12, 1, 2, 1, 13, '2020-04-19', '16:11:50', 224.50, 222.97, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:25:33', '2020-02-23 03:25:33', NULL),
(13, 1, 2, 1, 20, '2020-04-19', '16:15:26', 223.40, 224.63, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:26:06', '2020-02-23 03:26:06', NULL),
(14, 1, 2, 1, 19, '2020-04-19', '16:30:00', 223.20, 224.29, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:26:42', '2020-02-23 03:26:42', NULL),
(15, 1, 2, 1, 6, '2020-04-19', '16:37:53', 223.40, 224.34, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:27:11', '2020-02-23 03:27:11', NULL),
(16, 1, 2, 1, 7, '2020-04-19', '16:37:59', 224.60, 223.10, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:27:31', '2020-02-23 03:27:31', NULL),
(17, 1, 2, 1, 20, '2020-04-19', '16:45:00', 222.90, 224.57, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:27:51', '2020-02-23 03:27:51', NULL),
(18, 1, 2, 1, 19, '2020-04-19', '17:00:00', 223.80, 220.60, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:28:14', '2020-02-23 03:28:14', NULL),
(19, 1, 2, 1, 18, '2020-04-19', '17:13:21', 224.70, 224.20, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:28:31', '2020-02-23 03:28:31', NULL),
(20, 1, 2, 2, 22, '2020-04-19', '14:59:35', 224.80, 224.60, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:29:45', '2020-02-24 16:22:38', NULL),
(21, 1, 2, 2, 41, '2020-04-19', '15:15:00', 225.11, 225.48, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:30:17', '2020-02-23 03:30:17', NULL),
(22, 1, 2, 2, 27, '2020-04-19', '15:28:45', 225.15, 224.95, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:30:42', '2020-02-23 03:30:42', NULL),
(23, 1, 2, 2, 28, '2020-04-19', '15:28:50', 224.59, 225.51, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:31:03', '2020-02-23 03:31:03', NULL),
(24, 1, 2, 2, 40, '2020-04-19', '15:30:00', 225.09, 225.03, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:31:23', '2020-02-23 03:31:23', NULL),
(25, 1, 2, 2, 41, '2020-04-19', '15:45:00', 225.00, 225.61, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:31:53', '2020-02-23 03:31:53', NULL),
(26, 1, 2, 2, 40, '2020-04-19', '16:00:00', 224.02, 224.13, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:32:13', '2020-02-23 03:32:13', NULL),
(27, 1, 2, 2, 41, '2020-04-19', '16:15:38', 224.53, 224.70, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:32:36', '2020-02-23 03:32:36', NULL),
(28, 1, 2, 2, 23, '2020-04-19', '16:16:52', 223.87, 223.59, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, 1, '2020-02-23 03:38:13', '2020-03-14 02:20:53', '2020-03-14 02:20:53'),
(29, 1, 2, 2, 25, '2020-04-19', '16:16:59', 224.22, 224.10, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:38:35', '2020-02-23 03:38:35', NULL),
(30, 1, 2, 2, 40, '2020-04-19', '14:38:39', 224.73, 224.63, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, 1, '2020-02-23 03:38:54', '2020-02-24 16:21:18', '2020-02-24 16:21:18'),
(31, 1, 2, 2, 40, '2020-04-19', '16:30:01', 224.73, 224.63, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:39:49', '2020-02-23 03:39:49', NULL),
(32, 1, 2, 2, 41, '2020-04-19', '16:45:00', 224.68, 225.71, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:40:11', '2020-02-23 03:40:11', NULL),
(33, 1, 2, 2, 39, '2020-04-19', '16:57:49', 225.00, 224.79, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:40:35', '2020-02-23 03:40:35', NULL);


INSERT INTO `rpd_filling_heads` (`id`, `product_id`, `start_filling_date`, `rpd_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 23, '2020-04-19', '1', 1, 1, NULL, '2020-04-18 10:42:47', '2020-04-19 20:52:56', NULL);


INSERT INTO `wo_numbers` (`id`, `plan_id`, `product_id`, `rpd_filling_head_id`, `cpp_head_id`, `wo_number`, `production_plan_date`, `production_realisation_date`, `expired_date`, `fillpack_date`, `plan_batch_size`, `actual_batch_size`, `completion_date`, `explanation_1`, `explanation_2`, `explanation_3`, `formula_revision`, `wo_status`, `upload_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 24, NULL, NULL, 'G2004250003', '2020-04-06', NULL, NULL, NULL, '5014.28', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM WRP RTD COFFEE 200 ML ( AL/81.03)', '0', '1', 1, 1, NULL, NULL, '2020-04-18 10:37:02', NULL),
(2, 3, 23, 1, 1, 'G2004250001', '2020-04-06', '2020-04-19', '2021-04-19', '2020-04-19', '9333.334', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM WRP ON THE GO CHOCOLATE 200ML ( AK/81.01G)', '4', '1', 1, 1, NULL, NULL, '2020-04-20 00:03:41', NULL),
(3, 3, 23, 1, 1, 'G2004250002', '2020-04-06', '2020-04-19', '2021-04-19', '2020-04-19', '9333.334', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM WRP ON THE GO CHOCOLATE 200ML ( AK/81.01G)', '4', '1', 1, 1, NULL, NULL, '2020-04-20 00:03:41', NULL),
(4, 3, 25, NULL, NULL, 'G2004250004', '2020-04-07', '2020-04-19', NULL, NULL, '5014.29286', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM WRP RTD STRAWBERRY 200ML ( AL/81.04)', '2', '1', 1, 1, NULL, NULL, '2020-04-18 10:37:59', NULL),
(5, 3, 4, NULL, NULL, 'G2004708008', '2020-04-07', NULL, NULL, NULL, '5887.26', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HB GREEK CLASSIC 24X200ML (SENTUL) ( 0.4/FGHB09)', '0', '1', 1, 1, NULL, NULL, '2020-04-18 10:37:03', NULL),
(6, 3, 13, NULL, NULL, 'G2003214016', '2020-04-08', NULL, NULL, NULL, '9956.576', NULL, NULL, '-', '-', '-', 'FORMULA HILO RTD SCHOOL CHOCOLATE 200ML ( AO/34.44)', '0', '1', 1, 1, NULL, NULL, '2020-04-18 10:37:03', NULL),
(7, 3, 32, NULL, NULL, 'G2003700007', '2020-04-08', NULL, NULL, NULL, '2726.829', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE HB YO ( 1.7/WPHB01-1B)', '0', '1', 1, 1, NULL, NULL, '2020-04-18 10:37:03', NULL),
(8, 3, 8, NULL, NULL, 'G2003707001', '2020-04-08', NULL, NULL, NULL, '4951.47', NULL, NULL, '-', '-', '-', '-', '0', '1', 1, 1, NULL, NULL, '2020-04-18 10:37:03', NULL),
(9, 3, 34, NULL, NULL, 'G2003707001K', '2020-04-08', NULL, NULL, NULL, '4951.47', NULL, NULL, '-', '-', '-', '-', '0', '1', 1, 1, NULL, NULL, '2020-04-18 10:37:03', NULL),
(10, 3, 7, NULL, NULL, 'G2003707002', '2020-04-08', NULL, NULL, NULL, '5063.24', NULL, NULL, '-', '-', '-', '-', '0', '1', 1, 1, NULL, NULL, '2020-04-18 10:37:04', NULL),
(11, 3, 33, NULL, NULL, 'G2003707002K', '2020-04-08', NULL, NULL, NULL, '5063.24', NULL, NULL, '-', '-', '-', '-', '0', '1', 1, 1, NULL, NULL, '2020-04-18 10:37:04', NULL),
(12, 3, 19, NULL, NULL, 'G2004270001', '2020-04-12', NULL, NULL, NULL, '14001.995', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM LMEN HI PROTEIN RTD CHOCOLATE - SENTUL ( BH/46.01G)', '0', '1', 1, 1, NULL, NULL, '2020-04-18 10:37:04', NULL),
(13, 3, 19, NULL, NULL, 'G2004270002', '2020-04-12', NULL, NULL, NULL, '14001.995', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM LMEN HI PROTEIN RTD CHOCOLATE - SENTUL ( BH/46.01G)', '0', '1', 1, 1, NULL, NULL, '2020-04-18 10:37:04', NULL);
