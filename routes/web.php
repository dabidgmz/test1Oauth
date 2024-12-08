<?php

use App\Http\Controllers\Auth\GoogleController;
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

Route::get('/login', function () { return view('login'); })->name('login.form');
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogLeController::class, 'handleGoogleCallback'])->name ('google.callback');
Route::get('welcome', function () { return view('welcome'); })->name ('welcome');