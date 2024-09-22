<?php

use App\Models\Account;
use App\Models\Order;
use App\Models\Refund;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        // refunds === return do php ko cho pheps dat ten nhu vay
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('reason')->nullable();
            $table->dateTime('return_date');
            $table->string('status')->default(Refund::STATUS_PENDING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renderings');
    }
};
