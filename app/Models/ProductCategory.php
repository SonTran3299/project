<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_category';

    // protected $fillable = [
    //     'name',
    //     'slug',
    //     'status',
    //     'created_at',
    //     'updated_at'
    // ];
    public $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
}