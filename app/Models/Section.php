<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use function Laravel\Prompts\select;

class Section extends Model
{
    use HasFactory;
    protected $guarded=[];

    public static function sections(){
        $getSections = Section::with('categories')->select('id','name_'.LaravelLocalization::getCurrentLocale() . ' as name')->get();
        //dd($getSections);
        return $getSections;
    }
   

    public function categories(){
        return $this->hasMany(Category::class,'section_id')->select('id','section_id','name_'.LaravelLocalization::getCurrentLocale() . ' as name');
    }
}
