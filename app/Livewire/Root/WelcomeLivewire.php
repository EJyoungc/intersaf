<?php

namespace App\Livewire\Root;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

class WelcomeLivewire extends Component
{

    

    #[Layout('layouts.root')] 
    public function render()
    {
        $cat = Category::get();
        $p = Product::get();
        return view('livewire.root.welcome-livewire')->with('categories',$cat)->with('products',$p);
    }
}
