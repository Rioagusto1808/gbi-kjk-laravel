<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\File;
use App\Models\Jemaat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user()->load('jemaat'),
        ]);
    }

    public function updateUser(UserUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->only(['name', 'email']));
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update the user's profile information.
     */
    public function updateJemaat(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        // Data jemaat biasa
        $data = $request->only([
            'no_hp',
            'jenis_kelamin',
            'tanggal_lahir',
            'alamat',
            'status_pernikahan',
            'pekerjaan',
        ]);
        $data['name'] = $request->jemaat_name;

        // Handle foto base64
        if ($request->filled('foto')) {
            $image = $request->input('foto');
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);

            $imageName = 'foto_'.time().'.png';
            $path = 'uploads/foto/'.$imageName;

            // Simpan file baru ke storage
            Storage::disk('public')->put($path, base64_decode($image));

            // Kalau ada foto lama → hapus dulu
            if ($user->jemaat && $user->jemaat->foto) {
                Storage::disk('public')->delete($user->jemaat->foto->path); // hapus file lama
                $user->jemaat->foto->delete(); // hapus record lama dari tabel files (pakai soft delete kalau File pakai SoftDeletes)
            }

            // Buat record baru di tabel files
            $fileRecord = \App\Models\File::create([
                'nama_asli' => $imageName,
                'path' => $path,
                'mime_type' => 'image/png',
                'size' => strlen($image),
                'kategori' => 'foto_profil',
            ]);

            $data['foto_id'] = $fileRecord->id;
        }

        // Update atau buat jemaat
        if ($user->jemaat) {
            $user->jemaat->update($data);
        } else {
            $jemaat = \App\Models\Jemaat::create($data);
            $user->update(['jemaat_id' => $jemaat->id]);
        }

        return redirect()->route('profile.edit')
            ->with('success', 'Biodata jemaat berhasil diperbarui.');
    }

    /**
     * Delete the user's account (soft delete).
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Soft delete user
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function removePhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->jemaat && $user->jemaat->foto) {
            // hapus file dari storage
            Storage::disk('public')->delete($user->jemaat->foto->path);

            // hapus record file
            $user->jemaat->foto->delete();

            // reset relasi
            $user->jemaat->update(['foto_id' => null]);
        }

        return Redirect::route('profile.edit')->with('success', 'Foto profil berhasil dihapus.');
    }
}
