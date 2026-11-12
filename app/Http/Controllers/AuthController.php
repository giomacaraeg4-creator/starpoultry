<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        $account = Account::where(
            'user_name',
            $request->user_name
        )->first();

        if (!$account || !Hash::check(
            $request->password,
            $account->password_hash
        )) {
            return back()->withErrors([
                'login' => 'Invalid username or password.'
            ])->onlyInput('user_name');
        }

        if ($account->approval_status !== 'APPROVED') {
            return back()->withErrors([
                'login' => 'Your account is not yet approved.'
            ]);
        }

        if ($account->status !== 'ACTIVE') {
            return back()->withErrors([
                'login' => 'Your account is inactive.'
            ]);
        }

        if (!in_array($account->role, ['ADMIN', 'EMPLOYEE'])) {
            return back()->withErrors([
                'login' => 'Invalid account role.'
            ]);
        }

        $request->session()->regenerate();

        $request->session()->put([
            'account_id' => $account->id,
            'user_name' => $account->user_name,
            'role' => $account->role,
        ]);

        if ($account->role === 'ADMIN') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('employee.dashboard');
    }

    
   
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'You have successfully logged out.');
    }


}
