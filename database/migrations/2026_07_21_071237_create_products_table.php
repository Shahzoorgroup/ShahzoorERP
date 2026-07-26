<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('company');
            $table->string('model')->nullable();
            $table->string('barcode')->nullable();

            $table->decimal('cost_price', 12, 2);
            $table->decimal('sale_price', 12, 2);
            $table->decimal('minimum_sale_price', 12, 2);

            $table->decimal('down_payment', 12, 2);

            $table->integer('installment_months');

            $table->decimal('monthly_installment', 12, 2);

            $table->integer('stock_quantity')->default(0);

            $table->integer('minimum_stock')->default(5);

            $table->enum('status', [
                'Active',
                'Inactive'
            ])->default('Active');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};