<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {

            $table->id();

            $table->string('invoice_no')->unique();

            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();

            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();

            $table->date('sale_date');

            $table->decimal('total_amount', 12, 2);

            $table->decimal('down_payment', 12, 2)->default(0);

            $table->decimal('remaining_amount', 12, 2)->default(0);

            $table->integer('installment_months')->default(0);

            $table->decimal('monthly_installment', 12, 2)->default(0);

            $table->date('next_due_date')->nullable();

            $table->enum('status', [
                'Running',
                'Completed',
                'Cancelled'
            ])->default('Running');

            $table->text('remarks')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};