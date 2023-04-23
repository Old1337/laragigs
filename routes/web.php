<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\ListingController;
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



Route::controller(ListingController::class)->group(function () {

    Route::get('/', 'index');

    Route::get('/listings/create', 'create');

    Route::post('/listings', 'store');

    Route::get('/listings/{listing}', 'show');
});
