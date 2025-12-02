<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('package_id');
            $table->string('email')->nullable()->after('full_name');
            $table->string('phone')->nullable()->after('email');
            $table->integer('participants')->nullable()->after('phone');
            $table->date('travel_date')->nullable()->after('participants');
            $table->text('requests')->nullable()->after('travel_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['full_name', 'email', 'phone', 'participants', 'travel_date', 'requests']);
        });
    }
};
