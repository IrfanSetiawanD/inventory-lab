@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Daftar Stok Masuk</h3>
    </div>
@endsection

@section('content')
    <div class="container mt-4">
        <a href="{{ route('stock-in.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle me-1"></i> Tambah Stok Masuk
        </a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Aksi</th> {{-- Menambahkan kolom Aksi untuk konsistensi --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stocks as $index => $stock)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $stock->item_name }}</td>
                            <td>{{ ucfirst($stock->type) }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ $stock->date }}</td>
                            <td>
                                {{-- Tambahkan tombol aksi di sini jika diperlukan, contoh: edit/delete --}}
                                {{-- <a href="{{ route('stock-in.edit', $stock->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('stock-in.destroy', $stock->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus stok masuk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form> --}}
                                <span class="text-muted">No actions</span> {{-- Placeholder jika tidak ada aksi --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data stok masuk.</td>
                            {{-- Perbarui colspan --}}
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Jika Anda memiliki pagination untuk $stocks, tambahkan di sini --}}
        {{-- <div class="mt-3">
            {{ $stocks->links() }}
        </div> --}}
    </div>
@endsection
