<?php

use App\Livewire\Dash\Category\CategoryLivewire;
use App\Livewire\Dash\DashboardLivewire;
use App\Livewire\Dash\Products\ProductsLivewire;
use App\Livewire\Dash\Users\UsersLivewire;
use App\Livewire\Orders\OrdersLivewire;
use App\Livewire\Root\Products\ProductsLivewire as ProductsProductsLivewire;
use App\Livewire\Root\WelcomeLivewire;
use App\Livewire\Sales\SalesCashierLivewire;
use App\Livewire\Sales\SalesLivewire;
use Illuminate\Support\Facades\Route;

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

Route::get('/', WelcomeLivewire::class);

Auth::routes();


Route::middleware(['auth'])->group(function () {

    Route::get('/home', DashboardLivewire::class)->name('home');
    Route::get('dash/users', UsersLivewire::class)->middleware('isadmin')->name('users');
    Route::get('dash/products', ProductsLivewire::class)->name('products');
    Route::get('dash/categories',CategoryLivewire::class)->name('category');
    Route::get('dash/orders',OrdersLivewire::class)->name('orders');
    Route::get('dash/sales/cashier',SalesCashierLivewire::class)->name('sales.cashier');
    Route::get('dash/sales',SalesLivewire::class)->name('sales');
    //normal user
    Route::get('/products',ProductsLivewire::class)->name('root.products');
    Route::get('/categories',ProductsLivewire::class)->name('root.categories');

});
// Route::middleware(['auth','isadmin'])->group(function () {


// });
