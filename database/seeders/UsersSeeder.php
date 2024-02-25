<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'username' => "admin",
            'email' => "admin@gmail.com",
            'password' => bcrypt('admin123'),
        ]);

        $superadmin->assignRole('superadmin');

        $testingUser = User::create([
            'username' => 'testing',
            'email' => 'testing@gmail.com',
            'password' => bcrypt('admin123'),
        ]);
    }
}
