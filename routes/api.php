<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DonationController as ApiDonationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::delete('/donations/{id}', [ApiDonationController::class, 'destroy']);
Route::get('/donations', [ApiDonationController::class, 'index']);
Route::get('/donations/widget', [ApiDonationController::class, 'getWidgetData']);
Route::post('/donations/store', [ApiDonationController::class, 'store']);
Route::get('/donations/job', [ApiDonationController::class, 'deleteOldDonations']);
