<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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
    $page = "dashboard";
    return view('index', compact('page'));
})->name("/");

Route::get('product/index', [ProductController::class, "index"])->name('product/index');;
Route::get('product/create', [ProductController::class, "create"])->name('product/create');
Route::post('product/store', [ProductController::class, "store"])->name('product/store');
Route::get('product/destroy/{id}', [ProductController::class, "destroy"])->name('product/destroy');
Route::get('product/show/{id}', [ProductController::class, "show"])->name('product/show');

Route::get('category/index', [CategoryController::class, "index"])->name('category/index');
Route::get('category/create', [CategoryController::class, "create"])->name('category/create');
Route::post('category/store', [CategoryController::class, "store"])->name('category/store');
Route::get('category/destroy/{id}', [CategoryController::class, "destroy"])->name('category/destroy');
Route::get('category/show/{id}', [CategoryController::class, "show"])->name('category/show');