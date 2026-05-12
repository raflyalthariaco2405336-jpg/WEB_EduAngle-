@extends('layouts.app')

@section('content')
<section class="page-header" style="padding-bottom: 1rem;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h1>Quiz Management</h1>
                <p style="color: var(--text-muted);">Create and manage interactive quizzes.</p>
            </div>
            <a href="{{ route('dashboard.quizzes.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> New Quiz
            </a>
        </div>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem;">
    @if(session('success'))
    <div style="background: rgba(16,185,129,0.12); border: 1px solid #10b981; color: #10b981; padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 2rem;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <div class="glass-panel" style="overflow: hidden;">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Module</th>
                    <th>Questions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($quizzes as $quiz)
                <tr>
                    <td style="color: var(--text-muted);">{{ $loop->iteration }}</td>
                    <td>
                        <div style="font-weight: 600;">{{ $quiz->title }}</div>
                        <div style="color: var(--text-muted); font-size: 0.8rem;">{{ Str::limit($quiz->description, 60) }}</div>
                    </td>
                    <td style="color: var(--text-muted);">{{ $quiz->module?->title ?? '—' }}</td>
                    <td>
                        <span style="background: rgba(14,165,233,0.12); color: var(--secondary); padding: 0.2rem 0.7rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600;">
                            {{ $quiz->questions->count() }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('dashboard.quizzes.show', $quiz) }}" class="btn btn-outline btn-sm" style="padding: 0.4rem 0.9rem; font-size: 0.85rem;">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('dashboard.quizzes.edit', $quiz) }}" class="btn btn-outline btn-sm" style="padding: 0.4rem 0.9rem; font-size: 0.85rem;">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('dashboard.quizzes.destroy', $quiz) }}" method="POST" onsubmit="return confirm('Delete this quiz and all its questions?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="padding: 0.4rem 0.9rem; font-size: 0.85rem; background: rgba(244,63,94,0.15); color: var(--accent); border: 1px solid rgba(244,63,94,0.3);">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align: center; color: var(--text-muted); padding: 3rem;">No quizzes yet. <a href="{{ route('dashboard.quizzes.create') }}" style="color: var(--secondary);">Create one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
