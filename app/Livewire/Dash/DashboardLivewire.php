<?php

namespace App\Livewire\Dash;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardLivewire extends Component
{

    public $modal = false;
    public function create($id = null)
    {
        $this->modal = true;
    }

    public function cancel()
    {
        $this->reset(['modal']);
    }

    public function mount()
    {
        if (Auth::user()->role == 'admin') {
        } else {
            return redirect(route('root.products'));
        }
    }
    public function render()
    {


        $orders  = Order::all();
        $products = Product::all();
        $Revenue = Order::sum('total');
        return view('livewire.dash.dashboard-livewire')->with('orders', $orders)->with('products', $products)->with('Revenue', $Revenue);

        return redirect(route('root.products'));
    }
}
