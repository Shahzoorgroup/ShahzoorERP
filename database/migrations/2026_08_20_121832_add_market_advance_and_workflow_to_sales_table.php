<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {

            $table->decimal('market_advance', 15, 2)
                ->default(0)
                ->after('total_amount');

            $table->foreignId('salesman_id')
                ->nullable()
                ->after('customer_id')
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('sales_officer_id')
                ->nullable()
                ->after('salesman_id')
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('recovery_officer_id')
                ->nullable()
                ->after('sales_officer_id')
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('approval_status', [
                'Pending',
                'Approved',
                'Rejected'
            ])->default('Pending')->after('status');

            $table->foreignId('approved_by')
                ->nullable()
                ->after('approval_status')
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')
                ->nullable()
                ->after('approved_by');

        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {

            $table->dropForeign(['salesman_id']);
            $table->dropForeign(['sales_officer_id']);
            $table->dropForeign(['recovery_officer_id']);
            $table->dropForeign(['approved_by']);

            $table->dropColumn([
                'market_advance',
                'salesman_id',
                'sales_officer_id',
                'recovery_officer_id',
                'approval_status',
                'approved_by',
                'approved_at',
            ]);

        });
    }
};