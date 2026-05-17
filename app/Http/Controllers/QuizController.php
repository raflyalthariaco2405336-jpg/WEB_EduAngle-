<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::withCount('questions')->get();
        $userResults = QuizResult::where('user_id', Auth::id())
            ->with('quiz')
            ->latest()
            ->get()
            ->keyBy('quiz_id');

        return view('student.quizzes.index', compact('quizzes', 'userResults'));
    }

    public function show(Quiz $quiz)
    {
        $questions = $quiz->questions()->with('answers')->get()->shuffle();
        return view('student.quizzes.show', compact('quiz', 'questions'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $questions = $quiz->questions()->with('answers')->get();
        $score = 0;
        $total = $questions->count();
        $review = [];

        foreach ($questions as $question) {
            $correctAnswer = $question->answers->firstWhere('is_correct', true);
            $submittedId = $request->input('answers.' . $question->id);
            $isCorrect = ($correctAnswer && $submittedId == $correctAnswer->id);
            if ($isCorrect) {
                $score++;
            }

            $submittedAnswer = $question->answers->firstWhere('id', $submittedId);

            $review[] = [
                'question_text'    => $question->question_text,
                'image_path'       => $question->image_path,
                'answers'          => $question->answers,
                'submitted_id'     => $submittedId,
                'submitted_text'   => $submittedAnswer?->answer_text ?? 'Tidak dijawab',
                'correct_id'       => $correctAnswer?->id,
                'correct_text'     => $correctAnswer?->answer_text,
                'is_correct'       => $isCorrect,
            ];
        }

        QuizResult::create([
            'user_id'         => Auth::id(),
            'quiz_id'         => $quiz->id,
            'score'           => $score,
            'total_questions' => $total,
            'completed_at'    => now(),
        ]);

        $percentage = $total > 0 ? round(($score / $total) * 100) : 0;

        return view('student.quizzes.result', compact('quiz', 'score', 'total', 'percentage', 'review'));
    }
}
