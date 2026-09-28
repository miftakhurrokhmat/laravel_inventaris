@extends('layouts.app')

@section('judul', 'Tambah Kondisi')

@section('konten')
<h1 class="text-2xl font-bold mb-4">Tambah Kondisi</h1>

<form method="POST" action="{{ route('kondisi.store') }}"
      class="bg-white p-6 rounded shadow max-w-xl">
    @csrf

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Nama Kondisi</label>
        <input type="text" name="nama" value="{{ old('nama') }}"
               placeholder="Baik, Rusak Ringan, Rusak Berat"
               class="border rounded p-2 w-full" required autofocus>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Keterangan (opsional)</label>
        <input type="text" name="keterangan" value="{{ old('keterangan') }}"
               class="border rounded p-2 w-full">
    </div>

    <div class="flex gap-2">
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
            Simpan
        </button>
        <a href="{{ route('kondisi.index') }}" class="px-4 py-2 rounded border">Batal</a>
    </div>
</form>
@endsection