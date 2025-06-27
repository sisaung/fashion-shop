<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{

    protected $fillable = ['user_id','name','phone_number','city','township','address_detail'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
