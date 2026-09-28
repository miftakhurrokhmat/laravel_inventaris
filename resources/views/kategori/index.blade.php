@extends('layouts.app')

@section('judul', 'Kelola Kategori')

@section('konten')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Kelola Kategori</h1>
    <a href="{{ route('kategori.create') }}"
       class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
        + Tambah Kategori
    </a>
</div>

<table class="min-w-full bg-white rounded shadow text-sm">
    <thead class="bg-blue-700 text-white">
        <tr>
            <th class="p-3 text-left">Nama</th>
            <th class="p-3 text-left">Deskripsi</th>
            <th class="p-3 text-left">Jumlah Barang</th>
            <th class="p-3 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kategori as $k)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3 font-semibold">{{ $k->nama }}</td>
                <td class="p-3">{{ $k->deskripsi ?? '-' }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">
                        {{ $k->inventaris_count }} barang
                    </span>
                </td>
                <td class="p-3 space-x-2">
                    <a href="{{ route('kategori.show', $k) }}"
                       class="text-blue-600 hover:underline">Lihat</a>
                    <a href="{{ route('kategori.edit', $k) }}"
                       class="text-yellow-600 hover:underline">Ubah</a>
                    <form action="{{ route('kategori.destroy', $k) }}"
                          method="POST" class="inline"
                          onsubmit="return confirm('Hapus kategori {{ $k->nama }}?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="p-6 text-center text-gray-500">
                Belum ada kategori. Klik [+ Tambah Kategori] untuk memulai.
            </td></tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">{{ $kategori->links() }}</div>
@endsection