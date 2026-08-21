<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {

            $table->string('customer_photo')->nullable()->after('address');
            $table->string('house_photo')->nullable()->after('customer_photo');
            $table->string('cnic_front')->nullable()->after('house_photo');
            $table->string('cnic_back')->nullable()->after('cnic_front');

            $table->decimal('latitude', 10, 7)->nullable()->after('cnic_back');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');

        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {

            $table->dropColumn([
                'customer_photo',
                'house_photo',
                'cnic_front',
                'cnic_back',
                'latitude',
                'longitude',
            ]);

        });
    }
};