<?php

use App\Http\Controllers\PdfController;
use App\Livewire\Dash\Category\CategoryLivewire;
use App\Livewire\Dash\DashboardLivewire;
use App\Livewire\Dash\Products\ProductsLivewire;
use App\Livewire\Dash\Users\UsersLivewire;
use App\Livewire\Discount\DiscountLivewire;
use App\Livewire\Orders\OrdersLivewire;
use App\Livewire\Root\Categories\CategoryLivewire as CategoriesCategoryLivewire;
use App\Livewire\Root\Categories\RootCategoriesLivewire;
use App\Livewire\Root\Products\CategoryProductsLivewire;
use App\Livewire\Root\Products\ProductsLivewire as ProductsProductsLivewire;
use App\Livewire\Root\Products\RootProductsLivewire;
use App\Livewire\Root\Transaction\TransactionLivewire;
use App\Livewire\Root\Transaction\TransactionsLivewire;
use App\Livewire\Root\WelcomeLivewire;
use App\Livewire\Sales\SalesCashierLivewire;
use App\Livewire\Sales\SalesLivewire;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrders;
use Illuminate\Support\Facades\Auth;
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


Route::middleware(['auth', 'isadmin'])->group(function () {

 

    Route::get('/products', RootProductsLivewire::class)->name('root.products');
    Route::get('/categories', RootCategoriesLivewire::class)->name('root.categories');
    Route::get('/trasaction/status/{id}',TransactionLivewire::class)->name('root.transaction');
    Route::get('/orders',TransactionsLivewire::class)->name('root.orders');
    Route::get('/categories',CategoriesCategoryLivewire::class)->name('root.categories');
    Route::get('/categories/{id}/products',CategoryProductsLivewire::class)->name('root.cat.products');
    

    Route::get('/checkout/success/',function(){


        // dd(session('total'),session('stripe_id'));
        
        $o = Order::create([
            "stripe_id"=>session('stripe_id'),
            "total"=>session('total'),
            "user_id"=>Auth::user()->id,
            "status"=>"paid"
        ]);

        $cart = Cart::where('user_id',Auth::user()->id)->get();
        foreach($cart as $c){
            ProductOrders::create([
                "order_id"=>$o->id,
                "product_id"=>$c->product_id,
                "product_name"=>$c->product->name,
                "product_price"=>$c->product->price,
                'quantity'=>$c->product->quantity,
                "user_id"=>Auth::user()->id,
                "stripe_id"=>$c->stripe_id
            ]);

            $p = Product::find($c->product_id);
            // dd($p->quantity,$c->quantity ,$p->quantity - $c->quantity);
           $sub =  $p->quantity - $c->quantity;
            $p->quantity =  $sub;
            $p->save();
            $c->delete();
        }
        return redirect()->route('root.transaction',$o->id);

        

    })->name('checkout.success');
    // Route::get('/test',function(){
    //     echo "hello";
    // })->name('test');
    Route::middleware(['isadmin'])->group(function () {
        Route::get('/home', DashboardLivewire::class)->name('home');
        Route::get('/dash/users', UsersLivewire::class)->middleware('isadmin')->name('users');
        Route::get('/dash/products', ProductsLivewire::class)->name('products');
        Route::get('/dash/categories', CategoryLivewire::class)->name('category');
        Route::get('/dash/orders', OrdersLivewire::class)->name('orders');
        Route::get('/dash/sales/cashier', SalesCashierLivewire::class)->name('sales.cashier');
        Route::get('/dash/sales', SalesLivewire::class)->name('sales');
        Route::get('/dash/discount', DiscountLivewire::class)->name('discount');
        Route::get("/dash/reports",[PdfController::class,'report'])->name('pdf.report');

    });
});
