@extends('layouts.app')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Materi: Angle Kamera</h1>
        <p style="color: var(--text-muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Pahami posisi meletakkan kamera yang tepat untuk menghasilkan kesan emosional, ukuran, maupun komposisi visual yang sempurna pada subjek.</p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem;">
    <div class="materi-grid">
        @forelse($modules as $module)
        <div class="materi-card glass-panel">
            @if($module->image_path)
                <img src="{{ asset($module->image_path) }}" alt="{{ $module->title }}" class="materi-card-img" style="object-fit: cover; width: 100%; max-height: 200px;">
            @else
                <img src="https://placehold.co/600x400/4f46e5/ffffff?text={{ urlencode($module->title) }}" alt="{{ $module->title }}" class="materi-card-img">
            @endif
            <div class="materi-card-content">
                <h3>{{ $module->title }}</h3>
                <p>{{ $module->description }}</p>
            </div>
        </div>
        @empty
            <div style="grid-column: span 3; text-align: center; color: var(--text-muted); padding: 3rem;">
                <p>Materi belum tersedia saat ini. Silakan cek kembali nanti atau hubungi Admin.</p>
            </div>
        @endforelse
    </div>
</section>
@endsection
