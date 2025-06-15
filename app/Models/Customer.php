<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    protected $fillable = ['customer_name','customer_email','profile_image'];

    public function addresses() {
        return $this->hasMany(CustomerAddress::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
