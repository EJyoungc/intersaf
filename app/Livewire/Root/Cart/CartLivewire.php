<?php

namespace App\Livewire\Root\Cart;

use App\Models\Cart;
use App\Models\DiscountSetting;
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
    public $discount;

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
        // dd($cart);
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
        // Fetch the discount percentage from the DiscountSetting model
        $discountSetting = DiscountSetting::find(1);
        $discountPercentage = $discountSetting->discount;
        $this->discount = $discountPercentage;

        // Fetch the cart items for the current user
        $cart = Cart::where('user_id', Auth::user()->id)->with('product')->get();

        // Calculate the total price before applying the discount
        $totalPriceBeforeDiscount = $cart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Calculate the discount amount
        $discountAmount = ($totalPriceBeforeDiscount * $discountPercentage) / 100;

        // Calculate the total price after applying the discount
        $totalPriceAfterDiscount = $totalPriceBeforeDiscount - $discountAmount;

        // Prepare line items for Stripe checkout session
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

        // Set up Stripe session
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('root.products'),
        ]);

        // Store session ID and total amount in session for later retrieval
        session([
            'stripe_id' => $session->id,
            'total' => $totalPriceAfterDiscount, // Use the discounted total price
        ]);

        // Redirect to Stripe checkout page
        return redirect()->to($session->url);
    }





    public function render()
    {

        $discountSetting = DiscountSetting::find(1);
        $discountPercentage = $discountSetting->discount;
        $this->discount = $discountPercentage;

        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $this->totalPrice = $cart->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });
        // dd($cart->sum('product.price');
        return view('livewire.root.cart.cart-livewire')->with('cart', $cart);
    }
}
