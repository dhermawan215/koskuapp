<?php

use App\Http\Controllers\API\KontrakanRestController;
use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\API\TransactionRestController;
use App\Http\Controllers\API\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('kontrakans', [KontrakanRestController::class, 'all']);
Route::get('recomendedkost', [KontrakanRestController::class, 'recomendedKost']);
Route::get('popularkost', [KontrakanRestController::class, 'popularKost']);
Route::get('newkost', [KontrakanRestController::class, 'newKost']);
Route::get('generalkost', [KontrakanRestController::class, 'generalKost']);

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('logout', [UserController::class, 'logout']);

    Route::get('transaction', [TransactionRestController::class, 'all']);
    Route::get('transaction/{id}', [TransactionRestController::class, 'update']);
    Route::post('checkout', [TransactionRestController::class, 'checkout']);
    Route::post('checkoutAuto', [TransactionRestController::class, 'checkoutAuto']);
});

Route::post('midtrans/callback', [MidtransController::class, 'callback']);
