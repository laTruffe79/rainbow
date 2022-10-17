<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Question>
 */
class QuestionFactory extends Factory
{

    /**
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'question' => $this->faker->sentence.'?',
            'image' => $this->faker->randomElement(Question::IMAGES_ARRAY),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }




}
