<?php

use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/biens', [PropertyController::class, 'index']);
Route::get('/weather', [WeatherController::class, 'index']);
