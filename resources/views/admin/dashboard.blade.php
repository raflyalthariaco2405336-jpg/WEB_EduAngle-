@extends('layouts.app')

@section('content')
<section class="page-header" style="padding-top: 120px; padding-bottom: 30px;">
    <div class="container">
        <h1>Admin Dashboard</h1>
        <p style="color: var(--text-muted);">Manage your platform content</p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem;">
    <div class="glass-panel" style="padding: 2rem;">
        <h2>Dashboard Overview</h2>
        <br>
        <div class="benefits-grid">
            <a href="{{ route('dashboard.modules.index') }}" style="text-decoration: none; color: inherit;">
                <div class="benefit-card glass-panel" style="background: rgba(15, 23, 42, 0.6);">
                    <i class="fa-solid fa-book benefit-icon"></i>
                    <h3>Manage Learning Modules</h3>
                    <p>Create, update, and organize the camera angle techniques.</p>
                </div>
            </a>
            <a href="{{ route('dashboard.quizzes.index') }}" style="text-decoration: none; color: inherit;">
                <div class="benefit-card glass-panel" style="background: rgba(15, 23, 42, 0.6);">
                    <i class="fa-solid fa-question-circle benefit-icon"></i>
                    <h3>Manage Quizzes</h3>
                    <p>Create quizzes, add questions with images, and set correct answers.</p>
                </div>
            </a>
            <a href="{{ route('teacher.dashboard') }}" style="text-decoration: none; color: inherit;">
                <div class="benefit-card glass-panel" style="background: rgba(15, 23, 42, 0.6);">
                    <i class="fa-solid fa-chalkboard-user benefit-icon"></i>
                    <h3>Student Reports</h3>
                    <p>Monitor student performance, quiz scores, and provide feedback.</p>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection
