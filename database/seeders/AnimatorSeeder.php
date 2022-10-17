<?php

namespace Database\Seeders;

use App\Models\Animator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnimatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Animator::factory()->create([
            'name' => 'Benoît Martin',
            'email' => 'MBenoitmartin17@gmail.com',
        ]);

        Animator::factory()->create([
            'name' => 'Eloïse Siclon',
            'email' => 'eloise.siclon@gmail.com',
        ]);
    }
}
