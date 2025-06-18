<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = ['customer_id','phone_number','city','township','address_detail'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function order() {
        return $this->hasOne(Order::class);
    }

}
