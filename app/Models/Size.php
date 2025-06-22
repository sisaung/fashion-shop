<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    /** @use HasFactory<\Database\Factories\SizeFactory> */
    use HasFactory;
    protected $fillable = ['size_name', 'user_id', 'product_type_id','stock_id'];

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function productTypes()
    {
        return $this->belongsToMany(ProductType::class, 'product_type_size');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_size', 'size_id', 'product_id');
    }

    public function stocks() {
        return $this->hasMany(Stock::class);
    }

    // public function orderItems() {
    //     return $this->hasMany(OrderItem::class);
    // }
}
