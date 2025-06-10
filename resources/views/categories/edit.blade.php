@extends('layouts.app')

@section('content')
    <div class="container mt-4"> {{-- Mengganti max-w-xl mx-auto py-6 sm:px-6 lg:px-8 --}}
        <h4 class="mb-4">Edit Kategori</h4> {{-- Menggunakan h4 --}}

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
            {{-- Menggunakan id untuk route --}}
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                    class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Jenis</label>
                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                    <option value="Alat" {{ old('type', $category->type) == 'Alat' ? 'selected' : '' }}>Alat</option>
                    <option value="Bahan Kimia" {{ old('type', $category->type) == 'Bahan Kimia' ? 'selected' : '' }}>Bahan
                        Kimia</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Jika Anda memiliki kolom 'description' di tabel category, tambahkan di sini --}}
            {{-- <div class="mb-3">
            <label for="description" class="form-label">Deskripsi (Opsional)</label>
            <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div> --}}

            <div class="mb-3">
                <label for="hazard_level" class="form-label">Tingkat Bahaya (Opsional, untuk Bahan Kimia)</label>
                <input type="text" name="hazard_level" id="hazard_level"
                    value="{{ old('hazard_level', $category->hazard_level) }}"
                    class="form-control @error('hazard_level') is-invalid @enderror">
                @error('hazard_level')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
@endsection
