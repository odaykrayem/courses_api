<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OnlineCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(),
            'description' => $this->faker->text(),
            'link' => $this->faker->text(),
            'price' =>$this->faker->numberBetween(0,100)
        ];
    }
}
