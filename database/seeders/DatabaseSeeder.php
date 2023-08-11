<?php

namespace Database\Seeders;

use App\Models\OnlineCourse;
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
        // \App\Models\User::factory(10)->create();

        $this->call([
            CourseSeeder::class,
            OnlineCourseSeeder::class,
            ArticleSeeder::class
            ]
        );
    }
}
