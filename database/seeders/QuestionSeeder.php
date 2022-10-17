<?php

namespace Database\Seeders;

use App\Models\Purpose;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        foreach (Question::QUESTIONS_ARRAY as $key => $question) {

            Question::factory()
                ->has(Purpose::factory()->sequence([
                    'label' => Purpose::STANDARD_PURPOSES[0] , 'icon' => Purpose::SMILEYS[0] , 'satisfied' => true
                ]))
                ->has(Purpose::factory()->sequence([
                    'label' => Purpose::STANDARD_PURPOSES[1] , 'icon' => Purpose::SMILEYS[1] , 'satisfied' => true
                ]))
                ->has(Purpose::factory()->sequence([
                    'label' => Purpose::STANDARD_PURPOSES[2] , 'icon' => Purpose::SMILEYS[2] , 'satisfied' => false
                ]))
                ->has(Purpose::factory()->sequence([
                    'label' => Purpose::STANDARD_PURPOSES[3] , 'icon' => Purpose::SMILEYS[3] , 'satisfied' => false
                ]))
                ->create(['question' => Question::QUESTIONS_ARRAY[$key], 'image' => Question::IMAGES_ARRAY[$key] ]);

        }

    }
}
