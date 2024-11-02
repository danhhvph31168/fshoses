<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\Product;
use Nette\Utils\Random;
use App\Models\Category;
use Illuminate\Database\Seeder;

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

        for ($i = 1; $i < 11; $i++) {
            Category::query()->create([
                'name' => 'Danh mục ' . $i,
                'parent_id' => random_int(1, 10)
            ]);
        }

        Role::query()->insert(
            [
                [
                    'name' => 'Admin',
                    'Status' => '1',
                ],
                [
                    'name' => 'Staff',
                    'Status' => '1',
                ],
                [
                    'name' => 'User',
                    'Status' => '1',
                ]
            ],
        );
    }
}
