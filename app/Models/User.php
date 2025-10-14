<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🔹 All addresses
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    // 🔹 Multiple billing addresses
    public function billingAddresses()
    {
        return $this->hasMany(Address::class)->where('type', 'billing');
    }

    // 🔹 Multiple shipping addresses
    public function shippingAddresses()
    {
        return $this->hasMany(Address::class)->where('type', 'shipping');
    }
}
