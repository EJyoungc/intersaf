<?php

namespace App\Livewire\Orders;

use App\Mail\OrderNotifications;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class OrdersLivewire extends Component
{
    use LivewireAlert;

    public function send_notif($id){

        $order = Order::find($id);
        Mail::to($order->user->email)->send(new OrderNotifications($order->user));
        $this->alert('success', 'Notification sent successfully');
    }

    public function render()
    {


        $order = Order::all();

        return view('livewire.orders.orders-livewire')->with('orders',$order);
    }
}
