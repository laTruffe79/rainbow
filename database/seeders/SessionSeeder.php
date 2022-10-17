<?php

namespace Database\Seeders;

use App\Models\Animator;
use App\Models\School;
use App\Models\Session;
use App\Models\Survey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $school = School::all()->first();
        $animator = Animator::all()->first();
        $survey = Survey::all()->first();

        Session::factory()->create([
           'school_id' => $school->id,
           'survey_id' => $survey->id,
           'animator_id' => $animator->id,
        ]);

    }
}
