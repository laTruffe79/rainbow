<?php

namespace Database\Factories;

use App\Models\Session;
use chillerlan\QRCode\QRCode;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Session>
 */
class SessionFactory extends Factory
{

    /**
     * @var string
     */
    protected $model = Session::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $slug = \Str::random(32);
        return [
            'open' => 0,
            'slug' =>  $slug,
            'qrcode' => (new QRCode)->render(route('survey-slug',$slug)),
            'satisfaction_rate' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }



}
