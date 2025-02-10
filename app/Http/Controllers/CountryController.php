<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function getCities($countryId)
    {
        $country = Country::find($countryId);

        if (!$country) {
            return response()->json(['error' => 'Country not found'], 404);
        }

        $cities = $country->cities()->get(['id', 'name']);

        return response()->json($cities);
    }
}
