<?php

use App\Http\Controllers\DashboardController;
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

Route::get('/{date?}', [DashboardController::class, 'show'])
    ->name('dashboard')
    ->where("date", '[a-zA-Z0-9\-]+');

Route::post('/{date}', [DashboardController::class, 'process'])
    ->name("dashboard_process");
