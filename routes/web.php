<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*------------------------------------------

--------------------------------------------

All Normal Users Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:user'])->group(function () {



    Route::get('/home', [HomeController::class, 'index'])->name('home');
});



/*------------------------------------------

--------------------------------------------

All Admin Routes List

--------------------------------------------

--------------------------------------------*/

Route::prefix('admin/')->as('admin.')->middleware(['auth', 'user-access:admin'])->group(function () {



    Route::get('dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');


    Route::resource('category', CategoryController::class);

    Route::resource('subcategory', SubCategoryController::class);

    Route::resource('brand', BrandController::class);


    Route::resource('product', ProductController::class);

    /* get subcategory by category id with ajax */
    Route::get('/get-sub-category', [AjaxController::class, 'getSubCategory'])->name('get.subcategory');
});



/*------------------------------------------

--------------------------------------------

All Admin Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:manager'])->group(function () {



    Route::get('/manager/dashboard', [HomeController::class, 'managerDashboard'])->name('manager.dashboard');
});
