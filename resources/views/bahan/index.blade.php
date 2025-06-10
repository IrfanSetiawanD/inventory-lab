@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-4">Daftar Bahan Kimia</h4>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('bahan.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle me-1"></i> Tambah Bahan
        </a>

        <div class="table-responsive"> {{-- Menambahkan div untuk responsivitas tabel --}}
            <table class="table table-bordered table-striped align-middle"> {{-- Menambahkan align-middle untuk konten sel --}}
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Jumlah</th> {{-- MENAMBAHKAN KOLOM JUMLAH --}}
                        <th>Satuan</th> {{-- MENAMBAHKAN KOLOM SATUAN --}}
                        <th>Tingkat Bahaya</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Menggunakan $bahans karena itu yang dikirim dari controller --}}
                    @forelse ($bahans as $itemBahan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $itemBahan->name }}</td>
                            <td>{{ $itemBahan->category->name ?? '-' }}</td>
                            <td>{{ $itemBahan->quantity ?? '0' }}</td> {{-- MENAMPILKAN DATA JUMLAH --}}
                            <td>{{ $itemBahan->unit ?? '-' }}</td> {{-- MENAMPILKAN DATA SATUAN --}}
                            <td>{{ $itemBahan->danger_level ?? '-' }}</td>
                            <td>{{ $itemBahan->description ?? '-' }}</td>
                            <td>
                                @if ($itemBahan->image)
                                    <img src="{{ asset('storage/' . $itemBahan->image) }}" alt="Gambar" width="80">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('bahan.edit', $itemBahan->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('bahan.destroy', $itemBahan->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus bahan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            {{-- MENGUBAH COLSPAN DARI 7 MENJADI 9 (karena ada penambahan 2 kolom: Jumlah dan Satuan) --}}
                            <td colspan="9" class="text-center text-muted">Belum ada data bahan kimia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> {{-- Penutup div table-responsive --}}
    </div>
@endsection
