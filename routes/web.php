<?php

use App\Models\Salebill;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SalebillController;
use App\Http\Controllers\SupplierController;

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
//?start//
Route::middleware('local')->group(function () {

    Route::get('/roles', [UserController::class, 'role']);

    //! DataTable
    Route::get('/product/table', [ProductController::class, 'table']);
    Route::get('/product/add', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/store', [ProductController::class, 'store'])->name('product.store');

    Route::get('/store/table', [StoreController::class, 'table']);
    Route::get('/stock/table', [StockController::class, 'table']);
    Route::get('/supplier/table', [SupplierController::class, 'table']);
    Route::get('/user/table', [UserController::class, 'table']);
    Route::get('/salebill/table', [SalebillController::class, 'table']);


    Route::middleware(['role:admin'])->group(function () {


    });

    Route::middleware(['role:admin'])->group(function () {



    });

    Route::middleware(['role:admin'])->group(function () {



    });

    Route::middleware(['role:admin'])->group(function () {



    });
});
Route::get('/lang/{lang}', [LanguageController::class, 'change'])->name('lang.change');
