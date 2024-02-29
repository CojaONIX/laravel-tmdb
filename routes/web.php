<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\tmdbController;

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

Route::view('/', 'home')->name('home.page');
Route::view('/about', 'about')->name('about.page');
Route::view('/welcome', 'welcome')->name('welcome.page');

Route::get('/{media}/details/{id}', [tmdbController::class, 'getMediaDetails'])->name('media.details');

Route::get('/movie', [tmdbController::class, 'getMovieGroup'])->name('movie');
Route::get('/movie/details/{movie}', [tmdbController::class, 'getMovieDetails'])->name('movie.details');
Route::get('/movie/search', [tmdbController::class, 'getMovieSearch'])->name('movie.search');

Route::get('/tv', [tmdbController::class, 'getTvGroup'])->name('tv');
Route::get('/tv/details/{tv}', [tmdbController::class, 'getTvDetails'])->name('tv.details');
Route::get('/tv/search', [tmdbController::class, 'getTvSearch'])->name('tv.search');

Route::get('/test', [TestController::class, 'showTest'])->name('test.page');
Route::post('/test', [TestController::class, 'ajaxGetTestData']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
