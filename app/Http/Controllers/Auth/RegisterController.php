<?php

namespace App\Http\Controllers\Auth;

use App\Enterprise;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
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
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        // Check enterprise and create it if needed
        if (isset($data['enterprise'])) {
            $enterprise = Enterprise::where('name', $data['enterprise'])->first();
            if (empty($enterprise)) {
                $enterprise = Enterprise::create([
                    'name' => $data['enterprise']
                ]);
            }
        } else {
            $enterprise['id']=null;
        }


        // Return the newly created user
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'enterprise' => $enterprise['id'],
            'password' => bcrypt($data['password']),
        ]);
    }

}
