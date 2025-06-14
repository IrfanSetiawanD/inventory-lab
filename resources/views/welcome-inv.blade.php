<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di Inventory Lab</title>

    <!-- Fonts - Menggunakan Font Google 'Inter' -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS - CDN Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        xintegrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Bootstrap Icons CSS - CDN Bootstrap Icons (untuk tombol Login/Register jika diperlukan) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* Warna background disesuaikan agar lebih menyatu dengan gambar ilustrasi yang biru cerah */
            background: linear-gradient(to bottom right, #5D3FD3 0%, #00BFFF 100%);
            /* Ungu ke Deep Sky Blue */
            min-height: 100vh;
            margin: 0;
            color: #ffffff;
            /* Teks default putih */
            overflow-x: hidden;
            /* Mencegah scroll horizontal */
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.2);
            /* Navbar semi-transparan */
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: #ffffff !important;
            /* Warna logo */
            letter-spacing: -0.5px;
        }

        .navbar-brand span {
            color: #FFC0CB;
            /* Warna pink untuk 'Lab' atau bagian logo lain */
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 600;
            margin-left: 1.5rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #ffffff !important;
        }

        .hero-section {
            display: flex;
            align-items: center;
            min-height: calc(100vh - 80px);
            /* Kurangi tinggi navbar */
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .hero-title {
            font-size: 4.5rem;
            /* Judul besar */
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 25px;
            animation: slideInLeft 1s ease-out;
            /* Animasi masuk dari kiri */
        }

        .hero-description {
            font-size: 1.25rem;
            line-height: 1.7;
            margin-bottom: 40px;
            color: rgba(255, 255, 255, 0.8);
            animation: slideInLeft 1.2s ease-out;
        }

        .hero-btn {
            padding: 15px 35px;
            font-size: 1.15rem;
            border-radius: 50px;
            /* Tombol pill-shaped */
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1.5s ease-out;
        }

        .btn-primary-custom {
            background-color: #FFC0CB;
            /* Pink */
            border-color: #FFC0CB;
            color: #2D0B42;
            /* Teks gelap di tombol terang */
        }

        .btn-primary-custom:hover {
            background-color: #FFABC6;
            /* Pink lebih gelap */
            border-color: #FFABC6;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-secondary-custom {
            background-color: transparent;
            border: 2px solid #00F2FE;
            /* Border cyan */
            color: #00F2FE;
            /* Teks cyan */
        }

        .btn-secondary-custom:hover {
            background-color: rgba(0, 242, 254, 0.1);
            /* Latar belakang semi-transparan cyan */
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .illustration-img {
            max-width: 100%;
            height: auto;
            animation: fadeInRight 1.5s ease-out;
            /* Animasi masuk dari kanan */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {

            /* Medium ke bawah */
            .hero-title {
                font-size: 3.5rem;
            }

            .hero-description {
                font-size: 1.1rem;
            }

            .hero-section .col-lg-6 {
                text-align: center !important;
                /* Pusatkan konten di mobile */
            }

            .hero-buttons {
                justify-content: center !important;
                /* Pusatkan tombol di mobile */
            }
        }

        @media (max-width: 768px) {

            /* Small ke bawah */
            .hero-title {
                font-size: 2.8rem;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }

            .nav-link {
                margin-left: 0;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top"> {{-- fixed-top agar navbar selalu di atas --}}
        <div class="container">
            <a class="navbar-brand" href="#">Inventory <span>Lab</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> {{-- ms-auto untuk rata kanan --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Home</a> {{-- Mengarahkan Home ke Dashboard --}}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a> {{-- Menambahkan link ke halaman About --}}
                    </li>
                    {{-- Menghapus menu Features, Implementation, Contact, dan Sign In dari navbar --}}
                    {{-- Tombol Login dan Register sudah ada di hero section --}}
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-lg-start text-center mb-4 mb-lg-0">
                    <h1 class="hero-title">Inventory <br> Lab</h1> {{-- Mengganti judul --}}
                    <p class="hero-description">
                        Sistem manajemen inventaris laboratorium yang efisien untuk melacak dan mengelola
                        semua alat dan bahan kimia Anda. Optimalkan persediaan, pantau penggunaan, dan
                        pastikan ketersediaan untuk setiap eksperimen.
                    </p> {{-- Mengganti deskripsi --}}
                    <div class="hero-buttons d-flex justify-content-center justify-content-lg-start">
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn hero-btn btn-primary-custom me-3">Login</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn hero-btn btn-secondary-custom">Register</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    {{-- Mengganti placeholder dengan gambar welcome.png dari folder public/images --}}
                    <img src="{{ asset('images/welcome.png') }}" alt="Inventory Illustration"
                        class="img-fluid illustration-img">
                </div>
            </div>
        </div>
    </header>

    <!-- Bootstrap Bundle with Popper - CDN Bootstrap 5.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        xintegrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigF/00aJ/l2P/PNJ2L" crossorigin="anonymous">
    </script>
</body>

</html>
