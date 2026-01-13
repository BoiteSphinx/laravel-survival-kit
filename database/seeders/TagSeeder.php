<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::insert([
            ['name' => 'Perso', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Travail', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Optionnel', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
