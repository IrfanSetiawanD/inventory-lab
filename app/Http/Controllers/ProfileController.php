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
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'bio' => 'nullable|string|max:255',
        'location' => 'nullable|string|max:255',
        'tanggal_lahir' => 'nullable|date',
        'no_telp' => 'nullable|string|max:20',
    ]);

    $user->update([
        'name' => $request->name,
        'bio' => $request->bio,
        'location' => $request->location,
        'tanggal_lahir' => $request->tanggal_lahir,
        'no_telp' => $request->no_telp,
    ]);

    return back()->with('success', 'Data profil berhasil diperbarui.');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = $request->user();
    $user->update([
        'password' => bcrypt($request->password),
    ]);

    return back()->with('status', 'password-updated');
}
}
