<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validation des identifiants
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Vérification de l'existence de l'utilisateur
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Adresse email non reconnue.',
            ])->with('error', 'Aucun compte trouvé avec cette adresse email.');
        }

        // Clé de limitation (email + IP)
        $throttleKey = Str::lower($request->input('email')).'|'.$request->ip();

        // Vérification des tentatives excessives
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            event(new Lockout($request));

            $seconds = RateLimiter::availableIn($throttleKey);

            Log::warning('Tentatives excessives depuis IP: '.$request->ip().' avec email: '.$request->email);

            return back()->withErrors([
                'email' => 'Trop de tentatives. Veuillez réessayer dans '.$seconds.' secondes.',
            ])->with('error', 'Votre compte est temporairement bloqué. Veuillez patienter.');
        }

        // Vérification du statut du compte
        if (!$user->is_active) {
            RateLimiter::hit($throttleKey, 60);
            return back()->withErrors([
                'email' => 'Ce compte est désactivé.',
            ])->with('error', 'Compte inactif. Contactez l\'administrateur.');
        }

        // Vérification du verrouillage du compte
        if ($user->login_attempts >= 5 && $user->locked_until && $user->locked_until > now()) {
            $remainingTime = Carbon::now()->diffInMinutes($user->locked_until);
            Log::warning('Tentative de connexion sur compte verrouillé: '.$request->email);

            return back()->withErrors([
                'email' => 'Compte verrouillé. Réessayez dans '.$remainingTime.' minutes.',
            ])->with('error', 'Compte temporairement verrouillé pour sécurité.');
        }

        // Tentative d'authentification
        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Enregistrement de l'échec
            $user->increment('login_attempts');

            // Verrouillage après 5 échecs
            if ($user->login_attempts >= 5) {
                $user->update([
                    'locked_until' => Carbon::now()->addMinutes(30),
                    'login_attempts' => 0
                ]);

                Log::warning('Verrouillage du compte après échecs multiples: '.$request->email);

                return back()->withErrors([
                    'email' => 'Trop de tentatives échouées. Compte verrouillé 30 minutes.',
                ])->with('error', 'Sécurité : votre compte est verrouillé temporairement.');
            }

            RateLimiter::hit($throttleKey, 60);

            $remainingAttempts = 5 - $user->login_attempts;

            return back()->withErrors([
                'email' => 'Identifiants incorrects.',
            ])->with('error', 'Il vous reste '.$remainingAttempts.' tentatives.');
        }

        // Connexion réussie
        $request->session()->regenerate();
        RateLimiter::clear($throttleKey);

        // Mise à jour des informations de connexion
        $user->update([
            'login_attempts' => 0,
            'locked_until' => null,
            'last_login' => now(),
            'last_login_ip' => $request->ip(),
            'last_login_user_agent' => $request->userAgent()
        ]);

        Log::info('Connexion réussie: '.$user->email.' depuis IP: '.$request->ip());

        // Détection d'activité suspecte
        $this->checkSuspiciousLogin($user, $request);

        // Redirection selon le rôle
        return $this->authenticatedRedirect($user);
    }

    protected function checkSuspiciousLogin($user, $request)
    {
        $suspicious = false;

        // Détection de nouvel appareil
        if ($user->last_login_user_agent &&
            $user->last_login_user_agent !== $request->userAgent()) {
            $suspicious = true;
        }

        // Détection de nouvelle localisation
        if ($user->last_login &&
            Carbon::parse($user->last_login)->diffInMinutes(now()) < 120 &&
            $user->last_login_ip !== $request->ip()) {
            $suspicious = true;
        }

        if ($suspicious) {
            Log::warning('Activité suspecte détectée pour: '.$user->email, [
                'ancienne_ip' => $user->last_login_ip,
                'nouvelle_ip' => $request->ip(),
                'ancien_appareil' => $user->last_login_user_agent,
                'nouvel_appareil' => $request->userAgent()
            ]);

            // Ici vous pourriez envoyer une notification par email
        }
    }

    protected function authenticatedRedirect($user)
    {
        $redirectTo = match($user->role) {
            'admin' => '/dashboard',
            'prof' => '/professeur',
            'doctorant' => '/doctorant',
            default => '/',
        };

        $welcomeMessage = match($user->role) {
            'admin' => 'Bienvenue Administrateur '.$user->name.'!',
            'prof' => 'Bienvenue Professeur '.$user->name.'!',
            'doctorant' => 'Bienvenue Doctorant '.$user->name.'!',
            default => 'Bienvenue '.$user->name.'!',
        };

        return redirect()->intended($redirectTo)->with('success', $welcomeMessage);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info('Déconnexion de: '.($user ? $user->email : 'inconnu').' depuis IP: '.$request->ip());

        return redirect('/login')
            ->with('success', 'Vous avez été déconnecté avec succès.');
    }
}
