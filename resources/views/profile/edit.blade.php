@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<div class="container">
    <h1 class="mb-4 text-white">Profil Pengguna</h1>

    {{-- FOTO PROFIL --}}
    <div class="card mb-4 p-4">
        <div class="d-flex align-items-center gap-4">
            <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}" 
                 class="rounded-circle border border-2" width="100" height="100" alt="Foto Profil">
            <div>
                <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

    {{-- INFO DASAR --}}
    <div class="card mb-4 p-4">
        <h5>Informasi Tambahan</h5>
        <div class="mb-2"><strong>Bio:</strong> {{ Auth::user()->bio ?? '-' }}</div>
        <div class="mb-2"><strong>Tanggal Lahir:</strong> {{ Auth::user()->birth_date ?? '-' }}</div>
        <div class="mb-2"><strong>No. Telepon:</strong> {{ Auth::user()->phone ?? '-' }}</div>
    </div>

    {{-- TOMBOL AKSI --}}
    <div class="d-flex flex-wrap gap-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ubahDataModal">Ubah Data Diri</button>
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahPasswordModal">Ubah Password</button>
        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ubahEmailModal">Ubah Email</button>
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusAkunModal">Hapus Akun</button>
    </div>
</div>

{{-- MODAL UBAH DATA DIRI --}}
<div class="modal fade" id="ubahDataModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="modal-content">
            @csrf
            @method('patch')
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data Diri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label>Bio</label>
                    <textarea name="bio" class="form-control" rows="2">{{ Auth::user()->bio }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="birth_date" class="form-control" value="{{ Auth::user()->birth_date }}">
                </div>
                <div class="mb-3">
                    <label>No. Telepon</label>
                    <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                </div>
                <div class="mb-3">
                    <label>Ganti Foto Profil</label>
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL UBAH PASSWORD --}}
<div class="modal fade" id="ubahPasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('profile.update-password') }}" class="modal-content">
            @csrf
            @method('patch')
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Password Lama</label>
                    <input type="password" name="current_password" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Password Baru</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL UBAH EMAIL --}}
<div class="modal fade" id="ubahEmailModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('profile.update-email') }}" class="modal-content">
            @csrf
            @method('patch')
            <div class="modal-header">
                <h5 class="modal-title">Ubah Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Email Baru</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label>Password Akun</label>
                    <input type="password" name="password" class="form-control" placeholder="Konfirmasi password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary">Ubah Email</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL HAPUS AKUN --}}
<div class="modal fade" id="hapusAkunModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('profile.destroy') }}" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title text-danger">Konfirmasi Hapus Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger">Akun Anda akan dihapus permanen. Masukkan password untuk konfirmasi.</p>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Hapus Akun</button>
            </div>
        </form>
    </div>
</div>
@endsection
