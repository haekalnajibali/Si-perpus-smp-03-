<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'users' => User::first() 
                ->orderBy('nama')
               
                ->paginate(10)
                ->withQueryString(),
            'active' => 'users',
            'count' => User::get()->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create', [
            'active' => 'users',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'email' => 'required',
            'no_tlp' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'password' => 'required',
            'nama_gambar' => 'image|file|max:50000',
        ]);

        if ($request->file('nama_gambar')) {
            $imageName = time() . '.' . $request->file('nama_gambar')->getClientOriginalExtension();
            $request->file('nama_gambar')->move(public_path('storage/images'), $imageName);
            $validatedData['nama_gambar'] = $imageName;
        }

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        return redirect('/dashboard/users')->with('success', 'Petugas baru telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', [
            'user' => $user,
            'active' => 'users',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'id' => 'required',
            'nama' => 'required',
            'nip' => 'required',
            'email' => 'required',
            'no_tlp' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'password' => 'required',
            'nama_gambar' => 'image|file|max:50000',
        ];
        $validatedData = $request->validate($rules);
        if ($request->file('nama_gambar')) {
            $imageName = time() . '.' . $request->file('nama_gambar')->getClientOriginalExtension();
            // $request->file('nama_gambar')->move(public_path('storage/images'), $imageName);
            $validatedData['nama_gambar'] = $imageName;
        }

        if ($request->file('nama_gambar')) {
            if ($user->nama_gambar) {
                Storage::delete($member['nama_gambar']);
            }
            $imageName = time() . '.' . $request->file('nama_gambar')->getClientOriginalExtension();
            $request->file('nama_gambar')->move(public_path('storage/images'), $imageName);
            $validatedData['nama_gambar'] = $imageName;
        }
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::where('nip', $user->nip)->update($validatedData);

        return redirect('/dashboard/users')->with('success', 'User telah diubah!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
{
    // Periksa apakah ada transaksi terkait dengan anggota
    $transactionsCount = Transaction::where('user_id', $user->nip)->count();
    if ($transactionsCount > 0) {
        return redirect('/dashboard/users')->with('failed', 'Gagal hapus petugas karena terdapat transaksi!');
    } else {
        // Jika tidak ada transaksi terkait, hapus anggota
        if ($user->nama_gambar) {
            Storage::delete($user->nama_gambar);
        }

        $user->delete();

        return redirect('/dashboard/users')->with('success', 'Petugas telah dihapusss.');
    }
}
}
