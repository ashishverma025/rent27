<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return redirect('/');
});

/* --------------------- Common/User Routes START -------------------------------- */
Route::get('/', function () {
    return view('auth.login');
});

Route::get('google', function () {
    return view('auth.login');
});

Route::get('auth/twitter', 'Auth\LoginController@redirectToTwitter');
Route::get('auth/twitter/callback', 'Auth\LoginController@handleTwitterCallback');
Route::get('/email-verify/{id}', 'UsersController@emailverify');
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => 'PaypalController@payWithPaypal',));
Route::post('paypal', array('as' => 'paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'status','uses' => 'PaypalController@getPaymentStatus',));
Route::post('/create','WelcomeController@create');
Route::get('/contactus', 'WelcomeController@contactUs');
Route::get('/aboutus', 'WelcomeController@aboutUs');
Route::get('/donate', 'WelcomeController@donate');
Route::get('/privacy-procedure', 'WelcomeController@privacyPolicy');
Route::get('/services', 'WelcomeController@Services');
Route::get('/blog/{id?}', 'WelcomeController@Blogs');
Route::get('/faq/{id?}', 'WelcomeController@Faq');
Route::get('/get_quotes', 'WelcomeController@get_quotes');
Route::post('/quotes', 'WelcomeController@quotes');
Route::get('/', 'WelcomeController@landing_index');
Route::any('/editProfile/{id?}', 'WelcomeController@editProfile');
Route::get('/thankyou', 'WelcomeController@thankyou');
Route::any('/listing/truck', 'WelcomeController@listingTruck');
Route::get('/detail/truck/{id?}', 'WelcomeController@detailTruck');
Route::get('/buy-truck', 'WelcomeController@buy_truck');
Route::get('/rent-truck', 'WelcomeController@rent_truck');
Route::get('/sell-truck', 'WelcomeController@sell_truck');
Route::get('/advertise-truck', 'WelcomeController@advertise_truck');
Route::get('/pay-after-loading', 'WelcomeController@pay_after_loading');
Route::get('/get-verified', 'WelcomeController@get_verified');
Route::post('/saveReview', 'AjaxController@saveReview');
Route::post('/saveComplaint', 'AjaxController@saveComplaint');
Route::get('/send-quotes-email', 'SendEmailController@index');
/* --------------------- Driver/Customer Dashboard Routes START -------------------------------- */
/* Users Route */
Route::get('/custommer-dashboard', 'WelcomeController@customerDashboard');
Route::get('/driver-dashboard', 'WelcomeController@driverDashboard');
Route::get('/subscription', 'WelcomeController@subscription');
/* Dealer Route */

Route::get('/dealers', 'Dashboard\DealerController@index');
Route::get('/fetchDealer', 'Dashboard\DealerController@fetchDealer');
Route::any('/deleteDealer/{id?}', 'Dashboard\DealerController@deleteDealer');
Route::get('/dealervehicles', 'Dashboard\DealerController@dealerVehicles');

Route::get('/fetchvehicles', 'Dashboard\DealerController@fetchVehicles');
Route::any('/addDealerVehicle/{id?}', 'Dashboard\DealerController@addDealerVehicle');
Route::any('/addDealerVehicleSell/{id?}', 'Dashboard\DealerController@addDealerVehicleSell');
Route::any('/editDealerVehicle/{id?}', 'Dashboard\DealerController@editDealerVehicle');
Route::get('/deleteDealerVehicle/{id?}', 'Dashboard\DealerController@deleteDealerVehicle');
Route::get('/document-verification', 'TrustSwiftlyController@index');
Route::post('/documentVerified', 'TrustSwiftlyController@documentVerified');
Route::any('/emptytruck100trustWebhook', 'TrustSwiftlyController@trustWebhook');

Route::any('/user', 'Dashboard\UserController@index');
Route::any('/profile', 'Dashboard\UserController@edit');
Route::get('/user/destroy/{id}', 'Dashboard\UserController@destroy');
Route::get('/fetchUsers', 'Dashboard\UserController@fetchUsers');
 Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
 Route::get('/callback/{provider}', 'SocialController@callback');
/* Truck Route */
Route::get('/trucks', 'Dashboard\TruckController@index');
Route::get('/fetchTruck', 'Dashboard\TruckController@fetchTruck');
Route::any('/addTruck/{id?}', 'Dashboard\TruckController@saveTruck');
Route::any('/deleteTruck/{id?}', 'Dashboard\TruckController@deleteTruck');

Route::get('auth/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\LoginController@handleProviderCallback');

// Auth::routes();
Route::post('/registration', 'Auth\RegisterController@register');
Route::post('/signin', 'Auth\LoginController@signIn');

Route::post('/sign-in', 'Auth\RegisterController@signIn');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get("/homes", ["uses" => "HomeController@checkMD", "middleware" => "checkType:2"]);

// Route::get('admin', 'HomeController@index')->name('admin');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/change_password', 'UsersController@change_pwd');
Route::post('/change_password', 'UsersController@update_changed_pwd');
Route::get('/saveEnquiry', 'UsersController@saveEnquiry');

// Route::get('/admin', 'Auth\LoginController@showLoginForm');
/* --------------------- Common/User Routes END -------------------------------- */

/* ----------------------- Admin outes START -------------------------------- */

Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function() {
    /**
     * Admin Auth Route(s)
     */
    Route::namespace('Auth')->group(function() {

        //Login Routes
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');

        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        // Email Verification Route(s)
        Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
        Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
        Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
    });


    /* Companies Route */
    Route::get('/companies', 'CompanyController@index');
    Route::get('/fetchCompany', 'CompanyController@fetchCompany');
    Route::any('/addCompany/{id?}', 'CompanyController@saveCompany');
    Route::any('/deleteCompany/{id?}', 'CompanyController@deleteCompany');

    /* Truck Route */
    Route::get('/trucks', 'TruckController@index');
    Route::get('/fetchTruck', 'TruckController@fetchTruck');
    Route::any('/addTruck/{id?}', 'TruckController@saveTruck');
    Route::any('/deleteTruck/{id?}', 'TruckController@deleteTruck');

    /* Testimonial Route */
    Route::get('/testimonials', 'TestimonialController@index');
    Route::get('/fetchTestimonial', 'TestimonialController@fetchTestimonial');
    Route::any('/addTestimonial/{id?}', 'TestimonialController@saveTestimonial');
    Route::any('/deleteTestimonial/{id?}', 'TestimonialController@deleteTestimonial');

    /* Blog Route */
    Route::get('/blogs', 'BlogController@index');
    Route::get('/fetchBlog', 'BlogController@fetchBlog');
    Route::any('/addBlog/{id?}', 'BlogController@saveBlog');
    Route::any('/deleteBlog/{id?}', 'BlogController@deleteBlog');

    /* Advertisement Route */
    Route::get('/advertisements', 'AdvertisementController@index');
    Route::get('/fetchAdvertisement', 'AdvertisementController@fetchAdvertisement');
    Route::any('/addAdvertisement/{id?}', 'AdvertisementController@saveAdvertisement');
    Route::any('/deleteAdvertisement/{id?}', 'AdvertisementController@deleteAdvertisement');

    /* Enquiry Route */
    Route::get('/fetchEnquiry', 'EnquiryController@fetchEnquiry');
    Route::get('/enquiries', 'EnquiryController@index');


    /* Vehicles Route */
    Route::get('/vehicles', 'VehicleController@index');
    Route::get('/fetchVehicle', 'VehicleController@fetchVehicle');
    Route::any('/addVehicle/{id?}', 'VehicleController@saveVehicle');
    Route::any('/deleteVehicle/{id?}', 'VehicleController@deleteVehicle');

    /* Dealer Route */
    Route::get('/dealers', 'DealerController@index');
    Route::get('/fetchDealer', 'DealerController@fetchDealer');
    Route::any('/addDealer/{id?}', 'DealerController@saveDealer');
    Route::any('/deleteDealer/{id?}', 'DealerController@deleteDealer');
    Route::get('/dealervehicles', 'DealerController@dealerVehicles');
    Route::get('/fetchvehicles', 'DealerController@fetchVehicles');
    Route::any('/addDealerVehicle/{id?}', 'DealerController@addDealerVehicle');
    Route::any('/editDealerVehicle/{id?}', 'DealerController@editDealerVehicle');
    Route::get('/deleteDealerVehicle/{id?}', 'DealerController@deleteDealerVehicle');


    /* Truck Route */
    Route::get('/trucks', 'TruckController@index');
    Route::get('/fetchTruck', 'TruckController@fetchTruck');
    Route::any('/addTruck/{id?}', 'TruckController@saveTruck');
    Route::any('/deleteTruck/{id?}', 'TruckController@deleteTruck');



    Route::any('/user', 'UserController@index');
    Route::any('/user/create', 'UserController@create');
    Route::get('/user/edit/{id?}', 'UserController@edit');
    Route::get('/user/destroy/{id}', 'UserController@destroy');
    Route::get('/fetchUsers', 'UserController@fetchUsers');
    Route::get('/fetchUserbet', 'UserController@fetchUserbet');


    /* Betting Route */
    Route::get('/betting', 'BettingController@index');
    Route::get('/fetchBetting', 'BettingController@fetchBetting');
    Route::any('/addBetting/{id?}', 'BettingController@saveBetting');
    Route::any('/deleteBetting/{id?}', 'BettingController@deleteBetting');
    Route::any('/announceWinningNumber/{id?}', 'BettingController@announceWinningNumber');

    Route::get('/edit/{id?}', 'UserController@edit');
    Route::post('/uploadstudents', 'UserController@uploadStudentByCsv');
    Route::get('/dashboard', 'HomeController@index')->name('home')->middleware('guard.verified:admin,admin.verification.notice');


    //Put all of your admin routes here...
});
/* ----------------------- Admin Routes END -------------------------------- */

/* ----------------------- Site Routes START -------------------------------- */


//Route::get('/editprofile/{id?}', 'UsersController@editprofile');
Route::get('/userprofile', 'UsersController@viewProfile');
Route::post('/changecoverbanner', 'UsersController@changeCoverBanner');

Route::post('/sendotp', 'UsersController@sendOtp');
Route::post('/validateotp', 'UsersController@validateOtp');

Route::post('/updateprofile', 'UsersController@updateProfile');


/* ----------------------- Online Practice -------------------------------- */
Route::get("check-mw", ["uses" => "HomeController@checkMD", "middleware" => "checkType:2"]);
Route::get('/email-verify/{id}/{LcId}', 'UsersController@emailverify');

/* -----------------------Frontend Ajax Routes ----------------------------------------- */
Route::get('/checkmail', 'StudentsController@checkMail');
Route::post('/checkexistemail', 'AjaxController@checkExistEmail');


/* MOBILE VERIFICATION OTP SEND */
Route::get('/sendopt', function() {
    
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getCountries', function(){
    $path = asset('assets/sites/countries.json'); // ie: /var/www/laravel/app/storage/json/filename.json
    return $json = file_get_contents($path);
});

Route::get('/truck-for-sale', 'WelcomeController@truckForSale')->name('home');
Route::get('/truck-for-rental', 'WelcomeController@truckForRental')->name('home');
Route::post('/handlePaymentResponse', 'PaymentController@handlePaymentResponse');

//Reset Password Routes
Route::get('/reset-password/{token}', 'ResetPasswordController@getPassword');
Route::post('/reset-password', 'ResetPasswordController@updatePassword');

//Forget Password Routes
Route::get('/forget-password', 'ForgotPasswordController@getEmail');
Route::post('/forget-password', 'ForgotPasswordController@postEmail');

// Set session for user Type
Route::post('/set-user-type-session', function(){
    $roleId = request()->input('role_id');
    Session::put('role_id_click',$roleId);
});

Route::get('verify-email/{email}/{verify_token}', 'Auth\RegisterController@verifyEmail');
Route::get('terms-and-conditions', function(){
    return view('sites/terms-conditions');
});
