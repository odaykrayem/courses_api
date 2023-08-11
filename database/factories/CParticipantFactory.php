<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon;

class CParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'course_id' => Course::factory(),
            'expired' => $this->faker->randomElement([true, false]),
            'expired_at' => Carbon::now()->addHour(1)
        ];
    }
}
