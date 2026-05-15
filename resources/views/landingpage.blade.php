<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK RASTRADA - Sistem Pendukung Keputusan</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.12);
        }

        .navbar-brand {
            font-size: 22px;
            font-weight: 800;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            font-weight: 500;
            color: #64748b !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: #4f46e5 !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-main {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white !important;
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }

        .btn-main:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
            background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
        }

        .btn-secondary-main {
            background: white;
            color: #4f46e5;
            border: 2px solid #4f46e5;
            border-radius: 12px;
            padding: 12px 28px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary-main:hover {
            background: #4f46e5;
            color: white;
        }

        /* ===== HERO SECTION ===== */
        .hero {
            padding: 160px 0 120px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 56px;
            font-weight: 800;
            background: linear-gradient(135deg, #1e3a8a 0%, #4f46e5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
            margin-bottom: 24px;
            animation: fadeInUp 0.8s ease;
        }

        .hero-text {
            font-size: 18px;
            color: #64748b;
            margin-bottom: 32px;
            line-height: 1.8;
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            margin-bottom: 40px;
            animation: fadeInUp 0.8s ease 0.4s both;
            flex-wrap: wrap;
        }

        .hero-image {
            position: relative;
            animation: float 3s ease-in-out infinite;
            filter: drop-shadow(0 10px 30px rgba(0, 0, 0, 0.1));
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* ===== TENTANG SECTION ===== */
        .about-section {
            padding: 100px 0;
        }

        .section-title {
            font-size: 42px;
            font-weight: 800;
            color: #1e3a8a;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
            border-radius: 2px;
        }

        .about-text {
            font-size: 17px;
            color: #64748b;
            line-height: 1.9;
            margin-bottom: 30px;
        }

        .highlight-box {
            background: linear-gradient(135deg, #eef2ff 0%, #f3e8ff 100%);
            border-left: 4px solid #4f46e5;
            padding: 24px;
            border-radius: 12px;
            margin-top: 30px;
        }

        /* ===== FITUR SECTION ===== */
        .features-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
        }

        .feature-card {
            background: white;
            border: none;
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(79, 70, 229, 0.15);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .icon-box {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            background: linear-gradient(135deg, #eef2ff 0%, #f3e8ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #4f46e5;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .feature-card:hover .icon-box {
            transform: scale(1.1) rotate(5deg);
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
        }

        .feature-title {
            font-size: 22px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 12px;
        }

        .feature-text {
            color: #64748b;
            font-size: 16px;
            line-height: 1.6;
        }

        /* ===== METODE SECTION ===== */
        .metode-section {
            padding: 100px 0;
            background: white;
        }

        .stats-box {
            background: white;
            border-radius: 16px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .stats-box::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .stats-box:hover {
            transform: translateY(-5px);
            border-color: #4f46e5;
            box-shadow: 0 8px 30px rgba(79, 70, 229, 0.15);
        }

        .stats-box:hover::before {
            top: -20%;
            right: -20%;
        }

        .stats-number {
            font-size: 48px;
            font-weight: 800;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

        .stats-text {
            color: #64748b;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 0;
            position: relative;
            z-index: 1;
        }

        .stats-description {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 8px;
            position: relative;
            z-index: 1;
        }

        /* ===== FOOTER ===== */
        footer {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: white;
            padding: 50px 0 20px;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        }

        .footer-content {
            margin-bottom: 30px;
        }

        .footer-title {
            font-size: 24px;
            font-weight: 800;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 12px;
        }

        .footer-text {
            color: #cbd5e1;
            margin-bottom: 0;
        }

        .footer-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            margin-top: 30px;
        }

        .footer-meta {
            color: #94a3b8;
            font-size: 14px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .hero {
                padding: 120px 0 80px;
            }

            .hero-title {
                font-size: 36px;
            }

            .hero-text {
                font-size: 16px;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .btn-main,
            .btn-secondary-main {
                width: 100%;
                text-align: center;
            }

            .section-title {
                font-size: 32px;
            }

            .feature-card {
                padding: 30px 20px;
            }

            .stats-box {
                padding: 30px 20px;
            }

            .stats-number {
                font-size: 36px;
            }
        }

        /* ===== SMOOTH SCROLL ===== */
        html {
            scroll-behavior: smooth;
        }

        /* ===== UTILITY CLASSES ===== */
        .text-muted {
            color: #64748b;
        }

        .glow-effect {
            position: relative;
        }

        .glow-effect::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, transparent 100%);
            border-radius: inherit;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .glow-effect:hover::after {
            opacity: 1;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top py-3" id="navBar">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <i class="bi bi-speedometer2"></i> SPK RASTRADA
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#metode">Metode</a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a href="/login" class="btn btn-main">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Masuk Sistem
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero" id="home">

        <div class="container">

            <div class="row align-items-center">

                <!-- KONTEN -->
                <div class="col-lg-6 hero-content pe-lg-5">

                    <h1 class="hero-title">
                        Sistem Pendukung Keputusan Penerima RASTRADA
                    </h1>

                    <p class="hero-text">
                        Sistem berbasis metode TOPSIS untuk membantu proses penentuan dan monitoring penerima bantuan
                        RASTRADA secara objektif, efektif, dan transparan di Kelurahan Kandangan Barat.
                    </p>

                    <div class="hero-buttons">

                        <a href="/login" class="btn btn-main btn-lg">

                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Masuk Sistem

                        </a>

                        <a href="#tentang" class="btn btn-secondary-main btn-lg">

                            <i class="bi bi-info-circle me-2"></i>
                            Pelajari Lebih Lanjut

                        </a>

                    </div>

                </div>

                <!-- GAMBAR -->
                <div class="col-lg-6 text-center mt-5 mt-lg-0">

                    <div class="hero-image">

                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d4/Kantor_Kelurahan_Kandangan_Barat%2C_Hulu_Sungai_Selatan.JPG?utm_source=id.wikipedia.org&utm_campaign=index&utm_content=original"
                            alt="Komunitas Kelurahan Kandangan Barat" class="img-fluid rounded-4"
                            style="max-width: 100%; height: auto; box-shadow: 0 20px 50px rgba(0,0,0,0.15);">

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- TENTANG SECTION -->
    <section id="tentang" class="about-section">
        <div class="container">
            <div class="mb-5">
                <h2 class="section-title">Tentang Sistem</h2>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <p class="about-text">
                        <strong>SPK RASTRADA</strong> merupakan sistem pendukung keputusan yang dirancang khusus untuk
                        membantu
                        <strong>Kelurahan Kandangan Barat</strong> dalam menentukan penerima bantuan beras daerah
                        (RASTRADA) secara objektif dan transparan.
                    </p>
                    <p class="about-text">
                        Sistem ini menggunakan <strong>metode TOPSIS (Technique for Order of Preference by Similarity to
                            Ideal Solution)</strong>
                        sebagai fondasi dalam analisis keputusan. Dengan berbagai kriteria sosial ekonomi masyarakat
                        yang telah ditentukan,
                        sistem ini mampu memberikan rekomendasi penerima bantuan yang lebih akurat dan adil.
                    </p>
                    <div class="highlight-box">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-check-circle-fill text-primary me-2"></i>
                            Keunggulan Sistem
                        </h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check text-primary me-2"></i>Proses objektif berdasarkan
                                data terukur</li>
                            <li class="mb-2"><i class="bi bi-check text-primary me-2"></i>Transparansi dalam
                                pengambilan keputusan</li>
                            <li class="mb-2"><i class="bi bi-check text-primary me-2"></i>Monitoring berkelanjutan
                                setiap periode</li>
                            <li class="mb-2"><i class="bi bi-check text-primary me-2"></i>Laporan terstruktur dan
                                mudah dipahami</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FITUR SECTION -->
    <section id="fitur" class="features-section">
        <div class="container">
            <div class="mb-5">
                <h2 class="section-title">Fitur Sistem</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card glow-effect">
                        <div class="icon-box">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5 class="feature-title">Data Penduduk</h5>
                        <p class="feature-text">
                            Mengelola data lengkap masyarakat penerima bantuan dengan informasi demografi dan sosial
                            ekonomi yang terstruktur.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card feature-card glow-effect">
                        <div class="icon-box">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h5 class="feature-title">Perhitungan TOPSIS</h5>
                        <p class="feature-text">
                            Menghasilkan ranking prioritas penerima bantuan menggunakan algoritma TOPSIS yang telah
                            terbukti efektif.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card feature-card glow-effect">
                        <div class="icon-box">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                        <h5 class="feature-title">Monitoring Bantuan</h5>
                        <p class="feature-text">
                            Monitoring penerima bantuan setiap periode untuk memastikan distribusi yang adil dan tepat
                            sasaran.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- METODE SECTION -->
    <section id="metode" class="metode-section">
        <div class="container">
            <div class="mb-5">
                <h2 class="section-title">Metode TOPSIS</h2>
            </div>

            <p class="text-center text-muted mb-5"
                style="max-width: 600px; margin-left: auto; margin-right: auto; font-size: 16px;">
                TOPSIS (Technique for Order of Preference by Similarity to Ideal Solution) adalah metode pengambilan
                keputusan multi-kriteria yang mengukur jarak alternatif dari solusi ideal positif dan negatif.
            </p>

            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stats-box">
                        <div class="stats-number">1</div>
                        <div class="stats-text">Normalisasi Matriks</div>
                        <div class="stats-description">Mengubah data mentah ke skala baku</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-box">
                        <div class="stats-number">2</div>
                        <div class="stats-text">Pembobotan</div>
                        <div class="stats-description">Memberikan bobot pada setiap kriteria</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-box">
                        <div class="stats-number">3</div>
                        <div class="stats-text">Solusi Ideal</div>
                        <div class="stats-description">Menentukan ideal positif dan negatif</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-box">
                        <div class="stats-number">4</div>
                        <div class="stats-text">Perangkingan</div>
                        <div class="stats-description">Mengurutkan berdasarkan skor akhir</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <h5 class="footer-title">
                    <i class="bi bi-speedometer2"></i> SPK RASTRADA
                </h5>
                <p class="footer-text">
                    Sistem Pendukung Keputusan dan Monitoring Penerima Bantuan RASTRADA
                </p>
                <p class="footer-text" style="font-size: 14px; color: #94a3b8; margin-top: 8px;">
                    Kelurahan Kandangan Barat | Banjarmasin, Kalimantan Selatan
                </p>
            </div>
            <div class="footer-divider">
                <p class="footer-meta">
                    © 2024 SPK RASTRADA. Dikembangkan untuk transparansi dan keadilan dalam distribusi bantuan sosial.
                </p>
            </div>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Navbar scroll effect
        const navBar = document.getElementById('navBar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navBar.classList.add('scrolled');
            } else {
                navBar.classList.remove('scrolled');
            }
        });

        // Smooth scroll untuk links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    document.querySelectorAll('.navbar-collapse.show').forEach(el => {
                        el.classList.remove('show');
                    });
                }
            });
        });
    </script>

</body>

</html>
