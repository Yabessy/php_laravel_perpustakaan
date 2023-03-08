<?php

use App\Http\Controllers\admin\BookController as AdminBookController;
use App\Http\Controllers\admin\LendingController as AdminLendingController;
use App\Http\Controllers\admin\LibrarianController;
use App\Http\Controllers\admin\MemberController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserCommentController;
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
})->name('home');

Route::get('/daftar_buku', [BookController::class, 'index']);
Route::get('/daftar_buku/{book}', [BookController::class, 'show']);
Route::get('/daftar_buku/tipe/{type}', [BookController::class, 'type']);

Route::middleware('guest')->group(function () {
    Route::view('/register', 'register')->name('register');
    Route::post('/register', [AuthController::class, 'store']);

    Route::view('/login', 'login')->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::post('/comment', [UserCommentController::class, 'store']);
    
    Route::get('/laporan', [ReportController::class, 'create']);
    Route::post('/laporan', [ReportController::class, 'store']);

    Route::post('lending', [LendingController::class, 'store']);
    Route::patch('lending', [LendingController::class, 'update']);

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/history/{type?}', [LendingController::class, 'show'])->name('history');

    Route::middleware('superuser')->prefix('/admin')->name('admin.')->group(
        function () {
            Route::get(
                '/dashboard',
                function () {
                        return view('admin');
                    }
            );
            Route::middleware('admin')->group(
                function () {
                        Route::resource('/librarian', LibrarianController::class)->except('show', 'edit', 'update');
                    }
            );
            Route::middleware('librarian')->group(
                function () {
                        Route::resource('/lendings', AdminLendingController::class)->except('update');
                        Route::patch('/lendings', [AdminLendingController::class, 'update']);
                        Route::resource('/books', AdminBookController::class);
                        Route::get('books/types/{type}', [AdminBookController::class, 'type']);
                        Route::resource('/members', MemberController::class);
                        Route::get('/reports', [ReportController::class, 'index']);
                    }
            );
        }
    );
});