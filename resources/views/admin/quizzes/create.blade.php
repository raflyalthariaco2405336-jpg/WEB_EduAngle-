@extends('layouts.app')

@section('content')
<section class="page-header" style="padding-bottom: 1rem;">
    <div class="container" style="text-align: left;">
        <a href="{{ route('dashboard.quizzes.index') }}" class="btn btn-outline btn-sm" style="margin-bottom: 1rem;"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <h1>Create New Quiz</h1>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem; max-width: 700px;">
    <div class="glass-panel" style="padding: 2.5rem;">
        <form action="{{ route('dashboard.quizzes.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.4rem;">Quiz Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Mini Game: Guess the Camera Angle"
                    style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; background: rgba(255,255,255,0.06); border: 1px solid var(--glass-border); color: white; font-family: inherit; font-size: 1rem;">
                @error('title')<p style="color: var(--accent); font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</p>@enderror
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.4rem;">Module (optional)</label>
                <select name="module_id" style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; background: rgba(255,255,255,0.06); border: 1px solid var(--glass-border); color: white; font-family: inherit;">
                    <option value="" style="background: #1e293b;">— No specific module —</option>
                    @foreach($modules as $module)
                    <option value="{{ $module->id }}" style="background: #1e293b;" {{ old('module_id') == $module->id ? 'selected' : '' }}>{{ $module->title }}</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-bottom: 2rem;">
                <label style="display: block; color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.4rem;">Description</label>
                <textarea name="description" rows="3" placeholder="Brief description of what this quiz covers…"
                    style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; background: rgba(255,255,255,0.06); border: 1px solid var(--glass-border); color: white; font-family: inherit; resize: vertical;">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <i class="fa-solid fa-plus"></i> Create Quiz & Add Questions
            </button>
        </form>
    </div>
</section>
@endsection
