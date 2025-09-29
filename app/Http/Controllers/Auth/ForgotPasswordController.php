<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    public function sendResetLinkEmail(Request $request) {
        $request->validate(['email' => 'required|email']);
        usleep(random_int(1_000_000, 3_000_000));
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status !== Password::RESET_LINK_SENT) {
            usleep(random_int(3_000_000, 6_000_000));
        }
        return back()->with('status', 
            'Password reset link sent!'
        );
    }
}
