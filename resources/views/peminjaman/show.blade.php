@extends('layouts.app')

@section('judul', 'Detail Peminjaman')

@section('konten')
<h1 class="text-2xl font-bold mb-4">Detail Peminjaman</h1>

<div class="bg-white p-6 rounded shadow max-w-xl">
    <dl class="grid grid-cols-3 gap-3 text-sm">
        <dt class="font-semibold">Kode Pinjam</dt>
        <dd class="col-span-2 font-mono">{{ $peminjaman->kode_pinjam }}</dd>

        <dt class="font-semibold">Barang</dt>
        <dd class="col-span-2">{{ $peminjaman->inventaris->nama }}</dd>

        <dt class="font-semibold">Peminjam</dt>
        <dd class="col-span-2">{{ $peminjaman->user->name }}</dd>

        <dt class="font-semibold">Tanggal Pinjam</dt>
        <dd class="col-span-2">{{ $peminjaman->tanggal_pinjam->format('d F Y') }}</dd>

        <dt class="font-semibold">Rencana Kembali</dt>
        <dd class="col-span-2">{{ $peminjaman->rencana_kembali->format('d F Y') }}</dd>

        <dt class="font-semibold">Tanggal Kembali</dt>
        <dd class="col-span-2">
            {{ $peminjaman->tanggal_kembali?->format('d F Y') ?? 'Belum dikembalikan' }}
        </dd>

        <dt class="font-semibold">Status</dt>
        <dd class="col-span-2">
            <span class="px-2 py-1 rounded text-xs
                @if ($peminjaman->status === 'kembali') bg-green-100 text-green-700
                @elseif ($peminjaman->status === 'terlambat') bg-red-100 text-red-700
                @else bg-yellow-100 text-yellow-700 @endif">
                {{ $peminjaman->status }}
            </span>
        </dd>

        <dt class="font-semibold">Catatan</dt>
        <dd class="col-span-2">{{ $peminjaman->catatan ?: '-' }}</dd>
    </dl>

    <div class="mt-6 flex gap-2">
        @if ($peminjaman->status === 'dipinjam')
            <form action="{{ route('peminjaman.kembalikan', $peminjaman) }}" method="POST">
                @csrf @method('PATCH')
                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Tandai Dikembalikan
                </button>
            </form>
        @endif
        <a href="{{ route('peminjaman.index') }}" class="px-4 py-2 rounded border">Kembali</a>
    </div>
</div>
@endsection