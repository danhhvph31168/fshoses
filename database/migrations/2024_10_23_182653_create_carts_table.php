<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // ID tự động tăng
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Khóa ngoại đến bảng users
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
