<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Inventaris</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
            margin: 1cm;
            color: #333;
            /* Warna teks umum untuk PDF agar lebih jelas */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #1e3a8a;
            /* Warna judul yang konsisten */
            font-size: 18pt;
            /* Ukuran judul */
        }

        .section-title {
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 10px;
            /* Sedikit spasi di bawah judul bagian */
            font-size: 12pt;
            color: #1e3a8a;
            /* Warna judul bagian yang konsisten */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            /* Gaya tabel umum */
            /* border-radius: 8px; /* Dihapus untuk mencegah garis hilang di sudut */
            /* overflow: hidden; /* Dihapus karena terkait dengan border-radius */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            /* Mungkin tidak dirender, tetapi tidak menyebabkan garis hilang */
            table-layout: fixed;
            /* Penting: Membuat lebar kolom fixed */
        }

        th,
        td {
            border: 1px solid #547792;
            /* Border seperti tampilan web */
            padding: 8px;
            /* Padding sedikit lebih besar */
            vertical-align: middle;
            /* Selalu tengah secara vertikal */
            font-size: 10pt;
            text-align: center;
            /* Semua sel data dan header rata tengah */
        }

        thead {
            background-color: #1e3a8a;
            /* Warna header gelap seperti web */
            color: #fff;
            font-weight: 600;
        }

        /* Gaya untuk baris selang-seling */
        tbody tr:nth-child(odd) {
            background-color: #f9fafb;
            /* Warna striping tabel */
        }

        /* Gaya untuk gambar (jika ada di laporan PDF) */
        td img {
            max-width: 70px;
            border-radius: 6px;
        }

        /* Jika ada baris kosong */
        td[colspan][align="center"] {
            font-style: italic;
            color: #6c757d;
        }

        /* Lebar Kolom Spesifik untuk Laporan Alat Lab & Bahan Kimia */
        /* (No, Nama, Kategori, Jumlah, Satuan) */
        .table-alat-bahan th:nth-child(1),
        .table-alat-bahan td:nth-child(1) {
            width: 8%;
        }

        /* No */
        .table-alat-bahan th:nth-child(2),
        .table-alat-bahan td:nth-child(2) {
            width: 35%;
        }

        /* Nama */
        .table-alat-bahan th:nth-child(3),
        .table-alat-bahan td:nth-child(3) {
            width: 20%;
        }

        /* Kategori */
        .table-alat-bahan th:nth-child(4),
        .table-alat-bahan td:nth-child(4) {
            width: 12%;
        }

        /* Jumlah */
        .table-alat-bahan th:nth-child(5),
        .table-alat-bahan td:nth-child(5) {
            width: 25%;
        }

        /* Satuan */

        /* Lebar Kolom Spesifik untuk Laporan Stok Masuk & Keluar */
        /* (No, Nama, Jenis, Jumlah, Tanggal) */
        .table-stock th:nth-child(1),
        .table-stock td:nth-child(1) {
            width: 8%;
        }

        /* No */
        .table-stock th:nth-child(2),
        .table-stock td:nth-child(2) {
            width: 35%;
        }

        /* Nama */
        .table-stock th:nth-child(3),
        .table-stock td:nth-child(3) {
            width: 20%;
        }

        /* Jenis */
        .table-stock th:nth-child(4),
        .table-stock td:nth-child(4) {
            width: 12%;
        }

        /* Jumlah */
        .table-stock th:nth-child(5),
        .table-stock td:nth-child(5) {
            width: 25%;
        }

        /* Tanggal */
    </style>
</head>

<body>

    <h2>Laporan Inventaris</h2>

    {{-- Alat Lab --}}
    <div class="section-title">1. Laporan Alat Lab</div>
    <table class="table-alat-bahan"> {{-- Menambahkan kelas untuk lebar kolom --}}
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
    <table class="table-alat-bahan"> {{-- Menambahkan kelas untuk lebar kolom --}}
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
    <table class="table-stock"> {{-- Menambahkan kelas untuk lebar kolom --}}
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
    <table class="table-stock"> {{-- Menambahkan kelas untuk lebar kolom --}}
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
