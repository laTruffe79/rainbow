<?php /** @noinspection DuplicatedCode */

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
                    'key' => array_keys(Purpose::STANDARD_PURPOSES_SATISFACTION)[0],
                    'label' => Purpose::STANDARD_PURPOSES_SATISFACTION['most_satisfied']['label'] ,
                    'icon' => Purpose::STANDARD_PURPOSES_SATISFACTION['most_satisfied']['icon'] ,
                    'satisfied' => Purpose::STANDARD_PURPOSES_SATISFACTION['most_satisfied']['satisfied']
                ]))
                ->has(Purpose::factory()->sequence([
                    'key' => array_keys(Purpose::STANDARD_PURPOSES_SATISFACTION)[1],
                    'label' => Purpose::STANDARD_PURPOSES_SATISFACTION['satisfied']['label'] ,
                    'icon' => Purpose::STANDARD_PURPOSES_SATISFACTION['satisfied']['icon'] ,
                    'satisfied' => Purpose::STANDARD_PURPOSES_SATISFACTION['satisfied']['satisfied']
                ]))
                ->has(Purpose::factory()->sequence([
                    'key' => array_keys(Purpose::STANDARD_PURPOSES_SATISFACTION)[2],
                    'label' => Purpose::STANDARD_PURPOSES_SATISFACTION['not_satisfied']['label'] ,
                    'icon' => Purpose::STANDARD_PURPOSES_SATISFACTION['not_satisfied']['icon'] ,
                    'satisfied' => Purpose::STANDARD_PURPOSES_SATISFACTION['not_satisfied']['satisfied']
                ]))
                ->has(Purpose::factory()->sequence([
                    'key' => array_keys(Purpose::STANDARD_PURPOSES_SATISFACTION)[3],
                    'label' => Purpose::STANDARD_PURPOSES_SATISFACTION['angry']['label'] ,
                    'icon' => Purpose::STANDARD_PURPOSES_SATISFACTION['angry']['icon'] ,
                    'satisfied' => Purpose::STANDARD_PURPOSES_SATISFACTION['angry']['satisfied']
                ]))
                ->create(['question' => Question::QUESTIONS_ARRAY[$key],
                    'purpose_type' => 'STANDARD_PURPOSES_SATISFACTION',
                    'image' => Question::IMAGES_ARRAY[$key],
                    'satisfiable' => true]);

        }

        Question::factory()
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(Purpose::STANDARD_PURPOSES_CHANGED_MIND)[0],
                'label' => Purpose::STANDARD_PURPOSES_CHANGED_MIND['yes_really']['label'] ,
                'icon' => Purpose::STANDARD_PURPOSES_CHANGED_MIND['yes_really']['icon'] ,
                'satisfied' => Purpose::STANDARD_PURPOSES_CHANGED_MIND['yes_really']['satisfied']
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(Purpose::STANDARD_PURPOSES_CHANGED_MIND)[1],
                'label' => Purpose::STANDARD_PURPOSES_CHANGED_MIND['a_few']['label'] ,
                'icon' => Purpose::STANDARD_PURPOSES_CHANGED_MIND['a_few']['icon'] ,
                'satisfied' => Purpose::STANDARD_PURPOSES_CHANGED_MIND['a_few']['satisfied']
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(Purpose::STANDARD_PURPOSES_CHANGED_MIND)[2],
                'label' => Purpose::STANDARD_PURPOSES_CHANGED_MIND['not_really']['label'] ,
                'icon' => Purpose::STANDARD_PURPOSES_CHANGED_MIND['not_really']['icon'] ,
                'satisfied' => Purpose::STANDARD_PURPOSES_CHANGED_MIND['not_really']['satisfied']
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(Purpose::STANDARD_PURPOSES_CHANGED_MIND)[3],
                'label' => Purpose::STANDARD_PURPOSES_CHANGED_MIND['no']['label'] ,
                'icon' => Purpose::STANDARD_PURPOSES_CHANGED_MIND['no']['icon'] ,
                'satisfied' => Purpose::STANDARD_PURPOSES_CHANGED_MIND['no']['satisfied']
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
                'key' => array_keys(Purpose::OPEN_LAST_QUESTION_PURPOSES)[0],
                'label' => Purpose::OPEN_LAST_QUESTION_PURPOSES['grateful']['label'] ,
                'order' => Purpose::OPEN_LAST_QUESTION_PURPOSES['grateful']['order'] ,
                'icon' => Purpose::OPEN_LAST_QUESTION_PURPOSES['grateful']['icon'] ,
                'satisfied' => Purpose::OPEN_LAST_QUESTION_PURPOSES['grateful']['satisfied']
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(Purpose::OPEN_LAST_QUESTION_PURPOSES)[1],
                'label' => Purpose::OPEN_LAST_QUESTION_PURPOSES['reassured']['label'] ,
                'order' => Purpose::OPEN_LAST_QUESTION_PURPOSES['reassured']['order'] ,
                'icon' => Purpose::OPEN_LAST_QUESTION_PURPOSES['reassured']['icon'] ,
                'satisfied' => Purpose::OPEN_LAST_QUESTION_PURPOSES['reassured']['satisfied']
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(Purpose::OPEN_LAST_QUESTION_PURPOSES)[2],
                'label' => Purpose::OPEN_LAST_QUESTION_PURPOSES['surprised']['label'] ,
                'order' => Purpose::OPEN_LAST_QUESTION_PURPOSES['surprised']['order'] ,
                'icon' => Purpose::OPEN_LAST_QUESTION_PURPOSES['surprised']['icon'] ,
                'satisfied' => Purpose::OPEN_LAST_QUESTION_PURPOSES['surprised']['satisfied']
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(Purpose::OPEN_LAST_QUESTION_PURPOSES)[3],
                'label' => Purpose::OPEN_LAST_QUESTION_PURPOSES['annoyed']['label'] ,
                'order' => Purpose::OPEN_LAST_QUESTION_PURPOSES['annoyed']['order'] ,
                'icon' => Purpose::OPEN_LAST_QUESTION_PURPOSES['annoyed']['icon'] ,
                'satisfied' => Purpose::OPEN_LAST_QUESTION_PURPOSES['annoyed']['satisfied']
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(Purpose::OPEN_LAST_QUESTION_PURPOSES)[4],
                'label' => Purpose::OPEN_LAST_QUESTION_PURPOSES['worried']['label'] ,
                'order' => Purpose::OPEN_LAST_QUESTION_PURPOSES['worried']['order'] ,
                'icon' => Purpose::OPEN_LAST_QUESTION_PURPOSES['worried']['icon'] ,
                'satisfied' => Purpose::OPEN_LAST_QUESTION_PURPOSES['worried']['satisfied']
            ]))
            ->has(Purpose::factory()->sequence([
                'key' => array_keys(Purpose::OPEN_LAST_QUESTION_PURPOSES)[5],
                'label' => Purpose::OPEN_LAST_QUESTION_PURPOSES['uncomfortable']['label'] ,
                'order' => Purpose::OPEN_LAST_QUESTION_PURPOSES['uncomfortable']['order'] ,
                'icon' => Purpose::OPEN_LAST_QUESTION_PURPOSES['uncomfortable']['icon'] ,
                'satisfied' => Purpose::OPEN_LAST_QUESTION_PURPOSES['uncomfortable']['satisfied']
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
