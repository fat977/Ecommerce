<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $touches = ['products'];

    public function products(){
        return $this->belongsToMany(Product::class,'products_offers');
    }
}
