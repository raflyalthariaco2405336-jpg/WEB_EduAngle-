@extends('layouts.app')

@section('content')
<section class="page-header">
    <div class="container">
        <h1><i class="fa-solid fa-chart-line" style="color: var(--secondary);"></i> Laporan Saya</h1>
        <p style="color: var(--text-muted);">Pantau perkembangan belajarmu — {{ $user->name }}</p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem;">

    <!-- Stat cards row -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
        <div class="glass-panel" style="padding: 1.5rem; text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 800; color: var(--secondary);">{{ $avgScore }}%</div>
            <div style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.25rem;">Rata-rata Skor</div>
        </div>
        <div class="glass-panel" style="padding: 1.5rem; text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 800; color: var(--primary);">{{ $attemptedCount }}</div>
            <div style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.25rem;">Quiz Dikerjakan</div>
        </div>
        <div class="glass-panel" style="padding: 1.5rem; text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 800; color: #10b981;">{{ $results->count() }}</div>
            <div style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.25rem;">Total Percobaan</div>
        </div>
        <div class="glass-panel" style="padding: 1.5rem; text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 800; color: #f59e0b;">{{ $feedbacks->count() }}</div>
            <div style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.25rem;">Feedback Guru</div>
        </div>
    </div>

    <!-- Overall Progress bar -->
    <div class="glass-panel" style="padding: 2rem; margin-bottom: 2.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
            <h3 style="margin: 0; font-size: 1.1rem;">Progress Keseluruhan</h3>
            <span style="font-weight: 700; color: var(--secondary);">{{ $progressPercent }}%</span>
        </div>
        <div style="background: rgba(255,255,255,0.06); border-radius: 6px; overflow: hidden; height: 14px;">
            <div style="height: 100%; width: {{ $progressPercent }}%; background: linear-gradient(90deg, var(--primary), var(--secondary)); border-radius: 6px; transition: width 1s ease;"></div>
        </div>
        <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.75rem;">
            Kamu telah mencoba {{ $attemptedCount }} dari {{ $totalQuizzes }} kuis yang tersedia.
        </p>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; align-items: start;">

        <!-- Quiz History -->
        <div class="glass-panel" style="padding: 2rem;">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;"><i class="fa-solid fa-clock-rotate-left" style="color: var(--secondary);"></i> Riwayat Quiz</h3>
            @forelse($results as $result)
            @php
                $pct = $result->total_questions > 0 ? round(($result->score/$result->total_questions)*100) : 0;
                $col = $pct >= 80 ? '#10b981' : ($pct >= 60 ? '#f59e0b' : '#f43f5e');
            @endphp
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.85rem 0; border-bottom: 1px solid var(--glass-border);">
                <div>
                    <div style="font-weight: 600; font-size: 0.95rem;">{{ $result->quiz?->title ?? 'Quiz Dihapus' }}</div>
                    <div style="color: var(--text-muted); font-size: 0.8rem;">{{ $result->completed_at->diffForHumans() }}</div>
                </div>
                <div style="text-align: right;">
                    <div style="font-weight: 700; color: {{ $col }};">{{ $pct }}%</div>
                    <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $result->score }}/{{ $result->total_questions }}</div>
                </div>
            </div>
            @empty
            <p style="color: var(--text-muted); text-align: center; padding: 2rem 0;">Belum ada quiz yang dikerjakan.</p>
            @endforelse
        </div>

        <!-- Teacher Feedback -->
        <div class="glass-panel" style="padding: 2rem;">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;"><i class="fa-solid fa-comments" style="color: var(--primary);"></i> Feedback dari Guru</h3>
            @forelse($feedbacks as $fb)
            @php
                $badgeColors = ['Excellent' => ['bg'=>'rgba(16,185,129,0.15)','color'=>'#10b981'], 'Good' => ['bg'=>'rgba(245,158,11,0.15)','color'=>'#f59e0b'], 'Needs Improvement' => ['bg'=>'rgba(244,63,94,0.15)','color'=>'#f43f5e']];
                $bc = $badgeColors[$fb->status] ?? ['bg'=>'rgba(255,255,255,0.1)','color'=>'white'];
            @endphp
            <div style="padding: 1rem; border-radius: 10px; background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border); margin-bottom: 1rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <span style="font-weight: 600; font-size: 0.9rem; color: var(--secondary);">{{ $fb->teacher?->name ?? 'Guru' }}</span>
                    <span style="padding: 0.2rem 0.8rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; background: {{ $bc['bg'] }}; color: {{ $bc['color'] }};">{{ $fb->status }}</span>
                </div>
                <p style="color: var(--text-main); margin: 0; font-size: 0.9rem; line-height: 1.6;">{{ $fb->comment }}</p>
                <div style="color: var(--text-muted); font-size: 0.75rem; margin-top: 0.5rem;">{{ $fb->updated_at->format('d M Y') }}</div>
            </div>
            @empty
            <div style="text-align: center; padding: 2rem 0;">
                <i class="fa-solid fa-inbox" style="font-size: 2rem; color: var(--text-muted); margin-bottom: 0.5rem;"></i>
                <p style="color: var(--text-muted);">Belum ada feedback dari guru.</p>
            </div>
            @endforelse
        </div>
    </div>

    <div style="margin-top: 2rem; text-align: center;">
        <a href="{{ route('quizzes.index') }}" class="btn btn-primary" style="padding: 0.75rem 2.5rem;">
            <i class="fa-solid fa-play"></i> Mulai Quiz Sekarang
        </a>
    </div>
</section>
@endsection
