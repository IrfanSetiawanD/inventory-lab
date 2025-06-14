<!-- resources/views/stock_in/create.blade.php -->

@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Tambah Stok Masuk</h3>
    </div>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card dashboard-card"> {{-- Menggunakan card untuk tampilan yang lebih rapi --}}
            <div class="card-body">
                <form method="POST" action="{{ route('stock-in.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="type" class="form-label">Jenis Barang</label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror"
                            onchange="toggleOptions(this.value)">
                            <option value="">Pilih Jenis</option>
                            <option value="alat" {{ old('type') == 'alat' ? 'selected' : '' }}>Alat Lab</option>
                            <option value="bahan" {{ old('type') == 'bahan' ? 'selected' : '' }}>Bahan Kimia</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3" id="alat-options" style="display: none;">
                        <label for="item_id_alat" class="form-label">Pilih Alat</label>
                        <select name="item_id_alat" id="item_id_alat"
                            class="form-select @error('item_id_alat') is-invalid @enderror">
                            <option value="">Pilih Alat</option>
                            @forelse($alat as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('item_id_alat') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option> {{-- Pastikan atribut name adalah 'name' bukan 'nama' --}}
                            @empty
                                <option value="" disabled>Tidak ada alat tersedia. Tambahkan alat terlebih dahulu.
                                </option>
                            @endforelse
                        </select>
                        @error('item_id_alat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3" id="bahan-options" style="display: none;">
                        <label for="item_id_bahan" class="form-label">Pilih Bahan</label>
                        <select name="item_id_bahan" id="item_id_bahan"
                            class="form-select @error('item_id_bahan') is-invalid @enderror">
                            <option value="">Pilih Bahan</option>
                            @forelse($bahan as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('item_id_bahan') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option> {{-- Pastikan atribut name adalah 'name' bukan 'nama' --}}
                            @empty
                                <option value="" disabled>Tidak ada bahan kimia tersedia. Tambahkan bahan kimia
                                    terlebih dahulu.</option>
                            @endforelse
                        </select>
                        @error('item_id_bahan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" name="quantity" id="quantity"
                            class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}">
                        @error('quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" name="date" id="date"
                            class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                        @error('date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('stock-in.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Panggil toggleOptions saat halaman dimuat jika ada nilai old('type')
            const initialType = document.getElementById('type').value;
            if (initialType) {
                toggleOptions(initialType);
            }
        });

        function toggleOptions(type) {
            const alatOptions = document.getElementById('alat-options');
            const bahanOptions = document.getElementById('bahan-options');
            const itemIdAlat = document.getElementById('item_id_alat');
            const itemIdBahan = document.getElementById('item_id_bahan');

            if (type === 'alat') {
                alatOptions.style.display = 'block';
                bahanOptions.style.display = 'none';
                itemIdAlat.setAttribute('name', 'item_id'); // Aktifkan name untuk alat
                itemIdBahan.removeAttribute('name'); // Nonaktifkan name untuk bahan
            } else if (type === 'bahan') {
                alatOptions.style.display = 'none';
                bahanOptions.style.display = 'block';
                itemIdAlat.removeAttribute('name'); // Nonaktifkan name untuk alat
                itemIdBahan.setAttribute('name', 'item_id'); // Aktifkan name untuk bahan
            } else {
                alatOptions.style.display = 'none';
                bahanOptions.style.display = 'none';
                itemIdAlat.removeAttribute('name');
                itemIdBahan.removeAttribute('name');
            }
        }
    </script>
@endsection
