<?php

namespace App\Http\Controllers;

use Faker\Factory;
use App\PromoCode;
use Carbon\Carbon;
use App\CodeHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\GenerateCodeRequest;

class PromoCodeController extends Controller
{
    public function index()
    {
        return view('auth.promo_codes');
    }

    public function generate(GenerateCodeRequest $request, PromoCode $promo_code)
    {
        $faker = Factory::create();
        do {
            $generated_code = $faker->regexify('[A-Z0-9]{6,6}');
        } while ($promo_code->isExist($generated_code));

        $promo_code->newCode($generated_code, $request);

        return ['success' => true];
    }

    public function fetch(PromoCode $promoCode)
    {
        return DataTables::of(PromoCode::all())->setTransformer(function ($value) use ($promoCode) {
            $value               = collect($value)->toArray();
            $value['expiration'] = Carbon::parse($value['expiration'])->format('m/d/y');
            $value['used']       = count($promoCode->codeUsed($value['code'])->first()['history']);

            return $value;
        })->make(true);
    }

    public function remove(Request $request)
    {
        PromoCode::destroy($request->id);

        return ['success' => true];
    }

    public function verify(Request $request, PromoCode $promo_code, CodeHistory $codeHistory)
    {
        if (! $promo_code->isExist($request->promocode)) {
            return ['message' => 'Promo code does not exist!', 'discount' => 0];
        }
        if (! $promo_code->isExceeded($request->promocode)) {
            return ['message' => 'Promo code exceed number of uses!', 'discount' => 0];
        }
        if ($promo_code->isExpired($request->promocode)) {
            return ['message' => 'Promo code is expired!', 'discount' => 0];
        }

        $promo_code_id = PromoCode::query()->where('code', $request->promocode)->first()->id;
        if ($codeHistory->newQuery()
                        ->where('promo_code_id', $promo_code_id)
                        ->where('customer_id', auth()->id())
                        ->exists()) {
            return ['message' => 'You already used this code!', 'discount' => 0];
        }

        return ['message' => 'success', 'discount' => $promo_code->getDiscount($request->promocode)];
    }
}
