@extends('layouts.app')

@section('content')
<section class="page-header" style="padding-top: 120px; padding-bottom: 30px;">
    <div class="container">
        <h1>Create an Account</h1>
        <p style="color: var(--text-muted);">Bergabung dengan EduAngle untuk mulai belajar</p>
    </div>
</section>

<section class="container" style="padding-bottom: 6rem; display: flex; justify-content: center;">
    <div class="glass-panel" style="padding: 3rem; width: 100%; max-width: 500px; position: relative;">
        <h2 style="text-align: center; margin-bottom: 2.5rem; font-weight: 600;">Sign Up</h2>
        
        <form method="POST" action="{{ route('register.post') }}" style="display: flex; flex-direction: column; gap: 1.5rem;">
            @csrf
            
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label for="name" style="font-size: 0.95rem; font-weight: 500; color: var(--text-muted);">Full Name</label>
                <div style="position: relative;">
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                        class="@error('name') is-invalid @enderror"
                        style="width: 100%; padding: 1rem 1rem 1rem 2.75rem; border-radius: 8px; border: 1px solid @error('name') #f43f5e @else var(--glass-border) @enderror; background: rgba(15, 23, 42, 0.6); color: white; font-family: var(--font-main); outline: none; transition: border-color 0.3s ease;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); pointer-events: none;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
                @error('name')
                    <span style="color: #f43f5e; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label for="username" style="font-size: 0.95rem; font-weight: 500; color: var(--text-muted);">Username</label>
                <div style="position: relative;">
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required autocomplete="username"
                        class="@error('username') is-invalid @enderror"
                        style="width: 100%; padding: 1rem 1rem 1rem 2.75rem; border-radius: 8px; border: 1px solid @error('username') #f43f5e @else var(--glass-border) @enderror; background: rgba(15, 23, 42, 0.6); color: white; font-family: var(--font-main); outline: none; transition: border-color 0.3s ease;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); pointer-events: none;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                </div>
                @error('username')
                    <span style="color: #f43f5e; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label for="email" style="font-size: 0.95rem; font-weight: 500; color: var(--text-muted);">Email Address</label>
                <div style="position: relative;">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                        class="@error('email') is-invalid @enderror"
                        style="width: 100%; padding: 1rem 1rem 1rem 2.75rem; border-radius: 8px; border: 1px solid @error('email') #f43f5e @else var(--glass-border) @enderror; background: rgba(15, 23, 42, 0.6); color: white; font-family: var(--font-main); outline: none; transition: border-color 0.3s ease;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); pointer-events: none;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                </div>
                @error('email')
                    <span style="color: #f43f5e; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</span>
                @enderror
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label for="password" style="font-size: 0.95rem; font-weight: 500; color: var(--text-muted);">Password</label>
                <div style="position: relative;">
                    <input type="password" id="password" name="password" required 
                        class="@error('password') is-invalid @enderror"
                        style="width: 100%; padding: 1rem 2.75rem 1rem 2.75rem; border-radius: 8px; border: 1px solid @error('password') #f43f5e @else var(--glass-border) @enderror; background: rgba(15, 23, 42, 0.6); color: white; font-family: var(--font-main); outline: none; transition: border-color 0.3s ease;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); pointer-events: none;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    
                    <button type="button" id="togglePassword" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-muted); cursor: pointer; padding: 0; display: flex; align-items: center; justify-content: center;">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                    </button>
                </div>
                @error('password')
                    <span style="color: #f43f5e; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label for="password_confirmation" style="font-size: 0.95rem; font-weight: 500; color: var(--text-muted);">Confirm Password</label>
                <div style="position: relative;">
                    <input type="password" id="password_confirmation" name="password_confirmation" required 
                        style="width: 100%; padding: 1rem 1rem 1rem 2.75rem; border-radius: 8px; border: 1px solid var(--glass-border); background: rgba(15, 23, 42, 0.6); color: white; font-family: var(--font-main); outline: none; transition: border-color 0.3s ease;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); pointer-events: none;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 0.5rem; padding: 1rem; font-weight: 600; letter-spacing: 0.5px; display: flex; justify-content: center; align-items: center; gap: 0.5rem; border-radius: 8px;">
                <span>Create Account</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            </button>
        </form>

        <div style="margin-top: 2rem; text-align: center; font-size: 0.95rem;">
            <p style="color: var(--text-muted);">Already have an account? <a href="{{ route('login') }}" style="color: var(--accent); text-decoration: none; font-weight: 500;">Sign in here</a></p>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');
        
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('svg:first-of-type').style.color = 'var(--accent)';
                this.style.borderColor = 'var(--accent)';
                this.style.boxShadow = '0 0 0 3px rgba(56, 189, 248, 0.15)';
            });
            
            input.addEventListener('blur', function() {
                if (!this.classList.contains('is-invalid')) {
                    this.parentElement.querySelector('svg:first-of-type').style.color = 'var(--text-muted)';
                    this.style.borderColor = 'var(--glass-border)';
                    this.style.boxShadow = 'none';
                } else {
                    this.style.borderColor = '#f43f5e';
                    this.style.boxShadow = 'none';
                }
            });
        });

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIcon.style.display = 'none';
                eyeOffIcon.style.display = 'block';
            } else {
                eyeIcon.style.display = 'block';
                eyeOffIcon.style.display = 'none';
            }
        });
    });
</script>
@endsection
