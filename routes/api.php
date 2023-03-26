<?php

use App\Http\Controllers\MethodCallController;
use App\Http\Controllers\MethodController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('method')->group(function () {
    Route::apiResource('/call', MethodCallController::class)->only(['store']);
    Route::get('/statistic/{method}', [MethodController::class, 'getMethodStatistic']);
})->apiResource('/method', MethodController::class);
