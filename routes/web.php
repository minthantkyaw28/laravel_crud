<?php

use App\Http\Controllers\PostController;
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

// Route::get('/', function () {
//     return view('create');
// });

Route::get('/', [PostController::class, 'create'])->name('post#home');
Route::get('/customer/createPage', [PostController::class, 'create'])->name('post#createPage');
Route::post('/post/create', [PostController::class, 'postCreate'])->name('post#create');

// Route::get('/post/delete/{id}',[PostController::class,'postDelete'])->name('post#delete');
Route::delete('/post/delete/{id}',[PostController::class,'postDelete'])->name('post#delete');


Route::get('post/updatePage',[PostController::class,'updatePage'])->name('post#UpdatePage');
Route::get('post/updatePage/{id}',[PostController::class,'updatePage'])->name('post#UpdatePage');

Route::get('post/editPage/{id}',[PostController::class,'editPage'])->name('post#EditPage');

Route::post('post/update',[PostController::class,'update'])->name('post#update');
