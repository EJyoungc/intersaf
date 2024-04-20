<?php

namespace App\Livewire\Dash\Category;

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CategoryLivewire extends Component
{
    use LivewireAlert;
    public $name;
    public $modal = false;
    public $category;

    public function edit($id){
        // check if id is not empty
        if(!empty($id)){
            // query the id from the cat table
            $this->category = Category::find($id);
            $this->name = $this->category->name;
            $this->modal =true;
        }

    }

    public function store()
    {

        if(empty($this->category->id)){
            // validating the input field
        $this->validate([
            'name' => 'required|string'
        ]);

        // submitting data to the category table using category class
        Category::create([
            'name' => $this->name
        ]);
        // reseting modal and name using the cancel function
        $this->cancel();
        // alert that its successfull
        $this->alert('success','Category created successfully!');
        }else{

            $this->validate([
                'name' => 'required|string'
            ]);

            $this->category->name = $this->name;
            $this->category->save();
            $this->cancel();
            $this->alert('success','Category updated successfully!');

        }

    }
    public function cancel()
    {
        $this->reset(['modal','name']);
    }

    public function create()
    {
        $this->modal = true;
    }
    public function render()
    {
        $c =  Category::get();
        // dd($c);
        return view('livewire.dash.category.category-livewire')->with('categories',$c);
    }
}
