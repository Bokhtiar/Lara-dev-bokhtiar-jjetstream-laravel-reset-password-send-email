<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SMScontroller;
use App\Http\Controllers\Student\LessionController;
use App\Http\Controllers\Teacher\CourseController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/redirect', [LoginController::class, 'redirectToProvider']);
Route::get('/callback', [LoginController::class, 'handleProviderCallback']);



Route::get('/', function () {
  $divisions =  DB::table('divisions')->where('status',1)->get();
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

Route::get('send-mail', function () {
    $details = [
    'title' => 'Mail from localhost.com',
    'body' => 'This is for testing email using smtp'
    ];
    \Mail::to('bokhtiar.swe@gmail.com')->send(new \App\Mail\TestMail($details));
    dd("Email is Sent.");
    });



Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as' => 'student.'], function() {
        Route::get('/dashboard', [LessionController::class, 'index']);
    });
   Route::group(['middleware' => 'role:teacher', 'prefix' => 'teacher', 'as' => 'teacher.'], function() {
    Route::get('/dashboard', [CourseController::class, 'index']);
   });
    Route::group(['middleware' => 'role:user', 'prefix' => 'user', 'as' => 'user.'], function() {
        Route::get('/dashboard', [UserController::class, 'index']);
    });
});

Route::get('sendSMS', [SMScontroller::class, 'index']);
