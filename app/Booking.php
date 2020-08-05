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
        "pick-up",
        "drop-off",
        "amount",
        "customer_id",
        "status",
    ];
}
