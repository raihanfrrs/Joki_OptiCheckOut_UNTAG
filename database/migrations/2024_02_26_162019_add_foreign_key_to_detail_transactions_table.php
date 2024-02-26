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
        Schema::table('detail_transactions', function (Blueprint $table) {
            $table->foreign(['transaction_id'], 'detail_transactions_ibfk_1')->references(['id'])->on('transactions')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['product_id'], 'detail_transactions_ibfk_2')->references(['id'])->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_transactions', function (Blueprint $table) {
            $table->dropForeign('detail_transactions_ibfk_1');
            $table->dropForeign('detail_transactions_ibfk_2');
        });
    }
};
