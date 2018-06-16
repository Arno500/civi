<?php

namespace App\Http\Controllers\Auth;

use App\Enterprise;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class EnterpriseController extends Controller
{
    protected function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'city' => 'required|string|max:255',
            'country' => 'required|size:3',
            'website' => 'required|url',
            'logo' => 'required|image'
        ]);

        $user = Auth::user();
        $userEnterprise = $user['enterprise'];

        $enterprise = Enterprise::find($userEnterprise);

        $image = Image::make($request->file('logo'))->widen(250)->encode('jpg');
        $imageFilename = str_slug($validatedData['name']);
        $pathStorage = 'public/img/enterprise-logos/' . $imageFilename . '.jpg';
        $pathPublic = 'storage/img/enterprise-logos/' . $imageFilename . '.jpg';

        Storage::put($pathStorage, $image->__toString());

        $enterprise->name = $validatedData['name'];
        $enterprise->description = $validatedData['description'];
        $enterprise->city = $validatedData['city'];
        $enterprise->country = $validatedData['country'];
        $enterprise->website = $validatedData['website'];
        $enterprise->logourl = $pathPublic;

        $enterprise->save();

        return redirect()->action('HomeController@index')->with('message', 'created');
    }

    protected function display()
    {
        return redirect()->action('HomeController@index');
    }
}
