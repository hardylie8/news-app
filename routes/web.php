<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\News\CreateNews;
use App\Http\Livewire\News\EditNews;
use App\Http\Livewire\News\NewsIndex;
use App\Http\Livewire\News\ShowNews;
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
});


Route::get('/news', NewsIndex::class)->name('web.news.index');
Route::get('/news/create', CreateNews::class)->name('web.news.create');
Route::get('/news/{news}', ShowNews::class);
Route::get('/news/{news}/edit', EditNews::class)->name('web.news.edit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
