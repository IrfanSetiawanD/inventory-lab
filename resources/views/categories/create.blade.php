@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Tambah Kategori</h3>
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

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Jenis</label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror"
                            required>
                            <option value="" disabled {{ !old('type') ? 'selected' : '' }}>-- Pilih Jenis --</option>
                            <option value="Alat" {{ old('type') == 'Alat' ? 'selected' : '' }}>Alat</option>
                            <option value="Bahan Kimia" {{ old('type') == 'Bahan Kimia' ? 'selected' : '' }}>Bahan Kimia
                            </option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Optional: kolom description jika dibutuhkan --}}
                    {{-- <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi (Opsional)</label>
                        <textarea name="description" id="description" rows="3"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> --}}

                    <div class="mb-3">
                        <label for="hazard_level" class="form-label">Tingkat Bahaya (Opsional, untuk Bahan Kimia)</label>
                        <input type="text" name="hazard_level" id="hazard_level"
                            class="form-control @error('hazard_level') is-invalid @enderror"
                            value="{{ old('hazard_level') }}">
                        @error('hazard_level')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
