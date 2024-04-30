<?php

namespace App\Livewire\Discount;

use App\Models\DiscountSetting;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DiscountLivewire extends Component
{

    use LivewireAlert;

    public $discount;

    public function update(){
        $this->validate([
            'discount'=>'required|numeric',
        ]);
        $d = DiscountSetting::find(1) ;
        $d->discount = $this->discount;
        $d->save();

        $this->alert('success','successfully updated discount');

    }


    public function render()
    {   
        $d = DiscountSetting::find(1);
        $this->discount = $d->discount;
        return view('livewire.discount.discount-livewire');
    }
}
