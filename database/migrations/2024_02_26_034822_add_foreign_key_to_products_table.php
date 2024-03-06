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
        Schema::table('products', function (Blueprint $table) {
            Schema::table('products', function (Blueprint $table) {
                $table->foreign(['price_id'], 'products_ibfk_1')->references(['id'])->on('prices')->onUpdate('CASCADE')->onDelete('CASCADE');
                $table->foreign(['category_id'], 'products_ibfk_2')->references(['id'])->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
                $table->foreign(['temperature_id'], 'products_ibfk_3')->references(['id'])->on('temperatures')->onUpdate('CASCADE')->onDelete('CASCADE');
                $table->foreign(['size_id'], 'products_ibfk_4')->references(['id'])->on('sizes')->onUpdate('CASCADE')->onDelete('CASCADE');
                $table->foreign(['topping_id'], 'products_ibfk_5')->references(['id'])->on('toppings')->onUpdate('CASCADE')->onDelete('CASCADE');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_ibfk_1');
            $table->dropForeign('products_ibfk_2');
            $table->dropForeign('products_ibfk_3');
            $table->dropForeign('products_ibfk_4');
            $table->dropForeign('products_ibfk_5');
        });
    }
};
