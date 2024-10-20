<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Kiểm tra nếu vai trò 'Admin' đã tồn tại
        if (!Role::where('name', 'Admin')->exists()) {
            Role::create(['name' => 'Admin']);
        }

        // Kiểm tra và tạo các vai trò khác nếu cần
        if (!Role::where('name', 'User')->exists()) {
            Role::create(['name' => 'User']);
        }

        // Thêm các vai trò khác nếu cần
    }
}
