@extends('layouts.app')

@section('judul', 'Tambah Inventaris')

@section('konten')
<h1 class="text-2xl font-bold mb-4">Tambah Barang Inventaris</h1>

<form method="POST" action="{{ route('inventaris.store') }}"
      class="bg-white p-6 rounded shadow max-w-xl">
    @csrf

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Nama Barang</label>
        <input type="text" name="nama" value="{{ old('nama') }}"
               class="border rounded p-2 w-full" required autofocus>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Kategori</label>
        <select name="kategori_id" class="border rounded p-2 w-full" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategori as $k)
                <option value="{{ $k->id }}" @selected(old('kategori_id') == $k->id)>
                    {{ $k->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Kondisi</label>
        <select name="kondisi_id" class="border rounded p-2 w-full" required>
            <option value="">-- Pilih Kondisi --</option>
            @foreach ($kondisi as $k)
                <option value="{{ $k->id }}" @selected(old('kondisi_id') == $k->id)>
                    {{ $k->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Tanggal Perolehan</label>
        <input type="date" name="tanggal_perolehan" value="{{ old('tanggal_perolehan') }}"
               class="border rounded p-2 w-full" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Harga (Rp)</label>
        <input type="number" step="0.01" name="harga" value="{{ old('harga') }}"
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
        <a href="{{ route('inventaris.index') }}" class="px-4 py-2 rounded border">Batal</a>
    </div>
</form>
@endsection