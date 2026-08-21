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

        'location',

        'latitude',

        'longitude',

        'customer_photo',

        'house_photo',

        'cnic_front',

        'cnic_back',

        'status',

    ];


    public function branch()
    {
        return $this->belongsTo(
            Branch::class
        );
    }
}