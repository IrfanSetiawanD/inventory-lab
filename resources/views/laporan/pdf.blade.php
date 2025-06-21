<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Inventaris</title>
    <style>
        /* Gaya dasar saja untuk pengujian */
        body {
            font-family: sans-serif;
            font-size: 10pt;
            margin: 1cm;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 25px;
            font-size: 12pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        thead {
            background-color: #eee;
        }
    </style>
</head>

<body>

    <h2>Laporan Inventaris</h2>

    {{-- Alat Lab --}}
    <div class="section-title">1. Laporan Alat Lab</div>
    <table>
        <thead>
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
                    <td>{{ \Illuminate\Support\Str::limit($alat->name, 50, '...') }}</td>
                    <td>{{ $alat->category->name ?? '-' }}</td>
                    <td>{{ $alat->quantity }}</td>
                    <td>{{ $alat->unit }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" align="center">Tidak ada data alat lab.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Bahan Kimia --}}
    <div class="section-title">2. Laporan Bahan Kimia</div>
    <table>
        <thead>
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
                    <td>{{ \Illuminate\Support\Str::limit($bahan->name, 50, '...') }}</td>
                    <td>{{ $bahan->category->name ?? '-' }}</td>
                    <td>{{ $bahan->quantity }}</td>
                    <td>{{ $bahan->unit }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" align="center">Tidak ada data bahan kimia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Stok Masuk --}}
    <div class="section-title">3. Laporan Stok Masuk</div>
    <table>
        <thead>
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
                    <td>{{ \Illuminate\Support\Str::limit($stock->item_name ?? 'N/A', 50, '...') }}</td>
                    <td>
                        @php
                            $itemType = trim($stock->itemable_type ?? '');
                        @endphp
                        @if ($itemType === 'App\\Models\\AlatLab')
                            Alat Lab
                        @elseif ($itemType === 'App\\Models\\BahanKimia')
                            Bahan Kimia
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ $stock->date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" align="center">Tidak ada data stok masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Stok Keluar --}}
    <div class="section-title">4. Laporan Stok Keluar</div>
    <table>
        <thead>
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
                    <td>{{ \Illuminate\Support\Str::limit($stock->item_name ?? 'N/A', 50, '...') }}</td>
                    <td>
                        @php
                            $itemType = trim($stock->itemable_type ?? '');
                        @endphp
                        @if ($itemType === 'App\\Models\\AlatLab')
                            Alat Lab
                        @elseif ($itemType === 'App\\Models\\BahanKimia')
                            Bahan Kimia
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ $stock->date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" align="center">Tidak ada data stok keluar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
