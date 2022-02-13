<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\UserController;
Use App\Http\Controllers\Frontend\DefaultsController;
use App\Http\Controllers\Frontend\BlogsController;
use App\Http\Controllers\Frontend\PagesController;

Route::middleware(['admin'])->group(function () {
    Route::prefix('admin/settings')->group(function () {
        Route::get('', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('sortable', [SettingsController::class, 'sortable'])->name('settings.Sortable');
        Route::get('/delete/{id}', [SettingsController::class, 'destroy']);
        Route::get('/edit/{id}', [SettingsController::class, 'edit'])->name('settings.Edit');
        Route::post('update/{id}', [SettingsController::class, 'update'])->name('settings.Update');
    });
});

Route::middleware(['admin'])->group(function () {
    Route::prefix('admin')->group(function () {

        //Blog 
        Route::post('blog/sortable', [BlogController::class, 'sortable'])->name('blog.Sortable');
        Route::resource('blog', BlogController::class);
        //Page
        Route::post('page/sortable', [PageController::class, 'sortable'])->name('page.Sortable');
        Route::resource('page', PageController::class);
        //Slider
        Route::post('slider/sortable', [SliderController::class, 'sortable'])->name('slider.Sortable');
        Route::resource('slider', SliderController::class);
        //user
        Route::post('user/sortable', [UserController::class, 'sortable'])->name('user.Sortable');
        Route::resource('user', UserController::class);
    });
});
Route::prefix('admin')->group(function () {
    Route::get('/index', [DefaultController::class, 'index'])->name('admin.index')->middleware('admin');
    //Login
    Route::get('/', [DefaultController::class, 'login'])->name('admin.Login')->middleware('CheckLogin');
    Route::post('/', [DefaultController::class, 'authenticate'])->name('admin.Authenticate');
    Route::get('logout', [DefaultController::class, 'logout'])->name('admin.Logout');
});

//FRONTEND
Route::get('/', [DefaultsController::class, 'index'])->name('home.index');
//BLOG
Route::get('blog', [BlogsController::class, 'index'])->name('blog.Index');
Route::get('blog/{slug}', [BlogsController::class, 'detail'])->name('blog.Detail');

//PAGE
Route::get('page/{slug}', [PagesController::class, 'detail'])->name('page.Detail');

//Contact
Route::get('contact', [DefaultsController::class, 'contact'])->name('contact.Detail');
Route::post('contact', [DefaultsController::class, 'sendMail']);