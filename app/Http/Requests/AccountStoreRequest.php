<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"          => "required",
            "email"         => "required|unique:users|email:rfc,dns",
            "selfie_photo"  => "required|image",
            "license_plate" => "required|image",
            "front"         => "required|image",
            "side"          => "required|image",
            "back"          => "required|image",
            "or_cr"         => "required|image",
        ];
    }
}
