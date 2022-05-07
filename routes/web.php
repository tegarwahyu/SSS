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

Auth::routes();

Route::group(['middleware' => ['auth','permission:Access admin page']], function (){

	Route::get('/', function () {
    //return view('welcome');
	    return redirect()->route('admin');
	});
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
Route::group(['prefix'=>'admin', 'namespace' => 'admin', 'middleware' => ['auth','isDC']], function () {

	//admin index will be halaman awal setelah login
	Route::get('','DashboardController@index')->name('admin');

	// // profile user
	// Route::group(['middleware'=> ['role:Super Admin|Secretary|HR Staff|HR Manager|Leader DC|Collection Manager|Supervisor DC|Desk Collection|Director|Admin|Komisaris|Operasional Manager|Management|QA & Legal Manager|IT Manager|General Affair Staff|IT Staff|FAT Manager|Tax Staff|Translator Mandarin|Legal Staff|Medic Staff|Driver|Resepsionis|Security|Office Boy|Office Girl']], function(){
	// 	// to profile user
	// 	Route::get('profile/{id}','ProfileController@viewProfileById')->name('profile');
	// 	//get data gaji user
	// 	Route::get('profile/getDataSalaryUserById/{id}','ProfileController@getDataSalaryUserById');
    //     // ubah password via profile
    //     Route::post('profile/editPasswordProfile','ProfileController@editPasswordProfile')->name('editPassword');
	// });

	// route hr mengelola user
    Route::group(['middleware'=> ['role:Super Admin|HR Staff|HR Manager|Collection Staff|Collection Manager']], function(){
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
    Route::group(['middleware'=> ['role:Super Admin|Secretary|HR Staff|HR Manager|Leader DC|Collection Manager|Supervisor DC|Desk Collection|Director|Admin|Komisaris|Operasional Manager|Management|QA & Legal Manager|IT Manager|General Affair Staff|IT Staff|FAT Manager|Tax Staff|Translator Mandarin|Legal Staff|Medic Staff|Driver|Resepsionis|Security|Office Boy|Office Girl|Secretary']], function(){
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

    Route::group(['prefix' => 'roles'], function(){
    	Route::get('getdata','RoleController@getData');
    	Route::put('{id}','RoleController@update');
    	Route::get('role-details/{id}', 'RoleController@getMasterDetailsSingleData')->name('api.role_single_details');
		Route::get('role-details', 'RoleController@getMasterDetailsData')->name('api.role_details');
    });

    Route::group(['prefix' => 'permissions'], function(){
    	Route::get('getdata','PermissionController@getData');
    });

    //route resource (only resource)
    Route::resource('roles', 'RoleController'); // bug on update ( admin/roles/{id} 404 not found, tapi data sukses terupdate )
    Route::resource('permissions', 'PermissionController');

});

Route::group(['prefix'=>'user', 'namespace' => 'admin', 'middleware' => ['auth','isDC']], function () {
	// profile user
	Route::group(['middleware'=> ['role:Super Admin|Secretary|HR Staff|HR Manager|Leader DC|Collection Manager|Supervisor DC|Desk Collection|Director|Admin|Komisaris|Operasional Manager|Management|QA & Legal Manager|IT Manager|General Affair Staff|IT Staff|FAT Manager|Tax Staff|Translator Mandarin|Legal Staff|Medic Staff|Driver|Resepsionis|Security|Office Boy|Office Girl']], function(){
		// to profile user
		Route::get('profile/{id}','ProfileController@viewProfileById')->name('profile');
		//get data gaji user
		Route::get('profile/getDataSalaryUserById/{id}','ProfileController@getDataSalaryUserById');
		// ubah password via profile
		Route::post('profile/editPasswordProfile','ProfileController@editPasswordProfile')->name('editPassword');
	});
});
