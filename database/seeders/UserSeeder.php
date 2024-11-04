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
     */
    public function run(): void
    {
        User::factory(30)->create();

        User::factory()->create([
            'name' => 'mang ondi',
            'email' => 'ondi@idn.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'phone' => '08123456789',
        ]);
    }
}
