<?php 
require_once 'includes/middleware.php';
requireRole(['teacher', 'admin']);
require_once 'includes/navbar.php'; 
?>

<main class="dashboard-layout">
    <!-- Sidebar -->
    <aside class="sidebar glass-panel" style="border-radius: 0;">
        <h3 style="margin-bottom: 2rem; color: var(--secondary);">Guru Panel</h3>
        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="fa-solid fa-book-open"></i> Kelola Materi</a></li>
            <li><a href="#"><i class="fa-solid fa-users"></i> Perkembangan Siswa</a></li>
            <li><a href="#"><i class="fa-solid fa-message"></i> Diskusi Siswa</a></li>
            <li><a href="#"><i class="fa-solid fa-gear"></i> Pengaturan</a></li>
        </ul>
    </aside>

    <!-- Content -->
    <section class="dashboard-content">
        <h2>Kelola Materi Angle Kamera</h2>
        <p style="color: var(--text-muted); margin-bottom: 2rem;">(UI Mockup) Halaman guru untuk mengelola materi pembelajaran dan nilai siswa.</p>

        <div class="dashboard-cards">
            <div class="glass-panel dash-stat-card">
                <div class="dash-stat-info">
                    <h4>Total Materi</h4>
                    <h2>5 Topik</h2>
                </div>
                <div class="dash-stat-icon"><i class="fa-solid fa-file-video"></i></div>
            </div>
            <div class="glass-panel dash-stat-card">
                <div class="dash-stat-info">
                    <h4>Siswa Aktif</h4>
                    <h2>142 Siswa</h2>
                </div>
                <div class="dash-stat-icon" style="color: var(--secondary);"><i class="fa-solid fa-graduation-cap"></i></div>
            </div>
        </div>

        <div class="glass-panel" style="padding: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3>Daftar Materi Kuliah</h3>
                <button class="btn btn-primary" style="padding: 0.5rem 1.5rem; font-size: 0.9rem;">+ Tambah Materi</button>
            </div>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul Materi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#001</td>
                            <td>Eye Level</td>
                            <td><span class="badge badge-success">Selesai / Aktif</span></td>
                            <td>
                                <button class="btn btn-outline" style="padding: 0.3rem 0.8rem; font-size: 0.8rem;">Edit</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#002</td>
                            <td>High Angle</td>
                            <td><span class="badge badge-success">Selesai / Aktif</span></td>
                            <td>
                                <button class="btn btn-outline" style="padding: 0.3rem 0.8rem; font-size: 0.8rem;">Edit</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#003</td>
                            <td>Low Angle</td>
                            <td><span class="badge badge-success">Selesai / Aktif</span></td>
                            <td>
                                <button class="btn btn-outline" style="padding: 0.3rem 0.8rem; font-size: 0.8rem;">Edit</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>
