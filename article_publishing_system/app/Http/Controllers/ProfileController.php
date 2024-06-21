<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string|email|max:255|unique:users,user_email,' . $user->id,
            'user_current_password' => 'required',
            'password' => 'nullable|string|min:8|confirmed',
            'user_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!Hash::check($request->user_current_password, $user->user_password)) {
            return back()->withErrors(['user_current_password' => 'The current password is incorrect.']);
        }
        $user->user_name = $request->user_name;
        $user->user_email = $request->user_email;

        if ($request->password) {
            $user->user_password = Hash::make($request->password);
        }

        // Handle profile picture upload
        if ($request->hasFile('user_pic')) {
            if ($user->user_pic) {
                Storage::delete('public/' . $user->user_pic);
            }
            $path = $request->file('user_pic')->store('profile_pics', 'public');
            $user->user_pic = $path;
        }


        $user->save();
        return redirect()->route('profile.edit')->with('status', 'Profile updated successfully.');
    }
}
