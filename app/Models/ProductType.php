<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    /** @use HasFactory<\Database\Factories\ProductTypeFactory> */
    use HasFactory;
    protected $fillable = ['name', 'product_category_id', 'user_id'];

    public function productCategory()
    {

        return $this->belongsTo(ProductCategory::class);
    }

    public function user()
    {

        return $this->belongsTo(User::class);
    }
}
