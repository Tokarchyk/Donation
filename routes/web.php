<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/donation', [DonationController::class, 'index'])->name('donation.index');
// Route::get('/donation-form', [DonationController::class, 'show'])->name('donation-form.show');
Route::post('/store', [DonationController::class, 'store'])->name('donation.store');
// Route::get('/donation', [DonationController::class, 'search'])->name('donation.search');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
