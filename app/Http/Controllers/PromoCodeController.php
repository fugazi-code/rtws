<?php

namespace App\Http\Controllers;

use Faker\Factory;
use App\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function index()
    {
        return view('auth.promo_codes');
    }

    public function generate(Request $request, PromoCode $promo_code)
    {
        $faker = Factory::create();
        do {
            $generated_code = $faker->regexify('[A-Z0-9]{6,6}');
        } while ($promo_code->isExist($generated_code));

        $promo_code->newCode($generated_code, $request->discount);

        return ['success' => true];
    }

    public function fetch()
    {
        return PromoCode::all();
    }

    public function remove(Request $request)
    {
        PromoCode::destroy($request->id);

        return ['success' => true];
    }

    public function verify(Request $request, PromoCode $promo_code)
    {
        if ($promo_code->isExistAndUnused($request->promocode)) {
            return [
                'success'  => true,
                'discount' => PromoCode::query()->where('code', strtoupper($request->promocode))->first()->discount,
            ];
        } else {
            return ['success' => false];
        }
    }
}
