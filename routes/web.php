<?php


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
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


// Login to Dashboard
// Route::get('/', 'Dashboard\AuthController@index')->name('home');


// Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

//IF Admin Not Auth Return to login
// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->name('pagee')->middleware('adminauth:admin');

// Website routes
// Route::group(['namespace' => 'Site'], function () {
//     Route::get('/', 'SiteController@index');
// });


//site route
//Route::get('/', 'Site\SiteController@index');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localizationRedirect', 'localeViewPath'],
], function () {


    Route::group(['prefix' => 'dashboard', 'namespace' => 'App\Http\Controllers\Dashboard'], function () {

        Route::get('/', 'DashboardController@index')->name('admin.dashboard')->middleware('adminauth:admin');
        //Login process
        Route::get('/login', 'AuthController@login')->name('admin.login');
        Route::post('/do-login', 'AuthController@doLogin')->name('admin.doLogin');
        Route::name('admin.')->middleware('adminauth:admin')->group(function () {
            //Logout proccess
            Route::get('/logout', 'AuthController@logout')->name('logout');
        });


        Route::group(['prefix' => 'program'], function () {
            Route::get('/', 'DashboardController@getPrograms')->name('admin.programs');
            Route::get('/create', 'DashboardController@createProgram')->name('admin.create_program');
            Route::post('/store', 'DashboardController@addProgram')->name('admin.add_program');
        });
        Route::group(['prefix' => 'schools'], function () {
            Route::get('/', 'DashboardController@getSchools')->name('admin.schools');
            Route::get('/create', 'DashboardController@createSchool')->name('admin.create_school');
            Route::post('/store', 'DashboardController@addSchool')->name('admin.add_school');
        });
        Route::group(['prefix' => 'courses'], function () {
            Route::get('/', 'DashboardController@getCourses')->name('admin.courses');
            Route::get('/create', 'DashboardController@createCourse')->name('admin.create_course');
            Route::post('/store', 'DashboardController@addCourse')->name('admin.add_course');
        });
        Route::group(['prefix' => 'stages'], function () {
            Route::get('/', 'DashboardController@getStages')->name('admin.stages');
            Route::get('/create', 'DashboardController@createStage')->name('admin.create_stage');
            Route::post('/store', 'DashboardController@addStage')->name('admin.add_stage');
        });
        Route::group(['prefix' => 'units'], function () {
            Route::get('/', 'DashboardController@getUnits')->name('admin.units');
            Route::get('/create', 'DashboardController@createUnit')->name('admin.create_unit');
            Route::post('/store', 'DashboardController@addUnit')->name('admin.add_unit');
            Route::get('/edit/{id}', 'DashboardController@editUnit')->name('admin.edit_unit');
            Route::patch('/update/{id}', 'DashboardController@updateUnit')->name('admin.update_unit');
            Route::delete('/delete/{id}', 'DashboardController@deleteUnit')->name('admin.delete_unit');


            // Journey Start
            Route::get('/begin/{id}', 'DashboardController@getUnitBeginning')->name('admin.unit_begin');
            Route::get('/create_begin/{id}', 'DashboardController@createUnitBeginning')->name('admin.create_unit_begin');
            Route::post('/store_begin', 'DashboardController@storeUnitBeginning')->name('admin.store_unit_begin');
            Route::get('/lessons/{id}', 'DashboardController@getUnitLessons')->name('admin.unit_lessons');
            Route::get('/checkpoints/{id}', 'DashboardController@getUnitCheckpoint')->name('admin.unit_checkpoint');
            Route::get('/end/{id}', 'DashboardController@getUnitEnding')->name('admin.unit_end');
            // Journey End
        });

        Route::group(['prefix' => 'tests'], function () {
            Route::get('/', 'DashboardController@getTests')->name('admin.tests');
            Route::get('/create', 'DashboardController@createTest')->name('admin.create_test');
            Route::post('/store', 'DashboardController@addTest')->name('admin.add_test');
            Route::get('/edit/{id}', 'DashboardController@editTest')->name('admin.edit_test');
            Route::patch('/update/{id}', 'DashboardController@updateTest')->name('admin.update_test');
            Route::delete('/delete/{id}', 'DashboardController@deleteTest')->name('admin.delete_test');
        });
    });
});
