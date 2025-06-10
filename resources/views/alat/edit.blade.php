@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-4">Edit Alat Laboratorium</h4>

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

        <form action="{{ route('alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Alat</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $alat->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $alat->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control">{{ old('description', $alat->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini</label><br>
                @if ($alat->image)
                    <img src="{{ asset('storage/' . $alat->image) }}" alt="Gambar Alat" class="img-thumbnail mb-2"
                        width="150">
                @else
                    <p class="text-muted">Tidak ada gambar</p>
                @endif
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ganti Gambar</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('alat.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
