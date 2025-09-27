<?php

namespace App;

use App\Mail\OtpMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class Otp
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function send(string $email, OtpMail $mail) {
        Mail::to($email)->send($mail);
    }
    public function create(array $data, string $service) {
        $email = $data['email'];
        $otp = rand(100000, 999999);
        Cache::put("otp_{$service}_{$email}", [
            'data' => $data,
            'otp' => $otp,
        ], now()->addMinutes(10));
        $mail = new OtpMail($otp);
        $this->send($email, $mail);
        return $otp;
    }
    public function get(string $email, string $service) {
        return Cache::get("otp_{$service}_{$email}");
    }
    public function forget(string $email, string $service) {
        Cache::forget("otp_{$service}_{$email}");
    }
}
