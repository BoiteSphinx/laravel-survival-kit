<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()
            ->withoutTwoFactor()
            ->create([
                'name' => config('survival-kit.default_user.name'),
                'email' => config('survival-kit.default_user.email'),
            ]);

        Todo::factory()
            ->count(20)
            ->recycle($user)
            ->create();

        // $this->call([
        //     MyOtherSeeder::class
        // ]);
    }
}
