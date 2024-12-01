<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Order::class)->constrained();
            $table->integer('product_id')->default(0);
            $table->foreignIdFor(ProductVariant::class)->constrained();
            $table->integer('value')->default(0);
            $table->string('comment');
            $table->timestamps();
            $table->unique(['order_id', 'product_variant_id'], 'unique_order_product_variant');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating');
    }

};
