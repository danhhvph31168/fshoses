<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Role;
use App\Models\Cart;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(RoleSeeder::class);  // Seed roles trước
        // User::factory(5)->create();
        // Category::factory(5)->create();
        // Product::factory(5)->create();
        // $roles = ['Admin', 'User', 'Moderator'];

        // foreach ($roles as $role) {
        //     Role::firstOrCreate(['name' => $role]);
        // }
        Cart::factory(1)->create();
    }
}
