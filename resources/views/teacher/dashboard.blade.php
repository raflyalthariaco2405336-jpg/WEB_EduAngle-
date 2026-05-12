@extends('layouts.app')

@section('content')
<section class="page-header">
    <div class="container">
        <h1><i class="fa-solid fa-chalkboard-user" style="color: var(--secondary);"></i> Teacher Dashboard</h1>
        <p style="color: var(--text-muted);">Monitor student performance and provide feedback.</p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem;">

    <!-- Stats row -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
        <div class="glass-panel" style="padding: 1.5rem; text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 800; color: var(--secondary);">{{ $totalStudents }}</div>
            <div style="color: var(--text-muted); font-size: 0.9rem;">Total Students</div>
        </div>
        <div class="glass-panel" style="padding: 1.5rem; text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 800; color: var(--primary);">{{ $totalAttempts }}</div>
            <div style="color: var(--text-muted); font-size: 0.9rem;">Quiz Attempts</div>
        </div>
        <div class="glass-panel" style="padding: 1.5rem; text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 800; color: {{ $overallAvg >= 75 ? '#10b981' : '#f59e0b' }};">{{ $overallAvg }}%</div>
            <div style="color: var(--text-muted); font-size: 0.9rem;">Class Average</div>
        </div>
    </div>

    <!-- Search & student list -->
    <div class="glass-panel" style="padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
            <h2 style="margin: 0; font-size: 1.3rem;">Student List</h2>
            <form method="GET" action="{{ route('teacher.dashboard') }}" style="display: flex; gap: 0.75rem;">
                <input type="text" name="search" value="{{ $search }}" placeholder="Search by name…"
                    style="padding: 0.6rem 1rem; border-radius: 8px; border: 1px solid var(--glass-border); background: rgba(255,255,255,0.05); color: white; font-size: 0.9rem; outline: none; width: 220px;">
                <button type="submit" class="btn btn-primary" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;">
                    <i class="fa-solid fa-search"></i>
                </button>
            </form>
        </div>

        @forelse($students as $student)
        @php
            $avg = $student->avg_score;
            $col = $avg === null ? 'var(--text-muted)' : ($avg >= 80 ? '#10b981' : ($avg >= 60 ? '#f59e0b' : '#f43f5e'));
            $label = $avg === null ? 'No Attempts' : ($avg >= 80 ? 'Excellent' : ($avg >= 60 ? 'Good' : 'Needs Improvement'));
        @endphp
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;
                    padding: 1rem 0; border-bottom: 1px solid var(--glass-border);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--secondary));
                            display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; flex-shrink: 0;">
                    {{ strtoupper(substr($student->name, 0, 1)) }}
                </div>
                <div>
                    <div style="font-weight: 600;">{{ $student->name }}</div>
                    <div style="color: var(--text-muted); font-size: 0.8rem;">
                        {{ $student->quiz_results_count }} attempt(s)
                        @if($student->last_activity)
                            &nbsp;·&nbsp; Last active {{ $student->last_activity->diffForHumans() }}
                        @endif
                    </div>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 1.5rem; flex-shrink: 0;">
                <div style="text-align: right;">
                    <div style="font-weight: 700; color: {{ $col }};">{{ $avg !== null ? $avg.'%' : '—' }}</div>
                    <div style="font-size: 0.75rem; background: {{ $avg === null ? 'rgba(255,255,255,0.06)' : ($avg >= 80 ? 'rgba(16,185,129,0.12)' : ($avg >= 60 ? 'rgba(245,158,11,0.12)' : 'rgba(244,63,94,0.12)')) }};
                                color: {{ $col }}; padding: 0.15rem 0.75rem; border-radius: 50px; font-weight: 600;">{{ $label }}</div>
                </div>
                <a href="{{ route('teacher.student.show', $student) }}" class="btn btn-outline btn-sm" style="padding: 0.5rem 1.2rem;">
                    <i class="fa-solid fa-eye"></i> Detail
                </a>
            </div>
        </div>
        @empty
        <div style="text-align: center; padding: 3rem 0; color: var(--text-muted);">
            <i class="fa-solid fa-users-slash" style="font-size: 2rem; margin-bottom: 0.75rem;"></i>
            <p>No students found{{ $search ? ' matching "' . $search . '"' : '' }}.</p>
        </div>
        @endforelse
    </div>
</section>
@endsection
