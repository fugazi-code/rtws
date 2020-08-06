<?php

namespace App\Http\Controllers\Auth;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewRegistration;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $requestHttp;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest');
        $this->requestHttp = $request;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
            "contact"      => ['required', 'string', 'max:255'],
            "birth_date"   => ['required', 'date'],
            "address"      => ['required', 'string', 'max:255'],
            "country"      => ['required', 'string', 'max:255'],
            "postal_code"  => ['required', 'string', 'max:255'],
            "certify"      => ['required'],
            "selfie_photo" => ['required', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'        => $data['name'],
            'email'       => $data['email'],
            'password'    => Hash::make($data['password']),
            'role'        => 'customer',
            'status'      => 'active',
            'contact'     => $data['contact'],
            'birth_date'  => $data['birth_date'],
            'address'     => $data['address'],
            'country'     => $data['country'],
            'postal_code' => $data['postal_code'],
        ]);

        $path = $this->requestHttp->file('selfie_photo')->store('details');

        Gallery::create([
            'user_id' => $user->id,
            'path'    => $path,
            'purpose' => 'selfie_photo',
        ]);

        User::find($user->id)->notify(new NewRegistration());

        return $user;
    }
}
