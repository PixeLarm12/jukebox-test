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
            'email' => 'adm@adm.com.br',
            'password' => bcrypt(123123),
        ]);
    }
}
