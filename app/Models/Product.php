<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    protected $fillable =['name', 'category_id','image' ,'price' ,'quantity','desc','category_id','user_id'];


    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }



}
