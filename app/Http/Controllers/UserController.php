<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Menampilkan halaman untuk membuat user baru oleh admin.
     */
    public function create()
    {
        // Mengambil daftar role yang bisa dipilih oleh admin
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Menyimpan user baru yang dibuat oleh admin.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name'], // Memastikan role yang dipilih valid
            'kecamatan' => ['required', 'string', 'max:255'], // Simpan kecamatan
            'kelurahan' => ['required', 'string', 'max:255'], // Simpan kelurahan
            'nama_posyandu' => 'nullable|string',
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'kecamatan' => $request->kecamatan, // Simpan kecamatan
            'kelurahan' => $request->kelurahan, // Simpan kelurahan
            'nama_posyandu' => $request->nama_posyandu, // Simpan nama posyandu
        ]);

        // Menetapkan role ke user yang baru dibuat
        $user->assignRole($request->role);

        // Redirect ke halaman user management dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dibuat!');
    }

    /**
     * Menampilkan daftar semua user (opsional).
     */
    public function index()
    {
        $user = Auth::user();

        // Jika user adalah admin, tampilkan semua user
        if ($user->hasRole('admin')) {
            $users = User::with('roles')->get();
        } 
        // Jika user adalah PetugasKesehatan, tampilkan user dengan kecamatan yang sama
        else if ($user->hasRole('PetugasKesehatan')) {
            $users = User::with('roles')->where('kecamatan', $user->kecamatan)->get();
        } 
        // Jika bukan admin atau PetugasKesehatan, kosongkan hasil atau sesuaikan logika lainnya
        else {
            $users = collect([]); // Hasil kosong
        }

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all(); // Get all roles for the dropdown
        return view('admin.users.edit', compact('user', 'roles'));
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role' => 'required',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'nama_posyandu' => 'required|string|max:255',
        ]);

        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;
        $user->kecamatan = $request->kecamatan;
        $user->kelurahan = $request->kelurahan;
        $user->nama_posyandu = $request->nama_posyandu;


        // Update role
        $user->roles()->sync(Role::where('name', $request->role)->first());

        // Simpan perubahan
        $user->save();

        // Redirect ke halaman daftar user dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }
    public function destroy(User $user)
    {
        // Menghapus user dari database
        $user->delete();

        // Redirect ke halaman daftar user dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
    public function filter(Request $request)
    {
        $kecamatan = $request->input('kecamatan');

        // Ambil pengguna berdasarkan kecamatan yang dipilih
        $users = User::when($kecamatan, function ($query, $kecamatan) {
            return $query->where('kecamatan', $kecamatan);
        })->get();

  
        return view('admin.users.index', compact('users','kecamatan'));
    }

}
