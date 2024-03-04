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
        Schema::table('normalization_matriks', function (Blueprint $table) {
            $table->foreign(['user_id'], 'normalization_matriks_ibfk_1')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['alternative_matrik_id'], 'normalization_matriks_ibfk_2')->references(['id'])->on('alternative_matriks')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('normalization_matriks', function (Blueprint $table) {
            $table->dropForeign('normalization_matriks_ibfk_1');
            $table->dropForeign('normalization_matriks_ibfk_2');
        });
    }
};
