<?php

use App\Http\Controllers\Admin\Comment\CommentController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\ProfileController;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin/')->group(function () {

    require __DIR__ . '/auth.php';

    Route::middleware(['auth', 'verified'])->name('admin.')->group(function () {

        Route::resource('users', UserController::class);
        Route::resource('comments', CommentController::class);

        Route::post('/comments/reply/{comment}', [CommentController::class, 'reply'])->name('comments.reply');
        Route::get('/log/activities', [LogActivityController::class, 'index'])->name('log.activities');
        Route::view('/dashboard', 'admin.main')->name('dashboard');
    });

});

