<?php

use App\Models\Brand;
use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar',50);
            $table->string('name_en',50);
            $table->longText('desc_ar');
            $table->longText('desc_en');
            $table->string('image');
            $table->string('code');
            $table->decimal('price',7,2);
            $table->smallInteger('quantity')->length(3)->default(1);
            $table->tinyInteger('status')->default(1)->comment('1=>active , 0=> not active');
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Brand::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
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
