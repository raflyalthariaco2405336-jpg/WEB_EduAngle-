<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Ensures the user is logged in. If not, redirects to login page.
 */
function requireLogin() {
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
        header("Location: login.php");
        exit;
    }
}

/**
 * Checks if the user's role is within the allowed roles array.
 * If not, redirects to an error or home page.
 * 
 * @param array $allowed_roles e.g. ['admin', 'teacher']
 */
function requireRole($allowed_roles) {
    requireLogin();
    
    $user_role = $_SESSION['role'];
    if (!in_array($user_role, $allowed_roles)) {
        // You could redirect to a customized 'unauthorized.php' page, but home is fine for now
        header("Location: index.php?error=unauthorized");
        exit;
    }
}
?>
