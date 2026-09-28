@extends('layouts.app')

@section('judul', 'Catat Peminjaman')

@section('konten')
<h1 class="text-2xl font-bold mb-4">Catat Peminjaman Baru</h1>

<form method="POST" action="{{ route('peminjaman.store') }}"
      class="bg-white p-6 rounded shadow max-w-xl">
    @csrf

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Barang yang Dipinjam</label>
        <select name="inventaris_id" class="border rounded p-2 w-full" required>
            <option value="">-- Pilih Barang --</option>
            @foreach ($inventaris as $item)
                <option value="{{ $item->id }}" @selected(old('inventaris_id') == $item->id)>
                    {{ $item->kode }} - {{ $item->nama }}
                </option>
            @endforeach
        </select>
        <p class="text-xs text-gray-500 mt-1">
            Hanya barang dengan kondisi "Baik" yang bisa dipinjam.
        </p>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', now()->format('Y-m-d')) }}"
               class="border rounded p-2 w-full" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Rencana Kembali</label>
        <input type="date" name="rencana_kembali"
               value="{{ old('rencana_kembali', now()->addDays(7)->format('Y-m-d')) }}"
               class="border rounded p-2 w-full" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Catatan (opsional)</label>
        <textarea name="catatan" class="border rounded p-2 w-full">{{ old('catatan') }}</textarea>
    </div>

    <div class="flex gap-2">
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
            Simpan
        </button>
        <a href="{{ route('peminjaman.index') }}" class="px-4 py-2 rounded border">Batal</a>
    </div>
</form>
@endsection