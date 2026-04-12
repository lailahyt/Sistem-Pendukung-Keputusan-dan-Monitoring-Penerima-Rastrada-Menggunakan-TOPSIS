<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPK Rastrada</title>

    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap');

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #F0F4FF;
            padding: 1rem;
        }

        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 960px;
            min-height: 560px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(45, 68, 160, 0.15);
        }

        /* ── Left Panel ── */
        .login-left {
            flex: 0 0 45%;
            background: #ffffff;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2.5rem;
        }

        .brand-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #2D44A0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-icon svg {
            width: 18px;
            height: 18px;
        }

        .brand-name {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a2e;
            letter-spacing: -0.2px;
        }

        .login-heading {
            font-size: 26px;
            font-weight: 600;
            color: #1a1a2e;
            letter-spacing: -0.5px;
            line-height: 1.2;
            margin-bottom: 6px;
        }

        .login-subheading {
            font-size: 13.5px;
            color: #6b7280;
            margin-bottom: 2rem;
        }

        .field-label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
            letter-spacing: 0.2px;
        }

        .field-wrap {
            position: relative;
            margin-bottom: 1rem;
        }

        .field-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: #9ca3af;
            pointer-events: none;
        }

        .field-wrap input {
            width: 100%;
            height: 44px;
            padding: 0 40px 0 40px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1a1a2e;
            background: #fafafa;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .field-wrap input:focus {
            border-color: #2D44A0;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(45, 68, 160, 0.08);
        }

        .field-wrap input::placeholder {
            color: #c0c4cf;
        }

        .toggle-password {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: #9ca3af;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-password:hover { color: #2D44A0; }

        .row-meta {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-bottom: 1.5rem;
            margin-top: -4px;
        }

        .link-forgot {
            font-size: 12px;
            color: #2D44A0;
            text-decoration: none;
            font-weight: 500;
        }

        .link-forgot:hover { text-decoration: underline; }

        .btn-login {
            width: 100%;
            height: 46px;
            background: #2D44A0;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            letter-spacing: 0.2px;
            transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
            box-shadow: 0 4px 14px rgba(45, 68, 160, 0.3);
        }

        .btn-login:hover {
            background: #3A55C0;
            box-shadow: 0 6px 18px rgba(45, 68, 160, 0.38);
        }

        .btn-login:active { transform: scale(0.98); }

        .divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 1.4rem 0;
        }

        .divider-line { flex: 1; height: 1px; background: #e5e7eb; }

        .divider span {
            font-size: 12px;
            color: #9ca3af;
        }

        .signup-row {
            text-align: center;
            font-size: 13px;
            color: #6b7280;
        }

        .signup-row a {
            color: #2D44A0;
            font-weight: 600;
            text-decoration: none;
        }

        .signup-row a:hover { text-decoration: underline; }

        /* ── Right Panel ── */
        .login-right {
            flex: 1;
            background: #2D44A0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }

        .right-illustration {
            position: relative;
            z-index: 1;
            margin-bottom: 1.8rem;
        }

        .right-title {
            font-size: 20px;
            font-weight: 600;
            color: rgba(255,255,255,0.95);
            text-align: center;
            line-height: 1.45;
            position: relative;
            z-index: 1;
            margin-bottom: 8px;
        }

        .right-desc {
            font-size: 13px;
            color: rgba(255,255,255,0.55);
            text-align: center;
            position: relative;
            z-index: 1;
            max-width: 240px;
        }

        .badge-row {
            display: flex;
            gap: 8px;
            margin-top: 1.8rem;
            position: relative;
            z-index: 1;
        }

        .badge {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 11.5px;
            color: rgba(255,255,255,0.8);
            font-weight: 500;
        }

        /* ── Responsive ── */
        @media (max-width: 680px) {
            .login-right { display: none; }
            .login-left { flex: 0 0 100%; border-radius: 20px; }
            .login-wrapper { border-radius: 20px; }
        }
    </style>
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>

    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: "Login Gagal",
                text: "@foreach ($errors->all() as $error){{ $error }}{{ $loop->last ? '' : ' ' }}@endforeach",
                icon: "error",
                confirmButtonColor: "#2D44A0",
                confirmButtonText: "Coba lagi"
            });
        });
    </script>
    @endif

    <div class="login-wrapper">

        {{-- LEFT: Form --}}
        <div class="login-left">

            <div class="brand">
                <div class="brand-icon">
                    <svg viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 2a4 4 0 100 8 4 4 0 000-8z" fill="white"/>
                        <path d="M2 16c0-3.866 3.134-6 7-6s7 2.134 7 6" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="brand-name">SPK Rastrada</span>
            </div>

            <h1 class="login-heading">Selamat datang<br>kembali 👋</h1>
            <p class="login-subheading">Masuk untuk mengakses dashboard Anda</p>

            <form action="/login" method="POST" autocomplete="off">
                @csrf

                {{-- Email --}}
                <label class="field-label" for="inputEmail">Email</label>
                <div class="field-wrap">
                    <svg class="field-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="2" y="4" width="12" height="9" rx="1.5"/>
                        <path d="M2 6l6 4 6-4"/>
                    </svg>
                    <input
                        type="email"
                        id="inputEmail"
                        name="email"
                        placeholder="email@contoh.com"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>

                {{-- Password --}}
                <label class="field-label" for="inputPassword">Password</label>
                <div class="field-wrap">
                    <svg class="field-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="7" width="10" height="7" rx="1.5"/>
                        <path d="M5 7V5a3 3 0 016 0v2"/>
                        <circle cx="8" cy="10.5" r="1" fill="currentColor" stroke="none"/>
                    </svg>
                    <input
                        type="password"
                        id="inputPassword"
                        name="password"
                        placeholder="••••••••"
                        required
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword()" title="Tampilkan password">
                        <svg id="eye-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M1 8s2.5-5 7-5 7 5 7 5-2.5 5-7 5-7-5-7-5z"/>
                            <circle cx="8" cy="8" r="2"/>
                        </svg>
                    </button>
                </div>

                <div class="row-meta">
                    {{-- <a href="/forgot-password" class="link-forgot">Lupa password?</a> --}}
                </div>

                <button type="submit" class="btn-login">Masuk</button>
            </form>

            <div class="divider">
                <div class="divider-line"></div>
                <span>atau</span>
                <div class="divider-line"></div>
            </div>

            <div class="signup-row">
                Belum punya akun? <a href="/register">Daftar sekarang</a>
            </div>

        </div>

        {{-- RIGHT: Decoration --}}
        <div class="login-right">
            <div class="bubble" style="width:220px;height:220px;top:-70px;right:-70px;"></div>
            <div class="bubble" style="width:160px;height:160px;bottom:-50px;left:-50px;"></div>
            <div class="bubble" style="width:90px;height:90px;top:40%;right:20px;"></div>
            <div class="bubble" style="width:50px;height:50px;top:20%;left:20px;"></div>

            <div class="right-illustration">
                <svg width="220" height="200" viewBox="0 0 220 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Main card -->
                    <rect x="20" y="35" width="180" height="125" rx="12" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.2)" stroke-width="1"/>
                    <!-- Header bar -->
                    <rect x="20" y="35" width="180" height="32" rx="12" fill="rgba(255,255,255,0.15)"/>
                    <rect x="20" y="55" width="180" height="12" fill="rgba(255,255,255,0.15)"/>
                    <!-- Header dots -->
                    <circle cx="36" cy="51" r="4" fill="rgba(255,255,255,0.5)"/>
                    <circle cx="52" cy="51" r="4" fill="rgba(255,255,255,0.3)"/>
                    <circle cx="68" cy="51" r="4" fill="rgba(255,255,255,0.2)"/>
                    <!-- Title in header -->
                    <rect x="95" y="47" width="60" height="7" rx="3.5" fill="rgba(255,255,255,0.4)"/>
                    <!-- Bar chart -->
                    <rect x="38" y="100" width="18" height="40" rx="4" fill="rgba(255,255,255,0.35)"/>
                    <rect x="62" y="82" width="18" height="58" rx="4" fill="rgba(255,255,255,0.55)"/>
                    <rect x="86" y="91" width="18" height="49" rx="4" fill="rgba(255,255,255,0.4)"/>
                    <rect x="110" y="73" width="18" height="67" rx="4" fill="rgba(255,255,255,0.65)"/>
                    <rect x="134" y="85" width="18" height="55" rx="4" fill="rgba(255,255,255,0.45)"/>
                    <rect x="158" y="95" width="18" height="45" rx="4" fill="rgba(255,255,255,0.35)"/>
                    <!-- Trend line -->
                    <polyline points="47,100 71,83 95,91 119,73 143,85 167,97" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" fill="none" stroke-dasharray="3 2"/>
                    <!-- Dots on line -->
                    <circle cx="47" cy="100" r="3" fill="white" opacity="0.7"/>
                    <circle cx="71" cy="83" r="3" fill="white" opacity="0.7"/>
                    <circle cx="119" cy="73" r="3.5" fill="white" opacity="0.9"/>
                    <circle cx="167" cy="97" r="3" fill="white" opacity="0.7"/>
                    <!-- Bottom row label -->
                    <rect x="38" y="146" width="18" height="4" rx="2" fill="rgba(255,255,255,0.25)"/>
                    <rect x="62" y="146" width="18" height="4" rx="2" fill="rgba(255,255,255,0.25)"/>
                    <rect x="86" y="146" width="18" height="4" rx="2" fill="rgba(255,255,255,0.25)"/>
                    <rect x="110" y="146" width="18" height="4" rx="2" fill="rgba(255,255,255,0.25)"/>
                    <rect x="134" y="146" width="18" height="4" rx="2" fill="rgba(255,255,255,0.25)"/>
                    <rect x="158" y="146" width="18" height="4" rx="2" fill="rgba(255,255,255,0.25)"/>
                    <!-- Small stat cards below -->
                    <rect x="20" y="170" width="56" height="24" rx="7" fill="rgba(255,255,255,0.12)" stroke="rgba(255,255,255,0.2)" stroke-width="0.5"/>
                    <rect x="82" y="170" width="56" height="24" rx="7" fill="rgba(255,255,255,0.12)" stroke="rgba(255,255,255,0.2)" stroke-width="0.5"/>
                    <rect x="144" y="170" width="56" height="24" rx="7" fill="rgba(255,255,255,0.12)" stroke="rgba(255,255,255,0.2)" stroke-width="0.5"/>
                    <rect x="28" y="177" width="22" height="4" rx="2" fill="rgba(255,255,255,0.5)"/>
                    <rect x="28" y="184" width="14" height="3" rx="1.5" fill="rgba(255,255,255,0.25)"/>
                    <rect x="90" y="177" width="22" height="4" rx="2" fill="rgba(255,255,255,0.5)"/>
                    <rect x="90" y="184" width="14" height="3" rx="1.5" fill="rgba(255,255,255,0.25)"/>
                    <rect x="152" y="177" width="22" height="4" rx="2" fill="rgba(255,255,255,0.5)"/>
                    <rect x="152" y="184" width="14" height="3" rx="1.5" fill="rgba(255,255,255,0.25)"/>
                    <!-- User avatar top -->
                    <circle cx="110" cy="18" r="16" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.3)" stroke-width="1"/>
                    <circle cx="110" cy="13" r="5.5" fill="rgba(255,255,255,0.6)"/>
                    <path d="M99 26c0-6.075 4.925-9 11-9s11 2.925 11 9" stroke="rgba(255,255,255,0.6)" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>

            <h2 class="right-title">Sistem Pendukung<br>Keputusan Rastrada</h2>
            <p class="right-desc">Analisis data cerdas untuk pengambilan keputusan yang lebih baik</p>

            <div class="badge-row">
                <div class="badge">📊 Analisis</div>
                <div class="badge">⚡ Real-time</div>
                <div class="badge">🔒 Aman</div>
            </div>
        </div>

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('inputPassword');
            const icon  = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 00-2.79.588l.77.771A5.944 5.944 0 018 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0114.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z" fill="currentColor" stroke="none"/>
                    <path d="M11.297 9.176a3.5 3.5 0 00-4.474-4.474l.823.823a2.5 2.5 0 012.829 2.829l.822.822zm-2.943 1.299l.822.822a3.5 3.5 0 01-4.474-4.474l.823.823a2.5 2.5 0 002.829 2.829z" fill="currentColor" stroke="none"/>
                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 001.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 018 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709z" fill="currentColor" stroke="none"/>
                    <path d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z" fill="currentColor" stroke="none"/>
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path d="M1 8s2.5-5 7-5 7 5 7 5-2.5 5-7 5-7-5-7-5z" stroke="currentColor" stroke-width="1.5" fill="none"/>
                    <circle cx="8" cy="8" r="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                `;
            }
        }
    </script>

</body>
</html>
