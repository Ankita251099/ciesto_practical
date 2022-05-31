<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";


      public function shop_name()
    {
    	return $this->belongsTo(Shop::class,'shop_id');
    }
}
