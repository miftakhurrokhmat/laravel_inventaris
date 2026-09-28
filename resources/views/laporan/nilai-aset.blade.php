@extends('layouts.app')

@section('judul', 'Laporan Nilai Aset')

@section('konten')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Laporan Nilai Aset</h1>
    <a href="{{ route('laporan.index') }}" class="text-sm text-blue-600 hover:underline">
        ← Kembali ke Laporan
    </a>
</div>

{{-- Filter tanggal --}}
<form method="GET" class="bg-white p-4 rounded shadow mb-6 flex flex-wrap gap-2 items-center">
    <label class="font-semibold">Dari:</label>
    <input type="date" name="dari" value="{{ request('dari') }}" class="border rounded p-2">
    <label class="font-semibold">Sampai:</label>
    <input type="date" name="sampai" value="{{ request('sampai') }}" class="border rounded p-2">
    <button class="bg-blue-700 text-white px-4 py-2 rounded">Filter</button>
    @if (request('dari') || request('sampai'))
        <a href="{{ route('laporan.nilai-aset') }}" class="border px-4 py-2 rounded">Reset</a>
    @endif
</form>

{{-- Ringkasan --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-5 rounded shadow border-l-4 border-blue-500">
        <p class="text-sm text-gray-500">Total Barang</p>
        <p class="text-2xl font-bold text-blue-700">{{ number_format($ringkasan['total_barang']) }}</p>
    </div>
    <div class="bg-white p-5 rounded shadow border-l-4 border-green-500">
        <p class="text-sm text-gray-500">Total Nilai Aset</p>
        <p class="text-2xl font-bold text-green-600">
            Rp {{ number_format($ringkasan['total_nilai'], 0, ',', '.') }}
        </p>
    </div>
    <div class="bg-white p-5 rounded shadow border-l-4 border-yellow-500">
        <p class="text-sm text-gray-500">Rata-rata Nilai</p>
        <p class="text-2xl font-bold text-yellow-600">
            Rp {{ number_format($ringkasan['rata_rata'], 0, ',', '.') }}
        </p>
    </div>
</div>

{{-- Tabel detail --}}
<div class="bg-white p-6 rounded shadow">
    <table class="min-w-full text-sm">
        <thead class="bg-blue-700 text-white">
            <tr>
                <th class="p-3 text-left">Kode</th>
                <th class="p-3 text-left">Nama</th>
                <th class="p-3 text-left">Kategori</th>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-right">Harga (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 font-mono text-xs">{{ $item->kode }}</td>
                    <td class="p-3">{{ $item->nama }}</td>
                    <td class="p-3">{{ $item->kategori->nama }}</td>
                    <td class="p-3">{{ $item->tanggal_perolehan->format('d/m/Y') }}</td>
                    <td class="p-3 text-right">{{ number_format($item->harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="p-6 text-center text-gray-500">
                    Tidak ada data dalam rentang tanggal ini.
                </td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection