<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable ,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_banned',
        'banned_until',
        'device_name',
        'facebook_id',
        'gauth_id',
        'gauth_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => strtolower($value),
        );
    }

    public function addresses(){
        return $this->hasMany(Address::class,'user_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'carts')
        ->select('products.id','image','price','name_'.LaravelLocalization::getCurrentLocale() . ' as name')
        ->withPivot('quantity')->withTimestamps();
    }

    public function product_wishlists(){
        return $this->belongsToMany(Product::class,'wishlists')
        ->select('products.id','image','name_'.LaravelLocalization::getCurrentLocale() . ' as name')
        ->withTimestamps();
    }

    public function product_reviews(){
        return $this->belongsToMany(Product::class,'reviews')->withPivot('value','review')->withTimestamps();
    }
}
