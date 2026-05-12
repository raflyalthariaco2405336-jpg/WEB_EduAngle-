<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherFeedback;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request, User $student)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'status'  => 'required|in:Needs Improvement,Good,Excellent',
        ]);

        TeacherFeedback::updateOrCreate(
            ['teacher_id' => Auth::id(), 'student_id' => $student->id],
            ['comment' => $request->comment, 'status' => $request->status]
        );

        return back()->with('success', 'Feedback saved successfully.');
    }

    public function destroy(User $student)
    {
        TeacherFeedback::where('teacher_id', Auth::id())
            ->where('student_id', $student->id)
            ->delete();

        return back()->with('success', 'Feedback removed.');
    }
}
