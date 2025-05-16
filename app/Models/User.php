<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   protected $fillable = [
    'name',
    'email',
    'password',
    'telephone',
    'role',
    'statut',
    'last_login',
    'login_attempts',
    'locked_until',
    'last_login_ip',
    'last_login_user_agent',
    'is_active',
    'dark_mode',
    'receive_notifications'
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login' => 'datetime',
            'locked_until' => 'datetime',
            'deleted_at' => 'datetime',
            'is_active' => 'boolean',
            'login_attempts' => 'integer',
        ];
    }

    /**
     * Check if the user is currently locked
     */
    public function getIsLockedAttribute(): bool
    {
        return $this->locked_until && $this->locked_until > now();
    }

    /**
     * Check if the user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a professor
     */
    public function isProfessor(): bool
    {
        return $this->role === 'prof';
    }

    /**
     * Check if the user is a doctoral student
     */
    public function isDoctorant(): bool
    {
        return $this->role === 'doctorant';
    }

    /**
     * Reset login attempts and unlock account
     */
    public function resetLoginAttempts(): void
    {
        $this->update([
            'login_attempts' => 0,
            'locked_until' => null
        ]);
    }

    /**
     * Record a failed login attempt
     */
    public function recordFailedLoginAttempt(): void
    {
        $this->increment('login_attempts');

        if ($this->login_attempts >= 5) {
            $this->update([
                'locked_until' => now()->addMinutes(30),
                'login_attempts' => 0
            ]);
        }
    }

    /**
     * Record successful login
     */
    public function recordSuccessfulLogin(Request $request): void
    {
        $this->update([
            'last_login' => now(),
            'last_login_ip' => $request->ip(),
            'last_login_user_agent' => $request->userAgent(),
            'login_attempts' => 0,
            'locked_until' => null
        ]);
    }

    /**
     * Relationship with Prof model
     */
    public function prof(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Prof::class, 'user_id');
    }

    /**
     * Relationship with Doctorant model
     */
    public function doctorant(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Doctorant::class, 'user_id');
    }

    /**
     * Scope for active users
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for locked users
     */
    public function scopeLocked($query)
    {
        return $query->whereNotNull('locked_until')
                    ->where('locked_until', '>', now());
    }
}
