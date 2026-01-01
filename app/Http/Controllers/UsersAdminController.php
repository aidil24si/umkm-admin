<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['role'];
        $searchableColumns = ['name', 'email'];

        $query = User::query();

        // FILTER
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // SEARCH
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // PAGINATION
        $dataUser = $query->paginate(10)->withQueryString();

        // ====== PADANAN SQL%FOUND / SQL%NOTFOUND / SQL%ROWCOUNT ======
        if ($dataUser->total() === 0) {
            session()->flash('error', 'Tidak ada User yang terpilih');
        } else {
            session()->flash(
                'info',
                $dataUser->total() . ' user selected'
            );
        }

        return view('pages.user.index', compact('dataUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'name.string'        => 'Nama harus berupa teks.',
            'name.max'           => 'Nama maksimal 100 karakter.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah digunakan.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $data['name']     = $request->name;
        $data['email']    = $request->email;
        $data['role']     = $request->role;
        $data['password'] = $request->password;
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('profile_picture')) {
            $path                    = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);
        return view('pages.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id   = $id;
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'name.string'        => 'Nama harus berupa teks.',
            'name.max'           => 'Nama maksimal 100 karakter.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah digunakan.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Hapus foto jika user pilih hapus foto
        if ($request->remove_profile_picture) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $user->profile_picture = null;
        }

        // Upload foto baru
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $path                  = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();
        return redirect()->route('user.index')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
