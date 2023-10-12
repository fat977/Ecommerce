<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class City extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function regions(){
        return $this->hasMany(Region::class,'city_id')
        ->select('id','city_id','name_'.LaravelLocalization::getCurrentLocale() . ' as name');
    }
}
