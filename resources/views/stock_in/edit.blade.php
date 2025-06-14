@extends('layouts.app')

@section('content')
<h3>Edit Stok Masuk</h3>

<form method="POST" action="{{ route('stock-in.update', $stock->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="type">Jenis Barang</label>
        <select name="type" id="type" class="form-control" onchange="toggleOptions(this.value)">
            <option value="alat" {{ $stock->itemable_type === 'App\\Models\\AlatLab' ? 'selected' : '' }}>Alat Lab</option>
            <option value="bahan" {{ $stock->itemable_type === 'App\\Models\\BahanKimia' ? 'selected' : '' }}>Bahan Kimia</option>
        </select>
    </div>

    <div class="mb-3" id="alat-options" style="{{ $stock->itemable_type === 'App\\Models\\AlatLab' ? '' : 'display: none;' }}">
        <label for="item_id">Pilih Alat</label>
        <select name="item_id" class="form-control">
            @foreach($alat as $item)
                <option value="{{ $item->id }}" {{ $stock->itemable_type === 'App\\Models\\AlatLab' && $item->id == $stock->itemable_id ? 'selected' : '' }}>
                    {{ $item->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3" id="bahan-options" style="{{ $stock->itemable_type === 'App\\Models\\BahanKimia' ? '' : 'display: none;' }}">
        <label for="item_id">Pilih Bahan</label>
        <select name="item_id" class="form-control">
            @foreach($bahan as $item)
                <option value="{{ $item->id }}" {{ $stock->itemable_type === 'App\\Models\\BahanKimia' && $item->id == $stock->itemable_id ? 'selected' : '' }}>
                    {{ $item->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="quantity">Jumlah</label>
        <input type="number" name="quantity" class="form-control" value="{{ $stock->quantity }}">
    </div>

    <div class="mb-3">
        <label for="date">Tanggal</label>
        <input type="date" name="date" class="form-control" value="{{ $stock->date }}">
    </div>

    <button type="submit" class="btn btn-success">Update</button>
</form>

<script>
    function toggleOptions(type) {
        document.getElementById('alat-options').style.display = type === 'alat' ? 'block' : 'none';
        document.getElementById('bahan-options').style.display = type === 'bahan' ? 'block' : 'none';
    }

    // Jalankan saat halaman pertama kali dibuka
    document.addEventListener('DOMContentLoaded', function() {
        toggleOptions(document.getElementById('type').value);
    });
</script>
@endsection
