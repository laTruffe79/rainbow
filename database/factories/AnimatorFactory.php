<?php

namespace Database\Factories;

use App\Models\Animator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Animator>
 */
class AnimatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName.' '.$this->faker->lastName,
            'email' => $this->faker->email,
        ];
    }

    /**
     * @var string
     */
    protected $model = Animator::class;


}
