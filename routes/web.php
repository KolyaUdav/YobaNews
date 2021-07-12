<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostsController;
use App\Http\Controllers\IndexPageController;

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

Route::get('/', [IndexPageController::class, 'showNewPosts']);

Route::delete('/posts/{id}/delete-only-image', [PostsController::class, 'deleteOnlyImage']);
Route::resource('posts', PostsController::class);
