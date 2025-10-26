<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'kasir',
            'email' => 'kasir@catatyuk.com',
            'password' => bcrypt('123'),
            'role' => 'Kasir'
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@catatyuk.com',
            'password' => bcrypt('123'),
            'role' => 'Admin'
        ]);

        User::create([
            'name' => 'owner',
            'email' => 'owner@catatyuk.com',
            'password' => bcrypt('123'),
            'role' => 'Owner'
        ]);

        User::create([
            'name' => 'koki',
            'email' => 'koki@catatyuk.com',
            'password' => bcrypt('123'),
            'role' => 'Koki'
        ]);

        User::create([
            'name' => 'kurir',
            'email' => 'kurir@catatyuk.com',
            'password' => bcrypt('123'),
            'role' => 'Kurir'
        ]);
    }
}
