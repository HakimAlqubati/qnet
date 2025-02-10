<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create()
    {
        $countries = Country::with('cities')->get();
        return view('users.register', compact('countries'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phonenumber' => 'required|digits_between:10,15',
            'user_type' => ['required', Rule::in([User::USER_TYPE_CUSTOMER, User::USER_TYPE_ADMIN])],
            'parent_id' => 'nullable|exists:users,id',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'rank_id' => 'nullable|exists:ranks,id',
            'active' => 'boolean',
            'address' => 'nullable|string|max:500',
        ], [
            'name.required' => 'The name field is mandatory.',
            'email.required' => 'A valid email address is required.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'A password is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
            'phonenumber.required' => 'Please provide a phone number.',
            'phonenumber.digits_between' => 'The phone number must be between 10 to 15 digits.',
            'user_type.required' => 'The user type is required.',
            'user_type.in' => 'Invalid user type selected.',
            'country_id.required' => 'Please select a country.',
            'country_id.exists' => 'The selected country does not exist.',
            'city_id.required' => 'Please select a city.',
            'city_id.exists' => 'The selected city does not exist.',
            'rank_id.exists' => 'The selected rank is invalid.',
            'address.max' => 'The address may not be longer than 500 characters.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phonenumber' => $request->phonenumber,
            'user_type' => $request->user_type,
            'parent_id' => $request->parent_id,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'rank_id' => $request->rank_id,
            'active' => $request->active ?? false,
            'address' => $request->address,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
}
