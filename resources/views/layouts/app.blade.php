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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
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
            position: fixed;
            top: 0;
            left: 0;
            min-height: 100vh;
            background-color: #2236ed;
            /* Warna sidebar kembali ke ungu gelap */
            color: white;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.3);
            /* Bayangan sidebar */
            padding: 0;
            /* Hapus padding langsung dari .sidebar untuk mengontrolnya lebih granular di dalam */
            box-sizing: border-box;
            /* Penting untuk konsistensi lebar */
            flex-shrink: 0;
            /* Sangat penting: Mencegah sidebar menyusut */
            flex-grow: 0;
            /* Mencegah sidebar memanjang */
            width: 250px;
            /* Lebar 250px tetap diatur di atribut style HTML */
        }

        .sidebar h4 {
            color: #ffffff;
            /* Warna judul sidebar */
            font-weight: 800;
            padding-top: 2rem;
            /* Meningkatkan padding atas untuk menengahkan secara vertikal */
            padding-bottom: 1rem;
            /* Padding bawah */
            padding-left: 1rem;
            /* Padding kiri */
            padding-right: 1rem;
            /* Padding kanan */
            text-align: center;
            /* Pastikan judul tetap di tengah horizontal */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
            /* Efek bayangan teks untuk daya tarik */
        }

        .sidebar hr {
            margin: 0 1rem 20px 1rem;
            /* Margin horizontal agar hr sejajar dengan padding konten */
            border-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar ul {
            /* Target the ul (nav flex-column) untuk padding horizontal utama */
            padding: 0 1rem;
            /* Berikan padding horizontal ke seluruh daftar menu */
            list-style: none;
            /* Hapus bullet default */
            margin: 0;
            /* Hapus margin default ul */
        }

        .sidebar .nav-item {
            width: 100%;
            /* Pastikan item navigasi mengisi lebar penuh dalam ul */
            margin-bottom: 5px;
            /* Spasi antar item menu */
            box-sizing: border-box;
            /* Penting untuk konsistensi lebar padding/border */
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            /* Warna link lebih terang */
            text-decoration: none;
            padding: 12px 15px;
            /* Padding internal untuk konten link */
            transition: background-color 0.3s ease, color 0.3s ease;
            border-radius: 8px;
            /* Sudut membulat pada link */
            display: flex;
            /* Mengatur ikon dan teks */
            align-items: center;
            width: 100%;
            /* Pastikan elemen A mengambil lebar penuh dari .nav-item */
            flex-shrink: 0;
            /* Mencegah item link menyusut */
            white-space: nowrap;
            /* Mencegah teks wrapping */
            box-sizing: border-box;
            /* Pastikan padding dihitung dalam total lebar elemen */
            overflow: hidden;
            /* Sembunyikan konten yang melampaui batas */
            text-overflow: ellipsis;
            /* Tambahkan elipsis (...) untuk teks yang terpotong */
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            /* Latar belakang hover transparan */
            color: #ffffff;
            /* Warna teks full putih saat hover */
        }

        .sidebar .nav-link.active {
            background-color: #00BFFF;
            /* Warna aktif Deep Sky Blue */
            color: #2D0B42;
            /* Teks gelap untuk kontras */
            font-weight: 700;
            /* Tebal untuk item aktif */
            box-shadow: 0 2px 10px rgba(0, 191, 255, 0.4);
            /* Bayangan untuk item aktif */
        }

        .sidebar .nav-link.active i {
            color: #2D0B42;
            /* Pastikan ikon juga gelap saat aktif */
        }

        .content-area {
            margin-left: 250px;
            flex-grow: 1;
            padding: 25px;
            /* Padding lebih besar untuk area konten */
        }

        /* Kelas untuk judul halaman yang konsisten (Dashboard, Kategori, dll.) */
        .page-header-container {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            /* Garis bawah yang halus */
        }

        .page-title {
            font-size: 2.5rem;
            /* Ukuran judul */
            font-weight: 700;
            color: #ffffff;
            /* Warna putih */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            /* Sedikit bayangan teks */
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
        <div class="sidebar" style="width: 250px;">
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
                        <i class="bi bi-tags me-2"></i>Kategori
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('alat.*') ? 'active' : '' }}"
                        href="{{ route('alat.index') }}">
                        <i class="bi bi-beaker-fill me-2"></i>Alat Lab
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('bahan.*') ? 'active' : '' }}"
                        href="{{ route('bahan.index') }}">
                        <i class="bi bi-droplet-fill me-2"></i>Bahan Kimia
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('stock-in.*') ? 'active' : '' }}"
                        href="{{ route('stock-in.index') }}">
                        <i class="bi bi-arrow-up-right-circle me-2"></i>Stok Masuk
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('stock-out.*') ? 'active' : '' }}"
                        href="{{ route('stock-out.index') }}">
                        <i class="bi bi-arrow-down-left-circle me-2"></i>Stok Keluar
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('laporan') ? 'active' : '' }}"
                        href="{{ route('laporan') }}">
                        <i class="bi bi-file-earmark-pdf me-2"></i>Laporan
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
                        href="{{ route('profile.edit') }}">
                        <i class="bi bi-person-circle me-2"></i>Profile
                    </a>
                </li>
                <li class="nav-item mt-auto">
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
        <div class="flex-grow-1 p-4 content-area">
            {{-- Ini adalah tempat untuk menyisipkan header halaman dinamis --}}
            @yield('page_header')

            @yield('content')
        </div>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        xintegrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigF/00aJ/l2P/PNJ2L" crossorigin="anonymous">
    </script>
</body>

</html>
