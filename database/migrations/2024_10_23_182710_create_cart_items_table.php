<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');  // Khóa ngoại tới bảng carts
            $table->unsignedBigInteger('product_id'); // Khóa ngoại tới bảng products (nếu có)
            $table->integer('quantity');
            $table->decimal('price', 10, 2); // Giá mỗi sản phẩm
            $table->timestamps();

            // Liên kết khóa ngoại
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products'); // Nếu có bảng products
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
