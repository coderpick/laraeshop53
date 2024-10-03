<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProductController as ProductController2;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubCategoryController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

/* product details route */


Route::get('/shop', [ProductController2::class, 'products'])->name('products');

Route::get('/product/{slug}', [ProductController2::class, 'productDetail'])->name('product.detail');

Route::get('brand/{slug}', [ProductController2::class, 'brandProduct'])->name('brand.product');
Route::get('category/{category}/{subCategory?}', [ProductController2::class, 'categoryProduct'])->name('category.product');

/*------------------------------------------

--------------------------------------------

All Normal Users Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:user'])->group(function () {});



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



  Route::get('/product/trash/{id}', [ProductController::class, 'trash'])->name('product.trash');
  Route::get('/product/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');

  /* get subcategory by category id with ajax */
  Route::get('/get-sub-category', [AjaxController::class, 'getSubCategory'])->name('get.subcategory');


  Route::resource('slider', SliderController::class);

  Route::get('/slider/trash/{id}', [SliderController::class, 'trash'])->name('slider.trash');
  Route::get('/slider/restore/{id}', [SliderController::class, 'restore'])->name('slider.restore');
});



/*------------------------------------------

--------------------------------------------

All Admin Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:manager'])->group(function () {



  Route::get('/manager/dashboard', [HomeController::class, 'managerDashboard'])->name('manager.dashboard');
});
