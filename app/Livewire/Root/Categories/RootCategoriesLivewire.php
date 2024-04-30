<?php

namespace App\Livewire\Root\Categories;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RootCategoriesLivewire extends Component
{
    #[Layout('layouts.root')]
    public function render()
    {
        return view('livewire.root.categories.root-categories-livewire');
    }
}
