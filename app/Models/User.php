<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'branch_id',
        'role_id',
        'name',
        'email',
        'password',
        'designation',
        'mobile',
        'profile_photo',
        'status',
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

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function hasRole(string $roleName): bool
    {
        return $this->role && $this->role->name === $roleName;
    }

    public function isCEO(): bool
    {
        return $this->hasRole('ceo');
    }

    public function isSalesManager(): bool
    {
        return $this->hasRole('sales_manager');
    }

    public function isSalesOfficer(): bool
    {
        return $this->hasRole('sales_officer');
    }

    public function isSalesman(): bool
    {
        return $this->hasRole('salesman');
    }

    public function isRecoveryOfficer(): bool
    {
        return $this->hasRole('recovery_officer');
    }

    public function isAccountant(): bool
    {
        return $this->hasRole('accountant');
    }

    public function isActive(): bool
    {
        return $this->status === 'Active';
    }
}