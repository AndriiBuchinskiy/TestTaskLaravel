<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class,'register']);
Route::post('/logout', [AuthController::class,'logout']);

Route::resources([
    'posts' => PostController::class,
]);



Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/{id}', [PostController::class,'show']);
Route::get('/posts/{id}/comments', [CommentController::class,'index']);
Route::post('/posts/{id}/comments', [CommentController::class,'store']);
Route::get('/posts/{id}', [PostController::class,'show']);
Route::put('/posts/{id}', [PostController::class,'update']);
Route::delete('/posts/{id}', [PostController::class,'destroy']);
Route::delete('/posts/{id}', [PostController::class,'destroy']);
Route::get('/posts/categories',[PostController::class,'indexC']);


Route::get('/comments', [CommentController::class,'index']);
Route::post('/comments', [CommentController::class,'store']);
Route::get('/comments/{id}', [CommentController::class,'show']);
Route::put('/comments/{id}', [CommentController::class,'update']);
Route::delete('/comments/{id}', [CommentController::class,'destroy']);

Route::get('/categories',[CategoryController::class,'index']);
Route::get('/tags',[TagController::class,'index']);