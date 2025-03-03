<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdentifyController extends Controller
{
    public function verify(Request $request)
    {
        $codeQ = $request->input('code_q');
        // Example: Check if the ID exists in the database
        $exists = \App\Models\User::where('code_q', $codeQ)->exists();

        return response()->json([
            'success' => $exists
        ]);
    }
}
