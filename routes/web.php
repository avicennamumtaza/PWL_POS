<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/kategori/create', [KategoriController::class, 'create']);
// Route::post('/kategori', [KategoriController::class, 'store']);
// Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
// Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
// Route::get('/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');

// Route::prefix('/level')->group(function () {
//     Route::get('/', [LevelController::class, 'index']);
//     Route::get('/create', [LevelController::class, 'create']);
//     Route::post('/', [LevelController::class, 'store']);
//     Route::get('/edit/{id}', [LevelController::class, 'edit'])->name('m_level.edit_level');
//     Route::put('/update/{id}', [LevelController::class, 'update'])->name('m_level.update_level');
//     Route::get('/delete/{id}', [LevelController::class, 'destroy'])->name('m_level.delete_level');
// });

// Route::prefix('/user')->group(function () {
//     Route::get('/', [UserController::class, 'index']);
//     Route::get('/create', [UserController::class, 'create']);
//     Route::post('/', [UserController::class, 'store']);
//     Route::get('/edit/{id}', [UserController::class, 'edit'])->name('m_user.edit_user');
//     Route::put('/update/{id}', [UserController::class, 'update'])->name('m_user.update_user');
//     Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('m_user.delete_user');
// });

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah error
    Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [LevelController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [LevelController::class, 'create']); // menampilkan halaman form tambah error
    Route::post('/', [LevelController::class, 'store']); // menyimpan data user baru
    Route::get('/{id}', [LevelController::class, 'show']); // menampilkan detail user
    Route::get('/{id}/edit', [LevelController::class, 'edit']); // menampilkan halaman form edit user
    Route::put('/{id}', [LevelController::class, 'update']); // menyimpan perubahan data user
    Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [KategoriController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [KategoriController::class, 'create']); // menampilkan halaman form tambah error
    Route::post('/', [KategoriController::class, 'store']); // menyimpan data user baru
    Route::get('/{id}', [KategoriController::class, 'show']); // menampilkan detail user
    Route::get('/{id}/edit', [KategoriController::class, 'edit']); // menampilkan halaman form edit user
    Route::put('/{id}', [KategoriController::class, 'update']); // menyimpan perubahan data user
    Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [BarangController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [BarangController::class, 'create']); // menampilkan halaman form tambah error
    Route::post('/', [BarangController::class, 'store']); // menyimpan data user baru
    Route::get('/{id}', [BarangController::class, 'show']); // menampilkan detail user
    Route::get('/{id}/edit', [BarangController::class, 'edit']); // menampilkan halaman form edit user
    Route::put('/{id}', [BarangController::class, 'update']); // menyimpan perubahan data user
    Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'stok'], function () {
    Route::get('/', [StokController::class, 'index']); 
    Route::post('/list', [StokController::class, 'list']); 
    Route::get('/create', [StokController::class, 'create']); 
    Route::post('/', [StokController::class, 'store']); 
    Route::get('/{id}', [StokController::class, 'show']); 
    Route::get('/{id}/edit', [StokController::class, 'edit']); 
    Route::put('/{id}', [StokController::class, 'update']); 
    Route::delete('/{id}', [StokController::class, 'destroy']); 
});

Route::group(['prefix' => 'penjualan'], function () {
    Route::get('/', [PenjualanController::class, 'index'])->name('penjualan');
    Route::post('/list', [PenjualanController::class, 'list']);
    Route::get('/create', [PenjualanController::class, 'create']);
    Route::post('/', [PenjualanController::class, 'store']);
    Route::get('/{id}', [PenjualanController::class, 'show']);
    Route::delete('/{id}', [PenjualanController::class, 'destroy']);
});

Route::resource('m_user', PosController::class);
Route::get('/', [WelcomeController::class, 'index']);