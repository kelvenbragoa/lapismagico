<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auxiliar-create-registration', [App\Http\Controllers\GlobalController::class, 'auxiliaregistration']);
Route::get('/auxiliar-create-registration1/{id}', [App\Http\Controllers\GlobalController::class, 'auxiliaregistrationcity1']);
Route::get('/auxiliar-create-registration2/{id}', [App\Http\Controllers\GlobalController::class, 'auxiliaregistrationcity2']);
Route::get('/auxiliar-create-registration3/{id}', [App\Http\Controllers\GlobalController::class, 'auxiliaregistrationcity3']);
Route::get('/auxiliar-create-registration4/{id}', [App\Http\Controllers\GlobalController::class, 'auxiliaregistrationcity4']);
Route::get('/registration/count', [App\Http\Controllers\Admin\DashboardController::class, 'getRegistrationCount']);




Route::group(['middleware'=>['auth','admin']], function(){
    Route::get('/admins/dashboard/getdashboarddata', [App\Http\Controllers\Admin\DashboardController::class, 'dashboarddata']);

    Route::resource('users', 'App\Http\Controllers\Admin\UsersController');
    Route::resource('schoolyear', 'App\Http\Controllers\Admin\SchoolYearController');
    Route::resource('registration', 'App\Http\Controllers\Admin\RegistrationController');
    Route::resource('taxes', 'App\Http\Controllers\Admin\TaxesController');
    Route::post('/upload-profile-image', [App\Http\Controllers\Admin\RegistrationController::class, 'uploadimage']);
});


Route::get('{view}', ApplicationController::class)->where('view','(.*)')->middleware('auth');
