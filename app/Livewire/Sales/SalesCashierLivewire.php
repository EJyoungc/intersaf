<?php

namespace App\Livewire\Sales;

use App\Models\Product;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SalesCashierLivewire extends Component
{
    use LivewireAlert;
    public $search;
    public Collection $cart;
    public $totalPrice = 0;


    public function mount()
    {
        $this->fill([
            'cart' => collect([]),
        ]);
        // dd($this->cart);
    }


    public function add_to_cart($id)
    {

        $p = Product::find($id);

        if (!$p || $p->quantity == 0) {
            // Handle the case where the product is not found or out of stock
            $this->alert('warning', 'Item out of stock', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
            return;
        }

        // Check if the product is already in the cart
        $existingItem = $this->cart->firstWhere('id', $id);

        if ($existingItem) {
            // If the product is already in the cart, check quantity and update
            if ($existingItem['quantity'] == $p->quantity) {
                $this->alert('warning', 'Exceeded Quantity', [
                    'position' =>  'top-end',
                    'timer' =>  3000,
                    'toast' =>  true,
                    'showCancelButton' =>  false,
                    'showConfirmButton' =>  false,
                ]);
                return;
            }
            $this->cart = $this->cart->map(function ($item) use ($id) {
                if ($item['id'] == $id) {
                    $item['quantity'] += 1;
                }
                return $item;
            });
        } else {
            // If the product is not in the cart, add it to the cart
            $this->cart->push([
                "id" => $p->id,
                "name" => $p->name,
                "quantity" => 1,
                'price' => $p->price
            ]);
        }
        $this->calculateTotalPrice();
    }
    public function calculateTotalPrice()
    {
        $this->totalPrice = $this->cart->sum(function ($item) {
            return $item['quantity'] * $item['price'];
        });
    }

    

    public function subtract_from_cart($id)
{
    $this->cart = $this->cart->map(function ($item) use ($id) {
        if ($item['id'] == $id) {
            $item['quantity'] -= 1;
        }
        return $item;
    })->filter(function ($item) use ($id) {
        // Remove items with quantity less than or equal to 0
        return $item['quantity'] > 0;
    });

    $this->calculateTotalPrice();
}

public function remove_from_cart($id)
{
    $this->cart = $this->cart->reject(function ($item) use ($id) {
        return $item['id'] == $id;
    });

    $this->calculateTotalPrice();
}




    public function render()
    {
        $p = Product::query();
        $p->where('name', 'like', '%' . $this->search . '%');
        $p = $p->get();
        // dd();

        return view('livewire.sales.sales-cashier-livewire')->with('products', $p);
    }
}
