INSERT INTO `analisa_kimias` (`id`, `cpp_head_id`, `ppq_id`, `ts_awal_1`, `ts_awal_2`, `ts_tengah_1`, `ts_tengah_2`, `ts_akhir_1`, `ts_akhir_2`, `ts_awal_avg`, `ts_tengah_avg`, `ts_akhir_avg`, `ph_awal`, `ph_tengah`, `ph_akhir`, `visko_awal`, `visko_tengah`, `visko_akhir`, `sensori_awal`, `sensori_tengah`, `sensori_akhir`, `jam_filling_awal`, `jam_filling_tengah`, `jam_filling_akhir`, `ts_oven_awal`, `ts_oven_tengah`, `ts_oven_akhir`, `kode_batch_standar`, `progress_status`, `analisa_kimia_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 14.68, 14.50, 14.63, 14.89, 14.55, 14.56, 14.590, 14.760, 14.550, 4.15, 4.15, 6.00, 'eeeee', 'eeeee', 'eeeee', 'OK', 'OK', 'OK', '2020-06-22 10:23:52', '2020-06-22 11:50:04', '2020-06-22 13:01:48', 14.50, 14.50, 14.50, 'TC0205C', 1, 0, 1, 1, NULL, '2020-06-23 03:53:42', '2020-06-23 04:25:14', NULL);


INSERT INTO `corrective_actions` (`id`, `follow_up_ppq_id`, `follow_up_rkj_id`, `corrective_action`, `due_date_corrective_action`, `pic_corrective_action`, `status_corrective_action`, `verifikasi_corrective_action`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 'Perbaikan ini itu', '2020-06-23', 'Nesta Maulana', '1', NULL, 1, NULL, NULL, '2020-06-23 07:40:03', '2020-06-23 07:40:03', NULL),
(2, 2, NULL, 'Penambahan air 3000l', '2020-06-23', 'Logis', '1', NULL, 1, NULL, NULL, '2020-06-23 08:00:59', '2020-06-23 08:00:59', NULL);


INSERT INTO `cpp_details` (`id`, `cpp_head_id`, `wo_number_id`, `filling_machine_id`, `lot_number`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 7, 3, 'KA2212A', 1, NULL, NULL, '2020-06-22 00:37:53', '2020-06-22 00:37:53', NULL);

INSERT INTO `cpp_heads` (`id`, `product_id`, `analisa_kimia_id`, `analisa_mikro_id`, `packing_date`, `cpp_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 1, NULL, '2020-06-22', '1', 1, 1, NULL, '2020-06-22 00:37:34', '2020-06-23 05:28:01', NULL);

INSERT INTO `follow_up_ppqs` (`id`, `ppq_id`, `jumlah_metode_sampling`, `hasil_analisa`, `status_produk`, `tanggal_status_ppq`, `nomor_lbd`, `root_cause`, `kategori_case`, `status_case`, `status_follow_up_ppq`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '5 Pack dan Melihat Langsung Digudang', 'hasil analisa nya masih OK', '1', '2020-06-23', '-', 'Mesin terjadi crash sehingga menyebabkan banyak hal diluar dugaan', '0', '1', '1', 1, 1, NULL, '2020-06-23 07:36:01', '2020-06-23 07:40:02', NULL),
(2, 2, NULL, 'Hasil nya masih OK sensori pun masih OK jadi tidak perlu RKJ', '1', '2020-06-23', '-', NULL, NULL, NULL, '1', 1, 1, NULL, '2020-06-23 07:56:53', '2020-06-23 08:00:59', NULL);

INSERT INTO `palets` (`id`, `cpp_detail_id`, `palet`, `start`, `end`, `jumlah_box`, `jumlah_pack`, `analisa_mikro_30_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 1, 'P01', '2020-06-22 10:06:21', '2020-06-22 10:43:47', 119, 2856, NULL, 1, 1, NULL, '2020-06-22 18:41:07', '2020-06-23 06:42:16', NULL),
(5, 1, 'P02', '2020-06-22 10:43:48', '2020-06-22 11:35:18', 119, 2856, NULL, 1, 1, NULL, '2020-06-22 20:32:41', '2020-06-23 06:42:16', NULL),
(6, 1, 'P03', '2020-06-22 11:35:18', '2020-06-22 12:13:31', 119, 2856, NULL, 1, 1, NULL, '2020-06-23 03:34:17', '2020-06-23 06:42:16', NULL),
(7, 1, 'P04', '2020-06-22 12:13:31', '2020-06-22 12:38:30', 119, 2856, NULL, 1, 1, NULL, '2020-06-23 03:35:00', '2020-06-23 06:42:16', NULL),
(8, 1, 'P05', '2020-06-22 12:38:30', '2020-06-22 13:01:47', 64, 1536, NULL, 1, 1, NULL, '2020-06-23 03:35:30', '2020-06-23 06:42:59', NULL);

INSERT INTO `palet_ppqs` (`id`, `ppq_id`, `palet_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 7, 1, NULL, NULL, '2020-06-23 03:48:12', '2020-06-23 03:48:12', NULL),
(2, 1, 8, 1, NULL, NULL, '2020-06-23 03:48:12', '2020-06-23 03:48:12', NULL),
(3, 2, 6, 1, NULL, NULL, '2020-06-23 04:22:05', '2020-06-23 04:22:05', NULL),
(4, 2, 7, 1, NULL, NULL, '2020-06-23 04:22:05', '2020-06-23 04:22:05', NULL),
(5, 2, 8, 1, NULL, NULL, '2020-06-23 04:22:06', '2020-06-23 04:22:06', NULL),
(6, 3, 7, 1, NULL, NULL, '2020-06-23 06:42:59', '2020-06-23 06:42:59', NULL);

INSERT INTO `ppqs` (`id`, `rpd_filling_detail_pi_id`, `cpp_head_id`, `kategori_ppq_id`, `nomor_ppq`, `ppq_date`, `jam_awal_ppq`, `jam_akhir_ppq`, `jumlah_pack`, `alasan`, `detail_titik_ppq`, `status_akhir`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 13, NULL, 2, '001/PPQ/VI/2020', '2020-06-23', '2020-06-22 12:18:06', '2020-06-22 12:44:42', 4392, 'Overlap tidak sesuai spek', 'pada jam jam yang terlampir aja bro', '2', 1, 1, NULL, '2020-06-23 03:48:12', '2020-06-23 07:37:59', NULL),
(2, NULL, 1, 12, '002/PPQ/VI/2020', '2020-06-23', '2020-06-22 11:50:04', '2020-06-22 13:01:48', 7248, 'Palet Akhir :  pH Over 6.00', 'Ada dipertengahan palet tengah dan akhir', '2', 1, 1, NULL, '2020-06-23 04:22:05', '2020-06-23 08:00:59', NULL),
(3, NULL, 1, 24, '003/PPQ/VI/2020', '2020-06-23', '2020-06-22 12:18:06', '2020-06-22 12:18:06', 2856, 'Analisa Mikro 30 - pH #OK', 'pH pada pukul 2020-06-22 12:18:06 bernilai 4.30 berada diluar spek. Spek minimal : 4.15 spek max : 4.2514&#13;&#10;', '1', 1, 1, NULL, '2020-06-23 06:42:59', '2020-06-23 06:49:30', NULL);

INSERT INTO `preventive_actions` (`id`, `follow_up_ppq_id`, `follow_up_rkj_id`, `preventive_action`, `due_date_preventive_action`, `pic_preventive_action`, `status_preventive_action`, `verifikasi_preventive_action`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 'Ditambahkan mesin baru', '2020-06-27', 'Acu', '1', NULL, 1, NULL, NULL, '2020-06-23 07:40:03', '2020-06-23 07:40:03', NULL);


INSERT INTO `rpd_filling_detail_pis` (`id`, `rpd_filling_head_id`, `wo_number_id`, `filling_machine_id`, `filling_sampel_code_id`, `filling_date`, `filling_time`, `berat_kanan`, `berat_kiri`, `overlap`, `ls_sa_proportion`, `volume_kanan`, `volume_kiri`, `airgap`, `ts_accurate_kanan`, `ts_accurate_kiri`, `ls_accurate`, `sa_accurate`, `surface_check`, `pinching`, `strip_folding`, `konduktivity_kanan`, `konduktivity_kiri`, `design_kanan`, `design_kiri`, `dye_test`, `residu_h2o2`, `prod_code_and_no_md`, `correction`, `dissolving_test`, `status_akhir`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 7, 3, 43, '2020-06-22', '10:23:51', 221.88, 221.28, 4.50, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-22 00:07:37', '2020-06-22 00:37:11', NULL),
(2, 1, 7, 3, 62, '2020-06-22', '10:35:00', 220.20, 222.58, 4.56, '40:60', 198, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-22 00:08:18', '2020-06-22 20:27:58', NULL),
(3, 1, 7, 3, 50, '2020-06-22', '10:48:21', 220.20, 222.58, 4.56, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-22 00:09:38', '2020-06-22 20:28:08', NULL),
(4, 1, 7, 3, 55, '2020-06-22', '10:55:20', 222.37, 219.94, 5.02, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-22 00:10:18', '2020-06-23 03:37:02', NULL),
(5, 1, 7, 3, 62, '2020-06-22', '11:05:00', 222.38, 222.38, 5.02, '40:60', 200, 198, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-22 00:10:50', '2020-06-23 03:37:15', NULL),
(6, 1, 7, 3, 50, '2020-06-22', '11:09:03', 222.38, 219.66, 5.02, '40:60', 200, 198, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-22 00:11:55', '2020-06-23 03:37:57', NULL),
(7, 1, 7, 3, 59, '2020-06-22', '11:33:52', 223.03, 220.01, 5.02, '40:60', 200, 198, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-22 00:12:16', '2020-06-23 03:38:08', NULL),
(8, 1, 7, 3, 62, '2020-06-22', '11:35:00', 219.84, 222.49, 4.65, '40:60', 200, 198, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-22 00:12:37', '2020-06-23 03:38:18', NULL),
(9, 1, 7, 3, 55, '2020-06-22', '12:06:28', 220.00, 222.23, 4.89, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-22 00:13:06', '2020-06-23 03:38:31', NULL),
(10, 1, 7, 3, 50, '2020-06-22', '12:18:06', 220.00, 222.23, 4.56, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-22 00:13:29', '2020-06-23 03:38:47', NULL),
(11, 1, 7, 3, 59, '2020-06-22', '12:25:27', 221.99, 219.33, 4.23, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'overlap under spek', NULL, '#OK', 1, 1, NULL, '2020-06-22 00:13:55', '2020-06-23 03:39:20', NULL),
(12, 1, 7, 3, 62, '2020-06-22', '12:35:00', 220.37, 222.55, 4.03, '40:60', 200, 198, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'overlapnya masih #ok', NULL, '#OK', 1, 1, NULL, '2020-06-22 00:14:20', '2020-06-23 03:42:15', NULL),
(13, 1, 7, 3, 51, '2020-06-22', '12:44:42', 220.37, 222.55, 4.69, '40:60', 200, 198, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-22 00:14:51', '2020-06-23 03:42:34', NULL),
(14, 1, 7, 3, 57, '2020-06-22', '12:57:26', 219.72, 222.90, 4.65, '40:60', 200, 198, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-22 00:16:32', '2020-06-23 03:49:04', NULL),
(15, 1, 7, 3, 60, '2020-06-22', '13:01:47', 222.50, 219.98, 4.65, '40:60', 200, 198, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', '-', NULL, 'OK', 1, 1, NULL, '2020-06-22 00:17:19', '2020-06-23 03:50:05', NULL),
(16, 1, 7, 3, 44, '2020-06-22', '14:18:39', 220.36, 220.36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2020-06-22 00:18:51', '2020-06-22 00:24:59', '2020-06-22 00:24:59');

INSERT INTO `rpd_filling_heads` (`id`, `product_id`, `start_filling_date`, `rpd_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, '2020-06-22', '1', 1, 1, NULL, '2020-06-21 22:24:55', '2020-06-23 03:50:39', NULL);


INSERT INTO `wo_numbers` (`id`, `plan_id`, `product_id`, `rpd_filling_head_id`, `cpp_head_id`, `wo_number`, `production_plan_date`, `production_realisation_date`, `expired_date`, `fillpack_date`, `plan_batch_size`, `actual_batch_size`, `completion_date`, `explanation_1`, `explanation_2`, `explanation_3`, `formula_revision`, `wo_status`, `upload_status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 20, NULL, NULL, 'G2006214008', '2020-06-22', NULL, NULL, NULL, '9969.25', NULL, NULL, '-', '-', '-', '-', '0', '1', 1, 1, NULL, NULL, '2020-06-21 22:18:33', NULL),
(2, 3, 13, NULL, NULL, 'G2006214004', '2020-06-22', NULL, NULL, NULL, '9956.565', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AR/34.44)', '0', '1', 1, 1, NULL, NULL, '2020-06-21 22:18:33', NULL),
(3, 3, 13, NULL, NULL, 'G2006214010', '2020-06-22', NULL, NULL, NULL, '9956.565', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HILO RTD SCHOOL CHOCOLATE 200ML ( AR/34.44)', '0', '1', 1, 1, NULL, NULL, '2020-06-21 22:18:33', NULL),
(4, 3, 31, NULL, NULL, 'G2006700011', '2020-06-23', NULL, NULL, NULL, '2196.15', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE LOW FAT HB YOGURT ( 3.7/WPHB03)', '0', '1', 1, 1, NULL, NULL, '2020-06-21 22:18:33', NULL),
(5, 3, 30, NULL, NULL, 'G2006700010', '2020-06-23', NULL, NULL, NULL, '6625.45', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM YOBASE LOW FAT HB YOGURT ORIGINAL 01-00 ( 1.2/WPHB02)', '0', '1', 1, 1, NULL, NULL, '2020-06-21 22:18:33', NULL),
(6, 3, 9, NULL, NULL, 'G2006708009', '2020-06-23', NULL, NULL, NULL, '6660', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT WHOLESOME ORIGINAL ( 2/FGHB02)', '0', '1', 1, 1, NULL, NULL, '2020-06-21 22:18:33', NULL),
(7, 3, 4, 1, 1, 'G2006708007', '2020-06-23', '2020-06-22', '2020-12-22', '2020-06-22', '5887.26', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HB GREEK CLASSIC 24X200ML (SENTUL) ( 0.5/FGHB09)', '4', '1', 1, 1, NULL, NULL, '2020-06-23 03:50:52', NULL),
(8, 3, 1, NULL, NULL, 'G2006706002', '2020-06-24', NULL, NULL, NULL, '10048.24', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM HB YOGURT BLACKCURRANT ( 3.3/FGHB03)', '0', '1', 1, 1, NULL, NULL, '2020-06-21 22:18:33', NULL),
(9, 3, 23, NULL, NULL, 'G2006250003', '2020-06-24', NULL, NULL, NULL, '9333.334', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM WRP ON THE GO CHOCOLATE 200ML ( AL/81.01G)', '6', '0', 1, NULL, NULL, NULL, NULL, NULL),
(10, 3, 23, NULL, NULL, 'G2006250004', '2020-06-24', NULL, NULL, NULL, '9333.334', NULL, NULL, '-', '-', '-', 'FORMULA PHANTOM WRP ON THE GO CHOCOLATE 200ML ( AL/81.01G)', '6', '0', 1, NULL, NULL, NULL, NULL, NULL);
