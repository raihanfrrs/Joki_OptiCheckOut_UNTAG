<?php

use App\Models\Product;
use App\Models\Size;
use App\Models\Temperature;
use App\Models\Topping;
use App\Models\Transaction;
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
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Transaction::class);
            $table->foreignIdFor(Product::class);
            // $table->foreignIdFor(Temperature::class)->nullable();
            // $table->foreignIdFor(Size::class)->nullable();
            // $table->foreignIdFor(Topping::class)->nullable();
            $table->integer('qty');
            $table->bigInteger('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transactions');
    }
};
