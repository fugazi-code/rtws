<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    public function getDiscount($code)
    {
        return $this->newQuery()->where('code', $code)->first()->discount;
    }

    public function isExist($code)
    {
        return $this->newQuery()->where('code', $code)->exists();
    }

    public function isExpired($code)
    {
        return Carbon::now()->greaterThan($this->newQuery()->where('code', $code)->first()['expiration']);
    }

    public function isExceeded($code)
    {
        return count($this->codeUsed($code)->get()[0]->toArray()['history']) < $this->newQuery()
                                                                                     ->where('code', $code)
                                                                                     ->first()['overall'];
    }

    public function codeUsed($code)
    {
        return $this->newQuery()->where('code', $code)->with(['history']);
    }

    public function history()
    {
        return $this->hasMany(CodeHistory::class, 'promo_code_id', 'id');
    }

    public function newCode($code, $request)
    {
        $model             = new $this;
        $model->code       = $code;
        $model->overall    = $request->overall;
        $model->status     = 'active';
        $model->discount   = $request->discount;
        $model->expiration = $request->expiration;
        $model->save();
    }
}
