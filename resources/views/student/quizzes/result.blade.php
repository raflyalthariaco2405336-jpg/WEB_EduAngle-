@extends('layouts.app')

@section('content')
<style>
    @keyframes scoreReveal { from { transform: scale(0.5); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    @keyframes confetti { 0%{transform:translateY(0) rotate(0);opacity:1} 100%{transform:translateY(-200px) rotate(720deg);opacity:0} }
    .score-ring { animation: scoreReveal 0.6s cubic-bezier(0.34,1.56,0.64,1) forwards; }
</style>

<section class="page-header" style="padding-bottom: 0;">
    <div class="container">
        <h1>Quiz Complete!</h1>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem; max-width: 700px;">

    @php
        $grade = $percentage >= 80 ? 'Excellent' : ($percentage >= 60 ? 'Good' : 'Needs Improvement');
        $gradeColor = $percentage >= 80 ? '#10b981' : ($percentage >= 60 ? '#f59e0b' : '#f43f5e');
        $emoji = $percentage >= 80 ? '🎉' : ($percentage >= 60 ? '👍' : '💪');
    @endphp

    <div class="glass-panel score-ring" style="padding: 3rem; text-align: center; margin-bottom: 2rem;">
        <div style="font-size: 5rem; margin-bottom: 0.5rem;">{{ $emoji }}</div>
        <!-- Score ring -->
        <div style="position: relative; display: inline-block; margin: 1rem 0 1.5rem;">
            <svg width="160" height="160" style="transform: rotate(-90deg);">
                <circle cx="80" cy="80" r="70" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="12"/>
                <circle cx="80" cy="80" r="70" fill="none" stroke="{{ $gradeColor }}" stroke-width="12"
                    stroke-dasharray="{{ round(2 * 3.14159 * 70) }}"
                    stroke-dashoffset="{{ round(2 * 3.14159 * 70 * (1 - $percentage/100)) }}"
                    stroke-linecap="round"/>
            </svg>
            <div style="position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <span style="font-size: 2.5rem; font-weight: 800; color: {{ $gradeColor }};">{{ $percentage }}%</span>
            </div>
        </div>

        <h2 style="font-size: 1.8rem; margin-bottom: 0.5rem; color: white;">{{ $quiz->title }}</h2>
        <p style="color: var(--text-muted); margin-bottom: 1.5rem;">
            You answered <strong style="color: white;">{{ $score }}</strong> out of <strong style="color: white;">{{ $total }}</strong> questions correctly.
        </p>

        <span style="display: inline-block; padding: 0.5rem 1.5rem; border-radius: 50px; font-weight: 700;
                     background: {{ $gradeColor }}22; color: {{ $gradeColor }}; border: 1px solid {{ $gradeColor }}44;">
            {{ $grade }}
        </span>

        <div style="display: flex; gap: 1rem; justify-content: center; margin-top: 2rem; flex-wrap: wrap;">
            <a href="{{ route('quizzes.show', $quiz) }}" class="btn btn-outline" style="padding: 0.7rem 2rem;">
                <i class="fa-solid fa-rotate-right"></i> Try Again
            </a>
            <a href="{{ route('quizzes.index') }}" class="btn btn-primary" style="padding: 0.7rem 2rem;">
                <i class="fa-solid fa-list"></i> All Quizzes
            </a>
            <a href="{{ route('student.report') }}" class="btn btn-outline" style="padding: 0.7rem 2rem;">
                <i class="fa-solid fa-chart-bar"></i> My Report
            </a>
        </div>
    </div>

    @php
        $tips = [
            'Needs Improvement' => 'Jangan menyerah! Pelajari kembali materi angle kamera dan coba lagi.',
            'Good' => 'Bagus! Kamu sudah memahami sebagian besar materi. Latih terus untuk mencapai hasil sempurna.',
            'Excellent' => 'Luar biasa! Kamu menguasai materi angle kamera dengan sangat baik!',
        ];
    @endphp
    <div class="glass-panel" style="padding: 1.5rem; background: rgba({{ $percentage >= 80 ? '16,185,129' : ($percentage >= 60 ? '245,158,11' : '244,63,94') }}, 0.07);">
        <p style="margin: 0; color: var(--text-main);"><i class="fa-solid fa-lightbulb" style="color: #f59e0b;"></i> {{ $tips[$grade] }}</p>
    </div>
</section>
@endsection
