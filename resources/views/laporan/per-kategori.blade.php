@extends('layouts.app')

@section('judul', 'Laporan Per Kategori')

@section('konten')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Laporan Inventaris per Kategori</h1>
    <a href="{{ route('laporan.index') }}" class="text-sm text-blue-600 hover:underline">
        ← Kembali ke Laporan
    </a>
</div>

<div class="bg-white p-6 rounded shadow">
    <table class="min-w-full text-sm">
        <thead class="bg-blue-700 text-white">
            <tr>
                <th class="p-3 text-left">Kategori</th>
                <th class="p-3 text-right">Jumlah Barang</th>
                <th class="p-3 text-right">Total Nilai (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $k)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 font-semibold">{{ $k->nama }}</td>
                    <td class="p-3 text-right">{{ $k->inventaris_count }} unit</td>
                    <td class="p-3 text-right">
                        {{ number_format($k->inventaris_sum_harga ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="p-6 text-center text-gray-500">
                    Belum ada data.
                </td></tr>
            @endforelse
        </tbody>
        <tfoot class="bg-gray-100 font-bold">
            <tr>
                <td class="p-3">TOTAL</td>
                <td class="p-3 text-right">{{ $data->sum('inventaris_count') }} unit</td>
                <td class="p-3 text-right">
                    {{ number_format($data->sum('inventaris_sum_harga'), 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection