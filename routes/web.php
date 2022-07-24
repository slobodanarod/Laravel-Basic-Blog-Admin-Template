<?php

use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CategoryContoller;
use App\Http\Controllers\Backend\IndexController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->as('admin.')->group(function () {

    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/login',[AuthController::class,'loginPost'])->name('login_post');

    Route::middleware(['admin'])->group(function () {
        Route::get('/change_admin_mode',[AuthController::class,'change_admin_mode'])->name('change_mode');
        Route::get('user/edit',[AuthController::class,'edit'])->name('user.edit');
        Route::post('user/edit',[AuthController::class,'editPost'])->name('user.edit.post');
        Route::get('/dashboard',[IndexController::class,'index'])->name('index');
        Route::get('/logout',[AuthController::class,'logout'])->name('logout');
        Route::resources([
            'categories' => CategoryContoller::class,
            'blog' => BlogController::class,
            'settings' => SettingsController::class,
        ]);
    });

});
