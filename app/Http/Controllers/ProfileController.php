<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile information (index view).
     * Menampilkan informasi profil pengguna (tampilan indeks).
     */
    public function edit(Request $request): View
    {
        // Mengarahkan ke tampilan baru 'profile.show' untuk menampilkan informasi profil
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile settings form (edit view).
     * Menampilkan formulir pengaturan profil pengguna (tampilan edit).
     */
    public function settings(Request $request): View // Metode baru untuk menampilkan form edit
    {
        // Mengarahkan ke tampilan 'profile.edit' yang sudah ada (berisi form untuk edit)
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     * Memperbarui informasi profil pengguna.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Pastikan Anda memanggil ProfileUpdateRequest jika Anda menggunakannya.
        // Jika tidak, Anda bisa menggunakan $request->validate() langsung di sini.
        // Validasi tambahan untuk tanggal_lahir
        $request->validate([
            'tanggal_lahir' => 'nullable|date|before_or_equal:today', // Tanggal lahir tidak boleh di masa depan
        ]);

        $user = $request->user();

        // Mengisi data user dari request yang sudah divalidasi
        $user->fill($request->validated());

        // Update tanggal_lahir secara terpisah karena mungkin tidak ada di ProfileUpdateRequest default
        // Ini akan memastikan jika input kosong dikirim, itu akan diatur menjadi null.
        if ($request->has('tanggal_lahir')) {
            $user->tanggal_lahir = $request->tanggal_lahir;
        } else {
            // Jika tanggal_lahir tidak disertakan dalam request (misalnya, input tanggal lahir disembunyikan/tidak diisi)
            // atau jika nilai yang dikirim adalah string kosong, set menjadi null di database.
            if ($request->input('tanggal_lahir') === null || $request->input('tanggal_lahir') === '') {
                $user->tanggal_lahir = null; // Set null jika input kosong
            }
        }

        // Jika email berubah, set email_verified_at menjadi null (membutuhkan verifikasi ulang)
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect kembali ke halaman indeks profil dengan status success
        return Redirect::route('profile.edit')->with('status', 'profile-updated'); // Kembali ke halaman indeks profil (profile.show)
    }

    /**
     * Delete the user's account.
     * Menghapus akun pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validasi kata sandi untuk konfirmasi penghapusan akun
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Logout user
        Auth::logout();

        // Hapus akun user
        $user->delete();

        // Invalidasi sesi dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return Redirect::to('/');
    }
}
