<?php

use App\Livewire\Counter;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\KaryawanController;
use App\Livewire\Menu\Index;

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

Route::get('/counter', Counter::class);

Route::get('/', function () {
    return view('layouts.user.master');
});

Route::get('/tes', function () {
    return view('admin.toko.index');
});
// Route::get('/rumah', function () {
//     return view('layouts.master');
// });

Auth::routes();


//Login FB
Route::controller(FacebookController::class)->group(function () {
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});

//Login Google
Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::group(['middleware' => ['isLogin']], function () {
    // Akses Super Admin
    Route::get('/dashboard', [HomeController::class, 'index2']);
    // Route::group(['middleware' => ['checkRole:super_admin']], function () {
    //Kelola_resto
    Route::get('/kelola_toko', [TokoController::class, 'index'])->name('kelola-toko');
    Route::get('/toko/getdata/{id}', [TokoController::class, 'getdata'])->name('getdatatoko');
    Route::post('/toko/input', [TokoController::class, 'store'])->name('toko-input');
    Route::post('/toko/update', [TokoController::class, 'update'])->name('update-toko');
    Route::get('/toko/hapus/{id}', [TokoController::class, 'destroy'])->name('hapus-toko');
    Route::get('/changeOperasional', [TokoController::class, 'changeOperasional'])->name('changeOperasional');
    //Kelola_user
    Route::get('/kelola_user', [UserController::class, 'index'])->name('kelola-user');
    Route::get('/user/getdata/{id}', [UserController::class, 'getdata'])->name('getdatauser');
    Route::post('/user/input', [UserController::class, 'store'])->name('user-input');
    Route::post('/user/update', [UserController::class, 'update'])->name('update-user');
    Route::get('/user/hapus/{id}', [UserController::class, 'destroy'])->name('hapus-user');
    // });

    // Route::group(['middleware' => ['checkRole:admin']], function () {
    // Route::get('/dashboard', [HomeController::class, 'index2']);
    Route::get('/kelola_karyawan_toko', [KaryawanController::class, 'index']);
    Route::get('/karyawan_toko/getdata/{id}', [KaryawanController::class, 'getdata']);
    Route::post('/karyawan_toko/input', [KaryawanController::class, 'store']);
    Route::post('/karyawan_toko/update', [KaryawanController::class, 'update']);
    Route::get('/karyawan_toko/hapus/{id}', [KaryawanController::class, 'destroy']);

    Route::get('/changeOperasional', [TokoController::class, 'changeOperasional'])->name('changeOperasional');

    Route::get('/kelola_meja', [MejaController::class, 'index']);
    Route::get('/meja/getdata/{id}', [MejaController::class, 'getdata']);
    Route::post('/meja/input', [MejaController::class, 'store']);
    Route::post('/meja/update', [MejaController::class, 'update']);
    Route::get('/meja/hapus/{id}', [MejaController::class, 'destroy']);
    // });

    // Route::group(['middleware' => ['checkRole:dapur']], function () {
    Route::get('/kelola_menu', [MenuController::class, 'index']);
    Route::get('/menu/getdata/{id}', [MenuController::class, 'getdata']);
    Route::post('/menu/input', [MenuController::class, 'store']);
    Route::post('/menu/update', [MenuController::class, 'update']);
    Route::get('/menu/hapus/{id}', [MenuController::class, 'destroy']);
    // });

    // Akses User
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/input', [ProfileController::class, 'store']);
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword']);
    Route::post('/upload/avatar', [ProfileController::class, 'updateAvatar'])->name('upload.avatar');
    // Route::get('/menu/toko/{id}', [HomeController::class, 'menu'])->name('menu-toko');
    Route::get('/menu/toko/{id}', Index::class);
});
