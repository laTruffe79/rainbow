<?php /** @noinspection DuplicatedCode */

namespace Database\Seeders;

use App\Enums\DefaultPurposesEnum;
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
                    'key' => array_keys(DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION)[0],
                    'order' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['most_satisfied']['order'] ,
                    'label' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['most_satisfied']['label'] ,
                    'icon' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['most_satisfied']['icon'] ,
                    'satisfied' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['most_satisfied']['satisfied'],
                    'available_purpose_id' => 1
                ]))
                ->has(Purpose::factory()->sequence([
                    'key' => array_keys(DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION)[1],
                    'order' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['satisfied']['order'] ,
                    'label' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['satisfied']['label'] ,
                    'icon' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['satisfied']['icon'] ,
                    'satisfied' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['satisfied']['satisfied'],
                    'available_purpose_id' => 2
                ]))
                ->has(Purpose::factory()->sequence([
                    'key' => array_keys(DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION)[2],
                    'order' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['not_satisfied']['order'] ,
                    'label' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['not_satisfied']['label'] ,
                    'icon' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['not_satisfied']['icon'] ,
                    'satisfied' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['not_satisfied']['satisfied'],
                    'available_purpose_id' => 3
                ]))
                ->has(Purpose::factory()->sequence([
                    'key' => array_keys(DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION)[3],
                    'order' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['angry']['order'] ,
                    'label' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['angry']['label'] ,
                    'icon' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['angry']['icon'] ,
                    'satisfied' => DefaultPurposesEnum::STANDARD_PURPOSES_SATISFACTION['angry']['satisfied'],
                    'available_purpose_id' => 4
                ]))
                ->create(['question' => Question::QUESTIONS_ARRAY[$key],
                    'purpose_type' => 'STANDARD_PURPOSES_SATISFACTION',
                    'image' => Question::IMAGES_ARRAY[$key],
                    'satisfiable' => true]);

        }

        Question::factory()
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND)[0],
                'order' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['yes_really']['order'] ,
                'label' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['yes_really']['label'] ,
                'icon' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['yes_really']['icon'] ,
                'satisfied' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['yes_really']['satisfied'],
                'available_purpose_id' => 5
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND)[1],
                'order' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['a_few']['order'] ,
                'label' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['a_few']['label'] ,
                'icon' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['a_few']['icon'] ,
                'satisfied' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['a_few']['satisfied'],
                'available_purpose_id' => 6
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND)[2],
                'order' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['not_really']['order'] ,
                'label' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['not_really']['label'] ,
                'icon' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['not_really']['icon'] ,
                'satisfied' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['not_really']['satisfied'],
                'available_purpose_id' => 7
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND)[3],
                'order' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['no']['order'] ,
                'label' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['no']['label'] ,
                'icon' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['no']['icon'] ,
                'satisfied' => DefaultPurposesEnum::STANDARD_PURPOSES_CHANGED_MIND['no']['satisfied'],
                'available_purpose_id' => 8
            ]))
            ->create(
                [
                    'question' => Question::QUESTIONS_ARRAY3[0],
                    'purpose_type' => 'STANDARD_PURPOSES_CHANGED_MIND',
                    'image' => Question::IMAGES_ARRAY[1],
                    'satisfiable' => true,
                ]);

        Question::factory()
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES)[0],
                'label' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['grateful']['label'] ,
                'order' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['grateful']['order'] ,
                'icon' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['grateful']['icon'] ,
                'satisfied' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['grateful']['satisfied'],
                'available_purpose_id' => 9
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES)[1],
                'label' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['reassured']['label'] ,
                'order' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['reassured']['order'] ,
                'icon' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['reassured']['icon'] ,
                'satisfied' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['reassured']['satisfied'],
                'available_purpose_id' => 10
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES)[2],
                'label' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['surprised']['label'] ,
                'order' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['surprised']['order'] ,
                'icon' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['surprised']['icon'] ,
                'satisfied' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['surprised']['satisfied'],
                'available_purpose_id' => 10
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES)[3],
                'label' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['annoyed']['label'] ,
                'order' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['annoyed']['order'] ,
                'icon' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['annoyed']['icon'] ,
                'satisfied' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['annoyed']['satisfied'],
                'available_purpose_id' => 11
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES)[4],
                'label' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['worried']['label'] ,
                'order' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['worried']['order'] ,
                'icon' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['worried']['icon'] ,
                'satisfied' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['worried']['satisfied'],
                'available_purpose_id' => 12
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES)[5],
                'label' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['uncomfortable']['label'] ,
                'order' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['uncomfortable']['order'] ,
                'icon' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['uncomfortable']['icon'] ,
                'satisfied' => DefaultPurposesEnum::OPEN_LAST_QUESTION_PURPOSES['uncomfortable']['satisfied'],
                'available_purpose_id' => 13
            ]))
            ->create(
                [
                    'question' => Question::QUESTIONS_ARRAY2[0],
                    'purpose_type' => 'OPEN_LAST_QUESTION_PURPOSES',
                    'image' => Question::IMAGES_ARRAY[0],
                    'satisfiable' => false,
                ]);

    }

}
