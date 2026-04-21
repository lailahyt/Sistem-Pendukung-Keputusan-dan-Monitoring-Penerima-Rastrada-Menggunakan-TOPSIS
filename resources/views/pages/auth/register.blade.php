<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SPK Rastrada</title>

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

        .register-wrapper {
            display: flex;
            width: 100%;
            max-width: 960px;
            min-height: 580px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(45, 68, 160, 0.15);
        }

        /* ── Left: Decoration ── */
        .reg-left {
            flex: 0 0 42%;
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

        .left-illustration { position: relative; z-index: 1; margin-bottom: 1.8rem; }

        .left-title {
            font-size: 20px;
            font-weight: 600;
            color: rgba(255,255,255,0.95);
            text-align: center;
            line-height: 1.45;
            position: relative;
            z-index: 1;
            margin-bottom: 8px;
        }

        .left-desc {
            font-size: 13px;
            color: rgba(255,255,255,0.55);
            text-align: center;
            position: relative;
            z-index: 1;
            max-width: 230px;
            line-height: 1.6;
        }

        .step-dots {
            display: flex;
            gap: 6px;
            margin-top: 2rem;
            position: relative;
            z-index: 1;
        }

        .step-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.25);
        }

        .step-dot.active {
            width: 24px;
            border-radius: 4px;
            background: rgba(255,255,255,0.75);
        }

        /* ── Right: Form ── */
        .reg-right {
            flex: 1;
            background: #ffffff;
            padding: 2.8rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2rem;
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

        .brand-icon svg { width: 18px; height: 18px; }

        .brand-name {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a2e;
            letter-spacing: -0.2px;
        }

        .reg-heading {
            font-size: 24px;
            font-weight: 600;
            color: #1a1a2e;
            letter-spacing: -0.5px;
            line-height: 1.2;
            margin-bottom: 5px;
        }

        .reg-subheading {
            font-size: 13.5px;
            color: #6b7280;
            margin-bottom: 1.8rem;
        }

        .field-row {
            display: flex;
            gap: 12px;
            margin-bottom: 0;
        }

        .field-row .field-group { flex: 1; }

        .field-group { margin-bottom: 1rem; }

        .field-label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
            letter-spacing: 0.2px;
        }

        .field-wrap { position: relative; }

        .field-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px;
            height: 15px;
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

        .field-wrap input::placeholder { color: #c0c4cf; }

        .field-wrap input.is-invalid { border-color: #ef4444; }

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

        .password-strength {
            display: flex;
            gap: 4px;
            margin-top: 6px;
        }

        .strength-bar {
            flex: 1;
            height: 3px;
            border-radius: 2px;
            background: #e5e7eb;
            transition: background 0.3s;
        }

        .strength-label {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 4px;
        }

        .terms-row {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin: 1.2rem 0 1.4rem;
        }

        .terms-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            margin-top: 2px;
            accent-color: #2D44A0;
            flex-shrink: 0;
        }

        .terms-row label {
            font-size: 12.5px;
            color: #6b7280;
            line-height: 1.5;
        }

        .terms-row label a {
            color: #2D44A0;
            font-weight: 500;
            text-decoration: none;
        }

        .terms-row label a:hover { text-decoration: underline; }

        .btn-register {
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

        .btn-register:hover {
            background: #3A55C0;
            box-shadow: 0 6px 18px rgba(45, 68, 160, 0.38);
        }

        .btn-register:active { transform: scale(0.98); }

        .login-row {
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            margin-top: 1.2rem;
        }

        .login-row a {
            color: #2D44A0;
            font-weight: 600;
            text-decoration: none;
        }

        .login-row a:hover { text-decoration: underline; }

        @media (max-width: 680px) {
            .reg-left { display: none; }
            .reg-right { flex: 0 0 100%; border-radius: 20px; }
            .register-wrapper { border-radius: 20px; }
            .field-row { flex-direction: column; gap: 0; }
        }
    </style>
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>

    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: "Pendaftaran Gagal",
                text: "@foreach ($errors->all() as $error){{ $error }}{{ $loop->last ? '' : ' ' }}@endforeach",
                icon: "error",
                confirmButtonColor: "#2D44A0",
                confirmButtonText: "Perbaiki"
            });
        });
    </script>
    @endif

    <div class="register-wrapper">

        {{-- LEFT: Decoration --}}
        <div class="reg-left">
            <div class="bubble" style="width:220px;height:220px;top:-70px;left:-70px;"></div>
            <div class="bubble" style="width:160px;height:160px;bottom:-50px;right:-50px;"></div>
            <div class="bubble" style="width:80px;height:80px;top:38%;left:15px;"></div>
            <div class="bubble" style="width:45px;height:45px;bottom:22%;right:18px;"></div>

            <div class="left-illustration">
                <svg width="210" height="195" viewBox="0 0 210 195" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Background card -->
                    <rect x="15" y="30" width="180" height="130" rx="12" fill="rgba(255,255,255,0.08)" stroke="rgba(255,255,255,0.18)" stroke-width="1"/>
                    <!-- Top header strip -->
                    <rect x="15" y="30" width="180" height="30" rx="12" fill="rgba(255,255,255,0.13)"/>
                    <rect x="15" y="48" width="180" height="12" fill="rgba(255,255,255,0.13)"/>
                    <!-- User avatar circle -->
                    <circle cx="105" cy="15" r="15" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.3)" stroke-width="1"/>
                    <circle cx="105" cy="11" r="5" fill="rgba(255,255,255,0.6)"/>
                    <path d="M95 24c0-5.523 4.477-8 10-8s10 2.477 10 8" stroke="rgba(255,255,255,0.6)" stroke-width="1.5" stroke-linecap="round"/>
                    <!-- Header label -->
                    <rect x="88" y="44" width="34" height="6" rx="3" fill="rgba(255,255,255,0.4)"/>
                    <!-- Form fields illustration -->
                    <rect x="28" y="72" width="74" height="14" rx="5" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.2)" stroke-width="0.5"/>
                    <rect x="108" y="72" width="74" height="14" rx="5" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.2)" stroke-width="0.5"/>
                    <rect x="28" y="94" width="154" height="14" rx="5" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.2)" stroke-width="0.5"/>
                    <rect x="28" y="116" width="154" height="14" rx="5" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.2)" stroke-width="0.5"/>
                    <!-- Field icons -->
                    <circle cx="38" cy="79" r="3.5" fill="rgba(255,255,255,0.4)"/>
                    <circle cx="38" cy="101" r="3.5" fill="rgba(255,255,255,0.4)"/>
                    <circle cx="38" cy="123" r="3.5" fill="rgba(255,255,255,0.4)"/>
                    <!-- Field fill bars -->
                    <rect x="47" y="77" width="40" height="4" rx="2" fill="rgba(255,255,255,0.35)"/>
                    <rect x="47" y="99" width="55" height="4" rx="2" fill="rgba(255,255,255,0.35)"/>
                    <rect x="47" y="121" width="30" height="4" rx="2" fill="rgba(255,255,255,0.2)"/>
                    <!-- Submit button illustration -->
                    <rect x="55" y="140" width="100" height="14" rx="6" fill="rgba(255,255,255,0.3)"/>
                    <rect x="78" y="144" width="54" height="6" rx="3" fill="rgba(255,255,255,0.6)"/>
                    <!-- Check badge -->
                    <circle cx="170" cy="72" r="12" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.3)" stroke-width="0.5"/>
                    <path d="M165 72l3 3 6-6" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <!-- Progress dots -->
                    <circle cx="88" cy="170" r="3" fill="rgba(255,255,255,0.3)"/>
                    <rect x="93" y="167" width="24" height="6" rx="3" fill="rgba(255,255,255,0.65)"/>
                    <circle cx="122" cy="170" r="3" fill="rgba(255,255,255,0.3)"/>
                </svg>
            </div>

            <h2 class="left-title">Buat akun baru<br>dengan mudah</h2>
            <p class="left-desc">Isi data diri Anda dan mulai gunakan SPK Rastrada hari ini</p>

            <div class="step-dots">
                <div class="step-dot active"></div>
                <div class="step-dot"></div>
                <div class="step-dot"></div>
            </div>
        </div>

        {{-- RIGHT: Form --}}
        <div class="reg-right">

            <div class="brand">
                <div class="brand-icon">
                    <svg viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 2a4 4 0 100 8 4 4 0 000-8z" fill="white"/>
                        <path d="M2 16c0-3.866 3.134-6 7-6s7 2.134 7 6" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="brand-name">SPK Rastrada</span>
            </div>

            <h1 class="reg-heading">Daftar sekarang 🚀</h1>
            <p class="reg-subheading">Lengkapi informasi di bawah untuk membuat akun</p>

            <form action="/register" method="POST" autocomplete="off" id="registerForm">
                @csrf

                {{-- Name --}}
                <div class="field-group">
                    <label class="field-label" for="inputName">Nama Lengkap</label>
                    <div class="field-wrap">
                        <svg class="field-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="8" cy="5" r="3"/>
                            <path d="M2 14c0-3.314 2.686-5 6-5s6 1.686 6 5"/>
                        </svg>
                        <input
                            type="text"
                            id="inputName"
                            name="name"
                            placeholder="Nama lengkap Anda"
                            value="{{ old('name') }}"
                            required
                            autofocus
                        >
                    </div>
                </div>

                {{-- Email --}}
                <div class="field-group">
                    <label class="field-label" for="inputEmail">Alamat Email</label>
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
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div class="field-group">
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
                            placeholder="Min. 8 karakter"
                            required
                            oninput="checkStrength(this.value)"
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('inputPassword', 'eye1')" title="Tampilkan password">
                            <svg id="eye1" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M1 8s2.5-5 7-5 7 5 7 5-2.5 5-7 5-7-5-7-5z"/>
                                <circle cx="8" cy="8" r="2"/>
                            </svg>
                        </button>
                    </div>
                    <div class="password-strength" id="strengthBars">
                        <div class="strength-bar" id="bar1"></div>
                        <div class="strength-bar" id="bar2"></div>
                        <div class="strength-bar" id="bar3"></div>
                        <div class="strength-bar" id="bar4"></div>
                    </div>
                    <div class="strength-label" id="strengthLabel"></div>
                </div>

                {{-- Confirm Password --}}
                <div class="field-group">
                    <label class="field-label" for="inputPasswordConfirm">Konfirmasi Password</label>
                    <div class="field-wrap">
                        <svg class="field-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M13 6H3a1 1 0 00-1 1v6a1 1 0 001 1h10a1 1 0 001-1V7a1 1 0 00-1-1z"/>
                            <path d="M5 6V4a3 3 0 016 0v2"/>
                            <circle cx="8" cy="10" r="1.2" fill="currentColor" stroke="none"/>
                        </svg>
                        <input
                            type="password"
                            id="inputPasswordConfirm"
                            name="password_confirmation"
                            placeholder="Ulangi password"
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('inputPasswordConfirm', 'eye2')" title="Tampilkan password">
                            <svg id="eye2" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M1 8s2.5-5 7-5 7 5 7 5-2.5 5-7 5-7-5-7-5z"/>
                                <circle cx="8" cy="8" r="2"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="terms-row">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">
                        Saya menyetujui <a href="#">Syarat & Ketentuan</a> serta <a href="#">Kebijakan Privasi</a> SPK Rastrada
                    </label>
                </div>

                <button type="submit" class="btn-register">Buat Akun</button>
            </form>

            <div class="login-row">
                Sudah punya akun? <a href="/">Masuk di sini</a>
            </div>

        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon  = document.getElementById(iconId);
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

        function checkStrength(val) {
            const bars   = [document.getElementById('bar1'), document.getElementById('bar2'), document.getElementById('bar3'), document.getElementById('bar4')];
            const label  = document.getElementById('strengthLabel');
            const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e'];
            const labels = ['Sangat lemah', 'Lemah', 'Cukup kuat', 'Kuat'];

            let score = 0;
            if (val.length >= 8)              score++;
            if (/[A-Z]/.test(val))            score++;
            if (/[0-9]/.test(val))            score++;
            if (/[^A-Za-z0-9]/.test(val))     score++;

            bars.forEach((b, i) => {
                b.style.background = i < score ? colors[score - 1] : '#e5e7eb';
            });

            label.textContent  = val.length ? labels[score - 1] || '' : '';
            label.style.color  = val.length && score ? colors[score - 1] : '#9ca3af';
        }
    </script>

</body>
</html>
