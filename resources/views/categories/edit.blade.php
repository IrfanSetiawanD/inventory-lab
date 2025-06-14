@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Edit Kategori</h3>
    </div>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card dashboard-card">
            <div class="card-body">
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

                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Jenis</label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Alat" {{ old('type', $category->type) == 'Alat' ? 'selected' : '' }}>Alat
                            </option>
                            <option value="Bahan Kimia"
                                {{ old('type', $category->type) == 'Bahan Kimia' ? 'selected' : '' }}>
                                Bahan Kimia</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Optional: Deskripsi kategori --}}
                    {{-- <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi (Opsional)</label>
                        <textarea name="description" id="description" rows="3"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="mb-3">
                        <label for="hazard_level" class="form-label">Tingkat Bahaya (Opsional, untuk Bahan Kimia)</label>
                        <input type="text" name="hazard_level" id="hazard_level"
                            class="form-control @error('hazard_level') is-invalid @enderror"
                            value="{{ old('hazard_level', $category->hazard_level) }}">
                        @error('hazard_level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
