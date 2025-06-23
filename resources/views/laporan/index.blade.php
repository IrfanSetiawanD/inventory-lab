@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Laporan Inventaris</h3>
    </div>
@endsection

@section('content')
    <div class="container mt-4" style="max-width: 95%;">
        <div class="d-flex justify-content-end mb-4 print-hide">
            {{-- Tombol ini sekarang akan mengarahkan ke route yang menghasilkan PDF --}}
            <a href="{{ route('laporan.exportPdf') }}" class="btn btn-info" target="_blank">
                <i class="bi bi-printer me-2"></i> Cetak Laporan PDF
            </a>
        </div>

        {{-- Section: Laporan Alat Lab --}}
        <div class="card dashboard-card mb-5">
            <div class="card-header">
                <h4 class="card-title mb-0">1. Laporan Alat Lab</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alatLabs as $alat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Str::limit($alat->name, 50, '...') }}</td> {{-- Menyesuaikan limit --}}
                                    <td>{{ $alat->category->name ?? '-' }}</td>
                                    <td>{{ $alat->quantity }}</td>
                                    <td>{{ $alat->unit }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada data alat lab.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Section: Laporan Bahan Kimia --}}
        <div class="card dashboard-card mb-5">
            <div class="card-header">
                <h4 class="card-title mb-0">2. Laporan Bahan Kimia</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bahanKimias as $bahan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Str::limit($bahan->name, 50, '...') }}</td> {{-- Menyesuaikan limit --}}
                                    <td>{{ $bahan->category->name ?? '-' }}</td>
                                    <td>{{ $bahan->quantity }}</td>
                                    <td>{{ $bahan->unit }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada data bahan kimia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Section: Laporan Stok Masuk --}}
        <div class="card dashboard-card mb-5">
            <div class="card-header">
                <h4 class="card-title mb-0">3. Laporan Stok Masuk</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stockIns as $stock)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Str::limit($stock->item_name ?? 'N/A', 50, '...') }}</td> {{-- Menyesuaikan limit --}}
                                    <td>
                                        @php $itemType = trim($stock->itemable_type ?? ''); @endphp
                                        @if ($itemType === 'App\Models\AlatLab')
                                            Alat Lab
                                        @elseif ($itemType === 'App\Models\BahanKimia')
                                            Bahan Kimia
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>{{ $stock->date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada data stok masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Section: Laporan Stok Keluar --}}
        <div class="card dashboard-card mb-5">
            <div class="card-header">
                <h4 class="card-title mb-0">4. Laporan Stok Keluar</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stockOuts as $stock)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Str::limit($stock->item_name ?? 'N/A', 50, '...') }}</td> {{-- Menyesuaikan limit --}}
                                    <td>
                                        @php $itemType = trim($stock->itemable_type ?? ''); @endphp
                                        @if ($itemType === 'App\Models\AlatLab')
                                            Alat Lab
                                        @elseif ($itemType === 'App\Models\BahanKimia')
                                            Bahan Kimia
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>{{ $stock->date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada data stok keluar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <style>
        .table-bordered td,
        .table-bordered th {
            border: 1px solid #547792 !important;
        }

        thead.table-dark th {
            background-color: #1e3a8a !important;
            color: #fff;
            font-weight: 600;
            text-align: center;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9fafb;
        }

        .table tbody tr:hover {
            background-color: #e0f7ff;
            transition: background-color 0.2s ease-in-out;
        }

        td {
            vertical-align: middle !important;
            text-align: center;
            font-size: 14px;
        }

        .btn-sm {
            padding: 6px 10px;
            border-radius: 6px;
        }

        .table {
            border-collapse: collapse;
            border-radius: 12px;
            /* Diterapkan pada keseluruhan tabel */
            overflow: hidden;
            /* Penting untuk border-radius pada tabel responsif */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        /* Gaya kolom spesifik yang sudah ada di laporan-index, tetap dipertahankan */
        .table {
            table-layout: fixed;
            width: 100%;
            word-wrap: break-word;
        }

        .table th:nth-child(1),
        .table td:nth-child(1) {
            width: 6%;
            text-align: center;
        }

        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 35%;
        }

        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 20%;
        }

        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 15%;
        }

        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 24%;
        }
    </style>
@endsection
