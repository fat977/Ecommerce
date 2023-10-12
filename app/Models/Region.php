<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Region extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function addresses(){
        return $this->hasMany(Address::class,'region_id')
        ->select('id','region_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id')
        ->select('id','name_'.LaravelLocalization::getCurrentLocale() . ' as name');
    }
}
