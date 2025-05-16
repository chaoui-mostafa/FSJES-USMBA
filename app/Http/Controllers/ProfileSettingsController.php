<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ProfileSettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user instanceof \App\Models\User) {
            abort(500, 'Authenticated user is not a valid User instance.');
        }
        return view('profile.settings', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'dark_mode' => 'nullable|boolean',
            'receive_notifications' => 'nullable|boolean'
        ]);

        $user = Auth::user();
        if ($user instanceof \App\Models\User) {
            foreach ($validated as $key => $value) {
                $user->$key = $value;
            }
            $user->save();
        } else {
            abort(500, 'Authenticated user is not a valid User instance.');
        }

        return redirect()
            ->back()
            ->with('success', 'Settings updated successfully.');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Logout before deletion to prevent session issues
        Auth::logout();

        // Delete user
        $user->delete();

        // Invalidate session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Your account has been deleted successfully.');
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ]);

        $user = $request->user();
        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        // Optional: Send password change notification
        // $user->notify(new PasswordChangedNotification());

        return redirect()
            ->back()
            ->with('success', 'Password changed successfully.');
    }
}