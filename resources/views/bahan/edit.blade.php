@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-4">Edit Bahan Kimia</h4>

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

        <form action="{{ route('bahan.update', $bahan->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-4 rounded shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Bahan Kimia</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $bahan->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror"
                    required>
                    <option value="" disabled>-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $bahan->category_id) == $category->id ? 'selected' : '' }}>
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
                    value="{{ old('quantity', $bahan->quantity) }}" min="0" required>
                @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="unit" class="form-label">Satuan</label>
                <input type="text" name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror"
                    value="{{ old('unit', $bahan->unit) }}" required>
                @error('unit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- START: Perubahan untuk Danger Level menjadi Dropdown --}}
            <div class="mb-3">
                <label for="danger_level" class="form-label">Tingkat Bahaya</label>
                <select name="danger_level" id="danger_level"
                    class="form-select @error('danger_level') is-invalid @enderror" required>
                    <option value="" disabled>-- Pilih Tingkat Bahaya --</option>
                    @foreach ($dangerLevels as $level)
                        <option value="{{ $level }}"
                            {{ old('danger_level', $bahan->danger_level) == $level ? 'selected' : '' }}>
                            {{ $level }}
                        </option>
                    @endforeach
                </select>
                @error('danger_level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- END: Perubahan untuk Danger Level menjadi Dropdown --}}

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi (Opsional)</label>
                <textarea name="description" id="description" rows="3"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $bahan->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar (Opsional)</label>
                <input type="file" name="image" id="image"
                    class="form-control @error('image') is-invalid @enderror" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if ($bahan->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $bahan->image) }}" alt="Gambar Sekarang" style="max-width: 100px;">
                        <small class="form-text text-muted">Gambar saat ini</small>
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Bahan Kimia</button>
            <a href="{{ route('bahan.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
@endsection
