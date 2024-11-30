<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

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

#Before Login
Route::post('/register-user', [ApiController::class,'registerUser'])->middleware('throttle:regUsr');
Route::post('/ccode', [ApiController::class,'SetCaptchaCode'])->middleware('throttle:otp');
Route::post('/send-otp-mail', [ApiController::class,'sendOTPMail'])->middleware('throttle:otp');
Route::post('/verify-otp', [ApiController::class,'verifyOTP'])->middleware('throttle:verifyotp');
Route::post('/send-email-otp', [ApiController::class,'SendOTPEmailVerify'])->middleware('throttle:otp');

Route::post('/validatebrandid', [ApiController::class,'ValidateBrandId']);
Route::post('/login-user', [ApiController::class,'loginUser'])->middleware('throttle:loginUsr');
Route::post('/check-guest-user', [ApiController::class,'GuestUserLogin'])->middleware('throttle:loginUsr');

Route::group(['middleware' => ['throttle:randomTips']], function () {
    Route::post('/get-ground-scalling/{scenename}', [ApiController::class,'getGroundScalling']);
    Route::post('/get-appid', [ApiController::class,'getAppId']);
    Route::post('/get-menu-list', [ApiController::class,'GetMenuList']);
    Route::post('/homepage-setting-data', [ApiController::class,'GetHomePageSettingData']);
    Route::post('/get-convai-setting-data', [ApiController::class,'GetConvaiSettingData']);
});

## After Login APIs
Route::group(['middleware' => ['validatetoken']], function () {
    Route::post('/get-sbilife-data', [ApiController::class,'GetSbilifeData']);
    Route::post('/get-speaker-list', [ApiController::class,'GetSpeakerList']);
    Route::post('/get-speaker-details', [ApiController::class,'GetSpeakerDataById']);
    Route::post('/update-avatar-url', [ApiController::class,'updateAvatarUrl']);
    Route::post('/capture-user-activity', [ApiController::class,'CaptureUserActivity']);
    Route::post('/logout-user', [ApiController::class,'logoutUser']);
});

##Dashboard
Route::post('/get-total-registered-users', [ApiController::class,'GetTotalRegisteredUser']);
Route::post('/get-user-activity-list', [ApiController::class,'GetUserActivityList']);
Route::post('/get-dashboard-data', [ApiController::class,'GetDashboardSettingData']);