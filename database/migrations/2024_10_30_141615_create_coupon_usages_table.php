<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Coupon;
class CreateCouponUsagesTable extends Migration
{
    public function up()
    {
        Schema::create('coupon_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Coupon::class)->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupon_usages');
    }
}
