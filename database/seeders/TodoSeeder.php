<?php

namespace Database\Seeders;

use App\Enums\TodoStatus;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Todo::factory(20)
            // ->state(['status' => TodoStatus::IN_PROGRESS])
            ->create();
    }
}
