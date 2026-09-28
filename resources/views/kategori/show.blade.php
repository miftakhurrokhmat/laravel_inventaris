@extends('layouts.app')

@section('judul', 'Detail Kategori')

@section('konten')
<h1 class="text-2xl font-bold mb-4">Detail Kategori: {{ $kategori->nama }}</h1>

<div class="bg-white p-6 rounded shadow max-w-3xl">
    <dl class="grid grid-cols-3 gap-3 text-sm mb-6">
        <dt class="font-semibold">Nama</dt>
        <dd class="col-span-2">{{ $kategori->nama }}</dd>

        <dt class="font-semibold">Deskripsi</dt>
        <dd class="col-span-2">{{ $kategori->deskripsi ?? '-' }}</dd>

        <dt class="font-semibold">Jumlah Barang</dt>
        <dd class="col-span-2">{{ $kategori->inventaris->count() }} unit</dd>
    </dl>

    <h2 class="font-bold mb-2">Daftar Barang dalam Kategori Ini</h2>
    <table class="min-w-full text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Kode</th>
                <th class="p-2 text-left">Nama</th>
                <th class="p-2 text-right">Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategori->inventaris as $item)
                <tr class="border-b">
                    <td class="p-2 font-mono text-xs">{{ $item->kode }}</td>
                    <td class="p-2">{{ $item->nama }}</td>
                    <td class="p-2 text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="p-4 text-center text-gray-500">
                    Belum ada barang.
                </td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6 flex gap-2">
        <a href="{{ route('kategori.edit', $kategori) }}"
           class="bg-yellow-500 text-white px-4 py-2 rounded">Ubah</a>
        <a href="{{ route('kategori.index') }}" class="px-4 py-2 rounded border">Kembali</a>
    </div>
</div>
@endsection