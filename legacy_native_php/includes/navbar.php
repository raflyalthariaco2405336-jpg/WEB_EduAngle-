<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
$user_role = $_SESSION['role'] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduAngle | Belajar Angle Kamera</title>
    <!-- Google Fonts for modern typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar" id="navbar">
    <div class="container nav-container">
        <a href="index.php" class="logo"><i class="fa-solid fa-camera-retro"></i> EduAngle</a>
        
        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fa-solid fa-bars"></i>
        </button>

        <ul class="nav-links" id="navLinks">
            <li><a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Home</a></li>
            
            <?php if ($user_role): ?>
                <li><a href="materi.php" class="<?= ($current_page == 'materi.php') ? 'active' : '' ?>">Materi</a></li>
            <?php endif; ?>

            <li><a href="tentang.php" class="<?= ($current_page == 'tentang.php') ? 'active' : '' ?>">Tentang</a></li>
            
            <!-- Dashboard Links based on role -->
            <?php if ($user_role === 'teacher' || $user_role === 'admin'): ?>
                <li><a href="dashboard_teacher.php" class="<?= ($current_page == 'dashboard_teacher.php') ? 'active' : '' ?>"><i class="fa-solid fa-chalkboard-user"></i> Guru</a></li>
            <?php endif; ?>
            
            <?php if ($user_role === 'admin'): ?>
                <li><a href="dashboard_admin.php" class="<?= ($current_page == 'dashboard_admin.php') ? 'active' : '' ?>"><i class="fa-solid fa-user-shield"></i> Admin</a></li>
            <?php endif; ?>

            <!-- Login / Logout buttons -->
            <?php if ($user_role): ?>
                <li>
                    <a href="logout.php" style="color: var(--accent);"><i class="fa-solid fa-right-from-bracket"></i> Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
                </li>
            <?php else: ?>
                <li>
                    <a href="login.php" class="btn btn-primary" style="padding: 0.5rem 1.5rem; margin-top: -0.5rem; color: white !important;">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
