@extends('layouts.app')

@section('content')
<section class="page-header">
    <div class="container">
        <h1><i class="fa-solid fa-question-circle" style="color: var(--secondary);"></i> Quiz & Mini Game</h1>
        <p style="color: var(--text-muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
            Uji pemahamanmu tentang teknik angle kamera melalui kuis interaktif.
        </p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem;">
    @if(session('success'))
        <div class="alert-success" style="background: rgba(16,185,129,0.15); border: 1px solid #10b981; color: #10b981; padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 2rem;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    @forelse($quizzes as $quiz)
    @php
        $result = $userResults->get($quiz->id);
        $percentage = $result ? ($result->total_questions > 0 ? round(($result->score / $result->total_questions) * 100) : 0) : null;
    @endphp
    <div class="glass-panel" style="padding: 2rem; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; transition: transform 0.3s ease, box-shadow 0.3s ease;"
         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.4)'"
         onmouseout="this.style.transform=''; this.style.boxShadow=''">
        <div style="flex: 1; min-width: 200px;">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                <div style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0;">
                    🎯
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 1.2rem;">{{ $quiz->title }}</h3>
                    <span style="color: var(--text-muted); font-size: 0.9rem;"><i class="fa-solid fa-circle-question"></i> {{ $quiz->questions_count }} Questions</span>
                    @if($quiz->module)
                        <span style="margin-left: 1rem; color: var(--secondary); font-size: 0.85rem;"><i class="fa-solid fa-book"></i> {{ $quiz->module->title }}</span>
                    @endif
                </div>
            </div>
            <p style="color: var(--text-muted); margin: 0; font-size: 0.95rem;">{{ $quiz->description }}</p>
        </div>

        <div style="display: flex; align-items: center; gap: 1.5rem; flex-shrink: 0;">
            @if($result !== null)
                <div style="text-align: center;">
                    <div style="font-size: 1.5rem; font-weight: 700; color: {{ $percentage >= 80 ? '#10b981' : ($percentage >= 60 ? '#f59e0b' : '#f43f5e') }};">{{ $percentage }}%</div>
                    <div style="color: var(--text-muted); font-size: 0.8rem;">Last Score</div>
                </div>
            @endif
            <a href="{{ route('quizzes.show', $quiz) }}" class="btn btn-primary" style="padding: 0.65rem 1.8rem; font-size: 0.95rem; white-space: nowrap;">
                @if($result !== null)
                    <i class="fa-solid fa-rotate-right"></i> Retry
                @else
                    <i class="fa-solid fa-play"></i> Start Quiz
                @endif
            </a>
        </div>
    </div>
    @empty
        <div class="glass-panel" style="padding: 4rem; text-align: center;">
            <i class="fa-solid fa-face-sad-tear" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
            <p style="color: var(--text-muted);">Belum ada kuis yang tersedia. Cek kembali nanti!</p>
        </div>
    @endforelse

    <div style="margin-top: 2rem; text-align: center;">
        <a href="{{ route('student.report') }}" class="btn btn-outline" style="font-size: 0.95rem; padding: 0.65rem 2rem;">
            <i class="fa-solid fa-chart-bar"></i> Lihat Laporan Saya
        </a>
    </div>
</section>
@endsection
