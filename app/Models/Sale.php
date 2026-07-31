<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'invoice_no',
        'branch_id',
        'customer_id',
        'sale_date',
        'total_amount',
        'down_payment',
        'remaining_amount',
        'installment_months',
        'monthly_installment',
        'next_due_date',
        'status',
        'remarks',
    ];

    protected $casts = [
        'sale_date' => 'date',
        'next_due_date' => 'date',
        'total_amount' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'monthly_installment' => 'decimal:2',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function recoveries()
    {
        return $this->hasMany(Recovery::class);
    }
}