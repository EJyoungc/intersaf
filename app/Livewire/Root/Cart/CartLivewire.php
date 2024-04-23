<?php

namespace App\Livewire\Root\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\On;

class CartLivewire extends Component
{
    use LivewireAlert;
    public $modal = false;
    public $totalPrice =0;

    public function viewcart (){

        $this->modal = true;
        

    }

    #[On('cart_updated')]
    public function cart_updated(){

        $this->modal = false;
        $this->render();
    }


    public function remove_from_cart($id){
        Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->delete();
        $this->alert('success', 'Item removed from cart');
    }
    
    public function subtract_quantity($id){
        $cart = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
        if($cart->quantity > 1){
            $cart->decrement('quantity');
        }elseif($cart->quantity == 1){
            Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->delete();
        }
        $this->alert('success', 'Item removed from cart');
    }


    public function cancel(){
        $this->reset(['modal']);
    }

    public function add_quantity($id){
        $cart = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
        $cart->increment('quantity');
        $this->alert('success', 'Item added to cart');
       
    }

    public function clear_cart(){
        Cart::where('user_id', Auth::user()->id)->delete();
        $this->alert('success', 'Cart cleared');
    }




    public function render()
    {   
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $this->totalPrice = $cart->sum(function($cart){
            return $cart->product->price * $cart->quantity;
        });
        // dd($cart->sum('product.price');
        return view('livewire.root.cart.cart-livewire')->with('cart',$cart);
    }
}
