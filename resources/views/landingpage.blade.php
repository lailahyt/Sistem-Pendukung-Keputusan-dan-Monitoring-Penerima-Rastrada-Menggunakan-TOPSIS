<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK RASTRADA — Sistem Pendukung Keputusan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />

    <style>
        :root {
            --primary: #2D44A0;
            --primary-d: #253990;
            --primary-l: #EEF2FF;
            --navy: #1a2e6b;
            --body-bg: #f8fafc;
            --text: #1e293b;
            --muted: #64748b;
            --border: #e2e8f0;
            --white: #ffffff;
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--body-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text);
            overflow-x: hidden;
        }

        /* ── NAVBAR ── */
        .navbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 1px 0 var(--border);
            transition: all .3s ease;
            padding: 16px 0;
        }

        .navbar.scrolled {
            padding: 10px 0;
            box-shadow: 0 4px 24px rgba(45, 68, 160, .08);
        }

        .navbar-brand {
            font-size: 20px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--navy) 0%, var(--primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link {
            font-weight: 500;
            font-size: 14px;
            color: var(--muted) !important;
            position: relative;
            transition: color .25s;
            padding: 6px 0 !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            border-radius: 2px;
            transition: width .3s ease;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-nav {
            background: var(--primary);
            color: var(--white) !important;
            border-radius: 10px;
            padding: 9px 20px !important;
            font-weight: 600 !important;
            font-size: 14px;
            transition: all .25s ease;
            box-shadow: 0 4px 12px rgba(45, 68, 160, .25);
        }

        .btn-nav:hover {
            background: var(--primary-d) !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(45, 68, 160, .35);
        }

        .btn-nav::after {
            display: none !important;
        }

        /* ── HERO ── */
        .hero {
            padding: 140px 0 120px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(45, 68, 160, .04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(45, 68, 160, .04) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, black 40%, transparent 100%);
            -webkit-mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, black 40%, transparent 100%);
        }

        .hero-orb {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(45, 68, 160, .1) 0%, transparent 65%);
            border-radius: 50%;
            top: -150px;
            right: -150px;
            pointer-events: none;
        }

        .hero-orb-2 {
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(45, 68, 160, 0.15) 0%, transparent 65%);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            pointer-events: none;
        }

        /* hero text animations */
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary-l);
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 100px;
            margin-bottom: 20px;
            border: 1px solid rgba(45, 68, 160, .15);
            opacity: 0;
            animation: fadeUp .6s ease .1s forwards;
        }

        .hero-title {
            font-size: clamp(36px, 5vw, 58px);
            font-weight: 800;
            line-height: 1.12;
            color: var(--text);
            margin-bottom: 20px;
            opacity: 0;
            animation: fadeUp .6s ease .2s forwards;
        }

        .hero-title .highlight {
            background: linear-gradient(135deg, var(--navy) 0%, var(--primary) 60%, #2D44A0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-sub {
            font-size: 17px;
            color: var(--muted);
            line-height: 1.8;
            max-width: 500px;
            margin-bottom: 36px;
            opacity: 0;
            animation: fadeUp .6s ease .3s forwards;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            opacity: 0;
            animation: fadeUp .6s ease .4s forwards;
        }

        .btn-cta {
            background: linear-gradient(135deg, var(--primary) 0%, #2D44A0 100%);
            color: var(--white);
            padding: 13px 28px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .3s ease;
            box-shadow: 0 6px 20px rgba(45, 68, 160, .3);
            border: none;
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(45, 68, 160, .4);
            color: var(--white);
        }

        .btn-outline {
            background: var(--white);
            color: var(--primary);
            padding: 13px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1.5px solid var(--border);
            transition: all .3s ease;
        }

        .btn-outline:hover {
            border-color: var(--primary);
            background: var(--primary-l);
            color: var(--primary);
            transform: translateY(-2px);
        }

        .hero-stats {
            display: flex;
            gap: 32px;
            margin-top: 40px;
            flex-wrap: wrap;
            opacity: 0;
            animation: fadeUp .6s ease .55s forwards;
        }

        .h-stat {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .h-stat-num {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary);
            line-height: 1;
        }

        .h-stat-txt {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.4;
            max-width: 80px;
        }

        /* ── HERO VISUAL (carousel wrapper) ── */
        .hero-visual {
            position: relative;
            opacity: 0;
            animation: fadeLeft .8s ease .45s forwards;
            /* padding bawah untuk ruang badge b1 */
            padding-bottom: 30px;
        }

        /* ── CAROUSEL ── */
        #heroCarousel {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(30, 58, 138, .15);
            border: 1px solid var(--border);
            position: relative;
        }

        /* Ring pulse di luar carousel */
        .carousel-ring {
            position: absolute;
            inset: -5px;
            border-radius: 24px;
            border: 2px solid rgba(45, 68, 160, .18);
            animation: ringPulse 3s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes ringPulse {

            0%,
            100% {
                opacity: .35;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.012);
            }
        }

        #heroCarousel img {
            width: 100%;
            height: 360px;
            object-fit: cover;
            display: block;
        }

        /* overlay tint di tiap gambar */
        #heroCarousel .carousel-item::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(45, 68, 160, .10) 0%, transparent 55%);
            pointer-events: none;
        }

        /* tombol prev/next: navy solid, bukan putih transparan */
        #heroCarousel .carousel-control-prev,
        #heroCarousel .carousel-control-next {
            width: 40px;
            height: 40px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary);
            border-radius: 50%;
            opacity: 0;
            transition: opacity .25s ease;
            box-shadow: 0 4px 12px rgba(45, 68, 160, .3);
        }

        #heroCarousel:hover .carousel-control-prev,
        #heroCarousel:hover .carousel-control-next {
            opacity: 1;
        }

        #heroCarousel .carousel-control-prev {
            left: 12px;
        }

        #heroCarousel .carousel-control-next {
            right: 12px;
        }

        #heroCarousel .carousel-control-prev-icon,
        #heroCarousel .carousel-control-next-icon {
            width: 16px;
            height: 16px;
        }

        /* indikator: titik-titik di bawah carousel (bukan overlay) */
        #heroCarousel .carousel-indicators {
            position: static;
            margin: 10px 0 0;
            justify-content: center;
            gap: 6px;
        }

        #heroCarousel .carousel-indicators button {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--border);
            border: none;
            opacity: 1;
            transition: background .3s, transform .3s;
            flex-shrink: 0;
        }

        #heroCarousel .carousel-indicators button.active {
            background: var(--primary);
            transform: scale(1.3);
        }

        /* ── BUTIRAN BERAS jatuh di atas foto ── */
        .grain-overlay {
            position: absolute;
            inset: 0;
            border-radius: 20px;
            overflow: hidden;
            pointer-events: none;
            z-index: 2;
        }

        .grain {
            position: absolute;
            width: 9px;
            height: 4px;
            background: #F5E6B0;
            border-radius: 50%;
            border: 0.8px solid #C8A048;
            opacity: 0;
            animation: grainFall 3.5s ease-in-out infinite;
        }

        .grain:nth-child(1) {
            left: 10%;
            animation-delay: 0s;
        }

        .grain:nth-child(2) {
            left: 32%;
            animation-delay: 0.9s;
        }

        .grain:nth-child(3) {
            left: 57%;
            animation-delay: 1.7s;
        }

        .grain:nth-child(4) {
            left: 78%;
            animation-delay: 2.5s;
        }

        .grain:nth-child(5) {
            left: 46%;
            animation-delay: 3.1s;
        }

        @keyframes grainFall {
            0% {
                opacity: 0;
                transform: translateY(-10px) rotate(0deg);
            }

            15% {
                opacity: 1;
            }

            85% {
                opacity: 0.7;
            }

            100% {
                opacity: 0;
                transform: translateY(75px) rotate(210deg);
            }
        }

        /* ── BADGE MELAYANG ── */
        .float-badge {
            position: absolute;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 10px 28px rgba(0, 0, 0, .10);
            z-index: 10;
            animation: floatBadge 4s ease-in-out infinite;
        }

        /* b1: kiri bawah carousel — di luar, tidak overlap */
        .float-badge.b1 {
            bottom: -4px;
            left: -20px;
        }

        /* b2: kanan atas carousel — geser ke dalam sedikit agar tidak nabrak */
        .float-badge.b2 {
            top: 16px;
            right: -20px;
            animation-delay: 2s;
        }

        @keyframes floatBadge {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-7px);
            }
        }

        .badge-ico {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--primary-l);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 18px;
        }

        .badge-label {
            font-size: 11px;
            color: var(--muted);
        }

        .badge-val {
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
        }

        /* ── CHIP BERAS ── */
        .chip-beras {
            position: absolute;
            left: -14px;
            /* letakkan di tengah vertikal carousel (360px / 2 - setengah tinggi chip) */
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            background: var(--primary);
            color: var(--white);
            font-size: 11px;
            font-weight: 700;
            padding: 8px 14px;
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 16px rgba(45, 68, 160, .35);
            animation: chipPop 3s ease-in-out infinite;
            white-space: nowrap;
        }

        @keyframes chipPop {

            0%,
            100% {
                transform: translateY(-50%) scale(1);
            }

            50% {
                transform: translateY(-50%) scale(1.05);
            }
        }

        /* ── SECTION COMMONS ── */
        section {
            position: relative;
        }

        .section-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary-l);
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 100px;
            margin-bottom: 14px;
            border: 1px solid rgba(45, 68, 160, .15);
        }

        .section-heading {
            font-size: clamp(26px, 3.5vw, 40px);
            font-weight: 800;
            color: var(--text);
            line-height: 1.2;
            margin-bottom: 14px;
        }

        .section-sub {
            font-size: 16px;
            color: var(--muted);
            line-height: 1.8;
        }

        /* ── ABOUT ── */
        .about {
            padding: 110px 0;
            background: var(--white);
        }

        .about-divider {
            width: 48px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), #2D44A0);
            border-radius: 2px;
            margin-bottom: 28px;
        }

        .about-body {
            font-size: 16px;
            color: var(--muted);
            line-height: 1.9;
            margin-bottom: 20px;
        }

        .highlight-box {
            background: linear-gradient(135deg, var(--primary-l) 0%, #f3e8ff 100%);
            border-left: 3px solid var(--primary);
            padding: 22px 24px;
            border-radius: 12px;
            margin-top: 28px;
        }

        .highlight-box .hb-title {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .highlight-box li {
            font-size: 14px;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .highlight-box li i {
            color: var(--primary);
            font-size: 13px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .info-card {
            background: var(--body-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px 20px;
            transition: all .3s ease;
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(45, 68, 160, .04) 0%, transparent 70%);
            opacity: 0;
            transition: opacity .3s;
        }

        .info-card:hover {
            border-color: rgba(45, 68, 160, .25);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(45, 68, 160, .08);
        }

        .info-card:hover::before {
            opacity: 1;
        }

        .info-card .ic-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--primary-l);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 18px;
            margin-bottom: 14px;
        }

        .info-card .ic-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .info-card .ic-sub {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.6;
        }

        /* ── FITUR ── */
        .features {
            padding: 110px 0;
            background: linear-gradient(180deg, var(--body-bg) 0%, #dde8ff 100%);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 52px;
        }

        .feat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 36px 28px;
            transition: all .35s ease;
            position: relative;
            overflow: hidden;
        }

        .feat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), #2D44A0);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .35s ease;
        }

        .feat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 48px rgba(45, 68, 160, .12);
            border-color: rgba(45, 68, 160, .2);
        }

        .feat-card:hover::after {
            transform: scaleX(1);
        }

        .feat-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            background: var(--primary-l);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: var(--primary);
            margin-bottom: 20px;
            transition: all .35s ease;
        }

        .feat-card:hover .feat-icon {
            background: linear-gradient(135deg, var(--primary), #2D44A0);
            color: var(--white);
            transform: rotate(6deg) scale(1.05);
        }

        .feat-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 10px;
        }

        .feat-text {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.7;
        }

        /* ── METODE ── */
        .metode {
            padding: 110px 0;
            background: var(--white);
        }

        .metode-intro {
            text-align: center;
            max-width: 560px;
            margin: 0 auto 64px;
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            position: relative;
        }

        .steps::before {
            content: '';
            position: absolute;
            top: 40px;
            left: calc(12.5% + 12px);
            right: calc(12.5% + 12px);
            height: 2px;
            background: linear-gradient(90deg, var(--primary-l), var(--primary), #2D44A0, var(--primary), var(--primary-l));
        }

        .step-box {
            text-align: center;
            position: relative;
            padding: 0 8px;
            transition: all .3s;
        }

        .step-num {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid var(--border);
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
            margin: 0 auto 20px;
            position: relative;
            z-index: 1;
            transition: all .3s ease;
            box-shadow: 0 4px 12px rgba(45, 68, 160, .08);
        }

        .step-box:hover .step-num {
            background: linear-gradient(135deg, var(--primary), #2D44A0);
            color: var(--white);
            border-color: var(--primary);
            transform: scale(1.08);
            box-shadow: 0 8px 24px rgba(45, 68, 160, .25);
        }

        .step-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 8px;
        }

        .step-desc {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
        }

        /* ── FOOTER ── */
        footer {
            background: linear-gradient(135deg, #1a2e6b 0%, #0f1e45 100%);
            color: var(--white);
            padding: 48px 0 24px;
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(45, 68, 160, .4), rgba(45, 68, 160, .15), transparent);
        }

        .footer-brand {
            font-size: 20px;
            font-weight: 800;
            background: linear-gradient(135deg, #93a8e8, #93a8e8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .footer-text {
            color: #94a3b8;
            font-size: 14px;
        }

        .footer-divider {
            border-top: 1px solid rgba(255, 255, 255, .08);
            padding-top: 20px;
            margin-top: 32px;
        }

        .footer-meta {
            color: #64748b;
            font-size: 13px;
        }

        /* ── SCROLL REVEAL ── */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .7s ease, transform .7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeLeft {
            from {
                opacity: 0;
                transform: translateX(24px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 991px) {
            .features-grid {
                grid-template-columns: 1fr 1fr;
            }

            .steps {
                grid-template-columns: 1fr 1fr;
                gap: 28px;
            }

            .steps::before {
                display: none;
            }

            .info-grid {
                grid-template-columns: 1fr 1fr;
            }

            .float-badge {
                display: none;
            }

            .chip-beras {
                display: none;
            }
        }

        @media (max-width: 600px) {
            .features-grid {
                grid-template-columns: 1fr;
            }

            .steps {
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .hero {
                padding: 110px 0 70px;
            }

            .hero-stats {
                gap: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top" id="navBar">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <i class="fa-solid fa-wheat-awn"></i>
                SPK RASTRADA
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                    <li class="nav-item mt-2 mt-lg-0"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item mt-1 mt-lg-0"><a class="nav-link" href="#fitur">Fitur</a></li>
                    <li class="nav-item mt-1 mt-lg-0"><a class="nav-link" href="#metode">Statistik</a></li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a href="/login" class="nav-link btn-nav">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sistem
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero" id="home">
        <div class="hero-orb"></div>
        <div class="hero-orb-2"></div>
        <div class="container">
            <div class="row align-items-center g-5">

                <!-- KIRI: teks -->
                <div class="col-lg-6">
                    <div class="hero-eyebrow">
                        <i class="bi bi-geo-alt-fill"></i>
                        Kelurahan Kandangan Barat
                    </div>
                    <h1 class="hero-title">
                        Sistem Pendukung<br>
                        <span class="highlight">Keputusan Penerima</span><br>
                        RASTRADA
                    </h1>
                    <p class="hero-sub">
                        Sistem berbasis metode <b>TOPSIS</b> untuk membantu proses
                        penentuan penerima <b>Beras Sejahtera Daerah (RASTRADA)</b>
                        secara objektif, transparan, dan tepat sasaran di
                        Kelurahan Kandangan Barat.
                    </p>
                    <div class="hero-actions">
                        <a href="/login" class="btn-cta">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Masuk Sistem
                        </a>
                        <a href="#tentang" class="btn-outline">
                            <i class="bi bi-info-circle"></i>
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="h-stat">
                            <div class="h-stat-num"><i class="bi bi-people-fill"></i></div>
                            <div class="h-stat-txt">Data Penduduk</div>
                        </div>
                        <div style="width:1px;background:var(--border);align-self:stretch"></div>
                        <div class="h-stat">
                            <div class="h-stat-num"><i class="bi bi-clipboard-check"></i></div>
                            <div class="h-stat-txt">Seleksi Objektif</div>
                        </div>
                        <div style="width:1px;background:var(--border);align-self:stretch"></div>
                        <div class="h-stat">
                            <div class="h-stat-num"><i class="bi bi-box-seam"></i></div>
                            <div class="h-stat-txt">Monitoring Distribusi</div>
                        </div>
                    </div>
                </div>

                <!-- KANAN: carousel + dekorasi -->
                <div class="col-lg-6">
                    <div class="hero-visual">

                        <!-- Ring pulse di luar carousel -->
                        <div class="carousel-ring"></div>

                        <!-- CAROUSEL -->
                        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">

                            <div class="carousel-inner">

                                <div class="carousel-item active">
                                    <!-- Butiran beras hanya di slide pertama -->
                                    <div class="grain-overlay">
                                        <div class="grain"></div>
                                        <div class="grain"></div>
                                        <div class="grain"></div>
                                        <div class="grain"></div>
                                        <div class="grain"></div>
                                    </div>
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/d4/Kantor_Kelurahan_Kandangan_Barat%2C_Hulu_Sungai_Selatan.JPG"
                                        alt="Kantor Kelurahan Kandangan Barat">
                                </div>

                                <div class="carousel-item">
                                    <img src="{{ asset('assets/static/images/rastrada-distribusi.jpeg') }}"
                                        alt="Distribusi Bantuan RASTRADA">
                                </div>

                            </div>

                            <!-- Tombol prev/next (muncul saat hover) -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>

                        </div>

                        <!-- Indikator titik DI LUAR carousel (tidak overlap gambar) -->
                        <div class="d-flex justify-content-center gap-2 mt-2">
                            <button type="button"
                                style="width:8px;height:8px;border-radius:50%;background:var(--primary);border:none;padding:0;transition:transform .3s;"
                                data-bs-target="#heroCarousel" data-bs-slide-to="0" class="carousel-dot active-dot"
                                id="dot0"></button>
                            <button type="button"
                                style="width:8px;height:8px;border-radius:50%;background:var(--border);border:none;padding:0;transition:transform .3s;"
                                data-bs-target="#heroCarousel" data-bs-slide-to="1" id="dot1"></button>
                        </div>

                        <!-- Badge TOPSIS — kiri bawah -->
                        <div class="float-badge b1">
                            <div class="badge-ico"><i class="bi bi-graph-up-arrow"></i></div>
                            <div>
                                <div class="badge-label">Metode</div>
                                <div class="badge-val">TOPSIS</div>
                            </div>
                        </div>

                        <!-- Badge Transparan — kanan atas -->
                        <div class="float-badge b2">
                            <div class="badge-ico"><i class="bi bi-shield-check"></i></div>
                            <div>
                                <div class="badge-label">Distribusi</div>
                                <div class="badge-val">Transparan</div>
                            </div>
                        </div>

                        <!-- Chip label beras — tengah kiri -->
                        <div class="chip-beras">
                            <i class="fa-solid fa-wheat-awn"></i>
                            Beras Sejahtera Daerah
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- TENTANG -->
    <section id="tentang" class="about">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal">
                    <div class="about-divider"></div>
                    <div class="section-eyebrow"><i class="bi bi-info-circle"></i> Tentang Sistem</div>
                    <h2 class="section-heading">Bantuan Tepat Sasaran<br>Berbasis Data</h2>
                    <p class="about-body">
                        <strong>SPK RASTRADA</strong> dirancang untuk membantu <strong>Kelurahan Kandangan
                            Barat</strong>
                        menentukan penerima bantuan beras daerah secara objektif dan transparan —
                        menghilangkan subjektivitas dari proses seleksi.
                    </p>
                    <p class="about-body">
                        Dengan <strong>metode TOPSIS</strong>, sistem ini menganalisis berbagai kriteria sosial ekonomi
                        dan menghasilkan rekomendasi yang akurat dan dapat dipertanggungjawabkan.
                    </p>
                    <div class="highlight-box">
                        <div class="hb-title">
                            <i class="bi bi-check-circle-fill text-primary"></i>
                            Keunggulan Sistem
                        </div>
                        <ul class="list-unstyled mb-0">
                            <li><i class="bi bi-check2"></i> Proses objektif berdasarkan data terukur</li>
                            <li><i class="bi bi-check2"></i> Transparansi dalam pengambilan keputusan</li>
                            <li><i class="bi bi-check2"></i> Monitoring berkelanjutan setiap periode</li>
                            <li><i class="bi bi-check2"></i> Laporan terstruktur dan mudah dipahami</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 reveal">
                    <div class="info-grid">
                        <div class="info-card">
                            <div class="ic-icon"><i class="bi bi-people-fill"></i></div>
                            <div class="ic-title">Data Penduduk</div>
                            <div class="ic-sub">Kelola data warga secara terstruktur dan terpusat</div>
                        </div>
                        <div class="info-card">
                            <div class="ic-icon"><i class="bi bi-calculator"></i></div>
                            <div class="ic-title">Analisis TOPSIS</div>
                            <div class="ic-sub">Perhitungan otomatis menghasilkan ranking prioritas</div>
                        </div>
                        <div class="info-card">
                            <div class="ic-icon"><i class="bi bi-activity"></i></div>
                            <div class="ic-title">Monitoring</div>
                            <div class="ic-sub">Pantau distribusi bantuan secara real-time</div>
                        </div>
                        <div class="info-card">
                            <div class="ic-icon"><i class="bi bi-file-earmark-bar-graph"></i></div>
                            <div class="ic-title">Laporan</div>
                            <div class="ic-sub">Cetak laporan siap arsip setiap periode</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FITUR -->
    <section id="fitur" class="features">
        <div class="container">
            <div class="reveal">
                <div class="section-eyebrow"><i class="bi bi-grid-fill"></i> Fitur Sistem</div>
                <h2 class="section-heading">Semua yang Dibutuhkan<br>dalam Satu Platform</h2>
            </div>
            <div class="features-grid">
                <div class="feat-card reveal">
                    <div class="feat-icon"><i class="bi bi-people-fill"></i></div>
                    <div class="feat-title">Data Penduduk</div>
                    <div class="feat-text">Mengelola data lengkap masyarakat penerima bantuan dengan informasi
                        demografi dan sosial ekonomi yang terstruktur.</div>
                </div>
                <div class="feat-card reveal">
                    <div class="feat-icon"><i class="bi bi-graph-up"></i></div>
                    <div class="feat-title">Perhitungan TOPSIS</div>
                    <div class="feat-text">Menghasilkan ranking prioritas penerima bantuan secara otomatis menggunakan
                        algoritma TOPSIS yang terstandarisasi.</div>
                </div>
                <div class="feat-card reveal">
                    <div class="feat-icon"><i class="bi bi-clipboard-check"></i></div>
                    <div class="feat-title">Monitoring Bantuan</div>
                    <div class="feat-text">Monitoring pengambilan bantuan setiap penerima secara real-time, lengkap
                        dengan riwayat dan petugas yang bertugas.</div>
                </div>
                <div class="feat-card reveal">
                    <div class="feat-icon"><i class="bi bi-sliders"></i></div>
                    <div class="feat-title">Manajemen Kriteria</div>
                    <div class="feat-text">Atur bobot dan atribut kriteria penilaian secara fleksibel sesuai kebijakan
                        kelurahan setiap periode.</div>
                </div>
                <div class="feat-card reveal">
                    <div class="feat-icon"><i class="bi bi-file-earmark-text"></i></div>
                    <div class="feat-title">Laporan Terstruktur</div>
                    <div class="feat-text">Cetak laporan distribusi per periode dalam format rapi dan siap untuk arsip
                        serta pertanggungjawaban.</div>
                </div>
                <div class="feat-card reveal">
                    <div class="feat-icon"><i class="bi bi-shield-lock"></i></div>
                    <div class="feat-title">Manajemen Akses</div>
                    <div class="feat-text">Tiga tingkat akses — Admin, Petugas, dan Lurah — memastikan setiap pengguna
                        hanya melakukan tugasnya.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATISTIK -->
    <section id="metode" class="metode">
        <div class="container">

            <div class="metode-intro reveal">
                <div class="section-eyebrow">
                    <i class="bi bi-bar-chart-fill"></i>
                    Statistik Program
                </div>

                <h2 class="section-heading">
                    Statistik RASTRADA Kelurahan Kandangan Barat
                </h2>

                <p class="section-sub" style="font-size:15px">
                    Informasi umum mengenai data penduduk, penerima bantuan,
                    dan distribusi RASTRADA yang dapat diakses oleh masyarakat.
                </p>
            </div>

            <div class="row g-4">

                <div class="col-lg col-md-6">
                    <div class="feat-card text-center reveal">
                        <div class="feat-icon mx-auto">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="feat-title">
                            {{ number_format($totalPenduduk) }}
                        </div>
                        <div class="feat-text">
                            Total Penduduk
                        </div>
                    </div>
                </div>

                <div class="col-lg col-md-6">
                    <div class="feat-card text-center reveal">
                        <div class="feat-icon mx-auto">
                            <i class="bi bi-diagram-3-fill"></i>
                        </div>
                        <div class="feat-title">
                            {{ $totalRW }}
                        </div>
                        <div class="feat-text">
                            Total RW
                        </div>
                    </div>
                </div>

                <div class="col-lg col-md-6">
                    <div class="feat-card text-center reveal">
                        <div class="feat-icon mx-auto">
                            <i class="bi bi-house-door-fill"></i>
                        </div>
                        <div class="feat-title">
                            {{ $totalRT }}
                        </div>
                        <div class="feat-text">
                            Total RT
                        </div>
                    </div>
                </div>

                <div class="col-lg col-md-6">
                    <div class="feat-card text-center reveal">
                        <div class="feat-icon mx-auto">
                            <i class="bi bi-person-check-fill"></i>
                        </div>
                        <div class="feat-title">
                            {{ number_format($totalPenerima) }}
                        </div>
                        <div class="feat-text">
                            Penerima RASTRADA
                        </div>
                    </div>
                </div>

                <div class="col-lg col-md-6">
                    <div class="feat-card text-center reveal">
                        <div class="feat-icon mx-auto">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <div class="feat-title">
                            {{ number_format($totalDistribusi) }}
                        </div>
                        <div class="feat-text">
                            Distribusi Tersalurkan
                        </div>
                    </div>
                </div>

            </div>

            <!-- Statistik Penduduk per RW -->
            <div class="mt-5">

                <div class="text-center mb-4">
                    <h3 class="fw-bold">
                        Statistik Penduduk per RW
                    </h3>

                    <p class="text-muted">
                        Jumlah penduduk berdasarkan wilayah RW
                        di Kelurahan Kandangan Barat.
                    </p>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-4">

                    @foreach ($pendudukPerRW as $rw)
                        <div class="col">

                            <div class="feat-card text-center h-100">

                                <div class="feat-icon mx-auto">
                                    <i class="bi bi-diagram-3-fill"></i>
                                </div>

                                <div class="feat-title">
                                    RW {{ $rw->rw }}
                                </div>

                                <div class="feat-text">
                                    {{ $rw->total_penduduk }} Penduduk
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-brand">
                <i class="bi bi-speedometer2"></i> SPK RASTRADA
            </div>
            <p class="footer-text">Sistem Pendukung Keputusan dan Monitoring Penerima Bantuan RASTRADA</p>
            <p class="footer-text mt-1">Kelurahan Kandangan Barat | Kandangan, Hulu Sungai Selatan, Kalimantan Selatan
            </p>
            <div class="footer-divider">
                <p class="footer-meta">© 2026 SPK RASTRADA. Dikembangkan untuk transparansi dan keadilan dalam
                    distribusi bantuan sosial.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll
        const navBar = document.getElementById('navBar');
        window.addEventListener('scroll', () => {
            navBar.classList.toggle('scrolled', window.scrollY > 40);
        });

        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 100);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault();
                const t = document.querySelector(a.getAttribute('href'));
                if (t) {
                    t.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    document.querySelectorAll('.navbar-collapse.show').forEach(el => el.classList.remove(
                        'show'));
                }
            });
        });

        // Sinkronisasi indikator titik custom dengan carousel
        const carousel = document.getElementById('heroCarousel');
        const dots = [document.getElementById('dot0'), document.getElementById('dot1')];

        carousel.addEventListener('slid.bs.carousel', (e) => {
            dots.forEach((d, i) => {
                d.style.background = i === e.to ? 'var(--primary)' : 'var(--border)';
                d.style.transform = i === e.to ? 'scale(1.4)' : 'scale(1)';
            });
        });
    </script>
</body>

</html>
