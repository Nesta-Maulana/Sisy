<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'Auth\LoginController@ShowLoginForm')->name('face.page');

Route::post('/forgot-password', 'Master\MasterApp\UserController@customChangePassword')->name('forgot.password');
Auth::routes();
Route::get('/verify-account/{user_id}', 'Master\MasterApp\UserController@verifyAccount')->name('verify.account');

Route::middleware('auth')->group(function ()
{ 
	Route::get('/ganti-password/{user_id}', 'Master\MasterApp\UserController@showChangePasswordForm')->name('users.change-password');
	Route::post('/proses-ganti-password', 'Master\MasterApp\UserController@processChangePassword')->name('users.process-change-password');
	Route::get('/home', 'Auth\UserCredentialController@index')->name('credential_access.home-page');
	Route::get('/user-guide', 'Auth\UserCredentialController@userGuide')->name('credential_access.user-guide');
	Route::get('/halaman-help', 'Auth\UserCredentialController@halamanHelp')->name('credential_access.help-page');
}
);	


Route::group(['prefix' => 'master-apps','middleware'=>['auth','credential.check']], function() 
{
	Route::get('/', 'MasterAppController@index')->name('master_app.show_home');
	Route::get('home', 'MasterAppController@index')->name('master_app.show_home');
	Route::get('perhitungan-penggunaan', 'MasterAppController@perhitunganPernggunaan')->name('master_app.manage_meteran');

	Route::group(['prefix' => 'kelola-menu'], function () 
	{
		Route::get('', 'MasterAppController@manageMenu')->name('master_app.manage_menu');
		Route::post('', 'Master\MasterApp\MenuController@manageMenu');
		Route::get('/change-application/{application_id}', 'Master\MasterApp\MenuController@changeApplication');
		Route::get('/edit-menu/{menu_id}', 'Master\MasterApp\MenuController@editMenu');
		Route::get('/change-parent/{parent_menu_id}/{application_id}', 'Master\MasterApp\MenuController@changeParent');	
	});

	Route::group(['prefix' => 'kelola-hak-akses-menu'], function () 
	{
		Route::get('', 'MasterAppController@manageMenuPermission')->name('master_app.menu_permissions');
		
		Route::group(['prefix' => 'tambah-akses'], function () {
			Route::get('', 'MasterAppController@addMenuPermissionForm');
			Route::post('', 'Master\MasterApp\MenuPermissionController@manageMenuPermissionForm');
			Route::get('/ambil-menu/{application_id}/{user_id}', 'Master\MasterApp\MenuPermissionController@getMenuPermission');	
		});

		Route::post('/ubah-akses', 'Master\MasterApp\MenuPermissionController@changePermission');
	});

	Route::group(['prefix' => 'kelola-aplikasi'], function () {
		Route::get('', 'MasterAppController@manageApplication')->name('master_app.manage_applications');
		Route::post('', 'Master\MasterApp\ApplicationController@manageApplication');
		Route::get('/edit-application/{application_id}', 'Master\MasterApp\ApplicationController@editApplication');
	});

	Route::group(['prefix' => 'kelola-hak-akses-aplikasi'], function () {
		Route::get('', 'MasterAppController@manageApplicationPermission')->name('master_app.application_permissions');
		Route::group(['prefix' => 'tambah-akses'], function () {
			Route::get('', 'MasterAppController@manageApplicationPermissionForm');
			Route::post('', 'Master\MasterApp\ApplicationPermissionController@manageApplicationPermission');
			Route::get('/ambil-aplikasi/{application_id}', 'Master\MasterApp\ApplicationPermissionController@getApplicationPermission');
		});
		Route::post('/ubah-akses', 'Master\MasterApp\ApplicationPermissionController@changeApplicationPermission');
	});
	
	Route::group(['prefix' => 'kelola-produk'], function () {
		Route::get('', 'MasterAppController@manageProduct')->name('master_app.master_data.manage_products');
		Route::post('', 'Master\Rollie\ProductController@manageProduct');
		Route::get('/edit-produk/{product_id}', 'Master\Rollie\ProductController@editProduct');
	});
	
	Route::group(['prefix' => 'kelola-mesin-filling'], function () {
		Route::get('', 'MasterAppController@manageFillingMachine')->name('master_app.master_data.manage_filling_machines');
		Route::post('', 'Master\Rollie\FillingMachineController@manageFillingMachine');
		Route::get('/edit-mesin-filling/{filling_machine_id}', 'Master\Rollie\FillingMachineController@editFillingMachine');
	});

	Route::group(['prefix' => 'kelola-kategori-flowmeter'], function () {
		Route::get('', 'MasterAppController@manageFlowmeterCategory')->name('master_app.master_data.manage_flowmeter_categories');
		Route::post('', 'Master\Emon\FlowmeterCategoryController@manageFlowmeterCategory');
		Route::get('edit-flowmeter-category/{flowmeter_category_id}', 'Master\Emon\FlowmeterCategoryController@editFlowmeterCategory');
	});
	
	Route::group(['prefix' => 'kelola-flowmeter-workcenter'], function () {
		Route::get('', 'MasterAppController@manageFlowmeterWorkcenter')->name('master_app.master_data.manage_flowmeter_workcenters');
		Route::post('', 'Master\Emon\FlowmeterWorkcenterController@manageFlowmeterWorkcenter');
		Route::get('edit-flowmeter-workcenter/{flowmeter_workcenter_id}', 'Master\Emon\FlowmeterWorkcenterController@editFlowmeterWorkcenter');
	});

	Route::group(['prefix' => 'kelola-flowmeter-unit'], function () {
		Route::get('', 'MasterAppController@manageFlowmeterUnit')->name('master_app.master_data.manage_flowmeter_units');
		Route::post('', 'Master\Emon\FlowmeterUnitController@manageFlowmeterUnit');
		Route::get('edit-flowmeter-unit/{flowmeter_unit_id}', 'Master\Emon\FlowmeterUnitController@editFlowmeterUnit');
	});

	Route::group(['prefix' => 'kelola-flowmeter-location'], function () {
		Route::get('', 'MasterAppController@manageFlowmeterLocation')->name('master_app.master_data.manage_flowmeter_locations');
		Route::post('', 'Master\Emon\FlowmeterLocationController@manageFlowmeterLocation');
		Route::get('edit-flowmeter-location/{flowmeter_unit_id}', 'Master\Emon\FlowmeterLocationController@editFlowmeterLocation');
	});


	Route::group(['prefix' => 'kelola-flowmeter'], function () {
		Route::get('', 'MasterAppController@manageFlowmeter')->name('master_app.master_data.manage_flowmeters');
		Route::post('', 'Master\Emon\FlowmeterController@manageFlowmeter');
		Route::get('edit-flowmeter/{flowmeter_id}', 'Master\Emon\FlowmeterController@editFlowmeter');
	});

	Route::group(['prefix' => 'kelola-flowmeter-usage'], function () 
	{
		Route::get('', 'MasterAppController@manageFlowmeterUsage')->name('master_app.master_data.manage_flowmeter_usages');
		Route::post('', 'Master\Emon\FlowmeterUsageController@manageFlowmeter');
		Route::get('edit-flowmeter-usage/{flowmeter_id}', 'Master\Emon\FlowmeterUsageController@editFlowmeter');
	});

	Route::group(['prefix' => 'kelola-flowmeter-formula'], function () 
	{
		Route::get('', 'MasterAppController@manageFlowmeterFormula')->name('master_app.master_data.manage_flowmeter_formulas');
		Route::post('', 'Master\Emon\FlowmeterFormulaController@manageFormula');
		Route::get('edit-flowmeter-formula/{flowmeter_id}', 'Master\Emon\FlowmeterUsageController@editFlowmeter');
	});
	
	Route::group(['prefix' => 'kelola-flowmeter-location-permission'], function () 
	{
		Route::get('', 'MasterAppController@manageLocationPermission')->name('master_app.master_data.manage_flowmeter_location_permissions');
		Route::get('tambah-akses', 'MasterAppController@showFormManageLocationPermission');
		Route::get('get-location/{category_id}/{user_id}', 'Master\Emon\FlowmeterLocationPermissionsController@getFlowmeter');
	});
	
});

Route::group(['prefix' => 'rollie','middleware'=>['auth','credential.check']], function() 
{
	Route::get('/', 'RollieController@index')->name('rollie.show_home');

	Route::group(['prefix' => 'jadwal-produksi'], function () {
		Route::get('', 'RollieController@showProductionScheduleDashboard')->name('rollie.production_schedules');
		Route::get('/tambah-jadwal', 'RollieController@showProductionScheduleForm');
		Route::get('/ambil-detail-wo/{wo_id}', 'Transaction\Rollie\WoNumberController@getDetailWo');
		Route::post('/tambah-jadwal', 'Transaction\Rollie\WoNumberController@addProductionSchedule');
		Route::post('/update-data-wo', 'Transaction\Rollie\WoNumberController@updateDataWo');
		Route::post('/hapus-data-wo', 'Transaction\Rollie\WoNumberController@hapusWo');
		Route::post('/approve-jadwal', 'Transaction\Rollie\WoNumberController@finalizeWo');
		
	});
	Route::group(['prefix' => 'rpd-filling'], function () {
		Route::get('','RollieController@showRpdFillingDashboard')->name('rollie.process_data.rpds');
		Route::post('/proses-rpd-filling','Transaction\Rollie\RPDFillingController@prosesRpdFilling');
		/* ini untuk seluruh route Form Rpd Filling */
		Route::group(['prefix' => 'form'], function () 
		{
			Route::get('/{rpd_filling_head_id}','RollieController@showRpdFillingForm');
			Route::get('/get-wo-filling/{jenis_tambah}/{rpd_filling_head_id}','Transaction\Rollie\RPDFillingController@getWoFilling');
			Route::get('/get-filling-sampel/{filling_machine_id}/{rpd_filling_head_id}','Transaction\Rollie\RPDFillingController@getFillingSampel');
			Route::get('/check-filling-sampel/{filling_sampel_id}','Transaction\Rollie\RPDFillingController@checkFillingSampel');
			Route::post('/tambah-batch-proses','Transaction\Rollie\RPDFillingController@addBatchProses');
		
			Route::post('/tambah-sampel-filling','Transaction\Rollie\RPDFillingController@addFillingSampel');
			Route::get('/refresh-tabel-pi/{rpd_filling_head_id}','Transaction\Rollie\RPDFillingController@refreshTableSampel');
		
			Route::post('/submit-analisa-sampel-pi','Transaction\Rollie\RPDFillingController@submitAnalisaSampelPi');
			Route::post('/submit-analisa-sampel-event','Transaction\Rollie\RPDFillingController@submitAnalisaSampelPiAtEvent');
			Route::post('/hapus-sampel-analisa','Transaction\Rollie\RPDFillingController@hapusSampelAnalisa');
			Route::get('/form-ppq-filling/{rpd_filling_head_id}/{rpd_filling_detail_id}/{filling_machine_id}/{wo_number_id}','RollieController@showPpqFillingForm');
			Route::post('/input-ppq','Transaction\Rollie\PpqController@createPpq');
			Route::get('/draft-ppq-filling/{rpd_filling_head_id}','RollieController@showDraftPpq');
			Route::post('/draft-ppq-filling/proses-draft-ppq','Transaction\Rollie\PpqController@prosesPPQ');
			Route::get('/list-ppq-pi/{rpd_filling_head_id}','RollieController@showPpqPi');
			Route::post('/close-rpd-filling','Transaction\Rollie\RPDFillingController@closeRpdFilling');
		});
	});	
	Route::group(['prefix' => 'cpp-produk'], function () {
		
		Route::get('','RollieController@showCppProductDashboard')->name('rollie.process_data.cpps');
		Route::post('/proses-cpp-produk','Transaction\Rollie\CppProductController@prosesCppProduk');
		Route::group(['prefix' => 'form'], function () {
			Route::get('/{cpp_head_id}','RollieController@showCppProductForm');
			
			Route::post('/tambah-palet','Transaction\Rollie\CppProductController@addPalet');
			Route::get('/refresh-table-cpp/{cpp_head_id}/{wo_number_id}','Transaction\Rollie\CppProductController@refreshCppTable');
			
			Route::post('/ubah-nomor-palet','Transaction\Rollie\CppProductController@changePalet');
			Route::post('/ubah-jam-start','Transaction\Rollie\CppProductController@changeStart');
			Route::post('/ubah-jam-end','Transaction\Rollie\CppProductController@changeEnd');
			Route::post('/ubah-jumlah-box','Transaction\Rollie\CppProductController@changeBox');
			
			Route::get('/get-wo-packing/{jenis_tambah}/{rpd_filling_head_id}','Transaction\Rollie\CppProductController@getWoPacking');
			Route::post('/tambah-batch-proses','Transaction\Rollie\CppProductController@addBatchProses');
			Route::post('/hapus-palet','Transaction\Rollie\CppProductController@hapusPalet');
			Route::post('/close-cpp-produk','Transaction\Rollie\CppProductController@closeCppProduct');
		});
	});
	
	Route::group(['prefix' => 'permintaan-sampel'], function () 
	{
		Route::get('/','RollieController@showPsrDashboard')->name('rollie.process_data.psr');
		Route::post('/get-psr-detail','Transaction\Rollie\PsrController@getPsrDetail');
		Route::post('/ubah-psr','Transaction\Rollie\PsrController@ubahPsr');
		Route::post('/send-notifikasi-psr','Transaction\Rollie\PsrController@sendPsrToPenyelia');
		Route::post('/print-psr','Transaction\Rollie\PsrController@printPsr');

	});

	Route::group(['prefix' => 'fisikokimia'], function () 
	{
		Route::get('','RollieController@showFiskokimiaDashboard')->name('rollie.analysis_data.fiskokimias_qc_penyelia'); /* ini input analisa kimia berikut dengan analisa ts oven dan sejenisnya */
		Route::get('form/{analisa_kimia_id}','RollieController@showFormPpqFisikokimia');
		Route::post('form/input-ppq','Transaction\Rollie\PpqController@createPpq');
	});
	
	Route::post('/analisa-fisiko-kimia','Transaction\Rollie\AnalisaKimiaController@analisaFisikokimia'); /*  untuk qc rtd dan lainnya yang input analisa kimia */
	Route::post('/input-analisa-fisikokimia','Transaction\Rollie\AnalisaKimiaController@inputAnalisaKimia'); 
	
	Route::group(['prefix' => 'fisiko-kimia'], function () {
		Route::get('','RollieController@showFiskokimiaDashboard')->name('rollie.analysis_data.fiskokimias'); /*  untuk qc rtd dan lainnya yang input analisa kimia */
		Route::get('/form/{analisa_kimia_id}','RollieController@showFormPpqFisikokimia');
		Route::post('/form/input-ppq','Transaction\Rollie\PpqController@createPpq');
		Route::post('/update-ts-oven','Transaction\Rollie\AnalisaKimiaController@updateTsOven');
	});
	
	Route::group(['prefix' => 'fisiko-kimia-form'], function () {
		Route::get('/{analisa_kimia_form}/{params}','RollieController@showFiskokimiaForm'); 
		Route::post('/input-analisa-fisikokimia','Transaction\Rollie\AnalisaKimiaController@inputAnalisaKimia'); 
		Route::post('/edit-analisa-fisikokimia','Transaction\Rollie\AnalisaKimiaController@editAnalisaKimia'); 
	});
	
	Route::group(['prefix' => 'analisa-mikro-produk'], function () 
	{
		Route::get('','RollieController@showAnalisaMikroProductDashboard')->name('rollie.analysis_data.analisa_mikro_produk');	
		Route::post('/proses-analisa-mikro','Transaction\Rollie\AnalisaMikroController@inputAnalisaMikro'); 
		Route::get('/form/{analisa_mikro_id}', 'RollieController@showAnalisaMikroProductForm');
		Route::post('/form/submit-hasil-analisa', 'Transaction\Rollie\AnalisaMikroController@submitHasilAnalisa');
		
	});
	
	Route::group(['prefix' => 'analisa-ph-produk'], function () 
	{
		Route::get('','RollieController@showAnalisaMikroProductDashboard')->name('rollie.analysis_data.analisa_ph_produk');
		Route::post('/proses-analisa-mikro','Transaction\Rollie\AnalisaMikroController@inputAnalisaMikro'); 
		Route::get('/form/{analisa_mikro_id}', 'RollieController@showAnalisaMikroProductForm');
		Route::post('/form/submit-hasil-analisa', 'Transaction\Rollie\AnalisaMikroController@submitHasilAnalisa');	
		Route::post('/form/ubah-jam-filling', 'Transaction\Rollie\AnalisaMikroController@ubahJamFillingSampel');
		Route::get('/form/ambil-kode-sampel/{filling_machine_id}/{product_type_id}', 'Transaction\Rollie\AnalisaMikroController@getFillingSampelCode');

		Route::post('/form/tambah-sampel-analisa-mikro', 'Transaction\Rollie\AnalisaMikroController@addMikroSample');
		
	});

	Route::group(['prefix' => 'analisa-mikro-release'], function () 
	{
		Route::get('','RollieController@showAnalisaMikroProductDashboard')->name('rollie.analysis_data.analisa_mikro_release');
		Route::post('/proses-analisa-mikro','Transaction\Rollie\AnalisaMikroController@inputAnalisaMikro'); 
		Route::get('/form/{analisa_mikro_id}', 'RollieController@showAnalisaMikroProductForm');
		
		
		Route::post('/form/submit-hasil-analisa', 'Transaction\Rollie\AnalisaMikroController@submitHasilAnalisa');	
		Route::post('/form/ubah-jam-filling', 'Transaction\Rollie\AnalisaMikroController@ubahJamFillingSampel');
		Route::get('/form/ambil-kode-sampel/{filling_machine_id}/{product_type_id}', 'Transaction\Rollie\AnalisaMikroController@getFillingSampelCode');

		Route::get('/form-ppq/{ppq_30}/{ppq_55}', 'RollieController@showPpqForm');
		Route::post('/form-ppq/proses-ppq', 'Transaction\Rollie\AnalisaMikroController@prosesPpqMikro');
		
		Route::post('/form/tambah-sampel-analisa-mikro', 'Transaction\Rollie\AnalisaMikroController@addMikroSample');
		
	});

	Route::get('/ppq-qc-release', 'RollieController@showPpqDashboard')->name('rollie.rkol.ppq_qc_release');
	Route::get('/ppq-qc-tahanan', 'RollieController@showPpqDashboard')->name('rollie.rkol.ppq_qc_tahanan');
	Route::get('/ppq-engineering', 'RollieController@showPpqDashboard')->name('rollie.rkol.ppq_engineering');
	
	Route::post('/proses-follow-up-ppq', 'Transaction\Rollie\FollowUpPpqController@prosesFollowUpPpq');
	
	Route::get('/follow-up-ppq-qc-release/{ppq_id}', 'Transaction\Rollie\FollowUpPpqController@prosesFollowUpPpqQcRelease');
	Route::get('/follow-up-ppq-qc-tahanan/{ppq_id}', 'RollieController@showPpqDashboard');
	Route::get('/follow-up-ppq-engineering/{ppq_id}', 'RollieController@showPpqDashboard');

	Route::get('/form-follow-up-ppq/{follow_up_ppq_id}/{params}/{params_induk}','RollieController@showFollowUpPpqForm');
	Route::post('/form-follow-up-ppq/update-follow-up-ppq','Transaction\Rollie\FollowUpPpqController@updateFollowUpPpq');	
	Route::post('/form-follow-up-ppq/proses-ppq-to-rkj','Transaction\Rollie\RkjController@createRkj');

	Route::group(['prefix' => 'report-produk-release'], function () {
		Route::get('','RollieController@showRprDashboard')->name('rollie.reports.rpr');
		Route::post('upload-bar','Transaction\Rollie\RPRController@exportBar');
	});
	Route::group(['prefix' => 'report-rpd-filling'], function () {
		Route::get('','RollieController@showReportRpdDashboard')->name('rollie.reports.rpd_filling');
		Route::get('filter-tanggal-produksi/{tanggal_produksi}','Transaction\Rollie\RPDFillingController@filterTanggalReport');
		Route::get('filter-produk/{product_id}/{tangal_produksi}','Transaction\Rollie\RPDFillingController@filterProductReport');
		Route::get('filter-wo/{wo_number_id}','Transaction\Rollie\RPDFillingController@filterWoNumberReport');
		Route::get('export-excel/{tanggal_produksi}/{product_id}/{wo_number_id}','Transaction\Rollie\RPDFillingController@exportReportExcel');
	});


	Route::get('/rkj-rnd-produk-nfi', 'RollieController@showRkjDashboard')->name('rollie.rkol.rkj_rnd_produk_nfi');
	Route::get('/rkj-qa', 'RollieController@showRkjDashboard')->name('rollie.rkol.rkj_qa');

	Route::post('/proses-follow-up-rkj', 'Transaction\Rollie\FollowUpRkjController@prosesFollowUpRkj');
	Route::get('/form-follow-up-rkj/{follow_up_rkj_id}/{params}','RollieController@showFollowUpRkjForm');

	Route::post('/form-follow-up-rkj/update-follow-up-rkj','Transaction\Rollie\FollowUpRkjController@updateFollowUpRkj');

});


Route::group(['prefix' => 'emon','middleware'=>['auth','credential.check']], function() 
{
	Route::get('/', 'EmonController@index');
	Route::get('/home-operator', 'EmonController@homeOperator')->name('emon.home-operator');
	Route::group(['prefix' => 'monitoring-air'], function() {
		Route::get('/', 'EmonController@showMonitoringAir')->name('emon.monitoring.water');
		Route::get('/{location_id}', 'EmonController@showMonitoringFormAir');
		Route::post('/input-monitoring', 'Transaction\Emon\EnergyMonitoringController@inputMonitoringEnergy');
		Route::post('/update-data-monitoring', 'Transaction\Emon\EnergyMonitoringController@updateDataMonitoringEnergy');
		Route::get('/get-monitoring-data/{flowmeter_id}', 'Transaction\Emon\EnergyMonitoringController@getMonitoringData');
	    
	});
	
	Route::get('/monitoring-listrik', 'EmonController@showMonitoringListrik')->name('emon.monitoring.listrik');
	Route::get('/monitoring-gas', 'EmonController@showMonitoringGas')->name('emon.monitoring.gas');
	Route::get('/histori-pengamatan', 'EmonController@showMonitoringHistory')->name('emon.monitoring.histories');
});