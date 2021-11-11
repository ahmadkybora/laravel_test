<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lesson_name' => $this->faker->name(),
            'lesson_code' => $this->faker->numberBetween(0, 9),
            'number_unit' => $this->faker->numberBetween(0, 9),
        ];
    }
}
