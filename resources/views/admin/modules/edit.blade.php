@extends('layouts.app')

@section('content')
<section class="page-header" style="padding-top: 120px; padding-bottom: 30px;">
    <div class="container">
        <h1>Edit Modul: {{ $module->title }}</h1>
        <p style="color: var(--text-muted);"><a href="{{ route('dashboard.modules.index') }}" style="color: var(--accent); text-decoration: none;">&larr; Kembali ke Daftar</a></p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem; display: flex; justify-content: center;">
    <div class="glass-panel" style="padding: 3rem; width: 100%; max-width: 600px;">
        @if($errors->any())
            <div style="background: rgba(244, 63, 94, 0.2); border: 1px solid var(--accent); color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <ul style="margin: 0; padding-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('dashboard.modules.update', $module) }}" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.5rem;">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Judul Modul</label>
                <input type="text" id="title" name="title" value="{{ old('title', $module->title) }}" required autocomplete="off"
                    style="width: 100%; padding: 1rem; border-radius: 8px; border: 1px solid var(--glass-border); background: rgba(15, 23, 42, 0.5); color: white; font-family: var(--font-main); outline: none;">
            </div>
            
            <div>
                <label for="description" style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Deskripsi Materi</label>
                <textarea id="description" name="description" required rows="5"
                    style="width: 100%; padding: 1rem; border-radius: 8px; border: 1px solid var(--glass-border); background: rgba(15, 23, 42, 0.5); color: white; font-family: var(--font-main); outline: none; resize: vertical;">{{ old('description', $module->description) }}</textarea>
            </div>

            <div>
                <label for="image" style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Upload Ulang Gambar (Kosongkan bila tidak ingin diganti)</label>
                
                @if($module->image_path)
                    <div style="margin-bottom: 1rem;">
                        <img src="{{ Storage::url($module->image_path) }}" alt="Preview" style="max-width: 100%; height: auto; border-radius: 8px;">
                    </div>
                @endif
                
                <input type="file" id="image" name="image" accept="image/*"
                    style="width: 100%; padding: 1rem; border-radius: 8px; border: 1px solid var(--glass-border); background: rgba(15, 23, 42, 0.5); color: white; font-family: var(--font-main); outline: none;">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Update Modul</button>
        </form>
    </div>
</section>
@endsection
