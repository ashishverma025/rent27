<?php

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return redirect('/');
});

/* --------------------- Common/User Routes START -------------------------------- */
Route::get('/privacy-policy', 'WelcomeController@privacyPolicy');
Route::get('/terms-of-service', 'WelcomeController@termsOfService');

// Auth::routes();
Route::post('/registration', 'Auth\RegisterController@register');
Route::post('/signin', 'Auth\LoginController@signIn');

Route::post('/sign-in', 'Auth\RegisterController@signIn');

Route::get('/', 'WelcomeController@landing_index');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get("/homes", ["uses" => "HomeController@checkMD", "middleware" => "checkType:2"]);

// Route::get('admin', 'HomeController@index')->name('admin');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/change_password', 'UsersController@change_pwd');
Route::post('/change_password', 'UsersController@update_changed_pwd');

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

        //Reset Password Routes
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');

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


Route::get('/editprofile/{id?}', 'UsersController@editprofile');
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

