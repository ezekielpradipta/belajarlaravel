<?php

use App\Http\Controllers\KategoriController;
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
});
