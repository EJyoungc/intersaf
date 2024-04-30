<?php

namespace App\Livewire\Root\Products;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Livewire\Attributes\Url;
use Livewire\Component;

class CategoryProductsLivewire extends Component
{

    use LivewireAlert;

    public $category;

    #[Url]
    public $search = "";

    public function add_to_cart($id)
    {
        $p = Product::find($id);
        // dd($p);
        if (!$p || $p->quantity == 0) {
            $this->alert('warning', 'Item out of stock', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
            return;
        }

        $cart = Cart::where('product_id', $p->id)->where('user_id', Auth::user()->id)->first();
        if ($cart) {
            $cart->increment('quantity');
            $this->alert('success', 'Item added to cart');
            $this->dispatch('cart_updated');
        } else {
            Cart::create([
                'product_id' => $p->id,
                'quantity' => 1,
                'user_id' => Auth::user()->id,
            ]);
            $this->alert('success', 'Item added to cart');
            $this->dispatch('cart_updated');
        }
    }

    public function remove_from_cart($id)
    {
        Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->delete();
        $this->alert('success', 'Item removed from cart');
    }

    public function clear_cart()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
        $this->alert('success', 'Cart cleared');
    }

    public function mount($id)
    {
        $this->category  = Category::find($id);
    }


    #[Layout('layouts.root')]
    public function render()
    {
        $p = Product::query();
        $p->with('category');
        // if ($this->search !== '') {
        $p = Product::query();
        $p->with('category');
        $p->whereNot('quantity', 0);
        $p->where('category_id', $this->category->id);
        $p->where(function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        });
        // dd($p->get());
        // }


        $p = $p->get();
        return view('livewire.root.products.category-products-livewire')->with('products', $p);
    }
}
