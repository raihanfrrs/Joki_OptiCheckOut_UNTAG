<?php

use App\Models\User;
use App\Models\AlternativeMatriks;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('normalization_matriks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(User::class);
            $table->char('alternative_matrik_id', 36);
            $table->float('price');
            $table->float('temperature')->nullable();
            $table->float('size')->nullable();
            $table->float('topping')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('normalization_matriks');
    }
};
