<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['prof', 'doctorant'])
                    ->latest()
                    ->paginate(20); // Reduced from 600 for better performance

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create', [
            'roles' => ['admin' => 'Admin', 'prof' => 'Professor', 'doctorant' => 'Doctoral Student'],
            'statuses' => ['active' => 'Active', 'inactive' => 'Inactive']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()->mixedCase()->numbers()->symbols()],
            'telephone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9\+\-\s]+$/'],
            'role' => ['required', 'string', 'in:admin,prof,doctorant'],
            'statut' => ['required', 'string', 'in:active,inactive'],
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telephone' => $request->telephone,
                'role' => $request->role,
                'statut' => $request->statut,
                'is_active' => $request->statut === 'active',
                'email_verified_at' => $request->statut === 'active' ? now() : null
            ]);

            Log::info('User created', ['user_id' => $user->id, 'by' => auth()->id()]);

            return redirect()->route('users.index')
                ->with('success', 'User created successfully.');

        } catch (\Exception $e) {
            Log::error('User creation failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to create user. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['prof', 'doctorant']);

        $loginHistory = [
            'last_login' => $user->last_login?->format('Y-m-d H:i:s'),
            'last_ip' => $user->last_login_ip,
            'login_attempts' => $user->login_attempts,
            'is_locked' => $user->isLocked
        ];

        return view('users.show', compact('user', 'loginHistory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => ['admin' => 'Admin', 'prof' => 'Professor', 'doctorant' => 'Doctoral Student'],
            'statuses' => ['active' => 'Active', 'inactive' => 'Inactive']
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$user->id}"],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()->mixedCase()->numbers()->symbols()],
            'telephone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9\+\-\s]+$/'],
            'role' => ['required', 'string', 'in:admin,prof,doctorant'],
            'statut' => ['required', 'string', 'in:active,inactive'],
        ]);

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'role' => $request->role,
                'statut' => $request->statut,
                'is_active' => $request->statut === 'active',
                'email_verified_at' => $request->statut === 'active'
                    ? ($user->email_verified_at ?? now())
                    : null
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
                $data['password_changed_at'] = now();
            }

            // Unlock account if status is changed to active
            if ($request->statut === 'active' && $user->isLocked) {
                $data['locked_until'] = null;
                $data['login_attempts'] = 0;
            }

            $user->update($data);

            Log::info('User updated', ['user_id' => $user->id, 'by' => auth()->id()]);

            return redirect()->route('users.index')
                ->with('success', 'User updated successfully.');

        } catch (\Exception $e) {
            Log::error('User update failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Failed to update user. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            Log::info('User deleted', [
                'user_id' => $user->id,
                'by' => auth()->id()
            ]);

            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully.');

        } catch (\Exception $e) {
            Log::error('User deletion failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Failed to delete user. Please try again.');
        }
    }

    /**
     * Unlock a locked user account
     */
    public function unlock(User $user)
    {
        try {
            $user->update([
                'locked_until' => null,
                'login_attempts' => 0
            ]);

            Log::info('User unlocked', [
                'user_id' => $user->id,
                'by' => auth()->id()
            ]);

            return back()->with('success', 'User account unlocked successfully.');

        } catch (\Exception $e) {
            Log::error('User unlock failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Failed to unlock user account.');
        }
    }
    public function block(User $user)
{
    $user->update([
        'locked_until' => now()->addDays(7), // Blocage pour 7 jours
        'login_attempts' => 5
    ]);

    return back()->with('success', 'Le compte a été bloqué avec succès.');
}

// Duplicate unlock method removed to avoid redeclaration error.
}
