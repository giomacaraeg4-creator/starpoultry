<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'user_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('accounts', 'user_name'),
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'user_name.required' => 'Please enter your username.',
            'user_name.unique' => 'This username is already taken.',
            'password.required' => 'Please enter your password.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        Account::create([
            'user_name' => $validated['user_name'],

            'password_hash' => Hash::make(
                $validated['password']
            ),

            'role' => 'EMPLOYEE',
            'status' => 'ACTIVE',
            'approval_status' => 'PENDING',
        ]);

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Registration successful! Your account is waiting for Administrator approval.'
            );
    }
}
