<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'invoice_no',
        'branch_id',
        'customer_id',
        'salesman_id',
        'sales_officer_id',
        'recovery_officer_id',
        'sale_date',
        'total_amount',
        'market_advance',
        'down_payment',
        'remaining_amount',
        'installment_months',
        'monthly_installment',
        'next_due_date',
        'status',
        'approval_status',
        'approved_by',
        'approved_at',
        'remarks',
    ];

    protected $casts = [
        'sale_date' => 'date',
        'next_due_date' => 'date',
        'approved_at' => 'datetime',
        'total_amount' => 'decimal:2',
        'market_advance' => 'decimal:2',
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

    public function salesman()
    {
        return $this->belongsTo(User::class, 'salesman_id');
    }

    public function salesOfficer()
    {
        return $this->belongsTo(User::class, 'sales_officer_id');
    }

    public function recoveryOfficer()
    {
        return $this->belongsTo(User::class, 'recovery_officer_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function recoveries()
    {
        return $this->hasMany(Recovery::class);
    }

    public function isPending(): bool
    {
        return $this->approval_status === 'Pending';
    }

    public function isApproved(): bool
    {
        return $this->approval_status === 'Approved';
    }

    public function isRejected(): bool
    {
        return $this->approval_status === 'Rejected';
    }
}