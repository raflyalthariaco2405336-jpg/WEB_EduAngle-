@extends('layouts.app')

@section('content')
<style>
    .quiz-option { cursor: pointer; }
    .quiz-option input[type="radio"] { display: none; }
    .quiz-option label {
        display: flex; align-items: center; gap: 1rem;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        border: 2px solid var(--glass-border);
        background: rgba(255,255,255,0.03);
        cursor: pointer;
        transition: all 0.25s ease;
        font-size: 1rem;
    }
    .quiz-option label:hover { border-color: var(--secondary); background: rgba(14,165,233,0.08); }
    .quiz-option input[type="radio"]:checked + label {
        border-color: var(--primary);
        background: rgba(79,70,229,0.15);
    }
    .option-circle {
        width: 28px; height: 28px; border-radius: 50%;
        border: 2px solid var(--glass-border);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.85rem; font-weight: 700; flex-shrink: 0;
        transition: all 0.25s;
    }
    .quiz-option input[type="radio"]:checked + label .option-circle {
        background: var(--primary); border-color: var(--primary); color: white;
    }
    #timer-bar { height: 6px; background: linear-gradient(90deg, var(--primary), var(--secondary)); border-radius: 3px; transition: width 1s linear; }
    .q-card { display: none; }
    .q-card.active { display: block; }
</style>

<section class="page-header" style="padding-bottom: 1rem;">
    <div class="container" style="text-align: left;">
        <a href="{{ route('quizzes.index') }}" class="btn btn-outline btn-sm" style="margin-bottom: 1rem;">
            <i class="fa-solid fa-arrow-left"></i> Back to Quizzes
        </a>
        <h1 style="font-size: clamp(1.8rem, 4vw, 2.5rem);">{{ $quiz->title }}</h1>
        <p style="color: var(--text-muted);">{{ $quiz->description }}</p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem; max-width: 800px;">

    @if($questions->isEmpty())
        <div class="glass-panel" style="padding: 3rem; text-align: center;">
            <p style="color: var(--text-muted);">Quiz ini belum memiliki pertanyaan.</p>
        </div>
    @else
    <!-- Progress & Timer -->
    <div class="glass-panel" style="padding: 1rem 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem;">
        <span style="color: var(--text-muted); font-size: 0.9rem; flex-shrink: 0;">Progress:</span>
        <div style="flex: 1; background: rgba(255,255,255,0.05); border-radius: 3px; overflow: hidden;">
            <div id="progress-bar" style="height: 6px; background: linear-gradient(90deg, var(--primary), var(--secondary)); border-radius: 3px; width: 0%; transition: width 0.3s ease;"></div>
        </div>
        <span id="q-counter" style="color: var(--text-muted); font-size: 0.9rem; flex-shrink: 0;">1 / {{ $questions->count() }}</span>
        <div style="display: flex; align-items: center; gap: 0.5rem; flex-shrink: 0;">
            <i class="fa-solid fa-clock" style="color: var(--accent);"></i>
            <span id="timer" style="font-weight: 700; color: var(--accent);">{{ $questions->count() * 20 }}s</span>
        </div>
    </div>

    <form id="quiz-form" action="{{ route('quizzes.submit', $quiz) }}" method="POST">
        @csrf

        @foreach($questions as $i => $question)
        <div class="q-card glass-panel {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}" style="padding: 2rem; margin-bottom: 1rem;">
            @if($question->image_path)
                <img src="{{ asset($question->image_path) }}" alt="Question Image"
                     style="width: 100%; max-height: 280px; object-fit: cover; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid var(--glass-border);">
            @endif

            <h3 style="font-size: 1.15rem; margin-bottom: 1.5rem; line-height: 1.5;">
                <span style="color: var(--secondary); margin-right: 0.5rem;">Q{{ $i + 1 }}.</span>
                {{ $question->question_text }}
            </h3>

            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                @foreach($question->answers as $ai => $answer)
                @php $letters = ['A','B','C','D','E']; @endphp
                <div class="quiz-option">
                    <input type="radio" name="answers[{{ $question->id }}]" id="ans_{{ $answer->id }}" value="{{ $answer->id }}">
                    <label for="ans_{{ $answer->id }}">
                        <span class="option-circle">{{ $letters[$ai] ?? ($ai+1) }}</span>
                        {{ $answer->answer_text }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        <!-- Navigation -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem;">
            <button type="button" id="btn-prev" onclick="navigate(-1)" class="btn btn-outline btn-sm" style="visibility: hidden;">
                <i class="fa-solid fa-arrow-left"></i> Previous
            </button>
            <button type="button" id="btn-next" onclick="navigate(1)" class="btn btn-primary" style="padding: 0.7rem 2rem;">
                Next <i class="fa-solid fa-arrow-right"></i>
            </button>
            <button type="submit" id="btn-submit" class="btn btn-primary" style="display:none; background: linear-gradient(135deg, #10b981, #059669); padding: 0.7rem 2.5rem;">
                <i class="fa-solid fa-flag-checkered"></i> Submit Quiz
            </button>
        </div>
    </form>
    @endif
</section>

<script>
const totalQ = {{ $questions->count() }};
let current = 0;
let timeLeft = totalQ * 20;

function navigate(dir) {
    document.querySelectorAll('.q-card')[current].classList.remove('active');
    current = Math.max(0, Math.min(totalQ - 1, current + dir));
    document.querySelectorAll('.q-card')[current].classList.add('active');
    updateUI();
}

function updateUI() {
    document.getElementById('q-counter').textContent = (current + 1) + ' / ' + totalQ;
    document.getElementById('progress-bar').style.width = ((current + 1) / totalQ * 100) + '%';
    document.getElementById('btn-prev').style.visibility = current === 0 ? 'hidden' : 'visible';
    document.getElementById('btn-next').style.display = current === totalQ - 1 ? 'none' : 'inline-flex';
    document.getElementById('btn-submit').style.display = current === totalQ - 1 ? 'inline-block' : 'none';
}

// Timer
const timerEl = document.getElementById('timer');
const timerInt = setInterval(() => {
    timeLeft--;
    if (timerEl) timerEl.textContent = timeLeft + 's';
    if (timeLeft <= 0) { clearInterval(timerInt); document.getElementById('quiz-form')?.submit(); }
    if (timeLeft <= 30 && timerEl) timerEl.style.color = 'var(--accent)';
}, 1000);

updateUI();
</script>
@endsection
