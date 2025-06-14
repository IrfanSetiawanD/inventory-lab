<!-- resources/views/stock_in/create.blade.php -->

@extends('layouts.app')

@section('content')
<h3>Tambah Stok Masuk</h3>

<form method="POST" action="{{ route('stock-in.store') }}">
    @csrf

    <div class="mb-3">
        <label for="type">Jenis Barang</label>
        <select name="type" id="type" class="form-control" onchange="toggleOptions(this.value)">
            <option value="">Pilih Jenis</option>
            <option value="alat">Alat Lab</option>
            <option value="bahan">Bahan Kimia</option>
        </select>
    </div>

    <div class="mb-3" id="alat-options" style="display: none;">
        <label for="item_id">Pilih Alat</label>
        <select name="item_id" class="form-control">
            @foreach($alat as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3" id="bahan-options" style="display: none;">
        <label for="item_id">Pilih Bahan</label>
        <select name="item_id" class="form-control">
            @foreach($bahan as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="quantity">Jumlah</label>
        <input type="number" name="quantity" class="form-control">
    </div>

    <div class="mb-3">
        <label for="date">Tanggal</label>
        <input type="date" name="date" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
</form>

<script>
    function toggleOptions(type) {
        document.getElementById('alat-options').style.display = type === 'alat' ? 'block' : 'none';
        document.getElementById('bahan-options').style.display = type === 'bahan' ? 'block' : 'none';
    }
</script>
@endsection
