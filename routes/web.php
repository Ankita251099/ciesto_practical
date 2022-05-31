<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\SpinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\TermsConditionController;
use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\KycverificationController;
use App\Http\Controllers\ReferencePolicyController;
use App\Http\Controllers\SplashscreenController;
use App\Http\Controllers\PopupController;
use App\Http\Controllers\ChangepasswordController;
use App\Http\Controllers\CouponcodeController;
use App\Http\Controllers\transactionController;
use App\Http\Controllers\settingController;
use App\Http\Controllers\WindrolController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use Spatie\Analytics\Period;

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

Route::post('user-register', [RegistrationController::class, 'store'])->name('user-register');
Auth::routes();
Route::group(['middleware' =>'auth'],function(){


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::get('/dashboard/filterlist',[DashboardController::class,'datefilter'])->name('filter.list');

Route::get('shop',[ShopController::class,'index'])->name('shop.index');
Route::get('shop/create', [ShopController::class,'create'])->name('shop.create');
Route::post('shop/add', [ShopController::class, 'store'])->name('shop.add');
Route::get('shop/edit/{id}', [ShopController::class, 'edit'])->name('shop.edit');
Route::post('shop/update/{id}', [ShopController::class, 'update'])->name('shop.update');
Route::get('shop/delete/{id}', [ShopController::class, 'destroy'])->name('shop.delete');
Route::post('shop/import',[ShopController::class,'import'])->name('shop.import');


Route::get('product',[ProductController::class,'index'])->name('product.index');
Route::post('product',[ProductController::class,'index'])->name('product.minmaxprice');
Route::get('product/create', [ProductController::class,'create'])->name('product.create');
Route::post('product/add', [ProductController::class, 'store'])->name('product.add');
Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
Route::post('product/import',[ProductController::class,'import'])->name('product.import');


Route::get('Faq', [FaqsController::class, 'index'])->name('Faq.index');
Route::get('create', [FaqsController::class, 'create'])->name('Faq.create');
Route::post('add', [FaqsController::class, 'store'])->name('Faq.add');
Route::get('edit/{id}', [FaqsController::class, 'edit'])->name('Faq.edit');
Route::post('update/{id}', [FaqsController::class, 'update'])->name('Faq.update');
Route::get('delete/{id}', [FaqsController::class, 'destroy'])->name('Faq.delete');



Route::get('spin', [SpinController::class, 'index'])->name('spin.index');
Route::get('view', [SpinController::class, 'show'])->name('spin.view');
Route::get('spin/create', [SpinController::class, 'create'])->name('spin.create');
Route::post('spin_login/add', [SpinController::class, 'spin_login'])->name('spin_login.add');


Route::post('spin/add', [SpinController::class, 'store'])->name('spin.add');
Route::get('spin/edit/{id}', [SpinController::class, 'edit'])->name('spin.edit');
Route::post('spin/update/{id}', [SpinController::class, 'update'])->name('spin.update');
Route::get('spin/delete/{id}', [SpinController::class, 'destroy'])->name('spin.delete');

Route::get('multipleusersdelete', [SpinController::class, 'multipleusersdelete'])->name('multiple.delete');

Route::get('user', [UserController::class, 'index'])->name('user.view');
Route::get('user/list/{id}', [UserController::class, 'create'])->name('user.list');
Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('user/notification/{id}', [UserController::class, 'sendnotification'])->name('user.sendnotification');
Route::post('user/notification/store',[UserController::class, 'storenotification'])->name('user.storenotification');
Route::get('user/status_data',[UserController::class, 'status'])->name('user.status_data');
Route::get('user/date',[UserController::class, 'changedate'])->name('viewuser.date');
Route::get('user/change_status', [UserController::class, 'change_status'])->name('user.change_status');
Route::post('user/amount', [UserController::class, 'store'])->name('user.amountstore');
Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');



Route::get('video', [VideoController::class, 'index'])->name('video.index');
Route::get('video/create', [VideoController::class, 'create'])->name('video.create');
Route::post('video/add', [VideoController::class, 'store'])->name('video.add');
Route::get('addvideo', [VideoController::class, 'addvideo'])->name('addvideo');



Route::get('privacy', [PrivacyController::class, 'index'])->name('privacy.index');
Route::post('privacy/add', [PrivacyController::class, 'store'])->name('privacy.add');

Route::get('terms', [TermsConditionController::class, 'index'])->name('terms.index');
Route::post('terms/add', [TermsConditionController::class, 'store'])->name('terms.add');





Route::get('HelpDesk', [HelpdeskController::class, 'index'])->name('helpdesk.index');
Route::get('HelpDesk/change_status', [HelpdeskController::class, 'change_status'])->name('helpdesk.change_status');
Route::get('HelpDesk/view/{id}',[HelpdeskController::class,'viewTicketDetails'])->name('helpdesk.view');
Route::post('HelpDesk/view/store',[HelpdeskController::class,'ticketDetailsStore'])->name('helpDesk.ticketdetailsstore');
Route::get('HelpDesk/status_data',[HelpdeskController::class,'status'])->name('helpdesk.status_data');
Route::get('HelpDesk/delete/{id}',[HelpdeskController::class,'destroy'])->name('helpdesk.delete');



Route::get('Notification', [NotificationController::class, 'index'])->name('notification.index');
Route::get('Notification/create', [NotificationController::class, 'create'])->name('notification.create');
Route::post('Notification/add', [NotificationController::class, 'store'])->name('notification.add');
Route::get('Notification/edit/{id}', [NotificationController::class, 'edit'])->name('notification.edit');
Route::post('Notification/update/{id}', [NotificationController::class, 'update'])->name('notification.update');
Route::get('Notification/delete/{id}', [NotificationController::class, 'destroy'])->name('notification.delete');
Route::get('send_notification/{id}', [NotificationController::class, 'send_notification'])->name('send_notification');


Route::get('Leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
Route::get('getLeaderboard', [LeaderboardController::class, 'GetLeaderboard'])->name('getLeaderboard_data');



Route::get('Kyc',[KycverificationController::class,'index'])->name('kyc.index');
Route::get('kycDocumentDetails/{id}',[KycverificationController::class,'create'])->name('kyc.create');
Route::get('kyc/verified',[KycverificationController::class,'getverified'])->name('kyc.verified');
Route::get('kyc/rejected',[KycverificationController::class,'getrejected'])->name('kyc.rejected');
Route::get('status_data',[KycverificationController::class,'status'])->name('status_data');



Route::get('referencepolicy',[ReferencePolicyController::class,'index'])->name('policy.index');
Route::post('referencepolicy/add',[ReferencePolicyController::class,'store'])->name('policy.add');

Route::get('splashscreen',[SplashscreenController::class,'index'])->name('splashscreen.index');
Route::post('splashscreen/add',[SplashscreenController::class,'store'])->name('splashscreen.add');
Route::get('splashscreen/delete/{id}',[SplashscreenController::class,'destroy'])->name('splashscreen.delete');


Route::get('popupimage',[PopupController::class,'index'])->name('popupimage.index');
Route::post('popupimage/add',[PopupController::class,'store'])->name('popupimage.add');
Route::get('popupimage/delete/{id}',[PopupController::class,'destroy'])->name('popupimage.delete');


Route::get('changepassword',[ChangepasswordController::class,'index'])->name('changepassword.index');
Route::post('changepassword/update',[ChangepasswordController::class,'update'])->name('changepassword.update');


Route::get('couponcode', [CouponcodeController::class, 'index'])->name('code.index');
Route::get('couponcode/create', [CouponcodeController::class, 'create'])->name('code.create');
Route::post('couponcode/add', [CouponcodeController::class, 'store'])->name('code.add');
Route::get('couponcode/edit/{id}', [CouponcodeController::class, 'edit'])->name('code.edit');
Route::post('couponcode/update/{id}', [CouponcodeController::class, 'update'])->name('code.update');
Route::get('couponcode/delete/{id}', [CouponcodeController::class, 'destroy'])->name('code.delete');


Route::get('transaction',[transactionController::class,'index'])->name('transaction.index');
Route::get('transaction/create',[transactionController::class,'create'])->name('transaction.create');
Route::post('transaction/add',[transactionController::class,'store'])->name('transaction.add');
Route::get('transaction/edit/{id}',[transactionController::class,'edit'])->name('transaction.edit');
Route::post('transaction/update/{id}',[transactionController::class,'update'])->name('transaction.update');
Route::get('transaction/delete/{id}',[transactionController::class,'destroy'])->name('transaction.delete');
Route::get('transaction/paid',[transactionController::class,'getpaid'])->name('transaction.paid');
Route::get('transaction/unpaid',[transactionController::class,'getunpaid'])->name('transaction.unpaid');
Route::get('transaction/status_data',[transactionController::class,'getstatus'])->name('transaction.status_data');

Route::get('withdraw/minimum/maximum',[settingController::class,'index'])->name('withdraw.index');
Route::post('withdraw/minimum/maximum/add',[settingController::class,'store'])->name('withdraw.add');
Route::get('forceUpdate',[settingController::class,'forceUpdate'])->name('forceUpdate.index');
Route::post('forceUpdate',[settingController::class,'forceUpdateStore'])->name('forceUpdate.add');
Route::get('referrallink',[settingController::class,'referrallink'])->name('referrallink.index');
Route::post('referrallink',[settingController::class,'storereferrallink'])->name('referrallink.add');


Route::get('windrol',[WindrolController::class,'index'])->name('windrol.index');

});
