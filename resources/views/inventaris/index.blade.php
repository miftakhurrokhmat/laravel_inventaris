@extends('layouts.app')

@section('judul', 'Daftar Inventaris')

@section('konten')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Tabel Inventaris</h1>
    <a href="{{ route('inventaris.create') }}"
       class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
        + Tambah Barang
    </a>
</div>

{{-- Filter & pencarian --}}
<form method="GET" class="mb-4 flex flex-wrap gap-2 items-center">
    <input type="text" name="q" value="{{ request('q') }}"
           placeholder="Cari nama atau kode..."
           class="border rounded p-2 w-64">

    <select name="kategori_id" class="border rounded p-2">
        <option value="">Semua Kategori</option>
        @foreach ($kategori as $k)
            <option value="{{ $k->id }}" @selected(request('kategori_id') == $k->id)>
                {{ $k->nama }}
            </option>
        @endforeach
    </select>

    <select name="kondisi_id" class="border rounded p-2">
        <option value="">Semua Kondisi</option>
        @foreach ($kondisi as $k)
            <option value="{{ $k->id }}" @selected(request('kondisi_id') == $k->id)>
                {{ $k->nama }}
            </option>
        @endforeach
    </select>

    <button class="bg-blue-700 text-white px-4 py-2 rounded">Filter</button>

    @if (request('q') || request('kategori_id') || request('kondisi_id'))
        <a href="{{ route('inventaris.index') }}"
           class="border px-4 py-2 rounded hover:bg-gray-50">Reset</a>
    @endif
</form>

<table class="min-w-full bg-white rounded shadow text-sm">
    <thead class="bg-blue-700 text-white">
        <tr>
            <th class="p-3 text-left">Kode</th>
            <th class="p-3 text-left">Nama Barang</th>
            <th class="p-3 text-left">Kategori</th>
            <th class="p-3 text-left">Kondisi</th>
            <th class="p-3 text-left">Tanggal</th>
            <th class="p-3 text-right">Harga</th>
            <th class="p-3 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($inventaris as $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3 font-mono text-xs">{{ $item->kode }}</td>
                <td class="p-3">{{ $item->nama }}</td>
                <td class="p-3">{{ $item->kategori->nama ?? '-' }}</td>
                <td class="p-3">
                    <x-badge-kondisi :nama="$item->kondisi->nama ?? '-'" />
                </td>
                <td class="p-3">{{ $item->tanggal_perolehan->format('d/m/Y') }}</td>
                <td class="p-3 text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="p-3 space-x-2 whitespace-nowrap">
                    <a href="{{ route('inventaris.show', $item) }}"
                       class="text-blue-600 hover:underline">Lihat</a>
                    <a href="{{ route('inventaris.edit', $item) }}"
                       class="text-yellow-600 hover:underline">Ubah</a>
                    <form action="{{ route('inventaris.destroy', $item) }}"
                          method="POST" class="inline"
                          onsubmit="return confirm('Hapus barang ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="p-6 text-center text-gray-500">
                    Belum ada data inventaris.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">{{ $inventaris->links() }}</div>

<p class="text-sm text-gray-500 mt-2">
    @if ($inventaris->total() > 0)
        Menampilkan {{ $inventaris->firstItem() }} - {{ $inventaris->lastItem() }}
        dari {{ $inventaris->total() }} barang.
    @else
        Tidak ada data.
    @endif
</p>
@endsection