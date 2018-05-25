<?php

namespace App\Http\Controllers\Auth;

use App\Enterprise;
use App\Http\Controllers\Controller;
use App\Rules\OldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModifyAccountController extends Controller
{

    public function updateUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'string|min:6|confirmed|nullable',
            'enterprise' => 'string|max:255',
            'oldpassword' => ['required', 'string', 'min:6', new OldPassword],
        ]);

        $user = Auth::user();

        if (isset($validatedData['name'])) {
            $user->name = $validatedData['name'];
        }

        if (isset($validatedData['email'])) {
            $user->email = $validatedData['email'];
        }

        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        if (isset($validatedData['enterprise'])) {
            $enterprise = Enterprise::where('name', $validatedData['enterprise'])->first();
            if (empty($enterprise)) {
                $enterprise = Enterprise::create([
                    'name' => $validatedData['enterprise'],
                ]);
                $user->enterprise = $enterprise['id'];
            }
        } else {
            $user->enterprise = null;
        }

        $user->save();

        return redirect(route('profile'));

    }

    public function updateUserForm()
    {
        return view("auth.modify");
    }

}
