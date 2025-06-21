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
                @if (session('status') === 'password-updated')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Kata Sandi berhasil diperbarui!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('status') === 'two-factor-authentication-disabled')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Autentikasi Dua Faktor berhasil dinonaktifkan!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('status') === 'two-factor-authentication-enabled')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Autentikasi Dua Faktor berhasil diaktifkan!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('status') === 'recovery-codes-generated')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Kode Pemulihan berhasil dibuat!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <div class="card dashboard-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informasi Profil</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Perbarui informasi profil dan alamat email akun Anda.</p>
                        <form method="post" action="{{ route('profile.update') }}" class="mt-4">
                            @csrf
                            @method('patch')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input id="name" name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                    <p class="mt-2 text-sm text-gray-800">
                                        Alamat email Anda belum diverifikasi.
                                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                                            Klik di sini untuk mengirim ulang email verifikasi.
                                        </button>
                                    </p>
                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 text-success">
                                            Tautan verifikasi baru telah dikirim ke alamat email Anda.
                                        </p>
                                    @endif
                                @endif
                            </div>

                            {{-- Input untuk Tanggal Lahir --}}
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input id="tanggal_lahir" name="tanggal_lahir" type="date"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    value="{{ old('tanggal_lahir', $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('Y-m-d') : '') }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Input untuk Bio --}}
<div class="mb-3">
    <label for="bio" class="form-label">Bio</label>
    <textarea id="bio" name="bio"
        class="form-control @error('bio') is-invalid @enderror"
        rows="3">{{ old('bio', $user->bio) }}</textarea>
    @error('bio')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Input untuk Lokasi --}}
<div class="mb-3">
    <label for="location" class="form-label">Lokasi</label>
    <input id="location" name="location" type="text"
        class="form-control @error('location') is-invalid @enderror"
        value="{{ old('location', $user->location) }}">
    @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Input untuk No. Telepon --}}
<div class="mb-3">
    <label for="no_telp" class="form-label">No. Telepon</label>
    <input id="no_telp" name="no_telp" type="text"
        class="form-control @error('no_telp') is-invalid @enderror"
        value="{{ old('no_telp', $user->no_telp) }}">
    @error('no_telp')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>



                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Bagian untuk memperbarui kata sandi --}}
                <div class="card dashboard-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Perbarui Kata Sandi</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap
                            aman.</p>
                        <form method="post" action="{{ route('password.update') }}" class="mt-4">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                                <input id="current_password" name="current_password" type="password"
                                    class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                    autocomplete="current-password">
                                @error('current_password', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Sandi Baru</label>
                                <input id="password" name="password" type="password"
                                    class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                    autocomplete="new-password">
                                @error('password', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                    autocomplete="new-password">
                                @error('password_confirmation', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Bagian untuk menghapus akun --}}
                <div class="card dashboard-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Hapus Akun</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus
                            secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang
                            ingin Anda simpan.</p>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmUserDeletionModal">
                            Hapus Akun
                        </button>

                        <!-- Modal Konfirmasi Hapus Akun -->
                        <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1"
                            aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmUserDeletionModalLabel">Hapus Akun</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-muted">Apakah Anda yakin ingin menghapus akun Anda? Setelah
                                            akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.
                                            Harap masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus
                                            akun Anda secara permanen.</p>
                                        <form id="user-deletion-form" method="post"
                                            action="{{ route('profile.destroy') }}" class="p-0">
                                            @csrf
                                            @method('delete')
                                            <div class="mb-3">
                                                <label for="password_delete" class="form-label visually-hidden">Kata
                                                    Sandi</label>
                                                <input id="password_delete" name="password" type="password"
                                                    class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                                    placeholder="Kata Sandi" autocomplete="current-password">
                                                @error('password', 'userDeletion')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" form="user-deletion-form" class="btn btn-danger">Hapus
                                            Akun</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
