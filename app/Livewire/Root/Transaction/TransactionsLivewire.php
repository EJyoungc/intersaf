<?php

namespace App\Livewire\Root\Transaction;
use Livewire\Attributes\Layout;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransactionsLivewire extends Component
{
    #[Layout('layouts.root')]
    public function render()
    {
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('livewire.root.transaction.transactions-livewire')->with('orders',$orders);
    }
}
