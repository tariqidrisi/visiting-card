<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;

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

Route::get('/', ['middleware' => 'auth', function()
{
    return redirect('/dashboard');
}]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes(['register' => false]);
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/register', ['middleware' => 'auth', function()
{
    return redirect('/dashboard');
}]);

// Backend application routes
Route::group(['middleware' => 'auth'], function (){
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->name("dashboard");
    Route::get('company', 'App\Http\Controllers\DashboardController@company')->name("company");
    Route::get('new-company', 'App\Http\Controllers\DashboardController@newCompany')->name("new-company");
    Route::post('create-company', 'App\Http\Controllers\DashboardController@createCompany')->name("create-company");
    Route::post('ajax-update-company', 'App\Http\Controllers\DashboardController@ajaxUpdateCompany')->name("ajax-update-company");
    Route::get('company/{id}', 'App\Http\Controllers\DashboardController@viewCompany')->name("view-company");
    Route::post('company/update/{id}', 'App\Http\Controllers\DashboardController@updateCompany')->name("update-company");
    Route::post('ajax-update-customer', 'App\Http\Controllers\DashboardController@ajaxUpdateCustomer')->name("ajax-update-customer");
    Route::get('customer-information', 'App\Http\Controllers\DashboardController@customerInfo')->name("customer-information");
    Route::get('customer-information/{id}', 'App\Http\Controllers\DashboardController@viewCustomer')->name("view-customer");
    Route::post('customer-information/update/{id}', 'App\Http\Controllers\DashboardController@updateCustomer')->name("update-customer");
    Route::get('new-customer-info', 'App\Http\Controllers\DashboardController@newCustomerInfo')->name("new-customer-info");
    Route::post('create-customer-information', 'App\Http\Controllers\DashboardController@createCustomerInfo')->name("create-customer-information");
    Route::get('delete-records/{id}', 'App\Http\Controllers\DashboardController@destroy')->name("delete-records");
    Route::get('social-media', 'App\Http\Controllers\DashboardController@socialMedia')->name("social-media");
    Route::get('social-media/{id}', 'App\Http\Controllers\DashboardController@ajxSocialMedia')->name("social-media-company");
    Route::post('company-social-media', 'App\Http\Controllers\DashboardController@companySocialMedia')->name("company-social-media");
    Route::get('embed-video', 'App\Http\Controllers\DashboardController@embedVideo')->name("embed-video");
    Route::get('embed-video/{id}', 'App\Http\Controllers\DashboardController@ajaxEmbedVideo')->name("ajax-embed-video");
    Route::post('save-embed-video', 'App\Http\Controllers\DashboardController@saveVideo')->name("save-embed-video");


    // AWS image routes
    Route::get('image-upload', [ ImageUploadController::class, 'imageUpload' ])->name('image.upload');
    Route::post('image-upload', [ ImageUploadController::class, 'imageUploadPost' ])->name('image.upload.post');

});


// frontend routes
Route::get('/{profile}', 'App\Http\Controllers\FrontendController@profile')->name("profile");
Route::get('download-vcf/{id}', 'App\Http\Controllers\FrontendController@downloadVcf')->name("download-vcf");


