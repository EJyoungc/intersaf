<?php

namespace App\Livewire\Root\Transaction;
use Livewire\Attributes\Layout;
use App\Models\Order;
use App\Models\ProductOrders;
use Livewire\Component;

class TransactionLivewire extends Component
{

    public $order;
    
    public $modal = false;
    public function mount($id){
       $this->order = Order::find($id);
    }

    public function  create(){
        $this->modal = true;
    }

    public function cancel(){
        $this->$this->reset(['modal']);
    }

    #[Layout('layouts.root')]
    public function render()
    {
        $products = ProductOrders::where('order_id', $this->order->id)->get();
        // dd($products);
        return view('livewire.root.transaction.transaction-livewire')->with('products',$products);
    }
}
