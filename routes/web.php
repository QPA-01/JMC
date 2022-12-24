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

Route::group(['middleware' => 'auth:web'], function () {
    Route::resource(\App\Http\Controllers\RoleController::ROUTE_BASE, \App\Http\Controllers\RoleController::class);
    Route::resource(
        \App\Http\Controllers\DocumentTypeController::ROUTE_BASE,
        \App\Http\Controllers\DocumentTypeController::class
    );
    Route::resource(
        \App\Http\Controllers\UserController::ROUTE_BASE,
        \App\Http\Controllers\UserController::class
    );
    Route::resource(
        \App\Http\Controllers\CategoryEquipmentController::ROUTE_BASE,
        \App\Http\Controllers\CategoryEquipmentController::class
    );
    Route::resource(
        \App\Http\Controllers\EquipmentController::ROUTE_BASE,
        \App\Http\Controllers\EquipmentController::class
    );
    Route::resource(
        \App\Http\Controllers\LoanDetailController::ROUTE_BASE,
        \App\Http\Controllers\LoanDetailController::class
    )->middleware('admin');
    Route::get(
        '/user/update/password',
        [\App\Http\Controllers\UserController::class, 'update_password']
    )->name('update_password');
    Route::post(
        '/user/update/password',
        [\App\Http\Controllers\UserController::class, 'update_password_action']
    )->name('update_password_form');
    Route::get(
        '/home',
        [App\Http\Controllers\HomeController::class, 'index']
    )->name('home');
    Route::post(
        '/user/search/params',
        [\App\Http\Controllers\UserController::class, 'search']
    )->name('search_user');
    Route::get(
        '/equipment/category/summary',
        [\App\Http\Controllers\EquipmentController::class, 'get_equipments_category']
    )->name('find_equipaments');
    Route::get(
        '/loan_detail/generate/summary',
        [\App\Http\Controllers\LoanDetailController::class, 'get_category_sumary_action']
    )->name('generate_loan')->middleware('admin');
    Route::post(
        '/loan_detail/sumary_equipaments',
        [\App\Http\Controllers\LoanDetailController::class, 'get_equipament_sumary_action']
    )->name('sumary_equipments')->middleware('admin');
    Route::post(
        '/loan_detail/generate',
        [\App\Http\Controllers\LoanDetailController::class, 'create']
    )->name('sumary_generate')->middleware('admin');
});
