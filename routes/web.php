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
            Route::get('/', 'ProgramController@getPrograms')->name('admin.programs');
            Route::get('/create', 'ProgramController@createProgram')->name('admin.create_program');
            Route::post('/store', 'ProgramController@addProgram')->name('admin.add_program');
            Route::get("/show/program/{id}", 'ProgramController@showProgram')->name('admin.show_program');
            Route::get("/show/program/units/{id}", 'ProgramController@showProgramUnits')->name('admin.show_program_units');
            Route::get("/show/program/view-unit/{id}", 'ProgramController@showProgramViewUnit')->name('admin.show_program_view_unit');
            Route::get("/show/program/beginnings/{id}", 'ProgramController@showProgramBeginnings')->name('admin.show_program_beginnings');
            Route::get("/show/program/view-beginning/{id}", 'ProgramController@showProgramViewBeginning')->name('admin.show_program_view_beginning');
            Route::get("/show/program/benchmarks/{id}", 'ProgramController@showProgramBenchmarks')->name('admin.show_program_benchmarks');
            Route::get("/show/program/view-benchmark/{id}", 'ProgramController@showProgramViewBenchmark')->name('admin.show_program_view_benchmark');
            Route::get("/show/program/endings/{id}", 'ProgramController@showProgramEndings')->name('admin.show_program_endings');
            Route::get("/show/program/view-ending/{id}", 'ProgramController@showProgramViewEnding')->name('admin.show_program_view_ending');
            Route::delete('/delete/{id}', 'ProgramController@deleteProgram')->name('admin.delete_program');
        
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
            Route::delete('/delete/{id}', 'DashboardController@deleteCourse')->name('admin.delete_course');
        });
        Route::group(['prefix' => 'stages'], function () {
            Route::get('/', 'DashboardController@getStages')->name('admin.stages');
            Route::get('/create', 'DashboardController@createStage')->name('admin.create_stage');
            Route::post('/store', 'DashboardController@addStage')->name('admin.add_stage');
            Route::delete('/delete/{id}', 'DashboardController@deleteStage')->name('admin.delete_stage');
        });
        Route::group(['prefix' => 'units'], function () {
            Route::get('/', 'UnitController@getUnits')->name('admin.units');
            Route::get('/create', 'UnitController@createUnit')->name('admin.create_unit');
            Route::post('/store', 'UnitController@addUnit')->name('admin.add_unit');
            Route::get('/edit/{id}', 'UnitController@editUnit')->name('admin.edit_unit');
            Route::patch('/update/{id}', 'UnitController@updateUnit')->name('admin.update_unit');
            Route::delete('/delete/{id}', 'UnitController@deleteUnit')->name('admin.delete_unit');


            // Journey Start
            Route::get('/begin/{id}', 'UnitController@getUnitBeginning')->name('admin.unit_begin');
            Route::get('/create_begin/{id}', 'UnitController@createUnitBeginning')->name('admin.create_unit_begin');
            Route::post('/store_begin', 'UnitController@storeUnitBeginning')->name('admin.store_unit_begin');
            Route::get("/show/view-beginning/{id}", 'UnitController@showUnitViewBeginning')->name('admin.show_unit_view_beginning');

            Route::get('/lessons/{id}', 'UnitController@getUnitLessons')->name('admin.unit_lessons');
            Route::get('/create_lesson/{id}', 'UnitController@createUnitLesson')->name('admin.create_unit_lesson');
            Route::post('/store_lesson', 'UnitController@storeUnitLesson')->name('admin.store_unit_lesson');
            Route::get('/checkpoints/{id}', 'UnitController@getUnitCheckpoint')->name('admin.unit_checkpoint');
            Route::get('/end/{id}', 'UnitController@getUnitEnding')->name('admin.unit_end');
            Route::get('/create_ending/{id}', 'UnitController@createUnitEnding')->name('admin.create_unit_end');
            Route::post('/store_ending', 'UnitController@storeUnitEnding')->name('admin.store_unit_end');
            Route::get('/show_ending/{id}', 'UnitController@showUnitEnding')->name('admin.show_view_ending');
            Route::get('/lesson/presentations/{id}', 'UnitController@getPresentation')->name('admin.lesson_presentaion');
            Route::get('/lesson/warmups/{id}', 'UnitController@getLessonWarmup')->name('admin.lesson_warmup');
            Route::get('/lesson/lesson_ending/{id}', 'UnitController@getEndOfLesson')->name('admin.lesson_ending');




            Route::get('/create_checkpoint/{id}', 'UnitController@createUnitCheckpoint')->name('admin.create_unit_checkpoint');
            Route::post('/store_checkpoint', 'UnitController@storeUnitCheckpoint')->name('admin.store_unit_checkpoint');
            Route::get('/show_checkpoint/{id}', 'UnitController@showUnitCheckpoint')->name('admin.show_view_checkpoint');

            Route::get('/edit/checkpoint/{id}', 'UnitController@editUnitCheckpoint')->name('admin.edit_unit_checkpoint');
            Route::patch('/update/checkpoint/{id}', 'UnitController@updateUnitCheckpoint')->name('admin.update_unit_checkpoint');
            Route::delete('/delete/checkpoint/{id}', 'UnitController@deleteUnitCheckpoint')->name('admin.delete_unit_checkpoint');

            // Journey End
        });

        Route::group(['prefix' => 'tests'], function () {
            Route::get('/', 'TestController@getTests')->name('admin.tests');
            Route::get('/create', 'TestController@createTest')->name('admin.create_test');
            Route::post('/store', 'TestController@addTest')->name('admin.add_test');
            Route::get('/edit/{id}', 'TestController@editTest')->name('admin.edit_test');
            Route::patch('/update/{id}', 'TestController@updateTest')->name('admin.update_test');
            Route::delete('/delete/{id}', 'TestController@deleteTest')->name('admin.delete_test');
        });
        Route::group(['prefix' => 'questions'], function () {
            Route::get('/', 'QuestionController@getQuestions')->name('admin.questions');
            Route::get('/create', 'QuestionController@createQuestion')->name('admin.create_question');
            Route::post('/store', 'QuestionController@addQuestion')->name('admin.add_question');
            Route::get('/edit/{id}', 'QuestionController@editQuestion')->name('admin.edit_question');
            Route::patch('/update/{id}', 'QuestionController@updateQuestion')->name('admin.update_question');
            Route::delete('/delete/{id}', 'QuestionController@deleteQuestion')->name('admin.delete_question');
        });
        Route::group(['prefix' => 'benchmarks'], function () {
            Route::get('/', 'DashboardController@getBenchmarks')->name('admin.benchmarks');
            Route::get('/create', 'DashboardController@createBenchmark')->name('admin.create_benchmark');
            Route::get('/post-units/{program}', 'DashboardController@postUnits')->name('admin.post_units');
            Route::post('/store', 'DashboardController@addBenchmark')->name('admin.add_benchmark');
            Route::get('/edit/{id}', 'DashboardController@editBenchmark')->name('admin.edit_benchmark');
            Route::patch('/update/{id}', 'DashboardController@updateBenchmark')->name('admin.update_benchmark');
            Route::delete('/delete/{id}', 'DashboardController@deleteBenchmark')->name('admin.delete_benchmark');
        });
        Route::group(['prefix' => 'endings'], function () {
            Route::get('/', 'DashboardController@getEndings')->name('admin.endings');
            Route::get('/create', 'DashboardController@createEnding')->name('admin.create_ending');
            Route::post('/store', 'DashboardController@addEnding')->name('admin.add_ending');
            Route::get('/edit/{id}', 'DashboardController@editEnding')->name('admin.edit_ending');
            Route::patch('/update/{id}', 'DashboardController@updateEnding')->name('admin.update_ending');
            Route::delete('/delete/{id}', 'DashboardController@deleteEnding')->name('admin.delete_ending');
        });
        Route::group(['prefix' => 'beginnings'], function () {
            Route::get('/', 'DashboardController@getBeginnings')->name('admin.beginnings');
            Route::get('/create', 'DashboardController@createBeginning')->name('admin.create_beginning');
            Route::post('/store', 'DashboardController@addBeginning')->name('admin.add_beginning');
            Route::get('/edit/{id}', 'DashboardController@editBeginning')->name('admin.edit_beginning');
            Route::patch('/update/{id}', 'DashboardController@updateBeginning')->name('admin.update_beginning');
            Route::delete('/delete/{id}', 'DashboardController@deleteBeginning')->name('admin.delete_beginning');
        });
        Route::group(['prefix' => 'revision'], function () {
            Route::get('/', 'DashboardController@getRevisionQuestion')->name('admin.revision-question');
            Route::get('/create', 'DashboardController@createRevisionQuestion')->name('admin.create_revision_question');
            Route::post('/store', 'DashboardController@addRevisionQuestion')->name('admin.add_revision_question');
            Route::get('/edit/{id}', 'DashboardController@editRevisionQuestion')->name('admin.edit_revision_question');
            Route::patch('/update/{id}', 'DashboardController@updateRevisionQuestion')->name('admin.update_revision_question');
            Route::delete('/delete/{id}', 'DashboardController@deleteRevisionQuestion')->name('admin.delete_revision_question');
            Route::post('/add-question-bank', 'DashboardController@createQuestionBank')->name('admin.add_question_bank');
            Route::get('/get-question-banks', 'DashboardController@getQuestionBanks')->name('get-question-banks');
        });
        Route::group(['prefix' => 'presentations'], function () {
            Route::get('/', 'DashboardController@getPresentations')->name('admin.presentations');
            Route::get('/create', 'DashboardController@createPresentation')->name('admin.create_presentation');
            Route::post('/store', 'DashboardController@addPresentation')->name('admin.add_presentation');
            Route::get('/edit/{id}', 'DashboardController@editPresentation')->name('admin.edit_presentation');
            Route::patch('/update/{id}', 'DashboardController@updatePresentation')->name('admin.update_presentation');
            Route::delete('/delete/{id}', 'DashboardController@deletePresentation')->name('admin.delete_presentation');
        });
        Route::group(['prefix' => 'lesson-endings'], function () {
            Route::get('/', 'LessonController@getLessonEndings')->name('admin.lesson-endings');
            Route::get('/create', 'LessonController@createLessonEnding')->name('admin.create_lesson_ending');
            Route::post('/store', 'LessonController@addLessonEnding')->name('admin.add_lesson_ending');
            Route::get('/edit/{id}', 'LessonController@editLessonEnding')->name('admin.edit_lesson_ending');
            Route::patch('/update/{id}', 'LessonController@updateLessonEnding')->name('admin.update_lesson_ending');
            Route::delete('/delete/{id}', 'LessonController@deleteLessonEnding')->name('admin.delete_lesson_ending');
        });

        Route::group(['prefix' => 'warmups'], function () {
            Route::get('/', 'DashboardController@getWarmups')->name('admin.warmup');
            Route::get('/create', 'DashboardController@createWarmup')->name('admin.create_warmup');
            Route::post('/store', 'DashboardController@addWarmup')->name('admin.store_warmup');
        });
        Route::group(['prefix' => 'games'], function () {
            Route::get('/', 'GameController@getGames')->name('admin.games');
            Route::get('/create', 'GameController@createGame')->name('admin.create_game');
            Route::post('/store', 'GameController@storeGame')->name('admin.store_game');
            Route::post('/show/{id}', 'GameController@getGame')->name('admin.show_game');
        });
    });
});
