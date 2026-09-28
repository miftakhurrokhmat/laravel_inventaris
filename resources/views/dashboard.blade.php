@extends('layouts.app')

@section('judul', 'Dashboard')

@section('konten')
<h1 class="text-2xl font-bold mb-6">📊 Dashboard Inventaris</h1>

{{-- Kartu statistik --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white p-5 rounded shadow border-l-4 border-blue-500">
        <p class="text-sm text-gray-500">Total Barang</p>
        <p class="text-3xl font-bold text-blue-700">
            {{ number_format($stats['total_inventaris']) }}
        </p>
    </div>
    <div class="bg-white p-5 rounded shadow border-l-4 border-green-500">
        <p class="text-sm text-gray-500">Kondisi Baik</p>
        <p class="text-3xl font-bold text-green-600">
            {{ number_format($stats['barang_kondisi_baik']) }}
        </p>
    </div>
    <div class="bg-white p-5 rounded shadow border-l-4 border-purple-500">
        <p class="text-sm text-gray-500">Kategori</p>
        <p class="text-3xl font-bold text-purple-700">
            {{ number_format($stats['total_kategori']) }}
        </p>
    </div>
    <div class="bg-white p-5 rounded shadow border-l-4 border-yellow-500">
        <p class="text-sm text-gray-500">Nilai Aset</p>
        <p class="text-xl font-bold text-yellow-700">
            Rp {{ number_format($stats['total_nilai_aset'], 0, ',', '.') }}
        </p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-bold mb-4">Top 5 Kategori</h2>
        <canvas id="chartKategori"></canvas>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-bold mb-4">Distribusi Kondisi</h2>
        <canvas id="chartKondisi"></canvas>
    </div>
</div>

<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-bold">5 Barang Terbaru</h2>
        <a href="{{ route('inventaris.index') }}"
           class="text-sm text-blue-600 hover:underline">Lihat semua →</a>
    </div>
    <table class="min-w-full text-sm">
        <thead class="border-b">
            <tr>
                <th class="p-2 text-left">Kode</th>
                <th class="p-2 text-left">Nama</th>
                <th class="p-2 text-left">Kategori</th>
                <th class="p-2 text-left">Kondisi</th>
                <th class="p-2 text-right">Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($terbaru as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2 font-mono text-xs">{{ $item->kode }}</td>
                    <td class="p-2">{{ $item->nama }}</td>
                    <td class="p-2">{{ $item->kategori->nama }}</td>
                    <td class="p-2">
                        <x-badge-kondisi :nama="$item->kondisi->nama" />
                    </td>
                    <td class="p-2 text-right">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="p-4 text-center text-gray-500">
                    Belum ada barang.
                </td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('chartKategori'), {
        type: 'bar',
        data: {
            labels: @json($perKategori->pluck('nama')),
            datasets: [{
                label: 'Jumlah Barang',
                data: @json($perKategori->pluck('inventaris_count')),
                backgroundColor: '#3b82f6',
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    new Chart(document.getElementById('chartKondisi'), {
        type: 'doughnut',
        data: {
            labels: @json($perKondisi->pluck('nama')),
            datasets: [{
                data: @json($perKondisi->pluck('inventaris_count')),
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
            }]
        },
        options: { responsive: true }
    });
</script>
@endsection