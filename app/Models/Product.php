<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = ['product_name', 'product_code', 'slug', 'description', 'original_price', 'sale_price', 'discount_percentage', 'display_price', 'gender', 'is_new_arrival', 'product_type_id', 'product_category_id', 'brand_id', 'fit_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function fits()
    {
        return $this->belongsToMany(Fit::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    // public function orderItems()
    // {
    //     return $this->hasMany(OrderItem::class);
    // }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
