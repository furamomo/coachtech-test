<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

//お問い合わせ入力画面
Route::get('/', [ContactController::class, 'index'])->name('contact.index');

//確認画面
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

Route::post('/contact/back', [ContactController::class, 'back'])->name('contact.back');


Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');


//会員登録画面
Route::post('/register', [RegisterController::class, 'store'])->name('register');

//ログイン画面
Route::post('/login', [LoginController::class, 'store'])->name('login');


// 管理画面表示
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin');

// 検索
Route::get('/search', [AdminController::class, 'search'])
    ->middleware('auth')
    ->name('admin.search');

// リセット
Route::get('/reset', function () {
    return redirect('/admin');
})->middleware('auth')->name('admin.reset');

// 削除
Route::delete('/delete/{id}', [AdminController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.delete');

// エクスポート（CSV）
Route::get('/export', [AdminController::class, 'export'])
    ->middleware('auth')
    ->name('admin.export');

// ログアウト
Route::get('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
