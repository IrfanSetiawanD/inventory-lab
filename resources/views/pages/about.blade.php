<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - Inventory Lab</title>

    <!-- Fonts - Menggunakan Font Google 'Inter' -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS - CDN Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        xintegrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom right, #5D3FD3 0%, #00BFFF 100%);
            min-height: 100vh;
            margin: 0;
            color: #ffffff;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            /* Untuk menempatkan footer di bawah jika ada */
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.2);
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: #ffffff !important;
            letter-spacing: -0.5px;
        }

        .navbar-brand span {
            color: #FFC0CB;
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

        .about-section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            /* Agar konten mengisi sisa ruang vertikal */
            padding: 50px 15px;
            text-align: center;
        }

        .about-card {
            background-color: rgba(255, 255, 255, 0.98);
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
            padding: 40px;
            max-width: 800px;
            width: 100%;
            color: #333;
            /* Teks gelap di card terang */
            animation: fadeIn 1.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .about-title {
            font-size: 2.8rem;
            font-weight: 700;
            color: #007bff;
            margin-bottom: 25px;
        }

        .about-text {
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .developer-info {
            font-size: 1rem;
            font-weight: 600;
            color: #5a6268;
            margin-top: 30px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            padding-top: 20px;
        }

        .developer-info span {
            color: #007bff;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .about-title {
                font-size: 2rem;
            }

            .about-text {
                font-size: 1rem;
            }

            .about-card {
                padding: 25px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Inventory <span>Lab</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('about') }}">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="about-section">
        <div class="about-card fadeIn">
            <h1 class="about-title">Tentang Inventory Lab</h1>
            <p class="about-text">
                Inventory Lab adalah sistem manajemen inventaris yang memudahkan pengelolaan alat dan bahan kimia di
                laboratorium. Aplikasi ini membantu melacak stok, mencatat barang masuk dan keluar, serta membuat
                laporan inventaris.
            </p>
            <p class="about-text">
                Dengan Inventory Lab, persediaan lebih terkontrol, pemborosan bisa dikurangi, dan semua kebutuhan riset
                atau eksperimen selalu tersedia. Sistem ini dirancang dengan tampilan yang mudah digunakan dan fitur
                lengkap untuk mendukung kerja laboratorium secara efisien.
            </p>
            <div class="developer-info">
                Dikembangkan oleh: <span>Irfan Setiawan Dawolo, Muhammad Endrico, Muhammad Iqbal, Daniel Lenggono
                    Mulyadi</span>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        xintegrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigF/00aJ/l2P/PNJ2L" crossorigin="anonymous">
    </script>
</body>

</html>
