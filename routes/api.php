<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\StateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/partners', PartnerController::class)->name('partners');
Route::get('/countries', CountryController::class)->name('countries');
Route::get('/states', StateController::class)->name('states');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
