<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function brands()
    {

        return $this->hasMany(Brand::class);
    }

    public function productCategoires()
    {

        return $this->hasMany(ProductCategory::class);
    }

    public function productTypes()
    {
        return $this->hasMany(ProductType::class);
    }

    public function sizes() {
        return $this->hasMany(Size::class);
    }

    public function products() {
        $this->hasMany(Product::class);
    }

    public function coupons() {
        $this->hasMany(Coupon::class);
    }

    public function reviews() {
        $this->hasMany(Review::class);
    }

    public function wishlists() {
        $this->hasMany(Wishlist::class);
    }

    public function getProfileImageAttribute($value) {
        return $value ? asset(Storage::url($value)) : null;
    }
}
