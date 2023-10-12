<?php

use App\Models\Product;
use App\Models\Spec;
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
        Schema::create('products_specs', function (Blueprint $table) {
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Spec::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('value',20);

            //SETTING THE PRIMARY KEYS
            $table->primary(['product_id','spec_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_specs');
    }
};
