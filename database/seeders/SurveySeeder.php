<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Survey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $questions = Question::all();
        $survey = Survey::factory()
            ->create(['title' => Survey::STANDARD_SURVEY_TITLE, 'description' => Survey::STANDARD_SURVEY_DESCRIPTION]);

        foreach ($questions as $question) {

            $question->surveys()->attach($survey->id);

        }


    }
}
