<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<School>
 */
class SchoolFactory extends Factory
{

    /**
     * @var string
     */
    protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Collège '.$this->faker->firstName.' '.$this->faker->lastName.' de '.$this->faker->city,
            'phone' => '0'.$this->faker->numerify('#########'),
            'email' => $this->faker->email,
            'contact' => $this->faker->jobTitle,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
