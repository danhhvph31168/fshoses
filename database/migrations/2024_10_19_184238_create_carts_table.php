<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID người dùng
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // ID sản phẩm
            $table->integer('quantity')->default(1); // Số lượng sản phẩm
            $table->decimal('price', 10, 2); // Giá sản phẩm

            // Đặt khóa chính là sự kết hợp giữa user_id và product_id
            $table->primary(['user_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
