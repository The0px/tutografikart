<?php

use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

$idRegex = '[0-9]+';
$slugRegex = '[a-z0-9\-]+';

Route::get('/', [HomeController::class, 'index']);
Route::get('/biens', [PropertyController::class, 'index'])->name('property.index');
Route::get('/biens/{slug}-{property}', [PropertyController::class, 'show'])->name('property.show')->where([
    'property' => $idRegex,
    'slug' => $slugRegex,
]);
Route::post('/biens/{property}/contact', [PropertyController::class, 'contact'])->name('property.contact')->where([
    'property' => $idRegex,
]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth', 'verified')->name('dashboard');

Route::get('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::delete('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {

    Route::resource('property', AdminPropertyController::class)->except(['show']);
    Route::resource('option', OptionController::class)->except(['show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
