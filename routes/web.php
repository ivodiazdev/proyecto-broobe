<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageSpeedController;
use App\Http\Controllers\MetricHistoryController;

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

Route::get('/', [PageSpeedController::class, 'index']);
Route::get('/history', [MetricHistoryController::class, 'index']);
Route::post('/analizar', [PageSpeedController::class, 'analyze'])->name('analizar.url');
Route::post('/guardarMetrica', [MetricHistoryController::class, 'saveMetric'])->name('guardarMetrica.url');