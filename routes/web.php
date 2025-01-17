<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RyokanController;

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

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Auth::routes();

// 投稿に関する処理だけを扱う
Route::resource('posts', 'PostController');

Route::group(['middleware' => 'auth'], function() {

    // マイページ専用の処理
    Route::resource('mypage', 'MypageController')->only(['index']);

    // アカウント関連の処理
    Route::get('accounts/{account}/delete', [AccountController::class, 'delete'])->name('accounts.delete');
    Route::resource('accounts', 'AccountController')->only([
        'edit', 'update', 'destroy'
    ]);

    // 予約関連の処理
    // Route::get('reservations/inn/confirm', [ReservationController::class, 'confirm'])->name('reservations.inn.confirm');
    Route::resource('reservations', 'ReservationController')->except(['index']);

    // 違反報告の処理
    Route::resource('reports', 'ReportController')->only(['create', 'store']);

});

// 管理者用ダッシュボード
Route::group(['middleware' => ['auth', 'role:0']], function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
});

Route::prefix('admin')->group(function () {
    Route::get('admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('users', 'AdminUserController', ['as' => 'admin']);   // admin.users.index
    Route::resource('posts', 'AdminPostController', ['as' => 'admin']);   // admin.posts.index
    Route::patch('users/{user}/suspend', [AdminUserController::class, 'suspend'])->name('admin.users.suspend');
    Route::patch('users/{user}/resume', [AdminUserController::class, 'resume'])->name('admin.users.resume');
    Route::patch('posts/{post}/suspend', [AdminPostController::class, 'suspend'])->name('admin.posts.suspend');
    Route::patch('posts/{post}/resume', [AdminPostController::class, 'resume'])->name('admin.posts.resume');
});

// 一般ユーザー用ホームページ
Route::group(['middleware' => ['auth', 'role:1']], function () {
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
});

// 旅館運営ユーザー用ダッシュボード
Route::group(['middleware' => ['auth', 'role:2']], function () {
    Route::get('/ryokan/index', [RyokanController::class, 'index'])->name('ryokan.index');
});


