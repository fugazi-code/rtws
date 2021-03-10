<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeHistory extends Model
{
    public function discount()
    {
        return $this->hasOne(PromoCode::class, 'id', 'promo_code_id');
    }
}
