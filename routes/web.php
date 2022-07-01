<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard',compact('users'));
    })->name('dashboard');
    Route::get('/kategori/all',[KategoriController::class,'index'])->name('kategori-all');
    Route::post('/kategori/store',[KategoriController::class,'store'])->name('kategori-store');
    Route::get('/kategori/edit/{id}',[KategoriController::class,'edit']);
    Route::post('/kategori/update/{id}',[KategoriController::class,'update']);
    Route::get('/kategori/softdelete/{id}',[KategoriController::class,'softdelete']);
    Route::get('/kategori/restore/{id}',[KategoriController::class,'restore']);
    Route::get('/kategori/permadelete/{id}',[KategoriController::class,'permadelete']);

        ////// Produk Route /////
    Route::get('/produk/all',[ProdukController::class,'index'])->name('produk-all');
    Route::post('/produk/store',[ProdukController::class,'store'])->name('produk-store');
    Route::get('/produk/edit/{id}',[ProdukController::class,'edit']);
    Route::get('/produk/delete/{id}',[ProdukController::class,'delete']);
    Route::post('/produk/update/{id}',[ProdukController::class,'update']);
});
