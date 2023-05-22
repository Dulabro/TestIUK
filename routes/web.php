<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;

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

Route::get('/', function () {
    // if(auth()->user()){
    //     auth()->user()->assignRole('admin');
    // } 
    return view('welcome');
});

Route::get('/test',function(){
    if(DB::connection()->getDatabaseName())
    {
        echo "Yes! successfully connected to the DB: " . DB::connection()->getDatabaseName();
    }
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::post('/change-photo', [App\Http\Controllers\ChangePasswordController::class, 'update'])->name('profile.update');
Route::post('/change-password', [App\Http\Controllers\ChangePasswordController::class, 'store'])->name('change-password');
Route::delete('/courses/{id}/members', [CourseController::class, 'deleteUsers'])->name('deleteUser')->middleware('auth');
Route::get('/course', [App\Http\Controllers\CourseController::class, 'course'])->name('course')->middleware('auth');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses')->middleware('auth');
Route::get('courses/{cours}', [App\Http\Controllers\CourseController::class, 'show'])->name('courses.show')->middleware('auth');
Route::match(['GET', 'POST'], '/courses', [CourseController::class, 'store'])->middleware('auth');
Route::get('/lectures/create', [LectureController::class, 'create'])->name('lectures_create')->middleware('auth');
Route::match(['GET', 'POST'], '/lectures', [LectureController::class, 'store'])->middleware('auth');
Route::get('courses/lecture/{lecture}', [App\Http\Controllers\LectureController::class, 'show'])->name('lectures.show')->middleware('auth');
Route::match(['GET', 'POST'], '/codecourse', [HomeController::class, 'store'])->middleware('auth');
Route::get('/tests/create', [TestController::class, 'create'])->name('tests_create')->middleware('auth');
Route::match(['GET', 'POST'],'/test', [TestController::class, 'store'])->name('tests.store')->middleware('auth');
Route::get('/tests', [TestController::class, 'index'])->name('tests.index')->middleware('auth');
// Route::get('courses/lecture/test/{test}', [App\Http\Controllers\TestController::class, 'show'])->name('test')->middleware('auth');
Route::get('/test/{id}', [TestController::class, 'show'])->name('test.show')->middleware('auth');

Route::post('/test/calculateValue/{id}', [TestController::class, 'calculateValue'])->name('test.calculateValue')->middleware('auth');
Route::delete('lectures/{id}', [App\Http\Controllers\LectureController::class, 'destroy'])->name('lectures.destroy')->middleware('auth');
Route::get('courses/lecture/{lecture}/edit', [App\Http\Controllers\LectureController::class, 'edit'])->name('lectures.edit')->middleware('auth');
Route::put('courses/lecture/{lecture}', [App\Http\Controllers\LectureController::class, 'update'])->name('lectures.update');
Route::delete('courses/{id}', [App\Http\Controllers\CourseController::class, 'destroy'])->name('courses.destroy')->middleware('auth');
Route::get('/courses/{id}/members', [App\Http\Controllers\CourseController::class, 'members'])->name('courses.members')->middleware('auth');