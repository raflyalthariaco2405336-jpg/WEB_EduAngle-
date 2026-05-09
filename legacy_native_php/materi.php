<?php 
require_once 'includes/middleware.php';
requireRole(['student', 'teacher', 'admin']);
require_once 'includes/navbar.php'; 
?>

<section class="page-header">
    <div class="container">
        <h1>Materi: Angle Kamera</h1>
        <p style="color: var(--text-muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Pahami posisi meletakkan kamera yang tepat untuk menghasilkan kesan emosional, ukuran, maupun komposisi visual yang sempurna pada subjek.</p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem;">
    <div class="materi-grid">
        <!-- 1. Eye Level -->
        <div class="materi-card glass-panel">
            <img src="assets/images/eye_level.png" alt="Eye Level Angle" class="materi-card-img" onerror="this.src='https://placehold.co/600x400/4f46e5/ffffff?text=Eye+Level'">
            <div class="materi-card-content">
                <h3>Eye Level</h3>
                <p>Kamera diposisikan sejajar dengan mata subjek. Angle ini merupakan yang paling umum, menghasilkan tangkapan gambar yang natural, objektif, dan menunjukkan posisi yang setara dengan audiens.</p>
            </div>
        </div>

        <!-- 2. High Angle -->
        <div class="materi-card glass-panel">
            <img src="assets/images/high_angle.png" alt="High Angle" class="materi-card-img" onerror="this.src='https://placehold.co/600x400/0ea5e9/ffffff?text=High+Angle'">
            <div class="materi-card-content">
                <h3>High Angle</h3>
                <p>Kamera mengambil gambar dari atas memandang ke bawah menghadap subjek. Hal ini memberi kesan subjek terlihat lebih kecil, lemah, inferior, atau tertekan.</p>
            </div>
        </div>

        <!-- 3. Low Angle -->
        <div class="materi-card glass-panel">
            <img src="assets/images/low_angle.png" alt="Low Angle" class="materi-card-img" onerror="this.src='https://placehold.co/600x400/f43f5e/ffffff?text=Low+Angle'">
            <div class="materi-card-content">
                <h3>Low Angle</h3>
                <p>Kamera diposisikan dari bawah menatap ke atas ke arah subjek. Teknik ini memberikan kesan subjek tampak lebih besar, agung, kuat, heroik, atau dominan.</p>
            </div>
        </div>

        <!-- 4. Bird Eye View -->
        <div class="materi-card glass-panel">
            <img src="assets/images/bird_eye.png" alt="Bird Eye View" class="materi-card-img" onerror="this.src='https://placehold.co/600x400/10b981/ffffff?text=Bird+Eye+View'">
            <div class="materi-card-content">
                <h3>Bird Eye View</h3>
                <p>Tangkapan gambar ekstrem dari sudut sangat tinggi memandang langsung ke bawah, seperti pandangan burung yang sedang terbang. Angle ini sangat cocok untuk memperlihatkan kondisi lingkungan sekitar subjek secara luas.</p>
            </div>
        </div>

        <!-- 5. Frog Eye View -->
        <div class="materi-card glass-panel">
            <img src="assets/images/frog_eye.png" alt="Frog Eye View" class="materi-card-img" onerror="this.src='https://placehold.co/600x400/f59e0b/ffffff?text=Frog+Eye+View'">
            <div class="materi-card-content">
                <h3>Frog Eye View</h3>
                <p>Kamera diposisikan sejajar tanah atau serendah mungkin mengarah ke atas. Angle ekstrem ini membuat subjek terlihat luar biasa tinggi, besar, atau memberikan pandangan dramatis dari level bawah.</p>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
