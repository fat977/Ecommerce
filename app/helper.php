<?php

use Illuminate\Support\Facades\Lang;

function transl($key){
    if(!Lang::hasForLocale('website/header.'.$key,app()->getLocale())){
        return $key;
    }
    return __('website/header.'.$key);
}