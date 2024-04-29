<?php

namespace App\Livewire\Dash;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class DashboardLivewire extends Component
{
    public function render()
    {
        $orders  = Order::all();
        $products = Product::all();
        $Revenue =Order::sum('total');
        return view('livewire.dash.dashboard-livewire')->with('orders',$orders)->with('products',$products)->with('Revenue',$Revenue);
    }
}
