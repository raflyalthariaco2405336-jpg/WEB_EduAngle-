@extends('layouts.app')

@section('content')
<section class="page-header" style="padding-bottom: 1rem;">
    <div class="container" style="text-align: left;">
        <a href="{{ route('dashboard.quizzes.index') }}" class="btn btn-outline btn-sm" style="margin-bottom: 1rem;"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <h1>{{ $quiz->title }}</h1>
        <p style="color: var(--text-muted);">{{ $quiz->questions->count() }} questions &nbsp;·&nbsp;
            @if($quiz->module) Module: {{ $quiz->module->title }} @endif
        </p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem;">
    @if(session('success'))
    <div style="background: rgba(16,185,129,0.12); border: 1px solid #10b981; color: #10b981; padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 2rem;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 2rem; align-items: start;">

        <!-- Existing questions -->
        <div>
            <h3 style="margin-bottom: 1rem; font-size: 1.1rem;">Current Questions</h3>
            @forelse($quiz->questions as $i => $question)
            <div class="glass-panel" style="padding: 1.5rem; margin-bottom: 1rem; border-left: 3px solid var(--primary);">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem;">
                    <div style="flex: 1;">
                        <p style="margin: 0 0 0.75rem; font-weight: 600; font-size: 0.95rem;">Q{{ $i+1 }}. {{ $question->question_text }}</p>
                        @if($question->image_path)
                            <img src="{{ asset($question->image_path) }}" style="width: 100%; border-radius: 8px; max-height: 120px; object-fit: cover; margin-bottom: 0.75rem;">
                        @endif
                        <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.35rem;">
                            @foreach($question->answers as $answer)
                            <li style="font-size: 0.85rem; color: {{ $answer->is_correct ? '#10b981' : 'var(--text-muted)' }};">
                                {{ $answer->is_correct ? '✓' : '○' }} {{ $answer->answer_text }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <form action="{{ route('dashboard.questions.destroy', $question) }}" method="POST" onsubmit="return confirm('Delete this question?')" style="flex-shrink: 0;">
                        @csrf @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: var(--accent); cursor: pointer; font-size: 1rem;">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="glass-panel" style="padding: 2rem; text-align: center; color: var(--text-muted);">
                No questions yet. Add one using the form.
            </div>
            @endforelse
        </div>

        <!-- Add question form -->
        <div class="glass-panel" style="padding: 2rem; position: sticky; top: 90px;">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;"><i class="fa-solid fa-plus-circle" style="color: var(--secondary);"></i> Add New Question</h3>
            <form action="{{ route('dashboard.quizzes.questions.store', $quiz) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom: 1.25rem;">
                    <label style="color: var(--text-muted); font-size: 0.85rem; display: block; margin-bottom: 0.35rem;">Question Text *</label>
                    <textarea name="question_text" rows="3" required placeholder="Type the question here…"
                        style="width: 100%; padding: 0.75rem; border-radius: 8px; background: rgba(255,255,255,0.06); border: 1px solid var(--glass-border); color: white; font-family: inherit; resize: vertical;"></textarea>
                </div>
                <div style="margin-bottom: 1.25rem;">
                    <label style="color: var(--text-muted); font-size: 0.85rem; display: block; margin-bottom: 0.35rem;">Question Image (optional)</label>
                    <input type="file" name="image" accept="image/*"
                        style="width: 100%; padding: 0.6rem; border-radius: 8px; background: rgba(255,255,255,0.06); border: 1px solid var(--glass-border); color: var(--text-muted); font-size: 0.85rem;">
                </div>

                <div id="answers-container">
                    @foreach(['A','B','C','D'] as $li => $letter)
                    <div style="display: flex; gap: 0.5rem; align-items: center; margin-bottom: 0.6rem;">
                        <input type="radio" name="correct_answer" value="{{ $li }}" {{ $li === 0 ? 'checked' : '' }} style="flex-shrink: 0; accent-color: var(--primary);" required>
                        <input type="text" name="answers[]" required placeholder="Option {{ $letter }}"
                            style="flex: 1; padding: 0.6rem 0.8rem; border-radius: 8px; background: rgba(255,255,255,0.06); border: 1px solid var(--glass-border); color: white; font-family: inherit; font-size: 0.9rem;">
                    </div>
                    @endforeach
                </div>
                <p style="color: var(--text-muted); font-size: 0.8rem; margin-bottom: 1rem;">
                    <i class="fa-solid fa-circle-info"></i> Select the radio button next to the correct answer.
                </p>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.75rem;">
                    <i class="fa-solid fa-plus"></i> Add Question
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
