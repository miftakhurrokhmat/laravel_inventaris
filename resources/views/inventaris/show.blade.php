@extends('layouts.app')

@section('judul', 'Detail Inventaris')

@section('konten')
<h1 class="text-2xl font-bold mb-4">Detail Barang</h1>

<div class="bg-white p-6 rounded shadow max-w-3xl">
    <dl class="grid grid-cols-3 gap-3 text-sm mb-6">
        <dt class="font-semibold">Kode</dt>
        <dd class="col-span-2 font-mono">{{ $inventaris->kode }}</dd>

        <dt class="font-semibold">Nama</dt>
        <dd class="col-span-2">{{ $inventaris->nama }}</dd>

        <dt class="font-semibold">Kategori</dt>
        <dd class="col-span-2">{{ $inventaris->kategori->nama }}</dd>

        <dt class="font-semibold">Kondisi</dt>
        <dd class="col-span-2">
            <x-badge-kondisi :nama="$inventaris->kondisi->nama" />
        </dd>

        <dt class="font-semibold">Tanggal Perolehan</dt>
        <dd class="col-span-2">{{ $inventaris->tanggal_perolehan->format('d F Y') }}</dd>

        <dt class="font-semibold">Harga</dt>
        <dd class="col-span-2">Rp {{ number_format($inventaris->harga, 0, ',', '.') }}</dd>

        <dt class="font-semibold">Dicatat oleh</dt>
        <dd class="col-span-2">{{ $inventaris->user->name }}</dd>

        <dt class="font-semibold">Catatan</dt>
        <dd class="col-span-2">{{ $inventaris->catatan ?: '-' }}</dd>
    </dl>

    {{-- Riwayat peminjaman --}}
    <h2 class="font-bold mb-2">Riwayat Peminjaman</h2>
    <table class="min-w-full text-sm border mb-6">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Kode Pinjam</th>
                <th class="p-2 text-left">Peminjam</th>
                <th class="p-2 text-left">Tanggal Pinjam</th>
                <th class="p-2 text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inventaris->peminjaman as $p)
                <tr class="border-b">
                    <td class="p-2 font-mono text-xs">{{ $p->kode_pinjam }}</td>
                    <td class="p-2">{{ $p->user->name }}</td>
                    <td class="p-2">{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                    <td class="p-2">
                        <span class="px-2 py-1 rounded text-xs
                            {{ $p->status === 'kembali' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $p->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="p-4 text-center text-gray-500">
                    Belum pernah dipinjam.
                </td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="flex gap-2">
        <a href="{{ route('inventaris.edit', $inventaris) }}"
           class="bg-yellow-500 text-white px-4 py-2 rounded">Ubah</a>
        <a href="{{ route('inventaris.index') }}" class="px-4 py-2 rounded border">Kembali</a>
    </div>
</div>
@endsection