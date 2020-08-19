<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        "vehicle",
        "service",
        "sub",
        "schedule",
        "pick_up",
        "drop_off",
        "amount",
        "customer_id",
        "status",
        "ref_no",
        "weight",
        "budget",
    ];

    public function customer()
    {
        return $this->hasOne('App\User', 'id', 'customer_id');
    }

    public function rider()
    {
        return $this->hasOne('App\User', 'id', 'rider_id');
    }

    public function photo()
    {
        return $this->hasOne('App\Gallery', 'user_id', 'customer_id')->where('purpose', 'selfie_photo');
    }

    public function pending()
    {
        return self::query()
                   ->with(['customer', 'photo'])
                   ->where('status', 'pending')
                   ->orderBy('created_at', 'desc');
    }

    public function yours()
    {
        return self::query()
                   ->where('status', 'accepted')
                   ->where('rider_id', auth()->id())
                   ->with(['rider', 'photo', 'customer'])
                   ->orderBy('created_at', 'desc');
    }

    public function complete()
    {
        return self::query()
                   ->where('status', 'complete')
                   ->where('rider_id', auth()->id())
                   ->with(['rider', 'photo', 'customer'])
                   ->orderBy('created_at', 'desc');
    }
}
