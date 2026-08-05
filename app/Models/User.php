<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'branch_id',
        'name',
        'email',
        'password',
        'role',
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

    /*
    |--------------------------------------------------------------------------
    | Role Helpers
    |--------------------------------------------------------------------------
    */

    public function isCEO()
    {
        return $this->role === 'CEO';
    }

    public function isBranchManager()
    {
        return $this->role === 'Branch Manager';
    }

    public function isSalesManager()
    {
        return $this->role === 'Sales Manager';
    }

    public function isSalesman()
    {
        return $this->role === 'Salesman';
    }

    public function isRecoveryManager()
    {
        return $this->role === 'Recovery Manager';
    }

    public function isRecoveryOfficer()
    {
        return $this->role === 'Recovery Officer';
    }

    public function isAccountant()
    {
        return $this->role === 'Accountant';
    }

    /*
    |--------------------------------------------------------------------------
    | Status Helper
    |--------------------------------------------------------------------------
    */

    public function isActive()
    {
        return $this->status === 'Active';
    }
}