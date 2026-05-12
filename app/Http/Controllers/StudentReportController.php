<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizResult;
use App\Models\Quiz;
use App\Models\Module;
use App\Models\TeacherFeedback;
use Illuminate\Support\Facades\Auth;

class StudentReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $results = QuizResult::where('user_id', $user->id)
            ->with('quiz')
            ->latest('completed_at')
            ->get();

        $totalQuizzes   = Quiz::count();
        $attemptedCount = $results->unique('quiz_id')->count();
        $avgScore       = $results->count() > 0
            ? round($results->avg(fn($r) => $r->total_questions > 0 ? ($r->score / $r->total_questions) * 100 : 0))
            : 0;

        $feedbacks = TeacherFeedback::where('student_id', $user->id)
            ->with('teacher')
            ->latest()
            ->get();

        $totalModules    = Module::count();
        $progressPercent = $totalQuizzes > 0 ? min(100, round(($attemptedCount / $totalQuizzes) * 100)) : 0;

        return view('student.report', compact(
            'user', 'results', 'totalQuizzes', 'attemptedCount',
            'avgScore', 'feedbacks', 'totalModules', 'progressPercent'
        ));
    }
}
