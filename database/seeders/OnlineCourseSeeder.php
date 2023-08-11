<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OnlineCourse;

class OnlineCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OnlineCourse::factory()->count(2)->hasParticipants(2)->create();
    }
}
