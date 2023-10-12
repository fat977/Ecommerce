<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Category extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function section(){
        return $this->belongsTo(Section::class,'section_id')->select('id','name_'.LaravelLocalization::getCurrentLocale() . ' as name');
    }

    public function brands(){
        return $this->hasMany(Brand::class,'category_id');
    }

    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }
}
