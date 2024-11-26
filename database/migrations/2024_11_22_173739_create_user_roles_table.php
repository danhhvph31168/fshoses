<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_roles', function (Blueprint $table) {

            // $table->unsignedInteger('user_id');
            // $table->unsignedInteger('role_id');
            $table->primary(['role_id', 'user_id']);
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Role::class)->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
