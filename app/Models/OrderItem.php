<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['stock_id','order_id','sale_price','quantity'];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    // public function product() {
    //     return $this->belongsTo(Product::class);
    // }

    // public function size() {
    //     return $this->belongsTo(Size::class);
    // }

    public function stock() {
        return $this->belongsTo(Stock::class);
    }
}
