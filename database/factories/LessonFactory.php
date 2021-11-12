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
        $lesson_name = ['Math', 'Experimental', 'Quran', 'Sport', 'Farsi', 'Arabic', 'English', 'chemistry', 'Religious', 'social'];
        $lesson_code = [101, 102, 103, 104, 105, 106, 107, 108, 109, 110];
        $units = [11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

        return [
            'lesson_name' => $this->faker->name(),
            'lesson_code' => $this->faker->numberBetween(0, 9),
            'number_unit' => $this->faker->numberBetween(0, 9),
        ];
    }
}
