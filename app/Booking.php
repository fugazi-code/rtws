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
        "distance",
        "budget",
        "exact_address",
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

    public function yours($id)
    {
        return self::query()
                   ->selectRaw('*, \'\' as validCancel')
                   ->where('status', 'accepted')
                   ->where('rider_id', $id)
                   ->with(['rider', 'photo', 'customer'])
                   ->orderBy('created_at', 'desc');
    }

    public function complete($id)
    {
        return self::query()
                   ->where('status', 'complete')
                   ->where('rider_id', $id)
                   ->with(['rider', 'photo', 'customer'])
                   ->orderBy('created_at', 'desc');
    }

    public function cancelled($id)
    {
        return self::query()
                   ->where('status', 'cancelled')
                   ->where('rider_id', $id)
                   ->with(['rider', 'photo', 'customer'])
                   ->orderBy('created_at', 'desc');
    }

    public function isAlreadyAccepted($id)
    {
        return $this::query()->where('id', $id)->where('status', 'accepted')->count() > 0;
    }

    public static function limitBooking($id)
    {
        return (new static())::query()->where('rider_id', $id)->where('status', 'accepted')->count() >= 2;
    }
}
