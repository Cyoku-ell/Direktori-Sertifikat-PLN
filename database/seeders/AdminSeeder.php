<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([

            'name' => 'Administrator',

            'username' => 'admin',

            'email' => 'admin@gmail.com',

            'nip' => '000000000000',

            'perner' => '000000',

            'status' => 'Tetap',

            'unit_id' => null,

            'position_id' => null,

            'is_active' => true,

            'password' => Hash::make('12345678'),

        ]);

        $admin->assignRole('admin');
    }
}
