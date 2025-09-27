<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => ['required', 'min:3', 'max:25'],
            'password' => ['required', 'string', 'min:8', 'max:25']
        ]);
        if (Auth::validate($credentials)) {
            $email = User::where('username', $credentials['username'])->value('email');
            $credentials['email'] = $email;
            app('otp')->create($credentials, 'login');
            return response()->view('otp', [
                'email' => $email,
                'service' => 'login',
                'remember' => $request->filled('remember')
            ]);
        }
        return back()->withErrors([
            'username' => 'Invalid Credentials!'
        ])->onlyInput('username');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
