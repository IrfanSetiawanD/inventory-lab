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
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'bio' => 'nullable|string',
        'location' => 'nullable|string|max:255',
        'tanggal_lahir' => 'nullable|date',
        'no_telp' => 'nullable|string|max:20',
    ]);

    $user = Auth::user();
    $user->update($request->only([
        'name', 'email', 'bio', 'location', 'tanggal_lahir', 'no_telp',
    ]));

    return redirect()->route('profile.edit')->with('status', 'profile-updated');
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
