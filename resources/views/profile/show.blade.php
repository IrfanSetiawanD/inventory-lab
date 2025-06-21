@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Profil Pengguna</h3>
    </div>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Alert untuk status update profil --}}
                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Profil berhasil diperbarui!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card dashboard-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informasi Profil Anda</h5>
                    </div>
                    <div class="card-body">
                        {{-- FOTO PROFIL --}}
                        <div class="mb-4 text-center">
                            <img src="{{ $user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                 class="rounded-circle shadow" width="120" height="120" alt="Foto Profil">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama:</label>
                            <p class="form-control-plaintext">{{ $user->name }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email:</label>
                            <p class="form-control-plaintext">{{ $user->email }}</p>
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <p class="text-muted small">Alamat email Anda belum diverifikasi.</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Bio:</label>
                            <p class="form-control-plaintext">{{ $user->bio ?? 'Belum diisi' }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Lokasi:</label>
                            <p class="form-control-plaintext">{{ $user->location ?? 'Belum diisi' }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Lahir:</label>
                            <p class="form-control-plaintext">
                                {{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->translatedFormat('d F Y') : 'Belum diatur' }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">No. Telepon:</label>
                            <p class="form-control-plaintext">{{ $user->no_telp ?? 'Belum diisi' }}</p>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('profile.settings') }}" class="btn btn-primary">
                                <i class="bi bi-gear-fill me-2"></i> Pengaturan Akun
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
