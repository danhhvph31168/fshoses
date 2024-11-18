<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Cập nhật các giá trị NULL trong cột 'avatar' thành 'image-default/avatar.jpg'
        DB::table('users')->whereNull('avatar')->update(['avatar' => 'image-default/avatar.jpg']);
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->default('https://tinyurl.com/2pcrun9h')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->default(null)->change();
        });
    }
};
