@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Tambah Bahan Kimia</h3>
    </div>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card dashboard-card">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Oops!</strong> Ada kesalahan pada inputan:
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($categories->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        Peringatan: Belum ada kategori untuk Bahan Kimia. Silakan
                        <a href="{{ route('categories.create') }}" class="alert-link">buat kategori baru di sini</a> sebelum
                        menambahkan bahan.
                    </div>
                @else
                    <form action="{{ route('bahan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Bahan Kimia</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select name="category_id" id="category_id"
                                class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Jumlah</label>
                            <input type="number" name="quantity" id="quantity"
                                class="form-control @error('quantity') is-invalid @enderror"
                                value="{{ old('quantity', 0) }}" min="0" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="unit" class="form-label">Satuan</label>
                            <input type="text" name="unit" id="unit"
                                class="form-control @error('unit') is-invalid @enderror" value="{{ old('unit') }}"
                                placeholder="Contoh: buah, set, pcs" required>
                            @error('unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="danger_level" class="form-label">Tingkat Bahaya</label>
                            <select name="danger_level" id="danger_level"
                                class="form-select @error('danger_level') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Tingkat Bahaya --</option>
                                @foreach ($dangerLevels as $level)
                                    <option value="{{ $level }}"
                                        {{ old('danger_level') == $level ? 'selected' : '' }}>
                                        {{ $level }}
                                    </option>
                                @endforeach
                            </select>
                            @error('danger_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" rows="3"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Gambar (Opsional)</label>
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Bahan Kimia</button>
                        <a href="{{ route('bahan.index') }}" class="btn btn-secondary ms-2">Batal</a>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
