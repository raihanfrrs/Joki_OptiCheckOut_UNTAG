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
        Schema::table('alternative_matriks', function (Blueprint $table) {
            $table->foreign(['user_id'], 'alternative_matriks_ibfk_1')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['product_id'], 'alternative_matriks_ibfk_2')->references(['id'])->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['price_id'], 'alternative_matriks_ibfk_3')->references(['id'])->on('prices')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['temperature_id'], 'alternative_matriks_ibfk_4')->references(['id'])->on('temperatures')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['size_id'], 'alternative_matriks_ibfk_5')->references(['id'])->on('sizes')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['topping_id'], 'alternative_matriks_ibfk_6')->references(['id'])->on('toppings')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alternative_matriks', function (Blueprint $table) {
            $table->dropForeign('alternative_matriks_ibfk_1');
            $table->dropForeign('alternative_matriks_ibfk_2');
            $table->dropForeign('alternative_matriks_ibfk_3');
            $table->dropForeign('alternative_matriks_ibfk_4');
            $table->dropForeign('alternative_matriks_ibfk_5');
            $table->dropForeign('alternative_matriks_ibfk_6');
        });
    }
};
