<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UjiCoba;
use App\Models\DataPenduduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// kita cek dulu views blade yang sudah kita buat
Route::get('/ceklayouts', function () {
    return view('admin.layouts');
});
Route::get('/cekcreate', function () {
    return view('admin.create');
});
Route::get('/cekshow', function () {
    return view('admin.show');
});
Route::get('/cekedit', function () {
    return view('admin.edit');
});
Route::get('/ceklogin', function () {
    return view('auth.login');
});
Route::get('/cekregister', function () {
    return view('auth.register');
});


// buat route dengan resource agar bisa langsung dibuatkan semua route dengan class nya masing2
Route::resource('data',DataController::class)->middleware('belomlogin');


// uji coba buat route 1 per 1 (Data Controller)
// Route::get('data',[DataController::class,'index']);

// Uji coba dengan UjiCoba Controller
// Route::get('cobaindex',[UjiCoba::class,'CobaIndex']);
Route::middleware(['dahlogin'])->group(function () {
    // ...
    Route::get('auth',[AuthController::class,'formlog']);
Route::post('/auth/login',[AuthController::class,'login']);
Route::get('/auth/formregister',[AuthController::class,'formregis']);
Route::post('/auth/register',[AuthController::class,'register']);
});

Route::get('/auth/logout',[AuthController::class,'logout']);

