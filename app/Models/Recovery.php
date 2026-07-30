<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Recovery extends Model
{
    protected $fillable = [
        'sale_id',
        'recovery_date',
        'amount_received',
        'remaining_balance',
        'user_id',
        'latitude',
        'longitude',
        'photo',
        'remarks',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}