<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /** @use HasFactory<\Database\Factories\CouponFactory> */
    use HasFactory;
    protected $fillable = ['coupon_title','coupon_code','coupon_discount','coupon_expire_date','user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

}
// santar
