<?php

use App\Http\Controllers\UserController;
use  App\Http\Controllers\RouteController;
use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;

Route::get('/result', function () {
    return view('result');
});
Route::get('/', function () {
    return view('login_register');
})->name('login_index');
Route::POST('/register',[UserController::class,'register'])->name('register');
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::POST('/login',[UserController::class,'login'])->name('login');
Route::get('/home',[RouteController::class ,'index'])->name('home') ;
route::get('/organization',[RouteController::class, 'organization'])->name('organization');
Route::post('/Candidate', [CandidateController::class, 'store'])->name('add_Candidate');
Route::post('/update', [CandidateController::class, 'update'])->name('update'); 