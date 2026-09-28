<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Kategori;
use App\Models\Kondisi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //
    public function index()
    {
        return view('laporan.index');
    }

    public function perKategori()
    {
        $data = Kategori::withCount('inventaris')
            ->withSum('inventaris', 'harga')
            ->orderBy('nama')
            ->get();

        return view('laporan.per-kategori', compact('data'));
    }

    public function perKondisi()
    {
        $data = Kondisi::withCount('inventaris')
            ->withSum('inventaris', 'harga')
            ->orderBy('nama')
            ->get();

        return view('laporan.per-kondisi', compact('data'));
    }

    public function nilaiAset(Request $request)
    {
        $query = Inventaris::query()->with(['kategori', 'kondisi']);

        if ($request->filled('dari')) {
            $query->whereDate('tanggal_perolehan', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('tanggal_perolehan', '<=', $request->sampai);
        }

        $data = $query->orderBy('tanggal_perolehan')->get();

        $ringkasan = [
            'total_barang' => $data->count(),
            'total_nilai' => $data->sum('harga'),
            'rata_rata' => $data->avg('harga') ?? 0,
            'nilai_tertinggi' => $data->max('harga') ?? 0,
            'nilai_terendah' => $data->min('harga') ?? 0,
        ];

        return view('laporan.nilai-aset', compact('data', 'ringkasan'));
    }

    public function peminjaman(Request $request)
    {
        $query = Peminjaman::with(['inventaris', 'user']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data = $query->orderByDesc('tanggal_pinjam')->get();

        $ringkasan = [
            'total' => $data->count(),
            'dipinjam' => $data->where('status', 'dipinjam')->count(),
            'kembali' => $data->where('status', 'kembali')->count(),
            'terlambat' => $data->where('status', 'terlambat')->count(),
        ];

        return view('laporan.peminjaman', compact('data', 'ringkasan'));
    }
}
