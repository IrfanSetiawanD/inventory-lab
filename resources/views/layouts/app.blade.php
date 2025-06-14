<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Inventory Lab</title>
    <!-- Fonts - Menggunakan Font Google 'Inter' -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* Menerapkan font Inter */
            background: linear-gradient(to bottom right, #5D3FD3 0%, #00BFFF 100%);
            /* Background gradient konsisten */
            color: #ffffff;
            /* Warna teks default putih untuk seluruh aplikasi */
            margin: 0;
            padding: 0;
            /* Pastikan tidak ada padding/margin default browser */
            min-height: 100vh;
            /* Pastikan background mengisi seluruh tinggi viewport */
            overflow-x: hidden;
            /* Mencegah scroll horizontal */
        }

        .sidebar {
            min-height: 100vh;
            background-color: #3040e6;
            /* Warna sidebar lebih gelap dari gradien */
            color: white;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.3);
            /* Bayangan sidebar */
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.8);
            /* Warna link lebih terang */
            text-decoration: none;
            padding: 12px 15px;
            /* Padding untuk area klik lebih besar */
            transition: background-color 0.3s ease, color 0.3s ease;
            border-radius: 8px;
            /* Sudut membulat pada link */
            margin-bottom: 5px;
            /* Spasi antar item menu */
            display: flex;
            /* Mengatur ikon dan teks */
            align-items: center;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            /* Latar belakang hover transparan */
            color: #ffffff;
            /* Warna teks full putih saat hover */
        }

        .sidebar .active {
            background-color: #00BFFF;
            /* Warna aktif Deep Sky Blue */
            color: #182faf;
            /* Teks gelap untuk kontras */
            font-weight: 700;
            /* Tebal untuk item aktif */
            box-shadow: 0 2px 10px rgba(0, 191, 255, 0.4);
            /* Bayangan untuk item aktif */
        }

        .sidebar .active i {
            color: #182faf;
            /* Pastikan ikon juga gelap */
        }

        .sidebar h4 {
            color: #FFC0CB;
            /* Warna pink untuk judul sidebar */
            font-weight: 800;
            margin-bottom: 20px;
        }

        .content-area {
            flex-grow: 1;
            padding: 25px;
            /* Padding lebih besar untuk area konten */
        }

        /* Penyesuaian untuk elemen Bootstrap agar sesuai tema gelap */
        .card {
            background-color: rgba(255, 255, 255, 0.1);
            /* Latar belakang card semi-transparan */
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            color: #ffffff;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .card-header,
        .card-footer {
            background-color: rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .table {
            color: #ffffff;
            /* Warna teks tabel */
            border-color: rgba(255, 255, 255, 0.3);
            /* Warna border tabel */
        }

        .table th,
        .table td {
            border-color: rgba(255, 255, 255, 0.3);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.05);
            /* Warna striping tabel */
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.15);
            /* Warna hover tabel */
        }

        .table-dark {
            /* Memastikan header tabel tetap gelap atau disesuaikan */
            background-color: rgba(0, 0, 0, 0.3) !important;
            color: #ffffff;
        }

        /* Button styles for actions */
        .btn-primary {
            background-color: #00BFFF;
            /* Deep Sky Blue */
            border-color: #00BFFF;
            color: #2D0B42;
            /* Teks gelap */
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #00A3D9;
            border-color: #00A3D9;
        }

        .btn-warning {
            background-color: #FFC0CB;
            /* Pink */
            border-color: #FFC0CB;
            color: #2D0B42;
            /* Teks gelap */
            font-weight: 600;
        }

        .btn-warning:hover {
            background-color: #FFABC6;
            border-color: #FFABC6;
        }

        .btn-danger {
            background-color: #dc3545;
            /* Red */
            border-color: #dc3545;
            color: white;
            font-weight: 600;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="d-flex">
        <div class="sidebar p-3" style="width: 250px;">
            <h4 class="text-center">Inventory Lab</h4>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                        href="{{ route('categories.index') }}">
                        <i class="bi bi-box me-2"></i>Kategori
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('alat.*') ? 'active' : '' }}"
                        href="{{ route('alat.index') }}">
                        <i class="bi bi-tools me-2"></i>Alat Lab {{-- Mengganti ikon flask --}}
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('bahan.*') ? 'active' : '' }}"
                        href="{{ route('bahan.index') }}">
                        <i class="bi bi-droplet-fill me-2"></i>Bahan Kimia {{-- Mengganti ikon droplet-half --}}
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('stock-in.*') ? 'active' : '' }}"
                        href="{{ route('stock-in.index') }}">
                        <i class="bi bi-truck me-2"></i>Stok Masuk
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('stock-out.*') ? 'active' : '' }}"
                        href="{{ route('stock-out.index') }}">
                        <i class="bi bi-box-arrow-right me-2"></i>Stok Keluar
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('laporan') ? 'active' : '' }}"
                        href="{{ route('laporan') }}">
                        <i class="bi bi-file-earmark-pdf me-2"></i>Laporan
                    </a>
                </li>
                <li class="nav-item mt-auto"> {{-- Tambahkan mt-auto untuk push ke bawah --}}
                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" class="d-grid mt-4">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>

        </div>
        <div class="flex-grow-1 p-4 content-area"> {{-- Menambahkan kelas content-area --}}
            @yield('content')
        </div>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigF/00aJ/l2P/PNJ2L" crossorigin="anonymous">
    </script>
</body>

</html>
