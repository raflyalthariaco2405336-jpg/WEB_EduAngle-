<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QuizResult;
use App\Models\TeacherFeedback;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = User::where('role', 'student')
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->withCount('quizResults')
            ->get()
            ->map(function ($student) {
                $results = $student->quizResults;
                $student->avg_score = $results->count() > 0
                    ? round($results->avg(fn($r) => $r->total_questions > 0 ? ($r->score / $r->total_questions) * 100 : 0))
                    : null;
                $student->last_activity = $results->sortByDesc('completed_at')->first()?->completed_at;
                return $student;
            });

        $totalStudents    = User::where('role', 'student')->count();
        $totalAttempts    = QuizResult::count();
        $overallAvg       = QuizResult::count() > 0
            ? round(QuizResult::all()->avg(fn($r) => $r->total_questions > 0 ? ($r->score / $r->total_questions) * 100 : 0))
            : 0;

        return view('teacher.dashboard', compact('students', 'search', 'totalStudents', 'totalAttempts', 'overallAvg'));
    }

    public function showStudent(User $student)
    {
        $results = QuizResult::where('user_id', $student->id)
            ->with('quiz')
            ->latest('completed_at')
            ->get();

        $feedbacks = TeacherFeedback::where('student_id', $student->id)
            ->with('teacher')
            ->latest()
            ->get();

        $myFeedback = TeacherFeedback::where('student_id', $student->id)
            ->where('teacher_id', Auth::id())
            ->first();

        $avgScore = $results->count() > 0
            ? round($results->avg(fn($r) => $r->total_questions > 0 ? ($r->score / $r->total_questions) * 100 : 0))
            : null;

        return view('teacher.student_detail', compact('student', 'results', 'feedbacks', 'myFeedback', 'avgScore'));
    }
}
