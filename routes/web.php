<?php

use App\Models\Salebill;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SalebillController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\NotificationController;

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
})->name('home');

//?start//
Route::middleware('local')->group(function () {

    Route::get('/roles', [UserController::class, 'role']);

    //! DataTable Product
    Route::get('/product/table', [ProductController::class, 'table'])->name('product.table');
    Route::get('/product/add', [ProductController::class, 'create'])->name('product.new');
    Route::POST('/product/store', [ProductController::class, 'store'])->name('product.store');
    // ?todo Excel routes
    Route::get('/excel', [ProductController::class, 'excel'])->name('excel.index');
    Route::POST('/product/importExcel', [ProductController::class, 'importExcel'])->name('product.importExcel');
    Route::get('/product/show/{product}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::POST('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');


    //! DataTable Store
    Route::get('/store/table', [StoreController::class, 'table'])->name('store.table');
    Route::get('/store/add', [StoreController::class, 'create'])->name('store.new');
    Route::get('/store/store', [StoreController::class, 'store'])->name('store.store');

    //! DataTable Stock
    Route::get('/stock/table', [StockController::class, 'table'])->name('stock.table');

    //! DataTable Supplier
    Route::get('/supplier/table', [SupplierController::class, 'table'])->name('supplier.table');
    Route::get('/supplier/add', [SupplierController::class, 'create'])->name('supplier.new');
    Route::POST('/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');

    //! DataTable User
    Route::get('/user/table', [UserController::class, 'table'])->name('user.table');
    Route::get('/user/add', [UserController::class, 'create'])->name('user.new');
    Route::get('/user/store', [UserController::class, 'store'])->name('user.store');

    //! DataTable Salebill
    Route::get('/salebill/table', [SalebillController::class, 'table'])->name('salebill.table');
    Route::get('/salebill/add', [SalebillController::class, 'create'])->name('salebill.new');
    Route::POST('/salebill/store', [SalebillController::class, 'store'])->name('salebill.store');
    Route::get('/api/invoice/{code}', [SalebillController::class, 'infocode'])->name('salebill.infocode');
    Route::POST('/salebill/calculate/price', [SalebillController::class, 'calculatePrice'])->name('salebill.price');

    //! Print Salebill
    Route::get('/print-content', [SalebillController::class, 'printfatoorah'])->name('print.content');


    //! Setting 
    Route::get('/seeting-create', [SettingController::class, 'create'])->name('setting.create');
    Route::POST('/setting/store', [SettingController::class, 'store'])->name('setting.store');

    //! Auth 
    Route::get('/login', [UserController::class, 'loginIndex'])->name('loginindex');
    Route::POST('/login/check', [UserController::class, 'login'])->name('login');
    Route::get('/login/checklogin', function () {
        redirect(route('logout'));
    });
    Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
    Route::POST('/regist/create', [UserController::class, 'register'])->name('register');
    Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/notifications/fetch', function () {
        $notifications = auth()->user()->unreadNotifications;
        return response()->json([
            'notifications' => $notifications->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'message' => $notification->data['message'],
                ];
            })
        ]);
    })->name('notifications.fetch');

    //! landing Page
    Route::get('/home-Gadwalls', [UserController::class, 'home'])->name('homeindex');


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
Route::get('/verfiyemail/{user}', [UserController::class, 'verfiy'])->name('verify.email');
