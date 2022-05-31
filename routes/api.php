<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SpinController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\profilecontroller;
use App\Http\Controllers\Api\Bankcontroller;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\userbalanceController;
use App\Http\Controllers\Api\TicketdetailsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[LoginController::class,'store']);
Route::post('checkmobile',[LoginController::class,'checkMobilenumber']);

Route::post('editprofile',[profilecontroller::class,'editProfile']);
Route::post('popupScreen',[profilecontroller::class,'popupScreen']);
Route::post('checkcouponcode',[profilecontroller::class,'checkCouponCode']);




Route::post('make_payment',[TransactionController::class,'makePayment']);
Route::post('wallet_transfer',[TransactionController::class,'wallet_transfer']);
Route::post('bank_transfer',[TransactionController::class,'bank_transfer']);
Route::post('addamount',[TransactionController::class,'addamount']);
Route::post('transactionhistroy',[TransactionController::class,'TransactionHistroy']);

Route::post('addbank',[Bankcontroller::class,'store']);
Route::post('addUpi',[Bankcontroller::class,'UpiIds']);
Route::post('getUPI',[Bankcontroller::class,'getUPI']);
Route::post('addpaytm',[Bankcontroller::class,'PaytmID']);
Route::post('getpaytm',[Bankcontroller::class,'getPaytm']);
Route::post('getBankDetails',[Bankcontroller::class,'getBankDetails']);
Route::post('getbank',[Bankcontroller::class,'getBank']);
Route::post('getbank',[Bankcontroller::class,'getBank']);
Route::post('referrallink',[Bankcontroller::class,'referrallink']);





Route::post('getbalance',[userbalanceController::class,'getBalance']);
Route::post('getreferalcode',[userbalanceController::class,'getReferalCode']);
Route::post('spinCount',[userbalanceController::class,'spinCount']);
Route::post('getSpinCount',[userbalanceController::class,'getSpinCount']);
Route::post('percentageCount',[userbalanceController::class,'percentageCount']);
Route::post('getpercentagecount',[userbalanceController::class,'getpercentageCount']);


Route::post('spin_view',[SpinController::class, 'show']);
Route::post('spin',[SpinController::class, 'index']);
Route::post('getvideo',[SpinController::class, 'videoGet']);
Route::post('addTicket',[SpinController::class,'addTicket']);
Route::post('getTicket',[SpinController::class,'getTicket']);
Route::post('getleaderboard',[SpinController::class,'GetLeaderboard']);
Route::post('getfaq',[SpinController::class,'getFaq']);
Route::post('getTerms',[SpinController::class,'getTerms']);
Route::post('getPolicy',[SpinController::class,'getPolicy']);
Route::post('getReference',[SpinController::class,'getreference']);
Route::post('getSplashScreen',[SpinController::class,'getsplashscreen']);
Route::post('spinPrice',[SpinController::class,'spinPrice']);
Route::post('forcecupdate',[SpinController::class,'forcecUpdate']);
Route::post('withdrawamount',[SpinController::class,'withdrawAmount']);
Route::post('checkwithdrawtime',[SpinController::class,'checkwithdrawtime']);


Route::post('getTicketDetails',[TicketdetailsController::class,'getTicketDetails']);
Route::post('addKyc',[TicketdetailsController::class,'storekycdocument']);
Route::post('getRecord',[TicketdetailsController::class,'getAlltimeWinner']);
Route::post('Displayticketdetails',[TicketdetailsController::class,'Displayticketdetails']);
Route::post('getwithdrawlimit',[TicketdetailsController::class,'getMinimumMaximum']);



