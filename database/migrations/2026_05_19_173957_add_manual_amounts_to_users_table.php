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
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('manual_deposits', 15, 2)->default(0);
            $table->decimal('manual_withdrawals', 15, 2)->default(0);
            $table->decimal('manual_investments', 15, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['manual_deposits', 'manual_withdrawals', 'manual_investments']);
        });
    }
};
