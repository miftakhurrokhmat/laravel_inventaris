@extends('layouts.app')

@section('judul', 'Ubah Kategori')

@section('konten')
<h1 class="text-2xl font-bold mb-4">Ubah Kategori: {{ $kategori->nama }}</h1>

<form method="POST" action="{{ route('kategori.update', $kategori) }}"
      class="bg-white p-6 rounded shadow max-w-xl">
    @csrf @method('PUT')

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Nama Kategori</label>
        <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}"
               class="border rounded p-2 w-full" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Deskripsi</label>
        <textarea name="deskripsi" class="border rounded p-2 w-full">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
    </div>

    <div class="flex gap-2">
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
            Perbarui
        </button>
        <a href="{{ route('kategori.index') }}" class="px-4 py-2 rounded border">Batal</a>
    </div>
</form>
@endsection