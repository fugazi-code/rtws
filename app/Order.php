<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function customer()
    {
        return $this->hasOne('App\User', 'id', 'customer_id');
    }
}
