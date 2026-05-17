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

        $quiz2 = Quiz::create([
            'module_id' => $module ? $module->id : null,
            'title' => 'Basic Camera Angle & Videography Understanding',
            'description' => 'Test your understanding of basic camera angles, videography shots, and production planning.',
        ]);

        // Q1
        $q = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'Which camera angle is used to make the object look strong and dominant?',
        ]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Eye Level', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'High Angle', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Low Angle', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Close Up', 'is_correct' => false]);

        // Q2
        $q = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'Which shooting technique is used to show facial expressions in detail?',
        ]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Bird’s Eye View', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Close Up', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Eye Level', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'High Angle', 'is_correct' => false]);

        // Q3
        $q = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'Which camera angle provides a natural perspective similar to human eyesight?',
        ]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Low Angle', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'High Angle', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Eye Level', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Bird’s Eye View', 'is_correct' => false]);

        // Q4
        $q = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'In a video project, what is the main function of a storyboard?',
        ]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Editing videos', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Saving video results', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Planning scenes and camera shots', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Managing camera lighting', 'is_correct' => false]);

        // Q5
        $q = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'What is the purpose of using a high angle shot in a video?',
        ]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Strong and dominant impression', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Dramatic and majestic impression', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Weak or powerless impression', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Natural and realistic impression', 'is_correct' => false]);

        // Q6
        $q = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'One benefit of using an interactive learning website for camera angle materials is…',
        ]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Replacing the function of a camera', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Making simulations and visual understanding easier', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Reducing shooting practice', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Automatically editing videos', 'is_correct' => false]);

        // Q7
        $q = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'In a group video project, task division is necessary so that…',
        ]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Teachers can assess more easily', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'The project is completed faster and more organized', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Group discussion is unnecessary', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Member creativity is reduced', 'is_correct' => false]);

        // Q8
        $q = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'Which camera angle is often used to show the entire location or atmosphere?',
        ]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Close Up', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Bird’s Eye View', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Eye Level', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Over the Shoulder', 'is_correct' => false]);

        // Q9
        $q = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'What is the function of framing in photography and videography?',
        ]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Arranging object composition in an image', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Adding sound effects', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Setting video duration', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Determining video colors', 'is_correct' => false]);

        // Q10
        $q = Question::create([
            'quiz_id' => $quiz2->id,
            'question_text' => 'One important factor in the success of a video project is…',
        ]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Over the Shoulder', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Eye Level', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'High Angle', 'is_correct' => false]);
        Answer::create(['question_id' => $q->id, 'answer_text' => 'Worm’s Eye View', 'is_correct' => false]);
    }
}
