<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'coupon_id',
        'customer_address_id',
        'order_number',
        'customer_name',
        'order_date',
        'total_amount',
        'order_status',
        'confirm_message',
        'deliver_message',
        'cancel_message',
        'is_cancel',
        'tax_amount',
        'net_total'

    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function customerAddress() {
        return $this->belongsTo(CustomerAddress::class);
    }
}
