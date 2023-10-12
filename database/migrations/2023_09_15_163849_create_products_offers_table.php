<?php

use App\Models\Offer;
use App\Models\Product;
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
        Schema::create('products_offers', function (Blueprint $table) {
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Offer::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('price',7,2);

            //SETTING THE PRIMARY KEYS
            $table->primary(['product_id','offer_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_offers');
    }
};
