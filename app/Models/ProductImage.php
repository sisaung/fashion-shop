<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    /** @use HasFactory<\Database\Factories\ProductImageFactory> */
    use HasFactory;
    protected $fillable = ['product_id', 'images','original_name','large','preview','thumbnail'];

    public function product() {
        return $this->belongsTo(Product::class);
    }



    public function getThumbnailAttribute($value)
    {
        return $value ? asset(Storage::url($value)) : null;
    }

    public function getPreviewAttribute($value)
    {
        return  $value ? asset(Storage::url($value)) : null;
    }

    public function getLargeAttribute($value)
    {
        return  $value ? asset(Storage::url($value)) : null;
    }
}
