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

        foreach ($questions as $question) {
            $correctAnswer = $question->answers->firstWhere('is_correct', true);
            $submittedId = $request->input('answers.' . $question->id);
            if ($correctAnswer && $submittedId == $correctAnswer->id) {
                $score++;
            }
        }

        QuizResult::create([
            'user_id'         => Auth::id(),
            'quiz_id'         => $quiz->id,
            'score'           => $score,
            'total_questions' => $total,
            'completed_at'    => now(),
        ]);

        $percentage = $total > 0 ? round(($score / $total) * 100) : 0;

        return view('student.quizzes.result', compact('quiz', 'score', 'total', 'percentage'));
    }
}
