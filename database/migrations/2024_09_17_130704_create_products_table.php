<?php

use App\Models\Brand;
use App\Models\Category;
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
            $table->id();
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(Brand::class)->constrained();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('img_thumbnail');
            $table->double('price_regular');
            $table->double('price_sale')->default(0)->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_sale')->default(false);
            $table->boolean('is_show_home')->default(false);
            $table->boolean('is_delete')->default(false);
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
