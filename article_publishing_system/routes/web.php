<?php

use App\Http\Controllers\ArticleController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        return 'Database connection is successful!';
    } catch (\Exception $e) {
        return 'Could not connect to the database. Error: ' . $e->getMessage();
    }
});

Auth::routes();

// Authentication Routes
    //User Routes
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');



    //Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/articles', [ArticleController::class, 'adminIndex'])->name('admin.articles.index');
});
Route::get('/admin/articles', [ArticleController::class, 'adminIndex'])->name('admin.articles.index')->middleware('admin');
// Profile Route
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Article routes
Route::resource('articles', \App\Http\Controllers\ArticleController::class);

