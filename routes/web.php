<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperadminLoginController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ManageStreamController;
use App\Http\Controllers\IntermediatepageController;
use App\Http\Controllers\MailSetupController;
use App\Http\Controllers\LobbyController;
use App\Http\Controllers\LandingAreaController;
use App\Http\Controllers\AuditoriumController;
use App\Http\Controllers\AssetLibraryController;
use App\Http\Controllers\TemplateBannerController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppFeatureController;
use App\Http\Controllers\GestureController;
use App\Http\Controllers\ActivityController;
//use App\Http\Controllers\StripeController;

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

## Start SuperAdmin:  V-fair  ##
Route::group(['prefix' => '/'], function () {
    Route::get('/', [SuperadminLoginController::class,'welcome']);
    Route::any('/loginattempt', [SuperadminLoginController::class,'CheckLogin']);
    ## logout ##
    Route::get('/logout', [SuperadminLoginController::class,'logout'])->name('logout');
});


Route::group(['prefix' => '/', 'middleware' => ['superlogin']], function () {
    session(['layout' => 'normal']);   
    Route::any('/dashboard', [SuperadminController::class,'dashboard']);

     ## Manage Customers ##
    Route::any('/prospects',[SuperadminController::class,'prospects']);
    
    Route::post('/addprospects',[SuperadminController::class,'addprospects']);
    Route::post('/editprospects',[SuperadminController::class,'editprospects']);
    Route::post('/updateprospects',[SuperadminController::class,'updateprospects']);
    Route::any('/prospectStatus',[SuperadminController::class,'prospectStatus']);
    
    ## Manage Templates ##
    Route::any('/templates',[SuperadminController::class,'templates'])->name('templates');
    Route::any('/addtemplate',[SuperadminController::class,'AddTemplate'])->name('addtemplate');
    Route::post('/edittemplate',[SuperadminController::class,'edittemplate']);
    Route::post('/updatetemplate',[SuperadminController::class,'Updatetemplate'])->name('updatetemplate');
    
    ## Manage Templates Locations ##
    Route::any('/templates/locations/{bm_id}',[SuperadminController::class,'TemplateLocations']);
    Route::any('/templates/locations/{bm_id}/addedittemplatelocation',[SuperadminController::class,'AddEditTemplateLocation']);
    Route::any('/templates/locations/{bm_id}/uploadlocation',[SuperadminController::class,'UploadlocationsFile']);
    
    ## Manage Templates Menu Items ##
    Route::any('/templates/menus/{bm_id}',[SuperadminController::class,'TemplateMenus']);
    Route::any('/templates/menus/{bm_id}/addedittemplatemenus',[SuperadminController::class,'AddEditTemplateMenu']);
    Route::any('/templates/menus/{bm_id}/uploadmenu',[SuperadminController::class,'UploadMenuFile']);
    
    ## Manage Template Assets ##
    Route::any('/templates/assets/{bm_id}',[SuperadminController::class,'TemplateAssets']);
    Route::any('/templates/assets/{bm_id}/addedittemplateasset',[SuperadminController::class,'AddEditTemplateAsset']);
    Route::any('/templates/assets/{bm_id}/uploadasset',[SuperadminController::class,'SaveAsset']);
    Route::any('/templates/assets/{bm_id}/updateasset',[SuperadminController::class,'UpdateAsset']);
    
    
    ## Manage Packages ##
    Route::any('/packages',[SuperadminController::class,'packages'])->name('packages');
    Route::post('/addpackages',[SuperadminController::class,'addpackages']);
    Route::post('/updatepackages',[SuperadminController::class,'updatepackages']);
    Route::post('/editpackages',[SuperadminController::class,'editpackages']);
    
    
    //Manage Stream
    Route::any('manageevents',[SuperadminController::class,'ManageEvents'])->name('manage-stream');
    Route::any('/editevent',[SuperadminController::class,'EditEventDetail']);
    Route::any('/addevent',[SuperadminController::class,'AddEventData']);
    Route::any('/update-event-status',[SuperadminController::class,'ChangeEventStatus']);
    //Route::any('/stream-video-launch',[SuperadminController::class,'StreamVideoLaunch']);
    //Route::any('/play-livesream-video', [SuperadminController::class,'playLiveStreamVideo']);
    
    
    
    ## Manage App Setting ##
    Route::any('/manage-app-setting',[SuperadminController::class,'ManageAppSetting'])->name('manage-app-setting');
    Route::any('/manage-app-setting/view',[SuperadminController::class,'ViewAppSetting']);
    Route::any('/manage-app-setting/add',[SuperadminController::class,'AddAppSetting']);
    Route::any('/manage-app-setting/update',[SuperadminController::class,'UpdateAppSetting']);
    
    ## Campaign URL Builder ##
    Route::any('/Campaign',[SuperadminController::class,'Campaign']);
    Route::any('/changeleadstage',[SuperadminController::class,'changeleadstage']);
    Route::any('/mailcontent',[SuperadminController::class,'mailcontent']);
    Route::any('/SendCredentials',[SuperadminController::class,'SendCredentials']);
  //  Route::any('/activity', 'SuperadminController@VisitorActivity');
  
  ## Settings ##
        Route::any('/settings/{id}',[SuperadminController::class,'settings']);
        Route::any('/saveSettings',[SuperadminController::class,'saveSettings']) ;
        
        
    ## Manage Feature ##
    Route::any('/managefeature',[AppFeatureController::class,'ManageFeature'])->name('manage-feature');
    Route::any('/addFeature',[AppFeatureController::class,'AddFeature'])->name('addFeature');
    Route::post('/editFeatureFormdata',[AppFeatureController::class,'editFeatureFormData']);
    Route::post('/updatefeatureName',[AppFeatureController::class,'updateFeatureData'])->name('updatefeatureName');
    Route::post('/enable-disable-feature/{id}', [AppFeatureController::class,'EnableDisableFeature']);
    
    ## Manage Gesture ##
    Route::any('/managegesture',[GestureController::class,'ManageGesture'])->name('manage-gesture');
    Route::any('/addGestureName',[GestureController::class,'AddGesture'])->name('addGestureName');
    Route::post('/editGesture',[GestureController::class,'editGestureTemplate']);
    Route::post('/updateGestureName',[GestureController::class,'updateGesture'])->name('updateGestureName');
    Route::post('/enable-disable/{id}', [GestureController::class,'EnableDisableGesture']);
    
    ## Manage Activity ##
    Route::any('/manage-activity',[ActivityController::class,'ManageActivity'])->name('manage-activity');
    Route::any('/add-activity',[ActivityController::class,'AddActivity'])->name('add-activity');
    Route::post('/edit-activity',[ActivityController::class,'EditActivityData']);
    Route::post('/update-activity',[ActivityController::class,'UpdateActivityData'])->name('update-activity');
    Route::post('/change-activity-status/{id}', [ActivityController::class,'ChangeActivityStatus']);
        
});
## End SuperAdmin:  V-fair  ##


## start Exhibitor:  V-fair  ##
Route::group(['prefix' => 'exhibitor/{brand}'], function () {
     session(['layout' => 'normal']);

    Route::get('/', [UsersController::class,'welcome'])->name('welcome');
    Route::any('/loginattempt', [UsersController::class,'CheckLogin']);
    Route::any('/forgot-password', [UsersController::class,'forgetPassword']);
    Route::any('/change-password', [UsersController::class,'changePassword']);
    Route::any('/sendotp', [UsersController::class,'sendotp']);
    Route::any('/sendotpexhibitor', [UsersController::class,'sendotpexhibitor'])->name('sendotpexhibitor');
    Route::any('/auto-login', [UsersController::class,'AutoLoginAttempt']);

    ## logout ##
    Route::get('/logout', [UsersController::class,'logout']);
});

Route::group(['prefix' => 'exhibitor/{brand}','suffix'=>'{exhib}', 'middleware' => ['Login']], function () {
        session(['layout' => 'normal']);
        
        Route::any('/dashboard', [HomeController::class,'dashboard']);
        Route::any('/profile', [HomeController::class,'ViewProfile'])->name('profile');
        Route::any('/profile/project-photo-gallary/{project_id}', [HomeController::class,'ViewProfileProjectGallary']);
        Route::any('/profile/project-video-gallary/{project_id}', [HomeController::class,'ViewProjectVideoGallary']);
        Route::any('/activity', [HomeController::class,'VisitorActivity']);
        Route::any('/my-leads', [HomeController::class,'GetDataList'])->name('my-leads');
        // Route::any('/visiting-card', [HomeController::class,'ViewVisitingCard');
        Route::any('/savevisitingcard', [HomeController::class,'savevisitingcard']);
        Route::any('/saveuserprofile', [HomeController::class,'Updateuserprofile']);
        Route::any('/saveconvaiid', [HomeController::class,'Updateconvaiid']);
        Route::any('/saveuserprojectgallary', [HomeController::class,'updateProjectGallary']);
        Route::any('getcourses', [HomeController::class,'getcourses']);
        Route::any('getparentproductsubcategory', [HomeController::class,'getparentproductsubcategory']);
        Route::any('AddCourseOffered', [HomeController::class,'AddCourseOffered']);
        Route::any('/bothstaff', [HomeController::class,'bothstaff'])->name('bothstaff');
        Route::any('/citylist', [HomeController::class,'callcitylist']);
        Route::any('/addeditcourse', [HomeController::class,'addeditcourse']);
        Route::any('/addchatbotdata', [HomeController::class,'addchatbotdata']);
        Route::any('/addcategory', [HomeController::class,'addcategory']);
        Route::any('/changeleadstatus', [HomeController::class,'changeleadstatus']);
        Route::any('/showhistory', [HomeController::class,'showhistory']);
        Route::get('/saveData',[HomeController::class,'saveData']);
        Route::any('/edituser', [HomeController::class,'edituser']);
        Route::any('/adduser', [HomeController::class,'adduser']);
        Route::any('/removegalleryitem', [HomeController::class,'RemoveGalleryItem']);
        Route::any('/removebusinesscarditem', [HomeController::class,'RemoveBusinessCardItem']);
        Route::any('/removeboothstaffuser', [HomeController::class,'RemoveBoothStaffUser']);
        Route::any('/removebsmuser', [HomeController::class,'RemoveBsmUser']);
         Route::any('/downloadExcelexhibitor','DownloadController@downloadExcelexhibitor');
        
        Route::any('/saveThumbnaildata', [HomeController::class,'saveThumbnaildata']);
        Route::any('/saveThumbnailSocialdata', [HomeController::class,'saveThumbnailSocialdata']);
        Route::any('/removethumbnail', [HomeController::class,'removethumbnail']);
        Route::any('/removeSocialthumbnail', [HomeController::class,'removeSocialthumbnail']);
        Route::any('/scrollerdata', [HomeController::class,'scrollerdata']);
        Route::any('/saveinteractivedata', [HomeController::class,'saveinteractivedata']);
        
        Route::any('/adduserbsm',[HomeController::class,'adduserbsm']);
        Route::any('/edituserbsm',[HomeController::class,'edituserbsm']);
        Route::any('/bsm-representative',[HomeController::class,'bsmRepresentative']);
        Route::any('/saveexhibitordata', [HomeController::class,'saveexhibitordata']);
        ## Maintain Session ##
        Route::any('/reqonoff', [HomeController::class,'reqonoff']);
        Route::any('/changeevent/{eventid}/{targetpage}', [HomeController::class,'seteventasrequest']);
        ##  exhibitors change password   ##
        Route::any('/change_password',[HomeController::class,'change_password']);
        Route::any('/getcity',[HomeController::class,'getCity']);
        Route::any('/showEnquiry', [HomeController::class,'showEnquiry']);
        Route::any('/showQuotation', [HomeController::class,'showQuotation']);
        ##  Sync to NoPaperForms   ##
        Route::any('/SynctoNoPaperForms', [HomeController::class,'SynctoNoPaperForms']);
        ## Send SMS / Mail ##
        Route::any('/SendSMS', [HomeController::class,'sendsms']);
        Route::any('/sendMail', [HomeController::class,'sendMail']);
        ## Download Data ##
        Route::any('/downloadExcel','DownloadController@downloadExcel');
        ## change ##
        Route::any('/change',[HomeController::class,'change']);
        Route::any('/removeBrochure',[HomeController::class,'RemoveBrochure']);
        Route::any('/deletecourse',[HomeController::class,'deletecourse']);
        ### B2b Meetings
        Route::any('/meetings', 'MeetingController@meetings');
        Route::any('/user-profile', 'MeetingController@delegateprofile')->name('user-profile');
        Route::any('/join','MeetingController@JoinvideoRoom'); 
        Route::post('/createToken', "MeetingController@createToken"); 
        Route::any('/mymeetings', 'MeetingController@meetingdashboard');
        Route::any('/BuyerList', 'MeetingController@BuyerList');
        ### Buyer Lists
        Route::any('/totalRbsm', [HomeController::class,'totalRbsm']);
        Route::any('/totalDbsm', [HomeController::class,'totalDbsm']);
       
        Route::any('/changeevent/{eventid}/{targetpage}', 'MeetingController@seteventasrequest');
        ## Meeting time Route ##
        Route::any('/getmeettime','MeetingController@getmeettime');
        ## Send Meeting Request ##
        Route::any('/sendMeetingRequest','MeetingController@sendMeetingRequest');
        ## My Meetings ##
        Route::any('/Meetingsdata','MeetingController@MeetingsData');
        Route::any('/CancelledMeetingsdata','MeetingController@CancelledMeetingsdata');
        Route::any('/SaveMeetingFeedback','MeetingController@SaveMeetingFeedback');
        Route::any('/rescheduleMettingData','MeetingController@rescheduleMettingData');
        Route::any('/CheckNAddtoCReschedule','MeetingController@CheckNAddtoCReschedule');
        
        ## My Meetings ##
        Route::any('/ChangeMeetingStatus','MeetingController@ChangeMeetingStatus'); 
        
        ## Add to Cart ##
        Route::any('/CheckNAddtoC','MeetingController@CheckNAddtoC');
        ## cart data count ##
        Route::any('/CheckCartData','MeetingController@CheckCartData');
        ## cart data list ##
        Route::any('/cart','MeetingController@cartitemlist');
        ##remove item from cart ##
        Route::any('/removecartitem','MeetingController@removecartitem');
        ## clear cart ##
        Route::any('/clearcartitem','MeetingController@clearcartitem');
        ##checkout and Set Meeting ##
        Route::any('/checkout','MeetingController@CheckOutNSetMeeting');
        
        ##Invoice ##
        Route::any('/Invoices','MeetingController@Invoices');
        ##Invoice ##
        Route::any('/Viewinvoice','MeetingController@Viewinvoice');
        ## Feedform ##
        Route::any('/getfeedform','MeetingController@getfeedform'); 
        ## Save Feedback form ##
        Route::any('/SaveFeedform','MeetingController@SaveFeedform'); 
        ## Bypass from PaymentGateway ##
        Route::any('/checkoutresponseBypass','MeetingController@checkoutresponseBypass');
        ## cancel meeting ##
        Route::any('/cancelMetting','MeetingController@cancelMetting');
        ######### 
        Route::any('/bsm-representative',[HomeController::class,'bsmRepresentative']);
        
        Route::any('/activityreport',[HomeController::class,'ActivityReport']);
 
});



## Start Admin:  V-fair  ##
Route::group(['prefix' => '{brand}'], function () {
    Route::get('/', [AdminLoginController::class,'welcome']);
    Route::any('/loginattempt', [AdminLoginController::class,'CheckLogin']);
    ## logout ##
    Route::get('/logout', [AdminLoginController::class,'logout']);
    
    Route::any('/autologinattempt', [AdminLoginController::class,'AutoCustomerLogin']);
});



Route::group(['prefix' => '{brand}', 'middleware' => ['adminlogin']], function () {
    session(['layout' => 'normal']);   
    Route::any('/dashboard', [AdminController::class,'dashboard']);

    ## Landing Page ##
    Route::any('/lpage',[AdminController::class,'lpage']);
    Route::any('/lpage1',[AdminController::class,'lpage1']);
    Route::any('/lpage2',[AdminController::class,'lpage2']);
    
    Route::any('/getlpage',[AdminController::class,'getlpage']);
    
    Route::any('/landingPage',[AdminController::class,'landingPage']);
    
    Route::any('add_career_sessions',[AdminController::class,'addcareersessions']);
    Route::any('edit_career_sessions',[AdminController::class,'editcareersessions']);
    Route::any('delete_career_sessions',[AdminController::class,'deletecareersessions']);
    Route::any('update_career_sessions',[AdminController::class,'updatecareersessions']);
    Route::any('deletespeaker',[AdminController::class,'deleteSessionspeaker']);
    
    Route::any('sectionToggle',[AdminController::class,'sectionToggle']);
    
    Route::any('/manageregistrationpage',[AdminController::class,'manageRegistration']);
    Route::any('fieldToggle',[AdminController::class,'fieldToggle']);
    Route::any('add_custom_field',[AdminController::class,'addCustomField']);
    Route::any('cfToggle',[AdminController::class,'cfToggle']);
    Route::any('cfEdit',[AdminController::class,'cfEdit']);
    Route::any('cfEditOpt',[AdminController::class,'cfEditOpt']);
    Route::any('update_custom_field',[AdminController::class,'updatecustomfield']);
    Route::any('requesttosetorderby',[AdminController::class,'setOrderBy']);
    Route::any('requesttosettemplate',[AdminController::class,'setTemplate']);
    
    Route::any('crop-image-upload',[AdminController::class,'cropperJs']);
    Route::any('image-upload',[AdminController::class,'uploadCropImage']);
    
    ## CMS ##
    
    Route::any('/Addspk',[AdminController::class,'Addspk']);
    Route::any('/cms',[AdminController::class,'cms']);
    Route::any('/editcms',[AdminController::class,'editcms']);
    
    Route::any('/logoUpload',[AdminController::class,'logoUpload']);
    Route::any('/photoUpload',[AdminController::class,'photoUpload']);
    Route::any('/removegalleryitem',[AdminController::class,'removegalleryitem']);
    Route::any('/Addcms',[AdminController::class,'Addcms']);
    Route::any('/statusCms',[AdminController::class,'statusCms']);
    
    
    ## Campaign URL Builder ##
    Route::any('/Campaign',[AdminController::class,'Campaign']);
    
    ## Manage Events ##
    Route::any('/Events',[AdminController::class,'manage_events']);
    Route::any('/editevent',[AdminController::class,'editevent']);
    Route::any('/Addevent',[AdminController::class,'Addevent']);
    
    //Homepage content Manage
    Route::any('/managehomepage',[AdminController::class,'managehomepagecontent']);
    Route::any('/addhomepagecontent',[AdminController::class,'AddHomePageContent']);
    Route::any('/edithomepagecontent',[AdminController::class,'EditHomePageContent']);
    
    //Manage Unity Content
    Route::any('/manageunitycontent',[AdminController::class,'ManageUnityContent']);
    
    //Landing Area
    // Route::any('/managelandingarea',[LandingAreaController::class,'managelandingarea']);
    // Route::any('/AddLandingBanner',[LandingAreaController::class,'AddLandingBanner']);
    // Route::any('/EditLandingBanner',[LandingAreaController::class,'EditLandingBanner']);
    
    
    //Lobby
    // Route::any('/managelobby',[LobbyController::class,'managelobby']);
    // Route::any('/AddLobbybanner',[LobbyController::class,'AddBanner']);
    // Route::any('/EditLobbybanner',[LobbyController::class,'EditBanner']);
    
    //Audiotorium
    // Route::any('/manageaudi',[AuditoriumController::class,'manageaudi']);
    // Route::any('/addaudicontent',[AuditoriumController::class,'AddAudiContent']);
    // Route::any('/editaudicontent',[AuditoriumController::class,'EditAudiContent']);
    
    
    //Asset Library
    Route::any('/manageassetlibrary',[AssetLibraryController::class,'manageassetlibrary']);
    Route::any('/AddAssetLibraryContent',[AssetLibraryController::class,'AddAssetLibraryContent']);
    Route::any('/EditAssetLibraryContent',[AssetLibraryController::class,'EditAssetLibraryContent']);
    Route::any('/AddAssetLibraryFile',[AssetLibraryController::class,'AddAssetLibraryFile']);
    Route::any('/EditAssetLibraryFile',[AssetLibraryController::class,'EditAssetLibraryFile']);
    
    //Landing Area
    Route::any('/managetemplatebanners',[TemplateBannerController::class,'managetemplatebanners']);
    Route::any('/updatetemplatebannerdata',[TemplateBannerController::class,'UpdateTemplateBannerData']);
    
    Route::any('/choosetemplates',[AdminController::class,'ChooseTemplate']);
    Route::any('/ActivateTemplate',[AdminController::class,'ActivateTemplate']);
    
    ##package manager ##
        Route::any('/packageManger',[AdminController::class,'packageManger']);
        Route::any('/getPackageData',[AdminController::class,'getPackageData']);
        Route::any('/updatePackage',[AdminController::class,'updatePackage']);
        
        // Route::any('/pixelManager',[AdminController::class,'pixelManager']);
        // Route::any('/Settings',[AdminController::class,'Settings']);
        // Route::any('/masterDataSetup',[AdminController::class,'masterDataSetup']);
        Route::any('/all-leads',[AdminController::class,'GetDataList']);
        
    ## Settings ##
        Route::any('/settings',[AdminController::class,'settings']) ;
        Route::any('/saveSettings',[AdminController::class,'saveSettings']) ;
        Route::any('/changeevent/{eventid}/{targetpage}', [AdminController::class,'seteventasrequest']);
   
    ## Manage Streams  ##
        Route::any('/streammaster',[ManageStreamController::class,'streammaster']) ;
        Route::any('/changeStreamStatus',[ManageStreamController::class,'changeStreamStatus']);
        Route::any('/setDefaultStatusMws',[ManageStreamController::class,'setDefaultStatusMws']);
        Route::any('/AddeStreams',[ManageStreamController::class,'AddeStreams']);
        Route::any('/editStreams',[ManageStreamController::class,'editStreams']);
        Route::any('/updateStreams',[ManageStreamController::class,'updateStreams']);
        Route::any('/ActivateStream',[ManageStreamController::class,'ActivateStream']);
    
     ## exhibitor Hall Category ##
        Route::any('/manage-intermediate-page',[IntermediatepageController::class,'manage_intermediate_page']);
        Route::any('/addeditpopup-intermediate-page',[IntermediatepageController::class,'addeditpopup_intermediate_page']);
        Route::any('/updatestatus-intermediate-page',[IntermediatepageController::class,'updatestatus_intermediate_page']);
        Route::any('/addedit-intermediate-page',[IntermediatepageController::class,'addedit_intermediate_page']);
        Route::any('/setDefaultStatusMip',[IntermediatepageController::class,'setDefaultStatusMip']);

         ## mail setup ##
        
        Route::any('/mailsetup',[MailSetupController::class,'index']);
        Route::any('/mailstp',[MailSetupController::class,'mailstp']);
        
        
        ## Manage Exhibitors
       Route::any('/exhibitor',[AdminController::class,'exhibitor_master']);
       Route::any('/editexhibitor',[AdminController::class,'editexhibitor']);
       Route::any('/Addexhibitor',[AdminController::class,'Addexhibitor']);
   
       ## Manage Subscription
       Route::any('/mysubscription',[AdminController::class,'MySubscription']);
       Route::any('/upgradepackage',[AdminController::class,'UpgradePackage']);
       Route::any('/step-two',[AdminController::class,'ChoosePackagePlan']);
       Route::any('/savepackage',[AdminController::class,'SavePackagePlan']);
       Route::any('/verify',[AdminController::class,'VerifyPackagePlan']);
       Route::any('/response',[StripeController::class,'Response']);
       
       ## Manage Launch EVents
        Route::any('manageevents',[AdminController::class,'ManageEvents']);
        Route::any('/event-launch', [AdminController::class,'LaunchEvent']);
        Route::any('/editEventLaunch',[AdminController::class,'EditEventLaunch']);
        Route::any('/addEventLaunch',[AdminController::class,'AddEventLaunch']);
        Route::any('/activate-stream-video',[AdminController::class,'ActivateStreamVideo']);
        Route::any('/generate-meeting-link',[AdminController::class,'GenerateMeetingLink']);
        
        Route::any('/generate-meeting-token',[AdminController::class,'GenerateMeetingToken']);
        
        ## Selfie Wall
        Route::any('/selfiewall',[AdminController::class,'SelfieWall']);
        
        Route::any('/treasurehuntreport',[AdminController::class,'TreasureHuntReport']);
        
        ## Reset Treasure Hunt
        Route::any('/reset-reasure-hunt',[AdminController::class,'ResetTreasureHunt']);
        
        Route::any('/verify-user',[AdminController::class,'VerifyUser']);
        
        Route::any('/attendancereport',[AdminController::class,'attendance_report'])->name('Attendance');
        
    ## Manage Convai AppId ##
    Route::any('/manage-convai-appid',[AdminController::class,'ManageConvaiAppId'])->name('manage-convai-appid');
    Route::any('/manage-convai-appid/view',[AdminController::class,'ViewConvaiAppId']);
    Route::any('/manage-convai-appid/add',[AdminController::class,'AddConvaiAppId']);
    Route::any('/manage-convai-appid/update',[AdminController::class,'UpdateConvaiAppId']);
    
    ## Manage Convai CharacterId ##
    Route::any('/manage-convai-character-id',[AdminController::class,'ManageConvaiCharacterId'])->name('manage-convai-character-id');
    Route::any('/manage-convai-character-id/view',[AdminController::class,'ViewConvaiCharacterId']);
    Route::any('/manage-convai-character-id/add',[AdminController::class,'AddConvaiCharacterId']);
    Route::any('/manage-convai-character-id/update',[AdminController::class,'UpdateConvaiCharacterId']);
    
    //Homepage content Manage
    Route::any('/dashboard-settings',[AdminController::class,'ManageDashboardPageContent']);
    Route::any('/dashboard-settings/add',[AdminController::class,'AddDashboardPageContent']);
    Route::any('/dashboard-settings/edit',[AdminController::class,'EditDashboardPageContent']);
});


## End Admin:  V-fair  ##
















###########################################################


// Route::get('/', function () {
//     return view('dashboard.dashboardv1');
// });
// Route::view('/', 'starter')->name('starter');
Route::get('large-compact-sidebar/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'compact']);
    return view('dashboard.dashboardv1');
})->name('compact');

Route::get('large-sidebar/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'normal']);
    return view('dashboard.dashboardv1');
})->name('normal');

Route::get('horizontal-bar/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'horizontal']);
    return view('dashboard.dashboardv1');
})->name('horizontal');

Route::get('vertical/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'vertical']);
    return view('dashboard.dashboardv1');
})->name('vertical');


Route::view('dashboard/dashboard1', 'dashboard.dashboardv1')->name('dashboard_version_1');
Route::view('dashboard/dashboard2', 'dashboard.dashboardv2')->name('dashboard_version_2');
Route::view('dashboard/dashboard3', 'dashboard.dashboardv3')->name('dashboard_version_3');
Route::view('dashboard/dashboard4', 'dashboard.dashboardv4')->name('dashboard_version_4');

// uiKits
Route::view('uikits/alerts', 'uiKits.alerts')->name('alerts');
Route::view('uikits/accordion', 'uiKits.accordion')->name('accordion');
Route::view('uikits/buttons', 'uiKits.buttons')->name('buttons');
Route::view('uikits/badges', 'uiKits.badges')->name('badges');
Route::view('uikits/bootstrap-tab', 'uiKits.bootstrap-tab')->name('bootstrap-tab');
Route::view('uikits/carousel', 'uiKits.carousel')->name('carousel');
Route::view('uikits/collapsible', 'uiKits.collapsible')->name('collapsible');
Route::view('uikits/lists', 'uiKits.lists')->name('lists');
Route::view('uikits/pagination', 'uiKits.pagination')->name('pagination');
Route::view('uikits/popover', 'uiKits.popover')->name('popover');
Route::view('uikits/progressbar', 'uiKits.progressbar')->name('progressbar');
Route::view('uikits/tables', 'uiKits.tables')->name('tables');
Route::view('uikits/tabs', 'uiKits.tabs')->name('tabs');
Route::view('uikits/tooltip', 'uiKits.tooltip')->name('tooltip');
Route::view('uikits/modals', 'uiKits.modals')->name('modals');
Route::view('uikits/NoUislider', 'uiKits.NoUislider')->name('NoUislider');
Route::view('uikits/cards', 'uiKits.cards')->name('cards');
Route::view('uikits/cards-metrics', 'uiKits.cards-metrics')->name('cards-metrics');
Route::view('uikits/typography', 'uiKits.typography')->name('typography');

// extra kits
Route::view('extrakits/dropDown', 'extraKits.dropDown')->name('dropDown');
Route::view('extrakits/imageCroper', 'extraKits.imageCroper')->name('imageCroper');
Route::view('extrakits/loader', 'extraKits.loader')->name('loader');
Route::view('extrakits/laddaButton', 'extraKits.laddaButton')->name('laddaButton');
Route::view('extrakits/toastr', 'extraKits.toastr')->name('toastr');
Route::view('extrakits/sweetAlert', 'extraKits.sweetAlert')->name('sweetAlert');
Route::view('extrakits/tour', 'extraKits.tour')->name('tour');
Route::view('extrakits/upload', 'extraKits.upload')->name('upload');


// Apps
Route::view('apps/invoice', 'apps.invoice')->name('invoice');
Route::view('apps/inbox', 'apps.inbox')->name('inbox');
Route::view('apps/chat', 'apps.chat')->name('chat');
Route::view('apps/calendar', 'apps.calendar')->name('calendar');
Route::view('apps/task-manager-list', 'apps.task-manager-list')->name('task-manager-list');
Route::view('apps/task-manager', 'apps.task-manager')->name('task-manager');
Route::view('apps/toDo', 'apps.toDo')->name('toDo');
Route::view('apps/ecommerce/products', 'apps.ecommerce.products')->name('ecommerce-products');
Route::view('apps/ecommerce/product-details', 'apps.ecommerce.product-details')->name('ecommerce-product-details');
Route::view('apps/ecommerce/cart', 'apps.ecommerce.cart')->name('ecommerce-cart');
Route::view('apps/ecommerce/checkout', 'apps.ecommerce.checkout')->name('ecommerce-checkout');


Route::view('apps/contacts/lists', 'apps.contacts.lists')->name('contacts-lists');
Route::view('apps/contacts/contact-details', 'apps.contacts.contact-details')->name('contact-details');
Route::view('apps/contacts/grid', 'apps.contacts.grid')->name('contacts-grid');
Route::view('apps/contacts/contact-list-table', 'apps.contacts.contact-list-table')->name('contact-list-table');

// forms
Route::view('forms/basic-action-bar', 'forms.basic-action-bar')->name('basic-action-bar');
Route::view('forms/multi-column-forms', 'forms.multi-column-forms')->name('multi-column-forms');
Route::view('forms/smartWizard', 'forms.smartWizard')->name('smartWizard');
Route::view('forms/tagInput', 'forms.tagInput')->name('tagInput');
Route::view('forms/forms-basic', 'forms.forms-basic')->name('forms-basic');
Route::view('forms/form-layouts', 'forms.form-layouts')->name('form-layouts');
Route::view('forms/form-input-group', 'forms.form-input-group')->name('form-input-group');
Route::view('forms/form-validation', 'forms.form-validation')->name('form-validation');
Route::view('forms/form-editor', 'forms.form-editor')->name('form-editor');

// Charts
Route::view('charts/echarts', 'charts.echarts')->name('echarts');
Route::view('charts/chartjs', 'charts.chartjs')->name('chartjs');
Route::view('charts/apexLineCharts', 'charts.apexLineCharts')->name('apexLineCharts');
Route::view('charts/apexAreaCharts', 'charts.apexAreaCharts')->name('apexAreaCharts');
Route::view('charts/apexBarCharts', 'charts.apexBarCharts')->name('apexBarCharts');
Route::view('charts/apexColumnCharts', 'charts.apexColumnCharts')->name('apexColumnCharts');
Route::view('charts/apexRadialBarCharts', 'charts.apexRadialBarCharts')->name('apexRadialBarCharts');
Route::view('charts/apexRadarCharts', 'charts.apexRadarCharts')->name('apexRadarCharts');
Route::view('charts/apexPieDonutCharts', 'charts.apexPieDonutCharts')->name('apexPieDonutCharts');
Route::view('charts/apexSparklineCharts', 'charts.apexSparklineCharts')->name('apexSparklineCharts');
Route::view('charts/apexScatterCharts', 'charts.apexScatterCharts')->name('apexScatterCharts');
Route::view('charts/apexBubbleCharts', 'charts.apexBubbleCharts')->name('apexBubbleCharts');
Route::view('charts/apexCandleStickCharts', 'charts.apexCandleStickCharts')->name('apexCandleStickCharts');
Route::view('charts/apexMixCharts', 'charts.apexMixCharts')->name('apexMixCharts');

// datatables
Route::view('datatables/basic-tables', 'datatables.basic-tables')->name('basic-tables');

// sessions
Route::view('sessions/signIn', 'sessions.signIn')->name('signIn');
Route::view('sessions/signUp', 'sessions.signUp')->name('signUp');
Route::view('sessions/forgot', 'sessions.forgot')->name('forgot');

// widgets
Route::view('widgets/card', 'widgets.card')->name('widget-card');
Route::view('widgets/statistics', 'widgets.statistics')->name('widget-statistics');
Route::view('widgets/list', 'widgets.list')->name('widget-list');
Route::view('widgets/app', 'widgets.app')->name('widget-app');
Route::view('widgets/weather-app', 'widgets.weather-app')->name('widget-weather-app');

// others
Route::view('others/notFound', 'others.notFound')->name('notFound');
Route::view('others/user-profile', 'others.user-profile')->name('user-profile');
Route::view('others/starter', 'starter')->name('starter');
Route::view('others/faq', 'others.faq')->name('faq');
Route::view('others/pricing-table', 'others.pricing-table')->name('pricing-table');
Route::view('others/search-result', 'others.search-result')->name('search-result');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
