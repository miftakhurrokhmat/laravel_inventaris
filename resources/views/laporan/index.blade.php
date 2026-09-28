@extends('layouts.app')

@section('judul', 'Laporan')

@section('konten')
<h1 class="text-2xl font-bold mb-6">📈 Laporan</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <a href="{{ route('laporan.per-kategori') }}"
       class="bg-white p-6 rounded shadow hover:shadow-lg transition border-l-4 border-blue-500">
        <h2 class="text-lg font-bold mb-1">Laporan Per Kategori</h2>
        <p class="text-sm text-gray-500">Jumlah dan nilai barang per kategori</p>
    </a>

    <a href="{{ route('laporan.per-kondisi') }}"
       class="bg-white p-6 rounded shadow hover:shadow-lg transition border-l-4 border-green-500">
        <h2 class="text-lg font-bold mb-1">Laporan Per Kondisi</h2>
        <p class="text-sm text-gray-500">Distribusi barang berdasarkan kondisi</p>
    </a>

    <a href="{{ route('laporan.nilai-aset') }}"
       class="bg-white p-6 rounded shadow hover:shadow-lg transition border-l-4 border-yellow-500">
        <h2 class="text-lg font-bold mb-1">Laporan Nilai Aset</h2>
        <p class="text-sm text-gray-500">Total nilai aset dengan filter tanggal</p>
    </a>

    <a href="{{ route('laporan.peminjaman') }}"
       class="bg-white p-6 rounded shadow hover:shadow-lg transition border-l-4 border-purple-500">
        <h2 class="text-lg font-bold mb-1">Laporan Peminjaman</h2>
        <p class="text-sm text-gray-500">Riwayat dan status peminjaman</p>
    </a>
</div>
@endsection