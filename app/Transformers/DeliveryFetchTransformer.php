<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class DeliveryFetchTransformer extends TransformerAbstract
{
    public function transform($value)
    {
        $value['schedule'] = Carbon::parse($value['schedule'])->format('F j, Y');
        $value['created_at'] = Carbon::parse($value['created_at'])->format('F j, Y');
        $value['service'] = ucfirst($value['service']);

        return $value;
    }
}
