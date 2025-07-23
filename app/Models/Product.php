<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
   
    protected $table = 'product';

    // protected $fillable = [
    //     'name',
    //     'status',
    //     'created_at',
    //     'updated_at'
    // ];

    public $guarded = [];

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
