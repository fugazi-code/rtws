<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    public function store($booking_id, $wallet_id, $rider_id, $original_amount, $withheld)
    {
        $model                  = new $this;
        $model->booking_id      = $booking_id;
        $model->wallet_id       = $wallet_id;
        $model->rider_id        = $rider_id;
        $model->original_amount = $original_amount;
        $model->withheld        = $withheld;
        $model->save();
    }
}
