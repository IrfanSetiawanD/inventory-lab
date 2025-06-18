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

    {{-- CSS Cetak --}}
    <style>
        @media print {
            @page {
                size: A4 portrait;
                margin: 0.5cm;
            }

            html,
            body {
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                min-height: 100vh;
                overflow: hidden;
                font-size: 10pt;
                -webkit-print-color-adjust: exact;
                background: none !important;
            }

            .container {
                width: 100% !important;
                padding: 0.5cm !important;
                margin: 0 auto !important;
                box-sizing: border-box;
            }

            .print-hide,
            .page-header-container,
            .sidebar,
            .btn,
            .alert {
                display: none !important;
            }

            .card {
                border: 1px solid #ccc;
                box-shadow: none;
                page-break-inside: avoid;
                margin-bottom: 20px;
                background-color: #fff;
                color: #000;
                border-radius: 0;
            }

            .card-header,
            .card-title {
                background-color: #e9ecef !important;
                color: #000;
                border-bottom: 1px solid #ccc;
                padding: 10px 15px;
                font-size: 1.2em;
                text-align: left;
            }

            .card-body {
                padding: 15px;
            }

            .table-responsive {
                overflow: visible;
                margin-bottom: 0;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
                border: 1px solid #000;
                table-layout: fixed;
            }

            .table th,
            .table td {
                border: 1px solid #000;
                padding: 5px;
                vertical-align: top;
                word-wrap: break-word;
                white-space: normal;
                color: #000;
            }

            .table thead th:nth-child(1),
            .table tbody td:nth-child(1) {
                width: 5%;
                text-align: center;
            }

            .table thead th:nth-child(2),
            .table tbody td:nth-child(2) {
                width: 38%;
                text-align: left;
            }

            .table thead th:nth-child(3),
            .table tbody td:nth-child(3) {
                width: 17%;
                text-align: left;
            }

            .table thead th:nth-child(4),
            .table tbody td:nth-child(4) {
                width: 10%;
                text-align: right;
            }

            .table thead th:nth-child(5),
            .table tbody td:nth-child(5) {
                width: 30%;
                text-align: left;
            }

            .table-dark th {
                background-color: #dee2e6 !important;
                color: #000;
                border-bottom: 1px solid #000;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: #f8f9fa;
            }

            .table-striped tbody tr:nth-of-type(even) {
                background-color: #fff;
            }
        }
    </style>
@endsection
