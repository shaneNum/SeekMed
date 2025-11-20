<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(User $user) {
        $isOwner = Auth::check() && Auth::id() === $user->id;
        return view('user.profile', [
            'user' => $user,
            'isOwner' => $isOwner
        ]);
    }
    public function update(Request $request, User $user) {
        if (Auth::id() !== $user->id) abort(403, "Unauthorized.");
        $validated = $request->validate([
            'username' => ['required', 'min:3', 'max:25', 'unique:users,username'],
            'profile_picture' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png,webp', function($attr, $value, $fail) {
                if (!@getimagesize($value->getPathname())) $fail('Invalid file.');
            }],
        ]);
        $user->username = $validated['username'];
        if ($request->hasFile('profile_picture')) {
            $image = imagecreatefromstring(file_get_contents($request->file('profile_picture')));
            ob_start();
            imagejpeg($image, null, 90);
            $clean = ob_get_clean();
            $user->profile_picture = $clean;
        }
        $user->save();
        return back()->with('success', 'Your Profile has been Updated!');
    }
}
