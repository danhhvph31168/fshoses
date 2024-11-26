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
            $table->string('phone')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('district')->nullable()->change();
            $table->string('province')->nullable()->change();
            $table->string('zip_code')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->string('district')->nullable(false)->change();
            $table->string('province')->nullable(false)->change();
            $table->string('zip_code')->nullable(false)->change();
        });
    }
};
