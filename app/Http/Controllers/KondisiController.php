<?php

namespace App\Http\Controllers;

use App\Models\Kondisi;
use Illuminate\Http\Request;

class KondisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $kondisi = Kondisi::withCount('inventaris')
            ->orderBy('nama')
            ->paginate(10);

        return view('kondisi.index', compact('kondisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('kondisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'nama' => 'required|string|max:50|unique:kondisi,nama',
            'keterangan' => 'nullable|string|max:100',
        ]);

        Kondisi::create($data);

        return redirect()
            ->route('kondisi.index')
            ->with('sukses', 'Kondisi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kondisi $kondisi)
    {
        //
        $kondisi->load('inventaris');
        return view('kondisi.show', compact('kondisi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kondisi $kondisi)
    {
        //
        return view('kondisi.edit', compact('kondisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kondisi $kondisi)
    {
        //
        $data = $request->validate([
            'nama' => 'required|string|max:50|unique:kondisi,nama,' . $kondisi->id,
            'keterangan' => 'nullable|string|max:100',
        ]);

        $kondisi->update($data);

        return redirect()
            ->route('kondisi.index')
            ->with('sukses', 'Kondisi diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kondisi $kondisi)
    {
        //
        if ($kondisi->inventaris()->exists()) {
            return back()->withErrors([
                'kondisi' => 'Kondisi masih dipakai barang inventaris.',
            ]);
        }

        $kondisi->delete();

        return back()->with('sukses', 'Kondisi dihapus.');
    }
}
