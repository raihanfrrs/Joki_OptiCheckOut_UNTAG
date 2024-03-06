<?php

use App\Models\Size;
use App\Models\Price;
use App\Models\Topping;
use App\Models\Category;
use App\Models\Temperature;
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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Price::class);
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Temperature::class);
            $table->foreignIdFor(Size::class);
            $table->foreignIdFor(Topping::class);
            $table->string('name');
            $table->integer('stock');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
