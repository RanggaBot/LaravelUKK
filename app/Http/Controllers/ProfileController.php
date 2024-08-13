<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;

        if ($request->hasFile('profile_picture')) {
            // Hapus foto profil lama jika ada
            if ($user->profile_picture) {
                Storage::disk('public')->delete(str_replace('storage/', '', $user->profile_picture));
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = 'storage/' . $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}