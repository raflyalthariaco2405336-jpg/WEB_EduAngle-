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

        TeacherFeedback::create([
            'teacher_id' => Auth::id(),
            'student_id' => $student->id,
            'comment'    => $request->comment,
            'status'     => $request->status,
        ]);

        return back()->with('success', 'Feedback added successfully.');
    }

    public function update(Request $request, TeacherFeedback $feedback)
    {
        if ($feedback->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'comment' => 'required|string|max:1000',
            'status'  => 'required|in:Needs Improvement,Good,Excellent',
        ]);

        $feedback->update([
            'comment' => $request->comment,
            'status'  => $request->status,
        ]);

        return redirect()->route('teacher.student.show', $feedback->student_id)->with('success', 'Feedback updated successfully.');
    }

    public function destroy(TeacherFeedback $feedback)
    {
        if ($feedback->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $studentId = $feedback->student_id;
        $feedback->delete();

        return redirect()->route('teacher.student.show', $studentId)->with('success', 'Feedback removed.');
    }
}
