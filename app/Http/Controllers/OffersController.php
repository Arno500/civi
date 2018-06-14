<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OffersController extends Controller
{
    

    protected function index()
    {
        $offers = Offer::orderBy('created_at', 'desc')->paginate(15);
        return view('offer.offers')->with('offers', $offers);
    }

    protected function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'duration' => 'required|integer'
        ]);

        $offer = Offer::create([
            'enterprise_id' => Auth::user()->enterprise,
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'internship_duration' => $validatedData['duration']
        ]);

        return redirect()->action('OffersController@offer', ['offerid' => $offer['id']]);
    }

    protected function offer(int $offerid)
    {
        $offer = Offer::find($offerid);
        if ($offer == null) {
            abort(404);
        }
        return view('offer.view', ['offer' => $offer]);
    }
}
