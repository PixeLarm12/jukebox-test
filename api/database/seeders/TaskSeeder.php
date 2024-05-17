<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::first()->id;

        Task::insert([
            [
                'title' => 'Change login background color',
                'description' => 'Login page needs to change the background color from blue to orange',
                'user_id' => $userId,
            ],
            [
                'title' => 'Verify error messages',
                'description' => 'Check if all error messages from forms are correct.',
                'user_id' => $userId,
            ],
            [
                'title' => 'Change primary button color',
                'description' => 'From app.css file, btn-primary background color needs to be changed from blue to orange',
                'user_id' => $userId,
            ],
        ]);
    }
}
