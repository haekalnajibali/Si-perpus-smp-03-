<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Book;
use App\Http\Requests\StoreRakRequest;
use App\Http\Requests\UpdateRakRequest;
use Illuminate\Support\Facades\Storage;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.raks.index', [
            'active' => 'raks',
            'raks' => Rak::latest()->paginate(20),
            'count' => Rak::get()->count(), 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.raks.create', [
            'active' => 'raks',
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRakRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRakRequest $request)
    {
        $validatedData = $request->validate([ 
            'kategori' => 'required',
            'nama_gambar' => 'image|file|max:50000',
        ]);
        if ($request->file('nama_gambar')) {
            $imageName = time() . '.' . $request->file('nama_gambar')->getClientOriginalExtension();
            $request->file('nama_gambar')->move(public_path('storage/images'), $imageName);
            $validatedData['nama_gambar'] = $imageName;
        }
        Rak::create($validatedData);
    
        return redirect('/dashboard/raks')->with('success', 'Kategori baru telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function show(Rak $rak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function edit(Rak $rak)
    {
        return view('dashboard.raks.edit', [
            'rak' => $rak,
            'active' => 'raks',
        ]);
    }

    public function update(UpdateRakRequest $request, Rak $rak)
{
    $rules = [
        'kategori' => 'required',
        'nama_gambar' => 'image|file|max:50000',
    ];
    $validatedData = $request->validate($rules);

    if ($request->file('nama_gambar')) {
        if ($rak->nama_gambar) {
            Storage::delete($rak->nama_gambar); // Perhatikan penggunaan $rak->nama_gambar, bukan $rak['nama_gambar']
        }

        $imageName = time() . '.' . $request->file('nama_gambar')->getClientOriginalExtension();
        $request->file('nama_gambar')->move(public_path('storage/images'), $imageName);
        $validatedData['nama_gambar'] = $imageName;
    }

    // Perbarui record rak yang sesuai berdasarkan kunci primer
    $rak->update($validatedData);

    return redirect('/dashboard/raks')->with('success', 'Kategori telah diubah!.');
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRakRequest  $request
     * @param  \App\Models\Rak  $rak
     * @return \Illuminate\Http\Response
     */
   
    public function destroy(Rak $rak)
    {
        if(Book::where('rak_id',$rak->id)->count() != 0){
            return redirect('/dashboard/raks')->with('failed', 'Gagal hapus kategori karena data masih digunakan!');
        }
        if ($rak->nama_gambar) {
            Storage::delete($rak['nama_gambar']);
        }
        Rak::destroy($rak->id);
        Book::where('rak_id', $rak->id)->delete();
        return redirect('/dashboard/raks')->with('success', 'Kategori Rak telah dihapus.');
    }
}
