<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Inventaris;
use App\Models\Kategori;
use App\Models\Kondisi;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $stats = [
            'total_inventaris' => Inventaris::count(),
            'total_kategori' => Kategori::count(),
            'total_kondisi' => Kondisi::count(),
            'total_nilai_aset' => Inventaris::sum('harga'),
            'barang_kondisi_baik' => Inventaris::kondisiBaik()->count(),
            'peminjaman_aktif' => Peminjaman::where('status', 'dipinjam')->count(),
        ];

        $perKategori = Kategori::withCount('inventaris')
            ->orderByDesc('inventaris_count')
            ->limit(5)
            ->get();

        $perKondisi = Kondisi::withCount('inventaris')->get();

        $terbaru = Inventaris::with(['kategori', 'kondisi'])
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'perKategori', 'perKondisi', 'terbaru'));
    }
}
