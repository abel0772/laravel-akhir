<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
/*
|----------------------------------------------------------------------
----
| Web Routes
|----------------------------------------------------------------------
----
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
    Route::get('/', function () {
        return view('welcome');
    });
    //Route::get('login',[Controller::class,'login']);
    Route::get('/login', [Controller::class, 'login'])->name('login');
    Route::post('/login', [Controller::class, 'login']); // Memproses login

    Route::get('/dashboard', function () {
        return 'Selamat datang di Dashboard!';
    })->middleware('auth'); 

    Route::get('barangdata',[Controller::class,'barangdata']);
    Route::get('baranginsert',[Controller::class,'baranginsert']);
    Route::get('barangupdate',[Controller::class,'barangupdate']);
    Route::get('barangdelete',[Controller::class,'barangdelete']);
