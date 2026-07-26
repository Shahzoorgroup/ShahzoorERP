<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'branch_id',
        'category_id',
        'name',
        'company',
        'model',
        'barcode',
        'cost_price',
        'sale_price',
        'minimum_sale_price',
        'down_payment',
        'installment_months',
        'monthly_installment',
        'stock_quantity',
        'minimum_stock',
        'status',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}