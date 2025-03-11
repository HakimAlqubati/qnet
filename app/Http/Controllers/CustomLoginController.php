<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CustomLoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'identify_id' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt login using `identify_id` instead of email
        if (Auth::attempt(['identify_id' => $request->identify_id, 'password' => $request->password])) {
            return redirect('/'); // Redirect to home after login
        }

        return back()->withErrors(['identify_id' => 'Invalid credentials.']);
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
