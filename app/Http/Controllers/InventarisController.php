<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Kategori;
use App\Models\Kondisi;
use App\Http\Requests\SimpanInventarisRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $inventaris = Inventaris::query()
            ->with(['kategori', 'kondisi', 'user'])
            ->cari($request->query('q'))
            ->when($request->query('kategori_id'), function ($q, $katId) {
                $q->where('kategori_id', $katId);
            })
            ->when($request->query('kondisi_id'), function ($q, $konId) {
                $q->where('kondisi_id', $konId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('inventaris.index', [
            'inventaris' => $inventaris,
            'kategori' => Kategori::orderBy('nama')->get(),
            'kondisi' => Kondisi::orderBy('nama')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('inventaris.create', [
            'kategori' => Kategori::orderBy('nama')->get(),
            'kondisi' => Kondisi::orderBy('nama')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SimpanInventarisRequest $request)
    {
        //
        $data = $request->validated();
        $data['kode'] = Inventaris::buatKode();
        $data['user_id'] = $request->user()->id;

        $inventaris = Inventaris::create($data);

        Log::info('inventaris.ditambah', [
            'id' => $inventaris->id,
            'kode' => $inventaris->kode,
            'nama' => $inventaris->nama,
            'oleh' => $request->user()->email,
        ]);

        return redirect()
            ->route('inventaris.index')
            ->with('sukses', "Barang {$inventaris->kode} berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventaris $inventaris)
    {
        //
        $inventaris->load(['kategori', 'kondisi', 'user', 'peminjaman']);
        return view('inventaris.show', compact('inventaris'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventaris $inventaris)
    {
        //
        return view('inventaris.edit', [
            'inventaris' => $inventaris,
            'kategori' => Kategori::orderBy('nama')->get(),
            'kondisi' => Kondisi::orderBy('nama')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SimpanInventarisRequest $request, Inventaris $inventaris)
    {
        //
        $data = $request->validated();
        $inventaris->update($data);

        Log::info('inventaris.diubah', [
            'id' => $inventaris->id,
            'oleh' => $request->user()->email,
        ]);

        return redirect()
            ->route('inventaris.index')
            ->with('sukses', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventaris $inventaris)
    {
        //
        $kode = $inventaris->kode;
        $nama = $inventaris->nama;
        $id = $inventaris->id;

        $inventaris->delete();

        Log::info('inventaris.dihapus', [
            'id' => $id,
            'kode' => $kode,
            'nama' => $nama,
            'oleh' => auth()->user()->email,
            'waktu' => now()->toDateTimeString(),
        ]);

        return back()->with('sukses', "Barang {$kode} dihapus.");
    }

    
}
