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
        Schema::table('temp_transactions', function (Blueprint $table) {
            $table->foreign(['cashier_id'], 'temp_transactions_ibfk_1')->references(['id'])->on('cashiers')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['product_id'], 'temp_transactions_ibfk_2')->references(['id'])->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temp_transactions', function (Blueprint $table) {
            $table->dropForeign('temp_transactions_ibfk_1');
            $table->dropForeign('temp_transactions_ibfk_2');
        });
    }
};
