<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public static function myProfilePic()
    {
        return self::query()->select('path')->where('user_id', auth()->id())->where('purpose', 'Profile Pic')->get();
    }
}
