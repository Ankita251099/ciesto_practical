<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SpinController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\profilecontroller;
use App\Http\Controllers\Api\Bankcontroller;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\userbalanceController;
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
// php artisan db:seed --class=ShopSeeder
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('spin_view',[SpinController::class, 'show']);
Route::post('spin',[SpinController::class, 'index']);

Route::post('login',[LoginController::class,'store']);

Route::post('editprofile',[profilecontroller::class,'editProfile']);

Route::post('addbank',[Bankcontroller::class,'store']);

Route::post('addamount',[TransactionController::class,'addamount']);
Route::post('transactionhistroy',[TransactionController::class,'TransactionHistroy']);
Route::post('addUpi',[Bankcontroller::class,'UpiIds']);


Route::post('checkmobile',[LoginController::class,'checkMobilenumber']);

Route::post('getbalance',[userbalanceController::class,'getBalance']);

