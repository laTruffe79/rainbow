<?php

namespace Database\Factories;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Participant>
 */
class ParticipantFactory extends Factory
{

    protected $model = Participant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pseudo' => $this->faker->firstName.strval(\rand(1,100)),
            'token' => \Str::random(32),
            'token_is_valid' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'satisfaction_rate' => 0,
        ];
    }
}
