@extends('layouts.app')

@section('content')
<section class="page-header" style="padding-top: 120px; padding-bottom: 30px;">
    <div class="container">
        <h1>Overview Modul Pembelajaran</h1>
        <p style="color: var(--text-muted);">Kelola konten materi untuk siswa</p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem;">
    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid var(--accent); color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    <div class="glass-panel" style="padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2>Daftar Modul</h2>
            <a href="{{ route('dashboard.modules.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Modul</a>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <th style="padding: 1rem;">No</th>
                        <th style="padding: 1rem;">Judul</th>
                        <th style="padding: 1rem;">Dibuat Pada</th>
                        <th style="padding: 1rem; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($modules as $index => $module)
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <td style="padding: 1rem;">{{ $index + 1 }}</td>
                        <td style="padding: 1rem; font-weight: 500;">{{ $module->title }}</td>
                        <td style="padding: 1rem; color: var(--text-muted);">{{ $module->created_at->format('d M Y') }}</td>
                        <td style="padding: 1rem; text-align: right; display: flex; gap: 0.5rem; justify-content: flex-end;">
                            <a href="{{ route('dashboard.modules.edit', $module) }}" class="btn" style="background: rgba(15, 23, 42, 0.8); color: white; padding: 0.5rem 1rem; border-radius: 6px;">Edit</a>
                            <form action="{{ route('dashboard.modules.destroy', $module) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus modul ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="background: rgba(244, 63, 94, 0.8); color: white; padding: 0.5rem 1rem; border-radius: 6px; border: none; cursor: pointer;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding: 2rem; text-align: center; color: var(--text-muted);">Belum ada data modul.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
