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
        Schema::table('toppings', function (Blueprint $table) {
            $table->foreign(['rating_id'], 'toppings_ibfk_1')->references(['id'])->on('ratings')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('toppings', function (Blueprint $table) {
            $table->dropForeign('toppings_ibfk_1');
        });
    }
};
