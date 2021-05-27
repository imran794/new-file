<?php

use App\Http\Controllers\User\UserController;
Use App\Http\Controllers\Admin\AdminController;
Use App\Http\Controllers\Admin\IndexController;
Use App\Http\Controllers\Admin\BrandController;
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

Route::get('/',[IndexController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin','middleware' =>['admin','auth'],'namespace'=>'Admin'], function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::post('update/Data',[AdminController::class,'updateData'])->name('update.Data');
    Route::get('image/update',[AdminController::class,'imageupdate'])->name('admin.image.update');
    Route::post('update/Data/post',[AdminController::class,'updateDatapost'])->name('update.Data.post');
    Route::get('change/passwprd',[AdminController::class,'adminchangepasswprd'])->name('admin.change.passwprd');
    Route::post('update/password/data',[AdminController::class,'updatepassworddata'])->name('update.password.data');

    // barnd part
    Route::get('brand',[BrandController::class,'brand'])->name('brand');
    Route::post('brand/post',[BrandController::class,'brandstore'])->name('brand.post');
    Route::get('inactive/{id}',[BrandController::class,'admininactive']);
    Route::get('active/{id}',[BrandController::class,'adminactive']);
});

Route::group(['prefix'=>'user','middleware' =>['user','auth'],'namespace'=>'User'], function(){
    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::post('edit/profile',[UserController::class,'updateData'])->name('edit-profile');
    Route::get('image/update',[UserController::class,'imageupdate'])->name('image.update');
    Route::post('update/image/post',[UserController::class,'updatepost'])->name('update.image.post');
    Route::get('change/passwprd',[UserController::class,'changepasswprd'])->name('change.passwprd');
    Route::post('password/store',[UserController::class,'passwordstore'])->name('password.store');
});

