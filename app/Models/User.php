<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function shortUrls(): HasMany
    {
        return $this->hasMany(ShortUrl::class, 'created_by');
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class, 'invited_by');
    }

    public function isSuperAdmin(): bool
    {
        return $this->role?->name === Role::SUPER_ADMIN;
    }

    public function isAdmin(): bool
    {
        return $this->role?->name === Role::ADMIN;
    }

    public function isMember(): bool
    {
        return $this->role?->name === Role::MEMBER;
    }
}
