<!-- Modal Ubah Email -->
<div x-data @open-email-modal.window="$refs.modalEmail.showModal()">
    <dialog x-ref="modalEmail" class="rounded-xl backdrop:bg-black/30 p-0 w-full max-w-md">
        <form method="POST" action="{{ route('profile.update-email') }}" class="p-6 space-y-4">
            @csrf
            @method('patch')
            <h3 class="text-lg font-bold">Ubah Email</h3>
            <input type="email" name="email" class="w-full border rounded p-2" placeholder="Email baru" required>
            <input type="password" name="password" class="w-full border rounded p-2" placeholder="Password akun" required>
            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </dialog>
</div>

<!-- Modal Ubah Password -->
<div x-data @open-password-modal.window="$refs.modalPassword.showModal()">
    <dialog x-ref="modalPassword" class="rounded-xl backdrop:bg-black/30 p-0 w-full max-w-md">
        <form method="POST" action="{{ route('profile.update-password') }}" class="p-6 space-y-4">
            @csrf
            @method('patch')
            <h3 class="text-lg font-bold">Ubah Password</h3>
            <input type="password" name="current_password" class="w-full border rounded p-2" placeholder="Password Lama" required>
            <input type="password" name="password" class="w-full border rounded p-2" placeholder="Password Baru" required>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2" placeholder="Konfirmasi Password" required>
            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </dialog>
</div>

<!-- Modal Hapus Akun -->
<div x-data @open-delete-modal.window="$refs.modalDelete.showModal()">
    <dialog x-ref="modalDelete" class="rounded-xl backdrop:bg-black/30 p-0 w-full max-w-md">
        <form method="POST" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">
            @csrf
            @method('DELETE')
            <h3 class="text-lg font-bold text-red-600">Hapus Akun</h3>
            <p class="text-sm text-gray-600">Masukkan password untuk mengonfirmasi penghapusan akun Anda.</p>
            <input type="password" name="password" class="w-full border rounded p-2" placeholder="Password" required>
            <div class="text-right">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</button>
            </div>
        </form>
    </dialog>
</div>
