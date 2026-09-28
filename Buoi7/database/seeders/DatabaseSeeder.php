<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::factory()
        ->count(10)
        ->hasProducts(10)
        ->create();

        User::factory()
            ->has(Profile::factory()) 
            ->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
            
        User::factory(10)
            ->has(Profile::factory())
            ->create();
        $this->call(StudentCourseSeeder::class);
    }
}
