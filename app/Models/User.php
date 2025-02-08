<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be appended to model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = ['isAdmin']; // Always include `isAdmin` when user is serialized

    /**
     * User-Roles Relationship (Many-to-Many)
     */
    public function roles() {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole($role) {
        return $this->roles()->where('name', $role)->exists();
    }

    /**
     * Accessor for `isAdmin` attribute
     */
    public function getIsAdminAttribute() {
        return $this->hasRole('admin') || $this->hasRole('moderator');
    }
}
