<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('menu', [MenuController::class, 'index']);

Route::get('unggulan/makan', [MenuController::class, 'unggulanMakan']);
Route::get('unggulan/minum', [MenuController::class, 'unggulanMinum']);
Route::get('unggulan/snack', [MenuController::class, 'unggulanSnack']);

Route::get('makanan', [MenuController::class, 'makanan']);
Route::get('minuman', [MenuController::class, 'minuman']);
Route::get('snack', [MenuController::class, 'snack']);

Route::post('transaction', [TransactionController::class, 'store']);
Route::post('bayar/{id}', [TransactionController::class, 'bayar']);

Route::get('keranjang', [TransactionDetailController::class, 'getById']);
Route::get('total/{id}', [TransactionDetailController::class, 'getTotal']);
Route::post('detail_transaction', [TransactionDetailController::class, 'store']);

