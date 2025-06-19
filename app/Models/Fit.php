<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fit extends Model
{
    /** @use HasFactory<\Database\Factories\FitFactory> */
    use HasFactory;

    protected $fillable = ['fit_name' ,'product_type_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productTypes()
    {

        return $this->belongsToMany(ProductType::class,'fit_product_type');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
