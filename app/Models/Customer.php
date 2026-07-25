<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'branch_id',
        'name',
        'father_name',
        'cnic',
        'mobile',
        'address',
        'status',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}