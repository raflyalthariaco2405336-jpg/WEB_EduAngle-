@extends('layouts.app')

@section('content')
<section class="page-header" style="padding-top: 100px; padding-bottom: 20px;">
    <div class="container" style="text-align: left;">
        <a href="{{ route('materi') }}" class="btn btn-outline btn-sm" style="margin-bottom: 1rem;"><i class="fa-solid fa-arrow-left"></i> Kembali ke Materi</a>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem;">
    <div style="max-width: 900px; margin: 0 auto;">
        @if($module->image_path)
            <img src="{{ asset($module->image_path) }}" alt="{{ $module->title }}" class="materi-detail-img shadow-lg" style="box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
        @else
            <img src="https://placehold.co/1200x600/4f46e5/ffffff?text={{ urlencode($module->title) }}" alt="{{ $module->title }}" class="materi-detail-img shadow-lg" style="box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
        @endif

        <div class="glass-panel materi-detail-content">
            <h1 class="materi-detail-title">{{ $module->title }}</h1>
            
            <hr style="border-color: var(--glass-border); margin: 1.5rem 0;">
            
            <div class="materi-detail-desc">
                {!! nl2br(e($module->description)) !!}
            </div>
            
            <div style="margin-top: 3rem;">
                <h3 style="margin-bottom: 1rem; color: var(--secondary);">Topik Pembelajaran</h3>
                <ul style="list-style-type: disc; padding-left: 1.5rem; color: var(--text-muted); line-height: 1.8;">
                    <li>Pengenalan terhadap {{ $module->title }}</li>
                    <li>Fungsi dan dampak psikologis dari sudut pandang ini.</li>
                    <li>Contoh penerapan nyata dalam industri film dan fotografi.</li>
                    <li>Tips dan trik pengambilan gambar terbaik.</li>
                </ul>
                <p style="margin-top: 1rem; font-size: 0.9rem; color: var(--text-muted); font-style: italic;">*Catatan: Poin-poin di atas adalah materi esensial yang akan dibahas pada modul ini.</p>
            </div>
        </div>
    </div>
</section>
@endsection
