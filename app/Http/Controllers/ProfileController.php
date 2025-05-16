<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Ensure Auth facade is imported
use App\Models\User;
// use Auth;

class ProfileController extends Controller
{
    // Show Profile Edit Form
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    // Update Profile Information
   // In your ProfileController.php update method
public function update(Request $request)
{
    $user = User::find(auth()->id());

    $validated = $request->validate([
        'name' => 'required|string|max:50',
        'email' => 'required|email|max:255|unique:users,email,'.$user->id,
        'telephone' => 'nullable|string|max:20|regex:/^\+?[\d\s\-]+$/',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'current_password' => 'required_with:password|current_password',
        'password' => 'nullable|string|min:8|max:50|confirmed',
    ]);

    // Update basic info
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->telephone = $validated['telephone'] ?? null;

    // Update password if provided
    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    // Handle photo upload
    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('profile-photos', 'public');
        $user->photo_url = Storage::url($path);
    }

    $user->save();

    return redirect()->route('profile.edit')
                   ->with('success', 'Profile updated successfully!');
}
    // Change Password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Password changed successfully.');
    }
}
