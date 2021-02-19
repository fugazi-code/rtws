<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    public function isExist($code)
    {
        return $this->newQuery()->where('code', $code)->exists();
    }

    public function newCode($code, $discount)
    {
        $model              = new $this;
        $model->booking_id  = null;
        $model->customer_id = null;
        $model->code        = $code;
        $model->status      = 'unused';
        $model->discount    = $discount;
        $model->save();
    }
}
