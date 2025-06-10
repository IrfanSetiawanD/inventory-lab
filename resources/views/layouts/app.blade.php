<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Inventory Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: sans-serif;
            background: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .sidebar .active {
            background-color: #495057;
        }
    </style>
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
                        <i class="bi bi-flask me-2"></i>Alat Lab
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('bahan.*') ? 'active' : '' }}"
                        href="{{ route('bahan.index') }}">
                        <i class="bi bi-droplet-half me-2"></i>Bahan Kimia
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
            </ul>

        </div>
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
</body>

</html>
