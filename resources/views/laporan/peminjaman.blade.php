@extends('layouts.app')

@section('judul', 'Laporan Peminjaman')

@section('konten')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Laporan Peminjaman</h1>
    <a href="{{ route('laporan.index') }}" class="text-sm text-blue-600 hover:underline">
        ← Kembali ke Laporan
    </a>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 rounded shadow border-l-4 border-blue-500">
        <p class="text-xs text-gray-500">Total</p>
        <p class="text-2xl font-bold text-blue-700">{{ $ringkasan['total'] }}</p>
    </div>
    <div class="bg-white p-4 rounded shadow border-l-4 border-yellow-500">
        <p class="text-xs text-gray-500">Dipinjam</p>
        <p class="text-2xl font-bold text-yellow-600">{{ $ringkasan['dipinjam'] }}</p>
    </div>
    <div class="bg-white p-4 rounded shadow border-l-4 border-green-500">
        <p class="text-xs text-gray-500">Kembali</p>
        <p class="text-2xl font-bold text-green-600">{{ $ringkasan['kembali'] }}</p>
    </div>
    <div class="bg-white p-4 rounded shadow border-l-4 border-red-500">
        <p class="text-xs text-gray-500">Terlambat</p>
        <p class="text-2xl font-bold text-red-600">{{ $ringkasan['terlambat'] }}</p>
    </div>
</div>

<div class="bg-white p-6 rounded shadow">
    <table class="min-w-full text-sm">
        <thead class="bg-blue-700 text-white">
            <tr>
                <th class="p-3 text-left">Kode</th>
                <th class="p-3 text-left">Barang</th>
                <th class="p-3 text-left">Peminjam</th>
                <th class="p-3 text-left">Tgl Pinjam</th>
                <th class="p-3 text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $p)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 font-mono text-xs">{{ $p->kode_pinjam }}</td>
                    <td class="p-3">{{ $p->inventaris->nama }}</td>
                    <td class="p-3">{{ $p->user->name }}</td>
                    <td class="p-3">{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                    <td class="p-3">{{ $p->status }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="p-6 text-center text-gray-500">
                    Belum ada data.
                </td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection