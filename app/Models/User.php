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
        'status',
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
            'status' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
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

    public function getInitialsAttribute()
    {
        $name = trim($this->name);
        $words = preg_split('/\s+/', $name);

        // If name has 3 or more words → take first letter of first 3 words
        if (count($words) >= 3) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1) . substr($words[2], 0, 1));
        }

        // If name has 2 words → take first letters of both
        if (count($words) == 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }

        // If name is single word → take first 2 letters
        return strtoupper(substr($words[0], 0, 2));
    }
    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/users/' . $this->profile_image);
        }

        return null;
    }

    public function wishlists()
    {
        return $this->hasMany(\App\Models\Wishlist::class);
    }


}
