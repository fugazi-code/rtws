<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function rebuildWallet()
    {
        $model          = new $this;
        $model->user_id = auth()->user()->id;
        $model->current = 0;
        $model->save();
    }

    public function isExist()
    {
        return ! $this::where('user_id', auth()->user()->id)->count() ? true : false;
    }

    public function current()
    {
        return number_format($this::where('user_id', auth()->user()->id)->get()[0]->current, 2);
    }

    public function id()
    {
        return $this::where('user_id', auth()->user()->id)->get()[0]->id;
    }

    public function deposit($requester, $value)
    {
        return $this::newQuery()->where('user_id', $requester)->increment('current', $value);
    }

    public function withdraw($requester, $value)
    {
        return $this::newQuery()->where('user_id', $requester)->decrement('current', $value);
    }
}
