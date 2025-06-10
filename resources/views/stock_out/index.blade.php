
@extends('layouts.app')

@section('content')
    <h3>Daftar Stok Keluar</h3>
    <a href="{{ route('stock-out.create') }}" class="btn btn-primary mb-3">Tambah Stok Keluar</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $index => $stock)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $stock->item_name }}</td>
                    <td>{{ ucfirst($stock->type) }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ $stock->date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
