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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/user/login', 'HomeController@user_login')->name('user-login');

Route::get('/', 'HomeController@index')->middleware('auth')->name('home');
Route::get('/course/{slug}', 'HomeController@courses')->name('course-single');
Route::get('/assignment/{slug}', 'HomeController@assignment_details')->name('assignment-details');
Route::get('/submission/{slug}', 'HomeController@submission_single')->name('submission-single');
Route::get('/search', 'HomeController@search')->name('search');
Route::post('/submit-assignment/{slug}', 'HomeController@submit_assignment')->name('submit-assignment');

Route::get('/code', function(){
    return view('code');
})->name('code');

Route::get('admin/login', 'Auth\LoginController@loginForm')->name('login');
Route::post('admin/securelogin', 'Auth\LoginController@Login')->name('securelogin');
// Route::get('logout', 'Auth\LoginController@Logout')->name('logout');
Route::post('logout', 'Auth\LoginController@Logout')->name('logout');

Auth::routes(['verify' => true]);

Route::group(['middleware'=>['auth','role:super-admin']], function(){
    Route::name('admin.')->prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');
       
        Route::name('users.')->prefix('users')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('list');
            Route::get('/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
            Route::post('/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
             Route::post('/', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
            Route::get('/show/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('show');
            Route::get('/edit/{user}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
            Route::post('/edit/{user}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
             Route::post('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
        });
        
        Route::name('courses.')->prefix('courses')->group(function(){
            Route::get('/', 'Admin\CourseController@index')->name('index');
            Route::post('/', 'Admin\CourseController@index')->name('index');
            Route::post('/update/status', 'Admin\CourseController@status')->name('status');
            Route::get('/create', 'Admin\CourseController@create')->name('create');
            Route::post('/store', 'Admin\CourseController@store')->name('store');
            Route::get('/show/{course}', 'Admin\CourseController@show')->name('show');
            Route::get('/edit/{id}', 'Admin\CourseController@edit')->name('edit');
            Route::post('/update/{id}', 'Admin\CourseController@update')->name('update');
            Route::get('/delete/{id}', 'Admin\CourseController@destroy')->name('destroy');
        });
    
        // Facility routes 
        Route::name('assignments.')->prefix('assignments')->group(function(){
            Route::get('/', 'Admin\AssignmentController@index')->name('index');
            Route::get('/create', 'Admin\AssignmentController@create')->name('create');
            Route::post('/store', 'Admin\AssignmentController@store')->name('store');
            Route::get('/edit/{slug}', 'Admin\AssignmentController@edit')->name('edit');
            Route::post('/update/{id}', 'Admin\AssignmentController@update')->name('update');
            Route::get('/delete/{id}', 'Admin\AssignmentController@destroy')->name('destroy');
            Route::post('/update/featured', 'Admin\AssignmentController@featured')->name('featured');
        });
        Route::name('contents.')->prefix('contents')->group(function(){
            Route::get('/', 'Admin\ContentController@index')->name('index');
            Route::get('/create', 'Admin\ContentController@create')->name('create');
            Route::post('/store', 'Admin\ContentController@store')->name('store');
            Route::get('/edit/{slug}', 'Admin\ContentController@edit')->name('edit');
            Route::post('/update/{id}', 'Admin\ContentController@update')->name('update');
            Route::get('/delete/{id}', 'Admin\ContentController@destroy')->name('destroy');
            Route::post('/update/featured', 'Admin\ContentController@featured')->name('featured');
        });
    });
});

Route::group(['middleware'=>['auth','role:student']], function(){
    Route::name('student.')->prefix('student')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\StudentController::class, 'student_dashboard'])->name('student-dashboard');
        Route::get('/edit-profile', function(){
            return view('student.edit-profile');
        })->name('edit-profile-form');
        Route::post('/update-profile', [\App\Http\Controllers\StudentController::class, 'updateDetails'])->name('update-profile');
        Route::post('/update-password', [\App\Http\Controllers\StudentController::class, 'updatePassword'])->name('update-password');

    });
});

Route::group(['middleware'=>['auth','role:teacher']], function(){
    Route::name('teacher.')->prefix('teacher')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\TeacherController::class, 'teacher_dashboard'])->name('teacher-dashboard');
        Route::get('/edit-profile', function(){
            return view('teacher.edit-profile');
        })->name('edit-profile-form');
        Route::get('submitted-assignments', [\App\Http\Controllers\TeacherController::class, 'submitted_assignments'])->name('submitted-assignments');
        Route::post('/update-profile', [\App\Http\Controllers\TeacherController::class, 'updateDetails'])->name('update-profile');
        Route::post('/update-password', [\App\Http\Controllers\TeacherController::class, 'updatePassword'])->name('update-password');

    });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
