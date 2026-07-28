<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recoveries', function (Blueprint $table) {

            $table->id();

            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();

            $table->date('recovery_date');

            $table->decimal('amount_received', 12, 2);

            $table->decimal('remaining_balance', 12, 2);

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->decimal('latitude', 10, 7)->nullable();

            $table->decimal('longitude', 10, 7)->nullable();

            $table->string('photo')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recoveries');
    }
};