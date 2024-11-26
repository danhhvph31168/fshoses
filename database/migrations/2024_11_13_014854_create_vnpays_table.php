<?php

use App\Models\Order;
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
        Schema::create('vnpays', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained()->nullable();
            $table->decimal('vnp_Amount')->nullable();
            $table->string('vnp_BankCode')->nullable();
            $table->string('vnp_BankTranNo')->nullable();
            $table->string('vnp_CardType')->nullable();
            $table->string('vnp_OrderInfo')->nullable();
            $table->dateTime('vnp_PayDate')->nullable();
            $table->string('vnp_ResponseCode')->nullable();
            $table->string('vnp_TmnCode')->nullable();
            $table->string('vnp_TransactionNo')->nullable();
            $table->string('vnp_TransactionStatus')->nullable();
            $table->string('vnp_TxnRef')->nullable();
            $table->text('vnp_SecureHash')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vnpays');
    }
};
