
@extends('layouts.app')

@section('content')
    <h3>Daftar Stok Masuk</h3>
    <a href="{{ route('stock-in.create') }}" class="btn btn-primary mb-3">Tambah Stok Masuk</a>
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
            <td>{{ $stock->itemable->nama ?? '-' }}</td>
            <td>{{ class_basename($stock->itemable_type) }}</td>
            <td>{{ $stock->quantity }}</td>
            <td>{{ $stock->date }}</td>
            <td>
                <a href="{{ route('stock-in.edit', $stock->id) }}" class="btn btn-sm btn-warning">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
