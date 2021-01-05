<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')->group(function(){
    Route::get('/',[DashboardController::class,'getDashboard'])->name('dashboard');

    //Module User
    Route::get('/users/{status}',[UserController::class,'getUsers'])->name('user_list');
    Route::get('/user/{id}/edit',[UserController::class,'getUserEdit'])->name('user_edit');
    Route::post('/user/{id}/edit',[UserController::class,'postUserEdit'])->name('user_edit');
    Route::get('/user/{id}/permissinons',[UserController::class,'getUserPermissinons'])->name('user_permissinons');
    Route::post('/user/{id}/permissinons',[UserController::class,'postUserPermissinons'])->name('user_permissinons');
    Route::get('/user/{id}/banned',[UserController::class,'getUserBanned'])->name('user_banned');

    //Module Products
    Route::get('/products/{status}',[ProductController::class,'getHome'])->name('products');
    Route::get('/product/add',[ProductController::class,'getProductAdd'])->name('product_add');
    Route::post('/product/add',[ProductController::class,'postProductAdd'])->name('product_add');
    Route::post('/product/search',[ProductController::class,'postProducSearch'])->name('product_search');
    Route::get('/product/category',[ProductController::class,'getCategory'])->name('product_get_category');
    Route::get('/product/{id}/edit',[ProductController::class,'getProductEdit'])->name('product_edit');
    Route::post('/product/{id}/edit',[ProductController::class,'postProductEdit'])->name('product_edit');
    Route::get('/product/{id}/delete',[ProductController::class,'getProductDelete'])->name('product_delete');
    Route::get('/product/{id}/restore',[ProductController::class,'getProductRestore'])->name('product_restore');
    Route::post('/product/{id}/galery/add',[ProductController::class,'postProductGaleryAdd'])->name('product_galery_add');
    Route::get('/product/{id}/galery/{gid}/delete',[ProductController::class,'getProductGaleryDelete'])->name('product_galery_delete');

    //Modulo Categories
    Route::get('/categories/{module}',[CategoriesController::class,'getHome'])->name('categories');
    Route::post('/category/add',[CategoriesController::class,'postCategoryAdd'])->name('category_add');
    Route::get('/category/{id}/edit',[CategoriesController::class,'getCategoryEdit'])->name('category_edit');
    Route::post('/category/{id}/edit',[CategoriesController::class,'postCategoryEdit'])->name('category_edit');
    Route::get('/category/{id}/delete',[CategoriesController::class,'getCategoryDelete'])->name('category_delete');
});
