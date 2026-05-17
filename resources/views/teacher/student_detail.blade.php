@extends('layouts.app')

@section('content')
<section class="page-header" style="padding-bottom: 1rem;">
    <div class="container" style="text-align: left;">
        <a href="{{ route('teacher.dashboard') }}" class="btn btn-outline btn-sm" style="margin-bottom: 1rem;">
            <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
        </a>
        <h1 style="font-size: clamp(1.8rem,4vw,2.5rem);">{{ $student->name }}</h1>
        <p style="color: var(--text-muted);">{{ $student->email }} &nbsp;·&nbsp; Student Detail View</p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem;">

    @if(session('success'))
    <div style="background: rgba(16,185,129,0.12); border: 1px solid #10b981; color: #10b981; padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 2rem;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <!-- Stats row -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <div class="glass-panel" style="padding: 1.5rem; text-align: center;">
            <div style="font-size: 2rem; font-weight: 800; color: {{ $avgScore !== null ? ($avgScore >= 80 ? '#10b981' : ($avgScore >= 60 ? '#f59e0b' : '#f43f5e')) : 'var(--text-muted)' }};">
                {{ $avgScore !== null ? $avgScore.'%' : '—' }}
            </div>
            <div style="color: var(--text-muted); font-size: 0.85rem;">Average Score</div>
        </div>
        <div class="glass-panel" style="padding: 1.5rem; text-align: center;">
            <div style="font-size: 2rem; font-weight: 800; color: var(--secondary);">{{ $results->count() }}</div>
            <div style="color: var(--text-muted); font-size: 0.85rem;">Total Attempts</div>
        </div>
        <div class="glass-panel" style="padding: 1.5rem; text-align: center;">
            <div style="font-size: 2rem; font-weight: 800; color: var(--primary);">{{ $feedbacks->count() }}</div>
            <div style="color: var(--text-muted); font-size: 0.85rem;">Feedbacks</div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; align-items: start;">

        <!-- Quiz results -->
        <div class="glass-panel" style="padding: 2rem;">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;"><i class="fa-solid fa-list-check" style="color: var(--secondary);"></i> Quiz History</h3>
            @forelse($results as $result)
            @php $pct = $result->total_questions > 0 ? round(($result->score/$result->total_questions)*100) : 0;
                 $col = $pct >= 80 ? '#10b981' : ($pct >= 60 ? '#f59e0b' : '#f43f5e'); @endphp
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid var(--glass-border);">
                <div>
                    <div style="font-weight: 600; font-size: 0.9rem;">{{ $result->quiz?->title ?? 'Deleted Quiz' }}</div>
                    <div style="color: var(--text-muted); font-size: 0.75rem;">{{ $result->completed_at->format('d M Y, H:i') }}</div>
                </div>
                <div style="text-align: right;">
                    <div style="font-weight: 700; color: {{ $col }};">{{ $pct }}%</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $result->score }}/{{ $result->total_questions }}</div>
                </div>
            </div>
            @empty
            <p style="color: var(--text-muted); text-align: center; padding: 1.5rem 0;">No quiz attempts yet.</p>
            @endforelse
        </div>

        <!-- Feedback panel -->
        <div>
            <!-- Feedback form (Add / Edit) -->
            <div class="glass-panel" style="padding: 2rem; margin-bottom: 1.5rem;">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;"><i class="fa-solid fa-pen-to-square" style="color: var(--primary);"></i>
                    {{ $editingFeedback ? 'Edit Feedback' : 'Add Feedback' }}
                </h3>
                <form action="{{ $editingFeedback ? route('teacher.feedback.update', $editingFeedback) : route('teacher.feedback.store', $student) }}" method="POST">
                    @csrf
                    @if($editingFeedback)
                        @method('PUT')
                    @endif
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.4rem;">Status</label>
                        <select name="status" required style="width: 100%; padding: 0.7rem 1rem; border-radius: 8px; background: rgba(255,255,255,0.06); border: 1px solid var(--glass-border); color: white; font-family: inherit;">
                            @foreach(['Needs Improvement', 'Good', 'Excellent'] as $s)
                            <option value="{{ $s }}" style="background: #1e293b;" {{ ($editingFeedback?->status ?? '') === $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.4rem;">Comment</label>
                        <textarea name="comment" rows="4" required placeholder="e.g. Good understanding of High Angle techniques…"
                            style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; background: rgba(255,255,255,0.06); border: 1px solid var(--glass-border); color: white; font-family: inherit; resize: vertical; font-size: 0.95rem;">{{ $editingFeedback?->comment }}</textarea>
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        <button type="submit" class="btn btn-primary" style="flex: 1; padding: 0.7rem;">
                            <i class="fa-solid fa-save"></i> {{ $editingFeedback ? 'Save Changes' : 'Save Feedback' }}
                        </button>
                        @if($editingFeedback)
                            <a href="{{ route('teacher.student.show', $student) }}" class="btn btn-outline" style="padding: 0.7rem 1rem; color: var(--text-muted); border-color: var(--glass-border); text-decoration: none; text-align: center;">
                                Cancel
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- All feedbacks -->
            @if($feedbacks->count() > 0)
            <div class="glass-panel" style="padding: 2rem;">
                <h3 style="margin-bottom: 1.5rem; font-size: 1rem; color: var(--text-muted);">All Teacher Feedbacks</h3>
                @foreach($feedbacks as $fb)
                @php $badgeColors = ['Excellent'=>['#10b981','rgba(16,185,129,0.1)'],'Good'=>['#f59e0b','rgba(245,158,11,0.1)'],'Needs Improvement'=>['#f43f5e','rgba(244,63,94,0.1)']];
                     [$fc, $fbg] = $badgeColors[$fb->status] ?? ['white','rgba(255,255,255,0.05)']; @endphp
                <div style="background: {{ $fbg }}; border-radius: 10px; padding: 1.25rem; margin-bottom: 1rem; border: 1px solid var(--glass-border);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                        <div>
                            <span style="font-weight: 600; font-size: 0.85rem; color: var(--secondary);">{{ $fb->teacher?->name }}</span>
                            <div style="font-size: 0.7rem; color: var(--text-muted); margin-top: 0.15rem;">
                                {{ $fb->created_at->format('d M Y, H:i') }} ({{ $fb->created_at->diffForHumans() }})
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 0.75rem; font-weight: 700; color: {{ $fc }}; background: rgba(255,255,255,0.05); padding: 0.2rem 0.6rem; border-radius: 4px;">{{ $fb->status }}</span>
                            @if($fb->teacher_id === Auth::id())
                                <a href="{{ route('teacher.student.show', [$student, 'edit_feedback_id' => $fb->id]) }}" class="btn btn-outline btn-sm" style="padding: 0.2rem 0.4rem; font-size: 0.75rem; border-color: rgba(255,255,255,0.15); color: var(--text-muted);" title="Edit feedback">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <form action="{{ route('teacher.feedback.destroy', $fb) }}" method="POST" onsubmit="return confirm('Delete this feedback?')" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline btn-sm" style="padding: 0.2rem 0.4rem; font-size: 0.75rem; border-color: rgba(244,63,94,0.3); color: var(--accent);" title="Delete feedback">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <p style="margin: 0.5rem 0 0 0; font-size: 0.95rem; color: var(--text-main); line-height: 1.4;">{{ $fb->comment }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
