@extends('layouts.app')

@section('content')
    <div class="dashboard-header-container">
        <h3 class="dashboard-title">Dashboard</h3>
    </div>

    <div class="row mt-4 g-4"> {{-- g-4 untuk gap antar kolom --}}
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card dashboard-card">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper bg-primary-dark">
                        <i class="bi bi-box-seam"></i> {{-- Icon untuk Alat Lab --}}
                    </div>
                    <div class="text-content ms-3">
                        <h5 class="card-title">Total Alat Lab</h5>
                        <h2 class="card-value">{{ $alatLabCount }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card dashboard-card">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper bg-info-dark">
                        <i class="bi bi-flask"></i> {{-- Icon untuk Bahan Kimia --}}
                    </div>
                    <div class="text-content ms-3">
                        <h5 class="card-title">Total Bahan Kimia</h5>
                        <h2 class="card-value">{{ $bahanKimiaCount }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card dashboard-card">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper bg-success-dark">
                        <i class="bi bi-tags"></i> {{-- Icon untuk Kategori --}}
                    </div>
                    <div class="text-content ms-3">
                        <h5 class="card-title">Total Kategori</h5>
                        <h2 class="card-value">{{ $categories }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card dashboard-card">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper bg-danger-dark">
                        <i class="bi bi-arrow-down-right-circle"></i> {{-- Icon untuk Stock Keluar --}}
                    </div>
                    <div class="text-content ms-3">
                        <h5 class="card-title">Total Stok Keluar</h5>
                        <h2 class="card-value">{{ $stockOutCount }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card dashboard-card">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper bg-warning-dark">
                        <i class="bi bi-calendar-check"></i> {{-- Icon untuk Stock Keluar Bulan Ini --}}
                    </div>
                    <div class="text-content ms-3">
                        <h5 class="card-title">Stok Keluar ({{ now()->format('F') }})</h5>
                        <h2 class="card-value">{{ $stockOutMonth }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Styles for Dashboard Cards */
        .dashboard-header-container {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            /* Garis bawah yang halus */
        }

        .dashboard-title {
            font-size: 2.5rem;
            /* Ukuran judul */
            font-weight: 700;
            color: #ffffff;
            /* Warna putih */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            /* Sedikit bayangan teks */
        }

        .dashboard-card {
            background-color: rgba(255, 255, 255, 0.1);
            /* Latar belakang semi-transparan */
            border: 1px solid rgba(255, 255, 255, 0.2);
            /* Border putih transparan */
            border-radius: 15px;
            /* Sudut membulat */
            color: #ffffff;
            /* Warna teks putih */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            /* Bayangan yang lebih menonjol */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* Transisi halus */
            height: 100%;
            /* Pastikan card memiliki tinggi yang sama di baris yang sama */
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            /* Efek mengangkat saat hover */
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
            /* Bayangan lebih besar saat hover */
        }

        .dashboard-card .card-body {
            padding: 25px;
        }

        .dashboard-card .card-title {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 5px;
            color: rgba(255, 255, 255, 0.8);
            /* Warna teks judul card */
        }

        .dashboard-card .card-value {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
            color: #ffffff;
            /* Warna teks nilai card */
        }

        .icon-wrapper {
            font-size: 2.5rem;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
            /* Mencegah ikon menyusut */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Bayangan pada ikon */
        }

        /* Warna latar belakang ikon yang disesuaikan dengan tema */
        .bg-primary-dark {
            background-color: #007bff;
        }

        /* Biru */
        .bg-info-dark {
            background-color: #17a2b8;
        }

        /* Teal */
        .bg-success-dark {
            background-color: #28a745;
        }

        /* Hijau */
        .bg-danger-dark {
            background-color: #dc3545;
        }

        /* Merah */
        .bg-warning-dark {
            background-color: #ffc107;
        }

        /* Kuning */
        /* Anda bisa menyesuaikan warna ini agar lebih sesuai dengan palet ungu/biru */
        /* Misalnya:
            .bg-primary-dark { background-color: rgba(0, 191, 255, 0.7); } // Deep Sky Blue transparan
            .bg-info-dark    { background-color: rgba(138, 43, 226, 0.7); } // Blue Violet transparan
            */

        /* Responsive Adjustments */
        @media (max-width: 767.98px) {
            .dashboard-title {
                font-size: 2rem;
                text-align: center;
            }

            .dashboard-card .card-body {
                flex-direction: column;
                /* Tata letak kolom pada layar kecil */
                text-align: center;
            }

            .dashboard-card .icon-wrapper {
                margin-bottom: 15px;
                /* Spasi bawah ikon */
            }

            .dashboard-card .text-content {
                margin-left: 0 !important;
                /* Hapus margin kiri */
            }
        }
    </style>
@endsection
