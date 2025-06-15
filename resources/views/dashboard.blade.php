@extends('layouts.app')

@section('content')
    <div class="dashboard-header-container">
        <h3 class="dashboard-title">Dashboard</h3>
    </div>

    <div class="row mt-4 g-4"> {{-- g-4 untuk gap antar kolom --}}

        {{-- 1. Total Kategori --}}
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card dashboard-card">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper bg-custom-kategori"> {{-- Warna kustom untuk Kategori --}}
                        <i class="bi bi-tags"></i>
                    </div>
                    <div class="text-content ms-3">
                        <h5 class="card-title">Jumlah Kategori</h5>
                        <h2 class="card-value">{{ $categoriesCount }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Jenis Alat Lab --}}
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card dashboard-card">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper bg-custom-alat"> {{-- Warna kustom untuk Alat Lab --}}
                        <i class="bi bi-beaker-fill"></i>
                    </div>
                    <div class="text-content ms-3">
                        <h5 class="card-title">Jenis Alat Lab</h5>
                        <h2 class="card-value">{{ $alatLabCount }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Jenis Bahan Kimia --}}
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card dashboard-card">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper bg-custom-bahan"> {{-- Warna kustom untuk Bahan Kimia --}}
                        <i class="bi bi-droplet-fill"></i>
                    </div>
                    <div class="text-content ms-3">
                        <h5 class="card-title">Jenis Bahan Kimia</h5>
                        <h2 class="card-value">{{ $bahanKimiaCount }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. Total Stok Tersedia (Alat Lab + Bahan Kimia) --}}
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card dashboard-card">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper bg-custom-total-stock"> {{-- Warna kustom untuk Total Stock --}}
                        <i class="bi bi-boxes"></i> {{-- Icon kotak-kotak untuk total stok --}}
                    </div>
                    <div class="text-content ms-3">
                        <h5 class="card-title">Total Stok Tersedia</h5>
                        <h2 class="card-value">{{ $totalStock }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- 5. Total Stok Masuk (Bulan Ini) --}}
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card dashboard-card">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper bg-custom-stock-in-month"> {{-- Warna kustom untuk Stok Masuk Bulan Ini --}}
                        <i class="bi bi-arrow-up-right-circle"></i> {{-- Icon panah masuk --}}
                    </div>
                    <div class="text-content ms-3">
                        <h5 class="card-title">Stok Masuk ({{ now()->format('F') }})</h5>
                        <h2 class="card-value">{{ $totalStockInMonth }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- 6. Total Stok Keluar (Bulan Ini) --}}
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card dashboard-card">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper bg-custom-stock-out-month"> {{-- Warna kustom untuk Stok Keluar Bulan Ini --}}
                        <i class="bi bi-arrow-down-left-circle"></i> {{-- Icon panah keluar --}}
                    </div>
                    <div class="text-content ms-3">
                        <h5 class="card-title">Stok Keluar ({{ now()->format('F') }})</h5>
                        <h2 class="card-value">{{ $totalStockOutMonth }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Statistik Alat Lab per Kategori</h5>
                        <canvas id="alatChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>  
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Statistik Bahan Kimia per Kategori</h5>
                        <canvas id="bahanChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Proporsi Stok Masuk per Kategori ({{ now()->format('F') }})</h5>
                        <canvas id="stockInPieChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>       
        
        <script>
            const ctx = document.getElementById('alatChart').getContext('2d');
            const ctxAlat = document.getElementById('alatChart').getContext('2d');
            const alatChart = new Chart(ctxAlat, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($alatCategoryNames) !!},
                    datasets: [{
                        label: 'Jumlah Alat lab',
                        data: {!! json_encode($alatCategoryCounts) !!},
                        backgroundColor: [
                            'rgba(0, 191, 255, 0.6)',   // Deep Sky Blue
                            'rgba(138, 43, 226, 0.6)',  // Blue Violet
                            'rgba(255, 105, 180, 0.6)', // Hot Pink
                            'rgba(50, 205, 50, 0.6)'    // Lime Green
                        ],
                        borderColor: [
                            'rgba(0, 191, 255, 1)',
                            'rgba(138, 43, 226, 1)',
                            'rgba(255, 105, 180, 1)',
                            'rgba(50, 205, 50, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { color: 'white' },
                            grid: { color: 'rgba(255,255,255,0.1)' }
                        },
                        x: {
                            ticks: { color: 'white' },
                            grid: { color: 'rgba(255,255,255,0.05)' }
                        }
                    }
                }
            });

            const ctxBahan = document.getElementById('bahanChart').getContext('2d');
            const bahanChart = new Chart(ctxBahan, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($bahanCategoryNames) !!},
                    datasets: [{
                        label: 'Jumlah Bahan Kimia',
                        data: {!! json_encode($bahanCategoryCounts) !!},
                        backgroundColor: [
                            'rgba(0, 191, 255, 0.6)',   // Deep Sky Blue
                            'rgba(138, 43, 226, 0.6)',  // Blue Violet
                            'rgba(255, 105, 180, 0.6)', // Hot Pink
                            'rgba(50, 205, 50, 0.6)'    // Lime Green
                        ],
                        borderColor: [
                            'rgba(0, 191, 255, 1)',
                            'rgba(138, 43, 226, 1)',
                            'rgba(255, 105, 180, 1)',
                            'rgba(50, 205, 50, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { color: 'white' },
                            grid: { color: 'rgba(255,255,255,0.1)' }
                        },
                        x: {
                            ticks: { color: 'white' },
                            grid: { color: 'rgba(255,255,255,0.05)' }
                        }
                    }
                }
            });

            const stockInPieCtx = document.getElementById('stockInPieChart').getContext('2d');
            const stockInPieChart = new Chart(stockInPieCtx, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($stockInCategoryNames) !!},
                    datasets: [{
                        label: 'Jumlah Stok Masuk',
                        data: {!! json_encode($stockInCategoryTotals) !!},
                        backgroundColor: [
                            'rgba(0, 191, 255, 0.6)',   // Deep Sky Blue
                            'rgba(138, 43, 226, 0.6)',  // Blue Violet
                            'rgba(255, 105, 180, 0.6)', // Hot Pink
                            'rgba(50, 205, 50, 0.6)'    // Lime Green
                        ],
                        borderColor: [
                            'rgba(0, 191, 255, 1)',
                            'rgba(138, 43, 226, 1)',
                            'rgba(255, 105, 180, 1)',
                            'rgba(50, 205, 50, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: 'white'
                            }
                        }
                    }
                }
            });
        </script>

        {{-- Menghapus kartu Total Stok Keluar Keseluruhan --}}
        {{-- <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card dashboard-card">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-wrapper bg-custom-stock-out">
                        <i class="bi bi-calendar-minus"></i>
                    </div>
                    <div class="text-content ms-3">
                        <h5 class="card-title">Total Stok Keluar Keseluruhan</h5>
                        <h2 class="card-value">{{ $stockOutTotalCount }}</h2>
                    </div>
                </div>
            </div>
        </div> --}}
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
            /* Ukuran ikon lebih besar */
            width: 70px;
            /* Lebar wrapper ikon */
            height: 70px;
            /* Tinggi wrapper ikon */
            border-radius: 50%;
            /* Membuat lingkaran sempurna */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
            /* Mencegah ikon menyusut */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Bayangan pada ikon untuk efek menonjol */
            color: white;
            /* Pastikan ikon berwarna putih untuk kontras */
        }

        /* Warna latar belakang ikon yang disesuaikan dengan tema ungu/biru/pink */
        /* Warna untuk kartu baru */
        .bg-custom-total-stock {
            background-color: #f1eb47;
        }

        /* Blue Violet */
        .bg-custom-stock-in-month {
            background-color: #00BFFF;
        }

        /* Deep Sky Blue */
        .bg-custom-stock-out-month {
            background-color: #d81d3d;
            color: #333;
        }

        /* Pink, teks gelap untuk kontras */

        /* Warna untuk kartu lama (disesuaikan agar lebih harmonis) */
        .bg-custom-alat {
            background-color: #20c997;
        }

        /* Hijau terang (teal) */
        .bg-custom-bahan {
            background-color: #6f42c1;
        }

        /* Ungu */
        .bg-custom-kategori {
            background-color: #fd7e14;
            color: #333;
        }

        canvas#alatChart {
            background-color: transparent;
            color: #ffffff;
        }

        /* Kuning */

        /* Orange */
        .bg-custom-stock-out {
            background-color: #de1d30;
        }

        /* Merah */
        /* Anda bisa menyesuaikan warna ini agar lebih sesuai dengan palet ungu/biru */
        /* Misalnya:
                            .bg-custom-alat { background-color: rgba(0, 191, 255, 0.7); } // Deep Sky Blue transparan
                            .bg-custom-bahan { background-color: rgba(138, 43, 226, 0.7); } // Blue Violet transparan
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
