<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\News\CreateNews;
use App\Http\Livewire\News\EditNews;
use App\Http\Livewire\News\NewsIndex;
use App\Http\Livewire\News\ShowNews;
use App\Http\Livewire\Tags\CreateTag;
use App\Http\Livewire\Tags\EditTag;
use App\Http\Livewire\Tags\ShowTag;
use App\Http\Livewire\Tags\TagIndex;
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
    if (Auth::check()) {
        return redirect('/dashboard');
    } else {
        return view('auth.login');
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:web')->group(function () {

    Route::get('/news', NewsIndex::class)->name('web.news.index');
    Route::get('/news/create', CreateNews::class)->name('web.news.create');
    Route::get('/news/{news}', ShowNews::class);
    Route::get('/news/{news}/edit', EditNews::class)->name('web.news.edit');

    Route::get('/tag', TagIndex::class)->name('web.tag.index');
    Route::get('/tag/create', CreateTag::class)->name('web.tag.create');
    Route::get('/tag/{tag}', ShowTag::class)->name('web.tag.show');
    Route::get('/tag/{tag}/edit', EditTag::class)->name('web.tag.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

if (file_exists(app_path('Http/Livewire/LocalizationController.php'))) {
    Route::get('lang/{locale}', [App\Http\Livewire\LocalizationController::class, 'boot']);
}

require __DIR__ . '/auth.php';
