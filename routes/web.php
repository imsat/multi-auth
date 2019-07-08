<?php

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

Route::get('/', function () {
    return view('welcome');
//    return App::environment();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//, 'middleware' => ['customer']
Route::group(['prefix' => 'customer'], function() {

// Authentication Routes...
Route::get('login', 'CustomerAuth\LoginController@showLoginForm')->name('customer.login');
Route::post('login', 'CustomerAuth\LoginController@login');
Route::post('logout', 'CustomerAuth\LoginController@logout')->name('customer.logout');

// Registration Routes...
Route::get('register', 'CustomerAuth\RegisterController@showRegistrationForm')->name('customer.register');
Route::post('register', 'CustomerAuth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'CustomerAuth\ForgotPasswordController@showLinkRequestForm')->name('customer.password.request');
Route::post('password/email', 'CustomerAuth\ForgotPasswordController@sendResetLinkEmail')->name('customer.password.email');
Route::get('password/reset/{token}', 'CustomerAuth\ResetPasswordController@showResetForm')->name('customer.password.reset');
Route::post('password/reset', 'CustomerAuth\ResetPasswordController@reset')->name('customer.password.update');

// Email Verification Routes...
Route::get('email/verify', 'CustomerAuth\VerificationController@show')->name('customer.verification.notice');
Route::get('email/verify/{id}', 'CustomerAuth\VerificationController@verify')->name('customer.verification.verify');
Route::get('email/resend', 'CustomerAuth\VerificationController@resend')->name('customer.verification.resend');

});

Route::view('/customer/home', 'customer-home')->middleware('customer');
