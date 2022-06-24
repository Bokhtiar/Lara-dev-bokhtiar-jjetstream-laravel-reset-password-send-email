<?php

use App\Http\Controllers\Student\LessionController;
use App\Http\Controllers\Teacher\CourseController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::get('/', function () {
  $divisions =  DB::table('divisions')->where('status',1)->get();
  dd($divisions);
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as' => 'student.'], function() {
        Route::get('/dashboard', [LessionController::class, 'index']);
        //Route::resource('lessons', \App\Http\Controllers\Student\LessionController::class);
    });
   Route::group(['middleware' => 'role:teacher', 'prefix' => 'teacher', 'as' => 'teacher.'], function() {
    Route::get('/dashboard', [CourseController::class, 'index']);
    //Route::resource('courses', \App\Http\Controllers\Teacher\CourseController::class);
   });
    Route::group(['middleware' => 'role:user', 'prefix' => 'user', 'as' => 'user.'], function() {
        Route::get('/dashboard', [UserController::class, 'index']);
        //Route::resource('users', \App\Http\Controllers\User\UserController::class);
    });
});
