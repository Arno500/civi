<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $userEnterprise = $user['enterprise'];

        if ($userEnterprise >= 1){
            $userModel = User::findOrFail(Auth::user()->id);
            $enterpriseData = $userModel->enterprise()->first()->description;
            if ($enterpriseData == null){
                return view('auth.enterprise-setup');
            } else {
                return view('profile_enterprise');
            }
        } else {
            return view('profile');
        }
    }
}
