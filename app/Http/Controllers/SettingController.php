<?php

namespace App\Http\Controllers;

use App\Models\SchoolSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = SchoolSetting::first();
        $users = User::latest()->paginate(10);
        return view('settings.index', compact('setting', 'users'));
    }

    public function updateProfile(Request $request)
    {
        $setting = SchoolSetting::first();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'headmaster_name' => 'nullable|string|max:255',
            'headmaster_nip' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($setting->logo_path) {
                Storage::delete('public/' . $setting->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('school', 'public');
        }

        $setting->update($data);

        return back()->with('success', 'Profil sekolah berhasil diperbarui.');
    }

    public function createUser()
    {
        if (!in_array(Auth::user()->role, ['kepsek', 'admin'])) {
            abort(403);
        }
        return view('settings.users.create');
    }

    public function storeUser(Request $request)
    {
        if (!in_array(Auth::user()->role, ['kepsek', 'admin'])) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:kepsek,bendahara,operator,admin',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'aktif',
        ]);

        return redirect()->route('settings.index')->with('success', 'User baru berhasil ditambahkan.');
    }

    public function editUser(User $user)
    {
        if (!in_array(Auth::user()->role, ['kepsek', 'admin'])) {
            abort(403);
        }
        return view('settings.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        if (!in_array(Auth::user()->role, ['kepsek', 'admin'])) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:kepsek,bendahara,operator,admin',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];

        // Mencegah perubahan role pada akun sendiri agar tidak hilang akses
        if ($user->id !== Auth::id()) {
            $data['role'] = $request->role;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('settings.index')->with('success', 'User berhasil diperbarui.');
    }

    public function toggleUserStatus(User $user)
    {
        if (!in_array(Auth::user()->role, ['kepsek', 'admin'])) {
            abort(403);
        }

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menonaktifkan akun sendiri.');
        }

        $user->status = $user->status === 'aktif' ? 'nonaktif' : 'aktif';
        $user->save();

        return back()->with('success', 'Status user berhasil diubah.');
    }
    
    public function resetPassword(Request $request, User $user)
    {
        if (!in_array(Auth::user()->role, ['kepsek', 'admin'])) {
            abort(403);
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password user berhasil di-reset.');
    }
}
