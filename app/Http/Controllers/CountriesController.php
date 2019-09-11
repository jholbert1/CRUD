<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Country;
class CountriesController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        return response()->json([
            'country' => $countries,
        ]);
    }

    public function show(Request $request, $id)
    {

        $country = Country::where('id', $id)->with('state', 'state.city')->get();

        return response()->json([
            'country' => $country,
        ]);

    }
}
