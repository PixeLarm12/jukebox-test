<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Jukebox Admin',
            'email' => 'jukebox@admin.com',
            'password' => bcrypt(123123),
        ]);
    }
}
