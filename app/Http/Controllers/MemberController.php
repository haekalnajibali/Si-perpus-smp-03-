<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.members.index', [
            'members' => Member::orderBy('nama')
                ->filter(request(['search']))
                ->paginate(10)
                ->withQueryString(),
            'active' => 'members',
            'count' => Member::get()->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.members.create', [
            'active' => 'members',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberRequest $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nisn' => 'required|unique:members',
            'tmpt_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jns_kelamin' => 'required',
            'jns_anggota' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|unique:members',
            'nama_gambar' => 'image|file|max:50000',
        ]);
        if ($request->file('nama_gambar')) {
            $imageName = time() . '.' . $request->file('nama_gambar')->getClientOriginalExtension();
            $request->file('nama_gambar')->move(public_path('storage/images'), $imageName);
            $validatedData['nama_gambar'] = $imageName;
        }
        Member::create($validatedData);

        return redirect('/dashboard/members')->with('success', 'Anggota baru telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('dashboard.members.edit', [
            'member' => $member,
            'active' => 'members',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMemberRequest  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $rules = [
            'nama' => 'required',
            'nisn' => 'required|unique:members',
            'tmpt_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jns_kelamin' => 'required',
            'jns_anggota' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|unique:members',
            'nama_gambar' => 'image|file|max:50000',
        ];

        if ($request->nisn != $member->nisn) {
            $rules['nisn'] = 'required|unique:members';
        }
        if ($request->no_hp != $member->no_hp) {
            $rules['no_hp'] = 'required|unique:members';
        }

        $validatedData = $request->validate($rules);
        if ($request->file('nama_gambar')) {
            $imageName = time() . '.' . $request->file('nama_gambar')->getClientOriginalExtension();
            // $request->file('nama_gambar')->move(public_path('storage/images'), $imageName);
            $validatedData['nama_gambar'] = $imageName;
        }

        if ($request->file('nama_gambar')) {
            if ($member->nama_gambar) {
                Storage::delete($member['nama_gambar']);
            }
            $imageName = time() . '.' . $request->file('nama_gambar')->getClientOriginalExtension();
            $request->file('nama_gambar')->move(public_path('storage/images'), $imageName);
            $validatedData['nama_gambar'] = $imageName;
        }
        // dd($validatedData);

        Member::where('nisn', $member->nisn)->update($validatedData);

        return redirect('/dashboard/members')->with('success', 'Anggota telah diubah!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
{
    // Periksa apakah ada transaksi terkait dengan anggota
    $transactionsCount = Transaction::where('member_id', $member->nisn)->count();
    
    if ($transactionsCount > 0) {
        // Jika ada transaksi terkait, kembalikan dengan pesan gagal
        return redirect('/dashboard/members')->with('failed', 'Gagal hapus anggota karena terdapat transaksi!');
    } else {
        // Jika tidak ada transaksi terkait, hapus anggota
        if ($member->nama_gambar) {
            Storage::delete($member->nama_gambar);
        }

        $member->delete();
        
        // Setelah menghapus anggota, Anda mungkin ingin melakukan sesuatu yang lain,
        // seperti menghapus relasi lainnya, atau melakukan tindakan lainnya.
        // Misalnya:
        // $member->transactions()->delete(); // Menghapus transaksi terkait

        // Kemudian, kembalikan dengan pesan sukses
        return redirect('/dashboard/members')->with('success', 'Anggota telah dihapus.');
    }
}



}
