<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected static ?string $password = '123456789';
    public function run(): void
    {

        // for ($i = 1; $i < 2; $i++) {
        //     \App\Models\User::factory()->create([
        //         'role_id'   => 1,
        //         'name'      => 'Ahjhj',
        //         'email'     => 'danhhvph31168@fpt.edu.vn',
        //         'avatar'    => 'https://anhdephd.vn/wp-content/uploads/2022/04/anh-gai-xinh-hot-girl-viet-nam.jpg',
        //         'password'  => static::$password ??= \Hash::make('password'),
        //         'phone'     => '0987654321',
        //         'address'   => 'Viet Nam',
        //         'balance'   => '1234',
        //         'district'  => 'Quynh Phu',
        //         'province'  => 'Thai Binh',
        //         'zip_code'  => '3333',
        //     ]);
        // }


    }
}
