<?php

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
// Route::get('/template/dupak', 'TemplateController@dupakTemplate');
// Route::get('/template/dupak/{user_id}', 'TemplateController@dupakUser');
// Route::get('/dupak/index', 'admin\DupakController@index');
// Route::get('/testlama', 'admin\SptController@getLamaSpt');
// Route::get('/testkode', 'admin\TestController@kodeTemuanSelect');
// Route::post('/test/{uid}/{date_start}/{date_end}', 'admin\SptController@storeKuota');
// Route::get('/sess-anggota', 'admin\SptController@getSessionAnggota');
// Route::get('/test/dupak', 'admin\TestController@testDupak');

// });
Auth::routes();
Route::post('/pic-update','ProfileController@profilePicUpdate')->name('pic.update');
Route::get('/get-profile','ProfileController@getData')->name('api.profile');
// Route::get('/myprofile','ProfileController@edit')->name('myprofile');
Route::get('/admin/activity/useract','ProfileController@UserActivity')->name('useract');
Route::get('/admin/activity/bindex', 'ProfileController@viewActivity')->name('viewlog');
//Route::get('/search-user', 'admin\UserController@search')->name('search_user');
Route::resource('/profile','ProfileController')->except('destroy');

Route::namespace('admin')->group(function () {

	Route::get('/admin/dupak/update-dupak/pendidikan/{user_id}', 'DupakController@updateDupakPendidikan')->name('update_dupak_pendidikan');


	//Route Lokasi
	Route::get('/admin/lokasi','LokasiController@index')->name('index_lokasi');
	Route::post('/admin/save-lokasi','LokasiController@store')->name('store_lokasi');
	Route::get('/admin/getdata-lokasi','LokasiController@getLokasiPemeriksaan')->name('get_data_lokasi');
});
Route::group(['middleware' => ['auth','permission:Access admin page']], function (){

	Route::get('/', function () {
    //return view('welcome');
	    return redirect()->route('admin');
	});
});

Route::group(['middleware' => ['auth']], function(){
	Route::get('spt/myspt','admin\SptController@mySpt')->name('my-spt');
	Route::get('spt/myspt/{id}','admin\SptController@InputTemuan')->name('input_kode_laporan');
	Route::get('/admin/spt/myspt/{id}','SptController@InputTemuan')->name('input_kode_laporan_front');
});

/***
 *                             _
 *                            | |
 *      _ __    ___    _   _  | |_    ___
 *     | '__|  / _ \  | | | | | __|  / _ \
 *     | |    | (_) | | |_| | | |_  |  __/
 *     |_|     \___/   \__,_|  \__|  \___|
 *
 *
 */


//starting point new route classification
Route::group(['prefix'=>'admin', 'namespace' => 'admin', 'middleware' => ['auth','permission:Access admin page']], function () {

	//admin index will be halaman awal setelah login
	Route::get('','DashboardController@index')->name('admin');

	// profile user
	Route::group(['middleware'=> ['role:Super Admin']], function(){
		// to profile user
		Route::get('profile/{id}','ProfileController@viewProfileById')->name('profile');
		//get data gaji user
		Route::get('profile/getDataSalaryUserById/{id}','ProfileController@getDataSalaryUserById');
        // ubah password via profile
        Route::post('profile/editPasswordProfile','ProfileController@editPasswordProfile')->name('editPassword');
	});

	// route hr mengelola user
    Route::group(['middleware'=> ['role:Super Admin']], function(){
        // to index hr
		Route::get('hr','HRController@index')->name('hr');
		// getdata user by id aktif/tidak aktif
		Route::get('hr/getDataUser/{id}','HRController@getDataUser');
		// ke view data user yang tidak aktif
		Route::get('hr/getDataUserTidakAktif','HRController@viewUserTidakAktif')->name('userTidakAktif');
		// view upload user
        Route::get('hr/uploadDataView','HRController@uploadDataView')->name('uploadView');
		// post excel user to db
		Route::post('hr/uploadData','HRController@uploadData')->name('uploadData');
		// get tamplate karyawan
		Route::get('hr/getFormatKaryawan','HRController@getTamplateExcel')->name('getTamplate');
		// merubah status
		Route::post('hr/editStatusById/{id}','HRController@editstatus');
		// menambah note
		Route::post('hr/noteDeactiveUser','HRController@deactiveUser')->name('noteDeactiveUser');
        // inser data user ke db
        Route::post('hr/inputUser','HRController@create')->name('inputUser');
        // getdata edit user
        Route::get('hr/editUser/{id}','HRController@editUser')->name('editUser');
        // route post update data user
        Route::post('hr/updateUser','HRController@updateUser')->name('updateDataUser');

    });

	// route hr mengelola salary/payroll user
    Route::group(['middleware'=> ['role:Super Admin']], function(){
		// to index salary
        Route::get('hr/salary','SalaryController@index')->name('salary');
        // view slip salary
        Route::get('hr/salary/viewSlipSalary/{id}','SalaryController@viewSlipSalary')->name('viewSlipSalary');
		Route::get('salary/viewSalaryUserById','SalaryController@viewDataSalaryById')->name('salaryById');
		// get data by periode
		Route::post('hr/getDataByPeriode','SalaryController@dataByPeriode')->name('getDatabyPeriode');
		// get all data
		Route::get('hr/getDataSalary/{id}','SalaryController@getDataSalary')->name('getSalaryData');
		// view upload salary
		Route::get('hr/salary/form','SalaryController@viewFormSalary')->name('formSalary');
		// import salary dengan excel
		Route::post('hr/uploadSalary','SalaryController@uploadSalary')->name('uploadSalary');
		// download format excel
		Route::get('hr/getFormatSalary','SalaryController@getFormatSalary')->name('getTamplateSalary');
    });














	//cek dasar spt
	Route::get('spt/dasar-spt','SptController@cekDasarSpt')->name('cek_dasar_spt');

	//url prefix admin/spt
	Route::group(['prefix'=>'spt', 'middleware' => ['auth','permission:Access admin page']], function(){
		Route::get('getdata/{jenis_data}','SptController@getData')->name('get_data_spt'); // add jenis data variable (mensederhanakan route dengat method get agar terkumpul jadi 1, default value jenis_data = null)
		Route::get('get-anggota','SptController@getAnggota')->name('get_anggota_spt');
		Route::get('cetak-pdf/{id}','SptController@sptPdf')->name('spt_pdf');
		Route::get('docx/{id}','SptController@sptDocx')->name('spt_docx');
		Route::get('last-data-tambahan/{jenis_spt_id}', 'SptController@getLastDataTambahan')->name('last_data_tambahan');
		Route::get('last-data/{jenis_data}', 'SptController@getLastData')->name('last_data');
		Route::get('durasi', 'SptController@getDurasi')->name('durasi_spt');

		//Role TU Perencanaan
		Route::group(['middleware'=>['auth', 'role:Super Admin|TU Perencanaan']], function(){
			Route::get('penomoran','SptController@getPenomoranSpt')->name('get-penomoran');
			Route::post('insert-detail-spt','SptController@storeDetail')->name('store_detail_spt');
			Route::post('session/store','SptController@storeSessionAnggota')->name('store_session_anggota');
			Route::post('store-detail-anggota','SptController@storeDetailAnggota')->name('store_detail_anggota');
			Route::delete('delete-anggota/{id}','SptController@deleteAnggota')->name('delete_anggota');
			Route::get('{id}/edit', 'SptController@edit')->name('edit_spt');

			//percobaan tampilkan data anggota spt tanpa datatable
			Route::get('anggota/pengawasan', 'SptController@drawTableAnggota')->name('tabel_anggota_pengawasan');

			//session anggota SPT
			Route::get('session/anggota', 'SptController@getSessionAnggota')->name('get_session_anggota');
			Route::get('session/anggota/clear', 'SptController@clearSessionAnggota')->name('clear_session_anggota');
			Route::delete('session/anggota/delete/{user_id}', 'SptController@deleteSessionAnggotaItem')->name('delete_session_anggota_by_id');
		});

		Route::group(['middleware'=>['auth', 'role:Super Admin|TU Perencanaan|Administrasi Umum']], function(){
			Route::post('update-nomor/{id}','SptController@updateNomorSpt')->name('update_nomor_spt');
			Route::post('upload-spt','SptController@ajaxUpload')->name('ajax_upload_spt');
		});

		//role Administrasi Umum
		Route::group(['middleware'=>['auth', 'role:Super Admin|Administrasi Umum']], function(){
			Route::get('last-data-umum/{jenis_data}', 'SptController@getLastDataUmum')->name('last_data_umum');
			Route::get('cetak-pdf-umum/{id}','SptController@sptPdfUmum')->name('spt_pdf_umum');

			Route::get('get-spt-umum-byid/{id}','SptController@getSptUmumbyId')->name('get_spt_umum_byid');
			Route::get('get-penomoran-umum','SptController@getPenomoranSptUmum')->name('penomoran_umum');
			Route::get('get-arsip-umum','SptController@getArsipUmum')->name('arsip_spt_umum');
			//Route::post ('update-nomor-umum/{id}','SptController@updateNomorSptUmum')->name('penomoran_spt_umum');
			Route::post('upload-scan-umum/{id}','SptController@uploadScanSptumum')->name('upload_scan_spt_umum');
			Route::post('upload-scan/{id}','SptController@uploadScanSpt')->name('upload_scan_spt');
			Route::post('umum/store', 'SptController@storeUmum')->name('store_spt_umum');
			Route::post('umum/update', 'SptController@updateUmum')->name('update_spt_umum');
			Route::delete('umum/spt-umum/{id}','SptController@delelteSptUmum')->name('detele_spt_umum');

			Route::post('umum/session/store','SptController@storeSessionAnggotaUmum')->name('store_session_anggota_umum');
			Route::post('umum/store-detail-anggota','SptController@storeDetailAnggotaUmum')->name('store_detail_anggota_umum');
			Route::get('get-anggota/umum/{id}','SptController@getAnggotaUmum')->name('get_anggota_umum_spt');
			Route::delete('session/anggota/umum/delete/{user_id}', 'SptController@deleteSessionAnggotaUmumItem')->name('delete_session_anggota_umum_by_id');
			Route::delete('delete-anggota-umum/{id}','SptController@deleteAnggotaUmum')->name('delete_anggota_umum');

			Route::get('umum/{id}/edit', 'SptController@editSptUmum')->name('edit_spt_umum');
			Route::get('get-valueData-spt-umum/{id}', 'SptController@getDataSptUmumbyId');
			Route::get('get-previous-sptUmum/{id}','SptController@getPrevDataSptUmum');

			//percobaan tampilkan data anggota spt tanpa datatable
			Route::get('anggota/umum', 'SptController@drawTableAnggotaUmum')->name('tabel_anggota_umum');
			Route::get('session/anggota/umum/clear', 'SptController@clearSessionAnggotaUmum')->name('clear_session_anggota_umum');

		});
	});

	//Route jenis spt
	Route::group(['prefix'=> 'jenis-spt', 'middleware'=> ['role:Super Admin|TU Perencanaan']], function(){
		Route::get('getdata','JenisSptController@getData');
		Route::get('cari', 'JenisSptController@cariJenisSpt')->name('cari_jenis_spt');
		Route::get('get-radio-value/{id}', 'JenisSptController@getRadioValue')->name('jenis_spt_radio'); //kasus perceraian, menampilkan pilihan 1)izin cerai, 2)keterangan cerai
	});

	//Sertifikat route
	Route::group(['prefix'=>'sertifikat'], function(){
		Route::get('/myprofile','SertifikatController@viewProfile')->name('myprofile'); /*pindahkan fungsi edit dari profilecontroller ke usercontroller*/
		Route::get('/getDataPegawai','UserController@getData')->name('getDataPegawai');
		Route::get('/getDataSertifikat','SertifikatController@getSertifikatUsers')->name('getSertifikat');
		Route::get('getdata/sertifikat-auditor/{id}', 'SertifikatController@getdataSertifikatUsers')->name('sertifikat_kepegawaian');
		Route::get('myprofile/getDataSertifikatBy/{id}','SertifikatController@dataSertifikat')->name('sertifikat_by_id');
		Route::post('/input/sertifikat-auditor','SertifikatController@storeSertifikat')->name('input_sertifikat');
		Route::post('/edit/sertifikatAuditor','SertifikatController@editSertifikat')->name('save_edit_sertifikat');
		Route::get('/delete/sertifikatAuditor/{id}','SertifikatController@deleteSertifikat')->name('delete_sertifikat');

		Route::put('profile/{id}','UserController@updateDataProfileUser');
	});

	//kka
	Route::group(['prefix' => 'kka', 'middleware'=> ['role:Super Admin|Auditor|Inspektur']], function(){
		Route::get('input-kka/{id}','KkaController@InputKka')->name('input_kka');
		Route::get('input-lhp/{id}','KkaController@InputLhp')->name('input_lhp');

		Route::post('upload_lhp','KkaController@upload_lhp')->name('insert_lhp');
		Route::get('paparan/{id}','KkaController@paparanKKA');
		Route::post('input-paparan','KkaController@inputPaparanKKA')->name('input-paparan');

		Route::get('getdata_detail/{id}','KkaController@ProsesButtonKAA');
		Route::get('getDataTemuan_per_auditor/{id}','KkaController@getDataTemuan');
		Route::get('getdata-editKKA/{id}','KkaController@getEditKodeTemuanKKA');
    	Route::post('/laporan-auditor', 'KkaController@proses_upload')->name('laporan_auditor');

    	//unggah kka oleh ketua tim & menyejui kka oleh daltu,dalnis,penanggungjawab
    	Route::get('/unggah-KKA/{id}','KkaController@uploadKKA')->name('unggah');
    	Route::get('menyetujui/{id}','KkaController@Penyetujuan_daltu_dalnis');
    	Route::get('menyetujui_penanggungjawab/{id}','KkaController@Penyetujuan_penanggungjawab');
    	Route::get('tolak-kka/{id}','KkaController@tolakKKA');

    	//cetak kka & lhp
    	Route::get('/cetak/kka/{id}','KkaController@cetakLaporan')->name('laporan-cetak');
    	Route::get('/cetak/lhp/{id}','KkaController@cetakLhp')->name('laporan-lhp-cetak'); //
    });

	//calendar route
	Route::group(['prefix'=> 'calendar'], function(){
		Route::get('','CalendarController@index')->name('calendar');
		Route::get('holiday','CalendarController@getHoliday')->name('holiday_calendar');
		Route::post('create','CalendarController@create')->name('store_calendar');
		Route::post('update','CalendarController@update')->name('update_calendar');
		Route::post('delete','CalendarController@destroy')->name('delete_calendar');
		Route::get('user-event/{id}/change','CalendarController@userEventChange')->name('user_event_change');
		Route::post('update-user-event', 'CalendarController@updateUserEvent')->name('update_user_event');
		Route::delete('delete-user-event/{id}','CalendarController@deleteUserEvent')->name('delete_user_event');
		Route::get('pdf', 'CalendarController@calendarPdf')->name('calendar_pdf');

		Route::get('/admin/calendar/auditor','CalendarController@getSptAuditor')->name('calendar_auditor');
		Route::get('lembur', 'CalendarController@getLembur')->name('calendar_lembur');
		Route::get('ppm', 'CalendarController@getPpm')->name('calendar_ppm');
		Route::get('umum', 'CalendarController@getCalendarUmum')->name('calendar_umum');
	});

	Route::group(['prefix'=>'dupak'],function(){
		Route::get('list', 'DupakController@index')->name('list_dupak');
		Route::get('reviu', 'DupakController@reviuDupak')->name('reviu_dupak');
		Route::get('pengawasan', 'DupakController@getData')->name('data_dupak');
    	Route::get('pendidikan', 'DupakController@getDupakPendidikan')->name('data_dupak_pendidikan');
    	Route::get('diklat', 'DupakController@getDupakDiklat')->name('data_dupak_diklat');
    	Route::get('penunjang', 'DupakController@getDupakPenunjang')->name('data_dupak_penunjang');
    	Route::get('pengembangan', 'DupakController@getDupakPengembangan')->name('data_dupak_pengembangan');
    	Route::get('lak', 'DupakController@getLak')->name('data_dupak_lak');
    	Route::get('pak', 'DupakController@userPak')->name('user_pak');
    	Route::get('lama', 'DupakController@dupakLama')->name('dupak_lama');
		Route::get('user/{id}', 'DupakController@dupakUser')->name('get_dupak_user');
		Route::post('store/penunjang', 'DupakController@storePenunjang')->name('store_dupak_penunjang');
		Route::post('submit-dupak-lama', 'DupakController@submitDupakLama')->name('submit_dupak_lama');
	});

	Route::group(['prefix'=>'lokasi', 'middleware'=> ['role:Super Admin']],function(){
		Route::get('lokasi','LokasiController@index')->name('index_lokasi');
		Route::post('save-lokasi','LokasiController@store')->name('store_lokasi');
		Route::get('getdata-lokasi','LokasiController@getLokasiPemeriksaan')->name('get_data_lokasi');
		Route::get('getDataLokasi/{id}','LokasiController@getdataLokasi')->name('upload_scan_spt');
	});


	//fungsi resiko
	// Route::group(['prefix' => 'resiko'], function(){
	// 	Route::get('','ResikoController@index')->name('resikoindex');
	// 	Route::get('getdata','ResikoController@getDataResiko');
	// 	Route::post('insertDataResiko','ResikoController@insertResiko');
	// 	Route::get('delete/{id}','ResikoController@deleteResiko')->name('deleteDataResiko');
	// 	Route::get('getdata/resiko/{id}','ResikoController@resikoPdf')->name('resikoPDF');
	// });

    //route Kode temuan
    Route::group(['prefix' => 'kode'], function(){
    	Route::get('select', 'KodeTemuanController@kodeTemuanSelect')->name('select_kode');
	    Route::get('get-sub-kelompok/{id}', 'KodeTemuanController@getSubKelompok')->name('api.kode_sub_kel');
    });

    //route users/role/permission route
    Route::group(['prefix' => 'users'], function(){
    	Route::get('getdata','UserController@getData');
    	Route::get('search-user', 'UserController@search')->name('search_user');

    	//satgas ppm (penunjukan pejabat)
		Route::get('penunjukan/pejabat', 'PejabatController@index')->name('satgas_ppm');
		Route::post('submit/pejabat', 'PejabatController@submit')->name('submit_pejabat');



    });

    // route ppm
    Route::group(['prefix' => 'ppm'], function(){
    	Route::get('index','PpmController@index')->name('ppm_index');
    	Route::get('getdata-ppm','PpmController@getdataPpm')->name('getdata_ppm');
    	// ppm
		Route::post('store-ppm','PpmController@storePpm')->name('store_ppm'); /*strore ppm*/
    	Route::post('session-anggota/store/ppm','PpmController@storePpmSessionAnggotaPpm')->name('store_session_anggota_ppm'); /*store session anggota ppm*/
    	// Route::post('ppm/store-detail-anggota','SptController@storePpmDetailAnggota')->name('store_detail_anggota_umum');
    	Route::delete('session/anggota/delete/{user_id}','PpmController@deleteSessionAnggotaPpm')->name('delete_session_anggota_ppm_by_id'); /*delete anggota session by user_id*/
    	// Route::get('/get-ppm-byid/{id}','PpmController@getPpmByid')->name('getPpmById');
    	/*edit ppm*/
    	Route::get('get-valueData-ppm/{id}','PpmController@getValueEdit')->name('get_value_edit');
    	// Route::post('update-ppm','PpmController@updatePpm')->name('update_ppm');

    	// percobaan ppm tanpa datatable
    	// Route::get('ppm/get-data/anggota', 'PpmController@drawTableAnggotaPpm')->name('tabel_anggota_ppm');
    	Route::post('ppm/get-data/anggota', 'PpmController@TableAnggotaPpm')->name('tabel_anggota_ppm'); /*getdata user yang terkait ppm tsb*/
    	Route::delete('delete/data-ppm/{id}','PpmController@deletePpm')->name('delete_data_PPM_by_id');

    });

    Route::group(['prefix' => 'roles'], function(){
    	Route::get('getdata','RoleController@getData');
    	Route::put('{id}','RoleController@update');
    	Route::get('role-details/{id}', 'RoleController@getMasterDetailsSingleData')->name('api.role_single_details');
		Route::get('role-details', 'RoleController@getMasterDetailsData')->name('api.role_details');
    });

    Route::group(['prefix' => 'permissions'], function(){
    	Route::get('getdata','PermissionController@getData');
    });

    //data yang bisa diakses public (auth)
    Route::group(['middleware'=>'auth'], function(){
    	Route::get('get-auditor', 'UserController@getAuditor')->name('get_auditor');
    });

    //administering role and permission route
    Route::group(['middleware'=>'permission:Administer roles & permissions'], function(){

    });

    //route resource (only resource)
    Route::resource('roles', 'RoleController'); // bug on update ( admin/roles/{id} 404 not found, tapi data sukses terupdate )
    Route::resource('permissions', 'PermissionController');
	Route::resource('users', 'UserController');
	Route::resource('jenis-spt', 'JenisSptController');
	Route::resource('spt', 'SptController');
	Route::resource('kode', 'KodeTemuanController');
    //Route::get('/admin/users/getdata','UserController@getData');




});
