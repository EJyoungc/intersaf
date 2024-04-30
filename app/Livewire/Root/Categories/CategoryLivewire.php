<?php

namespace App\Livewire\Root\Categories;
use Livewire\Attributes\Layout;

use App\Models\Category;
use Livewire\Component;

class CategoryLivewire extends Component
{



    #[Layout('layouts.root')]
    public function render()
    {
        $cat = Category::all();
        return view('livewire.root.categories.category-livewire')->with('categories',$cat);
    }
}
