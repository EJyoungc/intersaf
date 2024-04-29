<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;

class OrdersLivewire extends Component
{
    public function render()
    {


        $order = Order::all();

        return view('livewire.orders.orders-livewire')->with('orders',$order);
    }
}
