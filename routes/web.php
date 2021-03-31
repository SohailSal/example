<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Word;
use App\Http\Controllers\Excel;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::get('posts', [PostController::class, 'index'])
    ->name('posts')
    ->middleware('auth');

Route::get('posts/create', [PostController::class, 'create'])
    ->name('posts.create')
    ->middleware('auth');

Route::get('posts/{post}', [PostController::class, 'show'])
    ->name('posts.show')
    ->middleware('auth');

Route::post('posts', [PostController::class, 'store'])
    ->name('posts.store')
    ->middleware('auth');

Route::get('posts/{post}/edit', [PostController::class, 'edit'])
    ->name('posts.edit')
    ->middleware('auth');

Route::put('posts/{post}', [PostController::class, 'update'])
    ->name('posts.update')
    ->middleware('auth');

Route::delete('posts/{post}', [PostController::class, 'destroy'])
    ->name('posts.destroy')
    ->middleware('auth');

Route::get('/word', Word::class)->name('word')->middleware('auth');
Route::get('/excel', Excel::class)->name('excel')->middleware('auth');

Route::get('/create/user','UserController@create');
Route::get('/update/user/{user}','UserController@edit');
Route::get('/delete/user/{user}','UserController@destroy');