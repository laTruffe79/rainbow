<?php

namespace Database\Seeders;

use App\Enums\DefaultPurposesEnum;
use App\Models\AvailablePurpose;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvailablePurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (\range(0,3) as $i){

            $key = array_keys(DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION)[$i];

            AvailablePurpose::factory()
                ->create(
                    [
                        'key' => $key,
                        'purpose_type' => 'STANDARD_PURPOSES_SATISFACTION',
                        'order' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION[$key]['order'] ,
                        'label' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION[$key]['label'] ,
                        'icon' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION[$key]['icon'] ,
                        'satisfied' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION[$key]['satisfied']
                    ]
                );
        }

        foreach (\range(0,3) as $i){

            $key = array_keys(DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND)[$i];
            AvailablePurpose::factory()
                ->create(
                    [
                        'key' => $key,
                        'purpose_type' => 'STANDARD_PURPOSES_CHANGED_MIND',
                        'order' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND[$key]['order'] ,
                        'label' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND[$key]['label'] ,
                        'icon' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND[$key]['icon'] ,
                        'satisfied' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND[$key]['satisfied']
                    ]
                );
        }

        foreach (\range(0,5) as $i){

            $key = array_keys(DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES)[$i];

            AvailablePurpose::factory()
                ->create(
                    [
                        'key' => $key,
                        'purpose_type' => 'OPEN_LAST_QUESTION_PURPOSES',
                        'order' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES[$key]['order'] ,
                        'label' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES[$key]['label'] ,
                        'icon' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES[$key]['icon'] ,
                        'satisfied' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES[$key]['satisfied']
                    ]
                );
        }

    }
}
