INSERT INTO `rpd_filling_detail_pis` (`id`, `rpd_filling_head_id`, `wo_number_id`, `filling_machine_id`, `filling_sampel_code_id`, 
	`filling_date`, `filling_time`, `berat_kanan`, `berat_kiri`, 
	`overlap`, `ls_sa_proportion`, `volume_kanan`, `volume_kiri`, `airgap`, `ts_accurate_kanan`, 
	`ts_accurate_kiri`, `ls_accurate`, `sa_accurate`, `surface_check`, `pinching`, `strip_folding`, `konduktivity_kanan`, 
	`konduktivity_kiri`, `design_kanan`, `design_kiri`, `dye_test`, `residu_h2o2`, `prod_code_and_no_md`, `correction`, 
	`dissolving_test`, `status_akhir`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 1, 1, '2020-04-19', '15:04:51', 224.30, 222.98, 3.77, '40:60', 200, 200, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 
	'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 1, 1, NULL, '2020-02-23 03:19:30', '2020-02-24 16:27:17', NULL),

UPDATE `rpd_filling_detail_pis` SET`overlap`='3.80',`ls_sa_proportion`='40:60',`volume_kanan`='220',
`volume_kiri`='220',`airgap`='OK',`ts_accurate_kanan`='OK',`ts_accurate_kiri`='OK',
`ls_accurate`='OK',`sa_accurate`='OK',`surface_check`='OK',`pinching`='OK',`strip_folding`='OK',
`konduktivity_kanan`='OK',`konduktivity_kiri`='OK',`design_kanan`='OK',`design_kiri`='OK',`dye_test`='OK',
`residu_h2o2`='OK',`prod_code_and_no_md`='OK',`correction`='OK',`dissolving_test`='OK',`status_akhir`='1'


UPDATE `rpd_filling_detail_pis` SET `overlap`=NULL,`ls_sa_proportion`=NULL,`volume_kanan`=NULL,
`volume_kiri`=NULL,`airgap`=NULL,`ts_accurate_kanan`=NULL,`ts_accurate_kiri`=NULL,
`ls_accurate`=NULL,`sa_accurate`=NULL,`surface_check`=NULL,`pinching`=NULL,`strip_folding`=NULL,
`konduktivity_kanan`=NULL,`konduktivity_kiri`=NULL,`design_kanan`=NULL,`design_kiri`=NULL,`dye_test`=NULL,
`residu_h2o2`=NULL,`prod_code_and_no_md`=NULL,`correction`=NULL,`dissolving_test`=NULL,`status_akhir`=NULL
