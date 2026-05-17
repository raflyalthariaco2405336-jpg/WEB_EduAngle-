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
    <div class="glass-panel" style="padding: 1.5rem; background: rgba({{ $percentage >= 80 ? '16,185,129' : ($percentage >= 60 ? '245,158,11' : '244,63,94') }}, 0.07); margin-bottom: 2rem;">
        <p style="margin: 0; color: var(--text-main);"><i class="fa-solid fa-lightbulb" style="color: #f59e0b;"></i> {{ $tips[$grade] }}</p>
    </div>

    <!-- Review Section -->
    @if(isset($review) && count($review) > 0)
    <div class="glass-panel" style="padding: 2rem;">
        <h3 style="margin-bottom: 1.5rem; font-size: 1.2rem; color: white;"><i class="fa-solid fa-square-poll-horizontal" style="color: var(--secondary);"></i> Review Pertanyaan</h3>
        
        @foreach($review as $i => $item)
        <div style="padding: 1.5rem; border-radius: 10px; background: rgba(255,255,255,0.02); border: 1px solid var(--glass-border); margin-bottom: 1.25rem;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; margin-bottom: 1rem;">
                <h4 style="margin: 0; font-size: 1rem; color: white; line-height: 1.5;">
                    <span style="color: var(--secondary);">Q{{ $i + 1 }}.</span> {{ $item['question_text'] }}
                </h4>
                @if($item['is_correct'])
                    <span style="background: rgba(16,185,129,0.12); color: #10b981; border: 1px solid rgba(16,185,129,0.3); padding: 0.25rem 0.75rem; border-radius: 50px; font-size: 0.8rem; font-weight: 700; display: flex; align-items: center; gap: 0.35rem; flex-shrink: 0;">
                        <i class="fa-solid fa-circle-check"></i> Benar
                    </span>
                @else
                    <span style="background: rgba(244,63,94,0.12); color: #f43f5e; border: 1px solid rgba(244,63,94,0.3); padding: 0.25rem 0.75rem; border-radius: 50px; font-size: 0.8rem; font-weight: 700; display: flex; align-items: center; gap: 0.35rem; flex-shrink: 0;">
                        <i class="fa-solid fa-circle-xmark"></i> Salah
                    </span>
                @endif
            </div>

            @if($item['image_path'])
                <img src="{{ asset($item['image_path']) }}" style="max-width: 100%; max-height: 160px; object-fit: cover; border-radius: 6px; margin-bottom: 1rem; border: 1px solid var(--glass-border);">
            @endif

            <div style="display: grid; grid-template-columns: 1fr; gap: 0.5rem; margin-left: 0;">
                @foreach($item['answers'] as $ans)
                    @php
                        $isSubmitted = ($ans->id == $item['submitted_id']);
                        $isCorrectOption = $ans->is_correct;
                        
                        $bgColor = 'rgba(255,255,255,0.02)';
                        $borderColor = 'var(--glass-border)';
                        $textColor = 'var(--text-muted)';
                        $icon = '○';
                        
                        if ($isCorrectOption) {
                            $bgColor = 'rgba(16,185,129,0.08)';
                            $borderColor = 'rgba(16,185,129,0.4)';
                            $textColor = '#10b981';
                            $icon = '✓';
                        } elseif ($isSubmitted && !$item['is_correct']) {
                            $bgColor = 'rgba(244,63,94,0.08)';
                            $borderColor = 'rgba(244,63,94,0.4)';
                            $textColor = '#f43f5e';
                            $icon = '✗';
                        }
                    @endphp
                    <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.6rem 1rem; border-radius: 8px; background: {{ $bgColor }}; border: 1px solid {{ $borderColor }}; color: {{ $textColor }}; font-size: 0.9rem;">
                        <span style="font-weight: 800; font-size: 1rem; width: 16px;">{{ $icon }}</span>
                        <span>{{ $ans->answer_text }}</span>
                        @if($isSubmitted)
                            <span style="font-size: 0.7rem; font-weight: 700; margin-left: auto; opacity: 0.8; background: rgba(255,255,255,0.06); padding: 0.15rem 0.4rem; border-radius: 4px; color: white;">Jawaban Anda</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
    @endif
</section>
@endsection
