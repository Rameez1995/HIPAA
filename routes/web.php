<?php

use Illuminate\Support\Facades\Route;

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
});

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');










Route::prefix('admin')->group(function(){
    Route::get('/dashboard', 'App\Http\Controllers\HomeController@index')->name('admin.dashboard');
    Route::get('/login', 'App\Http\Controllers\Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'App\Http\Controllers\Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/register', 'App\Http\Controllers\Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
    Route::post('/register', 'App\Http\Controllers\Auth\AdminRegisterController@register')->name('admin.register.submit');

    /** Training Routes */
Route::get('trainings', [App\Http\Controllers\TrainingController::class, 'index'])->name('trainings.index');
Route::get('trainings/create', [App\Http\Controllers\TrainingController::class, 'create'])->name('trainings.create');
Route::post('trainings/store', [App\Http\Controllers\TrainingController::class, 'store'])->name('trainings.store');
Route::get('trainingdetails/{id}',[App\Http\Controllers\TrainingController::class, 'display']);
Route::get('trainings/edit/{id}', [App\Http\Controllers\TrainingController::class, 'edit'])->name('trainings.edit');
Route::post('trainings/update', [App\Http\Controllers\TrainingController::class, 'update'])->name('trainings.update');

Route::get('getmyprofile', [App\Http\Controllers\EditProfileController::class, 'getmyprofile'])->name('getmyprofile');
Route::get('editprofile', [App\Http\Controllers\EditProfileController::class, 'editprofile'])->name('editprofile');
Route::put('updateprofile', [App\Http\Controllers\EditProfileController::class, 'updateprofile'])->name('update.profile');
Route::put('updatepassword', [App\Http\Controllers\EditProfileController::class, 'passwordupdate'])->name('update.password');




Route::post('categories/statusupdate/active', [App\Http\Controllers\CategoryController::class, 'statusupdateactive'])->name('category-status-active-update');
Route::post('categories/statusupdate/inactive', [App\Http\Controllers\CategoryController::class, 'statusupdateinactive'])->name('category-status-inactive-update');


/** Categories Routes */
Route::get('categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::post('categories/create', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
Route::post('categories/statusupdate/active', [App\Http\Controllers\CategoryController::class, 'statusupdateactive'])->name('category-status-active-update');
Route::post('categories/statusupdate/inactive', [App\Http\Controllers\CategoryController::class, 'statusupdateinactive'])->name('category-status-inactive-update');


/** Quiz Management Routes */
Route::post('quiz', [App\Http\Controllers\QuizController::class, 'index'])->name('quiz.index');
Route::post('quiz/store', [App\Http\Controllers\QuizController::class, 'store'])->name('quizes.store');

Route::post('resources/store', [App\Http\Controllers\ResourceController::class, 'store'])->name('resources.store');

});


// Vendor routes
Route::prefix('vendor')->group(function(){
    Route::get('/', 'App\Http\Controllers\Users\Vendor\VendorController@index')->name('vendor.dashboard');
    Route::get('/login', 'App\Http\Controllers\Auth\VendorLoginController@showLoginForm')->name('vendor.login');
    Route::post('/login', 'App\Http\Controllers\Auth\VendorLoginController@login')->name('vendor.login.submit');
    Route::get('/register', 'App\Http\Controllers\Auth\VendorRegisterController@showRegisterForm')->name('vendor.register');
    Route::post('/register', 'App\Http\Controllers\Auth\VendorRegisterController@register')->name('vendor.register.submit');
});