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
        Schema::table('preferences_matriks', function (Blueprint $table) {
            $table->foreign(['user_id'], 'preferences_matriks_ibfk_1')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['normalization_matrik_id'], 'preferences_matriks_ibfk_2')->references(['id'])->on('normalization_matriks')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('preferences_matriks', function (Blueprint $table) {
            $table->dropForeign('preferences_matriks_ibfk_1');
            $table->dropForeign('preferences_matriks_ibfk_2');
        });
    }
};
