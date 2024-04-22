<?php

namespace App\Livewire\Root\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class CartLivewire extends Component
{

    public $modal = false;

    public function viewcart (){

        $this->modal = true;
        

    }

    #[On('cart_updated')]
    public function cart_updated(){

        $this->modal = false;
        $this->render();
    }




    public function render()
    {   
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('livewire.root.cart.cart-livewire')->with('cart',$cart);
    }
}
