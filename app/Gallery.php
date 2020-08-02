<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['user_id', 'path', 'purpose'];

    public static function myProfilePic()
    {
        return self::query()->select('path')->where('user_id', auth()->id())->where('purpose', 'selfie_photo')->get();
    }
}
