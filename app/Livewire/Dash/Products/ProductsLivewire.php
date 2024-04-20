<?php

namespace App\Livewire\Dash\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductsLivewire extends Component
{

    use WithFileUploads;
    use LivewireAlert;
    public $name , $category ,$image ,$price ,$quantity,$description;
    public $modal = false;
    public $product;

    public function create($id = null){
        if(!empty($id)){

            $this->product = Product::find($id);
            $this->name =  $this->product->name;
            $this->price = $this->product->price;
            $this->category = $this->product->category_id;
            $this->quantity = $this->product->quantity;
            $this->description = $this->product->desc;
            $this->modal = true;
        }else{
            $this->modal = true;
        }
    }

    public function cancel(){
        $this->reset(['name', 'category' ,'price','image' ,'quantity','description','modal','product']);
        $this->modal = false; // Add this line to hide the form when 'x' button is clicked
    }

    public function store(){
        if(empty($this->product->id)){
            $this->validate([
                'name'=>'required',
                'category'=>'required' ,
                'price' =>'required|numeric',
                'image'=>'required|image',
                'quantity'=>'required|numeric',
                'description'=>'required'
            ]);

             $file =  $this->image->store('images');

            Product::create([
                'name'=>$this->name,
                'category_id'=>$this->category,
                'price'=>$this->price,
                'quantity'=>$this->quantity,
                'user_id'=> Auth::user()->id,
                'image'=>$file,
                'desc'=>$this->description,

            ]);
            $this->cancel();
            $this->alert('success','success added products');


        }else{
            $this->validate([
                'name'=>'required',
                'image'=>'required|image',
                'category'=>'required' ,
                'price' =>'required|numeric' ,
                'quantity'=>'required|numeric',
                'description'=>'required'
            ]);

            $p =Product::find($this->product->id);
            
            Storage::disk('custom')->delete($p->image);
            $file = $this->image->store('images');
            if(!empty($file)){

                $p->update([
                    'name'=>$this->name,
                    'category_id'=>$this->category,
                    'price'=>$this->price,
                    'quantity'=>$this->quantity,
                    'user_id'=> Auth::user()->id,
                    'desc'=>$this->description,
                    'image'=>$file,
    
                ]);
            }else{
                
            $p->update([
                'name'=>$this->name,
                'category_id'=>$this->category,
                'price'=>$this->price,
                'quantity'=>$this->quantity,
                'user_id'=> Auth::user()->id,
                'desc'=>$this->description,
                // 'image'=>$file,

            ]);
            }
            $this->cancel();
            $this->alert('success','success updated products');


        }

    }

    public function render()
    {

        $c = Category::all();
        $p = Product::all();
        $product_value = $p->sum('price') * $p->sum('quantity');

        return view('livewire.dash.products.products-livewire')->with('categories',$c)->with('products',$p)->with('product_value',$product_value);
    }
}
