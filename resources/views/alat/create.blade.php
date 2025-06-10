@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-4">Tambah Alat Laboratorium</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('alat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Alat</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                @if ($categories->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Peringatan: Belum ada kategori untuk Alat Lab. Silakan <a href="{{ route('categories.create') }}"
                            class="alert-link">buat kategori baru di sini</a> sebelum menambahkan alat.
                    </div>
                    <select class="form-select" id="category_id" name="category_id" disabled>
                        <option value="">-- Belum ada Kategori --</option>
                    </select>
                @else
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                        name="category_id" required>
                        <option value="" selected disabled>-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                @endif
            </div>

            {{-- START: Tambahkan field quantity --}}
            <div class="mb-3">
                <label for="quantity" class="form-label">Jumlah</label>
                <input type="number" name="quantity" id="quantity"
                    class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', 0) }}" required
                    min="0"> {{-- Default 0, minimal 0 --}}
                @error('quantity')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- END: Tambahkan field quantity --}}

            {{-- START: Tambahkan field unit (jika belum ada) --}}
            <div class="mb-3">
                <label for="unit" class="form-label">Satuan</label>
                <input type="text" name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror"
                    value="{{ old('unit') }}" placeholder="Contoh: buah, set, pcs" required>
                @error('unit')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- END: Tambahkan field unit --}}


            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Gambar</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                    accept="image/*">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('alat.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
