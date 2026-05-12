<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Module;
use Illuminate\Support\Facades\File;

class QuizManagementController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with(['module', 'questions'])->get();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $modules = Module::all();
        return view('admin.quizzes.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'module_id'   => 'nullable|exists:modules,id',
        ]);

        $quiz = Quiz::create($request->only('title', 'description', 'module_id'));

        return redirect()->route('dashboard.quizzes.show', $quiz)->with('success', 'Quiz created. Now add questions.');
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.answers');
        return view('admin.quizzes.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        $modules = Module::all();
        return view('admin.quizzes.edit', compact('quiz', 'modules'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'module_id'   => 'nullable|exists:modules,id',
        ]);

        $quiz->update($request->only('title', 'description', 'module_id'));

        return redirect()->route('dashboard.quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz)
    {
        // Delete question images
        foreach ($quiz->questions as $question) {
            if ($question->image_path && File::exists(public_path($question->image_path))) {
                File::delete(public_path($question->image_path));
            }
        }
        $quiz->delete();
        return redirect()->route('dashboard.quizzes.index')->with('success', 'Quiz deleted.');
    }

    // --- Question Management ---
    public function storeQuestion(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question_text' => 'required|string',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'answers'       => 'required|array|min:2',
            'answers.*'     => 'required|string',
            'correct_answer' => 'required|integer',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('aset/questions'), $imageName);
            $imagePath = 'aset/questions/' . $imageName;
        }

        $question = $quiz->questions()->create([
            'question_text' => $request->question_text,
            'image_path'    => $imagePath,
        ]);

        foreach ($request->answers as $index => $answerText) {
            $question->answers()->create([
                'answer_text' => $answerText,
                'is_correct'  => ($index == $request->correct_answer),
            ]);
        }

        return back()->with('success', 'Question added.');
    }

    public function destroyQuestion(Question $question)
    {
        if ($question->image_path && File::exists(public_path($question->image_path))) {
            File::delete(public_path($question->image_path));
        }
        $quizId = $question->quiz_id;
        $question->delete();
        return redirect()->route('dashboard.quizzes.show', $quizId)->with('success', 'Question deleted.');
    }
}
