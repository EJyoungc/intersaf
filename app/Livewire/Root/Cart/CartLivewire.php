<?php

namespace App\Livewire\Root\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\On;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CartLivewire extends Component
{
    use LivewireAlert;
    public $modal = false;
    public $totalPrice = 0;

    public function viewcart()
    {

        $this->modal = true;
    }

    #[On('cart_updated')]
    public function cart_updated()
    {

        $this->modal = false;
        $this->render();
    }


    public function remove_from_cart($id)
    {
        Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->delete();
        $this->alert('success', 'Item removed from cart');
    }

    public function subtract_quantity($id)
    {
        $cart = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
        if ($cart->quantity > 1) {
            $cart->decrement('quantity');
        } elseif ($cart->quantity == 1) {
            Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->delete();
        }
        $this->alert('success', 'Item removed from cart');
    }


    public function cancel()
    {
        $this->reset(['modal']);
    }

    public function add_quantity($id)
    {
        $cart = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
        $cart->increment('quantity');
        $this->alert('success', 'Item added to cart');
    }

    public function clear_cart()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
        $this->alert('success', 'Cart cleared');
    }





    public function checkout()
    {

        $cart = Cart::where('user_id', Auth::user()->id)->with('product')->get();
        // $cart = Cart::where('user_id',Auth::user()->id)->get();
        $this->totalPrice = $cart->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });


        $lineItems = [];

        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'mwk',
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => $item->product->price * 100, // Stripe requires amount in cents
                ],
                'quantity' => $item->quantity,
            ];
        }
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::create([

            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('root.products'),

        ]);

        session([
            'stripe_id' => $session->id,
            'total'=>$this->totalPrice,
        
        ]);
        return redirect()->to($session->url);
    


    }




    public function render()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $this->totalPrice = $cart->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });
        // dd($cart->sum('product.price');
        return view('livewire.root.cart.cart-livewire')->with('cart', $cart);
    }
}
