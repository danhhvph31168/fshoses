<?php

use App\Models\Account;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Coupon::class)->constrained()->nullable();
            $table->foreignId('staff_id')->constrained('users');
            $table->string('sku_order')->unique();
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone');
            $table->string('user_address');
            $table->string('user_province');
            $table->string('user_district');
            $table->string('user_ward');
            $table->text('user_note')->nullable();
            $table->string('status_order')->default(Order::STATUS_ORDER_PENDING);
            $table->double('total_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
