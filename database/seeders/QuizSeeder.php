<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Module;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $module = Module::first(); // Assuming a module exists from ModuleSeeder

        $quiz = Quiz::create([
            'module_id' => $module ? $module->id : null,
            'title' => 'Mini Game: Guess the Camera Angle',
            'description' => 'Test your knowledge by identifying the correct camera angles from the given descriptions or images.',
        ]);

        $q1 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Which camera angle is taken from a very high perspective, often looking directly down on the subject?',
        ]);

        Answer::create(['question_id' => $q1->id, 'answer_text' => 'Low Angle', 'is_correct' => false]);
        Answer::create(['question_id' => $q1->id, 'answer_text' => 'Bird\'s Eye View', 'is_correct' => true]);
        Answer::create(['question_id' => $q1->id, 'answer_text' => 'Dutch Angle', 'is_correct' => false]);
        Answer::create(['question_id' => $q1->id, 'answer_text' => 'Eye Level', 'is_correct' => false]);

        $q2 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'This angle is often used to make a subject look powerful, heroic, or intimidating. Which angle is it?',
        ]);

        Answer::create(['question_id' => $q2->id, 'answer_text' => 'High Angle', 'is_correct' => false]);
        Answer::create(['question_id' => $q2->id, 'answer_text' => 'Low Angle', 'is_correct' => true]);
        Answer::create(['question_id' => $q2->id, 'answer_text' => 'Over the Shoulder', 'is_correct' => false]);
        Answer::create(['question_id' => $q2->id, 'answer_text' => 'Worm\'s Eye View', 'is_correct' => false]);

        $q3 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'When the camera is tilted to one side, creating a sense of disorientation or psychological tension, it is called:',
        ]);

        Answer::create(['question_id' => $q3->id, 'answer_text' => 'Dutch Angle / Canted Angle', 'is_correct' => true]);
        Answer::create(['question_id' => $q3->id, 'answer_text' => 'High Angle', 'is_correct' => false]);
        Answer::create(['question_id' => $q3->id, 'answer_text' => 'Point of View (POV)', 'is_correct' => false]);
        Answer::create(['question_id' => $q3->id, 'answer_text' => 'Wide Shot', 'is_correct' => false]);
    }
}
