<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->truncate();

        User::query()->create([
            'name' => "Ferhat Sarıkaya",
            'email' => "admin@admin.com",
            'password' => Hash::make('password'),
            'role_as' => 1,
        ]);

        User::query()->create([
            'name' => "User 1",
            'email' => "user@user.com",
            'password' => Hash::make('password'),
            'role_as' => 0,
        ]);
    }
}
