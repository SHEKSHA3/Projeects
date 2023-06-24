<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $question = new Question();
            $question->question = $faker->sentence;
            $question->level_id = $faker->randomElement([1, 2, 3]);
            $question->save();

            for ($j = 0; $j < 4; $j++) {
                $answer = new Answer();
                $answer->question_id = $question->id;
                $answer->answer = $faker->sentence();
                $answer->is_correct = ($j === 0) ? 1 : 0; // Set the first answer as correct
                $answer->save();
            }
        }
    }
}
