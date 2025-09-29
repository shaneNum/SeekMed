<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'username' => ['required', 'min:3', 'max:25', 'unique:users,username'],
            'password' => ['required', 'confirmed', 'string', 'min:8', 'max:25'],
            'role' => ['required', 'in:user,doctor']
        ]);
        app('otp')->create($credentials, 'register');
        return response()->view('otp', [
            'email' => $credentials['email'],
            'service' => 'register',
            'remember' => $request->filled('remember')
        ]);
    }
}
