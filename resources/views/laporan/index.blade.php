@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Laporan Inventaris</h3>
    </div>
@endsection

@section('content')
    <div class="container mt-4" style="max-width: 95%;">
        <div class="d-flex justify-content-end mb-4 print-hide">
            <button class="btn btn-info" onclick="window.print()">
                <i class="bi bi-printer me-2"></i> Cetak Laporan
            </button>
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
                                    <td>{{ Str::limit($alat->name, 50, '...') }}</td>
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
                                    <td>{{ Str::limit($bahan->name, 50, '...') }}</td>
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
                                    <td>{{ Str::limit($stock->item_name ?? 'N/A', 50, '...') }}</td>
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
                                    <td>{{ Str::limit($stock->item_name ?? 'N/A', 50, '...') }}</td>
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

    {{-- Gaya CSS Tambahan --}}
    <style>
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
            text-align: right;
        }

        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 24%;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        @media print {

            .print-hide,
            .page-header-container,
            .sidebar,
            .btn,
            .alert {
                display: none !important;
            }

            body {
                -webkit-print-color-adjust: exact;
                background: none !important;
                color: #000 !important;
            }

            .card,
            .card-header,
            .card-body,
            .table {
                box-sizing: border-box !important;
                color: #000 !important;
                background: #fff !important;
                page-break-inside: avoid;
            }

            .table th,
            .table td {
                border: 1px solid #000 !important;
                padding: 5px;
            }

            .table-dark th {
                background-color: #e0e0e0 !important;
                color: #000 !important;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: #f9f9f9 !important;
            }
        }
    </style>
@endsection
