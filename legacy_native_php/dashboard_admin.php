<?php 
require_once 'includes/middleware.php';
requireRole(['admin']);
require_once 'includes/navbar.php'; 
?>

<main class="dashboard-layout">
    <!-- Sidebar -->
    <aside class="sidebar glass-panel" style="border-radius: 0;">
        <h3 style="margin-bottom: 2rem; color: var(--accent);">Admin Panel</h3>
        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="fa-solid fa-users-gear"></i> Master Data Info</a></li>
            <li><a href="#"><i class="fa-solid fa-user-tie"></i> Data Guru</a></li>
            <li><a href="#"><i class="fa-solid fa-database"></i> Database system</a></li>
            <li><a href="#"><i class="fa-solid fa-sliders"></i> Pengaturan Sistem</a></li>
        </ul>
    </aside>

    <!-- Content -->
    <section class="dashboard-content">
        <h2>Sistem Manajemen (Admin)</h2>
        <p style="color: var(--text-muted); margin-bottom: 2rem;">(UI Mockup) Halaman master admin untuk manajemen infrastruktur website.</p>

        <div class="dashboard-cards">
            <div class="glass-panel dash-stat-card">
                <div class="dash-stat-info">
                    <h4>Server Load</h4>
                    <h2>14%</h2>
                </div>
                <div class="dash-stat-icon" style="color: #10b981;"><i class="fa-solid fa-server"></i></div>
            </div>
            <div class="glass-panel dash-stat-card">
                <div class="dash-stat-info">
                    <h4>Guru Terdaftar</h4>
                    <h2>8 Guru</h2>
                </div>
                <div class="dash-stat-icon" style="color: var(--accent);"><i class="fa-solid fa-address-book"></i></div>
            </div>
             <div class="glass-panel dash-stat-card">
                <div class="dash-stat-info">
                    <h4>Storage Used</h4>
                    <h2>240 MB</h2>
                </div>
                <div class="dash-stat-icon" style="color: var(--secondary);"><i class="fa-solid fa-hard-drive"></i></div>
            </div>
        </div>

        <div class="glass-panel" style="padding: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3>Users System Logs</h3>
            </div>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Role</th>
                            <th>Status Akses</th>
                            <th>Last Login</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>USER-488</td>
                            <td>Guru Fotografi</td>
                            <td><span class="badge badge-success">Aktif</span></td>
                            <td>12 Menit Lalu</td>
                        </tr>
                        <tr>
                            <td>USER-422</td>
                            <td>Siswa Multimedia</td>
                            <td><span class="badge badge-success">Aktif</span></td>
                            <td>1 Jam Lalu</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>
