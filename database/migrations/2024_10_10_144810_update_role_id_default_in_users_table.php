<?php

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
        Schema::table('users', function (Blueprint $table) {
             // Sửa cột role_id để thêm giá trị mặc định là 0
             $table->unsignedBigInteger('role_id')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Quay lại thay đổi (nếu cần)
            $table->unsignedBigInteger('role_id')->default(null)->change();
        });
    }
};
