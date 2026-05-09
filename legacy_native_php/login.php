<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If already logged in, redirect home
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';

// Dummy database of users
$users = [
    'admin' => ['id' => 1, 'password' => 'password123', 'role' => 'admin', 'name' => 'System Admin'],
    'guru' => ['id' => 2, 'password' => 'password123', 'role' => 'teacher', 'name' => 'Bpk. Guru Fotografi'],
    'siswa' => ['id' => 3, 'password' => 'password123', 'role' => 'student', 'name' => 'Siswa Kreatif']
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        // Success
        $_SESSION['user_id'] = $users[$username]['id'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role'];
        $_SESSION['name'] = $users[$username]['name'];

        // Redirect based on role
        if ($users[$username]['role'] === 'admin') {
            header("Location: dashboard_admin.php");
        } elseif ($users[$username]['role'] === 'teacher') {
            header("Location: dashboard_teacher.php");
        } else {
            header("Location: materi.php");
        }
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<?php require_once 'includes/navbar.php'; ?>

<section class="page-header" style="padding-top: 120px; padding-bottom: 30px;">
    <div class="container">
        <h1>Welcome Back</h1>
        <p style="color: var(--text-muted);">Masuk ke akun Anda untuk melanjutkan belajar</p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem; display: flex; justify-content: center;">
    <div class="glass-panel" style="padding: 3rem; width: 100%; max-width: 450px;">
        <h2 style="text-align: center; margin-bottom: 2rem;">Login</h2>
        
        <?php if ($error): ?>
            <div style="background: rgba(244, 63, 94, 0.2); border: 1px solid var(--accent); color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; text-align: center;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div>
                <label for="username" style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Username</label>
                <input type="text" id="username" name="username" required autocomplete="off"
                    style="width: 100%; padding: 1rem; border-radius: 8px; border: 1px solid var(--glass-border); background: rgba(15, 23, 42, 0.5); color: white; font-family: var(--font-main); outline: none;">
            </div>
            
            <div>
                <label for="password" style="display: block; margin-bottom: 0.5rem; color: var(--text-muted);">Password</label>
                <input type="password" id="password" name="password" required 
                    style="width: 100%; padding: 1rem; border-radius: 8px; border: 1px solid var(--glass-border); background: rgba(15, 23, 42, 0.5); color: white; font-family: var(--font-main); outline: none;">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Login</button>
        </form>

        <div style="margin-top: 2rem; border-top: 1px solid var(--glass-border); padding-top: 1.5rem;">
            <p style="font-size: 0.9rem; color: var(--text-muted); text-align: center; margin-bottom: 0.5rem;"><strong>Akun Demo (User / Pass)</strong></p>
            <ul style="font-size: 0.85rem; color: var(--text-muted); text-align: center;">
                <li>admin / password123 (Admin)</li>
                <li>guru / password123 (Teacher)</li>
                <li>siswa / password123 (Student)</li>
            </ul>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
