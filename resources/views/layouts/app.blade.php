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
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('aset/logo.png') }}">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav class="navbar" id="navbar">
    <div class="container nav-container">
        <a href="{{ route('home') }}" class="logo"><i class="fa-solid fa-camera-retro"></i> EduAngle</a>
        
        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fa-solid fa-bars"></i>
        </button>

        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            
            @auth
                <li><a href="{{ route('materi') }}" class="{{ request()->routeIs('materi*') ? 'active' : '' }}">Materi</a></li>
                @if(Auth::user()->role === 'student')
                    <li><a href="{{ route('quizzes.index') }}" class="{{ request()->routeIs('quizzes*') ? 'active' : '' }}">Quiz</a></li>
                @endif
                <li><a href="{{ route('simulasi') }}" class="{{ request()->routeIs('simulasi') ? 'active' : '' }}">Simulasi 3D</a></li>
                @if(Auth::user()->role === 'student')
                    <li><a href="{{ route('student.report') }}" class="{{ request()->routeIs('student.report') ? 'active' : '' }}">My Report</a></li>
                @endif
            @endauth

            <li><a href="{{ route('about-us') }}" class="{{ request()->routeIs('about-us') ? 'active' : '' }}">About Us</a></li>
            
            @auth
                @if(Auth::user()->role === 'admin')
                    <li><a href="{{ route('dashboard.admin') }}" class="{{ request()->is('admin/*') ? 'active' : '' }}"><i class="fa-solid fa-user-shield"></i> Admin</a></li>
                @elseif(Auth::user()->role === 'teacher')
                    <li><a href="{{ route('teacher.dashboard') }}" class="{{ request()->routeIs('teacher.dashboard') || request()->routeIs('teacher.student.*') ? 'active' : '' }}"><i class="fa-solid fa-chalkboard-user"></i> Teacher Dashboard</a></li>
                    <li><a href="{{ route('teacher.quizzes.index') }}" class="{{ request()->routeIs('teacher.quizzes.*') ? 'active' : '' }}"><i class="fa-solid fa-list-check"></i> Manage Quizzes</a></li>
                @endif
            @endauth

            <!-- Login / Logout buttons -->
            @auth
                <li>
                    <a href="{{ url('/logout') }}" style="color: var(--accent);"><i class="fa-solid fa-right-from-bracket"></i> Logout ({{ Auth::user()->name }})</a>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 0.5rem 1.5rem; margin-top: -0.5rem; color: white !important;">Login</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

@yield('content')

<footer class="footer">
    <div class="container">
        <div class="footer-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('materi') }}">Materi</a>
            <a href="{{ route('about-us') }}">About Us</a>
        </div>
        <p>&copy; {{ date("Y") }} EduAngle SMK. Sebuah Platform Pengembangan Sumber Belajar Inovatif.</p>
        <p style="font-size: 0.85rem; color: var(--text-muted); opacity: 0.7;">Dibuat untuk mempermudah siswa belajar fotografi dan videografi.</p>
    </div>
</footer>

<!-- Interactivity script -->
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
