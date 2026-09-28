<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $kategori = Kategori::withCount('inventaris')
            ->orderBy('nama')
            ->paginate(10);

        return view('kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'nama' => 'required|string|max:100|unique:kategori,nama',
            'deskripsi' => 'nullable|string',
        ]);

        Kategori::create($data);

        return redirect()
            ->route('kategori.index')
            ->with('sukses', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
        $kategori->load('inventaris');
        return view('kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
        $data = $request->validate([
            'nama' => 'required|string|max:100|unique:kategori,nama,' . $kategori->id,
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($data);

        return redirect()
            ->route('kategori.index')
            ->with('sukses', 'Kategori diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
        if ($kategori->inventaris()->exists()) {
            return back()->withErrors([
                'kategori' => 'Kategori masih dipakai barang inventaris.',
            ]);
        }

        $kategori->delete();

        return back()->with('sukses', 'Kategori dihapus.');
    }
}
