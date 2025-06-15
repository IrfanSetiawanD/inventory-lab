@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Daftar Stok Keluar</h3>
    </div>
@endsection

@section('content')
    <div class="container mt-4">
        <a href="{{ route('stock-out.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle me-1"></i> Tambah Stok Keluar
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stocks as $index => $stock)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $stock->item_name ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $itemTypeFromDb = $stock->itemable_type ?? '';
                                    $itemTypeClean = trim(preg_replace('/[[:cntrl:]]/', '', $itemTypeFromDb));
                                @endphp
                                @if ($itemTypeClean === 'App\Models\AlatLab')
                                    Alat Lab
                                @elseif ($itemTypeClean === 'App\Models\BahanKimia')
                                    Bahan Kimia
                                @else
                                    N/A (
                                    @if ($itemTypeClean === '')
                                        EMPTY STRING
                                    @else
                                        {{ $itemTypeClean }} | HEX: {{ bin2hex($itemTypeClean) }}
                                    @endif
                                    )
                                @endif
                            </td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ $stock->date }}</td>
                            <td>
                                <form action="{{ route('stock-out.destroy', $stock->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus stok keluar ini? Aksi ini juga akan menambah kuantitas item di inventaris utama.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data stok keluar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $stocks->links() }}
        </div>
    </div>
@endsection
