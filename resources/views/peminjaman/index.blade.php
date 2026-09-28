@extends('layouts.app')

@section('judul', 'Daftar Peminjaman')

@section('konten')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Daftar Peminjaman</h1>
    <a href="{{ route('peminjaman.create') }}"
       class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
        + Catat Peminjaman
    </a>
</div>

<form method="GET" class="mb-4 flex gap-2">
    <select name="status" class="border rounded p-2">
        <option value="">Semua Status</option>
        <option value="dipinjam" @selected(request('status') === 'dipinjam')>Dipinjam</option>
        <option value="kembali" @selected(request('status') === 'kembali')>Kembali</option>
        <option value="terlambat" @selected(request('status') === 'terlambat')>Terlambat</option>
    </select>
    <button class="bg-blue-700 text-white px-4 py-2 rounded">Filter</button>
</form>

<table class="min-w-full bg-white rounded shadow text-sm">
    <thead class="bg-blue-700 text-white">
        <tr>
            <th class="p-3 text-left">Kode</th>
            <th class="p-3 text-left">Barang</th>
            <th class="p-3 text-left">Peminjam</th>
            <th class="p-3 text-left">Tgl Pinjam</th>
            <th class="p-3 text-left">Rencana Kembali</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($peminjaman as $p)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3 font-mono text-xs">{{ $p->kode_pinjam }}</td>
                <td class="p-3">{{ $p->inventaris->nama }}</td>
                <td class="p-3">{{ $p->user->name }}</td>
                <td class="p-3">{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                <td class="p-3">{{ $p->rencana_kembali->format('d/m/Y') }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 rounded text-xs
                        @if ($p->status === 'kembali') bg-green-100 text-green-700
                        @elseif ($p->status === 'terlambat') bg-red-100 text-red-700
                        @else bg-yellow-100 text-yellow-700 @endif">
                        {{ $p->status }}
                    </span>
                </td>
                <td class="p-3 space-x-2 whitespace-nowrap">
                    <a href="{{ route('peminjaman.show', $p) }}"
                       class="text-blue-600 hover:underline">Lihat</a>
                    @if ($p->status === 'dipinjam')
                        <form action="{{ route('peminjaman.kembalikan', $p) }}"
                              method="POST" class="inline"
                              onsubmit="return confirm('Tandai barang ini sudah dikembalikan?')">
                            @csrf @method('PATCH')
                            <button class="text-green-600 hover:underline">Kembalikan</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="p-6 text-center text-gray-500">
                Belum ada peminjaman.
            </td></tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">{{ $peminjaman->links() }}</div>
@endsection