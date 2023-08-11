<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::factory()->count(2)->hasVideos(2)->create();
        Course::factory()->count(2)->hasParticipants(2)->create();

    }
}
