<?php


use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/', '/login');

Route::get('/admin', function () {
    return view('layouts/sidebar');
});

Route::prefix('admin')->middleware('adminUsers')->group( function () {
    Route::resources([
        'posts' => PostController::class,
        'roles' => RoleController::class,
        'categories' =>CategoryController::class,
        'tags' => TagController::class,
        'users'=> UserController::class,
        'comments' =>CommentController::class
    ]);
});


