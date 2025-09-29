<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class PostOTPController extends Controller
{
    public function verify(Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
            'service' => ['required', 'in:register,login'],
            'remember' => ['nullable'],
            'otp' => ['required', 'numeric', 'digits:6']
        ]);
        $data = app('otp')->get($request->email, $request->service);
        if (!$data) {
            return view('otp', [
                'email' => $request->email,
                'service' => $request->service,
                'remember' => $request->remember,
                'errors' => new MessageBag(['otp' => 'OTP expired!']),
                'old' => $request->all()
            ]);
        }
        if ($request->otp != $data['otp']) {
            return view('otp', [
                'email' => $request->email,
                'service' => $request->service,
                'remember' => $request->remember,
                'errors' => new MessageBag(['otp' => 'Invalid OTP!']),
                'old' => $request->all()
            ]);
        }
        if ($request->service == 'register') {
            $credentials = $data['data'];
            $role = Role::where('name', $credentials['role'])->firstOrFail();
            $user = User::create([
                'email' => $credentials['email'],
                'username' => $credentials['username'],
                'password' => Hash::make($credentials['password']),
                'role_id' => $role->id,
                'email_verified_at' => now()
            ]);
        } elseif ($request->service == 'login') {
            $user = User::where('email', $request->email)->firstOrFail();
        } 
        app('otp')->forget($request->email, $request->service);
        Auth::login($user, $request->filled('remember'));
        $request->session()->regenerate();
        $request->session()->regenerateToken();
        return redirect()->intended('dashboard');
    }
}
