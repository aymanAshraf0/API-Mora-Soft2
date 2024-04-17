<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
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

Route::get('/dashboard', function () {
    $post1 = Post::get();
    return view('posts.index',compact('post1'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/index', [PostController::class, 'index'])->name('posts.index');
    Route::post('/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/destroy/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});

require __DIR__.'/auth.php';
