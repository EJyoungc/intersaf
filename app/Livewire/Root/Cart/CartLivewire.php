<?php

namespace App\Livewire\Root\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartLivewire extends Component
{

    public $modal = false;

    public function viewcart (){

        $this->modal = true;
        

    }
    public function render()
    {   
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('livewire.root.cart.cart-livewire')->with('cart',$cart);
    }
}
