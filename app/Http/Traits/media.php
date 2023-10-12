<?php
namespace App\Http\traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait media{

    public function uploadAvatar($file)
    {
        $file->store('/', 'avatars');
        return $file->hashName();
    }

    public function uploadImage($file, $path)
    {
        $file->store($path);
        return $file->hashName();
    }
    
    public function uploadAvatarFromURL($url){
        $avatar = file_get_contents($url);
        $hashName = hash('sha256', $avatar).'.png';
        Storage::disk('avatars')->put($hashName, $avatar);
        return $hashName;
    }
}