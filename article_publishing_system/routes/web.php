<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Auth::routes();

// Authentication Routes
    //User Routes
Route::get('/', [ArticleController::class, 'dashboard'])->name('home')->middleware('auth');



    //Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/articles', [ArticleController::class, 'adminIndex'])->name('admin.articles.index');
});
Route::get('/admin/articles', [ArticleController::class, 'adminIndex'])->name('admin.articles.index')->middleware('admin');
Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'allUsers'])->name('admin.users.index');
// Profile Route
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Article routes
Route::resource('articles', \App\Http\Controllers\ArticleController::class);

//Reseting password Controllers
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request')->middleware('guest');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('guest');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
