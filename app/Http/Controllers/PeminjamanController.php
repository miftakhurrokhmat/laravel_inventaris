<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Inventaris;
use App\Http\Requests\SimpanPeminjamanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $peminjaman = Peminjaman::query()
            ->with(['inventaris', 'user'])
            ->status($request->query('status'))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // Hanya barang dengan kondisi Baik yang bisa dipinjam
        $inventaris = Inventaris::kondisiBaik()
            ->orderBy('nama')
            ->get();

        return view('peminjaman.create', compact('inventaris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SimpanPeminjamanRequest $request)
    {
        //
        $data = $request->validated();
        $data['kode_pinjam'] = Peminjaman::buatKode();
        $data['user_id'] = $request->user()->id;
        $data['status'] = 'dipinjam';

        $peminjaman = Peminjaman::create($data);

        Log::info('peminjaman.dibuat', [
            'id' => $peminjaman->id,
            'kode' => $peminjaman->kode_pinjam,
            'barang' => $peminjaman->inventaris->nama,
            'peminjam' => $request->user()->email,
        ]);

        return redirect()
            ->route('peminjaman.index')
            ->with('sukses', "Peminjaman {$peminjaman->kode_pinjam} dicatat.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
        $peminjaman->load(['inventaris', 'user']);
        return view('peminjaman.show', compact('peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function kembalikan(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'kembali') {
            return back()->withErrors(['status' => 'Barang sudah dikembalikan.']);
        }

        $peminjaman->update([
            'tanggal_kembali' => now(),
            'status' => 'kembali',
        ]);

        Log::info('peminjaman.dikembalikan', [
            'id' => $peminjaman->id,
            'kode' => $peminjaman->kode_pinjam,
            'oleh' => auth()->user()->email,
        ]);

        return back()->with('sukses', 'Barang telah dikembalikan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
        $kode = $peminjaman->kode_pinjam;
        $peminjaman->delete();

        Log::info('peminjaman.dihapus', [
            'kode' => $kode,
            'oleh' => auth()->user()->email,
        ]);

        return back()->with('sukses', "Peminjaman {$kode} dihapus.");
    }
}
